<?php
namespace app\admin\model;
use think\model;
use traits\model\SoftDelete;

class UserTab extends \think\Model {
	
	protected $pk = "id";
	
	//用户名
	public $name;
	
	//密码
	public $password;
	
	//邮箱
	public $email;
	
	//创建时间
	public $create_time;
	
	//跟新时间
	public $update_time;
	
// 	//角色
// 	public $role;
	
// 	//状态 1启用 0禁用
// 	public $status;
	
// 	//删除时间
// 	public $delete_time;
	
	//登录时间
	public $login_time;
	
	//登陆次数
	public $login_count;
	
// 	//角色role 返回值处理
// 	public function getRoleAttr($value) {
// 		$roles = AdminRole::all();
// 		foreach ($roles as $role){
// 			$rol[$role['id']] = $role['rolename'];
// 		}
// 		return $rol[$value];
// 	}
	
	//状态字段 status 返回值处理
	public function getStatusAttr($value) {
		$status = [
				0=>'已禁用',
				1=>'已启用'
		];
		return $status[$value];
	}
	
	protected $table = 'user';
	
	use SoftDelete;
	protected $deleteTime = 'delet_time';

}