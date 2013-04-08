<?php 
require_once './header.php';		 
$sql="DELETE FROM dx_customer WHERE receipt_name='%s'";
$query = sprintf($sql,mysql_real_escape_string($_GET['name']));
echo $query;
mysql_query($query); 
echo "<script>window.location =\"customerlist.php\";</script>";
?>
  
