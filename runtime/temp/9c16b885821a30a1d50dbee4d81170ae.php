<?php /*a:1:{s:59:"/home/wwwroot/study/application/index/view/index/index.html";i:1563599450;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>aioq.cn艾比特数字资产价值兑换交易平台_区块链服务平台【艾比特】</title>
    <meta name="Keywords" content="aioq.cn艾比特数字资产价值兑换交易平台_区块链服务平台">
    <meta name="Description" content="aioq.cn艾比特交易平台是数字资产价值兑换交易平台，坚持为数字资产交易者提供，专业、安全、快捷的交易服务。">
    <meta name="author" content="aioq.cn">
    <meta name="coprright" content="aioq.cn">
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link rel="stylesheet" href="/static/index/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/static/index/css/style.css" id="theme"/>
    <link rel="stylesheet" href="/static/index/css/slider.css"/>
    <link rel="stylesheet" href="/static/index/css/common.css"/>
    <script type="text/javascript" src="/static/index/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="/static/layer/layer.js"></script>
    <script type="text/javascript" src="/static/index/js/slider.js"></script>
<style>
    /*.slider-body a img{*/
    /*    width: 100%;*/
    /*}*/
</style>
</head>
<body lang="zh-CN">
<!--[if lt IE 10]>
<div id="kie-bar" class="kie-bar ">
    您现在使用的浏览器版本过低，可能会导致浏览效果和信息的缺失。 建议立即升级到
    <a href="http://rj.baidu.com/soft/detail/14917.html" target="_blank" title="免费升级至IE8浏览器">IE 10+</a> 或
    <a href="http://rj.baidu.com/soft/detail/14744.html" target="_blank" title="免费升级至360安全浏览器">谷歌浏览器</a> 或
    <a href="http://rj.baidu.com/soft/detail/17451.html" target="_blank" title="免费升级至360安全浏览器">360安全浏览器</a> ，安全更放心！
</div><![endif]-->
<div id="mollymobi_header" style="z-index: 999;min-width: 1200px;width:100%;">
    <div class="header">
        <div class="header-content">
            <ul class="trade-status">

                <li style="padding: 0px 10px 0px 0px;">
                    <i class="fa fa-home fa-lg left move mr5"></i>
                    <span>欢迎来到aioq.cn艾比特数字资产价值兑换交易平台-区块链服务平台</span>
                </li>
            </ul>
            <ul class="user-status">

                <?php if($username==0): ?>
                <li>
                    <i class="fa fa-user left move fz_16"></i>
                    <a href="/index/Login/register" class="ma-l move"> 注册</a>
                </li>
                <li>
                    <a href="/index/Login/login" class="darker" style="color:#4f94e7">登录</a>
                </li>
                <?php else: ?>
                <li>
                    <i class="fa fa-user left move fz_16"></i>
                    <a href="/index/User/index" class="ma-l move"> <?php echo htmlentities($username); ?></a>
                </li>

                <li>
                    <a href="/index/Login/logout" class="darker" style="color:#4f94e7">安全退出</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<div class="common-nav">
    <div class="nav-bar">
        <div class="logo" style="margin-top: 12px;">
            <a href="/index/Index/index" class="xiaozhu-logo">
                <img src="/static/index/images/ABT.png" alt="" style="width: 50%;"/>
            </a>
        </div>
        <div class="nav-content">
            <ul class="common-nav-list">
                <li>
                    <a href="/index/Index/index">首页</a>
                </li>
                <li>
                    <a href="/index/Trade/index">交易中心
                    </a>
                </li>
                <li>
                    <a href="/index/Coin/index">申购币</a>
                </li>
                <li>
                    <a href="/index/Notice/index">公告中心</a>
                </li>
                <li>
                    <a href="/index/Notice/help">帮助中心</a>
                </li>
                <li>
                    <a href="/index/Notice/about_us">关于我们</a>
                </li>
                <li>
                    <a href="/index/User/index">个人中心</a>
                </li>

            </ul>
        </div>
    </div>
</div>

