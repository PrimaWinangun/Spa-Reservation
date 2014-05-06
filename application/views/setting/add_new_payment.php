<div class="block span3">
<a href="#page-stats" class="block-heading" data-toggle="collapse"> New Payment Type</a>
<div id="page-stats1" class="block-body collapse in">
	<div id="myTabContent" class="tab-content">
			<?php 
			
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('setting/admin/insert_payment_type', $attributes);?>
                <fieldset class="step" id="w2first">
                    <h1></h1>
					<div class="formRow">
                        <label>Payment Type :</label>
                        <div class="formRight">
						<?php 
						$pn = array(
							'name' => 'pay_name',
							'id'   => 'pay_name',
						);
						echo form_input($pn);?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Discount:</label>
                        <div class="formRight">
						<?php 
						$pd = array(
							'name' => 'pay_disc',
							'id'   => 'pay_disc',
						);
						echo form_input($pd);?>
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
			<tr><td colspan=9></td></tr>
		</tfoot>
		<thead>
			<tr>
				<th>No</th>
				<th>Payment</th>
				<th>Discount (%)</th>
				<th>Hide</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		if ($payment != NULL)
		{
		$num = 1;
		foreach ($payment as $row_rm)
		{ 
			?>
			<tr>
				<td align="center"><?php echo $num++ ?></td>
				<td><?php echo $row_rm['pay_payment_type'] ?></td>
				<td align="right"><?php echo $row_rm['pay_discount'] ?></td>
				<td align="center"><?php echo $row_rm['pay_hide_status'] ?></td>
				
				<td><center><?php 
					if ($row_rm['pay_hide_status'] == 'no'){
						echo anchor('setting/admin/void_payment_type/'.$row_rm['id_pay_type'], img(array('src'=>"wp-content/themes/thebanjarbali/rsv/images/control/16/busy.png", 'alt'=>'Hide Payment List', 'title'=>'Hide Payment List'))); 
						echo '&nbsp'.anchor('setting/admin/edit_payment_type/'.$row_rm['id_pay_type'], img(array('src'=>"wp-content/themes/thebanjarbali/rsv/images/control/16/config.png", 'alt'=>'Edit Payment List', 'title'=>'Edit Payment List')));
					} else {
						echo anchor('setting/admin/show_payment_type/'.$row_rm['id_pay_type'], img(array('src'=>"wp-content/themes/thebanjarbali/rsv/images/control/16/plus.png", 'alt'=>'Show Payment List', 'title'=>'Show Payment List')));
					}
				?></td>
            </tr><?php } } ?>
        </tbody>
    </table>
</div>