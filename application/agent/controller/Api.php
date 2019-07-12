<?php
namespace app\agent\controller;
use think\Db;
class Api extends Common{
    public function initialize(){
        parent::initialize();
    }
    public function excel_user_list(){
        ini_set('memory_limit','30720M');    // 临时设置最大内存占用为3G
        set_time_limit(0);   // 设置脚本最大执行时间 为0 永不过期
        $param = input('get.');
        $where = array();
        $where[]=['status','=',1];
        $where[] = ['type','=',1];
        if(request()->isGet()){
            if(!empty($param['username'])){
                $where[]=['username','=',$param['username']];
            }
            if(!empty($param['nickname'])){
                $where[]=['nickname','=',$param['nickname']];
            }
            if(!empty($param['phone'])){
                $where[]=['phone','=',$param['phone']];
            }
            if(!empty($param['pid'])){
                $map = array();
                $map[] = ['status','=',1];
                $map[] = ['type','=',1];
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
        $where[] = ['agent_id','=',$this->agent];
        $list = db::name('user')
            ->where($where)
            ->order(['money'=>'desc','uid'=>'desc'])
            ->field('uid,username,nickname,phone,pid,money,xm_fee,xm_rate,trade_min,trade_max,limit_type,invitation_status,trade_status,login_status')
            ->select();
        $last = [];
        foreach($list as $v){
            $new = [];
            $new[] = $v['uid'];
            $new[] = $v['username'];
            $new[] = $v['nickname'];
            $new[] = $v['phone'];
            $new[] = select_user_username($v['pid']);
            $new[] = $v['money'];
            $new[] = $v['xm_fee'];
            $new[] = $v['xm_rate'];
            $new[] = $v['trade_min'];
            $new[] = $v['trade_max'];
            $new[] = str_limit_type($v['limit_type']);
            $new[] = str_type($v['invitation_status']);
            $new[] = str_type($v['trade_status']);
            $new[] = str_type($v['login_status']);
            $last[] = $new;
        }
        $title = "<tr>
                <th>ID</th>
                <th>账号</th>
                <th>昵称</th>
                <th>电话</th>
                <th>邀请人</th>
                <th>余额</th>
                <th>洗码费</th>
                <th>洗码率%</th>
                <th>限小</th>
                <th>限大</th>
                <th>限红类型</th>
                <th>邀请状态</th>
                <th>交易状态</th>
                <th>登陆状态</th>
                </tr>";
        $name ='下级会员_'.date('Y-m-d H:i:s');
        excelData($last,$title,$name);
    }
    public function excel_agent_list(){
        ini_set('memory_limit','30720M');    // 临时设置最大内存占用为3G
        set_time_limit(0);   // 设置脚本最大执行时间 为0 永不过期
        $param = input('get.');
        $where = array();
        $where[]=['status','=',1];
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
                $where[]=['p_agent_id','=',$id];
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
        if(isset($param['p_agent_id'])){
            $map = [];
            $map[]=['status','=',1];
            $map[] = ['agent_name','=',$param['p_agent_id']];
            $id = db::name('agent')
                ->where($map)
//                ->where('find_in_set('.$this->agent.',chain)')
                ->value('agent_id');
            $where[]=['p_agent_id','=',$id];
        }else{
            if(!isset($param['agent_name'])&&!isset($param['nickname'])&&!isset($param['phone'])){
                $where[] = ['p_agent_id','=',$this->agent];
            }
        }
        $list = db::name('agent')
            ->where($where)
            ->order(['money'=>'desc','agent_id'=>'desc'])
            ->field('agent_id,agent_name,nickname,phone,money,xm_fee,hold,xm_rate,trade_min,trade_max,invitation_status,login_status')
            ->select();
        $last = [];
        foreach($list as $v){
            $new = [];
            $new[] = $v['agent_id'];
            $new[] = $v['agent_name'];
            $new[] = $v['nickname'];
            $new[] = $v['phone'];
            $new[] = $v['money'];
            $new[] = get_group_money($v['agent_id']);
            $new[] = $v['xm_fee'];
            $new[] = $v['hold'];
            $new[] = $v['xm_rate'];
            $new[] = $v['trade_min'];
            $new[] = $v['trade_max'];
            $new[] = str_type($v['invitation_status']);
            $new[] =str_type($v['login_status']);
            $last[] = $new;
        }
        $name ='下级代理_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>账号</th>
                <th>昵称</th>
                <th>电话</th>
                <th>余额</th>
                <th>群组余额</th>
                <th>洗码费</th>
                <th>占成%</th>
                <th>洗码率%</th>
                <th>限小</th>
                <th>限大</th>
                <th>邀请状态</th>
                <th>登陆状态</th>
                </tr>";
        excelData($last,$title,$name);
    }
    public function  excel_recharge_list(){
        ini_set('memory_limit','30720M');    // 临时设置最大内存占用为3G
        set_time_limit(0);   // 设置脚本最大执行时间 为0 永不过期
        $param = input('get.');
        $where = array();
        $where[] = ['b.type','=',1];
        $where[] = ['b.status','<>',3];
        $where[] = ['c.status','<>',3];
        if(request()->isGet()){
            if(!empty($param['username'])){
                $where[]= ['b.username|b.nickname','=',$param['username']];
            }
            if(!empty($param['agent_name'])){
                $where[]= ['c.agent_name|c.nickname','=',$param['agent_name']];
            }
            if(!empty($param['pay_sn'])){
                $where[]= ['a.pay_sn','=',$param['pay_sn']];
            }
            if(!empty($param['type'])){
                $where[]= ['a.type','=',$param['type']];
            }
            if(!empty($param['status'])){
                $where[]= ['a.status','=',$param['status']];
            }
            if(!empty($param['start'])){
                $where[]= ['a.add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[]= ['a.add_time','<=',$param['end']];
            }
        }
        $where[] = ['b.agent_id','in',$this->all_ids];
        $list = db::name('recharge')
            ->alias('a')
            ->join('user b','a.uid=b.uid')
            ->join('agent c','c.agent_id = a.agent_id')
            ->where($where)
            ->field('a.pay_id,a.pay_sn,b.nickname,c.nickname agent_nickname,a.amount,a.type,a.add_time,a.pay_time,a.status')
            ->select();
        foreach($list as &$v){
            $v['type'] = str_recharge_type($v['type']);
            $v['status'] = str_recharge_status($v['status']);
        }
        $name ='下级会员充值_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>单号</th>
                <th>会员</th>
                <th>直属代理</th>
                <th>余额</th>
                <th>支付类型</th>
                <th>创建时间</th>
                <th>到账时间</th>
                <th>状态</th>
                </tr>";
        excelData($list,$title,$name);
    }
    public function excel_user_withdraw_list(){
        ini_set('memory_limit','30720M');    // 临时设置最大内存占用为3G
        set_time_limit(0);   // 设置脚本最大执行时间 为0 永不过期
        $param = input('get.');
        $where = array();
        $where[] = ['b.type','=',1];
        $where[] = ['b.status','=',1];
        $where[] = ['c.status','=',1];
        if(request()->isGet()){
            if(!empty($param['username'])){
                $where[]= ['b.username','=',$param['username']];
            }
            if(!empty($param['pay_sn'])){
                $where[]= ['a.pay_sn','=',$param['pay_sn']];
            }
            if(!empty($param['status'])){
                $where[]= ['a.status','=',$param['status']];
            }
            if(!empty($param['start'])){
                $where[]= ['a.add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[]= ['a.add_time','<=',$param['end']];
            }
        }
        $where[] = ['b.agent_id','=',$this->agent];
        $list = db::name('user_withdraw_log')
            ->alias('a')
            ->join('user b','a.uid=b.uid')
            ->join('agent c','c.agent_id=a.agent_id')
            ->where($where)
            ->field('a.id,a.pay_sn,b.nickname,a.amount,a.server_money,a.pay_amount,a.bank_khm,a.bank_name,a.bank_province,a.bank_city,a.bank_address,a.bank_id,a.status,a.remark,a.note,a.add_time')
            ->select();
        foreach($list as &$v){
            $v['status'] = str_withdraw_status($v['status']);
        }
        $name ='下级会员提现_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>单号</th>
                <th>会员</th>
                <th>金额</th>
                <th>手续费</th>
                <th>实收</th>
                <th>姓名</th>
                <th>所属银行</th>
                <th>省</th>
                <th>市</th>
                <th>开户行名称</th>
                <th>银行卡号</th>
                <th>状态</th>
                <th>用户备注</th>
                <th>操作备注</th>
                <th>发起时间</th>
                </tr>";
        excelData($list,$title,$name);
    }
    public function excel_agent_withdraw_list(){
        ini_set('memory_limit','30720M');    // 临时设置最大内存占用为3G
        set_time_limit(0);   // 设置脚本最大执行时间 为0 永不过期
        $param = input('get.');
        $where = array();
        $where[] = ['b.status','=',1];
        if(request()->isGet()){
            if(!empty($param['agent_name'])){
                $where[]= ['b.agent_name','=',$param['agent_name']];
            }
            if(!empty($param['pay_sn'])){
                $where[]= ['a.pay_sn','=',$param['pay_sn']];
            }
            if(!empty($param['status'])){
                $where[]= ['a.status','=',$param['status']];
            }
            if(!empty($param['start'])){
                $where[]= ['a.add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[]= ['a.add_time','<=',$param['end']];
            }
        }
        $where[] = ['b.p_agent_id','=',$this->agent];
        $list = db::name('agent_withdraw_log')
            ->alias('a')
            ->join('agent b','b.agent_id=b.agent_id')
            ->where($where)
            ->field('a.id,a.pay_sn,b.nickname,b.p_agent_id,a.amount,a.server_money,a.pay_amount,a.bank_khm,a.bank_name,a.bank_province,a.bank_city,a.bank_address,a.bank_id,a.status,a.remark,a.note,a.add_time')
            ->select();
        foreach($list as &$v){
            $v['status'] = str_withdraw_status($v['status']);
            $v['p_agent_id'] = select_agent_nickname($v['p_agent_id']);
        }
        $name ='下级代理提现_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>单号</th>
                <th>代理</th>
                <th>直属代理</th>
                <th>金额</th>
                <th>手续费</th>
                <th>实收</th>
                <th>姓名</th>
                <th>所属银行</th>
                <th>省</th>
                <th>市</th>
                <th>开户行名称</th>
                <th>银行卡号</th>
                <th>状态</th>
                <th>代理备注</th>
                <th>操作备注</th>
                <th>发起时间</th>
                </tr>";
        excelData($list,$title,$name);
    }
    public function  excel_user_money_list(){
        ini_set('memory_limit','30720M');    // 临时设置最大内存占用为3G
        set_time_limit(0);   // 设置脚本最大执行时间 为0 永不过期
        $param = input('get.');
        $where = array();
        $where[] = ['b.type','=',1];
        $where[] = ['a.type','=',4];
        $where[] = ['b.status','=',1];
        if(request()->isGet()){
            if(!empty($param['username'])){
                $where[] = ['b.username','=',$param['username']];
            }
//            if(!empty($param['agent_name'])){
//                $where[] = ['c.agent_name','=',$param['agent_name']];
//            }
//            if(!empty($param['type'])){
//                $where[] = ['a.type','=',$param['type']];
//            }
            if(!empty($param['toward'])){
                if($param['toward']==1){
                    $where[] = ['a.amount','>',0];
                }else{
                    $where[] = ['a.amount','<=',0];
                }
            }
            if(!empty($param['start'])){
                $where[] = ['a.add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['a.add_time','<=',$param['end']];
            }
        }
        $where[] = ['b.agent_id','=',$this->agent];
        $list = db::name('user_bill')
            ->alias('a')
            ->join('user b','b.uid=a.uid')
            ->field('a.id,a.username,a.type_info,a.before_money,a.amount,a.after_money,a.note,a.add_time')
            ->where($where)
            ->order('a.id desc')
            ->select();
        $name ='会员上下分记录_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>会员</th>
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
        $where[] = ['b.status','=',1];
        if(request()->isGet()){

            if(!empty($param['agent_name'])){
                $where[] = ['b.agent_name','=',$param['agent_name']];
            }
//            if(!empty($param['p_agent_id'])){
//                $map = [];
//                $map[] = ['status','=',1];
//                $map[] = ['agent_name','=',$param['p_agent_id']];
//                $p_agent_id = db::name('agent')->where($map)->value('agent_id');
//                $where[] = ['b.p_agent_id','=',$p_agent_id];
//            }
//            if(!empty($param['type'])){
//                $where[] = ['a.type','=',$param['type']];
//            }
            if(!empty($param['toward'])){
                if($param['toward']==1){
                    $where[] = ['a.amount','>',0];
                }else{
                    $where[] = ['a.amount','<=',0];
                }
            }
            if(!empty($param['start'])){
                $where[] = ['a.add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['a.add_time','<=',$param['end']];
            }
        }
        $where[] = ['a.type','=',4];
        $where[] = ['b.p_agent_id','=',$this->agent];
        $list = db::name('agent_bill')
            ->alias('a')
            ->join('agent b','b.agent_id=a.agent_id')
            ->field('a.id,b.nickname,a.type_info,a.before_money,a.amount,a.after_money,a.note,a.add_time')
            ->where($where)
            ->order('a.id desc')
            ->select();
        $name ='代理上下分记录_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>代理</th>
                <th>操作类型</th>
                <th>变化前金额</th>
                <th>金额</th>
                <th>变化后金额</th>
                <th>备注</th>
                <th>添加时间</th>
                </tr>";
        excelData($list,$title,$name);
    }
    public function  excel_user_xm_list(){
        ini_set('memory_limit','30720M');    // 临时设置最大内存占用为3G
        set_time_limit(0);   // 设置脚本最大执行时间 为0 永不过期
        $param = input('get.');
        $where = array();
        $where[] = ['b.type','=',1];
        $where[] = ['b.status','<>',3];
        $where[] = ['c.status','<>',3];
        if(request()->isGet()){
            if(!empty($param['username'])){
                $where[] = ['b.username|b.nickname','=',$param['username']];
            }
            if(!empty($param['agent_name'])){
                $where[] = ['c.agent_name|c.nickname','=',$param['agent_name']];
            }
            if(!empty($param['type'])){
                $where[] = ['a.type','=',$param['type']];
            }
            if(!empty($param['toward'])){
                if($param['toward']==1){
                    $where[] = ['a.fee','>',0];
                }else{
                    $where[] = ['a.fee','<=',0];
                }
            }
            if(!empty($param['start'])){
                $where[] = ['a.add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['a.add_time','<=',$param['end']];
            }
        }
        $where[] = ['b.agent_id','in',$this->all_ids];
        $list = db::name('user_fee_log')
            ->alias('a')
            ->join('user b','b.uid=a.uid')
            ->join('agent c','c.agent_id=b.agent_id')
            ->field('a.id,b.nickname,c.nickname agent_nickname,a.before_fee,a.fee,a.after_fee,a.remark,a.add_time')
            ->where($where)
            ->select();
        $name ='下级会员洗码_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>会员</th>
                <th>直属代理</th>
                <th>变化前金额</th>
                <th>金额</th>
                <th>变化后金额</th>
                <th>备注</th>
                <th>添加时间</th>
                </tr>";
        excelData($list,$title,$name);
    }
    public function  excel_agent_xm_list(){
        ini_set('memory_limit','30720M');    // 临时设置最大内存占用为3G
        set_time_limit(0);   // 设置脚本最大执行时间 为0 永不过期
        $param = input('get.');
        $where = array();
        $where[] = ['b.status','<>',3];
        if(request()->isGet()){
            if(!empty($param['agent_name'])){
                $where[] = ['b.agent_name|b.nickname','=',$param['agent_name']];
            }
            if(!empty($param['p_agent_id'])){
                $map = [];
                $map[] = ['status','<>',3];
                $map[] = ['agent_name|nickname','=',$param['p_agent_id']];
                $p_agent_id = db::name('agent')->where($map)->value('agent_id');
                $where[] = ['b.p_agent_id','=',$p_agent_id];
            }
            if(!empty($param['toward'])){
                if($param['toward']==1){
                    $where[] = ['a.fee','>',0];
                }else{
                    $where[] = ['a.fee','<=',0];
                }
            }
            if(!empty($param['start'])){
                $where[] = ['a.add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['a.add_time','<=',$param['end']];
            }
        }
        $where[] = ['b.agent_id','in',$this->ids];
        $list = db::name('agent_fee_log')
            ->alias('a')
            ->join('agent b','b.agent_id=a.agent_id')
            ->field('a.id,b.nickname,b.p_agent_id,a.before_fee,a.fee,a.after_fee,a.remark,a.add_time')
            ->where($where)
            ->select();
        foreach($list as &$v){
            $v['p_agent_id'] = select_agent_nickname($v['p_agent_id']);
        }
        $name ='下级代理洗码_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>代理</th>
                <th>直属代理</th>
                <th>变化前金额</th>
                <th>金额</th>
                <th>变化后金额</th>
                <th>备注</th>
                <th>添加时间</th>
                </tr>";
        excelData($list,$title,$name);
    }
    public function excel_withdraw_list(){
        ini_set('memory_limit','30720M');    // 临时设置最大内存占用为3G
        set_time_limit(0);   // 设置脚本最大执行时间 为0 永不过期
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['pay_sn'])){
                $where[]= ['pay_sn','=',$param['pay_sn']];
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
        $where[] = ['agent_id','=',$this->agent];
        $list = db::name('agent_withdraw_log')
            ->where($where)
            ->field('id,pay_sn,amount,server_money,pay_amount,bank_khm,bank_name,bank_province,bank_city,bank_address,bank_id,status,remark,note,add_time')
            ->select();
        foreach($list as &$v){
            $v['status'] = str_withdraw_status($v['status']);
        }
        $name ='我的提现_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>单号</th>
                <th>金额</th>
                <th>手续费</th>
                <th>实收</th>
                <th>姓名</th>
                <th>所属银行</th>
                <th>开户行名称</th>
                <th>银行卡号</th>
                <th>状态</th>
                <th>我的备注</th>
                <th>操作备注</th>
                <th>发起时间</th>
                </tr>";
        excelData($list,$title,$name);
    }
    public function  excel_money_list(){
        ini_set('memory_limit','30720M');    // 临时设置最大内存占用为3G
        set_time_limit(0);   // 设置脚本最大执行时间 为0 永不过期
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['type'])){
                $where[] = ['type','=',$param['type']];
            }
            if(!empty($param['toward'])){
                if($param['toward']==1){
                    $where[] = ['amount','>',0];
                }else{
                    $where[] = ['amount','<=',0];
                }
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $where[] = ['agent_id','=',$this->agent];
        $list = db::name('agent_bill')
            ->field('id,type_info,before_money,amount,after_money,note,add_time')
            ->where($where)
            ->select();
        $name ='我的资金_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>操作类型</th>
                <th>变化前金额</th>
                <th>金额</th>
                <th>变化后金额</th>
                <th>备注</th>
                <th>添加时间</th>
                </tr>";
        excelData($list,$title,$name);
    }
    public function  excel_xm_list(){
        ini_set('memory_limit','30720M');    // 临时设置最大内存占用为3G
        set_time_limit(0);   // 设置脚本最大执行时间 为0 永不过期
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['toward'])){
                if($param['toward']==1){
                    $where[] = ['fee','>',0];
                }else{
                    $where[] = ['fee','<=',0];
                }
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $where[] = ['agent_id','=',$this->agent];
        $list = db::name('agent_fee_log')
            ->field('id,before_fee,fee,after_fee,remark,add_time')
            ->where($where)
            ->select();
        $name ='我的洗码_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>变化前金额</th>
                <th>金额</th>
                <th>变化后金额</th>
                <th>备注</th>
                <th>添加时间</th>
                </tr>";
        excelData($list,$title,$name);
    }
    public function  excel_over_order_list(){
        ini_set('memory_limit','30720M');    // 临时设置最大内存占用为3G
        set_time_limit(0);   // 设置脚本最大执行时间 为0 永不过期
        $param = input('get.');
        $where = array();
        $where[] = ['order_status','=',2];
        if(request()->isGet()){
            if(!empty($param['username'])){
                $where[] = ['username','=',$param['username']];
            }
            if(!empty($param['agent_name'])){
                $where[] = ['agent_name','=',$param['agent_name']];
            }
            if(!empty($param['table_id'])){
                $where[] = ['table_id','=',$param['table_id']];
            }
            if(!empty($param['game_id'])){
                $where[] = ['game_id','=',$param['game_id']];
            }
            if(!empty($param['order_status'])){
                $where[] = ['order_status','=',$param['order_status']];
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $all=get_all_agent('',$this->agent);
        $all[]=$this->agent;
        $where[] = ['agent_id','in',$all];
        $list = db::name('order')
            ->where($where)
            ->order('oid desc')
            ->select();
        foreach($list as &$val){
            $val['betting_result'] = json_decode($val['betting_result'],true);
            $val['trade_result'] = str_trade_result($val['trade_result']);
        }
        $last = [];
        foreach($list as $v ){
            $mid = [];
            $mid[] = $v['oid'];
            $mid[] = str_game_type($v['game_id']);
            $mid[] = select_table_name($v['table_id']);
            $mid[] = $v['trade_xue'];
            $mid[] = $v['trade_kou'];
            $mid[] = $v['username'];
            $mid[] = $v['agent_name'];
            if($v['game_id']==1){
                $mid[] = $v['betting_result']['zhuang'];
                $mid[] = $v['betting_result']['xian'];
                $mid[] = $v['betting_result']['bjl_he'];
            }else{
                $mid[] = $v['betting_result']['long'];
                $mid[] = $v['betting_result']['hu'];
                $mid[] = $v['betting_result']['lh_he'];
            }
            $mid[] = $v['betting_result']['zhuangdui'];
            $mid[] = $v['betting_result']['xiandui'];
            $mid[] = str_trade_result($v['trade_result']);
            $mid[] = $v['before_money'];
            $mid[] = $v['after_money'];
            $mid[] = $v['xm_money'];
            $mid[] = $v['betting_gain'];
            $mid[] = $v['shui_fee'];
            $mid[] = $v['order_profit'];
            $mid[] = $v['order_gain'];
            $mid[] = $v['add_time'];
            $mid[] = $v['settlement_time'];
            $last[]=$mid;

        }
//        $count = db::name('order')
//            ->alias('a')
//            ->join('user b','a.uid=b.uid')
//            ->join('agent c','a.agent_id=c.agent_id')
//            ->where($where)
//            ->field('count(a.oid) count,sum(a.betting_gain) sum_money')
//            ->find();

        $name ='订单记录_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>订单编号</th>
                <th>游戏类型</th>
                <th>台桌名称</th>
                <th>靴</th>
                <th>口</th>
                <th>会员</th>
                <th>代理</th>
                <th>庄/龙</th>
                <th>闲/虎</th>
                <th>和</th>
                <th>庄对</th>
                <th>闲对</th>
                <th>结果</th>
                <th>下注前余额</th>
                <th>下注后余额</th>
                <th>洗码量</th>
                <th>下注总金额</th>
                <th>平台抽水</th>
                <th>盈利金额</th>
                <th>订单收益</th>
                <th>下注时间</th>
                <th>结算时间</th>
                </tr>";
        excelData($last,$title,$name);
    }
    public function  excel_log(){
        $param = input('get.');
        $where = array();
        $where[]=['type','=',2];
        $where[] = ['uid','=',$this->agent];
        if(request()->isGet()){
            if(!empty($param['note'])){
                $where[] = ['note','like','%'.$param['note'].'%'];
            }
            if(!empty($param['start'])){
                $where[] = ['add_time','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[] = ['add_time','<=',$param['end']];
            }
        }
        $map = [];
        $map[] = ['operation_type','=',2];
        $map[] = ['aid','=',$this->agent];
        $list = db::name('operation')->whereOr([$map,$where])->field('id,type,username,operation_type,aid,note,before,param,add_ip,add_time')->order('id desc')->select();
        foreach($list as &$val){
            $val['type']=str_type_type($val['type']);
            if($val['aid']){
                if($val['operation_type']==1){
                    $val['aid'] = select_user_username($val['aid']);
                }elseif($val['operation_type']==2){
                    $val['aid'] = select_agent_username($val['aid']);
                }elseif($val['operation_type']==3){
                    $val['aid'] = select_admin_username($val['aid']);
                }
            }
            $val['operation_type']=str_type_type($val['operation_type']);
        }
        $name = '操作日志_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>操作人类型</th>
                <th>操作人</th>
                <th>被操作人类型</th>
                <th>被操作人</th>
                <th>说明</th>
                <th>操作前信息</th>
                <th>参数</th>
                <th>IP</th>
                <th>时间</th>
                </tr>";
        excelData($list,$title,$name);
    }
    public function  excel_user_form(){
        $param = input('get.');
        $ids = get_all_agent('',$this->agent);
        $ids[]=$this->agent;
        if(!in_array($param['agent_id'],$ids)){
            $this->error('参数错误');
        }
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['username'])){
                $where[] = ['a.username','=',$param['username']];
            }
            if(!empty($param['start'])){
                $where[]=['a.date','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[]=['a.date','<=',$param['end']];
            }
        }
        $list = db::name('user_form')
            ->alias('a')
            ->join('user b','a.uid=b.uid')
            ->group('a.uid')
            ->where($where)
            ->order('a.abs_order_gain desc')
            ->field('a.uid,a.username,a.nickname,a.agent_id,a.agent_name,a.xm_rate,sum(a.order_gain) order_gain,sum(a.xm) xm,sum(a.xm_fee) xm_fee,sum(a.recharge) recharge,sum(a.withdraw) withdraw,sum(a.up) up,sum(a.down) down,a.date,b.money')
            ->select();
        $last=[];
        foreach($list as &$val){
            $mid=[];
            $mid[]=$val['uid'];
            $mid[]=$val['username'];
            $mid[]=$val['nickname'];
            $mid[]=$val['agent_name'];
            $mid[]=number_format($val['money'],2,'.','');
            $mid[]=number_format($val['order_gain'],2,'.','');
            $mid[] = number_format($val['xm'],2,'.','');
            $mid[] = $val['xm_rate'];
            $mid[]=number_format($val['xm_fee'],2,'.','');
            $mid[]=number_format($val['recharge'],2,'.','');
            $mid[]=number_format($val['withdraw'],2,'.','');
            $mid[]=number_format($val['up'],2,'.','');
            $mid[]=number_format($val['down'],2,'.','');
            $last[]=$mid;
        }
        $name = '用户报表_'.date('Y-m-d H:i:s');
        $title = "<tr>
               <th>ID</th>
            <th>账号</th>
            <th>昵称</th>
              <th>代理</th>
              <th>账户余额</th>
              <th>总输赢</th>
              <th>洗码量</th>
            <th>洗码率%</th>
              <th>洗码费</th>
            <th>总充值</th>
            <th>总提现</th>
            <th>总上分</th>
            <th>总下分</th>
                </tr>";
        excelData($last,$title,$name);
    }
    public function  excel_agent_form(){
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['agent_name'])){
                $where[] = ['a.agent_name','=',$param['agent_name']];
            }
            if(!empty($param['start'])){
                $where[]=['a.date','>=',$param['start']];
            }
            if(!empty($param['end'])){
                $where[]=['a.date','<=',$param['end']];
            }
        }
        if(isset($param['p_agent_id'])){
            $map = [];
            $map[]=['status','=',1];
            $map[] = ['agent_name','=',$param['p_agent_id']];
            $id = db::name('agent')
                ->where($map)
//                ->where('find_in_set('.$this->agent.',chain)')
                ->value('agent_id');
            $where[]=['a.p_agent_id','=',$id];
        }else{
            if(!isset($param['agent_name'])&&!isset($param['nickname'])&&!isset($param['phone'])){
                $where[] = ['a.p_agent_id','=',$this->agent];
            }
        }
        $list = db::name('agent_form')
            ->alias('a')
            ->join('agent b','a.agent_id=b.agent_id')
            ->where($where)
            ->group('a.agent_id')
            ->order('a.abs_order_gain desc')
            ->field('a.agent_id,a.phone,a.agent_name,a.nickname,b.money,a.xm_rate,a.hold,a.p_agent_id,b.chain,sum(a.order_gain) order_gain,sum(a.xm) xm,sum(a.xm_fee) xm_fee,sum(a.recharge) recharge,sum(a.withdraw) withdraw,sum(a.up) up,sum(a.down) down,sum(a.company_money) company_money,sum(a.agent_money) agent_money,a.date')
            ->select();
        $last = [];
        foreach($list as $val){
            $new = [];
            $new[] = $val['agent_id'];
            $new[] = $val['agent_name'];
            $new[] = $val['nickname'];
            $new[] = number_format($val['money'],2,'.','');
            $new[] = get_group_money($val['agent_id']);
            $new[]=number_format($val['order_gain'],2,'.','');
            $new[] = $val['hold'];
            $new[] = number_format($val['company_money'],2,'.','');
            $new[] = number_format($val['agent_money'],2,'.','');
            $new[] = number_format($val['xm'],2,'.','');
            $new[] = $val['xm_rate'];
            $new[]=number_format($val['xm_fee'],2,'.','');
            $new[]=number_format($val['recharge'],2,'.','');
            $new[]=number_format($val['withdraw'],2,'.','');
            $new[]=number_format($val['up'],2,'.','');
            $new[]=number_format($val['down'],2,'.','');
            $last[]=$new;
        }
        $name = '代理报表_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                    <th>账号</th>
                    <th>昵称</th>
                    <th>账户余额</th>
                    <th>群组余额</th>
                    <th>总输赢</th>
                    <th>占成%</th>
                    <th>公司金额</th>
                    <th>代理金额</th>
                    <th>洗码量</th>
                    <th>洗码率%</th>
                    <th>洗码费</th>
                    <th>总充值</th>
                    <th>总提现</th>
                    <th>总上分</th>
                    <th>总下分</th>
                </tr>";
        excelData($last,$title,$name);
    }
    public function  excel_up_down_list(){
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['type'])){
                $where[] = ['type','=',$param['type']];
            }
            if(!empty($param['user_type'])){
                $where[] = ['user_type','=',$param['user_type']];
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
        $where[] = ['manager_id','=',$this->agent];
        $where[] = ['manager_type','=',2];

        $list = db::name('up_down')
            ->where($where)
            ->order('id desc')
            ->field('id,type_info,user_type,username,before_amount,amount,after_amount,note,add_time')
            ->select();
        foreach($list as &$val){
            $val['user_type'] = str_member_type($val['user_type']);
        }
        $name = '上下分日志_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>操作类型</th>
                <th>身份</th>
                <th>账号</th>
                <th>变化前金额</th>
                <th>金额</th>
                <th>变化后金额</th>
                <th>备注</th>
                <th>时间</th>
                </tr>";
        excelData($list,$title,$name);
    }
    public function  excel_xm_fee_list(){
        $param = input('get.');
        $where = array();
        if(request()->isGet()){
            if(!empty($param['user_type'])){
                $where[] = ['user_type','=',$param['user_type']];
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
        $where[] = ['manager_id','=',$this->agent];
        $where[] = ['manager_type','=',2];

        $list = db::name('xm_log')
            ->where($where)
            ->order('id desc')
            ->field('id,user_type,username,before_fee,fee,after_fee,remark,from_time,add_time')
            ->select();

        foreach($list as &$val){
            $val['user_type'] = str_member_type($val['user_type']);
        }
        $name = '结算日志_'.date('Y-m-d H:i:s');
        $title = "<tr>
                <th>ID</th>
                <th>身份</th>
                <th>账号</th>
                <th>变化前金额</th>
                <th>金额</th>
                <th>变化后金额</th>
                <th>备注</th>
                <th>开始时间</th>
                <th>截止时间</th>
                </tr>";
        excelData($list,$title,$name);
    }
}