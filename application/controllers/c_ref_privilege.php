<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * c_ref_privilege.php
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
class C_ref_privilege extends CI_Controller
{
	private $limit = 10;
	/**
	 * Constructor of class C_ref_privilege.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// constructor
		parent::__construct();
		// load library
		$this->load->library(array('table','form_validation'));
		// load model
		$this->load->model('m_base','', TRUE);
		// initialize table
		$this->m_base->initialize('r_privilege');
		// log in checking
		$is_logged_in = $this->session->userdata('is_logged_in');
			
		if(!isset($is_logged_in) || $is_logged_in != TRUE)
		{
			redirect('login/');
		}
	}

	/*------------------------------------------------------------------
	 * index page
	 *----------------------------------------------------------------*/
	public function index($offset = 0)
	{		
		// offset
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);

		// load data
		$privileges = $this->m_base->get_paged_list_groupby('id_r_privilege','privilege',$this->limit, $offset)->result();

		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('c_ref_privilege/index/');
		$config['total_rows'] = $this->m_base->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No.','Privilege','Action');
		$i = 0 + $offset;
		
		foreach ($privileges as $privilege)
		{
			$this->table->add_row(++$i.".", $privilege->privilege, 
								anchor('c_ref_privilege/view/'.$privilege->id_r_privilege,'view',array('class'=>'view')).' '.
								anchor('c_ref_privilege/update/'.$privilege->id_r_privilege,'update',array('class'=>'update')).' '.
								anchor('c_ref_privilege/delete/'.$privilege->id_r_privilege,'delete',array('class'=>'delete','onclick'=>"return confirm('Apakah Anda yakin akan menghapus data ini?')"))
								);
		}
		$data['table'] = $this->table->generate();
		