<!-- top 结束  -->
<link rel="stylesheet" href="/static/index/css/index.css"/>
<div class="banner-box">
    <div class="banner-tag-box">
        <div class="banner-tag visitor-banner-tag">
            <ul class="clearfix">
                <li class="float-r">
                </li>
            </ul>
            <div class="topest-profit">
                <strong> 1亿</strong><br><br> 全站24H累计交易量
            </div>
            <a href="/index/Login/register" class="red-link-btn" target="_blank">
                <i class="fa fa-cny index-reg-ico"></i> 立即注册</a>
            <a href="/index/Login/login" class="login-now"> 立即登录</a>
        </div>
    </div>

    <div id="slider_index"
         class="slider" style="height:400px;">
        <div class="slider-loading" data-u="loading">
            <div class="slider-loading-a"></div>
            <div class="slider-loading-b"></div>
        </div>
        <div class="slider-body" data-u="slides">

            <?php if(is_array($adv) || $adv instanceof \think\Collection || $adv instanceof \think\Paginator): $i = 0; $__LIST__ = $adv;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
            <div onclick="window.location.href='<?php echo htmlentities($val['url']); ?>'">
                <a><img data-u="image" title="" alt="" src="<?php echo htmlentities($val['image']); ?>"/>
                </a>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>

        <div id="slider-body-navigator_index"
             class="sbn-3" data-u="navigator" style="position: absolute;
        bottom: 16px;" data-autocenter="1">
            <div data-u="prototype" style=""></div>
        </div>
        <span id="slider-body-arrow-l_index" data-u="arrowleft"
              class="slider-body-arrowleft-1" data-autocenter="2"></span>
        <span id="slider-body-arrow-r_index" data-u="arrowright"
              class="slider-body-arrowright-1" data-autocenter="2"></span>
    </div>

</div>
<script>
    slider_run("slider_index", [{
        "$Duration": 1200,
        "x": 0.3,
        "$SlideOut": true,
        "$Easing": {},
        "$Opacity": 2
    }]);
</script>
<div class="tradeBox hg40" style=" width: 1200px;margin: 0 auto;   background: #FFF;">
    <div class="slideHd hg40" style="width: 1200px;margin: 0 auto;background: #FFF;">
        <ul class="active hg40  trade_qu_list" style="height: 40px;line-height: 40px;">

            <li class="trade_moshi trade_qu_pai current">
                <a> USDT交易区 </a>
            </li>
        </ul>
    </div>
</div>
<div class="price_today">
    <div class="autobox">
        <ul class="price_today_ull">
            <li data-sort="0" style="cursor: default;">交易市场</li>
            <li class="click-sort" data-sort="1" data-flaglist="0" data-toggle="0">最新成交价 <i
                    class="cagret cagret-down"></i> <i class="cagret cagret-up"></i>
            </li>
            <li class="click-sort" data-sort="2" data-flaglist="0" data-toggle="0">买一价 <i
                    class="cagret cagret-down"></i> <i class="cagret cagret-up"></i>
            </li>
            <li class="click-sort" data-sort="3" data-flaglist="0" data-toggle="0">卖一价 <i
                    class="cagret cagret-down"></i> <i class="cagret cagret-up"></i>
            </li>
            <li class="click-sort" data-sort="6" data-flaglist="0" data-toggle="0">24H成交量 <i
                    class="cagret cagret-down"></i> <i class="cagret cagret-up"></i>
            </li>
            <li class="click-sort" data-sort="4" data-flaglist="0" data-toggle="0">24H成交额
                <i class="cagret cagret-down"></i> <i class="cagret cagret-up"></i>
            </li>
            <li data-sort="0" style="width: 150px; text-align: center; text-indent: 0.5em;">操作</li>
        </ul>
    </div>
</div>
<ul class="price_today_ul" id="price_today_ul" style="margin: 0px auto;width: 1200px;background: #FFF;box-shadow: 2px 2px 4px #D7DAE0;">
    <?php if(is_array($product) || $product instanceof \think\Collection || $product instanceof \think\Paginator): $i = 0; $__LIST__ = $product;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
    <li>
        <dl class="autobox clear">
            <dt>
                <a href="/index/Trade/index">
                    <img src="<?php echo htmlentities($val['image']); ?>" style="vertical-align: middle;margin-right: 5px;width: 19px;margin-left: 12px;">
                    <?php echo htmlentities($val['name']); ?>
                </a>
            </dt>
            <dd class="orange" style="text-indent: 1.6em;" id="<?php echo htmlentities($val['abbreviation']); ?>">0</dd>
            <dd style="text-indent: 1.6rem;">0</dd>
            <dd style="text-indent: 1.6rem;">0</dd>
            <dd class="w142" style="    text-indent: 1.6rem;">0</dd>
            <dd class="w142" style="    text-indent: 2.5rem;">0</dd>
            <dd class="w102" style="width:150px;text-align: center;text-indent: 0.5em;"><input type="button" value="去交易" class="btns2" onclick="top.location='/index/Trade/index'"></dd>
        </dl>
    </li>
    <?php endforeach; endif; else: echo "" ;endif; ?>
