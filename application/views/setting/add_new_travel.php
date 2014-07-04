<div class="block span3">
<a href="#page-stats" class="block-heading" data-toggle="collapse"> New Travel</a>
<div id="page-stats1" class="block-body collapse in">
	<div id="myTabContent" class="tab-content">
			<?php 
			
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('setting/admin/insert_travel', $attributes);?>
                <fieldset class="step" id="w2first">
                    <h1></h1>
					<div class="formRow">
                        <label>Code :</label>
                        <div class="formRight">
						<?php 
						$tc = array(
							'name' => 'trv_code',
							'id'   => 'trv_code',
						);
						echo form_input($tc);?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Name:</label>
                        <div class="formRight">
						<?php 
						$tn = array(
							'name' => 'trv_name',
							'id'   => 'trv_name',
						);
						echo form_input($tn);?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Address:</label>
                        <div class="formRight">
						<?php 
						$ta = array(
							'name' => 'trv_add',
							'id'   => 'trv_add',
						);
						echo form_input($ta);?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Phone:</label>
                        <div class="formRight">
						<?php 
						$tp = array(
							'name' => 'trv_phn',
							'id'   => 'trv_phn',
						);
						echo form_input($tp);?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Email:</label>
                        <div class="formRight">
						<?php 
						$te = array(
							'name' => 'trv_mail',
							'id'   => 'trv_mail',
						);
						echo form_input($te);?>
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
			<tr><td colspan=8><div class="pagination"><?php echo $this->pagination->create_links();?></div></td></tr>
		</tfoot>
		<thead>
			<tr>
				<th>No</th>
				<th>Code</th>
				<th>Name</th>
				<th>Address</th>
				<th>Phone</th>
				<th>Email</th>
				<?php if ($user['position'] != 'reservation') {?>
				<th>Hide Status</th>
				<th>Action</th>
				<?php } ?>
			</tr>
		</thead>
		<tbody>
		<?php 
		if ($travel != NULL)
		{
		$num = 1;
		foreach ($travel as $row_rm)
		{ 
			?>
			<tr>
				<td><?php echo $num++ ?></td>
				<td><?php echo $row_rm['trv_code'] ?></td>
				<td><?php echo $row_rm['trv_name'] ?></td>
				<td><?php echo $row_rm['trv_address'] ?></td>
				<td><?php echo $row_rm['trv_phone'] ?></td>
				<td><?php echo $row_rm['trv_mail'] ?></td>
				<?php if ($user['position'] != 'reservation') {?>
				<td><center><?php echo $row_rm['trv_hide_status'] ?></td>
				
				<td><center><?php 
					if ($row_rm['trv_hide_status'] == 'no'){
						echo anchor('setting/admin/void_travel/'.$row_rm['id_travel'], img(array('src'=>"wp-content/themes/thebanjarbali/rsv/images/control/16/busy.png", 'alt'=>'Hide Travel', 'title'=>'Hide Travel'))); 
						echo '&nbsp'.anchor('setting/admin/edit_travel/'.$row_rm['id_travel'], img(array('src'=>"wp-content/themes/thebanjarbali/rsv/images/control/16/config.png", 'alt'=>'Edit Travel', 'title'=>'Edit Travel')));
					} else {
						echo anchor('setting/admin/show_travel/'.$row_rm['id_travel'], img(array('src'=>"wp-content/themes/thebanjarbali/rsv/images/control/16/plus.png", 'alt'=>'Show Travel', 'title'=>'Show Travel')));
					}
				}?></td>
            </tr><?php } } ?>
        </tbody>
    </table>
</div>