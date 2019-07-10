<?php
namespace app\admin\controller;
use think\Db;
class System extends Common{
    public function initialize(){
        parent::initialize();
    }
    /*系统设置*/
    public function  index(){
        // // echo 4.5-3671-200-1598.5+33567.4-50-11296.5+10218-992-697+221.5+66.1+58.2;die;
        // $a=29687.10-3715.60-100.00-11296.50+8850.50-69.00-1489.50+221.50+66.10+114.70;
        // echo $a;
        // die;
        if(request()->isPost()){
            $data=input('post.');//接收所有参数信息
            //foreach中逐条做数据修改
            //$val为所有参数信息
            //$ke 为参数key名
            //$vo 为对应参数value值
            db::startTrans();
            $x = 0;
            foreach($data as $k=>$v){
                $info = array();
                $info['id'] = $k;
                $info['value'] = $v;
                $info['update_time'] = date('Y-m-d H:i:s');
                $result = db::name('config')->cache('config')->update($info);
                if(!$result){
                    $x ++;
                }
            }
            if($x !=0){
                db::rollback();
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '配置失败';
            }else{
                db::commit();
                $data = array();
                $data['status'] = 1;
                $data['msg'] = '配置成功';
            }
            return json($data);
        }else{
            $list  = db::name('config')->order('id asc')->select();
            $this->assign('list',$list);
            return $this->fetch();
        }
    }

    public function my_ip(){
        $param = input('get.');
        $where = array();
        $where[] = ['status','=',1];
        $list = db::name('ip')->where($where)->order(['id'=>'desc'])->paginate(20,false,['query'=>$param]);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function add_ip(){
        if(request()->isAjax()){
            $data=input('post.');
            $data['add_time']=date('Y-m-d H:i:s');
            $data['status']=1;
            $status=db::name('ip')->insert($data);
            if($status){
                cache('my_ip',null);
                $data=[];
                $data['status']=1;
                $data['msg']='添加成功';
            }else{
                $data=[];
                $data['status']=0;
                $data['msg']='添加失败';
            }
            return json($data);
        }else{
            return $this->fetch();
        }
    }
}