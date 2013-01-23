<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 *      users_model.php
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

	class Users_model extends CI_Model{
		
		function __construct()
		{
			parent::__construct();
		}
		
		// validate if text input is empty or not
		function validate()
		{
			$this->db->where('username', $this->input->post('username'));
			$this->db->where('password', md5($this->input->post('password')));
			$query = $this->db->get('users');
			
			if($query->num_rows == 1)
			{
				return true;
			}
		}
		
		
		// create users
		function create_users()
		{
			$new_users_insert_data = array(
				'first_name' => $this->input->post('nama_depan'),
				'last_name' => $this->input->post('nama_belakang'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password'))
			);
			
			$insert = $this->db->insert('users', $new_users_insert_data);
			return $insert;
		}
	}
