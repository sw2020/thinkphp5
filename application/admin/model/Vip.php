<?php
namespace app\admin\model;

use think\Model;

class Vip extends \think\Model{
	public $username;
	public $password;
	public $vip;
	public $phone;
	public $create_time;
	public $vipstart;
	public $vipend;
	public $sex;
	public $address;
	public $email;
	public $city;
	public $user_icon;
	
	protected function getsexAttr($value){
		$vip = [
				'0'=>'保密',
				'1'=>'男',
				'2'=>'女'
		];
		return $vip[$value];
	}
	
	protected function getvipAttr($value){
		$vip = [
			'0'=>'未激活',
			'1'=>'已激活'
		];
		return $vip[$value];
	}
	
	protected $table = "vip";
}