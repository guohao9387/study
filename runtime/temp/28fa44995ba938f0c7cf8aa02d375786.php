<?php /*a:1:{s:63:"/home/wwwroot/study/application/agent/view/user/agent_list.html";i:1562901408;}*/ ?>
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
        <a href="">账户管理</a>
        <a>
            <cite>代理列表</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so">
            <!--<input class="layui-input" placeholder="开始日" name="start" id="start" value="<?php echo input('get.start'); ?>">-->
            <!--<input class="layui-input" placeholder="截止日" name="end" id="end" value="<?php echo input('get.end'); ?>">-->
            <input type="text" name="agent_name"  placeholder="代理账号" autocomplete="off" class="layui-input" value="<?php echo input('get.agent_name'); ?>">
            <input type="text" name="nickname"  placeholder="代理昵称" autocomplete="off" class="layui-input" value="<?php echo input('get.nickname'); ?>">
            <input type="text" name="phone"  placeholder="代理电话" autocomplete="off" class="layui-input" value="<?php echo input('get.phone'); ?>">
            <div class="layui-input-inline">
                <select name="page_number">
                    <option value="">当页数量</option>
                    <?php if(is_array($page_number) || $page_number instanceof \think\Collection || $page_number instanceof \think\Paginator): $i = 0; $__LIST__ = $page_number;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                    <option <?php if(input('get.page_number') == $val['num']): ?> selected="selected"<?php endif; ?> value="<?php echo htmlentities($val['num']); ?>"><?php echo htmlentities($val['num']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
            <button class="layui-btn"  lay-submit="" lay-filter="sreach">查询</button>
            <a href="/agent/User/agent_list"  class="layui-btn layui-btn-normal">重置</a>
        </form>
    </div>
    <xblock>
        <button class="layui-btn" onclick="x_admin_show('添加代理','/agent/User/agent_add')"><i class="layui-icon"></i>添加代理</button>
        <span class="x-right" style="line-height:40px">合计余额：<?php echo htmlentities(number_format($count['sum_money'],2,'.','')); ?>;数量：<?php echo htmlentities($count['count']); ?> 条</span>
    </xblock>
    <table class="layui-table">

        <thead>
        <tr>
            <th>ID</th>
            <th>账号</th>
            <th>昵称</th>
            <th>直属代理</th>
            <th>余额</th>
            <th>注册时间</th>
            <th>登录状态</th>
            <th>邀请码</th>
            <!--<th>银行卡</th>-->
            <th>操作</th></tr>
        </thead>
        <tbody>

        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>

                <td><?php echo htmlentities($vo['agent_id']); ?></td>
                <td><?php echo htmlentities($vo['agent_name']); ?></td>
                <td><?php echo htmlentities($vo['nickname']); ?></td>
                <td><?php echo htmlentities(select_agent_username($vo['p_agent_id'])); ?></td>
                <td><?php echo htmlentities(number_format($vo['money'],2,".","")); ?></td>

                <td><?php echo htmlentities($vo['add_time']); ?></td>
                <td class="td-status">
                    <?php if($vo['login_status'] == 1): ?>
                    是
                        <!--<a onclick="member_stop(this,<?php echo htmlentities($vo['agent_id']); ?>)" href="javascript:;"  title="设置代理不可登录">-->
                            <!--<span class="layui-btn layui-btn-normal layui-btn-mini">是</span>-->
                        <!--</a>-->
                    <?php else: ?>
                    否
                        <!--<a onclick="member_stop(this,<?php echo htmlentities($vo['agent_id']); ?>)" href="javascript:;"  title="设置代理可登录">-->
                            <!--<span class="layui-btn layui-btn-danger layui-btn-mini ">否</span>-->
                        <!--</a>-->
                    <?php endif; ?>
                </td>
                <td class="td-status">
                    <a onclick="x_admin_show('代理邀请码','/agent/User/agent_code?id=<?php echo htmlentities($vo['agent_id']); ?>')" href="javascript:;"  title="查看">
                        <span class="layui-btn layui-btn-mini " style="background-color: #C57979">查看</span>
                    </a>
                </td>
                <!--<td class="td-status">-->
                    <!--<a onclick="x_admin_show('银行卡信息','/admin/user/bank_list?username=<?php echo htmlentities($vo['agent_name']); ?>&utype=2')" href="javascript:;"  title="银行卡信息">-->
                        <!--<span class="layui-btn layui-btn-mini " style="background-color: #84AF9B">查看</span>-->
                    <!--</a>-->
                <!--</td>-->
                <td class="td-manage">
                    <div class="layui-btn-group">
                        <!-- 上分点击事件-->
                        <!--<button class="layui-btn layui-btn-warm layui-btn-sm" onclick="myshow('up',<?php echo htmlentities($vo['agent_id']); ?>,'<?php echo htmlentities($vo['agent_name']); ?>')">上分</button>-->
                        <!--<button class="layui-btn layui-btn-sm " style="background-color: #5BB75B;" onclick="myshow('down',<?php echo htmlentities($vo['agent_id']); ?>,'<?php echo htmlentities($vo['agent_name']); ?>')">下分</button>-->
                        <button class="layui-btn layui-btn-sm " onclick="x_admin_show('查看详情','/agent/User/agent_edit?agent_id=<?php echo htmlentities($vo['agent_id']); ?>')">查看详情</button>
                        <!--<button class="layui-btn layui-btn-danger layui-btn-sm" onclick="member_del(this,<?php echo htmlentities($vo['agent_id']); ?>)">删除</button>-->
                    </div>
                </td>
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