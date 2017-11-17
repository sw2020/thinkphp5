<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:84:"E:\project\workspace\thinkphp5\public/../application/admin\view\frontend\lw-add.html";i:1510826814;s:91:"E:\project\workspace\thinkphp5\public/../application/admin\view\frontend\public\header.html";i:1509948052;s:88:"E:\project\workspace\thinkphp5\public/../application/admin\view\frontend\public\nav.html";i:1510887650;s:91:"E:\project\workspace\thinkphp5\public/../application/admin\view\frontend\public\footer.html";i:1509949987;}*/ ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>BLOG index with sidebar & slider  | Amaze UI Examples</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  <link rel="icon" type="image/png" href="__STATIC__/frontend/assets/i/favicon.png">
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="icon" sizes="192x192" href="__STATIC__/frontend/assets/i/app-icon72x72@2x.png">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
  <link rel="apple-touch-icon-precomposed" href="__STATIC__/frontend/assets/i/app-icon72x72@2x.png">
  <meta name="msapplication-TileImage" content="__STATIC__/frontend/assets/i/app-icon72x72@2x.png">
  <meta name="msapplication-TileColor" content="#0e90d2">
  <link rel="stylesheet" type="text/css" href="__STATIC__/static/h-ui/css/H-ui.min.css" />
  <link rel="stylesheet" href="__STATIC__/frontend/assets/css/amazeui.min.css">
  <link rel="stylesheet" href="__STATIC__/frontend/assets/css/app.css">
</head>
<body id="blog-article-sidebar">
<!-- header start -->
<header class="am-g am-g-fixed blog-fixed blog-text-center blog-header">
    <div class="am-u-sm-8 am-u-sm-centered">
        <img width="200" src="http://s.amazeui.org/media/i/brand/amazeui-b.png" alt="Amaze UI Logo"/>
        <h2 class="am-hide-sm-only">中国首个开源 HTML5 跨屏前端框架</h2>
    </div>
</header>
<!-- header end -->
<hr>

<!-- nav start -->
<!-- nav start -->
<nav class="am-g am-g-fixed blog-fixed blog-nav">
<button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only blog-button" data-am-collapse="{target: '#blog-collapse'}" ><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="blog-collapse">
    <ul class="am-nav am-nav-pills am-topbar-nav">
      <li class="am-active"><a href="<?php echo url('FrontendIndex/main'); ?>">首页</a></li>
      <li><a href="<?php echo url('FrontendIndex/artlist'); ?>">文章列表</a></li>
      <li><a href="<?php echo url('FrontendPic/main'); ?>">图片库</a></li>
      <li><a href="<?php echo url('FrontendIndex/addArts'); ?>">发布文章</a></li>
    </ul>
    <form class="am-topbar-form am-topbar-right am-form-inline" role="search" method="GET" action="<?php echo url('FrontendIndex/search'); ?>" >
      <div class="am-form-group">
        <input type="text" class="am-form-field am-input-sm" value="" name="keyword" placeholder="文章搜索">
        <input type="submit" style="background-color:#fff;border:1px solid #ccc;display:inline-block;padding:6px;margin-left:-5px" value="搜索一下">
      </div>
    </form>
  </div>
