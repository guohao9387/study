<?php
namespace app\mobile\controller;
use think\Db;
class Notice extends Common
{
    public function initialize(){
        parent::initialize();
    }
    public function notice_list(){
        $param=input('get.');
        $where=[];
        $where[]=['status','=',1];
        $where[]=['type','=',1];
        $list=db::name('notice')->where($where)->order('sort desc')->paginate(20,false,['query'=>$param]);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function news_list(){
        $param=input('get.');
        $where=[];
        $where[]=['status','=',1];
        $where[]=['type','=',1];
        $list=db::name('news')->where($where)->order('sort desc')->paginate(20,false,['query'=>$param]);
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function notice_info(){
        $id=input('get.id');
        $where=[];
        $where[]=['id','=',$id];
        $where[]=['status','=',1];
        $info=db::name('notice')->where($where)->find();
        $this->assign('info',$info);
        return $this->fetch();
    }
    public function news_info(){
        $id=input('get.id');
        $where=[];
        $where[]=['id','=',$id];
        $where[]=['status','=',1];
        $where[]=['type','=',1];
        $info=db::name('news')->where($where)->find();
        $this->assign('info',$info);
        return $this->fetch();
    }

}
