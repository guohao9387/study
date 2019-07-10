<?php
namespace app\index\controller;
use think\Controller;
class Login extends Controller
{
    //会员登陆页面
    public function login(){
        if(isMobile()){
            $this->redirect('/mobile/login/login');
        }
    	return $this->fetch();
    }
    public function logout(){
        session('uinfo',null);
        session('trade_time',null);
        $this->redirect('/index/login/login');
    }


    public function test(){
        $mob = '15399681059';
        $ret = send_msg($mob);
        print_r($ret);
    }

   
}
