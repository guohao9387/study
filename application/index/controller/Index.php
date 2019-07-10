<?php
namespace app\index\controller;
class Index extends Common
{
    public function initialize()
    {
        parent::initialize();
    }
    public function index()
    {
        $this->redirect('/index/table/table_list');
    }

    public function agreement()
    {
        $info      = db('agreement')->find(4);
        $user_info = db('user')->find($this->uinfo['uid']);
        $this->assign('info', $info);
        $this->assign('user_info', $user_info);
        return $this->fetch();
    }
    public function action_trade_time(){
        if(request()->isAjax()){
            return json(time());
        }
    }

    public function test(){
		/*
        $order = new \app\index\model\Order();
        $trade_id = 18594;
        $reslut = $order->settlement_table_trade_by_trade_id($trade_id);
        var_dump($reslut);
		*/
    }
}
