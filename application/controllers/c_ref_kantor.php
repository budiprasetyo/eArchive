<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * c_ref_kantor.php
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
class C_ref_kantor extends CI_Controller
{
	// num of records per page
	private $limit = 10;
	
	/**
	 * Constructor of class Referensi.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		// load library
		$this->load->library(array('table','form_validation'));
		// load model
		$this->load->model('m_base','',TRUE);
		// initialize table
		$this->m_base->initialize('r_office');
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
		$offset = ( ! is_numeric($offset) || $offset < 1 ) ? 0 : $offset; 
		
		// load data
		$offices = $this->m_base->get_paged_list('id',$this->limit, $offset)->result(); 
		
		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('c_ref_kantor/index/');
		$config['total_rows'] = $this->m_base->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		
		$data['pagination'] = $this->pagination->create_links();
		
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No','Kementerian','Eselon I','Eselon II','Satker','Alamat','Kode Pos','No.Telp','E-mail','Action');
		$i = 0 + $offset;
		foreach ($offices as $office)
		{
			$this->table->add_row(++$i.".", $office->kdmenteri, $office->kdes1, $office->kdes2, $office->kdsatker, $office->alamat, $office->kodepos, $office->telp, $office->email,
								anchor('c_ref_kantor/view/'.$office->id,'view',array('class'=>'view')).' '.
								anchor('c_ref_kantor/update/'.$office->id,'update',array('class'=>'update')).' '.
								anchor('c_ref_kantor/delete/'.$office->id,'delete',array('class'=>'delete','onclick'=>"return confirm('Apakah Anda yakin akan menghapus data ini?')"))
								);
		}
		$data['table'] = $this->table->generate();
		
		// load view
		$data['main_content'] = 'v_kantor/v_ref_kantor';
		$this->load->view('includes/templates', $data);
	}
	
	/*------------------------------------------------------------------
	 * add
	 * ---------------------------------------------------------------*/
	public function add()
	{
		// set empty default form field values
		$this->_set_fields();  
		// set validation properties
		$this->_set_rules(); 
		
		// set common properties
		$data['title'] = 'Tambah Data Baru';
		$data['message'] = '';
		$data['action'] = site_url('c_ref_kantor/addOffice');
		$data['link_back'] = anchor('c_ref_kantor/index/','Kembali ke list kantor', array('class'=>'back'));
		
		// load view
		$data['main_content'] = 'v_kantor/officeEdit';
		$this->load->view('includes/templates',$data);
	}
	 
