<?php
namespace app\api\controller;
use app\api\controller\Base;
use think\db\Query;
class User extends Base{
	/**
	 * 用户登录接口
	 */
	public function login(){
		$data = $this->params;
		/******检测用户名是手机还是邮箱*/
		$user_name_type = $this->check_username($data['username']);
		switch ($user_name_type){
			case 'phone':
				$this->check_exist($data['username'], 'phone', 1);
				$dbres = db('vip')->field('id,username,password,phone,email,create_time')->where('phone',$data['username'])->find();
				break;
			case 'email':
				$this->check_exist($data['username'], 'email', 1);
				$dbres = db('vip')->field('id,username,password,phone,email,create_time')->where('email',$data['username'])->find();
				break;
		}
		if ($dbres['password'] !==$data['password']){
			$this->return_msg(400,'用户名或密码不正确！');
		}else {
			unset($dbres['password']);
			$this->return_msg(200,'登陆成功！',$dbres);
		}
	}
	/**
	 * 注册
	 */
	public function register(){
		$data = $this->params;
		/********检查验证码*******/
		$this->check_code($data['username'],$data['code']);
		/*******检查用户名********/
		$user_name_type = $this->check_username($data['username']);
		switch ($user_name_type){
			case 'phone':
					$this->check_exist($data['username'], 'phone', 0);
					$data['phone'] = $data['username'];
					break;
			case 'email':
					$this->check_exist($data['username'], 'email', 0);
					$data['email'] = $data['username'];
					break;
		}
		/*************用户信息写入数据库******/
		unset($data['username']);
		unset($data['code']);
		$data['create_time'] = time();
		$res = db('vip')->insert($data);
		if (isset($res) && !empty($res)){
			$this->return_msg(200,'用户注册成功！');
		}else {
			$this->return_msg(400,'用户注册失败！');
		}
	}
	/**
	 * 上传头像
	 */
	public function upload_head_icon(){
		/***********接收参数*******/
		$data = $this->params;
		/***********上传文件，获取路径***********/
		$head_img_path = $this->upload_file($data['user_icon'],'head_img');
		/***********存入数据看**********/
		$res = db('vip')->where('id',$data['id'])->setField('user_icon',$head_img_path);
		if (isset($res) && !empty($res)){
			$this->return_msg(200,'头像上传成功！',$head_img_path);
		}else {
			$this->return_msg(400,'头像上传失败！');
		}
		
	}
	/**
	 * 修改密码
	 */
	public function change_pwd(){
		/*******接受参数*******/
		$data = $this->params;
		/*******检查用户名**********/
		$user_name_type = $this->check_username($data['username']);
		switch ($user_name_type){
			case 'phone':
				$this->check_exist($data['username'],'phone', 1);
				$where = "`phone`='{$data['username']}'";
				break;
			case 'email':
				$this->check_exist($data['username'],'email', 1);
				$where = "`email`='{$data['username']}'";
				break;
		}
		$dbres = db('vip')->where($where)->find();
		if ($dbres['password'] == $data['old_password']){
			/************旧密码和账号匹配，可以修改密码************/
			$res = db('vip')->where($user_name_type,$data['username'])->setField('password',$data['password']);
			if ($res !== false){
				$this->return_msg(200,'修改密码成功！');
			}else {
				$this->return_msg(400,'修改密码失败！');
			}
		}else {
			$this->return_msg(400,'旧密码不正确！');
		}
	}
	
	public function find_pwd(){
		/***********接受参数********/
		$data = $this->params;
		$user_name_type = $this->check_username($data['username']);
		$this->check_code($data['username'], $data['code']);
		switch ($user_name_type){
			case 'phone':
				$this->check_exist($data['username'], 'phone', 1);
				$where['phone'] = $data['username'];
				break;
			case 'email':
				$this->check_exist($data['username'], 'email', 1);
				$where['email'] = $data['username'];
				break;
		}
		$dbres = db('vip')->where($where)->setField('password',$data['password']);
		if ($dbres !== false){
			$this->return_msg(200,'修改密码成功！');
		}else {
			$this->return_msg(400,'修改密码失败');
		}
	}
}






















