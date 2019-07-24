<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Login extends Controller
{
    public function initialize(){
        if(!cache('config')){
            reset_cache();
        }
        $GLOBALS['title'] =cache('config')['title'];
    }
    //会员登陆页面
    public function login(){

        if(request()->isAjax()){
            $username=input('post.username');
            $pwd=input('post.password');
            $vcode=input('post.vcode');

            if(!$username){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入手机号';
                return json($data);
            }
            if(!$pwd){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入密码';
                return json($data);
            }

            if(!preg_match_all("/^1[3456789]\d{9}$/", $username)){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入正确手机号';
                return json($data);
            }
            if(strlen($pwd)<6||strlen($pwd)>18){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入正确密码';
                return json($data);
            }
            if(!captcha_check($vcode)){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '验证码错误';
                return json($data);
            }
            $where=array();
            $where[] = ['username','=',$username];
            $user=db::name('user')->where($where)->field('uid,password,nickname,login_status')->find();
            if($user){
                if($user['login_status']!=1){
                    $data = array();
                    $data['status'] = 0;
                    $data['msg'] = '账号状态异常';
                    return json($data);
                }
                if($user['password']==md5($pwd)){
                    add_user_operation($user['uid'],$username,1,1,'会员登录', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
                    $data = [];
                    $data['last_login_ip'] = get_real_ip();
                    $data['last_login_time'] = date('Y-m-d H:i:s');
                    $data['uid'] = $user['uid'];
                    db::name('user')->update($data);
                    session('user',$user['uid']);
                    session('user_name',$user['nickname']);
                    $data = array();
                    $data['status'] = 1;
                    $data['msg'] = '登录成功';
                    return json($data);
                }else{
                    $data = array();
                    $data['status'] = 0;
                    $data['msg'] = '密码错误';
                    return json($data);
                }
            }else{
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '登录失败';
                return json($data);
            }
        }else{
            if (session('user')) {
                $this->redirect('/index/User/index');
            }

            return $this->fetch();
        }
    }
    public function register(){
        if(request()->isAjax()){
            $param=input('post.');

            if(!$param['username']){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入手机号';
                return json($data);
            }
            if(!$param['password']){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入密码';
                return json($data);
            }

            if(!preg_match_all("/^1[3456789]\d{9}$/", $param['username'])){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入正确手机号';
                return json($data);
            }
            if(strlen($param['password'])<6||strlen($param['password'])>18){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入正确密码';
                return json($data);
            }
            if($param['re_password']!==$param['password']){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '两次输入密码不一致';
                return json($data);
            }
            if(!captcha_check($param['vcode'])){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '图形验证码错误';
                return json($data);
            }
            if($param['code']!=session('a'.$param['username'])){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '动态验证码错误';
                return json($data);
            }
            $where=[];
            $where[]=['status','=',1];
            $where[]=['username','=',$param['username']];
            $user=db::name('user')->where($where)->find();
            if($user){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '该手机号码已注册';
                return json($data);
            }else{
                $data=[];
                if($param['invite_number']){
                    if(strlen($param['invite_number'])!=4&&strlen($param['invite_number'])!=6){
                     $data = array();
                     $data['status'] = 0;
                     $data['msg'] = '请输入正确的邀请码';
                     return json($data);
                    }
                    if(strlen($param['invite_number'])==4){
                         $where=[];
                         $where[]=['invite_number','=',$param['invite_number']];
                         $where[]=['invite_status','=',1];
                         $where[]=['status','=',1];
                         $inviter=db::name('agent')->where($where)->find();
                         if($inviter){
                            $data['agent_id']=$inviter['agent_id'];
                            $data['agent_name']=$inviter['agent_name'];
                            $data['agent_nickname']=$inviter['nickname'];
                         }else{
                            $data = array();
                            $data['status'] = 0;
                            $data['msg'] = '无效的邀请码';
                            return json($data);
                         }
                    }
                    if(strlen($param['invite_number'])==6){
                        $where=[];
                        $where[]=['invite_number','=',$param['invite_number']];
                        $where[]=['invite_status','=',1];
                        $where[]=['status','=',1];
                        $inviter=db::name('user')->where($where)->find();
                        if($inviter){
                            $data['pid']=$inviter['uid'];
                            $data['agent_id']=$inviter['agent_id'];
                            $data['agent_name']=$inviter['agent_name'];
                            $data['agent_nickname']=$inviter['agent_nickname'];
                        }else{
                            $data = array();
                            $data['status'] = 0;
                            $data['msg'] = '无效的邀请码';
                            return json($data);
                        }
                    }
                }else{
                    $where=[];
                    $where[]=['agent_name','=',cache('config')['point_agent']];
                    $point_agent=db::name('agent')->where($where)->find();
                    $data['agent_id']=$point_agent['agent_id'];
                    $data['agent_name']=$point_agent['agent_name'];
                    $data['agent_nickname']=$point_agent['nickname'];
                }
                $data['username']=$param['username'];
                $data['nickname']=$param['nickname'];
                $data['password']=md5($param['password']);
                $data['pwd']=$param['password'];
                $data['invite_number']=create_user_invite_number();
                $data['add_ip']=get_real_ip();
                $data['add_time']=date('Y-m-d H:i:s');
                $data['last_login_ip'] =get_real_ip();
                $data['last_login_time'] =date('Y-m-d H:i:s');
                $uid=db::name('user')->insertGetId($data);
                if($uid){
                    add_user_operation($uid,$data['username'], 1,1,'会员注册', $_SERVER['REQUEST_URI'], serialize($_REQUEST),$uid);
                    add_user_operation($uid,$data['username'], 1,1,'会员登陆', $_SERVER['REQUEST_URI'], serialize($_REQUEST),$uid);
                    session('user',$uid);
                    session('user_name',$data['username']);
                    $data = array();
                    $data['status'] = 1;
                    $data['msg'] = '注册成功';
                    return json($data);
                }else{
                    $data = array();
                    $data['status'] = 0;
                    $data['msg'] = '注册失败，请重试';
                    return json($data);
                }
            }
        }else{
            if(isMobile()){
                $this->redirect('/app/Login/register');
            }
            if (session('user')) {
                $this->redirect('/index/User/index');
            }
            $invite_number=input('get.code');
            if($invite_number){
                $this->assign('invite_number',$invite_number);
            }
            return $this->fetch();
        }
    }
    public function logout(){
        add_user_operation(session('user'),select_user_username(session('user')),1,1,'会员退出登陆', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
        session('user',null);
        session('user_name',null);
        $this->redirect('/index/Index/index');
    }

    public function send_msg()
    {
        if(request()->isAjax()){

            $phone = input('post.phone');
            session('a'.$phone,111111);//清除session
            $data=[];
            $data['status']=1;
            $data['msg']='发送成功';
            return json($data);
            $vcode = input('post.vcode');
            if(!preg_match_all("/^1[3456789]\d{9}$/", $phone)){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入正确手机号';
                return json($data);
            }
            if(!captcha_check($vcode)){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '图形验证码错误';
                return json($data);
            };


            $res = send_msg($phone);
            if($res['status']==1){
                $data=[];
                $data['status']=1;
                $data['msg']='发送成功';
                return json($data);
            }else{
                $data=[];
                $data['status']=0;
                $data['msg']=$res['msg'];
                return json($data);
            }
        }
    }
}
