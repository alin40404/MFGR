<?php
/**
 * --------------------s.wx141124
 * @param	Fires_curlGet		func	通过curl发送get方式http请求，处理页面返回使用echo本方法才能正常接收
			----------------》$url		string		url
						$data	  array		参数列表		array('key1'=>'val1', 'key2'=>'val2');
 * @return $output		string		返回值
 * ----------------------------------------------------------------------------e
 */
function Fires_curlGet($url, $data=null) {
		
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		
	if (!empty($data)) {
			
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	}
		
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($curl);
	curl_close($curl);
	return $output;
}