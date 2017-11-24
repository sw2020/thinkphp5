<?php 
namespace app\admin\model;

use think\model;
use traits\model\SoftDelete;
class AdminRole extends \think\Model{
	
	//角色名称
	public $rolename;
	
	//角色权限
	public $permissionid;
	
	//角色描述
	public $description;
	
	protected $table = "role";
	
	use SoftDelete;
	protected $deleteTime = 'deletetime';
}
?>