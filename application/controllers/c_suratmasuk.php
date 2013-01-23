<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * c_suratmasuk.php
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
class C_suratmasuk extends CI_Controller
{
	private $limit = 10;
	/**
	 * Constructor of class C_agd_suratmasuk.
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
		$this->m_base->initialize('suratmasuk_data');
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
		$suratmasuks = $this->m_base->get_paged_list('id_suratmasuk_data', $this->limit, $offset)->result();

		// generate pagination
		$this->load->library('pagination');
		$config['base_url'] = site_url('c_suratmasuk/');
		$config['total_rows'] = $this->m_base->count_all();
		$config['per_page'] = $this->limit;
		$config['uri_segment'] = $uri_segment;
		$this->pagination->initialize($config);
		
		$data['pagination'] = $this->pagination->create_links();
		
		// load datetime helper
		$this->load->helper('datetime');
		// generate table data
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('No.','Nomor & Tgl.Surat','Pengirim','Perihal','File',array('data'=>'Action','style'=>'text-align:center;'));
		$i = 0 + $offset;
		foreach ($suratmasuks as $suratmasuk)
		{
			$this->table->add_row(++$i.".", $suratmasuk->nosurat."<br />".date_convert($suratmasuk->tglsurat), $suratmasuk->pengirim, $suratmasuk->perihal, anchor(base_url().'surat_masuk/'.$suratmasuk->file,$suratmasuk->file,array('target' => '_blank')),
								anchor('c_suratmasuk/view/'.$suratmasuk->id_suratmasuk_data,'view',array('class'=>'view')).' '.
								anchor('c_suratmasuk/update/'.$suratmasuk->id_suratmasuk_data,'update',array('class'=>'update')).' '.
								anchor('c_suratmasuk/delete/'.$suratmasuk->id_suratmasuk_data,'delete',array('class'=>'delete','onclick'=>"return confirm('Apakah Anda yakin akan menghapus data ini?')"))
								);
		}
		$data['table'] = $this->table->generate();
		
		// load view
		$data['main_content'] = 'v_suratmasuk/v_suratmasuk';
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
		$data['action'] = site_url('c_suratmasuk/addSuratmasuk');
		$data['link_back'] = anchor('c_suratmasuk/index/','Kembali ke list surat masuk',array('class'=>'back'));
		
		// load view
		$data['main_content'] = 'v_suratmasuk/suratmasukEdit';
		$this->load->view('includes/templates',$data);	
	}
	
	/*------------------------------------------------------------------
	 * addSuratmasuk
	 * ---------------------------------------------------------------*/
	public function addSuratmasuk()
	{
		// set empty default form field values
		$this->_set_fields();
		// set validation rules
		$this->_set_rules();	
		
		// run form validation
		if ($this->form_validation->run() == FALSE)
		{
			// set common properties
			$data['title'] = 'Tambah Data Baru';
			$data['action'] = site_url('c_suratmasuk/addSuratmasuk');
			$data['link_back'] = anchor('c_suratmasuk/index/','Kembali ke list surat masuk', array('class'=>'back'));	
			$data['message'] = '<div class="failed">tambah data surat masuk gagal</div>';
		}
		else
		{

			// check whether post is send from submit button
			if(isset($_POST['submit']))
			{
				// Upload section
				$config['upload_path'] = './surat_masuk';
				$config['allowed_types'] = 'pdf|gif|jpg|jpeg|png';
				$config['max_size'] = '0';
				$config['max_width'] = '0';
				$config['max_height'] = '0';
				// Load the upload library
				$this->load->library('upload',$config);	
				
				// scan docs
				$shell = shell_exec('scanimage -d genesys:libusb:002:004 --format TIFF --brightness 100% --resolution 300 --mode Color -x 180 -y 225 > /var/www/eOffice/surat_masuk/scantest.tiff');
				//~ $shell = shell_exec("scanimage --test -d 'genesys:libusb:002:004'");
				//~ shell_exec('mysqldump -uroot -P3306 -pM3t@m0rph eoffice > /var/www/eOffice/surat_masuk/office.sql');
				//~ $shell = shell_exec('scanimage --list-devices');
				echo "<br /><br /><br /><pre>".$shell."</pre>";
				
				// Handle the file upload from the name of input type='file'
				if( ! $this->upload->do_upload('file'))
				{

					$data['message'] = '<div class="failed">'.$this->upload->display_errors().'</div>';
				}
				else
				{
					
					// File name
					$nama_file = $_FILES['file']['name'];
					$this->load->helper('datetime');
					
					// save data with the variable name $input that's will be used in model
					$input = array
								(
									'nosurat' => $this->input->post('nosurat'),
									'tglsurat' => date_convert($this->input->post('tglsurat')),
									'pengirim' => $this->input->post('pengirim'),
									'tujuan' => $this->input->post('tujuan'),
									'perihal' => $this->input->post('perihal'),
									'jenissurat' => $this->input->post('jenissurat'),
									'sifatsurat' => $this->input->post('sifatsurat'),
									'file' => $nama_file
								);
					$id = $this->m_base->save($input);
					// Upload the file
					$data = $this->upload->data();
					// set user message if insert successfully
					$data['message'] = '<div class="success">tambah data suratmasuk berhasil</div>';
					
					// set common properties
					$data['title'] = 'Tambah Data Baru';
					$data['action'] = site_url('c_suratmasuk/addSuratmasuk');
					$data['link_back'] = anchor('c_suratmasuk/index/','Kembali ke list surat masuk', array('class'=>'back'));
					
				}
			}
		}
		//load view
		$data['main_content'] = 'v_suratmasuk/suratmasukEdit';
		$this->load->view('includes/templates',$data);
	}
	
