<?php
namespace app\index\controller;

use app\index\model\Recharge;
use think\Db;
use think\Response;

class Pay extends Common
{
    public function initialize()
    {
        parent::initialize();
        $this->pay_type_arr = [
            1   =>  [
                1   =>  ['name'=>'支付宝扫码', 'max'=>'5000','code'=>924],
                2   =>  ['name'=>'微信扫码', 'max'=>'5000','code'=>911],
                3   =>  ['name'=>'银联快捷', 'max'=>'3000','code'=>914],
                5   =>  ['name'=>'银联扫码', 'max'=>'1000','code'=>926],
            ],
            2   =>  [
                1   =>  ['name'=>'支付宝扫码', 'max'=>'','code'=>101],
                2   =>  ['name'=>'微信扫码', 'max'=>'','code'=>102],
                3   =>  ['name'=>'银联转账', 'max'=>'','code'=>103],
            ],
            3   =>  [
                3   =>  ['name'=>'快捷支付', 'max'=>'','code'=>13],
            ],
            4   =>  [
                1   =>  ['name'=>'支付宝扫码', 'max'=>'','code'=>2],
                2   =>  ['name'=>'微信扫码', 'max'=>'','code'=>1],
            ],
            5   =>  [
                1   =>  ['name'=>'支付宝扫码', 'max'=>'','code'=>'al000'],
                2   =>  ['name'=>'微信扫码', 'max'=>'500','code'=>'wx000'],
            ],
            6   =>  [
                1   =>  ['name'=>'支付宝', 'max'=>'','code'=>'alipay'],
            ],
            7   =>  [
                71   =>  ['name'=>'支付宝', 'max'=>'','code'=>'ALIPAY'],
                72   =>  ['name'=>'微信', 'max'=>'','code'=>'WEIXINPAY'],
            ],
        ];
    }


    public function pay(){
        $money = input('money');
        $pay_type = input('pay_type','','intval');
        if(!preg_match('/^\+?[1-9][0-9]*$/',$money)){
            $this->error('充值金额必须是正整数');
        }
        $where = [
            ['id', '=',$pay_type],
            ['status','in', '1,3']
        ];
//        $where = [
//            'pay_type'    => ['like','%,'.$pay_type.',%'],
//            'status'      =>   1
//        ];
//        print_r($where);
        //->cache(3600*8)
        $pay_config_row = Db::name('pay')->where($where)->order('sort ASC')->find();
        if(empty($pay_config_row)){
            $this->error('支付方式不存在');
        }
        $this->pay_config = $pay_config_row;
//        echo '<pre>';
////        print_r($pay_config_row);
//        $this->pay_config = false;        //应使用的支付方式
//        //判断限额
//        $nowday = date('Y-m-d');
//        $where = [
//            ['uid','=', $this->uinfo['uid']],
//            ['pay_time', 'between',[$nowday.' 00:00:00',$nowday.' 23:59:59']],
//            ['status','=', 2]
//        ];
//        $len = count($pay_config_row);
//        foreach ($pay_config_row as $k => $val){
//            $where[] = ['type','=',$val['id']];
//            $today_total = Db::name('recharge')->where($where)->sum('amount');
//            if($today_total+$money <= $val['limit_money']){
//                $this->pay_config = $val;
//                break;
//            }
//            if($k == ($len - 1)){
//                //$this->error('您今天最多还可充值'.($val['limit_money']-$today_total).'元');
//            }
//        }
//        if(empty($this->pay_config)){
//            $this->error('您今日支付已超额，请明日再充值');
//        }
        //判断金额临界值
        $min = $this->pay_config['min_pay'];
        $max = $this->pay_config['max_pay'];
        if($money < $min){
            $this->error('最小充值金额为'.$min);
        }
        if($money > $max){
            $this->error('最大充值金额为'.$max);
        }
        //验证某一支付方式自身的限额
//        $custom_pay_max = intval($this->pay_type_arr[$this->pay_config['id']][$pay_type]['max']);
//        if($custom_pay_max > 0 && $money > $custom_pay_max){
//            $this->error($this->pay_type_arr[$this->pay_config['id']][$pay_type]['name'].'最大充值金额为'.$custom_pay_max.'元');
//        }
        $pay_fun = 'pay'.$this->pay_config['pay_id'];
        return $this->$pay_fun();
    }

