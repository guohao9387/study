<?php
namespace app\index\controller;
use think\Db;
class User extends Common
{
    private $user;
    public function initialize()
    {
        parent::initialize();
        $where = [];
        $where[] = ['uid','=',$this->uinfo['uid']];
        $this->user = db::name('user')->where($where)->field('uid,username,nickname,money,agent_id,status,login_status,type,recharge_type')->find();
        if($this->user['status']!=1||$this->user['login_status']!=1||$this->user['type']!=1){
            $this->error('账户状态异常','/index/login/logout');
        }
    }
    public function index()
    {
        $this->assign('info',$this->user);
        return $this->fetch();
    }
    public function news_list()
    {
        $where = [];
        $where[] = ['status','=',1];
        $list = db::name('news')->where($where)->order('sort desc')->field('id,title,add_time')->select();
        $this->assign('info',$this->user);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function news()
    {
        $where = [];
        $where[] = ['status','=',1];
        $where[] = ['id','=',input('get.id')];
        $news = db::name('news')->where($where)->field('title,content')->find();
        $this->assign('info',$this->user);
        $this->assign('news',$news);
        return $this->fetch();
    }

    public function recharge()
    {
        if($this->user['recharge_type']==2){
            $this->error('参数错误');
        }
        $this->assign('info',$this->user);

        if($this->uinfo['uid'] == 146){
            $where = [
                ['status','in', '1,3'],
                ['is_weixin','=', 0],
            ];
        }else{
            $where = [
                ['status','=', 1],
                ['is_weixin','=', 0],
            ];
        }

        $pay_config_row = Db::name('pay')->where($where)->order('sort ASC')->select();
        $this->assign('payment',$pay_config_row);

        return $this->fetch();
    }
    public function withdraw()
    {
        if($this->user['recharge_type']==2){
            $this->error('参数错误');
        }
        //判断真实姓名和取款密码
        $user = Db::name('user')->where(['uid'=>$this->user['uid']])->find();

        $map=[];
        $map[]=['key','=','min_tixian_money'];
        $min_tixian_money = db::name('config')->where($map)->value('value');

        $where = [];
        $where[] = ['uid','=',$this->user['uid']];
        $where[] = ['status','<>',3];
        $bank = db::name('user_withdraw_log')->where($where)->order('id desc')->find();
        //若没有提现过
        if(empty($bank)){
            $min_tixian_money = 100;
        }
        $this->assign('bank',$bank);
        $this->assign('min_tixian_money',$min_tixian_money);
        $this->assign('info',$user);
        //查找提现规则
        $protocol = Db::name('agreement')->where(['title'=>'提现规则'])->value('content');
        $this->assign('protocol',$protocol);

        //查看代理
        $user_agent_type = db::name('agent')->where(['agent_id'=>$this->user['agent_id']])->value('match_type');
        if($user_agent_type == 2){
            return $this->fetch('withdraw2');
        }else{
            if($this->user['uid']){
                if(empty($user['realname']) || empty($user['withdraw_pwd'])){
                    $this->redirect('withdraw_bank');
                    exit();
                }
                return $this->fetch();
            }else{
                return $this->fetch('withdraw2');
            }
        }
    }

    public function withdraw_bank(){

        $this->assign('info',$this->user);
        return $this->fetch();
    }

    public function money_list()
    {
        $post = input('post.');
        $where = [];
        $where[] = ['uid','=',$this->user['uid']];

        if(request()->isGet()){
            if(!empty($post['start'])){
                $where[] = ['add_time','>=',$post['start']];
            }
            if(!empty($post['end'])){
                $where[] = ['add_time','<=',$post['end']];
            }
        }
        $list = db::name('user_bill')->where($where)->order('id desc')->paginate(20,false,['query'=>$post]);
        $this->assign('list',$list);
        $this->assign('info',$this->user);
        return $this->fetch();
    }
    public function recharge_list()
    {
        if($this->user['recharge_type']==2){
            $this->error('参数错误');
        }
        $post = input('post.');
        $where = [];
        $where[] = ['uid','=',$this->user['uid']];

        if(request()->isGet()){
            if(!empty($post['start'])){
                $where[] = ['add_time','>=',$post['start']];
            }
            if(!empty($post['end'])){
                $where[] = ['add_time','<=',$post['end']];
            }
        }
        $list = db::name('recharge')->where($where)->order('pay_id desc')->paginate(20,false,['query'=>$post]);
        $this->assign('list',$list);
        $this->assign('info',$this->user);
        return $this->fetch();
    }
    public function withdraw_list()
    {
        if($this->user['recharge_type']==2){
            $this->error('参数错误');
        }
        $post = input('post.');
        $where = [];
        $where[] = ['uid','=',$this->user['uid']];

        if(request()->isGet()){
            if(!empty($post['start'])){
                $where[] = ['add_time','>=',$post['start']];
            }
            if(!empty($post['end'])){
                $where[] = ['add_time','<=',$post['end']];
            }
        }
        $list = db::name('user_withdraw_log')->where($where)->order('id desc')->paginate(20,false,['query'=>$post]);
        $this->assign('list',$list);
        $this->assign('info',$this->user);
        return $this->fetch();
    }
    public function order_list()
    {
        $post = input('post.');
        $where = [];
        $where[] = ['uid','=',$this->user['uid']];
         $where[] = ['order_status','=',2];
        if(request()->isGet()){
            if(!empty($post['start'])){
                $where[] = ['add_time','>=',$post['start']];
            }
            if(!empty($post['end'])){
                $where[] = ['add_time','<=',$post['end']];
            }
        }
        $list = db::name('order')->where($where)->order('oid desc')->paginate(20,false,['query'=>$post]);
        $res = [];
        foreach($list as $val){
            $res[] = json_decode($val['betting_result'],true);
        }
        $this->assign('list',$list);
        $this->assign('res',$res);
        $this->assign('info',$this->user);
        return $this->fetch();
    }
    public function repwd()
    {
        if(request()->isAjax()){
            $post = input('post.');
            if(!$post['old_pwd']){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '请输入旧密码';
                return json($data);
            }
            if(!$post['pass']){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '请输入新密码';
                return json($data);
            }
            if(!$post['repass']){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '请输入重复密码';
                return json($data);
            }
            if(strlen($post['pass'])<6||strlen($post['pass'])>18){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '请输入6-18位的新密码';
                return json($data);
            }
            if($post['repass']!=$post['pass']){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '确认密码与新密码不同';
                return json($data);
            }
            $where = [];
            $where[] = ['uid','=',$this->user['uid']];
            $where[] = ['status','=',1];
            $password = db::name('user')->where($where)->value('password');
            if(md5($post['old_pwd'])!=$password){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '旧密码输入错误';
                return json($data);
            }
            $data = [];
            $data['pwd'] = $post['pass'];
            $data['password'] = md5($post['pass']);
            $res = db::name('user')->where($where)->update($data);
            if($res){
                $data = [];
                $data['status'] = 1;
                $data['msg'] = '修改成功';
            }else{
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '修改失败';
            }
            add_user_operation($this->user['uid'],$this->user['username'], 1,1,'修改密码', $_SERVER['REQUEST_URI'], serialize($_REQUEST),$this->user['uid'],json_encode($post));
            return json($data);
        }else{
            $this->assign('info',$this->user);

            return $this->fetch();
        }
    }
    public function kefu()
    {
        $where = [];
        $where[] =['status','=',1];
        $list = db::name('kefu')->where($where)->order(['sort'=>'desc','id'=>'desc'])->select();
        $this->assign('list',$list);
        $this->assign('info',$this->user);
        return $this->fetch();
    }
    public function app()
    {
        $this->assign('info',$this->user);
        return $this->fetch();
    }


}
