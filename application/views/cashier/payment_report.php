
<div class="block span3">
    
	<?php 	
	echo '<a href="#page-stats" class="block-heading" data-toggle="collapse"> Payment Report </a>
				  <div id="page-stats" class="block-body collapse in">';
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('cashier/payment/generate_payment_report', $attributes);?>
	
	<div id="myTabContent" class="tab-content">
		<div class="formRow">
            <label>User:</label>
			<?php 
			$us = array();
			if ($user['authority'] < 2)
			{ $disabled = 'readonly="readonly"'; } else { $disabled = ''; }
			foreach ($list_user as $user_list) :
			{
				$us[$user_list['username']] = ($user_list['nama']);
			} endforeach; 
			echo form_dropdown('user',$us,$user['username'], $disabled);
			?>
			<div class="clear"></div>
        </div>
		<div class="formRow">
            <label>Payment Type:</label>
			<?php 
						$rc = array(
								'All' => 'All',
								'Cash' => 'Cash',
								'Credit' => 'Credit',
								'Deposit' => 'Deposit',
								'Hutang' => 'Receivable',
								'FOC' => 'FOC',
							);
						echo form_dropdown('pay_type',$rc,''); ?>
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