<?php
namespace app\admin\controller;
use think\Db;
class Log extends Common{
    public function initialize(){
        parent::initialize();
    }

    /**
     * 操作日志
     * @return mixed
     * @throws \think\exception\DbException
     */
    public function  admin_log(){
        $param = input('get.');
        $where = array();
        $where[] = ['type','=',3];
        if(request()->isGet()){
            if(!empty($param['username'])){
                //操作人
                $where[] = ['username','=',$param['username']];
            }
            if(!empty($param['operation_type'])){
                //被操作人类型
                $where[] = ['operation_type','=',$param['operation_type']];
            }
            if(!empty($param['aid'])){
                // 若被操作人不为空
                $aid=0;
                if(!empty($param['operation_type'])){
                    if($param['operation_type']==1){
                        // 被操作人为会员
                        $map=[];
                        $map[]=['username','=',$param['aid']];
                        $map[]=['status','=',1];
                        $aid=db::name('user')->where($map)->value('uid');
                    }
                    if($param['operation_type']==2){
                        // 被操作人为代理
                        $map=[];
                        $map[]=['agent_name','=',$param['aid']];
                        $map[]=['status','=',1];
                        $aid=db::name('agent')->where($map)->value('agent_id');
                    }
                    if($param['operation_type']==3){
                        // 备操作人为管理员
                        $map=[];
                        $map[]=['username','=',$param['aid']];
                        $map[]=['status','=',1];
                        $aid=db::name('admin')->where($map)->value('aid');
                    }
                }
                if(!empty($aid)){
                    $where[] = ['aid','=',$aid];
                }
            }
            if(!empty($param['note'])){
                // like查询说明信息
                $where[] = ['note','like','%'.$param['note'].'%'];
            }
            if(!empty($param['start'])){
                // 开始时间
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                // 结束时间
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $page = isset($param['page_number'])?$param['page_number']:20;
        $list = db::name('operation_log')->where($where)->field('id,username,operation_type,note,url,add_ip,add_time,aid,type')->order('id desc')->paginate($page,false,['query'=>$param]);
        $this->assign('list',$list);
        $count = db::name('operation_log')->where($where)->count();
        $this->assign('count',$count);
        $this->assign('page_number',$this->page_number);
        return $this->fetch();
    }
    public function  agent_log(){
        $param = input('get.');
        $where = array();
        $where[] = ['type','=',2];
        if(request()->isGet()){
            if(!empty($param['username'])){
                //操作人
                $where[] = ['username','=',$param['username']];
            }
            if(!empty($param['note'])){
                // like查询说明信息
                $where[] = ['note','like','%'.$param['note'].'%'];
            }
            if(!empty($param['start'])){
                // 开始时间
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                // 结束时间
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $page = isset($param['page_number'])?$param['page_number']:20;
        $list = db::name('operation_log')->where($where)->field('id,username,operation_type,note,url,add_ip,add_time,aid,type')->order('id desc')->paginate($page,false,['query'=>$param]);
        $this->assign('list',$list);
        $count = db::name('operation_log')->where($where)->count();
        $this->assign('count',$count);
        $this->assign('page_number',$this->page_number);
        return $this->fetch();
    }
    public function     user_log(){
        $param = input('get.');
        $where = array();
        $where[] = ['type','=',1];
        if(request()->isGet()){
            if(!empty($param['username'])){
                //操作人
                $where[] = ['username','=',$param['username']];
            }
            if(!empty($param['note'])){
                // like查询说明信息
                $where[] = ['note','like','%'.$param['note'].'%'];
            }
            if(!empty($param['start'])){
                // 开始时间
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                // 结束时间
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $page = isset($param['page_number'])?$param['page_number']:20;
        $list = db::name('operation_log')->where($where)->field('id,username,operation_type,note,url,add_ip,add_time,aid,type')->order('id desc')->paginate($page,false,['query'=>$param]);
        $this->assign('list',$list);
        $count = db::name('operation_log')->where($where)->count();
        $this->assign('count',$count);
        $this->assign('page_number',$this->page_number);
        return $this->fetch();
    }

    /*订单详情*/
    public function log_info(){
        $where = array();
        $where[] = ['id','=',input('get.id')];
        $info = db::name('operation_log')->where($where)->find();
        if($info){
            $this->assign('info',$info);
            return $this->fetch();
        }else{
            $this->error('信息有误');
        }
    }
}