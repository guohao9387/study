<?php

namespace app\index\model;
use think\Db;
use think\Model;

class Table extends Model
{
    protected $pk = 'table_id';
    //
    //获取游戏台桌信息及相关信息
    public function table_list()
    {
        $map        = [];
        $map[]      = ['is_online', '=', 1];
        $map[]      = ['status', '=', 1];
        $table_list = db('table')->where($map)->select();

    }

    public function get_user_table_trade_list($uid,$table_id){

    }
 

}
