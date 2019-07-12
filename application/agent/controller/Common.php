<?php
namespace app\agent\controller;
use think\Controller;
use think\Db;
class Common extends Controller{

    public  $agent;
    public  $agent_name;
    public  $config;
    public  $page_number;
    public function initialize(){
        $this->agent=session('agent');
        $this->agent_name=session('agent_name');
        if(empty($this->agent)){
            $this->redirect('/agent/Login/login');
        }
        if(!cache('config')){
            reset_cache();
        }
        $this->config = cache('config');
        $GLOBALS['title'] =$this->config['title'].'代理后台';
        $this->page_number = db::name('page_number')->cache('page_number')->field('num')->select();
        $mytime=quick_time_select(2);
        $this->assign('mytime',$mytime);
    }
}

