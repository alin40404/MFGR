<?php
/********************************

2015-04-20

********************************/

define('_ROOT', '.');
define("_LANMU", 'wy_article');//��Ŀid��

///
include(_ROOT."/include/header.inc.php");

/* s.wx2015/7/22.�������ǩ��ID-------------------------------------------------------------e */
if ( isset($_COOKIE['tk']) ){

	$token = $_COOKIE['tk'];
}else{

	 $token = uniqid('bjq_') . mt_rand(0, 1000);
}
setcookie('tk', $token, time()+3600);
//--e

/* s.wx2015/7/23.ÿ�ν��붼����û��ϴ�δʹ�õ�ͼƬ-------------------------------------------------------------e */
if( !is_object($_wsys_bjq_img) )	make_class('_wsys_bjq_img');
$sql = 'delete from wsys_bjq_img where tb_name="none" and tb_id=0 and token="'.$token.'" and post_date<='.(time()-7200);//����
//$sql = 'delete from wsys_bjq_img where tb_name="none" and tb_id=0 and token="'.$token.'"';
$t_data = $_wsys_bjq_img->query($sql);
//--e


_check('add');
make_class("_wy_article");
make_class("_wy_tags");
$tagnum = $_wy_tags->_listcount("where tag_cat=3 and is_use=1");
$taglist=$_wy_tags->_list(0, $tagnum, "*", "where tag_cat=3 and is_use=1");
//��������ύ��������������û�����
if($_POST['article_cat']==3){
    $id = $_wy_article->_list(0,1,'id');
    
    make_class("_wy_user_actions");
    $_wy_user_actions->add( array('uid'=>$uid, 'action_type'=>$article_cat, 'link_table'=>'wy_article', 'link_id'=>($id[0]['id'])+1) );
}
//
if($check_array && in_array('week', $check_array)){
	@include("../week_info.php");

	$_r[year] = date("Y", time());
	$_r[week] = date("W", time());
}

