<div class="block span3">
<a href="#page-stats" class="block-heading" data-toggle="collapse"> New Product</a>
<div id="page-stats1" class="block-body collapse in">
	<div id="myTabContent" class="tab-content">
			<?php 
			
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('setting/admin/update_payment_type', $attributes);
			echo form_hidden('id', $payment->id_pay_type);?>
                <fieldset class="step" id="w2first">
                    <h1></h1>
					<div class="formRow">
                        <label>Payment Type :</label>
                        <div class="formRight">
						<?php 
						$pn = array(
							'name' => 'pay_name',
							'id'   => 'pay_name',
							'value'=> $payment->pay_payment_type
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
							'value'=> $payment->pay_discount
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
</div>