<?php
	include_once 'Util/Autoloader.php';

	$url = "http://route.showapi.com/xxxx-xxxxx";//调用URL,根据情况改变此值
	$METHOD = "POST";//或者是GET,根据情况改变此值
	$showapi_appid="xxxxx";
	$showapi_sign="xxxxxxxx";
	$text="这是一段测试的文本";  //根据情况改变此值
	$num="3"; //根据情况改变此值
	$req = new ShowapiRequest($url,$showapi_appid,$showapi_sign);
	$response=$req->addTextPara("text", $text)
    		  ->addTextPara("num", $num)
    		  ->get();
	print_r($response->getContent());
	
