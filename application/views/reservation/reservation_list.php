
<div class="block span3">
    
	<?php 	
	echo '<a href="#page-stats" class="block-heading" data-toggle="collapse"> Search Reservation </a>
				  <div id="page-stats" class="block-body collapse in">';?>
	
	<div id="myTabContent" class="tab-content">
		<div class="formRow">
		<?php $attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('reservation/admin/search_list_reservation', $attributes);?>
			<label>Reservation Code :</label>
			<?php 
			$rc = array(
				'name' => 'search',
				'id'   => 'search',
				'value' => '',
				'class'=> 'span9'
				);
			echo form_input($rc);?>
				<button class="btn btn-primary" style="margin-bottom:10px"><i class="icon-search"></i></button>
		</div>
		</form>
		<div class="formRow">
		<?php $attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('reservation/admin/search_list_reservation_by_date', $attributes);?>
			<label>Reservation Date :</label>
			<?php 
			$rd = array(
				'name' => 'date_search',
				'id'   => 'datepicker',
				'value' => '',
				'class'=> 'span9'
				);
			echo form_input($rd);?>
			<button class="btn btn-primary" style="margin-bottom:10px"><i class="icon-search"></i></button>
        </div>
		</form>
	</div>
</div>
</div>

<div class="span9">
	<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Reservation Code</th>
				<th>Date</th>
				<th>Agent</th>
				<th>Guide</th>
				<th>Pax</th>
				<th>Harga</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		if ($this->uri->segment(4) != NULL)
		{
			$num = $this->uri->segment(4) + 1;
		} else { $num = 1;}
		if ($res_list != NULL)
		{
		foreach ($res_list as $row_res)
		{ 
			$color = '';
			if ($row_res->res_status == 'void')	{$color = 'bgcolor="red"';}
			if ($row_res->res_status == 'paid')	{$color = 'bgcolor="green"';}
			?>
			<tr>
				<td <?php echo $color; ?>><center><?php echo $num++; ?></td>
				<td <?php echo $color; ?>><center><?php echo $row_res->res_code ?></td>
				<td <?php echo $color; ?>><center><?php echo date('d-m-Y', strtotime($row_res->res_date)) ?></td>
				<td <?php echo $color; ?>><center><?php echo $row_res->res_agent ?></td>
				<td <?php echo $color; ?>><center><?php echo $row_res->res_guide ?></td>
				<td <?php echo $color; ?>><center><?php echo $row_res->res_pax ?></td>
				<td <?php echo $color; ?>><center><?php echo $row_res->harga ?></td>
				<td <?php echo $color; ?>><center><?php echo $row_res->res_status ?></td>
				<td <?php echo $color; ?>><center><?php 
					echo anchor('reservation/admin/add_detail_pax/'.$row_res->res_code.'/'.$this->uri->segment(4)/*, img(array('src'=>"wp-theme/images/control/16/busy.png", 'alt'=>'Delete SMU', 'title'=>'Delete SMU'))*/,'detail &nbsp'); 
					if ($row_res->res_status == 'open')
					{
						echo anchor('reservation/admin/void_reservation/'.$row_res->res_code.'/list_reservation/'
						/*, img(array('src'=>"wp-theme/images/control/16/busy.png", 'alt'=>'Delete SMU', 'title'=>'Delete SMU'))*/,'void'); 
					}
				?></td>
            </tr> 
		<?php } }?>
        </tbody>
		<tfoot>
			<tr><td colspan="9"><div class="pagination"><?php echo $this->pagination->create_links();?></div></td></tr>
		</tfoot>
    </table>
	<?php 
		echo form_open('reservation/admin/print_reservation/'.$this->uri->segment(4));
	?>
	<div id="clear"></div>
	</div>
</div>
</div>