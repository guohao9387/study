<?php /*a:1:{s:58:"/home/wwwroot/study/application/agent/view/index/main.html";i:1562901408;}*/ ?>
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

</head>
<body>
<div class="x-body layui-anim layui-anim-up">
<blockquote class="layui-elem-quote">欢迎代理：
    <span class="x-red"><?php echo htmlentities($nickname); ?></span>！当前登陆时间:<?php echo date('Y-m-d H:i:s',time()); ?></blockquote>
<fieldset class="layui-elem-field">
    <legend>数据统计</legend>
    <div class="layui-field-box">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-body">
                    <div class="layui-carousel x-admin-carousel x-admin-backlog" lay-anim="" lay-indicator="inside" lay-arrow="none" style="width: 100%; height: 90px;">
                        <div carousel-item="">
                            <ul class="layui-row layui-col-space10 layui-this">
                                <li class="layui-col-xs2" >
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>账户余额</h3>
                                        <p>
                                            <cite><?php echo htmlentities(number_format($param['money'],2,".","")); ?></cite></p>
                                    </a>
                                </li>
                                <li class="layui-col-xs2" >
                                    <a href="javascript:;" class="x-admin-backlog-body">
                                        <h3>已提现</h3>
                                        <p>
                                            <cite><?php echo htmlentities(number_format($param['withdraw'],2,".","")); ?></cite></p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>

<fieldset class="layui-elem-field">
    <legend>资金记录</legend>
    <div class="layui-field-box">
        <table class="layui-table" lay-skin="line">
            <tbody>
            <tr>
                <td style="text-indent: 20px;">
                    <table class="layui-table">
                        <thead>
                        <tr>
                        <th>ID</th>
                        <th>操作类型</th>
                        <th>变化前金额</th>
                        <th>金额</th>
                        <th>变化后金额</th>
                        <th>备注</th>
                        <th>添加时间</th>
                        <tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <tr>
                            <td><?php echo htmlentities($vo['id']); ?></td>
                            <td><?php echo htmlentities($vo['type_info']); ?></td>
                            <td><?php echo htmlentities(number_format($vo['before_money'],2,'.','')); ?></td>
                            <td><?php echo htmlentities(number_format($vo['money'],2,'.','')); ?></td>
                            <td><?php echo htmlentities(number_format($vo['after_money'],2,'.','')); ?></td>
                            <td><?php echo htmlentities($vo['remark']); ?></td>
                            <td><?php echo htmlentities($vo['add_time']); ?></td>
                        </tr>
                        <?php endforeach; endif; else: echo "暂时没有数据" ;endif; if(!empty($list)): ?>
                        <tr>
                            <td><a href="/agent/Agent/money_list" style="color: blue;">查看更多</a></td>
                        </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</fieldset>
<fieldset class="layui-elem-field">
    <legend>系统公告</legend>
    <div class="layui-field-box">
        <table class="layui-table" lay-skin="line">
            <tbody>
            <tr>
                <td style="text-indent: 20px;">
                    <?php echo htmlentities($param['notice']['content']); ?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</fieldset>
<!--<fieldset class="layui-elem-field">-->
    <!--<legend>今日新增</legend>-->
    <!--<div class="layui-field-box">-->
        <!--<table class="layui-table">-->
            <!--<tbody>-->
            <!--<tr>-->
                <!--<th>会员数</th>-->
                <!--<td></td>-->
            <!--</tr>-->
            <!--</tbody>-->
        <!--</table>-->
    <!--</div>-->
<!--</fieldset>-->

<fieldset class="layui-elem-field">
    <legend>开发团队</legend>
    <div class="layui-field-box">
        <table class="layui-table">
            <tbody>
            <tr>
                <th>版权所有</th>
                <td><?php echo htmlentities($GLOBALS['title']); ?>
                    <!--<a href="" class='x-a' target="_blank">访问官网</a>-->
                </td>
            </tr>
            <tr>
                <th>开发者</th>
                <td><?php echo htmlentities($GLOBALS['title']); ?>技术部</td></tr>
            </tbody>
        </table>
    </div>
</fieldset>
<blockquote class="layui-elem-quote layui-quote-nm">本系统由<?php echo htmlentities($GLOBALS['title']); ?>提供技术支持。</blockquote>
</div>
</body>
</html>