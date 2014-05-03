<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>The Banjar Bali | Reservation System | Payment Report</title>

<style type="text/css">
html {
	margin : 10px;
}

table.gridtable {
	font-family: times,arial,sans-serif;
	font-size:14px;
	color:#333333;
	border-width: 1px;
	border-color: #666666;
	border-collapse: collapse;
	margin-top:10px;
	margin-bottom:2px;
	border-top: 1px solid;
	height:auto;
	
}
table.gridtable th {
	border-width: 1px;
	padding: 4px;
	border-style: solid;
	border-color: #666666;
	background-color: #eee;
	height:auto;
	border-bottom:1px solid;
	border-top:1px solid;
}
table.gridtable td {
	border-width: 1px;
	padding: 2px;
	border-style: solid;
	border-color: #666666;
	border-bottom: 1px solid;
	background-color: #ffffff;
	text-align: left;
	height:auto;
}
</style>


</head>
<body>
	<table> 
		<tr>
			<td width="40%" colspan="3"><strong>The Banjar Bali</strong></td>
		</tr>
		<tr>
            <td colspan="3"><strong>Reservation System</strong></td>
		</tr>
		<tr>
			<td><strong>Therapist Report</strong></td><td>:</td><td><strong><?php echo date('d-m-Y', strtotime($start)).' s/d '.date('d-m-Y', strtotime($end));?></td>
		</tr>
		<tr>
			<td width="40%"><strong>Therapist Code</strong></td><td>:</td><td><strong><?php echo $user?></td>
		</tr>
	</table>
					
	<table class="gridtable" width="100%">
			<tr>
				<th>No</th>
				<th>Therapist</th>
				<th>Date</th>
				<th>Total</th>
			</tr>
		<?php 
		if ($therapist_list != NULL)
		{
		$num = 1;
		foreach ($therapist_list as $row_thr)
		{
			?>
			<tr>
				<td><div align="center"><?php echo $num++;?></div></td>
				<td><?php echo $row_thr->thr_name;?></td>
				<td><div align="center"><?php echo date('d-M-Y', strtotime($row_thr->thw_date));?></div></td>
				<td><div align="center"><?php echo $row_thr->times;?></div></td>
			</tr>
		<?php } }?>
    </table>
</body>
</html>
