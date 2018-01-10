<?php 
namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\Vip;
use think\Session;
class PersenalCenter extends Base{
	public function main(){
		$this->blogisLogin();
		//获取用户信息
		@$id = Session::get('blogid');
		@$user = Vip::get(['id'=>$id]);
		$this->assign('user',@$user);
		return $this->view->fetch('frontend/personalcenter');
	}
}
?>