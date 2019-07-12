<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Login extends Controller
{
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
            };
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
            $GLOBALS['title'] ='内部学习系统后台管理系统';
            return $this->fetch();
        }
    }
    public function logout(){
        add_user_operation(session('user'),select_user_username(session('user')),1,1,'会员退出登陆', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
        session('user',null);
        session('user_name',null);
        $this->redirect('/index/Index/index');
    }

}