if($confirm == 1){
	//
	$post_info = $_POST;

	if(empty($post_info)) _s('', 'û���ύ����', 'wy_article_add.php');

	$keys = array('uid', 'type', 'article_cat', 'title', 'content', 'tag', 'photo_tag', 'review', 'view', 'comment_num', 'praise_num', 'sort_order', 'face_pic','keys','is_top','is_hide');

	if(isset($keys[city_quhao])) _check_city($_POST);
	
	if($check_array && in_array('week', $check_array)){
		$post_info[week] = substr($_POST[week],4,2);
		$post_info[year] = substr($_POST[week],0,4);
	}

	$post_info = array_copy($keys, $post_info);

	////����ʱ��
	foreach($post_info as $k => $v){
		if(eregi("_time", $k)) $post_info[$k] = $v ? strtotime($v) : 0;
	}
	////

	

	make_class("_upload");
	
	$u = 1;

	if(empty($post_info[face_pic]) && !empty($HTTP_POST_FILES['upload_file_name']['tmp_name'][$u]) && $HTTP_POST_FILES['upload_file_name']['tmp_name'][$u] != "none"){
		  $HTTP_POST_FILES['upload_file']['name'] = $HTTP_POST_FILES['upload_file_name']['name'][$u];
		  $HTTP_POST_FILES['upload_file']['type'] = $HTTP_POST_FILES['upload_file_name']['type'][$u];
		  $HTTP_POST_FILES['upload_file']['tmp_name'] = $HTTP_POST_FILES['upload_file_name']['tmp_name'][$u];
		  $HTTP_POST_FILES['upload_file']['error'] = $HTTP_POST_FILES['upload_file_name']['error'][$u];
		  $HTTP_POST_FILES['upload_file']['size'] = $HTTP_POST_FILES['upload_file_name']['size'][$u];

		  if(eregi("pic", "face_pic") && !eregi("\.jpg$", $HTTP_POST_FILES['upload_file']['name']) && !eregi("\.gif$", $HTTP_POST_FILES['upload_file']['name']) && !eregi("\.jpeg$", $HTTP_POST_FILES['upload_file']['name'])) _s('', '���ϴ��Ĳ���ͼƬ��ʽ��', "wy_article_add.php?id=$id");

		  //���ƴ�С,���ܳ���1M
		  if(eregi("pic", "face_pic") && $HTTP_POST_FILES['upload_file']['size'] > 1024*1024){
			  _s('', '���ϴ���ͼƬ����1M,��ѹ�����ϴ���', "wy_article_add.php?id=$id");

		  }

		  //wx150420.��ά���ϴ�Ŀ¼
			//$post_info[face_pic] = _UPLOAD_DIR_HTTP . "/" . date("Y_m", time()) . "/" .  $_upload->upload_file("upload_file");//original
				//new
			$t_file_name = date("Y_m_d", time()) . '_' . uniqid() . rand() . '.jpg';
			$post_info[face_pic] = date("Y_m", time()) . "/" .  $_upload->upload_file("upload_file", $t_file_name, '', 2);

	}


	//in_array('pid', $check_array) || 
	if((in_array('company_id', $check_array)) && (in_array('year', $check_array) || in_array('name', $check_array))){
		
		$sql_add = "WHERE 1";
		if(in_array('pid', $check_array)) $sql_add .= " and pid='".$post_info[pid]."'";
		if(in_array('company_id', $check_array)) $sql_add .= " and company_id='".$post_info[company_id]."'";

		if(in_array('year', $check_array)){
			$sql_add .= " and year='".$post_info[year]."'";
		}
		if(in_array('name', $check_array)){
			$sql_add .= " and binary name='".mysql_escape_string($post_info[name])."'";
		}
		if(in_array('month', $check_array)){
			$sql_add .= " and month='".$post_info[month]."'";
		}
		if(in_array('day', $check_array)){
			$sql_add .= " and day='".$post_info[day]."'";
		}

		if(in_array('week', $check_array)){
			$sql_add .= " and week='".$post_info[week]."'";
		}

		if(in_array('shop_id', $check_array)){
			$sql_add .= " and shop_id='".$post_info[shop_id]."'";
		}

		if(in_array('member_id', $check_array)){
			$sql_add .= " and member_id='".$post_info[member_id]."'";
		}

		if($_wy_article->_listcount($sql_add)){
			_s('', '���ظ�����', 'wy_article_add.php');
		}
	}




	if(isset($post_info[mubiao_lv])) $post_info[mubiao_lv] = $post_info[mubiao_num] ? ($post_info[num]*100/$post_info[mubiao_num]) : 0;


	$post_info[post_date] = time();

$allcontent=stripslashes($post_info[content]);

	$bigarray=s_img($allcontent);
	if($bigarray){
		$post_info[editor_ori_src]=join(",",$bigarray);
		$smallpic=array();
		foreach($bigarray as $value){
			$ext=strrchr($value, '.');
			$smallpic[]=substr($value,0,strrpos($value,"."))."_s126".$ext;
		}
		$post_info[editor_small_src]=join(",",$smallpic);
	}

	$seodes=strip_tags($post_info[content]);
	$post_info[des]=mb_substr($seodes,0,80,'gbk');

	$post_info[tag]=join(",",$_POST[tag]);


	//if(isset($post_info[uid])) $post_info[uid] = $_member->id;
	if(isset($post_info[username])) $post_info[username] = $_member->username;
	if(isset($post_info[admin_username])) $post_info[admin_username] = $_member->username;
	if(isset($post_info[last_update])) $post_info[last_update] = time();

	$_wy_article->add($post_info);

/*
	//�����Ӵ���
	$lines = split("\n", $post_info[name]);
	foreach($lines as $name){
		$name = trim($name);
		$name = str_replace("\r", "", $name);
		if(!$name) continue;
		$post_info[name] = $name;

		$_wy_article->add($post_info);
	}
*/

	_s('�ɹ�', '���ӳɹ���', 'wy_article_list.php');

}


//
//$cat_select = _select(0,'cat', $);
//$cat_select = $_->parent_drop_down(0,'pid');


function s_img($str){
	$img_path=array();
    preg_match_all("/<img.*\>/isU",$str,$ereg);//��ͼƬ��<img��������ȡ������ 
	foreach($ereg[0] as $v){
		$img=$v;//ͼƬ 
		$p="#src=('|\")(.*)('|\")#isU";
		preg_match_all ($p, $img, $img1); 
	   $img_path[] =$img1[2][0];
	}
    //$img_path =$img1[2];
    return $img_path; 
}

include template('admin_header');

if ( $_GET['abc'] ){
	include template("wy_article_add_1");
}else{
	
	include template("wy_article_add");
}
?>