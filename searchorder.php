<?php

$index="index";
require_once 'include/common.inc.php';
require_once 'include/head.php';
$index = $db->get_one("SELECT * FROM $met_index where lang='$lang' order by id desc");
$index[index]='index';
$index[news_no]=$index_news_no;
$index[product_no]=$index_product_no;
$index[download_no]=$index_download_no;
$index[img_no]=$index_img_no;
$index[job_no]=$index_job_no;
$index[link_ok]=$index_link_ok;
$index[link_img]=$index_link_img;
$index[link_text]=$index_link_text;
$show['description']=$met_description;
$show['keywords']=$met_keywords;
require_once 'public/php/methtml.inc.php';
if($met_indexskin=="" or (!file_exists("templates/".$met_skin_user."/".$met_indexskin.".".$dataoptimize_html)))$met_indexskin='searchorder';
include template($met_indexskin);
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
