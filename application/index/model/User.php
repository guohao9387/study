<?php

namespace app\index\model;
use think\Model;
class User extends Model
{
    protected $pk = 'uid';
    public function do_login($username, $password)
    {
        $map       = [];
        $map[]     = ['username', '=', $username];
        $map[] = ['status','=',1];
        $map[]     = ['password', '=', md5($password)];

        $user_info = $this->where($map)->find();
        //dump($user_info);
        if (empty($user_info)) {
            return '账号或密码错误';
        }
        if ($user_info['login_status'] == 2) {
            return '账号冻结，暂无法登陆';
        }
        $data                     = [];
        $data['uid']              = $user_info['uid'];
        $data['last_login_ip']    = get_real_ip();
        $data['last_login_time']  = date('Y-m-d H:i:s');
        $data['last_login_token'] = md5($user_info['username'] . mt_rand(100000, 999999));
        $data['update_time']      = date('Y-m-d H:i:s');
       
        $status                   = $this->update($data);
        if ($status) {
            add_user_operation($user_info['uid'],$user_info['username'],1,1,'登录', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
            $user=[];
            $user['uid'] = $user_info['uid'];
            $user['username'] = $user_info['username'];
            $user['type'] = $user_info['type'];
            $user['last_login_token'] =$data['last_login_token'];
            session('uinfo',$user);
            if($user_info['type']==1){
                session('trade_time',time()+1200);
            }else{
                session('trade_time',time()+86400);
            }
            return '1';
        } else {
            return '请重试';
        }

    }
}
