<?php /*a:1:{s:62:"/home/wwwroot/study/application/admin/view/admin/kefu_add.html";i:1562751629;}*/ ?>
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
            <label for="name" class="layui-form-label">
                客服名称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="name" name="name" required="" lay-verify="normal"
                       autocomplete="off" class="layui-input" >
            </div>
            <div class="layui-form-mid layui-word-aux">
                必填，1-20位
            </div>
        </div>
        <div class="layui-form-item">
            <label for="value" class="layui-form-label">
                联系方式
            </label>
            <div class="layui-input-inline">
                <input type="text" id="value" name="value"  lay-verify="value"
                       autocomplete="off" class="layui-input" >
            </div>
            <div class="layui-form-mid layui-word-aux">
                选填，1-50位
            </div>
        </div>
        <div class="layui-form-item">
            <label for="image" class="layui-form-label">
                二维码
            </label>
            <div class="layui-input-inline">
                <button type="button" class="layui-btn" id="image">
                    <i class="layui-icon">&#xe67c;</i>上传图片
                </button>
                <input type="hidden" name="image" id="path" lay-verify="image"/>
                <img src="" alt="" id="img" />
            </div>
            <div class="layui-form-mid layui-word-aux">
                选填，单张
            </div>
        </div>
        <div class="layui-form-item">
            <label for="sort" class="layui-form-label">
                排序
            </label>
            <div class="layui-input-inline">
                <input type="number" id="sort" name="sort" required="" lay-verify="sort"
                       autocomplete="off" class="layui-input" >
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
    layui.use('upload', function(){
        var upload = layui.upload;

        //执行实例
        var uploadInst = upload.render({
            elem: '#image' //绑定元素
            ,accept: 'images' //绑定元素
            ,url: '/admin/Api/upload' //上传接口
            ,data:{path:'kefu'}
            ,done: function(res){
//                console.log(res);
                if(res['status'] == 1){
                    $('#path').attr('value',res['info']);
                }else{
                    layer.msg(res.info,{icon: 2,time:2000});
                }
                //上传完毕回调
            }
            , choose: function (obj) {
                obj.preview(function (index, file, result) {
                    $('#img').attr('src',result);
                });
            }
            ,error: function(){
                layer.msg('上传失败，请重试',{icon: 2,time:2000});
                //请求异常回调
            }
        });
    });
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
                ,layer = layui.layer;

        //自定义验证规则
        form.verify({
            normal:function(value){
                if(value.length < 1||value.length > 20){
                    return '长度1-20位';
                }
            }
            ,value:function(value){
                if(value){
                    if(value.length < 1||value.length > 50){
                        return '长度1-50位';
                    }
                }
            }
        });

        //监听提交
        form.on('submit(add)', function(data){
            $('.layui-btn').attr("disabled",true);
            $.post("/admin/Admin/kefu_add",data.field,function(res){
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