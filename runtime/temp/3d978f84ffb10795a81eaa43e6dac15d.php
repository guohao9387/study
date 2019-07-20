<?php /*a:1:{s:66:"/home/wwwroot/study/application/agent/view/withdraw/bank_list.html";i:1562901408;}*/ ?>
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
        <a href="">提现管理</a>
        <a>
            <cite>银行卡列表</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <xblock>
        <button class="layui-btn" onclick="x_admin_show('添加银行卡','/agent/Withdraw/bank_add')"><i class="layui-icon"></i>添加银行卡</button>
        <span class="x-right" style="line-height:40px">每人最多绑定3张银行卡，绑定后如需修改请联系客服。</span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>真实姓名</th>
            <th>电话</th>
            <th>开户行</th>
            <th>支行</th>
            <th>卡号</th>
            <th>添加时间</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
                <td><?php echo htmlentities($vo['id']); ?></td>
                <td><?php echo htmlentities($vo['name']); ?></td>
                <td><?php echo htmlentities(dataDesensitization($vo['phone'],3,4)); ?></td>
                <td><?php echo htmlentities($vo['bank_name']); ?></td>
                <td><?php echo htmlentities($vo['branch_name']); ?></td>
                <td><?php echo htmlentities(dataDesensitization($vo['bank_card'],4,8)); ?></td>
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
</body>
</html>