<?php 
require_once '../include/common.inc.php';
require_once '../member/login_check.php';

 
function isAdmin($member_name)
{
	return $member_name=="admin";
}

function isPaymentAdmin($member_name)
{
    return $member_name=='payadmin';
}
function isToday($date_str)
{
    return date('Ymd') == date('Ymd', strtotime($date_str));
}
?>
<style>
	 body {width:1024px;}
	.boxcontent{width:80%}
	.boxcontent table.detail { border: solid 1px #A7C2E7; margin: 5px 2%; width: 85%; border-collapse: collapse; }
	.boxcontent table.detail thead { color: #407ACA; font-weight: bold; background-color: #FDF9C5; }
	.boxcontent table.detail td { border: solid 1px #A7C2E7; line-height: 22px; text-align: center; padding: 2px; white-space:nowrap;}
	.boxcontent table.detail td.tleft {text-align: left;}
	.boxcontent table.detail td.tright {text-align: right;}
	.boxcontent table.detail td input {border-width: 0px 0px 1px 0px; border-bottom: dotted 1px gray;}		
	</style>
<a href="/">网站首页</a>
<?if(isAdmin($metinfo_member_name)){
    echo '<a href="addcustomer.php">添加客户</a>
    <a href="customerlist.php">客户信息列表</a>&nbsp&nbsp';
}
?>
<a href="addorder1.php">添加订单</a>

<a href="orderlist.php">订单查询</a>

<a href="addreturn.php">添加退货</a>

<a href="returnlist.php">退货查询</a>

当前帐号:<?echo $metinfo_member_name?> <a href="../member/login_out.php">退出</a>
<hr/>
<link href="scripts/jqueryui/jquery.ui.all.css"  rel="stylesheet" type="text/css" />
<script src="scripts/jquery-1.8.3.js"></script>
<script src="scripts/jquery-ui-1.8.11.js"></script>
<script language="javascript">
jQuery(function($){
     $.datepicker.regional['zh-CN'] = {
        clearText: '清除',
        clearStatus: '清除已选日期',
        closeText: '关闭',
        closeStatus: '不改变当前选择',
        prevText: '<上月',
        prevStatus: '显示上月',
        prevBigText: '<<',
        prevBigStatus: '显示上一年',
        nextText: '下月>',
        nextStatus: '显示下月',
        nextBigText: '>>',
        nextBigStatus: '显示下一年',
        currentText: '今天',
        currentStatus: '显示本月',
        monthNames: ['一月','二月','三月','四月','五月','六月', '七月','八月','九月','十月','十一月','十二月'],
        monthNamesShort: ['一','二','三','四','五','六', '七','八','九','十','十一','十二'],
        monthStatus: '选择月份',
        yearStatus: '选择年份',
        weekHeader: '周',
        weekStatus: '年内周次',
        dayNames: ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],
        dayNamesShort: ['周日','周一','周二','周三','周四','周五','周六'],
        dayNamesMin: ['日','一','二','三','四','五','六'],
        dayStatus: '设置 DD 为一周起始',
        dateStatus: '选择 m月 d日, DD',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        initStatus: '请选择日期',
        isRTL: false};
        $.datepicker.setDefaults($.datepicker.regional['zh-CN']);
    });
</script>







