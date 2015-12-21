<?php
/**
 * --------------------s.wx2015/7/29
 * @param	writeInFile_Debug	func		��ָ���������������Ӧ���ļ�
			----------------��$info		mixed		������ļ��е�����
						$type		string		������ݵ�����
						------��'text'	Ĭ��		�ı�����
								'json'	json��ʽ���ͣ����ݽ�����һ��������
								'serialize'	���л�����
						$fname	string	ָ�����ļ�����Ϊ��Ĭ��ֵʱ����������Ĭ�ϵ��ļ���
						$fpath	string	ָ���Ĵ洢·����ΪĬ��ֵ��ʱ����������Ĭ�ϵĴ洢·��
 * 
 * ----------------------------------------------------------------------------e
 */
function writeInFile_Debug($info, $type='text', $fname='', $fpath=''){

	if ( $fname )	$t_fname=$fname;	 else	$t_fname='debug.txt';
	if ( $fpath )	$t_fpath=$fpath;	else $t_fpath='./upload/'; 
	
	$t_fdir =  $fpath . $fname;//�����ļ���ȫ·��

	$handle = fopen($t_fdir, 'a+');
	
	$file_info_str = date('Y-m-d H:i:s') . ': ';
	switch ( $type ){
		
		case 'text':
			$file_info_str .= $info .  "\r\n";//\r\nһ��Ҫ��˫����""����
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
