<?php
use think\Db;
use ip\IpLocation;
function reset_cache(){
    $system = db::name('config')->select();
    $sys = [];
    foreach($system as $v){
        $sys[$v['key']] = $v['value'];
    }
    cache('config',$sys);
}
function is_weixin(){
    if ( strpos($_SERVER['HTTP_USER_AGENT'],
        'MicroMessenger') !== false ) {
        return 1;
    }
    return 0;
}
function getAccesstoken(){
    $param = array();
    $param['grant_type'] = 'client_credential';
    $param['appid'] = config("appid");
    $param['secret'] = config("appsecret");
    $url = 'https://api.weixin.qq.com/cgi-bin/token?' . http_build_query ( $param );
    $content = file_get_contents ( $url );
    $content = json_decode ( $content, true );
    $accesstoken = $content['access_token'];
    return $accesstoken;
}
function getWeixinInfo($openid) {
    $param = array();
    $param['access_token'] = getAccesstoken();
    $param['openid'] = $openid;
    $param['lang'] = 'zh_CN';
    $url = 'https://api.weixin.qq.com/cgi-bin/user/info?' . http_build_query ( $param );
    $content = file_get_contents ( $url );
    $content = json_decode ( $content, true );
    return $content;
}

//发送短信
function send_msg($mobile, $msg = "【内部学习系统】您好，您的验证码是：")
{

    session('a'.$mobile,null);//清除session
    //创建一个类
    $clapi = new \msg\Msg();

    $code = mt_rand(100000, 999999);

    /**
     * 调用短信方法
     * 如果需要发送多个手机号码 请用英文逗号","隔开
     * 签名需在平台审核通过后 在短信内容前面添加
     */

    $result = $clapi->sendSMS($mobile, $msg . $code);

//返回值处理返回数组
    $result = $clapi->execResult($result);

//返回的状态码
    $statusStr = array(
        '0'   => '发送成功',
        '101' => '无此会员',
        '102' => '密码错',
        '103' => '提交过快',
        '104' => '系统忙',
        '105' => '敏感短信',
        '106' => '消息长度错',
        '107' => '错误的手机号码',
        '108' => '手机号码个数错',
        '109' => '无发送额度',
        '110' => '不在发送时间内',
        '111' => '超出该账户当月发送额度限制',
        '112' => '无此产品',
        '113' => 'extno格式错',
        '115' => '自动审核驳回',
        '116' => '签名不合法，未带签名',
        '117' => 'IP地址认证错',
        '118' => '会员没有相应的发送权限',
        '119' => '会员已过期',
        '120' => '内容不是白名单',
        '121' => '必填参数。是否需要状态报告，取值true或false',
        '122' => '5分钟内相同账号提交相同消息内容过多',
        '123' => '发送类型错误(账号发送短信接口权限)',
        '124' => '白模板匹配错误',
        '125' => '驳回模板匹配错误',
        '128' => '内容解码失败',
    );
    $data = array();
    if ($result[1] == 0) {
        session('a'.$mobile,$code);//设置短信session
        $data['status'] = 1;
        $data['msg']    = '发送成功';
    } else {
        $data['status'] = 0;
        if (isset($result[1])) {
            $data['msg'] = $statusStr[$result[1]];
        } else {
            $data['msg'] = "发生未知错误";
        }
    }
    return $data;

}
//发送短信
function send_info($mobile,$msg)
{
    //创建一个类
    $clapi = new \msg\Msg;
    /**
     * 调用短信方法
     * 如果需要发送多个手机号码 请用英文逗号","隔开
     * 签名需在平台审核通过后 在短信内容前面添加
     */
    $result = $clapi->sendSMS($mobile, $msg);
    return true;
}
//生成二维码
function code($url,$filename=''){
    //生成二维码图片
    $object = new \qrcode\Qrcode();
    /*天之初二维码的图片*/
    if($filename){
        $filename = '.'.$filename;
    }else{
        $filename = './uploads/code/'.time().rand(10000,99999).'.png';
    }
    $level=3;
    $size=6;
    $errorCorrectionLevel =intval($level) ;//容错级别
    $matrixPointSize = intval($size);//生成图片大小
    $object::png($url,$filename, $errorCorrectionLevel, $matrixPointSize, 2);
//    if($logo){
//        $image = \think\Image::open($filename);
////    $image->water('.'.$logo,5)->text($name,'/home/www/tzc/public/yahei.ttf',15,'#000000',5,5)->save($filename);
//        $image->water('.'.$logo,5)->save($filename);
//    }
    return $filename;
}

