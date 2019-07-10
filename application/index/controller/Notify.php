<?php
namespace app\index\controller;

use app\index\model\Recharge;
use think\Controller;
use think\Db;

class Notify extends Controller
{

    public function notify1()
    {
        $debug = true;
        $log_path = './pay_config/pay1_'.date('Y-m-d').'.log';
        $param = $_REQUEST;
        if($debug){
            file_put_contents($log_path,var_export($param,true)."\r\n\r\n",FILE_APPEND);
        }

        // $returnArray = array( // 返回字段
        //     "memberid"       => empty($_REQUEST["memberid"]) ? 0 : $_REQUEST["memberid"], // 商户ID
        //     "orderid"        => empty($_REQUEST["orderid"]) ? 0 : $_REQUEST["orderid"], // 订单号
        //     "amount"         => empty($_REQUEST["amount"]) ? 0 : $_REQUEST["amount"], // 交易金额
        //     "datetime"       => empty($_REQUEST["datetime"]) ? 0 : $_REQUEST["datetime"], // 交易时间
        //     "transaction_id" => empty($_REQUEST["transaction_id"]) ? 0 : $_REQUEST["transaction_id"], // 流水号
        //     "returncode"     => empty($_REQUEST["returncode"]) ? 0 : $_REQUEST["returncode"],
        // );
        // $returncode = empty($_REQUEST["returncode"]) ? 0 : $_REQUEST["returncode"];
        // // dump($re_sign);
        // //dump($sign);

        

        // $input     = input();
        // $input_str = json_encode($input);
        // error_log($input_str . "\r\n", 3, "my-errors.log");

        // die;
        $returnArray = array( // 返回字段
            "memberid"       => empty($_REQUEST["memberid"]) ? 0 : $_REQUEST["memberid"], // 商户ID
            "orderid"        => empty($_REQUEST["orderid"]) ? 0 : $_REQUEST["orderid"], // 订单号
            "amount"         => empty($_REQUEST["amount"]) ? 0 : $_REQUEST["amount"], // 交易金额
            "datetime"       => empty($_REQUEST["datetime"]) ? 0 : $_REQUEST["datetime"], // 交易时间
            "transaction_id" => empty($_REQUEST["transaction_id"]) ? 0 : $_REQUEST["transaction_id"], // 流水号
            "returncode"     => empty($_REQUEST["returncode"]) ? 0 : $_REQUEST["returncode"],
        );
        if ($returnArray['returncode'] == "01") {
//            $str      = "交易成功！订单号：" . $returnArray['orderid'];

            /*
            $Recharge = new Recharge();
            //$returnArray['orderid']='SN20190109155840774189';
            $reslut = $Recharge->notify_recharge($returnArray['orderid'], $_REQUEST);
            */
            $this->redirect('/index/user/index');
            exit('ok');

        }
        $md5key = Db::name('pay')->where(['pay_id'=>1])->value('key');
//        $md5key = "6bd1qvsjvxd2wl1llc2uptxf8b78qr65";
        ksort($returnArray);
        reset($returnArray);
        $md5str = "";
        foreach ($returnArray as $key => $val) {
            $md5str = $md5str . $key . "=" . $val . "&";
        }
        //dump($returnArray);
        $sign       = strtoupper(md5($md5str . "key=" . $md5key));
        $re_sign    = empty($_REQUEST["sign"]) ? 0 : $_REQUEST["sign"];
        $returncode = empty($_REQUEST["returncode"]) ? 0 : $_REQUEST["returncode"];
        // dump($re_sign);
        //dump($sign);
        if ($sign == $re_sign) {

            if ($returncode == "00") {
//                $str      = "交易成功！订单号：" . $returnArray['orderid'];
                $Recharge = new Recharge();
                //$returnArray['orderid']='SN20190109155840774189';
                $reslut = $Recharge->notify_recharge($returnArray['orderid'], $_REQUEST);
                if($reslut){
                    exit('ok');
                }else{
                    exit('error');
                }
            }
        }else{
             $this->redirect('/index/user/index');
        }

    }

