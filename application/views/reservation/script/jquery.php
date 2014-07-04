  <script src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/rsv/lib/js/jquery.maskedinput.min.js" type="text/javascript"></script> 
  <script type="text/javascript" src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/rsv/lib/jquery.autocomplete.min.js"></script>
  <script>
	$(function(){
	  var therapist = [
	  <?php
		foreach ($therapist as $thr_list) :
		{
			echo "{ value: '".$thr_list['thr_name']." (".$thr_list['thr_code'].")', data: '".$thr_list['thr_code']."' },";
		} endforeach; 
	  ?>
	 ];
	  var product = [
	  <?php
		foreach ($produk as $prod_list) :
		{
			echo "{ value: '".$prod_list['prod_name']." (".$prod_list['prod_code'].")', data: '".$prod_list['id_prod']."' },";
		} endforeach; 
	  ?>
	 ];
	  var nationality = [
	  <?php
		foreach ($nationality as $nation_list) :
		{
			echo '{ value: "'.$nation_list["name"].' ('.$nation_list["id"].')", data: "'.$nation_list["id"].'" },';
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
	   $('#prod').autocomplete({
		lookup: product,
		onSelect: function (suggestion) {
		  var thehtml = '<input type="hidden" name="produk" value="'+ suggestion.data +'" id="produk" />';
		  $('#outputprod').html(thehtml);
		}
	  });
	  $('#nation').autocomplete({
		lookup: nationality,
		onSelect: function (suggestion) {
		  var thehtml = '<input type="hidden" name="nationality" value="'+ suggestion.data +'" id="nationality" />';
		  $('#outputnat').html(thehtml);
		}
	  });
	  })
	

	jQuery(function($){
	   $("#time").mask("99:99");
	   $("#time2").mask("99:99");
	});
  </script>