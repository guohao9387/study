<?php
namespace app\admin\controller;
use think\Db;
class Money extends Common{
    public function initialize(){
        parent::initialize();
    }

    /*充值记录*/
    public function  recharge_list(){
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['username'])){
                $where[]= ['username','=',$param['username']];
            }
            if(!empty($param['order_sn'])){
                $where[]= ['order_sn','=',$param['order_sn']];
            }
            if(!empty($param['agent_name'])){
                $where[]= ['agent_name','=',$param['agent_name']];
            }
            if(!empty($param['type'])){
                $where[]= ['type','=',$param['type']];
            }
            if(!empty($param['status'])){
                $where[]= ['status','=',$param['status']];
            }
            if(!empty($param['start'])){
                $where[]= ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[]= ['add_time','<=',$param['end']];
            }
        }
        $page = isset($param['page_number'])?$param['page_number']:20;

        $list = db::name('recharge')
            ->where($where)
            ->order('id desc')
            ->paginate($page,false,['query'=>$param]);
        $this->assign('list',$list);
        $count = db::name('recharge')
            ->where($where)
            ->field('count(id) count,sum(money) sum')
            ->find();
        $this->assign('count',$count);
        $this->assign('page_number',$this->page_number);

        return $this->fetch();
    }

    /*提现记录*/
    public function user_withdraw_list(){
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['username'])){
                $where[]= ['username','=',$param['username']];
            }
            if(!empty($param['nickname'])){
                $where[]= ['nickname','=',$param['nickname']];
            }
            if(!empty($param['phone'])){
                $where[]= ['phone','=',$param['phone']];
            }
            if(!empty($param['agent_name'])){
                $where[]= ['agent_name','=',$param['agent_name']];
            }
            if(!empty($param['status'])){
                $where[]= ['status','=',$param['status']];
            }
            if(!empty($param['start'])){
                $where[]= ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[]= ['add_time','<=',$param['end']];
            }
        }
        $page = isset($param['page_number'])?$param['page_number']:20;

        $list = db::name('user_withdraw_log')
            ->where($where)
            ->order('id desc')
            ->paginate($page,false,['query'=>$param]);
        $this->assign('list',$list);

        //array_shift($where);
        $count = db::name('user_withdraw_log')
            ->where($where)
            ->field('count(id) count,sum(money) sum')
            ->find();
        $this->assign('count',$count);
        $this->assign('page_number',$this->page_number);

        return $this->fetch();
    }

    /*提现记录*/
    public function agent_withdraw_list(){
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['agent_name'])){
                $where[]= ['agent_name','=',$param['agent_name']];
            }
            if(!empty($param['nickname'])){
                $where[]= ['nickname','=',$param['nickname']];
            }
            if(!empty($param['status'])){
                $where[]= ['status','=',$param['status']];
            }
            if(!empty($param['start'])){
                $where[]= ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[]= ['add_time','<=',$param['end']];
            }
        }
        $page = isset($param['page_number'])?$param['page_number']:20;
        $list = db::name('agent_withdraw_log')
            ->where($where)
            ->order('id desc')
            ->paginate($page,false,['query'=>$param]);
        $this->assign('list',$list);
        $count = db::name('agent_withdraw_log')
            ->where($where)
            ->field('count(id) count,sum(money) sum')
            ->find();
        $this->assign('page_number',$this->page_number);
        $this->assign('count',$count);
        return $this->fetch();
    }


    /*资金总记录 1,4*/
    public function  user_money_list(){
		//config('app_trace',true);
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['username'])){
                $where[] = ['username','=',$param['username']];
            }
            if(!empty($param['nickname'])){
                $where[]= ['nickname','=',$param['nickname']];
            }

            if(!empty($param['agent_name'])){
                $where[] = ['agent_name','=',$param['agent_name']];
            }

            if(!empty($param['type'])){
                $where[] = ['type','=',$param['type']];
            }

            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $page = isset($param['page_number'])?$param['page_number']:20;

        $list = db::name('user_money_log')
            ->where($where)
            ->order('id desc')
            ->paginate($page,false,['query'=>$param]);
        $this->assign('list',$list);

        $count = db::name('user_money_log')
            ->field('count(id) count,sum(money) sum')
            ->where($where)
            ->find();

		//$count = ['sum'=>16791343.12,'count'=>7202925];
        $this->assign('count',$count);
        $this->assign('page_number',$this->page_number);

        return $this->fetch();
    }
    /*资金总记录*/
    public function  agent_money_list(){
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['agent_name'])){
                $where[] = ['agent_name','=',$param['agent_name']];
            }
            if(!empty($param['nickname'])){
                $where[]= ['nickname','=',$param['nickname']];
            }
            if(!empty($param['type'])){
                $where[] = ['type','=',$param['type']];
            }
            if(!empty($param['remark'])){
                $where[] = ['remark','=',$param['remark']];
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $page = isset($param['page_number'])?$param['page_number']:20;

//        dump($where);die;
        $list = db::name('agent_money_log')
            ->where($where)
            ->order('id desc')
            ->paginate($page,false,['query'=>$param]);
        $this->assign('list',$list);

        $count = db::name('agent_money_log')
            ->field('count(id) count,sum(money) sum')
            ->where($where)
            ->find();
        $this->assign('count',$count);
        $this->assign('page_number',$this->page_number);

        return $this->fetch();
    }
}