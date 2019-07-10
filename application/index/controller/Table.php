<?php

namespace app\Index\controller;
use app\croupier\model\Table as croupierTable;
use think\Db;
class Table extends Common
{
    /**
     * 台桌列表
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function table_list()
    {
        $game_id = input('game_id');
        $map   = [];
        $map[] = ['is_online', '=', 1];
        $map[] = ['is_danji', '=', 2];
        $map[] = ['status', '=', 1];
        $view = '';
        if ($this->uinfo['type'] == 3) {
            $map[] = ['is_phone', '=', 1];
            $view = 'table_list_dt';
        } else {
            $map[] = ['is_system', '=', 1];
        }
        if (!empty($game_id)) {
            $map[] = ['game_id', '=', $game_id];
        }
        $table_list  = db::name('table')->where($map)->select();
        $data             = [];
        $data['userinfo'] = db::name('user')->where('uid', $this->uinfo['uid'])->field('uid,nickname,money,last_login_token')->find();
        //dump($data);die;
        $data['last_login_token'] = $data['userinfo']['last_login_token'];
        $data['push_server_addr'] = config('app.push_server_addr');
        $this->assign('table_list', $table_list);
        $this->assign('info', $data);
        $this->assign('action_trade_time',session('trade_time'));
        if($game_id == 3){
            $view = 'table_list_nn';
        }

        if($this->uinfo['uid']==143){
            //$view="table_list_test";
        }
        return $this->fetch($view);
    }


    /**
     * 台桌详情
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function table_info()
    {
        $table_id = input('table_id');
        if (empty($table_id)) {
            $this->error("参数异常");
        }
        $where=[];
        $where[] = ['uid','=',$this->uinfo['uid']];
        $where[] = ['status','=',1];
        $userinfo = db::name('user')->where($where)->find();
        if(!$userinfo){
            $this->error('参数错误','/index/login/logout');
        }
        $map      = [];
        $map[]    = ['table_id', '=', $table_id];
        $map[]    = ['is_online', '=', 1];
        $map[]    = ['status', '=', 1];
        $map[]    = ['is_danji','=',2];

        if ($this->uinfo['type'] == 3) {
            $map[] = ['is_phone', '=', 1];
        } else {
            $map[] = ['is_system', '=', 1];
        }

        $table_info = db('table')->where($map)->find();
        if (empty($table_info)) {
            $this->error("未查到该桌台");
        }
        if ($table_info['is_online'] != 1) {
            $this->error("该桌台暂无法投注");
        }
        //游戏配置信息
        $game_info = db('game')->where('game_id', $table_info['game_id'])->find();
        // dump($game_info);

        $data                     = [];
        $data['table_id']         = $table_info['table_id'];
        $data['username']         = $userinfo['username'];
        $data['money']            = number_format($userinfo['money'], 2);
        $data['last_login_token'] = $userinfo['last_login_token'];

        if ($userinfo['limit_type'] == 2) {
            $data['trade_limit']['trade_min'] = floor($userinfo['trade_min']);
            $data['trade_limit']['trade_max'] = floor($userinfo['trade_max']);
            $data['trade_limit']['zhuang']    = floor($data['trade_limit']['trade_max'] * config('app.trade_limit_zhuang'));
            $data['trade_limit']['xian']      = floor($data['trade_limit']['trade_max'] * config('app.trade_limit_xian'));
            $data['trade_limit']['bjl_he']    = floor($data['trade_limit']['trade_max'] * config('app.trade_limit_bjl_he'));
            $data['trade_limit']['zhuangdui'] = floor($data['trade_limit']['trade_max'] * config('app.trade_limit_zhuangdui'));
            $data['trade_limit']['xiandui']   = floor($data['trade_limit']['trade_max'] * config('app.trade_limit_xiandui'));
            $data['trade_limit']['long']      = floor($data['trade_limit']['trade_max'] * config('app.trade_limit_long'));
            $data['trade_limit']['hu']        = floor($data['trade_limit']['trade_max'] * config('app.trade_limit_hu'));
            $data['trade_limit']['lh_he']     = floor($data['trade_limit']['trade_max'] * config('app.trade_limit_lh_he'));
        } else {
            $data['trade_limit']['trade_min'] = floor($table_info['trade_min']);
            $data['trade_limit']['trade_max'] = floor($table_info['trade_max']);
            $data['trade_limit']['zhuang']    = floor($data['trade_limit']['trade_max'] * config('app.trade_limit_zhuang'));
            $data['trade_limit']['xian']      = floor($data['trade_limit']['trade_max'] * config('app.trade_limit_xian'));
            $data['trade_limit']['bjl_he']    = floor($data['trade_limit']['trade_max'] * config('app.trade_limit_bjl_he'));
            $data['trade_limit']['zhuangdui'] = floor($data['trade_limit']['trade_max'] * config('app.trade_limit_zhuangdui'));
            $data['trade_limit']['xiandui']   = floor($data['trade_limit']['trade_max'] * config('app.trade_limit_xiandui'));
            $data['trade_limit']['long']      = floor($data['trade_limit']['trade_max'] * config('app.trade_limit_long'));
            $data['trade_limit']['hu']        = floor($data['trade_limit']['trade_max'] * config('app.trade_limit_hu'));
            $data['trade_limit']['lh_he']     = floor($data['trade_limit']['trade_max'] * config('app.trade_limit_lh_he'));
        }
        //     $data=[];
        //     $data['zhuomian'] = 'rtmp://47.90.104.164:1935/live/lsj';
        //     $data['paidian'] = 'rtmp://47.90.104.164:1935/live/lsj';
        //     $data['quanjing'] = 'rtmp://47.90.104.164:1935/live/lsj';
        // echo  json_encode($data);
        $data['game_config']  = json_decode($game_info['game_config'], true);
        $data['video_config'] = json_decode($table_info['video_config'], true);

        $data['push_server_addr'] = config('app.push_server_addr');
        $data['table_name'] = $table_info['table_name'];;

        // dump($this->uinfo);
        $map   = [];
        $map[] = ['is_online', '=', 1];
        $map[] = ['status', '=', 1];
        if ($this->uinfo['type'] == 3) {
            $map[] = ['is_phone', '=', 1];
        } else {
            $map[] = ['is_system', '=', 1];
        }
        $map[] = ['is_danji', '=', 2];
        //获取所有台桌
        $all_table_list = db('table')->where($map)->select();
        foreach ($all_table_list as $k => &$v) {
            $v['video_config'] = json_decode($v['video_config'], true);
            if ($v['game_id'] == 1) {
                $v['table_short_title'] = '百';
            } elseif ($v['game_id'] == 2) {
                $v['table_short_title'] = '龙';
            }

        }
        $cache_push_user_in_name = 'table_' . $table_info['table_id'] . '_' . $this->uinfo['username'];
        $cache_value = cache($cache_push_user_in_name);
        if (empty($cache_value))
        {
            $croupierTable   = new croupierTable();
            $content         = [];
            $content['code'] = 102; //
            $content['data'] = "用户" . $this->uinfo['username'] . '进入房间'; //;//
            $croupierTable->push_server_msg(2, $table_info['table_id'], $content);
            cache($cache_push_user_in_name, 1, 10);
        }
        $this->assign('all_table_list', $all_table_list);
        $this->assign('info', $data);

        $view = 'table_info_lh';
        if ($table_info['game_id'] == 1) {
            $view = "table_info_bjl";
        } elseif ($table_info['game_id'] == 2) {
            $view = "table_info_lh";
        }elseif ($table_info['game_id'] == 3) {
            $view = "table_info_nn";
            //获取牛牛规则
            $protocol = Db::name('agreement')->where(['title'=>'牛牛规则'])->value('content');
            $this->assign('protocol',$protocol);
        }
        
        if($this->uinfo['type']==3){
           $view.= '_dt';
        }
        $this->assign('action_trade_time',session('trade_time'));
        return $this->fetch($view);
       

    }

    public function table_list_info()
    {
        // $croupierTable = new croupierTable();
        // $data          = $croupierTable->push_table_list();
        // ApiReturn("1", 'success', $data);
    }
    //投注大厅
    public function bet_list()
    {

        $page = input('page', 1);
        $map   = [];
        $map[] = ['is_online', '=', 1];
        $map[] = ['status', '=', 1];
        $map[] = ['is_danji', '=', 2];
        if ($this->uinfo['type'] == 3) {
            $map[] = ['is_phone', '=', 1];
        } else {
            $map[] = ['is_system', '=', 1];
        }
        //获取所有台桌
        $all_table_list = db::name('table')->where($map)->select();
        foreach ($all_table_list as $k => &$v) {
            $v['video_config'] = json_decode($v['video_config'], true);
            if ($v['game_id'] == 1) {
                $v['table_short_title'] = '百';
            } elseif ($v['game_id'] == 2) {
                $v['table_short_title'] = '龙';
            }
        }

        //判定台桌页码范围
        $min_page  = 1;
        $max_page  = ceil(count($all_table_list) / 3);
        $pre_page  = $page - 1;
        $next_page = $page + 1;
        if ($pre_page <= $min_page) {
            $pre_page = $min_page;
        }
        if ($next_page >= $max_page) {
            $next_page = $max_page;
        }
        if ($page <= $min_page) {
            $page = $min_page;

        } elseif ($page >= $max_page) {
            $page = $max_page;

        }
        $table_list  = db::name('table')->where($map)->page($page, 3)->select();

        $game_list = db::name('game')->cache(10)->select();
        foreach ($table_list as $k => &$v) {
            foreach ($game_list as $m => $n) {
                if ($v['game_id'] == $n['game_id']) {
                    $v['game_config'] = json_decode($n['game_config'], true);
                }
            }
            $v['video_config'] = json_decode($v['video_config'], true);
        }

        $data     = [];
        $userinfo = db::name('user')->where('uid', $this->uinfo['uid'])->find();

        $data['last_login_token'] = $userinfo['last_login_token'];
        $data['push_server_addr'] = config('app.push_server_addr');
        $data['pre_page']         = $pre_page;
        $data['next_page']        = $next_page;
        $data['page']             = $page;

        // dump($data);die;
        $this->assign('table_list', $table_list);
        $this->assign('all_table_list', $all_table_list);
        $this->assign('info', $data);
        $this->assign('userinfo', $userinfo);
        $map    = [];
        $map[]  = ['status', '=', 1];
        $map[]  = ['type', '=', 1];
        $notice = db::name('notice')->where($map)->order('sort desc')->column('content');
        $notice = implode('&emsp;&emsp;&emsp;&emsp;',$notice);
        $this->assign('notice', $notice);
        $this->assign('action_trade_time',session('trade_time'));
        return $this->fetch();
    }

    //用户进入房间播报
    public function push_to_table()
    {
        // $table_id = input('table_id');
        // if (empty($table_id)) {
        //     ApiReturn("1", '非法参数', '');
        // }
        // $user_info       = session('uinfo');
        // $croupierTable   = new croupierTable();
        // $content         = [];
        // $content['code'] = 102; //
        // $content['data'] = "用户:" . $user_info['username'] . ",进入房间"; //;//
        // $reslut          = $croupierTable->push_server_msg(2, $table_id, $content);
        // // $data          = $croupierTable->push_table_list();
        // ApiReturn("1", 'success', $reslut);
    }


}
