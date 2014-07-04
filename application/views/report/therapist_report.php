
<div class="block span3">
    <script type="text/javascript" src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/rsv/lib/jquery.autocomplete.min.js"></script>
  <script>
	$(function(){
	  var therapist = [
	  <?php
		foreach ($list_therapist as $thr_list) :
		{
			echo "{ value: '".$thr_list['thr_name']." (".$thr_list['thr_code'].")', data: '".$thr_list['thr_code']."' },";
		} endforeach; 
	  ?>
	 ];
  
	  // setup autocomplete function pulling from therapist[] array
	  $('#thr').autocomplete({
		lookup: therapist,
		onSelect: function (suggestion) {
		  var thehtml = '<input type="hidden" name="therapist" value="'+ suggestion.data +'" id="therapist" />';
		  $('#outputbox').html(thehtml);
		}
	  });
});
  </script>
	<?php 	
	echo '<a href="#page-stats" class="block-heading" data-toggle="collapse"> Therapist Report </a>
				  <div id="page-stats" class="block-body collapse in">';
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('report/generate/therapist_report', $attributes);?>
	
	<div id="myTabContent" class="tab-content">
		<div class="formRow">
            <label>Therapist:</label>
			<div class="formRow">
							<input type="text" name="thr" value="" id="thr"/>
						</div>
                        <div class="clear"></div>
						
                    </div>
					<div id="outputbox"><input type="hidden" name="therapist" value="All" id="therapist" /></div>
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