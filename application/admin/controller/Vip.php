<?php 
namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\Vip as VipModel;
use think\Request;
<<<<<<< HEAD
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
=======
>>>>>>> 0e03570ddf72ea9a237a1e0574242415e71446c4
class Vip extends Base{
	protected function validateRule(){
		return array(
				array(
						'username|用户名' => 'require|Unique:Vip|min:4|max:16',
						'phone|手机号' => 'require',
						'email|邮箱' => 'require|email|Unique:Vip'
				)
		);
	}
	/**
	 * 显示会员列表
	 * @return string
	 */
	public function listVip(){
		$VipModel = new VipModel();
		$data = $VipModel->all();
		$this->view->assign('vips',$data);
		return $this->view->fetch('vip/member-list');
	}
	/**
	 * 添加用户（page）
	 * @return string
	 */
	public function addpage(){
		return $this->view->fetch('vip/member-add');
	}
	/**
	 * 添加用户
	 * @param Request $request
	 * @return number[]|string[]|\think\true[]
	 */
	public function add(Request $request){
		$data = $request->param();
		$status = 0;
		$message = $this->validate($data,self::validateRule()[0]);
		if ($message == 1){
			if(preg_match("/^[\x80-\xff_a-zA-Z0-9]{3,15}$/",$data['username']) == 1){
				//通过验证
				$data['password'] = md5('123456');
				$data['create_time'] = time();
				$VipModel = new VipModel($data);
				$VipModel->allowField(true)->save();
				if (isset($VipModel) && !empty($VipModel)){
					$status = 1;
					$message = '添加成功！';
				}else {
					$message = '内部服务器发生错误，添加失败！';
				}
			}else {
				$message = '用户名只能是字母、数字、汉字组成！';
			}
		}
		return ['status'=>$status,'message'=>$message];
	}
	/**
	 * 查看用户详细信息
	 * @return string
	 */
	public function show(){
		$id = input('id');
		$VipModel = new VipModel();
		$data = $VipModel->get(['id'=>$id]);
		$this->view->assign('data',$data);
		return $this->view->fetch('vip/member-show');
	}
	/**
	 * 开通会员
	 * @return number[]|string[]
	 */
	public function active(){
		$id = input('id');
		$VipModel = new VipModel();
		$startTime = time();
		$endTime = strtotime("+ 1 month",strtotime(date('Y-m-d',$startTime)));
		$active = $VipModel->save(['vip'=>'1','vipstart'=>$startTime,'vipend'=>$endTime],['id'=>$id]);
		if ($active == 1){
			$status = 1;
			$message = "已激活";
		}
		$result = '<tr><th class="text-r">到期时间：</th><td class="endtime">'.date('Y-m-d',$endTime).'<a class = "add-vip" href="#"> 续费</a></td></tr>';
		return ['status'=>$status,'message'=>$message,'result'=>$result];
	}
	/**
	 * 续费
	 * @return number[]|string[]
	 */
	public function renew(){
		$id = input('id');
		$VipModel = new VipModel();
		$vip = $VipModel->get(['id'=>$id]);
		$endTime = strtotime("+ 1 month",strtotime(date('Y-m-d',$vip['vipend'])));
		$renew = $VipModel->save(['vipend'=>$endTime],['id'=>$id]);
		if ($renew == 1){
			$status = 1;
			$message = '续费成功';
			$html = date('Y-m-d',$endTime).'<a class = "add-vip" href="#">续费</a>';
		}
		return ['status'=>$status,'message'=>$message,'html'=>$html];
	}
	/**
	 * 跳转到修改密码页面
	 * @return string
	 */
	public function changePass(){
		$id = input('id');
		$VipModel = new VipModel();
		$vip = $VipModel->get(['id'=>$id]);
		$this->view->assign('vip',$vip);
		return $this->view->fetch('vip/change-password');
	}
	/**
	 * 修改密码
	 * @param Request $request
	 * @return number[]|string[]
	 */
	public function password(Request $request){
		$status = 0;
		$data = $request->param();
		if ($data['newpassword'] == $data['newpassword2']){
			$VipModel = new VipModel();
			$md5pass = md5($data['newpassword']);
			$change = $VipModel->save(['password'=>$md5pass],['id'=>$data['id']]);
			if ($change == 1){
				$status = 1;
				$message = '密码修改成功！';
			}else {
				$message = '内部服务器错误，修改失败!';
			}
		}else {
			$message = '两次密码输入不一致';
		}
		return ['status'=>$status,'message'=>$message];
	}
	/**
	 * 会员账号删除
	 * @param Request $request
	 * @return number[]|string[]
	 */
	public function del(Request $request){
		$data = $request->param();
		$status = 0 ;
		$VipModel = new VipModel();
		$del = $VipModel->destroy(['id'=>$data['id']]);
		if ($del == 1){
			$status = 1;
			$message = '删除成功！';
		}else {
			$message = '内部服务器错误，删除失败！';
		}
		return ['status'=>$status,'message'=>$message];
	}
	/**
	 * 跳转到修改的页面
	 * @return string
	 */
	public function editPage(){
		$id = input('id');
		$VipModel = new VipModel();
		$vip = $VipModel->get(['id'=>$id]);
		$this->view->assign('vip',$vip);
		return $this->view->fetch('vip/member-edit');
	}
	
	/**
	 * 修改用户信息
	 * @param Request $request
	 * @return number[]|string[]|\think\true[]
	 */
	public function edit(Request $request){
		$status = 0;
		$data = $request->param();
		$message = $this->validate($data,self::validateRule()[0]);
		if ($message == 1){
			if(preg_match("/^[\x80-\xff_a-zA-Z0-9]{3,15}$/",$data['username']) == 1){
				//通过验证
				$VipModel = new VipModel();
				$VipModel->allowField(true)->save($data,['id'=>$data['id']]);
				if (isset($VipModel) && !empty($VipModel)){
					$status = 1;
					$message = '修改成功！';
				}else {
					$message = '内部服务器发生错误，修改失败！';
				}
			}else {
				$message = '用户名只能是字母、数字、汉字组成！';
			}
		}
		return ['status'=>$status,'message'=>$message];
	}
<<<<<<< HEAD
	
	public function showtest(){
		return $this->view->fetch('model/index');
	}
	
	public function test(Request $request){
		$data = $_FILES['file_data']['name'];
		return ['data'=>$data];
	}
=======
>>>>>>> 0e03570ddf72ea9a237a1e0574242415e71446c4
}
?>