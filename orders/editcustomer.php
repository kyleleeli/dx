
<html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	</head>
<body>
<?require_once './header.php';
	$verifycode=mysql_real_escape_string($_GET['VerifyCode']);
	$sql="SELECT * FROM  dx_customer where verify_code='%s' order by create_date desc";
	$query = sprintf($sql, $verifycode);
	mysql_query("SET NAMES UTF8"); 	        
	$result=mysql_query($query);
	$row=mysql_fetch_array($result);
?>

<form method="POST" action="submitcustomer.php?action=edit">
	<table style="width:80%">
		<tbody>
			<tr><td>账户信息</td></tr>
			<tr>
				<td>收款人：</td>
				<td><input type="text" id="txtReceiptName" name="ReceiptName" value="<? echo $row[receipt_name] ?>"/></td>
				<td>收款人帐号：</td>
				<td><input type="text" id="txtReceiptAccountName" name="ReceiptAccountName" value="<? echo $row[receipt_account_name] ?>"/></td>
			</tr>
			<tr>
				<td>验证码：</td>
				<td><? echo $row[verify_code] ?><input type="hidden" id="txtVerfyCode" name="VerifyCode" value="<? echo $row[verify_code]?>"/></td>
				<td>帐号：</td>
				<td><input type="text" id="txtAccount" name="Account" value="<? echo $row[account] ?>"/></td>
			</tr>
			<tr>
				<td>账户名称：</td>
				<td><input type="text" id="txtAccountName" name="AccountName" value="<? echo $row[account_name] ?>"/></td>
				<td>银行类别：</td>
				<td><input type="text" id="txtBankName" name="BankName" value="<? echo $row[bank_name] ?>"/></td>
			</tr>
			<tr>
				<td>账户性质：</td>
				<td><select  id="txtAccountType" name="AccountType">
					<options>
						<option value="借记卡" "<?if($row[account_type]=="借记卡"){
										echo "selected='selected'";
									 }?>">借记卡</option>
						<option value="借记卡" "<?if($row[account_type]=="信用卡"){
										echo "selected='selected'";
						}?>">信用卡</option>
					</options>	
				</select></td>
				<td>账户所属网点：</td>
				<td><input type="text" id="txtLocaltion" name="AccountLocaltion" value="<? echo $row[account_location] ?>"/></td>
			</tr>
			<tr>
				<td>账户所在市：</td>
				<td><input type="text" id="txtAccountCity" name="AccountCity" value="<? echo $row[account_city] ?>"/></td>
				
			</tr>
			<tr><td>联系信息</td></tr>	
			<tr>
				<td>办公电话：</td>
				<td><input type="text" id="txtOfficePhoneNo" name="OfficePhoneNo" value="<? echo $row[office_phone_no] ?>"/></td>
				<td>手机：</td>
				<td><input type="text" id="txtMobileNo" name="MobileNo" value="<? echo $row[mobile_no] ?>"/></td>
			</tr>
			<tr>
				<td>传真：</td>
				<td><input type="text" id="txtFaxNo" name="FaxNo" value="<? echo $row[fax_no] ?>"/></td>
				<td>QQ：</td>
				<td><input type="text" id="txtQQNo" name="QQNo" value="<? echo $row[qq_no] ?>"/></td>
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

