<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Common extends Controller
{
    public $config;
    public function initialize()
    {

        if(session('user')){
            $this->assign('username',session('user_name'));
        }else{
            $this->assign('username',0);
        }
        if(!cache('config')){
            $this->config =reset_cache();
        }else{
            $this->config = cache('config');
        }
        $GLOBALS['title'] =$this->config['title'];

    }
}
