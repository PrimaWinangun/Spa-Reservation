<div class="block span3">
<a href="#page-stats" class="block-heading" data-toggle="collapse"> New Room</a>
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
<div class="block span9">
	<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered">
        <tfoot>
			<tr><td colspan=6><div class="pagination"><?php echo $this->pagination->create_links();?></div></td></tr>
		</tfoot>
		<thead>
			<tr>
				<th>No</th>
				<th>Category</th>
				<th>Room</th>
				<th>Status</th>
				<th>Hide Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		if ($room != NULL)
		{
		if ($this->uri->segment(4) == NULL)
		{ $num = 1; } else { $num = $this->uri->segment(4, 1) + 1; }
		foreach ($room as $row_rm)
		{ 
			?>
			<tr>
				<td><center><?php echo $num++; ?></td>
				<td><center><?php echo $row_rm['room_category']?></td>
				<td><center><?php echo $row_rm['room_name']?></td>
				<td><center><?php echo $row_rm['room_status']?></td>
				<td><center><?php echo $row_rm['room_hide_status']?></td>
				
				<td><center><?php 
					if ($row_rm['room_hide_status'] == 'no'){
						echo anchor('setting/admin/void_room/'.$row_rm['id'], img(array('src'=>"wp-content/themes/thebanjarbali/rsv/images/control/16/busy.png", 'alt'=>'Hide room', 'title'=>'Hide room'))); 
						echo '&nbsp'.anchor('setting/admin/edit_room/'.$row_rm['id'], img(array('src'=>"wp-content/themes/thebanjarbali/rsv/images/control/16/config.png", 'alt'=>'Edit room', 'title'=>'Edit room')));
					} else {
						echo anchor('setting/admin/show_room/'.$row_rm['id'], img(array('src'=>"wp-content/themes/thebanjarbali/rsv/images/control/16/plus.png", 'alt'=>'Show room', 'title'=>'Show room')));
					}
				?></td>
            </tr><?php } } ?>
        </tbody>
    </table>
</div>
</div>