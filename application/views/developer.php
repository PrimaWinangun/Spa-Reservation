  	<div class="block span4">
                <br>
				<?php echo form_open('register/save_developer'); ?>
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
										<option value="developer" name="developer">Developer</option>
                            	</select>
                            </td>
                        </tr>
                        <tr>
                        	<td>Jabatan</td>
                            <td>
								<select name="position">
										<option value="developer" name="developer">Developer</option>
                            	</select>
							</td>
                        </tr>
						<tr>
                        	<td>Authority</td>
                            <td>
								<select name="auth">
                                    <option value="4" name="4">Developer</option>
                            	</select>
							</td>
                        </tr>
                        <tr>
                        	<td>&nbsp;</td>
                            <td><?php echo form_submit('submit', 'Register', 'class = "btn btn-primary pull-right"'); ?></td>
                        </tr>
                    </table>
                	<?php echo form_close(); ?>
			</div>
		</div>
	</div>
