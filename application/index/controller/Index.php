<?php
namespace app\index\controller;
use think\Db;
class Index extends Common
{
    public function initialize()
    {
        parent::initialize();
    }
    public function index()
    {
        return $this->fetch();
    }
}
