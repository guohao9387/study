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
    public function create_order(){
        if(request()->isAjax()){

        }
    }
}