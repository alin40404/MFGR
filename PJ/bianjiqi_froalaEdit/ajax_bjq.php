<?php
/* s.wx2015/7/18.¿çÓò´«Êä-------------------------------------------------------------e */
header( 'Access-Control-Allow-Origin:*' ); 
//--e

$file_info = isset($_FILES['file']) ? $_FILES['file'] : 'none';
$token = isset($_GET['tk']) ? check_str($_GET['tk']) : '';

if ( !$token ){

	return;
}

define('_ROOT', '.');

/* s.wx2015/7/17.common-------------------------------------------------------------e */
include(_ROOT."/include/header.inc.php");
//--e

/* s.wx2015/7/22.func-------------------------------------------------------------e */
function check_str($var){

	$var = str_replace(" ", "", $var);
	$var = str_replace("'", "", $var);
	$var = str_replace("\"", "", $var);

	return $var;
}
//--e

/* s.wx2015/7/21.debug-------------------------------------------------------------e */
//$t_file_main_dir =  './upload/debug.txt';
//$handle = fopen($t_file_main_dir, 'a+');

//$file_info_str = date('Y-m-d H:i:s') . ': ' . serialize($file_info) . "\r\n";
 //fwrite($handle, $file_info_str);
 
 //fclose($handle);
 //--e

//$t_path = './upload/';

if ( !defined('T_IMG_ROOT') )	define('T_IMG_ROOT', str_replace ( '\\', '/', dirname( dirname( __FILE__ ) ) . '/' ) );
$t_path = T_IMG_ROOT . 'imgdata/htmlimg/'.date('Ymd').'/';

if ( !is_dir($t_path) ){
	mkdir($t_path, 0777);
	chmod($t_path, 0777);
}

$t_img_name = 'bj'.date('Y_m_d_H_i_s').'.jpg';
$image_name = $t_path . $t_img_name;
if ( move_uploaded_file($file_info['tmp_name'], $image_name) ){

	$re = array();
	//$re['link'] = 'http://sys.wy100.com/sys/upload/'.$t_img_name;
	$re['link'] = 'http://img.wayes.cn/wayes_sys/imgdata/htmlimg/'.date('Ymd').'/'.$t_img_name;

	if( !is_object($_wsys_bjq_img) )	make_class('_wsys_bjq_img');
	$t_data = array('token'=>$token, 'img'=>$re['link'], 'tb_name'=>'none', 'post_date'=>time());
	$_wsys_bjq_img->add($t_data);

	echo json_encode($re);
}
exit;