    /**
     * 支付方式一
     */
    public function pay1()
    {
        $money = input('money');
        $pay_type = input('pay_type');
//        $pay_type = $this->pay_type_arr[1][$pay_type]['code'];
        $pay_type = $this->pay_config['pay_type'];
        $Recharge   = new Recharge();
        $uid        = $this->uinfo['uid'];
        $post_param = input();
        $reslut     = $Recharge->creat_recharge($uid, $money, $post_param,$this->pay_config['id']);
        if ($reslut['status'] == 0) {
            apiReturn(0, $reslut['info']);
        } else {
            $order_info = $reslut['info'];
            
            $pay_memberid    = $this->pay_config['businessid']; //商户ID
            $pay_orderid     =$order_info['pay_sn']; //订单号
            $pay_amount      =$order_info['amount']; //交易金额
            $pay_applydate   = $order_info['add_time']; //订单时间
            // $pay_notifyurl   = 'http://'.$_SERVER['SERVER_NAME'].'/index.php/index/notify/notify1'; //服务端返回地址
            // $pay_callbackurl = 'http://'.$_SERVER['SERVER_NAME'].'/index.php/index/notify/notify1'; //页面跳转返回地址
            //$pay_notifyurl   = get_host().'/index/notify/notify1'; //服务端返回地址
			$pay_notifyurl   = 'http://tlgj.china-frf.com/index/notify/notify1'; 
            $pay_callbackurl = get_host().url('user/index'); //页面跳转返回地址
            $Md5key          = $this->pay_config['key']; //密钥
            $tjurl           = "http://www.fujiashangmao.com/pay/index.php"; //提交地址
            $pay_bankcode    = $pay_type; //银行编码,微信扫码
            //扫码
            $native = array(
                "pay_memberid"    => $pay_memberid,
                "pay_orderid"     => $pay_orderid,
                "pay_amount"      => $pay_amount,
                "pay_applydate"   => $pay_applydate,
                "pay_bankcode"    => $pay_bankcode,
                "pay_notifyurl"   => $pay_notifyurl,
                "pay_callbackurl" => $pay_callbackurl,
            );
            db::name('recharge')->where(['pay_sn'=>$pay_orderid])->update(['post_param'=>json_encode($native)]);

            ksort($native);
            $md5str = "";
            foreach ($native as $key => $val) {
                $md5str = $md5str . $key . "=" . $val . "&";
            }
            //dump($md5str . "key=" . $Md5key);
            $sign                      = strtoupper(md5($md5str . "key=" . $Md5key));
            $native["pay_md5sign"]     = $sign;
            $native['pay_attach']      = "1234|456";
            $native['pay_productname'] = 'VIP基础服务';
            $native['userid']          = md5($this->uinfo['uid'].$this->uinfo['username']); //用户/玩家唯一id

            echo '<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>支付Demo</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    <div class="row" style="margin:15px;0;">
        <div class="col-md-12">
            <form class="form-inline" id="form1" method="post" action="'.$tjurl.'">
              ';
                foreach ($native as $key => $val) {
                    echo '<input type="hidden" name="' . $key . '" value="' . $val . '">';
                }
                echo'
                <button type="submit" class="btn btn-success btn-lg" style="display:none">银联支付(金额：'. $pay_amount.'元)</button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
     <script language=javascript> 
       $("#form1").submit();
    </script> 
</body>
</html>
';
exit();
        }

    }


