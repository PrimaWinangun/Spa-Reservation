
<div class="block span3">
    
	<?php 	
	echo '<a href="#page-stats" class="block-heading" data-toggle="collapse"> Payment Report </a>
				  <div id="page-stats" class="block-body collapse in">';
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('report/generate/payment_report', $attributes);?>
	
	<div id="myTabContent" class="tab-content">
		<div class="formRow">
            <label>User:</label>
			<?php 
			$us = array();
			$us['All'] = 'All';
			foreach ($list_user as $user_list) :
			{
				$us[$user_list['username']] = ($user_list['nama']);
			} endforeach; 
			echo form_dropdown('user',$us,'');
			?>
			<div class="clear"></div>
        </div>
		<div class="formRow">
            <label>Payment Type:</label>
			<?php 
						$rc = array(
								'All' => 'All',
								'Cash' => 'Cash',
								'Credit_Credit' => 'Credit Card',
								'Debit_Credit' => 'Debit Card',
								'Deposit' => 'Deposit',
								'FOC' => 'FOC',
							);
						echo form_dropdown('pay_type',$rc,''); ?>
			<div class="clear"></div>
        </div>
		<div class="formRow">
            <label>Start Date:</label>
			<?php 
			$dis = array(
				'name' => 'start',
				'id'   => 'datepicker',
				'style'=> 'width:40%',
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