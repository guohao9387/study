<?php
namespace app\index\controller;

use app\croupier\model\Table as croupierTable;
use app\index\model\Order;
use think\Controller;
use think\Db;

class Api extends Controller
{
    public $uinfo;
    public function initialize()
    {
        $this->uinfo = session('uinfo');
        //判断是否重复登陆
        $last_login_token = db('user')->where(['uid' => $this->uinfo['uid']])->value('last_login_token');
        if ($last_login_token != $this->uinfo['last_login_token']) {
            session('uinfo', null);
            ApiReturn(-1, '您已在其它地方登陆，请重新登陆');
        }
    }

    public function creat_order()
    {

        $table_id = input("table_id");
        $data     = input("data");
        /*
        // test  data
         $table_id=38;
        $data=[];
        $data[]=['qy'=>'xian1','money'=>[10,50]];

        */
        if (empty($data)) {
            ApiReturn(0, '请下注后进行投注');
        }
        $bets_data = [];
        foreach ($data as $k => $v) {
            $bets_data[$v['qy']] = $v['money'];
        }

        $Order  = new Order();
        $table_info = db::name('table')->find($table_id);
        //根据桌台判断下注情况是否正确
        $reslut=0;
        if ($table_info['game_id'] == 1) {
            $reslut = $Order = $Order->creat_order($this->uinfo['uid'], $table_id, $bets_data);
        }elseif($table_info['game_id'] == 2){
            $reslut = $Order = $Order->creat_order($this->uinfo['uid'], $table_id, $bets_data);
        }elseif($table_info['game_id'] == 3){
            $reslut = $Order = $Order->creat_order_nn($this->uinfo['uid'], $table_id, $bets_data);
        }else{
            ApiReturn(0, '非法下注');
        }

        if ($reslut == 1) {
            //推送台桌消息
            $croupierTable   = new croupierTable();
            $data            = $croupierTable->push_table_list($table_id);
            $content         = [];
            $content['code'] = 100; //
            $content['data'] = $data; //;//
            $croupierTable->push_server_msg_sendtochannelclient($table_id, $content);
             //推送台桌消息
            $croupierTable   = new croupierTable();
            $data            = $croupierTable->push_table_list($table_id);
            $content         = [];
            $content['code'] = 100; //
            $content['data'] = $data; //;//
            $croupierTable->push_server_msg(2, $table_id, $content);
            //推送个人资金
            $money           = Db::name('user')->where('uid', $this->uinfo['uid'])->value('money');
            $croupierTable   = new croupierTable();
            $content         = [];
            $content['code'] = 200; //
            $content['data'] = number_format($money, 2); //
            $croupierTable->push_server_msg(1, $this->uinfo['uid'], $content);
            ApiReturn(1, "下注成功");
        } else {
            ApiReturn(0, $reslut);
        }
    }

    public function tuiya_order()
    {
        $table_id = input("table_id");
        $Order    = new Order();
        /*
        test data
             $table_id = 38;
        */
       
        $reslut = $Order = $Order->tuiya_order($this->uinfo['uid'], $table_id);
        if ($reslut == 1) {
            //推送台桌消息
            $croupierTable   = new croupierTable();
            $data            = $croupierTable->push_table_list($table_id);
            $content         = [];
            $content['code'] = 100; //
            $content['data'] = $data; //;//
            $croupierTable->push_server_msg_sendtochannelclient($table_id, $content);
             //推送台桌消息
            $croupierTable   = new croupierTable();
            $data            = $croupierTable->push_table_list($table_id);
            $content         = [];
            $content['code'] = 100; //
            $content['data'] = $data; //;//
            $croupierTable->push_server_msg(2, $table_id, $content);
            //推送个人资金
            $money           = Db::name('user')->where('uid', $this->uinfo['uid'])->value('money');
            $croupierTable   = new croupierTable();
            $content         = [];
            $content['code'] = 200; //
            $content['data'] = number_format($money, 2); //
            $croupierTable->push_server_msg(1, $this->uinfo['uid'], $content);
            ApiReturn(1, "退押成功");
        } else {
            ApiReturn(0, $reslut);
        }
    }

    public function jiesuan()
    {
         $Order       = new Order();
         echo $reslut = $Order->settlement_table_trade(38);

        //推送个人资金
        // $money           = Db::name('user')->where('uid', $this->uinfo['uid'])->value('money');
        // $croupierTable   = new croupierTable();
        // $content         = [];
        // $content['code'] = 200; //
        // $content['data'] = number_format($money, 2); //
        // echo $croupierTable->push_server_msg(1, $this->uinfo['uid'], $content);
    }

