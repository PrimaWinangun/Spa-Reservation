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
		$this->load->model('setting_model');
		
		# Get data from db
		$data['room_cat'] = $this->setting_model->get_data_room_cat();
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('setting/add_new_room_cat', $data);
		$this->load->view('template/footer');
	}
	
	public function edit_room_cat()
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
		$this->load->model('setting_model');
		
		# Get data from db
		$data['room_cat'] = $this->setting_model->get_detail_room_cat($this->uri->segment(4));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('setting/edit_room_cat', $data);
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
		
		# Ambil data dari form di tampilan
		$data = array(
				'cat_code' => $this->input->post('room_code'),
				'cat_name' => $this->input->post('room_cat'),
				'cat_update_by' => $user['username'],
		);
		
		# Masukkan data ke database melalui model
		$this->setting_model->insert_room_cat($data);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_room_cat/');
	}
	
	public function update_room_cat()
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
		
		# Ambil data dari form di tampilan
		$data = array(
				'cat_code' => $this->input->post('room_code'),
				'cat_name' => $this->input->post('room_cat'),
				'cat_update_by' => $user['username'],
		);
		
		# Masukkan data ke database melalui model
		$this->setting_model->update_room_cat($this->input->post('id'), $data);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_room_cat/');
	}
	
	public function void_room_cat()
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
		
		# Masukkan data ke database melalui model
		$this->setting_model->void_room_cat($this->uri->segment(4));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_room_cat/');
	}
	
	public function show_room_cat()
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
		
		# Masukkan data ke database melalui model
		$this->setting_model->show_room_cat($this->uri->segment(4));
		
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
		
		# Pagination Config
		$config['base_url'] = base_url().'index.php/setting/admin/new_room/'; //set the base url for pagination
		$config['total_rows'] = $this->setting_model->count_room(); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 4; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$pagination = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		# Get data from db
		$data['room_cat'] = $this->setting_model->get_data_room_cat_unhide();
		$data['room'] = $this->setting_model->get_data_room($config['per_page'], $pagination);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('setting/add_new_room', $data);
		$this->load->view('template/footer');
	}
	
	public function edit_room()
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
		$data['room_cat'] = $this->setting_model->get_data_room_cat_unhide();
		$data['room'] = $this->setting_model->get_detail_room($this->uri->segment(4));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('setting/edit_room', $data);
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
		
		# Ambil data dari form di tampilan
		$data = array(
				'room_name' => $this->input->post('room'),
				'room_category' => $this->input->post('room_cat'),
				'room_update_by' => $user['username'],
		);
		
		# Masukkan data ke database melalui model
		$this->setting_model->insert_room($data);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_room/');
	}
	
	public function update_room()
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
		
		# Ambil data dari form di tampilan
		$data = array(
				'room_name' => $this->input->post('room'),
				'room_category' => $this->input->post('room_cat'),
				'room_update_by' => $user['username'],
		);
		
		# Masukkan data ke database melalui model
		$this->setting_model->update_room($this->input->post('id'), $data);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_room/');
	}
	
	public function void_room()
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
		
		# Masukkan data ke database melalui model
		$this->setting_model->void_room($this->uri->segment(4));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_room/');
	}
	
	public function show_room()
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
		
		# Masukkan data ke database melalui model
		$this->setting_model->show_room($this->uri->segment(4));
		
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
		
		# Pagination Config
		$config['base_url'] = base_url().'index.php/setting/admin/new_therapist/'; //set the base url for pagination
		$config['total_rows'] = $this->setting_model->count_therapist(); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 4; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$pagination = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		# Get data from db
		$data['therapist'] = $this->setting_model->get_data_therapist($config['per_page'], $pagination);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('setting/add_new_therapist', $data);
		$this->load->view('template/footer');
	}
	
	public function edit_therapist()
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
		$data['therapist'] = $this->setting_model->get_detail_therapist($this->uri->segment(4));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('setting/edit_therapist', $data);
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
		
		# Ambil data dari form di tampilan
		$data = array(
				'thr_name' => $this->input->post('therapist_name'),
				'thr_code' => $this->input->post('therapist_code'),
				'thr_update_by' => $user['username'],
		);
		
		# Masukkan data ke database melalui model
		$this->setting_model->insert_therapist($data);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_therapist/');
	}
	
	public function update_therapist()
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
		
		# Ambil data dari form di tampilan
		$data = array(
				'thr_name' => $this->input->post('therapist_name'),
				'thr_code' => $this->input->post('therapist_code'),
				'thr_update_by' => $user['username'],
		);
		
		# Masukkan data ke database melalui model
		$this->setting_model->update_therapist($this->input->post('id'), $data);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_therapist/');
	}
	
	public function void_therapist()
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
		
		# Masukkan data ke database melalui model
		$this->setting_model->void_therapist($this->uri->segment(4));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_therapist/');
	}
	
	public function show_therapist()
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
		
		# Masukkan data ke database melalui model
		$this->setting_model->show_therapist($this->uri->segment(4));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_therapist/');
	}
	
	## ---------------- ##
	## END OF THERAPIST ##
	## ---------------- ##
	
	## ---------------- ##
	## PRODUCT CATEGORY ##
	## ---------------- ##
	
	public function new_product_cat()
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
		$page['sidebar_list_product_cat'] = 'on';
		
		# Load Model connect to database
		$this->load->model('setting_model');
		
		# Get data from db
		$data['product_cat'] = $this->setting_model->get_data_product_cat();
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('setting/add_new_product_cat', $data);
		$this->load->view('template/footer');
	}
	
	public function edit_product_cat()
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
		$page['sidebar_list_product_cat'] = 'on';
		
		# Load Model connect to database
		$this->load->model('setting_model');
		
		# Get data from db
		$data['product_cat'] = $this->setting_model->get_detail_product_cat($this->uri->segment(4));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('setting/edit_product_cat', $data);
		$this->load->view('template/footer');
	}
	
	public function insert_product_cat()
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
		
		# Ambil data dari form di tampilan
		$data = array(
				'cp_code' => $this->input->post('cat_code'),
				'cp_name' => $this->input->post('cat_name'),
				'cp_update_by' => $user['username'],
		);
		
		# Masukkan data ke database melalui model
		$this->setting_model->insert_product_cat($data);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_product_cat/');
	}
	
	public function update_product_cat()
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
		
		# Ambil data dari form di tampilan
		$data = array(
				'cp_code' => $this->input->post('cat_code'),
				'cp_name' => $this->input->post('cat_name'),
				'cp_update_by' => $user['username'],
		);
		
		# Masukkan data ke database melalui model
		$this->setting_model->update_product_cat($this->input->post('id'), $data);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_product_cat/');
	}
	
	public function void_product_cat()
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
		
		# Masukkan data ke database melalui model
		$this->setting_model->void_product_cat($this->uri->segment(4));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_product_cat/');
	}
	
	public function show_product_cat()
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
		
		# Masukkan data ke database melalui model
		$this->setting_model->show_product_cat($this->uri->segment(4));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_product_cat/');
	}
	
	## ----------------------- ##
	## END OF PRODUCT CATEGORY ##
	## ----------------------- ##
	
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
		
		# Pagination Config
		$config['base_url'] = base_url().'index.php/setting/admin/new_product/'; //set the base url for pagination
		$config['total_rows'] = $this->setting_model->count_product(); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 4; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$pagination = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		# Get data from db
		$data['product_cat'] = $this->setting_model->get_data_product_cat_unhide();
		$data['product'] = $this->setting_model->get_data_product($config['per_page'], $pagination);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('setting/add_new_product', $data);
		$this->load->view('template/footer');
	}
	
	public function edit_product()
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
		$data['product_cat'] = $this->setting_model->get_data_product_cat_unhide();
		$data['product'] = $this->setting_model->get_detail_product($this->uri->segment(4));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('setting/edit_product', $data);
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
		
		# Ambil data dari form di tampilan
		$data = array(
				'prod_kategori' => $this->input->post('prod_cat'),
				'prod_code' => $this->input->post('prod_code'),
				'prod_name' => $this->input->post('prod_name'),
				'prod_rate' => $this->input->post('prod_rate'),
				'prod_rate_dollar' => $this->input->post('prod_rate_usd'),
				'prod_update_by' => $user['username'],
		);
		
		# Masukkan data ke database melalui model
		$this->setting_model->insert_product($data);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_product/');
	}
	
	public function update_product()
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
		
		# Ambil data dari form di tampilan
		$data = array(
				'prod_kategori' => $this->input->post('prod_cat'),
				'prod_code' => $this->input->post('prod_code'),
				'prod_name' => $this->input->post('prod_name'),
				'prod_rate' => $this->input->post('prod_rate'),
				'prod_rate_dollar' => $this->input->post('prod_rate_usd'),
				'prod_update_by' => $user['username'],
		);
		
		# Masukkan data ke database melalui model
		$this->setting_model->update_product($this->input->post('id'),$data);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_product/');
	}
	
	public function void_product()
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
		
		# Masukkan data ke database melalui model
		$this->setting_model->void_product($this->uri->segment(4));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_product/');
	}
	
	public function show_product()
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
		
		# Masukkan data ke database melalui model
		$this->setting_model->show_product($this->uri->segment(4));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_product/');
	}
	
	## -------------- ##
	## END OF PRODUCT ##
	## -------------- ##
	
	## ------ ##
	## TRAVEL ##
	## ------ ##
	
	public function new_travel()
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
		$page['sidebar_list_travel'] = 'on';
		
		# Load Model connect to database
		$this->load->model('setting_model');
		
		# Pagination Config
		$config['base_url'] = base_url().'index.php/setting/admin/new_travel/'; //set the base url for pagination
		$config['total_rows'] = $this->setting_model->count_travel(); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 4; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$pagination = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		# Get data from db
		$data['travel'] = $this->setting_model->get_data_travel($config['per_page'], $pagination);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('setting/add_new_travel', $data);
		$this->load->view('template/footer');
	}
	
	public function edit_travel()
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
		$page['sidebar_list_travel'] = 'on';
		
		# Load Model connect to database
		$this->load->model('setting_model');
		
		# Get data from db
		$data['travel'] = $this->setting_model->get_detail_travel($this->uri->segment(4));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('setting/edit_travel', $data);
		$this->load->view('template/footer');
	}
	
	public function insert_travel()
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
		
		# Ambil data dari form di tampilan
		$data = array(
				'trv_code' => $this->input->post('trv_code'),
				'trv_name' => $this->input->post('trv_name'),
				'trv_address' => $this->input->post('trv_add'),
				'trv_phone' => $this->input->post('trv_phn'),
				'trv_mail' => $this->input->post('trv_mail'),
				'trv_update_by' => $user['username'],
		);
		
		# Masukkan data ke database melalui model
		$this->setting_model->insert_travel($data);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_travel/');
	}
	
	public function update_travel()
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
		
		# Ambil data dari form di tampilan
		$data = array(
				'trv_code' => $this->input->post('trv_code'),
				'trv_name' => $this->input->post('trv_name'),
				'trv_address' => $this->input->post('trv_add'),
				'trv_phone' => $this->input->post('trv_phn'),
				'trv_mail' => $this->input->post('trv_mail'),
				'trv_update_by' => $user['username'],
		);
		
		# Masukkan data ke database melalui model
		$this->setting_model->update_travel($this->input->post('id'), $data);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_travel/');
	}
	
	public function void_travel()
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
		
		# Masukkan data ke database melalui model
		$this->setting_model->void_travel($this->uri->segment(4));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_travel/');
	}
	
	public function show_travel()
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
		
		# Masukkan data ke database melalui model
		$this->setting_model->show_travel($this->uri->segment(4));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_travel/');
	}
	
	## ------------- ##
	## END OF TRAVEL ##
	## ------------- ##
	
	## ------------ ##
	## PAYMENT TYPE ##
	## ------------ ##
	
	public function new_payment_type()
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
		$page['sidebar_payment_type'] = 'on';
		
		# Load Model connect to database
		$this->load->model('setting_model');
		
		# Get data from db
		$data['payment'] = $this->setting_model->get_data_payment();
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('setting/add_new_payment', $data);
		$this->load->view('template/footer');
	}
	
	public function edit_payment_type()
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
		$page['sidebar_payment_type'] = 'on';
		
		# Load Model connect to database
		$this->load->model('setting_model');
		
		# Get data from db
		$data['payment'] = $this->setting_model->get_detail_payment($this->uri->segment(4));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('setting/edit_payment', $data);
		$this->load->view('template/footer');
	}
	
	public function insert_payment_type()
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
		
		# Ambil data dari form di tampilan
		$data = array(
				'pay_payment_type' => $this->input->post('pay_name'),
				'pay_discount' => $this->input->post('pay_disc'),
				'pay_update_by' => $user['username'],
		);
		
		# Masukkan data ke database melalui model
		$this->setting_model->insert_payment($data);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_payment_type/');
	}
	
	public function update_payment_type()
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
		
		# Ambil data dari form di tampilan
		$data = array(
				'pay_payment_type' => $this->input->post('pay_name'),
				'pay_discount' => $this->input->post('pay_disc'),
				'pay_update_by' => $user['username'],
		);
		
		# Masukkan data ke database melalui model
		$this->setting_model->update_payment($this->input->post('id'),$data);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_payment_type/');
	}
	
	public function void_payment_type()
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
		
		# Masukkan data ke database melalui model
		$this->setting_model->void_payment($this->uri->segment(4));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_payment_type/');
	}
	
	public function show_payment_type()
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
		
		# Masukkan data ke database melalui model
		$this->setting_model->show_payment($this->uri->segment(4));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/admin/new_payment_type/');
	}
	
	## ------------------- ##
	## END OF PAYMENT TYPE ##
	## ------------------- ##
}

/* End of file admin.php */
/* Location: ./application/controllers/setting/admin.php */