    /**
     * 支付2的回调
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function notify2(){
        $debug = true;
        $log_path = './pay_config/pay2_'.date('Y-m-d').'.log';
        $param = $_REQUEST;
        if($debug){
            file_put_contents($log_path,var_export($param,true)."\r\n\r\n",FILE_APPEND);
        }
        if(empty($param['get_time']) || empty($param['pay_amount']) || empty($param['pay_orderid']) || empty($param['order_id'])){
            exit('error');
        }
        $key = Db::name('pay')->where(['pay_id'=>2])->value('key');
        $sort_arr = [];
        foreach ($param as $k=>$v){
            if(!empty($v) && $k != 'sign'){
                $sort_arr[$k] = $v;
            }
        }
        ksort($sort_arr);
        $sort_arr['key'] = $key;

        $str1 = urldecode(http_build_query($sort_arr));
        //查找充值记录
        $recharge_tb = 'recharge';
        $order_sn = $param['pay_orderid'];
        $re_row = Db::name($recharge_tb)->where(['pay_sn' => $order_sn])->find();
//        echo md5($str1)."\r\n";
        if(!empty($re_row) && $re_row['status'] == 1 && $param['sign'] == strtoupper(md5($str1))){
            //修改记录
            try{
//                $save_data = [
//                    'pay_time'      =>  date('Y-m-d H:i:s'),
//                    'return_param'  =>  var_export($param,true),
//                    'update_time'   =>  date('Y-m-d H:i:s'),
//                    'status'        =>  2
//                ];
//                Db::name($recharge_tb)->where(['pay_sn' => $param['pay_orderid']])->update($save_data);

                //处理其他业务
                $Recharge = new Recharge();
                $reslut = $Recharge->notify_recharge($order_sn, $param);
                if($reslut){
                    exit('success');
                }else{
                    if($debug) {
                        file_put_contents($log_path, "失败。原因业务逻辑操作失败\r\n\r\n", FILE_APPEND);
                    }
                    exit('error');
                }
            }catch (\Exception  $e){
                if($debug) {
                    file_put_contents($log_path, "失败。原因" . print_r($e->getMessage(), true) . "\r\n\r\n", FILE_APPEND);
                }
                exit('error');
            }
        }
        if($debug) {
            file_put_contents($log_path, "失败。原因充值记录、记录状态、或者签名不正确。\r\n\r\n", FILE_APPEND);
        }
        exit('error');

    }

    /**
     * 支付3的回调
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */

    public function notify3(){
        $debug = true;
        $log_path = './pay_config/pay3_'.date('Y-m-d').'.log';
        $param = file_get_contents("php://input");
        $param = json_decode($param,true);
        if($debug){
            file_put_contents($log_path,var_export($param,true)."\r\n\r\n",FILE_APPEND);
        }
        if(empty($param['code']) || empty($param['merchantOrderNo']) || empty($param['platformOrderNo']) || empty($param['sign'])){
            if($debug) {
                file_put_contents($log_path, "失败。原因参数不完整\r\n\r\n", FILE_APPEND);
            }
            exit('error');
        }
        $key = Db::name('pay')->where(['pay_id'=>3])->value('key');
        ksort($param);
        $sort_arr = [];
        foreach ($param as $k=>$v){
            if(!empty($v) && $k != 'sign'){
                $sort_arr[] = $k . "=" . $v;
            }
        }
        $sort_arr[] = 'key='.$key;
        $str1 = implode('&', $sort_arr);
        //查找充值记录
        $recharge_tb = 'recharge';
        $order_sn = $param['merchantOrderNo'];
        $re_row = Db::name($recharge_tb)->where(['pay_sn' => $order_sn])->find();
        if(!empty($re_row) && $re_row['status'] == 1 && strtolower($param['sign']) == md5($str1)){
            //修改记录
            try{
                //处理其他业务
                $Recharge = new Recharge();
                $reslut = $Recharge->notify_recharge($order_sn, $param);
                if($reslut){
                    exit('success');
                }else{
                    if($debug) {
                        file_put_contents($log_path, "失败。原因业务逻辑操作失败\r\n\r\n", FILE_APPEND);
                    }
                    exit('error');
                }
            }catch (\Exception  $e){
                if($debug) {
                    file_put_contents($log_path, "失败。原因" . print_r($e->getMessage(), true) . "\r\n\r\n", FILE_APPEND);
                }
                exit('error');
            }
        }
        if($debug) {
            file_put_contents($log_path, "失败。原因充值记录、记录状态、或者签名不正确。\r\n\r\n", FILE_APPEND);
        }
        exit('error');
    }


