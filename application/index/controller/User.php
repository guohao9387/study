<?php
namespace app\index\controller;
use think\Db;
class User extends Common
{
    public function initialize()
    {
        parent::initialize();
    }
    public function index()
    {
        return $this->fetch();
    }
    public function news_list()
    {
        $where = [];
        $where[] = ['status','=',1];
        $list = db::name('news')->where($where)->order('sort desc')->field('id,title,add_time')->select();
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function news()
    {
        $where = [];
        $where[] = ['status','=',1];
        $where[] = ['id','=',input('get.id')];
        $news = db::name('news')->where($where)->field('title,content')->find();
        $this->assign('news',$news);
        return $this->fetch();
    }

    public function recharge()
    {
        return $this->fetch();
    }
    public function withdraw()
    {
        return $this->fetch();
    }

    public function withdraw_bank()
    {
        return $this->fetch();
    }

    public function money_list()
    {
        $post = input('post.');
        $where = [];
        $where[] = ['uid','=',$this->user];

        if(request()->isGet()){
            if(!empty($post['start'])){
                $where[] = ['add_time','>=',$post['start']];
            }
            if(!empty($post['end'])){
                $where[] = ['add_time','<=',$post['end']];
            }
        }
        $list = db::name('user_money_log')->where($where)->order('id desc')->paginate(20,false,['query'=>$post]);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function recharge_list()
    {

        $post = input('post.');
        $where = [];
        $where[] = ['uid','=',$this->user];

        if(request()->isGet()){
            if(!empty($post['start'])){
                $where[] = ['add_time','>=',$post['start']];
            }
            if(!empty($post['end'])){
                $where[] = ['add_time','<=',$post['end']];
            }
        }
        $list = db::name('recharge')->where($where)->order('id desc')->paginate(20,false,['query'=>$post]);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function withdraw_list()
    {
        $post = input('post.');
        $where = [];
        $where[] = ['uid','=',$this->user];

        if(request()->isGet()){
            if(!empty($post['start'])){
                $where[] = ['add_time','>=',$post['start']];
            }
            if(!empty($post['end'])){
                $where[] = ['add_time','<=',$post['end']];
            }
        }
        $list = db::name('user_withdraw_log')->where($where)->order('id desc')->paginate(20,false,['query'=>$post]);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function order_list()
    {
        $post = input('post.');
        $where = [];
        $where[] = ['uid','=',$this->user];
         $where[] = ['order_status','=',2];
        if(request()->isGet()){
            if(!empty($post['start'])){
                $where[] = ['add_time','>=',$post['start']];
            }
            if(!empty($post['end'])){
                $where[] = ['add_time','<=',$post['end']];
            }
        }
        $list = db::name('order')->where($where)->order('oid desc')->paginate(20,false,['query'=>$post]);
        $res = [];
        foreach($list as $val){
            $res[] = json_decode($val['betting_result'],true);
        }
        $this->assign('list',$list);
        $this->assign('res',$res);
        return $this->fetch();
    }
    public function repwd()
    {
        if(request()->isAjax()){
            $post = input('post.');
            if(!$post['old_pwd']){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '请输入旧密码';
                return json($data);
            }
            if(!$post['pass']){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '请输入新密码';
                return json($data);
            }
            if(!$post['repass']){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '请输入重复密码';
                return json($data);
            }
            if(strlen($post['pass'])<6||strlen($post['pass'])>18){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '请输入6-18位的新密码';
                return json($data);
            }
            if($post['repass']!=$post['pass']){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '确认密码与新密码不同';
                return json($data);
            }
            $where = [];
            $where[] = ['uid','=',$this->user];
            $where[] = ['status','=',1];
            $password = db::name('user')->where($where)->value('password');
            if(md5($post['old_pwd'])!=$password){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '旧密码输入错误';
                return json($data);
            }
            $data = [];
            $data['pwd'] = $post['pass'];
            $data['password'] = md5($post['pass']);
            $res = db::name('user')->where($where)->update($data);
            if($res){
                $data = [];
                $data['status'] = 1;
                $data['msg'] = '修改成功';
            }else{
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '修改失败';
            }
            add_user_operation($this->user,$this->user_name, 1,1,'修改密码', $_SERVER['REQUEST_URI'], serialize($_REQUEST),$this->user['uid'],json_encode($post));
            return json($data);
        }else{
            return $this->fetch();
        }
    }
    public function kefu()
    {
        $where = [];
        $where[] =['status','=',1];
        $list = db::name('kefu')->where($where)->order(['sort'=>'desc','id'=>'desc'])->select();
        $this->assign('list',$list);
        return $this->fetch();
    }
}