</ul>


<div class="index_news mt20 index_news1" style="    padding-bottom: 0px;">
    <div style="padding: 20px 20px;border-color: #FFD0B7;">
        <p>
            <span style="color: rgb(227, 108, 9);">
            <span style="font-size: 16px;">风险提示&nbsp;</span>
            数字货币交易具有极高的风险（预挖、暴涨暴跌、庄家操控、团队解散、技术缺陷等），据国家五部委《关于防范比特币风险的通知》，aioq.cn艾比特交易平台仅为数字货币的爱好者提供一个自由的网上交换平台，对币的投资价值不承担任何审查、担保、赔偿的责任，如果您不能接受，请不要进行交易！</span>
        </p>
    </div>
</div>
<div class="tag-box">
    <div class="hotest-tag-list tag-list-transfer">
        <div class="safety_tips">
            <h3 style="font-weight:bold">专业的安全保障</h3>
            <div class="autobox">
                <ul class="safety_tips_ul clear">
                    <li id="li1">
                        <img id="img1" src="/static/index/images/safe_1.jpg" alt="" width="70" height="70"/>
                        <h4>系统可靠</h4>
                        <p>银行级用户数据加密、动态身份验证，多级风险识别控制，保障交易安全</p>
                    </li>
                    <li id="li2">
                        <img id="img2" src="/static/index/images/safe_2.jpg" alt="" width="70" height="70"/>
                        <h4>资金安全</h4>
                        <p>钱包多层加密，离线存储于银行保险柜，资金第三方托管，确保安全</p>
                    </li>
                    <li id="li3">
                        <img id="img3" src="/static/index/images/safe_3.jpg" alt="" width="70" height="70"/>
                        <h4>快捷方便</h4>
                        <p>充值即时、提现迅速，每秒万单的高性能交易引擎，保证一切快捷方便</p>
                    </li>
                    <li id="li4">
                        <img id="img4" src="/static/index/images/safe_4.jpg" alt="" width="70" height="70"/>
                        <h4>服务专业</h4>
                        <p>专业的客服团队，邮件回复和24小时在线QQ，VIP一对一专业服务</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="index_news mt20">
    <div class="index_media ml35 mt20">
        <ul class="index_media_ul index_media_me">
            <li class="index_media_li active">行业资讯</li>
            <li class="index_media_li1">
                <a href="/index/Notice/news" target="_blank">更多+</a></li>
        </ul>
        <div class="index_media_con">
            <div class="index_media_tab">
                <ul class="index_media_ul1">
                    <?php if(is_array($news_list) || $news_list instanceof \think\Collection || $news_list instanceof \think\Paginator): $i = 0; $__LIST__ = $news_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                    <li class="index_media_li7"><i class="index_media_gt">&gt;</i>
                        <a href="/index/Notice/news_info?id=<?php echo htmlentities($val['id']); ?>" target="_blank" class="index_media_a"><?php echo htmlentities($val['title']); ?></a>
                        <label><?php echo htmlentities(substr($val['add_time'],0,10)); ?></label>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="index_media index_media1 ml35 mt20">
        <ul class="index_media_ul index_media_ul2">
            <li class="index_media_li active">官方公告</li>
            <li class="index_media_li1 index_media_li3">
                <a href="/index/Notice/index" target="_blank">更多+</a>
            </li>
        </ul>
        <div class="index_media_con1">
            <div class="index_media_tab index_media_tab1 " style="width: 420px;">

                <ul class="index_media_ul1 index_media_ul3">
                    <?php if(is_array($notice_list) || $notice_list instanceof \think\Collection || $notice_list instanceof \think\Paginator): $i = 0; $__LIST__ = $notice_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>

                    <li class="index_media_li4"><i class="index_media_gt">&gt;</i>
                        <a href="/index/Notice/notice_info?id=<?php echo htmlentities($val['id']); ?>" target="_blank" class="index_media_a index_media_a1"><?php echo htmlentities($val['title']); ?></a>
                    </li>
                    <li class="index_media_li5"><label><?php echo htmlentities(substr($val['add_time'],0,10)); ?></label></li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>

                </ul>

            </div>
        </div>
    </div>

    <style>
        #links ul {
            height: 42px;
            padding-top: 11px;
            overflow: hidden;
            width: 100%;
            min-width: 1200px;
        }

        #links li {
            float: left;
            width: 90px;
            margin: 0 10px;
            display: inline;
        }

        #links img {
            display: block;
            width: 90px;
            height: 32px;
            overflow: hidden;
        }

        #links a:hover img {
            opacity: 0.8;
            filter: alpha(opacity=80);
        }
    </style>


    <div class="index_news mt20 index_news1 " style="    margin-bottom: -20px;">
        <ul class="index_media_ul index_media_ul4 ml35">
            <li class="index_media_li active">合作伙伴</li>
        </ul>

        <div class="content links">
            <div class="links_list">
                <div id="links">
                    <ul id="slideContainer" class="slideContainer">
                        <li>
                            <a href="javascript:" alt="" title="" target="_blank">
                                <img src="/static/index/upload/link/5a8e6cc0e6558.png">
                            </a>
                        </li>
                        <li>
                            <a href="javascript:" alt="巴比特资讯" title="巴比特资讯" target="_blank">
                                <img src="/static/index/upload/link/594111dd89501.png">
                            </a>
                        </li>
                        <li>
                            <a href="javascript:" alt="币久网" title="币久网" target="_blank">
                                <img src="/static/index/upload/link/594111357dde6.png">
                            </a>
                        </li>
                        <li>
                            <a href="javascript:" alt="元宝网" title="元宝网" target="_blank">
                                <img src="/static/index/upload/link/5941105dbeb7f.png">
                            </a>
                        </li>
                        <li>
                            <a href="javascript:" alt="比特币之家" title="比特币之家" target="_blank">
                                <img src="/static/index/upload/link/5941100cd1cac.png">
                            </a>
                        </li>
                        <li>
                            <a href="javascript:" alt="比特币中国" title="比特币中国" target="_blank">
                                <img src="/static/index/upload/link/59410f69cdfa3.png">
                            </a>
                        </li>
                        <li>
                            <a href="javascript:" alt="中国比特币" title="中国比特币" target="_blank">
                                <img src="/static/index/upload/link/59410f19cdfa3.png">
                            </a>
                        </li>
                        <li>
                            <a href="javascript:" tppabs="https://bter.com/" alt="比特儿" title="比特儿" target="_blank">
                                <img src="/static/index/upload/link/59410ecc5f59e.png">
                            </a>
                        </li>
                        <li>
                            <a href="javascript:" alt="聚币网" title="聚币网" target="_blank">
                                <img src="/static/index/upload/link/59410e79f41fd.png">
                            </a>
                        </li>
                        <li>
                            <a href="javascript:" alt="比特币咨讯网" title="比特币咨讯网" target="_blank">
                                <img src="/static/index/upload/link/59410e227a0dd.png">
                            </a>
                        </li>
                        <li>
                            <a href="javascript:" alt="sosobtc" title="sosobtc" target="_blank">
                                <img src="/static/index/upload/link/5941179826217.png">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <div class="clear">
    </div>

    <style>

        .sidetool li span {
            position: absolute;
            right: 40px;
            top: 0;
            text-align: center;
            overflow: hidden;
            visibility: hidden;
            width: 0px;
            height: 40px;
            background: #ff6709;
            line-height: 40px;
            color: #fff;
            transition: width .25s ease-in-out .1s;
        }

        .sidetool li:hover span {
            box-sizing: border-box;
            width: 120px;
            visibility: visible;
        }

        .sidetool li span.sqrcode i {
            display: block;
            visibility: hidden;
            opacity: 0;
            transition: all .3s ease-in 0;
            position: absolute;
            bottom: -5px;
            font-style: normal;
            font-size: 12px;
            width: 100%;
            text-align: center;
        }

        .sidetool li:hover span.sqrcode i {
            opacity: 1;
            visibility: visible;
        }

        .sidetool li:hover span.sqrcode {
            width: 120px;
            height: 140px;
            padding: 12px 0;
        }

        .sidetool ul > li {
            box-shadow: 0 0 5px rgba(0, 0, 0, .12);
            margin: 1px 0;
            position: relative;
            padding-top: 10%;
            width: 40px;
            height: 40px;
            background-color: #fff;
            box-sizing: border-box;
        }

        .sidetool ul > li:hover {
            background-color: #ff6709;
        }

        .sidetool ul > li > a {
            box-sizing: border-box;
            display: inline-block;
            width: 100%;
            height: 100%;
        }

        .sidetool .sidetool-item {
            margin: 5px auto;
            width: 52%;
            transition: all .3s ease-in 0s;
            height: 60%;
            display: block;
            background: url("/static/index/images/sidebar.png") no-repeat;
            background-position: 0 0;
        }

        .sidetool .sidetool-item.qq {
            background-position: 0 0;
        }

        .sidetool .sidetool-item.mobile {
            background-position: 0 -169px;
        }

        .sidetool ul > li:hover .sidetool-item.mobile {
            background-position: 0 -194px;
        }

        .sidetool ul > li:hover .sidetool-item.qq {
            background-position: 0 -24px;
        }

        .sidetool .sidetool-item.wechat {
            background-position: 0 -127px;
        }

        .sidetool ul > li:hover .sidetool-item.wechat {
            background-position: 0 -147px;
        }

        .sidetool .sidetool-item.tel {
            background-position: 0 -87px;
        }

        .sidetool ul > li:hover .sidetool-item.tel {
            background-position: 0 -107px;
        }

        .sidetool .sidetool-item.qrc {
            background-position: 0 -48px;
        }

        .sidetool ul > li:hover .sidetool-item.qrc {
            background-position: 0 -68px;
        }

        .jubi-lts-an:hover p {
            color: #fff;
        }

        .jubi-lts-an P {
            font-size: 14px;
            color: #eb5200;
            width: 19px;
            text-align: center;
            margin: 0px auto;
            line-height: 15px;
        }

    </style>

    <div id="kf1" class="sidetool hidden-xs">
        <ul>
            <li>
                <a href="javascript:" target="_blank"><i class="sidetool-item qq"></i></a>
                <span style="cursor:pointer;"
                      onclick="javascript:window.open('http://wpa.qq.com/msgrd?v=3&uin=<?php echo htmlentities($kefu['qq']); ?>&site=qq&menu=yes');">QQ在线客服</span>
            </li>
            <li>
                <a href="#" onclick="javascript:return false;"><i class="sidetool-item wechat"></i></a>
                <span class="sqrcode"><img src="<?php echo htmlentities($kefu['weixin']); ?>" width="100"
                                           alt=""/><i>微信客服</i></span>
            </li>
            <li>
                <a href="#" onclick="javascript:return false;"><i class="sidetool-item mobile"></i></a>
                <span class="sqrcode"><img width="100" style="background-color: #fff;"
                                           src="<?php echo htmlentities($kefu['phone']); ?>" alt=""/><i>访问手机版</i></span>
            </li>
            <li><a href=""><i class="sidetool-item tel"></i></a><span>010-56267773</span></li>
        </ul>
    </div>
