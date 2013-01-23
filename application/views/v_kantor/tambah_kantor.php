<!--
   tambah_kantor.php
   
   Copyright 2012 metamorph <metamorph@metamorph>
   
   This program is free software; you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; either version 2 of the License, or
   (at your option) any later version.
   
   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.
   
   You should have received a copy of the GNU General Public License
   along with this program; if not, write to the Free Software
   Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
   MA 02110-1301, USA.
   
   
-->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#kantor_form").hide();
			$("#flip").click(function(){
				$("#kantor_form").slideToggle("slow");
			});
		});
	</script>
	<div id="form_apps">
			<p id="flip">Tampilkan/Sembunyikan Form</p>
			<h1>Referensi Kantor</h1>
			<p>Data referensi ini digunakan untuk perekaman referensi kantor</p>
			<!-- Action = 'c_ref_kantor/simpan_rkantor' -->
			<?php
				$attributes	= array('id' => 'kantor_form');
				echo form_open('c_ref_kantor/simpan_rkantor', $attributes);
			?>
					<label>Kode Kementerian
						<span class='small'>Isikan kode kementerian</span>
					</label>
					<?php
						$data = array(
							'name'			=> 'kdmenteri',
							'id'			=> 'kdmenteri',
							'maxlength'		=> '3',
							'placeholder' 	=> 'Kode Kementerian',
							'class'			=> 'jq_watermark'
						);
						echo form_input($data);
					?>
					<label>Kode Eselon I
						<span class='small'>Isikan kode eselon I</span>
					</label>
					<?php
						$data = array(
							'name'			=> 'kdes1',
							'id'			=> 'kdes1',
							'maxlength'		=> '2',
							'placeholder' 	=> 'Kode Eselon I',
							'class'			=> 'jq_watermark'
						);
						echo form_input($data);
					?>
					<!-- Kode Eselon II = Kode Eselon I + Kode Eselon II -->
					<label>Kode Eselon II
						<span class='small'>Isikan kode eselon II</span>
					</label>
					<?php
						$data = array(
							'name'		=> 'kdes2',
							'id'		=> 'kdes2',
							'maxlength'	=> '4',
							'placeholder' 	=> 'Kode Eselon II {kode eselon 1 + kode eselon 2}',
							'class'			=> 'jq_watermark'
						);
						echo form_input($data);
					?>
					<label>Kode Satker
						<span class='small'>Isikan kode satker</span>
					</label>
					<?php
						$data = array(
							'name'			=> 'kdsatker',
							'id'			=> 'kdsatker',
							'maxlength'		=> '6',
							'placeholder' 	=> 'Kode Satker',
							'class'			=> 'jq_watermark'
						);
						echo form_input($data);
					?>
					<label>Alamat
						<span class='small'>Isikan alamat</span>
					</label>
					<?php
						$data = array(
							'name'			=> 'alamat',
							'id'			=> 'alamat',
							'maxlength'		=> '250',
							'placeholder' 	=> 'Alamat (maksimal 250 karakter)',
							'class'			=> 'jq_watermark'
						);
						echo form_input($data);
					?>
					<label>Kode Pos
						<span class='small'>Isikan kode pos</span>
					</label>
					<?php
						$data = array(
							'name'			=> 'kodepos',
							'id'			=> 'kodepos',
							'maxlength'		=> '5',
							'placeholder' 	=> 'Kode Pos',
							'class'			=> 'jq_watermark'
						);
						echo form_input($data);
					?>
					<label>No. Telepon
						<span class='small'>Isikan nomor telepon</span>
					</label>
					<?php
						$data = array(
							'name'			=> 'telp',
							'id'			=> 'telp',
							'maxlength'		=> '50',
							'placeholder' 	=> 'No.Telp {no.telp 1, no.telp 2}',
							'class'			=> 'jq_watermark'
						);
						echo form_input($data);
					?>
					<label>No. Fax
						<span class='small'>Isikan nomor fax</span>
					</label>
					<?php
						$data = array(
							'name'			=> 'fax',
							'id'			=> 'fax',
							'maxlength'		=> '50',
							'placeholder' 	=> 'No.Fax {no.fax 1, no.fax 2}',
							'class'			=> 'jq_watermark'
						);
						echo form_input($data);
					?>
					<label>E-mail
						<span class='small'>Isikan nomor e-mail</span>
					</label>
					<?php
						$data = array(
							'name'			=> 'email',
							'id'			=> 'email',
							'maxlength'		=> '50',
							'placeholder' 	=> 'E-mail',
							'class'			=> 'jq_watermark'
						);
						echo form_input($data);
					?>
					<label>Website
						<span class='small'>Isikan nama website</span>
					</label>
					<?php
						$data = array(
							'name'			=> 'website',
							'id'			=> 'website',
							'maxlength'		=> '50',
							'placeholder' 	=> 'Nama Website',
							'class'			=> 'jq_watermark'
						);
						echo form_input($data);
					?>
					<label>SMS Gateway
						<span class='small'>Isikan SMS gateway</span>
					</label>
					<?php
						$data = array(
							'name'			=> 'smsgateway',
							'id'			=> 'smsgateway',
							'maxlength'		=> '25',
							'placeholder' 	=> 'No.SMS Gateway',
							'class'			=> 'jq_watermark'
						);
						echo form_input($data);
						$this->load->helper('html');
						echo br(2);
						echo form_submit('submit','simpan');
					?>
	</div>
