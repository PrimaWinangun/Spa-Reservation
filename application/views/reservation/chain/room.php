 <label>Room :</label>
    <div class="formRight">
	<select  name="room" id="room" class="form-control">
		<option value="">--</option>
		<?php foreach ($rooms as $room) {?>
			<option value="<?php echo $room->room_name;?>" class="<?php echo $room->room_category;?>"><?php echo $room->room_name;?></option>
		<?php } ?>
	</select>
	</div>
 <div class="clear"></div>