    public function notify4(){
        $debug = true;
        $log_path = './pay_config/pay4_'.date('Y-m-d').'.log';
        $notified = new Notified4();

        // 订单异步通知数据
        $param = $notified->get_json_request();
        if ($param === null) {
            if($debug){
                file_put_contents($log_path,"失败，参数不完整\r\n\r\n",FILE_APPEND);
            }
            exit('FAILCURE');
        }

        // 解密后的通知内容
        $content = $notified->decrypt($param->encrypt);
        if($debug){
            file_put_contents($log_path,var_export($content,true)."\r\n\r\n",FILE_APPEND);
        }

        // 验签失败
        if(!$notified->verify($content, $param->sign)) {
            if($debug) {
                file_put_contents($log_path, "失败。原因签名不正确。\r\n\r\n", FILE_APPEND);
            }
            exit('FAILCURE');
        }
        // 字符串转换成JSON对象
        $param = json_decode($content,true);

        //查找充值记录
        $recharge_tb = 'recharge';
        $order_sn = $param['orderId'];
        $re_row = Db::name($recharge_tb)->where(['pay_sn' => $order_sn])->find();
        if(!empty($re_row) && $re_row['status'] == 1){
            //修改记录
            try{
                //处理其他业务
                $Recharge = new Recharge();
                $reslut = $Recharge->notify_recharge($order_sn, $param);
                if($reslut){
                    exit('SUCCESS');
                }else{
                    if($debug) {
                        file_put_contents($log_path, "失败。原因业务逻辑操作失败\r\n\r\n", FILE_APPEND);
                    }
                    exit('error');
                }
            }catch (\Exception  $e){
                if($debug) {
                    file_put_contents($log_path, "失败。原因" . print_r($e->getMessage(), true) . "\r\n\r\n", FILE_APPEND);
                }
                exit('error');
            }
        }else{
            if($debug) {
                file_put_contents($log_path, "失败。原因订单不存在或状态为已支付。\r\n\r\n", FILE_APPEND);
            }
        }
        exit('error');
    }


    public function notify5(){
        $debug = true;
        $log_path = './pay_config/pay5_'.date('Y-m-d').'.log';
        $param = file_get_contents("php://input");
        $param = json_decode($param,true);
//        $param = array (
//            'body' =>
//                array (
//                    'amount' => '10000',
//                    'bankCardNo' => '',
//                    'biz' => 'wx000',
//                    'chargeTime' => '20190416105420',
//                    'mchtId' => '2000412000991663',
//                    'orderId' => 'SN20190416105050556900',
//                    'payType' => 'wx',
//                    'seq' => 'f9bb4b37d4b64ffdbedb8e57d1498709',
//                    'status' => 'SUCCESS',
//                    'tradeId' => 'P1904161050515971170',
//                ),
//            'head' =>
//                array (
//                    'respCode' => '0000',
//                    'respMsg' => '请求成功',
//                ),
//            'sign' => '9249398c314564500c51953ac4fed016',
//        );
        if($debug){
            file_put_contents($log_path,var_export($param,true)."\r\n\r\n",FILE_APPEND);
        }

        if($param['head']['respCode'] != '0000'){
            if($debug) {
                file_put_contents($log_path, "失败。原因支付失败\r\n\r\n", FILE_APPEND);
            }
            exit('error');
        }
        //验签
        $key = Db::name('pay')->where(['pay_id'=>5])->value('key');
        //签名步骤一：按字典序排序参数
        ksort($param);
        $string = "";
        foreach ($param['body'] as $k => $v)
        {
            if($v != "" && !is_array($v)){
                $string .= $k . "=" . $v . "&";
            }
        }
        $string = trim($string, "&");
        //签名步骤二：在string后加入KEY
        $string = $string . "&key=".$key;
        //签名步骤三：MD5加密
        $string = md5($string);
        //签名步骤四：所有字符转为大写
        $sign = strtoupper($string);
        if($sign == strtoupper($param['sign'])){
            $recharge_tb = 'recharge';
            $order_sn = $param['body']['orderId'];
            $re_row = Db::name($recharge_tb)->where(['pay_sn' => $order_sn])->find();
            if(!empty($re_row) && $re_row['status'] == 1){
                //修改记录
                try{
                    //处理其他业务
                    $Recharge = new Recharge();
                    $reslut = $Recharge->notify_recharge($order_sn, $param);
                    if($reslut){
                        exit('SUCCESS');
                    }else{
                        if($debug) {
                            file_put_contents($log_path, "失败。原因业务逻辑操作失败\r\n\r\n", FILE_APPEND);
                        }
                        exit('error');
                    }
                }catch (\Exception  $e){
                    if($debug) {
                        file_put_contents($log_path, "失败。原因" . print_r($e->getMessage(), true) . "\r\n\r\n", FILE_APPEND);
                    }
                    exit('error');
                }
            }else{
                if($debug) {
                    file_put_contents($log_path, "失败。原因订单不存在或已经支付成功\r\n\r\n", FILE_APPEND);
                }
                exit('error');
            }
        }else{
            if($debug) {
                file_put_contents($log_path, "失败。原因验签失败\r\n\r\n", FILE_APPEND);
            }
            exit('error');
        }
    }


