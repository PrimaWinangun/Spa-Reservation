<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * PT Gapura Angkasa
	 * Warehouse Management System.
	 * ver 3.0
	 * 
	 * App id : 
	 * App code : wmsdps
	 *
	 * payment controller
	 *
	 * url : http://dom.wms.dps.gapura.co.id/
	 * design : SIGAP Team
	 * project head : mantara@gapura.co.id
	 *
	 * developer : panca dharma wisesa (pandhawa digital)
	 * phone : 0361 853 2400
	 * email : pandhawa.digital@gmail.com
	 *
	 * copyright by panca dharma wisesa (pandhawa digital)
	 * Do not copy, modified, share or sell this script 
	 * without any permission from developer
	 */
	 
	function __construct()
	{
        parent::__construct();
		
		/*if ( ! $this->session->userdata('logged_in'))
    	{ 
        	# function allowed for access without login
			$allowed = array('');
        
			# other function need login
			if (! in_array($this->router->method, $allowed)) 
			{
    			redirect('login');
			}
   		 }*/
	} 
	
	public function index()
	{
		$this->new_room_cat();
	}
	
	## ------------- ##
	## ROOM CATEGORY ##
	## ------------- ##
	
	public function new_room_cat()
	{		
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'setting', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'setting';
		$page['sidebar_list_room_cat'] = 'on';
		
		# Load Model connect to database
		$this->load->model('reservation_model');
		
		# Get data from db
		$data['room_cat'] = $this->reservation_model->get_data_room_cat();
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('setting/add_new_room_cat', $data);
		$this->load->view('template/footer');
	}
	
	public function insert_room_cat()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'setting', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('setting_model');
		
		# Retrieve data user
		$userdata = $this->session->userdata('log_data');
		
		# Ambil data dari form di tampilan
		$data = array(
				'cat_code' => $this->input->post('room_code'),
				'cat_name' => $this->input->post('room_cat'),
				'cat_update_by' => $userdata['username'],
		);
		
		# Masukkan data ke database melalui model
		$this->setting_model->insert_room_cat($data);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_room_cat/');
	}
	
	## -------------------- ##
	## END OF ROOM CATEGORY ##
	## -------------------- ##
	
	## ---- ##
	## ROOM ##
	## ---- ##
	public function new_room()
	{		
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'setting', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'setting';
		$page['sidebar_list_room'] = 'on';
		
		# Load Model connect to database
		$this->load->model('setting_model');
		
		# Get data from db
		$data['room_cat'] = $this->setting_model->get_data_room_cat();
		$data['room'] = $this->setting_model->get_data_room();
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('setting/add_new_room', $data);
		$this->load->view('template/footer');
	}
	
	public function insert_room()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'setting', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('setting_model');
		
		# Retrieve data user
		$userdata = $this->session->userdata('log_data');
		
		# Ambil data dari form di tampilan
		$data = array(
				'room_name' => $this->input->post('room'),
				'room_category' => $this->input->post('room_cat'),
				'room_update_by' => $userdata['username'],
		);
		
		# Masukkan data ke database melalui model
		$this->setting_model->insert_room($data);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_room/');
	}
	
	## ----------- ##
	## END OF ROOM ##
	## ----------- ##
	
	## --------- ##
	## THERAPIST ##
	## --------- ##
	
	public function new_therapist()
	{		
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'setting', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'setting';
		$page['sidebar_list_therapist'] = 'on';
		
		# Load Model connect to database
		$this->load->model('setting_model');
		
		# Get data from db
		$data['therapist'] = $this->setting_model->get_data_therapist();
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('setting/add_new_therapist', $data);
		$this->load->view('template/footer');
	}
	
	public function insert_therapist()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'setting', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('setting_model');
		
		# Retrieve data user
		$userdata = $this->session->userdata('log_data');
		
		# Ambil data dari form di tampilan
		$data = array(
				'thr_name' => $this->input->post('therapist_name'),
				'thr_code' => $this->input->post('therapist_code'),
				'thr_update_by' => $userdata['username'],
		);
		
		# Masukkan data ke database melalui model
		$this->setting_model->insert_therapist($data);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_therapist/');
	}
	
	## ---------------- ##
	## END OF THERAPIST ##
	## ---------------- ##
	
	## ------- ##
	## PRODUCT ##
	## ------- ##
	
	public function new_product()
	{		
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'setting', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'setting';
		$page['sidebar_list_product'] = 'on';
		
		# Load Model connect to database
		$this->load->model('setting_model');
		
		# Get data from db
		$data['product_cat'] = $this->setting_model->get_data_product_cat();
		$data['product'] = $this->setting_model->get_data_product();
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('setting/add_new_product', $data);
		$this->load->view('template/footer');
	}
	
	public function insert_product()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'setting', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('setting_model');
		
		# Retrieve data user
		$userdata = $this->session->userdata('log_data');
		
		# Ambil data dari form di tampilan
		$data = array(
				'thr_name' => $this->input->post('therapist_name'),
				'thr_code' => $this->input->post('therapist_code'),
				'thr_update_by' => $userdata['username'],
		);
		
		# Masukkan data ke database melalui model
		$this->setting_model->insert_product($data);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_therapist/');
	}
	
	## ---------------- ##
	## END OF THERAPIST ##
	## ---------------- ##
}

/* End of file payment.php */
/* Location: ./application/controllers/setting/admin.php */