<?php
/**
 * --------------------s.wx2015/7/29
 * @param	writeInFile_Debug	func		将指定的内容输出到相应的文件
			----------------》$info		mixed		输出到文件中的内容
						$type		string		输出数据的类型
						------》'text'	默认		文本类型
								'json'	json格式类型，传递进来的一定是数组
								'serialize'	序列化类型
						$fname	string	指定的文件名，为空默认值时，将会生成默认的文件名
						$fpath	string	指定的存储路径，为默认值空时，将会生成默认的存储路径
 * 
 * ----------------------------------------------------------------------------e
 */
function writeInFile_Debug($info, $type='text', $fname='', $fpath=''){

	if ( $fname )	$t_fname=$fname;	 else	$t_fname='debug.txt';
	if ( $fpath )	$t_fpath=$fpath;	else $t_fpath='./upload/'; 
	
	$t_fdir =  $fpath . $fname;//保存文件的全路径

	$handle = fopen($t_fdir, 'a+');
	
	$file_info_str = date('Y-m-d H:i:s') . ': ';
	switch ( $type ){
		
		case 'text':
			$file_info_str .= $info .  "\r\n";//\r\n一定要用双引号""包裹
			break;
		case 'json':
			$file_info_str .= json_encode($info) .  "\r\n";
			break;
		case 'serialize':
			$file_info_str .= serialize($info) .  "\r\n";
			break;
	}
	
	fwrite($handle, $file_info_str);
	fclose($handle);
}