    public function notify6(){
        $debug = true;
        $log_path = './pay_config/pay6_'.date('Y-m-d').'.log';
        $param = $_REQUEST;
        if($debug){
            file_put_contents($log_path,var_export($param,true)."\r\n\r\n",FILE_APPEND);
        }

        if(empty($param['PayStatus']) || $param['PayStatus'] != 'success'){
            if($debug) {
                file_put_contents($log_path, "失败。原因支付失败\r\n\r\n", FILE_APPEND);
            }
            exit('error');
        }
        //验签
        $key = Db::name('pay')->where(['pay_id'=>6])->value('key');
        //签名步骤一：按字典序排序参数
        $sign_str = $param['Amount'].'|'.$param['PayOrderNo'].'|'.$param['PayOrderTime'].'|'.$key;
        //签名步骤二：MD5加密
        $string = md5(strtoupper(md5($sign_str)));
        //签名步骤三：所有字符转为大写
        $sign = strtoupper($string);
        if($sign == strtoupper($param['Sign'])){
            $recharge_tb = 'recharge';
            $order_sn = $param['MerOrderNo'];
            $re_row = Db::name($recharge_tb)->where(['pay_sn' => $order_sn])->find();
            if(!empty($re_row) && $re_row['status'] == 1){
                //修改记录
                try{
                    //处理其他业务
                    $Recharge = new Recharge();
                    $reslut = $Recharge->notify_recharge($order_sn, $param);
                    if($reslut){
                        exit('success');
                    }else{
                        if($debug) {
                            file_put_contents($log_path, "失败。原因业务逻辑操作失败\r\n\r\n", FILE_APPEND);
                        }
                        exit('error');
                    }
                }catch (\Exception  $e){
                    if($debug) {
                        file_put_contents($log_path, "失败。原因" . print_r($e->getMessage(), true) . "\r\n\r\n", FILE_APPEND);
                    }
                    exit('error');
                }
            }else{
                if($debug) {
                    file_put_contents($log_path, "失败。原因订单不存在或已经支付成功\r\n\r\n", FILE_APPEND);
                }
                exit('error');
            }
        }else{
            if($debug) {
                file_put_contents($log_path, "失败。原因验签失败\r\n\r\n", FILE_APPEND);
            }
            exit('error');
        }
    }


