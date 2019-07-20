<?php /*a:1:{s:63:"/home/wwwroot/study/application/admin/view/admin/news_list.html";i:1562835044;}*/ ?>
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

<body class="layui-anim layui-anim-up">
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">平台管理</a>
        <a>
            <cite>资讯列表</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so">
            <input class="layui-input" placeholder="开始日" name="start" id="start" value="<?php echo input('get.start'); ?>">
            <input class="layui-input" placeholder="截止日" name="end" id="end" value="<?php echo input('get.end'); ?>">
            <input type="text" name="title"  placeholder="资讯标题" autocomplete="off" class="layui-input" value="<?php echo input('get.title'); ?>">
            <div class="layui-input-inline">
                <select name="status">
                    <option value="">资讯状态</option>
                    <option <?php if(input('get.status') == 1): ?> selected="selected"<?php endif; ?> value="1">正常</option>
                    <option <?php if(input('get.status') == 2): ?> selected="selected"<?php endif; ?> value="2">禁用</option>
                </select>
            </div>
            <button class="layui-btn"  lay-submit="" lay-filter="sreach">查询</button>
            <a href="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>"  class="layui-btn layui-btn-normal">重置</a>

        </form>
    </div>
    <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加资讯','/admin/Admin/news_add')"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">资讯数量：<?php echo htmlentities($count); ?> 条</span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>标题</th>
            <th>排序</th>
            <th>添加时间</th>
            <th>状态</th>
            <th>操作</th></tr>
        </thead>
        <tbody>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
                <td>
                    <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo htmlentities($vo['id']); ?>'><i class="layui-icon">&#xe605;</i></div>
                </td>
                <td><?php echo htmlentities($vo['id']); ?></td>
                <td><?php echo htmlentities($vo['title']); ?></td>
                <td><?php echo htmlentities($vo['sort']); ?></td>
                <td><?php echo htmlentities($vo['add_time']); ?></td>
                <td class="td-status">
                    <?php if($vo['status'] == 1): ?>
                        <a onclick="member_stop(this,<?php echo htmlentities($vo['id']); ?>)" href="javascript:;"  title="禁用">
                            <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span>
                        </a>
                    <?php else: ?>
                        <a onclick="member_stop(this,<?php echo htmlentities($vo['id']); ?>)" href="javascript:;"  title="启用">
                            <span class="layui-btn layui-btn-danger layui-btn-mini ">已禁用</span>
                        </a>
                    <?php endif; ?>
                </td>

                <td class="td-manage">
                    <a title="编辑"  onclick="x_admin_show('编辑','/admin/Admin/news_edit?id=<?php echo htmlentities($vo['id']); ?>')" href="javascript:;">
                        <i class="layui-icon">&#xe642;</i>
                    </a>
                    <a title="删除" onclick="member_del(this,<?php echo htmlentities($vo['id']); ?>)" href="javascript:;">
                        <i class="layui-icon">&#xe640;</i>
                    </a>
                </td>
            </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>

        </tbody>
    </table>
    <div class="page">
        <div>
            <?php echo $list->render(); ?>
        </div>
    </div>

</div>
<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
            ,type: 'datetime'

        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
            ,type: 'datetime'

        });
    });

    /*会员-禁用*/
    function member_stop(obj,id){
        layer.confirm('确认要'+$(obj).attr('title')+'吗？',function(index){
            var status = 1;
            if($(obj).attr('title')=='禁用'){
                status = 2;
            }
            $.ajax({
                url:'/admin/Api/status_change',
                data:{id:id,status:status,db:'news'},
                type:'post',
                dataType:'json',
                success:function(res){
                    if(res['status']==1){
                        if(status==2){
                            //发异步把会员状态进行更改
                            $(obj).attr('title','启用').children('span').removeClass('layui-btn-normal').addClass('layui-btn-danger').html('已禁用');
                            layer.msg('已禁用!',{icon: 1,time:1000});
                        }else{
                            $(obj).attr('title','禁用').children('span').removeClass('layui-btn-danger').addClass('layui-btn-normal').html('已启用');
                            layer.msg('已启用!',{icon: 1,time:1000});
                        }
                    }else{
                        layer.msg('操作失败!',{icon: 2,time:1000});
                    }
                }
            });
        });
    }

    /*会员-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
            $.ajax({
                url:'/admin/Api/status_change',
                data:{id:id,status:3,db:'news'},
                type:'post',
                dataType:'json',
                success:function(res){
                    if(res['status']==1){
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!',{icon:1,time:1000});
                    }else{
                        layer.msg('操作失败!',{icon: 2,time:1000});
                    }
                }
            });
        });
    }


    function delAll (argument) {

        var data = tableCheck.getData();
        if(data.length==0){
            layer.msg('至少选择一个!',{icon:2,time:1000});
            return;
        }
        layer.confirm('确认要删除编号为：'+data+'的资讯吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            $.ajax({
                url:'/admin/Api/status_change',
                data:{id:data,status:3,db:'news'},
                type:'post',
                dataType:'json',
                success:function(res){
                    if(res['status']==1){
                        $(".layui-form-checked").not('.header').parents('tr').remove();
                        layer.msg('删除成功!',{icon:1,time:1000});
                    }else{
                        layer.msg('操作失败!',{icon: 2,time:1000});
                    }
                }
            });

        });
    }
</script>

</body>

</html>