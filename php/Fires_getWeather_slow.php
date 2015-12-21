<?php
/**
 * --------------------s.wx150228
 * @param	Fires_getWeather_slow		func	���ָ�����е�����(�÷����Ƚ���)
							-----��$city	string	 ��������
 * @return		string			�����������е�������Ϣ
 * ----------------------------------------------------------------------------e
 */
function Fires_getWeather_slow($city) {
	
	$cityUrl = "http://evenle.com/wei/20130921/city.php";
//		var_dump(file_get_contents($cityUrl));
	$web = json_decode( file_get_contents($cityUrl) );
//		var_dump($web);
	$arr=array();
	foreach($web as $k=>$w){
		if( is_object($w) ) $arr[$k]=json_to_array($w); //�ж������ǲ���object
		else $arr[$k] = $w;
	}
	
	if( $t_pos=strpos($city, '��') )	$city=substr($city, 0, $t_pos);
//		var_dump($arr[$city]);
	
	$cityId = $arr[$city];
	$url = "http://m.weather.com.cn/data/".$cityId.".html";
//		var_dump($url);
//		exit;
	$weather = json_decode( file_get_contents($url) );
	return json_encode($weather);
}