    /**
     * 支付2
     */
    public function pay2(){
        if($this->request->isAjax()){
            $money = input('money');
            $pay_type = input('pay_type');
            $Recharge   = new Recharge();
            $uid        = $this->uinfo['uid'];
            if(empty($uid)){
                return ajax_return_error('请先登录');
            }
            $post_param = input();
            $reslut     = $Recharge->creat_recharge($uid, $money, $post_param,$this->pay_config['id']);
            if($reslut['status'] == 1){
                $re_data = $reslut['info'];
                return ajax_return_success('success',[
                    'order_sn'  =>  $re_data['pay_sn'],
                    'pay_time'  =>  date('Y-m-d H:i:s'),
                    'callback'  =>  get_host().url('notify/notify2')
                ]);
            }else{
                return ajax_return_error($reslut['info']);
            }
        }else{
            $money = input('money');
            $pay_type = input('pay_type','','intval');
//            $pay_type = $this->pay_type_arr[2][$pay_type]['code'];
            $pay_type = $this->pay_config['pay_type'];
            if(!preg_match('/^\+?[1-9][0-9]*$/',$money)){
                $this->error('充值金额必须是正整数');
                exit();
            }
            if(!in_array($pay_type,[101,102])){
                $this->error('非法充值方式');
                exit();
            }

            $param=[];
            $param['pay_businessid']    =   $this->pay_config['businessid'];
            $param['pay_memberid']      =   $this->uinfo['uid'];
            $param['key']               =   $this->pay_config['key'];
            $param['pay_type']          =   $pay_type;
            $param['money']             =   $money;
            $this->assign('param',$param);
            return $this->fetch('pay2');
        }

    }

    /**
     * 支付3
     */
    public function pay3(){
        $money = input('money');
        $pay_type = input('pay_type','','intval');
//        $pay_type = $this->pay_type_arr[3][$pay_type]['code'];
        $pay_type = $this->pay_config['pay_type'];
        if(!preg_match('/^\+?[1-9][0-9]*$/',$money)){
            $this->error('充值金额必须是正整数');
            exit();
        }
        if(!in_array($pay_type,[13])){
            $this->error('非法充值方式');
            exit();
        }

        $Recharge   = new Recharge();
        $uid        = $this->uinfo['uid'];
        $post_param = input();
        $reslut     = $Recharge->creat_recharge($uid, $money, $post_param,$this->pay_config['id']);
        if($reslut['status'] == 1){
            $re_data = $reslut['info'];
            $sign_param = [
                'merchantCode'      =>  $this->pay_config['businessid'],
                'businessType'      =>  $pay_type,
                'orderNo'           =>  $re_data['pay_sn'],
                'bankCardNo'        =>  '',
                'amount'            =>  $money*100,         //支付金额，单位为分
                'clientIp'          =>  '',
                'desc'              =>  $uid.':用户充值',
                //'noticeUrl'         =>  get_host().url('notify/notify3'),
				'noticeUrl'         =>  'http://tlgj.china-frf.com/index/notify/notify3',				
                'returnUrl'         =>  get_host().url('user/index'),
            ];
            db::name('recharge')->where(['pay_sn'=>$re_data['pay_sn']])->update(['post_param'=>json_encode($sign_param)]);
            ksort($sign_param);
            $fieldString = [];
            foreach ($sign_param as $key => $value) {
                if(!empty($value)){
                    $fieldString[] = $key . "=" . $value . "";
                }else{
                    unset($sign_param[$key]);
                }
            }
            $fieldString = implode('&', $fieldString);
            $sign_param['sign'] = md5($fieldString .'&key='.$this->pay_config['key']);
            $payUrl = 'http://api.mingxuf.cn/fillip/api/trade';//支付接口地址
            $rsp = post_json($payUrl, $sign_param);
            $rsp = json_decode($rsp, true);
            if($rsp['code'] == '0000'){
                header('Location: '.$rsp['tradeUrl']);
            }else{
                $this->error($rsp['message']);
            }

        }else{
            $this->error($reslut['info']);
        }
    }

