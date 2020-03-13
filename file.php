<?php
	include_once 'Util/Autoloader.php';

	$url = "https://route.showapi.com/xxxx-xxxxx";//调用URL,根据情况改变此值
	$METHOD = "POST";
	$showapi_appid="xxxxxxx";
	$showapi_sign="xxxxxxxx";
	$filePath = '/1.jpg';//根据情况改变此值
	$typeId="34"; //根据情况改变此值
	
	
	$req = new ShowapiRequest($url,$showapi_appid,$showapi_sign);
	$response=$req->addTextPara("typeId", $typeId)
    		  ->addFilePara("image", $filePath)
    		  ->post();
	print_r($response->getContent());
?>
