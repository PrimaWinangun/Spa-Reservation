<?php 
	if ($detail_total_pax < ($total_pax/2))
		{
			$alert = 'alert-success';
		} else
	if ($detail_total_pax >= ($total_pax))
		{
			$alert = 'alert-error';
		} else 
		{
			$alert = '';
		}
?>

<div class="alert <?php echo $alert ?>"><strong>Total Pax : <?php echo $detail_total_pax;?> of <?php echo $total_pax;?></strong></div>
</div>
   <script src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/rsv/lib/js/jquery.maskedinput.min.js" type="text/javascript"></script> 
 
<div class="row-fluid">
<div class="block span3">
<a href="#page-stats" class="block-heading" data-toggle="collapse"> Reservation Code <?php echo $this->uri->segment(4);?></a>
<div id="page-stats1" class="block-body collapse in">
	<div id="myTabContent" class="tab-content">
			<?php 
			
			$attributes = array('class'=>'form','id'=>'wizard3');
			if ($reservation->ins_rsv_status != 'paid'){
			echo form_open('instant/reservation/insert_detail_pax', $attributes);
			}			
			echo form_hidden('res_code', $this->uri->segment(4));
			echo form_hidden('res_date', $res_date);?>
                <fieldset class="step" id="w2first">
                    <h1></h1>
					
					<div class="formRow">
                        <label>Produk :</label>
                       <div class="formRight">
							<input type="text" name="prod" value="" id="prod"/>
						</div>
                        <div class="clear"></div>
					</div>
					<div id="outputprod"><input type="hidden" name="produk" value="" id="produk" /></div>
					<div class="formRow">
                        <label>Rupiah Pay : <?php echo form_checkbox('rupiah', 'yes');?></label>
                        <div class="clear"></div>
                    </div>
					<div id="outputbox"><input type="hidden" name="therapist" value="" id="therapist" /></div>
					<div class="formRow">
                        <label>Quantity :</label>
                        <div class="formRight">
						<?php 
						$jk = array(
							'name' => 'jum',
							'id'   => 'jum',
							'style'=> 'width:20%',
							'value'=> 1,
						);
						echo form_input($jk); echo '&nbsp Pcs';?>
						</div>
                        <div class="clear"></div>
                    </div>
				</fieldset>
				<?php if ($reservation->ins_rsv_status != 'paid'){ ?>
				<div class="btn-toolbar">
					<button class="btn btn-primary"><i class="icon-save"></i> Submit</button>
					<div class="btn-group">
					</div>
				</div>
                <div class="clear"></div>
				<?php } ?>
			</form>
			<div class="data" id="w2"></div>
        </div>
</div>
</div>
<div class="block span9">
<a href="#page-stats" class="block-heading" data-toggle="collapse">Reservation Code <?php echo $this->uri->segment(4);?></a>
<div id="page-stats2" class="block-body collapse in">
	<div id="myTabContent" class="tab-content">
	<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered">
        <tfoot>
			<tr><td colspan=9></td></tr>
		</tfoot>
		<thead>
			<tr>
				<th>No</th>
				<th>Produk</th>
				<th>Jumlah</th>
				<th>Harga Dollar</th>
				<th>Harga Rupiah</th>
				<th>Subtotal</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$total_bayar = 0;
		$total_bayar_dollar = 0;
		$pay = 0;
		$pay_dollar = 0;
		if ($data_pax != NULL)
		{
		$num = 1;
		foreach ($data_pax as $row_pax)
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
				
				<td><center><?php 
					if ($row_pax['irpd_status'] != 'void')
					{
						echo anchor('instant/reservation/void_detail_pax/'.$row_pax['id_irpd'].'/'.$this->uri->segment(4)/*, img(array('src'=>"wp-theme/images/control/16/busy.png", 'alt'=>'Delete SMU', 'title'=>'Delete SMU'))*/,'delete'); 
					}
				?></td>
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
		
		$total_bayar = $total_bayar + $pay;
		$total_bayar_dollar = $total_bayar_dollar + $pay_dollar;
		
		$pay = 0;
		$pay_dollar = 0;
		} ?>
		<tr>
			<td colspan="5"><div align="right"><b>Total : </div></td>
			<td><center><b><?php echo 'USD '.number_format($total_bayar_dollar, 2, ',', '.').' <br/> IDR '.number_format($total_bayar, 2, ',', '.');?></td>
			<td></td>
		</tr><?php }?>
        </tbody>
    </table>
	<?php 
		echo form_open('instant/reservation/pay_reservation/'.$this->uri->segment(4));
	?>
	<div class="btn-toolbar">
		<p align="right"><button class="btn btn-primary"><i class="icon-save"></i> Pay</button></p>
		<div class="btn-group">
		</div>
	</div>
	<div id="clear"></div>
	</div>
</div>
</div>

<?php $this->load->view('instant/script/product');?>