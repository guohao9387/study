<?php
namespace app\admin\controller;
use think\Db;
class System extends Common{
    public function initialize(){
        parent::initialize();
    }
    /*系统设置*/
    public function  index(){
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
                $result = db::name('config')->update($info);
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
                reset_cache();
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