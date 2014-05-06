<div class="block span3">
<a href="#page-stats" class="block-heading" data-toggle="collapse"> Edit Room</a>
<div id="page-stats1" class="block-body collapse in">
	<div id="myTabContent" class="tab-content">
			<?php 
			
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('setting/admin/update_room', $attributes);
			echo form_hidden('id', $room->id);?>
                <fieldset class="step" id="w2first">
                    <h1></h1>
					<div class="formRow">
                        <label>Room Category :</label>
                        <div class="formRight">
						<?php 
						$rc = array();
						foreach ($room_cat as $rc_list) :
						{
							$rc[$rc_list['cat_code']] = ($rc_list['cat_name']);
						} endforeach; 
						echo form_dropdown('room_cat',$rc, $room->room_category);
						?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Room Name:</label>
                        <div class="formRight">
						<?php 
						$jk = array(
							'name' => 'room',
							'id'   => 'room',
							'value'=> $room->room_name
						);
						echo form_input($jk);?>
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