<?php 
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Request;
use app\admin\model\Vip;
use think\Session;
class FrontendLog extends Base{
	
	public function log(){
		return $this->view->fetch('frontend/lw-log');
	}
	/**
	 * 登录
	 * @param Request $request
	 * @return number[]|string[]
	 */
	public function login(Request $request){
		$data = $request->param();
		$status = 0 ;
		if (preg_match('/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i',$data['email']) == 1){
			if (strlen($data['password']) <11){
				$message = '密码长度不能小于11位';
			}else {
				$user = Vip::get(['email'=>$data['email'],'password'=>md5($data['password'])]);
				if (isset($user) && !empty($user)){
					Session::set('blogid',$user['id']);
					Session::set('blogemail',$user['email']);
					
					$status =1;
					$message = '登陆成功!';
				}else {
					$message = '账号和密码不匹配！';
				}
			}
		}else {
			$message = '邮箱格式错误！';
		}
		return ['status'=>$status,'message'=>$message];
	}
	/**
	 * 注册页面
	 * @return string
	 */
	public function reg(){
		return $this->view->fetch('frontend/lw-re');
	}
	public function regs(Request $request){
		$data = $request->param();
		$status = 0;
		if (preg_match('/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i',$data['email']) == 1){
			if (strlen($data['password']) <11){
				$message = '密码长度不能小于11位';
			}else {
				if ($data['password'] !== $data['repassword']){
					$message = '两次密码输入不一致！';
				}else {
					$user = Vip::get(['email'=>$data['email']]);
					if (isset($user) && !empty($user)){
						$message = '此邮箱已注册！';
					}else {
						$user = new Vip();
						$user->data([
								'email'=>$data['email'],
								'password'=>md5($data['password']),
								'create_time'=>time()
						]);
						$reg = $user->save();
						if ($reg == 1){
							$message = '注册成功！';
							$status = 1;
						}
					}
				}
			}
		}else {
			$message = '邮箱格式错误！';
		}
		return ['status'=>$status,'message'=>$message];
	}
}
?>