<?php
namespace app\mobile\controller;
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
//            $this->redirect('/index/Login/login');
        }
    }

    public function index()
    {
        if($this->user){
            $user=db::name('user')->where('uid',$this->user)->find();
            $user['real_money']=$user['money']-$user['promise_money'];
            $where=[];
            $where[]=['order_status','=',1];
            $where[]=['uid','=',$this->user];
            $keep_order_list=db::name('order')->order('oid desc')->where($where)->select();
        }else{
            $user=[];
            $user['real_money']=0.00;
            $user['uid']=4;
            $user['money']=0.00;
            $user['promise_money']=0.00;
            $user['lever']=1;
            $keep_order_list=[];
        }
        $this->assign('user',$user);
        $this->assign('keep_order_list',$keep_order_list);

        $where=[];
        $where[]=['status','=',1];
        $where[]=['show_status','=',1];
        $where[]=['id','=',input('get.id')];
        $product=db::name('product')->where($where)->find();
        if(!$product){
            $this->error('该产品暂未开放','/mobile/Index/index');
        }
        $this->assign('product',$product);

        $where=[];
        $where[]=['status','=',1];
        $where[]=['show_status','=',1];
        $product_list=db::name('product')->where($where)->select();
        $this->assign('product_list',$product_list);

        return $this->fetch();
    }
    public function create_order(){
        if(request()->isAjax()){
//        if(1){
            if(!$this->user){
                return json_return(0,'请先登录');
            }
            $param=input('post.');

//            $param['id']=3;
//            $param['hand']=1;
//            $param['win']=0;
//            $param['loss']=0;
//            $param['direction']=2;
            if($param['direction']!=1&&$param['direction']!=2){
                return json_return(0,'方向有误');
            }

            $where=[];
            $where[]=['status','=',1];
            $where[]=['show_status','=',1];
            $where[]=['trade_status','=',1];
            $where[]=['id','=',$param['id']];
            //产品信息
            $product_info=db::name('product')->where($where)->find();
            if($product_info){
                $now_price=get_now_price($product_info['abbreviation']);
                //当前价格
                if(!$now_price){
                    return json_return(0,'网络错误，请重试');
                }
                //判断止盈止损

                if(isset($param['target_profit_check'])&&$param['target_profit_check']==1){
                    if($param['direction']==1){
                        if($param['target_profit']<($now_price+$product_info['wave'])){
                            return json_return(0,'止盈应大于等于最小止盈值');
                        }
                    }else{
                        if($param['target_profit']>($now_price-$product_info['wave'])){
                            return json_return(0,'止盈应小于等于最小止盈值');
                        }
                    }
                }
                if(isset($param['stop_loss_check'])&&$param['stop_loss_check']==1){
                    if($param['direction']==1){
                        if($param['stop_loss']>($now_price-$product_info['wave'])){
                            return json_return(0,'止损应小于等于最小止损值');
                        }
                    }else{
                        if($param['stop_loss']<($now_price+$product_info['wave'])){
                            return json_return(0,'止损应大于等于最小止损值');
                        }
                    }
                }
                //判断手数范围
                if($param['hand']<$product_info['min_hand']){
                    return json_return(0,'小于最小手数');
                }
                if($param['hand']>$product_info['max_hand']){
                    return json_return(0,'大于最大手数');
                }

                db::startTrans();
                $map=[];
                $map[]=['uid','=',$this->user];
                $map[]=['status','=',1];
                $user=db::name('user')->where($map)->lock(true)->find();
//                dump($amount+$fee);die;
                if(!$user){
                    return json_return(0,'网络错误，请重试');
                }
                if($user['trade_status']==2){
                    return json_return(0,'交易受限，请联系客服');
                }

                //总价
                $amount=$now_price*$product_info['contract']*$param['hand']/$user['lever'];
                //手续费
                $fee=$param['hand']*$product_info['fee'];
                //买涨时候的爆仓价格
                if($param['direction']==1){
                    $point=$now_price*(1-1/$user['lever']);
                }else{
                    //买跌时候的爆仓价格
                    $point=$now_price*(1+1/$user['lever']);
                }

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
                $order=[];
                $order['order_sn']='sn'.time().rand(1000,9999);
                $order['uid']=$this->user;
                $order['username']=$this->user_name;
                $order['agent_id']=$user['agent_id'];
                $order['agent_name']=$user['agent_name'];
                $order['pid']=$product_info['id'];
                $order['product_name']=$product_info['name'];
                $order['product_abbreviation']=$product_info['abbreviation'];
                $order['money']=$amount;
                $order['first_money']=$amount;
                $order['hand']=$param['hand'];
                $order['contract']=$product_info['contract'];
                $order['lever']=$user['lever'];
                $order['fee']=$fee;
                $order['direction']=$param['direction'];
                $order['buy_price']=$now_price;
                if(isset($param['target_profit_check'])){
                    $order['target_profit_check']=2;
                    $order['target_profit']=$param['target_profit'];
                }else{
                    $order['target_profit_check']=1;
                    $order['target_profit']=0;
                }
                if(isset($param['stop_loss_check'])){
                    $order['stop_loss_check']=2;
                    $order['stop_loss']=$param['stop_loss'];
                }else{
                    $order['stop_loss_check']=1;
                    $order['stop_loss']=0;
                }
                $order['loss_point']=$point;
                $order['add_time']=date('Y-m-d H:i:s');
//                dump($data);die;
                $oid=db::name('order')->insertGetId($order);
                if(!$oid){
                    db::rollback();
                    return json_return(0,'操作失败，请重试');
                }
                $order['oid']=$oid;
                $order['now_price']=$now_price;
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
                    $msg=[];
                    $msg['status']=1001;
                    $msg['order']=$order;
                    //给总后台发消息，刷新持仓页面
                    bar(1,$msg);
                    return json_return(1,'建仓成功',$order);
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
            if(!$this->user){
                return json_return(0,'请先登录');
            }
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
            $map=[];
            $map[]=['uid','=',$this->user];
            $map[]=['status','=',1];
            $user=db::name('user')->where($map)->lock(true)->find();
            if(!$user){
                return json_return(0,'网络错误，请重试');
            }
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
                //买入(买涨）
                if($order['direction']==1){
                    $money=$profit;
                    //卖出(买跌）
                }elseif($order['direction']==2){
                    $money=-$profit;
                }
//                //如果涨了
//                if($now_price>$order['buy_price']){
//                    //买入(买涨）
//                    if($order['direction']==1){
//                        $money=$profit;
//                        //卖出(买跌）
//                    }elseif($order['direction']==2){
//                        $money=-$profit;
//                    }
//                    //如果跌了
//                }elseif($now_price<$order['buy_price']){
//                    //买入(买涨）
//                    if($order['direction']==1){
//                        $money=$profit;
//                        //卖出(买跌）
//                    }elseif($order['direction']==2){
//                        $money=-$profit;
//                    }
//                }

            }
            //操作用户账户
            $status=db::name('user')->where('uid',$this->user)->setInc('money',$money);
            if(!$status){
                db::rollback();
                return json_return(0,'操作失败');
            }
            $after=db::name('user')->where('uid',$this->user)->find();
            //更新订单状态
            $data=[];
            $data['oid']=$order['oid'];
            $data['sell_price']=$now_price;
            $data['profit']=$money;
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
                $msg=[];
                $msg['status']=1002;
                $msg['oid']=$order['oid'];
                //给总后台发消息，刷新持仓页面
                bar(1,$msg);
                $info=[];
                $info['oid']=$order['oid'];
                $info['money']=$money;
                $info['promise_money']=-$order['money'];
                return json_return(1,'平仓成功',$info);
            }else{
                db::rollback();
                return json_return(0,'操作失败，请重试');
            }
        }
    }
}