function create_agent_invite_number(){
    $invite_number = mt_rand(1000,9999);
    $where = [];
    $where[] = ['status','=',1];
    $where[] = ['invite_number','=',$invite_number];
    $res = db::name('agent')->where($where)->find();
    if($res){
        return create_agent_invite_number();
    }else{
        return $invite_number;
    }
}
function create_user_invite_number(){
    $invite_number = mt_rand(100000,999999);
    $where = [];
    $where[] = ['status','=',1];
    $where[] = ['invite_number','=',$invite_number];
    $res = db::name('user')->where($where)->find();
    if($res){
        return create_user_invite_number();
    }else{
        return $invite_number;
    }
}
//会员行为记录
function add_user_operation($uid, $username, $type, $operation_type, $note, $url, $param,$aid='',$before='')
{
    $data                   = array();
    $data['uid']            = $uid;
    $data['username']       = $username;
    $data['type']           = $type;
    $data['aid']           = $aid;
    $data['before']           = $before;
    $data['operation_type'] = $operation_type;
    $data['note']           = $note;
    $data['url']            = $url;
    $data['param']          = $param;
    $data['add_ip']          = get_real_ip();
    $data['add_time']        = date('Y-m-d H:i:s');
    $id = db::name('operation_log')->insertGetId($data);
    return $id;
}
//公告发布对象
function str_notice_type($type){
    $str = '';
    if($type == 1){
        $str = '会员';
    }elseif($type ==2){
        $str = '代理';
    }
    return $str;
}
function str_adv_type($type){
    $str = '';
    if($type == 1){
        $str = '首页';
    }elseif($type ==2){
        $str = '申购币';
    }
    return $str;
}
function str_type_type($type){
    $str = '';
    if($type == 1){
        $str = '会员';
    }elseif($type ==2){
        $str = '代理';
    }elseif($type ==3){
        $str = '管理员';
    }elseif($type ==4){
        $str = '平台信息';
    }
    return $str;
}
function str_news_type($type){
    $str = '';
    if($type == 1){
        $str = '新闻资讯';
    }elseif($type ==2){
        $str = '关于我们';
    }elseif($type ==3){
        $str = '帮助中心';
    }elseif($type ==4){
        $str = '下载中心';
    }
    return $str;
}
function str_order_status($status){
    $str = '';
    if($status == 1){
        $str = '待结算';
    }elseif($status ==2){
        $str = '已结算';
    }elseif($status ==3){
        $str = '无效';
    }
    return $str;
}
function str_agent_money_type($status){
    $str = '';
    if($status == 1){
        $str = '提现';
    }elseif($status ==2){
        $str = '上下分';
    }elseif($status ==3){
        $str = '其他';
    }
    return $str;
}

//是否
function str_type($type){
    $str = '';
    if($type == 1){
        $str = '是';
    }elseif($type ==2){
        $str = '否';
    }
    return $str;
}
function str_direction($type){
    $str = '';
    if($type == 1){
        $str = '买入';
    }elseif($type ==2){
        $str = '卖出';
    }
    return $str;
}
function user_real_status($type){
    $str = '';
    if($type == 0){
        $str = '未实名';
    }elseif($type ==1){
        $str = '已实名';
    }
    return $str;
}

//是否
function str_recharge_status($type){
    $str = '';
    if($type == 1){
        $str = '未支付';
    }elseif($type ==2){
        $str = '已支付';
    }
    return $str;
}
//是否
function str_utype($type){
    $str = '';
    if($type == 1){
        $str = '会员';
    }elseif($type ==2){
        $str = '代理';
    }
    return $str;
}
function str_recharge_type($type){
    $str = '';
    if($type == 1){
//        $str = '微信';
        $str = '支付一';
    }elseif($type ==2){
//        $str = '支付宝';
        $str = '支付二';
    }
    return $str;
}

function str_member_type($type){
    $str = '';
    if($type == 1){
        $str = '会员';
    }elseif($type ==2){
        $str = '代理';
    }
    return $str;
}
//会员status
function str_user_status($status){
    $str = '';
    if($status == 1){
        $str = '正常';
    }elseif($status ==2){
        $str = '冻结';
    }elseif($status ==3){
        $str = '禁用';
    }
    return $str;
}
//提现状态
function str_withdraw_status($status){
    $str = '';
    if($status == 1){
        $str = '待审核';
    }elseif($status ==2){
        $str = '已审核';
    }elseif($status ==3){
        $str = '已拒绝';
    }
    return $str;
}