    /**
     * 支付4
     */
    public function pay4(){
        $pay_id = 4;
        $money = input('money');
        $pay_type = input('pay_type','','intval');
//        $pay_type = $this->pay_type_arr[$pay_id][$pay_type]['code'];
        $pay_type = $this->pay_config['pay_type'];
        if(!preg_match('/^\+?[1-9][0-9]*$/',$money)){
            $this->error('充值金额必须是正整数');
            exit();
        }
        if(!in_array($pay_type,[1,2])){
            $this->error('非法充值方式');
            exit();
        }

        $Recharge   = new Recharge();
        $uid        = $this->uinfo['uid'];
        $post_param = input();
        $reslut     = $Recharge->creat_recharge($uid, $money, $post_param,$this->pay_config['id']);
        if($reslut['status'] == 1){
            $re_data = $reslut['info'];
            $sign_param = array(
                // 商户号(商户在支付平台系统经过注册认证后被分配的唯一商户号)
                'merId' => $this->pay_config['businessid'],
                // 商户订单号(填写真实的订单号)
                'businessOrderId' => $re_data['pay_sn'],
                // 支付金额
                'tradeMoney' => $money,
                // 支付方式(2:支付宝支付)
                'payType' => $pay_type,
                // 异步通知地址
				
                //'asynURL' => get_host().url('index/notify/notify4')
				'asynURL' => 'http://tlgj.china-frf.com/index/notify/notify4'
//                'asynURL' => 'http://tl.kppkkp.cn/notify.php'
            );
            db::name('recharge')->where(['pay_sn'=>$re_data['pay_sn']])->update(['post_param'=>json_encode($sign_param)]);
//            ksort($sign_param);
//            $fieldString = [];
//            foreach ($sign_param as $key => $value) {
//                if(!empty($value)){
//                    $fieldString[] = $key . "=" . $value . "";
//                }else{
//                    unset($sign_param[$key]);
//                }
//            }
//            $fieldString = implode('&', $fieldString);
//            $sign_param['sign'] = md5($fieldString .'&key='.$this->pay_config['key']);
            $payUrl = 'http://sh.doopooe.com/basic/gateway/v1/OrderPay';//支付接口地址
            $rsp = post_json($payUrl, $sign_param);
            $rsp = json_decode($rsp, true);
            if($rsp['code'] == '1000'){
                header('Location: '.$rsp['info']['codeurl']);
            }else{
                $err_msg = array(
                    '1002' => '支付失败',
                    '0000' => '验签失败',
                    '0001' => '商户不存在',
                    '0002' => '商户未启用',
                    '0003' => '必传参数为空',
                    '0004' => '产生订单失败',
                    '0005' => '订单金额有误',
                    '0006' => '订单金额超出支付范围',
                    '0007' => '支付类型无效',
                    '0017' => '系统异常',
                    '0019' => '修改订单支付方式失败',
                    '0020' => '交易金额格式错误',
                    '0040' => '代理不存在',
                    '0041' => '中转手机不存在',
                    '0042' => '生成收款码失败',
                    '0043' => '未找到商户所属中转手机代理',
                    '0044' => '无手机在线',
                    '0045' => '未找到商户的支付通道'
                );
                $errmsg = $err_msg[$rsp['code']] ?? '未知错误';
                $this->error($errmsg);
            }

        }else{
            $this->error($reslut['info']);
        }
    }


