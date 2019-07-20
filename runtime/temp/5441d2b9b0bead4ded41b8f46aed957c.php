<?php /*a:1:{s:64:"/home/wwwroot/study/application/admin/view/admin/notice_add.html";i:1562751629;}*/ ?>
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
        <div class="layui-form-item">
            <label for="title" class="layui-form-label">
                标题
            </label>
            <div class="layui-input-inline">
                <input type="text" id="title" name="title" required="" lay-verify="normal"
                       autocomplete="off" class="layui-input" >
            </div>
            <div class="layui-form-mid layui-word-aux">
                1-50位
            </div>
        </div>
        <div class="layui-form-item">
            <label for="content" class="layui-form-label">
                内容
            </label>
            <div class="layui-input-inline"  style="width: 70% ;">
                <input type="text" id="content" name="content" required="" lay-verify="content"
                       autocomplete="off" class="layui-input" >
            </div>
            <div class="layui-form-mid layui-word-aux">
                1-255位
            </div>
        </div>
        <div class="layui-form-item" >
            <label for="type" class="layui-form-label">
                发布对象
            </label>
            <div class="layui-input-inline">
                <select id="type" name="type" class="valid" >
                    <option  value="1">会员</option>
                    <option  value="2">代理</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="sort" class="layui-form-label">
                排序
            </label>
            <div class="layui-input-inline">
                <input type="number" id="sort" name="sort" required=""
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                最小1，最大9999，越大越靠前，默认1
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
                if(value.length <= 0||value.length > 50){
                    return '长度1-50位';
                }
            },content: function(value){
                if(value.length <= 0||value.length > 255){
                    return '长度1-255位';
                }
            }

        });

        //监听提交
        form.on('submit(add)', function(data){
            $('.layui-btn').attr("disabled",true);
            $.post("/admin/Admin/notice_add",data.field,function(res){
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