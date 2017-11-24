<?php 
namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\AdminPermission as PermissionModel;
use think\Request;

class AdminPermission extends Base{
	
	protected function validateRule(){
		return  array(
				array(
						'authority|权限名称'=>'require|unique:authority|min:3|max:30',
						'description|权限描述'=>'max:100'
				)
		);
	}
	/**
	 * 权限列表显示
	 * @return string
	 */
	public function permissionList() {
		$this->isLogin();
		
		$permissions = PermissionModel::all();
		$count = count($permissions);
		for ($i=0;$i<count($permissions);$i++){
			$permissions[$i] = $permissions[$i]->toArray();
		}
		$this->view->assign('title','权限列表')->assign('list',$permissions)->assign('count',$count);
		return $this->view->fetch('AdminPermission/admin-permission');
	}
	/**
	 * 添加权限页面
	 * @return string
	 */
	public function permissionAddPage(){
		$this->view->assign('title','添加权限');
		return $this->view->fetch('AdminPermission/permission-add');
	}
	/**
	 * 添加权限
	 * @param Request $requset
	 * @return number[]|string[]|\think\true[]
	 */
	public function permissionAdd(Request $requset){
		$status = 0;
		
		$data = $requset->param();
		$message = $this->validate($data, self::validateRule()[0]);
		
		if ($message == 1){
			$permission = new PermissionModel($data);
			$isSave = $permission->allowField(true)->save();
			if ($isSave == 1){
				$status = 1;
				$message = '添加成功';
			}else {
				$message = '内部服务器错误';
			}
		}
		return ['status'=>$status,'message'=>$message];
	}
	
}

?>