    /**
     * 支付5
     * @return mixed
     */
    public function pay5(){
        $pay_id = 5;
        $money = input('money');
        $pay_type = input('pay_type','','intval');
//        $pay_type = $this->pay_type_arr[$pay_id][$pay_type]['code'];
        $pay_type = $this->pay_config['pay_type'];
        if(!preg_match('/^\+?[1-9][0-9]*$/',$money)){
            $this->error('充值金额必须是正整数');
            exit();
        }

        $Recharge   = new Recharge();
        $uid        = $this->uinfo['uid'];
        $post_param = input();
        $reslut     = $Recharge->creat_recharge($uid, $money, $post_param,$this->pay_config['id']);
        if($reslut['status'] == 1){
            $re_data = $reslut['info'];
            $params = array(
                // 商户号(商户在支付平台系统经过注册认证后被分配的唯一商户号)
                'mchtId'        => $this->pay_config['businessid'],
                'key'           => $this->pay_config['key'],
                'version'       => 20,
                // 商户订单号(填写真实的订单号)
                'orderId'       => $re_data['pay_sn'],
                'orderTime'     => date('YmdHis'),
                'currencyType'  => 'CNY',
                'goods'         => '余额充值',
                // 支付金额
                'amount'        => $money*100,
                // 支付方式(2:支付宝支付)
                'biz'           => $pay_type,
                // 异步通知地址
                //'notifyUrl'     => get_host().url('index/notify/notify5'),
				'notifyUrl'     => 'http://tlgj.china-frf.com/index/notify/notify5',
                'callBackUrl'   => get_host().url('user/index'),
            );
            db::name('recharge')->where(['pay_sn'=>$re_data['pay_sn']])->update(['post_param'=>json_encode($params)]);
            //签名步骤一：按字典序排序参数
            ksort($params);
            $string = "";
            foreach ($params as $k => $v)
            {
                if($v != "" && !in_array($k,['mchtId','version','biz','key','sign'])){
                    $string .= $k . '=' . $v . '&';
                }
            }
//            echo $string.'<br/>';
            $string = trim($string, '&');
            //签名步骤二：在string后加入KEY
            $string = $string . "&key=".$this->pay_config['key'];
            //签名步骤三：MD5加密
//            echo $string.'<br/>';
            $string = md5($string);
            //签名步骤四：所有字符转为大写
            $sign = strtoupper($string);

            $params['sign'] = $sign;

            $this->assign([
                'action_url'    =>  'https://api.tongfuzf.top/gateway/cashier/mchtCall',
                'params'        =>  $params
            ]);
            return $this->fetch('pay_form');

        }else{
            $this->error($reslut['info']);
        }
    }


    /**
     * 支付6
     */
    public function pay6(){
        $pay_id = 6;
        $money = input('money');
        $pay_type = input('pay_type','','intval');
//        $pay_type = $this->pay_type_arr[$pay_id][$pay_type]['code'];
        $pay_type = $this->pay_config['pay_type'];
        if(!preg_match('/^\+?[1-9][0-9]*$/',$money)){
            $this->error('充值金额必须是正整数');
            exit();
        }
//        if(!in_array($pay_type,[1,2])){
//            $this->error('非法充值方式');
//            exit();
//        }

        $Recharge   = new Recharge();
        $uid        = $this->uinfo['uid'];
        $post_param = input();
        $reslut     = $Recharge->creat_recharge($uid, $money, $post_param,$this->pay_config['id']);
        if($reslut['status'] == 1){
            $re_data = $reslut['info'];
            $params = array(
                // 商户号(商户在支付平台系统经过注册认证后被分配的唯一商户号)
                'MerId' => $this->pay_config['businessid'],
                // 商户订单号(填写真实的订单号)
                'MerOrderNo' => $re_data['pay_sn'],
                // 支付金额
                'tradeMoney' => $money,
                // 支付方式(2:支付宝支付)
                'PayType' => $pay_type,
                'Amount'        =>  $money*100,
                'MerOrderTime'  =>  date('YmdHis'),
                'GoodsName'     =>  '会员充值',
                // 异步通知地址
                'NotifyUrl'     => 'http://tlgj.china-frf.com/index/notify/notify6',
				//'NotifyUrl'     => get_host().url('index/notify/notify6'),
				
                'SuccessUrl'    => get_host().url('index/user/index'),
//                'Sign'          => ''
            );
            db::name('recharge')->where(['pay_sn'=>$re_data['pay_sn']])->update(['post_param'=>json_encode($params)]);
            $sign_str = $params['Amount'].'|'.$params['MerOrderNo'].'|'.$params['MerOrderTime'].'|'.$this->pay_config['key'];
//            echo $sign_str;
            $sign = strtoupper(md5(strtoupper(md5($sign_str))));
            $params['Sign'] = $sign;

            $payUrl = 'http://lt.ibosser.com:9980/order/pay';//支付接口地址
            $rsp = post_request($payUrl, $params);
            $rsp = json_decode($rsp, true);
//            print_r($rsp);
//            exit();
            if($rsp['code'] == 'success'){
                header('Location: '.$rsp['data']['PayUrl']);
            }else{
                $this->error('支付失败');
            }

        }else{
            $this->error($reslut['info']);
        }
    }

