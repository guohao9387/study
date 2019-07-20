<?php /*a:1:{s:69:"/home/wwwroot/study/application/admin/view/user/under_agent_list.html";i:1562835437;}*/ ?>
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
    <style>
        .model{
            display: none;
            width: 100%;
            height:100%;
            background: rgba(0,0,0,0.5);
            position: fixed;
            left:0;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            z-index: 99999;
            top:0;
            overflow: hidden;
        }
        .model .model-center{
            width: 40%;
            position: absolute;
            padding: 14px 0;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            left:35% ;
            top:4%;

            background: #ffffff;
        }
        .model .layui-form-label{
            width: 30%;
            float: left;
            padding: 0;
            padding-top:15px;
            font-size: 16px;
        }
        .model .layui-input-block,.model .model-num{
            width: 62%;
            float: right;
            margin-left: 0;
            margin-top: 6px;
        }
        .model .model-num{
            border-radius: 10px;
            width: 50%;
            padding-left: 3%;
            margin-right:7%;
            -moz-border-radius: 10px;
            -webkit-border-radius: 10px;
            height: 25px;
            line-height: 25px;
            border: 1px solid #ddd;
            background: none;
            outline: none;
            margin-top: 8px;
        }
        .model .layui-form-item{
            margin-bottom: 5px!important;
        }
        .model button{
            height: 30px;
            line-height: 30px;
            margin: 0 auto;
            width: 20%;
            margin-left: 40%;
            margin-top: 20px;

        }
        #my_agent_name{
            color: orange;
        }
        .my_red{
            color: red;
        }
        .my_blue{
            color: blue;
        }
    </style>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="layui-anim layui-anim-up">
<div class="model" >
    <div class="model-center">
        <form class="layui-form">
            <div style="text-align: center">确定要操作 <span id="my_agent_name"></span> <span class="my_up_down" ></span></div>
            <div class="layui-form-item">
                <label class="layui-form-label">金额</label>
                <input type="number" placeholder="请输入金额" id="my_money" class="model-num" />
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">大写金额</label>
                <div class="model-num" id="big_real_money">零</div>
            </div>
            <input type="hidden" id="agent_id" value=""/>
            <input type="hidden" id="my_type" value=""/>
            <div class="layui-form-item">
                <button class="layui-btn" type="button" onclick="tijiao()">提交</button>
                <button class="layui-btn layui-btn-danger" type="button" onclick="quxiao()">取消</button>
            </div>
        </form>
    </div>
