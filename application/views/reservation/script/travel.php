
  <script type="text/javascript" src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/rsv/lib/jquery.autocomplete.min.js"></script>
  <script>
	$(function(){
	  var travel = [
	  <?php
		foreach ($travel as $trv_list) :
		{
			echo '{ value: "'.$trv_list["trv_name"].' ('.$trv_list["trv_code"].')", data: "'.$trv_list["trv_code"].'" },';
		} endforeach; 
	  ?>
	 ];
  
	  // setup autocomplete function pulling from travel[] array
	  $('#trv').autocomplete({
		lookup: travel,
		onSelect: function (suggestion) {
		  var thehtml = '<input type="hidden" name="travel" value="'+ suggestion.data +'" id="travel" />';
		  $('#outputbox').html(thehtml);
		}
	  });
	});
  </script>