</nav>
<hr>
<!-- nav end -->
<!-- nav end -->
<hr>
<!-- content srart -->
<div class="am-g am-g-fixed blog-fixed blog-content">
    <div class="am-u-md-8 am-u-sm-12">
      
      	<article class="page-container">
			<form class="form form-horizontal" id="form-article-add">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>文章标题：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="" placeholder="" id="" name="titel">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">简略标题：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="" placeholder="" id="" name="small_title">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>文章类型：</label>
					<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
						<select name="articletype" class="select">
							<option value="0">全部类型</option>
							<option value="1">帮助说明</option>
							<option value="2">新闻资讯</option>
						</select>
						</span> </div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">排序值：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="0" placeholder="" id="" name="order">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">关键词：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="" placeholder="" id="" name="keywords">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">文章摘要：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<textarea name="about" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true"></textarea>
						<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">文章作者：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="0" placeholder="" id="" name="author">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-2">文章内容：</label>
					<div class="formControls col-xs-8 col-sm-9"> 
						<script id="editor" type="text/plain" style="width:100%;height:400px;"></script> 
					</div>
				</div>
				<div class="row cl">
					<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
						<button onClick="article_save_submit();" class="btn btn-primary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核</button>
						<button onClick="article_save();" class="btn btn-secondary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存草稿</button>
						<button onClick="removeIframe();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
					</div>
				</div>
			</form>
		</article>
      
        <br/>
        <div class="am-g blog-article-widget blog-article-margin">
          <div class="am-u-lg-4 am-u-md-5 am-u-sm-7 am-u-sm-centered blog-text-center">
            <span class="am-icon-tags"> &nbsp;</span><a href="#">标签</a> , <a href="#">TAG</a> , <a href="#">啦啦</a>
            <hr>
            <a href=""><span class="am-icon-qq am-icon-fw am-primary blog-icon"></span></a>
            <a href=""><span class="am-icon-wechat am-icon-fw blog-icon"></span></a>
            <a href=""><span class="am-icon-weibo am-icon-fw blog-icon"></span></a>
          </div>
        </div>

        <hr>
        <div class="am-g blog-author blog-article-margin">
          <div class="am-u-sm-3 am-u-md-3 am-u-lg-2">
            <img src="__STATIC__/frontend/assets/i/f15.jpg" alt="" class="blog-author-img am-circle">
          </div>
        </div>
        <hr>
        <ul class="am-pagination blog-article-margin">
          <li class="am-pagination-prev"><a href="#" class="">&laquo; 一切的回顾</a></li>
          <li class="am-pagination-next"><a href="">不远的未来 &raquo;</a></li>
        </ul>
        
        <hr>

        <form class="am-form am-g">
            <h3 class="blog-comment">评论</h3>
          <fieldset>
            <!--  <div class="am-form-group am-u-sm-4 blog-clear-left">
              <input type="text" class="" placeholder="名字">
            </div>
            <div class="am-form-group am-u-sm-4">
              <input type="email" class="" placeholder="邮箱">
            </div>

            <div class="am-form-group am-u-sm-4 blog-clear-right">
              <input type="password" class="" placeholder="网站">
            </div>-->
        
            <div class="am-form-group">
              <textarea class="" rows="5" placeholder="请输入留言内容.."></textarea>
            </div>
        
            <p><button type="submit" class="am-btn am-btn-default">发表评论</button></p>
          </fieldset>
        </form>

        <hr>
    </div>

    <div class="am-u-md-4 am-u-sm-12 blog-sidebar">
        <div class="blog-sidebar-widget blog-bor">
            <h2 class="blog-text-center blog-title"><span>个人中心</span></h2>
            <?php if(\think\Session::get('blogid') == null || \think\Session::get('blogid') == ''): ?>尚未登录，<a href="<?php echo url('FrontendLog/log'); ?>" style="color:red">点此登录</a><br/><br/><br/><?php else: ?>
            <img src="__STATIC__/frontend/assets/i/f14.jpg" alt="about me" class="blog-entry-img" >
            <p>会员状态：<?php if($user['vip'] == '未激活'): ?><a id="vipstatus" class = 'active-vip' style="color:red" href="#">点击激活</a><?php else: ?><?php echo $user['vip']; endif; ?></p>
            <p><?php if($user['vip'] == '已激活'): ?>到期时间：<?php echo date("Y-m-d",$user['vipend']); ?>  <a style="color:red" class = "add-vip" href="#">续费</a></tr>
      <?php endif; ?></p>
            <p>用户名：<?php if($user['username'] == null || $user['username'] == ''): ?>博客用户<?php echo $user['id']; else: ?><?php echo $user['username']; endif; ?></p>
            <p>邮箱：<?php echo session('blogemail'); ?></p>
            <p><?php if($user['beizhu'] == null || $user['beizhu'] == ''): ?>这个家伙很懒，什么也没留下！<?php else: ?><?php echo $user['beizhu']; endif; ?></p><?php endif; ?>
        </div>
        <div class="blog-sidebar-widget blog-bor">
            <h2 class="blog-text-center blog-title"><span>关注我</span></h2>
            <p>
                <a href=""><span class="am-icon-qq am-icon-fw am-primary blog-icon"></span></a>
                <a href=""><span class="am-icon-github am-icon-fw blog-icon"></span></a>
                <a href=""><span class="am-icon-weibo am-icon-fw blog-icon"></span></a>
                <a href=""><span class="am-icon-reddit am-icon-fw blog-icon"></span></a>
                <a href=""><span class="am-icon-weixin am-icon-fw blog-icon"></span></a>
            </p>
        </div>
        <div class="blog-clear-margin blog-sidebar-widget blog-bor am-g ">
            <h2 class="blog-title"><span>标签</span></h2>
            <div class="am-u-sm-12 blog-clear-padding">
            <a href="" class="blog-tag">amaze</a>
            <a href="" class="blog-tag">妹纸 UI</a>
            <a href="" class="blog-tag">HTML5</a>
            <a href="" class="blog-tag">这是标签</a>
            <a href="" class="blog-tag">Impossible</a>
            <a href="" class="blog-tag">开源前端框架</a>
            </div>
        </div>
    </div>
