<?php
namespace app\agent\controller;
use think\Db;
class User extends Common{

    public function initialize(){
        parent::initialize();
    }
    public function user_list(){

        $param = input('get.');
        $where = array();
        $where[] = ['status','=',1];
        $where[] = ['agent_id','in',get_all_agent($this->agent)];
        if(request()->isGet()){
            if(!empty($param['username'])){
                $where[]=['username','=',$param['username']];
            }
            if(!empty($param['nickname'])){
                $where[]=['nickname','=',$param['nickname']];
            }
            if(!empty($param['pid'])){
                $map = array();
                $map[] = ['status','=',1];
                $map[] = ['username','=',$param['pid']];
                $id = db::name('user')->where($map)->value('uid');
                $where[]=['pid','=',$id];
            }
            if(!empty($param['agent_name'])){
                $where[] = ['agent_name','=',$param['agent_name']];
            }
//            if(!empty($param['p_agent'])){
//                $map = array();
//                $map[] = ['status','=',1];
//                $map[] = ['agent_name','=',$param['p_agent']];
//                $id = db::name('agent')->where($map)->value('uid');
//                $where[] = ['b.p_agent_id','=',$id];
//            }
//            if(!empty($param['all_agent'])){
//                $where[] = ['agent_id','in',get_all_agent($param['all_agent'])];
//            }

            if(!empty($param['status'])){
                if($param['status'] == 1||$param['status'] == 2){
                    $where[]=['login_status','=',$param['status']];
                }else{
                    $where[]=['trade_status','=',$param['status']];
                }
            }

            if(!empty($param['start'])){
                $where[]=['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[]=['add_time','<=',$param['end']];
            }

        }
        $page = isset($param['page_number'])?$param['page_number']:20;
        $list = db::name('user')
            ->where($where)
//            ->order(['money'=>'desc','uid'=>'desc'])
            ->order(['uid'=>'desc'])
            ->paginate($page,false,['query'=>$param]);
        $this->assign('list',$list);

        $count = db::name('user')
            ->where($where)
            ->field('count(uid) count,sum(money) sum_money')
            ->find();
        $this->assign('count',$count);
        $this->assign('page_number',$this->page_number);

        return $this->fetch();
    }
    public function user_edit(){

        if(request()->isAjax()){
               die;
            $data = input('post.');
            $where = array();
            $where[] = ['status','=',1];
            $where[] = ['uid','=',$data['uid']];
            $userinfo = db::name('user')->where($where)->find();

            if(strlen($data['username'])!=11){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入11位账号';
                return json($data);
            }
            if(strlen($data['invite_number'])!=6){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入6位邀请码';
                return json($data);
            }
            if(strlen($data['nickname'])<=0||strlen($data['nickname'])>12){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入1-12位昵称';
                return json($data);
            }


            $where = [];
            $where[] = ['username','=',$data['username']];
            $where[] = ['status','=',1];
            $where[] = ['uid','<>',$data['uid']];
            $info = db::name('user')->where($where)->find();
            if($info){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '该账号已存在';
                return json($data);
            }

            $where = array();
            $where[] = ['status','=',1];
            $where[] = ['invite_number','=',$data['invite_number']];
            $where[] = ['uid','<>',$data['uid']];
            $info = db::name('user')->where($where)->find();
            if($info){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '该邀请码已存在';
                return json($data);
            }
            $param=[];
            if(empty($data['agent_id'])){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入直属代理账号';
                return json($data);
            }else{
                $where = [];
                $where[] = ['status','=',1];
                $where[] = ['agent_name','=',$data['agent_id']];
                $agent = db::name('agent')->where($where)->field('agent_id,agent_name,nickname')->find();
                if($agent){

                    $param['agent_id'] = $agent['agent_id'];
                    $param['agent_name'] = $agent['agent_name'];
                    $param['agent_nickname'] = $agent['nickname'];
                }else{
                    $data = array();
                    $data['status'] = 0;
                    $data['msg'] = '代理不存在';
                    return json($data);
                }

                if(!empty($data['pid'])){
                    $where = [];
                    $where[] = ['status','=',1];
                    $where[] = ['username','=',$data['pid']];
//                    $where[] = ['agent_id','=',$data['agent_id']];
                    $inviter = db::name('user')->where($where)->value('uid');
                    if($inviter){
                        $param['pid'] = $inviter;
                    }else{
                        $data = array();
                        $data['status'] = 0;
                        $data['msg'] = '邀请人不存在';
                        return json($data);
                    }
                }
            }

            $where=[];
            $where[] = ['uid','=',$data['uid']];

            $param['username'] = $data['username'];
            $param['nickname'] = $data['nickname'];
            $param['login_status'] = $data['login_status'];
            $param['trade_status'] = $data['trade_status'];
            $param['invite_status'] = $data['invite_status'];
            $param['pwd'] = $data['password'];
            $param['password'] = md5($data['password']);
            $param['update_time'] = date('Y-m-d H:i:s');

            $res = db::name('user')->where($where)->update($param);
            if($res){
                $note=get_user_diff($userinfo,$param);
                add_user_operation($this->agent,$this->agent_name, 2,1,$note, $_SERVER['REQUEST_URI'], serialize($_REQUEST),$res);
                $data = array();
                $data['status'] = 1;
                $data['msg'] = '修改成功';
            }else{
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '修改失败';
            }
            return json($data);
        }else{
            $where = array();
            $where[] = ['status','=',1];
            $where[] = ['uid','=',input('get.uid')];
            $userinfo = db::name('user')->where($where)->find();
            if($userinfo){
                $this->assign('info',$userinfo);
                $this->assign('config',$this->config);
                return $this->fetch();
            }else{
                $this->error('信息有误');
            }
        }
    }
    public function agent_list(){
        $param = input('get.');
        $where = array();
        $where[]=['status','=',1];
        $where[]=['p_agent_id','=',$this->agent];

        if(request()->isGet()){
            if(!empty($param['agent_name'])){
                $where[]=['agent_name','=',$param['agent_name']];
            }
            if(!empty($param['nickname'])){
                $where[]=['nickname','=',$param['nickname']];
            }

            if(!empty($param['status'])){
                $where[]=['status','=',$param['status']];
            }
            if(!empty($param['start'])){
                $where[]=['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[]=['add_time','<=',$param['end']];
            }
        }
        $page = isset($param['page_number'])?$param['page_number']:20;
        //dump($where);die;
        $list = db::name('agent')->where($where)->order(['money'=>'desc','agent_id'=>'desc'])->paginate($page,false,['query'=>$param]);
        //dump($list);die;
        $this->assign('list',$list);
        $count = db::name('agent')
            ->where($where)
            ->field('count(agent_id) count,sum(money) sum_money')
            ->find();
        $this->assign('count',$count);
        $this->assign('page_number',$this->page_number);
        return $this->fetch();
    }
    public function agent_add(){
        if(request()->isAjax()){
            $data = input('post.');
            if(strlen($data['agent_name'])<=0||strlen($data['agent_name'])>12){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入6-12位账号';
                return json($data);
            }
            if(strlen($data['nickname'])<=0||strlen($data['nickname'])>18){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入1-6位昵称';
                return json($data);
            }
            $where = array();
            $where[] = ['agent_name','=',$data['agent_name']];
            $where[] = ['status','=',1];
            $info = db::name('agent')->where($where)->find();
            if($info){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '该账号已注册';
                return json($data);
            }

            $data['p_agent_id'] = $this->agent;
            $data['pwd'] = $data['password'];
            $data['password'] = md5($data['password']);
            $data['status'] = 1;
            $data['add_ip'] = get_real_ip();
            $data['add_time'] = date('Y-m-d H:i:s');
            $data['update_time'] = date('Y-m-d H:i:s');
            $data['money'] = 0;
            $data['invite_number'] = create_agent_invite_number();
            $res = db::name('agent')->insertGetId($data);
            if($res){
                add_user_operation($this->agent,$this->agent_name, 2,2,'添加代理', $_SERVER['REQUEST_URI'], serialize($_REQUEST),$res);
                $data = array();
                $data['status'] = 1;
                $data['msg'] = '添加成功';
            }else{
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '添加失败';
            }
            return json($data);
        }else{
            return $this->fetch();
        }
    }
    public function agent_edit(){
        if(request()->isAjax()){
            die;
            $data = input('post.');
            if(strlen($data['agent_name'])<=0||strlen($data['agent_name'])>12){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入6-12位账号';
                return json($data);
            }
            if(strlen($data['nickname'])<=0||strlen($data['nickname'])>36){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入1-12位昵称';
                return json($data);
            }
            if(strlen($data['invite_number'])!=4){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入4位邀请码';
                return json($data);
            }
            $where = array();
            $where[] = ['status','=',1];
            $where[] = ['agent_id','=',$data['agent_id']];
            $agent_info = db::name('agent')->where($where)->find();
            if(strlen($data['nickname'])<=0||strlen($data['nickname'])>12){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '请输入1-12位昵称';
                return json($data);
            }
            $where = array();
            $where[] = ['status','=',1];
            $where[] = ['invite_number','=',$data['invite_number']];
            $where[] = ['agent_id','<>',$data['agent_id']];
            $info = db::name('agent')->where($where)->find();
            if($info){
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '该邀请码已存在';
                return json($data);
            }

            if($data['p_agent_id']){
                $map = [];
                $map[] = ['agent_name','=',$data['p_agent_id']];
                $map[] = ['status','=',1];
                $res = db::name('agent')->where($map)->value('agent_id');
                if($res){
                    $data['p_agent_id'] = $res;
                }else{
                    $data = array();
                    $data['status'] = 0;
                    $data['msg'] = '上级代理账号有误';
                    return json($data);
                }
            }else{
                $data['p_agent_id'] = 0;
            }

            $where=[];
            $where['agent_id'] = $data['agent_id'];

            $param=[];
            $param['pwd'] = $data['password'];
            $param['nickname'] = $data['nickname'];
            $param['invite_status'] = $data['invite_status'];
            $param['login_status'] = $data['login_status'];
            $param['password'] = md5($data['password']);
            $param['update_time']=date('Y-m-d H:i:s');
            // dump($param);die;
            $res = db::name('agent')->where($where)->update($param);
            if($res){
                $note=get_agent_diff($agent_info,$param);
                add_user_operation($this->agent,$this->agent_name, 2,2,$note, $_SERVER['REQUEST_URI'], serialize($_REQUEST),$res);
                $data = array();
                $data['status'] = 1;
                $data['msg'] = '修改成功';
            }else{
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '修改失败';
            }
            return json($data);
        }else{
            $where = array();
            $where[] = ['status','=',1];
            $where[] = ['agent_id','=',input('get.agent_id')];
            $agent_info = db::name('agent')->where($where)->find();
            if($agent_info){
                $this->assign('info',$agent_info);
                return $this->fetch();
            }else{
                $this->error('信息有误');
            }
        }
    }
    public function user_code(){
        $id = input('get.id');
        if($id){
            $where = [];
            $where[] = ['status','=',1];
            $where[] = ['uid','=',$id];
            $res = db::name('user')->where($where)->field('invite_number,nickname,code')->find();
            $url = 'http://' .$this->config['address']. '/index/login/register?code='.$res['invite_number'];
            if(!$res['code']){
                $path = substr(code($url), 1);
                $data = array();
                $data['code'] = $path;
                $res = db::name('user')->where($where)->update($data);
                if(!$res){
                    $this->error('生成二维码失败');
                }
            }else{
                $path = $res['code'];
            }
            $this->assign('path',$path);
            $this->assign('url',$url);
            $this->assign('name',$res['nickname']);
            $this->assign('invite_number',$res['invite_number']);
        }else{
            $this->error('生成二维码失败');
        }

        return $this->fetch('code');
    }
    public function agent_code(){
        $id = input('get.id');
        if($id){
            $where = [];
            $where[] = ['status','=',1];
            $where[] = ['agent_id','=',$id];
            $res = db::name('agent')->where($where)->field('invite_number,nickname,code')->find();
            $url = 'http://' .$this->config['address']. '/index/login/register?code='.$res['invite_number'];
            if(!$res['code']){
                $path = substr(code($url), 1);
                $data = array();
                $data['code'] = $path;
                $res = db::name('agent')->where($where)->update($data);
                if(!$res){
                    $this->error('生成二维码失败');
                }
            }else{
                $path = $res['code'];
            }
            $this->assign('path',$path);
            $this->assign('url',$url);
            $this->assign('name',$res['nickname']);
            $this->assign('invite_number',$res['invite_number']);
        }else{
            $this->error('生成二维码失败');
        }
        return $this->fetch('code');
    }
    public function down(){
        $name = input('get.name').'.png';
        $filename = ltrim(input('get.path'),'/');
        header("Content-type: application/octet-stream");
        header("Content-Length: ".filesize($filename));
        header("Content-Disposition: attachment; filename=$name");
        $fp = fopen($filename, 'rb');
        fpassthru($fp);
        fclose($fp);
        die;
    }
}