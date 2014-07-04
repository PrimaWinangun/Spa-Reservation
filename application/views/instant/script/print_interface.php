<html>
<head>
 <title>JavaScript Popup Example 3</title>
</head>
<script type="text/javascript">
function poponload()
{
    var popup = window.open("about:blank", "_blank");
	popup.location = "<?php echo base_url();?>index.php/instant/reservation/print_payment";
}
</script>
<body onload="javascript: poponload()">
</body>
</html>