
<html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<style>
	 body {width:1024px;}
	.boxcontent{width:99%}
	.boxcontent table.detail { border: solid 1px #A7C2E7; margin: 5px 2%; width: 99%; border-collapse: collapse; }
	.boxcontent table.detail thead { color: #407ACA; font-weight: bold; background-color: #FDF9C5; }
	.boxcontent table.detail td { border: solid 1px #A7C2E7; line-height: 22px; text-align: center; padding: 2px; white-space:nowrap;}
	.boxcontent table.detail td.tleft {text-align: center;font-weight:bold}
	.boxcontent table.detail td.tright {text-align: left;}
	.boxcontent table.detail td input {border-width: 0px 0px 1px 0px; border-bottom: dotted 1px gray;}		
	</style>
	</head>

<body>
<form>
<?php
	require_once '../include/common.inc.php';

	$orderno=mysql_real_escape_string($_GET['OrderNo']);
	$verifycode=mysql_real_escape_string($_GET['VerifyCode']);
	$sql="SELECT * FROM  dx_detail where order_no='%s' and verify_code='%s' order by create_date desc";
	$query = sprintf($sql, $orderno,$verifycode);
	mysql_query("SET NAMES UTF8"); 	        
	$result=mysql_query($query);
	$row=mysql_fetch_array($result)

?>
<div style="text-align:center"><h3>订单信息</h3></div>
<div class="boxcontent">
   <table class="detail" style="width:800px">
		<tbody>
			<tr>
				<td class="tleft">日期：</td>
				<td class="tright"><?echo $row[year]."年".$row[month]."月".$row[day]."日"   ?>
				</td>
				<td class="tleft">条码单号：</td>
				<td class="tright"><? echo $row[order_no]?></td>
			</tr>
			<tr>
				<td class="tleft">区域：</td>
				<td class="tright"><? echo $row[region] ?></td>
				<td class="tleft">派货人：</td>
				<td class="tright"><? echo $row[send_by] ?></td>
			</tr>
			<tr>
				<td class="tleft">数量：</td>
				<td class="tright"><? echo $row[count] ?></td>
				<td class="tleft">运费：</td>
				<td class="tright"><? echo $row[fare] ?></td>
		
			</tr>
			<tr>
				<td class="tleft">已付：</td>
				<td class="tright"><? echo $row[payed_amount] ?></td>
				<td class="tleft">付款人：</td>
				<td class="tright"><? echo $row[payed_by] ?></td>
			</tr>
			<tr>
				
				<td class="tleft">验证码：</td>
				<td class="tright"><? echo $row[verify_code] ?></td>
				<td class="tleft">收款人：</td>
				<td class="tright"><? echo $row[receipt_name] ?></td>

			</tr>
			<tr>
				<td class="tleft">帐号名：</td>
				<td class="tright"><? echo $row[receipt_account_name] ?></td>
				<td class="tleft">代收货款：</td>
				<td class="tright"><? echo $row[payment_collection] ?></td>

			</tr>
			<tr>
				<td class="tleft">减货款：</td>
				<td class="tright"><? echo $row[payment_minux] ?></td>
				<td class="tleft">手续费：</td>
				<td class="tright"><? echo $row[fee] ?></td>
			
			<tr>
				<td class="tleft">实际转账：</td>
				<td class="tright"><? echo $row[indeed_transfer_amount] ?></td>
				<td class="tleft">转账日期</td>
				<td class="tright"><?echo $row[transfer_date] ?></td>

			</tr>
			</tr>
			<tr>
				<td  class="tleft">收款日期：</td>
				<td class="tright"><? echo $row[send_date] ?></td>
				<td></td><td></td>
			</tr>
		</tbody>
	</table>
</div>
</body>
</html>