</div>
<div class="boxs mt40" style="padding-top: 100px;">
    <footer id="footer" class="footer">
        <section class="main">
            <div class="about_me">
                <div class="wx">
                    <a href="javascript:" class="footer_wx_icon">
                        <img src="/static/index/images/ABT.png"/>
                    </a>
                </div>
            </div>
            <div class="layout_center">


                <div class="list">
                    <label>关于我们</label>
                    <ul>
                        <?php if(is_array($about_us_list) || $about_us_list instanceof \think\Collection || $about_us_list instanceof \think\Paginator): $i = 0; $__LIST__ = $about_us_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                        <li><a href="/index/Notice/about_us_info?id=<?php echo htmlentities($val['id']); ?>" style="overflow: hidden;"><?php echo htmlentities($val['title']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <li><a href="/index/Notice/about_us" style="overflow: hidden;text-align: left;">更多</a></li>
                    </ul>
                </div>
                <div class="list">
                    <label>帮助中心</label>
                    <ul>
                        <?php if(is_array($help_list) || $help_list instanceof \think\Collection || $help_list instanceof \think\Paginator): $i = 0; $__LIST__ = $help_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                        <li><a href="/index/Notice/help_info?id=<?php echo htmlentities($val['id']); ?>" style="overflow: hidden;"><?php echo htmlentities($val['title']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <li><a href="/index/Notice/help" style="overflow: hidden;text-align: left;">更多</a></li>
                    </ul>
                </div>
                <div class="list"><label>下载中心</label>
                    <ul>
                        <?php if(is_array($download_list) || $download_list instanceof \think\Collection || $download_list instanceof \think\Paginator): $i = 0; $__LIST__ = $download_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                        <li><a href="/index/Notice/download_info?id=<?php echo htmlentities($val['id']); ?>" style="overflow: hidden;"><?php echo htmlentities($val['title']); ?></a></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                        <li><a href="/index/Notice/download" style="overflow: hidden;    text-align: left;">更多</a>
                        </li>
                    </ul>
                </div>

                <div class="contact_us">
                    <div class="contact_us_text0" style="text-align: left;">24小时值班QQ :</div>
                    <div class="contact_us_text1" style="text-align: left;margin-top: 10px;margin-bottom: 12px;">
                        <?php echo htmlentities($kefu['qq']); ?>
                    </div>
                    <div class="contact_us_text2" style="text-align: left;margin-bottom: 5px;">
                        工作日:9:00-19:00
                    </div>
                    <div class="contact_us_text2" style="text-align: left;margin-bottom: 5px;">
                        节假日:9:00-18:00
                    </div>
                    <!--<div>-->
                        <!--<a href="#" class="contact_us_text3"><span>会员群号 :1群：</span></a>-->
                    <!--</div>-->
                </div>
            </div>
        </section>
    </footer>
    <div class="footer_bottom">

        <div style="margin-bottom: 5px;width:1200px;margin:0 auto;">
            <span class="text-danger">风险提示：比特币等数字资产交易具有极高的风险（预挖、暴涨暴跌、庄家操控、团队解散、技术缺陷等），据国家五部委《关于防范比特币风险的通知》，aioq.cn艾比特网仅为数字资产的爱好者提供一个自由的网上交换平台，对币的投资价值不承担任何审查、担保、赔偿的责任，您需要完全对自己的投资损失承担责任，如果您不能接受，请不要进行交易！谢谢！</span>
        </div>

        <div class="autobox" style="height: 40px;margin-top: 5px;">
			<span style="display: inline-block;color:#A6A9AB;">
			(c)2016-2018 aioq.cn艾比特数字资产价值兑换交易平台 All Rights Reserved &nbsp;&nbsp;&nbsp;&nbsp;
                <!--<a href="javascript:"         target="_blank">京ICP备11046674号</a>-->
			</span>

            <span style="float: right;">
			<a href="javascript:" target="_blank" class="margin10" style="margin-left:5px;"> <img
                    src="/static/index/upload/footer/footer_1.png">
            </a>
			<a href="javascript:" target="_blank" class="margin10" style="margin-left:5px;"> <img
                    src="/static/index/upload/footer/footer_2.png"> </a>
			<a href="javascript:" target="_blank" class="margin10" style="margin-left:5px;"><img
                    src="/static/index/upload/footer/footer_3.png"> </a>
			<a href="javascript:" target="_blank" class="margin10" style="margin-left:5px;"><img
                    src="/static/index/upload/footer/footer_4.png"> </a>
		</span>
        </div>
    </div>
</div>

</body>

</html>

<script type="text/javascript">
    var ws = new WebSocket("ws://47.90.122.200:8080/ws?uid=2");

    ws.onopen = function()
    {
        // Web Socket 已连接上，使用 send() 方法发送数据
        //ws.send("发送数据");
    };

    ws.onmessage = function (evt)
    {
        //console.log(evt.data);
        var data=JSON.parse(evt.data);
        $.each(data,function(k,v){
            var id='#'+k;
            var last_price=$(id).html();
            var now_price=v['USD'];
            if(now_price>=last_price){
                $(id).attr("style","color:red;");
            }else{
                $(id).attr("style","color:green;");
            }
            $(id).html(v['USD']);
        })
    };
</script>