<?php
/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */


/**
*http请求处理
*/
class HttpUtil 
{
	public static function send($request, $readtimeout, $connectTimeout)
    {
		return self::DoHttp($request->getUrl(), 
							$request->getMethod(), 
							$readtimeout, 
							$connectTimeout,
							$request->getHeaders(), 
							$request->getQuerys()
							);
	}

	/**
	 *请求Request
	 */
	private static function DoHttp($url , $method,   $readtimeout, $connectTimeout, $headers, $querys )
    {
		$response = new HttpResponse();
        $curl = self::InitHttpRequest($url,   $method, $readtimeout, $connectTimeout, $headers, $querys);

		
		$response->setContent(curl_exec($curl));
		$response->setHttpStatusCode(curl_getinfo($curl, CURLINFO_HTTP_CODE));
		$response->setContentType(curl_getinfo($curl, CURLINFO_CONTENT_TYPE));
		$response->setHeaderSize(curl_getinfo($curl, CURLINFO_HEADER_SIZE));	
		curl_close($curl);
		return $response;
    }

	/**
	 *准备请求Request
	 */
	private static function InitHttpRequest($url , $method, $readtimeout, $connectTimeout, $headers, $querys)
	{ 
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_FAILONERROR, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_TIMEOUT, $readtimeout);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $connectTimeout);
		if (strtoupper($method)=="GET") {
			$sb =http_build_query($querys);
			$url .= "?";
			$url .= $sb;
		}else{
			curl_setopt($curl, CURLOPT_POST, 1);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $querys);
		}
		curl_setopt($curl, CURLOPT_URL, $url);
		if (1 == strpos("$".$url, HttpSchema::HTTPS))
		{
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        return $curl;
	}
  
 
}