</div>
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">用户管理</a>
        <a>
            <cite>二级代理</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">
    <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so">
            <input class="layui-input" placeholder="开始日" name="start" id="start" value="<?php echo input('get.start'); ?>">
            <input class="layui-input" placeholder="截止日" name="end" id="end" value="<?php echo input('get.end'); ?>">
            <input type="text" name="agent_name"  placeholder="代理账号" autocomplete="off" class="layui-input" value="<?php echo input('get.agent_name'); ?>">
            <input type="text" name="nickname"  placeholder="代理昵称" autocomplete="off" class="layui-input" value="<?php echo input('get.nickname'); ?>">
            <input type="text" name="phone"  placeholder="代理电话" autocomplete="off" class="layui-input" value="<?php echo input('get.phone'); ?>">
            <input type="text" name="p_agent_id"  placeholder="一级代理账号" autocomplete="off" class="layui-input" value="<?php echo input('get.p_agent_id'); ?>">

            <!--<div class="layui-input-inline">-->
                <!--<select name="login_status">-->
                    <!--<option value="">登录状态</option>-->
                    <!--<option <?php if(input('get.login_status') == 1): ?> selected="selected"<?php endif; ?> value="1">正常登录</option>-->
                    <!--<option <?php if(input('get.login_status') == 2): ?> selected="selected"<?php endif; ?> value="2">禁止登录</option>-->
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
            <a href="<?php echo htmlentities($_SERVER['REQUEST_URI']); ?>"  class="layui-btn layui-btn-normal">重置</a>
            <a href="<?php echo url('admin/Api/excel_under_agent_list',input('get.')); ?>"  class="layui-btn" style="background-color: #337AB7">导出</a>
        </form>
    </div>
    <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加代理','/admin/User/agent_add')"><i class="layui-icon"></i>添加代理</button>
        <span class="x-right" style="line-height:40px">合计余额：<?php echo htmlentities(number_format($count['sum_money'],2,'.','')); ?>;数量：<?php echo htmlentities($count['count']); ?> 条</span>
    </xblock>
    <table class="layui-table">

        <thead>
        <tr>
            <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>账号</th>
            <th>昵称</th>
            <!--<th>电话</th>-->
            <th>直属代理</th>
            <th>余额</th>
            <th>注册时间</th>
            <th>登录状态</th>
            <th>邀请码</th>
            <th>银行卡</th>
            <th>操作</th></tr>
        </thead>
        <tbody>

        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
            <tr>
                <td>
                    <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo htmlentities($vo['agent_id']); ?>'><i class="layui-icon">&#xe605;</i></div>
                </td>
                <td><?php echo htmlentities($vo['agent_id']); ?></td>
                <td><?php echo htmlentities($vo['agent_name']); ?></td>
                <td><?php echo htmlentities($vo['nickname']); ?></td>
                <td><?php echo htmlentities(select_agent_username($vo['p_agent_id'])); ?></td>
                <td><?php echo htmlentities(number_format($vo['money'],2,".","")); ?></td>

                <td><?php echo htmlentities($vo['add_time']); ?></td>
                <td class="td-status">
                    <?php if($vo['login_status'] == 1): ?>
                        <a onclick="member_stop(this,<?php echo htmlentities($vo['agent_id']); ?>)" href="javascript:;"  title="设置代理不可登录">
                            <span class="layui-btn layui-btn-normal layui-btn-mini">是</span>
                        </a>
                    <?php else: ?>
                        <a onclick="member_stop(this,<?php echo htmlentities($vo['agent_id']); ?>)" href="javascript:;"  title="设置代理可登录">
                            <span class="layui-btn layui-btn-danger layui-btn-mini ">否</span>
                        </a>
                    <?php endif; ?>
                </td>
                <td class="td-status">
                    <a onclick="x_admin_show('代理邀请码','/admin/User/agent_code?id=<?php echo htmlentities($vo['agent_id']); ?>')" href="javascript:;"  title="查看">
                        <span class="layui-btn layui-btn-mini " style="background-color: #C57979">查看</span>
                    </a>
                </td>
                <td class="td-status">
                    <a onclick="x_admin_show('银行卡信息','/admin/User/bank_list?username=<?php echo htmlentities($vo['agent_name']); ?>&utype=2')" href="javascript:;"  title="银行卡信息">
                        <span class="layui-btn layui-btn-mini " style="background-color: #84AF9B">查看</span>
                    </a>
                </td>
                <td class="td-manage">
                    <div class="layui-btn-group">
                        <!-- 上分点击事件-->
                        <button class="layui-btn layui-btn-warm layui-btn-sm" onclick="myshow('up',<?php echo htmlentities($vo['agent_id']); ?>,'<?php echo htmlentities($vo['agent_name']); ?>')">上分</button>
                        <button class="layui-btn layui-btn-sm " style="background-color: #5BB75B;" onclick="myshow('down',<?php echo htmlentities($vo['agent_id']); ?>,'<?php echo htmlentities($vo['agent_name']); ?>')">下分</button>
                        <button class="layui-btn layui-btn-sm " onclick="x_admin_show('修改','/admin/User/agent_edit?agent_id=<?php echo htmlentities($vo['agent_id']); ?>')">修改</button>
                        <button class="layui-btn layui-btn-danger layui-btn-sm" onclick="member_del(this,<?php echo htmlentities($vo['agent_id']); ?>)">删除</button>
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
    $(function(){
    $('#my_money').bind('input propertychange', function() {
        var my_money = $('#my_money').val();
        var num=Math.floor(my_money * 100) / 100;
        var res=intToChinese(num);
        $('#big_real_money').html(res);
    });
});
//layui.use(['form','layer'], function(){
//    $ = layui.jquery;
//    form = layui.form;
//});
function myshow(type,agent_id,agent_name) {

    var type_str;

    if(type=='up'){
        type_str='上分';
        $('.my_up_down').addClass('my_red');
    }
    if(type=='down'){
        type_str='下分';
        $('.my_up_down').addClass('my_blue');
    }

    $('#agent_id').val(agent_id);
    $('#my_type').val(type);
    $('#my_agent_name').html(agent_name);
    $('.my_up_down').html(type_str);
    $(".model").show();
    $('#my_money').focus()
}
function quxiao() {
    $(".model").hide();
    $('#my_money').val('');
    $('#big_real_money').html('零');
    $('.my_up_down').removeClass('my_red my_blue');
}
function tijiao(){
    var agent_id=$('#agent_id').val();
    if(!agent_id){
        alert('参数错误');
        return false;
    }

    var money = $('#my_money').val();
    if(money<=0){
        layer.msg('请输入正确的金额!');
        return false;
    }
    var type=$('#my_type').val();
    var load = layer.load();
    $.ajax({
        url:"/admin/Api/new_agent_money_change",
        data:{agent_id:agent_id,money:money,param:type},
        dataType:"json",
        type:"post",
        success:function(res){
            layer.close(load);
            if(res.status == 1){
                layer.msg('操作成功!',{icon: 1,time:1000},function(){
                    window.location.reload();
                });
            }else{
                layer.msg(res.msg,{icon: 2,time:1000});
            }
        }
    });
    quxiao();
}
function intToChinese ( str ) {
    str = str+'';
    if(str != ''){
        var str_arr = str.split('.')
        str = str_arr[0];
    }
    var len = str.length-1;
    var idxs = ['','十','百','千','万','十','百','千','亿','十','百','千','万','十','百','千','亿'];
    var num = ['零','壹','贰','叁','肆','伍','陆','柒','捌','玖'];
    return str.replace(/([1-9]|0+)/g,function( $, $1, idx, full) {
        var pos = 0;
        if( $1[0] != '0' ){
            pos = len-idx;
            if( idx == 0 && $1[0] == 1 && idxs[len-idx] == '十'){
                return idxs[len-idx];
            }
            return num[$1[0]] + idxs[len-idx];
        } else {
            var left = len - idx;
            var right = len - idx + $1.length;
            if( Math.floor(right/4) - Math.floor(left/4) > 0 ){
                pos = left - left%4;
            }
            if( pos ){
                return idxs[pos] + num[$1[0]];
            } else if( idx + $1.length >= len ){
                return '';
            }else {
                return num[$1[0]]
            }
        }
    });
}

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

    function agent_money_change(id,param){
        layer.prompt({
            formType: 0,
            value: 0,
            title: '请输入金额'

        }, function(value, index, elem){
            var load = layer.load();
            $.ajax({
                url:"/admin/Api/agent_money_change",
                data:{agent_id:id,param:param,money:value},
                dataType:"json",
                type:"post",
                success:function(res){
                    layer.close(load);
                    if(res.status == 1){
                        layer.msg('操作成功!',{icon: 1,time:1000},function(){
                            window.location.reload();
                        });
                    }else if(res.status == 2){
                        layer.msg('余额不足',{icon: 2,time:1000});
                    }else{
                        layer.msg('操作失败!',{icon: 2,time:1000});
                    }
                    layer.close(index);
                }
            })

        });
    }

    /*会员-禁用*/
    function member_stop(obj,id){
        layer.confirm('确认要'+$(obj).attr('title')+'吗？',function(index){
            var status = 1;
            if($(obj).attr('title')=='设置代理不可登录'){
                status = 2;
            }
            var load = layer.load();
            $.ajax({
                url:'/admin/User/agent_status_change',
                data:{agent_id:id,status:status},
                type:'post',
                dataType:'json',
                success:function(res){
                    layer.close(load);
                    if(res['status']==1){
                        if(status==2){
                            //发异步把会员状态进行更改
                            $(obj).attr('title','设置代理可登录').children('span').removeClass('layui-btn-normal').addClass('layui-btn-danger').html('否');
                            layer.msg('已设置代理不可登录!',{icon: 1,time:1000});
                        }else{
                            $(obj).attr('title','设置代理不可登录').children('span').removeClass('layui-btn-danger').addClass('layui-btn-normal').html('是');
                            layer.msg('已设置代理可登录!',{icon: 1,time:1000});
                        }
                    }else{
                        layer.msg('操作失败!',{icon: 2,time:1000});
                    }
                }
            });
        });
    }


    /*会员-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
            var load = layer.load();
            $.ajax({
                url:'/admin/User/agent_del',
                data:{agent_id:id},
                type:'post',
                dataType:'json',
                success:function(res){
                    layer.close(load);
                    if(res['status']==1){
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!',{icon:1,time:1000});
                    }else if(res['status'] == 2){
                        layer.msg('操作失败，ID为'+res['agent_id']+'的代理余额不为0!',{icon:2,time:2000});
                    }else if(res['status'] == 3){
                        layer.msg('操作失败，ID为'+res['agent_id']+'的代理下级会员不为空!',{icon:2,time:2000});
                    }else if(res['status'] == 4){
                        layer.msg('操作失败，ID为'+res['agent_id']+'的代理下级代理不为空!',{icon:2,time:2000});
                    }else{
                        layer.msg('操作失败!',{icon: 2,time:1000});
                    }
                }
            });
        });
    }
    

    function delAll (argument) {
        var data = tableCheck.getData();
        if(data.length==0){
            layer.msg('至少选择一个代理!',{icon:2,time:1000});
            return;
        }
        layer.confirm('确认要删除编号为：'+data+'的代理吗？',function(index){
            //捉到所有被选中的，发异步进行删除
            var load = layer.load();
            $.ajax({
                url:'/admin/User/agent_del',
                data:{agent_id:data},
                type:'post',
                dataType:'json',
                success:function(res){
                    layer.close(load);
                    if(res['status']==1){
                        $(".layui-form-checked").not('.header').parents('tr').remove();
                        layer.msg('删除成功!',{icon:1,time:1000});
                    }else if(res['status'] == 2){
                        layer.msg('操作失败，ID为'+res['agent_id']+'的代理余额/洗码费不为0!',{icon:2,time:2000});
                    }else if(res['status'] == 3){
                        layer.msg('操作失败，ID为'+res['agent_id']+'的代理下级会员不为空!',{icon:2,time:2000});
                    }else if(res['status'] == 4){
                        layer.msg('操作失败，ID为'+res['agent_id']+'的代理下级代理不为空!',{icon:2,time:2000});
                    }else{
                        layer.msg('操作失败!',{icon: 2,time:1000});
                    }
                }
            });

        });
    }
</script>

</body>

</html>