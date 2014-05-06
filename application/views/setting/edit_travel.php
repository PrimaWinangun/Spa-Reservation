<div class="block span3">
<a href="#page-stats" class="block-heading" data-toggle="collapse"> New Travel</a>
<div id="page-stats1" class="block-body collapse in">
	<div id="myTabContent" class="tab-content">
			<?php 
			
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('setting/admin/update_travel', $attributes);
			echo form_hidden('id', $travel->id_travel);?>
                <fieldset class="step" id="w2first">
                    <h1></h1>
					<div class="formRow">
                        <label>Code :</label>
                        <div class="formRight">
						<?php 
						$tc = array(
							'name' => 'trv_code',
							'id'   => 'trv_code',
							'value'=> $travel->trv_code
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
							'value'=> $travel->trv_name
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
							'value'=> $travel->trv_address
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
							'value'=> $travel->trv_phone
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
							'value'=> $travel->trv_mail
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
</div>