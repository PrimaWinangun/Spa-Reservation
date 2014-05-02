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