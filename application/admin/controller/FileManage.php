<?php 
namespace app\admin\controller;

use app\admin\controller\Base;
use think\Request;

class FileManage extends Base{
	public function main(){
		$this->isLogin();
		$path = ROOT_PATH.'/public/fileManage/';
		$info = $this->readDirectory($path);
		$this->view->assign('files',$info)->assign('path',$path);		
		return $this->view->fetch('fileManage/index');
	}
	
	/**
	 * 显示添加文件的页面
	 * @return string
	 */
	public function createFile(){
		$path = ROOT_PATH.'/public/fileManage/';  //文件目录路径
		$this->view->assign('path',$path);	
		return $this->view->fetch('fileManage/addfile');
	}
	/**
	 * 添加文件
	 * @param Request $request
	 * @return number[]|string[]
	 */
	public function add(Request $request){
		$data = $request->param();
		$filename = $data['filename'];
		$path = $data['path'];
		$file = $path.'/'.$filename;
		$message = '';
		$status = 0;
		
		$pattern = "/[\/,\*,<>,\?|]/";
		if (!preg_match($pattern,$filename)){
			if (!file_exists($file)){
				//通过touch（filename） 创建文件
				if (touch($file)){
					$message = "文件创建成功";
					$status =1;
				}else {
					$message = "文件创建失败";
				}
			}else {
				$message = "文件已存在";
			}
		}else {
			$message = '非法的文件名';
		}
		return ['status'=>$status,'message'=>$message];
	}
	/**
	 * 查看文件
	 * @return string
	 */
	public function show(){
		//获取要查看的文件的文件名
		$data = Request::instance()->pathinfo();
		$data = explode('/',$data);
		$filename = end($data);
		$path = ROOT_PATH.'/public/fileManage/';  //文件目录路径
		$extarr = explode('.',$filename);
		$ext = strtolower(end($extarr));
		$picArr = array('gif','png','jpg','jpeg');
		///判断是不是图片类型
		if (in_array($ext,$picArr)){
			$this->view->assign('pic',$filename);
		}else {
			$file = file_get_contents($path.$filename);
			if (strlen($file)>0){
				$this->view->assign('file',$file);
			}else {
				$this->view->assign('file','当前文件没有内容！');
			}
		}
		
		return $this->view->fetch('fileManage/fileshow');
	}
	
	public function edit(){
		
	}
	
	public function del(Request $request){
		$data = $request->param();
		dump($data);
	}
	
	/**
	 * 读取文件夹
	 * @param  $path  文件路径
	 * @return arr	文件夹里面的内容
	 */
	public function readDirectory($path){
		$handle = opendir($path);
		$arr = array();
		while (($item = readdir($handle))!== false){
			if ($item != "." && $item != ".."){
				if (is_file($path."/".$item)){
					$arr['file'][] = $item;
				}
				if (is_dir($path."/".$item)){
					$arr['dir'][] = $item;
				}
			}
		}
		closedir($handle);
		return $arr;
	}
	
	
	
}

?>