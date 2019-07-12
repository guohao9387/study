<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\cache;
class common extends Controller{
    public  $admin;
    public  $admin_name;
    public  $config;
    public  $page_number;
    public function initialize(){

//        $arr = explode('.',get_real_ip());
//        $my_ip=$arr[0].".".$arr[1].".".$arr[2];
//
//        $map=[];
//        $map[]=['status','=',1];
//        $ip_list=db::name('ip')->where($map)->select();
//        $ip=[];
//        if($ip_list){
//            foreach ($ip_list as $value) {
//                $ip[]=$value['ip'];
//            }
//        }
//        $ip[]='127.0.0';
//        $ip[] = '117.67.87';
//        $ip[] = '47.52.116';
//        $ip[] = '47.75.181';
//        if(!in_array($my_ip,$ip)){
//           echo $my_ip.'--';
//            die;
//        }
        // dump($_SERVER);die;
        $this->admin=session('admin');
        $this->admin_name=session('admin_name');
        if(empty($this->admin)){
            $this->redirect('/admin/Login/login');
        }
        $this->config = cache('config');
        if(!$this->config){
            $system = db::name('config')->cache('config')->select();
            $sys = [];
            foreach($system as $v){
                $sys[$v['key']] = $v['value'];
            }
            $this->config = $sys;
        }
        $GLOBALS['title'] =$this->config['title'].'后台';
        $this->page_number = db::name('page_number')->cache('page_number')->field('num')->select();
        $mytime=quick_time_select(2);
        $this->assign('mytime',$mytime);
    }
}

