<?php
namespace app\agent\controller;
use think\Db;
class Index extends Common{
    public function initialize(){
        parent::initialize();
    }

    /*首页*/
    public function index()
    {
        $p_agent_id=db::name('agent')->where('agent_id',$this->agent)->value('p_agent_id');
        $this->assign('p_agent_id',$p_agent_id);
        return $this->fetch();
    }
    /*首页内容*/
    public function main()
    {
        $nickname = db::name('agent')->where('agent_id',$this->agent)->value('agent_name');
        $this->assign('nickname',$nickname);

        $where = [];
        $where[] = ['agent_id','=',$this->agent];

        $info = db::name('agent')->where($where)->field('money')->find();
        $param = [];
        $param['money'] = $info['money'];

        $where=[];
        $where[]=['status','=',2];
        $where[]=['agent_id','=',$this->agent];
        $param['withdraw']=db::name('agent_withdraw_log')->where($where)->sum('money');
        $where = array();
        $where['status'] = 1;
        $where['type'] = 2;
        $param['notice'] = db::name('notice')->where($where)->order('id desc')->field('content,add_time')->find();

        $this->assign('param',$param);

        $where = [];
        $where[] = ['agent_id','=',$this->agent];
        $list = db::name('agent_money_log')
            ->where($where)
            ->limit(10)
            ->order('id desc')->select();
        $this->assign('list',$list);
        return $this->fetch();
    }

    /*公告*/
    public function notice(){
        $where = array();
        $where[] = ['id','=',input('get.id')];
        $where[] = ['type','=',2];
        $where[] = ['status','=',1];
        $info = db::name('notice')->where($where)->field('title,content')->find();
        $this->assign('info',$info);
        return $this->fetch();
    }

}

