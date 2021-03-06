<?php 
namespace app\admin\controller;

use app\admin\controller\Base;
use think\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use think\Url;

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
		$filename = input('filename');
// 		dump($data);die();
// 		$data = explode('/',$data);
// 		$filename = end($data);
		$path = $this->getpath();  //文件目录路径
		
		$extarr = explode('.',$filename);
		$ext = strtolower(end($extarr));
		$picArr = array('gif','png','jpg','jpeg');
		$txtArr = array('txt','html','php','css');
		///判断是不是图片类型
		if (in_array($ext,$picArr)){
			$this->view->assign('pic',$filename);
		}elseif (in_array($ext,$txtArr)) {
			$file = file_get_contents($path.$filename);
			if (strlen($file)>0){
				$this->view->assign('file',$file);
			}else {
				$this->view->assign('file','当前文件没有内容！');
			}
		}else {
			$this->view->assign('file','该文件类型不可查看！');
		}
		
		return $this->view->fetch('fileManage/fileshow');
	}
	
	/**
	 * 修改文件  页面
	 * @return string
	 */
	public function editPage(){
		$filename = input('filename');
		$path = $this->getpath();
		$extarr = explode('.',$filename);
		$ext = strtolower(end($extarr));
		$picArr = array('html','css','txt','php');
		
		if (in_array($ext,$picArr)){
// 			$this->view->assign('file',"不能修改图片类型");
			$file = file_get_contents($path.$filename);
			$this->view->assign('file',$file)->assign('filename',$filename);
			return $this->view->fetch('fileManage/editfile');
		}else {
			echo "该文件类型不可修改!";
		}
	}
	
	/**
	 * 修改文件内容
	 */
	public function edit(){
		$filename = $_POST['filename'];
		$filecontent = $_POST['filecontent'];
		$path = $this->getpath();
		
		$file = file_put_contents($path.$filename,$filecontent);
		if ($file){
			$message = "修改文件成功";
		}else {
			$message = "修改文件失败";
		}
		alertMes($message, Url::build('FileManage/show','filename='.$filename));
	}
	/**
	 * 文件重命名
	 * @return string
	 */
	public function rename(){
		$oldfilename = input('filename');
		$path = ROOT_PATH.'/public/fileManage/';  //文件目录路径
		$this->view->assign('oldfilename',$oldfilename);
		return $this->view->fetch('fileManage/rename');
	}
	/**
	 * 文件重命名的操作
	 * @return number[]|string[]
	 */
	public function filerename(){
		$oldname = $_POST['oldfilename'];
		$filename = $_POST['filename'];
		$path = $this->getpath();
		
		$res = rename($path.$oldname,$path.$filename);
		if ($res ==true){
			$status = 1;
			$message = "修改成功";
		}else {
			$status = 0;
			$message = "修改失败";
		}
		return ['status'=>$status,'message'=>$message];
	}
	
	/**
	 * 删除文件
	 * @param Request $request  文件名
	 * @return status=1 表示删除成功
	 */
	public function del(Request $request){
		$data = $request->param();
		$filename = $data['filename'];
		$file = $this->getpath().$filename;
		if (unlink($file)){
			$status = 1;
			$message = "删除成功";
		}else {
			$status = 0;
			$message = "内部服务器错误，删除失败";
		}
		
		return ['status'=>$status,'message'=>$message];
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
	
	/**
	 * 下载文件
	 * @return string
	 */
	public function downloadfile(){
		$filename = input('filename');
		$file = $this->getpath().$filename;
		
		if (file_exists($file) == true){
			header("Content-Disposition:attachment;filename=".$filename);
			header("Accept-ranges:bytes");
			header("Accept-length:".filesize($file));
			readfile($file);
// 			fopen($file,"r");
		}else {
			echo "该文件已被删除";
		}
		return $this->view->fetch('public/test');
	}
	
	public function copyfile(){
		$filename = input('filename');
		$path = $this->getpath();
		$file = $path.$filename;
		$newfile = $path.'附件'.$filename;
		
		if(copy($file,$newfile)){
			$status =1;
			$message = "复制成功";
		}else {
			$status = 0;
			$message = '复制失败';
		}
		
		return ['status'=>$status,'message'=>$message];
	}
	
	public function getpath(){
		return  ROOT_PATH.'/public/fileManage/';
	}
	
}

?>