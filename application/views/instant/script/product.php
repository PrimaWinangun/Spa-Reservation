  <script src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/rsv/lib/js/jquery.maskedinput.min.js" type="text/javascript"></script> 
  <script type="text/javascript" src="<?php echo base_url(); ?>wp-content/themes/thebanjarbali/rsv/lib/jquery.autocomplete.min.js"></script>
  <script>
	$(function(){
	  var product = [
	  <?php
		foreach ($produk as $prod_list) :
		{
			echo "{ value: '".$prod_list['prod_name']." (".$prod_list['prod_code'].")', data: '".$prod_list['id_prod']."' },";
		} endforeach; 
	  ?>
	 ];
	  // setup autocomplete function pulling from therapist[] array
	 
	   $('#prod').autocomplete({
		lookup: product,
		onSelect: function (suggestion) {
		  var thehtml = '<input type="hidden" name="produk" value="'+ suggestion.data +'" id="produk" />';
		  $('#outputprod').html(thehtml);
		}
	  });
	  })
  </script>