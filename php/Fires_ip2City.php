<?php
/**
 * --------------------s.wx141124
 * @param	Fires_ip2City		func	ͨ������ip����ip���ڵ���
			--------��$ip	string	   ipֵ
 * @return $city		string		����ֵ

 * ----------------------------------------------------------------------------e
 */
function  Fires_ip2City($ip) {
	
	$url='http://www.ip138.com/ips138.asp?ip='.$ip.'&action=2';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	//����URL�����Է���curl_init������
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/14.0.835.202 Safari/535.1");
	//����UA
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	//��curl_exec()��ȡ����Ϣ���ļ�������ʽ���أ�������ֱ������� ������ӣ���ʹû��echo,Ҳ���Զ����
	$content = curl_exec($ch);
	//ִ��
	curl_close($ch);
	//�ر�
	//return $content;
	/* preg_match_all("|<li>(.*)</li>|U", $content, $out,PREG_PATTERN_ORDER);
	 return $out;
	$city = $out[1][0];
	$city = str_replace("��վ�����ݣ�","",$city);
	return $city; */
	preg_match('/��վ�����ݣ�(?<mess>(.*))��(.*)<\/li><li>/',$content, $arr);
	//��ѯע������
	if( strripos($arr['mess'],"ʡ")>0 )
		$city=substr($arr['mess'], strripos($arr['mess'],"ʡ")+2, 100);
	elseif( strripos($arr['mess'],"������")>0 )
		$city=substr($arr['mess'], strripos($arr['mess'],"������")+6, 100);//��������Ĵ����� �½�ά���������
	else
		$city=$arr['mess'];
	
	return $city;
}