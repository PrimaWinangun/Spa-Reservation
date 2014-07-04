
<div class="span12">
<strong><h2>Room Report </h2></strong>
<table>
	<tr>
		<td width="40%"><strong>Room</strong></td><td>:</td><td><strong><?php echo $room; ?></td>
	</tr>
	<tr>
		<td><strong>Date </strong></td><td>:</td><td><strong><?php echo date('d-m-Y', strtotime($start)).' s/d '.date('d-m-Y', strtotime($end));?></td>
	</tr>
	<tr>
		<td colspan="3"><?php echo anchor('report/generate/room_pdf/'.$room.'/'.$start.'/'.$end,'Download as PDF');?></td>
	</tr>
</table>

	<div id="myTabContent" class="tab-content">
	<table cellpadding="0" cellspacing="0" class="table table-bordered">
		<thead>
			<tr>
				<th rowspan="2" style="vertical-align:middle">No</th>
				<th rowspan="2" style="vertical-align:middle">Room</th>
				<th rowspan="2" style="vertical-align:middle">Date</th>
				<th colspan="2">Time</th>
			</tr>
			<tr>
				<th>Start</th>
				<th>End</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		if ($room_list != NULL)
		{
		$num = 1;
		foreach ($room_list as $row_prd)
		{
			?>
			<tr>
				<td align="center"><?php echo $num++;?></td>
				<td><?php echo $row_prd->room_name;?></td>
				<td align="center"><?php echo date('d-M-Y', strtotime($row_prd->rav_book_date));?></td>
				<td align="center"><?php echo date('H:i', strtotime( $row_prd->rav_start));?></td>
				<td align="center"><?php echo date('H:i', strtotime( $row_prd->rav_end));?></td>
			</tr>
		<?php } }?>
        </tbody>
    </table>
	</div>
</div>
</div>