</div>
<!-- content end -->


 <footer class="blog-footer">
    <div class="am-g am-g-fixed blog-fixed am-u-sm-centered blog-footer-padding">
        <div class="am-u-sm-12 am-u-md-4- am-u-lg-4">
            <h3>模板简介</h3>
            <p class="am-text-sm">这是一个使用amazeUI做的简单的前端模板。<br> 博客/ 资讯类 前端模板 <br> 支持响应式，多种布局，包括主页、文章页、媒体页、分类页等<br>嗯嗯嗯，不知道说啥了。外面的世界真精彩<br><br>
            Amaze UI 使用 MIT 许可证发布，用户可以自由使用、复制、修改、合并、出版发行、散布、再授权及贩售 Amaze UI 及其副本。</p>
        </div>
        <div class="am-u-sm-12 am-u-md-4- am-u-lg-4">
            <h3>社交账号</h3>
            <p>
                <a href=""><span class="am-icon-qq am-icon-fw am-primary blog-icon blog-icon"></span></a>
                <a href=""><span class="am-icon-github am-icon-fw blog-icon blog-icon"></span></a>
                <a href=""><span class="am-icon-weibo am-icon-fw blog-icon blog-icon"></span></a>
                <a href=""><span class="am-icon-reddit am-icon-fw blog-icon blog-icon"></span></a>
                <a href=""><span class="am-icon-weixin am-icon-fw blog-icon blog-icon"></span></a>
            </p>
            <h3>Credits</h3>
            <p>我们追求卓越，然时间、经验、能力有限。Amaze UI 有很多不足的地方，希望大家包容、不吝赐教，给我们提意见、建议。感谢你们！</p>          
        </div>
        <div class="am-u-sm-12 am-u-md-4- am-u-lg-4">
              <h1>我们站在巨人的肩膀上</h1>
             <h3>Heroes</h3>
            <p>
                <ul>
                    <li>jQuery</li>
                    <li>Zepto.js</li>
                    <li>Seajs</li>
                    <li>LESS</li>
                    <li>...</li>
                </ul>
            </p>
        </div>
    </div>    
    <div class="blog-text-center">© 2015 AllMobilize, Inc. Licensed under MIT license. Made with love By LWXYFER</div>    
  </footer>

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="__STATIC__/frontend/assets/js/jquery.min.js"></script>
<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->
<script src="__STATIC__/frontend/assets/js/amazeui.min.js"></script>
<!-- <script src="assets/js/app.js"></script> -->
<script type="text/javascript" src="__STATIC__/lib/jquery/1.9.1/jquery.min.js"></script> 

