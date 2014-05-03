
<div class="block span3">
    
	<?php 	
	echo '<a href="#page-stats" class="block-heading" data-toggle="collapse"> Search Reservation </a>
				  <div id="page-stats" class="block-body collapse in">';
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('cashier/payment/search_reservation', $attributes);?>
	
	<div id="myTabContent" class="tab-content">
		<div class="formRow">
			<label>Reservation Code :</label>
			<?php 
			$rc = array(
				'name' => 'res_code',
				'id'   => 'res_code',
				'class'=> 'span9'
				);
			echo form_input($rc);?>
			<button class="btn btn-primary" style="margin-bottom:10px"><i class="icon-search"></i></button>
		</div>
		</form>
	</div>
</div>
</div>


<div class="block span9">
<a href="#page-stats" class="block-heading" data-toggle="collapse">Reservation List</a>
<div id="page-stats2" class="block-body collapse in">
	<div id="myTabContent" class="tab-content">
	<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Reservation Code</th>
				<th>Agent</th>
				<th>Guide</th>
				<th>Pax</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		if ($res_list != NULL)
		{
		$num = $this->uri->segment(4,0) + 1;
		foreach ($res_list as $row_res)
		{ 
			$color = '';
			if ($row_res->res_status == 'void')
			{
				$color = 'bgcolor="red"';
			}
			?>
			<tr>
				<td <?php echo $color; ?>><center><?php echo $num++; ?></td>
				<td <?php echo $color; ?>><center><?php echo $row_res->res_code ?></td>
				<td <?php echo $color; ?>><center><?php echo $row_res->res_agent ?></td>
				<td <?php echo $color; ?>><center><?php echo $row_res->res_guide ?></td>
				<td <?php echo $color; ?>><center><?php echo $row_res->res_pax ?></td>
				<td <?php echo $color; ?>><center><?php echo $row_res->res_status ?></td>
				
				<td <?php echo $color; ?>><center><?php 
					if ($row_res->res_status != 'paid')
					{
						echo anchor('cashier/payment/pay_reservation/'.$row_res->res_code.'/'.$this->uri->segment(4)/*, img(array('src'=>"wp-theme/images/control/16/busy.png", 'alt'=>'Delete SMU', 'title'=>'Delete SMU'))*/,'Pay'); 
					} else 
					if ($row_res->res_status == 'paid')
					{
						echo anchor('cashier/payment/void_payment/'.$row_res->res_code.'/'.$this->uri->segment(4)/*, img(array('src'=>"wp-theme/images/control/16/busy.png", 'alt'=>'Delete SMU', 'title'=>'Delete SMU'))*/,'Void'); 
					}
				?></td>
            </tr> 
		<?php } }?>
        </tbody>
		<tfoot>
			<tr><td colspan="9"><div class="pagination"><?php echo $this->pagination->create_links();?></div></td></tr>
		</tfoot>
    </table>
	</div>
</div>
</div>