//查询会员
function select_user_nickname($uid){
    if($uid){
        $where = [];
        $where[] = ['uid','=',$uid];
        $where[] = ['status','=',1];
        $nickname = db::name('user')->where($where)->value('nickname');
    }else{
        $nickname = '';
    }
    return $nickname;
}
function select_user_username($uid){
    if($uid){
        $where = [];
        $where[] = ['uid','=',$uid];
        $where[] = ['status','=',1];
        $username = db::name('user')->where($where)->value('username');
    }else{
        $username = '';
    }
    return $username;
}

function select_agent_username($agent_id){
    if($agent_id){
        $where = [];
        $where[] = ['agent_id','=',$agent_id];
        $where[] = ['status','=',1];
        $username = db::name('agent')->where($where)->value('agent_name');
    }else{
        $username = '';
    }
    return $username;
}

//查询代理
function select_agent_nickname($agent_id){
    if($agent_id){
        $where = [];
        $where[] = ['agent_id','=',$agent_id];
        $where[] = ['status','=',1];
        $nickname = db::name('agent')->where($where)->value('nickname');
    }else{
        $nickname = '';
    }
    return $nickname;
}

//自定义APi数据返回格式
function ApiReturn($status = 0, $info = "", $content = "")
{
    header('Content-type: application/json');
    $data           = array();
    $data['status'] = $status;
    $data['info']   = $info;
    $data['data']   = $content;
    exit(json_encode($data));
}
/*
*处理Excel导出
*@param $datas array 设置表格数据
*@param $titlename string 设置head
*@param $title string 设置表头
*/
function excelData($datas,$titlename,$name){
    $filename = $name.'.xls';
    $str = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\"\r\nxmlns:x=\"urn:schemas-microsoft-com:office:excel\"\r\nxmlns=\"http://www.w3.org/TR/REC-html40\">\r\n<head>\r\n<meta http-equiv=Content-Type content=\"text/html; charset=utf-8\">\r\n</head>\r\n<body>";
    $str .="<table border=1><head></head>";
    $str .= $titlename;
    foreach ($datas as $rt )
    {
        $str .= "<tr>";
        foreach ( $rt as $v )
        {
            $str .= "<td style='vnd.ms-excel.numberformat:@'>{$v}</td>";
        }
        $str .= "</tr>\n";
    }
    $str .= "</table></body></html>";
    header( "Content-Type: application/vnd.ms-excel; name='excel'" );
    header( "Content-type: application/octet-stream" );
    header( "Content-Disposition: attachment; filename=".$filename );
    header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
    header( "Pragma: no-cache" );
    header( "Expires: 0" );
    exit( $str );
}
//生成提现单号
function generate_sn(){
    $chars='1234567890';
    $chars1 = "abcdefghijkmnpqrstuvwxyz";
    $retrun ='';
    for ($i=0; $i <3 ; $i++) {
        $retrun .= substr($chars1,mt_rand(0,strlen($chars1)-1),1);
    }
    for ($i=0; $i <4 ; $i++) {
        $retrun .= substr($chars,mt_rand(0,strlen($chars)-1),1);
    }
    return $retrun;
}

//生成提现单号
function creat_recharge_sn($sn=""){
    $chars='1234567890';
    $chars1 = "abcdefghijkmnpqrstuvwxyz";
    $retrun =$sn.date('YmdHis');
    for ($i=0; $i <3 ; $i++) {
      //  $retrun .= substr($chars1,mt_rand(0,strlen($chars1)-1),1);
    }
    for ($i=0; $i <6 ; $i++) {
        $retrun .= substr($chars,mt_rand(0,strlen($chars)-1),1);
    }
    return $retrun;
}

function get_new_chain($chain,$find,$b=''){
    $arr=[];
    if($chain){
        $arr = explode(',',$chain);
        foreach($arr as $key=>$val){
            if($val==$find){
                if($b!=1){
                    unset($arr[$key]);
                }
                break;
            }else{
                unset($arr[$key]);
            }
        }
    }
    return $arr;
}
//生成提现单号
function sn_withdraw(){
    $chars='sn';
    $chars = $chars.time().rand(1000,9999);
    return $chars;
}


