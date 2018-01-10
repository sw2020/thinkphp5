<?php 
namespace app\admin\model;

use think\Model;

class Review extends Model{
<<<<<<< HEAD
	
	public $id;
	
	public $uid;
	
	public $aid;//文章id
	
	public $review; //留言内容
	
	public $create_time;
	
	
=======
	public $uid;
	
	public $review; //留言内容
	
>>>>>>> 0e03570ddf72ea9a237a1e0574242415e71446c4
	protected $table = "review";
}
?>