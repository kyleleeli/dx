<?
require_once './header.php';
if(isset($_GET["ReceiptName"])){
	$receiptName=mysql_real_escape_string($_GET['ReceiptName']);
}
if(isset($_GET["VerifyCode"])){
 $verifyCode=mysql_real_escape_string($_GET['VerifyCode']);
}
if(isset($_GET["GetBy"])){
	$getBy=mysql_real_escape_string($_GET['GetBy']);
}
$sql_by_receipt_name="SELECT * FROM  dx_customer where receipt_name='%s' order by create_date desc";
$sql_by_verify_code="SELECT * FROM  dx_customer where verify_code='%s' order by create_date desc";
$query="";
 
if($getBy=='ReceiptName'){
	$query = sprintf($sql_by_receipt_name, $receiptName);
}else{
	$query=sprintf($sql_by_verify_code,$verifyCode);
}	
mysql_query("SET NAMES UTF8");
$result=mysql_query($query);
ob_end_clean();
if($row=mysql_fetch_array($result)){
	$receipt_name=$row[receipt_name];
	$verify_code=$row[verify_code];
	$account_name=$row[account_name];
	echo "1^".$verify_code."^".$receipt_name."^".$account_name;
}else{
	echo "0^^^";
}

?>