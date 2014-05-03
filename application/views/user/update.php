   	<div class="block span4">
	<?php 
		$username = $datauser->ur_username;
		$name = $datauser->ur_nama;
		$email = $datauser->ur_email;
		$telp = $datauser->ur_telpon;
	?>
            	<a href="#page-stats" class="block-heading" data-toggle="collapse">REGISTER NEW USER</a>
        		<div id="page-stats" class="block-body collapse in">
                <br>
				<?php echo form_open('setting/user/update_user'); 
					echo form_hidden('id_user', $this->uri->segment(4));?>
                    <table>
                    	<tr>
                        	<td width="30%">Username</td>
                            <td><input type="text" name="username" value="<?php echo $username?>" readonly="readonly"/></td>
                        </tr>
                        <tr>
                        	<td>Password</td>
                            <td><input type="password" name="password" /></td>
                        </tr>
                        <tr>
                        	<td>Nama</td>
                            <td><input type="text" name="nama" value="<?php echo $name?>"/></td>
                        </tr>
                        <tr>
                        	<td>Email</td>
                            <td><input type="text" name="email" value="<?php echo $email?>"/></td>
                        </tr>
						<tr>
                        	<td>No. Telp</td>
                            <td><input type="text" name="telp" value="<?php echo $telp?>"/></td>
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
	</div>
