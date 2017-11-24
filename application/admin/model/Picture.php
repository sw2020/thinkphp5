<?php
namespace app\admin\model;

use think\model;
class Picture extends \think\Model{
	public $pic_name;
	
	public $pic_id;
	
	public $create_time;
	
	protected $dateFormat = 'Ymd';
	protected $type = [
			'create_time'  =>  'timestamp',
	];
	
	protected $table = 'pic';
}