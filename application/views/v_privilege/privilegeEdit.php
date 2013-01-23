<?php
/*
 * privilegeEdit.php
 * 
 * Copyright 2012 metamorph <metamorph@metamorph>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

?>
	<div class="content">
			<h1><?php echo $title; ?></h1>
			<?php echo $message; ?>
			<?php echo form_open($action); ?>
				<div class="data">
						<table>
							<tr>
								<td>ID</td>
								<td>
									<?php
										$data = array(
												'name'			=> 'id',
												'id'			=> 'text',
												'maxlength'		=> '4',
												'placeholder' 	=> 'ID',
												'class'			=> 'jq_watermark',
												'value'			=> set_value('id',$this->form_data->id),
												'readonly'		=> 'readonly'
												);
										echo form_input($data);
										$data = array(
												'id'			=> set_value('id',$this->form_data->id)
												);
										echo form_hidden($data);
									?>
								</td>
							</tr>
							<tr>
								<td valign="top">Privilege<span style="color:red;"> *</span></td>
								<td>
									<?php
										$data = array(
												'name'			=> 'privilege',
												'id'			=> 'text',
												'minlength'		=> '3',
												'maxlength'		=> '30',
												'placeholder' 	=> 'Privilege',
												'class'			=> 'jq_watermark',
												'value'			=> set_value('privilege',$this->form_data->privilege)
												);
										echo form_input($data);
									?>
									<?php echo form_error('privilege'); ?>
								</td>
							</tr>
							
							<tr>
								<td valign="top"><h3>Sub Menu</h3></td> <!-- Menu Section -->
								<td></td>
							</tr>
							<?php foreach ($menus as $menu) { ?>
							<tr>
								<td valign="top"><?php echo $menu->title; ?></td>
								<td>
									<?php
										if(isset($menu->id_dyn_menu) != NULL)
										{
											$data = array(	'name'	=> 'id_dyn_menu[]',
															'value'	=> $menu->id,
															'checked'	=> TRUE
													);
										}
										else
										{
											$data = array(	'name'	=> 'id_dyn_menu[]',
															'value'	=> $menu->id
													);											
										}	
											
										echo form_checkbox($data);
									?>
									<?php echo form_error('id_dyn_menu'); ?>
								</td>
							</tr>
							<?php } ?>
							
							<tr>
								<td>
									&nbsp;
								</td>
								<td>
									<?php
										$data = array(
													'name' 	=> 'submit',
													'id'	=> 'btnSubmit',
													'value'	=> 'Simpan'
												);
										echo form_submit($data);
									?>
								</td>
							</tr>
						</table>
					<?php
						echo form_close();
					?>
				</div>
			<br />
			<?php
				echo $link_back;
			?>
	</div>
	