    /**
     * 支付7
     */
    public function pay7(){
        $pay_id = 7;
        $money = input('money');
        $pay_type = input('pay_type','','intval');
//        $pay_type = $this->pay_type_arr[$pay_id][$pay_type]['code'];
        $pay_type = $this->pay_config['pay_type'];
        if(!preg_match('/^\+?[1-9][0-9]*$/',$money)){
            $this->error('充值金额必须是正整数');
            exit();
        }
//        if(!in_array($pay_type,[1,2])){
//            $this->error('非法充值方式');
//            exit();
//        }

        $Recharge   = new Recharge();
        $uid        = $this->uinfo['uid'];
        $post_param = input();
        $reslut     = $Recharge->creat_recharge($uid, $money, $post_param,$this->pay_config['id']);
        if($reslut['status'] == 1){
            $re_data = $reslut['info'];
//            $params = array(
//                // 商户号(商户在支付平台系统经过注册认证后被分配的唯一商户号)
//                'MerId' => $this->pay_config['businessid'],
//                // 商户订单号(填写真实的订单号)
//                'MerOrderNo' => $re_data['pay_sn'],
//                // 支付金额
//                'tradeMoney' => $money,
//                // 支付方式(2:支付宝支付)
//                'PayType' => $pay_type,
//                'Amount'        =>  $money*100,
//                'MerOrderTime'  =>  date('YmdHis'),
//                'GoodsName'     =>  '会员充值',
//                // 异步通知地址
//                'NotifyUrl'     => get_host().url('index/notify/notify7'),
//                'SuccessUrl'    => get_host().url('index/user/index'),
////                'Sign'          => ''
//            );

            //网关
            $formUrl = "http://api.yiyou55.com/apiv32.aspx";
            //商户id
            $merchantId = $this->pay_config['businessid'];//商户号 在客服给您的资料里面
            //金额
            $payMoney = $money;   //
            //Key
            $keyValue = $this->pay_config['key'];//密钥 在客服给您的资料里面
            //分割符
            $code = "^|^";


            //第二步，给变量设置值
            $p0_Cmd 			= "Buy";
            $p1_MerId 			= $merchantId;
            $p2_Order 			= $re_data['pay_sn'];    //订单号单日唯一
            $p3_Amt 			= $payMoney;
            $p4_Cur 			= "CNY";
            $p5_Pid 			= "recharge";
            $p6_Pcat 			= "productType";
            $p7_Pdesc 			= "user recharge";
            //$p8_Url 			= get_host().url('index/notify/notify7');
			$p8_Url 			= 'http://tlgj.china-frf.com/index/notify/notify7';
			
            $p9_SAF 			= get_host().url('index/user/index');
            $pa_MP 				= "merchantExtraInfo";
            $pd_FrpId 			= $pay_type;
            $pr_NeedResponse 	= "1";
            $payerIp 			="";//payerIp	支付IP			不参与签名
            $hmac 				="";//hmac	签名数据	是	Max(32)

            // 获得MD5-HMAC签名
            $stringA = $p0_Cmd.$code.
                $p1_MerId 		.$code.
                $p2_Order 		.$code.
                $p3_Amt 		.$code.
                $p4_Cur 		.$code.
                $p5_Pid 		.$code.
                $p6_Pcat 		.$code.
                $p7_Pdesc 		.$code.
                $p8_Url 		.$code.
                $p9_SAF 		.$code.
                $pa_MP 			.$code.
                $pd_FrpId 		.$code.
                $pr_NeedResponse.$code;

            $hmac = pay7_HmacMd5($stringA,$keyValue);

            //第三步，提交到网关
            $formString = "<form id='form1' name='form1' action='$formUrl' method='POST' >";
            $formString .="			<input type='hidden' name='p0_Cmd'   value='$p0_Cmd'>";
            $formString .="				<input type='hidden' name='p1_MerId' value='$p1_MerId'>";
            $formString .="				<input type='hidden' name='p2_Order' value='$p2_Order'>";
            $formString .="				<input type='hidden' name='p3_Amt'   value='$p3_Amt'>";
            $formString .="				<input type='hidden' name='p4_Cur'   value='$p4_Cur'>";
            $formString .="				<input type='hidden' name='p5_Pid'   value='$p5_Pid'>";
            $formString .="				<input type='hidden' name='p6_Pcat'  value='$p6_Pcat'>";
            $formString .="				<input type='hidden' name='p7_Pdesc' value='$p7_Pdesc'>";
            $formString .="				<input type='hidden' name='p8_Url'   value='$p8_Url'>";
            $formString .="				<input type='hidden' name='p9_SAF'   value='$p9_SAF'>";
            $formString .="				<input type='hidden' name='pa_MP'    value='$pa_MP'>";
            $formString .="				<input type='hidden' name='pd_FrpId' value='$pd_FrpId'>";
            $formString .="				<input type='hidden' name='pr_NeedResponse' value='$pr_NeedResponse'>";
            $formString .="				<input type='hidden' name='hmac'     value='$hmac'>";
//            $formString .="				<input type='submit' />";
            $formString .="		</form>";
            $formString .="<script type=\"text/javascript\" language=\"javascript\">setTimeout(\"document.getElementById('form1').submit();\",0);</script>";

            echo $formString;
        }else{
            $this->error($reslut['info']);
        }
    }

