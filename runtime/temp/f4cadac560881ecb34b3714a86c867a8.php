<?php /*a:1:{s:60:"/home/wwwroot/study/application/admin/view/system/index.html";i:1562806576;}*/ ?>
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
    <form class="layui-form layui-form-pane">
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
            <div class="layui-form-item">
                <label class="layui-form-label" style="width: 250px"><?php echo htmlentities($val['name']); ?></label>
                <div class="layui-input-inline">
                    <input type="text"  autocomplete="off" class="layui-input" name="<?php echo htmlentities($val['id']); ?>" value="<?php echo htmlentities($val['value']); ?>">
                </div>
            </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        <div class="layui-form-item">
            <button class="layui-btn" lay-submit="" lay-filter="add">更新</button>
        </div>
    </form>
</div>
<script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
                ,layer = layui.layer;

        //监听提交
        form.on('submit(add)', function(data){
            $.post("/admin/System/index",data.field,function(res){
                layer.msg(res.msg,{icon: 1,time:2000},function(){
                    window.location.reload();
                });
            },'json');
            return false;
        });


    });
</script>
</body>
</html>