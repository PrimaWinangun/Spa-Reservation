<?php 
		foreach ($room101 as $room)
		{
			$start = $room->rpd_start_on;
			$end = $room->rpd_end_on;
		}
		
		$time = strtotime($end) - strtotime($start);
		$current = strtotime(date('H:i:s', now())) - strtotime($start);
		
		if ($time <= $current)
		{
			$current = $time;
		}
		echo $start.' - '.$end.' - '.date('H:i:s', now());
	?>
<input name="current" id="current" type="hidden" value="<?php echo $current; ?>" >
<input name="time" id="time" type="hidden" value="<?php echo $time; ?>" >
<script>
	var start = $('#current').attr("value");
	var end_time = $('#time').attr("value");
	var progress = start/end_time * 100;
	var time = end_time*10;
    var timer = setInterval(updateProgressbar, time);
	
    function updateProgressbar(){
        $("#progressbar").progressbar({
            value: ++progress
        });
        if(progress == end_time)
            clearInterval(timer);
    }
    
    $(function () {
        $("#progressbar").progressbar({
            value: progress
        });
    });
	
</script>
<div class="block span9">
	
	<div id="progressbar"></div>
</div>
</div>
