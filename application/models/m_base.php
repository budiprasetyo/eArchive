<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * m_base.php
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


	class M_base extends CI_Model{
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
		
		// initialize table name  -> at the last i found it, thanks Lord Jesus
		public function initialize($table_name = NULL)
		{
			$this->table_name = $table_name;
		}
		
		/**
		 * Getting all fields from table
		 * @access	public
		 * @param	none
		 * @return	$results array
		 */
		public function get_all(){
			$results	= $this->db->get($this->table_name);
			
			if($results->num_rows() > 0){
				return $results;
			}
		}
		
		/**
		 * Getting selected fields
		 * @access	public
		 * @param	string $fields	
		 * @return	selected fields from table
		 */
		public function get_data_fields($fields = '', $where = NULL, $orderby = NULL, $groupby = NULL, $limit = NULL, $offset = NULL)
		{
			$query = $this->db->select($fields);	
			
			if( ! is_null($orderby) )
			{
				$query = $this->db->order_by($orderby);
			}
			
			if( ! is_null($groupby) )
			{
				$query = $this->db->group_by($gropuby);
			}
			
			$query = $this->db->get($this->table_name);
			
			if( ! is_null($where) )
			{
				$query = $this->db->get_where($this->table_name, $where);
			}
			
			return $query;
		}

		 
		// get data with parameter where, limit, offset
		public function get_where($where = NULL, $limit = NULL, $offset = NULL)
		{
			return $this->db->get_where($this->table_name, $where, $limit, $offset);
		}
		
		// get number of table in database
		public function count_all()
		{
			return $this->db->count_all($this->table_name);
		}
		
		// get table with paging
		public function get_paged_list($id,$limit = 10, $offset = 0)
		{
			$query = $this->db->order_by($id,'desc');
			$query = $this->db->get($this->table_name,$limit,$offset);
			return $query;
			
			$query->free_result();
		}
		
		// get table with paging and grouping
		public function get_paged_list_groupby($id,$groupby = NULL, $limit = 10, $offset = 0)
		{
			$query = $this->db->order_by($id,'desc');
			$query = $this->db->group_by($groupby);
			$query = $this->db->get($this->table_name,$limit,$offset);
			return $query;
			
			$query->free_result();
		}
		
		// get data by id
		public function get_by_id($id_name,$id)
		{
			$this->db->where($id_name,$id);
			$query = $this->db->get($this->table_name);
			return $query;
			
			$query->free_result();
		}
		
		// add new data 
		public function save($input)
		{
			$this->db->insert($this->table_name,$input);
			return $this->db->insert_id();
		}
		
		// add new data with procedure
		public function save_with_procedure($input,$procedure_name,$table_altered,$column_type_name)
		{
			$this->db->insert($this->table_name,$input);
			return $this->db->insert_id();
			$this->db->query('CALL '.$procedure_name.'('.$table_altered.','.$column_type_name.')');
		}
		
		// update data by id
		public function update($id_name,$id, $input)
		{
			$this->db->where($id_name,$id);
			$this->db->update($this->table_name,$input);
		}
		
		// update data by id with procedure method
		public function update_with_procedure($id,$input,$procedure_name,$column_type_name)
		{
			$this->db->where('id',$id);
			$this->db->update($this->table_name,$input);
			$this->db->query('CALL '.$procedure_name.'('.$this->table_name.','.$column_type_name.')');
		}
		
		// delete data by id
		public function delete($id_name,$id)
		{
			$this->db->where($id_name,$id);
			$this->db->delete($this->table_name);
		}
		
		// get parents list, exception for table_name's instantiate
		public function get_parent_list($fields,$table_name,$group,$order,$asc,$selected,$id,$field_name)
		{
			$result	= array();
			$this->db->select($fields);
			$this->db->from($table_name);
			$this->db->group_by($group);
			$this->db->order_by($order,$asc);
			$array_keys_values = $this->db->get();
			
			foreach($array_keys_values->result() as $row)
			{
				$result[0] = "$selected";
				$result[$row->$id] = $row->$field_name;
			}
			
			return $result;
		}
		
		// get child list, exception for table_name's instantiate
		public function get_child_list($input_name,$fields,$table_name,$field_where,$group,$order,$asc,$selected,$value,$field_option)
		{
			$id = $this->input->post($input_name);
			$result = array();
			
			$this->db->select($fields);
			$this->db->from($table_name);
			$this->db->where($field_where,$id);
			//$this->db->group_by($group);
			$this->db->order_by($order,$asc);
			$array_keys_values = $this->db->get();
			
			foreach($array_keys_values->result() as $row)
			{
				$result[0] = "$selected";
				$result[$row->$value] = $row->$field_option;
			}
			
			return $result;
		}
	}
// ------------------------------------------------------------------------
// End of M_base Controller Class.
// ------------------------------------------------------------------------
/* End of file m_base.php */
/* Location: ../application/controllers/m_base.php */
	
?>


