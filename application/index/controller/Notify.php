<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Notify extends Controller
{
    public function index(){
        $key = '1821b732aaa00678caeec99530e399a8';//商户密钥

        $data['appid'] = $_REQUEST['appid'];
        $data['out_trade_no'] = $_REQUEST['out_trade_no'];
        $data['pay_id'] = $_REQUEST['pay_id'];
        $data['payment'] = $_REQUEST['payment'];
        $data['pay_no'] = $_REQUEST['pay_no'];
        $data['resp_code'] = $_REQUEST['resp_code'];
        $data['resp_desc'] = $_REQUEST['resp_desc'];
        $data['tran_amount'] =$_REQUEST['tran_amount'];//费率后金额
        $data['amount'] =$_REQUEST['amount'];//订单金额(以这个上分)
        $data['version'] = $_REQUEST['version'];
        ksort($data);
        $reqData = array();
        foreach ($data as $k => $v) {
            $reqData[] = $k . '=' . $v;
        }
        $str = implode('&', $reqData);
        $sign = md5($str .$key );
        if($sign==$_REQUEST['sign']){
            if($data['resp_code']=='00'){
                //业务....
                db::startTrans();
                $where=[];
                $where['order_sn']=$_REQUEST['out_trade_no'];
                $order=db::name('recharge')->lock(true)->where($where)->find();
                $money=number_format($_REQUEST['amount']/$order['rate'], 2, ".", "");

                if($order){
                    if($order['status']==2){
                        db::rollback();
                        echo 'success';
                        exit;
                    }else{
                        $data=[];
                        $data['status']=2;
                        $data['update_time']=date('Y-m-d H:i:s');
                        $status=db::name('order')->where($where)->update($data);
                        if(!$status){
                            db::rollback();
                            echo 'error';
                            exit;
                        }
                        $where=[];
                        $where['uid']=$order['uid'];
                        $user=db::name('user')->where($where)->lock(true)->find();
                        if(!$user){
                            db::rollback();
                            echo 'error';
                            exit;
                        }
                        $status=db::name('user')->where($where)->setInc('money',$money);
                        if(!$status){
                            db::rollback();
                            echo 'error';
                            exit;
                        }
                        $data=[];
                        $data['uid']=$user['uid'];
                        $data['username']=$user['username'];
                        $data['nickname']=$user['nickname'];
                        $data['from_oid']=$order['id'];
                        $data['operation_id']=0;
                        $data['before_money']=$user['money'];
                        $data['money']=$money;
                        $data['after_money']=$user['money']+$money;
                        $data['type']=1;
                        $data['type_info']='自动充值';
                        $data['remark']='自动充值';
                        $data['add_time']=date('Y-m-d H:i:s');
                        $status=db::name('user_money_log')->insert($data);
                        if($status){
                            db::commit();
                            echo 'success';
                            exit;
                        }else{
                            db::rollback();
                            echo 'error';
                            exit;
                        }
                    }
                }else{
                    db::rollback();
                    echo 'null';
                    exit;
                }
            }
        }else{
            echo '签名不正确';
            exit;
        }
    }
}
