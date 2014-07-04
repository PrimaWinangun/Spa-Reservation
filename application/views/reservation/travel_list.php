<div class="block span12">
	<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered">
        <tfoot>
			<tr><td colspan=8><div class="pagination"><?php echo $this->pagination->create_links();?></div></td></tr>
		</tfoot>
		<thead>
			<tr>
				<th>No</th>
				<th>Code</th>
				<th>Name</th>
				<th>Address</th>
				<th>Phone</th>
				<th>Email</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		if ($travel != NULL)
		{
		$num = 1;
		foreach ($travel as $row_rm)
		{ 
			?>
			<tr>
				<td><?php echo $num++ ?></td>
				<td><?php echo $row_rm['trv_code'] ?></td>
				<td><?php echo $row_rm['trv_name'] ?></td>
				<td><?php echo $row_rm['trv_address'] ?></td>
				<td><?php echo $row_rm['trv_phone'] ?></td>
				<td><?php echo $row_rm['trv_mail'] ?></td>
            </tr><?php }} ?>
        </tbody>
    </table>
</div>