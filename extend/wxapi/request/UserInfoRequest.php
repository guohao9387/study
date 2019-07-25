<?php
namespace wxapi\request;
use wxapi\Object;
/* 通过code取的AccessToken，用来取用户openid和信息
 *  */
class UserInfoRequest extends Object
{
	private $apiParas = array();
	
	public function init(){
		$this->setLang("zh_CN");
	}

	public function getApiMethodName(){
		return "sns/userinfo";
	}
	
	public function getApiParas(){
		return $this->apiParas;
	}

	public function putOtherTextParam($key, $value){
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}

	public function setAccessToken($access_token){
		$this->apiParas["access_token"] = $access_token;
	}
	
	public function setOpenid($openid){
		$this->apiParas["openid"] = $openid;
	}
	
	public function setLang($lang){
		$this->apiParas["lang"] = $lang;
	}
	
}
