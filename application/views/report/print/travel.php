<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>The Banjar Bali | Reservation System | Travel Report</title>

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
			<td><strong>Travel Report</strong></td><td>:</td><td><strong><?php echo date('d-m-Y', strtotime($start)).' s/d '.date('d-m-Y', strtotime($end));?></td>
		</tr>
		<tr>
			<td width="40%"><strong>Travel Code</strong></td><td>:</td><td><strong><?php echo $travel?></td>
		</tr>
	</table>
					
	<table class="gridtable" width="100%">
			<tr>
				<th>No</th>
				<th>Travel</th>
				<th>Date</th>
				<th>Pax</th>
			</tr>
		<?php 
		if ($travel_list != NULL)
		{
		$num = 1;
		foreach ($travel_list as $row_prd)
		{
			?>
			<tr>
				<td><div align="center"><?php echo $num++;?></div></td>
				<td><?php echo $row_prd->trv_name;?></td>
				<td><div align="center"><?php echo date('d-M-Y', strtotime($row_prd->res_date));?></div></td>
				<td><div align="center"><?php echo $row_prd->sum;?></div></td>
			</tr>
		<?php } }?>
    </table>
</body>
</html>
