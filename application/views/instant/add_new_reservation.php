<?php if($this->uri->segment(4) == 'invalid_input') { ?>
	<div class="alert alert-error"><strong>Invalid Input</strong></div>
<?php } ?>

<div class="row-fluid">
<div class="block span3">
    
	<?php 	
	echo '<a href="#page-stats" class="block-heading" data-toggle="collapse"> Insert Reservation </a>
				  <div id="page-stats" class="block-body collapse in">';
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('instant/reservation/insert_reservation', $attributes);?>
	
	<div id="myTabContent" class="tab-content">
		<div class="formRow">
			<label>Reservation Code :</label>
			<?php 
			$rc = array(
				'name' => 'res_code',
				'id'   => 'res_code',
				'value' => $res_code,
				'readonly'=> 'readonly'
				);
			echo form_input($rc);?>
            <div class="clear"></div>
        </div>
		<div class="formRow">
            <label>Reservation Date:</label>
			<?php 
			$date = array(
				'name' => 'date',
				'id'   => 'datepicker',
				'style'=> 'width:40%',
				'value'=> date('d-m-Y', now())
				);
			echo form_input($date);
			?>
			<div class="clear"></div>
        </div>
		<div class="formRow">
            <label>Travel:</label>
			<div class="formRight">
				<input type="text" name="trv" value="" id="trv"/>
			</div>
            <div class="clear"></div>
		</div>
		<div id="outputbox"><input type="hidden" name="travel" value="" id="travel" /></div>
		<div class="formRow">
            <label>Guide:</label>
			<?php 
			$pax = array(
				'name' => 'pic',
				'id'   => 'pic',
				'placeholder'=> 'Nama Guide',
				);
			echo form_input($pax);?>
			<div class="clear"></div>
        </div>
		<div class="formRow">
            <label>Pax:</label>
			<?php 
			$pax = array(
				'name' => 'pax',
				'id'   => 'pax',
				'placeholder'=> '10',
				);
			echo form_input($pax);?>
			<div class="clear"></div>
        </div>
		<div class="btn-toolbar">
			<button class="btn btn-primary"><i class="icon-save"></i> Save</button>
			<div class="btn-group">
			</div>
		</div>
        <div class="clear"></div>
		</form>
	</div>
</div>
</div>

<div class="block span9">
	<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Payment Code</th>
				<th>Reservation Code</th>
				<th>Travel</th>
				<th>Guide</th>
				<th>Quantity</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		if ($list_payment != NULL)
		{
		$num = 1;
		foreach ($list_payment as $row_pax)
		{ 
			?>
			<tr>
				<td><center><?php echo $num++; ?></td>
				<td><center><?php echo $row_pax['irb_pay_code']?></td>
				<td><center><?php echo $row_pax['irb_res_code']?></td>
				<td><center><?php echo $row_pax['ins_rsv_travel']?></td>
				<td><center><?php echo $row_pax['ins_rsv_agent']?></td>
				<td><center><?php echo $row_pax['irb_quantity']?></td>
				<td><center><?php 
					echo anchor('instant/reservation/void_reservation/'.$row_pax['irb_res_code'],'void ');
					echo anchor('instant/reservation/reprint_reservation/'.$row_pax['irb_res_code'],'reprint');
				?></td>
            </tr> 
		<?php 
		} ?>
		<?php }?>
        </tbody>
    </table>
	
</div>
</div>

<?php $this->load->view('reservation/script/travel');?>