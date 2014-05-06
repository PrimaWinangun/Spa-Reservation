<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generate extends CI_Controller {

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
		$this->payment();
	}

	## -------------- ##
	## PAYMENT REPORT ##
	## -------------- ##
	
	public function payment()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'report', 1))
		{
			redirect('user/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('report_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'report';
		$page['sidebar_report_payment'] = 'on';
		
		# Get data Travel
		$data['list_user'] = $this->login_case->get_user('cashier', 2);
		$data['user'] = $user;
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('report/payment_report', $data);
		$this->load->view('template/footer');
	}
	
	public function payment_report()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'report', 1))
		{
			redirect('user/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('report_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'report';
		$page['sidebar_report_payment'] = 'on';
		
		# Get data form
		$data['payment'] = $this->input->post('pay_type');
		$data['user'] = $this->input->post('user');
		$data['start'] = date('Y-m-d', strtotime($this->input->post('start')));
		$data['end'] = date('Y-m-d', strtotime($this->input->post('end')));
		$data['pay_list'] = $this->report_model->get_generate_payment_report($data['start'], $data['end'], $data['payment'], $data['user']);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		if ($this->input->post('pay_type') == 'Hutang')
		{
			$this->load->view('report/hutang_report_generated', $data);
		} else {
			$this->load->view('report/payment_report_generated', $data);
		}
		$this->load->view('template/footer');
	}
	
	public function payment_pdf()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
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
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
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
		$user = $this->session->userdata('log_data');
		
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
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
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
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'report', 1))
		{
			redirect('user/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('report_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'report';
		$page['sidebar_report_therapist'] = 'on';
		
		# Get data Travel
		$data['list_therapist'] = $this->report_model->get_therapist();
		$data['user'] = $user;
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('report/therapist_report', $data);
		$this->load->view('template/footer');
	}
	
	public function therapist_report()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'report', 1))
		{
			redirect('user/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('report_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'report';
		$page['sidebar_report_therapist'] = 'on';
		
		# Get data form
		$data['user'] = $this->input->post('therapist');
		$data['start'] = date('Y-m-d', strtotime($this->input->post('start')));
		$data['end'] = date('Y-m-d', strtotime($this->input->post('end')));
		$data['therapist_list'] = $this->report_model->get_generate_therapist_report($data['start'], $data['end'], $data['user']);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('report/therapist_report_generated', $data);
		$this->load->view('template/footer');
	}
	
	public function therapist_pdf()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Load Model connect to database
		$this->load->model('report_model');
		$this->load->library('pdf');
		
		# Get data form
		$data['user'] = $this->uri->segment(4);
		$data['start'] = date('Y-m-d', strtotime($this->uri->segment(5)));
		$data['end'] = date('Y-m-d', strtotime($this->uri->segment(6)));
		$data['therapist_list'] = $this->report_model->get_generate_therapist_report($data['start'], $data['end'], $data['user']);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
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
	
	## --------------------- ##
	## END OF PAYMENT REPORT ##
	## --------------------- ##
	
	## -------------- ##
	## PRODUCT REPORT ##
	## -------------- ##
	
	public function product()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'report', 1))
		{
			redirect('user/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('report_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'report';
		$page['sidebar_report_product'] = 'on';
		
		# Get data Travel
		$data['list_product'] = $this->report_model->get_product();
		$data['user'] = $user;
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('report/product_report', $data);
		$this->load->view('template/footer');
	}
	
	public function product_report()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'report', 1))
		{
			redirect('user/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('report_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'report';
		$page['sidebar_report_product'] = 'on';
		
		# Get data form
		$data['product'] = $this->input->post('product');
		$data['start'] = date('Y-m-d', strtotime($this->input->post('start')));
		$data['end'] = date('Y-m-d', strtotime($this->input->post('end')));
		$data['product_list'] = $this->report_model->get_generate_product_report($data['start'], $data['end'], $data['product']);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('report/product_report_generated', $data);
		$this->load->view('template/footer');
	}
	
	public function product_pdf()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Load Model connect to database
		$this->load->model('report_model');
		$this->load->library('pdf');
		
		# Get data form
		$data['product'] = $this->uri->segment(4);
		$data['start'] = date('Y-m-d', strtotime($this->uri->segment(5)));
		$data['end'] = date('Y-m-d', strtotime($this->uri->segment(6)));
		$data['product_list'] = $this->report_model->get_generate_product_report($data['start'], $data['end'], $data['product']);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
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
	
}

/* End of file generate.php */
/* Location: ./application/controllers/report/generate.php */