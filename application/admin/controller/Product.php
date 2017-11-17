<?php
namespace app\admin\controller;

use app\admin\controller\Base;

class Product extends Base{
	public function productBrand(){
		return $this->view->fetch('public/codeing');
	}
	
	public function productType(){
		return $this->view->fetch('public/codeing');
	}
	
	public function pro(){
		return $this->view->fetch('public/codeing');
	}
}