<?php
namespace app\admin\controller;
use think\controller;
use think\Session;

class Base extends \think\Controller {
	//判断用户是否登陆
	protected function isLogin() {
		$user_id = session('user_id');
		if (!isset($user_id) || empty($user_id)){
			//未登陆
			$this->error('请先登陆！','admin/User/login');
		}
	}
	
	//防止重复登陆
	protected function alreadyLogin($post_name) {
		$user_name = session('user_info')['name'];
		if ($user_name == $post_name){
			//未登陆
			$this->error('该账户已经登陆！','Index/index');
		}
	}
	
<<<<<<< HEAD
	//判断用户是否登陆
	protected function blogisLogin() {
		$user_id = session('blogid');
		if (!isset($user_id) || empty($user_id)){
			//未登陆
			$this->error('请先登陆！','admin/FrontendLog/log');
		}
	}
=======
>>>>>>> 0e03570ddf72ea9a237a1e0574242415e71446c4
}
?>