<div class="block span3">
<a href="#page-stats" class="block-heading" data-toggle="collapse"> Edit Therapist</a>
<div id="page-stats1" class="block-body collapse in">
	<div id="myTabContent" class="tab-content">
			<?php 
			
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('setting/admin/update_therapist', $attributes);
			echo form_hidden('id', $therapist->id_therapist);?>
                <fieldset class="step" id="w2first">
                    <h1></h1>
					<div class="formRow">
                        <label>Name :</label>
                        <div class="formRight">
						<?php 
						$tn = array(
							'name' => 'therapist_code',
							'id'   => 'therapist',
							'value'=> $therapist->thr_code
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
							'name' => 'therapist_name',
							'id'   => 'therapist',
							'value'=> $therapist->thr_name
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
</div>