	/*------------------------------------------------------------------
	 * view
	 * ---------------------------------------------------------------*/
	public function view($id)
	{
		// set common properties
		$data['title'] = 'Detail Data';
		$data['link_back'] = anchor('c_suratmasuk/index','Kembali ke list suratmasuk',array('class'=>'back'));
		
		// get suratmasuk details
		$data['suratmasuk'] = $this->m_base->get_by_id('id_suratmasuk_data',$id)->row();
		
		// load view
		$data['main_content'] = 'v_suratmasuk/suratmasukView';
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
		$suratmasuk = $this->m_base->get_by_id('id_suratmasuk_data',$id)->row();
		// prefill form values
		$this->form_data->id_suratmasuk_data = $id;
		$this->form_data->nosurat	= $suratmasuk->nosurat;
		$this->form_data->tglsurat	= $suratmasuk->tglsurat;
		$this->form_data->pengirim 	= $suratmasuk->pengirim;
		$this->form_data->tujuan 	= $suratmasuk->tujuan;
		$this->form_data->perihal 	= $suratmasuk->perihal;
		$this->form_data->jenissurat= $suratmasuk->jenissurat;
		$this->form_data->sifatsurat= $suratmasuk->sifatsurat;
		$this->form_data->file 		= $suratmasuk->file;
		
		// set common properties
		$data['title'] = 'Update Surat Masuk';
		$data['message'] = '';
		$data['action'] = site_url('c_suratmasuk/updateSuratmasuk');
		$data['link_back'] = anchor('c_suratmasuk/index', 'Kembali ke list suratmasuk', array('class'=>'back'));
		
		// load view
		$data['main_content'] = 'v_suratmasuk/suratmasukEdit';
		$this->load->view('includes/templates', $data);
	}

	/*------------------------------------------------------------------
	 * update suratmasuk
	 * ---------------------------------------------------------------*/
	public function updateSuratmasuk()
	{
		// set empty default form field values
		$this->_set_fields();
		// set form_validation properties
		$this->_set_rules();
		
		// set common properties
		$data['title'] = 'Update Surat Masuk';
		$data['action'] = site_url('c_suratmasuk/updateSuratmasuk');
		$data['link_back'] = anchor('c_suratmasuk/index', 'Kembali ke list suratmasuk', array('class'=>'back'));
		
		// run form_validation
		if ($this->form_validation->run() == FALSE)
		{
			$data['message'] = '';
		}
		else
		{
			// save data
			$id = $this->input->post('id');
			$suratmasuk = array
						(
							'nosurat' => $this->input->post('nosurat'),
							'tglsurat' => $this->input->post('tglsurat'),
							'pengirim' => $this->input->post('pengirim'),
							'tujuan' => $this->input->post('tujuan'),
							'perihal' => $this->input->post('perihal'),
							'jenissurat' => $this->input->post('jenissurat'),
							'sifatsurat' => $this->input->post('sifatsurat'),
							'file' => $this->input->post('file')
						);
			$this->m_base->update('id_suratmasuk_data',$id,$suratmasuk);
			
			// set user message
			$data['message'] = '<div class="success">update suratmasuk berhasil</div>';
		}
				
		// load view
		$data['main_content'] = 'suratmasukEdit';
		$this->load->view('includes/templates', $data);
	}
	
	/*------------------------------------------------------------------
	 * delete
	 * ---------------------------------------------------------------*/
	public function delete($id)
	{		
		// retrieve surat masuk name of file
		$row = $this->m_base->get_data_fields('file','id_suratmasuk_data = "'.$id.'"')->row();
		
		$file = $row->file;
		
		// check if file exists
		if(file_exists(dirname(dirname(dirname(__FILE__))).'/surat_masuk/'.$file))
		{
			// delete file surat masuk
			unlink(dirname(dirname(dirname(__FILE__))).'/surat_masuk/'.$file);
		}
		// delete surat masuk
		$this->m_base->delete('id_suratmasuk_data',$id);

		// redirect to surat masuk list page
		redirect('c_suratmasuk/index/', 'refresh');
	}
	
	/*------------------------------------------------------------------
	 * form set empty fields
	 * ---------------------------------------------------------------*/
	public function _set_fields()
	{
		$this->form_data->id_suratmasuk_data = '';
		$this->form_data->nosurat = '';
		$this->form_data->tglsurat = '';
		$this->form_data->pengirim = '';
		$this->form_data->tujuan = '';
		$this->form_data->perihal = '';
		$this->form_data->jenissurat = '';
		$this->form_data->sifatsurat = '';
		$this->form_data->file = '';
	}
	
	/*------------------------------------------------------------------
	 * form set rules
	 * ---------------------------------------------------------------*/
	public function _set_rules()
	{
		$this->form_validation->set_rules('nosurat','Nomor Surat','trim|required');
		$this->form_validation->set_rules('tglsurat','Tanggal Surat','trim|required');
		$this->form_validation->set_rules('pengirim','Pengirim','trim|required');
		$this->form_validation->set_rules('tujuan','Tujuan','trim|required');
		$this->form_validation->set_rules('perihal','Perihal','trim|required');
		$this->form_validation->set_rules('jenissurat','Jenis Surat','trim|required');
		$this->form_validation->set_rules('sifatsurat','Sifat Surat','trim|required');
		$this->form_validation->set_rules('file','File','trim');
		
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
// End of C_suratmasuk Controller Class.
// ------------------------------------------------------------------------
/* End of file c_suratmasuk.php */
/* Location: ../application/controllers/c_suratmasuk.php */
