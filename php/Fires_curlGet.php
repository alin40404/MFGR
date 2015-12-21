<?php
/**
 * --------------------s.wx141124
 * @param	Fires_curlGet		func	ͨ��curl����get��ʽhttp���󣬴���ҳ�淵��ʹ��echo������������������
			----------------��$url		string		url
						$data	  array		�����б�		array('key1'=>'val1', 'key2'=>'val2');
 * @return $output		string		����ֵ
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