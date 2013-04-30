<html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	
	</head>
<body>
<?php
	  require_once './header.php';
	   $VerifyCode="";
	   $ReceiptName="";
	   $ReceiptAccountName="";
	   $Year=$cur_year;
	   $Month=$cur_mon;
	   $Day="";
	   $OrderNo="";
	   $Region="";
	   $SendDate="";
	   $TransferDate="";
	if($_SERVER['REQUEST_METHOD']=='POST') {
	   $VerifyCode=mysql_real_escape_string($_POST["VerifyCode"]);
	   $ReceiptName=mysql_real_escape_string($_POST["ReceiptName"]);
	   $ReceiptAccountName=mysql_real_escape_string($_POST["ReceiptAccountName"]);
	   $Year=mysql_real_escape_string($_POST["Year"]);
	   $Month=mysql_real_escape_string($_POST["Month"]);
	   $Day=mysql_real_escape_string($_POST["Day"]);
	   $OrderNo=mysql_real_escape_string($_POST["OrderNo"]);
	   $Region=mysql_real_escape_string($_POST["Region"]);
	   $TransferDate=mysql_real_escape_string($_POST["TransferDate"]);
	   $SendDate=mysql_real_escape_string($_POST["SendDate"]);
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
<h1>订单信息查询</h1>
<form action="orderlist.php" method="POST" >
<table >
	<tr>
		<td>转账日期:</td>
		<td><input type="text" id="txtTransferDate" name="TransferDate" value="<? echo $TransferDate?>"/></td>
		<td>收款日期:</td>
		<td><input type="text" id="txtSendDate" name="SendDate" value="<? echo $SendDate?>"/></td>
	</tr>
	<tr>
		<td>验证码:</td>
		<td><input type="text" id="txtVerifyCode" name="VerifyCode" value="<? echo $VerifyCode?>"/></td>
		<td>收款人:</td>
		<td><input type="text" id="txtReceiptName" name="ReceiptName" value="<? echo $ReceiptName?>"/></td>
		<td>帐号名:</td>
		<td><input type="text" id="txtReceiptAccountName" name="ReceiptAccountName" value="<? echo $ReceiptAccountName?>"/></td>
		
	</tr>
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
			<td>条形单码:</td>
			<td>
			<input type="text" id="txtOrderNo" value="<? echo $OrderNo?>" name="OrderNo"/>				
			</td>
			<td>区域:</td>
			<td>
				<input type="text" id="txtRegion" value="<? echo $Region?>" name="Region"/>				
			</td>
			<td>
				<input type="submit" value="查询"/>
				<button id="btnPrint" onclick="javascript:openPrintWin()">打印</button>
			</td>
	</tr>
</table>
</form>
</div>
<?php 
require_once '../include/common.inc.php';
require_once '../member/login_check.php';
if($_SERVER['REQUEST_METHOD']=='POST') {
   $sql="SELECT * FROM  dx_detail where (verify_code='%s' or '%s' ='')	
         and (receipt_name='%s' or '%s' ='')
	 and (receipt_account_name='%s' or '%s' ='')
	 and (year=%d or '%s' ='')
	 and (month=%d or '%s' ='')
	 and (day=%d or '%s' ='')
     and (region='%s' or '%s' ='')
     and (order_no='%s' or '%s' ='')
     and (transfer_date='%s' or '%s' ='')
     and (send_date='%s' or '%s' ='')
  order by create_date desc";

$sumsql="SELECT count(*) sum_count,sum(fare) as 'sum_fare',
			sum(fee) as 'sum_fee',sum(payment_collection) as 'sum_payment_collection',
			sum(payment_minus) as 'sum_payment_minus',sum(indeed_transfer_amount) as 'sum_indeed_transfer_amount'
			 FROM  dx_detail where (verify_code='%s' or '%s' ='')	
         and (receipt_name='%s' or '%s' ='')
	 and (receipt_account_name='%s' or '%s' ='')
	 and (year=%d or '%s' ='')
	 and (month=%d or '%s' ='')
	 and (day=%d or '%s' ='')
     and (region='%s' or '%s' ='')
     and (order_no='%s' or '%s' ='')
     and (transfer_date='%s' or '%s' ='')
     and (send_date='%s' or '%s' ='')
  order by create_date desc";


  $sql=sprintf($sql,
		$VerifyCode,$VerifyCode,
		$ReceiptName,$ReceiptName,
		$ReceiptAccountName,$ReceiptAccountName,
		$Year,$Year,
		$Month, $Month,
		$Day,$Day,
		$Region,$Region,
		$OrderNo, $OrderNo,
		$TransferDate,$TransferDate,
		$SendDate,$SendDate);

  $sumsql=sprintf($sumsql,
		$VerifyCode,$VerifyCode,
		$ReceiptName,$ReceiptName,
		$ReceiptAccountName,$ReceiptAccountName,
		$Year,$Year,
		$Month, $Month,
		$Day,$Day,
		$Region,$Region,
		$OrderNo, $OrderNo,
		$TransferDate,$TransferDate,
		$SendDate,$SendDate);
	//echo $sql;
}elseif($_SERVER['REQUEST_METHOD']=='GET'){
	 $sql="SELECT * FROM  dx_detail where order_no='%s'
  	 order by create_date desc";
	 $sql=sprintf($sql,$OrderNo);
}?>
<div class="boxcontent">
<?
mysql_query("SET NAMES UTF8"); 
	$sumresult=mysql_query($sumsql);
	$sum_count="";
	$sum_fare="";
	$sum_fee="";
	$sum_payment_collection="";
	$sum_indeed_transfer_amount="";
	$sum_payment_minus="";
	echo "<div>";
	if($sumrow=mysql_fetch_array($sumresult)){
		$sum_count=$sumrow[sum_count];
		$sum_fare=$sumrow[sum_fare];
		$sum_fee=$sumrow[sum_fee];
		$sum_payment_collection=$sumrow[sum_payment_collection];
		$sum_indeed_transfer_amount=$sumrow[sum_indeed_transfer_amount];
		$sum_payment_minus=$sumrow[sum_payment_minus];
	}
	$blank="&nbsp&nbsp&nbsp&nbsp";
	echo "总记录数:".$sum_count.$blank;
	echo "总运费:".$sum_fare.$blank;
	echo "总代收货款:".$sum_payment_collection.$blank;
	echo "总减货款:".$sum_payment_minus.$blank;
	echo "总手续费:".$sum_fee.$blank;
	echo "总实际转账:".$sum_indeed_transfer_amount.$blank;
	echo "</div>";
?>
<div style="font-size:10pt;color:red">提示:非当日订单以及被管理员编辑过后的订单将被锁定，不能被删除／编辑</div>
<table class="detail" style="width:800px">
	<thead>
		<tr>
			<td>操作</td>
			<td>锁定?</td>
			<td>年</td>
			<td>月</td>
			<td>日</td>
			<td>条形单码</td>
			<td>区域</td>
			<td>派货人</td>
			<td>数量</td>
			<td>运费</td>
			<td>已付</td>
			<td>付款人</td>
			<td>收款人</td>
			<td>帐号名</td>
			<td>验证码</td>  
			<td>代收货款</td>
			<td>减货款</td>
			<td>手续费</td>
			<td>实际转账</td>  
			<td>转账日期</td>
			<td>收款日期</td>
			<td>创建人</td>
			<td>最后更新人</td>
			<td>备注</td>	
		</tr>
	</thead>
	<tbody>


<?
	function isTodayRow($r){
		$y=$r[year];
		$m=$r[month];
		$d=$r[day];
		return $y==$cur_year&&$m==$cur_mon&&$d==$cur_day; 
	}
	
	mysql_query("SET NAMES UTF8"); 
	$result=mysql_query($sql);
	while($row=mysql_fetch_array($result)){
	//$isNotEdit=(!isAdmin($metinfo_member_name)) and ($row[is_locked_by_admin]==1);
	$op="<tr>
		<td><a href='javascript:editCustomer(\"".$row[order_no]."\")'>编辑</a>
		<a href='javascript:deleteCustomer(\"".$row[order_no]."\")'>删除</a></td>";
	if(!isAdmin($metinfo_member_name)){
		if(($row[is_locked_by_admin]==1)||(!isTodayRow($row))){
				$op="<tr><td></td>";
			}
			
	}
	echo $op.
  		"<td>".(($row[is_locked_by_admin]==1||(!isTodayRow($row)))?"是":"否")."</td>
	    <td>".$row[year]."</td>
		<td>".$row[month]."</td>
		<td>".$row[day]."</td>  
		<td>".$row[order_no]."</td> 
		<td>".$row[region]."</td>
		<td>".$row[send_by]."</td>
		<td>".$row[count]."</td>
		<td>".$row[fare]."</td>
		<td>".$row[payed_amount]."</td>
		<td>".$row[payed_by]."</td>
		<td>".$row[receipt_name]."</td>
		<td>".$row[receipt_account_name]."</td>
		<td>".$row[verify_code]."</td>
		<td>".$row[payment_collection]."</td>
		<td>".$row[payment_minus]."</td>
		<td>".$row[fee]."</td>
		<td>".$row[indeed_transfer_amount]."</td>
		<td>".$row[transfer_date]."</td>
		<td>".$row[send_date]."</td>
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
function deleteCustomer(orderNo){
   if(confirm("确认删除订单:"+orderNo+"的信息?")){
		window.location.href="deleteorder.php?orderNo="+orderNo;	
   }	
}
function editCustomer(orderNo){
	window.location.href="editorder.php?orderno="+orderNo;	
}
$(document).ready(function(){
	var txtTransfferDateInput=$("#txtTransferDate");
	var txtSendDateInput=$("#txtSendDate");
	if(txtTransfferDateInput.length>0){
			txtTransfferDateInput.datepicker({
            dateformat: "yy/mm/dd"
        });
	}
	if(txtSendDateInput.length>0){
		txtSendDateInput.datepicker({
			dateformat:"yy/mm/dd"
		});
	}		
});

function getPrintHtml() {
	return $(".boxcontent").html();
}
function openPrintWin() {
	var h = $(window).height(); 
	var w = $(window).width(); 
	window.open("printorderlist.php","",'toolbar=no ,location=0, status=no, titlebar=no, menubar=no width=+'+w+", height="+h);
}
</script>

