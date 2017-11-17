<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Picture;
class FrontendPic extends Base{
	public function main(){
		$PicModel = new Picture();
		$pictures = $PicModel->all();
		$this->view->assign('picture',$pictures);
		return $this->view->fetch('frontend/lw-img');
	}
}