<?php if($this->uri->segment(4) == 'invalid_input') { ?>
	<div class="alert alert-error"><strong>Invalid Input</strong></div>
<?php } ?>

<div class="row-fluid">
<div class="block span3">
    
	<?php 	
	echo '<a href="#page-stats" class="block-heading" data-toggle="collapse"> Insert Kurs </a>
				  <div id="page-stats" class="block-body collapse in">';
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('setting/admin/insert_kurs', $attributes);?>
	
	<div id="myTabContent" class="tab-content">
		<div class="formRow">
            <label>Date:</label>
			<?php 
			$date = array(
				'name' => 'date',
				'id'   => 'datepicker',
				'style'=> 'width:40%',
				);
			echo form_input($date);
			?>
			<div class="clear"></div>
        </div>
		<div class="formRow">
            <label>Kurs:</label>
			<?php 
			$pax = array(
				'name' => 'kurs',
				'id'   => 'kurs',
				'placeholder'=> '11500',
				);
			echo form_input($pax);?>
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