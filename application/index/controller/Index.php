<?php
namespace app\index\controller;
use think\Db;
class Index extends Common
{
    public function initialize(){
        parent::initialize();
        $kefu=[];
        $kefu['qq']=db::name('kefu')->where('id','=',5)->cache('qq_kefu')->value('value');
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
    public function index()
    {
        $where=[];
        $where[]=['status','=',1];
        $where[]=['show_status','=',1];
        $product=db::name('product')->where($where)->field('name,abbreviation,contract,image')->select();
        $this->assign('product',$product);

        $where=[];
        $where[]=['status','=',1];
        $where[]=['type','=',1];
        $list=db::name('notice')->where($where)->order('sort desc')->limit(6)->select();
        $this->assign('notice_list',$list);

        $where=[];
        $where[]=['status','=',1];
        $where[]=['type','=',1];
        $list=db::name('news')->where($where)->order('sort desc')->limit(6)->select();
        $this->assign('news_list',$list);

        $where=[];
        $where[]=['status','=',1];
        $where[]=['type','=',1];
        $list=db::name('adv')->where($where)->order('sort desc')->select();
        $this->assign('adv',$list);

        return $this->fetch();
    }
}