    public function pay8(){
        $pay_id = 8;
        $money = input('money');
        $pay_type = $this->pay_config['pay_type'];
        if(!preg_match('/^\+?[1-9][0-9]*$/',$money)){
            $this->error('充值金额必须是正整数');
            exit();
        }

        $Recharge   = new Recharge();
        $uid        = $this->uinfo['uid'];
        $post_param = input();
        $reslut     = $Recharge->creat_recharge($uid, $money, $post_param,$this->pay_config['id']);
        if($reslut['status'] == 1){
            $re_data = $reslut['info'];
            $payload=array(
                "action"    =>  $pay_type,
                "txnamt"    =>  $money*100,
                "merid"     =>  $this->pay_config['businessid'],
                "orderid"   =>  $re_data['pay_sn'],
                //"backurl"   =>  get_host().url('index/notify/notify8'),
				"backurl"   =>  "http://tlgj.china-frf.com/index/notify/notify8",
                "fronturl"  =>  get_host().url('index/user/index'),
            );

            db::name('recharge')->where(['pay_sn'=>$re_data['pay_sn']])->update(['post_param'=>json_encode($payload)]);
            //格式化JSON
            $arrayJson = json_encode($payload);
            //签名
            $sign= md5(base64_encode($arrayJson).$this->pay_config['key']);

            $req=  base64_encode($arrayJson);
            //请求参数
            $requestData="req=".$req."&sign=".$sign;
            $post_data = [
                'req'   =>  $req,
                'sign'  =>  $sign
            ];
            $post_url = 'https://api.yulea.net/api/mpgateway';
            $rsp = post_request($post_url, $post_data);
            $rsp = json_decode($rsp,true);
            $rsp_data = json_decode(base64_decode($rsp['resp']),true);
            if($rsp_data['respcode'] == '00'){
                header('Location: '.$rsp_data['formaction']);
                exit();
            }else{
                $this->error($rsp_data['respmsg']);
            }

        }
        $this->error($reslut['info']);
    }

