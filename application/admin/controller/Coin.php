<?php
namespace app\admin\controller;
use think\Db;
class Coin extends Common{
    public function initialize(){
        parent::initialize();
    }
    public function coin_list(){
        $param = input('get.');
        $where = array();
        $where[] = ['status','=',1];
        if(request()->isGet()){
            if(!empty($param['name'])){
                $where[] = ['name','=',$param['name']];
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $list = db::name('apply_coin')->where($where)->order(['id'=>'desc'])->paginate(20,false,['query'=>$param]);
        $this->assign('list',$list);
        $count = db::name('apply_coin')->where($where)->count();
        $this->assign('count',$count);
        return $this->fetch();
    }
    /*公告添加*/
    public function coin_add(){
        if(request()->isAjax()){
            $data = input('post.');
            unset($data['file']);
            $data['show_status']=2;
            $data['add_time'] = date('Y-m-d H:i:s',time());
            $data['update_time'] = date('Y-m-d H:i:s',time());
            $res = db::name('apply_coin')->insert($data);
            if($res){
                add_user_operation($this->admin,$this->admin_name, 3,4,'添加申购币', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
                $data = array();
                $data['status'] = 1;
                $data['msg'] = '添加成功';
            }else{
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '添加失败';
            }
            return json($data);
        }else{
            return $this->fetch();
        }
    }
    /*公告编辑*/
    public function coin_edit(){
        if(request()->isAjax()){
            $data = input('post.');
            unset($data['file']);
            $data['update_time'] = date('Y-m-d H:i:s',time());
            $res = db::name('apply_coin')->update($data);
            if($res){
                add_user_operation($this->admin,$this->admin_name, 3,4,'修改申购币', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
                $data = array();
                $data['status'] = 1;
                $data['msg'] = '修改成功';
            }else{
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '修改失败';
            }
            return json($data);
        }else{
            $where = array();
            $where[] = ['status','=',1];
            $where[] = ['id','=',input('get.id')];
            $info = db::name('apply_coin')->where($where)->find();
            if($info){
                $this->assign('info',$info);
                return $this->fetch();
            }else{
                $this->error('参数有误');
            }
        }
    }
    public function user_apply_coin(){
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['apply_coin_id'])){
                $where[] = ['apply_coin_id','=',$param['apply_coin_id']];
            }
            if(!empty($param['username'])){
                $where[] = ['username','=',$param['username']];
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $list = db::name('user_apply_coin')->where($where)->order(['id'=>'desc'])->paginate(20,false,['query'=>$param]);
        $this->assign('list',$list);
        $count = db::name('user_apply_coin')->where($where)->sum('amount');
        $this->assign('count',$count);
        $where=[];
        $where[]=['status','=',1];
        $coin_list=db::name('apply_coin')->where($where)->field('id,name')->select();
        $this->assign('coin_list',$coin_list);
        $this->assign('page_number',$this->page_number);

        return $this->fetch();
    }
    public function apply_coin_order_log(){
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['apply_coin_id'])){
                $where[] = ['apply_coin_id','=',$param['apply_coin_id']];
            }
            if(!empty($param['username'])){
                $where[] = ['username','=',$param['username']];
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $list = db::name('apply_coin_order_log')->where($where)->order(['id'=>'desc'])->paginate(20,false,['query'=>$param]);
        $this->assign('list',$list);
        $count = db::name('apply_coin_order_log')
            ->where($where)
            ->field('sum(number) number,sum(amount) sum_amount')
            ->find();
        $this->assign('count',$count);

        $where=[];
        $where[]=['status','=',1];
        $coin_list=db::name('apply_coin')->where($where)->field('id,name')->select();
        $this->assign('coin_list',$coin_list);
        $this->assign('page_number',$this->page_number);

        return $this->fetch();
    }
    public function apply_coin_give_log(){
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['apply_coin_id'])){
                $where[] = ['apply_coin_id','=',$param['apply_coin_id']];
            }
            if(!empty($param['username'])){
                $where[] = ['username','=',$param['username']];
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $list = db::name('apply_coin_give_log')->where($where)->order(['id'=>'desc'])->paginate(20,false,['query'=>$param]);
        $this->assign('list',$list);
        $count = db::name('apply_coin_give_log')
            ->where($where)
            ->field('sum(number) number')
            ->find();
        $this->assign('count',$count);
        $where=[];
        $where[]=['status','=',1];
        $coin_list=db::name('apply_coin')->where($where)->field('id,name')->select();
        $this->assign('coin_list',$coin_list);
        $this->assign('page_number',$this->page_number);

        return $this->fetch();
    }
}

