<?php
/**
 * --------------------s.wx141124
 * @param	Fires_ip2City		func	通过传递ip返回ip所在地区
			--------》$ip	string	   ip值
 * @return $city		string		返回值

 * ----------------------------------------------------------------------------e
 */
function  Fires_ip2City($ip) {
	
	$url='http://www.ip138.com/ips138.asp?ip='.$ip.'&action=2';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	//设置URL，可以放入curl_init参数中
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/14.0.835.202 Safari/535.1");
	//设置UA
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	//将curl_exec()获取的信息以文件流的形式返回，而不是直接输出。 如果不加，即使没有echo,也会自动输出
	$content = curl_exec($ch);
	//执行
	curl_close($ch);
	//关闭
	//return $content;
	/* preg_match_all("|<li>(.*)</li>|U", $content, $out,PREG_PATTERN_ORDER);
	 return $out;
	$city = $out[1][0];
	$city = str_replace("本站主数据：","",$city);
	return $city; */
	preg_match('/本站主数据：(?<mess>(.*))市(.*)<\/li><li>/',$content, $arr);
	//查询注意事项
	if( strripos($arr['mess'],"省")>0 )
		$city=substr($arr['mess'], strripos($arr['mess'],"省")+2, 100);
	elseif( strripos($arr['mess'],"自治区")>0 )
		$city=substr($arr['mess'], strripos($arr['mess'],"自治区")+6, 100);//特殊情况的处理，如 新疆维吾尔自治区
	else
		$city=$arr['mess'];
	
	return $city;
}