	/*------------------------------------------------------------------
	 * addOffice
	 * ---------------------------------------------------------------*/
	public function addOffice()
	{
		// set common properties
		$data['title'] = 'Tambah Data Baru';
		$data['action'] = site_url('c_ref_kantor/addOffice');
		$data['link_back'] = anchor('c_ref_kantor/index','Kembali ke list kantor', array('class'=>'back'));
		
		// set empty default form field values
		$this->_set_fields();
		// set validation properties
		$this->_set_rules();
		
		// run form_validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '';
		}
		else
		{
			// save data
			$input = array
						(
						'kdmenteri' => $this->input->post('kdmenteri'),
						'kdes1' => $this->input->post('kdes1'),
						'kdes2' => $this->input->post('kdes1').$this->input->post('kdes2'),
						'kdsatker' => $this->input->post('kdsatker'),
						'alamat' => $this->input->post('alamat'),
						'kodepos' => $this->input->post('kodepos'),
						'telp' => $this->input->post('telp'),
						'fax' => $this->input->post('fax'),
						'email' => $this->input->post('email'),
						'website' => $this->input->post('website'),
						'smsgateway' => $this->input->post('smsgateway')
						);			
			// save data from input form
			$id = $this->m_base->save($input);
			
			// set user message
			$data['message'] = '<div class="success">tambah data kantor berhasil</div>';
		}
		// load view
		$data['main_content'] = 'v_kantor/officeEdit';
		$this->load->view('includes/templates', $data);
	}
	
	/*------------------------------------------------------------------
	 * view
	 * ---------------------------------------------------------------*/
	function view($id)
	{
		// set common properties
		$data['title'] = 'Detail Data';
		$data['link_back'] = anchor('c_ref_kantor/index','Kembali ke list kantor',array('class'=>'back'));
		
		// get office details
		$data['office'] = $this->m_base->get_by_id('id',$id)->row();
		
		//load view
		$data['main_content'] = 'v_kantor/officeView';
		$this->load->view('includes/templates',$data);
	}
	
	/*------------------------------------------------------------------
	 * update
	 * ---------------------------------------------------------------*/
	function update($id)
	{
		// set form_validation properties
		$this->_set_fields();
		
		// call the query
		$office = $this->m_base->get_by_id('id',$id)->row();
		// prefill form values
		$this->form_data->id 		= $id;
		$this->form_data->kdmenteri = $office->kdmenteri;
		$this->form_data->kdes1 	= $office->kdes1;
		$this->form_data->kdes2 	= substr($office->kdes2,2,2);
		$this->form_data->kdsatker 	= $office->kdsatker;
		$this->form_data->alamat 	= $office->alamat;
		$this->form_data->kodepos 	= $office->kodepos;
		$this->form_data->telp 		= $office->telp;
		$this->form_data->fax 		= $office->fax;
		$this->form_data->email	 	= $office->email;
		$this->form_data->website 	= $office->website;
		$this->form_data->smsgateway = $office->smsgateway;
		
		// set common properties
		$data['title'] = 'Update Kantor';
		$data['message'] = '';
		$data['action'] = site_url('c_ref_kantor/updateOffice');
		$data['link_back'] = anchor('c_ref_kantor/index', 'Kembali ke list kantor', array('class'=>'back'));
		
		// load view
		$data['main_content'] = 'v_kantor/officeEdit';
		$this->load->view('includes/templates', $data);
	}
	
	/*------------------------------------------------------------------
	 * update office
	 * ---------------------------------------------------------------*/
	public function updateOffice()
	{
		// set common properties
		$data['title'] = 'Update Kantor';
		$data['action'] = site_url('c_ref_kantor/updateOffice');
		$data['link_back'] = anchor('c_ref_kantor/index', 'Kembali ke list kantor', array('class'=>'back'));
		
		// set empty default form field values
		$this->_set_fields();
		// set form_validation properties
		$this->_set_rules();
		
		// run form_validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '';
		}
		else
		{
			// save data
			$id = $this->input->post('id');
			$office = array
						(
							'kdmenteri' => $this->input->post('kdmenteri'),
							'kdes1' => $this->input->post('kdes1'),
							'kdes2' => $this->input->post('kdes1').$this->input->post('kdes2'),
							'kdsatker' => $this->input->post('kdsatker'),
							'alamat' => $this->input->post('alamat'),
							'kodepos' => $this->input->post('kodepos'),
							'telp' => $this->input->post('telp'),
							'fax' => $this->input->post('fax'),
							'email' => $this->input->post('email'),
							'website' => $this->input->post('website'),
							'smsgateway' => $this->input->post('smsgateway')
						);
			$this->m_base->update('id',$id,$office);
			
			// set user message
			$data['message'] = '<div class="success">update kantor berhasil</div>';
		}
		
		// load view
		$data['main_content'] = 'v_kantor/officeEdit';
		$this->load->view('includes/templates', $data);
	}
	
	/*------------------------------------------------------------------
	 * delete
	 * ---------------------------------------------------------------*/
	public function delete($id)
	{
		// delete office
		$this->m_base->delete('id',$id);
		
		// redirect to office list page
		redirect('c_ref_kantor/index/', 'refresh');
	}
	
	/*------------------------------------------------------------------
	 * form_validation fields
	 * ---------------------------------------------------------------*/
	public function _set_fields()
	{
		$this->form_data->id = '';
		$this->form_data->kdmenteri = '';
		$this->form_data->kdes1 = '';
		$this->form_data->kdes2 = '';
		$this->form_data->kdsatker = '';
		$this->form_data->alamat = '';
		$this->form_data->kodepos = '';
		$this->form_data->telp = '';
		$this->form_data->fax = '';
		$this->form_data->email = '';
		$this->form_data->website = '';
		$this->form_data->smsgateway = '';
	}
	
	/*------------------------------------------------------------------
	 * form_validation rules
	 * ---------------------------------------------------------------*/
	public function _set_rules()
	{
		$this->form_validation->set_rules('kdmenteri','Kode Kementerian','trim|required|min_length[3]');
		$this->form_validation->set_rules('kdes1','Kode Eselon I','trim|required|min_length[2]');
		$this->form_validation->set_rules('kdes2','Kode Eselon II','trim|required|min_length[2]');
		$this->form_validation->set_rules('kdsatker','Kode Satker','trim|required|min_length[6]');
		$this->form_validation->set_rules('alamat','Alamat','trim|required');
		$this->form_validation->set_rules('kodepos','Kode Pos','trim|required|min_length[5]');
		$this->form_validation->set_rules('telp','No.Telepon','trim|required');
		$this->form_validation->set_rules('fax','No.Fax','trim');
		$this->form_validation->set_rules('email','E-mail','trim|valid_email');
		$this->form_validation->set_rules('website','Website','trim');
		$this->form_validation->set_rules('smsgateway','No.SMS Gateway','trim');
		
		$this->form_validation->set_message('required','* wajib diisi');
		$this->form_validation->set_message('isset','* wajib diisi');
		$this->form_validation->set_error_delimiters('<p class="error">','</p>');
	}
	
	/*------------------------------------------------------------------
	 * autocomplete
	 * ---------------------------------------------------------------*/
	public function autocomplete_kementerian()
	{
		$this->load->model('m_ref_kantor','get_data');
		$query = $this->get_data->get_autocomplete('kdmenteri,nmmenteri','kdmenteri','r_menteri','10',NULL,'kdmenteri',array('field'=>NULL,'sort'=>''));
		foreach($query->result() as $row)
		{
			echo "<li title='" . $row->kdmenteri . "'>".$row->kdmenteri." - ".$row->nmmenteri."</li>";
		}
	}
	
	public function autocomplete_eselon1()
	{
		$this->load->model('m_ref_kantor','get_data');
		$query = $this->get_data->get_autocomplete('kdmenteri,kdes1,nmes1','kdes1','r_menteri','10',NULL,'kdmenteri,kdes1',array('field'=>NULL,'sort'=>''));
		foreach($query->result() as $row)
		{
			echo "<li title='" . $row->kdes1 . "'>".$row->kdmenteri."-".$row->kdes1."-".$row->nmes1."</li>";
		}
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
// End of C_ref_kantor Controller Class.
// ------------------------------------------------------------------------
/* End of file c_ref_kantor.php */
/* Location: ../application/controllers/c_ref_kantor.php */
