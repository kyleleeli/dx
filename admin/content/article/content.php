<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
$depth='../';
require_once $depth.'../login/login_check.php';
require_once $depth.'global.func.php';
if($action=="editor"){
	$news_list=$db->get_one("select * from $met_news where id='$id'");
	$news_list['title']=str_replace('"', '&#34;', str_replace("'", '&#39;',$news_list['title']));
	$news_list['ctitle']=str_replace('"', '&#34;', str_replace("'", '&#39;',$news_list['ctitle']));
	if($met_member_use){
		$lev=$met_class[$news_list['class1']][access];
	}
	if(!$news_list)metsave('-1',$lang_dataerror,$depth);
	$class1=$news_list['class1'];
	if($news_list[img_ok]==1){
		$img_ok="checked='checked'";
		$img_ok_display='';
	}else{
		$img_ok="";
		$img_ok_display="none";
	}
	if($news_list[com_ok]==1)$com_ok="checked='checked'";
	if($news_list[top_ok]==1)$top_ok="checked='checked'";
	if($news_list[wap_ok]==1)$wap_ok="checked='checked'";
	$class2x[$news_list[class2]]="selected='selected'";
	$class3x[$news_list[class3]]="selected='selected'";	
}else{
	$class2x[$class2]="selected='selected'";
	$class3x[$class3]="selected='selected'";
	$news_list[class2]=$class2;
	$news_list[issue]=$metinfo_admin_name;
	$news_list[hits]=0;
	$news_list[no_order]=0;
	$news_list[addtime]=$m_now_date;
	$news_list[access]=0;
	$news_list[no_order]=0;
	$lang_editinfo=$lang_addinfo;
	$lev=$met_class[$class1][access];
}
$list_access['access']=$news_list['access'];
require '../access.php';
$listjs=listjs();
$css_url=$depth."../templates/".$met_skin."/css";
$img_url=$depth."../templates/".$met_skin."/images";
include template('content/article/content');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>