<?php
/*
 * officeEdit.php
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
		<!--
		<div id="formdialog" title="">
		-->
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
					<td valign="top">Kode Kementerian<span style="color:red;"> *</span></td>
					<td>
						<?php
							$data = array(
							'name'			=> 'kdmenteri',
							'id'			=> 'category1',
							'maxlength'		=> '3',
							'placeholder' 	=> 'Kode Kementerian',
							'class'			=> 'jq_watermark',
							'value'			=> set_value('kdmenteri',$this->form_data->kdmenteri)
							);
							echo form_input($data);
						?>
						<div id="category_suggestions1">
							<div class="suggestions" id="category_autoSuggestionsList1">
							</div>
						</div>
						<?php echo form_error('kdmenteri'); ?>
					</td>
				</tr>
				<tr>
					<td valign="top">Kode Eselon I<span style="color:red;"> *</span></td>
					<td>
						<?php
							$data = array(
							'name'			=> 'kdes1',
							'id'			=> 'category2',
							'maxlength'		=> '2',
							'placeholder' 	=> 'Kode Eselon I',
							'class'			=> 'jq_watermark',
							'value'			=> set_value('kdes1',$this->form_data->kdes1)
							);
							echo form_input($data);
						?>
						<div id="category_suggestions2">
							<div class="suggestions" id="category_autoSuggestionsList2">
							</div>
						</div>
						<?php echo form_error('kdes1'); ?>
					</td>
				</tr>
				<tr>
					<td valign="top">Kode Eselon II<span style="color:red;"> *</span></td>
					<td>
						<?php
							$data = array(
									'name'			=> 'kdes2',
									'id'			=> 'text',
									'maxlength'		=> '2',
									'placeholder' 	=> 'Kode Eselon II',
									'class'			=> 'jq_watermark',
									'value'			=> set_value('kdes2',$this->form_data->kdes2)
									);
							echo form_input($data);
						?>
						<?php echo form_error('kdes2'); ?>
					</td>
				</tr>	
				<tr>
					<td valign="top">Kode Satker<span style="color:red;"> *</span></td>
					<td>
						<?php
							$data = array(
									'name'			=> 'kdsatker',
									'id'			=> 'text',
									'maxlength'		=> '6',
									'placeholder' 	=> 'Kode Satker',
									'class'			=> 'jq_watermark',
									'value'			=> set_value('kdsatker',$this->form_data->kdsatker)
									);
							echo form_input($data);
						?>
						<?php echo form_error('kdsatker'); ?>
					</td>
				</tr>	
				<tr>
					<td valign="top">Alamat<span style="color:red;"> *</span></td>
					<td>
						<?php
							$data = array(
									'name'			=> 'alamat',
									'id'			=> 'text',
									'maxlength'		=> '250',
									'placeholder' 	=> 'Alamat',
									'class'			=> 'jq_watermark',
									'value'			=> set_value('alamat',$this->form_data->alamat)
									);
							echo form_input($data);
						?>
						<?php echo form_error('alamat'); ?>
					</td>
				</tr>
				<tr>
					<td valign="top">Kode Pos<span style="color:red;"> *</span></td>
					<td>
						<?php
							$data = array(
									'name'			=> 'kodepos',
									'id'			=> 'text',
									'maxlength'		=> '5',
									'placeholder' 	=> 'Kode Pos',
									'class'			=> 'jq_watermark',
									'value'			=> set_value('kodepos',$this->form_data->kodepos)
									);
							echo form_input($data);
						?>
						<?php echo form_error('kodepos'); ?>
					</td>
				</tr>		
				<tr>
					<td valign="top">No.Telepon<span style="color:red;"> *</span></td>
					<td>
						<?php
							$data = array(
									'name'			=> 'telp',
									'id'			=> 'text',
									'maxlength'		=> '50',
									'placeholder' 	=> 'No.Telepon',
									'class'			=> 'jq_watermark',
									'value'			=> set_value('telp',$this->form_data->telp)
									);
							echo form_input($data);
						?>
						<?php echo form_error('telp'); ?>
					</td>
				</tr>
				<tr>
					<td valign="top">No.Fax</td>
					<td>
						<?php
							$data = array(
									'name'			=> 'fax',
									'id'			=> 'text',
									'maxlength'		=> '50',
									'placeholder' 	=> 'No.Fax',
									'class'			=> 'jq_watermark',
									'value'			=> set_value('fax',$this->form_data->fax)
									);
							echo form_input($data);
						?>
						<?php echo form_error('fax'); ?>
					</td>
				</tr>
				<tr>
					<td valign="top">E-mail</td>
					<td>
						<?php
							$data = array(
									'name'			=> 'email',
									'id'			=> 'text',
									'maxlength'		=> '50',
									'placeholder' 	=> 'E-mail',
									'class'			=> 'jq_watermark',
									'value'			=> set_value('email',$this->form_data->email)
									);
							echo form_input($data);
						?>
						<?php echo form_error('email'); ?>
					</td>
				</tr>
				<tr>
					<td valign="top">Website</td>
					<td>
						<?php
							$data = array(
									'name'			=> 'website',
									'id'			=> 'text',
									'maxlength'		=> '50',
									'placeholder' 	=> 'Website',
									'class'			=> 'jq_watermark',
									'value'			=> set_value('website',$this->form_data->website)
									);
							echo form_input($data);
						?>
						<?php echo form_error('website'); ?>
					</td>
				</tr>
				<tr>
					<td valign="top">No.SMS Gateway</td>
					<td>
						<?php
							$data = array(
									'name'			=> 'smsgateway',
									'id'			=> 'text',
									'maxlength'		=> '25',
									'placeholder' 	=> 'No.SMS Gateway',
									'class'			=> 'jq_watermark',
									'value'			=> set_value('smsgateway',$this->form_data->smsgateway)
									);
							echo form_input($data);
						?>
						<?php echo form_error('smsgateway'); ?>
					</td>
				</tr>
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
		<!--
		</div>
		-->
	</div>
	