    public function notify7(){
        $debug = true;
        $log_path = './pay_config/pay7_'.date('Y-m-d').'.log';
        $param = $_REQUEST;
        if($debug){
            file_put_contents($log_path,var_export($param,true)."\r\n\r\n",FILE_APPEND);
        }

        if(empty($param['r1_Code']) || $param['r1_Code'] != '1'){
            if($debug) {
                file_put_contents($log_path, "失败。原因支付失败\r\n\r\n", FILE_APPEND);
            }
            exit('error');
        }

        //验签
        $key = Db::name('pay')->where(['pay_id'=>7])->value('key');

        //Key
        $keyValue = $key;
        //分隔符
        $code = "^|^";

        $p1_MerId  		= $_REQUEST['p1_MerId']; //p1_MerId	商户编号	Max(11)		1
        $r0_Cmd  		= $_REQUEST['r0_Cmd']; //r0_Cmd	业务类型	Max(20)	固定值 ”Buy”.	2
        $r1_Code  		= $_REQUEST['r1_Code']; //r1_Code	支付结果		固定值 “1”, 代表支付成功.	3
        $r2_TrxId  		= $_REQUEST['r2_TrxId']; //r2_TrxId	平台交易流水号	Max(50)	平台订单号唯一	4
        $r3_Amt  		= $_REQUEST['r3_Amt']; //r3_Amt	支付金额	Max(20)	单位:元，精确到分. 商户收到该返回数据后,一定用自己数据库中存储的金额与该金额进行比较.	5
        $r4_Cur  		= $_REQUEST['r4_Cur']; //r4_Cur	交易币种	Max(10)	返回时是"RMB"	6
        $r5_Pid  		= $_REQUEST['r5_Pid']; //r5_Pid	商品名称	Max(20)	同支付提交值。	7
        $r6_Order  		= $_REQUEST['r6_Order']; //r6_Order	商户订单号	Max(50)	商户订单号.	8
        $r7_Uid  		= $_REQUEST['r7_Uid']; //r7_Uid		Max(50)	固定留空.	9
        $r8_MP  		= $_REQUEST['r8_MP']; //r8_MP	商户扩展信息	Max(200)	此参数如用到中文，请注意转码.	10
        $r9_BType  		= $_REQUEST['r9_BType']; //r9_BType	交易结果返回类型	Max(1)	固定2	11
        $hmac  			= $_REQUEST['hmac']; //hmac	签名数据	Max(32)

        $stringA = $p1_MerId.$code.$r0_Cmd.$code.$r1_Code.$code.$r2_TrxId.$code.$r3_Amt.$code.$r4_Cur.$code.$r5_Pid.$code.$r6_Order.$code.$r7_Uid.$code.$r8_MP.$code.$r9_BType.$code;

        $verifyHmac = pay7_HmacMd5($stringA,$keyValue);

        if($hmac == $verifyHmac){
            if($r1_Code=="1"){

                $recharge_tb = 'recharge';
                $order_sn = $r6_Order;
                $re_row = Db::name($recharge_tb)->where(['pay_sn' => $order_sn])->find();

                if(!empty($re_row) && $re_row['status'] == 1){
                    //修改记录
                    try{
                        //处理其他业务
                        $Recharge = new Recharge();
                        $reslut = $Recharge->notify_recharge($order_sn, $param);
                        if($reslut){
                            if($r9_BType=="1"){
                                echo "交易成功";
                                echo  "<br />在线支付页面返回";
                            }elseif($r9_BType=="2"){
                                #如果需要应答机制则必须回写流,以success开头,大小写不敏感.
                                echo "success";
                                echo "<br />交易成功";
                                echo  "<br />在线支付服务器返回";
                            }
                            exit();
                        }else{
                            if($debug) {
                                file_put_contents($log_path, "失败。原因业务逻辑操作失败\r\n\r\n", FILE_APPEND);
                            }
                            exit('error');
                        }
                    }catch (\Exception  $e){
                        if($debug) {
                            file_put_contents($log_path, "失败。原因" . print_r($e->getMessage(), true) . "\r\n\r\n", FILE_APPEND);
                        }
                        exit('error');
                    }
                }else{
                    if($debug) {
                        file_put_contents($log_path, "失败。原因订单不存在或已经支付成功\r\n\r\n", FILE_APPEND);
                    }
                    exit('error');
                }

                #	需要比较返回的金额与商家数据库中订单的金额是否相等，只有相等的情况下才认为是交易成功.
                #	并且需要对返回的处理进行事务控制，进行记录的排它性处理，在接收到支付结果通知后，判断是否进行过业务逻辑处理，不要重复进行业务逻辑处理，防止对同一条交易重复发货的情况发生.
            }
        }else{
            if($debug) {
                file_put_contents($log_path, "失败。原因验签失败\r\n\r\n", FILE_APPEND);
            }
            exit('error');
        }

    }

