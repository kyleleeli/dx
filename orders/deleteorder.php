<?php 
require_once './header.php';
$sql="DELETE FROM `dx_detail` WHERE order_no='%s'";

$query = sprintf($sql,mysql_real_escape_string($_GET['orderNo']));
echo $query;
mysql_query($query); 
echo "<script>window.location =\"orderlist.php\";</script>";
?>
  
