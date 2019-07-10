<?php
namespace app\admin\controller;
use think\Db;
class Payconfig extends Common{
    public function initialize(){
        parent::initialize();
    }
    /*系统设置*/
    public function  index(){
        $where = [
            ['status','>=','0']
        ];
        $list  = db::name('pay')->where($where)->order('id asc')->select();
        $this->assign([
            'list'  =>  $list,
            'count' =>  count($list)
        ]);
        return $this->fetch();

    }

    public function edit(){
        if($this->request->isAjax()){
            $param = $this->request->post();
            $ret = Db::name('pay')->where(['id'=>$param['id']])->update($param);
            $data = [];
            $data['status'] = $ret === false?0:1;
            $data['msg'] = $ret === false?'修改失败':'修改成功';
            return json($data);
        }else{
            $id = input('id');
            $row = Db::name('pay')->where(['id'=>$id])->find();
            if(empty($row)){
                $this->error('记录不存在');
            }
            $this->assign([
                'info'      =>  $row
            ]);
            return $this->fetch();
        }
    }

}