//获得系统配置参数
function get_system_config($key='')
{
    $config = db('config')->cache(1)->select();
    $return = array();
    foreach ($config as $k => $v) {
        $return[$v['key']] = $v['value'];
    }
    if (empty($key)) {
        return $return;
    } else {
        return $return[$key];
    }

}
//判断是否手机端
function isMobile() { 
  // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
  if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
    return true;
  } 
 
  // 脑残法，判断手机发送的客户端标志,兼容性有待提高。其中'MicroMessenger'是电脑微信
  if (isset($_SERVER['HTTP_USER_AGENT'])) {
    $clientkeywords = array('nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile','MicroMessenger'); 
    // 从HTTP_USER_AGENT中查找手机浏览器的关键字
    if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
      return true;
    } 
  } 
   // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
   if (isset($_SERVER['HTTP_VIA'])) { 
    // 找不到为flase,否则为true
    return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
  } 
  // 协议法，因为有可能不准确，放到最后判断
  if (isset ($_SERVER['HTTP_ACCEPT'])) { 
    // 如果只支持wml并且不支持html那一定是移动设备
    // 如果支持wml和html但是wml在html之前则是移动设备
    if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
      return true;
    } 
  } 
  return false;
}

function get_week_start($type,$time=''){
    if(date('w')==1&&date('H')<7){
        if($time){
            $sdefaultDate = date("Y-m-d",time()-8*24*60*60);
        }else{
            $sdefaultDate = date("Y-m-d",strtotime("-1 day"));
        }
    }else{
        if($time){
            $sdefaultDate = date("Y-m-d",time()-7*24*60*60);
        }else{
            $sdefaultDate = date("Y-m-d");
        }
    }

    $w=date('w',strtotime($sdefaultDate));

    $week_start=date('Y-m-d',strtotime("$sdefaultDate -".($w ? $w - 1 : 6).' days'));
    $week_end=date('Y-m-d',strtotime("$week_start +6 days"));
    if($type==1){
        return $week_start;
    }elseif($type==2){
        return $week_end;
    }
}

function quick_time_select($param){
    if($param==1){
        if(date('H')<7){
            $time=date("Y-m-d",strtotime("-2 day")).' 07:00:00';
        }else{
            $time=date("Y-m-d",strtotime("-1 day")).' 07:00:00';
        }
    }elseif($param==2){
        if(date('H')<7){
            $time=date("Y-m-d",strtotime("-1 day")).' 07:00:00';
        }else{
            $time=date("Y-m-d").' 07:00:00';
        }
    }elseif($param==3){
        $time=get_week_start(1).' 07:00:00';
    }elseif($param==4){
        $time=get_week_start(1,1).' 07:00:00';
    }elseif($param==5){
        if(date('w')==1&&date('H')<7){
            $sdefaultDate = date("Y-m-d",time()-8*24*60*60);
        }else{
            $sdefaultDate = date("Y-m-d",time()-7*24*60*60);
        }
        $w=date('w',strtotime($sdefaultDate));
        $week_start=date('Y-m-d',strtotime("$sdefaultDate -".($w ? $w - 1 : 6).' days'));
        $time=date('Y-m-d',strtotime("$week_start +7 days")).' 07:00:00';
    }elseif($param==6){
        if(date('d')==1&&date('H')<7){
            $beginThismonth=mktime(0,0,0,date('m')-1,1,date('Y'));
        }else{
            $beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
        }
        $time=date("Y-m-d",$beginThismonth).' 07:00:00';
    }elseif($param==7){
        if(date('d')==1&&date('H')<7){
            $beginThismonth=mktime(0,0,0,date('m')-2,1,date('Y'));
        }else{
            $beginThismonth=mktime(0,0,0,date('m')-1,1,date('Y'));
        }
        $time=date("Y-m-d",$beginThismonth).' 07:00:00';
    }elseif($param==8){
        if(date('d')==1&&date('H')<7){
            $endThismonth=mktime(0,0,0,date('m')-1,1,date('Y'));
        }else{
            $endThismonth=mktime(0,0,0,date('m'),1,date('Y'));
        }
        $time=date("Y-m-d",$endThismonth-24*3600).' 07:00:00';

    }
    return $time;
}
function form_date_get($param){
    if($param==1){
        if(date('H')<7){
            $date=date("Y-m-d",strtotime("-2 day"));
        }else{
            $date=date("Y-m-d",strtotime("-1 day"));
        }
    }elseif($param==2){
        if(date('H')<7){
            $date=date("Y-m-d",strtotime("-1 day"));
        }else{
            $date=date("Y-m-d");
        }
    }elseif($param==3){
        $date=get_week_start(1);
    }elseif($param==4){
        $date=get_week_start(1,1);
    }elseif($param==5){
        $date=get_week_start(2,1);
    }elseif($param==6){
        if(date('d')==1&&date('H')<7){
            $beginThismonth=mktime(0,0,0,date('m')-1,1,date('Y'));
        }else{
            $beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
        }
        $date=date("Y-m-d",$beginThismonth);
    }elseif($param==7){
        if(date('d')==1&&date('H')<7){
            $beginThismonth=mktime(0,0,0,date('m')-2,1,date('Y'));
        }else{
            $beginThismonth=mktime(0,0,0,date('m')-1,1,date('Y'));
        }
        $date=date("Y-m-d",$beginThismonth);
    }elseif($param==8){
        if(date('d')==1&&date('H')<7){
            $endThismonth=mktime(0,0,0,date('m')-1,1,date('Y'));
        }else{
            $endThismonth=mktime(0,0,0,date('m'),1,date('Y'));
        }
        $date=date("Y-m-d",$endThismonth-24*3600);
    }
    return $date;
}