    public function notify8(){
        $debug = true;
        $log_path = './pay_config/pay8_'.date('Y-m-d').'.log';
        $param = $_POST;
        if($debug){
            file_put_contents($log_path,var_export($param,true)."\r\n\r\n",FILE_APPEND);
        }

        if(empty($param['resp']) || empty($param['sign'])){
            if($debug) {
                file_put_contents($log_path, "失败。原因参数不完整\r\n\r\n", FILE_APPEND);
            }
            exit();
        }

        //验签
        $key = Db::name('pay')->where(['pay_id'=>8])->value('key');

        $resp = base64_decode($param['resp'],true);
		$resp = json_decode($resp, true);
        $mySign = md5($param['resp'].$key);

        if($param['sign'] == $mySign){
            if('0000' == $resp['resultcode'] || '1002' == $resp['resultcode']){

                $recharge_tb = 'recharge';
                $order_sn = $resp['orderid'];
                $re_row = Db::name($recharge_tb)->where(['pay_sn' => $order_sn])->find();

                if(!empty($re_row) && $re_row['status'] == 1){
                    //修改记录
                    try{
                        //处理其他业务
                        $Recharge = new Recharge();
                        $reslut = $Recharge->notify_recharge($order_sn, $param);
                        if($reslut){
                            exit('0000');
                        }else{
                            if($debug) {
                                file_put_contents($log_path, "失败。原因业务逻辑操作失败\r\n\r\n", FILE_APPEND);
                            }
                            exit();
                        }
                    }catch (\Exception  $e){
                        if($debug) {
                            file_put_contents($log_path, "失败。原因" . print_r($e->getMessage(), true) . "\r\n\r\n", FILE_APPEND);
                        }
                        exit();
                    }
                }else{
                    if($debug) {
                        file_put_contents($log_path, "失败。原因订单不存在或已经支付成功\r\n\r\n", FILE_APPEND);
                    }
                    exit('0000');
                }

                #	需要比较返回的金额与商家数据库中订单的金额是否相等，只有相等的情况下才认为是交易成功.
                #	并且需要对返回的处理进行事务控制，进行记录的排它性处理，在接收到支付结果通知后，判断是否进行过业务逻辑处理，不要重复进行业务逻辑处理，防止对同一条交易重复发货的情况发生.
            }
        }else{
            if($debug) {
                file_put_contents($log_path, "失败。原因验签失败\r\n\r\n", FILE_APPEND);
            }
            exit();
        }

    }
	
