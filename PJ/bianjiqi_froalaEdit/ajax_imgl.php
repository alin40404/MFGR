<?php
/********************************

2015-04-20

********************************/
/* s.wx2015/7/18.¿çÓò´«Êä-------------------------------------------------------------e */
header( 'Access-Control-Allow-Origin:*' ); 
//--e

$token = isset($_GET['tk']) ? $_GET['tk'] : '';

$token = check_str($token);

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

if( !is_object($_wsys_bjq_img) )	make_class('_wsys_bjq_img');

$t_con = 'where token="'.$token.'" and post_date>='.(time()-7200);//Î´¹ýÆÚ
//$t_con = 'where token="'.$token.'"';
//$t_con = 'where token="bjq_55af595976f09742"';
$t_data = $_wsys_bjq_img->_list(0, 40, '*', $t_con);

if ( !empty($t_data) ){

	$re_arr = array();
	foreach( $t_data as $k=>$v ){
	
		$re_arr[] = $v['img'];
	}
	/* s.wx2015/7/21.debug-------------------------------------------------------------e */
	//$t_file_main_dir =  './upload/debug.txt';
	//$handle = fopen($t_file_main_dir, 'a+');

	//$file_info_str = date('Y-m-d H:i:s') . ': ' . $t_str . "\r\n";
	 //fwrite($handle, $file_info_str);
	 
	 //fclose($handle);
	 //--e
	echo json_encode($re_arr);
}

exit;