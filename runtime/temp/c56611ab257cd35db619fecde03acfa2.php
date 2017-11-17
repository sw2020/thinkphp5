<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:94:"E:\project\workspace\thinkphp5\public/../application/admin\view\AdminRole\admin-role-edit.html";i:1507878169;s:80:"E:\project\workspace\thinkphp5\public/../application/admin\view\public\meta.html";i:1504605462;s:82:"E:\project\workspace\thinkphp5\public/../application/admin\view\public\footer.html";i:1504578213;}*/ ?>
﻿<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="__STATIC__/favicon.ico" >
<link rel="Shortcut Icon" href="__STATIC__/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="__STATIC__/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="__STATIC__/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="__STATIC__/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="__STATIC__/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="__STATIC__/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

<title><?php echo (isset($title) && ($title !== '')?$title:"页面标题"); ?></title>
<meta name="keywords" content="H-ui.admin v3.0,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.0，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="cl pd-20">
	<form action="" method="post" class="form form-horizontal" id="form-admin-role-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>角色名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" disabled class="input-text" value="<?php echo $user['rolename']; ?>" placeholder="<?php echo $user['rolename']; ?>" id="roleName" name="roleName" datatype="*4-16" nullmsg="用户账户不能为空">
				<input type="text" value="<?php echo $user['id']; ?>" id="pid"  name="id" style="display:none"  >
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">备注：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php echo $user['description']; ?>" placeholder="<?php echo $user['description']; ?>" id="descrip" name="description">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">网站角色：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<dl class="permission-list">
					<dt>
						<label>
							<input type="checkbox" value="<?php echo $vo['id']; ?>" name="permission" id="user-Character-0">
							<?php echo $vo['authority']; ?></label>
					</dt>
					<dd>
						<dl class="cl permission-list2">
							
							<dd style="margin-left:0">
								<label class="">
									<input type="checkbox" value="<?php echo $vo['id']; ?>-1" name="power" id="user-Character-0-1-0">
									添加</label>
								<label class="">
									<input type="checkbox" value="<?php echo $vo['id']; ?>-2" name="power" id="user-Character-0-1-1">
									修改</label>
								<label class="">
									<input type="checkbox" value="<?php echo $vo['id']; ?>-3" name="power" id="user-Character-0-1-2">
									删除</label>
								<label class="">
									<input type="checkbox" value="<?php echo $vo['id']; ?>-4" name="power" id="user-Character-0-1-3">
									查看</label>
								<label class="">
									<input type="checkbox" value="<?php echo $vo['id']; ?>-5" name="power" id="user-Character-0-1-4">
									审核</label>
							</dd>
						</dl>
					</dd>
				</dl>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input type="button" class="btn btn-success radius" value="确定" id="admin-role-save">
			</div>
		</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="__STATIC__/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="__STATIC__/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="__STATIC__/static/h-ui.admin/js/H-ui.admin.page.js"></script> 
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="__STATIC__/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="__STATIC__/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="__STATIC__/lib/jquery.validation/1.14.0/messages_zh.js"></script> 
<script type="text/javascript">
$(function(){
	
	$("#admin-role-save").on('click',function(){
		
		var power = [];
		$(".permission-list2 input[name='power']").each(function(){
			if($(this).prop("checked") == true){
				power.push($(this).val());
			}
		});
		var roleName = $("#roleName").val();
		var descrip = $("#descrip").val();
		$.ajax({
			type:"POST",
			url:"<?php echo url('AdminRole/editRole'); ?>",
			data:{'id':$("#pid").val(),'rolename' : roleName,'description' : descrip,'permissionid': power},
			dataType:"JSON",
			success:function(data){
				if(data.status == 1){
					layer.msg(data.message,{icon:1,time:2000});
					setTimeout(function(){
						 //刷新页面
				        parent.window.location.href='<?php echo url("AdminRole/roleList"); ?>';
				        //获取窗口索引
				        var index = parent.layer.getFrameIndex(window.name);
				        //关闭弹出层
				        parent.layer.close(index);
					},2000);
					
				}else{
					layer.msg(data.message,{icon:2,time:2000});
				}
			}
		});
	});
	
	$(".permission-list dt input:checkbox").click(function(){
		$(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
	});
	$(".permission-list2 dd input:checkbox").click(function(){
		var l =$(this).parent().parent().find("input:checked").length;
		var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
		if($(this).prop("checked")){
			$(this).closest("dl").find("dt input:checkbox").prop("checked",true);
			$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
		}
		else{
			if(l==0){
				$(this).closest("dl").find("dt input:checkbox").prop("checked",false);
			}
			if(l2==0){
				$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
			}
		}
	});
	
	$("#form-admin-role-add").validate({
		rules:{
			roleName:{
				required:true,
			},
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit();
			var index = parent.layer.getFrameIndex(window.name);
			parent.layer.close(index);
		}
	});
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>