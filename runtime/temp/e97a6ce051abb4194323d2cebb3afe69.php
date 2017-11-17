<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:83:"E:\project\workspace\thinkphp5\public/../application/admin\view\frontend\lw-re.html";i:1509087090;s:91:"E:\project\workspace\thinkphp5\public/../application/admin\view\frontend\public\header.html";i:1509948052;}*/ ?>
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
<body>
<header>
  <div class="log-header">
      <h1><a href="/">注册</a> </h1>
  </div>    
  <div class="log-re">
    <button id="log_btn" type="button" class="am-btn am-btn-default am-radius log-button">登 录</button>
  </div> 
</header>

<div class="log"> 
  <div class="am-g">
  <div class="am-u-lg-3 am-u-md-6 am-u-sm-8 am-u-sm-centered log-content">
    <h1 class="log-title am-animation-slide-top">用户注册</h1>
    <br>
    <form class="am-form" id="log-form">
      <div class="am-input-group am-radius am-animation-slide-left">       
        <input type="email" id="doc-vld-email-2-1" class="am-radius" data-validation-message="请输入正确邮箱地址" name="email" placeholder="邮箱" required/>
        <span class="am-input-group-label log-icon am-radius"><i class="am-icon-user am-icon-sm am-icon-fw"></i></span>
      </div>
      <br>
      <div class="am-input-group am-animation-slide-left log-animation-delay">       
        <input type="password" id="log-password" class="am-form-field am-radius log-input" placeholder="密码" name="password" minlength="11" required>
        <span class="am-input-group-label log-icon am-radius"><i class="am-icon-lock am-icon-sm am-icon-fw"></i></span>
      </div>
      <br>   
      <div class="am-input-group am-animation-slide-left log-animation-delay-a">       
        <input type="password" data-equal-to="#log-password" class="am-form-field am-radius log-input" placeholder="确认密码" name="repassword" data-validation-message="请确认密码一致" required>
        <span class="am-input-group-label log-icon am-radius"><i class="am-icon-lock am-icon-sm am-icon-fw"></i></span>
      </div>
      <br>
      <button id="reg_btn" type="button" class="am-btn am-btn-primary am-btn-block am-btn-lg am-radius am-animation-slide-bottom log-animation-delay-b">注 册</button>
      <br>
    </form>
  </div>
  </div>
  <footer class="log-footer">   
    © 2014 AllMobilize, Inc. Licensed under MIT license.
  </footer>
</div>



<!--[if (gte IE 9)|!(IE)]><!-->
<script src="__STATIC__/frontend/assets/js/jquery.min.js"></script>
<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->
<script src="__STATIC__/frontend/assets/js/amazeui.min.js"></script>
<script src="__STATIC__/frontend/assets/js/app.js"></script>
<script>
$(function(){
	$("#log_btn").on('click',function(){
		window.location.href="<?php echo url('FrontendLog/log'); ?>";
	});
	
	$("#reg_btn").on('click',function(){
		$.ajax({
			url:'<?php echo url("FrontendLog/regs"); ?>',
			method:'POST',
			data:$("#log-form").serialize(),
			success:function(data){
				if(data.status == 1){
					alert(data.message);
					window.location.href="<?php echo url('FrontendLog/log'); ?>";
				}
			}
		});
	});
});

</script>
</body>
</html>