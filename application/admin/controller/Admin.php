<?php
namespace app\admin\controller;
use think\Db;
class Admin extends Common{
    public function initialize(){
        parent::initialize();
    }

    /*广告列表*/
    public function adv_list(){
        $param = input('get.');
        $where = array();
        $where[] = ['status','<>',3];
        if(request()->isGet()){
            if(!empty($param['name'])){
                $where[] = ['name','=',$param['name']];
            }
            if(!empty($param['type'])){
                $where[] = ['type','=',$param['type']];
            }
            if(!empty($param['status'])){
                $where[] = ['status','=',$param['status']];
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $list = db::name('adv')->where($where)->order(['sort'=>'desc','id'=>'desc'])->paginate(20,false,['query'=>$param]);
        $this->assign('list',$list);
        $count = db::name('adv')->where($where)->count();
        $this->assign('count',$count);
        return $this->fetch();
    }
    /*广告添加*/
    public function adv_add(){
        if(request()->isAjax()){
            $data = input('post.');
            if(!$data['sort']||$data['sort']<1||$data['sort']>9999){
                $data['sort']=1;
            }
            $data['add_time'] = date('Y-m-d H:i:s',time());
            $data['status'] = 1;
            unset($data['file']);
            $res = db::name('adv')->insertGetId($data);
            if($res){
                add_user_operation($this->admin,$this->admin_name, 3,4,'添加广告', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
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
    /*广告编辑*/
    public function adv_edit(){
        if(request()->isAjax()){
            $data = input('post.');
            if(!$data['sort']||$data['sort']<1||$data['sort']>9999){
                $data['sort']=1;
            }
            unset($data['file']);
            $res = db::name('adv')->update($data);
            if($res){
                add_user_operation($this->admin,$this->admin_name, 3,4,'编辑广告', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
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
            $where[] = ['status','<>',3];
            $where[] = ['id','=',input('get.id')];
            $info = db::name('adv')->where($where)->field('id,name,image,url,type,sort')->find();
            if($info){
                $this->assign('info',$info);
                return $this->fetch();
            }else{
                $this->error('参数有误');
            }
        }
    }

    /*公告列表*/
    public function notice_list(){
        $param = input('get.');
        $where = array();
        $where[] = ['status','<>',3];
        if(request()->isGet()){
            if(!empty($param['title'])){
                $where[] = ['title','=',$param['title']];
            }
            if(!empty($param['status'])){
                $where[] = ['status','=',$param['status']];
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $list = db::name('notice')->where($where)->order(['sort'=>'desc','id'=>'desc'])->paginate(20,false,['query'=>$param]);
        $this->assign('list',$list);
        $count = db::name('notice')->where($where)->count();
        $this->assign('count',$count);
        return $this->fetch();
    }
    /*公告添加*/
    public function notice_add(){
        if(request()->isAjax()){

            $data = input('post.');
            if(!$data['sort']||$data['sort']<1||$data['sort']>9999){
                $data['sort']=1;
            }
            $data['add_time'] = date('Y-m-d H:i:s',time());
            $data['status'] = 1;
            unset($data['file']);
            $res = db::name('notice')->insert($data);
            if($res){
                add_user_operation($this->admin,$this->admin_name, 3,4,'添加公告', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
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
    /*公告编辑*/
    public function notice_edit(){
        if(request()->isAjax()){
            $data = input('post.');
            unset($data['file']);
            if(!$data['sort']||$data['sort']<1||$data['sort']>9999){
                $data['sort']=1;
            }
            $res = db::name('notice')->update($data);
            if($res){
                add_user_operation($this->admin,$this->admin_name, 3,4,'编辑公告', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
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
            $where[] = ['status','<>',3];
            $where[] = ['id','=',input('get.id')];
            $info = db::name('notice')->where($where)->field('id,title,content,sort,type')->find();
            if($info){
                $this->assign('info',$info);
                return $this->fetch();
            }else{
                $this->error('参数有误');
            }
        }
    }
    /*公告列表*/
    public function news_list(){
        $param = input('get.');
        $where = array();
        $where[] = ['status','<>',3];
        if(request()->isGet()){
            if(!empty($param['title'])){
                $where[] = ['title','=',$param['title']];
            }
            if(!empty($param['status'])){
                $where[] = ['status','=',$param['status']];
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $list = db::name('news')->where($where)->order(['sort'=>'desc','id'=>'desc'])->paginate(20,false,['query'=>$param]);
        $this->assign('list',$list);
        $count = db::name('news')->where($where)->count();
        $this->assign('count',$count);
        return $this->fetch();
    }
    /*公告添加*/
    public function news_add(){
        if(request()->isAjax()){

            $data = input('post.');
            if(!$data['sort']||$data['sort']<1||$data['sort']>9999){
                $data['sort']=1;
            }
            $data['add_time'] = date('Y-m-d H:i:s',time());
            $data['status'] = 1;
            $data['des'] = substr($data['content'],0,100);
            unset($data['file']);
            $res = db::name('news')->insert($data);
            if($res){
                add_user_operation($this->admin,$this->admin_name, 3,4,'添加资讯', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
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
    /*公告编辑*/
    public function news_edit(){
        if(request()->isAjax()){
            $data = input('post.');
            unset($data['file']);
            if(!$data['sort']||$data['sort']<1||$data['sort']>9999){
                $data['sort']=1;
            }
            $data['des'] = substr($data['content'],0,100);
            $res = db::name('news')->update($data);
            if($res){
                add_user_operation($this->admin,$this->admin_name, 3,4,'编辑资讯', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
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
            $where[] = ['status','<>',3];
            $where[] = ['id','=',input('get.id')];
            $info = db::name('news')->where($where)->field('id,title,content,sort')->find();
            if($info){
                $this->assign('info',$info);
                return $this->fetch();
            }else{
                $this->error('参数有误');
            }
        }
    }

    public function protocol_list(){
        $param = input('get.');
        $where = array();
        $where[] = ['status','<>',3];
        if(request()->isGet()){
            if(!empty($param['title'])){
                $where[] = ['title','=',$param['title']];
            }
            if(!empty($param['status'])){
                $where[] = ['status','=',$param['status']];
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $list = db::name('agreement')->where($where)->order(['id'=>'desc'])->paginate(20,false,['query'=>$param]);
        $this->assign('list',$list);
        $count = db::name('agreement')->where($where)->count();
        $this->assign('count',$count);
        return $this->fetch();
    }
    /*公告添加*/
    public function protocol_add(){
        if(request()->isAjax()){
            $data = input('post.');
            $data['add_time'] = date('Y-m-d H:i:s',time());
            $data['status'] = 1;
            unset($data['file']);
            $res = db::name('agreement')->insert($data);
            if($res){
                add_user_operation($this->admin,$this->admin_name, 3,4,'添加协议', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
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
    /*公告编辑*/
    public function protocol_edit(){
        if(request()->isAjax()){
            $data = input('post.');
            unset($data['file']);

            $res = db::name('agreement')->update($data);
            if($res){
                add_user_operation($this->admin,$this->admin_name, 3,4,'修改协议', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
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
            $where[] = ['status','<>',3];
            $where[] = ['id','=',input('get.id')];
            $info = db::name('agreement')->where($where)->field('id,title,content')->find();
            if($info){
                $this->assign('info',$info);
                return $this->fetch();
            }else{
                $this->error('参数有误');
            }
        }
    }
    public function kefu_list(){
        $param = input('get.');
        $where = array();
        $where[] = ['status','=',1];
        if(request()->isGet()){
            if(!empty($param['name'])){
                $where[] = ['name','=',$param['name']];
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $list = db::name('kefu')->where($where)->order(['sort'=>'desc','id'=>'desc'])->paginate(20,false,['query'=>$param]);
        $this->assign('list',$list);
        $count = db::name('kefu')->where($where)->count();
        $this->assign('count',$count);
        return $this->fetch();
    }
    /*广告添加*/
    public function kefu_add(){
        if(request()->isAjax()){
            $data = input('post.');
            if(!$data['sort']||$data['sort']<1||$data['sort']>9999){
                $data['sort']=1;
            }
            $data['add_time'] = date('Y-m-d H:i:s');
            $data['status'] = 1;
            unset($data['file']);
            $res = db::name('kefu')->insert($data);
            if($res){
                add_user_operation($this->admin,$this->admin_name, 3,4,'添加客服', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
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
    public function product_list(){
        $param = input('get.');
        $where = array();
        $where[] = ['status','=',1];
        if(request()->isGet()){
            if(!empty($param['name'])){
                $where[] = ['name','=',$param['name']];
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $list = db::name('product')->where($where)->order(['id'=>'desc'])->paginate(20,false,['query'=>$param]);
        $this->assign('list',$list);
        $count = db::name('product')->where($where)->count();
        $this->assign('count',$count);
        return $this->fetch();
    }
    /*公告添加*/
    public function product_add(){
        if(request()->isAjax()){
            $data = input('post.');
            $data['show_status']=2;
            $data['trade_status']=2;
            $data['add_time'] = date('Y-m-d H:i:s',time());
            $data['update_time'] = date('Y-m-d H:i:s',time());
            $res = db::name('product')->insert($data);
            if($res){
                add_user_operation($this->admin,$this->admin_name, 3,4,'添加产品', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
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
    /*公告编辑*/
    public function product_edit(){
        if(request()->isAjax()){
            $data = input('post.');
            $res = db::name('product')->update($data);
            if($res){
                add_user_operation($this->admin,$this->admin_name, 3,4,'修改产品', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
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
            $where[] = ['id','=',input('get.id')];
            $info = db::name('product')->where($where)->find();
            if($info){
                $this->assign('info',$info);
                return $this->fetch();
            }else{
                $this->error('参数有误');
            }
        }
    }
    public function coin_list(){
        $param = input('get.');
        $where = array();
        $where[] = ['status','=',1];
        if(request()->isGet()){
            if(!empty($param['name'])){
                $where[] = ['name','=',$param['name']];
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $list = db::name('apply_coin')->where($where)->order(['id'=>'desc'])->paginate(20,false,['query'=>$param]);
        $this->assign('list',$list);
        $count = db::name('apply_coin')->where($where)->count();
        $this->assign('count',$count);
        return $this->fetch();
    }
    /*公告添加*/
    public function coin_add(){
        if(request()->isAjax()){
            $data = input('post.');
            unset($data['file']);
            $data['show_status']=2;
            $data['add_time'] = date('Y-m-d H:i:s',time());
            $data['update_time'] = date('Y-m-d H:i:s',time());
            $res = db::name('apply_coin')->insert($data);
            if($res){
                add_user_operation($this->admin,$this->admin_name, 3,4,'添加申购币', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
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
    /*公告编辑*/
    public function coin_edit(){
        if(request()->isAjax()){
            $data = input('post.');
            unset($data['file']);
            $data['update_time'] = date('Y-m-d H:i:s',time());
            $res = db::name('apply_coin')->update($data);
            if($res){
                add_user_operation($this->admin,$this->admin_name, 3,4,'修改申购币', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
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
            $where[] = ['id','=',input('get.id')];
            $info = db::name('apply_coin')->where($where)->find();
            if($info){
                $this->assign('info',$info);
                return $this->fetch();
            }else{
                $this->error('参数有误');
            }
        }
    }
}

