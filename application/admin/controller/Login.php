<?php
namespace app\admin\Controller;
use think\Controller;
use think\Db;
class Login extends Controller{
    public function login(){
        if(request()->isAjax()){
            $username=input('post.username');
            $pwd=input('post.password');
//            $vcode=input('post.vcode');

            if(!$username){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入账户名';
                return json($data);
            }
            if(!$pwd){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入密码';
                return json($data);
            }
            if(strlen($username)<6||strlen($username)>20){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入正确账号';
                return json($data);
            }
            if(strlen($pwd)<6||strlen($pwd)>18){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入正确密码';
                return json($data);
            }
//            if(!captcha_check($vcode)){
//                $this->error('验证码错误');
//            };
            $where=array();
            $where[] = ['username','=',$username];
            $admin=db::name('admin')->where($where)->field('id,password,nickname')->find();
            if($admin){
                if($admin['password']==md5($pwd)){
                    add_user_operation($admin['id'],$username, 3,3,'管理员登录', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
                    $data = [];
                    $data['last_login_ip'] = get_real_ip();
                    $data['last_login_time'] = date('Y-m-d H:i:s');
                    $data['id'] = $admin['id'];
                    db::name('admin')->update($data);
                    session('admin',$admin['id']);
                    session('admin_name',$username);
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
        add_user_operation(1,'admin',3,3,'管理员退出登录', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
        session('admin',null);
        session('admin_name',null);
        $this->redirect('/admin/Login/login');
    }
}

