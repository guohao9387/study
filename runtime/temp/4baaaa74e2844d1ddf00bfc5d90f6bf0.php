<?php /*a:1:{s:68:"/home/wwwroot/study/application/admin/view/coin/user_apply_coin.html";i:1562751629;}*/ ?>
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
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">申购币管理</a>
        <a>
          <cite>申购币持有记录</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so">
            <div class="layui-input-inline">
                <select name="apply_coin_id">
                    <option value="">申购币种类</option>
                    <?php foreach($coin_list as $val): ?>
                    <option value="<?php echo htmlentities($val['id']); ?>" <?php if(input('get.apply_coin_id') == $val['id']): ?> selected="selected"<?php endif; ?>><?php echo htmlentities($val['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input type="text" name="username"  placeholder="会员账号" autocomplete="off" class="layui-input" value="<?php echo input('get.username'); ?>">
            <div class="layui-input-inline">
                <select name="page_number">
                    <option value="">当页数量</option>
                    <?php if(is_array($page_number) || $page_number instanceof \think\Collection || $page_number instanceof \think\Paginator): $i = 0; $__LIST__ = $page_number;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                    <option <?php if(input('get.page_number') == $val['num']): ?> selected="selected"<?php endif; ?> value="<?php echo htmlentities($val['num']); ?>"><?php echo htmlentities($val['num']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
            <button class="layui-btn"  lay-submit="" lay-filter="sreach">查询</button>
            <a href="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>"  class="layui-btn layui-btn-normal">重置</a>
            <a href="<?php echo url('admin/Api/excel_user_apply_coin',input('get.')); ?>"  class="layui-btn" style="background-color: #337AB7">导出</a>

        </form>
      </div>
      <xblock>
          <span class="x-right" style="line-height:40px">合计数量：<?php echo htmlentities($count); ?>个</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>币种</th>
            <th>会员</th>
            <th>数量</th>
            <th >操作</th>
            </tr>
        </thead>
        <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
            <tr>
                 <td><?php echo htmlentities($val['apply_coin_name']); ?></td>
                <td><?php echo htmlentities($val['username']); ?></td>
                <td><?php echo htmlentities($val['amount']); ?></td>
                <td class="td-manage">
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

        
    </script>
  </body>
</html>