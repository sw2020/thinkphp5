<?php 
namespace app\admin\common;

use app\admin\model\Picture;

class Pic {
	static public function getPicByid($pic_id){
		$picModel = new Picture();
		$pics = $picModel->all(['pic_id'=>$pic_id]);
		return $pics;
	}
}
?>