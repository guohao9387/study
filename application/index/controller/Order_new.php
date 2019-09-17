<?php
namespace app\index\controller;
use think\Db;
class Order extends Common
{
    public function initialize()
    {
        parent::initialize();
    }
    public function close_order(){
        $now_all_price=get_all_price();
        //查询所有买涨爆仓
        $where=[];
        $where[]=['order_status','=',1];
        $order_list=db::name('order')->where($where)->select();
        $n=0;
        foreach($order_list as $val){
            $now_price=$now_all_price[$val['product_abbreviation']]['USD'];
            //买涨
            if($val['direction']==1){
                //如果设置止盈，且当前价格大于等于止盈价格
                if($val['target_profit_check']==2&&$now_price>=$val['target_profit']){
                    $profit=($val['target_profit']-$val['buy_price'])*$val['hand']*$val['contract'];
                    save_order($val,$now_price,4,$profit);
                    $n=1;
                    continue;
                }
                //如果设置止损，且当前价格小于等于止损价格
                elseif($val['stop_loss_check']==2&&$now_price<=$val['stop_loss']){
                    $profit=($val['stop_loss']-$val['buy_price'])*$val['hand']*$val['contract'];
                    save_order($val,$now_price,5,$profit);
                    $n=1;
                    continue;
                }
                //如果没有设置止盈止损，再判断是否需要爆仓
                //买涨时候，如果当前价格小于爆仓价格，则触发爆仓
                elseif($now_price<=$val['loss_point']){
                    new_baocang($val,$now_price,$val['direction']);
                    $n=1;
                    continue;
                }

            }
            if($val['direction']==2){
                //如果设置止盈，且当前价格小于等于止盈价格
                if($val['target_profit_check']==2&&$now_price<=$val['target_profit']){
                    $profit=($val['buy_price']-$val['target_profit'])*$val['hand']*$val['contract'];
                    save_order($val,$now_price,4,$profit);
                    $n=1;
                    continue;
                }
                //如果设置止损，且当前价格大于等于止损价格
                elseif($val['stop_loss_check']==2&&$now_price>=$val['stop_loss']){
                    $profit=($val['stop_loss']-$val['buy_price'])*$val['hand']*$val['contract'];
                    save_order($val,$now_price,5,$profit);
                    $n=1;
                    continue;
                }
                //如果没有设置止盈止损，再判断是否需要爆仓
                //买跌时候，如果当前价格大于爆仓价格，则触发爆仓
                elseif($now_price>=$val['loss_point']){
                    new_baocang($val,$now_price,$val['direction']);
                    $n=1;
                    continue;
                }
            }

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
    public function night_fee(){
//        if(cache('night_fee_time')==date('Y-m-d')){
//            echo '今日已运行过';
//        }
        $where=[];
        $where[]=['order_status','=',1];
        $order_list=db::name('order')->where($where)->order('oid asc')->select();
        $where=[];
        $where[]=['status','=',1];
        $product_night_fee=cache('product_night_fee');
        if(!$product_night_fee){
            $product_night_fee=cache_night_fee();
        }
        $now_all_price=get_all_price();
        $n=0;
        foreach($order_list as $val){
            $where=[];
            $where[]=['date','=',date("Y-m-d")];
            $where[]=['oid','=',$val['oid']];
            $res=db::name('night_fee')->where($where)->find();
            if($res){
                continue;
            }
            $now_price=$now_all_price[$val['product_abbreviation']]['USD'];
            $where=[];
            $where[]=['uid','=',$val['uid']];
            $user=db::name('user')->where($where)->find();
            //如果可用余额不足就爆仓
            if(($user['money']-$user['promise_money'])<$product_night_fee[$val['product_abbreviation']]){
                $profit=($now_price-$val['buy_price'])*$val['hand']*$val['contract'];
                if($val['direction']==1){
                    $amount=$profit;
                }else{
                    $amount=-$profit;
                }
                save_order($val,$now_price,6,$amount);
                $n=1;
            }else{
                db::startTrans();
                $where=[];
                $where[]=['uid','=',$val['uid']];
                $user=db::name('user')->where($where)->lock(true)->find();
                //扣除过夜费
                $status=db::name('user')->where($where)->setDec('money',$product_night_fee[$val['product_abbreviation']]);

                $data=[];
                $data['oid']=$val['oid'];
                $data['fee']=$product_night_fee[$val['product_abbreviation']];
                $data['date']=date("Y-m-d");
                $data['add_time']=date('Y-m-d H:i:s');
                $operation_id=db::name('night_fee')->insertGetId($data);
                //添加资金记录
                $data=[];
                $data['uid']=$user['uid'];
                $data['username']=$user['username'];
                $data['nickname']=$user['nickname'];
                $data['from_oid']=$val['oid'];
                $data['operation_id']=$operation_id;
                $data['before_money']=$user['money'];
                $data['money']=$product_night_fee[$val['product_abbreviation']];
                $data['after_money']=$user['money']-$product_night_fee[$val['product_abbreviation']];
                $data['type']=3;
                $data['type_info']='过夜费';
                $data['remark']='扣除过夜费';
                $data['add_time']=date('Y-m-d H:i:s');
                $status=db::name('user_money_log')->insert($data);
                 db::commit();
                //给用户发送消息
                $msg=[];
                $msg['status']=201;
                $msg['money']=-$product_night_fee[$val['product_abbreviation']];
                $msg['promise_money']=0;
                bar($user['uid'],$msg);
                $msg=[];
                $msg['status']=1002;
                $msg['oid']=$val['oid'];
                send_msg_agent($user['agent_id'],$msg);
            }

        }
        if($n==1){
            $msg=[];
            $msg['status']=1003;
            //给总后台发消息，刷新持仓页面
            bar(1,$msg);
            return 'ok';
        }else{
            return 'success';
        }
    }
}
