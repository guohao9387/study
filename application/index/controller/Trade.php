<?php
namespace app\index\controller;
use think\Db;
class Trade extends Common
{
    public $user;
    public $user_name;
    public function initialize()
    {
        parent::initialize();
        $this->user = session('user');
        $this->user_name = session('user_name');
        if (empty($this->user)) {
            $this->redirect('/index/Login/login');
        }
    }
    public function index2(){
        return $this->fetch();
    }
    public function index()
    {
        $user=db::name('user')->where('uid',$this->user)->find();
        $user['real_money']=$user['money']-$user['promise_money'];
        $this->assign('user',$user);


        $where=[];
        $where[]=['status','=',1];
        $where[]=['show_status','=',1];
        $product_list=db::name('product')->where($where)->select();
        $this->assign('product_list',$product_list);

        $where=[];
        $where[]=['order_status','=',1];
        $where[]=['uid','=',$this->user];
        $keep_order_list=db::name('order')->where($where)->select();
        $this->assign('keep_order_list',$keep_order_list);

        return $this->fetch();
    }
    public function create_order(){
//        if(request()->isAjax()){
        if(1){
            $param=input('post.');
            $param['id']=3;
            $param['hand']=1;
            $param['win']=0;
            $param['loss']=0;
            $param['direction']=2;
            $where=[];
            $where[]=['status','=',1];
            $where[]=['show_status','=',1];
            $where[]=['trade_status','=',1];
            $where[]=['id','=',$param['id']];
            //产品信息
            $product_info=db::name('product')->where($where)->find();
            if($product_info){
                //判断手数范围
                if($param['hand']<$product_info['min_hand']){
                    return json_return(0,'小于最小手数');
                }
                if($param['hand']>$product_info['max_hand']){
                    return json_return(0,'大于最大手数');
                }
                //当前价格
                $now_price=get_now_price($product_info['abbreviation']);
                if(!$now_price){
                    return json_return(0,'网络错误，请重试');
                }
                //判断止盈止损范围
                if($param['win']==1&&$param['target_profit']>$now_price+$product_info['wave']){
                    return json_return(0,'止盈大于最高止盈范围');
                }
                if($param['loss']==1&&$param['stop_loss']<$now_price-$product_info['wave']){
                    return json_return(0,'止损小于最小止损范围');
                }
                //总价
                $amount=$now_price*$product_info['contract']*$param['hand'];
                //手续费
                $fee=$param['hand']*$product_info['fee'];

                db::startTrans();
                $user=db::name('user')->where('uid',$this->user)->lock(true)->find();
//                dump($amount+$fee);die;
                if(($user['money']-$user['promise_money'])<($amount+$fee)){
                    db::rollback();
                    return json_return(0,'账户余额不足');
                }
                //操作保证金账户
                $status=db::name('user')->where('uid',$this->user)->setInc('promise_money',$amount);
                if(!$status){
                    db::rollback();
                    return json_return(0,'操作失败，请重试');
                }
                //操作账户余额，扣除手续费
                $status=db::name('user')->where('uid',$this->user)->setDec('money',$fee);
                if(!$status){
                    db::rollback();
                    return json_return(0,'操作失败，请重试');
                }
                //创建订单
                $data=[];
                $data['order_sn']='sn'.time().rand(1000,9999);
                $data['uid']=$this->user;
                $data['username']=$this->user_name;
                $data['agent_id']=$user['agent_id'];
                $data['agent_name']=$user['agent_name'];
                $data['pid']=$product_info['id'];
                $data['product_name']=$product_info['name'];
                $data['product_abbreviation']=$product_info['abbreviation'];
                $data['money']=$amount;
                $data['hand']=$param['hand'];
                $data['contract']=$product_info['contract'];
                $data['fee']=$fee;
                $data['direction']=$param['direction'];
                $data['buy_price']=$now_price;
                if($param['win']==1){
                    $data['target_profit']=$param['target_profit'];
                }else{
                    $data['target_profit']=0;
                }
                if($param['loss']==1){
                    $data['stop_loss']=$param['stop_loss'];
                }else{
                    $data['stop_loss']=0;
                }
                $data['add_time']=date('Y-m-d H:i:s');
//                dump($data);die;
                $oid=db::name('order')->insertGetId($data);
                if(!$oid){
                    db::rollback();
                    return json_return(0,'操作失败，请重试');
                }
                //记录用户操作
                $operation_id=add_user_operation($user['uid'],$user['username'],1,1,'会员建仓', $_SERVER['REQUEST_URI'], serialize($_REQUEST),$oid);
                //添加资金记录
                $data=[];
                $data['uid']=$this->user;
                $data['username']=$this->user_name;
                $data['nickname']=$user['nickname'];
                $data['from_oid']=$oid;
                $data['operation_id']=$operation_id;
                $data['before_money']=$user['money'];
                $data['money']=$fee;
                $data['after_money']=$user['money']-$fee;
                $data['type']=3;
                $data['type_info']='建仓';
                $data['remark']='会员建仓，扣除手续费';
                $data['add_time']=date('Y-m-d H:i:s');
                $status=db::name('user_money_log')->insert($data);
                if($status){
                    db::commit();
                    return json_return(1,'建仓成功',$data);
                }else{
                    db::rollback();
                    return json_return(0,'操作失败，请重试');
                }
            }else{
                return json_return(0,'产品异常');
            }
        }
    }
    public function close_order(){
        if(request()->isAjax()){
//        if(1){
            $param=input('post.');
//            $param['oid']=100004;
            $where=[];
            $where[]=['oid','=',$param['oid']];
            $where[]=['uid','=',$this->user];
            $where[]=['order_status','=',1];
            db::startTrans();
            $order=db::name('order')->where($where)->lock(true)->find();
            if(!$order){
                db::rollback();
                return json_return(0,'订单信息有误');
            }
            //当前价格
            $now_price=get_now_price($order['product_abbreviation']);
            if(!$now_price){
                db::rollback();
                return json_return(0,'网络错误，请重试');
            }
            $user=db::name('user')->where('uid',$this->user)->lock(true)->find();
            //操作用户保证金
            $status=db::name('user')->where('uid',$this->user)->setDec('promise_money',$order['money']);
            if(!$status){
                db::rollback();
                return json_return(0,'操作失败');
            }
            //计算用户盈亏
            //如果平局
            if($now_price==$order['buy_price']){
                $money=0;
            }else{
                $profit=($now_price-$order['buy_price'])*$order['hand']*$order['contract'];
                //如果涨了
                if($now_price>$order['buy_price']){
                    //买入(买涨）
                    if($order['direction']==1){
                        $money=$profit;
                        //卖出(买跌）
                    }elseif($order['direction']==2){
                        $money=-$profit;
                    }
                    //如果跌了
                }elseif($now_price<$order['buy_price']){
                    //买入(买涨）
                    if($order['direction']==1){
                        $money=-$profit;
                        //卖出(买跌）
                    }elseif($order['direction']==2){
                        $money=$profit;
                    }
                }
            }
            //操作用户账户
            $status=db::name('user')->where('uid',$this->user)->setInc('money',$money);
            if(!$status){
                db::rollback();
                return json_return(0,'操作失败');
            }
            //更新订单状态
            $data=[];
            $data['oid']=$order['oid'];
            $data['sell_price']=$now_price;
            $data['profit']=$now_price;
            $data['order_status']=2;
            $data['order_close_type']=1;
            $data['update_time']=date('Y-m-d H:i:s');
            $status=db::name('order')->update($data);
            if(!$status){
                db::rollback();
                return json_return(0,'操作失败');
            }
            //记录用户操作
            $operation_id=add_user_operation($user['uid'],$user['username'],1,1,'会员平仓', $_SERVER['REQUEST_URI'], serialize($_REQUEST),$order['oid']);
            //添加资金记录
            $data=[];
            $data['uid']=$this->user;
            $data['username']=$this->user_name;
            $data['nickname']=$user['nickname'];
            $data['from_oid']=$order['oid'];
            $data['operation_id']=$operation_id;
            $data['before_money']=$user['money'];
            $data['money']=$money;
            $data['after_money']=$user['money']+$money;
            $data['type']=3;
            $data['type_info']='平仓';
            $data['remark']='会员平仓，结算收益';
            $data['add_time']=date('Y-m-d H:i:s');
            $status=db::name('user_money_log')->insert($data);
            if($status){
                db::commit();
                return json_return(1,'平仓成功',$data);
            }else{
                db::rollback();
                return json_return(0,'操作失败，请重试');
            }
        }
    }
}
