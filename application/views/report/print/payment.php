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
				<th colspan="2">Compliment / FOC</th>
				<th colspan="2">Cash</th>
				<th colspan="2">Credit Card</th>
				<th colspan="2">Debit Card</th>
				<th colspan="2">Receivable / AR</th>
				<th colspan="2">Total</th>
			</tr>
			<tr>
				<th>IDR</th>
				<th>USD</th>
				<th>IDR</th>
				<th>USD</th>
				<th>IDR</th>
				<th>USD</th>
				<th>IDR</th>
				<th>USD</th>
				<th>IDR</th>
				<th>USD</th>
				<th>IDR</th>
				<th>USD</th>
			</tr>
		<?php 
		$tot_foc_idr = 0;
		$tot_foc_usd = 0;
		$tot_cash_idr = 0;
		$tot_cash_usd = 0;
		$tot_ccard_idr = 0;
		$tot_ccard_usd = 0;
		$tot_dcard_idr = 0;
		$tot_dcard_usd = 0;
		$tot_ar_idr = 0;
		$tot_ar_usd = 0;
		$tot_idr = 0;
		$tot_usd = 0;
		if ($pay_list != NULL)
		{
		$num = 1;
		foreach ($pay_list as $row_pay)
		{
			$foc_idr = 0;
			$foc_usd = 0;
			$cash_idr = 0;
			$cash_usd = 0;
			$ccard_idr = 0;
			$ccard_usd = 0;
			$dcard_idr = 0;
			$dcard_usd = 0;
			$ar_idr = 0;
			$ar_usd = 0;
			
			if ($row_pay->rb_payment_type == 'Cash')
			{ $cash_idr = $row_pay->rb_paid_idr;   
			  $cash_usd = $row_pay->rb_paid_usd; } else 
			if ($row_pay->rb_payment_type == 'Credit_Card')
			{ $ccard_idr = $row_pay->rb_paid_idr;
			  $ccard_usd = $row_pay->rb_paid_usd; } else 
			if ($row_pay->rb_payment_type == 'Debit_Card')
			{ $dcard_idr = $row_pay->rb_paid_idr;
			  $dcard_usd = $row_pay->rb_paid_usd; } else
			if ($row_pay->rb_payment_type == 'FOC')
			{ $foc_idr = $row_pay->rb_paid_idr;
			  $foc_usd = $row_pay->rb_paid_usd; }
			  
			if ($row_pay->rb_payment_type_2 == 'Cash')
			{ $cash_idr = $row_pay->rb_paid_idr_2;   
			  $cash_usd = $row_pay->rb_paid_usd_2; } else 
			if ($row_pay->rb_payment_type_2 == 'Credit_Card')
			{ $ccard_idr = $row_pay->rb_paid_idr_2;
			  $ccard_usd = $row_pay->rb_paid_usd_2; } else 
			if ($row_pay->rb_payment_type_2 == 'Debit_Card')
			{ $dcard_idr = $row_pay->rb_paid_idr_2;
			  $dcard_usd = $row_pay->rb_paid_usd_2; } else
			if ($row_pay->rb_payment_type_2 == 'FOC')
			{ $foc_idr = $row_pay->rb_paid_idr_2;
			  $foc_usd = $row_pay->rb_paid_usd_2; }
			  
			$tot_cash_idr = $tot_cash_idr + $cash_idr;
			$tot_cash_usd = $tot_cash_usd + $cash_usd;
			$tot_ccard_idr = $tot_ccard_idr + $ccard_idr;
			$tot_ccard_usd = $tot_ccard_usd + $ccard_usd;
			$tot_dcard_idr = $tot_dcard_idr + $dcard_idr;
			$tot_dcard_usd = $tot_dcard_usd + $dcard_usd;
			$tot_foc_idr = $tot_foc_idr + $foc_idr;
			$tot_foc_usd = $tot_foc_usd + $foc_usd;
			$tot_ar_idr = $tot_ar_idr + $ar_idr;
			$tot_ar_usd = $tot_ar_usd + $ar_usd;
			
			$tot_idr = $tot_cash_idr + $tot_ccard_idr + $tot_dcard_idr + $tot_foc_idr + $tot_ar_idr;
			$tot_usd = $tot_cash_usd + $tot_ccard_usd + $tot_dcard_usd + $tot_foc_usd + $tot_ar_usd;
			
			?>
			<tr>
				<td><div align="center"><?php echo $num++;?></div></td>
				<td><?php echo $row_pay->rb_pay_code;?></td>
				<td><div align="right"><?php echo number_format($foc_idr, 2, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format($foc_usd, 2, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format($cash_idr, 2, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format($cash_usd, 2, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format($ccard_idr, 2, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format($ccard_usd, 2, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format($dcard_idr, 2, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format($dcard_usd, 2, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format($ar_idr, 2, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format($ar_usd, 2, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format(($row_pay->rb_paid_idr + $row_pay->rb_paid_idr_2), 2, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format(($row_pay->rb_paid_usd + $row_pay->rb_paid_usd_2), 2, ',', '.');?></div></td>
			</tr>
		<?php } }?>
			<tr>
				<td colspan="2"><div align="right">TOTAL</div></td>
				<td><div align="right"><?php echo number_format($tot_foc_idr, 2, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format($tot_foc_usd, 2, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format($tot_cash_idr, 2, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format($tot_cash_usd, 2, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format($tot_ccard_idr, 2, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format($tot_ccard_usd, 2, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format($tot_dcard_idr, 2, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format($tot_dcard_usd, 2, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format($tot_ar_idr, 2, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format($tot_ar_usd, 2, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format($tot_idr, 2, ',', '.');?></div></td>
				<td><div align="right"><?php echo number_format($tot_usd, 2, ',', '.');?></div></td>
			</tr>
    </table>
</body>
</html>
