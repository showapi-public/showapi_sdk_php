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

	//方式1
	$response=$req->addTextPara("typeId", $typeId)
		->addTextPara("img_base64", $img_base64)
		->post();

	//方式2
	$response=$req->addTextPara("typeId", $typeId)
		->addBase64Para("img_base64", $file_path)
		->post();

	print_r($response->getContent());

?>
	 
	
