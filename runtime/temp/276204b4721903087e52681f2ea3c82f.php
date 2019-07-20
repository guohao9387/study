<?php /*a:1:{s:59:"/home/wwwroot/study/application/admin/view/login/login.html";i:1562835044;}*/ ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo htmlentities($GLOBALS['title']); ?></title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/static/admin/css/font.css">
    <link rel="stylesheet" href="/static/admin/css/xadmin.css">
    <script src="/static/index/js/jquery-2.1.1.min.js" charset="utf-8"></script>
    <script src="/static/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/static/admin/js/xadmin.js"></script>

</head>
<body class="login-bg">
    
    <div class="login layui-anim layui-anim-up">
        <div class="message"><?php echo htmlentities($GLOBALS['title']); ?></div>
        <div id="darkbannerwrap"></div>
        
        <form method="post" class="layui-form" >
            <input name="username" placeholder="账号"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20" >
        </form>
    </div>

    <script>
        $(function  () {
            layui.use('form', function(){
                var form = layui.form;
                form.on('submit(login)', function(data){
                    $('input[type="submit"]').attr("disabled",true);
                    $.post("/admin/Login/login",data.field,function(res){
                        if(res.status==0){
                            layer.msg(res.msg,{icon: 2,time:1000},function(){
                                $('input[type="submit"]').removeAttr("disabled");
                            });
                        }else{
                            layer.msg(res.msg,{icon: 1,time:1000},function(){
                                window.location.href="/admin/Index/index"
                            });
                        }
                    },'json');
                    return false;
                });
            });
        })
    </script>
</body>
</html>