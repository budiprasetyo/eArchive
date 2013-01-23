<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * m_autocomplete.php
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
	class M_autocomplete extends CI_Model{
		// table name
		private $table_name = NULL;
		/**
		 * Constructor of class M_base.
		 *
		 * @return void
		 */
		public function __construct()
		{
			parent::__construct();
		}
		
		// searching function
		public function search($keyword,$field,$table)
		{
			$this->db->select($field)->from($table);
			$this->db->like($field,$keyword);
			$query = $this->db->get();
			
			return $query->result();
		}
	}
// ------------------------------------------------------------------------
// End of M_autocomplete Controller Class.
// ------------------------------------------------------------------------
/* End of file m_autocomplete.php */
/* Location: ../application/controllers/m_autocomplete.php */
	
?>


