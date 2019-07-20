<?php /*a:1:{s:59:"/home/wwwroot/study/application/agent/view/login/login.html";i:1562902314;}*/ ?>
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
            <input name="agent_name" placeholder="账号"  type="number" lay-verify="normal" class="layui-input" >
            <hr class="hr15">
            <input name="password" lay-verify="password" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <input name="code" lay-verify="code" placeholder="验证码"  type="text"  style="width: 60%;float: left;">
            <img src="/agent/Login/verify" alt="captcha" id="code" style="width: 40%;float: right;height:3rem;display: inline-block;" onClick="this.src=this.src+'?'+Math.random()"/>

            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20" >
        </form>
    </div>

    <script>
        $(function  () {
            layui.use('form', function(){
                $ = layui.jquery;
                var form = layui.form
                        ,layer = layui.layer;
                form.verify({
                    normal:function(value){
                        if(value.length ==0){
                            return '请输入账号';
                        }
                        if(value.length <6||value.length >12){
                            return '请输入正确的账号';
                        }
                        if(!new RegExp("^[a-zA-Z0-9]+$").test(value)){
                            return '必须数字或字母';
                        }
                    }
                    ,password: [
                        /^[\S]{6,18}$/
                        ,'请输入6到18位密码'
                    ]
                    ,code: function(value){
                        if(value.length !=4){
                            return '请输入验证码';
                        }
                    }

                });

                form.on('submit(login)', function(data){
                    var load = layer.load();
                    $('input[type="submit"]').attr("disabled",true);
                    $.post("/agent/Login/login",data.field,function(res){
                        layer.close(load);
                        if(res.status==0){
                            layer.msg(res.msg,{icon: 2,time:1000},function(){
                                $('input[type="submit"]').removeAttr("disabled");
                                $('input[name="password"]').val('');
                                $('#code').click();
                            });
                        }else{
                            layer.msg(res.msg,{icon: 1,time:1000},function(){
                                window.location.href="/agent/index/index"
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