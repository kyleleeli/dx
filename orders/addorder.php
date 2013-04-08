
<html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	</head>
<body>
<?php 
	require_once './header.php';
?>
<form method="POST" action="submitorder.php?action=add">
	<table style="width:80%">
		<tbody>
			<tr><td>订单信息</td></tr>
			<tr>
				<td>日期：</td>
				<td>
				    <input type="text" id="txtMonth" value="2013"  style="width:50px" name="Year"/>年
				   <select  id="txtMounth" name="Month">
					<options>
					<?
					$index=1;
					$tmp_date=date("Ym");
					$cur_mon =substr($tmp_date,4,2);//当前月份
					echo $cur_mon;
					 for(;$index<13;$index++){
						if($cur_mon==$index){						
							echo "<option value='".$index."' selected='selected'>".$index."</option>";

						}else{
							echo "<option value='".$index."'>".$index."</option>";
						}
					 }
					?>
					</options>	
				</select>月
				<input type="text" id="txtDay" value="<?echo $cur_day?>"  style="width:50px" name="Day"/>日
				</td>
				<td>条码单号：</td>
				<td><input type="text" id="txtOrderNo" name="OrderNo"/></td>
			</tr>
			<tr>
				<td>区域：</td>
				<td><input type="text" id="txtRegion" name="Region"/></td>
				<td>派货人：</td>
				<td><input type="text" id="txtSendBy" name="SendBy"/></td>
			</tr>
			<tr>
				<td>数量：</td>
				<td><input type="text" id="txtCount" name="Count"/></td>
				<td>运费：</td>
				<td><input type="text" id="txtFare" name="Fare"/></td>
				
				
			</tr>
			<tr>
				<td>已付：</td>
				<td><input type="text" id="txtPayedAmount" name="PayedAmount"/></td>
				<td>付款人：</td>
				<td><input type="text" id="txtPayedBy" name="PayedBy"/></td>
				
			</tr>
			</tr>
			<tr>
				<td>验证码：</td>
				<td><input type="text" id="txtVerifyCode" name="VerifyCode"/></td>
				<td>收款人：</td>
				<td><input type="text" id="txtReceiptName" name="ReceiptName"/></td>
				
			<tr>
				<td>帐号名：</td>
				<td><input type="text" id="txtReceiptAccountName" name="ReceiptAccountName"/></td>
				<td>代收货款：</td>
				<td><input type="text" id="txtPaymentCollection" name="PaymentCollection"/></td>
			</tr>
			<tr>
				<td>减货款：</td>
				<td><input type="text" id="txtPaymentMinus" name="PaymentMinus"/></td>
				<td>手续费：</td>
				<td><input type="text" id="txtFee" name="Fee"/></td>
			</tr>
			<tr>
				<td>实际转账：</td>
				<td><input type="text" id="txtIndeedTransferAmount" name="IndeedTransferAmount"/></td>
				<td>转帐日期</td>
				<td><input type="text" id="txtTransferDate" name="TransferDate"/></td>
			</tr>
			<tr>
				<td>收款日期：</td>
				<td><input type="text" id="txtSendDate" name="SendDate"/></td>
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

