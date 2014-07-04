
<div class="block span3">
    
	<?php 	
	echo '<a href="#page-stats" class="block-heading" data-toggle="collapse"> Travel Report </a>
				  <div id="page-stats" class="block-body collapse in">';
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('report/generate/travel_report', $attributes);?>
	
	<div id="myTabContent" class="tab-content">
		<div class="formRow">
            <label>Travel:</label>
			<?php 
			$us = array();
			$us['All'] = 'All';
			foreach ($list_travel as $user_list) :
			{
				$us[$user_list['trv_code']] = ($user_list['trv_name']);
			} endforeach; 
			echo form_dropdown('travel',$us,'');
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