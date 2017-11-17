<?php
namespace app\api\controller;
use think\Request;
use think\Controller;
use think\Validate;
use think\Image;
class Base extends Controller{
	protected $requset;  //用来处理参数
	protected $validater;  // 用来验证数据/参数
	protected $params;	//过滤后符合要求的参数（不包括time和token）
	protected $rules = array(
			'User' =>array(
				'login'=>array(				//$rules['User']['login]
						'username'=>['require','max'=>20],
						'password'=>['require','length'=>32]
				),
				'register'=>array(				
						'username'=>['require','max'=>20],
						'password'=>['require','length'=>32],
						'code'=>['require','number','length'=>6]
				),
				'upload_head_icon'=>array(
						'id'=>'require|number',
						'user_icon'=>'require|image|fileSize:2000000|fileExt:jpg,png,bmp,jpeg',
				),
				'change_pwd'=>array(
						'username'=>['require','max'=>20],
						'old_password'=>['require','length'=>32],
						'password'=>['require','length'=>32]
				),
				'find_pwd'=>array(
						'username'=>['require','max'=>20],
						'password'=>['require','length'=>32],
						'code'=>['require','number','length'=>6]
				),
			),
			'Code'=>array(
				'get_code'=>array(
						'username'=>['require'],
						'is_exist'=>['require','number','length'=>1]
				)
			),
	);
	
	protected function _initialize(){
		parent::_initialize();
		$this->requset = Request::instance();
		//检查是否超时
// 		$this->check_time($this->requset->only(['time']));
// 		//检查token
// 		$this->check_token($this->request->param());
		//验证过滤后，剔除time和token的参数
// 		$this->check_params($this->request->except(['time','token']));
		$this->check_params($this->request->param(true));
	}
	/**
	 * 
	 * @param unknown $arr [包含时间戳的参数数组]
	 * @return  [json]  [检验结果]
	 */
	public function check_time($arr){
		if (!isset($arr['time']) || intval($arr['time']) <=1){
			$this->return_msg ('400','时间戳不存在！');
		}
		if (time() - intval($arr['time']) >60){
			$this->return_msg('400','请求超时！');
		}
	}
	/**
	 * 检查token,防止篡改token
	 * @param unknown $arr
	 */
	public function check_token($arr){
		/*********************api传过来的token*******/
		if (!isset($arr['token']) || empty($arr['token'])){
			$this->return_msg(400,'token不能为空!');
		}
		$api_token = $arr['token'];
		/*********************服务器生成的token*****/
		unset($arr['token']);
		$service_token = '';
		foreach ($arr as $key => $value){
			$service_token .= md5($value);
		}
		$service_token = md5('api_'.$service_token.'_api');
		if ($api_token !== $service_token){
			$this->return_msg(400,'token不正确！');
		}
	}
	/**
	 * 验证参数，过滤参数
	 * @param unknown $arr
	 */
	public function check_params($arr){
		/**************获取验证规则******************/
		$rule = $this->rules[$this->request->controller()][$this->request->action()];
		$this->validater = new Validate($rule);
		if (!$this->validater->check($arr)){
			$this->return_msg(400,$this->validater->getError());
		}
		/***********通过验证**********/
		$this->params = $arr;
	}
	/**
	 * 检测用户名，并返回用户名类型
	 * @param unknown $username
	 * @return string
	 */
	public function check_username($username){
		$is_email = Validate::is($username,'email')?1:0;
		$is_phone = preg_match('/^1[3578]\d{9}$/',$username)?4:2;
		$flag = $is_email + $is_phone;
		switch ($flag){
			case 2:
				$this->return_msg(400,'手机或邮箱格式不正确！');
				break;
			case 3:
				return 'email';
				break;
			case 4:
				return 'phone';
				break;
		}
	}
	/**
	 * 
	 * @param  $value
	 * @param [phone or email] $type
	 * @param  $exist
	 */
	public function check_exist($value,$type,$exist){
		$type_num = $type =='phone'?2:4;
		$flag = $type_num+$exist;
		$phone_res = db('vip')->where('phone',$value)->find();
		$email_res = db('vip')->where('email',$value)->find();
		switch ($flag){
			case 2:
				if (isset($phone_res) && !empty($phone_res)){
					$this->return_msg(400,'此手机号被占用！');
				}
				break;
			case 3:
				if (!isset($phone_res) || empty($phone_res)){
					$this->return_msg(400,'手机号不存在！');
				}
				break;
			case 4:
				if (isset($email_res) && !empty($email_res)){
					$this->return_msg(400,'此邮箱已被占用！');
				}
				break;
			case 5:
				if (!isset($email_res) || empty($email_res)){
					$this->return_msg(400,'此邮箱不存在！');
				}
				break;
		}
	}
	/***
	 * 检查验证码
	 * @param unknown $username
	 * @param unknown $code
	 */
	public function check_code($username,$code){
		/********检查是否超时*********/
		$last_time = session($username.'_last_send_time');
		if (time() - $last_time >600){
			$this->return_msg(400,'验证超时');
		}
		/*********验证码是否正确******/
		$md5_code = md5($username.'_'.md5($code));
		if (session($username.'_code') !== $md5_code){
			$this->return_msg(400,'验证码不正确！');
		}
		/*****不管是否正确，每个验证码只验证一次****/
		session($username.'_code',null);
	}
	/**
	 * 上传图片
	 * @param 文件 $file
	 * @param 文件用于的类型，例如（icon_img） $type
	 * @return string  文件保存的路径
	 */
	public function upload_file($file,$type=''){
		$info = $file->move(ROOT_PATH . 'public' . DS . 'icons');
		if (isset($info) && !empty($info)){
			$path = '/icons/' . $info->getSaveName();
			/**************裁剪图片***************/
			if (!empty($type)){
				$this->image_edit($path,$type);
				
			}
			return $path;
		}else {
			$this->return_msg(400,$file->getError());
		}
	}
	
	public function image_edit($path,$type){
		$image = Image::open(ROOT_PATH. 'public' .$path);
		switch ($type){
			case 'head_img':
				$image->thumb(200,200,Image::THUMB_CENTER)->save(ROOT_PATH. 'public' .$path);
				break;
		}
	}
	/**
	 * 返回状态
	 * @param unknown $code
	 * @param string $msg
	 * @param array $data
	 */
	public function return_msg($code,$msg='',$data=[]){
		/***************整合数据**********************/
		$return_data['code'] = $code;
		$return_data['msg'] = $msg;
		$return_data['data'] =$data;
		/***********************返回以上数据，终止脚本**********/
		echo json_encode($return_data);die();
	}
	
}














