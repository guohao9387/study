<?php
namespace app\admin\controller;
//use function think\__require_file;
use think\Db;

class Api extends Common{
    public function initialize(){
        parent::initialize();
    }
    public function closeOrder(){
        if(request()->isAjax()){
            $param=input('post.');
            if(!$param['oid']){
                return json_return(0,'参数错误');
            }
            $where=[];
            $where[]=['oid','=',$param['oid']];
            $where[]=['order_status','=',1];
            db::startTrans();
            $order=db::name('order')->where($where)->lock(true)->find();
            if(!$order){
                db::rollback();
                return json_return(0,'订单信息有误');
            }
            //当前价格
            $now_price=get_now_price($order['product_abbreviation']);
            if(!$now_price){
                db::rollback();
                return json_return(0,'网络错误，请重试');
            }
            $map=[];
            $map[]=['uid','=',$order['uid']];
            $map[]=['status','=',1];
            $user=db::name('user')->where($map)->lock(true)->find();
            if(!$user){
                return json_return(0,'网络错误，请重试');
            }
            //操作用户保证金
            $status=db::name('user')->where('uid',$user['uid'])->setDec('promise_money',$order['money']);
            if(!$status){
                db::rollback();
                return json_return(0,'操作失败');
            }
            //计算用户盈亏
            //如果平局
            if($now_price==$order['buy_price']){
                $money=0;
            }else{
                $profit=($now_price-$order['buy_price'])*$order['hand']*$order['contract']/$user['lever'];
                if($order['direction']==1){
                    $money=$profit*$user['lever'];
                    //卖出(买跌）
                }elseif($order['direction']==2){
                    $money=-$profit*$user['lever'];
                }
            }
            //操作用户账户
            $status=db::name('user')->where('uid',$user['uid'])->setInc('money',$money);
            if(!$status){
                db::rollback();
                return json_return(0,'操作失败');
            }
            $after=db::name('user')->where('uid',$user['uid'])->find();
            //更新订单状态
            $data=[];
            $data['oid']=$order['oid'];
            $data['sell_price']=$now_price;
            $data['profit']=$money;
            $data['order_status']=2;
            $data['order_close_type']=2;
            $data['update_time']=date('Y-m-d H:i:s');
            $status=db::name('order')->update($data);
            if(!$status){
                db::rollback();
                return json_return(0,'操作失败');
            }
            //记录用户操作
            $operation_id=add_user_operation($this->admin,$this->admin_name,3,1,'强行平仓', $_SERVER['REQUEST_URI'], serialize($_REQUEST),$order['oid']);

            //添加资金记录
            $data=[];
            $data['uid']=$user['uid'];
            $data['username']=$user['username'];
            $data['nickname']=$user['nickname'];
            $data['from_oid']=$order['oid'];
            $data['operation_id']=$operation_id;
            $data['before_money']=$user['money'];
            $data['money']=$money;
            $data['after_money']=$user['money']+$money;
            $data['type']=3;
            $data['type_info']='平仓';
            $data['remark']='风险平仓，结算收益';
            $data['add_time']=date('Y-m-d H:i:s');
            $status=db::name('user_money_log')->insert($data);
            if($status){
                db::commit();
                $msg=[];
                $msg['status']=101;
                $msg['msg']='风险过大，您的订单【单号：'.$order['order_sn'].'】已经被平仓';
                $msg['oid']=$order['oid'];
                $msg['money']=$money;
                $msg['promise_money']=-$order['money'];
                bar($user['uid'],$msg);
                $msg=[];
                $msg['status']=1002;
                $msg['oid']=$order['oid'];
                send_msg_agent($user['agent_id'],$msg);

                return json_return(1,'平仓成功');

            }else{
                db::rollback();
                return json_return(0,'操作失败，请重试');
            }
        }
    }
    //会员提现处理
    public function user_withdraw_handle()
    {
        if(request()->isAjax()){
            $param = input('post.');
            $where = [];
            $where[] = ['status','=','1'];
            $where[] = ['id','=',$param['id']];
            db::startTrans();
            $withdraw = db::name('user_withdraw_log')->lock(true)->where($where)->find();
            if($withdraw){
                $data = [];
                $data['id'] = $param['id'];
                $data['status'] = $param['status'];
                if($param['status']==2 && $withdraw['status'] == 1) {
                    //审核操作
                    $data['update_time'] = date('Y-m-d H:i:s');
                    $data['remark'] = '审核通过';
                    $res = db::name('user_withdraw_log')->where($where)->update($data);
                    if($res){
                        add_user_operation($this->admin,$this->admin_name,3,1,'审核会员提现', $_SERVER['REQUEST_URI'], serialize($_REQUEST),$withdraw['uid']);
                        db::commit();
                        $data = [];
                        $data['status'] = 1;
                        $data['msg'] = '操作成功';
                    }else{
                        db::rollback();
                        $data = [];
                        $data['status'] = 0;
                        $data['msg'] = '操作失败';
                    }
                } elseif ($param['status']==3 && $withdraw['status'] == 1){
                    //拒绝操作
                    if(!$param['remark']){
                        db::rollback();
                        $data = [];
                        $data['status'] = 0;
                        $data['msg'] = '请输入拒绝原因';
                        return json($data);
                    }
                    if(strlen($param['remark'])>50){
                        db::rollback();
                        $data = [];
                        $data['status'] = 0;
                        $data['msg'] = '请输入1-50字拒绝原因';
                        return json($data);
                    }
                    $data['update_time'] = date('Y-m-d H:i:s');
                    $data['remark'] = $param['remark'];
                    $res = db::name('user_withdraw_log')->where($where)->update($data);
                    if($res){
                        $oid=add_user_operation($this->admin,$this->admin_name,3,1,'拒绝代理提现', $_SERVER['REQUEST_URI'], serialize($_REQUEST),$withdraw['uid']);
                        $where = [];
                        $where[] = ['uid','=',$withdraw['uid']];
                        $where[] = ['status','=',1];
                        $before = db::name('user')->lock(true)->where($where)->field('money,username,nickname')->find();
                        $status = db::name('user')->where($where)->setInc('money',$withdraw['money']);
                        if($status){
                            $after_money =  $before['money']+$withdraw['money'];
                            $data = [];
                            $data['uid'] = $withdraw['uid'];
                            $data['username'] = $withdraw['username'];
                            $data['nickname'] = $before['nickname'];
                            $data['from_oid'] = $withdraw['id'];
                            $data['operation_id'] = $oid;
                            $data['type'] = 2;
                            $data['type_info'] = '会员提现';
                            $data['money'] = $withdraw['money'];
                            $data['before_money'] = $before['money'];
                            $data['after_money'] = $after_money;
                            $data['remark'] = '会员提现失败';
                            $data['add_time'] = date('Y-m-d H:i:s');
                            $res = db::name('user_money_log')->insert($data);
                            if($res){
                                db::commit();
                                $data = [];
                                $data['status'] = 1;
                                $data['msg'] = '操作成功';
                            }else{
                                db::rollback();
                                $data = [];
                                $data['status'] = 0;
                                $data['msg'] = '操作失败';
                            }
                        }else{
                            db::rollback();
                            $data = [];
                            $data['status'] = 0;
                            $data['msg'] = '操作失败';
                        }
                    }else{
                        db::rollback();
                        $data = [];
                        $data['status'] = 0;
                        $data['msg'] = '操作失败';
                    }
                }
            }else{
                db::rollback();
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '操作失败';
            }
            return json($data);
        }
    }
    public function user_real_handle()
    {
        if(request()->isAjax()){
            $param = input('post.');
            $where = [];
            $where[] = ['status','=','1'];
            $where[] = ['id','=',$param['id']];
            db::startTrans();
            $real_info = db::name('real_auth')->lock(true)->where($where)->find();
            if($real_info){
                $data = [];
                $data['id'] = $param['id'];
                $data['status'] = $param['status'];
                if($param['status']==2 && $real_info['status'] == 1) {
                    //审核操作
                    $data['update_time'] = date('Y-m-d H:i:s');
                    $data['remark'] = '审核通过';
                    $res = db::name('real_auth')->where($where)->update($data);
                    if($res){
                        $data=[];
                        $data['real']=1;
                        $data['update_time'] = date('Y-m-d H:i:s');
                        $res=db::name('user')->where('uid',$real_info['uid'])->update($data);
                        if($res){
                            add_user_operation($this->admin,$this->admin_name,3,1,'审核通过会员实名', $_SERVER['REQUEST_URI'], serialize($_REQUEST),$real_info['uid']);
                            db::commit();
                            $data = [];
                            $data['status'] = 1;
                            $data['msg'] = '操作成功';
                        }else{
                            db::rollback();
                            $data = [];
                            $data['status'] = 0;
                            $data['msg'] = '操作失败';
                        }
                    }else{
                        db::rollback();
                        $data = [];
                        $data['status'] = 0;
                        $data['msg'] = '操作失败';
                    }
                } elseif ($param['status']==3 && $real_info['status'] == 1){
                    //拒绝操作
                    if(!$param['remark']){
                        db::rollback();
                        $data = [];
                        $data['status'] = 0;
                        $data['msg'] = '请输入拒绝原因';
                        return json($data);
                    }
                    if(strlen($param['remark'])>50){
                        db::rollback();
                        $data = [];
                        $data['status'] = 0;
                        $data['msg'] = '请输入1-50字拒绝原因';
                        return json($data);
                    }
                    $data['update_time'] = date('Y-m-d H:i:s');
                    $data['remark'] = $param['remark'];
                    $res = db::name('real_auth')->where($where)->update($data);
                    if($res){
                        add_user_operation($this->admin,$this->admin_name,3,1,'审核拒绝会员实名', $_SERVER['REQUEST_URI'], serialize($_REQUEST),$real_info['id']);
                        db::commit();
                        $data = [];
                        $data['status'] = 1;
                        $data['msg'] = '操作成功';
                    }else{
                        db::rollback();
                        $data = [];
                        $data['status'] = 0;
                        $data['msg'] = '操作失败';
                    }
                }
            }else{
                db::rollback();
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '操作失败';
            }
            return json($data);
        }
    }
    //代理提现处理
    public function agent_withdraw_handle()
    {
        if(request()->isAjax()){
            $param = input('post.');
            $where = [];
            $where[] = ['status','=','1'];
            $where[] = ['id','=',$param['id']];
            db::startTrans();
            $withdraw = db::name('agent_withdraw_log')->where($where)->find();
            if($withdraw){
                $data = [];
                $data['id'] = $param['id'];
                $data['status'] = $param['status'];
                if($param['status']==2 && $withdraw['status'] == 1){
                    $data['update_time'] = date('Y-m-d H:i:s');
                    $data['remark'] = '审核通过';
                    $res = db::name('agent_withdraw_log')->where($where)->update($data);
                    if($res){
                        add_user_operation($this->admin,$this->admin_name,3,2,'审核代理提现', $_SERVER['REQUEST_URI'], serialize($_REQUEST),$withdraw['agent_id']);
                        db::commit();
                        $data = [];
                        $data['status'] = 1;
                        $data['msg'] = '操作成功';
                    }else{
                        db::rollback();
                        $data = [];
                        $data['status'] = 0;
                        $data['msg'] = '操作失败';
                    }
                }elseif($param['status']==3 && $withdraw['status'] == 1){
                    if(!$param['remark']){
                        db::rollback();
                        $data = [];
                        $data['status'] = 0;
                        $data['msg'] = '请输入拒绝原因';
                        return json($data);
                    }
                    if(strlen($param['remark'])>50){
                        db::rollback();
                        $data = [];
                        $data['status'] = 0;
                        $data['msg'] = '请输入1-50字拒绝原因';
                        return json($data);
                    }
                    $data['update_time'] = date('Y-m-d H:i:s');
                    $data['remark'] = $param['remark'];
                    $res = db::name('agent_withdraw_log')->where($where)->update($data);
                    if($res){
                        $oid=add_user_operation($this->admin,$this->admin_name,3,2,'拒绝代理提现', $_SERVER['REQUEST_URI'], serialize($_REQUEST),$withdraw['agent_id']);
                        $where = [];
                        $where[] = ['agent_id','=',$withdraw['agent_id']];
                        $where[] = ['status','=',1];
                        $before = db::name('agent')->lock(true)->where($where)->field('money,agent_name,nickname')->find();
                        $status = db::name('agent')->where($where)->setInc('money',$withdraw['money']);
                        if($status){
                            $after_money =  $before['money']+$withdraw['money'];
                            $data = [];
                            $data['agent_id'] = $withdraw['agent_id'];
                            $data['agent_name'] = $before['agent_name'];
                            $data['nickname'] = $before['nickname'];
                            $data['operation_id'] = $oid;
                            $data['from_oid'] = $withdraw['id'];
                            $data['type'] = 1;
                            $data['type_info'] = '代理提现';
                            $data['money'] = $withdraw['money'];
                            $data['before_money'] = $before['money'];
                            $data['after_money'] = $after_money;
                            $data['remark'] = '代理提现失败';
                            $data['add_time'] = date('Y-m-d H:i:s');
                            $res = db::name('agent_money_log')->insert($data);
                            if($res){
                                db::commit();
                                $data = [];
                                $data['status'] = 1;
                                $data['msg'] = '操作成功';
                            }else{
                                db::rollback();
                                $data = [];
                                $data['status'] = 0;
                                $data['msg'] = '操作失败';
                            }
                        }else{
                            db::rollback();
                            $data = [];
                            $data['status'] = 0;
                            $data['msg'] = '操作失败';
                        }
                    }else{
                        db::rollback();
                        $data = [];
                        $data['status'] = 0;
                        $data['msg'] = '操作失败';
                    }
                }else{
                    db::rollback();
                    $data = [];
                    $data['status'] = 0;
                    $data['msg'] = '操作失败';
                }
            }else{
                db::rollback();
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '操作失败';
            }
            return json($data);
        }
    }
    /*修改状态*/
    public function status_change(){
        if(request()->isAjax()){
            $input = input('post.');
            if(isset($input['field'])){
                $field = $input['field'];
            }else{
                $field = 'status';
            }
            $data = array();
            $data[$field] = $input['status'];
            $res = db::name($input['db'])->where('id','in',input('post.id/a'))->update($data);
            if($res){
                add_user_operation($this->admin,$this->admin_name,3,4,'修改状态', $_SERVER['REQUEST_URI'], serialize($_REQUEST));
                $data = array();
                $data['status'] = 1;
            }else{
                $data = array();
                $data['status'] = 0;
            }
            return json($data);
        }
    }
    /*上传图片*/
    public function upload(){
        $file = request()->file('file');
        if($file){
            $path ='./uploads/'. input('post.path');
            $info = $file->move($path);
            if($info){
                $data = array();
                $data['status'] = 1;
                $data['info'] = '/uploads/'.input('post.path').'/'.$info->getSaveName();
            }else{
                $data = array();
                $data['status'] = 1;
                $data['info'] = $file->getError();
            }
            return json($data);

        }
    }
    /*edit上传图片*/
    public function edit_upload(){
        $file = request()->file('file');
        if($file){
            $info = $file->move('./uploads/notice');
            if($info){
                $data = array();
                $data['code'] = 0;
                $data['msg'] = '上传成功';
                $data['data']['src'] = str_replace('\\','/','/uploads/notice/'.$info->getSaveName());
            }else{
                $data = array();
                $data['code'] = 0;
                $data['msg'] =  $file->getError();
            }
            return json($data);
        }
    }

