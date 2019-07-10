<?php
namespace wxapi;

class Objectt
{
	protected $OtherData=[];
	
    public static function className()
    {
        return get_called_class();
    }

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
    }

    public function __get($name){
    	$getter='get'.$name;
    	if(method_exists($this, $getter)){
    		return $this->$getter();
    	}else if(property_exists($this,$name)){
    		return $this->$name;
    	}else if(isset($this->OtherData[$name])){
    		return $this->OtherData[$name];
    	}
    	return '';
    }
    
    public function __set($name, $value){
    	$setter='set'.$name;
    	if(method_exists($this, $getter)){
    		$this->$getter($value);
    	}/* else if(property_exists($this,$name)){
    		$this->$name=$value;
    	} */else{
    		$this->OtherData[$name]=$value;
    	}
    }
    
}