<script type="text/javascript" src="__STATIC__/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="__STATIC__/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="__STATIC__/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="__STATIC__/lib/jquery.validation/1.14.0/messages_zh.js"></script>   
<script type="text/javascript" src="__STATIC__/lib/webuploader/0.1.5/webuploader.min.js"></script> 
<script type="text/javascript" src="__STATIC__/lib/ueditor/1.4.3/ueditor.config.js"></script> 
<script type="text/javascript" src="__STATIC__/lib/ueditor/1.4.3/ueditor.all.min.js"> </script> 
<script type="text/javascript" src="__STATIC__/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
$(function(){
	
	//激活会员
	$(".active-vip").on('click',function(){
		layer.confirm('激活会员需支付每月 10 元的费用，您确定要激活吗？',function(){
			$.post("<?php echo url('Vip/active',['id'=>$user['id']]); ?>",function(data){
				if(data.status == 1){
					$("#vipstatus").html('已激活');
					$("#vipstatus").parent().after(data.result);
					layer.msg('已激活!',{icon: 6,time:1000});
					
				}
			});
		});
	});
	
	//续费会员
	$(".add-vip").on('click',function(){
		layer.confirm('续费会员需支付10 元的费用，您确定要续费吗？',function(){
			$.post("<?php echo url('Vip/renew',['id'=>$user['id']]); ?>",function(data){
				if(data.status == 1){
					$(".endtime").html(data.html);
					layer.msg('续费成功!',{icon: 6,time:1000});
					setTimeout(function(){
						history.go(0);
					},1000);
				}
			});
		});
	});
	
	
	$list = $("#fileList"),
	$btn = $("#btn-star"),
	state = "pending",
	uploader;

	var uploader = WebUploader.create({
		auto: true,
		swf: 'lib/webuploader/0.1.5/Uploader.swf',
	
		// 文件接收服务端。
		server: '<?php echo url("Picture/upload"); ?>',
		// 选择文件的按钮。可选。
		// 内部根据当前运行是创建，可能是input元素，也可能是flash.
		pick: '#filePicker',
	
		// 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
		resize: false,
		// 只允许选择图片文件。
		accept: {
			title: 'Images',
			extensions: 'gif,jpg,jpeg,bmp,png',
			mimeTypes: 'image/*'
		}
	});
	uploader.on( 'fileQueued', function( file ) {
		var $li = $(
			'<div id="' + file.id + '" class="item">' +
				'<div class="pic-box"><img></div>'+
				'<div class="info">' + file.name + '</div>' +
				'<p class="state">等待上传...</p>'+
			'</div>'
		),
		$img = $li.find('img');
		$list.append( $li );
	
		// 创建缩略图
		// 如果为非图片文件，可以不用调用此方法。
		// thumbnailWidth x thumbnailHeight 为 100 x 100
		uploader.makeThumb( file, function( error, src ) {
			if ( error ) {
				$img.replaceWith('<span>不能预览</span>');
				return;
			}
			
			$img.attr( 'src', src );
		}, thumbnailWidth, thumbnailHeight );
	});
	// 文件上传过程中创建进度条实时显示。
	uploader.on( 'uploadProgress', function( file, percentage ) {
		var $li = $( '#'+file.id ),
			$percent = $li.find('.progress-box .sr-only');
	
		// 避免重复创建
		if ( !$percent.length ) {
			$percent = $('<div class="progress-box"><span class="progress-bar radius"><span class="sr-only" style="width:0%"></span></span></div>').appendTo( $li ).find('.sr-only');
		}
		$li.find(".state").text("上传中");
		$percent.css( 'width', percentage * 100 + '%' );
	});
	
	// 文件上传成功，给item添加成功class, 用样式标记上传成功。
	uploader.on( 'uploadSuccess', function( file ) {
		$( '#'+file.id ).addClass('upload-state-success').find(".state").text("已上传");
	});
	
	// 文件上传失败，显示上传出错。
	uploader.on( 'uploadError', function( file ) {
		$( '#'+file.id ).addClass('upload-state-error').find(".state").text("上传出错");
	});
	
	// 完成上传完了，成功或者失败，先删除进度条。
	uploader.on( 'uploadComplete', function( file ) {
		$( '#'+file.id ).find('.progress-box').fadeOut();
	});
	uploader.on('all', function (type) {
        if (type === 'startUpload') {
            state = 'uploading';
        } else if (type === 'stopUpload') {
            state = 'paused';
        } else if (type === 'uploadFinished') {
            state = 'done';
        }

        if (state === 'uploading') {
            $btn.text('暂停上传');
        } else {
            $btn.text('开始上传');
        }
    });

    $btn.on('click', function () {
        if (state === 'uploading') {
            uploader.stop();
        } else {
            uploader.upload();
        }
    });
	
	var ue = UE.getEditor('editor');
	
});
	function article_save_submit(){
		$.ajax({
			url: '<?php echo url("Article/add"); ?>',
			type:'POST',
			data:$('#form-article-add').serialize(),
			success:function(data){
				if(data.status == 1 ){
					layer.msg(data.message,{icon:1,time:2000});
					setTimeout(function(){
						 //刷新页面
				        parent.window.location.href='<?php echo url('FrontendIndex/artlist'); ?>';
				        //获取窗口索引
				        var index = parent.layer.getFrameIndex(window.name);
				        //关闭弹出层
				        parent.layer.close(index);
					},3000);
				}else{
					layer.msg(data.message,{icon:2,time:2000});
				}
			}
		});
	}
</script>
</body>
</html>