<?php 
require_once './header.php';
if($_SERVER['REQUEST_METHOD']=='POST') {
	$action=$_GET["action"];
	$query="";	
	$insert_sql="INSERT INTO `dx_detail` (
	`order_no`,`region`, `send_by`, 
	`count`, `fare`,
	`payed_amount`, `payed_by`, `receipt_name`,
	`receipt_account_name`, `verify_code`, `payment_collection`,
	`payment_minus`, `fee`, `indeed_transfer_amount`,
	`transfer_date`, `send_date`,
	`year`,`month`,`day`,`remark`,`create_by`)
	 VALUES 
	(
	'%s', '%s', '%s',
	'%s',  '%s',
	'%s', '%s', '%s',
	'%s', '%s', '%s',
	'%s', '%s', '%s',
	'%s', '%s',
	'%s','%s','%s','%s','%s')";
	if(isAdmin($metinfo_member_name)) {
		$update_sql="UPDATE `dx_detail` 
		SET 
		region='%s', send_by='%s', 
		count='%s',fare=%d,
		payed_amount='%s', payed_by='%s', receipt_name='%s',
		receipt_account_name='%s', verify_code='%s', payment_collection='%s',
		payment_minus=%d, fee=%d, indeed_transfer_amount=%d,
		transfer_date='%s', send_date='%s',
		year=%d,month=%d,day=%d,remark='%s',update_by='%s',is_locked_by_admin=1
		WHERE order_no='%s'";
	}else{
		$update_sql="UPDATE `dx_detail` 
		SET 
		region='%s', send_by='%s', 
		count='%s',fare=%d,
		payed_amount='%s', payed_by='%s', receipt_name='%s',
		receipt_account_name='%s', verify_code='%s', payment_collection='%s',
		payment_minus=%d, fee=%d, indeed_transfer_amount=%d,
		transfer_date='%s', send_date='%s',
		year=%d,month=%d,day=%d,remark='%s',update_by='%s',is_locked_by_admin=0
		WHERE order_no='%s'";
	}
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
					mysql_real_escape_string($_POST['Day']),
					mysql_real_escape_string($_POST['Remark'],
					$metinfo_member_name)
		);
	}elseif($action=="addbyrows"){
		$querysArr=array();
		$count=(int)$_POST['RowCount'];
		$tempQuery="";
		for($j=0;$j<$count;$j++){	
			$i=$j+1;	
			$tempQuery= sprintf($insert_sql,  mysql_real_escape_string($_POST['OrderNo_'.$i]), 
					mysql_real_escape_string($_POST['Region_'.$i]),
					mysql_real_escape_string($_POST['SendBy_'.$i]),
					mysql_real_escape_string($_POST['Count_'.$i]),
					mysql_real_escape_string($_POST['Fare_'.$i]),
					mysql_real_escape_string($_POST['PayedAmount_'.$i]),
					mysql_real_escape_string($_POST['PayedBy_'.$i]),
					mysql_real_escape_string($_POST['ReceiptName_'.$i]),
					mysql_real_escape_string($_POST['ReceiptAccountName_'.$i]),
					mysql_real_escape_string($_POST['VerifyCode_'.$i]),
					mysql_real_escape_string($_POST['PaymentCollection_'.$i]),
					mysql_real_escape_string($_POST['PaymentMinus_'.$i]),
					mysql_real_escape_string($_POST['Fee_'.$i]),
					mysql_real_escape_string($_POST['IndeedTransferAmount_'.$i]),
					mysql_real_escape_string($_POST['TransferDate_'.$i]),
					mysql_real_escape_string($_POST['SendDate_'.$i]),
					mysql_real_escape_string($_POST['Year_'.$i]),
					mysql_real_escape_string($_POST['Month_'.$i]),
					mysql_real_escape_string($_POST['Day_'.$i]),
					mysql_real_escape_string($_POST['Remark_'.$i]),
					$metinfo_member_name
		);
			array_push($querysArr, $tempQuery);
		}		
		mysql_query('START TRANSACTION');
		mysql_query("SET AUTOCOMMIT=0");
		//echo $querysArr[0];		
		for($k=0;$k<$count;$k++){
			$q= $querysArr[$k];
			echo $q;
			$r=mysql_query($q);
			if(!$r){
				ob_end_clean();				
				header('HTTP/1.0 400 Bad error');
				//echo $q;				
			    echo 'Invalid query: ' .mysql_error();
				mysql_query("ROLLBACK");
				mysql_query("CLOSE");
			}
		}	
 		mysql_query("COMMIT");
		mysql_query("CLOSE");
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
					mysql_real_escape_string($_POST['Remark']),
					$metinfo_member_name,
				    mysql_real_escape_string($_POST['OrderNo'])
		);

	}
	//$result = mysql_query($query);
		//if (!$result) {
			//ob_end_clean();				
			//header('HTTP/1.0 400 Bad error');
			//die($query);			
			//die('Invalid query: ' . mysql_error());
		//}

}
if($action!='addbyrows'){
	//echo $query;	
	mysql_query($query);
	mysql_query("CLOSE");
	echo "<script>window.location =\"orderlist.php?OrderNo=".$_POST['OrderNo']."\";</script>";
}
?>
  