function getCity($ip)
{
    if($ip){
        $qqwry_filepath = __DIR__ . '/../extend/ip/qqwry.dat';
        $ret = IpLocation::getLocation($ip, $qqwry_filepath);
        return !empty($ret["area"])?$ret["area"]:'';
    }else{
        return '';
    }
}
function get_user_diff($before,$after){
    $res = array_diff_assoc($before,$after);
    $str='编辑会员';
    if(isset($res['username'])){
       $str.=',修改账号';
    }elseif(isset($res['password'])){
        $str.=',修改密码';
    }elseif(isset($res['nickname'])){
        $str.=',修改姓名';
    }elseif(isset($res['login_status'])){
        $str.=',修改登录状态';
    }elseif(isset($res['trade_status'])){
        $str.=',修改交易状态';
    }elseif(isset($res['invite_status'])){
        $str.=',修改邀请状态';
    }elseif(isset($res['invite_number'])){
        $str.=',修改邀请码';
    }elseif(isset($res['agent_id'])){
        $str.=',修改所属代理';
    }elseif(isset($res['pid'])){
        $str.=',修改邀请人';
    }
    return $str;
}
function get_agent_diff($before,$after){
  
    $res = array_diff_assoc($before,$after);
    $str='编辑代理';
    if(isset($res['username'])){
       $str.=',修改账号';
    }elseif(isset($res['password'])){
        $str.=',修改密码';
    }elseif(isset($res['nickname'])){
        $str.=',修改姓名';
    }elseif(isset($res['login_status'])){
        $str.=',修改登录状态';
    }elseif(isset($res['invite_status'])){
        $str.=',修改邀请状态';
    }elseif(isset($res['invite_number'])){
        $str.=',修改邀请码';
    }
    return $str;
}

function get_all_agent($id){
    $where=[];
    $where[]=['p_agent_id','=',$id];
    $where[]=['status','=',1];
    $agent_ids=db::name('agent')->where($where)->field('agent_id')->select();
    $ids=[];
    if($agent_ids){
        foreach($agent_ids as $val){
            $ids[]=$val['agent_id'];
        }
    }
    $ids[]=$id;
    return $ids;
}
/**
 * 获取协议和域名
 * @return string
 */
function get_host(){

    $protocol = $_SERVER['SERVER_PROTOCOL'];
    $protocol_arr = explode('/',$protocol);
    return strtolower($protocol_arr[0]).'://'.$_SERVER['HTTP_HOST'];
}

/**
 * 获取IP地址
 * @return mixed
 */
