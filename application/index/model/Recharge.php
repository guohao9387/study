<?php

namespace app\index\model;
use think\db;
use think\Model;

class Recharge extends Model
{
    protected $pk = 'pay_id';

    //创建支付订单
    public function creat_recharge($uid, $money, $post_param,$type=1)
    {

        $return = [];
        if (!is_numeric($money) || strpos($money, ".") !== false) {
            $return['status'] = 0;
            $return['info']   = "转入金额必须为整数";
            return $return;
        }
        if ($money < 100) {
            $return['status'] = 0;
            $return['info']   = "单笔转入不能小于100元";
            return $return;
        }
        $min_recharge = get_system_config('min_recharge');
        if ($money < $min_recharge) {
            $return['status'] = 0;
            $return['info']   = "单笔转入最小" . $min_recharge . "元";
            return $return;
        }

        $user_info = db::name('user')->find($uid);
        if($user_info['recharge_type']==2){
            $return['status'] = 0;
            $return['info']   = "参数错误";
            return $return;
        }
        //添加充值记录
        $data                 = [];
        $data['pay_sn']       = creat_recharge_sn('SN');
        $data['uid']          = $uid;
        $data['agent_id']     = $user_info['agent_id'];
        $data['amount']       = $money;
        $data['amount']       = $money;
        $data['type']         = $type;
        $data['pay_time']     = '';
        $data['post_param']   = json_encode($post_param);
        $data['return_param'] = '';
        $data['add_time']     = date('Y-m-d H:i:s');
        $data['update_time']  = date('Y-m-d H:i:s');
        $data['status']       = 1;
        $reslut               = db::name('recharge')->insert($data);
        if ($reslut) {
            session('trade_time',time()+1200);
            $return['status'] = 1;
            $return['info']   = $data;
            return $return;
        } else {
            $return['status'] = 0;
            $return['info']   = "创建订单失败";
            return $return;
        }
    }

    //支付回调付款
    public function notify_recharge($pay_sn, $return_param)
    {

        $pay_order_info = $this->where(['pay_sn' => $pay_sn])->find();
        if (empty($pay_order_info)) {
            $return['status'] = 0;
            $return['info']   = "未查到对应信息";
            return $return;
        }
       // dump($pay_order_info);
        if ($pay_order_info['status'] == 2) {
            $return['status'] = 1;
            $return['info']   = "付款成功";
            return $return;
        } else {
            Db::startTrans();
            try {
                //更新充值订单
                $data                 = [];
                $data['pay_id']       = $pay_order_info['pay_id'];
                $data['return_param'] = json_encode($return_param);
                $data['pay_time']     = date('Y-m-d H:i:s');
                $data['update_time']  = date('Y-m-d H:i:s');
                $data['status']       = 2;
                $reslut               = $this->update($data);

                $user_info                     = db::name('user')->lock(true)->where('uid', $pay_order_info['uid'])->find();
                //增加账户余额
                db::name('user')->where('uid', $pay_order_info['uid'])->setInc('money', $pay_order_info['amount']);
                //增加用户日志
                $user_log_data                 = [];
                $user_log_data['uid']          = $pay_order_info['uid'];
                $user_log_data['agent_id']     = $user_info['agent_id'];
                $user_log_data['username']     = $user_info['username'];
                $user_log_data['type']         = 1;
                $user_log_data['type_info']    = '用户充值';
                $user_log_data['amount']       = $pay_order_info['amount'];
                $user_log_data['before_money'] = $user_info['money'];
                $user_log_data['after_money']  = $user_info['money'] + $pay_order_info['amount'];
                $user_log_data['note']         = '用户充值';
                $user_log_data['from_oid']     = $pay_order_info['pay_id'];
                $user_log_data['add_time']     = date('Y-m-d H:i:s');
                $user_log_data['update_time']  = date('Y-m-d H:i:s');
      
                db::name('user_bill')->insert($user_log_data);


                // 提交事务
                Db::commit();

                $return['status'] = 1;
                $return['info']   = "付款成功";
                //更新支付方式收入统计金额
                Db::name('pay')->where(['id'=>$pay_order_info['type']])->setInc('total',$pay_order_info['amount']);

                return $return;
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                $return['status'] = 0;
                $return['info']   = "付款失败";
                return $return;
            }
        }
    }

}
