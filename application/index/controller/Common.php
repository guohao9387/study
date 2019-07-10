<?php

namespace app\index\controller;
use think\Controller;
class Common extends Controller
{
    public $uinfo;
    public function initialize()
    {
    	if(isMobile()){
            $this->redirect('/mobile/login/logout');
        }
        $this->uinfo = session('uinfo');
        if (empty($this->uinfo)) {
            $this->redirect('/index/login/login');
        }
        if(session('trade_time')<=time()){
            $this->redirect('/index/login/logout');
        }
        //判断是否重复登陆
        $last_login_token = db('user')->where(['uid'=>$this->uinfo['uid']])->value('last_login_token');
        // dump($last_login_token);
        // dump($this->uinfo['last_login_token']);die;
        if($last_login_token!=$this->uinfo['last_login_token']){
            session('uinfo',null);
            session('trade_time',null);
            $this->redirect('/index/login/login');
        }

    }
}
