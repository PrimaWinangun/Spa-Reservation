<div class="block span3">
<a href="#page-stats" class="block-heading" data-toggle="collapse"> New Therapist</a>
<div id="page-stats1" class="block-body collapse in">
	<div id="myTabContent" class="tab-content">
			<?php 
			
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('setting/admin/insert_therapist', $attributes);?>
                <fieldset class="step" id="w2first">
                    <h1></h1>
					<div class="formRow">
                        <label>Name :</label>
                        <div class="formRight">
						<?php 
						$tn = array(
							'name' => 'therapist_name',
							'id'   => 'therapist',
						);
						echo form_input($tn);?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Code :</label>
                        <div class="formRight">
						<?php 
						$tc = array(
							'name' => 'therapist_code',
							'id'   => 'therapist',
						);
						echo form_input($tc);?>
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
				<th>Code</th>
				<th>Name</th>
				<th>Status</th>
				<th>Hide Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		if ($therapist != NULL)
		{
		if ($this->uri->segment(4) == NULL)
		{ $num = 1; } else { $num = $this->uri->segment(4, 1) + 1; }
		foreach ($therapist as $row_thr)
		{ 
			?>
			<tr>
				<td><center><?php echo $num++; ?></td>
				<td><center><?php echo $row_thr['thr_code']?></td>
				<td><center><?php echo $row_thr['thr_name']?></td>
				<td><center><?php echo $row_thr['thr_status']?></td>
				<td><center><?php echo $row_thr['thr_hide_status']?></td>
				
				<td><center><?php 
					if ($row_thr['thr_hide_status'] == 'no'){
						echo anchor('setting/admin/void_therapist/'.$row_thr['id_therapist'], img(array('src'=>"wp-content/themes/thebanjarbali/rsv/images/control/16/busy.png", 'alt'=>'Hide thr', 'title'=>'Hide thr'))); 
						echo '&nbsp'.anchor('setting/admin/edit_therapist/'.$row_thr['id_therapist'], img(array('src'=>"wp-content/themes/thebanjarbali/rsv/images/control/16/config.png", 'alt'=>'Edit thr', 'title'=>'Edit thr')));
					} else {
						echo anchor('setting/admin/show_therapist/'.$row_thr['id_therapist'], img(array('src'=>"wp-content/themes/thebanjarbali/rsv/images/control/16/plus.png", 'alt'=>'Show thr', 'title'=>'Show thr')));
					}
				?></td>
            </tr><?php } } ?>
        </tbody>
    </table>
</div>