<?php
	include_once 'Util/Autoloader.php';

	$url = "http://route.showapi.com/xxxx-xxxxx";//调用URL,根据情况改变此值
	$showapi_appid="xxxxxxx";
	$showapi_sign="xxxxxxxxxxx";
	$typeId="34";//根据情况改变此值
	$file_path= '/1.jpg';  //根据情况改变此值
	
	$fp = fopen($file_path,"rb", 0);
	$content = fread($fp,filesize($file_path)); 
    fclose($fp); 
    $img_base64 = base64_encode($content); 

	$req = new ShowapiRequest($url,$showapi_appid,$showapi_sign);
	$response=$req->addTextPara("img_base64", $img_base64)
    		  ->addTextPara("typeId", $typeId)
    		  ->post();
	print_r($response->getContent());
	
	
	 
	
