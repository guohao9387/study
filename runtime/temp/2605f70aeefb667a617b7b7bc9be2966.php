<?php /*a:1:{s:58:"/home/wwwroot/study/application/admin/view/index/main.html";i:1562835044;}*/ ?>
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

    </head>
    <body>
    <div class="x-body layui-anim layui-anim-up">
        <blockquote class="layui-elem-quote">欢迎管理员：
            <span class="x-red"><?php echo htmlentities($nickname); ?></span>！当前时间:<?php echo date('Y-m-d H:i:s',time()); ?></blockquote>
        <fieldset class="layui-elem-field">
            <legend>存量查询</legend>
            <div class="layui-field-box">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body">
                            <div class="layui-carousel x-admin-carousel x-admin-backlog" lay-anim="" lay-indicator="inside" lay-arrow="none" style="width: 100%; height: 90px;">
                                <div carousel-item="">
                                    <ul class="layui-row layui-col-space10 layui-this">
                                        <li class="layui-col-xs2">
                                            <a onclick="x_admin_show('会员列表','/admin/User/user_list')" class="x-admin-backlog-body">
                                                <h3>会员数</h3>
                                                <p>
                                                    <cite><?php echo htmlentities($param['count_user']); ?></cite></p>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs2">
                                            <a onclick="x_admin_show('代理列表','/admin/User/agent_list?param=1')"  class="x-admin-backlog-body">
                                                <h3>代理数</h3>
                                                <p>
                                                    <cite><?php echo htmlentities($param['count_agent']); ?></cite></p>
                                            </a>
                                        </li>

                                        <li class="layui-col-xs2">
                                            <a onclick="x_admin_show('自动充值记录','/admin/Money/recharge_list?start=<?php echo htmlentities($mytime); ?>')" class="x-admin-backlog-body">
                                                <h3>充值金额</h3>
                                                <p>
                                                    <cite><?php echo htmlentities(number_format($param['sum_recharge'],2,'.','')); ?></cite></p>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs2">
                                            <a  onclick="x_admin_show('会员提现记录','/admin/Money/user_withdraw_list?start=<?php echo htmlentities($mytime); ?>')" class="x-admin-backlog-body">
                                                <h3>会员提现</h3>
                                                <p>
                                                    <cite><?php echo htmlentities(number_format($param['sum_user_withdraw'],2,'.','')); ?></cite></p>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs2">
                                            <a onclick="x_admin_show('代理提现记录','/admin/Money/agent_withdraw_list?start=<?php echo htmlentities($mytime); ?>')" class="x-admin-backlog-body">
                                                <h3>代理提现</h3>
                                                <p>
                                                    <cite><?php echo htmlentities(number_format($param['sum_agent_withdraw'],2,'.','')); ?></cite></p>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs2">
                                            <a onclick="x_admin_show('下注记录','/admin/Order/order_list?start=<?php echo htmlentities($mytime); ?>')"  class="x-admin-backlog-body">
                                                <h3>平台抽水</h3>
                                                <p>
                                                    <cite><?php echo htmlentities(number_format($param['sum_order_fee'],2,'.','')); ?></cite></p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="layui-carousel x-admin-carousel x-admin-backlog" lay-anim="" lay-indicator="inside" lay-arrow="none" style="width: 100%; height: 90px;">
                                <div carousel-item="">
                                    <ul class="layui-row layui-col-space10 layui-this">
                                        <li class="layui-col-xs2">
                                            <a onclick="javascript:;" class="x-admin-backlog-body">
                                                <h3>总输赢</h3>
                                                <p>
                                                    <cite><?php echo htmlentities(number_format($param['order_gain'],2,'.','')); ?></cite>
                                                </p>
                                            </a>
                                        </li>
                                        <li class="layui-col-xs2">
                                            <a onclick="javascript:;" class="x-admin-backlog-body">
                                                <h3>今输赢</h3>
                                                <p>
                                                    <cite><?php echo htmlentities(number_format($param['today_order_gain'],2,'.','')); ?></cite>
                                                </p>
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
            <legend>增量查询</legend>
            <div class="layui-field-box">
                <table class="layui-table">
                    <tbody>
                        <tr>
                            <th>名称</th>
                            <td>昨天</td>
                            <td>今天</td>
                            <td>本月</td>
                        </tr>
                        <tr>
                            <th>会员数</th>
                            <td><?php echo htmlentities($param['yesterday_new_user']); ?></td>
                            <td><?php echo htmlentities($param['today_new_user']); ?></td>
                            <td><?php echo htmlentities($param['month_new_user']); ?></td>
                        </tr>
                        <tr>
                            <th>代理数</th>
                            <td><?php echo htmlentities($param['yesterday_new_agent']); ?></td>
                            <td><?php echo htmlentities($param['today_new_agent']); ?></td>
                            <td><?php echo htmlentities($param['month_new_agent']); ?></td>
                        </tr>
                        <tr>
                            <th>自动充值</th>
                            <td><?php echo htmlentities($param['yesterday_new_recharge']); ?></td>
                            <td><?php echo htmlentities($param['today_new_recharge']); ?></td>
                            <td><?php echo htmlentities($param['month_new_recharge']); ?></td>
                        </tr>
                        <tr>
                            <th>会员提现</th>
                            <td><?php echo htmlentities($param['yesterday_new_user_withdraw']); ?></td>
                            <td><?php echo htmlentities($param['today_new_user_withdraw']); ?></td>
                            <td><?php echo htmlentities($param['month_new_user_withdraw']); ?></td>
                        </tr>
                        <tr>
                            <th>代理提现</th>
                            <td><?php echo htmlentities($param['yesterday_new_agent_withdraw']); ?></td>
                            <td><?php echo htmlentities($param['today_new_agent_withdraw']); ?></td>
                            <td><?php echo htmlentities($param['month_new_agent_withdraw']); ?></td>
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
                    <?php if(is_array($param['notice']) || $param['notice'] instanceof \think\Collection || $param['notice'] instanceof \think\Paginator): $i = 0; $__LIST__ = $param['notice'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td >
                            <a class="x-a" href="/admin/Index/notice?id=<?php echo htmlentities($val['id']); ?>" target="_blank"><?php echo htmlentities(str_notice_type($val['type'])); ?>||<?php echo htmlentities($val['title']); ?>||<?php echo htmlentities($val['add_time']); ?></a>
                        </td>
                    </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>
        </fieldset>
        <fieldset class="layui-elem-field">
            <legend>开发团队</legend>
            <div class="layui-field-box">
                <table class="layui-table">
                    <tbody>
                        <tr>
                            <th>版权所有</th>
                            <td>内部学习系统
                                <!--<a href="" class='x-a' target="_blank">访问官网</a>-->
                            </td>
                        </tr>
                        <tr>
                            <th>开发者</th>
                            <td>内部学习系统技术部</td></tr>
                    </tbody>
                </table>
            </div>
        </fieldset>
        <blockquote class="layui-elem-quote layui-quote-nm">本系统由内部学习系统提供技术支持。</blockquote>
    </div>
    </body>
</html>