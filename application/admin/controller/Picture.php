<?php
namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\Picture as picModel;
use app\admin\model\PicInfo;
use think\Request;
use app\admin\common\Pic;
use think\Image;

class Picture extends Base {
	/**
	 * 图片组名称验证
	 * picinfo表
	 * @return string[][]
	 */
	protected function validateRule() {
		return array(
				array(
					'pics_name|图片标题' => 'require|unique:PicInfo|min:6|max:32',
				),
		);
	}
	/**
	 * 生成缩略图的尺寸
	 * @return number[]
	 */
	protected function thumbSize() {
		return array(
			'0'=>600, //600*600尺寸
			'1'=>300,
			'2'=>100,
			'3'=>1200,
		);
	}
	/**
	 * 显示图片组列表
	 * @return string
	 */
	public function main(){
		$picModel = new PicInfo();
		$picInfo = $picModel->all();
		for ($i = 0 ;$i<count($picInfo);$i++){
			$picInfo[$i] = $picInfo[$i]->toArray();
			$picInfo[$i]['pics'] = Pic::getPicByid($picInfo[$i]['pic_id']);
			for ($j=0;$j<count($picInfo[$i]['pics']);$j++){
				$picInfo[$i]['pics'][$j] = $picInfo[$i]['pics'][$j]->toArray();
			}
		}
		$this->assign('picInfo',$picInfo);
		return $this->view->fetch('picture/picture-list');
	}
	/**
	 * 查看图片
	 * @return string
	 */
	public function show(){
		$id = input('id');
		$sql = "SELECT `t0`.* from `pic` `t0` LEFT JOIN `pic_info` `t1` ON 
				`t0`.`pic_id` = `t1`.`pic_id` WHERE `t1`.`id`={$id}";
		$pics = new picModel();
		$pics = $pics->query($sql);
		$this->assign('pics',$pics);
		return $this->view->fetch('picture/picture-show');
	}
	/**
	 * 跳转到添加的页面
	 * @return string
	 */
	public function addPage(){
		return $this->view->fetch('picture/picture-add');
	}
	
	/**
	 * 图片上传，并把图片名称保存到pic表中
	 */
	public function upload(){
		$files = request()->file();
		foreach ($files as $file){
			$ext = $file->getExtension();
			
			$img = \think\Image::open($file);
			$info = $file->move(ROOT_PATH.'public'.DS.'uploads');
			
			if ($info){
				$thumbSizeArr = self::thumbSize();
				for ($i=0;$i<count($thumbSizeArr);$i++){
					$img->thumb($thumbSizeArr[$i], $thumbSizeArr[$i])->save(ROOT_PATH.'public'.DS.'thumb'.$thumbSizeArr[$i].'/' . $info->getFilename());
				}
				$pic_name = $info->getFilename();
				$message = "上传成功";
				$status = 1;
			}else {
				echo $file->getError();
			}
		}
		$pic = new picModel([
			'pic_name'=>$pic_name,
			'pic_id' =>$_POST['pic_id'],
			'create_time'=>time()
		]);
		$pic->save();
	}
	/**
	 * picinfo表中存放图片的相关记录
	 * @param Request $request
	 * @return number[]|string[]|\think\true[]|mixed[]|array[]
	 */
	public function addPicInfo(Request $request){
		$status = 0 ;
		$message = '';
		$data = $request->param();
		$pic = picModel::get(['pic_id'=>$data['pic_id']]);
		if (isset($pic) && !empty($pic)){
			$message =$this->validate($data,self::validateRule()[0]);
			
			if ($message == 1){
				//通过验证
				$data['create_time'] = time();
				$PicInfoModel = new PicInfo($data);
				$PicInfoModel->allowField(true)->save();
				$status = 1;
				$message = '添加成功';
			}
		}else {
			$message = '请先上传图片！';
		}
		
		return ['status'=>$status,'message'=>$message,'data'=>$data];
	}
	/**
	 * 删除图片
	 * @param Request $request
	 * @return number[]|string[]
	 */
	public function del(Request $request){
		$status = 0;
		$id = $request->param();
		$id = $id['id'];
		
		$picInfoModel = new PicInfo();
		$picinfo = $picInfoModel->get(['id'=>$id]);
		//根据picinfo表的pic_id获取pic表中的参数；
		$pics = Pic::getPicByid($picinfo['pic_id']);
		
		$picdel = picModel::get(['pic_id'=>$picinfo['pic_id']])->delete();
		$picinfodel = $picinfo->delete();
		
		if ($picdel == 1 && $picinfodel == 1){
			//删除文件
			foreach ($pics as $pic){
					
				if (file_exists(ROOT_PATH.'public'.DS.'uploads/'.$pic['create_time']. '/'. $pic['pic_name'])){
					unlink(ROOT_PATH.'public'.DS.'uploads/'.$pic['create_time']. '/'. $pic['pic_name']);
				}
					
				if (file_exists(ROOT_PATH.'public'.DS.'thumb100'.'/' . $pic['pic_name'])) {
					unlink(ROOT_PATH.'public'.DS.'thumb100'.'/' . $pic['pic_name']);
				}
					
				if (file_exists(ROOT_PATH.'public'.DS.'thumb300'.'/' . $pic['pic_name'])) {
					unlink(ROOT_PATH.'public'.DS.'thumb300'.'/' . $pic['pic_name']);
				}
					
				if (file_exists(ROOT_PATH.'public'.DS.'thumb600'.'/' . $pic['pic_name'])) {
					unlink(ROOT_PATH.'public'.DS.'thumb600'.'/' . $pic['pic_name']);
				}
				
				if (file_exists(ROOT_PATH.'public'.DS.'thumb1200'.'/' . $pic['pic_name'])) {
					unlink(ROOT_PATH.'public'.DS.'thumb1200'.'/' . $pic['pic_name']);
				}
			}
			$status = 1;
			$message = '删除成功';
		}else {
			$message = '内部服务器错误';
		}
		
		return ['status'=>$status,'message'=>$message];
	}
	/**
	 * 发布和下架图片
	 * @param Request $request
	 * @return number[]|string[]
	 */
	public function changeStatus(Request $request){
		$status = 0;
		$message = '';
		$data = $request->param();
		$PicInfoModel = new PicInfo();
		$pic = $PicInfoModel->save(['status'=>$data['status']],['id'=>$data['id']]);
		if ($pic == 1){
			$status =1;
			$message = '操作成功';
		}else {
			$message = '内部服务器错误，操作失败！';
		}
		return ['status'=>$status,'message'=>$message];
	}
}