<?php 
namespace app\admin\controller;
use app\admin\controller\Base;

class Index extends Base {
	public function index() {
		$this->isLogin();
		$this-> view -> assign('title','我的管理系统');
		return $this->view->fetch();
	}
}
?>