    public function new_user_money_change(){
        if(request()->isAjax()){
            $param=input('post.');
            if($param['money']<=0){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '请输入正确的金额';
                return json($data);
            }
            if($param['param']!='up'&&$param['param']!='down'){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '参数错误';
                return json($data);
            }
            $where = [];
            $where[] = ['status','=',1];
            $where[] = ['uid','=',$param['uid']];
            db::startTrans();
            $user = db::name('user')->where($where)->lock(true)->find();
            if(!$user){
                db::rollback();
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '会员信息有误';
                return json($data);
            }
            $agent_where=[];
            $agent_where[]=['status','=',1];
            $agent_where[]=['agent_id','=',$user['agent_id']];
            $agent=db::name('agent')->lock(true)->where($agent_where)->find();
            if(!$agent){
                db::rollback();
                $data=[];
                $data['status'] = 0;
                $data['msg'] = '上级信息有误';
                return json($data);
            }
            if($param['param']=='up'){
                $note = '上分';
                $status = db::name('user')->where($where)->setInc('money',$param['money']);
                $amount=$param['money'];
            }
            if($param['param']=='down'){
                if(($user['money']-$param['money'])<0){
                    db::rollback();
                    $data=[];
                    $data['status'] = 0;
                    $data['msg'] = '会员金额不足';
                    return json($data);
                }else{
                    $note = '下分';
                    $status = db::name('user')->where($where)->setDec('money',$param['money']);
                    $amount=-$param['money'];
                }
            }
            $after_money = $user['money']+$amount;
            if($status){
                $oid = add_user_operation($this->admin,$this->admin_name,3,1,$note, $_SERVER['REQUEST_URI'], serialize($_REQUEST),$param['uid']);
                if($oid){
                    $data = [];
                    $data['uid'] = $user['uid'];
                    $data['username'] = $user['username'];
                    $data['nickname'] = $user['nickname'];
                    $data['type'] = 3;
                    $data['type_info'] = $note;
                    $data['money'] = $amount;
                    $data['before_money'] = $user['money'];
                    $data['after_money'] = $after_money;
                    $data['remark'] = '平台操作会员'.$user['username'].$note;
                    $data['from_oid'] = $oid;
                    $data['operation_id'] = $oid;
                    $data['add_time'] = date('Y-m-d H:i:s');
                    $res = db::name('user_money_log')->insert($data);
                    if($res){
                        db::commit();
                        $data=[];
                        $data['status'] = 1;
                    }else{
                        db::rollback();
                        $data=[];
                        $data['status'] = 0;
                        $data['msg'] = '操作失败1';
                    }
                }else{
                    db::rollback();
                    $data=[];
                    $data['status'] = 0;
                    $data['msg'] = '操作失败2';
                }
            }else{
                db::rollback();
                $data=[];
                $data['status'] = 0;
                $data['msg'] = '操作失败3';
            }
        }
        return json($data);
    }

