<?php if($this->uri->segment(5) == 'therapist_not_available') { ?>
	<div class="alert alert-error"><strong>Therapist Not Available at the time</strong></div>
<?php } ?>
  <script type="text/javascript" src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/rsv/lib/jquery.autocomplete.min.js"></script>
  <script>
	$(function(){
	  var therapist = [
	  <?php
		foreach ($therapist as $thr_list) :
		{
			echo "{ value: '".$thr_list['thr_name']."', data: '".$thr_list['thr_code']."' },";
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
<div class="row-fluid">
<div class="block span3">
<?php 
	foreach($data_pax as $row_pax) 
	{
		$room = $row_pax->rpd_room;
		$date = $row_pax->res_date;
		$res = $row_pax->rpd_res_id;
		$prod = $row_pax->rpd_product;
		$start = date('H:i',strtotime($row_pax->rpd_start_on));
		$end = date('H:i',strtotime($row_pax->rpd_end_on));
	}
?>
<a href="#page-stats" class="block-heading" data-toggle="collapse"> Reservation Code <?php echo $res;?></a>
<div id="page-stats1" class="block-body collapse in">
	<div id="myTabContent" class="tab-content">
			<?php 
			
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('reservation/admin/update_data_therapist', $attributes);
			echo form_hidden('res_code', $res);
			echo form_hidden('res_date', $date);
			echo form_hidden('res_id', $this->uri->segment(4));?>
                <fieldset class="step" id="w2first">
                    <h1></h1>
					<div class="formRow room">
                        <label>Room :</label>
                        <div class="formRight">
						<?php 
							$jk = array(
								'name' => 'room',
								'id'   => 'room',
								'value'=> $room,
								'readonly' => 'readonly'
							);
						echo form_input($jk);?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Produk :</label>
                        <div class="formRight">
						<?php 
							$jk = array(
								'name' => 'prod',
								'id'   => 'prod',
								'value'=> $prod,
								'readonly' => 'readonly'
							);
						echo form_input($jk);?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Therapist :</label>
                        <div class="formRight">
							<input type="text" name="thr" value="" id="thr"/>
						</div>
                        <div class="clear"></div>
						
                    </div>
					<div id="outputbox"><input type="hidden" name="therapist" value="" id="therapist" /></div>
					
					<div class="formRow">
                        <label>Start :</label>
                        <div class="formRight">
						<?php 
						$st = array(
							'name' => 'start',
							'id'   => 'datetimepicker',
							'value'=> $start,
							'readonly' => 'readonly'
						);
						echo form_input($st);;?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>End :</label>
                        <div class="formRight">
						<?php 
						$en = array(
							'name' => 'end',
							'id'   => 'datetimepicker2',
							'value'=> $end,
							'readonly' => 'readonly'
						);
						echo form_input($en);?>
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