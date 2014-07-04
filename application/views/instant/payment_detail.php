
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
			if ($row_pax['irpd_rate_payment'] == 'rupiah')
				{ $rate = $row_pax['irpd_rate']; $payment = 'IDR'; } else {$rate = $row_pax['irpd_rate_dollar']; $payment = 'USD';} 
			?>
			<tr>
				<td><center><?php echo $num++; ?></td>
				<td><center><?php echo $row_pax['irpd_product']?></td>
				<td><center><?php echo $row_pax['irpd_quantity']?></td>
				<td><center><?php echo number_format($row_pax['irpd_rate_dollar'], 2, ',', '.')?></td>
				<td><center><?php echo number_format($row_pax['irpd_rate'], 2, ',', '.')?></td>
				<td><center><?php echo $payment.' '.number_format($row_pax['irpd_quantity']*$rate, 2, ',', '.') ?></td>
            </tr> 
		<?php 
		if ($row_pax['irpd_status'] != 'void')
		{
			if ($row_pax['irpd_rate_payment'] == 'rupiah')
			{
				$pay = $row_pax['irpd_quantity']*$row_pax['irpd_rate'];
			} else {
				$pay_dollar = $row_pax['irpd_quantity']*$row_pax['irpd_rate_dollar'];
			}
		}
		
		$quantity = $quantity + $row_pax['irpd_quantity'];
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
<?php $this->load->view('cashier/script/calculate');

$tx_idr = 0;
$tx_usd = 0;
$serv_idr = 0; 
$serv_usd = 0;
$sub_idr = 0; 
$sub_usd = 0; 
?>


<div class="block span5">
<a href="#page-stats" class="block-heading" data-toggle="collapse"> Reservation Code <?php echo $this->uri->segment(4);?></a>
<div id="page-stats1" class="block-body collapse in">
	<div id="myTabContent" class="tab-content">
	<table width="100%">
			<?php 
			
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('instant/reservation/submit_payment', $attributes);
			echo form_hidden('res_code', $this->uri->segment(4));
			echo form_hidden('quantity', $quantity);
			
			?>
			<input name="rate" id="rate" type="hidden" value="<?php echo $total_bayar; ?>" >
			<input name="rate_dollar" id="rate_dollar" type="hidden" value="<?php echo $total_bayar_dollar; ?>" >
			<input name="kurs" id="kurs" type="hidden" value="<?php echo $kurs->kurs_value; ?>" >
			<tr>
				<td width="30%"><label>Price Type</label></td><td>:</td>
				<td align="right">
                        <div class="formRight">
						<select id="promo" name="promo" onchange="javascript:hitungPaymentType(this.value)">
						
							<?php foreach($payment_type as $row_pay){ ?>
							 <option value="<?php echo $row_pay->pay_payment_type;?>"><?php echo $row_pay->pay_payment_type;?></option>
							<?php } ?>
						</select>
						</div>
				</td>
			</tr>
			<tr>
				<td><label>Payment Type </label></td><td>:</td>
				<td align="right">
                    <div class="formRight">
						<select id="pay_type" name="pay_type" onchange="javascript:showNote(this.value)">  <!--Call run() function-->
							 <option value="Cash">Cash</option>
							 <option value="Credit_Card">Credit Card</option>
							 <option value="Debit_Card">Debit Card</option>
							 <option value="Hutang">Recievable</option>     
							 <option value="FOC">FOC</option>     
						</select>
					</div>
				</td>
			</tr>
			<tr>
				<td></td><td></td><td align="right">
						<select id="pay_type_2" name="pay_type_2" onchange="javascript:disabledEnabled(this.value)">  <!--Call run() function-->
							 <option value="-">-</option>
							 <option value="Credit_Card">Credit Card</option>
							 <option value="Debit_Card">Debit Card</option> 
							 <option value="Hutang">Recievable</option>     
						</select>
				</td>
			</tr>
			<tr class="cc_detail">
				<td><label>FOC Note</label></td><td>:</td>
				<td align="right">
                        <div class="formRight">
						<?php 
						$focnote = array(
							'id' => 'foc_note',
							'name' => 'foc_note',
							'disabled' => 'disabled'
						);
						echo form_input($focnote);?></div>
				</td>
			<tr>
			<tr>
				<td><label>Discount </label></td><td>:</td>
				<td align="right">
					<?php 
						$dis = array(
							'name' => 'dis',
							'id'   => 'dis',
							'style'=> 'width:10%',
							'value'=> '0',
							'onchange' => 'javascript:hitungtotal(this.value)'
						);
						echo form_input($dis); ?>&nbsp IDR
					<?php
						$disc_idr = array(
							'name' => 'dis_idr',
							'id'   => 'dis_idr',
							'style'=> 'width:48%',
							'value'=> '0',
							'onchange' => 'javascript:hitungdiscount(this.value)'
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
							'value'=> '0.000',
							'onchange' => 'javascript:hitungdiscount(this.value)'
						);
						echo form_input($disc_usd);?>
						</div>
                </td>
			</tr>
			<tr>
			<?php $tx_idr = $total_bayar * 12.5 / 100; $tx_usd = $total_bayar_dollar * 12.5 / 100; ?>
				<td><label>Tax </label><td>:</td>
				<td align="right">
                        <div class="formRight">
						<?php 
						$tax = array(
							'name' => 'tax',
							'id'   => 'tax',
							'style'=> 'width:10%',
							'value'=> 12.5,
							'onchange' => 'javascript:hitungtotal(this.value)'
						);
						echo form_input($tax); ?>&nbsp IDR
					<?php
						$tax_idr = array(
							'name' => 'tax_idr',
							'id'   => 'tax_idr',
							'style'=> 'width:48%',
							'value'=> $tx_idr,
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
							'value'=> number_format($tx_usd, 3, '.',''),
							'readonly' => 'readonly'
						);
						echo form_input($tax_usd);?>
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
							'value'=> $total_bayar + $tx_idr + $sub_idr,
							'readonly'=> 'readonly'
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
							'value'=> number_format(($total_bayar_dollar + $tx_usd + $sub_usd), 3, '.',''),
							'readonly'=> 'readonly'
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
							'value'=> '0',
							'onchange' => 'javascript:hitungpayment_idr(this.value)',
							'disabled' => 'disabled'
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
							'value'=> '0',
							'onchange' => 'javascript:hitungpayment_usd(this.value)',
							'disabled' => 'disabled'
						);
						echo form_input($jk);?>
						</div>
                       </td>
			</tr>
			
			<tr>
				<td><font color="#FF0000">Kurs Hari Ini</font></td><td>:</td>
				<td align="right">
				<strong><font color="#FF0000"><?php echo number_format($kurs->kurs_value, 2, ',', '.')?></font></strong>
                </td>
			</tr>
			<tr>
				<td rowspan="2"><label>Payment Fisik</label></td><td>:</td>
				<td align="right">
                        <div class="formRight">IDR &nbsp
						<?php 
						$jk = array(
							'name' => 'fis_idr',
							'id'   => 'fis_idr',
							'style'=> 'width:65%',
							'value'=> '0',
							'onchange' => 'javascript:hitungfisik_idr(this.value)',
						);
						echo form_input($jk);?></td>
			</tr>
			<tr>
				<td></td>
				<td align="right">USD &nbsp<?php
						$jk = array(
							'name' => 'fis_usd',
							'id'   => 'fis_usd',
							'style'=> 'width:65%',
							'value'=> '0',
							'onchange' => 'javascript:hitungfisik_usd(this.value)',
						);
						echo form_input($jk);?>
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