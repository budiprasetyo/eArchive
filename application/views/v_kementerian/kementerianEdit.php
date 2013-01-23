<?php
/*
 * kementerianEdit.php
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
<!--
<script type="text/javascript">
	$(document).ready(function(){
		$(".content").fadeIn(300,function(){
		
			// add the mask to body
			$(".content").append("<div id='mask'></div>");
			$("#mask").fadeIn(300);
			
			return false;
		});
		
		// when clicking on the button the mask layer the popup closed
		$("a.back,#mask").live("click", function(){
			$("#mask,.content").fadeOut(300,function(){
				$("#mask").remove();
			});
			return false;
		});
	});
</script>
-->
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
								<td valign="top">Kode Kementerian<span style="color:red;"> *</span></td>
								<td>
									<?php
										$data = array(
												'name'			=> 'kdmenteri',
												'id'			=> 'text',
												'maxlength'		=> '3',
												'placeholder' 	=> 'Kode Kementerian',
												'class'			=> 'jq_watermark',
												'value'			=> set_value('kdmenteri',$this->form_data->kdmenteri)
												);
										echo form_input($data);
									?>
									<?php echo form_error('kdmenteri'); ?>
								</td>
							</tr>
							<tr>
								<td valign="top">Nama Kementerian<span style="color:red;"> *</span></td>
								<td>
									<?php
										$data = array(
												'name'			=> 'nmmenteri',
												'id'			=> 'text',
												'maxlength'		=> '175',
												'placeholder' 	=> 'Nama Kementerian',
												'class'			=> 'jq_watermark',
												'value'			=> set_value('nmmenteri',$this->form_data->nmmenteri)
												);
										echo form_input($data);
									?>
									<?php echo form_error('nmmenteri'); ?>
								</td>
							</tr>
							<tr>
								<td valign="top">Kode Eselon I<span style="color:red;"> *</span></td>
								<td>
									<?php
										$data = array(
												'name'			=> 'kdes1',
												'id'			=> 'text',
												'maxlength'		=> '2',
												'placeholder' 	=> 'Kode Eselon I',
												'class'			=> 'jq_watermark',
												'value'			=> set_value('kdes1',$this->form_data->kdes1)
												);
										echo form_input($data);
									?>
									<?php echo form_error('kdes1'); ?>
								</td>
							</tr>
							<tr>
								<td valign="top">Nama Eselon I<span style="color:red;"> *</span></td>
								<td>
									<?php
										$data = array(
												'name'			=> 'nmes1',
												'id'			=> 'text',
												'maxlength'		=> '200',
												'placeholder' 	=> 'Nama Eselon I',
												'class'			=> 'jq_watermark',
												'value'			=> set_value('nmes1',$this->form_data->nmes1)
												);
										echo form_input($data);
									?>
									<?php echo form_error('nmes1'); ?>
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
								<td valign="top">Nama Eselon II<span style="color:red;"> *</span></td>
								<td>
									<?php
										$data = array(
												'name'			=> 'nmes2',
												'id'			=> 'text',
												'maxlength'		=> '200',
												'placeholder' 	=> 'Nama Eselon II',
												'class'			=> 'jq_watermark',
												'value'			=> set_value('nmes2',$this->form_data->nmes2)
												);
										echo form_input($data);
									?>
									<?php echo form_error('nmes2'); ?>
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
	
