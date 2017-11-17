<?php
namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\AdminPermission;
use think\Request;
use app\admin\model\AdminRole as AdminRoleModel;
use app\admin\model\UserTab;


class AdminRole extends Base{
	protected function validateRule(){
		return array(
			array(
					'rolename|角色名称' => 'require|unique:role',
			)	
		);
	}
	/**
	 * 获取权限名称
	 * @return \think\static
	 */
	public function getPermissionCN() {
		$permissions = AdminPermission::all();
		foreach ($permissions as $permission){
			$CN[$permission['id']] =  substr($permission['authority'],0,strlen($permission['authority'])-6);
		}
		return $CN;
	}
	
	public function roleList(){
		$this->isLogin();
		$roles = AdminRoleModel::all();
		for ($i=0;$i<count($roles);$i++){
			$roles[$i]["permissionid"] = explode(',',$roles[$i]["permissionid"]);
			$permission = $roles[$i]["permissionid"];

			for ($j=0;$j<count($permission);$j++){
				$permissionInfo = explode('-',$permission[$j]);
				$permissionInfo[0] = self::getPermissionCN()[$permissionInfo[0]];
				$permissionArr[$i][] = $permissionInfo;
// 				dump($permissionInfo);
			}
			$roles[$i]["permissionid"] = $permissionArr[$i];
			$roles[$i]["users"] = self::getUserByRoleId($roles[$i]['id']);
			
		}
// 		dump($roles);die();
	
		$this->view->assign('list',$roles);
		return $this->view->fetch('AdminRole/admin-role');
	}
	
	public function getUserByRoleId($roleid){
		$users = UserTab::all(['role'=>$roleid]);
		if (!isset($users) || empty($users)){
			$users = ["暂无相关信息"];
		}
		return $users;
	}
	
	/*
	 * 
	 * 跳转到添加的角色 页面
	 */
	public function addRolePage(){
		$list =  AdminPermission::all();
		for ($i=0;$i<count($list);$i++){
			$list[$i] = $list[$i]->toArray();
		}
		$this->view->assign('list',$list);
		return $this->view->fetch('AdminRole/admin-role-add');
	}
	/**
	 * 添加角色
	 * @param Request $request
	 * @return number[]|string[]|\think\true[]
	 */
	public function addRole(Request $request){
		$data = $request->param();
		
		$status = 0;
		$message = $this->validate($data, self::validateRule()[0]);
		if ($message == 1){
			//通过验证
// 			dump($data);die();
			$data['permissionid'] = implode(',',$data['permissionid']);
			
			$role = new AdminRoleModel($data);
			$role->allowField(true)->save();

			if (isset($role) && !empty($role)){
				$message = "添加成功";
				$status = 1;
			}else {
				$message="内部服务器错误";
			}
		}
		
		return ['status'=>$status,'message'=>$message];
	}
	/**
	 * 跳转到编辑页面
	 * @param Request $request
	 * @return string
	 */
	public function editRolePage(Request $request){
		$id = $request->param();
		$user = AdminRoleModel::get(['id'=>$id['id']]);
		$user = $user->toArray();
		
		$list =  AdminPermission::all();
		for ($i=0;$i<count($list);$i++){
			$list[$i] = $list[$i]->toArray();
		}
		$this->view->assign('list',$list)->assign('user',$user);
		return $this->view->fetch("AdminRole/admin-role-edit");
	}
	/**
	 * 修改角色信息
	 * @param Request $request
	 * @return number[]|string[]
	 */
	public function editRole(Request $request){
		$data = $request->param();
		$id = $data['id'];
		unset($data['id']);
		
		$status = 0;
		$data['permissionid'] = implode(',',$data['permissionid']);
			
		$role = new AdminRoleModel($data);
		$role->where('id',$id)->update($data);
	
		if (isset($role) && !empty($role)){
			$message = "修改成功";
			$status = 1;
		}else {
			$message="内部服务器错误";
		}
		return ['status'=>$status,'message'=>$message];
	}
	
	public function delRole(){
		$id = $_POST['Rid'];
		$user = UserTab::all(['role' => $id]);
		if (isset($user) && !empty($user)){
			$status = 0;
			$message = "该角色类有相关用户，无法删除！";
		}else {
			$delRoel = AdminRoleModel::get(['id'=>$id])->delete();
			if ($delRoel == 1){
				$status = 1;
				$message = "删除成功！";
			}else {
				$status = 0 ;
				$message = "内部服务器错误";
			}
		}
		return ['status'=>$status,'message'=>$message];
	}
}