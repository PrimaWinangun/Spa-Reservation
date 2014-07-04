<?php 
	echo form_open_multipart('register/do_upload_verification');
?>
	<input type="file" name="userfile" size="20" />
 <div class="btn-toolbar">
			<button class="btn btn-primary"><i class="icon-save"></i> Save</button>
		<div class="btn-group">
<?php echo form_close();?>