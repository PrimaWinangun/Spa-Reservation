<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * The Banjar Bali
	 * Reservation System.
	 * 
	 * App code : app.rsv.alcd
	 * App ver  : 1.0.0
	 *
	 * reservation/admin controller
	 *
	 * design : SIGAP Team
	 * project head : primawinangun@gmail.com
	 *
	 * developer : prima winangun
	 * phone : 0822 844 60840
	 *
	 * copyright by prima winangun
	 * Do not copy, modified, share or sell this script 
	 * without any permission from developer
	 */
	 
	function __construct()
	{
        parent::__construct();
		
		if ( ! $this->session->userdata('log_data'))
    	{ 
        	# function allowed for access without login
			$allowed = array('');
        
			# other function need login
			if (! in_array($this->router->method, $allowed)) 
			{
    			redirect('login');
			}
   		 }
	} 
	
	public function index()
	{
		$this->new_reservation();
	}
	
	## --------------- ##
	## NEW RESERVATION ##
	## --------------- ##
	
	public function new_reservation()
	{		
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'reservation', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('reservation_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'reservation';
		$page['sidebar_new_reservation'] = 'on';
		
		# Pagination Config
		$config['base_url'] = base_url().'index.php/reservation/admin/list_reservation/'; //set the base url for pagination
		$config['total_rows'] = $this->reservation_model->count_reservation_date(date('Y-m-d', now())); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 4; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$pagination = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		# Get data Travel
		$data['travel'] = $this->reservation_model->get_data_travel();
		$data['res_code'] = $this->reservation_model->get_last_res_code();
		$data['res_list'] = $this->reservation_model->get_today_res_list(date('Y-m-d', now()), $config['per_page'], $pagination);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		# View call
		$this->load->view('template/header',$page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('reservation/add_new_reservation', $data);
		$this->load->view('template/footer');
	}
	
	public function insert_reservation()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'reservation', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('reservation_model');
		
		# Retrieve data user
		$userdata = $this->session->userdata('log_data');
		
		# Form Validation
		$config = array(
               array(
                     'field'   => 'date', 
                     'label'   => 'date', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'pic', 
                     'label'   => 'pic', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'pax', 
                     'label'   => 'pax', 
                     'rules'   => 'required|numeric'
                  )
            );
		$this->form_validation->set_rules($config);
		
		if ($this->form_validation->run() == TRUE)
		{
			# Ambil data dari form di tampilan
			$data = array(
					'res_code' => $this->input->post('res_code'),
					'res_date' => mdate('%Y-%m-%d',strtotime($this->input->post('date'))),
					'res_agent' => $this->input->post('travel'),
					'res_guide' => $this->input->post('pic'),
					'res_order_by' => $this->input->post('travel'),
					'res_pax' => $this->input->post('pax'),
					'res_update_by' => $userdata['username'],
			);
			
			# Masukkan data ke database melalui model
			$this->reservation_model->insert_data_reservasi($data);
			
			# Application Log
			$this->app_log->record($user['username'], $this->uri->uri_string());
			
			redirect('reservation/admin/add_detail_pax/'.$this->input->post('res_code'));
		} else {
			redirect('reservation/admin/new_reservation/invalid_input');
		}
	}
	
	public function add_detail_pax()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'reservation', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('reservation_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'reservation';
		$page['sidebar_new_reservation'] = 'on';
		
		# Retrieve Data from Database
		$data['produk'] = $this->reservation_model->get_data_produk();
		$data['room_cat'] = $this->reservation_model->get_data_room_cat();
		$data['rooms'] = $this->reservation_model->get_data_room_open();
		$data['therapist'] = $this->reservation_model->get_data_therapist_open();
		$data['data_pax'] = $this->reservation_model->get_data_pax($this->uri->segment(4));
		$data['reservation'] = $this->reservation_model->get_data_reservation($this->uri->segment(4));
		
		$total_pax = $this->reservation_model->get_data_reservation($this->uri->segment(4));
		$data['total_pax'] = $total_pax->res_pax;
		$data['res_date'] = $total_pax->res_date;
		$data['detail_total_pax'] = $this->reservation_model->total_detail_pax($this->uri->segment(4));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header',$page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('reservation/add_detail_pax',$data);
		$this->load->view('template/footer');
	}
	
	public function insert_detail_pax()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'reservation', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('reservation_model');
		
		# Form Validation
		$config = array(
               array(
                     'field'   => 'jum', 
                     'label'   => 'jum', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'start', 
                     'label'   => 'start', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'end', 
                     'label'   => 'end', 
                     'rules'   => 'required'
                  )
            );
		$this->form_validation->set_rules($config);
		
		if ($this->form_validation->run() == TRUE)
		{
			# Retrieve data user
			$userdata = $this->session->userdata('log_data');
			
			# Ambil harga dari database
			$product = $this->reservation_model->get_detail_product($this->input->post('produk'));

			# Ambil data dari form di tampilan
			if ($this->input->post('end') >= '24:00')
			{
				$end = '00:00';
			} else { $end = $this->input->post('end');}
			if ($this->input->post('rupiah') == 'yes')
			{
				$payment = 'rupiah';
			} else { $payment = 'dollar'; }
			$data = array(
					'rpd_res_id' => $this->input->post('res_code'),
					'rpd_room' => $this->input->post('room'),
					'rpd_product' => $product->prod_code,
					'rpd_therapist' => $this->input->post('therapist'),
					'rpd_rate' => $product->prod_rate,
					'rpd_rate_dollar' => $product->prod_rate_dollar,
					'rpd_rate_payment' => $payment,
					'rpd_start_on' => $this->input->post('start'),
					'rpd_end_on' => $end,
					'rpd_quantity' => $this->input->post('jum'),
					'rpd_update_by' => $userdata['username'],
			);
			
			# Application Log
			$this->app_log->record($user['username'], $this->uri->uri_string());
			
			# Cek available room, redirect if not available
			if ($this->reservation_model->get_available_room($this->input->post('room'),$this->input->post('start'), $end, $this->input->post('res_date')) >= 1)
			{
				redirect('reservation/admin/add_detail_pax/'.$this->input->post('res_code').'/room_not_available');
			} else {
				# Masukkan data ke database melalui model
				if ($this->reservation_model->get_available_therapist($this->input->post('therapist'), $this->input->post('start'), $end, $this->input->post('res_date')) >= 1){
						redirect('reservation/admin/add_detail_pax/'.$this->input->post('res_code').'/therapist_not_available');
				} else 
				{
					$id_rpd =  $this->reservation_model->insert_data_pax($data);
					if ($this->input->post('therapist') != '')
					{
						$therapist = array(
										'thw_code' => $this->input->post('therapist'),
										'thw_date' => $this->input->post('res_date'),
										'thw_start_time' => $this->input->post('start'),
										'thw_end_time' => $this->input->post('end'),
										'thw_id_rpd' => $id_rpd
							);
							$this->reservation_model->insert_therapist_workhour($therapist);
					}
					if ($this->input->post('room') != '')
					{
						$cat_room = $this->reservation_model->get_room_cat_by_room_no($this->input->post('room'));
						$available = array(
									'rav_room_name' => $this->input->post('room'),
									'rav_id_rpd' => $id_rpd,
									'rav_start' => $this->input->post('start'),
									'rav_end' => $this->input->post('end'),
									'rav_book_date' => $this->input->post('res_date'),
									'rav_status' => 'book'
						);
						
						$this->reservation_model->insert_available_list($available);
					}
					
					redirect('reservation/admin/add_detail_pax/'.$this->input->post('res_code'));
				}
			}
		} else {
			redirect('reservation/admin/add_detail_pax/'.$this->input->post('res_code').'/invalid');
		}
	}
	
	public function set_therapist()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'reservation', 1)  AND !$this->url_app->auth_limit($user, 'therapist', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('reservation_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'reservation';
		$page['sidebar_room_available'] = 'on';
		
		$data['therapist'] = $this->reservation_model->get_data_therapist_open();
		$data['data_pax'] = $this->reservation_model->get_data_pax_by_id($this->uri->segment(4));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header',$page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('reservation/set_therapist',$data);
		$this->load->view('template/footer');
	}
	
	public function update_data_therapist()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'reservation', 1)  AND !$this->url_app->auth_limit($user, 'therapist', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('reservation_model');
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		if ($this->reservation_model->get_available_therapist($this->input->post('therapist'), $this->input->post('start'), $this->input->post('end'), $this->input->post('res_date')) >= 1)
		{
			redirect('reservation/admin/set_therapist/'.$this->input->post('res_id').'/therapist_not_available');
		} else {
			$therapist = array(
				'thw_code' => $this->input->post('therapist'),
				'thw_date' => $this->input->post('res_date'),
				'thw_start_time' => $this->input->post('start'),
				'thw_end_time' => $this->input->post('end'),
				'thw_id_rpd' => $this->input->post('res_id')
			);
			$this->reservation_model->insert_therapist_workhour($therapist);
			$this->reservation_model->set_data_detail_pax($this->input->post('res_id'), $this->input->post('therapist'));
			
			redirect('reservation/admin/room_available');
		}
	}
	
	## ---------------------- ##
	## END OF NEW RESERVATION ##
	## ---------------------- ##
	
	## ---------------- ##
	## RESERVATION LIST ##
	## ---------------- ##
	
	public function list_reservation()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'reservation', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('reservation_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'reservation';
		$page['sidebar_list_reservation'] = 'on';
		
		# Pagination Config
		$config['base_url'] = base_url().'index.php/reservation/admin/list_reservation/'; //set the base url for pagination
		$config['total_rows'] = $this->reservation_model->count_reservation(); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 4; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$pagination = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		# Get data Travel
		$data['res_list'] = $this->reservation_model->get_reservation_list($config['per_page'], $pagination);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		# View call
		$this->load->view('template/header',$page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('reservation/reservation_list', $data);
		$this->load->view('template/footer');
	}
	
	public function search_list_reservation()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'reservation', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('reservation_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'reservation';
		$page['sidebar_list_reservation'] = 'on';
		
		if ($this->input->post('search') != NULL)
		{
			$this->session->set_flashdata('search_rsv', $this->input->post('search'));
			$search = $this->input->post('search');
		} else { 
			$search = $this->session->flashdata('search_rsv');
			$this->session->keep_flashdata('search_rsv');
		}
		
		# Pagination Config
		$config['base_url'] = base_url().'index.php/reservation/admin/search_list_reservation/'; //set the base url for pagination
		$config['total_rows'] = $this->reservation_model->count_reservation_search($search); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 4; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$pagination = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		# Get data Travel
		$data['res_list'] = $this->reservation_model->get_search_reservation_list($search, $config['per_page'], $pagination);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		# View call
		$this->load->view('template/header',$page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('reservation/reservation_list', $data);
		$this->load->view('template/footer');
	}
	
	public function search_list_reservation_by_date()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'reservation', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('reservation_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'reservation';
		$page['sidebar_list_reservation'] = 'on';
		
		if ($this->input->post('date_search') != NULL)
		{
			$this->session->set_flashdata('search_date', $this->input->post('date_search'));
			$search = $this->input->post('date_search');
		} else { 
			$search = $this->session->flashdata('search_date');
			$this->session->keep_flashdata('search_rsv');
		}
		
		# Pagination Config
		$config['base_url'] = base_url().'index.php/reservation/admin/search_list_reservation_by_date/'; //set the base url for pagination
		$config['total_rows'] = $this->reservation_model->count_reservation_date(date('Y-m-d', strtotime($search))); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 4; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$pagination = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		# Get data Travel
		$data['res_list'] = $this->reservation_model->get_today_res_list(date('Y-m-d', strtotime($search)), $config['per_page'], $pagination);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		# View call
		$this->load->view('template/header',$page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('reservation/reservation_list', $data);
		$this->load->view('template/footer');
	}
	
	## ----------------------- ##
	## END OF RESERVATION LIST ##
	## ----------------------- ##
	
	## -------------- ##
	## AVAILABLE ROOM ##
	## -------------- ##
	
	public function room_available()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'reservation', 1) AND !$this->url_app->auth_limit($user, 'therapist', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('reservation_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'reservation';
		$page['sidebar_room_available'] = 'on';
		
		# Retrieve data from database
		$data['room'] = $this->reservation_model->get_room_list();
		$data['date'] = date('Y-m-d', now());
		
		foreach ($data['room'] as $row_room)
		{
			$data['room'.$row_room->room_name] = $this->reservation_model->get_all_room($data['date'], $row_room->room_name);
		}
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header',$page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('reservation/room_available',$data);
		$this->load->view('template/footer');
	}
	
	public function room_use()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'reservation', 1) AND !$this->url_app->auth_limit($user, 'therapist', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('reservation_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'reservation';
		$page['sidebar_room_available'] = 'on';
		
		# Retrieve data from database
		$data['room'] = $this->reservation_model->get_room_list();
		$data['date'] = date('Y-m-d', now());
		foreach ($data['room'] as $row_room)
		{
			$data['room'.$row_room->room_name] = $this->reservation_model->get_all_room($data['date'], $row_room->room_name);
		}
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header',$page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('reservation/room_use',$data);
		$this->load->view('template/footer');
	}
	
	public function search_room_available()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'reservation', 1) AND !$this->url_app->auth_limit($user, 'therapist', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('reservation_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'reservation';
		$page['sidebar_room_available'] = 'on';
		
		$data['date'] = date('Y-m-d', strtotime($this->input->post('date')));
		
		# Retrieve data from database
		$data['room'] = $this->reservation_model->get_room_list();
		foreach ($data['room'] as $row_room)
		{
			$data['room'.$row_room->room_name] = $this->reservation_model->get_all_room($data['date'], $row_room->room_name);
		}
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header',$page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('reservation/room_available',$data);
		$this->load->view('template/footer');
	}
	
	## --------------------- ##
	## END OF AVAILABLE ROOM ##
	## --------------------- ##
	
	## ---------------- ##
	## VOID RESERVATION ##
	## ---------------- ##
	
	public function void_reservation()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'reservation', 2))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('reservation_model');
		
		# Void Data
		$detail = $this->reservation_model->get_data_pax($this->uri->segment(4, TRUE));
		
		foreach ($detail as $row)
		{
			$this->reservation_model->void_available_room($row['rpd_room']);
		}
		
		# Void Data
		$this->reservation_model->void_detail_reservation($this->uri->segment(4, TRUE));
		$this->reservation_model->void_reservation($this->uri->segment(4, TRUE));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		# Redirect
		redirect('reservation/admin/'.$this->uri->segment(5));
	}
	
	public function void_detail_pax()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'reservation', 2))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('reservation_model');
		
		# Void Data
		$this->reservation_model->void_detail_reservation_by_id($this->uri->segment(4, TRUE));
		$this->reservation_model->void_available_room_by_id($this->uri->segment(4, TRUE));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		# Redirect
		redirect('reservation/admin/add_detail_pax/'.$this->uri->segment(5));
	}
	
	## ----------------------- ##
	## END OF VOID RESERVATION ##
	## ----------------------- ##
}

/* End of file payment.php */
/* Location: ./application/controllers/cashier/payment.php */