    //创建支付订单
    public function creat_recharge()
    {
        if (request()->isPost()) {
            $money = input('post.money');

            if (!is_numeric($money) || strpos($money, ".") !== false) {
                ApiReturn(0, "转入金额必须为整数");
            }
            if ($money < 0) {
                ApiReturn(0, "单笔转入不能小于0元");
            }
            $min_recharge = get_system_config('min_recharge');
            if ($money < $min_recharge) {
                ApiReturn(0, "单笔转入最小" . $min_recharge . "元");
            }

            $user_info = db::name('user')->find($this->uinfo['uid']);
            //添加充值记录
            $data                 = [];
            $data['pay_sn']       = creat_recharge_sn('SN');
            $data['uid']          = $this->uinfo['uid'];
            $data['agent_id']     = $user_info['agent_id'];
            $data['amount']       = $money;
            $data['amount']       = $money;
            $data['type']         = 1;
            $data['pay_time']     = '';
            $data['post_param']   = json_encode(input());
            $data['return_param'] = '';
            $data['add_time']     = date('Y-m-d H:i:s');
            $data['update_time']  = date('Y-m-d H:i:s');
            $data['status']       = 1;
            $reslut               = db::name('recharge')->insert($data);
            if ($reslut) {
                //ApiReturn(0, "功能已编写，未对接");
                $pay_url = "http://" . $_SERVER['HTTP_HOST'] . '/' . url('Pay/do_pay', array('order_sn' => $data['pay_sn'], 'pay_type' => 1));
                ApiReturn(1, "创建订单成功", $pay_url);
            } else {
                ApiReturn(0, $reslut);
            }
        }

    }

    public function get_user_tz_cash()
    {
        $uid        = $this->uinfo['uid'];
        $sql        = "SELECT sum(`betting_gain`) as sum_betting_gain,table_id FROM `yl_order` where uid = '{$uid}' AND order_status = '1' GROUP BY table_id";
        $list       = Db::query($sql);
        $table_list = db('table')->column('table_id');
        //dump($table_list);

        $data = [];

        foreach ($list as $k => $v) {
            $data[$v['table_id']] = number_format($v['sum_betting_gain'], 2);
        }
        foreach ($table_list as $k => $v) {
            if (empty($data[$v])) {
                $data[$v] = 0;
            }
        }
        //       dump($data);
        ApiReturn(1, "success", $data);

    }

    public function get_all_table_betts(){
        //获取台桌最后的交易靴号和口号
        $where = [
            ['status', '=', 1],
            ['is_online', '=', 1]
        ];
        $table_row = Db::name('table')->field('table_id,last_trade_xue,last_trade_kou')->where($where)->select();
        if(empty($table_row)){
            ApiReturn(0, "error", '');
        }

        $all_betting = [];
        foreach ($table_row as $val){
            $map=[];
            $map[]=['table_id','=',$val['table_id']];
            $map[]=['order_status','=',1];
            $map[]=['uid','=', $this->uinfo['uid']];
            $map[]=['trade_xue','=', $val['last_trade_xue']];
            $map[]=['trade_kou','=', $val['last_trade_kou']];
            $order_info = db::name('order')->where($map)->order('oid desc')->find();
            // dump($order_info);
            $betting_result_arr = [];
            if(!empty($order_info)){
                $betting_result_arr = json_decode($order_info['betting_result'],true);
            }
            $data=[];
            if($betting_result_arr){
                foreach ($betting_result_arr as $k => $v) {
                    if($v!=0){
                        $data[]=['qy'=>$k,'money'=>$v];
                    }

                }
            }

            $all_betting[$val['table_id']] = $data;
        }

        //dump($betting_result_arr);
        ApiReturn(1, "success", $all_betting);
    }


