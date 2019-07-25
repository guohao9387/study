<?php
namespace wxapi\request;

use wxapi\Objectt;
/* 
 *  */
class GetWechatCodeRequest extends Objectt
{
	const SNSAPI_BASE="snsapi_base";
	const SNSAPI_USERINFO="snsapi_userinfo";
	private $apiParas = array();
	private $appid;
	private $redirect_uri;
	private $scope;
	private $state;
	
	public function init(){
		$this->setResponseType();
		$this->setRedirectUri();
		//$this->apiParas['#'] = 'wechat_redirect';
	}
	
	public function run(){
		//获取业务参数
		$apiParams = $this->getApiParas();
		$arr['appid']=$apiParams['appid'];
		$arr['redirect_uri']=$apiParams['redirect_uri'];
		$arr['response_type']=$apiParams['response_type'];
		$arr['scope']=$apiParams['scope'];
	
		//系统参数放入GET请求串
		$requestUrl =$this->getApiMethodName()   . "?";
		
		$str='';
		foreach ($arr as $key=>$val){
			$str.=$key.'='.$val.'&';
		}
		$str=rtrim($str,'&').'#wechat_redirect';
	
		return $requestUrl.$str;
	}

	public function getApiMethodName(){
		return "https://open.weixin.qq.com/connect/oauth2/authorize";
	}
	
	public function getApiParas(){
		return $this->apiParas;
	}

	public function putOtherTextParam($key, $value){
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}

	public function setAppId($appid){
		$this->appid = $appid;
		$this->apiParas["appid"] = $appid;
	}
	
	public function getAppId(){
		return $this->appid;
	}
	
	public function setRedirectUri(){
		//$this->redirect_uri=urlEncode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
		$this->redirect_uri=urlencode('http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
		$this->apiParas["redirect_uri"] = $this->redirect_uri;
	}
	
	public function setResponseType(){
		$this->apiParas["response_type"] = 'code';
	}
	
	public function setScope($scope){
		$this->scope = $scope;
		$this->apiParas["scope"] = $scope;
	}
	
	public function getScope(){
		return $this->scope;
	}

	public function setState($state){
		$this->state = $state;
		$this->apiParas["state"] = $state;
	}
	
	public function getState(){
		return $this->state;
	}
	
}
