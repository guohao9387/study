<?php /*a:1:{s:59:"/home/wwwroot/study/application/admin/view/index/index.html";i:1562835044;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlentities($GLOBALS['title']); ?></title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/static/admin/css/font.css">
    <link rel="stylesheet" href="/static/admin/css/xadmin.css">
    <script src="/static/index/js/jquery-2.1.1.min.js" charset="utf-8"></script>
    <script src="/static/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/static/admin/js/xadmin.js"></script>

</head>
<body>
<!-- 顶部开始 -->
<div class="container">
    <div class="logo"><a href="/admin/Index/index"><?php echo htmlentities($GLOBALS['title']); ?></a></div>
    <div class="left_open">
        <i title="展开左侧栏" class="iconfont">&#xe699;</i>
    </div>

    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;"><?php echo htmlentities($nickname); ?></a>
            <dl class="layui-nav-child"> <!-- 二级菜单 -->
                <dd><a onclick="x_admin_show('个人信息','/admin/Index/personal',1000,600)">个人信息</a></dd>
                <dd><a href="/admin/Login/logout">退出</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item to-index"><a href="/index/index/index">前台首页</a></li>
    </ul>

</div>
<!-- 顶部结束 -->
<!-- 中部开始 -->
<!-- 左侧菜单开始 -->
<div class="left-nav">
    <div id="side-nav">
        <ul id="nav">
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b9;</i>
                    <cite>平台管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <!--<li>-->
                        <!--<a _href="/admin/Admin/adv_list">-->
                            <!--<i class="iconfont">&#xe6a7;</i>-->
                            <!--<cite>广告列表</cite>-->
                        <!--</a>-->
                    <!--</li >-->
                    <li>
                        <a _href="/admin/Admin/notice_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>公告列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/admin/Admin/news_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>资讯列表</cite>
                        </a>
                    </li >
                    <!--<li>-->
                        <!--<a _href="/admin/Admin/protocol_list">-->
                            <!--<i class="iconfont">&#xe6a7;</i>-->
                            <!--<cite>协议列表</cite>-->
                        <!--</a>-->
                    <!--</li >-->
                    <li>
                        <a _href="/admin/Admin/kefu_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>客服列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/admin/Admin/product_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>产品列表</cite>
                        </a>
                    </li >

                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b9;</i>
                    <cite>用户管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="/admin/User/agent_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>一级代理</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/admin/User/under_agent_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>二级代理</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/admin/User/user_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>会员列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/admin/User/bank_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>银行卡列表</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b9;</i>
                    <cite>订单记录</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="/admin/Order/order_list?start=<?php echo htmlentities($mytime); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>平仓记录</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/admin/Order/keep_order_list?start=<?php echo htmlentities($mytime); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>持仓记录</cite>
                        </a>
                    </li >

                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b9;</i>
                    <cite>资金记录</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="/admin/Money/recharge_list?start=<?php echo htmlentities($mytime); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>自动充值记录</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/admin/Money/agent_withdraw_list?start=<?php echo htmlentities($mytime); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>代理提现记录</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/admin/Money/user_withdraw_list?start=<?php echo htmlentities($mytime); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>会员提现记录</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/admin/Money/agent_money_list?start=<?php echo htmlentities($mytime); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>代理资金记录</cite>
                        </a>
                    </li >

                    <li>
                        <a _href="/admin/Money/user_money_list?start=<?php echo htmlentities($mytime); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>会员资金记录</cite>
                        </a>
                    </li >
                </ul>
            </li>

            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b9;</i>
                    <cite>申购币管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="/admin/Coin/coin_list">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>申购币列表</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/admin/Coin/user_apply_coin">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>申购币持有记录</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/admin/Coin/apply_coin_order_log?start=<?php echo htmlentities($mytime); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>申购币购买记录</cite>
                        </a>
                    </li >
                    <li>
                        <a _href="/admin/Coin/apply_coin_give_log?start=<?php echo htmlentities($mytime); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>申购币赠送记录</cite>
                        </a>
                    </li >
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b9;</i>
                    <cite>日志管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                    <a _href="/admin/Log/user_log?start=<?php echo htmlentities($mytime); ?>">
                    <i class="iconfont">&#xe6a7;</i>
                    <cite>会员日志</cite>
                    </a>
                    </li >
                    <li>
                    <a _href="/admin/Log/agent_log?start=<?php echo htmlentities($mytime); ?>">
                    <i class="iconfont">&#xe6a7;</i>
                    <cite>代理日志</cite>
                    </a>
                    </li >
                    <li>
                        <a _href="/admin/Log/admin_log?start=<?php echo htmlentities($mytime); ?>">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>平台日志</cite>
                        </a>
                    </li >

                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b9;</i>
                    <cite>系统设置</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="/admin/System/index">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>系统设置</cite>
                        </a>
                    </li >
                </ul>
            </li>
</ul>

</div>
</div>
<!-- <div class="x-slide_left"></div> -->
<!-- 左侧菜单结束 -->
<!-- 右侧主体开始 -->
<div class="page-content">
    <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
        <ul class="layui-tab-title">
            <li class="home"><i class="layui-icon">&#xe68e;</i>首页</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <iframe src='/admin/Index/main' frameborder="0" scrolling="yes" class="x-iframe"></iframe>
            </div>
        </div>
    </div>
</div>
<div class="page-content-bg"></div>
<!-- 右侧主体结束 -->
<!-- 中部结束 -->
<!-- 底部开始 -->
<div class="footer">
    <div class="copyright">Copyright ©2018 内部学习系统 v1.3 All Rights Reserved</div>
</div>
<!-- 底部结束 -->
</body>
</html>