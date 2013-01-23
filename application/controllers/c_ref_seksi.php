<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * c_ref_seksi.php
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
class C_ref_seksi extends CI_Controller
{
	private $limit = 10;
	/**
	 * Constructor of class C_ref_kementerian.
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
		$this->m_base->initialize('r_seksi');
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
		$seksis = $this->m_base->get_paged_list('r_menteri', $this->limit, $offset)->result();

		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('c_ref_kementerian/');
		$config['total_rows'] = $this->m_base->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No.','Kementerian','Eselon 1','Eselon 2','Satker','Action');
		$i = 0 + $offset;
		foreach ($kementerians as $kementerian)
		{
			$this->table->add_row(++$i.".", $kementerian->kdmenteri."<br />".$kementerian->nmmenteri, $kementerian->kdes1."<br />".$kementerian->nmes1, $kementerian->kdes2."<br />".$kementerian->nmes2, $kementerian->kdsatker."<br />".$kementerian->nmsatker,
								anchor('c_ref_kementerian/view/'.$kementerian->id,'view',array('class'=>'view')).' '.
								anchor('c_ref_kementerian/update/'.$kementerian->id,'update',array('class'=>'update')).' '.
								anchor('c_ref_kementerian/delete/'.$kementerian->id,'delete',array('class'=>'delete','onclick'=>"return confirm('Apakah Anda yakin akan menghapus data ini?')"))
								);
		}
		$data['table'] = $this->table->generate();
		
		// load view
		$data['main_content'] = 'v_kementerian/v_ref_kementerian';
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
		$data['action'] = site_url('c_ref_kementerian/addKementerian');
		$data['link_back'] = anchor('c_ref_kementerian/index/','Kembali ke list kementerian',array('class'=>'back'));
		
		// load view
		$data['main_content'] = 'v_kementerian/kementerianEdit';
		$this->load->view('includes/templates',$data);	
	}
	
	/*------------------------------------------------------------------
	 * addKementerian
	 * ---------------------------------------------------------------*/
	public function addKementerian()
	{
		// set empty default form field values
		$this->_set_fields();
		// set validation rules
		$this->_set_rules();
		
		// set common properties
		$data['title'] = 'Tambah Data Baru';
		$data['action'] = site_url('c_ref_kementerian/addKementerian');
		$data['link_back'] = anchor('c_ref_kementerian/index/','Kembali ke list kementerian', array('class'=>'back'));
		
		// run form validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '';
		}
		else
		{
			// save data with the variable name $input that's will be used in model
			$input = array
						(
							'kdmenteri' => $this->input->post('kdmenteri'),
							'nmmenteri' => $this->input->post('nmmenteri'),
							'kdes1' => $this->input->post('kdes1'),
							'nmes1' => $this->input->post('nmes1'),
							'kdes2' => $this->input->post('kdes2'),
							'nmes2' => $this->input->post('nmes2'),
							'kdsatker' => $this->input->post('kdsatker'),
							'nmsatker' => $this->input->post('nmsatker')
						);
			$id = $this->m_base->save($input);
			
			// set user message if insert successfully
			$data['message'] = '<div class="success">tambah data kementerian berhasil</div>';
		}
		//load view
		$data['main_content'] = 'v_kementerian/kementerianEdit';
		$this->load->view('includes/templates',$data);
	}
	
	/*------------------------------------------------------------------
	 * view
	 * ---------------------------------------------------------------*/
	public function view($id)
	{
		// set common properties
		$data['title'] = 'Detail Data';
		$data['link_back'] = anchor('c_ref_kementerian/index','Kembali ke list kementerian',array('class'=>'back'));
		
		// get kementerian details
		$data['kementerian'] = $this->m_base->get_by_id($id)->row();
		
		// load view
		$data['main_content'] = 'v_kementerian/kementerianView';
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
		$kementerian = $this->m_base->get_by_id($id)->row();
		// prefill form values
		$this->form_data->id = $id;
		$this->form_data->kdmenteri = $kementerian->kdmenteri;
		$this->form_data->nmmenteri = $kementerian->nmmenteri;
		$this->form_data->kdes1 	= $kementerian->kdes1;
		$this->form_data->nmes1 	= $kementerian->nmes1;
		$this->form_data->kdes2 	= $kementerian->kdes2;
		$this->form_data->nmes2 	= $kementerian->nmes2;
		$this->form_data->kdsatker 	= $kementerian->kdsatker;
		$this->form_data->nmsatker 	= $kementerian->nmsatker;
		
		// set common properties
		$data['title'] = 'Update Kementerian';
		$data['message'] = '';
		$data['action'] = site_url('c_ref_kementerian/updateKementerian');
		$data['link_back'] = anchor('c_ref_kementerian/index', 'Kembali ke list kementerian', array('class'=>'back'));
		
		// load view
		$data['main_content'] = 'v_kementerian/kementerianEdit';
		$this->load->view('includes/templates', $data);
	}

	/*------------------------------------------------------------------
	 * update kementerian
	 * ---------------------------------------------------------------*/
	public function updateKementerian()
	{
		// set empty default form field values
		$this->_set_fields();
		// set form_validation properties
		$this->_set_rules();
		
		// set common properties
		$data['title'] = 'Update Kementerian';
		$data['action'] = site_url('c_ref_kementerian/updateKementerian');
		$data['link_back'] = anchor('c_ref_kementerian/index', 'Kembali ke list kementerian', array('class'=>'back'));
		
		// run form_validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '';
		}
		else
		{
			// save data
			$id = $this->input->post('id');
			$kementerian = array
						(
							'kdmenteri' => $this->input->post('kdmenteri'),
							'nmmenteri' => $this->input->post('nmmenteri'),
							'kdes1' => $this->input->post('kdes1'),
							'nmes1' => $this->input->post('nmes1'),
							'kdes2' => $this->input->post('kdes2'),
							'nmes2' => $this->input->post('nmes2'),
							'kdsatker' => $this->input->post('kdsatker'),
							'nmsatker' => $this->input->post('nmsatker')
						);
			$this->m_base->update($id,$kementerian);
			
			// set user message
			$data['message'] = '<div class="success">update kementerian berhasil</div>';
		}
				
		// load view
		$data['main_content'] = 'v_kementerian/kementerianEdit';
		$this->load->view('includes/templates', $data);
	}
	
	/*------------------------------------------------------------------
	 * delete
	 * ---------------------------------------------------------------*/
	public function delete($id)
	{
		// delete office
		$this->m_base->delete($id);
		
		// redirect to office list page
		redirect('c_ref_kementerian/index/', 'refresh');
	}
	
	/*------------------------------------------------------------------
	 * form set empty fields
	 * ---------------------------------------------------------------*/
	public function _set_fields()
	{
		$this->form_data->id = '';
		$this->form_data->kdmenteri = '';
		$this->form_data->nmmenteri = '';
		$this->form_data->kdes1 = '';
		$this->form_data->nmes1 = '';
		$this->form_data->kdes2 = '';
		$this->form_data->nmes2 = '';
		$this->form_data->kdsatker = '';
		$this->form_data->nmsatker = '';
	}
	
	/*------------------------------------------------------------------
	 * form set rules
	 * ---------------------------------------------------------------*/
	public function _set_rules()
	{
		$this->form_validation->set_rules('kdmenteri','Kode Kementerian','trim|required|min_length[3]');
		$this->form_validation->set_rules('nmmenteri','Nama Kementerian','trim|required');
		$this->form_validation->set_rules('kdes1','Kode Eselon 1','trim|required|min_length[2]');
		$this->form_validation->set_rules('nmes1','Nama Eselon 1','trim|required');
		$this->form_validation->set_rules('kdes2','Kode Eselon 2','trim|required|min_length[4]');
		$this->form_validation->set_rules('nmes2','Nama Eselon 2','trim|required');
		$this->form_validation->set_rules('kdsatker','Kode Satker','trim|required');
		$this->form_validation->set_rules('nmsatker','Nama Satker','trim|required');
		
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
// End of C_ref_seksi Controller Class.
// ------------------------------------------------------------------------
/* End of file c_ref_seksi.php */
/* Location: ../application/controllers/c_ref_seksi.php */
