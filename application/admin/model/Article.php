<?php 
namespace app\admin\model;

use think\model;
class Article extends \think\Model{
	public $titel;
	
	public $small_title;
	
	public $order;
	
	public $keyword;
	
	public $article;
	
	public $create_time;
	
	public $author;
	
	public $about;
	
	public $glance;
	
	public function getarticletypeAttr($value) {
		$articletype = [
				'0'=>'全部类型',
				'1'=>'帮助说明',
				'2'=>'新闻咨询',
		];
		return $articletype[$value];
	}
	
	protected $table = 'article';
}


?>