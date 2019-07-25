<?php
namespace app\agent\controller;
use think\Db;
class Log extends Common{
    public function initialize(){
        parent::initialize();
    }
    public function  log(){
        $param = input('get.');
        $where = array();
        $where[]=['type','=',2];
        $where[] = ['uid','=',$this->agent];
        if(request()->isGet()){
            if(!empty($param['note'])){
                $where[] = ['note','like','%'.$param['note'].'%'];
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }

        $page = isset($param['page_number'])?$param['page_number']:20;
        $list = db::name('operation_log')->where($where)->field('id,username,operation_type,note,url,add_ip,add_time,aid,type')->order('id desc')->paginate($page,false,['query'=>$param]);
        $this->assign('list',$list);
        $count = db::name('operation_log')->where($where)->count();
        $this->assign('count',$count);
        $this->assign('page_number',$this->page_number);
        return $this->fetch('agent_log');
    }
    /*订单详情*/
    public function log_info(){
        $where = array();
        $where[] = ['id','=',input('get.id')];
        $where[] = ['uid','=',$this->agent];
        $where[] = ['type','=',2];
        $info = db::name('operation_log')->where($where)->find();
        if($info){
            $this->assign('info',$info);
            return $this->fetch();
        }else{
            $this->error('信息有误');
        }
    }
}