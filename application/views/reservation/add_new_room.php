
<div class="block span9">
	<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered">
        <tfoot>
			<tr><td colspan=6><div class="pagination"><?php echo $this->pagination->create_links();?></div></td></tr>
		</tfoot>
		<thead>
			<tr>
				<th>No</th>
				<th>Category</th>
				<th>Room</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		if ($room != NULL)
		{
		if ($this->uri->segment(4) == NULL)
		{ $num = 1; } else { $num = $this->uri->segment(4, 1) + 1; }
		foreach ($room as $row_rm)
		{ 
			?>
			<tr>
				<td><center><?php echo $num++; ?></td>
				<td><center><?php echo $row_rm['room_category']?></td>
				<td><center><?php echo $row_rm['room_name']?></td>
				<td><center><?php echo $row_rm['room_status']?></td>
				
				<td><center><?php 
					if ($row_rm['room_status'] == 'open')
						{
							echo '&nbsp'.anchor('reservation/admin/close_room/'.$row_rm['id'], img(array('src'=>"wp-content/themes/thebanjarbali/rsv/images/control/16/brainstorming.png", 'alt'=>'Edit room', 'title'=>'Close room')));
						} else {
							echo '&nbsp'.anchor('reservation/admin/open_room/'.$row_rm['id'], img(array('src'=>"wp-content/themes/thebanjarbali/rsv/images/control/16/sign-up.png", 'alt'=>'Edit room', 'title'=>'Open room')));
						}
				?></td>
            </tr><?php } } ?>
        </tbody>
    </table>
</div>
</div>