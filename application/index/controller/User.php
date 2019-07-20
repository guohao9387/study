<?php
namespace app\index\controller;
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
            $this->redirect('/index/Login/login');
        }
        $this->info=db::name('user')->where('uid',$this->user)->find();
        $this->assign('info',$this->info);
    }
    public function index()
    {
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
        $param=input('get.');
        $where=[];
        $where[]=['status','=',1];
        $where[]=['pid','=',$this->user];
        $list=db::name('user')->where($where)->paginate(20,false,['query'=>$param]);
        $this->assign('list',$list);
        return $this->fetch();
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
        return $this->fetch();
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
            if($param['money']>$user['money']){
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
                $data['uid'] = $this->user;
                $data['username'] = $this->user_name;
                $data['nickname'] = $user['nickname'];
                $data['money'] = $param['money'];
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
                $data['type_info'] ='代理提现';
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
            return $this->fetch();
        }
    }

    public function withdraw_list()
    {
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['status'])){
                $where[]= ['status','=',$param['status']];
            }
            if(!empty($param['start'])){
                $where[]= ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[]= ['add_time','<=',$param['end']];
            }
        }
        $where[] = ['uid','=',$this->user];
        $list = db::name('user_withdraw_log')
            ->where($where)
            ->order('id desc')
            ->paginate(20,false,['query'=>$param]);
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function money_list()
    {
        $post = input('get.');
        $where = [];
        $where[] = ['uid','=',$this->user];

        if(request()->isGet()){
            if(!empty($post['start'])){
                $where[] = ['add_time','>=',$post['start']];
            }
            if(!empty($post['end'])){
                $where[] = ['add_time','<=',$post['end']];
            }
        }
        $list = db::name('user_money_log')->where($where)->order('id desc')->paginate(20,false,['query'=>$post]);
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function order_list()
    {
        $post = input('post.');
        $where = [];
        $where[] = ['uid','=',$this->user];
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
        $this->assign('list',$list);
        return $this->fetch();
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
        $list = db::name('bank_info')->where($where)->order(['id'=>'desc'])->select();
        $count=count($list);
        $this->assign('count',$count);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function blind_bank_card(){
        $where=[];
        $where[]=['status','=',2];
        $where[]=['uid','=',$this->user];
        $real=db::name('real_auth')->where($where)->field('name')->find();
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
    public function coin(){
        $where=[];
        $where[]=['uid','=',$this->user];
        $list=db::name('user_apply_coin')->where($where)->select();
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function coin_order_list()
    {
        $post = input('get.');
        $where = [];
        $where[] = ['uid','=',$this->user];
        if(request()->isGet()){
            if(!empty($post['start'])){
                $where[] = ['add_time','>=',$post['start']];
            }
            if(!empty($post['end'])){
                $where[] = ['add_time','<=',$post['end']];
            }
        }
        $list = db::name('apply_coin_order_log')->where($where)->order('id desc')->paginate(20,false,['query'=>$post]);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function coin_give_list()
    {
        $post = input('get.');
        $where = [];
        $where[] = ['uid','=',$this->user];
        if(request()->isGet()){
            if(!empty($post['start'])){
                $where[] = ['add_time','>=',$post['start']];
            }
            if(!empty($post['end'])){
                $where[] = ['add_time','<=',$post['end']];
            }
        }
        $list = db::name('apply_coin_give_log')->where($where)->order('id desc')->paginate(20,false,['query'=>$post]);
        $this->assign('list',$list);
        return $this->fetch();
    }
}
