<?php 
namespace app\admin\model;

use think\Model;

class Review extends Model{
	
	public $id;
	
	public $uid;
	
	public $aid;//文章id
	
	public $review; //留言内容
	
	public $create_time;
	
	
	protected $table = "review";
}
?>