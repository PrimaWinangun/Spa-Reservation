<div class="block span4">
<a href="#page-stats" class="block-heading" data-toggle="collapse"> Reservation Code <?php echo $this->uri->segment(4);?></a>
<div id="page-stats1" class="block-body collapse in">
	<div id="myTabContent" class="tab-content">
			<?php 
			
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('setting/admin/insert_room', $attributes);?>
                <fieldset class="step" id="w2first">
                    <h1></h1>
					<div class="formRow">
                        <label>Room Category :</label>
                        <div class="formRight">
						<?php 
						$rc = array();
						foreach ($room_cat as $rc_list) :
						{
							$rc[$rc_list['cat_code']] = ($rc_list['cat_name']);
						} endforeach; 
						echo form_dropdown('room_cat',$rc,'');
						?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Room Name:</label>
                        <div class="formRight">
						<?php 
						$jk = array(
							'name' => 'room',
							'id'   => 'room',
							'style'=> 'width:20%',
						);
						echo form_input($jk);?>
						</div>
                        <div class="clear"></div>
                    </div>
				</fieldset>
				<div class="btn-toolbar">
					<button class="btn btn-primary"><i class="icon-save"></i> Submit</button>
					<div class="btn-group">
					</div>
				</div>
                <div class="clear"></div>
			</form>
			<div class="data" id="w2"></div>
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
				<th>Category</th>
				<th>Room</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		if ($room != NULL)
		{
		$num = 1;
		foreach ($room as $row_rm)
		{ 
			?>
			<tr>
				<td><center><?php echo $num++; ?></td>
				<td><center><?php echo $row_rm['room_category']?></td>
				<td><center><?php echo $row_rm['room_name']?></td>
				<td><center><?php echo $row_rm['room_status']?></td>
				
				<td><center><?php echo anchor('setting/admin/void_room/'.$row_rm['id']/*, img(array('src'=>"wp-theme/images/control/16/busy.png", 'alt'=>'Delete SMU', 'title'=>'Delete SMU'))*/,'delete'); ?></td>
            </tr><?php } } ?>
        </tbody>
    </table>
</div>
</div>
</div>