	public function notify9(){
        $debug = true;
        $log_path = './pay_config/pay9_'.date('Y-m-d').'.log';
        $param = $_POST;

//        $param = array (
//            'memberid' => '10041',
//            'orderid' => 'SN20190627012801602578',
//            'transaction_id' => '363134797821812736cdada3c74b82e695',
//            'amount' => '100.0000',
//            'datetime' => '20190627013056',
//            'returncode' => '00',
//            'sign' => '2AA14D6A492038C6514250A2A819AECC',
//            'attach' => '1234|456',
//        );
		
//		$returnArray = array( // 返回字段
//            "pay_memberid" => $param["memberid"], // 商户ID
//            "pay_orderid" =>  $param["orderid"], // 订单号
//            "pay_amount" =>  $param["amount"], // 交易金额
//			"key"   =>  'uhapwt1esfl148qyf9ktu9lb7mftinr',
//        );

        $returnArray = array( // 返回字段
            "memberid" => $param["memberid"], // 商户ID
            "orderid" =>  $param["orderid"], // 订单号
            "amount" =>  $param["amount"], // 交易金额
            "datetime" =>  $param["datetime"], // 交易时间
            "transaction_id" =>  $param["transaction_id"], // 流水号
            "returncode" => $param["returncode"]
        );
      
        if($debug){
            file_put_contents($log_path,var_export($param,true)."\r\n\r\n",FILE_APPEND);
        }
        //验签
        $md5key = $key = Db::name('pay')->where(['pay_id'=>9])->value('key');
		ksort($returnArray);
		reset($returnArray);
		$md5str = "";
		foreach ($returnArray as $key => $val) {
			$md5str = $md5str . $key . "=" . $val . "&";
		}
		$sign = strtoupper(md5($md5str . "key=" . $md5key));
		//dump($sign);die;
		if ($sign == $param["sign"]) {
			if ($param["returncode"] == "00") {
				
				$recharge_tb = 'recharge';
                $order_sn = $param['orderid'];
                $re_row = Db::name($recharge_tb)->where(['pay_sn' => $order_sn])->find();

                if(!empty($re_row) && $re_row['status'] == 1){
                    //修改记录
                    try{
                        //处理其他业务
                        $Recharge = new Recharge();
                        $reslut = $Recharge->notify_recharge($order_sn, $param);
                        if($reslut){
                            exit('OK');
                        }else{
                            if($debug) {
                                file_put_contents($log_path, "失败。原因业务逻辑操作失败\r\n\r\n", FILE_APPEND);
                            }
                            exit();
                        }
                    }catch (\Exception  $e){
                        if($debug) {
                            file_put_contents($log_path, "失败。原因" . print_r($e->getMessage(), true) . "\r\n\r\n", FILE_APPEND);
                        }
                        exit();
                    }
                }else{
                    if($debug) {
                        file_put_contents($log_path, "失败。原因订单不存在或已经支付成功\r\n\r\n", FILE_APPEND);
                    }
                    exit('OK');
                }				  
			}
		}else{
            if($debug) {
                file_put_contents($log_path, "失败。原因验签失败\r\n\r\n", FILE_APPEND);
            }
            exit();
        }
    }

    public function notify10(){
        $debug = true;
        $log_path = './pay_config/pay10_'.date('Y-m-d').'.log';
        $param = $_POST;

        $returnArray = array( // 返回字段
            "memberid" => $param["memberid"], // 商户ID
            "orderid" =>  $param["orderid"], // 订单号
            "amount" =>  $param["amount"], // 交易金额
            "datetime" =>  $param["datetime"], // 交易时间
            "transaction_id" =>  $param["transaction_id"], // 流水号
            "returncode" => $param["returncode"]
        );

        if($debug){
            file_put_contents($log_path,var_export($param,true)."\r\n\r\n",FILE_APPEND);
        }
        //验签
        $md5key = $key = Db::name('pay')->where(['pay_id'=>10])->value('key');
        ksort($returnArray);
        reset($returnArray);
        $md5str = "";
        foreach ($returnArray as $key => $val) {
            $md5str = $md5str . $key . "=" . $val . "&";
        }
        $sign = strtoupper(md5($md5str . "key=" . $md5key));
        //dump($sign);die;
        if ($sign == $param["sign"]) {
            if ($param["returncode"] == "00") {

                $recharge_tb = 'recharge';
                $order_sn = $param['orderid'];
                $re_row = Db::name($recharge_tb)->where(['pay_sn' => $order_sn])->find();

                if(!empty($re_row) && $re_row['status'] == 1){
                    //修改记录
                    try{
                        //处理其他业务
                        $Recharge = new Recharge();
                        $reslut = $Recharge->notify_recharge($order_sn, $param);
                        if($reslut){
                            exit('OK');
                        }else{
                            if($debug) {
                                file_put_contents($log_path, "失败。原因业务逻辑操作失败\r\n\r\n", FILE_APPEND);
                            }
                            exit();
                        }
                    }catch (\Exception  $e){
                        if($debug) {
                            file_put_contents($log_path, "失败。原因" . print_r($e->getMessage(), true) . "\r\n\r\n", FILE_APPEND);
                        }
                        exit();
                    }
                }else{
                    if($debug) {
                        file_put_contents($log_path, "失败。原因订单不存在或已经支付成功\r\n\r\n", FILE_APPEND);
                    }
                    exit('OK');
                }
            }
        }else{
            if($debug) {
                file_put_contents($log_path, "失败。原因验签失败\r\n\r\n", FILE_APPEND);
            }
            exit();
        }
    }

}


class Notified4 {

    // 平台公钥
    protected $publicKey = '';

    // 商户私钥
    protected $merPriKey = '';

