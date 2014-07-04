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
            <td><strong>Payment Report</strong></td><td> : </td><td><strong><?php echo strtoupper(mdate("%d-%M-%Y", strtotime($start))); ?> s/d <?php echo strtoupper(mdate("%d-%M-%Y", strtotime($end))); ?></strong></td>
		</tr>
		<tr>
			<td><strong>Payment Type</td><td> : </td><td><strong><?php echo $payment;?></strong></td>
		</tr>
		<tr>
			<td><strong>User</td><td> : </td><td><strong><?php echo ucfirst($user);?><strong></td>
		</tr>
	</table>				
	<table class="gridtable" width="100%">
			<tr>
				<th rowspan="2">No</th>
				<th rowspan="2">Payment Code</th>
				<th rowspan="2">Reservation Code</th>
				<th rowspan="2">Travel</th>
				<th rowspan="2">Guide</th>
				<th colspan="2">Paid</th>
				<th colspan="2">Receivable / AR</th>
				<th rowspan="2">Status</th>
			</tr>
			<tr>
				<th>IDR</th>
				<th>USD</th>
				<th>IDR</th>
				<th>USD</th>
			</tr>
		<?php 
		$tot_ar_idr = 0;
		$tot_ar_usd = 0;
		$tot_idr = 0;
		$tot_usd = 0;
		$unpaid_usd = 0;
		$unpaid_idr = 0;
		$paid_usd = 0;
		$paid_idr = 0;
		$status = '';
		if ($pay_list != NULL)
		{
		$num = 1;
		foreach ($pay_list as $row_pay)
		{
			$ar_idr = 0;
			$ar_usd = 0;
			if ($row_pay->rb_payment_type == 'Hutang')
			{ $ar_idr  = $row_pay->rb_paid_idr;   
			  $ar_usd = $row_pay->rb_paid_usd; }
			
			if ($row_pay->rb_payment_type_2 == 'Hutang')
			{ $ar_idr  = $row_pay->rb_paid_idr_2;
			  $ar_usd = $row_pay->rb_paid_usd_2; }
			  
			if ($row_pay->rb_status == 'open')
			{
				$status = anchor('report/generate/paid_debt/'.$row_pay->id_res_bill,'pay debt');
				$unpaid_idr = $unpaid_idr + $ar_idr;
				$unpaid_usd = $unpaid_usd + $ar_usd;
			} else {
				$status = 'paid';
				$paid_idr = $paid_idr + $ar_idr;
				$paid_usd = $paid_usd + $ar_usd;
			}
			
			?>
			<tr>
				<td align="center"><?php echo $num++;?></td>
				<td><?php echo $row_pay->rb_pay_code;?></td>
				<td><?php echo $row_pay->res_code;?></td>
				<td><?php echo $row_pay->res_agent;?></td>
				<td><?php echo $row_pay->res_guide;?></td>
				<?php if ($row_pay->rb_status == 'open') { 
					echo '<td><div align="right">0,00</td><td><div align="right">0,000</td>'; ?>
					<td><div align="right"><?php echo number_format($ar_idr, 2, ',', '.');?></div></td>
					<td><div align="right"><?php echo number_format($ar_usd, 3, ',', '.');?></div></td>
				<?php } else { ?>
					<td><div align="right"><?php echo number_format($ar_idr, 2, ',', '.');?></div></td>
					<td><div align="right"><?php echo number_format($ar_usd, 3, ',', '.');?></div></td>
				<?php echo '<td><div align="right">0,00</td><td><div align="right">0,000</td>'; }?>
				<td><div align="center"><?php echo $status;?></div></td>
			</tr>
		<?php } }?>
			<tr>
				<td colspan="5"><div align="right">TOTAL</div></td>
				<td><div align="right"><?php echo number_format($paid_idr, 2, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format($paid_usd, 3, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format($unpaid_idr, 2, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format($unpaid_usd, 3, ',', '.');?></div></td>
				<td></td>
			</tr>
    </table>
</body>
</html>
