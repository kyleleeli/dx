
<html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	</head>
<body>
<form method="POST" action="submitreturn.php?action=edit">
<?php
	require_once './header.php';
	$orderno=mysql_real_escape_string($_GET['orderno']);
	$sql="SELECT * FROM  dx_returns where order_no='%s' order by create_date desc";
	$query = sprintf($sql, $orderno);
	mysql_query("SET NAMES UTF8"); 	        
	$result=mysql_query($query);
	mysql_query("CLOSE");
	//echo $query;
	$row=mysql_fetch_array($result);
	/*if(!isAdmin($metinfo_member_name)){
		if($row[is_locked_by_admin]==1){
			echo "该订单已被管理员锁定，不能编辑！";
				return;			
			}
	}*/
?>
	<table style="width:80%">
		<tbody>
			<tr><td>退货信息</td></tr>
			<tr>
				<td>日期：</td>
				<td>
				    <input type="text" id="txtMonth" value="2013"  style="width:50px" name="Year" value="<? echo $row[year] ?>"/>年
				   <select  id="txtMounth" name="Month">
					<options>
					<?
					 for(;$index<13;$index++){
						if($index==$row[month] ){						
							echo "<option value='".$index."' selected='selected'>".$index."</option>";

						}else{
							echo "<option value='".$index."'>".$index."</option>";
						}
					 }
					?>
					</options>	
				</select>月
				<input type="text" id="txtDay"  style="width:50px" name="Day" value="<? echo $row[day] ?>"/>日
				</td>
				<td>条码单号：</td>
				<td><? echo $row[order_no]?><input type="hidden" id="txtOrderNo" name="OrderNo" value="<? echo $row[order_no] ?>"/></td>
			</tr>
			<tr>
				<td>区域：</td>
				<td><input type="text" id="txtRegion" name="Region" value="<? echo $row[region] ?>"/></td>
				<td>退货人：</td>
				<td><input type="text" id="txtSendBy" name="ReturnBy" value="<? echo $row[return_by] ?>"/></td>
			</tr>
			<tr>
				<td>数量：</td>
				<td><input type="text" id="txtRegion" name="Count" value="<? echo $row[count] ?>"/></td>
				<td>退货费：</td>
				<td><input type="text" id="txtSendBy" name="ReturnFee" value="<? echo $row[return_fee] ?>"/></td>
			</tr>
			<tr>
				<td>仓库：</td>
				<td><input type="text" id="txtCount" name="Warehouse" value="<? echo $row[warehouse] ?>"/></td>
				<td>备注：</td>
				<td><input type="text" id="txtFare" name="Remark" value="<? echo $row[remark] ?>"/></td>		
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

