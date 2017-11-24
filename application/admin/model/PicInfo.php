<?php
namespace app\admin\model;

use think\model;

class PicInfo extends \think\Model{
	
	const STATUS_ACTIVED = 1;
	
	public $pics_name;
	
	public $p_name;
	
	public $types;
	
	public $order;
	
	public $status;
	
	public $pic_author;
	
	public $pic_source;
	
	public $keywords;
	
	public $about;
	
	public $pic_id;
	
	public $create_time;
	
	public $update_time;
	
	public function getTypesAttr($value) {
		$types = [
			'0'=>'全部栏目',
			'1'=>'新闻资讯',
			'11'=>'行业动态',
			'12'=>'行业新闻',
			'13'=>'行业咨询'
		];
		return $types[$value];
	}
	
	protected $table = "pic_info";
}
?>