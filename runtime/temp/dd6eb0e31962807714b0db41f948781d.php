<?php /*a:1:{s:69:"/home/wwwroot/study/application/admin/view/money/user_money_list.html";i:1562751629;}*/ ?>
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
        <a href="">资金管理</a>
        <a>
            <cite>会员资金记录</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so">
            <input class="layui-input" placeholder="开始日" name="start" id="start" value="<?php echo input('get.start'); ?>" autocomplete="off">
            <input class="layui-input" placeholder="截止日" name="end" id="end" value="<?php echo input('get.end'); ?>" autocomplete="off">
            <input type="text" name="username"  placeholder="会员账号" autocomplete="off" class="layui-input" value="<?php echo input('get.username'); ?>">
            <input type="text" name="nickname"  placeholder="会员昵称" autocomplete="off" class="layui-input" value="<?php echo input('get.nickname'); ?>">

            <div class="layui-input-inline">
                <select name="type">
                    <option value="">操作类型</option>
                    <option <?php if(input('get.type') == 1): ?> selected="selected"<?php endif; ?> value="1">充值</option>
                    <option <?php if(input('get.type') == 2): ?> selected="selected"<?php endif; ?> value="2">提现</option>
                    <option <?php if(input('get.type') == 3): ?> selected="selected"<?php endif; ?> value="3">下注/结算</option>
                    <option <?php if(input('get.type') == 4): ?> selected="selected"<?php endif; ?> value="4">上/下分</option>
                    <option <?php if(input('get.type') == 5): ?> selected="selected"<?php endif; ?> value="5">申购币</option>
                    <option <?php if(input('get.type') == 6): ?> selected="selected"<?php endif; ?> value="6">其他</option>
                </select>
            </div>
            <!--<div class="layui-input-inline">-->
                <!--<select name="toward">-->
                    <!--<option value="">操作方向</option>-->
                    <!--<option <?php if(input('get.toward') == 1): ?> selected="selected"<?php endif; ?> value="1">增加</option>-->
                    <!--<option <?php if(input('get.toward') == 2): ?> selected="selected"<?php endif; ?> value="2">减少</option>-->
                <!--</select>-->
            <!--</div>-->
            <div class="layui-input-inline">
                <select name="page_number">
                    <option value="">当页数量</option>
                    <?php if(is_array($page_number) || $page_number instanceof \think\Collection || $page_number instanceof \think\Paginator): $i = 0; $__LIST__ = $page_number;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                    <option <?php if(input('get.page_number') == $val['num']): ?> selected="selected"<?php endif; ?> value="<?php echo htmlentities($val['num']); ?>"><?php echo htmlentities($val['num']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
            <button class="layui-btn"  lay-submit="" lay-filter="sreach">查询</button>
            <a href="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>?start=<?php echo htmlentities($mytime); ?>"  class="layui-btn layui-btn-normal">重置</a>
            <a href="<?php echo url('admin/Api/excel_user_money_list',input('get.')); ?>"  class="layui-btn" style="background-color: #337AB7">导出</a>

        </form>
    </div>
    <div class="layui-row">
        <a href="<?php echo url('admin/Money/user_money_list',input('get.')); ?>&start=<?php echo quick_time_select(1); ?>&end=<?php echo quick_time_select(2); ?>" class="layui-btn layui-btn-sm layui-btn-normal">昨天</a>
        <a href="<?php echo url('admin/Money/user_money_list',input('get.')); ?>&start=<?php echo quick_time_select(2); ?>&end=" class="layui-btn layui-btn-sm layui-btn-normal">今天</a>
        <a href="<?php echo url('admin/Money/user_money_list',input('get.')); ?>&start=<?php echo quick_time_select(3); ?>&end=" class="layui-btn layui-btn-sm layui-btn-normal">本周</a>
        <a href="<?php echo url('admin/Money/user_money_list',input('get.')); ?>&start=<?php echo quick_time_select(4); ?>&end=<?php echo quick_time_select(5); ?>" class="layui-btn layui-btn-sm layui-btn-normal">上周</a>
        <a href="<?php echo url('admin/Money/user_money_list',input('get.')); ?>&start=<?php echo quick_time_select(6); ?>&end=" class="layui-btn layui-btn-sm layui-btn-normal">本月</a>
        <a href="<?php echo url('admin/Money/user_money_list',input('get.')); ?>&start=<?php echo quick_time_select(7); ?>&end=<?php echo quick_time_select(8); ?>" class="layui-btn layui-btn-sm layui-btn-normal">上月</a>
    </div>
    <xblock>
        <span class="x-right" style="line-height:40px">合计金额：<?php echo htmlentities(number_format($count['sum'],2,'.','')); ?>;数量：<?php echo htmlentities($count['count']); ?> 条</span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>账号</th>
            <th>昵称</th>
            <th>操作类型</th>
            <th>变化前金额</th>
            <th>金额</th>
            <th>变化后金额</th>
            <th>备注</th>
            <th>添加时间</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr>
            <td><?php echo htmlentities($vo['id']); ?></td>
            <td><?php echo htmlentities($vo['username']); ?></td>
            <td><?php echo htmlentities($vo['nickname']); ?></td>
            <td><?php echo htmlentities($vo['type_info']); ?></td>
            <td><?php echo htmlentities(number_format($vo['before_money'],2,'.','')); ?></td>
            <td><?php echo htmlentities(number_format($vo['money'],2,'.','')); ?></td>
            <td><?php echo htmlentities(number_format($vo['after_money'],2,'.','')); ?></td>
            <td><?php echo htmlentities($vo['remark']); ?></td>
            <td><?php echo htmlentities($vo['add_time']); ?></td>
        </tr>
        <?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>

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


</script>

</body>

</html>