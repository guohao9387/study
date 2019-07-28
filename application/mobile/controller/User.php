<?php
namespace app\mobile\controller;
use think\Db;
class User extends Common
{
    public $user;
    public $user_name;
    public $info;
    public function initialize()
    {
        parent::initialize();
        $this->user = session('user');
        $this->user_name = session('user_name');
        if (empty($this->user)) {
            $this->redirect('/Mobile/Login/login');
        }

        $this->info=db::name('user')->where('uid',$this->user)->find();
        $this->info['real_money']=$this->info['money']-$this->info['promise_money'];
        $this->assign('info',$this->info);
    }
    public function index()
    {
        $url = 'http://' .$this->config['address']. '/index/login/register?code='.$this->info['invite_number'];
        if(!$this->info['code']){
            $path = substr(code($url), 1);
            $data = array();
            $data['code'] = $path;
            $res = db::name('user')->where('uid',$this->user)->update($data);
            if(!$res){
                $this->error('生成二维码失败','/index/User/index');
            }
        }else{
            $path = $this->info['code'];
        }
        $this->assign('path',$path);
        $this->assign('url',$url);
        $this->assign('invite_number',$this->info['invite_number']);
        return $this->fetch();
    }


    public function invite()
    {
        $url = 'http://' .$this->config['address']. '/index/login/register?code='.$this->info['invite_number'];
        if(!$this->info['code']){
            $path = substr(code($url), 1);
            $data = array();
            $data['code'] = $path;
            $res = db::name('user')->where('uid',$this->user)->update($data);
            if(!$res){
                $this->error('生成二维码失败','/index/User/index');
            }
        }else{
            $path = $this->info['code'];
        }
        $this->assign('path',$path);
        $this->assign('url',$url);
        $this->assign('name',$this->info['nickname']);
        $this->assign('invite_number',$this->info['invite_number']);
        return $this->fetch();
    }
    public function down(){
        $name = input('get.name').'.png';
        $filename = ltrim(input('get.path'),'/');
        header("Content-type: application/octet-stream");
        header("Content-Length: ".filesize($filename));
        header("Content-Disposition: attachment; filename=$name");
        $fp = fopen($filename, 'rb');
        fpassthru($fp);
        fclose($fp);
        die;
    }
    public function friends(){
        $where=[];
        $where[]=['status','=',1];
        $where[]=['pid','=',$this->user];
        $list=db::name('user')->where($where)->paginate(20);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function more_friends(){
        if(request()->isAjax()){
            $num = 20;
            $page = input('post.page');
            $where = [];
            $where[] = ['pid','=',$this->user];
            $where[] = ['status','=',1];
            $list = db::name('user')->where($where)->order('uid desc')->field('nickname,add_time')->limit($page*$num,$num)->select();
            return $list;
        }
    }
    public function real_auth()
    {

        if(request()->isAjax()){
            $param=input('post.');
            if(strlen($param['name'])<1||strlen($param['name'])>6){
                $data=[];
                $data['status']=0;
                $data['msg']='请输入正确的真实姓名';
                return json($data);
            }
            if(strlen($param['card'])<15||strlen($param['card'])>18){
                $data=[];
                $data['status']=0;
                $data['msg']='请输入正确的身份证号';
                return json($data);
            }
            $where=[];
            $where[]=['uid','=',$this->user];
            $info=db::name('real_auth')->where($where)->find();
            if($info['status']==1||$info['status']==2){
                $data=[];
                $data['status']=0;
                $data['msg']='请勿重复认证';
                return json($data);
            }else{
                $data=[];
                $data['uid']=$this->user;
                $data['username']=$this->info['username'];
                $data['name']=$param['name'];
                $data['card']=$param['card'];
                $data['add_time']=date('Y-m-d H:i:s');
                $data['status']=1;
                $id=db::name('real_auth')->insertGetId($data);
                if($id){
                    add_user_operation($this->user,$this->info['username'],1,1,'会员发起实名认证', $_SERVER['REQUEST_URI'], serialize($_REQUEST),$id);
                    $data=[];
                    $data['status']=1;
                    $data['msg']='申请成功，请耐心等待审核';
                }else{
                    $data=[];
                    $data['status']=0;
                    $data['msg']='申请失败，请重试';
                }
                return json($data);
            }
        }else{
            $where=[];
            $where[]=['uid','=',$this->user];
            $info=db::name('real_auth')->where($where)->order('id desc')->find();
            $this->assign('real_info',$info);
            return $this->fetch();
        }
    }
    public function recharge()
    {
        if(request()->isAjax()){
            $param=input('post.');
            if($param['type']!='5001'&&$param['type']!='2004'&&$param['type']!='QWJ_QUICK'&&$param['type']!='7001'){
                return json_return(0,'参数有误');
            }
            if($param['money']<500){
                return json_return(0,'最低充值金额500');
            }
            if($param['money']>30000){
                return json_return(0,'最大充值金额30000');
            }
            $order_sn='rn'.time().rand(1000,9999);
            $data=[];
            $data['uid']=$this->user;
            $data['username']=$this->user_name;
            $data['agent_id']=$this->info['agent_id'];
            $data['agent_name']=$this->info['agent_name'];
            $data['order_sn']=$order_sn;
            $data['real_money']=number_format($param['money']/$this->config['recharge_rate'], 2, ".", "");
            $data['money'] = number_format($param['money'], 2, ".", "");
            $data['rate'] = $this->config['recharge_rate'];
            $data['type']=$param['type'];
            $data['status']=1;
            $data['add_time']=date('Y-m-d H:i:s');
            $status=db::name('recharge')->insert($data);
            if(!$status){
                return json_return(0,'网络错误，请重试');
            }

            $data=[];
            $data['total_fee'] = number_format($param['money'], 2, ".", "");
            $data['appid'] = '19575690';
            $secret = '1821b732aaa00678caeec99530e399a8';
            $data['version'] = '1.1';
            $data['pay_id'] = $param['type'];
            $data['out_trade_no'] = $order_sn;
            $data['return_url'] = 'http://'.$_SERVER['SERVER_NAME'].'/index/User/index';
            $data['notify_url'] = 'http://'.$_SERVER['SERVER_NAME'].'/index/Notify/index';
            ksort($data);
            $fieldString = array();
            foreach ($data as $key => $value) {
                if(!empty($value)){
                    $fieldString [] = $key . "=" . $value . "";
                }
            }
            $fieldString = implode('&', $fieldString);
            $data['sign'] = md5($fieldString . $secret);
            $payUrl = 'https://pay.jr8789.com/api.php/webRequest/tradePay';//支付接口地址

            $result = post_json($payUrl, $data);
            $result = json_decode($result, true);
            if($result['data']['resp_code']=='00'){
                $info=$result['data']['payment'];
                return json_return(1,'1',$info);
            }else{
                return json_return(0,'网络错误，请重试');
            }
        }else{
            $this->assign('rate',$this->config['recharge_rate']);
            $this->assign('real',number_format(3000/$this->config['recharge_rate'], 2, ".", ""));

            return $this->fetch();
        }
    }
    public function withdraw()
    {
        if(request()->isAjax()){
            $param = input('post.');
            if($param['money']<=0){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '金额有误';
                return json($data);
            }
            if(!$param['bank_info_id']){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '请选择提现银行卡信息';
                return json($data);
            }
            $where=[];
            $where[]=['id','=',$param['bank_info_id']];
            $where[]=['utype','=',1];
            $where[]=['status','=',1];
            $where[]=['uid','=',$this->user];
            $bank_info=db::name('bank_info')->where($where)->find();
            if(!$bank_info){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '银行卡信息有误';
                return json($data);
            }

            $where = [];
            $where[] = ['uid','=',$this->user];
            $where[] = ['status','=',1];
            db::startTrans();
            $user = db::name('user')->lock(true)->where($where)->find();
            if(!$user){
                db::rollback();
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '参数错误';
                return json($data);
            }
            if($param['money']>($user['money']-$user['promise_money'])){
                db::rollback();
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '余额不足';
                return json($data);
            }
            $status = db::name('user')->where($where)->setDec('money',$param['money']);
            if(!$status){
                db::rollback();
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '操作失败';
                return json($data);
            }
            $after_money = db::name('user')->where($where)->value('money');
            if($after_money<0){
                db::rollback();
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '余额不足';
                return json($data);
            }
            $oid=add_user_operation($this->user,$this->user_name,1,1,'用户提现', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
            if($oid){

                $data = [];
                $data['order_sn']='uw'.time().rand(1000,9999);
                $data['uid'] = $this->user;
                $data['username'] = $this->user_name;
                $data['nickname'] = $user['nickname'];
                $data['money'] = $param['money'];
                $data['rate'] = $this->config['withdraw_rate'];
                $data['real_money'] = number_format($param['money']/$this->config['withdraw_rate'], 2, ".", "");
                $data['name'] = $bank_info['name'];
                $data['phone'] = $bank_info['phone'];
                $data['bank_name'] = $bank_info['bank_name'];
                $data['branch_name'] = $bank_info['branch_name'];
                $data['bank_card'] = $bank_info['bank_card'];
                $data['bank_info_id'] = $param['bank_info_id'];
                $data['add_time'] = date('Y-m-d H:i:s');
                $data['status'] = 1;
                $res = db::name('user_withdraw_log')->insertGetId($data);

                $data=[];
                $data['uid'] = $this->user;
                $data['username'] = $this->user_name;
                $data['nickname'] = $user['nickname'];
                $data['from_oid'] = $res;
                $data['operation_id'] =$oid;
                $data['type'] =2;
                $data['type_info'] ='用户提现';
                $data['before_money'] =$user['money'];
                $data['money'] =$param['money'];
                $data['after_money'] =$after_money;
                $data['remark'] ='用户发起提现';
                $data['add_time'] = date('Y-m-d H:i:s');
                $res2=db::name('user_money_log')->insert($data);
                if($res&&$res2){
                    db::commit();
                    $data=[];
                    $data['status'] = 1;
                    $data['msg'] = '操作成功，请耐心等待审核';
                }else{
                    db::rollback();
                    $data=[];
                    $data['status'] = 0;
                    $data['msg'] = '操作失败';
                }
            }else{
                db::rollback();
                $data=[];
                $data['status'] = 0;
                $data['msg'] = '操作失败';
            }
            return json($data);
        }else{
            $where=[];
            $where[]=['utype','=',1];
            $where[]=['uid','=',$this->user];
            $where[]=['status','=',1];
            $bank_info_list=db::name('bank_info')->where($where)->select();
            $this->assign('bank_info_list',$bank_info_list);
            $real_money=$this->info['money']-$this->info['promise_money'];
            $this->assign('real_money',$real_money);
            $this->assign('rate',$this->config['withdraw_rate']);
            return $this->fetch();
        }
    }

    public function withdraw_list()
    {
        $where = array();
        $where[] = ['uid','=',$this->user];
        $list = db::name('user_withdraw_log')
            ->where($where)
            ->order('id desc')
            ->paginate(20);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function withdraw_info()
    {
        $where = [];
        $where[] = ['status','=',1];
        $where[] = ['uid','=',$this->user];
        $id = input('get.id');
        if(!$id){
            $this->error('参数错误');
        }
        $where =[];
        $where[] = ['id','=',$id];
        $where[] = ['uid','=',$this->user];
        $info = db::name('user_withdraw_log')->where($where)->find();
        $this->assign('info',$info);
        return $this->fetch();
    }
    public function more_withdraw(){

        if(request()->isAjax()){
            $num = 20;
            $page = input('post.page');
            $where = [];
            $where[] = ['uid','=',$this->user];
            $list = db::name('user_withdraw_log')->where($where)->order('id desc')->limit($page*$num,$num)->select();
            if($list){
                foreach($list as &$val){
                    $val['status'] = str_withdraw_status($val['status']);
                    $val['money'] = number_format($val['money'],'2','.','');
                }
            }
            return $list;
        }
    }
    public function money_list()
    {
        $where = [];
        $where[] = ['uid','=',$this->user];
        $list = db::name('user_money_log')->where($where)->order('id desc')->paginate(20);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function more_money_list(){
        if(request()->isAjax()){
            $num = 20;
            $page = input('post.page');
            $where = [];
            $where[] = ['uid','=',$this->user];
            $list = db::name('user_money_log')->where($where)->order('id desc')->limit($page*$num,$num)->select();
            if($list){
                foreach($list as &$val){
                    $val['money'] = number_format($val['money'],'2','.','');
                    $val['before_money'] = number_format($val['before_money'],'2','.','');
                    $val['after_money'] = number_format($val['after_money'],'2','.','');
                }
            }
            return $list;
        }
    }
    public function order_list()
    {
        $where = [];
        $where[] = ['uid','=',$this->user];
         $where[] = ['order_status','=',2];
        $list = db::name('order')->where($where)->order('oid desc')->paginate(20);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function more_order_list(){
        if(request()->isAjax()){
            $num = 20;
            $page = input('post.page');
            $where = [];
            $where[] = ['uid','=',$this->user];
            $where[] = ['order_status','=',2];
            $list = db::name('order')->where($where)->order('oid desc')->limit($page*$num,$num)->select();
            if($list){
                foreach($list as &$val){
                    $val['buy_price'] = number_format($val['buy_price'],'2','.','');
                    $val['sell_price'] = number_format($val['sell_price'],'2','.','');
                    $val['money'] = number_format($val['money'],'2','.','');
                    $val['profit'] = number_format($val['profit'],'2','.','');
                }
            }
            return $list;
        }
    }
    public function re_pwd()
    {
        if(request()->isAjax()){
            $post = input('post.');
            if(!$post['old_password']){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '请输入旧密码';
                return json($data);
            }
            if(!$post['password']){
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
            if(strlen($post['password'])<6||strlen($post['password'])>18){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '请输入6-18位的新密码';
                return json($data);
            }
            if($post['repass']!=$post['password']){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '确认密码与新密码不同';
                return json($data);
            }
            $where = [];
            $where[] = ['uid','=',$this->user];
            $where[] = ['status','=',1];
            $password = db::name('user')->where($where)->value('password');
            if(md5($post['old_password'])!=$password){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '旧密码输入错误';
                return json($data);
            }
            $data = [];
            $data['pwd'] = $post['password'];
            $data['password'] = md5($post['password']);
            $data['update_time']=date('Y-m-d H:i:s');
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
            add_user_operation($this->user,$this->user_name, 1,1,'修改密码', $_SERVER['REQUEST_URI'], serialize($_REQUEST),$this->user,json_encode($post));
            return json($data);
        }else{
            return $this->fetch();
        }
    }
    public function kefu()
    {
        $where = [];
        $where[] =['status','=',1];
        $list = db::name('kefu')->where($where)->order(['sort'=>'desc','id'=>'desc'])->select();
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function bank_list()
    {
        $where = [];
        $where[] =['status','=',1];
        $where[] =['utype','=',1];
        $where[] =['uid','=',$this->user];
        $list = db::name('bank_info')->where($where)->select();
        $count=count($list);
        $this->assign('count',$count);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function bank_add(){
        $where=[];
        $where[]=['status','=',2];
        $where[]=['uid','=',$this->user];
        $real=db::name('real_auth')->where($where)->field('name')->find();
        if(!$real){
            $data=[];
            $data['status']=0;
            $data['msg']='请先进行实名认证';
            return json($data);
        }
        $real['phone']=$this->user_name;
        if(request()->isAjax()){
            $where=[];
            $where[]=['utype','=',1];
            $where[]=['status','=',1];
            $where[]=['uid','=',$this->user];
            $bank_count=db::name('bank_info')->where($where)->count();
            if($bank_count>=3){
                $data=[];
                $data['status']=0;
                $data['msg']='最多绑定3张银行卡';
                return json($data);
            }
            $param=input('post.');
            if(strlen($param['bank_name'])<0||strlen($param['bank_name'])>60){
                $data=[];
                $data['status']=0;
                $data['msg']='请输入正确的开户行';
                return json($data);
            }
            if(strlen($param['branch_name'])<0||strlen($param['branch_name'])>150){
                $data=[];
                $data['status']=0;
                $data['msg']='请输入正确的开户支行名称';
                return json($data);
            }
            if(strlen($param['bank_card'])<16||strlen($param['bank_card'])>20){
                $data=[];
                $data['status']=0;
                $data['msg']='请输入正确的银行卡号';
                return json($data);
            }
            $data=[];
            $data['uid']=$this->user;
            $data['utype']=1;
            $data['username']=$this->user_name;
            $data['name']=$real['name'];
            $data['phone']=$real['phone'];
            $data['bank_name']=$param['bank_name'];
            $data['branch_name']=$param['branch_name'];
            $data['bank_card']=$param['bank_card'];
            $data['add_time']=date('Y-m-d H:i:s');
            $data['status']=1;
            $res=db::name('bank_info')->insert($data);
            if($res){
                $data=[];
                $data['status']=1;
                $data['msg']='添加成功';
            }else{
                $data=[];
                $data['status']=0;
                $data['msg']='添加失败';
            }
            return json($data);
        }else{
            $bank=db::name('bank')->order('id asc')->select();
            $this->assign('bank',$bank);
            $this->assign('real',$real);

            return $this->fetch();
        }
    }
    public function my_coin(){
        $where=[];
        $where[]=['uid','=',$this->user];
        $list=db::name('user_apply_coin')->where($where)->select();
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function coin_order_log()
    {
        $where = [];
        $where[] = ['uid','=',$this->user];
        $where[]=['apply_coin_id','=',input('get.id')];
        $list = db::name('apply_coin_order_log')->where($where)->order('id desc')->paginate(20);
        $this->assign('list',$list);
        $this->assign('id',input('get.id'));
        return $this->fetch();
    }
    public function more_coin_order_list(){
        if(request()->isAjax()){
            $num = 20;
            $page = input('post.page');
            $id = input('post.id');
            $where = [];
            $where[] = ['uid','=',$this->user];
            $where[] = ['apply_coin_id','=',$id];
            $list = db::name('apply_coin_order_log')->where($where)->order('id desc')->limit($page*$num,$num)->select();
            if($list){
                foreach($list as &$val){
                    $val['number'] = number_format($val['number'],'2','.','');
                    $val['price'] = number_format($val['price'],'2','.','');
                    $val['amount'] = number_format($val['amount'],'2','.','');
                }
            }
            return $list;
        }
    }
    public function coin_give_log()
    {
        $where = [];
        $where[] = ['uid','=',$this->user];
        $where[]=['apply_coin_id','=',input('get.id')];
        $list = db::name('apply_coin_give_log')->where($where)->order('id desc')->paginate(20);
        $this->assign('list',$list);
        $this->assign('id',input('get.id'));
        return $this->fetch();
    }
    public function more_coin_give_list(){
        if(request()->isAjax()){
            $num = 20;
            $page = input('post.page');
            $id = input('post.id');
            $where = [];
            $where[] = ['uid','=',$this->user];
            $where[] = ['apply_coin_id','=',$id];
            $list = db::name('apply_coin_give_log')->where($where)->order('id desc')->limit($page*$num,$num)->select();
            if($list){
                foreach($list as &$val){
                    $val['number'] = number_format($val['number'],'2','.','');
                }
            }
            return $list;
        }
    }
}
