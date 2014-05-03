
<div class="block span3">
    
	<?php 	
	echo '<a href="#page-stats" class="block-heading" data-toggle="collapse"> Search Reservation By Code </a>
				  <div id="page-stats" class="block-body collapse in">';
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('cashier/payment/payment_list_search', $attributes);?>
	
	<div id="myTabContent" class="tab-content">
		<div class="formRow">
			<label>Payment / Reservation Code :</label>
			<?php 
			$rc = array(
				'name' => 'pay_code',
				'id'   => 'pay_code',
				'class'=> 'span9',
				'value'=> $code
				);
			echo form_input($rc);?>
			<button class="btn btn-primary" style="margin-bottom:10px"><i class="icon-search"></i></button>
		</div>
		</form>
	</div>
</div>
</div>
<div class="block span3">
    
	<?php 	
	echo '<a href="#page-stats" class="block-heading" data-toggle="collapse"> Search Reservation By Date</a>
				  <div id="page-stats" class="block-body collapse in">';
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('cashier/payment/payment_list_date_search', $attributes);?>
	
	<div id="myTabContent" class="tab-content">
		<div class="formRow">
			<label>Payment Date :</label>
			<?php 
			$rc = array(
				'name' => 'pay_date',
				'id'   => 'datepicker',
				'class'=> 'span9',
				'value'=> $date
				);
			echo form_input($rc);?>
			<button class="btn btn-primary" style="margin-bottom:10px"><i class="icon-search"></i></button>
		</div>
		</form>
	</div>
</div>
</div>
</div>

<div class="row-fluid">
<div class="span12">
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
				<th rowspan="2">Paid Date</th>
				<th rowspan="2">Transaction By</th>
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
			</tr>
		</thead>
		<tbody>
		<?php 
		if ($pay_list != NULL)
		{
		$num = $this->uri->segment(4,0) + 1;
		foreach ($pay_list as $row_pay)
		{ 
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
				<td><?php echo date('d-m-Y',strtotime($row_pay->rb_paid_date));?></td>
				<td><?php echo ucfirst($row_pay->rb_transaction_by);?></td>
			</tr>
		<?php } }?>
        </tbody>
		<tfoot>
			<tr><td colspan="14"><div class="pagination"><?php echo $this->pagination->create_links();?></div></td></tr>
		</tfoot>
    </table>
	</div>
</div>
</div>