function get_real_ip(){
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR']) {
        $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $pos = array_search('unknown', $arr);
        if (false !== $pos) {
            unset($arr[$pos]);
        }
        $ip = trim(current($arr));
    } elseif (isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP']) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


/**
 * ajax返回
 * @param $msg
 * @param $data
 * @param int $code
 * @return \think\Response
 */
function ajax_return($msg,$data=[],$code=0){
    $ret = [
        'code'      =>  $code,
        'msg'       =>  $msg,
        'data'      =>  $data,
    ];
    return \think\Response::create($ret,'json');
}

/**
 * 失败状态的返回
 * @param $msg
 * @param $data
 * @return \think\Response
 */
function ajax_return_error($msg,$data=[]){
    return ajax_return($msg,$data,-1);
}

/**
 * 成功状态的ajax
 * @param $msg
 * @param $data
 * @return \think\Response
 */
function ajax_return_success($msg,$data=[]){
    return ajax_return($msg,$data,0);
}


function has_ts_privilege($value,$ts_ids){
    return $count_data_p = Db::name('privilege')->where(['id'=>['IN',$ts_ids],'parent_id'=>-1,'value'=>$value])->count();
}

/**
 * post request
 * @param $url
 * @param $post
 * @return mixed
 */
function post_json($url, $post)
{
    $headers = [
        "Content-type: application/json;charset='utf-8'",
        "Accept: application/json",
        "Cache-Control: no-cache",
        "Pragma: no-cache"
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $s = curl_exec($ch);
    curl_close($ch);
    return $s;
}


function post_request($url, $post)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLINFO_HEADER_OUT, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
//    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $s = curl_exec($ch);
    curl_close($ch);
    return $s;
}



function datetime_to_time($dt){
    if(!empty($dt)){
        return date('H:i:s',strtotime($dt));
    }
    return '';
}


function moneyToString($num)
{
    $digits = ['零', '壹', '贰', '叁', '肆', '伍', '陆', '柒', '捌', '玖'];
    $radices =['', '拾', '佰', '仟', '万', '亿'];
    $bigRadices = ['', '万', '亿'];
    $decimals = ['角', '分'];
    $cn_dollar = '元';
    $cn_integer = '整';
    $num_arr = explode('.', $num);
    $int_str = $num_arr[0]??'';
    $float_str = $num_arr[1]??'';
    $outputCharacters = '';
    if ($int_str) {
        $int_len = strlen($int_str);
        $zeroCount = 0;
        for ($i = 0; $i < $int_len; $i++) {
            $p = $int_len - $i - 1;
            $d = substr($int_str, $i, 1);
            $quotient = $p / 4;
            $modulus = $p % 4;
            if ($d == "0") {
                $zeroCount++;
            }
            else {
                if ($zeroCount > 0)
                {
                    $outputCharacters .= $digits[0];
                }
                $zeroCount = 0;
                $outputCharacters .= $digits[$d] . $radices[$modulus];
            }
            if ($modulus == 0 && $zeroCount < 4) {
                $outputCharacters .= $bigRadices[$quotient];
                $zeroCount = 0;
            }
        }
        $outputCharacters .= $cn_dollar;
    }
    if ($float_str) {
        $float_len = strlen($float_str);
        for ($i = 0; $i < $float_len; $i++) {
            $d = substr($float_str, $i, 1);
            if ($d != "0") {
                $outputCharacters .= $digits[$d] . $decimals[$i];
            }
        }
    }
    if ($outputCharacters == "") {
        $outputCharacters = $digits[0] . $cn_dollar;
    }
    if ($float_str) {
        $outputCharacters .= $cn_integer;
    }
    return $outputCharacters;
}
/**
 * 数据脱敏
 * @param $string 需要脱敏值
 * @param int $start 开始
 * @param int $length 结束
 * @param string $re 脱敏替代符号
 * @return bool|string
 */
function dataDesensitization($string, $start = 0, $length = 0, $re = '*')
{
    if (empty($string)){
        return false;
    }
    $strarr = array();
    $mb_strlen = mb_strlen($string);
    while ($mb_strlen) {//循环把字符串变为数组
        $strarr[] = mb_substr($string, 0, 1, 'utf8');
        $string = mb_substr($string, 1, $mb_strlen, 'utf8');
        $mb_strlen = mb_strlen($string);
    }
    $strlen = count($strarr);
    $begin = $start >= 0 ? $start : ($strlen - abs($start));
    $end = $last = $strlen - 1;
    if ($length > 0) {
        $end = $begin + $length - 1;
    } elseif ($length < 0) {
        $end -= abs($length);
    }
    for ($i = $begin; $i <= $end; $i++) {
        $strarr[$i] = $re;
    }
    if ($begin >= $end || $begin >= $last || $end > $last) return false;
    return implode('', $strarr);
}
//$data = array("name" => "Hagrid", "age" => "36");
//bar('http://127.0.0.1:8080/unicast?uid=5678',json_encode($data));
//总后台:uid=1,代理后台uid='agent'+xxx;用户首页3，未登录交易中心4
//总后台状态码1001：用户下单；1002：用户平仓
//用户状态码101：总后台平仓；102：爆仓;
function bar($uid, $body){
    if($uid){
        $url='http://47.90.122.200:8080/unicast?uid='.$uid;
        $body=json_encode($body);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $body,
            //CURLOPT_PORT =>8080,
            CURLOPT_HTTPHEADER => array(
                "Cache-Control: no-cache",
                'Content-Type: application/json',
                'Content-Length: ' . strlen($body),
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
}
function get_now_price($name){
    $url="http://47.90.122.200:8080/price";
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        //CURLOPT_POSTFIELDS => $body,
        //CURLOPT_PORT =>8080,

        CURLOPT_HTTPHEADER => array(
            "Cache-Control: no-cache",
            'Content-Type: application/json',
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        $info=  json_decode($response,true);
        $price=$info[$name]['USD'];
        return $price;
    }
}
function get_all_price(){
    $url="http://47.90.122.200:8080/price";
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        //CURLOPT_POSTFIELDS => $body,
        //CURLOPT_PORT =>8080,

        CURLOPT_HTTPHEADER => array(
            "Cache-Control: no-cache",
            'Content-Type: application/json',
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        $info=  json_decode($response,true);
        return $info;
    }
}
function json_return($status,$msg,$info='')
{
    $data=[];
    $data['status']=$status;
    $data['msg']=$msg;
    if($info){
        $data['info']=$info;
    }
    return json($data);
}
//平仓更新用户和订单
function save_order($order,$now_price,$type,$direction){
    db::startTrans();
    $where=[];
    $where[]=['status','=',1];
    $where[]=['uid','=',$order['uid']];
    $user=db::name('user')->where($where)->lock(true)->find();
    if($direction==1){
        $profit=($now_price-$order['buy_price'])*$order['hand']*$order['contract']/$order['lever'];
    }else{
        $profit=($order['buy_price']-$now_price)*$order['hand']*$order['contract']/$order['lever'];
    }
    //盈利金额
    //操作用户保证金
    $status=db::name('user')->where('uid',$user['uid'])->setDec('promise_money',$order['money']);
    //操作账户余额
    $status=db::name('user')->where('uid',$user['uid'])->setInc('money',$profit);
    $after=db::name('user')->where('uid',$user['uid'])->find();
    //更新订单状态
    $data=[];
    $data['oid']=$order['oid'];
    $data['sell_price']=$now_price;
    $data['profit']=$profit;
    $data['order_status']=2;
    $data['order_close_type']=$type;
    $data['update_time']=date('Y-m-d H:i:s');
    $status=db::name('order')->update($data);
    if($type==1){
        $remark='用户平仓';
    }elseif($type==2){
        $remark='风险平仓';
    }elseif($type==3){
        $remark='爆仓';
    }elseif($type==4){
        $remark='止盈平仓';
    }elseif($type==5){
        $remark='止损平仓';
    }else{
        $remark='过夜费不足平仓';
    }
    //添加资金记录
    $data=[];
    $data['uid']=$user['uid'];
    $data['username']=$user['username'];
    $data['nickname']=$user['nickname'];
    $data['from_oid']=$order['oid'];
    $data['operation_id']=0;
    $data['before_money']=$user['money'];
    $data['money']=$profit;
    $data['after_money']=$after['money'];
    $data['type']=3;
    $data['type_info']='平仓';
    $data['remark']=$remark.'，结算收益';
    $data['add_time']=date('Y-m-d H:i:s');
    $status=db::name('user_money_log')->insert($data);
    db::commit();
    //给用户发送消息
    $msg=[];
    $msg['status']=101;
    $msg['msg']='您的订单【单号：'.$order['order_sn'].'】，已经'.$remark;
    $msg['oid']=$order['oid'];
    $msg['money']=number_format($after['money'],2,'.','');
    $msg['promise_money']=number_format($after['promise_money'],2,'.','');
    $msg['real_money']=number_format(($after['money']-$after['promise_money']),2,'.','');
    bar($user['uid'],$msg);
}
function cache_night_fee(){
    $where=[];
    $where[]=['status','=',1];
    $product=db::name('product')->where($where)->select();
    $arr=[];
    foreach($product as $val){
        $arr[$val['abbreviation']]=$val['night_fee'];
    }
    cache('product_night_fee',$arr);
}