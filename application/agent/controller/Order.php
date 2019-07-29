<?php
namespace app\agent\controller;
use think\Db;
class Order extends Common{
    public function initialize(){
        parent::initialize();
    }
    /*订单列表*/
    public function  order_list(){
        $param = input('get.');
        $where = array();
        $where[] = ['order_status','=',2];
        $where[]=['agent_id','in',get_all_agent($this->agent)];
        if(request()->isGet()){
            if(!empty($param['username'])){
                $where[] = ['username','=',$param['username']];
            }
            if(!empty($param['pid'])){
                $where[] = ['pid','=',$param['pid']];
            }
            if(!empty($param['order_sn'])){
                $where[] = ['order_sn','=',$param['order_sn']];
            }
            if(!empty($param['direction'])){
                $where[] = ['direction','=',$param['direction']];
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $page = isset($param['page_number'])?$param['page_number']:20;
        $list = db::name('order')->where($where)->order('oid desc')->paginate($page,false,['query'=>$param]);
        $this->assign('list',$list);
        $count = db::name('order')
            ->where($where)
            ->field('count(oid) count,sum(money) sum_money,sum(fee) sum_fee,sum(profit) sum_order_profit')
            ->find();
        $this->assign('count',$count);
        $this->assign('page_number',$this->page_number);
        $where=[];
        $where[]=['status','=',1];
        $product=db::name('product')->where($where)->select();
        $this->assign('product',$product);

        return $this->fetch();
    }
    public function order_info(){
        $where = array();
        $where[] = ['oid','=',input('get.oid')];
        $where[] = ['order_status','=',2];
        $where[]=['agent_id','in',get_all_agent($this->agent)];
        $info = db::name('order')->where($where)->find();

        if($info){
            $this->assign('info',$info);
            return $this->fetch();
        }else{
            $this->error('信息有误');
        }
    }
    public function keep_order_list(){
        $param = input('get.');
        $where = array();
        $where[] = ['order_status','=',1];
        $where[]=['agent_id','in',get_all_agent($this->agent)];
        if(request()->isGet()){
            if(!empty($param['username'])){
                $where[] = ['username','=',$param['username']];
            }
            if(!empty($param['pid'])){
                $where[] = ['pid','=',$param['pid']];
            }
            if(!empty($param['order_sn'])){
                $where[] = ['order_sn','=',$param['order_sn']];
            }
            if(!empty($param['direction'])){
                $where[] = ['direction','=',$param['direction']];
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $page = isset($param['page_number'])?$param['page_number']:20;
        $list = db::name('order')->where($where)->order('oid desc')->paginate($page,false,['query'=>$param]);
        $this->assign('list',$list);
        $count = db::name('order')
            ->where($where)
            ->field('count(oid) count,sum(money) sum_money,sum(fee) sum_fee')
            ->find();
        $this->assign('count',$count);
        $this->assign('page_number',$this->page_number);
        $where=[];
        $where[]=['status','=',1];
        $product=db::name('product')->where($where)->select();
        $this->assign('product',$product);
        $this->assign('agent',$this->agent);

        return $this->fetch();
    }

}