
<div class="block span7">
	<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Produk</th>
				<th>Jumlah</th>
				<th>Harga Dollar</th>
				<th>Harga Rupiah</th>
				<th>Subtotal</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$total_bayar = 0;
		$total_bayar_dollar = 0;
		$pay = 0;
		$pay_dollar = 0;
		$quantity = 0;
		if ($rsv_detail != NULL)
		{
		$num = 1;
		foreach ($rsv_detail as $row_pax)
		{ 
			if ($row_pax['rpd_rate_payment'] == 'rupiah')
				{ $rate = $row_pax['rpd_rate']; $payment = 'IDR'; } else {$rate = $row_pax['rpd_rate_dollar']; $payment = 'USD';} 
			?>
			<tr>
				<td><center><?php echo $num++; ?></td>
				<td><center><?php echo $row_pax['rpd_product']?></td>
				<td><center><?php echo $row_pax['rpd_quantity']?></td>
				<td><center><?php echo number_format($row_pax['rpd_rate_dollar'], 2, ',', '.')?></td>
				<td><center><?php echo number_format($row_pax['rpd_rate'], 2, ',', '.')?></td>
				<td><center><?php echo $payment.' '.number_format($row_pax['rpd_quantity']*$rate, 2, ',', '.') ?></td>
            </tr> 
		<?php 
		if ($row_pax['rpd_status'] != 'void')
		{
			if ($row_pax['rpd_rate_payment'] == 'rupiah')
			{
				$pay = $row_pax['rpd_quantity']*$row_pax['rpd_rate'];
			} else {
				$pay_dollar = $row_pax['rpd_quantity']*$row_pax['rpd_rate_dollar'];
			}
		}
		
		$quantity = $quantity + $row_pax['rpd_quantity'];
		$total_bayar_dollar = $total_bayar_dollar + $pay_dollar;
		$total_bayar = $total_bayar + $pay;
		
		$pay = 0;
		$pay_dollar = 0;
		} ?>
		<tr>
			<td colspan="5"><div align="right"><b>Total : </div></td>
			<td><center><b><?php echo 'USD '.number_format($total_bayar_dollar, 2, ',', '.').' <br/> IDR '.number_format($total_bayar, 2, ',', '.');?></td>
		</tr><?php }?>
        </tbody>
    </table>
	
</div>

<!-- Calculating Javascript -->
 <script type="text/javascript" src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/rsv/lib/jquery.autocomplete.min.js"></script>
  <script>
	$(function(){
	  var instant = [
	   <?php
		foreach ($instant_paid as $ipl) :
		{
			echo "{ value: '".$ipl->irb_pay_code."', data: '".$ipl->irb_pay_code."' },";
		} endforeach; 
	  ?>
	 ];
  
	  // setup autocomplete function pulling from therapist[] array
	  $('#payment_code').autocomplete({
		lookup: instant,
		onSelect: function (suggestion) {
		}
	  });
});
  </script>


<div class="block span5">
<a href="#page-stats" class="block-heading" data-toggle="collapse"> Reservation Code <?php echo $this->uri->segment(4);?></a>
<div id="page-stats1" class="block-body collapse in">
	<div id="myTabContent" class="tab-content">
	<table width="100%">
			<?php 
			
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('cashier/payment/submit_instant_payment', $attributes);
			echo form_hidden('res_code', $this->uri->segment(4));
			echo form_hidden('quantity', $quantity);
			
			?>
			<input name="rate" id="rate" type="hidden" value="<?php echo $total_bayar; ?>" >
			<input name="rate_dollar" id="rate_dollar" type="hidden" value="<?php echo $total_bayar_dollar; ?>" >
			<tr>
				<td width="30%"><label>Payment Code</label></td><td>:</td>
				<td align="right">
                        <div class="formRight">
							<input type="text" name="payment_code" value="" id="payment_code"/>
						</div>
				</td>
			</tr>
			<tr>
			<td></td><td></td><td>
				<div class="btn-toolbar">
					<button class="btn btn-primary"><i class="icon-save"></i> Submit</button>
					<div class="btn-group">
					</div>
				</div>
                <div class="clear"></div>
			</td>
			</form>
			<div class="data" id="w2"></div>
			</tr>
    </table>
	</div>
</div>
</div>