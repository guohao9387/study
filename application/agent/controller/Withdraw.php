<?php
namespace app\agent\controller;
use think\Db;
class Withdraw extends Common{
    public function initialize(){
        parent::initialize();
    }
    public function withdraw(){
        if(request()->isAjax()){
            $param = input('post.');
            if($param['money']<=0){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '金额有误';
                return json($data);
            }
            if(!$param['bank_info_id']){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '请选择提现银行卡信息';
                return json($data);
            }
            $where=[];
            $where[]=['id','=',$param['bank_info_id']];
            $where[]=['utype','=',2];
            $where[]=['status','=',1];
            $where[]=['uid','=',$this->agent];
            $bank_info=db::name('bank_info')->where($where)->find();
            if(!$bank_info){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '银行卡信息有误';
                return json($data);
            }

            $where = [];
            $where[] = ['agent_id','=',$this->agent];
            $where[] = ['status','=',1];
            db::startTrans();
            $agent = db::name('agent')->lock(true)->where($where)->find();
            if(!$agent){
                db::rollback();
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '参数错误';
                return json($data);
            }
            if($param['money']>$agent['money']){
                db::rollback();
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '余额不足';
                return json($data);
            }
            $status = db::name('agent')->where($where)->setDec('money',$param['money']);
            if(!$status){
                db::rollback();
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '操作失败';
                return json($data);
            }
            $after_money = db::name('agent')->where($where)->value('money');
            if($after_money<0){
                db::rollback();
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '余额不足';
                return json($data);
            }
            $oid=add_user_operation($this->agent,$this->agent_name,2,2,'代理提现', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
            if($oid){

                $data = [];
                $data['agent_id'] = $this->agent;
                $data['agent_name'] = $this->agent_name;
                $data['nickname'] = $agent['nickname'];
                $data['money'] = $param['money'];
                $data['rate'] = $this->config['withdraw_rate'];
                $data['real_money'] = number_format($param['money']*$this->config['withdraw_rate'], 2, ".", "");
                $data['name'] = $bank_info['name'];
                $data['phone'] = $bank_info['phone'];
                $data['bank_name'] = $bank_info['bank_name'];
                $data['branch_name'] = $bank_info['branch_name'];
                $data['bank_card'] = $bank_info['bank_card'];
                $data['bank_info_id'] = $param['bank_info_id'];
                $data['add_time'] = date('Y-m-d H:i:s');
                $data['status'] = 1;
                $res = db::name('agent_withdraw_log')->insertGetId($data);

                $data=[];
                $data['agent_id'] = $this->agent;
                $data['agent_name'] = $this->agent_name;
                $data['nickname'] = $agent['nickname'];
                $data['from_oid'] = $res;
                $data['operation_id'] =$oid;
                $data['type'] =1;
                $data['type_info'] ='代理提现';
                $data['before_money'] =$agent['money'];
                $data['money'] =$param['money'];
                $data['after_money'] =$after_money;
                $data['remark'] ='代理发起提现';
                $data['add_time'] = date('Y-m-d H:i:s');
                $res2=db::name('agent_money_log')->insert($data);
                if($res&&$res2){
                    db::commit();
                    $data=[];
                    $data['status'] = 1;
                    $data['msg'] = '操作成功，请耐心等待审核';
                }else{
                    db::rollback();
                    $data=[];
                    $data['status'] = 0;
                    $data['msg'] = '操作失败';
                }
            }else{
                db::rollback();
                $data=[];
                $data['status'] = 0;
                $data['msg'] = '操作失败';
            }
            return json($data);
        }else{
            $where=[];
            $where[]=['utype','=',2];
            $where[]=['uid','=',$this->agent];
            $where[]=['status','=',1];
            $bank_info_list=db::name('bank_info')->where($where)->select();
            $this->assign('bank_info_list',$bank_info_list);
            $money=db::name('agent')->where('agent_id',$this->agent)->value('money');
            $this->assign('money',$money);
            $this->assign('rate',$this->config['withdraw_rate']);

            return $this->fetch();
        }

    }
    /*提现记录*/
    public function withdraw_list(){
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['status'])){
                $where[]= ['status','=',$param['status']];
            }
            if(!empty($param['start'])){
                $where[]= ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[]= ['add_time','<=',$param['end']];
            }
        }
        $where[] = ['agent_id','=',$this->agent];
        $page = isset($param['page_number'])?$param['page_number']:20;
        $list = db::name('agent_withdraw_log')
            ->where($where)
            ->order('id desc')
            ->paginate($page,false,['query'=>$param]);
        $this->assign('list',$list);
        $count = db::name('agent_withdraw_log')
            ->where($where)
            ->field('count(id) count,sum(money) sum')
            ->find();
        $this->assign('count',$count);
        $this->assign('page_number',$this->page_number);

        return $this->fetch();
    }
    public function bank_list(){
        $param = input('get.');
        $where = array();
        $where[]=['status','=',1];
        $where[]=['utype','=',2];
        $where[]=['uid','=',$this->agent];
        $list = db::name('bank_info')->where($where)->order(['id'=>'desc'])->paginate(20,false,['query'=>$param]);
        $this->assign('list',$list);
        $count = db::name('bank_info')->where($where)->count();
        $this->assign('count',$count);
        $this->assign('page_number',$this->page_number);

        return $this->fetch();
    }
    public function bank_info(){
        if(request()->isAjax()){
            $param = input('post.');
            $where = [];
            $where[] = ['id','=',$param['id']];
            $info = db::name('bank_info')->where($where)->find();
            if($info){
                $data = [];
                $data['phone'] = $param['phone'];
                $data['name'] = $param['name'];
                $data['bank_name'] = $param['bank_name'];
                $data['branch_name'] = $param['branch_name'];
                $data['bank_card'] = $param['bank_card'];
                $data['update_time'] = date('Y-m-d H:i:s');
                $res = db::name('bank_info')->where($where)->update($data);
                if($info['utype']==1){
                    $remark='修改用户银行卡';
                } else{
                    $remark='修改代理银行卡';
                }
                add_user_operation($this->admin,$this->admin_name, 3,$info['utype'],$remark, $_SERVER['REQUEST_URI'], serialize($_REQUEST));
                if($res){
                    $data = [];
                    $data['status']=1;
                    $data['msg']='操作成功';
                }else{
                    $data = [];
                    $data['status']=0;
                    $data['msg']='操作失败';
                }
                return json($data);
            }  else{
                $data = [];
                $data['status']=0;
                $data['msg']='操作失败';
            }

        }else{
            $where=[];
            $where[]=['id','=',input('get.id')];
            $info=db::name('bank_info')->where($where)->find();
            $this->assign('info',$info);
            return $this->fetch();
        }
    }
    public function bank_add(){
        if(request()->isAjax()){
            $where=[];
            $where[]=['utype','=',2];
            $where[]=['status','=',1];
            $where[]=['uid','=',$this->agent];
            $bank_count=db::name('bank_info')->where($where)->count();
            if($bank_count>=3){
                $data=[];
                $data['status']=0;
                $data['msg']='最多绑定3张银行卡';
                return json($data);
            }
            $param=input('post.');
            if(strlen($param['name'])<0||strlen($param['name'])>15){
                $data=[];
                $data['status']=0;
                $data['msg']='请输入正确的真实姓名';
                return json($data);
            }
            if(strlen($param['phone'])!=11){
                $data=[];
                $data['status']=0;
                $data['msg']='请输入正确的手机号';
                return json($data);
            }
            if(strlen($param['bank_name'])<0||strlen($param['bank_name'])>60){
                $data=[];
                $data['status']=0;
                $data['msg']='请输入正确的开户行';
                return json($data);
            }
            if(strlen($param['branch_name'])<0||strlen($param['branch_name'])>150){
                $data=[];
                $data['status']=0;
                $data['msg']='请输入正确的开户支行名称';
                return json($data);
            }
            if(strlen($param['bank_card'])<16||strlen($param['bank_card'])>20){
                $data=[];
                $data['status']=0;
                $data['msg']='请输入正确的银行卡号';
                return json($data);
            }
            $data=[];
            $data['uid']=$this->agent;
            $data['utype']=2;
            $data['username']=$this->agent_name;
            $data['name']=$param['name'];
            $data['phone']=$param['phone'];
            $data['bank_name']=$param['bank_name'];
            $data['branch_name']=$param['branch_name'];
            $data['bank_card']=$param['bank_card'];
            $data['add_time']=date('Y-m-d H:i:s');
            $data['status']=1;
            $res=db::name('bank_info')->insert($data);
            if($res){
                $data=[];
                $data['status']=1;
                $data['msg']='添加成功';
            }else{
                $data=[];
                $data['status']=0;
                $data['msg']='添加失败';
            }
            return json($data);

        }else{
            $bank=db::name('bank')->order('id asc')->select();
            $this->assign('bank',$bank);
            return $this->fetch();
        }
    }
}