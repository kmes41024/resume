<?php  
	require_once("encoding.php");
	require_once("db/conn.php");
	
	$uid = 1;
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>resume_list</title>

  <link href="assets/css/root.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
	<div class="panel panel-default">
		<div class="panel-title" style = "font-size:22px;">
			Resume_List
		</div>
		<div class="panel-body table-responsive">
			<table id="example0" class="table display" style = "font-size:22px;">
				<thead>
					<tr>
						<th>编号</th>
						<th>版本</th>
						<th>报告生产日期</th>
						<th>支付方式</th>
						<th>购买价格</th>
						<th>按键区</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$sql = "SELECT *  FROM `t_member_resume` WHERE `f_user_id` = ".$uid;
						$rs = $conn->execute($sql);
						$len = count($rs);
						
						if(count($rs)>0)
						{	
							for($i = 1; $i <= $len; $i++)
							{
								echo "<tr><td align = center>";
								echo $i;
								echo "</td>";
								
								if($rs[$i-1]['f_edition'] == 'vip')
								{
									echo "<td class = 'resume_td'>强胜版履历</td>";
								}
								else if($rs[$i-1]['f_edition'] == 'advance')
								{
									echo "<td class = 'resume_td'>吸睛版履历</td>";
								}
								else if($rs[$i-1]['f_edition'] == 'basic')
								{
									echo "<td class = 'resume_td'>经典版履历</td>";
								}
								
								if($rs[$i-1]['f_completetime'] != NULL)
								{
									echo "<td class = 'resume_td'>".$rs[$i-1]['f_completetime']."</td>";
								}
								else if($rs[$i-1]['f_completetime'] == NULL)
								{
									echo "<td></td>";
								}
								
								$sql_2 = "SELECT *  FROM `t_pay_order` WHERE `f_payOid` = ".$rs[$i-1]['f_payOid'];
								$rs_2 = $conn->execute($sql_2);
								
								echo "<td class = 'resume_td'>".$rs_2[0]['f_payWay']."</td>";
								echo "<td class = 'resume_td'>".$rs_2[0]['f_payPrice']."</td>";
								
								if($rs[$i-1]['f_completetime'] == NULL)
								{
									echo "<td class = 'edit_td'><pre><button type = 'button' style = 'width:6.2cm;' onclick = edit({$rs[$i-1]['id']})>编辑履历</button></pre></td>";
								}
								else
								{
									echo "<td class = 'edit_td'><pre><button type = 'button' onclick = 'review(\"{$rs[$i-1]['f_resume_path']}\")'>查看报告</button>      ";
									echo "<a href='".$rs[$i-1]['f_resume_path']."' id='download' download = 'resume.pdf' style = 'color:black;'><button type = 'button' id = 'btn'>下载报告</button></a></pre></td>";
								}
								echo "</tr>";
							}
						}
				    ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="modal" id="reviewModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" style="width:1200px">
			<div class="modal-content">
				<div class="modal-header" align="center">
					<font style="font-family:'思源黑体 CN NORMAL';font-size:20px;color:#000" class="m-modal-title"><label id="reviewModel_title"></label></font>
				</div>
				<div class="modal-body" align="center">
					<iframe src=""></iframe>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal" onclick="exitPreview()">离开</button>
				</div>
			</div>
		</div>
	</div>	
</body> 
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins.js"></script>
	<script src="assets/js/datatables/datatables.min.js"></script>
	<script src="layui/layui.all.js"></script>
	<script src="assets/css/main.js"></script>
</html>