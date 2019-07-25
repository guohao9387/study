<?php
namespace app\agent\controller;
use think\Db;
use think\Image;
class Agent extends Common{
    public function initialize(){
        parent::initialize();
    }

    public function  money_list(){
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['type'])){
                $where[] = ['type','=',$param['type']];
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $where[] = ['agent_id','=',$this->agent];
        $list = db::name('agent_money_log')
            ->where($where)
            ->order('id desc')
            ->paginate(20,false,['query'=>$param]);
        $this->assign('list',$list);

        $count = db::name('agent_money_log')
            ->field('count(id) count,sum(money) sum')
            ->where($where)
            ->find();
        $this->assign('count',$count);

        return $this->fetch();
    }
    /*修改个人信息*/
    public function personal(){
        $where = array();
        $where['agent_id'] = $this->agent;
        $where['status'] = 1;
        $info = db::name('agent')->where($where)->field('nickname')->find();

        if(request()->isAjax()){
            $param = input('post.');
            if(strlen($param['nickname'])<=0||strlen($param['nickname'])>18){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '请输入正确昵称';
                return json($data);
            }

            $data = array();
            if($param['pass']){
                $data['password'] = md5($param['pass']);
                $data['pwd'] = $param['pass'];
            }
            $data['nickname'] = $param['nickname'];
//            $data['tel'] = $param['tel'];
            $where=[];
            $where['agent_id'] = $this->agent;
            $res = db::name('agent')->where($where)->update($data);
            if($res){
                add_user_operation($this->agent,$this->agent_name, 2,2,'修改个人信息', $_SERVER['REQUEST_URI'], serialize($_REQUEST),$this->agent,json_encode($info));
                $data = array();
                $data['status'] = 1;
                $data['msg'] = '修改成功';
                return json($data);
            }else{
                $data = array();
                $data['status'] = 0;
                $data['msg'] = '修改失败';
                return json($data);
            }
        }else{
            $this->assign('info',$info);
            return $this->fetch();
        }
    }
    public function code(){
        $where = [];
        $where[] = ['status','=',1];
        $where[] = ['agent_id','=',$this->agent];
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

        return $this->fetch('code');
    }
    public function code123(){
        $where = [];
        $where[] = ['status','=',1];
        $where[] = ['agent_id','=',$this->agent];

        $tg_address = db::name('config')->where(['key'=>'wx_tg_address'])->value('value');     //推广域名池
		/**
		echo '<!--';
		print_r($tg_address);
		echo '-->';
		**/
        $tg_address_arr = explode(',',$tg_address);
        $n = array_rand($tg_address_arr);

        $res = db::name('agent')->where($where)->field('agent_id,invitation_code,nickname')->find();
        $url = 'http://' .$tg_address_arr[$n]. '/mobile/login/register?agent_id='.$this->agent;
        $code_path = './uploads/code/agent_'.$this->agent.'-'.rand(1000,99999).'.jpg';
        if(!file_exists($code_path) || input('reset')){
			@unlink('.'.$res['invitation_code']);
//            $api_url = 'http://qr.topscan.com/api.php?text='.urlencode($url).'&w='.$w;
//            $code_str = file_get_contents($api_url);
//            file_put_contents($code_path,$code_str);
            \qrcode\Qrcode::png($url,$code_path,'',11,1);
            $tp_img = Image::open('./uploads/code/agent_code.jpg');
            $res = getimagesize($code_path);
            $w = $res[0];
            $y_size = $tp_img->size();
            $location = [($y_size[0]-$w)/2,($y_size[1]-$w-150)/2+150];
            $tp_img->water($code_path,$location);
            $tp_img->save($code_path);
			db::name('agent')->where(['agent_id'=>$this->agent])->update(['invitation_code'=>trim($code_path,'.')]);
        }
        $this->assign('url',$url);
        $this->assign('name',$this->agent_name);
        $this->assign('code_path',trim($code_path,'.').'?m='.rand(1000,99999));
        if(isMobile()){
            $view='m_new_code';
        }else{
            $view='new_code';
        }
        return $this->fetch($view);
    }
	

	


}

