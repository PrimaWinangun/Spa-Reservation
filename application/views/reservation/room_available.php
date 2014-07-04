<div class="block span3">
<a href="#page-stats" class="block-heading" data-toggle="collapse"> Search</a>
<div id="page-stats1" class="block-body collapse in">
	<div id="myTabContent" class="tab-content">
	<?php $attributes = array('class'=>'form','id'=>'wizard3');
		echo form_open('reservation/admin/search_room_available', $attributes);?>
	<strong>Available Room : <?php echo date('d-m-Y', strtotime($date));?></strong>
			<div class="formRow">
                <label>Search Date :</label>
                <div class="formRight">
				<?php 
					$jk = array(
						'name' => 'date',
						'id'   => 'datepicker',
						'value'=> date('d-m-Y', strtotime($date)),
						'class'=> 'span9'
					);
					echo form_input($jk);
				?>
					<button class="btn btn-primary" style="margin-bottom:10px"><i class="icon-search"></i></button>
					<div class="btn-group">
					</div>
				</div>
			</div>
	</form>
	<?php echo form_open('reservation/admin/search_room_by_name');?>
			<div class="formRow">
                <label>Search Room :</label>
                <div class="formRight">
				<?php 
					$jk = array(
						'name' => 'room',
						'id'   => 'room',
						'value'=> '',
						'placeholder' => 'Room Name',
						'class'=> 'span9'
					);
					echo form_input($jk);
				?>
					<button class="btn btn-primary" style="margin-bottom:10px"><i class="icon-search"></i></button>
					<div class="btn-group">
					</div>
				</div>
			</div>
		</div>
		</div>
	</form>
	<div class="data" id="w2"></div>
</div>

<div class="block span9">
<div id="myTabContent" class="tab-content">
	<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered">
		<tfoot>
			<tr>
				<td colspan="16"><div class="pagination"><?php echo $this->pagination->create_links();?></div></td>
			</tr>
		</tfoot>
		<thead>
			<tr>
				<th rowspan="2">Room</th>
				<th colspan="15">Hour</th>
			</tr>
			<tr>
				<th>9</th>
				<th>10</th>
				<th>11</th>
				<th>12</th>
				<th>13</th>
				<th>14</th>
				<th>15</th>
				<th>16</th>
				<th>17</th>
				<th>18</th>
				<th>19</th>
				<th>20</th>
				<th>21</th>
				<th>22</th>
				<th>23</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			foreach($room as $room_row)
			{
				$room = 'room'.$room_row->room_name;
				$reserv = 'reserv'.$room_row->room_name;
				for($x = '09'; $x<= 23; $x++ )
				{
					$hour = 'hour'.$room_row->room_name.$x;
					$colour = 'colour'.$room_row->room_name.$x;
					$modal = 'modal'.$room_row->room_name.$x;
					$$hour = '';
					$$colour = 'white'; 
					$$modal = '';
				}
		?>
				<?php 
					foreach ($$room as $$reserv)
					{
						$colour = 'colour'.$room_row->room_name.$x;
						$start = date('H',strtotime($$reserv->rav_start));
						if (date('i', strtotime($$reserv->rav_end)) == date('i', strtotime('00')))
							{ $end = date('H',strtotime($$reserv->rav_end))-1; } else {$end = date('H',strtotime($$reserv->rav_end));}
						if ($end <= '08')
						{
							$end = '24';
						}
						for($x = $start; $x<= $end; $x++ )
						{
							$hour = 'hour'.$room_row->room_name.$x;
							$colour = 'colour'.$room_row->room_name.$x;
							$modal = 'modal'.$room_row->room_name.$x;
							$$hour = '<a data-toggle="modal" href="#myModal'.$$reserv->rav_id_rpd.'">'.$$reserv->rav_status.'</a>';
							
							if ($$reserv->rav_status == 'book')
							{
								$$colour = 'yellow';
							} else
							if ($$reserv->rav_status == 'close')
							{
								$$colour = 'red';
							} else 
							if ($$reserv->rav_status == 'paid')
							{
								$$colour = 'lime';
							}
							if ($$reserv->rpd_therapist == '')
							{
								$therapist = 'not set';
								$link = '<a href="'.base_url().'index.php/reservation/admin/set_therapist/'.$$reserv->rav_id_rpd.'" class="btn btn-primary">Set</a>';
								$$colour = '#DD9E9E';
							} else {$therapist = $$reserv->rpd_therapist; $link='<a href="'.base_url().'index.php/reservation/admin/edit_therapist/'.$$reserv->rav_id_rpd.'" class="btn btn-primary">Edit</a>';}
							$$modal = '
								<div class="modal kecil fade" id="myModal'.$$reserv->rav_id_rpd.'">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
												  <h4 class="modal-title">Detail Reservation</h4>
												</div>
												<div class="modal-body">
													<table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered">
													<tbody>
														<tr><td>Reservation ID</td><td>'.$$reserv->rpd_res_id.'</td></tr>
														<tr><td>Produk</td><td>'.$$reserv->rpd_product.'</td></tr>
														<tr><td>Therapist</td><td>'.$therapist.'</td></tr>
														<tr><td>Quantity</td><td>'.$$reserv->rpd_quantity.'</td></tr>
														<tr><td>Start</td><td>'.date('H:i',strtotime($$reserv->rpd_start_on)).'</td></tr>
														<tr><td>End</td><td>'.date('H:i',strtotime($$reserv->rpd_end_on)).'</td></tr>
													</tbody>
													</table>
												</div>
												<div class="modal-footer">
												'.$link.'
												  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
								</div>
							';
						}
					}
				?>
			<tr>
				<td><?php echo $room_row->room_name;?></td>
				<?php 
					for($x = '09'; $x<= 23; $x++ )
					{
						$hour = 'hour'.$room_row->room_name.$x;
						$colour = 'colour'.$room_row->room_name.$x;
						$modal = 'modal'.$room_row->room_name.$x;
						echo '<td bgcolor="'.$$colour.'" align="center">'.$$hour.$$modal.'</td>';
					}
				?>
            </tr> 
		<?php } ?>
        </tbody>
    </table>
</div>
</div>
