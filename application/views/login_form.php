<?php
/*
 *      login_form.php
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
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login Form</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.20" />
</head>

<body>
	<div id="login_form">
		<h2>Login Form</h2>
		<?php
			echo form_open('login/validate_credentials');
				$data = array(
							'name'			=> 'username',
							'id'			=> 'text',
							'maxlength'		=> '30',
							'placeholder' 	=> 'Username',
							'class'			=> 'jq_watermark',
							'autofocus'		=> 'autofocus'
							);
			echo form_input($data);
				$data = array(
							'name'			=> 'password',
							'id'			=> 'text',
							'maxlength'		=> '32',
							'placeholder' 	=> 'Password',
							'class'			=> 'jq_watermark'
							);
			echo form_password($data);
			echo form_submit('submit','Login');
			echo anchor('login/signup','Create User');
		?>
	</div>
</body>

</html>