    /**
     * 根据台桌id获取当前台桌下注详情
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function get_betts_by_table(){
        $table_id = input('table_id');
        if(empty($table_id)){
              ApiReturn(0, "error", '');
        }
        //获取台桌最后的交易靴号和口号
        $table_row = Db::name('table')->field('last_trade_xue,last_trade_kou')->where(['table_id'=>$table_id])->find();
        if(empty($table_row)){
            ApiReturn(0, "error", '');
        }
        $map=[];
        $map[]=['table_id','=',$table_id];
        $map[]=['order_status','=',1];
        $map[]=['uid','=', $this->uinfo['uid']];
        $map[]=['trade_xue','=', (string)$table_row['last_trade_xue']];
        $map[]=['trade_kou','=', (string)$table_row['last_trade_kou']];
        $order_info = db::name('order')->where($map)->order('oid desc')->find();
       // dump($order_info);
        $betting_result_arr = [];
        if(!empty($order_info)){
           $betting_result_arr = json_decode($order_info['betting_result'],true);
        }else{
                $betting_result_arr['zhuang']=0;
                $betting_result_arr['xian']=0;
                $betting_result_arr['bjl_he']=0;
                $betting_result_arr['zhuangdui']=0;
                $betting_result_arr['xiandui']=0;
                $betting_result_arr['long']=0;
                $betting_result_arr['lh_he']=0;
                $betting_result_arr['hu']=0;
       }
        $data=[];
        foreach ($betting_result_arr as $k => $v) {
            if($v!=0){
                  $data[]=['qy'=>$k,'money'=>$v];
            }
          
        }
      //dump($betting_result_arr);
      ApiReturn(1, "success", $data);
    }

    /**
     * 获取台桌推送数据
     */
    public function get_table_list_info(){
        $id = input('table_id',0);
        $Table = new croupierTable();
        $data = $Table->push_table_list($id);
        if($id && !empty($data[$id])){
            ApiReturn(1, "success", $data[$id]);
        }else{
            ApiReturn(1, "success", $data);
        }
    }

    public function test()
    {
        //$Order = new Order();
       // $reslut = $Order = $Order->settlement_table_trade_by_trade_id(802);
        // dump($reslut);
        // $user_betting_money           = [];
        // $user_betting_money['zhuang'] = 100;
        // $user_betting_money['xian']   = 100;
        // $user_betting_money['bjl_he']   = 100;
        // $user_betting_money['zhuangdui']   = 100;
        // $user_betting_money['xiandui']   = 102;
        // $reslut                       = $Order                       = $Order->tuiya_order(69, 9);
        //dump($reslut);
         //$Table = new croupierTable();
        
        // $reslut='xian';
        //$reslut = $Table->modify_trade_reslut(802,$reslut);
       // dump($reslut);

    }

