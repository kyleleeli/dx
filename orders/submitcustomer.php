<?php 
require_once './header.php';
if($_SERVER['REQUEST_METHOD']=='POST') {
$action=$_GET['action'];
if($action=='add'){
$sql="INSERT INTO `dx_customer` (`receipt_name`, `receipt_account_name`, `verify_code`, `account`, `account_name`, `bank_name`, `account_type`, `account_location`, `account_city`, `office_phone_no`, `mobile_no`, `fax_no`, `qq_no`)
 VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')";


$query = sprintf($sql,  mysql_real_escape_string($_POST['ReceiptName']), 
			mysql_real_escape_string($_POST['ReceiptAccountName']),
			mysql_real_escape_string($_POST['VerifyCode']),
			mysql_real_escape_string($_POST['Account']),
			mysql_real_escape_string($_POST['AccountName']),
			mysql_real_escape_string($_POST['BankName']),
			mysql_real_escape_string($_POST['AccountType']),
			mysql_real_escape_string($_POST['AccountLocaltion']),
			mysql_real_escape_string($_POST['AccountCity']),
			mysql_real_escape_string($_POST['OfficePhoneNo']),
			mysql_real_escape_string($_POST['MobileNo']),
			mysql_real_escape_string($_POST['FaxNo']),
			mysql_real_escape_string($_POST['QQNo']));
}elseif($action=='edit'){
$sql="UPDATE dx_customer SET
	receipt_name='%s',
	receipt_account_name='%s',
	account='%s',
	account_name='%s',
	bank_name='%s',
	account_type='%s',
	account_location='%s',
	account_city='%s',
	office_phone_no='%s',
	mobile_no='%s',
	fax_no='%s',
	qq_no='%s'
	WHERE 
	verify_code='%s'";


$query = sprintf($sql,  mysql_real_escape_string($_POST['ReceiptName']), 
			mysql_real_escape_string($_POST['ReceiptAccountName']),
			mysql_real_escape_string($_POST['Account']),
			mysql_real_escape_string($_POST['AccountName']),
			mysql_real_escape_string($_POST['BankName']),
			mysql_real_escape_string($_POST['AccountType']),
			mysql_real_escape_string($_POST['AccountLocaltion']),
			mysql_real_escape_string($_POST['AccountCity']),
			mysql_real_escape_string($_POST['OfficePhoneNo']),
			mysql_real_escape_string($_POST['MobileNo']),
			mysql_real_escape_string($_POST['FaxNo']),
			mysql_real_escape_string($_POST['QQNo']),
			mysql_real_escape_string($_POST['VerifyCode']));
}
	//echo $query;
	mysql_query($query); 
}
echo $query;
echo "<script>window.location =\"customerlist.php?VerifyCode=".$_POST['VerifyCode']. "\";</script>";
?>
  
