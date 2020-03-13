<?php
	include_once 'Util/Autoloader.php';

	$url = "https://route.showapi.com/xxxx-xxxxx";//调用URL,根据情况改变此值
	$showapi_appid="xxxxxxx";
	$showapi_sign="xxxxxxxxxxx";
	$typeId="34";//根据情况改变此值
	$file_path= '/1.jpg';  //根据情况改变此值

    //生成对应文件的base64字符串
    $img_base64 = ShowapiRequest::file_base64($file_path);

	$req = new ShowapiRequest($url,$showapi_appid,$showapi_sign);
	$response=$req->addTextPara("img_base64", $img_base64)
    		  ->addTextPara("typeId", $typeId)
    		  ->post();
	print_r($response->getContent());

?>
	 
	
