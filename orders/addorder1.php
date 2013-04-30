
<html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<style>
	body {width:1024px;}
	.boxcontent{width:50%}
	.boxcontent table.detail { border: solid 1px #A7C2E7; margin: 5px 2%; width: 85%; border-collapse: collapse; }
	.boxcontent table.detail thead { color: #407ACA; font-weight: bold; background-color: #FDF9C5; }
	.boxcontent table.detail tr.checked { background-color: #FDF9C5;  }
	.boxcontent table.detail tr.error { background-color:red;  }		
	.boxcontent table.detail td { border: solid 1px #A7C2E7; line-height: 22px; text-align: center; padding: 0px; white-space:nowrap;}
	.boxcontent table.detail td.tleft {text-align: left;}
	.boxcontent table.detail td.tright {text-align: right;}
	.boxcontent table.detail td input {width:50px;border-width: 0px 0px 1px 0px; border-bottom: dotted 1px gray;}		
	</style>
	</head>
<body>
<?php 
	require_once './header.php';	
?>
<div class="boxcontent">
	<form method="POST" action="submitorder.php?action=addbyrows">
		<table style="width:80%" class="detail">
			<thead>
				<tr><td colspan="20">录入订单信息 <input type="button" value="提交"  id="btnSubmit"/> <input type="button" value="新增一行" style="width:100px" id="btnAddRow"/>  <input type="button"  id="btnDelRow" value="删除选择行" style="width:100px"/> </td>
										
				</tr>
				<tr>
					<td>选择</td>
					<td>日期</td>
					<td>条码单号</td>
				 	<td>区域</td>
					<td>派货人</td>
					<td>数量</td>
					<td>运费</td>
				 	<td>已付</td>
					<td>付款人</td>
			  		<td>验证码</td>
					<td>收款人</td>
			 		<td>帐号名</td>
					<td>代收货款</td>
			 		<td>减货款</td>
					<td>手续费</td>
	 				<!--<td>实际转账</td>
					<td>转帐日期</td>
	 				<td>收款日期</td>-->
					<td>备注</td>
				</tr>
			</thead>			
			<tbody id="tbInput">
				<tr id="row_1" index="1">
					<td><input type="checkbox" name="chkrow_1" style="width:20px" id="chkrow_1" onclick="javascript:checkRow(this)"/></td>
					<td>
					    <input type="text" id="txtYear_1" name="Year_1" value="2013"  style="width:30px" name="Year" />年<select  id="txtMonth_1" name="Month_1">
						<options>
						<?
						$index=1;
						$tmp_date=date("Ym");
						$cur_mon =substr($tmp_date,4,2);//当前月份
						echo $cur_mon;
						 for(;$index<13;$index++){
							if($cur_mon==$index){						
								echo "<option value='".$index."' selected='selected'>".$index."</option>";

							}else{
								echo "<option value='".$index."'>".$index."</option>";
							}
						 }
						?>
						</options>	
					</select>月
					<input type="text" id="txtDay_1" value="<?echo $cur_day?>"  style="width:20px" name="Day_1"/>日
					</td>
					<td><input type="text" id="txtOrderNo_1" name="OrderNo_1" style="width:70px" data-valid-name="OrderNo"/></td>
					<td><input type="text" id="txtRegion_1" name="Region_1"/></td>
					<td><input type="text" id="txtSendBy_1" name="SendBy_1"/></td>
					<td><input type="text" id="txtCount_1" name="Count_1" style="width:100px"/></td>
					<td><input type="text" id="txtFare_1" name="Fare_1"/></td>
					<td><input type="text" id="txtPayedAmount_1" name="PayedAmount_1"/></td>
					<td><input type="text" id="txtPayedBy_1" name="PayedBy_1" style="width:70px" /></td>
					<td><input type="text" id="txtVerifyCode_1" name="VerifyCode_1" data-valid-name="VerifyCode"/></td>
					<td><input type="text" id="txtReceiptName_1" name="ReceiptName_1" style="width:70px" data-valid-name="ReceiptName"/></td>
					<td><input type="text" id="txtReceiptAccountName_1" name="ReceiptAccountName_1"/></td>
					<td><input type="text" id="txtPaymentCollection_1" name="PaymentCollection_1"/></td>
					<td><input type="text" id="txtPaymentMinus_1" name="PaymentMinus_1"/></td>
					<td><input type="text" id="txtFee_1" name="Fee_1"/></td>
					<!--<td><input type="text" id="txtIndeedTransferAmount_1" name="IndeedTransferAmount_1"/></td>
					<td><input type="text" id="txtTransferDate_1" name="TransferDate_1"/></td>
					<td><input type="text" id="txtSendDate_1" name="SendDate_1"/></td>-->
					<td><input type="text" id="txtRemark_1" name="Remark_1" style="width:200px"/></td>
				</tr>
			</tbody>
		</table>
		<input id="txtRowCount" name="RowCount" type="hidden" value="1"/>
	</form>
</div>
</body>
</html>
<script language="javascript">
	var trTemplate=$("#tbInput tr").first().clone();
	var tbInput=$("#tbInput")
	function refreshIdAndNameAndBindEvents(){
		var trS=tbInput.find("tr");
		trS.each(function(i,t){
			var tr=$(this);
			var index=i+1;
			tr.attr("id","row_"+index).attr("index",index);
			tr.find("input,select").each(function(i,t){
				var e=$(this);
				var namePrefix=e.attr("name").split("_")[0];
				var idPrefix=e.attr("id").split("_")[0]	;
				var name=namePrefix+"_"+index;
				var id=idPrefix+"_"+index;
				e.attr("id",id);
				e.attr("name",name);
			});
			var receiptName_input_name="ReceiptName_"+index;
			var verifyCode_input_name="VerifyCode_"+index;
			tr.find("input[name='"+receiptName_input_name+"']").focusout(function(){
				getCustomerInfo($(this),"ReceiptName")
			});
			tr.find("input[name='"+verifyCode_input_name+"']").focusout(function(){
				getCustomerInfo($(this),"VerifyCode")
			});
					
		});
		$("#txtRowCount").val(trS.length);		
	}
	$(document).ready(function(){
	refreshIdAndNameAndBindEvents();		
		$("#btnAddRow").click(function(){
			var rowCount=tbInput.find("tr").length;
			var index=rowCount+1;
			var tr=$(trTemplate).clone();
			tbInput.append(tr);
			refreshIdAndNameAndBindEvents()
		});
		$("#btnDelRow").click(function(){
			var trS=getCheckedRows();
			trS.remove();	
			refreshIdAndName()
		});
		$("form").submit(function(){
			return validation();				
		});
		
		$("#btnSubmit").click(function(){
			if(validation()){
				$.ajax({
				  type: "POST",
				  url: "submitorder.php?action=addbyrows",
				  data:$("form").serialize(),
				  success: function(s){
				  	alert("提交成功！");
					window.location.href="orderlist.php";
				  },
				 error:function(err){
					alert("提交失败！");
				 }
				});
			}
		});
	});

	function checkRow(target){
		var t=$(target);
		var tr=t.parent().parent();
		if(t.is(":checked")){
			tr.attr("checked","chekced").addClass("checked");		
		}else{
			tr.removeAttr("checked").removeClass("checked");
		}
	}

	function getCheckedRows(){
		return tbInput.find("tr[checked='checked']");
	}
	
	function validation(){
		var flag=true;
		$("input[data-valid-name='OrderNo']").each(function(i,e){
			var t=$(this)
			t.parent().parent().removeClass("error");						
			if($.trim(t.val())===''){
				flag=false;
				t.parent().parent().addClass("error")		
			}
		});
		if(!flag){
			alert("条形单号不能为空！");
			return flag;
		}
	
		$("input[data-valid-name='ReceiptName']").each(function(i,e){
			var t=$(this)
			t.parent().parent().removeClass("error");						
			if($.trim(t.val())===''){
				flag=false;
				t.parent().parent().addClass("error")		
			}
		});
		if(!flag){
			alert("收款人不能为空！");
			return flag;
		}
		$("input[data-valid-name='VerifyCode']").each(function(i,e){
			var t=$(this)
			t.parent().parent().removeClass("error");						
			if($.trim(t.val())===''){
				flag=false;
				t.parent().parent().addClass("error")		
			}
		});
		if(!flag){
			alert("验证码不能为空！");
			return flag;
		}
		return flag;

			
	}

	function getCustomerInfo(target,getBy){
		var inputVal=target.val();
		if(inputVal!==''){
			var url="ajaxgetcustomer.php?";
			if(getBy==='ReceiptName'){
				url=url+"GetBy=ReceiptName"+"&ReceiptName="+inputVal;
			}else{
				url=url+"GetBy=VerifyCode"+"&VerifyCode="+inputVal;
			}
			$.ajax({
				type:"GET",
				url:url,
				success:function(resp){
					var arr=resp.split("^");
					var flag=arr[0];
					var verifyCode=arr[1];
					var receiptName=arr[2];
					var accountName=arr[3];
					var row=target.parent().parent();
					if(flag==="0"){
						alert("对应的客户信息不存在");
						row.find("input[name^='ReceiptName_']").val(receiptName);	
						row.find("input[name^='ReceiptAccountName_']").val(accountName);
						row.find("input[name^='VerifyCode_']").val(verifyCode);
					}else{
						row.find("input[name^='ReceiptName_']").val(receiptName);	
						row.find("input[name^='ReceiptAccountName_']").val(accountName);
						row.find("input[name^='VerifyCode_']").val(verifyCode);
					}
				
				},
				error:function(err){
					alert("对应的客户信息不存在");
					var row=target.parent().parent();
					row.find("input[name^='ReceiptName_']").val("");	
					row.find("input[name^='ReceiptAccountName_']").val("");
					row.find("input[name^='VerifyCode_']").val("");
				}
			});
		}
	}
</script>

















