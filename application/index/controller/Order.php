<?php
namespace app\index\controller;
use think\Db;
class Order extends Common
{
    public function initialize()
    {
        parent::initialize();
    }
    public function index()
    {
        return $this->fetch();
    }
    public function close_order(){
        $now_all_price=get_all_price();
//        dump($now_all_price);die;
        //查询所有设置止盈的订单
        $where=[];
        $where[]=['order_status','=',1];
        $where[]=['target_profit_check','=',2];
        $target_profit_order_list=db::name('order')->where($where)->order('oid desc')->select();
        $n=0;
        if($target_profit_order_list){
            foreach($target_profit_order_list as $val){
                //当前价格
                $now_price=$now_all_price[$val['product_abbreviation']]['USD'];
                //只判断用户买涨，而且达到止盈标准(止盈价格小于当前价格)
                if($val['direction']==1&&$now_price>=$val['target_profit']){
                    db::startTrans();
                    $where=[];
                    $where[]=['status','=',1];
                    $where[]=['uid','=',$val['uid']];
                    $user=db::name('user')->where($where)->lock(true)->find();
                    //盈利金额(正数）
                    $profit=($now_price-$val['buy_price'])*$val['hand']*$val['contract']*$val['lever'];

                    //操作用户保证金-扣除保证金
                    $status=db::name('user')->where('uid',$user['uid'])->setDec('promise_money',$val['money']);
                    if(!$status){
                        db::rollback();
                        return json_return(0,'操作失败');
                    }

                    //操作账户余额-增加真实盈利金额
                    $status=db::name('user')->where('uid',$user['uid'])->setInc('money',$profit);
                    if(!$status){
                        db::rollback();
                        return json_return(0,'操作失败');
                    }

                    $after=db::name('user')->where('uid',$user['uid'])->find();

                    //更新订单状态
                    $data=[];
                    $data['oid']=$val['oid'];
                    $data['sell_price']=$now_price;
                    $data['profit']=$profit;
                    $data['order_status']=2;
                    $data['order_close_type']=4;
                    $data['update_time']=date('Y-m-d H:i:s');
                    $status=db::name('order')->update($data);
                    if(!$status){
                        db::rollback();
                        return json_return(0,'操作失败');
                    }
                    //添加资金记录
                    $data=[];
                    $data['uid']=$user['uid'];
                    $data['username']=$user['username'];
                    $data['nickname']=$user['nickname'];
                    $data['from_oid']=$val['oid'];
                    $data['operation_id']=0;
                    $data['before_money']=$user['money'];
                    $data['money']=$profit;
                    $data['after_money']=$after['money'];
                    $data['type']=3;
                    $data['type_info']='平仓';
                    $data['remark']='止盈平仓，结算收益';
                    $data['add_time']=date('Y-m-d H:i:s');
                    $status=db::name('user_money_log')->insert($data);
                    if($status){
                        db::commit();
                        //给用户发送消息
                        $msg=[];
                        $msg['status']=101;
                        $msg['msg']='您的订单【单号：'.$val['order_sn'].'】达到止盈标准，已经自动平仓';
                        $msg['oid']=$val['oid'];
                        $msg['money']=number_format($after['money'],2,'.','');
                        $msg['promise_money']=number_format($after['promise_money'],2,'.','');
                        $msg['real_money']=number_format(($after['money']-$after['promise_money']),2,'.','');
                        bar($user['uid'],$msg);
                        return json_return(1,'平仓成功');
                    }else{
                        db::rollback();
                        return json_return(0,'操作失败，请重试');
                    }
                }
            }
            $n=1;
        }
        //查询所有设置止损的订单
        $where=[];
        $where[]=['order_status','=',1];
        $where[]=['stop_loss_check','=',2];
        $stop_loss_order_list=db::name('order')->where($where)->order('oid desc')->select();
        if($stop_loss_order_list){
            foreach($stop_loss_order_list as $val){
                //当前价格
                $now_price=$now_all_price[$val['product_abbreviation']]['USD'];
                //只判断用户买涨，而且达到止盈标准(止盈价格小于当前价格)
                if($val['direction']==2&&$now_price<=$val['stop_loss']){
                    db::startTrans();
                    $where=[];
                    $where[]=['status','=',1];
                    $where[]=['uid','=',$val['uid']];
                    $user=db::name('user')->where($where)->lock(true)->find();
                    //盈利金额
                    $profit=($val['buy_price']-$now_price)*$val['hand']*$val['contract']*$val['lever'];

                    //操作用户保证金
                    $status=db::name('user')->where('uid',$user['uid'])->setDec('promise_money',$val['money']);
                    if(!$status){
                        db::rollback();
                        return json_return(0,'操作失败');
                    }

                    //操作账户余额
                    $status=db::name('user')->where('uid',$user['uid'])->setDec('money',$profit);
                    if(!$status){
                        db::rollback();
                        return json_return(0,'操作失败');
                    }

                    $after=db::name('user')->where('uid',$user['uid'])->find();

                    //更新订单状态
                    $data=[];
                    $data['oid']=$val['oid'];
                    $data['sell_price']=$now_price;
                    $data['profit']=$profit;
                    $data['order_status']=2;
                    $data['order_close_type']=5;
                    $data['update_time']=date('Y-m-d H:i:s');
                    $status=db::name('order')->update($data);
                    if(!$status){
                        db::rollback();
                        return json_return(0,'操作失败');
                    }
                    //添加资金记录
                    $data=[];
                    $data['uid']=$user['uid'];
                    $data['username']=$user['username'];
                    $data['nickname']=$user['nickname'];
                    $data['from_oid']=$val['oid'];
                    $data['operation_id']=0;
                    $data['before_money']=$user['money'];
                    $data['money']=$profit;
                    $data['after_money']=$after['money'];
                    $data['type']=3;
                    $data['type_info']='平仓';
                    $data['remark']='止损平仓，结算收益';
                    $data['add_time']=date('Y-m-d H:i:s');
                    $status=db::name('user_money_log')->insert($data);
                    if($status){
                        db::commit();
                        //给用户发送消息
                        $msg=[];
                        $msg['status']=101;
                        $msg['msg']='您的订单【单号：'.$val['order_sn'].'】达到止损标准，已经自动平仓';
                        $msg['oid']=$val['oid'];
                        $msg['money']=number_format($after['money'],2,'.','');
                        $msg['promise_money']=number_format($after['promise_money'],2,'.','');
                        $msg['real_money']=number_format(($after['money']-$after['promise_money']),2,'.','');
                        bar($user['uid'],$msg);
                        return json_return(1,'平仓成功');
                    }else{
                        db::rollback();
                        return json_return(0,'操作失败，请重试');
                    }
                }
            }
            $n=1;
        }
        if($n==1){
            $msg=[];
            $msg['status']=1003;
            //给总后台发消息，刷新持仓页面
            bar(1,$msg);
            return 'ok';
        }else{
            return 'null';
        }

    }
}
