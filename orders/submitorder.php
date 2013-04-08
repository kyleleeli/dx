<?php 
require_once './header.php';
if($_SERVER['REQUEST_METHOD']=='POST') {
	$action=$_GET["action"];
	$insert_sql="INSERT INTO `dx_detail` (
	`order_no`,`region`, `send_by`, 
	`count`, `fare`,
	`payed_amount`, `payed_by`, `receipt_name`,
	`receipt_account_name`, `verify_code`, `payment_collection`,
	`payment_minus`, `fee`, `indeed_transfer_amount`,
	`transfer_date`, `send_date`,
	`year`,`month`,`day`)
	 VALUES 
	(
	'%s', '%s', '%s',
	'%s',  '%s',
	'%s', '%s', '%s',
	'%s', '%s', '%s',
	'%s', '%s', '%s',
	'%s', '%s',
	'%s','%s','%s')";

	$update_sql="UPDATE `dx_detail` 
	SET 
	region='%s', send_by='%s', 
	count='%s',fare=%d,
	payed_amount='%s', payed_by='%s', receipt_name='%s',
	receipt_account_name='%s', verify_code='%s', payment_collection='%s',
	payment_minus=%d, fee=%d, indeed_transfer_amount=%d,
	transfer_date='%s', send_date='%s',
	year=%d,month=%d,day=%d
	WHERE order_no='%s'";

	$query="";
	if ($action == "add") {
		$query= sprintf($insert_sql,  mysql_real_escape_string($_POST['OrderNo']), 
					mysql_real_escape_string($_POST['Region']),
					mysql_real_escape_string($_POST['SendBy']),
					mysql_real_escape_string($_POST['Count']),
					mysql_real_escape_string($_POST['Fare']),
					mysql_real_escape_string($_POST['PayedAmount']),
					mysql_real_escape_string($_POST['PayedBy']),
					mysql_real_escape_string($_POST['ReceiptName']),
					mysql_real_escape_string($_POST['ReceiptAccountName']),
					mysql_real_escape_string($_POST['VerifyCode']),
					mysql_real_escape_string($_POST['PaymentCollection']),
					mysql_real_escape_string($_POST['PaymentMinus']),
					mysql_real_escape_string($_POST['Fee']),
					mysql_real_escape_string($_POST['IndeedTransferAmount']),
					mysql_real_escape_string($_POST['TransferDate']),
					mysql_real_escape_string($_POST['SendDate']),
					mysql_real_escape_string($_POST['Year']),
					mysql_real_escape_string($_POST['Month']),
					mysql_real_escape_string($_POST['Day'])
		);
	}elseif($action == "edit"){
		$query = sprintf($update_sql, mysql_real_escape_string($_POST['Region']),
					mysql_real_escape_string($_POST['SendBy']),
					mysql_real_escape_string($_POST['Count']),
					mysql_real_escape_string($_POST['Fare']),
					mysql_real_escape_string($_POST['PayedAmount']),
					mysql_real_escape_string($_POST['PayedBy']),
					mysql_real_escape_string($_POST['ReceiptName']),
					mysql_real_escape_string($_POST['ReceiptAccountName']),
					mysql_real_escape_string($_POST['VerifyCode']),
					mysql_real_escape_string($_POST['PaymentCollection']),
					mysql_real_escape_string($_POST['PaymentMinus']),
					mysql_real_escape_string($_POST['Fee']),
					mysql_real_escape_string($_POST['IndeedTransferAmount']),
					mysql_real_escape_string($_POST['TransferDate']),
					mysql_real_escape_string($_POST['SendDate']),
					mysql_real_escape_string($_POST['Year']),
					mysql_real_escape_string($_POST['Month']),
					mysql_real_escape_string($_POST['Day']),
				        mysql_real_escape_string($_POST['OrderNo'])
		);

	}

	echo $query;
	mysql_query($query); 
}
echo "<script>window.location =\"orderlist.php?OrderNo=".$_POST['OrderNo']."\";</script>";
?>
  
