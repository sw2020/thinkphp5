<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use app\admin\model\UserTab;
use app\admin\model\AdminRole;
/**
 * 菜单
 */
function getmenu(){
	//获取当前登陆的用户的id
	$user_id = session('user_id');
	$user = UserTab::get(['id'=>$user_id]);
	
	//获取该用户权限
	$permission = AdminRole::get(['id'=>$user['role']]);
	$permissionArr = explode(',',$permission['permissionid']);
	$permissionInfo = [];
	for ($i=0;$i<count($permissionArr);$i++){
		$permissionArr[$i] = explode('-',$permissionArr[$i]);
		array_push($permissionInfo,$permissionArr[$i][0]);
	}
	$permissionInfo = array_merge(array_unique($permissionInfo));
// 	return $permissionInfo;//返回权限的序列id
	for ($j=0;$j<count($permissionInfo);$j++){
		switch ($permissionInfo[$j])
		{
			case 1:
				echo '<dl id="menu-article">
						<dt><i class="Hui-iconfont">&#xe616;</i> 资讯管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
							<dd>
								<ul>
									<li><a href="'.url('Article/main').'" title="资讯管理">资讯管理</a></li>
						</ul>
					</dd>
				</dl>';
				break;
			case 2:
				echo '<dl id="menu-picture">
								<dt><i class="Hui-iconfont">&#xe613;</i> 图片管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
								<dd>
									<ul>
										<li><a href="'.url('Picture/main').'" title="图片管理">图片管理</a></li>
							</ul>
						</dd>
					</dl>';
				break;
			case 3:
				echo '<dl id="menu-product">
								<dt><i class="Hui-iconfont">&#xe620;</i> 产品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
								<dd>
									<ul>
										<li><a href="'.url('Product/productBrand').'" title="品牌管理">品牌管理</a></li>
										<li><a href="'.url('Product/productType').'" title="分类管理">分类管理</a></li>
										<li><a href="'.url('Product/pro').'" title="产品管理">产品管理</a></li>
							</ul>
						</dd>
					</dl>';
				break;
			case 4:
				echo '<dl id="menu-comments">
							<dt><i class="Hui-iconfont">&#xe622;</i> 评论管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
							<dd>
								<ul>
									<li><a href="'.url('Review/listReview').'" title="评论列表">评论列表</a></li>
									<li><a href="'.url('Review/rollBack').'" title="意见反馈">意见反馈</a></li>
						</ul>
					</dd>
				</dl>';
				break;
			case 5:
				echo '<dl id="menu-member">
							<dt><i class="Hui-iconfont">&#xe60d;</i> 会员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
							<dd>
								<ul>
									<li><a href="'.url('Vip/listVip').'" title="会员列表">会员列表</a></li>
								<!--	<li><a href="member-del.html" title="删除的会员">删除的会员</a></li>
									<li><a href="member-level.html" title="等级管理">等级管理</a></li>
									<li><a href="member-scoreoperation.html" title="积分管理">积分管理</a></li>
									<li><a href="member-record-browse.html" title="浏览记录">浏览记录</a></li>
									<li><a href="member-record-download.html" title="下载记录">下载记录</a></li>
									<li><a href="member-record-share.html" title="分享记录">分享记录</a></li>   -->
						</ul>
					</dd>
				</dl>';
				break;
			case 6:
				echo '<dl id="menu-admin">
						<dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
						<dd>
							<ul>
								<li><a href="'.url('AdminRole/roleList').'" title="角色管理">角色管理</a></li>
								<li><a href="'.url('AdminPermission/permissionList').' "title="权限管理">权限管理</a></li>
								<li><a href="'.url('User/adminList').' "title="管理员列表">管理员列表</a></li>
					</ul>
				</dd>
			</dl>';
				break;
			case 7:
				echo '<dl id="menu-tongji">
						<dt><i class="Hui-iconfont">&#xe61a;</i> 系统统计<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
						<dd>
							<ul>
								<li><a href="'.url('System/chart',['c'=>1]).'" title="折线图">折线图</a></li>
								<li><a href="'.url('System/chart',['c'=>2]).'" title="时间轴折线图">时间轴折线图</a></li>
								<li><a href="'.url('System/chart',['c'=>3]).'" title="区域图">区域图</a></li>
								<li><a href="'.url('System/chart',['c'=>4]).'" title="柱状图">柱状图</a></li>
								<li><a href="'.url('System/chart',['c'=>5]).'" title="饼状图">饼状图</a></li>
								<li><a href="'.url('System/chart',['c'=>6]).'" title="3D柱状图">3D柱状图</a></li>
								<li><a href="'.url('System/chart',['c'=>7]).'" title="3D饼状图">3D饼状图</a></li>   
					</ul>
				</dd>
			</dl>';
				break;
<<<<<<< HEAD
// 			case 8:
// 				echo '<dl id="menu-system">
// 						<dt><i class="Hui-iconfont">&#xe62e;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
// 						<dd>
// 							<ul>
// 								<li><a href="system-base.html" title="系统设置">系统设置</a></li>
// 						<!--		<li><a href="system-category.html" title="栏目管理">栏目管理</a></li>
// 								<li><a href="system-data.html" title="数据字典">数据字典</a></li>
// 								<li><a href="system-shielding.html" title="屏蔽词">屏蔽词</a></li>
// 								<li><a href="system-log.html" title="系统日志">系统日志</a></li>		-->
// 					</ul>
// 				</dd>
// 			</dl>';
// 				break;
			case 14:
				echo '<dl id="menu-article">
					<dt><i class="Hui-iconfont">&#xe616;</i> 文件管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
						<dd>
							<ul>
								<li><a href="'.url('FileManage/main').'" title="文件管理">文件管理</a></li>
=======
			case 8:
				echo '<dl id="menu-system">
						<dt><i class="Hui-iconfont">&#xe62e;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
						<dd>
							<ul>
								<li><a href="system-base.html" title="系统设置">系统设置</a></li>
						<!--		<li><a href="system-category.html" title="栏目管理">栏目管理</a></li>
								<li><a href="system-data.html" title="数据字典">数据字典</a></li>
								<li><a href="system-shielding.html" title="屏蔽词">屏蔽词</a></li>
								<li><a href="system-log.html" title="系统日志">系统日志</a></li>		-->
>>>>>>> 0e03570ddf72ea9a237a1e0574242415e71446c4
					</ul>
				</dd>
			</dl>';
				break;
		}
	}
}


<<<<<<< HEAD
/**
 * 将字节单位自动转化成 KB ,MB GB TB
 * @param 文件的字节大小 $bytesize
 * @return 文件大小
 */
function sizeformat($bytesize){
	$i=0;
	//当$bytesize 大于是1024字节时，开始循环，当循环到第4次时跳出；
	while(abs($bytesize)>=1024){
		$bytesize=$bytesize/1024;
		$i++;
		if($i==4)break;
	}
	//将Bytes,KB,MB,GB,TB定义成一维数组；
	$units= array("B","KB","MB","GB","TB");
	$newsize=round($bytesize,2);
	return("$newsize $units[$i]");
}

=======
>>>>>>> 0e03570ddf72ea9a237a1e0574242415e71446c4
?>