<div class="block span4">
<a href="#page-stats" class="block-heading" data-toggle="collapse"> New Product</a>
<div id="page-stats1" class="block-body collapse in">
	<div id="myTabContent" class="tab-content">
			<?php 
			
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('setting/admin/insert_product', $attributes);?>
                <fieldset class="step" id="w2first">
                    <h1></h1>
					<div class="formRow">
                        <label>Product Category :</label>
                        <div class="formRight">
						<?php 
						$rc = array();
						$rc[''] = '';
						foreach ($product_cat as $rc_list) :
						{
							$rc[$rc_list['cp_code']] = ($rc_list['cp_name']);
						} endforeach; 
						echo form_dropdown('prod_cat',$rc,'');
						?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Product Code:</label>
                        <div class="formRight">
						<?php 
						$pc = array(
							'name' => 'prod_code',
							'id'   => 'prod_code',
						);
						echo form_input($pc);?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Product Name:</label>
                        <div class="formRight">
						<?php 
						$pn = array(
							'name' => 'prod_name',
							'id'   => 'prod_name',
						);
						echo form_input($pn);?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Product Price:</label>
                        <div class="formRight">
						<?php 
						$pri = array(
							'name' => 'prod_rate',
							'id'   => 'prod_rate',
							'placeholder' => 'Rupiah (IDR)'
						);
						echo form_input($pri);?>
						<?php 
						$pru = array(
							'name' => 'prod_rate_usd',
							'id'   => 'prod_rate_usd',
							'placeholder' => 'Dollar (USD)'
						);
						echo form_input($pru);?>
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
				<th rowspan="2">No</th>
				<th colspan="3">Product</th>
				<th colspan="2">Rate</th>
				<th rowspan="2">Action</th>
			</tr>
			<tr>
				<th>Category</th>
				<th>Code</th>
				<th>Name</th>
				<th>IDR</th>
				<th>USD</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		if ($product != NULL)
		{
		$num = 1;
		foreach ($product as $row_rm)
		{ 
			?>
			<tr>
				<td><?php echo $num++ ?></td>
				<td><?php echo $row_rm['prod_kategori'] ?></td>
				<td><?php echo $row_rm['prod_code'] ?></td>
				<td><?php echo $row_rm['prod_name'] ?></td>
				<td align="right"><?php echo $row_rm['prod_rate'] ?></td>
				<td align="right"><?php echo $row_rm['prod_rate_dollar'] ?></td>
				
				<td><center><?php echo anchor('setting/admin/void_product/'.$row_rm['id_prod']/*, img(array('src'=>"wp-theme/images/control/16/busy.png", 'alt'=>'Delete SMU', 'title'=>'Delete SMU'))*/,'delete'); ?></td>
            </tr><?php } } ?>
        </tbody>
    </table>
</div>
</div>
</div>