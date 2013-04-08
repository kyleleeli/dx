<html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
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
	</head>
<body>
<?php 
require_once './header.php';
	   $VerifyCode="";
	   $ReceiptName="";
	   $ReceiptAccountName="";
	if($_SERVER['REQUEST_METHOD']=='POST') {
	   $VerifyCode=mysql_real_escape_string($_POST["VerifyCode"]);
	   $ReceiptName=mysql_real_escape_string($_POST["ReceiptName"]);
	   $ReceiptAccountName=mysql_real_escape_string($_POST["ReceiptAccountName"]);
 	}
	if($_SERVER['REQUEST_METHOD']=='GET') {
	if(is_array($_GET)&&count($_GET)>0)//先判断是否通过get传值了
   	 {
	     if(isset($_GET["VerifyCode"]))//是否存在"OrderNo"的参数
	     {
		$VerifyCode=mysql_real_escape_string($_GET["VerifyCode"]);
	     }
	 }
	}
?>
<div>
<h1>客户帐号信息</h1>
<form action="customerlist.php" method="POST" >
<table>
	<tr>
		<td>验证码:</td>
		<td><input type="text" id="txtVerifyCode" name="VerifyCode" value="<? echo $VerifyCode?>"/></td>
		<td>收款人:</td>
		<td><input type="text" id="txtReceiptName" name="ReceiptName" value="<? echo $ReceiptName?>"/></td>
		<td>帐号名:</td>
		<td><input type="text" id="txtReceiptAccountName" name="ReceiptAccountName" value="<? echo $ReceiptAccountName?>"/></td>
		<td><input type="submit" value="查询"/></td>
	</tr>
			
</table>
</form>
</div>
<div class="boxcontent">
<table class="detail" style="width:800px">
<tbody>
<tr>
  <td>操作</td>
  <td>收款人</td>
  <td>收款人账户名</td>
  <td>验证码</td>
  <td>帐号</td>
  <td>账户名称</td>
  <td>开户行行别</td>
  <td>账户性质</td>
  <td>账户所属网点</td>
  <td>账户所在市</td>
  <td>办公电话</td>
  <td>手机</td>
  <td>传真</td>
  <td>QQ号码</td>  
 <td>创建日期</td>
			
</tr>
<?php
mysql_query("SET NAMES UTF8"); 
if($_SERVER['REQUEST_METHOD']=='POST') {
   	$sql="SELECT * FROM  dx_customer where (verify_code='%s' or '%s' ='')	
         and (receipt_name='%s' or '%s' ='')
	 and (receipt_account_name='%s' or '%s' ='')
  	 order by create_date desc";
  	$sql=sprintf($sql,$VerifyCode,$VerifyCode,
		$ReceiptName,$ReceiptName,
		$ReceiptAccountName,$ReceiptAccountName);
}elseif($_SERVER['REQUEST_METHOD']=='GET'){
	$sql="SELECT * FROM  dx_customer where verify_code='%s' order by create_date desc";
	$sql=sprintf($sql,$VerifyCode);
}
 
$result=mysql_query($sql);

while($row=mysql_fetch_array($result)){
	echo "<tr>
	<td><a href='javascript:deleteCustomer(\"".$row[receipt_name]."\",\"".$row[verify_code]."\")'>删除</a>
	 <a href='editcustomer.php?VerifyCode=".$row[verify_code]."'>编辑</a></td>
	<td>".$row[receipt_name]."</td>
	<td>".$row[receipt_account_name]."</td>
	<td>".$row[verify_code]."</td>
	<td>".$row[account]."</td>
	<td>".$row[account_name]."</td>
	<td>".$row[bank_name]."</td>
	<td>".$row[account_type]."</td>
	<td>".$row[account_location]."</td>
	<td>".$row[account_city]."</td>
	<td>".$row[office_phone_no]."</td>
	<td>".$row[mobile_no]."</td>
	<td>".$row[fax_no]."</td>
	<td>".$row[qq_no]."</td>
	<td>".$row[create_date]."</td>
	</tr>";
}
?>
</tbody>
</table>
</div>
</body>
</html>
<script language="javascript">
function deleteCustomer(name,code){
   if(confirm("确认删除"+name+"(验证码:"+code+")的信息?")){
	window.location.href="deletecustomer.php?VerifyCode="+code;	
   }	
}
</script>