	public function pay9(){
		//echo 123;die;
        $pay_id = 9;
        $money = input('money');
        $pay_type = $this->pay_config['pay_type'];
        if(!preg_match('/^\+?[1-9][0-9]*$/',$money)){
            $this->error('充值金额必须是正整数');
            exit();
        }
		//dump($this->pay_config);die;

        $Recharge   = new Recharge();
        $uid        = $this->uinfo['uid'];
        $post_param = input();
        $reslut     = $Recharge->creat_recharge($uid, $money, $post_param,$this->pay_config['id']);
        if($reslut['status'] == 1){
            $re_data = $reslut['info'];
            $payload=array(
                "pay_bankcode"    =>  $this->pay_config['pay_type'],
                "pay_amount"    =>  $money.'.00',
                "pay_memberid"     =>  $this->pay_config['businessid'],
                "pay_orderid"   =>  $re_data['pay_sn'],
                "pay_applydate"   =>  date("Y-m-d H:i:s"),				
				//"pay_notifyurl"   =>  get_host().url('index/notify/notify9'),
				"pay_notifyurl"   =>  "http://tlgj.china-frf.com/index/notify/notify9",
				"pay_callbackurl"  =>  get_host().url('user/index'),
            );
			ksort($payload);
			$md5str = "";
			foreach ($payload as $key => $val) {
				$md5str = $md5str . $key . "=" . $val . "&";
			}
			$sign = strtoupper(md5($md5str . "key=" . $this->pay_config['key']));
			$payload["pay_md5sign"] = $sign;
			$payload['pay_attach']  = $uid;
			$payload['pay_productname'] ='团购商品';         
            $post_url = 'http://cloudpay_api.shankuaipay.com/pay/';

            db::name('recharge')->where(['pay_sn'=>$re_data['pay_sn']])->update(['post_param'=>json_encode($payload)]);
            $this->assign([
                'action_url'    =>  $post_url,
                'params'        =>  $payload
            ]);
            return $this->fetch('pay_form');
//			echo $this->buildRequestForm($post_url,$payload);
            
        }
        $this->error($reslut['info']);
    }

    public function pay10(){
        //echo 123;die;
        $pay_id = 10;
        $money = input('money');
        $pay_type = $this->pay_config['pay_type'];
        if(!preg_match('/^\+?[1-9][0-9]*$/',$money)){
            $this->error('充值金额必须是正整数');
            exit();
        }
        //dump($this->pay_config);die;

        $Recharge   = new Recharge();
        $uid        = $this->uinfo['uid'];
        $post_param = input();
        $reslut     = $Recharge->creat_recharge($uid, $money, $post_param,$this->pay_config['id']);
        if($reslut['status'] == 1){
            $re_data = $reslut['info'];
            $payload=array(
                "pay_bankcode"    =>  $this->pay_config['pay_type'],
                "pay_amount"    =>  $money.'.00',
                "pay_memberid"     =>  $this->pay_config['businessid'],
                "pay_orderid"   =>  $re_data['pay_sn'],
                "pay_applydate"   =>  date("Y-m-d H:i:s"),
                //"pay_notifyurl"   =>  get_host().url('index/notify/notify10'),
				"pay_notifyurl"   =>  "http://tlgj.china-frf.com/index/notify/notify10",				
                "pay_callbackurl"  =>  get_host().url('user/index'),
            );
            ksort($payload);
            $md5str = "";
            foreach ($payload as $key => $val) {
                $md5str = $md5str . $key . "=" . $val . "&";
            }
            $sign = strtoupper(md5($md5str . "key=" . $this->pay_config['key']));
            $payload["pay_md5sign"] = $sign;
            $payload['pay_attach']  = $uid;
            $payload['pay_productname'] ='团购商品';
            $post_url = 'http://f.hej4.cn/Pay_Index.html';

            db::name('recharge')->where(['pay_sn'=>$re_data['pay_sn']])->update(['post_param'=>json_encode($payload)]);

            $rsp = post_request($post_url, $payload);
            $rsp = json_decode($rsp,true);
            if($rsp['returncode'] == '00'){
                header('Location: '.$rsp['qr_url']);
                exit();
            }

        }
        $this->error($reslut['info']);
    }

}
