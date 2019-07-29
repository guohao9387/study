<?php
namespace app\mobile\controller;
use think\Db;
class Index extends Common
{
    public function initialize(){
        parent::initialize();
    }
    public function index()
    {
        $where=[];
        $where[]=['status','=',1];
        $where[]=['type','=',1];
        $list=db::name('notice')->where($where)->order('sort desc')->select();
        $this->assign('notice_list',$list);

        $where=[];
        $where[]=['status','=',1];
        $where[]=['type','=',1];
        $list=db::name('news')->where($where)->order('sort desc')->limit(6)->select();
        $this->assign('news_list',$list);

        $where=[];
        $where[]=['status','=',1];
        $where[]=['type','=',3];
        $list=db::name('adv')->where($where)->order('sort desc')->select();
        $this->assign('adv',$list);

        return $this->fetch();
    }
    public function price()
    {
        $where=[];
        $where[]=['status','=',1];
        $where[]=['show_status','=',1];
        $product=db::name('product')->where($where)->field('id,name,desc_name,abbreviation,contract,image')->select();
        $this->assign('product',$product);
        return $this->fetch();
    }
}
