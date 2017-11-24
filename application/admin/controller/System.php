<?php 
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Request;

class System extends Base{
	public function chart(Request $request){
		$id = $request->param()['c'];
		switch ($id){
			case 1:
				return $this->view->fetch('System/charts-1');
			case 2:
				return $this->view->fetch('System/charts-2');
			case 3:
				return $this->view->fetch('System/charts-3');
			case 4:
				return $this->view->fetch('System/charts-4');
			case 5:
				return $this->view->fetch('System/charts-5');
			case 6:
				return $this->view->fetch('System/charts-6');
			case 7:
				return $this->view->fetch('System/charts-7');
			default:
				return $this->view->fetch('public/codeing');
		}
		
	}
}

?>