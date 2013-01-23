<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 *      site.php
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
 *
 *----------------------------------------------------------------------
 * 
 *  This class for containing form from all menus
 * 
 * -------------------------------------------------------------------*/

	class Site extends CI_Controller{
		
		function __construct()
		{
			parent::__construct();
			$this->is_logged_in();
		}
		
		function administrator_area()
		{
			$this->load->view('administrator_area');
		}
		
		function is_logged_in()
		{
			$is_logged_in = $this->session->userdata('is_logged_in');
			
			if(!isset($is_logged_in) || $is_logged_in != TRUE)
			{
				redirect('login/');
			}
		}
	}
// ------------------------------------------------------------------------
// End of Site Class.
// ------------------------------------------------------------------------
/* End of file site.php */
/* Location: ../application/controllers/site.php */
