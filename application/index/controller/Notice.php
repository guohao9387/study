<?php
namespace app\index\controller;
use think\Db;
class Notice extends Common
{
    public function initialize(){
        parent::initialize();
        $kefu=[];
        $kefu['qq']=db::name('kefu')->where('id','=',2)->cache('qq_kefu')->value('value');
        $kefu['weixin']=db::name('kefu')->where('id','=',3)->cache('weixin_kefu')->value('image');
        $kefu['phone']=db::name('kefu')->where('id','=',4)->cache('phone_kefu')->value('image');
        $this->assign('kefu',$kefu);

        $where=[];
        $where[]=['status','=',1];
        $where[]=['type','=',2];
        $list=db::name('news')->where($where)->order('sort desc')->limit(6)->select();
        $this->assign('about_us_list',$list);

        $where=[];
        $where[]=['status','=',1];
        $where[]=['type','=',3];
        $list=db::name('news')->where($where)->order('sort desc')->limit(6)->select();
        $this->assign('help_list',$list);

        $where=[];
        $where[]=['status','=',1];
        $where[]=['type','=',4];
        $list=db::name('news')->where($where)->order('sort desc')->limit(6)->select();
        $this->assign('download_list',$list);
    }
    public function index(){
        $param=input('get.');
        $where=[];
        $where[]=['status','=',1];
        $where[]=['type','=',1];
        $list=db::name('notice')->where($where)->order('sort desc')->paginate(20,false,['query'=>$param]);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function news(){
        $param=input('get.');
        $where=[];
        $where[]=['status','=',1];
        $where[]=['type','=',1];
        $list=db::name('news')->where($where)->order('sort desc')->paginate(20,false,['query'=>$param]);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function about_us(){
        $param=input('get.');
        $where=[];
        $where[]=['status','=',1];
        $where[]=['type','=',2];
        $list=db::name('news')->where($where)->order('sort desc')->paginate(20,false,['query'=>$param]);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function help(){
        $param=input('get.');
        $where=[];
        $where[]=['status','=',1];
        $where[]=['type','=',3];
        $list=db::name('news')->where($where)->order('sort desc')->paginate(20,false,['query'=>$param]);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function download(){
        $param=input('get.');
        $where=[];
        $where[]=['status','=',1];
        $where[]=['type','=',4];
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
    public function about_us_info(){
        $id=input('get.id');
        $where=[];
        $where[]=['id','=',$id];
        $where[]=['status','=',1];
        $where[]=['type','=',2];
        $info=db::name('news')->where($where)->find();
        $this->assign('info',$info);
        return $this->fetch();
    }
    public function download_info(){
        $id=input('get.id');
        $where=[];
        $where[]=['id','=',$id];
        $where[]=['status','=',1];
        $where[]=['type','=',4];
        $info=db::name('news')->where($where)->find();
        $this->assign('info',$info);
        return $this->fetch();
    }
    public function help_info(){
        $id=input('get.id');
        $where=[];
        $where[]=['id','=',$id];
        $where[]=['status','=',1];
        $where[]=['type','=',3];
        $info=db::name('news')->where($where)->find();
        $this->assign('info',$info);
        return $this->fetch();
    }

}
