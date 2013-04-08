
<html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	</head>
<body>
<form method="POST" action="submitorder.php?action=edit">
<?php
	require_once './header.php';

	$orderno=mysql_real_escape_string($_GET['orderno']);
	$sql="SELECT * FROM  dx_detail where order_no='%s' order by create_date desc";
	$query = sprintf($sql, $orderno);
	mysql_query("SET NAMES UTF8"); 	        
	$result=mysql_query($query);
	$row=mysql_fetch_array($result)

?>
	<table style="width:80%">
		<tbody>
			<tr><td>订单信息</td></tr>
			<tr>
				<td>日期：</td>
				<td>
				    <input type="text" id="txtMonth" value="2013"  style="width:50px" name="Year" value="<? echo $row[year] ?>"/>年
				   <select  id="txtMounth" name="Month">
					<options>
					<?
					 for(;$index<13;$index++){
						if($index==$row[month] ){						
							echo "<option value='".$index."' selected='selected'>".$index."</option>";

						}else{
							echo "<option value='".$index."'>".$index."</option>";
						}
					 }
					?>
					</options>	
				</select>月
				<input type="text" id="txtDay"  style="width:50px" name="Day" value="<? echo $row[day] ?>"/>日
				</td>
				<td>条码单号：</td>
				<td><? echo $row[order_no]?><input type="hidden" id="txtOrderNo" name="OrderNo" value="<? echo $row[order_no] ?>"/></td>
			</tr>
			<tr>
				<td>区域：</td>
				<td><input type="text" id="txtRegion" name="Region" value="<? echo $row[region] ?>"/></td>
				<td>派货人：</td>
				<td><input type="text" id="txtSendBy" name="SendBy" value="<? echo $row[send_by] ?>"/></td>
			</tr>
			<tr>
				<td>数量：</td>
				<td><input type="text" id="txtCount" name="Count" value="<? echo $row[count] ?>"/></td>
				<td>运费：</td>
				<td><input type="text" id="txtFare" name="Fare" value="<? echo $row[fare] ?>"/></td>
		
			</tr>
			<tr>
				<td>已付：</td>
				<td><input type="text" id="txtPayedAmount" name="PayedAmount" value="<? echo $row[payed_amount] ?>"/></td>
<td>付款人：</td>
				<td><input type="text" id="txtPayedBy" name="PayedBy" value="<? echo $row[payed_by] ?>"/></td>
			</tr>
			<tr>
				
				<td>验证码：</td>
				<td><input type="text" id="txtVerifyCode" name="VerifyCode" value="<? echo $row[verify_code] ?>"/></td>
				<td>收款人：</td>
				<td><input type="text" id="txtReceiptName" name="ReceiptName" value="<? echo $row[receipt_name] ?>"/></td>

			</tr>
			<tr>
				<td>帐号名：</td>
				<td><input type="text" id="txtReceiptAccountName" name="ReceiptAccountName" value="<? echo $row[receipt_account_name] ?>"/></td>
				<td>代收货款：</td>
				<td><input type="text" id="txtPaymentCollection" name="PaymentCollection" value="<? echo $row[payment_collection] ?>"/></td>

			</tr>
			<tr>
				<td>减货款：</td>
				<td><input type="text" id="txtPaymentMinus" name="PaymentMinus" value="<? echo $row[payment_minux] ?>"/></td>
				<td>手续费：</td>
				<td><input type="text" id="txtFee" name="Fee" value="<? echo $row[fee] ?>"/></td>
			
			<tr>
				<td>实际转账：</td>
				<td><input type="text" id="txtIndeedTransferAmount" name="IndeedTransferAmount" value="<? echo $row[indeed_transfer_amount] ?>"/></td>
				<td>转账日期：</td>
				<td><input type="text" id="txtTransferDate" name="TransferDate" value="<? echo $row[transfer_date] ?>"/></td>

			</tr>
			</tr>
			<tr>
				<td>收款日期：</td>
				<td><input type="text" id="txtSendDate" name="SendDate" value="<? echo $row[send_date] ?>"/></td>
			</tr>
			<tr>
				<td><input type="submit" value="提交" />
				<input type="reset" value="重置"/></td>
			</tr>
		</tbody>
	</table>
</form>
</body>
</html>

