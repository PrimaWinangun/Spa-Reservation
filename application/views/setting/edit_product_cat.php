<div class="block span3">
<a href="#page-stats" class="block-heading" data-toggle="collapse"> Edit Product Category</a>
<div id="page-stats1" class="block-body collapse in">
	<div id="myTabContent" class="tab-content">
			<?php 
			
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('setting/admin/update_product_cat', $attributes);
			echo form_hidden('id', $product_cat->id_cat_product);?>
                <fieldset class="step" id="w2first">
                    <h1></h1>
					<div class="formRow">
                        <label>Category Code:</label>
                        <div class="formRight">
						<?php 
						$pc = array(
							'name' => 'cat_code',
							'id'   => 'cat_code',
							'value'=> $product_cat->cp_code
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
							'value'=> $product_cat->cp_name
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
</div>