<?php /*a:1:{s:65:"/home/wwwroot/study/application/agent/view/withdraw/withdraw.html";i:1562901408;}*/ ?>
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
<div class="x-body">
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>发起提现</legend>
    </fieldset>

    <div style="padding: 20px; background-color: #F2F2F2;">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md6">
                <div class="layui-card">
                    <div class="layui-card-header">可用余额:<?php echo htmlentities(number_format($money,2,".","")); ?></div>
                </div>
            </div>
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body">
                        <form class="layui-form">

                            <div class="layui-form-item">
                                <label for="money" class="layui-form-label">
                                    金额
                                </label>
                                <div class="layui-input-inline">
                                    <input type="number" id="money" name="money" required="" lay-verify="number|money" autocomplete="off" class="layui-input" >
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label for="bank_info_id" class="layui-form-label">
                                            银行卡信息
                                </label>
                                <div class="layui-input-inline" style="width: 50%;">
                                    <select id="bank_info_id" name="bank_info_id" class="valid" lay-verify="bank_info_id">
                                        <option  value="0">请选择银行卡信息</option>
                                        <?php if(is_array($bank_info_list) || $bank_info_list instanceof \think\Collection || $bank_info_list instanceof \think\Paginator): $i = 0; $__LIST__ = $bank_info_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
                                        <option  value="<?php echo htmlentities($val['id']); ?>"><?php echo htmlentities($val['bank_name']); ?>—<?php echo htmlentities(dataDesensitization($val['bank_card'],4,8)); ?></option>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">
                                </label>
                                <button  class="layui-btn" lay-filter="add" lay-submit="">
                                    确认
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="layui-card-body">
                        <p>1.提现必须选择已绑定的银行卡。</p>
                        <p>2. 如有疑问请联系客服</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>

    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
                ,layer = layui.layer;

        //自定义验证规则
        form.verify({
           money: function(value){
                if(value== ''||value== null){
                    return '请输入提现金额';
                }
                if(value<=0){
                    return '请输入正确的提现金额';
                }
           },bank_info_id: function(value){
                if(value==0){
                    return '请选择提现银行卡信息';
                }
            }
        });

        //监听提交
        form.on('submit(add)', function(data){
            $('.layui-btn').attr("disabled",true);
            $.post("/agent/Withdraw/withdraw",data.field,function(res){
                if(res.status==0){
                    layer.msg(res.msg,{icon: 2,time:2000},function(){
                        $('.layui-btn').removeAttr("disabled");
                    });
                }else{
                    layer.msg(res.msg,{icon: 1,time:1000},function(){
                        window.location.reload();
                        //window.location.href='/agent/Withdraw/withdraw_list';
                    });
                }
            },'json');
            return false;
        });
    });
</script>
</body>
</html>