<div class="block span4">
    
	<?php 	
	echo '<a href="#page-stats" class="block-heading" data-toggle="collapse"> Insert Reservation </a>
				  <div id="page-stats" class="block-body collapse in">';
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('setting/admin/insert_room_cat', $attributes);?>
	
	<div id="myTabContent" class="tab-content">
		<div class="formRow">
			<label>Room Category Code :</label>
			<?php 
			$rcc = array(
				'name' => 'room_code',
				'id'   => 'room_code',
				);
			echo form_input($rcc);?>
            <div class="clear"></div>
        </div>
		<div class="formRow">
			<label>Room Category :</label>
			<?php 
			$rc = array(
				'name' => 'room_cat',
				'id'   => 'room_cat',
				);
			echo form_input($rc);?>
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

<div class="block span8">
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
				<th>Code</th>
				<th>Name</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$total_bayar = 0;
		if ($room_cat != NULL)
		{
		$num = 1;
		foreach ($room_cat as $row_pax)
		{ 
			?>
			<tr>
				<td><center><?php echo $num++; ?></td>
				<td><center><?php echo $row_pax['cat_code']?></td>
				<td><center><?php echo $row_pax['cat_name']?></td>
				
				<td><center><?php echo anchor('setting/admin/void_room_cat/'.$row_pax['id_cat_room'].'/'/*, img(array('src'=>"wp-theme/images/control/16/busy.png", 'alt'=>'Delete SMU', 'title'=>'Delete SMU'))*/,'delete'); ?></td>
            </tr> <?php } }?>
        </tbody>
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