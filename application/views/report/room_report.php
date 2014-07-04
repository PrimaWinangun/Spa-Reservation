
<div class="block span3">
    
	<?php 	
	echo '<a href="#page-stats" class="block-heading" data-toggle="collapse"> Room Report </a>
				  <div id="page-stats" class="block-body collapse in">';
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('report/generate/room_report', $attributes);?>
	
	<div id="myTabContent" class="tab-content">
		<div class="formRow">
            <label>Room:</label>
			<?php 
			$us = array();
			$us['All'] = 'All';
			foreach ($list_room as $user_list) :
			{
				$us[$user_list['room_name']] = ($user_list['room_name']);
			} endforeach; 
			echo form_dropdown('room',$us,'');
			?>
			<div class="clear"></div>
        </div>
		<div class="formRow">
            <label>Start Date:</label>
			<?php 
			$dis = array(
				'name' => 'start',
				'id'   => 'datepicker',
				'style'=> 'width:40%',
				'value'=> date('d-m-Y', now())
			);
			echo form_input($dis); ?>
			<div class="clear"></div>
		</div>
		<div class="formRow">
            <label>End Date:</label>
			<?php 
			$dis = array(
				'name' => 'end',
				'id'   => 'datepicker2',
				'style'=> 'width:40%',
				'value'=> date('d-m-Y', now())
			);
			echo form_input($dis); ?>
			<div class="clear"></div>
		</div>
		<div class="btn-toolbar">
			<button class="btn btn-primary"><i class="icon-save"></i> Generate</button>
			<div class="btn-group">
			</div>
		</div>
        <div class="clear"></div>
		</form>
	</div>
</div>
</div>
</div>