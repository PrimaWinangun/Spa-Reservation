
<div class="span12">
<strong><h2>Payment Report </h2></strong>
<table>
	<tr>
		<td width="60%"><strong>Payment Type</strong></td><td>:</td><td><strong><?php echo $payment?></td>
	</tr>
	<tr>
		<td><strong>Cashier </strong></td><td>:</td><td><strong><?php echo ucfirst($user)?></td>
	</tr>
	<tr>
		<td><strong>Date </strong></td><td>:</td><td><strong><?php echo date('d-m-Y', now());?></td>
	</tr>
</table>

	<div id="myTabContent" class="tab-content">
	<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered">
		<thead>
			<tr>
				<th rowspan="2">No</th>
				<th rowspan="2">Payment Code</th>
				<th rowspan="2">Reservation Code</th>
				<th colspan="2">Payment Type</th>
				<th colspan="2">Harga</th>
				<th colspan="2">Discount</th>
				<th colspan="2">Tax</th>
				<th colspan="2">Subtotal</th>
			</tr>
			<tr>
				<th>Type 1</th>
				<th>Type 2</th>
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
		$subtotal_rate_idr = 0;
		$subtotal_rate_usd = 0;
		$subtotal_disc_idr = 0;
		$subtotal_disc_usd = 0;
		$subtotal_tax_idr = 0;
		$subtotal_tax_usd = 0;
		$subtotal_idr = 0;
		$subtotal_usd = 0;
		$total_idr = 0;
		$total_usd = 0;
		if ($pay_list != NULL)
		{
		$num = 1;
		foreach ($pay_list as $row_pay)
		{ 
			$subtotal_rate_idr = $subtotal_rate_idr + $row_pay->rb_total_rp;
			$subtotal_rate_usd = $subtotal_rate_usd + $row_pay->rb_total;
			$subtotal_disc_idr = $subtotal_disc_idr + $row_pay->rb_discount_rp;
			$subtotal_disc_usd = $subtotal_disc_usd + $row_pay->rb_discount;
			$subtotal_tax_idr = $subtotal_tax_idr + $row_pay->rb_tax_rp;
			$subtotal_tax_usd = $subtotal_tax_usd + $row_pay->rb_tax;
			$subtotal_idr = $row_pay->rb_total_rp - $row_pay->rb_discount_rp + $row_pay->rb_tax_rp;
			$subtotal_usd = $row_pay->rb_total - $row_pay->rb_discount + $row_pay->rb_tax;
			$total_idr = $total_idr + $subtotal_idr;
			$total_usd = $total_usd + $subtotal_usd;
			?>
			<tr>
				<td align="center"><?php echo $num++;?></td>
				<td><?php echo $row_pay->rb_pay_code;?></td>
				<td><?php echo $row_pay->rb_res_code;?></td>
				<td><?php echo $row_pay->rb_payment_type;?></td>
				<td><?php echo $row_pay->rb_payment_type_2;?></td>
				<td align="right"><?php echo number_format($row_pay->rb_total_rp, 2, ',', '.');?></td>
				<td align="right"><?php echo number_format($row_pay->rb_total, 2, ',', '.');?></td>
				<td align="right"><?php echo number_format($row_pay->rb_discount_rp, 2, ',', '.');?></td>
				<td align="right"><?php echo number_format($row_pay->rb_discount, 2, ',', '.');?></td>
				<td align="right"><?php echo number_format($row_pay->rb_tax_rp, 2, ',', '.');?></td>
				<td align="right"><?php echo number_format($row_pay->rb_tax, 2, ',', '.');?></td>
				<td align="right"><?php echo number_format($subtotal_idr, 2, ',', '.');?></td>
				<td align="right"><?php echo number_format($subtotal_usd, 2, ',', '.');?></td>
			</tr>
		<?php } }?>
        </tbody>
		<tfoot>
			<tr>
				<td colspan="5" align="right"><strong>TOTAL</strong></td>
				<td align="right"><?php echo number_format($subtotal_rate_idr, 2, ',', '.'); ?></td>
				<td align="right"><?php echo number_format($subtotal_rate_usd, 2, ',', '.'); ?></td>
				<td align="right"><?php echo number_format($subtotal_disc_idr, 2, ',', '.'); ?></td>
				<td align="right"><?php echo number_format($subtotal_disc_usd, 2, ',', '.'); ?></td>
				<td align="right"><?php echo number_format($subtotal_tax_idr, 2, ',', '.'); ?></td>
				<td align="right"><?php echo number_format($subtotal_tax_usd, 2, ',', '.'); ?></td>
				<td align="right"><?php echo number_format($total_idr, 2, ',', '.'); ?></td>
				<td align="right"><?php echo number_format($total_usd, 2, ',', '.'); ?></td>
			</tr>
		</tfoot>
    </table>
	</div>
</div>
</div>