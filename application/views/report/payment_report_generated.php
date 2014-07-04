
<div class="span12">
<strong><h2>Payment Report </h2></strong>
<table>
	<tr>
		<td width="40%"><strong>Payment Type</strong></td><td>:</td><td><strong><?php echo $payment?></td>
	</tr>
	<tr>
		<td><strong>Cashier </strong></td><td>:</td><td><strong><?php echo ucfirst($user)?></td>
	</tr>
	<tr>
		<td><strong>Date </strong></td><td>:</td><td><strong><?php echo date('d-m-Y', strtotime($start)).' s/d '.date('d-m-Y', strtotime($end));?></td>
	</tr>
	<tr>
		<td colspan="3"><?php echo anchor('report/generate/payment_pdf/'.$payment.'/'.$user.'/'.$start.'/'.$end,'Download as PDF');?></td>
	</tr>
</table>

	<div id="myTabContent" class="tab-content">
	<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered">
		<thead>
			<tr>
				<th rowspan="2" style="vertical-align:middle">No</th>
				<th rowspan="2" style="vertical-align:middle">Payment Code</th>
				<th rowspan="2" style="vertical-align:middle">Rate</th>
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
		</thead>
		<tbody>
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
			{ $foc_idr = $row_pay->rb_total_rp;
			  $foc_usd = $row_pay->rb_total; } else
			if ($row_pay->rb_payment_type == 'Hutang')
			{ $ar_idr = $row_pay->rb_paid_idr;
			  $ar_usd = $row_pay->rb_paid_usd; }
			  
			if ($row_pay->rb_payment_type_2 == 'Credit_Card')
			{ $ccard_idr = $row_pay->rb_paid_idr_2;
			  $ccard_usd = $row_pay->rb_paid_usd_2; } else 
			if ($row_pay->rb_payment_type_2 == 'Debit_Card')
			{ $dcard_idr = $row_pay->rb_paid_idr_2;
			  $dcard_usd = $row_pay->rb_paid_usd_2; } else
			if ($row_pay->rb_payment_type_2 == 'Hutang')
			{ $ar_idr = $row_pay->rb_paid_idr_2;
			  $ar_usd = $row_pay->rb_paid_usd_2; } 
			  
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
				<td align="center"><?php echo $num++;?></td>
				<td><?php echo $row_pay->rb_pay_code;?></td>
				<td><?php echo number_format($row_pay->rb_rate, 0, ',', '.');?></td>
				<td align="right"><?php echo number_format($foc_idr, 2, ',', '.');?></td>
				<td align="right"><?php echo number_format($foc_usd, 3, ',', '.');?></td>
				<td align="right"><?php echo number_format($cash_idr, 2, ',', '.');?></td>
				<td align="right"><?php echo number_format($cash_usd, 3, ',', '.');?></td>
				<td align="right"><?php echo number_format($ccard_idr, 2, ',', '.');?></td>
				<td align="right"><?php echo number_format($ccard_usd, 3, ',', '.');?></td>
				<td align="right"><?php echo number_format($dcard_idr, 2, ',', '.');?></td>
				<td align="right"><?php echo number_format($dcard_usd, 3, ',', '.');?></td>
				<td align="right"><?php echo number_format($ar_idr, 2, ',', '.');?></td>
				<td align="right"><?php echo number_format($ar_usd, 3, ',', '.');?></td>
				<td align="right"><?php echo number_format(($row_pay->rb_paid_idr + $row_pay->rb_paid_idr_2), 2, ',', '.');?></td>
				<td align="right"><?php echo number_format(($row_pay->rb_paid_usd + $row_pay->rb_paid_usd_2), 3, ',', '.');?></td>
			</tr>
		<?php } }?>
        </tbody>
		<tfoot>
			<tr>
				<td align="right" colspan="3">TOTAL</td>
				<td align="right"><?php echo number_format($tot_foc_idr, 2, ',', '.');?></td>
				<td align="right"><?php echo number_format($tot_foc_usd, 3, ',', '.');?></td>
				<td align="right"><?php echo number_format($tot_cash_idr, 2, ',', '.');?></td>
				<td align="right"><?php echo number_format($tot_cash_usd, 3, ',', '.');?></td>
				<td align="right"><?php echo number_format($tot_ccard_idr, 2, ',', '.');?></td>
				<td align="right"><?php echo number_format($tot_ccard_usd, 3, ',', '.');?></td>
				<td align="right"><?php echo number_format($tot_dcard_idr, 2, ',', '.');?></td>
				<td align="right"><?php echo number_format($tot_dcard_usd, 3, ',', '.');?></td>
				<td align="right"><?php echo number_format($tot_ar_idr, 2, ',', '.');?></td>
				<td align="right"><?php echo number_format($tot_ar_usd, 3, ',', '.');?></td>
				<td align="right"><?php echo number_format($tot_idr, 2, ',', '.');?></td>
				<td align="right"><?php echo number_format($tot_usd, 3, ',', '.');?></td>
			</tr>
		</tfoot>
    </table>
	</div>
</div>
</div>