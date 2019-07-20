<?php /*a:1:{s:63:"/home/wwwroot/study/application/admin/view/user/agent_edit.html";i:1562835044;}*/ ?>
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
    <form class="layui-form">
        <input type="hidden" name="agent_id" value="<?php echo htmlentities($info['agent_id']); ?>"/>
        <div class="layui-form-item">
            <label class="layui-form-label">
                账号
            </label>
            <div class="layui-input-inline">
                <input type="text" readonly
                       autocomplete="off" class="layui-input" value="<?php echo htmlentities($info['agent_name']); ?>">
            </div>
            <div class="layui-form-mid layui-word-aux">
                唯一账号，6-12位数字，字母
            </div>
        </div>

        <div class="layui-form-item">
            <label for="password" class="layui-form-label">
                密码
            </label>
            <div class="layui-input-inline">
                <input type="text" id="password" name="password" required="" lay-verify="password"
                       autocomplete="off" class="layui-input" placeholder="不填则不做修改" value="<?php echo htmlentities($info['pwd']); ?>">
            </div>
            <div class="layui-form-mid layui-word-aux">
                6到18个字符
            </div>
        </div>

        <div class="layui-form-item">
            <label for="nickname" class="layui-form-label">
                姓名
            </label>
            <div class="layui-input-inline">
                <input type="text" id="nickname" name="nickname" required="" lay-verify="nickname"
                       autocomplete="off" class="layui-input" value="<?php echo htmlentities($info['nickname']); ?>">
            </div>
            <div class="layui-form-mid layui-word-aux">
                1-6位不含特殊字符
            </div>
        </div>

        <div class="layui-form-item">
            <label for="p_agent_id" class="layui-form-label">
                直属代理
            </label>
            <div class="layui-input-inline">
                <input type="text" id="p_agent_id" name="p_agent_id"
                       autocomplete="off" class="layui-input" value="<?php echo htmlentities(select_agent_username($info['p_agent_id'])); ?>" readonly>
            </div>
            <div class="layui-form-mid layui-word-aux">
                选填
            </div>
        </div>
        <div class="layui-form-item">
            <label for="invite_number" class="layui-form-label">
                         邀请码
            </label>
            <div class="layui-input-inline">
                <input type="number" id="invite_number" name="invite_number" required="" lay-verify="number"
                       autocomplete="off" class="layui-input" value="<?php echo htmlentities($info['invite_number']); ?>">
            </div>
            <div class="layui-form-mid layui-word-aux">
                4位数字
            </div>
        </div>
        <div class="layui-form-item">
            <label  class="layui-form-label">
                账户余额
            </label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" value="<?php echo htmlentities(number_format($info['money'],2,'.','')); ?>" disabled>
            </div>
        </div>


        <div class="layui-form-item">
            <label class="layui-form-label">
                邀请状态
            </label>
            <div class="layui-input-inline">
                <input type="radio" name="invite_status" value="1" title="是" <?php if($info['invite_status'] == 1): ?>checked<?php endif; ?>>
                <input type="radio" name="invite_status" value="2" title="否" <?php if($info['invite_status'] == 2): ?>checked<?php endif; ?>>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">
                登录状态
            </label>
            <div class="layui-input-inline">
                <input type="radio" name="login_status" value="1" title="是" <?php if($info['login_status'] == 1): ?>checked<?php endif; ?>>
                <input type="radio" name="login_status" value="2" title="否" <?php if($info['login_status'] == 2): ?>checked<?php endif; ?>>
            </div>
        </div>
        <div class="layui-form-item">
            <label  class="layui-form-label">
                上次登录IP
            </label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" value="<?php echo htmlentities(getCity($info['last_login_ip'])); ?>" disabled>
            </div>
        </div>
        <div class="layui-form-item">
            <label  class="layui-form-label">
                上次登录时间
            </label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" value="<?php echo htmlentities($info['last_login_time']); ?>" disabled>
            </div>
        </div>
        <div class="layui-form-item">
            <label  class="layui-form-label">
                注册IP
            </label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" value="<?php echo htmlentities(getCity($info['add_ip'])); ?>" disabled>
            </div>
        </div>
        <div class="layui-form-item">
            <label  class="layui-form-label">
                注册时间
            </label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" value="<?php echo htmlentities($info['add_time']); ?>" disabled>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">
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
            normal:function(value){
                if(value.length < 6||value.length > 12){
                        return '长度6-12位';
                }
                if(!new RegExp("^[a-zA-Z0-9]+$").test(value)){
                    return '必须数字或字母';
                }
            }
            , nickname:function(value){
                if(value.length < 1||value.length > 6){
                    return '长度1-6位';
                }
                if(!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)){
                    return '不含特殊字符';
                }
            }

            ,password: function(value){
                if($('#password').val()!=''&&($("#password").val().length <6 || $("#password").val().length>18)){
                    return '请输入6-18位的密码';
                }
            }

        });

        //监听提交
        form.on('submit(add)', function(data){
            $('.layui-btn').attr("disabled",true);
            $.post("/admin/User/agent_edit",data.field,function(res){
                if(res.status==0){
                    layer.msg(res.msg,{icon: 2,time:2000},function(){
                        $('.layui-btn').removeAttr("disabled");
                    });
                }else{
                    layer.msg(res.msg,{icon: 1,time:1000},function(){
                        var index = parent.layer.getFrameIndex(window.name);
                        //关闭当前frame
                        parent.layer.close(index);
                        parent.location.reload();
                    });
                }
            },'json');
            return false;
        });
    });
</script>
</body>
</html>