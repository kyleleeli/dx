
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
	<form method="POST" action="submitreturn.php?action=addbyrows">
		<table style="width:80%" class="detail">
			<thead>
				<tr><td colspan="20">录入退货信息 <input type="button" value="提交"  id="btnSubmit"/> <input type="button" value="新增一行" style="width:100px" id="btnAddRow"/>  <input type="button"  id="btnDelRow" value="删除选择行" style="width:100px"/> </td>
										
				</tr>
				<tr>
					<td>选择</td>
					<td>日期</td>
					<td>退货人</td>
					<td>数量</td>
					<td>单号</td>
				 	<td>退货费</td>
					<td>区域</td>
					<td>所在仓库</td>					
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
					<td><input type="text" id="txtReturnBy_1" name="ReturnBy_1"/></td>
					<td><input type="text" id="txtCount_1" name="Count_1"/></td>
					<td><input type="text" id="txtOrderNo_1" name="OrderNo_1" style="width:70px" data-valid-name="OrderNo"/></td>
					<td><input type="text" id="txtReturnFee" name="ReturnFee_1"/></td>
					<td><input type="text" id="txtRegion_1" name="Region_1"/></td>
					<td><input type="text" id="txtWarehouse_1" name="Warehouse_1" style="width:70px" /></td>
					<td><input type="text" id="txtRemark_1" name="Remark_1" style="width:200px"/></td>
				</tr>
			</tbody>
		</table>
		<input id="txtRowCount" name="RowCount" type="hidden" value="1"/>
	</form>
</div>
</body>
</html>
<script src="jquery-1.8.3.js"></script>
<script language="javascript">
	var trTemplate=$("#tbInput tr").first().clone();
	var tbInput=$("#tbInput")
	function refreshIdAndName(){
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
			})
					
		});
		$("#txtRowCount").val(trS.length);		
	}
	$(document).ready(function(){		
		$("#btnAddRow").click(function(){
			var rowCount=tbInput.find("tr").length;
			var index=rowCount+1;
			var tr=$(trTemplate).clone();
			tbInput.append(tr);
			refreshIdAndName()
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
				  url: "submitreturn.php?action=addbyrows",
				  data:$("form").serialize(),
				  success: function(s){
				  	alert("提交成功！");
					window.location.href="returnlist.php";
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
		}
		return flag;	
	}
</script>

















