<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:84:"E:\project\workspace\thinkphp5\public/../application/admin\view\vip\member-show.html";i:1508913765;s:82:"E:\project\workspace\thinkphp5\public/../application/admin\view\public\footer.html";i:1504578213;}*/ ?>
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
<link href="__STATIC__/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script><![endif]-->
<title>用户查看</title>
</head>
<body>
<div class="cl pd-20" style=" background-color:#5bacb6">
  <img class="avatar size-XL l" src="__STATIC__/static/h-ui/images/user.jpg">
  <dl style="margin-left:80px; color:#fff">
    <dt><span class="f-18"><?php echo $data['username']; ?></span> <span class="pl-10 f-12">余额：40</span></dt>
    <dd class="pt-10 f-12" style="margin-left:0">这家伙很懒，什么也没有留下</dd>
  </dl>
</div>
<div class="pd-20">
  <table class="table">
    <tbody>
      <tr>
        <th class="text-r" width="80">性别：</th>
        <td><?php echo $data['sex']; ?></td>
      </tr>
      <tr>
        <th class="text-r">手机：</th>
        <td><?php echo $data['phone']; ?></td>
      </tr>
      <tr>
        <th class="text-r">邮箱：</th>
        <td><?php echo $data['email']; ?></td>
      </tr>
      <tr>
        <th class="text-r">地址：</th>
        <td><?php if($data['address'] == '' || $data['address'] == null): ?>暂无相关记录<?php else: ?><?php echo $data['address']; endif; ?></td>
      </tr>
      <tr>
        <th class="text-r">注册时间：</th>
        <td><?php echo $data['create_time']; ?></td>
      </tr>
     
      <tr>
      	<th class="text-r">会员状态：</th>
      	<td id="vipstatus"> <?php if($data['vip'] == '未激活'): ?><a class = 'active-vip' href="#">点击激活</a><?php else: ?><?php echo $data['vip']; endif; ?></td>
      </tr>
      <?php if($data['vip'] == '已激活'): ?>
      <tr>
      	<th class="text-r">到期时间：</th>
      	<td class="endtime"><?php echo date("Y-m-d",$data['vipend']); ?>  <a class = "add-vip" href="#">续费</a></td>
      </tr>
      <?php endif; ?>
      <tr>
        <th class="text-r">积分：</th>
        <td>330</td>
      </tr>
    </tbody>
  </table>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="__STATIC__/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="__STATIC__/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="__STATIC__/static/h-ui.admin/js/H-ui.admin.page.js"></script> 
<!--/_footer /作为公共模版分离出去-->
<script>
	$(function(){
		//激活会员
		$(".active-vip").on('click',function(){
			layer.confirm('激活会员需支付每月 10 元的费用，您确定要激活吗？',function(){
				$.post("<?php echo url('Vip/active',['id'=>$data['id']]); ?>",function(data){
					if(data.status == 1){
						$("#vipstatus").html('已激活');
						$("#vipstatus").parent().after(data.result);
						layer.msg('已激活!',{icon: 6,time:1000});
						setTimeout(function(){
							location.reload() ;
						},1000);
					}
				});
			});
		});
		
		//续费会员
		$(".add-vip").on('click',function(){
			layer.confirm('续费会员需支付10 元的费用，您确定要续费吗？',function(){
				$.post("<?php echo url('Vip/renew',['id'=>$data['id']]); ?>",function(data){
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