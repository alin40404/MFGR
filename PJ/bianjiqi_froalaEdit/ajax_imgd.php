<?php
/* s.wx2015/7/18.¿çÓò´«Êä-------------------------------------------------------------e */
header( 'Access-Control-Allow-Origin:*' ); 
//--e
define('_ROOT', '.');
if ( !defined('T_IMG_ROOT') )	define('T_IMG_ROOT', str_replace ( '\\', '/', dirname( dirname( __FILE__ ) ) . '/' ) );

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

$token = isset($_GET['tk']) ? $_GET['tk'] : '';
$t_src = isset($_POST['src']) ? check_str($_POST['src']) : '';

if( !is_object($_wsys_bjq_img) )	make_class('_wsys_bjq_img');
$t_con = 'where token="'.$token.'" and img="'.$t_src.'"';
$t_data = $_wsys_bjq_img->_list(0, 1, 'id', $t_con);

if ( count($t_data)==1 ){
	
	
	$t_path = T_IMG_ROOT . 'imgdata/htmlimg/'.date('Ymd').'/';
	$t_path .= basename($t_src);
	//$t_path = './upload/'.basename($t_src);
	@unlink($t_path);
	$_wsys_bjq_img->del($t_data[0]['id']);
}

//$t_arr = array();
//$t_arr['info'] = $t_info;
//$t_arr['src'] = $t_src;

/* s.wx2015/7/21.debug-------------------------------------------------------------e */
//$t_file_main_dir =  './upload/debug.txt';
//$handle = fopen($t_file_main_dir, 'a+');

//$file_info_str = date('Y-m-d H:i:s') . ': ' . serialize($t_arr) . "\r\n";
 //fwrite($handle, $file_info_str);
 
 //fclose($handle);
 //--e

exit;