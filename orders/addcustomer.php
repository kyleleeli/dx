
<html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	</head>
<body>
<?require_once './header.php';?>
<form method="POST" action="submitcustomer.php?action=add">
	<table style="width:80%">
		<tbody>
			<tr><td>账户信息</td></tr>
			<tr>
				<td>收款人：</td>
				<td><input type="text" id="txtReceiptName" name="ReceiptName"/></td>
				<td>收款人帐号：</td>
				<td><input type="text" id="txtReceiptAccountName" name="ReceiptAccountName"/></td>
			</tr>
			<tr>
				<td>验证码：</td>
				<td><input type="text" id="txtVerfyCode" name="VerifyCode"/></td>
				<td>帐号：</td>
				<td><input type="text" id="txtAccount" name="Account"/></td>
			</tr>
			<tr>
				<td>账户名称：</td>
				<td><input type="text" id="txtAccountName" name="AccountName"/></td>
				<td>银行类别：</td>
				<td><input type="text" id="txtBankName" name="BankName"/></td>
			</tr>
			<tr>
				<td>账户性质：</td>
				<td><select  id="txtAccountType" name="AccountType">
					<options>
					  <option value="借记卡" selected="selected">借记卡</option>
					  <option value="信用卡">信用卡</option>						
					</options>	
				</select></td>
				<td>账户所属网点：</td>
				<td><input type="text" id="txtLocaltion" name="AccountLocaltion"/></td>
			</tr>
			<tr>
				<td>账户所在市：</td>
				<td><input type="text" id="txtAccountCity" name="AccountCity"/></td>
				
			</tr>
			<tr><td>联系信息</td></tr>	
			<tr>
				<td>办公电话：</td>
				<td><input type="text" id="txtOfficePhoneNo" name="OfficePhoneNo"/></td>
				<td>手机：</td>
				<td><input type="text" id="txtMobileNo" name="MobileNo"/></td>
			</tr>
			<tr>
				<td>传真：</td>
				<td><input type="text" id="txtFaxNo" name="FaxNo"/></td>
				<td>QQ：</td>
				<td><input type="text" id="txtQQNo" name="QQNo"/></td>
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

