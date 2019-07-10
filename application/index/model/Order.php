<?php

namespace app\index\model;

use app\croupier\model\Table as croupierTable;
use think\Db;
use think\facade\Cache;
use think\Model;

class Order extends Model
{
    //
    protected $pk = 'oid';

    //创建订单
    //$data=['zhuang'=>100，'xian'=>50]
    public function creat_order($uid, $table_id, $user_betting_money)
    {

        $total_betting_money = 0;
        if (empty($user_betting_money['zhuang'])) {
            $user_betting_money['zhuang'] = 0;
        }
        if (empty($user_betting_money['xian'])) {
            $user_betting_money['xian'] = 0;
        }
        if (empty($user_betting_money['bjl_he'])) {
            $user_betting_money['bjl_he'] = 0;
        }
        if (empty($user_betting_money['zhuangdui'])) {
            $user_betting_money['zhuangdui'] = 0;
        }
        if (empty($user_betting_money['xiandui'])) {
            $user_betting_money['xiandui'] = 0;
        }
        if (empty($user_betting_money['long'])) {
            $user_betting_money['long'] = 0;
        }
        if (empty($user_betting_money['hu'])) {
            $user_betting_money['hu'] = 0;
        }
        if (empty($user_betting_money['lh_he'])) {
            $user_betting_money['lh_he'] = 0;
        }

        foreach ($user_betting_money as $k => $v) {
            $total_betting_money += $v;
        }
        if ($total_betting_money == 0) {
            return '请下注后投注';
        }
       
        $user_info  = db::name('user')->find($uid);
        $table_info = db::name('table')->find($table_id);
        //根据桌台判断下注情况是否正确
        if ($table_info['game_id'] == 1) {
            if (!empty($user_betting_money['long']) || !empty($user_betting_money['hu']) || !empty($user_betting_money['lh_he'])) {
                return '非法下注';
            }
        } elseif ($table_info['game_id'] == 2) {
            if (!empty($user_betting_money['zhuang']) || !empty($user_betting_money['xian']) || !empty($user_betting_money['bjl_he']) || !empty($user_betting_money['zhuangdui']) || !empty($user_betting_money['xiandui'])) {
                return '非法下注';
            }
        }

        if (empty($user_info)) {
            return '下单会员信息不存在';
        }
        if ($user_info['trade_status'] == 2) {
            return '限制交易，请联系客服处理';
        }
        if ($user_info['type'] == 3) {
            return '电投账户无法通过系统下单';
        }

        if (empty($table_info)) {
            return '下单桌台信息不存在';
        }
        if ($table_info['status'] != 1) {
            return '桌台状态暂无法下注';
        }
        if ($table_info['is_system'] != 1) {
            return '桌台暂不支持系统下注';
        }

        //获取最后异一场交易数据
        $map        = [];
        $map[]      = ['table_id', '=', $table_info['table_id']];
        $trade_info = db::name('table_trade')->where($map)->order('trade_id', 'desc')->find();
        if (empty($trade_info)) {
            return '桌台暂无交易场次';
        }
        if ($trade_info['trade_status'] != 2) {
            return '该桌台已暂停下注';
        }

        $trade_end_time = strtotime($trade_info['trade_start_time']) + $table_info['second']-11; //计算下注+倒计时时间
        if (time() > $trade_end_time) {
            return '该桌台已暂停下注';
        }
        //计算可用限红
        $xianhong_min_limti = [];
        $xianhong_max_limti = [];
        if ($user_info['limit_type'] == 1) {
            $xianhong_min_limti['zhuang']    = $user_info['trade_min'];
            $xianhong_min_limti['xian']      = $user_info['trade_min'];
            $xianhong_min_limti['bjl_he']    = $user_info['trade_min'];
            $xianhong_min_limti['zhuangdui'] = $user_info['trade_min'];
            $xianhong_min_limti['xiandui']   = $user_info['trade_min'];
            $xianhong_min_limti['long']      = $user_info['trade_min'];
            $xianhong_min_limti['hu']        = $user_info['trade_min'];
            $xianhong_min_limti['lh_he']     = $user_info['trade_min'];

            $xianhong_max_limti['zhuang']    = floor($user_info['trade_max'] * config('app.trade_limit_zhuang'));
            $xianhong_max_limti['xian']      = floor($user_info['trade_max'] * config('app.trade_limit_xian'));
            $xianhong_max_limti['bjl_he']    = floor($user_info['trade_max'] * config('app.trade_limit_bjl_he'));
            $xianhong_max_limti['zhuangdui'] = floor($user_info['trade_max'] * config('app.trade_limit_zhuangdui'));
            $xianhong_max_limti['xiandui']   = floor($user_info['trade_max'] * config('app.trade_limit_xiandui'));
            $xianhong_max_limti['long']      = floor($user_info['trade_max'] * config('app.trade_limit_long'));
            $xianhong_max_limti['hu']        = floor($user_info['trade_max'] * config('app.trade_limit_hu'));
            $xianhong_max_limti['lh_he']     = floor($user_info['trade_max'] * config('app.trade_limit_lh_he'));
        } else {
            $xianhong_min_limti['zhuang']    = $table_info['trade_min'];
            $xianhong_min_limti['xian']      = $table_info['trade_min'];
            $xianhong_min_limti['bjl_he']    = $table_info['trade_min'];
            $xianhong_min_limti['zhuangdui'] = $table_info['trade_min'];
            $xianhong_min_limti['xiandui']   = $table_info['trade_min'];
            $xianhong_min_limti['long']      = $table_info['trade_min'];
            $xianhong_min_limti['hu']        = $table_info['trade_min'];
            $xianhong_min_limti['lh_he']     = $table_info['trade_min'];

            $xianhong_max_limti['zhuang']    = floor($table_info['trade_max'] * config('app.trade_limit_zhuang'));
            $xianhong_max_limti['xian']      = floor($table_info['trade_max'] * config('app.trade_limit_xian'));
            $xianhong_max_limti['bjl_he']    = floor($table_info['trade_max'] * config('app.trade_limit_bjl_he'));
            $xianhong_max_limti['zhuangdui'] = floor($table_info['trade_max'] * config('app.trade_limit_zhuangdui'));
            $xianhong_max_limti['xiandui']   = floor($table_info['trade_max'] * config('app.trade_limit_xiandui'));
            $xianhong_max_limti['long']      = floor($table_info['trade_max'] * config('app.trade_limit_long'));
            $xianhong_max_limti['hu']        = floor($table_info['trade_max'] * config('app.trade_limit_hu'));
            $xianhong_max_limti['lh_he']     = floor($table_info['trade_max'] * config('app.trade_limit_lh_he'));
        }

        //百家乐
        if ($table_info['game_id'] == 1) {
            //所有下注情况加起来  不得小于 限红最小
            if (!empty($user_betting_money['zhuang'])) {
                if ($user_betting_money['zhuang'] < $xianhong_min_limti['zhuang'] || $user_betting_money['zhuang'] > $xianhong_max_limti['zhuang']) {
                    return '投注庄金额不符合限红，无法下单';
                }
            }
            if (!empty($user_betting_money['xian'])) {
                if ($user_betting_money['xian'] < $xianhong_min_limti['xian'] || $user_betting_money['xian'] > $xianhong_max_limti['xian']) {
                    return '投注闲金额不符合限红，无法下单';
                }
            }
            if (!empty($user_betting_money['bjl_he'])) {
                if ($user_betting_money['bjl_he'] < $xianhong_min_limti['bjl_he'] || $user_betting_money['bjl_he'] > $xianhong_max_limti['bjl_he']) {
                    return '投注和金额不符合限红，无法下单';
                }
            }
            if (!empty($user_betting_money['zhuangdui'])) {
                if ($user_betting_money['zhuangdui'] < $xianhong_min_limti['zhuangdui'] || $user_betting_money['zhuangdui'] > $xianhong_max_limti['zhuangdui']) {
                    return '投注庄对金额不符合限红，无法下单';
                }
            }
            if (!empty($user_betting_money['xiandui'])) {
                if ($user_betting_money['xiandui'] < $xianhong_min_limti['xiandui'] || $user_betting_money['xiandui'] > $xianhong_max_limti['xiandui']) {
                    return '投注闲对金额不符合限红，无法下单';
                }
            }
            if (!empty($user_betting_money['zhuangdui'])&&!empty($user_betting_money['xiandui'])) {
                if (($user_betting_money['zhuangdui']+$user_betting_money['xiandui'])>$xianhong_max_limti['zhuangdui']) {
                    return '投注庄闲对金额不符合限红，无法下单';
                }
            }

        } elseif ($table_info['game_id'] == 2) {
//龙虎斗
            if (!empty($user_betting_money['long'])) {
                if ($user_betting_money['long'] < $xianhong_min_limti['long'] || $user_betting_money['long'] > $xianhong_max_limti['long']) {
                    return '投注龙金额不符合限红，无法下单';
                }
            }
            if (!empty($user_betting_money['hu'])) {
                if ($user_betting_money['hu'] < $xianhong_min_limti['hu'] || $user_betting_money['hu'] > $xianhong_max_limti['hu']) {
                    return '投注虎金额不符合限红，无法下单';
                }
            }
            if (!empty($user_betting_money['lh_he'])) {
                if ($user_betting_money['lh_he'] < $xianhong_min_limti['lh_he'] || $user_betting_money['lh_he'] > $xianhong_max_limti['lh_he']) {
                    return '投注和金额不符合限红，无法下单';
                }
            }

        }

        //查找该场会员是否已下单
        $map        = [];
        $map[]      = ['oid','>','2370000'];
        $map[]      = ['uid', '=', $user_info['uid']];
        $map[]      = ['trade_id', '=', $trade_info['trade_id']];
        $map[]      = ['order_status', '=', 1];
        $order_info = db::name('order')->where($map)->find();
        if (empty($order_info)) {
            $insert_data                           = [];
            $insert_data['uid']                    = $user_info['uid'];
            $insert_data['username']               = $user_info['username'];
            $insert_data['agent_id']               = $user_info['agent_id'];
            $insert_data['agent_name']             = $user_info['agent_name'];
            $insert_data['table_id']               = $table_info['table_id'];
            $insert_data['trade_id']               = $trade_info['trade_id'];
            $insert_data['game_id']                = $table_info['game_id'];
            $insert_data['trade_xue']              = $trade_info['trade_xue'];
            $insert_data['trade_kou']              = $trade_info['trade_kou'];
            $insert_data['trade_odds']             = $trade_info['bets_rate'];
            $insert_data['betting_result']         = json_encode($user_betting_money);
            $insert_data['trade_result']           = '';
            $insert_data['original_trade_result']  = '';
            $insert_data['betting_gain']           = $total_betting_money;
            $insert_data['effective_betting_gain'] = 0;
            $insert_data['shui_fee']               = 0;
            $insert_data['order_profit']           = 0;
            $insert_data['order_gain']             = 0;
            $insert_data['is_win']                 = 4;
            $insert_data['order_status']           = 1;
            $insert_data['before_money']           = $user_info['money'];
            $insert_data['after_money']            = 0;
            $insert_data['order_status']           = 1;
            $insert_data['add_time']               = date('Y-m-d H:i:s');
            $insert_data['settlement_time']        = '';
            $insert_data['update_time']            = date('Y-m-d H:i:s');
            //查找账户金额是否充足
            if ($total_betting_money > $user_info['money']) {
                return '账户余额不足';
            }
            Db::startTrans();
            try {
                //扣除账户余额
                Db::name('user')->where('uid', $user_info['uid'])->lock(true)->find();
                Db::name('user')->where('uid', $user_info['uid'])->setDec('money', $total_betting_money);
                //提交订单
                $oid                   = Db::name('order')->where($map)->insertGetId($insert_data);
                $param                 = [];
                $param['uid']          = $user_info['uid'];
                $param['agent_id']     = $user_info['agent_id'];
                $param['username']     = $user_info['username'];
                $param['type']         = 3;
                $param['type_info']    = '会员下注';
                $param['amount']       = -$total_betting_money;
                $param['before_money'] = $user_info['money'];
                $param['after_money']  = $user_info['money'] - $total_betting_money;
                $param['note']         = "会员下注";
                $param['from_oid']     = $oid;
                $param['add_time']     = date('Y-m-d H:i:s');
                Db::name('user_bill')->data($param)->insert();

                $trade_data             = [];
                $trade_data['trade_id'] = $trade_info['trade_id'];
                $bets_money             = json_decode($trade_info['bets_money'], true);

                foreach ($bets_money as $k => &$v) {
                    $v += $user_betting_money[$k];
                }
                $trade_data['bets_money']  = json_encode($bets_money);
                $trade_data['update_time'] = date('Y-m-d H:i:s');
                db::name('table_trade')->update($trade_data);
                add_user_operation($user_info['uid'], $user_info['username'], 1, 1, '下单', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
                session('trade_time',time()+1200);

                Db::commit();
                return '1';
            } catch (\Exception $e) {
                // 回滚事务
                dump($e);
                Db::rollback();
                return '请重试1';
            }
        } else {
            if ($total_betting_money <= $order_info['betting_gain']) {
                return '请额外下注后进行投注'; //下注金额不能比该场第一次下注少
            }
            //计算各投注情况 下注金额增加数值
            $total_betting_money_cha_arr = [];
            //dump($user_betting_money);
            $order_betting_result = json_decode($order_info['betting_result'], true);
            foreach ($user_betting_money as $k => $v) {
                $cha                             = $user_betting_money[$k] - $order_betting_result[$k];
                $total_betting_money_cha_arr[$k] = $cha;
            }

            //计算重复下注投注所需金额
            $need_money = $total_betting_money - $order_info['betting_gain'];
            if ($need_money > $user_info['money']) {
                return '账户余额不足';
            }

            //dump($total_betting_money_cha_arr);
            $update_data                   = [];
            $update_data['oid']            = $order_info['oid'];
            $update_data['betting_result'] = json_encode($user_betting_money);
            $update_data['betting_gain']   = $total_betting_money;
            $update_data['after_money']    = $user_info['money'] - $need_money;
            $update_data['update_time']    = date('Y-m-d H:i:s');
            Db::startTrans();
            try {
                //扣除账户余额
                Db::name('user')->where('uid', $user_info['uid'])->lock(true)->find();
                Db::name('user')->where('uid', $user_info['uid'])->setDec('money', $need_money);
                //提交订单
                Db::name('order')->update($update_data);
                $param                 = [];
                $param['uid']          = $user_info['uid'];
                $param['agent_id']     = $user_info['agent_id'];
                $param['username']     = $user_info['username'];
                $param['type']         = 3;
                $param['type_info']    = '会员下注';
                $param['amount']       = -$need_money;
                $param['before_money'] = $user_info['money'];
                $param['after_money']  = $user_info['money'] - $need_money;
                $param['note']         = "会员下注";
                $param['from_oid']     = $order_info['oid'];
                $param['add_time']     = date('Y-m-d H:i:s');
                Db::name('user_bill')->data($param)->insert();

                $trade_data             = [];
                $trade_data['trade_id'] = $trade_info['trade_id'];
                $bets_money             = json_decode($trade_info['bets_money'], true);

                foreach ($bets_money as $k => &$v) {
                    $v += $total_betting_money_cha_arr[$k];
                }
                $trade_data['bets_money']  = json_encode($bets_money);
                $trade_data['update_time'] = date('Y-m-d H:i:s');
                db::name('table_trade')->update($trade_data);
                add_user_operation($user_info['uid'], $user_info['username'], 1, 1, '下单', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
                session('trade_time',time()+1200);
                Db::commit();
                return '1';
            } catch (\Exception $e) {
                // 回滚事务
                //dump($e);
                Db::rollback();
                return '请重试2';
            }

        }

    }


    public function creat_order_nn($uid, $table_id, $user_betting_money)
    {

        $total_betting_money = 0;
        if (empty($user_betting_money['xian1'])) {
            $user_betting_money['xian1'] = [0,0];
        }
        if (empty($user_betting_money['xian2'])) {
            $user_betting_money['xian2'] = [0,0];
        }
        if (empty($user_betting_money['xian3'])) {
            $user_betting_money['xian3'] = [0,0];
        }
        if (empty($user_betting_money['xian4'])) {
            $user_betting_money['xian4'] = [0,0];
        }
        if (empty($user_betting_money['xian5'])) {
            $user_betting_money['xian5'] = [0,0];
        }

        foreach ($user_betting_money as $k => $v) {
            $total_betting_money =$total_betting_money+($v[0]+$v[1]*5);
        }
        if ($total_betting_money == 0) {
            return '请下注后投注';
        }
       
        $user_info  = db::name('user')->find($uid);
        $table_info = db::name('table')->find($table_id);
        //根据桌台判断下注情况是否正确
        // if ($table_info['game_id'] == 3) {
        //     if (!empty($user_betting_money['xian1']) || !empty($user_betting_money['xian2']) || !empty($user_betting_money['xian3']) || !empty($user_betting_money['xian4']) || !empty($user_betting_money['xian5'])) {
        //         return '非法下注';
        //     }
        // }else{
        //     return '非法下注';
        // }

        if (empty($user_info)) {
            return '下单会员信息不存在';
        }
        if ($user_info['trade_status'] == 2) {
            return '限制交易，请联系客服处理';
        }
        if ($user_info['type'] == 3) {
            return '电投账户无法通过系统下单';
        }

        if (empty($table_info)) {
            return '下单桌台信息不存在';
        }
        if ($table_info['status'] != 1) {
            return '桌台状态暂无法下注';
        }
        if ($table_info['is_system'] != 1) {
            return '桌台暂不支持系统下注';
        }

        //获取最后异一场交易数据
        $map        = [];
        $map[]      = ['table_id', '=', $table_info['table_id']];
        $trade_info = db::name('table_trade')->where($map)->order('trade_id', 'desc')->find();
        if (empty($trade_info)) {
            return '桌台暂无交易场次';
        }
        if ($trade_info['trade_status'] != 2) {
            return '该桌台已暂停下注';
        }

        $trade_end_time = strtotime($trade_info['trade_start_time']) + $table_info['second']-11; //计算下注+倒计时时间
        if (time() > $trade_end_time) {
         return '该桌台已暂停下注';
        }
        //计算可用限红
        $xianhong_min_limti = [];
        $xianhong_max_limti = [];
        $xian_name = ['xian1'=>'闲家一','xian2'=>'闲家二','xian3'=>'闲家三','xian4'=>'闲家五','xian5'=>'闲家六'];
        foreach ($user_betting_money as $k => $v) {
            $tmp_money = $v[0]+$v[1];
            if($tmp_money > 0 && ($tmp_money < $table_info['trade_min'] || $tmp_money > $table_info['trade_max'])){
                return '投注'.$xian_name[$k].'不符合限红，无法下单';
            }
        }



        //查找该场会员是否已下单
        $map        = [];
        //$map[]      = ['oid','>','1370000'];
        $map[]      = ['uid', '=', $user_info['uid']];
        $map[]      = ['trade_id', '=', $trade_info['trade_id']];
        $map[]      = ['order_status', '=', 1];
        $order_info = db::name('order')->where($map)->find();
      
        if (empty($order_info)) {
            $insert_data                           = [];
            $insert_data['uid']                    = $user_info['uid'];
            $insert_data['username']               = $user_info['username'];
            $insert_data['agent_id']               = $user_info['agent_id'];
            $insert_data['agent_name']             = $user_info['agent_name'];
            $insert_data['table_id']               = $table_info['table_id'];
            $insert_data['trade_id']               = $trade_info['trade_id'];
            $insert_data['game_id']                = $table_info['game_id'];
            $insert_data['trade_xue']              = $trade_info['trade_xue'];
            $insert_data['trade_kou']              = $trade_info['trade_kou'];
            $insert_data['trade_odds']             = $trade_info['bets_rate'];
            $insert_data['betting_result']         = json_encode($user_betting_money);
            $insert_data['trade_result']           = '';
            $insert_data['original_trade_result']  = '';
            $insert_data['betting_gain']           = $total_betting_money;
            $insert_data['effective_betting_gain'] = 0;
            $insert_data['shui_fee']               = 0;
            $insert_data['order_profit']           = 0;
            $insert_data['order_gain']             = 0;
            $insert_data['is_win']                 = 4;
            $insert_data['order_status']           = 1;
            $insert_data['before_money']           = $user_info['money'];
            $insert_data['after_money']            = 0;
            $insert_data['order_status']           = 1;
            $insert_data['add_time']               = date('Y-m-d H:i:s');
            $insert_data['settlement_time']        = '';
            $insert_data['update_time']            = date('Y-m-d H:i:s');

          
            //查找账户金额是否充足
            if ($total_betting_money > $user_info['money']) {
                return '账户余额不足';
            }
            Db::startTrans();
            try {
                //扣除账户余额
                Db::name('user')->where('uid', $user_info['uid'])->lock(true)->find();
                Db::name('user')->where('uid', $user_info['uid'])->setDec('money', $total_betting_money);
                //提交订单
                $oid                   = Db::name('order')->where($map)->insertGetId($insert_data);
                $param                 = [];
                $param['uid']          = $user_info['uid'];
                $param['agent_id']     = $user_info['agent_id'];
                $param['username']     = $user_info['username'];
                $param['type']         = 3;
                $param['type_info']    = '会员下注';
                $param['amount']       = -$total_betting_money;
                $param['before_money'] = $user_info['money'];
                $param['after_money']  = $user_info['money'] - $total_betting_money;
                $param['note']         = "会员下注";
                $param['from_oid']     = $oid;
                $param['add_time']     = date('Y-m-d H:i:s');

              
                Db::name('user_bill')->data($param)->insert();

                $trade_data             = [];
                $trade_data['trade_id'] = $trade_info['trade_id'];
                $bets_money             = json_decode($trade_info['bets_money'], true);
                // dump($bets_money);
                // dump($user_betting_money);
                // echo json_encode($user_betting_money);
          
                foreach ($bets_money as $k => &$v) {
                    foreach ($v as $m => $n) {
                        $v[$m] += $user_betting_money[$k][$m];
                    }
                }
                $trade_data['bets_money']  = json_encode($bets_money);
                $trade_data['update_time'] = date('Y-m-d H:i:s');

                //dump($trade_data);die;
                db::name('table_trade')->update($trade_data);
                add_user_operation($user_info['uid'], $user_info['username'], 1, 1, '下单', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
                session('trade_time',time()+1200);

                Db::commit();
                return '1';
            } catch (\Exception $e) {
                // 回滚事务
              //  dump($e);
                Db::rollback();
                return '请重试1';
            }
        } else {
            if ($total_betting_money <= $order_info['betting_gain']) {
                return '请额外下注后进行投注'; //下注金额不能比该场第一次下注少
            }
            //计算各投注情况 下注金额增加数值
            $total_betting_money_cha_arr = [];
            //dump($user_betting_money);
            $order_betting_result = json_decode($order_info['betting_result'], true);
            //dump($user_betting_money);
           // dump($order_betting_result);
            foreach ($user_betting_money as $k => $v) {
                foreach ($v as $m => $n) {
                    $cha                             = $n - $order_betting_result[$k][$m];
                    //dump($cha);
                    $v[$m] += $user_betting_money[$k][$m];
                    $total_betting_money_cha_arr[$k][$m] = $cha;
                }
              
              
            }

            //计算重复下注投注所需金额
            $need_money = $total_betting_money - $order_info['betting_gain'];
            if ($need_money > $user_info['money']) {
                return '账户余额不足';
            }

            //dump($total_betting_money_cha_arr);
            $update_data                   = [];
            $update_data['oid']            = $order_info['oid'];
            $update_data['betting_result'] = json_encode($user_betting_money);
            $update_data['betting_gain']   = $total_betting_money;
            $update_data['after_money']    = $user_info['money'] - $need_money;
            $update_data['update_time']    = date('Y-m-d H:i:s');
         
            Db::startTrans();
            try {
                //扣除账户余额
                Db::name('user')->where('uid', $user_info['uid'])->lock(true)->find();
                Db::name('user')->where('uid', $user_info['uid'])->setDec('money', $need_money);
                //提交订单
                Db::name('order')->update($update_data);
                $param                 = [];
                $param['uid']          = $user_info['uid'];
                $param['agent_id']     = $user_info['agent_id'];
                $param['username']     = $user_info['username'];
                $param['type']         = 3;
                $param['type_info']    = '会员下注';
                $param['amount']       = -$need_money;
                $param['before_money'] = $user_info['money'];
                $param['after_money']  = $user_info['money'] - $need_money;
                $param['note']         = "会员下注";
                $param['from_oid']     = $order_info['oid'];
                $param['add_time']     = date('Y-m-d H:i:s');
              
                Db::name('user_bill')->data($param)->insert();

                $trade_data             = [];
                $trade_data['trade_id'] = $trade_info['trade_id'];
                $bets_money             = json_decode($trade_info['bets_money'], true);
                // dump($bets_money);
                // dump($user_betting_money);
                foreach ($bets_money as $k => &$v) {
                    foreach ($v as $m => $n) {
                        $v[$m] += $total_betting_money_cha_arr[$k][$m];
                    }
                }
                $trade_data['bets_money']  = json_encode($bets_money);
                $trade_data['update_time'] = date('Y-m-d H:i:s');
                // dump($need_money);die;
                db::name('table_trade')->update($trade_data);
                add_user_operation($user_info['uid'], $user_info['username'], 1, 1, '下单', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
                session('trade_time',time()+1200);
                Db::commit();
                return '1';
            } catch (\Exception $e) {
                // 回滚事务
                //dump($e);
                Db::rollback();
                return '请重试2';
            }

        }

    }

    //下单后进行退押
    public function tuiya_order($uid, $table_id)
    {

        $map        = [];
        $map[]      = ['table_id', '=', $table_id];
        $trade_info = db::name('table_trade')->where($map)->order('trade_id desc')->find();
        if(empty($trade_info)){
             return '暂无可退押场次';
        }
        $map        = [];
        $map[]      = ['uid', '=', $uid];
        $map[]      = ['trade_id', '=', $trade_info['trade_id']];
        $map[]      = ['order_status', '=', 1];
        $order_info = db::name('order')->where($map)->order('oid desc')->find();
        // dump($order_info);
        if (empty($order_info)) {
            return '暂无可退押下注';
        }
        //查找下注交易资料
        //$trade_info = db::name('table_trade')->find($order_info['trade_id']);

        if ($trade_info['trade_status'] != 2) {
            return '已结算暂无法退押';
        }

        //查找倒计时
        $table_info_second = db::name("table")->where(['table_id' => $table_id])->value('second');
        //  echo db::name("table")->getlastsql();
        $trade_start_time  = strtotime($trade_info['trade_start_time']);
        $now_time          = time();
        //前台修正倒计时少10s
      

        if ($trade_start_time <= $now_time - $table_info_second + 15) {
            return '退押时间已超出';
        }

        Db::startTrans();
        try {
            //更新订单状态
            $data                 = [];
            $data['oid']          = $order_info['oid'];
            $data['order_status'] = 3; //设置无效订单
            $data['update_time']  = date('Y-m-d H:i:s');
            db::name('order')->data($data)->update();
            //退还用户下注资金
            $user_info = db::name('user')->find($order_info['uid']);
            //修改用户资金
            Db::name('user')->where('uid', $order_info['uid'])->setInc('money', $order_info['betting_gain']);
            //修改交易场次下注金额
            $bets_money = json_decode($trade_info['bets_money'], true);

            $order_bet_money = json_decode($order_info['betting_result'], true);
            //dump($order_bet_money);
            //dump($bets_money);
            if($trade_info['game_id']==1){
                foreach ($bets_money as $key => &$value) {
                    $value = $value - $order_bet_money[$key];
                }
            }elseif($trade_info['game_id']==2){
                foreach ($bets_money as $key => &$value) {
                    $value = $value - $order_bet_money[$key];
                }
            }elseif($trade_info['game_id']==3){
                foreach ($bets_money as $k => &$v) {
                    foreach ($v as $m => $n) {
                        $v[$m] -= $order_bet_money[$k][$m];
                    }
                }
            }else{
                return 'error';
            }
           
            $trade_data['trade_id']    = $trade_info['trade_id'];
            $trade_data['bets_money']  = json_encode($bets_money);
            $trade_data['update_time'] = date('Y-m-d H:i:s');
            // dump($trade_data);
            // die();
            db::name('table_trade')->update($trade_data);
            //增加日志
            $data                 = [];
            $data['uid']          = $user_info['uid'];
            $data['username']     = $user_info['username'];
            $data['agent_id']     = $user_info['agent_id'];
            $data['type']         = 3;
            $data['type_info']    = '订单退押';
            $data['amount']       = $order_info['betting_gain'];
            $data['before_money'] = $user_info['money'];
            $data['after_money']  = $user_info['money'] + $order_info['betting_gain'];
            $data['note']         = "会员订单退押返款";
            $data['from_oid']     = $order_info['oid'];
            $data['add_time']     = date('Y-m-d H:i:s');
            $data['update_time']  = date('Y-m-d H:i:s');
            db::name('user_bill')->data($data)->insert();
            add_user_operation($user_info['uid'], $user_info['username'], 1, '用户', '用户退押', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
            Db::commit();
            return '1';
        } catch (\Exception $e) {
            // 回滚事务
            //dump($e);
            Db::rollback();
            return '请重试';
        }
    }

    //按照台桌结算最后一场交易订单
    public function settlement_table_trade($table_id)
    {
        //设置文件锁防止重复结算
        $Cache_name = 'settlement_order' . $table_id;
        $flag       = Cache::get($Cache_name);
        $flag       = 0;
        if (empty($flag)) {
            Cache::set($Cache_name, 1);
            $table_info = db('table')->find($table_id);
            if (empty($table_info)) {
                return '结算桌台信息不存在';
            }
            if ($table_info['status'] != 1) {
                return '桌台状态暂无法结算';
            }

            //获取最后异一场交易数据
            $map        = [];
            $map[]      = ['table_id', '=', $table_info['table_id']];
            $trade_info = db('table_trade')->where($map)->order('trade_id', 'desc')->find();
            if (empty($trade_info)) {
                return '桌台暂无交易场次';
            }

            if ($trade_info['trade_result'] == '') {
                return '该桌台未出结果，暂无法结算';
            }

            $trade_end_time = strtotime($trade_info['trade_start_time']) + $table_info['second']; //计算下注+倒计时时间
            $now_time       = time();
            if ($now_time <= $trade_end_time) {
                return '该桌台下注中，暂无法结算';
            }
            if($trade_info['game_id']==1||$trade_info['game_id']==2){
                $this->settlement_table_trade_by_trade_id($trade_info['trade_id']);
            }elseif($trade_info['game_id']=3){
                $this->settlement_table_trade_by_trade_id_nn($trade_info['trade_id']);
            }
          
            
            Cache::rm($Cache_name);
            return 1;
        }
    }

    /**
     * 按照交易编号结算订单--百家乐和龙虎
     * @param $trade_id
     * @return int|string
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function settlement_table_trade_by_trade_id($trade_id)
    {

        $map        = [];
        $map[]      = ['trade_id', '=', $trade_id];
        $trade_info = db::name('table_trade')->where($map)->order('trade_id', 'desc')->find();
        if (empty($trade_info)) {
            return '桌台暂无交易场次';
        }

        if ($trade_info['trade_result'] == '') {
            return '该桌台未出结果，暂无法结算';
        }

        $map        = [];
        $map[]        = ['oid', '>', 2800000];
        $map[]      = ['trade_id', '=', $trade_id];
        $map[]      = ['order_status', '=', 1];
        $order_list = db::name('order')->where($map)->select();
        //dump($order_list);
        $trade_result_arr = explode(',', $trade_info['trade_result']); //开奖结果解析为数组
        foreach ($order_list as $k => $v) {
            /**更新订单信息**/
            $betting_result_arr = json_decode($v['betting_result'], true);
            $trade_odds_arr     = json_decode($v['trade_odds'], true);
            $order_profit       = 0; //订单盈利金额
            $shui_fee           = 0;
            // dump($trade_odds_arr);
            // dump($betting_result_arr);
            $effective_betting_gain = $v['betting_gain']; //有效投注金额
            $danbian_xm_amount      = 0; //单边洗码费用
            $shuangbian_xm_amount   = 0; //双边洗码费用
            foreach ($betting_result_arr as $m => $n) {
                //如果投注金额不为0
                if (!empty($trade_odds_arr[$m])) {
                    //判断是否中奖
                    if (in_array($m, $trade_result_arr)) {
                        if ($v['game_id'] == 1) {
//结算百家乐
                            if ($m == 'zhuang') {
                                //如果结果为庄闲 投注进行返还下注金额*（1+赔率）
                                $order_profit += $n * (1 + $trade_odds_arr[$m]); //盈利金额=下注金额*（1+赔率）;
                                //投注庄进行抽水
                                $shui_fee               = $n * (1 - $trade_odds_arr[$m]);
                                $effective_betting_gain = $effective_betting_gain - $shui_fee; //有效投注。要扣除抽水
                            }
                            if ($m == 'xian') {
                                //如果结果为庄闲 投注进行返还下注金额*（1+赔率）
                                $order_profit += $n * (1 + $trade_odds_arr[$m]); //盈利金额=下注金额*（1+赔率）;
                            }
                            if ($m == 'zhuangdui' || $m == 'xiandui') {
                                //如果结果为庄对闲对 投注进行返还下注金额*（赔率）   不返还投注本金
                                $order_profit += $n * $trade_odds_arr[$m]; //盈利金额=下注金额*（赔率）;
                            }
                            if ($m == 'bjl_he') {
                                //如果结果为和 庄闲投注进行返还
                                $order_profit           = $order_profit + $betting_result_arr['bjl_he'] * $trade_odds_arr[$m] + $betting_result_arr['zhuang'] + $betting_result_arr['xian']; //盈利金额=下注金额*赔率+投注庄本金+投注闲本金;
                                $effective_betting_gain = $effective_betting_gain - $betting_result_arr['zhuang'] - $betting_result_arr['xian']; //有效投注。要扣 投注庄本金+投注闲本金
                            }

                        } else if ($v['game_id'] == 2) {
                            if ($m == 'long') {
                                $order_profit += $n * (1 + $trade_odds_arr[$m]); //盈利金额=下注金额*（1+赔率）;
                                $shui_fee               = $n * (1 - $trade_odds_arr[$m]); //投注龙进行抽水
                                $effective_betting_gain = $effective_betting_gain - $shui_fee; //有效投注。要扣除抽水

                            }
                            if ($m == 'hu') {
                                //如果结果为虎 投注进行返还下注金额*（1+赔率）
                                $order_profit += $n * (1 + $trade_odds_arr[$m]); //盈利金额=下注金额*（1+赔率）;
                                $shui_fee               = $n * (1 - $trade_odds_arr[$m]); //投注虎进行抽水
                                $effective_betting_gain = $effective_betting_gain - $shui_fee; //有效投注。要扣除抽水
                            }
                            if ($m == 'lh_he') {
                                //如果结果为和 龙虎投注进行返还
                                $order_profit           = $order_profit + $betting_result_arr['lh_he'] * ($trade_odds_arr[$m]) + $betting_result_arr['long'] + $betting_result_arr['hu']; //盈利金额=下注金额*（赔率）+投注龙本金+投注虎本金;
                                $effective_betting_gain = $effective_betting_gain - $betting_result_arr['long'] - $betting_result_arr['hu']; //有效投注。要扣 投注龙本金+投注虎本金
                            }
                        }
                    }
                }
                //计算单双边洗码金额
                if ($v['game_id'] == 1) {
//结算百家乐
                    if (in_array('zhuang', $trade_result_arr)) {
                        $danbian_xm_amount    = $betting_result_arr['xian'];
                        $shuangbian_xm_amount = $betting_result_arr['xian'] + $betting_result_arr['zhuang'] * $trade_odds_arr['zhuang'];

                    }
                    if (in_array('xian', $trade_result_arr)) {
                        $danbian_xm_amount    = $betting_result_arr['zhuang'];
                        $shuangbian_xm_amount = $betting_result_arr['xian'] + $betting_result_arr['zhuang'];

                    }
                    if (in_array('bjl_he', $trade_result_arr)) {
                        $danbian_xm_amount    = 0;
                        $shuangbian_xm_amount = 0;

                    }

                } else if ($v['game_id'] == 2) {
                    if (in_array('long', $trade_result_arr)) {
                        $danbian_xm_amount    = $betting_result_arr['hu'];
                        $shuangbian_xm_amount = $betting_result_arr['long'] * $trade_odds_arr['long'] + $betting_result_arr['hu'];
                    }
                    if (in_array('hu', $trade_result_arr)) {
                        $danbian_xm_amount    = $betting_result_arr['long'];
                        $shuangbian_xm_amount = $betting_result_arr['long']+ $betting_result_arr['hu'] * $trade_odds_arr['hu'];
                    }
                    if (in_array('lh_he', $trade_result_arr)) {
                        $danbian_xm_amount    = 0;
                        $shuangbian_xm_amount = 0;
                    }

                }

            }
            Db::startTrans();
            try{
                //dump($order_profit);die;
                $user_info                      = db::name('user')->find($v['uid']);
                $map                            = [];
                $data                           = [];
                $map[]                          = ['oid', '=', $v['oid']];
                $data['trade_result']           = $trade_info['trade_result'];
                $data['shui_fee']               = $shui_fee;
                $data['order_profit']           = $order_profit;
                $data['after_money']            = $user_info['money'] + $order_profit;
                $order_gain                     = $order_profit - $v['betting_gain'];
                $data['order_gain']             = $order_gain; //订单总盈利 = 盈利金额-投注金额
                $data['effective_betting_gain'] = $effective_betting_gain;
                if ($data['order_gain'] > 0) {
                    $data['is_win'] = 1;
                } elseif ($data['order_gain'] < 0) {
                    $data['is_win'] = 2;
                } else {
                    $data['is_win'] = 3;
                }
                $data['order_status']    = 2;
                $data['settlement_time'] = date('Y-m-d H:i:s');
                $data['update_time']     = date('Y-m-d H:i:s');
                if ($user_info['xm_type'] == 1) {
                    $data['xm_money'] = $danbian_xm_amount;
                } elseif ($user_info['xm_type'] == 2) {
                    $data['xm_money'] = $shuangbian_xm_amount;
                }

                db::name('order')->where($map)->update($data);
//                db::name('company')->where('id', 1)->setInc('shui', $shui_fee);
                company_money_log(['shui'=>$shui_fee], 4);
                /****/
                /**订单盈利资金发放**/

                // if ($order_profit != 0) {

                db::name('user')->where('uid', $user_info['uid'])->setInc('money', $order_profit);
                $data                 = [];
                $data['uid']          = $user_info['uid'];
                $data['username']     = $user_info['username'];
                $data['agent_id']     = $user_info['agent_id'];
                $data['type']         = 3;
                $data['type_info']    = '订单结算';
                $data['amount']       = $order_profit;
                $data['before_money'] = $user_info['money'];
                $data['after_money']  = $user_info['money'] + $order_profit;
                $data['note']         = "会员订单结算";
                $data['from_oid']     = $v['oid'];
                $data['add_time']     = date('Y-m-d H:i:s');
                db::name('user_bill')->data($data)->insert();
                //}
                /****/
                /**发放洗码费率**/
                //$kui_sun_money = $order_profit-$v['betting_gain'];
                $this->xima_user_commission($v['uid'], $danbian_xm_amount, $shuangbian_xm_amount, $v['oid']);
                /****/

                /**发放占成**  不发放/
                // $this->zhancheng_agent_commission($v['agent_id'], $order_gain, 0, $v['oid']);
                /****/

                /**推送个人余额**/
                $money           = Db::name('user')->where('uid', $user_info['uid'])->value('money');
                $croupierTable   = new croupierTable();
                $content         = [];
                $content['code'] = 200; //
                $content['data'] = number_format($money, 2); //
                $croupierTable->push_server_msg(1, $user_info['uid'], $content);


                $form_data=[];
                $form_data['dianbian']=$danbian_xm_amount;
                $form_data['shuangbian']=$shuangbian_xm_amount;
                $form_data['order_gain']=$order_gain;
                update_user_form($user_info['uid'],$form_data);

                Db::commit();
            }catch (\Exception $e){

                Db::rollback();
            }

        }
        return 1;
    }

    /**
     * 按照交易编号结算订单 -- 牛牛
     * @param $trade_id
     * @return int|string
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function settlement_table_trade_by_trade_id_nn($trade_id)
    {

        $map        = [];
        $map[]      = ['trade_id', '=', $trade_id];
        $trade_info = db::name('table_trade')->where($map)->order('trade_id', 'desc')->find();
        if (empty($trade_info)) {
            return '桌台暂无交易场次';
        }

        if ($trade_info['trade_result'] == '') {
            return '该桌台未出结果，暂无法结算';
        }

        $map        = [];
        $map[]      = ['trade_id', '=', $trade_id];
        $map[]      = ['order_status', '=', 1];
        $order_list = db::name('order')->where($map)->select();
        // dump($order_list);
        $trade_result_arr = explode(',', $trade_info['trade_result']); //开奖结果解析为数组
        $betting_result_info_arr = json_decode($trade_info['trade_result_info'], true);
//        echo '<pre>';
//        print_r($order_list);
//        return ;
     //  dump($betting_result_info_arr);
        foreach ($order_list as $k => $v) {
            /**更新订单信息**/
            $betting_result_arr = json_decode($v['betting_result'], true);
            $trade_odds_arr     = json_decode($v['trade_odds'], true);
            
            $order_profit       = 0; //订单盈利金额
            $shui_fee           = 0;
           
            
            $effective_betting_gain = $v['betting_gain']; //有效投注金额
            $danbian_xm_amount      = 0; //单边洗码费用
            $shuangbian_xm_amount   = 0; //双边洗码费用
            foreach ($betting_result_arr as $m => $n) {

                if (in_array($m, $trade_result_arr)) {
                    if($n[0]+$n[1] <= 0){
                        continue;
                    }

                    //该闲家开结果
                    $trade_reslut_niu_num = 0;
                    if($m=="xian1"){
                        $trade_reslut_niu_num = $betting_result_info_arr[1]['niu_num'];
                    }elseif($m=="xian2"){
                        $trade_reslut_niu_num = $betting_result_info_arr[2]['niu_num'];
                    }elseif($m=="xian3"){
                        $trade_reslut_niu_num = $betting_result_info_arr[3]['niu_num'];
                    }elseif($m=="xian4"){
                        $trade_reslut_niu_num = $betting_result_info_arr[4]['niu_num'];
                    }elseif($m=="xian5"){
                        $trade_reslut_niu_num = $betting_result_info_arr[5]['niu_num'];
                    }
                    // 0-12 ============>  wuniu  nuu1-9  niuniu   zhadan
                    //dump($trade_reslut_niu_num);
//                    print_r($trade_reslut_niu_num);
//                    echo '<br/>';
                   
                    if($trade_reslut_niu_num==0){
                      $order_profit += ($n[0]+$n[1]*5)+$n[0]+$n[1];
                    }elseif($trade_reslut_niu_num<=6){
                        $order_profit += ($n[0]+$n[1]*5)+$n[0]+$n[1];
                    }elseif($trade_reslut_niu_num>6&&$trade_reslut_niu_num<10){
                      
                        $order_profit +=($n[0]+$n[1]*5)+ $n[0]+$n[1]*2;
                        if($trade_reslut_niu_num>=7){
                            $shui_fee += ($n[0]+$n[1]*2)*0.05;
                            $order_profit-=($n[0]+$n[1]*2)*0.05;
                        }
                    }elseif($trade_reslut_niu_num==10){
                        $order_profit +=($n[0]+$n[1]*5)+ $n[0]+$n[1]*3;
                        if($trade_reslut_niu_num>=7){
                             $shui_fee += ($n[0]+$n[1]*3)*0.05;
                             $order_profit-=($n[0]+$n[1]*3)*0.05;
                        }
                    }elseif($trade_reslut_niu_num==11){
                        $order_profit +=($n[0]+$n[1]*5)+ $n[0]+$n[1]*4;
                        if($trade_reslut_niu_num>=7){
                             $shui_fee += ($n[0]+$n[1]*4)*0.05;
                             $order_profit-=($n[0]+$n[1]*4)*0.05;
                        }
                    }elseif($trade_reslut_niu_num==12){
                        $order_profit +=($n[0]+$n[1]*5)+ $n[0]+$n[1]*5;
                        if($trade_reslut_niu_num>=7){
                             $shui_fee += ($n[0]+$n[1]*5)*0.05;
                             $order_profit-=($n[0]+$n[1]*5)*0.05;
                        }
                    }
                    // dump($m);
                    //  dump($trade_reslut_niu_num);
                    //  dump($order_profit);
                    // dump($n);
                    //7牛以上赢钱了抽水
                    /*
                    if($order_profit-$effective_betting_gain>0){
                        $shui_fee               = $order_profit*0.05;
                    }else{
                        $shui_fee               =0;
                    }
                    */
                    $effective_betting_gain = $effective_betting_gain-$shui_fee;
                }else{
                    //退还翻倍预扣除费用
                    if($betting_result_info_arr[0]['niu_num']<7){
                        $order_profit += $n[1]*4;
                    }elseif($betting_result_info_arr[0]['niu_num']<10){
                        $order_profit += $n[1]*3;
                    }elseif($betting_result_info_arr[0]['niu_num']==10){
                        $order_profit += $n[1]*2;
                    }elseif($betting_result_info_arr[0]['niu_num']==11){
                        $order_profit += $n[1]*1;
                    }elseif($betting_result_info_arr[0]['niu_num']==12){
                        $order_profit += $n[1]*0;
                    }
                   
                }
                //如果投注金额不为0
                // if (!empty($trade_odds_arr[$m])) {
                //     //判断是否中奖
                //     if (in_array($m, $trade_result_arr)) {
                //          if ($v['game_id'] == 3){
                //             dump($m);
                //             $order_profit = $n[0]+$n[1]*3;
                //             $shui_fee               = $order_profit*0.05;
                //             $effective_betting_gain = $effective_betting_gain-$shui_fee;
                //         }
                //     }
                // }
               

            }


            Db::startTrans();
            try{
                // dump($order_profit);die;
                $user_info                      = db::name('user')->find($v['uid']);
                $map                            = [];
                $data                           = [];
                $map[]                          = ['oid', '=', $v['oid']];
                $data['trade_result']           = $trade_info['trade_result'];
                $data['shui_fee']               = $shui_fee;
                $data['order_profit']           = $order_profit;
                $data['after_money']            = $user_info['money'] + $order_profit;
                $order_gain                     = $order_profit - $v['betting_gain'];
                $data['order_gain']             = $order_gain; //订单总盈利 = 盈利金额-投注金额
                $data['effective_betting_gain'] = $effective_betting_gain;
                if ($data['order_gain'] > 0) {
                    $data['is_win'] = 1;
                } elseif ($data['order_gain'] < 0) {
                    $data['is_win'] = 2;
                } else {
                    $data['is_win'] = 3;
                }
                $data['order_status']    = 2;
                $data['settlement_time'] = date('Y-m-d H:i:s');
                $data['update_time']     = date('Y-m-d H:i:s');
                if ($user_info['xm_type'] == 1) {
                    $data['xm_money'] = $danbian_xm_amount;
                } elseif ($user_info['xm_type'] == 2) {
                    $data['xm_money'] = $shuangbian_xm_amount;
                }
                // dump($data);
                // die();
                db::name('order')->where($map)->update($data);
//                db::name('company')->where('id', 1)->setInc('shui', $shui_fee);
                company_money_log(['shui'=>$shui_fee], 4);
                /****/
                /**订单盈利资金发放**/

                // if ($order_profit != 0) {

                db::name('user')->where('uid', $user_info['uid'])->setInc('money', $order_profit);
                $data                 = [];
                $data['uid']          = $user_info['uid'];
                $data['username']     = $user_info['username'];
                $data['agent_id']     = $user_info['agent_id'];
                $data['type']         = 3;
                $data['type_info']    = '订单结算';
                $data['amount']       = $order_profit;
                $data['before_money'] = $user_info['money'];
                $data['after_money']  = $user_info['money'] + $order_profit;
                $data['note']         = "会员订单结算";
                $data['from_oid']     = $v['oid'];
                $data['add_time']     = date('Y-m-d H:i:s');
                db::name('user_bill')->data($data)->insert();
                //}
                /****/
                /**发放洗码费率**/
                //$kui_sun_money = $order_profit-$v['betting_gain'];
                $this->xima_user_commission($v['uid'], $danbian_xm_amount, $shuangbian_xm_amount, $v['oid']);
                /****/

                /**发放占成**  不发放/
                // $this->zhancheng_agent_commission($v['agent_id'], $order_gain, 0, $v['oid']);
                /****/

                /**推送个人余额**/
                $money           = Db::name('user')->where('uid', $user_info['uid'])->value('money');
                $croupierTable   = new croupierTable();
                $content         = [];
                $content['code'] = 200; //
                $content['data'] = number_format($money, 2); //
                $croupierTable->push_server_msg(1, $user_info['uid'], $content);


                $form_data=[];
                $form_data['dianbian']=$danbian_xm_amount;
                $form_data['shuangbian']=$shuangbian_xm_amount;
                $form_data['order_gain']=$order_gain;
                update_user_form($user_info['uid'],$form_data);
                //处理成功，提交事务
                Db::commit();
            }catch (\Exception $e){
                //发生异常，记录日志
                $path = './trade/';
                if(!is_dir($path)){
                    mkdir($path);
                }
                $path .= date('Ymd').'log.log';
                $log = '时间：'.date('Y-m-d H:i:s')."\r\n".'交易号：'.$trade_id."\r\n".'info:'.print_r($e->getMessage(),true);
                file_put_contents($path,$log."\r\n",FILE_APPEND);
                Db::rollback();
            }


        }
        return 1;
    }
    //会员洗码返佣
    public function xima_user_commission($uid, $danbian_xm_amount, $shuangbian_xm_amount, $from_oid = "")
    {
        $user_info = db::name('user')->find($uid);
        //  dump($user_info);
        $xm_fee = 0;
        $xm     = 0;
        if ($user_info['xm_type'] == 1) {
            //计算洗码金额
            $xm_fee = $danbian_xm_amount * $user_info['xm_rate'] / 100;
            $xm     = $danbian_xm_amount;
        } elseif ($user_info['xm_type'] == 2) {
            $xm_fee = $shuangbian_xm_amount * $user_info['xm_rate'] / 100;
            $xm     = $shuangbian_xm_amount;
        }
        //修改账户资金

//           if($xm_fee!=0){
        Db::startTrans();
        try {
            if ($xm_fee != 0) {
                db::name('user')->where('uid', $user_info['uid'])->setInc('xm_fee', $xm_fee);
            }
            //  dump($user_info);
            //echo db::name('user')->getlastsql();
            $data               = [];
            $data['uid']        = $user_info['uid'];
            $data['agent_id']   = $user_info['agent_id'];
            $data['oid']        = $from_oid;
            $data['xm']         = $xm;
            $data['xm_rate']    = $user_info['xm_rate'];
            $data['fee']        = $xm_fee;
            $data['before_fee'] = $user_info['xm_fee'];
            $data['after_fee']  = $user_info['xm_fee'] + $xm_fee;
            $data['remark']     = '会员下单增加用户洗码费';
            $data['add_time']   = date('Y-m-d H:i:s');
            db::name('user_fee_log')->insert($data);
            // echo db::name('user_fee_log')->getlastsql();
            // 提交事务
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
        }
//           }
        if (!empty($user_info['agent_id'])) {
            $this->xima_agent_commission($user_info['agent_id'], $danbian_xm_amount, $shuangbian_xm_amount, $from_oid);
        }
    }
    //代理洗码返佣
    public function xima_agent_commission($agent_id, $danbian_xm_amount, $shuangbian_xm_amount, $from_oid = "")
    {
        $agent_info = db::name('agent')->find($agent_id);
        //计算洗码金额

        $xm_fee = 0;
        $xm     = 0;
        if ($agent_info['xm_type'] == 1) {
            //计算洗码金额
            $xm_fee = $danbian_xm_amount * $agent_info['xm_rate'] / 100;
            $xm     = $danbian_xm_amount;
        } elseif ($agent_info['xm_type'] == 2) {
            $xm_fee = $shuangbian_xm_amount * $agent_info['xm_rate'] / 100;
            $xm     = $shuangbian_xm_amount;
        }
        //修改账户资金
        //         if($xm_fee!=0){
        Db::startTrans();
        try {
            if ($xm_fee != 0) {
                db::name('agent')->where('agent_id', $agent_info['agent_id'])->setInc('xm_fee', $xm_fee);
            }
            $data               = [];
            $data['oid']        = $from_oid;
            $data['agent_id']   = $agent_info['agent_id'];
            $data['xm']         = $xm;
            $data['xm_rate']    = $agent_info['xm_rate'];
            $data['fee']        = $xm_fee;
            $data['before_fee'] = $agent_info['xm_fee'];
            $data['after_fee']  = $agent_info['xm_fee'] + $xm_fee;
            $data['remark']     = '会员下单洗码费';
            $data['add_time']   = date('Y-m-d H:i:s');
            db::name('agent_fee_log')->insert($data);
            // 提交事务
            Db::commit();

        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
        }
//         }
        if (!empty($agent_info['p_agent_id'])) {
            $this->xima_agent_commission($agent_info['p_agent_id'], $danbian_xm_amount, $shuangbian_xm_amount, $from_oid);
        }
    }

    //代理占成返佣
    private function zhancheng_agent_commission($agent_id, $money, $chile_money, $from_oid = "")
    {
        $agent_info = db::name('agent')->find($agent_id);
        //计算洗码金额
        //$xm_fee = $money * $agent_info['xm_rate'] / 100-$chile_money;
        $hold_money = $money * $agent_info['hold'] / 100 - $chile_money;
        //dump($hold_money);
        //修改账户资金
        if (abs($hold_money) > 0) {
            db::name('agent')->where('agent_id', $agent_info['agent_id'])->setInc('money', $hold_money);
        }
        Db::startTrans();
        try {

            $data                 = [];
            $data['agent_id']     = $agent_info['agent_id'];
            $data['agent_name']   = $agent_info['agent_name'];
            $data['type']         = 2;
            $data['type_info']    = '占成';
            $data['amount']       = $hold_money;
            $data['before_money'] = $agent_info['money'];
            $data['after_money']  = $agent_info['money'] + $hold_money;
            $data['note']         = "会员下单占成";
            $data['from_oid']     = $from_oid;
            $data['add_time']     = date('Y-m-d H:i:s');
            $data['update_time']  = date('Y-m-d H:i:s');
            //dump($data);
            db::name('agent_bill')->data($data)->insert();
            $this->zhancheng_agent_commission($agent_info['p_agent_id'], $money, $hold_money, $from_oid);
            // 提交事务
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
        }

    }

/*
//1充值2提现3下注4系统操作（上/下分）5洗码费6其他
public function change_user_money($uid,$type, $money,  $type_info, $note)
{
$user_info = db('user')->find($uid);
if(empty($user_info)){
return '会员不存在';
}
$data=[];
$data['uid']=$user_info['uid'];
$data['type']=$type;
$data['type_info']='';
$data['amount']=$money;
$data['before_money'] = $user_info['money'];
$data['after_money']= $user_info['money']+$money;
$data['note']=$note;

}
//1提现2占成3洗码费4系统操作5其他
public function change_agent_money($uid,$type, $money,  $type_info, $note)
{

}
 */
}
