<?php 
require_once './header.php';
if($_SERVER['REQUEST_METHOD']=='POST') {
	$action=$_GET["action"];
	$query="";	
	$insert_sql="INSERT INTO `dx_returns` (
	`order_no`,`region`, `return_by`, 
	`count`, `return_fee`,
	`warehouse`, `year`,`month`,
	`day`,`remark`,`create_by`)
	 VALUES 
	(
	'%s', '%s', '%s',
	'%s',  %d,
	'%s', %d, %d,
	%d, '%s', '%s'
	)";
	$update_sql="UPDATE `dx_returns` 
		SET 
		region='%s', return_by='%s', 
		count='%s',return_fee=%d,
		warehouse='%s',year=%d,month=%d,
		day=%d,remark='%s',
		update_by='%s'
		WHERE order_no='%s'";
	if ($action == "add") {
		$query= sprintf($insert_sql,  mysql_real_escape_string($_POST['OrderNo']), 
					mysql_real_escape_string($_POST['Region']),
					mysql_real_escape_string($_POST['ReturnBy']),
					mysql_real_escape_string($_POST['Count']),
					mysql_real_escape_string($_POST['ReturnFee']),
					mysql_real_escape_string($_POST['Warehouse']),
					mysql_real_escape_string($_POST['Year']),
					mysql_real_escape_string($_POST['Month']),
					mysql_real_escape_string($_POST['Day']),
					mysql_real_escape_string($_POST['Remark']),
					$metinfo_member_name
		);
	}elseif($action=="addbyrows"){
		$querysArr=array();
		$count=(int)$_POST['RowCount'];
		$tempQuery="";
		for($j=0;$j<$count;$j++){	
			$i=$j+1;	
			$tempQuery= sprintf($insert_sql,  mysql_real_escape_string($_POST['OrderNo_'.$i]), 
					mysql_real_escape_string($_POST['Region_'.$i]),
					mysql_real_escape_string($_POST['ReturnBy_'.$i]),
					mysql_real_escape_string($_POST['Count_'.$i]),
					mysql_real_escape_string($_POST['ReturnFee_'.$i]),
					mysql_real_escape_string($_POST['Warehouse_'.$i]),
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
				echo $q;				
			    echo 'Invalid query: ' .mysql_error();
				mysql_query("ROLLBACK");
				mysql_query("CLOSE");
			}
		}	
 		mysql_query("COMMIT");
		mysql_query("CLOSE");
	}elseif($action == "edit"){	
		$query = sprintf($update_sql, 
					mysql_real_escape_string($_POST['Region']),
					mysql_real_escape_string($_POST['ReturnBy']),
					mysql_real_escape_string($_POST['Count']),
					mysql_real_escape_string($_POST['ReturnFee']),
					mysql_real_escape_string($_POST['Warehouse']),
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
	echo "<script>window.location =\"returnlist.php?OrderNo=".$_POST['OrderNo']."\";</script>";
}
?>
  