    /**
     * 会员提现接口
     * @return \think\response\Json
     * @throws \think\Exception
     */
    public function _withdraw(){
        if(request()->isAjax()){
            $user = db::name('user')->lock(true)->where(['uid' => $this->uinfo['uid']])->find();
            if(!$user){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '会员信息有误';
                return json($data);
            }
            if(empty($user['realname']) || empty($user['withdraw_pwd'])){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '请绑定真实姓名和取款密码';
                return json($data);
            }
            //查看代理
            $user_agent_type = db::name('agent')->where(['agent_id'=>$user['agent_id']])->value('match_type');
            if($user_agent_type == 2){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '您的账户不支持自助提现,请联系客服！';
                return json($data);
            }

            $map=[];
            $map[]=['key','=','min_tixian_money'];
            $min_tixian_money = db::name('config')->where($map)->value('value');

            $where = [];
            $where[] = ['uid','=',$this->uinfo['uid']];
            $where[] = ['status','=',1];
            $bank = db::name('user_withdraw_log')->where($where)->order('id desc')->find();
            //若没有提现过
            if(empty($bank)){
                $min_tixian_money = 100;
            }

            $param = input('post.');
//            if(strlen($param['bank_khm'])<=0||strlen($param['bank_khm'])>10){
//                $data = [];
//                $data['status'] = 0;
//                $data['msg'] = '请输入正确的真实姓名';
//                return json($data);
//            }
            $param['bank_khm'] = $user['realname'];
            if(strlen($param['bank_name'])<=0||strlen($param['bank_name'])>50){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '请输入正确的银行名称';
                return json($data);
            }
//            if(strlen($param['bank_address'])<=0||strlen($param['bank_address'])>100){
//                $data = [];
//                $data['status'] = 0;
//                $data['msg'] = '请输入正确的开户行支行名称';
//                return json($data);
//            }
            if(strlen($param['bank_id'])<=0||strlen($param['bank_id'])>30){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '请输入正确的银行卡号';
                return json($data);
            }

//            if(strlen($param['remark'])>50){
//                $data = [];
//                $data['status'] = 0;
//                $data['msg'] = '请输入50字以内备注';
//                return json($data);
//            }
            if($param['money']<$min_tixian_money){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '最少提现金额'.$min_tixian_money;
                return json($data);
            }
            if($param['money']%10!=0){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '提现金额必须是10的整数倍';
                return json($data);
            }
            if(empty($param['withdraw_pwd'])){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '请输入取款密码';
                return json($data);
            }
            if(md5($param['withdraw_pwd']) != $user['withdraw_pwd']){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '取款密码错误';
                return json($data);
            }
            db::startTrans();

            $hold=db::name('agent')->where('agent_id','=',$user['agent_id'])->value('hold');
            if($param['money']>$user['money']){
                db::rollback();
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '余额不足';
                return json($data);
            }
            $status = db::name('user')->where(['uid' => $this->uinfo['uid']])->setDec('money',$param['money']);
            if(!$status){
                db::rollback();
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '操作失败1';
                return json($data);
            }
            $after_money = db::name('user')->where(['uid' => $this->uinfo['uid']])->value('money');
            if($after_money<0){
                db::rollback();
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '余额不足';
                return json($data);
            }
            add_user_operation($this->uinfo['uid'],$user['username'],1,1,'提现', $_SERVER['REQUEST_URI'], serialize($_REQUEST));

            //判断是否有手续费
            $sx_fee = get_withdraw_sx_fee($user['uid'],$param['money']);

            $data = [];
            $data['pay_sn'] =  sn_withdraw();
            $data['uid'] = $user['uid'];
            $data['agent_id'] = $user['agent_id'];
            $data['amount'] = $param['money'];
            $data['before_money'] = $user['money'];
            $data['after_money'] = $after_money;
            $data['sx_fee'] = $sx_fee;
            $data['server_money'] = $param['money']*($hold/100);
            $data['pay_amount'] = $param['money']-$param['money']*($hold/100);
            $data['bank_khm'] = $param['bank_khm'];
            $data['bank_name'] = $param['bank_name'];
            $data['bank_id'] = $param['bank_id'];
            $data['add_time'] = date('Y-m-d H:i:s');
            //$data['remark'] = $param['remark'];
            $data['status'] = 1;
            $oid = db::name('user_withdraw_log')->insertGetId($data);
            if($oid){
                $data = [];
                $data['uid'] = $user['uid'];
                $data['username'] = $user['username'];
                $data['agent_id'] = $user['agent_id'];
                $data['type'] = 2;
                $data['type_info'] = '会员提现';
                $data['amount'] = -($param['money']-$sx_fee);
                $data['before_money'] = $user['money'];
                $data['after_money'] = $after_money;
                $data['note'] = '会员提现';
                $data['from_oid'] = $oid;
                $data['add_time'] = date('Y-m-d H:i:s');
                $data['update_time'] = date('Y-m-d H:i:s');


                if($sx_fee > 0){
                    $data['after_money'] = $after_money+$sx_fee;
                    $data2 = [];
                    $data2['uid'] = $user['uid'];
                    $data2['username'] = $user['username'];
                    $data2['agent_id'] = $user['agent_id'];
                    $data2['type'] = 21;
                    $data2['type_info'] = '手续费';
                    $data2['amount'] = -$sx_fee;
                    $data2['before_money'] = $after_money+$sx_fee;
                    $data2['after_money'] = $after_money;
                    $data2['note'] = '会员提现手续费';
                    $data2['from_oid'] = $oid;
                    $data2['add_time'] = date('Y-m-d H:i:s');
                    $data2['update_time'] = date('Y-m-d H:i:s');
                    $data = [
                        $data,
                        $data2
                    ];
                }else{
                    $data = [$data];
                }

                $res = db::name('user_bill')->insertAll($data);
                //插入上下分记录
                $data = [];
                $data['type'] = 3;
                $data['type_info'] = '会员提现';
                $data['uid'] = $user['uid'];
                $data['username'] = $user['username'];
                $data['user_type'] = 1;
                $data['manager_id'] = $user['uid'];
                $data['manager_type'] = 3;
                $data['manager_name'] = $user['username'];
                $data['amount'] = -$param['money'];
                $data['before_amount'] = $user['money'];
                $data['after_amount'] = $after_money;
                $data['note'] = '会员自助提现';
                $data['add_time'] = date('Y-m-d H:i:s');
                if($sx_fee > 0){
                    $data['amount'] = -$param['money']+$sx_fee;
                    $data['after_amount'] = $after_money+$sx_fee;
                    $data2 = [];

                    $data2['type'] = 31;
                    $data2['type_info'] = '提现手续费';
                    $data2['uid'] = $user['uid'];
                    $data2['username'] = $user['username'];
                    $data2['user_type'] = 1;
                    $data2['manager_id'] = $user['uid'];
                    $data2['manager_type'] = 3;
                    $data2['manager_name'] = $user['username'];
                    $data2['amount'] = -$sx_fee;
                    $data2['before_amount'] = $after_money+$sx_fee;
                    $data2['after_amount'] = $after_money;
                    $data2['note'] = '会员自助提现手续费';
                    $data2['add_time'] = date('Y-m-d H:i:s');

                    $data = [
                        $data,
                        $data2
                    ];
                }else{
                    $data = [$data];
                }
                $res2 = db::name('up_down')->insertAll($data);
                if($res && $res2){
                    db::commit();
                    $data=[];
                    $data['status'] = 1;
                    $data['msg'] = '操作成功，请耐心等待审核';
                }else{
                    db::rollback();
                    $data=[];
                    $data['status'] = 0;
                    $data['msg'] = '操作失败2';
                }
            }else{
                db::rollback();
                $data=[];
                $data['status'] = 0;
                $data['msg'] = '操作失败3';
            }
            return json($data);
        }
    }