    public function __construct()
    {
        $row = Db::name('pay')->field('key,publickey')->where(['pay_id'=>4])->find();
        $this->publicKey = $row['publickey'];
        $this->merPriKey = $row['key'];
    }

    /**
     * 校验$value是否非空
     * if not set ,return true;
     * if is null , return true;
     **/
    protected function checkEmpty($value) {
        if (!isset($value))
            return true;
        if ($value === null)
            return true;
        if (trim($value) === "")
            return true;
        return false;
    }
    /**
     * 获取请求的JSON
     */
    public function get_json_request() {
        // 获取请求参数
        $request = file_get_contents('php://input');
        //测试数据
        //$request = '{"encrypt":"jrt8AwwUIlik1j29n3F8YNIuFsrSZwR+jHyFoA2p1kCyIY3Sz2EE71gt2DXvMXbZKAiUjVpB7xWZCmXicOxIg/osen9IyYdVLzra7gjwj/M/QYdQ7LfaOMwc4xL2kqbN8z81eyEbOt27/baPTY9TICBaOksVKxOCZ4kAPfDLzE5MVtG9Bm7ZqihXMzk3evGPQz8JNhqYwKjzqUdJc7nKv9D3fQ+JoXvdsSmCcur4bRWynb8Gwy9ZnkmliA9X7/CjA186C8MCFQLwokHLn7/H39+hjXjY4yjo5sn9WbyWYYSO0C8K5rDdfIcGaYqvX+INPYWWAEgDsq3CFkTEUbjF9w==","sign":"UNgQdkQDtvjJiu6oG62OwnK42OB/feCDdgn1jus+qsfN0sK15HFFOYSaLUU7BQWMoW9xTjY1S1cgJHPS2ck3iL2LywPX/aYf2FTbPKGI5MWV4JL3tR2TLokRunGrhRjepDE4iYA5um2DGNFWO5Wy1eTaHUSATE6yeYq+RwMzDwsnIo6EWjyjZFGr/vguiINg5s47dlezi3rdhgnVCdYSWYqgsYg8rAox3ybklOEGDVYDNgj2Kypp3JXiQe6fURyRUa9HizIQEcWy//VZ/J/Pd8+57ZTQ3ko/OjUbkaQOnT1R8guOsUNkDNrtwImWuOb5LGxclGhkBqTDCy0T+HTmYA=="}';
        if ($request == "") {
            return null;
        }
        //获取$request编码
        $encoding = mb_detect_encoding($request, 'auto');
        //convert to unicode
        if ($encoding != 'UTF-8') {
            //将$request的编码设置为UTF-8
            $request = iconv($encoding, 'UTF-8', $request);
        }
        //将json字符串转为数组
        $request = json_decode($request);
        return $request;
    }
    /**
     * 验签
     */
    public function verify($data, $sign) {
        if(!$this->checkEmpty($this->publicKey)){
            $pubKey = "-----BEGIN PUBLIC KEY-----\n".wordwrap($this->publicKey, 64, "\n", true)."\n-----END PUBLIC KEY-----";
        }
        ($pubKey) or die('平台RSA公钥错误。请检查公钥文件格式是否正确');

        //调用openssl内置方法验签，返回bool值
        return (openssl_verify($data, base64_decode($sign), $pubKey, OPENSSL_ALGO_SHA1) === 1);
    }

    /**
     *  解密
     **/
    public function decrypt($data) {
        if(!$this->checkEmpty($this->merPriKey)){
            //拼接字符串
            $priKey = "-----BEGIN RSA PRIVATE KEY-----\n" . wordwrap($this->merPriKey, 64, "\n", true) ."\n-----END RSA PRIVATE KEY-----";
        }

        ($priKey) or die('您使用的商户私钥格式错误，请检查RSA私钥配置');

        $decodes = str_split(base64_decode($data), 256);
        $strnull = "";
        $dcyCont = "";
        foreach ($decodes as $decode) {
            if (!openssl_private_decrypt($decode, $dcyCont, $priKey)) {
                echo "<br/>" . openssl_error_string() . "<br/>";
            }
            $strnull .= $dcyCont;
        }
        return $strnull;
    }
}
