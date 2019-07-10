<?php
namespace wxapi\request;

use wxapi\Objectt;
/* 通过code取的AccessToken，用来取用户openid和信息
 *  */
class AccessTokenCodeRequest extends Objectt
{
	private $apiParas = array();
	private $appid;
	private $secret;
	private $code;
	
	public function init(){
		$this->setAppId('');
		$this->setSecret('');
		$this->setCode('');
		$this->apiParas['grant_type'] = 'authorization_code';
	}

	public function getApiMethodName(){
		return "sns/oauth2/access_token";
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
	
	public function setSecret($secret){
		$this->secret = $secret;
		$this->apiParas["secret"] = $secret;
	}
	
	public function getSecret(){
		return $this->secret;
	}

	public function setCode($code){
		$this->code = $code;
		$this->apiParas["code"] = $code;
	}
	
	public function getCode(){
		return $this->code;
	}
	
}
