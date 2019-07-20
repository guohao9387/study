<?php
namespace app\index\controller;
use think\Db;
class Coin extends Common
{
    public function initialize(){
        parent::initialize();
        $kefu=[];
        $kefu['qq']=db::name('kefu')->where('id','=',2)->cache('qq_kefu')->value('value');
        $kefu['weixin']=db::name('kefu')->where('id','=',3)->cache('weixin_kefu')->value('image');
        $kefu['phone']=db::name('kefu')->where('id','=',4)->cache('phone_kefu')->value('image');
        $this->assign('kefu',$kefu);

        $where=[];
        $where[]=['status','=',1];
        $where[]=['type','=',2];
        $list=db::name('news')->where($where)->order('sort desc')->limit(6)->select();
        $this->assign('about_us_list',$list);

        $where=[];
        $where[]=['status','=',1];
        $where[]=['type','=',3];
        $list=db::name('news')->where($where)->order('sort desc')->limit(6)->select();
        $this->assign('help_list',$list);

        $where=[];
        $where[]=['status','=',1];
        $where[]=['type','=',4];
        $list=db::name('news')->where($where)->order('sort desc')->limit(6)->select();
        $this->assign('download_list',$list);
    }
    public function index()
    {
        $where=[];
        $where[]=['status','=',1];
        $where[]=['show_status','=',1];
        $list=db::name('apply_coin')->where($where)->select();
        $this->assign('list',$list);

        $where=[];
        $where[]=['status','=',1];
        $where[]=['type','=',2];
        $list=db::name('adv')->where($where)->order('sort desc')->select();
        $this->assign('adv',$list);
        $money=db::name('user')->where('uid',session('user'))->value('money');
        $this->assign('money',$money);
        return $this->fetch();
    }
    public function buy(){
        if(request()->isAjax()){
            $param=input('post.');
            if($param['number']<=0){
                $data=[];
                $data['status']=0;
                $data['msg']='数量有误';
                return json($data);
            }
            $where=[];
            $where[]=['status','=',1];
            $where[]=['show_status','=',1];
            $where[]=['id','=',$param['id']];
            $info=db::name('apply_coin')->where($where)->find();
            if($info){
                $amount=$param['number']*$info['price']*$info['min_hand'];
                db::startTrans();
                $user = db::name('user')->lock(true)->where('uid',session('user'))->find();
                if($user['money']<$amount){
                    db::rollback();
                    $data=[];
                    $data['status']=0;
                    $data['msg']='账户余额不足';
                    return json($data);
                }
                $status=db::name('user')->where('uid',session('user'))->setDec('money',$amount);
                if($status){

                    $where=[];
                    $where[]=['uid','=',$user['uid']];
                    $where[]=['apply_coin_id','=',$info['id']];
                    $res=db::name('user_apply_coin')->where($where)->find();
                    if($res){
                        $status=db::name('user_apply_coin')->where($where)->setInc('amount',$param['number']);
                    }else{
                        $data=[];
                        $data['uid']=$user['uid'];
                        $data['username']=$user['username'];
                        $data['apply_coin_id']=$info['id'];
                        $data['apply_coin_name']=$info['name'];
                        $data['amount']=$param['number'];

                        $status=db::name('user_apply_coin')->insert($data);
                    }
                    if($status){
                        $data=[];
                        $data['uid']=$user['uid'];
                        $data['username']=$user['username'];
                        $data['nickname']=$user['nickname'];
                        $data['apply_coin_id']=$info['id'];
                        $data['apply_coin_name']=$info['name'];
                        $data['number']=$param['number'];
                        $data['price']=$info['price'];
                        $data['amount']=$amount;
                        $data['add_time']=date('Y-m-d H:i:s');
                        $order_id=db::name('apply_coin_order_log')->insertGetId($data);
                        if($order_id){
                            $operation_id=add_user_operation($user['uid'],$user['username'],1,1,'申购币购买', $_SERVER['REQUEST_URI'], serialize($_REQUEST),$user['uid']);

                            $data=[];
                            $data['uid']=$user['uid'];
                            $data['username']=$user['username'];
                            $data['nickname']=$user['nickname'];
                            $data['from_oid']=$order_id;
                            $data['before_money']=$user['money'];
                            $data['money']=$amount;
                            $data['after_money']=$user['money']-$amount;
                            $data['type']=5;
                            $data['type_info']='申购币';
                            $data['remark']='申购币购买';
                            $data['operation_id']=$operation_id;
                            $data['add_time']=date('Y-m-d H:i:s');
                            $res=db::name('user_money_log')->insert($data);
                            if($res){
                                if($user['pid']){
                                    $p_user=db::name('user')->where('uid',$user['pid'])->find();
                                    if($p_user){
                                        $p_number=$param['number']*$this->config['coin_give']/100;
                                        $where=[];
                                        $where[]=['uid','=',$p_user['uid']];
                                        $where[]=['apply_coin_id','=',$info['id']];
                                        $res=db::name('user_apply_coin')->where($where)->find();
                                        if($res){
                                            $status=db::name('user_apply_coin')->where($where)->setInc('amount',$p_number);
                                        }else{
                                            $data=[];
                                            $data['uid']=$p_user['uid'];
                                            $data['username']=$p_user['username'];
                                            $data['apply_coin_id']=$info['id'];
                                            $data['apply_coin_name']=$info['name'];
                                            $data['amount']=$p_number;
                                            $status=db::name('user_apply_coin')->insert($data);
                                        }
                                        if($status){
                                            $data=[];
                                            $data['uid']=$p_user['uid'];
                                            $data['username']=$p_user['username'];
                                            $data['nickname']=$p_user['nickname'];
                                            $data['give_uid']=$user['uid'];
                                            $data['give_username']=$user['username'];
                                            $data['from_oid']=$order_id;
                                            $data['apply_coin_id']=$info['id'];
                                            $data['apply_coin_name']=$info['name'];
                                            $data['number']=$p_number;
                                            $data['add_time']=date('Y-m-d H:i:s');
                                            $res=db::name('apply_coin_give_log')->insertGetId($data);
                                            if(!$res){
                                                db::rollback();
                                                $data=[];
                                                $data['status']=0;
                                                $data['msg']='购买失败，请重试';
                                                return json($data);
                                            }
                                        }else{
                                            db::rollback();
                                            $data=[];
                                            $data['status']=0;
                                            $data['msg']='购买失败，请重试';
                                            return json($data);
                                        }
                                    }else{
                                        db::rollback();
                                        $data=[];
                                        $data['status']=0;
                                        $data['msg']='购买失败，请重试';
                                        return json($data);
                                    }
                                }
                                db::commit();
                                $data=[];
                                $data['status']=1;
                                $data['msg']='购买成功';
                                return json($data);
                            }else{
                                db::rollback();
                                $data=[];
                                $data['status']=0;
                                $data['msg']='购买失败，请重试';
                                return json($data);
                            }
                        }else{
                            db::rollback();
                            $data=[];
                            $data['status']=0;
                            $data['msg']='购买失败，请重试';
                            return json($data);
                        }

                    }else{
                        db::rollback();
                        $data=[];
                        $data['status']=0;
                        $data['msg']='购买失败，请重试';
                        return json($data);
                    }

                }else{
                    db::rollback();
                    $data=[];
                    $data['status']=0;
                    $data['msg']='购买失败，请重试';
                    return json($data);
                }
            }else{
                $data=[];
                $data['status']=0;
                $data['msg']='参数有误';
                return json($data);
            }
        }
    }
}