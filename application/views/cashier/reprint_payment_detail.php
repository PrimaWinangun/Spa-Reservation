
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


<div class="block span5">
<a href="#page-stats" class="block-heading" data-toggle="collapse"> Reservation Code <?php echo $this->uri->segment(4);?></a>
<div id="page-stats1" class="block-body collapse in">
	<div id="myTabContent" class="tab-content">
	<table width="100%">
			<?php 
			
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('cashier/payment/reprint_payment', $attributes);
			echo form_hidden('res_code', $this->uri->segment(4));
			echo form_hidden('quantity', $quantity);
			
			?>
			<input name="rate" id="rate" type="hidden" value="<?php echo $total_bayar; ?>" >
			<input name="rate_dollar" id="rate_dollar" type="hidden" value="<?php echo $total_bayar_dollar; ?>" >
			<tr>
				<td width="30%"><label>Price Type</label></td><td>:</td>
				<td align="right">
                        <div class="formRight">
						<select id="promo" name="promo" readonly="readonly">
							 <option value="<?php echo $pay_detail->rb_promo;?>"><?php echo $pay_detail->rb_promo;?></option>
						</select>
						</div>
				</td>
			</tr>
			<tr>
				<td><label>Payment Type </label></td><td>:</td>
				<td align="right">
                    <div class="formRight">
						<select id="pay_type" name="pay_type" readonly="readonly">  <!--Call run() function-->
							 <option value="<?php echo $pay_detail->rb_payment_type; ?>"><?php echo str_replace('_',' ',$pay_detail->rb_payment_type) ?></option>   
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<td></td><td></td><td align="right">
						<select id="pay_type_2" name="pay_type_2" readonly="readonly>  <!--Call run() function-->
							 <option value="<?php echo $pay_detail->rb_payment_type_2; ?>"><?php echo str_replace('_',' ',$pay_detail->rb_payment_type_2) ?></option>      
						</select>
				</td>
			</tr>
			<tr>
				<td><label>Discount </label></td><td>:</td>
				<td align="right">
					&nbsp IDR
					<?php
						$disc_idr = array(
							'name' => 'dis_idr',
							'id'   => 'dis_idr',
							'style'=> 'width:48%',
							'value'=> $pay_detail->rb_discount_rp,
							'readonly' => 'readonly'
						);
						echo form_input($disc_idr);?>
						</div>
                </td>
			</tr>
			<tr>
				<td></td><td></td>
				<td align="right">
                        <div class="formRight">USD
					<?php
						$disc_usd = array(
							'name' => 'dis_usd',
							'id'   => 'dis_usd',
							'style'=> 'width:48%',
							'value'=> $pay_detail->rb_discount,
							'readonly' => 'readonly'
						);
						echo form_input($disc_usd);?>
						</div>
                </td>
			</tr>
			<tr>
			<?php $tx_idr = $total_bayar * 10 / 100; $tx_usd = $total_bayar_dollar * 10 / 100; ?>
				<td><label>Tax </label><td>:</td>
				<td align="right">
                        <div class="formRight">
						&nbsp IDR
					<?php
						$tax_idr = array(
							'name' => 'tax_idr',
							'id'   => 'tax_idr',
							'style'=> 'width:48%',
							'value'=> $pay_detail->rb_tax_rp,
							'readonly' => 'readonly'
						);
						echo form_input($tax_idr);?>
						</div>
                </td>
			</tr>
			<tr>
				<td></td><td></td>
				<td align="right">
                        <div class="formRight">USD
					<?php
						$tax_usd = array(
							'name' => 'tax_usd',
							'id'   => 'tax_usd',
							'style'=> 'width:48%',
							'value'=> number_format($pay_detail->rb_tax, 2, '.',''),
							'readonly' => 'readonly'
						);
						echo form_input($tax_usd);?>
						</div>
                </td>
			</tr>
			<tr>
				<td><label>Service </label><td>:</td>
				<td align="right">
                        <div class="formRight">
						&nbsp IDR
					<?php
						$srv_idr = array(
							'name' => 'serv_idr',
							'id'   => 'serv_idr',
							'style'=> 'width:48%',
							'value'=> $pay_detail->rb_service_rp,
							'readonly' => 'readonly'
						);
						echo form_input($srv_idr);?>
						</div>
                </td>
			</tr>
			<tr>
				<td></td><td></td>
				<td align="right">
                        <div class="formRight">USD
					<?php
						$srv_usd = array(
							'name' => 'serv_usd',
							'id'   => 'serv_usd',
							'style'=> 'width:48%',
							'value'=> number_format($pay_detail->rb_service, 2, '.',''),
							'readonly' => 'readonly'
						);
						echo form_input($srv_usd);?>
						</div>
                </td>
			</tr>
			<tr>
				<td rowspan="2"><label>Grand Total Payment 1</label></td><td>:</td>
				<td align="right">
                        <div class="formRight">IDR &nbsp
						<?php 
						$jk = array(
							'name' => 'grand_idr',
							'id'   => 'grand_idr',
							'style'=> 'width:65%',
							'value'=> $pay_detail->rb_paid_idr,
							'readonly' => 'readonly'
						);
						echo form_input($jk);?></td>
			</tr>
			<tr>
				<td></td>
				<td align="right">USD &nbsp<?php
						$jk = array(
							'name' => 'grand_usd',
							'id'   => 'grand_usd',
							'style'=> 'width:65%',
							'value'=> $pay_detail->rb_paid_usd,
							'readonly' => 'readonly'
						);
						echo form_input($jk);?>
						</div>
                       </td>
			</tr>
			<tr>
				<td rowspan="2"><label>Grand Total Payment 2</label></td><td>:</td>
				<td align="right">
                        <div class="formRight">IDR &nbsp
						<?php 
						$jk = array(
							'name' => 'grand_idr_2',
							'id'   => 'grand_idr_2',
							'style'=> 'width:65%',
							'value'=> $pay_detail->rb_paid_idr_2,
							'readonly' => 'readonly'
						);
						echo form_input($jk);?></td>
			</tr>
			<tr>
				<td></td>
				<td align="right">USD &nbsp<?php
						$jk = array(
							'name' => 'grand_usd_2',
							'id'   => 'grand_usd_2',
							'style'=> 'width:65%',
							'value'=> $pay_detail->rb_paid_usd_2,
							'readonly' => 'readonly'
						);
						echo form_input($jk);?>
						</div>
                       </td>
			</tr>
			<tr>
			<td></td><td></td><td>
				<div class="btn-toolbar">
					<button class="btn btn-primary"><i class="icon-save"></i> Reprint</button>
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