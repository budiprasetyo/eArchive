<?php
/*
 * suratmasukEdit.php
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
			<?php echo form_open_multipart($action); ?>
				<div class="data">
						<table>
							<tr>
								<td>ID</td>
								<td>
									<?php
										$data = array(
												'name'			=> 'id',
												'id'			=> 'text',
												'maxlength'		=> '7',
												'placeholder' 	=> 'ID',
												'class'			=> 'jq_watermark',
												'value'			=> set_value('id_suratmasuk_data',$this->form_data->id_suratmasuk_data),
												'readonly'		=> 'readonly'
												);
										echo form_input($data);
										$data = array(
												'id' 			=> set_value('id',$this->form_data->id_suratmasuk_data)
												);
										echo form_hidden($data);
									?>
								</td>
							</tr>
							<tr>
								<td valign="top">Nomor Surat<span style="color:red;"> *</span></td>
								<td>
									<?php
										$data = array(
												'name'			=> 'nosurat',
												'id'			=> 'text',
												'maxlength'		=> '100',
												'placeholder' 	=> 'Nomor Surat',
												'class'			=> 'jq_watermark',
												'value'			=> set_value('nosurat',$this->form_data->nosurat)
												);
										echo form_input($data);
									?>
									<?php echo form_error('nosurat'); ?>
								</td>
							</tr>
							<tr>
								<td valign="top">Tanggal Surat<span style="color:red;"> *</span></td>
								<td>
									<?php
										$data = array(
												'name'			=> 'tglsurat',
												'id'			=> 'tanggal',
												'maxlength'		=> '10',
												'placeholder' 	=> 'Tanggal Surat',
												'class'			=> 'jq_watermark',
												'value'			=> set_value('tglsurat',$this->form_data->tglsurat)
												);
										echo form_input($data);
									?>
									<?php echo form_error('tglsurat'); ?>
								</td>
							</tr>
							<tr>
								<td valign="top">Pengirim<span style="color:red;"> *</span></td>
								<td>
									<?php
										$data = array(
												'name'			=> 'pengirim',
												'id'			=> 'text',
												'maxlength'		=> '150',
												'placeholder' 	=> 'Pengirim',
												'class'			=> 'jq_watermark',
												'value'			=> set_value('pengirim',$this->form_data->pengirim)
												);
										echo form_input($data);
									?>
									<?php echo form_error('pengirim'); ?>
								</td>
							</tr>
							<tr>
								<td valign="top">Perihal<span style="color:red;"> *</span></td>
								<td>
									<?php
										$data = array(
												'name'			=> 'perihal',
												'id'			=> 'text',
												'maxlength'		=> '200',
												'placeholder' 	=> 'Perihal',
												'class'			=> 'jq_watermark',
												'value'			=> set_value('perihal',$this->form_data->perihal)
												);
										echo form_input($data);
									?>
									<?php echo form_error('perihal'); ?>
								</td>
							</tr>
							<tr>
								<td valign="top">Tujuan<span style="color:red;"> *</span></td>
								<td>
									<?php
										$data = array(
												'name'			=> 'tujuan',
												'id'			=> 'text',
												'maxlength'		=> '100',
												'placeholder' 	=> 'Tujuan',
												'class'			=> 'jq_watermark',
												'value'			=> set_value('tujuan',$this->form_data->tujuan)
												);
										echo form_input($data);
									?>
									<?php echo form_error('tujuan'); ?>
								</td>
							</tr>	
							<tr>
								<td valign="top">Jenis Surat<span style="color:red;"> *</span></td>
								<td>
									<?php
										$data = array(
												'name'			=> 'jenissurat',
												'id'			=> 'text',
												'maxlength'		=> '2',
												'placeholder' 	=> 'Jenis Surat',
												'class'			=> 'jq_watermark',
												'value'			=> set_value('jenissurat',$this->form_data->jenissurat)
												);
										echo form_input($data);
									?>
									<?php echo form_error('jenissurat'); ?>
								</td>
							</tr>
							<tr>
								<td valign="top">Sifat Surat<span style="color:red;"> *</span></td>
								<td>
									<?php
										$data = array(
												'name'			=> 'sifatsurat',
												'id'			=> 'text',
												'maxlength'		=> '2',
												'placeholder' 	=> 'Sifat Surat',
												'class'			=> 'jq_watermark',
												'value'			=> set_value('sifatsurat',$this->form_data->jenissurat)
												);
										echo form_input($data);
									?>
									<?php echo form_error('sifatsurat'); ?>
								</td>
							</tr>
							<tr>
								<td valign="top">File<span style="color:red;"></span></td>
								<td>
									<?php
										//~ $data = array(
												//~ 'name'			=> 'file',
												//~ 'id'			=> 'text',
												//~ 'maxlength'		=> '100',
												//~ 'placeholder' 	=> 'File',
												//~ 'class'			=> 'jq_watermark',
												//~ 'value'			=> set_value('file',$this->form_data->file)
												//~ );
										//~ echo form_input($data);
									?>
									<input type="file" name="file" id="text" />
									<?php echo form_error('file'); ?>
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
	</div>
	
