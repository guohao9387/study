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
                    save_order($val,$now_price,3,-$val['money']);
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
                    save_order($val,$now_price,3,-$val['money']);
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
        $order_list=db::name('order')->where($where)->select();
        $where=[];
        $where[]=['status','=',1];
        $product_night_fee=cache('product_night_fee');
        if(!$product_night_fee){
            $product_night_fee=cache_night_fee();
        }
        $now_all_price=get_all_price();

        foreach($order_list as $val){
            $now_price=$now_all_price[$val['product_abbreviation']]['USD'];
            $where=[];
            $where[]=['uid','=',$val['uid']];
            $user=db::name('user')->where($where)->lock(true)->find();
            if($user['money']<$product_night_fee[$val['product_abbreviation']]){
                save_order($val,$now_price,6);
            }else{

            }
            $status=db::name('user')->where($where)->setDec('money',$product_night_fee[$val['product_abbreviation']]);

        }
        cache('night_fee_time',date('Y-m-d'));

    }
}
