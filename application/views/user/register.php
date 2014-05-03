        	<div class="block span4">
            	<a href="#page-stats" class="block-heading" data-toggle="collapse">REGISTER NEW USER</a>
        		<div id="page-stats" class="block-body collapse in">
                <br>
				<?php echo form_open('setting/user/save_user'); ?>
                    <table>
                    	<tr>
                        	<td width="30%">Username</td>
                            <td><input type="text" name="username" /></td>
                        </tr>
                        <tr>
                        	<td>Password</td>
                            <td><input type="password" name="password" /></td>
                        </tr>
                        <tr>
                        	<td>Nama</td>
                            <td><input type="text" name="nama" /></td>
                        </tr>
                        <tr>
                        	<td>Email</td>
                            <td><input type="text" name="email"/></td>
                        </tr>
						<tr>
                        	<td>No. Telp</td>
                            <td><input type="text" name="telp"/></td>
                        </tr>
                        <tr>
                        	<td>Level</td>
                            <td>
                            	<select name="level">
                                	<?php if ($auth >= 4) {?>
										<option value="developer" name="developer">Developer</option>
									<?php }
									if ($auth >= 3) {?>
										<option value="administrator" name="administrator">Administrator</option>
									<?php } ?>
                                    <option value="officer" name="officer">Officer</option>
                            	</select>
                            </td>
                        </tr>
                        <tr>
                        	<td>Jabatan</td>
                            <td>
								<select name="position">
									<?php if ($auth >= 4) {?>
										<option value="developer" name="developer">Developer</option>
									<?php }
									if ($auth >= 3) {?>
										<option value="administrator" name="administrator">Administrator</option>
									<?php } ?>
                                    <option value="manager" name="manager">Manager</option>
                                    <option value="supervisor" name="supervisor">Supervisor</option>
                                	<option value="reservation" name="reservation">Reservation Staff</option>
                                    <option value="cashier" name="cashier">Cashier Staff</option>
                                    <option value="report" name="report">Report Staff</option>
                            	</select>
							</td>
                        </tr>
						<?php if ($auth >= 3) {?>
						<tr>
                        	<td>Authority</td>
                            <td>
								<select name="auth">
								<?php if ($auth >= 4) {?>
                                    <option value="4" name="4">Developer</option>
								<?php } ?>
                                    <option value="3" name="3">Administrator</option>
                                	<option value="2" name="2">Supervisor</option>
                                    <option value="1" name="1">Staff</option>
                            	</select>
							</td>
                        </tr>
						<?php } ?>
                        <tr>
                        	<td>&nbsp;</td>
                            <td><?php echo form_submit('submit', 'Register', 'class = "btn btn-primary pull-right"'); ?></td>
                        </tr>
                    </table>
                	<?php echo form_close(); ?>
			</div>
		</div>
		<div class="span8">
		<table cellpadding="0" cellspacing="0" class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Username</th>
				<th>No. Telp</th>
				<th>Email</th>
				<th>Level</th>
				<th>Jabatan</th>
				<?php if ($auth >= 3) {?>
				<th>Action</th>
				<?php }?>
			</tr>
		</thead>
		<tbody>
		<?php 
		$num = 1;
		foreach($list_user as $row_usr){ ?>
		<tr>
			<td><?php echo $num++?></td>
			<td><?php echo $row_usr->ur_username; ?></td>
			<td><?php echo $row_usr->ur_telpon; ?></td>
			<td><?php echo $row_usr->ur_email; ?></td>
			<td><?php echo $this->encrypt->decode($row_usr->ur_level, $this->config->item('encryption_key')); ?></td>
			<td><?php echo $this->encrypt->decode($row_usr->ur_position, $this->config->item('encryption_key')); ?></td>
			<?php if ($auth >= 3) {?>
			<td>
			<?php
				if ($this->encrypt->decode($row_usr->ur_logon, $this->config->item('encryption_key')) != 4 AND $auth>=3)
				{
					if ($row_usr->ur_approved == 'no')
					{
						echo anchor('setting/user/approve_user/'.$row_usr->id_user,'Approve ');
					} else {
						echo anchor('setting/user/suspend_user/'.$row_usr->id_user,'Suspend ');
					}
					echo anchor('setting/user/update/'.$row_usr->id_user,'Edit');
				} else 
				if ($this->encrypt->decode($row_usr->ur_logon, $this->config->item('encryption_key')) == 4 AND $auth>3)
				{
					if ($row_usr->ur_approved == 'no')
					{
						echo anchor('setting/user/approve_developer/'.$row_usr->id_user,'Approve ');
					} else {
						echo anchor('setting/user/suspend_developer/'.$row_usr->id_user,'Suspend ');
					}
					echo anchor('setting/user/update/'.$row_usr->id_user,'Edit');
				}
				
			?>
			</td>
			<?php }?>
		</tr>
		<?php } ?>
        </tbody>
    </table>
		</div>
	</div>
