<?php
/*
 *      createusers_form.php
 *      
 *      Copyright 2012 metamorph <metamorph@metamorph>
 *      
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *      
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *      
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 *      
 *      
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Create Users</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.20" />
</head>

<body>
	<div id="login_form">
	<h2>Create Users</h2>
		<fieldset>
			<legend>Informasi Pribadi</legend>
			<?php
				echo form_open('login/create_users');
				echo form_input('nama_depan',set_value('nama_depan','Nama Depan'));
				echo form_input('nama_belakang',set_value('nama_belakang','Nama Belakang'));
			?>
		</fieldset>
		
		<fieldset>
			<legend>Informasi Login</legend>
			<?php
				echo form_input('username',set_value('username','Username'));
				echo form_input('password',set_value('password','Password'));
				echo form_input('password1',set_value('password1','Konfirmasi Password'));
				
				echo form_submit('submit','Rekam User');
				echo anchor('login','Login');
				
				echo validation_errors('<p class="error">');
			?>
		</fieldset>
	</div>
</body>

</html>
