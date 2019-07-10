<?php

namespace app\index\controller;
use app\croupier\model\Table as croupierTable;
use app\index\model\User;
use app\index\model\Order;
use Gosocket\Gosocket;
use think\Controller;

class Apip extends Controller
{
    public function do_login()
    {

        $username = input('username');
        $password = input('password');
        if (empty($username)) {
            ApiReturn("0", '请输入账号', '');
        }
        if (empty($password)) {
            ApiReturn("0", '请输入密码', '');
        }
        $User   = new User;
        $reslut = $User->do_login($username, $password);
        if ($reslut == 1) {
            $croupierTable   = new croupierTable();
            $content         = [];
            $content['code'] = 400; //
            $content['data'] = '您的账号已在别处登陆'; //
            $uinfo = session('uinfo');
            $croupierTable->push_server_msg(1, $uinfo['uid'], $content);
            ApiReturn("1", '登陆成功', '');
        } else {
            ApiReturn("0", $reslut, '');
        }
    }

    //根据 connection_token 推送给会员桌台消息  (无效)
    public function push_table_list_info()
    {
        $connection_token = input('connection_token');
        if (empty($connection_token)) {
            ApiReturn("0", '参数缺失', '');
        }
        //推送全部桌台信息消息
        $croupierTable   = new croupierTable();
        $Gosocket        = new Gosocket();
        $data            = $croupierTable->push_table_list();
        $content         = [];
        $content['code'] = 100; //
        $content['data'] = $data; //;//
        $reslut          = $Gosocket->sendtopersonclient($connection_token, json_encode($content));
        if ($reslut == 1) {
            ApiReturn("1", 'success', '');
        } else {
            ApiReturn("0", $reslut, '');
        }
    }
//为推送服务提供数据
    public function server_get_table_list_info()
    {
        $key      = input('key');
        $Gosocket = new Gosocket();
        $appkey   = Gosocket::API_KEY;
        if ($key != $appkey) {
            ApiReturn("0", 'key参数异常', '');
        }
        $croupierTable   = new croupierTable();
        $data            = $croupierTable->push_table_list();
        $content         = [];
        $content['code'] = 100; //
        $content['data'] = $data; //
        exit(json_encode($content));
    }
//为推送服务提供数据时间
    public function server_get_table_list_info_time()
    {
        $key      = input('key');
        $Gosocket = new Gosocket();
        $appkey   = Gosocket::API_KEY;
        if ($key != $appkey) {
            ApiReturn("0", 'key参数异常', '');
        }
        $croupierTable   = new croupierTable();
        $data            = $croupierTable->push_table_list();
        $content         = [];
        $content['code'] = 101; //
        $content['data'] = $data; //
        exit(json_encode($content));
    }
    public function test()
    {
      // debug('begin');
        // $croupierTable = new croupierTable();
        //  $data          = $croupierTable->push_table_list();
     
        // ApiReturn(1, 'success', $data);
        //  $json_data = json_encode($data);
        $order = new order();
        $result = $order->settlement_table_trade_by_trade_id_nn(632);

        // $content         = [];
        // $content['code'] = '900'.mt_rand(10,99); //
        // $content['data'] = $data; //
        // echo $croupierTable->push_server_msg(1,0, $content);
        // echo $croupierTable->push_server_msg_sendtochannelclient(28, $content);
   
      // dump($data);
    }

}
