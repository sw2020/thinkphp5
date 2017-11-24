<?php 
namespace app\admin\model;

use think\model;

class AdminPermission extends \think\Model{
	
	//权限名称
	public $authority ;
	
	//权限描述
	public $description;
	
	protected $table = 'authority';
}
?>