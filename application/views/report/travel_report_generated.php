
<div class="span12">
<strong><h2>Travel Report </h2></strong>
<table>
	<tr>
		<td width="40%"><strong>Travel Code</strong></td><td>:</td><td><strong><?php echo $travel; ?></td>
	</tr>
	<tr>
		<td><strong>Date </strong></td><td>:</td><td><strong><?php echo date('d-m-Y', strtotime($start)).' s/d '.date('d-m-Y', strtotime($end));?></td>
	</tr>
	<tr>
		<td colspan="3"><?php echo anchor('report/generate/travel_pdf/'.$travel.'/'.$start.'/'.$end,'Download as PDF');?></td>
	</tr>
</table>

	<div id="myTabContent" class="tab-content">
	<table cellpadding="0" cellspacing="0" class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Travel</th>
				<th>Guide</th>
				<th>Date</th>
				<th>Pax</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		if ($travel_list != NULL)
		{
		$num = 1;
		foreach ($travel_list as $row_prd)
		{
			?>
			<tr>
				<td align="center"><?php echo $num++;?></td>
				<td><?php echo $row_prd->trv_name;?></td>
				<td><?php echo $row_prd->res_guide;?></td>
				<td align="center"><?php echo date('d-M-Y', strtotime($row_prd->res_date));?></td>
				<td align="center"><?php echo $row_prd->sum;?></td>
			</tr>
		<?php } }?>
        </tbody>
    </table>
	</div>
</div>
</div>