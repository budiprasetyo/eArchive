<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 *      login.php
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
class Login extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	// index page
	public function index()
	{
		$data['main_content'] = 'login_form';
		$this->load->view('includes/templateslogin', $data);
	}
	
	// validate input user and password
	public function validate_credentials()
	{
		
		$this->load->model('users_model');
		$query = $this->users_model->validate();
		
		if($query) // if the users's credentials are validated
		{
			
			$data = array(
				'username' => $this->input->post('username'),
				'is_logged_in' => TRUE
			);
			
			$this->session->set_userdata($data);
			redirect('site/administrator_area');
			
		}
		else
		{
			$this->session->set_flashdata('message','Username dan/atau password Anda salah');
			$this->index();
		}
		
	}
	
	// create users form
	public function signup()
	{
		$data['main_content'] = 'createusers_form';
		$this->load->view('includes/templateslogin', $data);
	}
	
	// create users
	public function create_users()
	{
		$this->load->library('form_validation');
		
		// validate field name, error message, validation rules
		$this->form_validation->set_rules('nama_depan', 'Nama Depan', 'trim|required');
		$this->form_validation->set_rules('nama_belakang', 'Nama Belakang', 'trim|required');
		
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password1', 'Konfirmasi Password', 'trim|required|matches[password]');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->signup();
		}
		else
		{
			$this->load->model('users_model');
			if($query = $this->users_model->create_users())
			{
				$data['main_content'] = 'signup_successful';
				$this->load->view('includes/templateslogin', $data);
			}
			else 
			{
				$this->signup();
			}
		}
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login', 'refresh');
	}
}

// ------------------------------------------------------------------------
// End of Login Class.
// ------------------------------------------------------------------------
/* End of file login.php */
/* Location: ../application/controllers/login.php */
