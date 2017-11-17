<?php
namespace app\api\controller;
use app\api\controller\Base;
use PHPMailer\PHPMailer;
class Code extends Base{
	public function get_code(){
		$username = $this->params['username'];
		$exist = $this->params['is_exist'];
		$username_type = $this->check_username($username);
		switch ($username_type){
			case 'phone':
				$this->get_code_by_username($username,'phone',$exist);
				break;
			case 'email':
				$this->get_code_by_username($username,'email',$exist);
				break;
		}
	}
	/**
	 * 根据手机/邮箱获取验证码
	 * @param unknown $username
	 * @param 【email或者phone】 $type
	 * @param unknown $exist
	 */
	/**
	 * 检查验证码
	 * @param unknown $username
	 * @param unknown $type
	 * @param unknown $exist
	 */
	public function get_code_by_username($username,$type,$exist){
		if ($type == 'phone'){
			$type_name = '手机';
		}elseif ($type == 'email'){
			$type_name = '邮箱';
		}
		/*******检查手机号是否存在*************/
		$this->check_exist($username,$type,$exist);
		/*********检查验证码请求频率是否 过高  30s一次*****/
		if (session("?".$username.'_last_send_time')){
			if (time()-session($username.'_last_send_time')<30){
				$this->return_msg(400,$type_name.'验证，每30秒只能请求一次！');
			}
		}
		/**********生成验证码***********/
		$code = $this->make_code(6);
		/************session存放验证码 md5加密************/
		$md5_code = md5($username.'_'.md5($code));
		session($username.'_code',$md5_code);
		/************session存放验证码的发送时间***********/
		session($username.'_last_send_time',time());
		/**********发送验证码******************************/
		if ($type == 'phone'){
			$this->send_code_to_phone($username,$code);
		}elseif ($type == 'email'){
			$this->send_code_to_email($username,$code);
		}
	}
	/**
	 * 生成随机验证码
	 * @param 【验证码位数】 $num
	 * @return 【验证码】
	 */
	public function make_code($num){
		$max = pow(10,$num) - 1;
		$min = pow(10,($num-1));
		return rand($min,$max);
	}
	public function send_code_to_phone(){
		echo 'send_code_to_phone';
	}
	/**
	 * 向邮箱发送验证码
	 * @param unknown $emai
	 * @param unknown $code
	 */
	public function send_code_to_email($emai,$code){
		$toemail = $emai;
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->CharSet = 'utf-8';
		$mail->Host = 'smtp.qq.com';
		$mail->SMTPAuth = true;
		$mail->Username = "158555827@qq.com";
		$mail->Password = "smufipjeygklbhbb";
		$mail->SMTPSecure = 'ssl';
		$mail->Port = '465';
		$mail->setFrom('158555827@qq.com','接口测试');
		$mail->addAddress($toemail,'test');
		$mail->addReplyTo('158555827@qq.com','Reply');
		$mail->Subject = '您有新的验证码！';
		$mail->Body = "这是一个测试邮件，您的验证码是$code,验证码有效期为一分钟，本邮件无需回复！";
		if (!$mail->send()){
			$this->return_msg(400,$mail->ErrorInfo);
		}else {
			$this->return_msg(200,'验证码已发送成功，请注意查收！');
		}
	}
}