<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * m_ref_privilege.php
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
class M_ref_privilege extends M_base 
{
	
	/**
	 * Constructor of class M_ref_privilege.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// constructor
		parent::__construct();
	}

	/**
	 * Select for retrieving parent_id
	 * 
	 * @access	public
	 * @param	none
	 * @return	array
	 */
	public function get_parent_id()
	{
		return $this->db->query('SELECT a.privilege, b.parent_id FROM r_privilege a LEFT JOIN dyn_menu b ON a.id_dyn_menu = b.id GROUP BY parent_id');
	}
	
	/**
	 * Select for showing menu with checked or unchecked
	 * 
	 * @access 	public
	 * @param	none
	 * @return	array
	 */
	public function get_checked_checkbox()
	{
		return $this->db->query('SELECT a.id,a.title,b.id_dyn_menu FROM dyn_menu a LEFT JOIN r_privilege b ON a.id=b.id_dyn_menu WHERE a.parent_id != 0');
	}
	
	/**
	 * Delete privilege
	 * 
	 * @access	public
	 * @param	$id integer
	 * @return	none
	 */
	public function delete_privilege($id)
	{
		$this->initialize('r_privilege');
		$query = $this->get_data_fields('privilege', 'id_r_privilege = '.$id)->row();
		
		$this->db->query('DELETE FROM r_privilege WHERE privilege = "'.$query->privilege.'"');
	}
}
