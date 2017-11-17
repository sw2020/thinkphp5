<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Request;
use app\admin\model\UserTab;
use think\Session;
use think\helper\Time;
use app\admin\model\AdminRole;

class User extends Base{
	/**
	 * 验证规则
	 * @return string[][]
	 */
	protected function validateRule() {
		return array(
				array(
						'name|用户名' => 'require',
						'password|密码' => 'require',
						'verify|验证码' => 'require|captcha'
				),
				array(
						'name|用户名' => "require|unique:User|min:3|max:10",
						'password|密码' => "require|min:6|max:16",
						'email|邮箱' => 'require|email',
						'phone|手机' => 'require'
				)
		);
	}
	
	public function login(){		
		return $this->view->fetch("User/login");
	}
	/**
	 * 用户登录
	 * @param Request $request
	 * @return number[]|string[]|\think\true[]|mixed[]|array[]
	 */
	public function checkLogin(Request $request){
		//初始化返回参数
		$status = 0;
		$message = '';
		$data = $request->param();
		
		$rule = [
				'name|用户名' => 'require',
				'password|密码' => 'require',
				'verify|验证码' => 'require|captcha'
		];
		
		$user_name = session('user_info')['name'];
		if ($user_name == $data['name'] && !empty($user_name)){
			//该账户已经登陆
			$status = '1';
			$message = "该账户已经登陆，请勿重复登陆";
		}else {
			
			//自定义验证规则
			$msg = [
					'name|用户名' => ['require' => '用户名不能为空'],
					'password|密码' => ['require'=>'密码不能为空'],
					'verify|验证码' => [
							'require'=>'验证码不能为空',
							'captcha'=>'验证码错误'
					]
			];
			
			$message = $this->validate($data,self::validateRule()[0],$msg);
			if ($message == 1){
				$user = UserTab::get(['name'=>$data['name'],'password'=>md5($data['password'])]);
				if ($user['status'] == "已禁用"){
					$message = '该账号被禁用或审核中';
				}elseif (!isset($user)) {
					$message = "没有找到该用户，请重新登录";
				} else {
					$status = 1;
					$message = "恭喜您,登陆成功";
				
					//设置用户登陆信息，session
					Session::set('user_id',$user->id);//用户ID
					Session::set('user_info',$user->getData());//获取用户所有信息
					
					$user_info = $user->toArray();
					$login_count = $user_info['login_count']+1;
				
					$UserModel = new UserTab();
					$UserModel->save([
							'login_time' => time(),
							'login_count' => $login_count
					],['id' => $user->id]);
				}
			}
		}	
	
		return ['status'=>$status,'message'=>$message,'data'=>$data];
	}
	/**
	 * 注销登陆
	 */
	public function logout(){
		Session::delete('user_id');
		Session::delete('user_info');
		$this->success('注销登陆，正在返回','admin/User/login');
	}
	
	/**
	 * 管理员列表显示
	 * @return string
	 */
	public function adminList(){
		$this->isLogin();
		$this->view->assign('title','管理员列表');
		$this->view->assign('keywords','我的管理系统');
		$this->view->assign('description','管理系统');
		
		$this->view->count = UserTab::count();
		
		//判断当前用户是不是超级管理员
		$userName = Session::get('user_info.name');
		if ($userName == 'admin') {
			$list = UserTab::all();//超级管理员  获取所有的管理员信息
		}else {
			$list = UserTab::all(['name'=>$userName]);//非超级管理员只能看到自己的信息
		}
		
		for ($i=0;$i<count($list);$i++){
			$list[$i]['role'] = AdminRole::get(['id'=>$list[$i]['role']])['rolename'];
		}
		
		$this->view->assign('list',$list);
		
		return $this->view->fetch('User/admin-list');
	}
	
	/**
	 * 添加用户页面
	 * @return string
	 */
	public function adminAdd() {
		$this->isLogin();
		
		$roles = AdminRole::all();
		$this->view->assign('roles',$roles);
		$this->view->assign('title','添加管理员');
		$this->view->assign('keywords','我的管理系统');
		$this->view->assign('description','管理系统');
		return $this->view->fetch('User/admin-add');
	}
	/**
	 * 添加用户
	 * @param Request $request
	 * @return number[]|string[]|\think\true[]|mixed[]|array[]
	 */
	public function addUser(Request $request){
		$data = $request->param();
		$status =0;
		
		$message = $this->validate($data, self::validateRule()[1]);
		if ($message == 1){
			if ($data['password'] == $data['password2']){
				
				$data['create_time'] = time();
				$data['update_time'] = time();
				$data['status'] = 0 ;
				$data['password'] = md5($data['password']);
				$user = new UserTab($data);
				//自动过滤掉，表中没有的字段
				$user->allowField(true)->save();
				if (isset($user) && !empty($user)){
					$status = 1;
					$message = "添加用户成功";
				}else {
					$message = "服务器错误，添加失败";
				}
			}else {
				$message = "两次密码输入不一致";
			}
		}
		return ['status'=>$status,'message'=>$message,'data'=>$data];
	}
	/**
	 * 管理员 停用 启用
	 * @param Request $requset
	 */
	public function setStatus(Request $requset){
		$data = $requset->param();
		$userModel = new UserTab();
		$userModel->where('id',$data['uid'])->update(['status'=>$data['status']]);		
	}
	/**
	 * 跳转到editAdminPage 页面
	 * @param Request $requset
	 * @return string
	 */
	public function editAdminPage(Request $requset) {
		$this->isLogin();
		
		$this->view->assign('title','添加管理员');
		$this->view->assign('keywords','我的管理系统');
		$this->view->assign('description','管理系统');
		$roles = AdminRole::all();
		$this->view->assign('roles',$roles);
		$data = $requset->param();
		$userModel = new UserTab();
		$user = $userModel->where('id',$data['uid'])->find();
		$user = $user->toArray();
		
		$this->view->assign('user',$user);
		return $this->view->fetch('User/admin-edit');
	}
	/**
	 * 修改用户信息
	 * @param Request $request
	 * @return number[]|string[]|\think\true[]
	 */
	public function editAdmin(Request $request){
		$data = $request->param();
		$status = 0;
		
		$message = $this->validate($data, self::validateRule()[1]);
		if ($message == 1){
			//表示验证通过
			if ($data['password'] == $data['password2']){
				$data['update_time'] = time();
				unset($data['password2']);
				$data['password'] = md5($data['password']);
				
				$userModel = new UserTab();
				$user = $userModel->where('id',$data['id'])->update($data);
				if (isset($user) && !empty($user)){
					$status = 1;
					$message = "修改成功";
					
				}else {
					$message = "内部服务器错误，修改失败";
				}
			}else {
				$message = "两次密码输入不一致";
			}
		}
		return ['status'=>$status,'message'=>$message];
	}
	
	public function delUser(Request $requst){
		$data = $requst->param();
		UserTab::destroy(['id'=>$data['uid']]);
	}
}

