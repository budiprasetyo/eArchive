<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * m_ref_kantor.php
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


	class M_ref_kantor extends CI_Model{
		// table name
		private $table_name = 'r_office';
		/**
		 * Constructor of class M_ref_kantor.
		 *
		 * @return void
		 */
		public function __construct()
		{
			parent::__construct();
		}
		
		// autocomplete
		public function get_autocomplete($fields='' ,$like='',$table='',$limit=NULL,$offset=NULL,$group=NULL,$order=array('field'=>NULL,'sort'=>'ASC'))
		{
			$this->db->select($fields);
			$this->db->like($like, $this->input->post('queryString'),'both');
			
			if(!is_null($group))
			{
				$this->db->group_by($group);
			}
			
			if(!is_null($order['field']))
			{
				$this->db->order_by($order['field'],$order['sort']);
			}
			
			return $this->db->get($table,$limit,$offset);
		}
	}
// ------------------------------------------------------------------------
// End of M_ref_kantor Controller Class.
// ------------------------------------------------------------------------
/* End of file m_ref_kantor.php */
/* Location: ../application/controllers/m_ref_kantor.php */
	
?>


