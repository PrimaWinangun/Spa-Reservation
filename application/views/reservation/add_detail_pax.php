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
<?php if($this->uri->segment(5) == 'room_not_available') { ?>
	<div class="alert alert-error"><strong>Room Not Available at the time</strong></div>
<?php } ?>
<?php if($this->uri->segment(5) == 'therapist_not_available') { ?>
	<div class="alert alert-error"><strong>Therapist Not Available at the time</strong></div>
<?php } ?>

<div class="row-fluid">
<div class="block span3">
<a href="#page-stats" class="block-heading" data-toggle="collapse"> Reservation Code <?php echo $this->uri->segment(4);?></a>
<div id="page-stats1" class="block-body collapse in">
	<div id="myTabContent" class="tab-content">
			<?php 
			
			$attributes = array('class'=>'form','id'=>'wizard3');
			if ($reservation->res_status != 'paid'){
			echo form_open('reservation/admin/insert_detail_pax', $attributes);
			}			
			echo form_hidden('res_code', $this->uri->segment(4));
			echo form_hidden('res_date', $res_date);?>
                <fieldset class="step" id="w2first">
                    <h1></h1>
					<div class="formRow">
                        <label>Room Category :</label>
                        <div class="formRight">
						<?php 
						$rc = array();
						$rc['-'] = 'Select Room';
						foreach ($room_cat as $rc_list) :
						{
							$rc[$rc_list['cat_code']] = ($rc_list['cat_name']);
						} endforeach; 
						echo form_dropdown('room_cat',$rc,'','id="room_cat"');
						?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow room">
                        <label>Room :</label>
                        <div class="formRight">
						<select  name="room" id="room" class="form-control">
							<option value="">--</option>
						</select>
						</div>
                        <div class="clear"></div>
                    </div>
					<script type="text/javascript">
					$("#room_cat").change(function(){
							var room_cat = {room_cat:$("#room_cat").val()};
							$.ajax({
									type: "POST",
									url : "<?php echo site_url('reservation/ajax_station/select_room')?>",
									data: room_cat,
									success: function(msg){
										$('#room').html(msg);
									}
								});
					});
				   </script>
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
					<div class="formRow">
                        <label>Therapist :</label>
                        <div class="formRight">
							<input type="text" name="thr" value="" id="thr"/>
						</div>
                        <div class="clear"></div>
						
                    </div>
					<div id="outputbox"><input type="hidden" name="therapist" value="" id="therapist" /></div>
					<div class="formRow">
						<label>Gender : </label>
						<div class="formRight">
						<select id="gender" name="gender">
							 <option value="Male">Male</option>
							 <option value="Female">Female</option>
						</select>
						</div>
                        <div class="clear"></div>
					</div>
					<div class="formRow">
						<label>Nationality:</label>
						<div class="formRight">
							<input type="text" name="nation" value="" id="nation"/>
						</div>
                        <div class="clear"></div>	
                    </div>
					<div id="outputnat"><input type="hidden" name="nationality" value="" id="nationality" /></div>
					<div class="formRow">
                        <label>Quantity :</label>
                        <div class="formRight">
						<?php 
						$jk = array(
							'name' => 'jum',
							'id'   => 'jum',
							'style'=> 'width:20%',
							'value'=> 1,
							'readonly' => 'readonly'
						);
						echo form_input($jk); echo '&nbsp Pcs';?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Start :</label>
                        <div class="formRight">
						<?php 
						$st = array(
							'name' => 'start',
							'id'   => 'time',
							'style'=> 'width:50%',
							'placeholder' => '10:00'
						);
						echo form_input($st);;?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>End :</label>
                        <div class="formRight">
						<?php 
						$en = array(
							'name' => 'end',
							'id'   => 'time2',
							'style'=> 'width:50%',
							'placeholder' => '23:00'
						);
						echo form_input($en);?>
						</div>
                        <div class="clear"></div>
                    </div>
				</fieldset>
				<?php if ($reservation->res_status != 'paid'){ ?>
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
				<th>Room</th>
				<th>Therapist</th>
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
			if ($row_pax['rpd_therapist'] == '')
				{ $therapist = '-'; } else {$therapist = $row_pax['rpd_therapist']; }
			if ($row_pax['rpd_room'] == '')
				{ $room = '-'; } else {$room = $row_pax['rpd_room']; }
			if ($row_pax['rpd_rate_payment'] == 'rupiah')
				{ $rate = $row_pax['rpd_rate']; $payment = 'IDR'; } else {$rate = $row_pax['rpd_rate_dollar']; $payment = 'USD';} 
			?>
			<tr>
				<td><center><?php echo $num++; ?></td>
				<td><center><?php echo $room ?></td>
				<td><center><?php echo $therapist ?></td>
				<td><center><?php echo $row_pax['rpd_product']?></td>
				<td><center><?php echo $row_pax['rpd_quantity']?></td>
				<td><center><?php echo number_format($row_pax['rpd_rate_dollar'], 2, ',', '.')?></td>
				<td><center><?php echo number_format($row_pax['rpd_rate'], 2, ',', '.')?></td>
				<td><center><?php echo $payment.' '.number_format($row_pax['rpd_quantity']*$rate, 2, ',', '.') ?></td>
				
				<td><center><?php 
					if ($row_pax['rpd_status'] != 'void')
					{
						echo anchor('reservation/admin/void_detail_pax/'.$row_pax['id_rpd'].'/'.$this->uri->segment(4)/*, img(array('src'=>"wp-theme/images/control/16/busy.png", 'alt'=>'Delete SMU', 'title'=>'Delete SMU'))*/,'delete'); 
					}
				?></td>
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
		
		$total_bayar = $total_bayar + $pay;
		$total_bayar_dollar = $total_bayar_dollar + $pay_dollar;
		
		$pay = 0;
		$pay_dollar = 0;
		} ?>
		<tr>
			<td colspan="7"><div align="right"><b>Total : </div></td>
			<td><center><b><?php echo 'USD '.number_format($total_bayar_dollar, 2, ',', '.').' <br/> IDR '.number_format($total_bayar, 2, ',', '.');?></td>
			<td></td>
		</tr><?php }?>
        </tbody>
    </table>
	<div id="clear"></div>
	</div>
</div>
</div>

<?php $this->load->view('reservation/script/jquery');?>