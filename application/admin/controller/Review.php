<?php 
namespace app\admin\controller;

use app\admin\controller\Base;

class Review extends Base{
	public function listReview(){
		return $this->view->fetch('public/codeing');
	}
	
}
?>