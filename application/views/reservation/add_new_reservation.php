<?php if($this->uri->segment(4) == 'invalid_input') { ?>
	<div class="alert alert-error"><strong>Invalid Input</strong></div>
<?php } ?>

<div class="row-fluid">
<div class="block span3">
    
	<?php 	
	echo '<a href="#page-stats" class="block-heading" data-toggle="collapse"> Insert Reservation </a>
				  <div id="page-stats" class="block-body collapse in">';
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('reservation/admin/insert_reservation', $attributes);?>
	
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
<a href="#page-stats" class="block-heading" data-toggle="collapse">Reservation Date <?php echo date('d-m-Y', now());?></a>
<div id="page-stats2" class="block-body collapse in">
	<div id="myTabContent" class="tab-content">
	<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Reservation Code</th>
				<th>Agent</th>
				<th>Guide</th>
				<th>Pax</th>
				<th>Harga</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		if ($res_list != NULL)
		{
		$num = 1;
		foreach ($res_list as $row_res)
		{ 
			$color = '';
			if ($row_res->res_status == 'void')
			{
				$color = 'bgcolor="red"';
			}
			?>
			<tr>
				<td <?php echo $color; ?>><center><?php echo $num++; ?></td>
				<td <?php echo $color; ?>><center><?php echo $row_res->res_code ?></td>
				<td <?php echo $color; ?>><center><?php echo $row_res->res_agent ?></td>
				<td <?php echo $color; ?>><center><?php echo $row_res->res_guide ?></td>
				<td <?php echo $color; ?>><center><?php echo $row_res->res_pax ?></td>
				<td <?php echo $color; ?>><center><?php echo $row_res->harga ?></td>
				
				<td <?php echo $color; ?>><center><?php 
					echo anchor('reservation/admin/add_detail_pax/'.$row_res->res_code.'/'.$this->uri->segment(4)/*, img(array('src'=>"wp-theme/images/control/16/busy.png", 'alt'=>'Delete SMU', 'title'=>'Delete SMU'))*/,'detail &nbsp'); 
					if ($row_res->res_status == 'open')
					{
						echo anchor('reservation/admin/void_reservation/'.$row_res->res_code.'/'.$this->uri->segment(4)/*, img(array('src'=>"wp-theme/images/control/16/busy.png", 'alt'=>'Delete SMU', 'title'=>'Delete SMU'))*/,'void'); 
					}
				?></td>
            </tr> 
		<?php } }?>
        </tbody>
		<tfoot>
			<tr><td colspan="9"><div class="pagination"><?php echo $this->pagination->create_links();?></div></td></tr>
		</tfoot>
    </table>
	<?php 
		echo form_open('reservation/admin/print_reservation/'.$this->uri->segment(4));
	?>
	<div class="btn-toolbar">
		<p align="right"><button class="btn btn-primary"><i class="icon-save"></i> Print</button></p>
		<div class="btn-group">
		</div>
	</div>
	<div id="clear"></div>
	</div>
</div>
</div>
<?php $this->load->view('reservation/script/travel');?>