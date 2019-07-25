<?php
namespace app\admin\controller;
use think\Db;
class Index extends Common{
    public function initialize(){
        parent::initialize();
    }
    /*首页*/
    public function index()
    {
        $nickname = db::name('admin')->where('id',$this->admin)->value('nickname');
        $this->assign('nickname',$nickname);
        return $this->fetch();
    }
    /*首页内容*/
    public function main()
    {
        $nickname = db::name('admin')->where('id',$this->admin)->value('nickname');
        $this->assign('nickname',$nickname);

        $param = array();
        $where = array();
        $where[] = ['status','=',1];
        $param['count_user'] = db::name('user')->where($where)->count();
        $param['count_agent'] = db::name('agent')->where($where)->count();
        $param['count_table'] = db::name('product')->where($where)->count();

        //订单
        $where=[];
        $where[]=['order_status','=',2];
        $order_info=db::name('order')->where($where)->field('count(oid) count_oid,sum(profit) sum_profit,sum(fee) sum_fee')->find();
        $param['count_oid'] =    $order_info['count_oid'];
        $param['order_gain'] =    $order_info['sum_profit'];
        $param['sum_order_fee'] =    $order_info['sum_fee'];

        //充值
        $where=[];
        $where[]=['status','=',2];
        $recharge_info=db::name('recharge')->where($where)->sum('money');
        $param['sum_recharge'] = $recharge_info;

        //提现
        $user_withdraw=db::name('user_withdraw_log')->where($where)->sum('money');
        $agent_withdraw=db::name('agent_withdraw_log')->where($where)->sum('money');
        $param['sum_user_withdraw'] = $user_withdraw;
        $param['sum_agent_withdraw'] = $agent_withdraw;


        $today=quick_time_select(2);
        $where = array();
        $where[] = ['order_status','=',2];
        $where[]=['add_time','>',$today];
        $param['today_order_gain']= db::name('order')->where($where)->sum('profit');

        $yesterday_start = quick_time_select(1);//昨日开始
        $month_start =  quick_time_select(6);//本月开始

        $yesterday_where = [];
        $yesterday_where[] = ['add_time','>=',$yesterday_start];
        $yesterday_where[] = ['add_time','<=',$today];

        $today_where = [];
        $today_where[] = ['add_time','>=',$today];


        $month_where = [];
        $month_where[] = ['add_time','>=',$month_start];

        $user_where = $yesterday_where;
        $user_where[] = ['status','=',1];
        $param['yesterday_new_user'] = db::name('user')->where($user_where)->count();
        $param['yesterday_new_agent'] = db::name('agent')->where($user_where)->count();

        $user_where = $today_where;
        $user_where[] = ['status','=',1];
        $param['today_new_user'] = db::name('user')->where($user_where)->count();
        $param['today_new_agent'] = db::name('agent')->where($user_where)->count();

        $user_where = $month_where;
        $user_where[] = ['status','=',1];
        $param['month_new_user'] = db::name('user')->where($user_where)->count();
        $param['month_new_agent'] = db::name('agent')->where($user_where)->count();


        $recharge_where = $yesterday_where;
        $recharge_where[] = ['status','=',2];
        $param['yesterday_new_recharge'] = db::name('recharge')->where($recharge_where)->sum('money');
        $param['yesterday_new_user_withdraw'] = db::name('user_withdraw_log')->where($recharge_where)->sum('money');
        $param['yesterday_new_agent_withdraw'] = db::name('agent_withdraw_log')->where($recharge_where)->sum('money');

        $recharge_where = $today_where;
        $recharge_where[] = ['status','=',2];
        $param['today_new_recharge'] = db::name('recharge')->where($recharge_where)->sum('money');
        $param['today_new_user_withdraw'] = db::name('user_withdraw_log')->where($recharge_where)->sum('money');
        $param['today_new_agent_withdraw'] = db::name('agent_withdraw_log')->where($recharge_where)->sum('money');

        $recharge_where = $month_where;
        $recharge_where[] = ['status','=',2];
        $param['month_new_recharge'] = db::name('recharge')->where($recharge_where)->sum('money');
        $param['month_new_user_withdraw'] = db::name('user_withdraw_log')->where($recharge_where)->sum('money');
        $param['month_new_agent_withdraw'] = db::name('agent_withdraw_log')->where($recharge_where)->sum('money');


        $where = array();
        $where['status'] = 1;
        $param['notice'] = db::name('notice')->where($where)->field('id,add_time,title,type')->select();
        $this->assign('param',$param);

        return $this->fetch();
    }
    /*修改个人信息*/
    public function personal(){
        $where = array();
        $where['id'] = $this->admin;
        $info = db::name('admin')->where($where)->field('username,nickname')->find();
        if(request()->isAjax()){
            $param = input('post.');
            $data = array();
            if($param['pass']){
                $data['pwd'] = $param['pass'];
                $data['password'] = md5($param['pass']);
            }
            $data['nickname'] = $param['nickname'];
//            $data['tel'] = $param['tel'];
            $where=[];
            $where['id'] = $this->admin;
            $res = db::name('admin')->where($where)->update($data);
            if($res){
                add_user_operation($this->admin,$this->admin_name, 3,3,'修改个人信息', $_SERVER['REQUEST_URI'], serialize($_REQUEST),$this->admin,json_encode($info));
                $data = array();
                $data['status'] = 1;
                $data['msg'] = '修改成功';
                return json($data);
            }else{
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '修改失败';
                return json($data);
            }
        }else{

            $this->assign('info',$info);
            return $this->fetch();
        }
    }
    /*公告*/
    public function notice(){
        $where = array();
        $where['id'] = input('get.id');
        $info = db::name('notice')->where($where)->field('title,content')->find();
        $this->assign('info',$info);
        return $this->fetch();
    }

}

