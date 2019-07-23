<?php
namespace app\index\controller;
use think\Db;
class Order extends Common
{
    public function initialize()
    {
        parent::initialize();
    }
    public function index()
    {
        return $this->fetch();
    }
    public function close_order(){
        return 1;
    }
}
