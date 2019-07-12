<?php
namespace app\index\controller;
use think\Controller;
class Common extends Controller
{
    public $user;
    public $user_name;
    public function initialize()
    {
        $this->user = session('user');
        $this->user_name = session('user_name');
        if (empty($this->user)) {
            $this->redirect('/index/Index/index');
        }
    }
}
