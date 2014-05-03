<div class="block span4">
<a href="#page-stats" class="block-heading" data-toggle="collapse"> New Product Category</a>
<div id="page-stats1" class="block-body collapse in">
	<div id="myTabContent" class="tab-content">
			<?php 
			
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('setting/admin/insert_product_cat', $attributes);?>
                <fieldset class="step" id="w2first">
                    <h1></h1>
					<div class="formRow">
                        <label>Category Code:</label>
                        <div class="formRight">
						<?php 
						$pc = array(
							'name' => 'cat_code',
							'id'   => 'cat_code',
						);
						echo form_input($pc);?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Category Name:</label>
                        <div class="formRight">
						<?php 
						$pn = array(
							'name' => 'cat_name',
							'id'   => 'cat_name',
						);
						echo form_input($pn);?>
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
<a href="#page-stats" class="block-heading" data-toggle="collapse">Product Category</a>
<div id="page-stats2" class="block-body collapse in">
	<div id="myTabContent" class="tab-content">
	<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered">
        <tfoot>
			<tr><td colspan=9></td></tr>
		</tfoot>
		<thead>
			<tr>
				<th>No</th>
				<th>Category Code</th>
				<th>Cateogry Name</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		if ($product_cat != NULL)
		{
		$num = 1;
		foreach ($product_cat as $row_rm)
		{ 
			?>
			<tr>
				<td><?php echo $num++ ?></td>
				<td><?php echo $row_rm['cp_code'] ?></td>
				<td><?php echo $row_rm['cp_name'] ?></td>
				
				<td><center><?php echo anchor('setting/admin/void_product_cat/'.$row_rm['id_cat_product']/*, img(array('src'=>"wp-theme/images/control/16/busy.png", 'alt'=>'Delete SMU', 'title'=>'Delete SMU'))*/,'delete'); ?></td>
            </tr><?php } } ?>
        </tbody>
    </table>
</div>
</div>
</div>