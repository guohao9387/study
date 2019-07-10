<?php
namespace Controller;

use Think\Controller;
use wxapi\WxClient;
use wxapi\request\AccessTokenRequest;
//use wxapi\post\QrcodeCreatePost;
use wxapi\request\GetWechatCodeRequest;
use wxapi\request\AccessTokenCodeRequest;

class WxqrsController extends Controller {
	
	public function index(){
		$WxClient =new WxClient();
		$WxClient->appID='wx557a273037dc4798';
		$WxClient->appsecret='ad9e59ed7018323f45c197b765b9f692';
		
		if(!isset($_GET['code'])){
			$req = new GetWechatCodeRequest();
			$req->setAppId($WxClient->appID);
			$req->setScope(GetWechatCodeRequest::SNSAPI_USERINFO);
			$url=$req->run();
			header('location:'.$url);
			return ;
		}else{
			$req = new AccessTokenCodeRequest();
			$req->setAppId($WxClient->appID);
			$req->setSecret($WxClient->appsecret);
			$req->setCode($_GET['code']);
			$resp=$WxClient->execute($req);
		}
		echo '<pre>';
		print_r($resp);
	}
		
}