    /**
     * 绑定提现信息
     * @return \think\Response
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\exception\PDOException
     */
    public function _withdraw_bank(){
        if($this->request->isAjax()){
            $user = db::name('user')->where(['uid' => $this->uinfo['uid']])->find();
            if($user['realname'] || $user['withdraw_pwd']){
                return ajax_return_error('您已经绑定过真实姓名和取款密码，若要修改请联系客服');
            }
            $realname = input('post.realname');
            $pwd = input('post.pwd');
            $repwd = input('post.repwd');
            if(empty($realname)){
                return ajax_return_error('请输入真实姓名');
            }
            if(empty($pwd)){
                return ajax_return_error('请设置取款密码');
            }
            if(strlen($pwd) < 6 || strlen($pwd) > 16){
                return ajax_return_error('取款密码需在6-16位之间');
            }
            if($pwd != $repwd){
                return ajax_return_error('两次密码不一致');
            }

            $data = [
                'realname'  =>  $realname,
                'withdraw_pwd'  =>  md5($pwd)
            ];
            $ret = Db::name('user')->where(['uid' => $this->uinfo['uid']])->update($data);
            if($ret){
                return ajax_return_success('绑定成功');
            }else{
                return ajax_return_error('绑定失败，请重试');
            }
        }
    }

    /**
     * 判断手续费
     * @return \think\Response
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function _withdraw_check_money(){
        if(request()->isAjax()){
            $money = input('post.money');
            $where = [];
            $where[] = ['uid','=',$this->uinfo['uid']];
            $where[] = ['status','<>',3];

            $bank = db::name('user_withdraw_log')->where($where)->order('id desc')->find();
            $map=[];
            $map[]=['key','=','min_tixian_money'];
            $min_tixian_money = db::name('config')->where($map)->value('value');
            if(empty($bank)){
                $min_tixian_money = 100;
            }
            if($money < $min_tixian_money){
                return ajax_return_error('最低提现金额为'.$min_tixian_money.'元');
            }
            $sx_fee = get_withdraw_sx_fee($this->uinfo['uid'],$money);
            return ajax_return_success('手续费<span style="color: red;"> '.$sx_fee.' </span>元,实到<span style="color: red;"> '.($money-$sx_fee).' </span>');
        }
    }

    public function piao_api(){
        if($this->request->isAjax()){
            $tid = input('post.tid','');
            if(empty($tid)){
                return ajax_return_error('参数错误');
            }
            $game_id = Db::name('table')->where(['table_id'=>$tid])->value('game_id');
            if($game_id == 1){
                $xz_arr = [
                    '庄','闲','和','庄对','闲对'
                ];
            }elseif ($game_id == 2){
                $xz_arr = [
                    '龙','虎','和'
                ];
            }elseif ($game_id == 3){
                $xz_arr = [
                    '闲1','闲2','闲3','闲5','闲6'
                ];
            }

            $xz_qy = $xz_arr[array_rand($xz_arr,1)];
            //随机取一个会员
            $sql = 'SELECT nickname FROM yl_user WHERE uid >= ((SELECT MAX(uid) FROM yl_user)-(SELECT MIN(uid) FROM yl_user)) * RAND() + (SELECT MIN(uid) FROM yl_user) LIMIT 1';
            $ret = Db::query($sql);
            //随机金额
            $money = rand(5,20)*10;

            $nickname = mb_substr($ret[0]['nickname'],0,1)."**".mb_substr($ret[0]['nickname'],-1,1);
            return ajax_return_success('',[
                'msg'   =>  $nickname.'下注'.$xz_qy.','.$money.'元',
            ]);
        }
    }
}
