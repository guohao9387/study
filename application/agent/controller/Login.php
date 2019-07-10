<?php
namespace app\agent\controller;
use think\Controller;
use think\Db;
use think\captcha\Captcha;
class Login extends Controller{
    public function verify()
    {
        $config =    [
            // 验证码字体大小
            'fontSize'    =>    30,
            // 验证码位数
            'length'      =>    4,
            // 关闭验证码杂点
            'useNoise'    =>    false,
            //混淆曲线
            'useCurve'    =>    false,
            'codeSet'    =>    '0123456789',
        ];
        $captcha = new Captcha($config);
        return $captcha->entry();
    }
    public function login(){
        if(request()->isAjax()){
            $param = input('post.');
            if(!$param['agent_name']){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入账号';
                return json($data);
            }
            if(!$param['password']){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入密码';
                return json($data);
            }
            if(strlen($param['agent_name'])<6||strlen($param['agent_name'])>12){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入正确账号';
                return json($data);
            }
            if(strlen($param['password'])<6||strlen($param['password'])>18){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入正确密码';
                return json($data);
            }
            if(!captcha_check($param['code'])){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '验证码错误';
                return json($data);
            };
            $where=array();
            $where[] = ['agent_name','=',$param['agent_name']];
            $where[] = ['status','=',1];
            $agent=db::name('agent')->where($where)->field('agent_id,password,nickname,login_status')->find();
//            print_r($agent);
            if($agent){
                if($agent['login_status']==2){
                    $data = array();
                    $data['status'] = 0;
                    $data['msg'] = '账号状态异常';
                    return json($data);
                }
                if($agent['password']==md5($param['password'])){
                   
                    add_user_operation($agent['agent_id'],$param['agent_name'], 2,2,'登录', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
                    $data = [];
                    $data['last_login_ip'] = get_real_ip();
                    $data['last_login_time'] = date('Y-m-d H:i:s');
                    $data['agent_id'] = $agent['agent_id'];
                    db::name('agent')->update($data);
                    session('agent',$agent['agent_id']);
                    session('agent_name',$param['agent_name']);
                    $data = array();
                    $data['status'] = 1;
                    $data['msg'] = '登录成功';
                    return json($data);
                }else{
                    $data = array();
                    $data['status'] = 0;
                    $data['msg'] = '密码错误';
                    return json($data);
                }
            }else{
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '登录失败';
                return json($data);
            }
        }else{
            return $this->fetch();
        }
    }
    public function logout(){
        add_user_operation(session('agent'),session('agent_name'), 2,2,'退出登录', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
        session('agent',null);
        session('agent_name',null);
        $this->redirect(url('/agent/login/login'));
    }
}

