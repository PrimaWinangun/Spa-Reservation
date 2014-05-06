<div class="block span3">
<a href="#page-stats" class="block-heading" data-toggle="collapse"> New Product</a>
<div id="page-stats1" class="block-body collapse in">
	<div id="myTabContent" class="tab-content">
			<?php 
			
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('setting/admin/update_product', $attributes);
			echo form_hidden('id', $product->id_prod);?>
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
						echo form_dropdown('prod_cat',$rc,$product->prod_kategori);
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
							'value'=> $product->prod_code
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
							'value'=> $product->prod_name
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
							'placeholder' => 'Rupiah (IDR)',
							'value'=> $product->prod_rate
						);
						echo form_input($pri);?>
						<?php 
						$pru = array(
							'name' => 'prod_rate_usd',
							'id'   => 'prod_rate_usd',
							'placeholder' => 'Dollar (USD)',
							'value'=> $product->prod_rate_dollar
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
</div>