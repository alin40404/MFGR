<?php
/**
 * --------------------s.wx150228
 * @param	Fires_curlPost	func	通过curl发送post方式http请求，处理页面返回使用echo本方法才能正常接收
					 ----------------》$uri		string		url
								$data		array		参数列表		array('key1'=>'val1', 'key2'=>'val2');
 * @return $return		string		返回值
 * ----------------------------------------------------------------------------e
 */
function Fires_curlPost($uri, $data=null){
	
	$ch = curl_init ();
	// print_r($ch);
	curl_setopt ( $ch, CURLOPT_URL, $uri );
	curl_setopt ( $ch, CURLOPT_POST, 1 );
	curl_setopt ( $ch, CURLOPT_HEADER, 0 );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
	$return = curl_exec ( $ch );
	curl_close ( $ch );

	return $return;
}