<?php
include_once 'Util/Autoloader.php';

class ShowapiRequest
{
	protected  $url;
	protected  $showapi_appid ;
	protected  $showapi_sign ;
	protected  $querys = array();
	protected  $files = array();

	
	function  __construct( $url,$showapi_appid,$showapi_sign  )
	{
		$this->url=$url;
		$this->showapi_appid = $showapi_appid;
		$this->showapi_sign = $showapi_sign;
		$this->addTextPara("showapi_appid",$showapi_appid)  ;
		$this->addTextPara("showapi_sign",$showapi_sign)  ;
	}
	
	public function addTextPara($key, $value)
	{
		$this->querys[$key] = $value;
		return $this;
	}
	
	public function addFilePara($key, $path)
	{
        if(version_compare(PHP_VERSION, '5.5.0') >= 0) {
            $this->querys[$key] = new CURLFile($path);
        } else {
            $this->querys[$key] = '@' .$path;
        }
		return $this;
	}

	/**
	*method=GET请求示例
	*/
    public function get() {
    	//echo ($this->host."\r\n");
    	//echo ($this->path."\r\n");
    	$request= new HttpRequest($this->url ,  HttpMethod::GET );
    	foreach ($this->querys as $itemKey => $itemValue) {
			 	//print_r($itemKey."    ".$itemValue."\r\n");
			 	$request->setQuery($itemKey, $itemValue);
		}
		$response = HttpClient::execute($request);
        return  $response;
	}

	/**
	*method=POST且是表单提交，请求示例
	*/
	public function post() {
		$request =  new HttpRequest($this->url,  HttpMethod::POST );
		foreach ($this->querys as $itemKey => $itemValue) {
    			//print_r($itemKey."    ".$itemValue."\r\n");
			 	$request->setQuery($itemKey, $itemValue);
		}
		$response = HttpClient::execute($request);
        return  $response;
	}

	 
	
	 
}