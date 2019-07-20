<?php
namespace app\index\controller;
use think\Db;
class Trade extends Common
{
    public $user;
    public $user_name;
    public function initialize()
    {
        parent::initialize();
        $this->user = session('user');
        $this->user_name = session('user_name');
        if (empty($this->user)) {
            $this->redirect('/index/Login/login');
        }
    }
    public function index()
    {
        return $this->fetch();
    }
}
