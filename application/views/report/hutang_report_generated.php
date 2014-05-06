
<div class="span12">
<strong><h2>Hutang Report </h2></strong>
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
		<td colspan="3"><?php echo anchor('report/generate/hutang_pdf/'.$user.'/'.$start.'/'.$end,'Download as PDF');?></td>
	</tr>
</table>

	<div id="myTabContent" class="tab-content">
	<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered">
		<thead>
			<tr>
				<th rowspan="2">No</th>
				<th rowspan="2">Payment Code</th>
				<th rowspan="2">Reservation Code</th>
				<th rowspan="2">Travel</th>
				<th rowspan="2">Guide</th>
				<th colspan="2">Receivable / AR</th>
			</tr>
			<tr>
				<th>IDR</th>
				<th>USD</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$tot_ar_idr = 0;
		$tot_ar_usd = 0;
		$tot_idr = 0;
		$tot_usd = 0;
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
			  
			$tot_ar_idr = $tot_ar_idr + $ar_idr;
			$tot_ar_usd = $tot_ar_usd + $ar_usd;
			
			$tot_idr = $tot_ar_idr;
			$tot_usd = $tot_ar_usd;
			
			?>
			<tr>
				<td align="center"><?php echo $num++;?></td>
				<td><?php echo $row_pay->rb_pay_code;?></td>
				<td><?php echo $row_pay->res_code;?></td>
				<td><?php echo $row_pay->res_agent;?></td>
				<td><?php echo $row_pay->res_guide;?></td>
				<td align="right"><?php echo number_format($ar_idr, 2, ',', '.');?></td>
				<td align="right"><?php echo number_format($ar_usd, 2, ',', '.');?></td>
			</tr>
		<?php } }?>
        </tbody>
		<tfoot>
			<tr>
				<td align="right" colspan="5">TOTAL</td>
				<td align="right"><?php echo number_format($tot_ar_idr, 2, ',', '.');?></td>
				<td align="right"><?php echo number_format($tot_ar_usd, 2, ',', '.');?></td>
			</tr>
		</tfoot>
    </table>
	</div>
</div>
</div>