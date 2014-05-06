<div class="block span3">
    
	<?php 	
	echo '<a href="#page-stats" class="block-heading" data-toggle="collapse"> Insert Reservation </a>
				  <div id="page-stats" class="block-body collapse in">';
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('setting/admin/update_room_cat', $attributes);
			echo form_hidden('id', $this->uri->segment(4));?>
	
	<div id="myTabContent" class="tab-content">
		<div class="formRow">
			<label>Room Category Code :</label>
			<?php 
			$rcc = array(
				'name' => 'room_code',
				'id'   => 'room_code',
				'value'=> $room_cat->cat_code
				);
			echo form_input($rcc);?>
            <div class="clear"></div>
        </div>
		<div class="formRow">
			<label>Room Category :</label>
			<?php 
			$rc = array(
				'name' => 'room_cat',
				'id'   => 'room_cat',
				'value'=> $room_cat->cat_name
				);
			echo form_input($rc);?>
            <div class="clear"></div>
        </div>
		<div class="btn-toolbar">
			<button class="btn btn-primary"><i class="icon-save"></i> Save</button>
			<div class="btn-group">
			</div>
		</div>
        <div class="clear"></div>
		</form>
	</div>
</div>
</div>

</div>