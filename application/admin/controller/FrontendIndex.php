<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use app\admin\model\Article;
use app\admin\model\PicInfo;
use app\admin\model\Picture;
use think\Session;
use app\admin\model\Vip;
use think\Request;
use think\Db;
use app\admin\model\Review;
use phpDocumentor\Reflection\Location;

class FrontendIndex extends Base{
	/**
	 * 博客主页显示
	 * @return string
	 */
	public function main(){
		//获取banner图片
		$PicInfoModel = new PicInfo();
		$pic = $PicInfoModel->get(['status'=>PicInfo::STATUS_ACTIVED]);
		$PicModel = new Picture();
		$picurl = $PicModel->all(['pic_id'=>$pic['pic_id']]);
		
		//获取文章博客
		$ArtModel = new Article();
		$Articles = $ArtModel->order('rand()')->limit(3)->select();
		//获取图片路径 并且存到Article 数组中
		for ($i=0;$i<count($Articles);$i++){
			preg_match('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i',$Articles[$i]['article'],$match);
			$Articles[$i]['pic_url'] = $match[1];
		}
		
		//获取用户信息
		@$id = Session::get('blogid');
		@$user = Vip::get(['id'=>$id]);
		$this->view->assign('articles',$Articles)->assign('pics',$picurl)->assign('user',@$user);
		return $this->view->fetch('frontend/lw-index');
	}
	/**
	 * 文章详情
	 * @return string
	 */
	public function articleDiteils(){
		$id = input('id');
		//获取文章博客
		$ArtModel = new Article();
		$article = $ArtModel->get(['id'=>$id]);
		$ArtModel->save([
				'glance'=> $article['glance']+1
		],['id'=>$id]);
		
		//获取留言信息
		$ReviewModel = new Review();
		$reviews = $ReviewModel->all(['aid'=>$id]);
		for ($i=0;$i<count($reviews);$i++){
			
			$Vip = Vip::get(['id'=>$reviews[$i]['uid']]);
			$reviews[$i]['vip'] = $Vip['vip'];
			$reviews[$i]['sex'] = $Vip['sex'];
			$reviews[$i]['beizhu'] = $Vip['beizhu'];
			$reviews[$i]['username'] = $Vip['username'];
			$reviews[$i]['user_icon'] = $Vip['user_icon'];
		}
		
		//获取用户信息
		@$uid = Session::get('blogid');
		@$user = Vip::get(['id'=>$uid]);
		$this->view->assign('article',$article)->assign('user',@$user)->assign('reviews',@$reviews);
		//获取用户信息
		@$uid = Session::get('blogid');
		@$user = Vip::get(['id'=>$uid]);
		$this->view->assign('article',$article)->assign('user',@$user);
		return $this->view->fetch('frontend/lw-article');
	}
	/**
	 * 文章列表
	 * @return string
	 */
	public function artlist(){
		$ArtModel = new Article();
		$arts = $ArtModel->all();
		//获取用户信息
		@$uid = Session::get('blogid');
		@$user = Vip::get(['id'=>$uid]);
		$this->view->assign('user',@$user)->assign('arts',$arts);
		return $this->view->fetch('frontend/lw-list');
	}
	/**
	 * 发表文章页面
	 */
	public function addArts(){
		$this->blogisLogin();
		$user_id = session('user_id');
		if (!isset($user_id) || empty($user_id)){
			//未登陆
			$this->error('请先登陆！','FrontendLog/log');
		}
		
		//获取用户信息
		@$uid = Session::get('blogid');
		@$user = Vip::get(['id'=>$uid]);
		$this->view->assign('user',@$user);
		
		return $this->view->fetch('frontend/lw-add');
	}
	/***
	 * 文章搜索
	 * @param Request $request
	 * @return string
	 */
	public function search(Request $request){
		$keyword = $request->param();
		$keyword = $keyword['keyword'];
		$artlist = Db::table('article')->where('titel','like','%'.$keyword.'%')->select();
		//获取用户信息
		@$uid = Session::get('blogid');
		@$user = Vip::get(['id'=>$uid]);
		$this->view->assign('user',@$user)->assign('arts',$artlist);
		return $this->view->fetch('frontend/lw-list');
	}
	
	/**
	 * 留言功能
	 * @param Request $requst  前台传过来的数据
	 * @return number[]|string[]
	 */
	public function review(Request $requst){
		$status = 0;
		$message = '';
		$data = $requst->param();
		
		if (!isset($data['uid']) || empty($data['uid'])){
			$message = "请先登录！";
		}else {
			$data['create_time'] = time();
			$ReviewModel = new Review($data);
			$ReviewModel->allowField(true)->save();
			if (isset($ReviewModel['id']) && !empty($ReviewModel['id'])){
				$message = "留言成功";
				$status = 1;
			}else {
				$message = "内部服务器错误";
			}
		}
		
		alertMes($message, $_SERVER['HTTP_REFERER']);
	}
	
	
	
}