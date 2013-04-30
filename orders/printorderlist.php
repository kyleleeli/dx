<html>
	<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<script src="scripts/jquery-1.8.3.js"></script>
	<style>
		 body {width:1024px;}
		 table.detail { border: solid 1px #A7C2E7; margin: 5px 2%; width: 85%; border-collapse: collapse; }
		 table.detail thead { color: #407ACA; font-weight: bold; background-color: #FDF9C5; }
		 table.detail td { border: solid 1px #A7C2E7; line-height: 22px; text-align: center; padding: 2px; white-space:nowrap;}
		 table.detail td.tleft {text-align: left;}
		 table.detail td.tright {text-align: right;}
		 table.detail td input {border-width: 0px 0px 1px 0px; border-bottom: dotted 1px gray;}		
	</style>
	</head>
	<body>
		<button id="btnPrint" onclick="javascript:window.print()">点此开始打印</button>
	</body>
</html>
<script language="javascript">
	$(document).ready(function () {
		var opener=window.opener;
		if(opener){
			var html=opener.getPrintHtml();
			$("body").append(html);
			$("table tr").each(function(){
				$(this).find("td:gt(20)").remove();
				$(this).find("td").eq(0).remove();
				$(this).find("td").eq(0).remove();
			}); 
		}
	});
</script>