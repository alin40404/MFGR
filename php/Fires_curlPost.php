<?php
/**
 * --------------------s.wx150228
 * @param	Fires_curlPost	func	ͨ��curl����post��ʽhttp���󣬴���ҳ�淵��ʹ��echo������������������
					 ----------------��$uri		string		url
								$data		array		�����б�		array('key1'=>'val1', 'key2'=>'val2');
 * @return $return		string		����ֵ
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