    public function new_agent_money_change(){
        if(request()->isAjax()){
            $param=input('post.');
            if($param['money']<=0){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '请输入正确的金额';
                return json($data);
            }
            if($param['param']!='up'&&$param['param']!='down'){
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '参数错误';
                return json($data);
            }
            $where = [];
            $where[] = ['status','=',1];
            $where[] = ['agent_id','=',$param['agent_id']];
            db::startTrans();
            $agent = db::name('agent')->where($where)->lock(true)->find();
            if(!$agent){
                db::rollback();
                $data = [];
                $data['status'] = 0;
                $data['msg'] = '代理信息有误';
                return json($data);
            }
            $amount = $param['money'];

            if($param['param']=='up'){
                $note = '上分';
                $status = db::name('agent')->where($where)->setInc('money',$amount);
            }
            if($param['param']=='down'){
                if(($agent['money']-$param['money'])<0){
                    db::rollback();
                    $data=[];
                    $data['status'] = 0;
                    $data['msg'] = '代理金额不足';
                    return json($data);
                }else{
                    $note = '下分';
                    $status = db::name('agent')->where($where)->setDec('money',$amount);
                    $amount=-$amount;
                }
            }

            $after_money = $agent['money']+$amount;
            if($after_money<0){
                db::rollback();
                $data=[];
                $data['status'] = 0;
                $data['msg'] = '代理金额不足';
                return json($data);
            }
            if($status){
                $oid = add_user_operation($this->admin,$this->admin_name,3,2,$note, $_SERVER['REQUEST_URI'], serialize($_REQUEST),$param['agent_id']);
                if($oid){
                    $data = [];
                    $data['agent_id'] = $agent['agent_id'];
                    $data['agent_name'] = $agent['agent_name'];
                    $data['nickname'] = $agent['nickname'];
                    $data['type_info'] = $note;
                    $data['type'] = 2;
                    $data['money'] = $amount;
                    $data['before_money'] = $agent['money'];
                    $data['after_money'] = $after_money;
                    $data['remark'] = '平台操作代理'.$agent['agent_name'].$note;
                    $data['from_oid'] = $oid;
                    $data['operation_id'] = $oid;
                    $data['add_time'] = date('Y-m-d H:i:s');
                    $res = db::name('agent_money_log')->insert($data);
                    if($res){
                        db::commit();
                        $data=[];
                        $data['status'] = 1;
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
            }else{
                db::rollback();
                $data=[];
                $data['status'] = 0;
                $data['msg'] = '操作失败';
            }
            return json($data);
        }
    }

    public function excel_user_list(){
        ini_set('memory_limit','30720M');    // 临时设置最大内存占用为3G
        set_time_limit(0);   // 设置脚本最大执行时间 为0 永不过期
        $param = input('get.');
        $where = array();
        $where[] = ['status','=',1];
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
            if(!empty($param['status'])){
                if($param['status'] == 1||$param['status'] == 2){
                    $where[]=['login_status','=',$param['status']];
                }else{
                    $where[]=['trade_status','=',$param['trade_status']];
                }
            }
            if(!empty($param['start'])){
                $where[]=['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[]=['add_time','<=',$param['end']];
            }
        }
        $list = db::name('user')
            ->where($where)
            ->order(['money'=>'desc','uid'=>'desc'])
            ->field('uid,username,pwd,nickname,pid,agent_name,money,promise_money,last_login_ip,last_login_time,add_ip,add_time,invite_status,trade_status,login_status')
            ->select();
        foreach($list as &$v){
            $v['pid'] = select_user_username($v['pid']);
            $v['trade_status'] = str_type($v['trade_status']);
            $v['invite_status'] = str_type($v['invite_status']);
            $v['login_status'] = str_type($v['login_status']);
        }
        $title = "<tr>
                <th>ID</th>
                <th>账号</th>
                <th>密码</th>
                <th>昵称</th>
                <th>邀请人</th>
                <th>直属代理</th>
                <th>余额</th>
                <th>保证金</th>
                <th>最后登陆IP</th>
                <th>最后登陆时间</th>
                <th>注册IP</th>
                <th>注册时间</th>
                <th>邀请状态</th>
                <th>交易状态</th>
                <th>登陆状态</th>
                </tr>";
        $name ='会员_'.date('Y-m-d H:i:s');
        excelData($list,$title,$name);
    }
    public function excel_agent_list(){
        ini_set('memory_limit','30720M');    // 临时设置最大内存占用为3G
        set_time_limit(0);   // 设置脚本最大执行时间 为0 永不过期
        $param = input('get.');
        $where = array();
        $where[]=['status','=',1];
        $where[]=['p_agent_id','=',0];
        if(request()->isGet()){
            if(!empty($param['agent_name'])){
                $where[]=['agent_name','=',$param['agent_name']];
            }
            if(!empty($param['nickname'])){
                $where[]=['nickname','=',$param['nickname']];
            }
            if(!empty($param['phone'])){
                $where[]=['phone','=',$param['phone']];
            }
            if(!empty($param['p_agent_id'])){
                $map = [];
                $map[]=['status','=',1];
                $map[] = ['agent_name','=',$param['p_agent_id']];
                $id = db::name('agent')->where($map)->value('agent_id');
                if($id){
                    $where[]=['p_agent_id','=',$id];
                }else{
                    $where[]=['agent_id','=',0];
                }
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
        $list = db::name('agent')
            ->where($where)
            ->order(['money'=>'desc','agent_id'=>'desc'])
            ->field('agent_id,agent_name,pwd,nickname,money,last_login_ip,last_login_time,add_ip,add_time,invite_status,login_status')
            ->select();
        $new = [];
        foreach($list as $key=>&$v){
            $new[$key][] = $v['agent_id'];
            $new[$key][] = $v['agent_name'];
            $new[$key][] = $v['nickname'];
            $new[$key][] = $v['pwd'];
            $new[$key][] = $v['money'];
            $new[$key][] = $v['last_login_ip'];
            $new[$key][] = $v['last_login_time'];
            $new[$key][] = $v['add_ip'];
            $new[$key][] = $v['add_time'];
            $new[$key][] = str_type($v['invite_status']);
            $new[$key][] = str_type($v['login_status']);
        }
        $name ='一级代理_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>账号</th>
                <th>昵称</th>
                <th>密码</th>
                <th>余额</th>
                <th>最后登陆IP</th>
                <th>最后登陆时间</th>
                <th>注册IP</th>
                <th>注册时间</th>
                <th>邀请状态</th>
                <th>登陆状态</th>
                </tr>";
        excelData($new,$title,$name);
    }
    public function excel_under_agent_list(){
        ini_set('memory_limit','30720M');    // 临时设置最大内存占用为3G
        set_time_limit(0);   // 设置脚本最大执行时间 为0 永不过期
        $param = input('get.');
        $where = array();
        $where[]=['status','=',1];
        $where[]=['p_agent_id','<>',0];
        if(request()->isGet()){
            if(!empty($param['agent_name'])){
                $where[]=['agent_name','=',$param['agent_name']];
            }
            if(!empty($param['nickname'])){
                $where[]=['nickname','=',$param['nickname']];
            }
            if(!empty($param['phone'])){
                $where[]=['phone','=',$param['phone']];
            }
            if(!empty($param['p_agent_id'])){
                $map = [];
                $map[]=['status','=',1];
                $map[] = ['agent_name','=',$param['p_agent_id']];
                $id = db::name('agent')->where($map)->value('agent_id');
                if($id){
                    $where[]=['p_agent_id','=',$id];
                }else{
                    $where[]=['agent_id','=',0];
                }
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
        $list = db::name('agent')
            ->where($where)
            ->order(['money'=>'desc','agent_id'=>'desc'])
            ->field('agent_id,agent_name,pwd,nickname,p_agent_id,money,last_login_ip,last_login_time,add_ip,add_time,invite_status,login_status')
            ->select();
        $new = [];
        foreach($list as $key=>&$v){
            $new[$key][] = $v['agent_id'];
            $new[$key][] = $v['agent_name'];
            $new[$key][] = $v['nickname'];
            $new[$key][] = $v['pwd'];
            $new[$key][] =  select_agent_username($v['p_agent_id']);
            $new[$key][] = $v['money'];
            $new[$key][] = $v['last_login_ip'];
            $new[$key][] = $v['last_login_time'];
            $new[$key][] = $v['add_ip'];
            $new[$key][] = $v['add_time'];
            $new[$key][] = str_type($v['invite_status']);
            $new[$key][] = str_type($v['login_status']);
        }
        $name ='二级代理_'.date('Y-m-d H:i:s');
        $title ="<tr>
                <th>ID</th>
                <th>账号</th>
                <th>昵称</th>
                <th>密码</th>
                <th>直属代理</th>
                <th>余额</th>
                <th>最后登陆IP</th>
                <th>最后登陆时间</th>
                <th>注册IP</th>
                <th>注册时间</th>
                <th>邀请状态</th>
                <th>登陆状态</th>
                </tr>";
        excelData($new,$title,$name);
    }
    public function  excel_recharge_list(){
        ini_set('memory_limit','30720M');    // 临时设置最大内存占用为3G
        set_time_limit(0);   // 设置脚本最大执行时间 为0 永不过期
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['username'])){
                $where[]= ['username','=',$param['username']];
            }
            if(!empty($param['order_sn'])){
                $where[]= ['order_sn','=',$param['order_sn']];
            }
            if(!empty($param['agent_name'])){
                $where[]= ['agent_name','=',$param['agent_name']];
            }
            if(!empty($param['type'])){
                $where[]= ['type','=',$param['type']];
            }
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
        $list = db::name('recharge')
            ->where($where)
            ->field('id,order_sn,username,nickname,agent_name,money,type,add_time,update_time,status')
            ->select();
        foreach($list as &$v){
            $v['type'] = str_recharge_type($v['type']);
            $v['status'] = str_recharge_status($v['status']);
        }
        $name ='充值_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>单号</th>
                <th>账号</th>
                <th>名称</th>
                <th>直属代理</th>
                <th>金额</th>
                <th>支付类型</th>
                <th>创建时间</th>
                <th>到账时间</th>
                <th>状态</th>
                </tr>";
        excelData($list,$title,$name);
    }
    /**
     * 导出会员提现记录
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function excel_user_withdraw_list(){
        ini_set('memory_limit','30720M');    // 临时设置最大内存占用为3G
        set_time_limit(0);   // 设置脚本最大执行时间 为0 永不过期
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['username'])){
                $where[]= ['username','=',$param['username']];
            }
            if(!empty($param['nickname'])){
                $where[]= ['nickname','=',$param['nickname']];
            }
            if(!empty($param['order_sn'])){
                $where[]= ['order_sn','=',$param['order_sn']];
            }
            if(!empty($param['agent_name'])){
                $where[]= ['agent_name','=',$param['agent_name']];
            }
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
        $list = db::name('user_withdraw_log')
            ->where($where)
            ->field('order_sn,username,nickname,money,name,phone,bank_name,branch_name,bank_card,status,remark,add_time,update_time')
            ->select();
        foreach($list as &$v){
            $v['status'] = str_withdraw_status($v['status']);
        }
        $name ='会员提现_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>单号</th>
                <th>账号</th>
                <th>名称</th>
                <th>金额</th>
                <th>姓名</th>
                <th>电话</th>
                <th>开户行</th>
                <th>开户支行</th>
                <th>银行卡号</th>
                <th>状态</th>
                <th>审核备注</th>
                <th>发起时间</th>
                <th>审核时间</th>
                </tr>";
        excelData($list,$title,$name);
    }
    /**
     * 导出代理提现记录
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function  excel_agent_withdraw_list(){
        ini_set('memory_limit','30720M');    // 临时设置最大内存占用为3G
        set_time_limit(0);   // 设置脚本最大执行时间 为0 永不过期
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['agent_name'])){
                $where[]= ['agent_name','=',$param['agent_name']];
            }
            if(!empty($param['nickname'])){
                $where[]= ['nickname','=',$param['nickname']];
            }
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
        $list = db::name('agent_withdraw_log')
            ->where($where)
            ->field('id,agent_name,nickname,money,name,phone,bank_name,branch_name,bank_card,status,remark,add_time,update_time')
            ->select();
        foreach($list as &$v){
            $v['status'] = str_withdraw_status($v['status']);
        }
        $name ='代理提现_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>代理账号</th>
                <th>昵称</th>
                <th>金额</th>
                <th>姓名</th>
                <th>电话</th>
                <th>开户行</th>
                <th>开户支行</th>
                <th>银行卡号</th>
                <th>状态</th>
                <th>审核备注</th>
                <th>发起时间</th>
                <th>审核时间</th>
                </tr>";
        excelData($list,$title,$name);
    }
    public function  excel_user_money_list(){
        ini_set('memory_limit','30720M');    // 临时设置最大内存占用为3G
        set_time_limit(0);   // 设置脚本最大执行时间 为0 永不过期
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['username'])){
                $where[] = ['username','=',$param['username']];
            }
            if(!empty($param['nickname'])){
                $where[]= ['nickname','=',$param['nickname']];
            }

            if(!empty($param['agent_name'])){
                $where[] = ['agent_name','=',$param['agent_name']];
            }

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
        $list = db::name('user_money_log')
            ->field('id,username,nickname,type_info,before_money,money,after_money,remark,add_time')
            ->select();
            krsort($list);
        $name ='会员资金_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>账号</th>
                <th>名称</th>
                <th>操作类型</th>
                <th>变化前金额</th>
                <th>金额</th>
                <th>变化后金额</th>
                <th>备注</th>
                <th>添加时间</th>
                </tr>";
        excelData($list,$title,$name);
    }
    public function  excel_agent_money_list(){
        ini_set('memory_limit','30720M');    // 临时设置最大内存占用为3G
        set_time_limit(0);   // 设置脚本最大执行时间 为0 永不过期
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['agent_name'])){
                $where[] = ['agent_name','=',$param['agent_name']];
            }
            if(!empty($param['nickname'])){
                $where[]= ['nickname','=',$param['nickname']];
            }
            if(!empty($param['type'])){
                $where[] = ['type','=',$param['type']];
            }
            if(!empty($param['remark'])){
                $where[] = ['remark','=',$param['remark']];
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $list = db::name('agent_money_log')
            ->field('id,agent_name,nickname,type_info,before_money,money,after_money,remark,add_time')
            ->where($where)
            ->select();
        $name ='代理资金_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>账号</th>
                <th>名称</th>
                <th>操作类型</th>
                <th>变化前金额</th>
                <th>金额</th>
                <th>变化后金额</th>
                <th>备注</th>
                <th>添加时间</th>
                </tr>";
        excelData($list,$title,$name);
    }
    public function  excel_admin_log(){
        $param = input('get.');
        $where = array();
        $where[] = ['type','=',3];
        if(request()->isGet()){
            if(!empty($param['username'])){
                //操作人
                $where[] = ['username','=',$param['username']];
            }
            if(!empty($param['operation_type'])){
                //被操作人类型
                $where[] = ['operation_type','=',$param['operation_type']];
            }
            if(!empty($param['aid'])){
                // 若被操作人不为空
                $aid=0;
                if(!empty($param['operation_type'])){
                    if($param['operation_type']==1){
                        // 被操作人为会员
                        $map=[];
                        $map[]=['username','=',$param['aid']];
                        $map[]=['status','=',1];
                        $aid=db::name('user')->where($map)->value('uid');
                    }
                    if($param['operation_type']==2){
                        // 被操作人为代理
                        $map=[];
                        $map[]=['agent_name','=',$param['aid']];
                        $map[]=['status','=',1];
                        $aid=db::name('agent')->where($map)->value('agent_id');
                    }
                }
                if(!empty($aid)){
                    $where[] = ['aid','=',$aid];
                }
            }
            if(!empty($param['note'])){
                // like查询说明信息
                $where[] = ['note','like','%'.$param['note'].'%'];
            }
            if(!empty($param['start'])){
                // 开始时间
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                // 结束时间
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $list = db::name('operation_log')->where($where)->field('id,type,username,operation_type,aid,note,url,param,add_ip,add_time')->order('id desc')->select();
        foreach($list as &$val){
            $val['type']=str_type_type($val['type']);
            if($val['aid']){
                if($val['operation_type']==1){
                    $val['aid'] = select_user_username($val['aid']);
                }elseif($val['operation_type']==2){
                    $val['aid'] = select_agent_username($val['aid']);
                }
            }
            $val['operation_type']=str_type_type($val['operation_type']);
        }

        $name = '平台操作日志_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>操作人类型</th>
                <th>操作人</th>
                <th>被操作人类型</th>
                <th>被操作人</th>
                <th>说明</th>
                <th>地址</th>
                <th>参数</th>
                <th>IP</th>
                <th>时间</th>
                </tr>";
        excelData($list,$title,$name);
    }
    public function  excel_agent_log(){
        $param = input('get.');
        $where = array();
        $where[] = ['type','=',2];
        if(request()->isGet()){
            if(!empty($param['username'])){
                //操作人
                $where[] = ['username','=',$param['username']];
            }
            if(!empty($param['operation_type'])){
                //被操作人类型
                $where[] = ['operation_type','=',$param['operation_type']];
            }
            if(!empty($param['aid'])){
                // 若被操作人不为空
                $aid=0;
                if(!empty($param['operation_type'])){
                    if($param['operation_type']==1){
                        // 被操作人为会员
                        $map=[];
                        $map[]=['username','=',$param['aid']];
                        $map[]=['status','=',1];
                        $aid=db::name('user')->where($map)->value('uid');
                    }
                    if($param['operation_type']==2){
                        // 被操作人为代理
                        $map=[];
                        $map[]=['agent_name','=',$param['aid']];
                        $map[]=['status','=',1];
                        $aid=db::name('agent')->where($map)->value('agent_id');
                    }
                }
                if(!empty($aid)){
                    $where[] = ['aid','=',$aid];
                }
            }
            if(!empty($param['note'])){
                // like查询说明信息
                $where[] = ['note','like','%'.$param['note'].'%'];
            }
            if(!empty($param['start'])){
                // 开始时间
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                // 结束时间
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $list = db::name('operation_log')->where($where)->field('id,type,username,operation_type,aid,note,url,param,add_ip,add_time')->order('id desc')->select();
        foreach($list as &$val){
            $val['type']=str_type_type($val['type']);
            if($val['aid']){
                if($val['operation_type']==1){
                    $val['aid'] = select_user_username($val['aid']);
                }elseif($val['operation_type']==2){
                    $val['aid'] = select_agent_username($val['aid']);
                }
            }
            $val['operation_type']=str_type_type($val['operation_type']);
        }

        $name = '代理操作日志_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>操作人类型</th>
                <th>操作人</th>
                <th>被操作人类型</th>
                <th>被操作人</th>
                <th>说明</th>
                <th>地址</th>
                <th>参数</th>
                <th>IP</th>
                <th>时间</th>
                </tr>";
        excelData($list,$title,$name);
    }
    public function  excel_user_log(){
        $param = input('get.');
        $where = array();
        $where[] = ['type','=',1];
        if(request()->isGet()){
            if(!empty($param['username'])){
                //操作人
                $where[] = ['username','=',$param['username']];
            }
            if(!empty($param['operation_type'])){
                //被操作人类型
                $where[] = ['operation_type','=',$param['operation_type']];
            }
            if(!empty($param['aid'])){
                // 若被操作人不为空
                $aid=0;
                if(!empty($param['operation_type'])){
                    if($param['operation_type']==1){
                        // 被操作人为会员
                        $map=[];
                        $map[]=['username','=',$param['aid']];
                        $map[]=['status','=',1];
                        $aid=db::name('user')->where($map)->value('uid');
                    }
                    if($param['operation_type']==2){
                        // 被操作人为代理
                        $map=[];
                        $map[]=['agent_name','=',$param['aid']];
                        $map[]=['status','=',1];
                        $aid=db::name('agent')->where($map)->value('agent_id');
                    }
                }
                if(!empty($aid)){
                    $where[] = ['aid','=',$aid];
                }
            }
            if(!empty($param['note'])){
                // like查询说明信息
                $where[] = ['note','like','%'.$param['note'].'%'];
            }
            if(!empty($param['start'])){
                // 开始时间
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                // 结束时间
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $list = db::name('operation_log')->where($where)->field('id,operation_type,aid,note,url,param,add_ip,add_time')->order('id desc')->select();
        foreach($list as &$val){
            $val['type']=str_type_type($val['type']);
            if($val['aid']){
                if($val['operation_type']==1){
                    $val['aid'] = select_user_username($val['aid']);
                }elseif($val['operation_type']==2){
                    $val['aid'] = select_agent_username($val['aid']);
                }
            }
            $val['operation_type']=str_type_type($val['operation_type']);
        }

        $name = '会员操作日志_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>操作人类型</th>
                <th>操作人</th>
                <th>被操作人类型</th>
                <th>被操作人</th>
                <th>说明</th>
                <th>地址</th>
                <th>参数</th>
                <th>IP</th>
                <th>时间</th>
                </tr>";
        excelData($list,$title,$name);
    }
    public function  excel_user_apply_coin(){
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['apply_coin_id'])){
                $where[] = ['apply_coin_id','=',$param['apply_coin_id']];
            }
            if(!empty($param['username'])){
                $where[] = ['username','=',$param['username']];
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $list = db::name('user_apply_coin')->where($where)->field('id,username,apply_coin_name,amount')->order(['id'=>'desc'])->select();

        $name = '申购币持有记录'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>会员</th>
                <th>申购币名称</th>
                <th>数量</th>
                </tr>";
        excelData($list,$title,$name);
    }
    public function  excel_apply_coin_order_log(){
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['apply_coin_id'])){
                $where[] = ['apply_coin_id','=',$param['apply_coin_id']];
            }
            if(!empty($param['username'])){
                $where[] = ['username','=',$param['username']];
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $list = db::name('apply_coin_order_log')->where($where)->field('id,username,nickname,apply_coin_name,number,price,amount,add_time')->order(['id'=>'desc'])->select();

        $name = '申购币购买记录'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>会员</th>
                <th>名称</th>
                <th>申购币名称</th>
                <th>数量</th>
                <th>单价</th>
                <th>消费金额</th>
                <th>时间</th>
                </tr>";
        excelData($list,$title,$name);
    }
    public function  excel_apply_coin_give_log(){
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['apply_coin_id'])){
                $where[] = ['apply_coin_id','=',$param['apply_coin_id']];
            }
            if(!empty($param['username'])){
                $where[] = ['username','=',$param['username']];
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $list = db::name('apply_coin_give_log')->where($where)->field('id,username,nickname,apply_coin_name,number,give_username,add_time')->order(['id'=>'desc'])->select();

        $name = '申购币赠送记录'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>会员</th>
                <th>名称</th>
                <th>申购币名称</th>
                <th>数量</th>
                <th>赠送人</th>
                <th>时间</th>
                </tr>";
        excelData($list,$title,$name);
    }
    public function  excel_order_list(){
        $param = input('get.');
        $where = array();
        $where[] = ['order_status','=',2];
        if(request()->isGet()){
            if(!empty($param['username'])){
                $where[] = ['username','=',$param['username']];
            }
            if(!empty($param['pid'])){
                $where[] = ['pid','=',$param['pid']];
            }
            if(!empty($param['order_sn'])){
                $where[] = ['order_sn','=',$param['order_sn']];
            }
            if(!empty($param['direction'])){
                $where[] = ['direction','=',$param['direction']];
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $list = db::name('order')->where($where)->field('order_sn,username,agent_name,product_name,hand,contract,fee,money,direction,buy_price,sell_price,target_profit,stop_loss,profit,add_time,update_time')->order(['oid'=>'desc'])->select();

        $name = '订单记录'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>订单号</th>
                <th>会员</th>
                <th>代理</th>
                <th>产品名称</th>
                <th>手数</th>
                <th>交易单位</th>
                <th>手续费</th>
                <th>保证金</th>
                <th>方向</th>
                <th>买入价</th>
                <th>卖出价</th>
                <th>止盈</th>
                <th>止损</th>
                <th>盈利金额</th>
                <th>建仓时间</th>
                <th>平仓时间</th>
                </tr>";
        excelData($list,$title,$name);
    }
}