<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:86:"E:\project\workspace\thinkphp5\public/../application/admin\view\frontend\lw-index.html";i:1509949524;s:91:"E:\project\workspace\thinkphp5\public/../application/admin\view\frontend\public\header.html";i:1509948052;s:88:"E:\project\workspace\thinkphp5\public/../application/admin\view\frontend\public\nav.html";i:1510887650;s:91:"E:\project\workspace\thinkphp5\public/../application/admin\view\frontend\public\footer.html";i:1509949987;}*/ ?>
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

<body id="blog">

<header class="am-g am-g-fixed blog-fixed blog-text-center blog-header">
    <div class="am-u-sm-8 am-u-sm-centered">
        <img width="200" src="http://s.amazeui.org/media/i/brand/amazeui-b.png" alt="Amaze UI Logo"/>
        <h2 class="am-hide-sm-only">个人博客</h2>
    </div>
</header>
<hr>
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
<!-- banner start -->
<div class="am-g am-g-fixed blog-fixed am-u-sm-centered blog-article-margin">
    <div data-am-widget="slider" class="am-slider am-slider-b1" data-am-slider='{&quot;controlNav&quot;:false}' >
    <ul class="am-slides">
     <?php if(is_array($pics) || $pics instanceof \think\Collection || $pics instanceof \think\Paginator): $i = 0; $__LIST__ = $pics;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
      <li>
            <img src="__ROOT__/uploads/<?php echo $vo['create_time']; ?>/<?php echo $vo['pic_name']; ?>">
            <div class="am-slider-desc blog-slider-desc">
                <div class="blog-text-center blog-slider-con">
                    <span><a href="" class="blog-color">Article &nbsp;</a></span>               
                    <h1 class="blog-h-margin"><a href="">总在思考一句积极的话</a></h1>
                    <p>那时候刚好下着雨，柏油路面湿冷冷的，还闪烁着青、黄、红颜色的灯火。
                    </p>
                    <span>2015/10/9</span>                
                </div>
            </div>
      </li>
      <?php endforeach; endif; else: echo "" ;endif; ?>
     
    </ul>
    </div>
</div>
<!-- banner end -->

<!-- content srart -->
<div class="am-g am-g-fixed blog-fixed">
    <div class="am-u-md-8 am-u-sm-12">
	<?php if(is_array($articles) || $articles instanceof \think\Collection || $articles instanceof \think\Paginator): $i = 0; $__LIST__ = $articles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <article class="am-g blog-entry-article">
            <div class="am-u-lg-6 am-u-md-12 am-u-sm-12 blog-entry-img">
                <img src="<?php echo $vo['pic_url']; ?>" alt="" class="am-u-sm-12">
            </div>
            <div class="am-u-lg-6 am-u-md-12 am-u-sm-12 blog-entry-text">
                <span><a href="" class="blog-color">article &nbsp;</a></span>
                <span> @<?php echo $vo['author']; ?> &nbsp;</span>
                <span><?php echo $vo['create_time']; ?></span>
                <h1><a href="<?php echo url('FrontendIndex/articleDiteils',['id'=>$vo['id']]); ?>"><?php echo $vo['titel']; ?></a></h1>
                <p><?php echo $vo['about']; ?>
                </p>
                <h8 style="text-align:right">浏览次数：<?php echo $vo['glance']; ?></h8>
                <p><a href="" class="blog-continue">continue reading</a></p>
            </div>
        </article>

	<?php endforeach; endif; else: echo "" ;endif; ?>
        
<ul class="am-pagination">
  <li class="am-pagination-prev"><a href="">&laquo; Prev</a></li>
  <li class="am-pagination-next"><a href="">Next &raquo;</a></li>
</ul>
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
<script type="text/javascript" src="__STATIC__/lib/layer/2.4/layer.js"></script>
<script>
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
	});
</script>
</body>
</html>