		// load view
		$data['main_content'] = 'v_privilege/v_ref_privilege';
		$this->load->view('includes/templates',$data);
	}
		
	/*------------------------------------------------------------------
	 * add
	 * ---------------------------------------------------------------*/
	public function add()
	{
		// set empty default form field values
		$this->_set_fields();
		// set validation rules
		$this->_set_rules();
		
		// set common properties
		$data['title'] = 'Tambah Data Baru';
		$data['message'] = '';
		$data['action'] = site_url('c_ref_privilege/addPrivilege');
		$data['link_back'] = anchor('c_ref_privilege/index/','Kembali ke list privilege',array('class'=>'back'));

		// set menus checkbox fields for inserting into r_privilege table	
		$this->m_base->initialize('dyn_menu');
		$data['menus'] = $this->m_base->get_data_fields('id,title,parent_id','parent_id != 0')->result();
		
		
		// load view
		$data['main_content'] = 'v_privilege/privilegeEdit';
		$this->load->view('includes/templates',$data);	
	}
	
	/*------------------------------------------------------------------
	 * addprivilege
	 * ---------------------------------------------------------------*/
	public function addPrivilege()
	{
		// set empty default form field values
		$this->_set_fields();
		// set validation rules
		$this->_set_rules();
		
		// set common properties
		$data['title'] = 'Tambah Data Baru';
		$data['message'] = '';
		$data['action'] = site_url('c_ref_privilege/addPrivilege');
		$data['link_back'] = anchor('c_ref_privilege/index/','Kembali ke list privilege', array('class'=>'back'));
		
		// set menus checkbox fields for inserting into r_privilege table	
		$this->m_base->initialize('dyn_menu');
		$data['menus'] = $this->m_base->get_data_fields('id,title,parent_id','parent_id != 0')->result();
		
		// run form validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '<div class="failed">tambah data privilege gagal</div>';
		}
		else
		{
			$id_dyn_menu = $this->input->post('id_dyn_menu');
			if( is_array($this->input->post('id_dyn_menu')) && count($this->input->post('id_dyn_menu')) >= 1 )
			{
				for($i = 0;$i < count($this->input->post('id_dyn_menu'));$i++)
				{
					$input = array(	'privilege' => $this->input->post('privilege'),
									'id_dyn_menu' => $id_dyn_menu[$i]
								);
								
					// initialize to table r_privilege 
					$this->m_base->initialize('r_privilege');
					$this->m_base->save($input);
				}

				// set user message if insert successfully
				$data['message'] = '<div class="success">tambah data privilege berhasil</div>';
				
				// process to insert parent id to r_privilege
				// 1. select child id from r_privilege to retrieve parent_id
				// 2. insert parent_id into r_privilege
				$this->load->model('m_ref_privilege','',TRUE);
				$parents = $this->m_ref_privilege->get_parent_id();
				foreach($parents->result() as $parent)
				{
					$input = array(	'privilege' 	=> $parent->privilege,
									'id_dyn_menu' 	=> $parent->parent_id
									);
					$this->m_base->save($input);
				}
				
			}
		}
		//load view
		$data['main_content'] = 'v_privilege/privilegeEdit';
		$this->load->view('includes/templates',$data);
	}
	
	/*------------------------------------------------------------------
	 * view
	 * ---------------------------------------------------------------*/
	public function view($id)
	{
		// set common properties
		$data['title'] = 'Detail Data';
		$data['link_back'] = anchor('c_ref_privilege/index','Kembali ke list privilege',array('class'=>'back'));
		
		// get privilege details
		$data['privilege'] = $this->m_base->get_by_id('id',$id)->row();
		
		// load view
		$data['main_content'] = 'v_privilege/privilegeView';
		$this->load->view('includes/templates',$data);
	}
	
	/*------------------------------------------------------------------
	 * update
	 * ---------------------------------------------------------------*/
	public function update($id)
	{
		// set empty default form field values
		$this->_set_fields();
		
		// call the query
		$privilege = $this->m_base->get_by_id('id_r_privilege',$id)->row();
		// prefill form values
		$this->form_data->id 			= $id;
		$this->form_data->privilege 	= $privilege->privilege;
		
		// set common properties
		$data['title'] = 'Update privilege';
		$data['message'] = '';
		$data['action'] = site_url('c_ref_privilege/updatePrivilege');
		$data['link_back'] = anchor('c_ref_privilege/index', 'Kembali ke list privilege', array('class'=>'back'));
		
		// select checked checkbox from r_privilege
		// two things below will be done at update privilege method
		// 1. delete privilege	
		// 2. insert new role
		$this->load->model('m_ref_privilege');
		$data['menus'] = $this->m_ref_privilege->get_checked_checkbox()->result();
		
		// load view
		$data['main_content'] = 'v_privilege/privilegeEdit';
		$this->load->view('includes/templates', $data);
	}

	/*------------------------------------------------------------------
	 * update privilege
	 * ---------------------------------------------------------------*/
	public function updatePrivilege()
	{
		// set empty default form field values
		$this->_set_fields();
		// set form_validation properties
		$this->_set_rules();
		
		// set common properties
		$data['title'] = 'Update privilege';
		$data['action'] = site_url('c_ref_privilege/updatePrivilege');
		$data['link_back'] = anchor('c_ref_privilege/index', 'Kembali ke list privilege', array('class'=>'back'));
		
		// run form_validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '<div class="failed">tambah data privilege gagal</div>';
		}
		else
		{
			// delete data
			$id 			= $this->input->post('id');
			$id_dyn_menu 	= $this->input->post('id_dyn_menu');
			// load model
			$this->load->model('m_ref_privilege');
			// 1. delete privilege	
			// 2. insert new role
			$this->m_ref_privilege->delete_privilege($id);
			
			if( is_array($this->input->post('id_dyn_menu')) && count($this->input->post('id_dyn_menu')) >= 1 )
			{
				for($i = 0;$i < count($this->input->post('id_dyn_menu'));$i++)
				{
					$input = array(	'privilege' => $this->input->post('privilege'),
									'id_dyn_menu' => $id_dyn_menu[$i]
								);
								
					// initialize to table r_privilege 
					$this->m_base->initialize('r_privilege');
					$this->m_base->save($input);
				}

				// set user message if insert successfully
				$data['message'] = '<div class="success">tambah data privilege berhasil</div>';
				
				// process to insert parent id to r_privilege
				// 1. select child id from r_privilege to retrieve parent_id
				// 2. insert parent_id into r_privilege
				$this->load->model('m_ref_privilege','',TRUE);
				$parents = $this->m_ref_privilege->get_parent_id();
				foreach($parents->result() as $parent)
				{
					$input = array(	'privilege' 	=> $parent->privilege,
									'id_dyn_menu' 	=> $parent->parent_id
									);
					$this->m_base->save($input);
				}
				
			}
		}
		// select checked checkbox from r_privilege
		$this->load->model('m_ref_privilege');
		$data['menus'] = $this->m_ref_privilege->get_checked_checkbox()->result();
				
		// load view
		$data['main_content'] = 'v_privilege/privilegeEdit';
		$this->load->view('includes/templates', $data);
	}
	
	/*------------------------------------------------------------------
	 * delete
	 * ---------------------------------------------------------------*/
	public function delete($id)
	{
		// delete privilege
		$this->load->model('m_ref_privilege');
		$this->m_ref_privilege->delete_privilege($id);
		
		// redirect to office list page
		redirect('c_ref_privilege/index/', 'refresh');
	}
	
	/*------------------------------------------------------------------
	 * form set fields 
	 * ---------------------------------------------------------------*/
	public function _set_fields()
	{
		// prefill
		$this->form_data->id = '';
		$this->form_data->privilege = '';

	}
	
	
	/*------------------------------------------------------------------
	 * form set rules
	 * ---------------------------------------------------------------*/
	public function _set_rules()
	{
		$this->form_validation->set_rules('privilege','Privilege','trim|required|min_length[3]|max_length[30]');
		
		$this->form_validation->set_message('required','* wajib diisi');
		$this->form_validation->set_message('isset','* wajib diisi');
		$this->form_validation->set_error_delimiters('<p class="error">','</p>');
	}
	
	/*------------------------------------------------------------------
	 * valid date
	 * ---------------------------------------------------------------*/
	public function valid_date($str)
	{
		// match the format of the date
		if (preg_match ("/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/",$str,$parts))
		{
			// check whether the date is valid or not
			if(checkdate($parts[2],$parts[1],$parts[3]))
				return true;
			else
				return true;
		}
		else
			return false;
	}	
}

// ------------------------------------------------------------------------
// End of C_ref_privilege Controller Class.
// ------------------------------------------------------------------------
/* End of file c_ref_privilege.php */
/* Location: ../application/controllers/c_ref_privilege.php */
