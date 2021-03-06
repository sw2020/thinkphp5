<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:89:"E:\project\workspace\thinkphp5\public/../application/admin\view\Article\article-show.html";i:1508295407;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link href="__STATIC__/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="__STATIC__/static/h-ui.admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="__STATIC__/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="__STATIC__/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="__STATIC__/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script><![endif]-->

<link href="__STATIC__/lib/lightbox2/2.8.1/css/lightbox.css" rel="stylesheet" type="text/css" >
<title>文章展示</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
	<span class="c-gray en">&gt;</span>
	咨询管理
	<span class="c-gray en">&gt;</span>
	文章展示
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="pd-20">
	<div class="portfolio-content">
	<h1><?php echo $article['titel']; ?></h1>
	<h7>作者：<?php echo $article['author']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   发布时间：<?php echo $article['create_time']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 浏览次数：<?php echo $article['glance']; ?></h7><br/><br/>
	<?php echo $article['article']; ?>
	</div>
</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="__STATIC__/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="__STATIC__/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="__STATIC__/static/h-ui.admin/js/H-ui.admin.page.js"></script>
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="__STATIC__/lib/lightbox2/2.8.1/js/lightbox.min.js"></script>
<script type="text/javascript">
$(function(){
});
</script>
</body>
</html>