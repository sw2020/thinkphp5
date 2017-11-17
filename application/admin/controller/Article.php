<?php 
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Request;
use app\admin\model\Article as ArticleModel;
use think\Db;

class Article extends Base{
	
	protected function validateRules(){
		return array(
				array(
				'titel|文章标题' => 'require|unique:article',
				'article|文章内容'=> 'require|max:5000000|min:60',
				'author|作者名称'=> 'require'
				),
		);
	}
	
	public function main(){
		$articleModel = new ArticleModel();
		$articles = $articleModel->all();
		$this->view->assign('articles',$articles);
		return $this->view ->fetch('Article/article-list');
	}
	
	public function addArticle(){
		return $this->view->fetch('Article/article-add');
	}
	/**
	 * 添加新文章
	 * @param Request $request
	 * @return number[]|string[]|\think\true[]
	 */
	public function add(Request $request){
		$data = $request->param();
		$data['article'] = $data['editorValue'];
		$status = 0;
		$message = $this->validate($data, self::validateRules()[0]);
		
		if ($message == 1){
			//验证通过
			$data['create_time'] = time();
			$data['status'] = 0;
			$data['glance'] = 0;
			$articleModel = new ArticleModel($data);
			$articleModel->allowField(true)->save();
			if (isset($articleModel) && !empty($articleModel)){
				$message = '添加成功';
				$status = 1;
			}else {
				$message = '添加失败！';
			}
		}
		return ['status'=>$status,'message'=>$message];
	}
	/**
	 * 查看文文章详情
	 * @return string
	 */
	public function show(){
		$id = input('id');
		$articleModel = new ArticleModel();
		$article = $articleModel->get(['id'=>$id]);
		$articleModel->save([
				'glance'=> $article['glance']+1
		],['id'=>$id]);
		$this->view->assign('article',$article);
		return $this->view->fetch('Article/article-show');
	}
	/**
	 * 发布和下架文章
	 * @param Request $request
	 * @return number[]|string[]
	 */
	public function check(Request $request){
		$data = $request->param();
		$articleModel = new ArticleModel();
		$check = $articleModel->save([
				'status'=>$data['status']
		],['id'=>$data['id']]);
		if ($check == 1){
			$status = 1;
			$message = '操作成功！';
		}else {
			$status = 0;
			$message = '内部服务器错误！';
		}
		return ['status'=>$status,'message'=>$message];
	}
	/**
	 * 删除文章
	 * @param Request $request
	 * @return number[]|string[]
	 */
	public function del(Request $request){
		$data = $request->param();
		$del = ArticleModel::destroy(['id'=>$data['id']]);
		if ($del == 1){
			$status = 1;
			$message = '删除成功！';
		}else {
			$status = 0;
			$message = '内部服务器错误，删除失败！';
		}
		return ['status'=>$status,'message'=>$message];
	}
	/**
	 * 批量删除
	 * @param Request $request
	 * @return number[]|string[]
	 */
	public function delAll(Request $request){
		$data = $request->param();
		Db::startTrans();
		try {
			foreach ($data['id'] as $id){
				ArticleModel::destroy(['id'=>$id]);
			}
			Db::commit();
			$status = 1;
			$message = '删除成功！';
		}catch (\Exception $e){
			Db::rollback();
			$status = 0;
			$message = '内部服务器发生错误，删除失败！';
		}
		return ['status'=>$status,'message'=>$message];
	}
}
?>