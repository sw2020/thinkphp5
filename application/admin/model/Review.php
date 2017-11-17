<?php 
namespace app\admin\model;

use think\Model;

class Review extends Model{
	public $uid;
	
	public $review; //留言内容
	
	protected $table = "review";
}
?>