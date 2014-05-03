<div class="block span4">
        <p class="block-heading">Create Manifest outbound</p>
        <div class="block-body">
		<?php echo form_open('outbound/manifest/create_manifest');?>
		<table>
			<tr>
				<td>Airline</td>
				
			</tr>
			<tr>
				<td>Flight Number</td>
				<td><input name="flight_no" placeholder="GA110" type="text"></td>
			</tr>
			<tr>
				<td>A/C Registration</td>
				<td><input name="ac_reg" placeholder="PK" type="text"></td>
			</tr>
			<tr>
				<td>Tanggal Manifest</td>
				<td><input name="date" placeholder="ALL" type="text" value="<?php echo mdate('%d-%m-%Y', now())?>"></td>
			</tr>
			<tr>
				<td>NIL</td>
				<td><?php echo form_checkbox('nil', 'yes');?></td>
			</tr>
		</table>
        <div class="btn-toolbar">
			<button class="btn btn-primary"><i class="icon-save"></i> Create & Build Up</button>
		<div class="btn-group">
		</div>
		</div>
		<?php echo form_close();?>
	</div>
</div>
<div class="span8">
	<center><b>History Manifest Outbound Tanggal </b>
	<table class="table table-bordered" width="90%" padding-top>
		<thead>
			<tr>
				<th>No</th>
				<th>Airline</th>
				<th>Flight No</th>
				<th>A/C Registration</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		
		</tbody>
	</table>
	<center><div class="pagination"><?php echo $this->pagination->create_links();?></div></center>
	</center>
</div>