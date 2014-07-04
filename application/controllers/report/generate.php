<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generate extends My_Reservation {

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
	} 
	
	public function index()
	{
		$this->payment();
	}

	## -------------- ##
	## PAYMENT REPORT ##
	## -------------- ##
	
	public function payment()
	{
		# Log Data
		$limit = array('report');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('report_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'report';
		$page['sidebar_payment_report'] = 'on'; $page['sidebar'] = $this->sidebar_set($user['log_data']);
		$page['sidebar'] = $this->sidebar_set($user['log_data']);
		
		# Get data Travel
		$data['list_user'] = $this->login_case->get_user('cashier', 2);
		$data['user'] = $user;
		
		# Application Log
		$this->app_record($user);
		
		#view call
		$this->view_call('report/payment_report', $page, $data);
	}
	
	public function payment_report()
	{
		# Log Data
		$limit = array('report');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('report_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'report';
		$page['sidebar_payment_report'] = 'on'; $page['sidebar'] = $this->sidebar_set($user['log_data']);
		$page['sidebar'] = $this->sidebar_set($user['log_data']);
		
		# Get data form
		$data['payment'] = $this->input->post('pay_type');
		$data['user'] = $this->input->post('user');
		$data['start'] = date('Y-m-d', strtotime($this->input->post('start')));
		$data['end'] = date('Y-m-d', strtotime($this->input->post('end')));
		$data['pay_list'] = $this->report_model->get_generate_payment_report($data['start'], $data['end'], $data['payment'], $data['user']);
		
		# Application Log
		$this->app_record($user);
		
		#view call
		if ($this->input->post('pay_type') == 'Hutang')
		{
			$this->view_call('report/hutang_report_generated', $page, $data);
		} else {
			$this->view_call('report/payment_report_generated', $page, $data);
		}
	}
	
	public function payment_pdf()
	{
		# Log Data
		$limit = array('report');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('report_model');
		$this->load->library('pdf');
		
		# Get data form
		$data['payment'] = $this->uri->segment(4);
		$data['user'] = $this->uri->segment(5);
		$data['start'] = date('Y-m-d', strtotime($this->uri->segment(6)));
		$data['end'] = date('Y-m-d', strtotime($this->uri->segment(7)));
		$data['pay_list'] = $this->report_model->get_generate_payment_report($data['start'], $data['end'], $data['payment'], $data['user']);
		
		# Application Log
		$this->app_record($user);
		
		# Load Helper PDF
		$this->load->helper('sigap_pdf');
		
		# PDF Maker
		$stream = TRUE; 
		$papersize = 'A4'; 
		$orientation = 'landscape';
		$filename = 'Payment-Report-'.date('dM', strtotime($data['start'])).'-'.date('dMY', strtotime($data['end'])).'-'.$data['payment'].'-'.$data['user'];
		$data['filename'] = $filename . '.pdf';
		$html = $this->load->view('report/print/payment',$data, true); 
		pdf_create($html, $filename, $stream, $papersize, $orientation, '');
	}
	
	public function hutang_pdf()
	{
		# Log Data
		$limit = array('report');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('report_model');
		$this->load->library('pdf');
		
		# Get data form
		$data['payment'] = 'Hutang';
		$data['user'] = $this->uri->segment(4);
		$data['start'] = date('Y-m-d', strtotime($this->uri->segment(5)));
		$data['end'] = date('Y-m-d', strtotime($this->uri->segment(6)));
		$data['pay_list'] = $this->report_model->get_generate_payment_report($data['start'], $data['end'], $data['payment'], $data['user']);
		
		# Application Log
		$this->app_record($user);
		
		# Load Helper PDF
		$this->load->helper('sigap_pdf');
		
		# PDF Maker
		$stream = TRUE; 
		$papersize = 'A4'; 
		$orientation = 'landscape';
		$filename = 'Hutang-Report-'.date('dM', strtotime($data['start'])).'-'.date('dMY', strtotime($data['end'])).'-'.$data['user'];
		$data['filename'] = $filename . '.pdf';
		$html = $this->load->view('report/print/hutang',$data, true); 
		pdf_create($html, $filename, $stream, $papersize, $orientation, '');
	}
	
	## --------------------- ##
	## END OF PAYMENT REPORT ##
	## --------------------- ##
	
	## ---------------- ##
	## THERAPIST REPORT ##
	## ---------------- ##
	
	public function therapist()
	{
		# Log Data
		$limit = array('report','therapist');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('report_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'report';
		$page['sidebar_therapist_report'] = 'on'; 
		$page['sidebar'] = $this->sidebar_set($user['log_data']);
		
		# Get data Travel
		$data['list_therapist'] = $this->report_model->get_therapist();
		$data['user'] = $user;
		
		# Application Log
		$this->app_record($user);
		
		#view call
		$this->view_call('report/therapist_report', $page, $data);
	}
	
	public function therapist_report()
	{
		# Log Data
		$limit = array('report','therapist');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('report_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'report';
		$page['sidebar_therapist_report'] = 'on'; 
		$page['sidebar'] = $this->sidebar_set($user['log_data']);
		
		# Get data form
		$data['user'] = $this->input->post('therapist');
		$data['start'] = date('Y-m-d', strtotime($this->input->post('start')));
		$data['end'] = date('Y-m-d', strtotime($this->input->post('end')));
		$data['therapist_list'] = $this->report_model->get_generate_therapist_report($data['start'], $data['end'], $data['user']);
		
		# Application Log
		$this->app_record($user);
		
		#view call
		$this->view_call('report/therapist_report_generated', $page, $data);
	}
	
	public function therapist_pdf()
	{
		# Log Data
		$limit = array('report','therapist');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('report_model');
		$this->load->library('pdf');
		
		# Get data form
		$data['user'] = $this->uri->segment(4);
		$data['start'] = date('Y-m-d', strtotime($this->uri->segment(5)));
		$data['end'] = date('Y-m-d', strtotime($this->uri->segment(6)));
		$data['therapist_list'] = $this->report_model->get_generate_therapist_report($data['start'], $data['end'], $data['user']);
		
		# Application Log
		$this->app_record($user);
		
		# Load Helper PDF
		$this->load->helper('sigap_pdf');
		
		# PDF Maker
		$stream = TRUE; 
		$papersize = 'A4'; 
		$orientation = 'landscape';
		$filename = 'Therapist-Report-'.date('dM', strtotime($data['start'])).'-'.date('dMY', strtotime($data['end'])).'-'.$data['user'];
		$data['filename'] = $filename . '.pdf';
		
		$html = $this->load->view('report/print/therapist',$data, true); 
		pdf_create($html, $filename, $stream, $papersize, $orientation, '');
	}
	
	## ----------------------- ##
	## END OF THERAPIST REPORT ##
	## ----------------------- ##
	
	## ----------- ##
	## ROOM REPORT ##
	## ----------- ##
	
	public function room()
	{
		# Log Data
		$limit = array('report','reservation');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('report_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'report';
		$page['sidebar_room_report'] = 'on'; 
		$page['sidebar'] = $this->sidebar_set($user['log_data']);
		
		# Get data Travel
		$data['list_room'] = $this->report_model->get_room();
		$data['user'] = $user;
		
		# Application Log
		$this->app_record($user);
		
		#view call
		$this->view_call('report/room_report', $page, $data);
	}
	
	public function room_report()
	{
		# Log Data
		$limit = array('report','reservation');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('report_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'report';
		$page['sidebar_room_report'] = 'on'; 
		$page['sidebar'] = $this->sidebar_set($user['log_data']);
		
		# Get data form
		$data['room'] = $this->input->post('room');
		$data['start'] = date('Y-m-d', strtotime($this->input->post('start')));
		$data['end'] = date('Y-m-d', strtotime($this->input->post('end')));
		$data['room_list'] = $this->report_model->get_generate_room_report($data['start'], $data['end'], $data['room']);
		
		# Application Log
		$this->app_record($user);
		
		#view call
		$this->view_call('report/room_report_generated', $page, $data);
	}
	
	public function room_pdf()
	{
		# Log Data
		$limit = array('report','reservation');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('report_model');
		$this->load->library('pdf');
		
		# Get data form
		$data['user'] = $this->uri->segment(4);
		$data['start'] = date('Y-m-d', strtotime($this->uri->segment(5)));
		$data['end'] = date('Y-m-d', strtotime($this->uri->segment(6)));
		$data['room_list'] = $this->report_model->get_generate_room_report($data['start'], $data['end'], $data['user']);
		
		# Application Log
		$this->app_record($user);
		
		# Load Helper PDF
		$this->load->helper('sigap_pdf');
		
		# PDF Maker
		$stream = TRUE; 
		$papersize = 'A4'; 
		$orientation = 'landscape';
		$filename = 'Room-Report-'.date('dM', strtotime($data['start'])).'-'.date('dMY', strtotime($data['end'])).'-'.$data['user'];
		$data['filename'] = $filename . '.pdf';
		
		$html = $this->load->view('report/print/room',$data, true); 
		pdf_create($html, $filename, $stream, $papersize, $orientation, '');
	}
	
	## ------------------ ##
	## END OF ROOM REPORT ##
	## ------------------ ##
	
	## -------------- ##
	## PRODUCT REPORT ##
	## -------------- ##
	
	public function product()
	{
		# Log Data
		$limit = array('report','reservation');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('report_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'report';
		$page['sidebar_product_report'] = 'on'; 
		$page['sidebar'] = $this->sidebar_set($user['log_data']);
		
		# Get data Travel
		$data['list_product'] = $this->report_model->get_product();
		$data['user'] = $user;
		
		# Application Log
		$this->app_record($user);
		
		#view call
		$this->view_call('report/product_report', $page, $data);
	}
	
	public function product_report()
	{
		# Log Data
		$limit = array('report','reservation');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('report_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'report';
		$page['sidebar_product_report'] = 'on'; $page['sidebar'] = $this->sidebar_set($user['log_data']);
		
		# Get data form
		$data['product'] = $this->input->post('product');
		$data['start'] = date('Y-m-d', strtotime($this->input->post('start')));
		$data['end'] = date('Y-m-d', strtotime($this->input->post('end')));
		$data['product_list'] = $this->report_model->get_generate_product_report($data['start'], $data['end'], $data['product']);
		
		# Application Log
		$this->app_record($user);
		
		# view call
		$this->view_call('report/product_report_generated', $page, $data);
	}
	
	public function product_pdf()
	{
		# Log Data
		$limit = array('report','reservation');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('report_model');
		$this->load->library('pdf');
		
		# Get data form
		$data['product'] = str_replace('%20',' ',$this->uri->segment(4));
		$data['start'] = date('Y-m-d', strtotime($this->uri->segment(5)));
		$data['end'] = date('Y-m-d', strtotime($this->uri->segment(6)));
		$data['product_list'] = $this->report_model->get_generate_product_report($data['start'], $data['end'], $data['product']);
		
		# Application Log
		$this->app_record($user);
		
		# Load Helper PDF
		$this->load->helper('sigap_pdf');
		
		# PDF Maker
		$stream = TRUE; 
		$papersize = 'A4'; 
		$orientation = 'landscape';
		$filename = 'Product-Report-'.date('dM', strtotime($data['start'])).'-'.date('dMY', strtotime($data['end'])).'-'.$data['product'];
		$data['filename'] = $filename . '.pdf';
		
		$html = $this->load->view('report/print/product',$data, true); 
		pdf_create($html, $filename, $stream, $papersize, $orientation, '');
	}
	
	## --------------------- ##
	## END OF PRODUCT REPORT ##
	## --------------------- ##
	
	## ------------- ##
	## TRAVEL REPORT ##
	## ------------- ##
	
	public function travel()
	{
		# Log Data
		$limit = array('report','reservation');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('report_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'report';
		$page['sidebar_travel_report'] = 'on'; 
		$page['sidebar'] = $this->sidebar_set($user['log_data']);
		
		# Get data Travel
		$data['list_travel'] = $this->report_model->get_travel();
		$data['user'] = $user;
		
		# Application Log
		$this->app_record($user);
		
		#view call
		$this->view_call('report/travel_report', $page, $data);
	}
	
	public function travel_report()
	{
		# Log Data
		$limit = array('report','reservation');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('report_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'report';
		$page['sidebar_travel_report'] = 'on'; 
		$page['sidebar'] = $this->sidebar_set($user['log_data']);
		
		# Get data form
		$data['travel'] = $this->input->post('travel');
		$data['start'] = date('Y-m-d', strtotime($this->input->post('start')));
		$data['end'] = date('Y-m-d', strtotime($this->input->post('end')));
		$data['travel_list'] = $this->report_model->get_generate_travel_report($data['start'], $data['end'], $data['travel']);
		
		# Application Log
		$this->app_record($user);
		
		# view call
		$this->view_call('report/travel_report_generated', $page, $data);
	}
	
	public function travel_pdf()
	{
		# Log Data
		$limit = array('report','reservation');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('report_model');
		$this->load->library('pdf');
		
		# Get data form
		$data['travel'] = str_replace('%20',' ',$this->uri->segment(4));
		$data['start'] = date('Y-m-d', strtotime($this->uri->segment(5)));
		$data['end'] = date('Y-m-d', strtotime($this->uri->segment(6)));
		$data['travel_list'] = $this->report_model->get_generate_travel_report($data['start'], $data['end'], $data['travel']);
		
		# Application Log
		$this->app_record($user);
		
		# Load Helper PDF
		$this->load->helper('sigap_pdf');
		
		# PDF Maker
		$stream = TRUE; 
		$papersize = 'A4'; 
		$orientation = 'landscape';
		$filename = 'Travel-Report-'.date('dM', strtotime($data['start'])).'-'.date('dMY', strtotime($data['end'])).'-'.$data['travel'];
		$data['filename'] = $filename . '.pdf';
		
		$html = $this->load->view('report/print/travel',$data, true); 
		pdf_create($html, $filename, $stream, $papersize, $orientation, '');
	}
	
	## -------------------- ##
	## END OF TRAVEL REPORT ##
	## -------------------- ##
	
	## -------- ##
	## PAY DEBT ##
	## -------- ##
	
	public function paid_debt()
	{
		# Log Data
		$limit = array('report');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('report_model');
		$this->load->library('user_agent');
		
		$this->report_model->update_payment_status($this->uri->segment(4));
		
		# Application Log
		$this->app_record($user);
		
		redirect('report/generate/payment');
	}
	
	## -------- ##
	## PAY DEBT ##
	## -------- ##
}

/* End of file generate.php */
/* Location: ./application/controllers/report/generate.php */