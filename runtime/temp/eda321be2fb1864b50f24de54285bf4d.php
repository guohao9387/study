<?php /*a:1:{s:57:"/home/wwwroot/study/application/admin/view/user/code.html";i:1562806576;}*/ ?>
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
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=1.3"></script>

</head>

<body>
<div class="x-body">
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>邀请码:<?php echo htmlentities($invite_number); ?></legend>
    </fieldset>

    <div style="padding: 20px; background-color: #F2F2F2;">
        <div class="layui-row layui-col-space15">

            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body">
                        <img src="<?php echo htmlentities($path); ?>" alt=""/>
                    </div>
                    <div class="layui-card-header" style="text-indent:60px;">
                        <a href="/admin/User/down?name=<?php echo htmlentities($name); ?>&path=<?php echo htmlentities($path); ?>"><b>点击下载到本地</b></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="padding: 20px; background-color: #F2F2F2;">
        <div class="layui-row layui-col-space15">

            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-header">
                        邀请地址
                    </div>
                    <div class="layui-card-body">
                        <?php echo htmlentities($url); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
