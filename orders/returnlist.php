<html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />	
	</head>
<body>
<?php
	  require_once './header.php';
	   $Year=$cur_year;
	   $Month=$cur_mon;
	   $Day="";
	   $Region="";
	if($_SERVER['REQUEST_METHOD']=='POST') {
	   $Year=mysql_real_escape_string($_POST["Year"]);
	   $Month=mysql_real_escape_string($_POST["Month"]);
	   $Day=mysql_real_escape_string($_POST["Day"]);
	   $Region=mysql_real_escape_string($_POST["Region"]);
	}
	if($_SERVER['REQUEST_METHOD']=='GET') {
	if(is_array($_GET)&&count($_GET)>0)//先判断是否通过get传值了
   	 {
	     if(isset($_GET["OrderNo"]))//是否存在"OrderNo"的参数
	     {
			$OrderNo=mysql_real_escape_string($_GET["OrderNo"]);
	     }
	 }
	}
 ?>
<div>
<h1>客户帐号信息</h1>
<form action="returnlist.php" method="POST" >
<table>
	<tr>
		<td>日期：</td>
			<td>
			    <input type="text" id="txtMonth" value="<? echo $Year?>"  style="width:50px" name="Year"/>年
			   <select  id="txtMounth" name="Month">
				<options>
				<?
				echo "<option value=''></option>";
				$index=1;
				for(;$index<13;$index++){
					
					if($Month==$index){						
						echo "<option value='".$index."' selected='selected'>".$index."</option>";

					}else{
						echo "<option value='".$index."'>".$index."</option>";
					}
				 }
				?>
				</options>	
			</select>月
			<input type="text" id="txtDay" value="<? echo $Day?>" style="width:50px" name="Day"/>日
			</td>
			<td>区域:</td>
			<td>
				<input type="text" id="txtRegion" value="<? echo $Region?>" name="Region"/>				
			</td>
			<td><input type="submit" value="查询"/></td>
	</tr>
</table>
</form>
</div>

<div class="boxcontent">
<table class="detail" style="width:800px">
	<thead>
		<tr>
			<td>操作</td>
			<td>年</td>
			<td>月</td>
			<td>日</td>
			<td>退货人</td>
			<td>数量</td>
			<td>单号</td>						
			<td>退货费</td>			
			<td>区域</td>
			<td>所在仓库</td>
			<td>创建人</td>
			<td>最后更新人</td>
			<td>备注</td>	
		</tr>
	</thead>
	<tbody>


<?php 
require_once '../include/common.inc.php';
require_once '../member/login_check.php';
if($_SERVER['REQUEST_METHOD']=='POST') {
   $sql="SELECT * FROM  dx_returns where
	  (year=%d or '%s' ='')
	 and (month=%d or '%s' ='')
	 and (day=%d or '%s' ='')
     and (region='%s' or '%s' ='')
     and (order_no='%s' or '%s' ='')
  order by create_date desc";
	
  $sql=sprintf($sql,
		$Year,$Year,
		$Month, $Month,
		$Day,$Day,
		$Region,$Region,
		$OrderNo, $OrderNo);

	//echo $sql;
}elseif($_SERVER['REQUEST_METHOD']=='GET'){
	 $sql="SELECT * FROM  dx_returns where order_no='%s'
  	 order by create_date desc";
	 $sql=sprintf($sql,$OrderNo);
}
	//echo $sql;
	mysql_query("SET NAMES UTF8"); 
	$result=mysql_query($sql);
	while($row=mysql_fetch_array($result)){
	//$isNotEdit=(!isAdmin($metinfo_member_name)) and ($row[is_locked_by_admin]==1);
	$op="<tr>
		<td><a href='javascript:editReturn(\"".$row[order_no]."\")'>编辑</a>
		<a href='javascript:deleteReturn(\"".$row[order_no]."\")'>删除</a></td>";

	echo $op.
  		"<td>".$row[year]."</td>
		<td>".$row[month]."</td>
		<td>".$row[day]."</td>  
		<td>".$row[return_by]."</td>
		<td>".$row[count]."</td>
		<td>".$row[order_no]."</td> 
		<td>".$row[return_fee]."</td>		
		<td>".$row[region]."</td>
		<td>".$row[warehouse]."</td>
		<td>".$row[create_by]."</td>
		<td>".$row[update_by]."</td>
		<td>".$row[remark]."</td>
	  </tr>";
	}
?>
</tbody>
</table>
</div>
</body>
</html>
<script language="javascript">
function deleteReturn(orderNo){
   if(confirm("确认删除退货单:"+orderNo+"的信息?")){
		window.location.href="deletereturn.php?orderNo="+orderNo;	
   }	
}
function editReturn(orderNo){
	window.location.href="editreturn.php?orderno="+orderNo;	
}
</script>

