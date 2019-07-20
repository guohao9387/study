<?php /*a:1:{s:62:"/home/wwwroot/study/application/agent/view/agent/personal.html";i:1562901408;}*/ ?>
<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title><?php echo htmlentities($GLOBALS['title']); ?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/static/admin/css/font.css">
    <link rel="stylesheet" href="/static/admin/css/xadmin.css">
    <script src="/static/index/js/jquery-2.1.1.min.js" charset="utf-8"></script>
    <script src="/static/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/static/admin/js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <div class="x-body">
        <form class="layui-form" method="post">
          <div class="layui-form-item">
              <label for="L_nickname" class="layui-form-label">
                         姓名
              </label>
              <div class="layui-input-inline">
                  <input type="text" id="L_nickname" name="nickname" required="" lay-verify="nickname"
                  autocomplete="off" class="layui-input" value="<?php echo htmlentities($info['nickname']); ?>">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  1到12个字符
              </div>
          </div>

          <div class="layui-form-item">
              <label for="L_pass" class="layui-form-label">
                  <span class="x-red"></span>新密码
              </label>
              <div class="layui-input-inline">
                  <input type="password" id="L_pass" name="pass" required="" lay-verify="pass"
                  autocomplete="off" class="layui-input" placeholder="不填则不做修改">
              </div>
              <div class="layui-form-mid layui-word-aux">
                  6到18个字符
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
                  <span class="x-red"></span>确认密码
              </label>
              <div class="layui-input-inline">
                  <input type="password" id="L_repass" name="repass" required="" lay-verify="repass"
                  autocomplete="off" class="layui-input" placeholder="请输入确认密码">
              </div>
          </div>
          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  确认
              </button>
          </div>
      </form>
    </div>
    <script>
      layui.use(['form','layer'], function(){
          $ = layui.jquery;
        var form = layui.form
        ,layer = layui.layer;
          //自定义验证规则
        form.verify({
         nickname:function(value){
                if(value.length < 1||value.length > 6){
                    return '长度1-6位';
                }
                if(!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)){
                    return '不含特殊字符';
                }
            }
            ,pass: function(value){
                if(value != '' && (value.length < 6 || value.length > 18)){
                    return '请输入6-18位的密码';
                }
            }
            ,repass: function(value){
                if($('#password').val()!=$("#repass").val()){
                    return '两次输入密码不一致';
                }
            }
        });
        //监听提交
        form.on('submit(add)', function(data){
            $('.layui-btn').attr("disabled",true);
            $.post("/agent/Agent/personal",data.field,function(res){
                if(res.status==0){
                    layer.msg(res.msg,{icon: 2,time:2000},function(){
                        $('.layui-btn').removeAttr("disabled");
                    });
                }else{
                    layer.msg(res.msg,{icon: 1,time:1000},function(){
                        window.location.href="/agent/Login/logout";
                    });
                }
            },'json');
            return false;
        });
      });
  </script>
  </body>
</html>