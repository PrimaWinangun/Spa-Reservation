<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {

	/**
	 * The Banjar Bali
	 * Reservation System.
	 * 
	 * App code : app.rsv.alcd
	 * App ver  : 1.0.0
	 *
	 * cashier/payment controller
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
		$this->new_payment();
	}
	
	## ----------- ##
	## NEW PAYMENT ##
	## ----------- ##
	
	public function new_payment()
	{		
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'cashier', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model
		$this->load->model('payment_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'cashier';
		$page['sidebar_new_payment'] = 'on';
		
		# Pagination Config
		$config['base_url'] = base_url().'index.php/cashier/payment/new_payment/'; //set the base url for pagination
		$config['total_rows'] = $this->payment_model->count_reservation(); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 4; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$pagination = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		# Get data Travel
		$data['res_list'] = $this->payment_model->get_reservation_list($config['per_page'], $pagination);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/add_new_payment', $data);
		$this->load->view('template/footer');
	}
	
	public function search_reservation()
	{		
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'cashier', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model
		$this->load->model('payment_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'cashier';
		$page['sidebar_new_payment'] = 'on';
		
		# Search Input Post
		if ($this->input->post('res_code') != NULL)
		{
			$this->session->set_flashdata('search_pay', $this->input->post('res_code'));
			$search = $this->input->post('res_code');
		} else { 
			$search = $this->session->flashdata('search_pay');
			$this->session->keep_flashdata('search_pay');
		}
		
		# Pagination Config
		$config['base_url'] = base_url().'index.php/cashier/payment/search_reservation/'; //set the base url for pagination
		$config['total_rows'] = $this->payment_model->count_reservation_search($search); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 4; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$pagination = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		# Get data Travel
		$data['res_list'] = $this->payment_model->get_reservation_list_search($search, $config['per_page'], $pagination);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/add_new_payment', $data);
		$this->load->view('template/footer');
	}
	
	public function pay_reservation()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'cashier', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('payment_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'cashier';
		$page['sidebar_new_payment'] = 'on';
		
		# Masukkan data ke database melalui model
		$rsv = $this->uri->segment(4, TRUE);
		$data['rsv_detail'] = $this->payment_model->search_detail_reservasi($rsv);
		$data['rsv_data'] = $this->payment_model->search_data_reservasi($rsv);
		$data['payment_type'] = $this->payment_model->get_payment_type();
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/payment_detail',$data);
		$this->load->view('template/footer');
	}
	
	public function reprint_reservation()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'cashier', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('payment_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'cashier';
		$page['sidebar_new_payment'] = 'on';
		
		# Masukkan data ke database melalui model
		$rsv = $this->uri->segment(4, TRUE);
		$data['rsv_detail'] = $this->payment_model->search_detail_reservasi($rsv);
		$data['rsv_data'] = $this->payment_model->search_data_reservasi($rsv);
		$data['pay_detail'] = $this->payment_model->search_detail_payment($rsv);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/reprint_payment_detail',$data);
		$this->load->view('template/footer');
	}
	
	public function submit_payment()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'cashier', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('payment_model');
		
		# Check if already paid
		if ($this->payment_model->get_paid_data($this->input->post('res_code')))
		{
			redirect('cashier/payment/');
		}
		
		# Get Last Reservation Code
		$pay_code = $this->payment_model->get_last_payment_code();
		
		# Data from View
		$data = array(
				'rb_pay_code' => $pay_code,
				'rb_res_code' => $this->input->post('res_code'),
				'rb_quantity' => $this->input->post('quantity'),
				'rb_total' => $this->input->post('rate_dollar'),
				'rb_total_rp' => $this->input->post('rate'),
				'rb_payment_type' => $this->input->post('pay_type'),
				'rb_payment_type_2' => $this->input->post('pay_type_2'),
				'rb_status' => 'close',
				'rb_promo' => $this->input->post('promo'),
				'rb_discount' => $this->input->post('dis_usd'),
				'rb_discount_rp' => $this->input->post('dis_idr'),
				'rb_tax' => $this->input->post('tax_usd'),
				'rb_tax_rp' => $this->input->post('tax_idr'),
				'rb_service' => $this->input->post('serv_usd'),
				'rb_service_rp' => $this->input->post('serv_idr'),
				'rb_isvoid' => 'no',
				'rb_paid_date' => date('Y-m-d', now()),
				'rb_paid_idr' => $this->input->post('grand_idr'),
				'rb_paid_usd' => $this->input->post('grand_usd'),
				'rb_paid_idr_2' => $this->input->post('grand_idr_2'),
				'rb_paid_usd_2' => $this->input->post('grand_usd_2'),
				'rb_update_by' => $user['username'],
				'rb_transaction_by' => $user['username'],
		);
		
		$this->payment_model->insert_data_payment($data);
		$this->session->set_flashdata('payment_detail', $data);
		$this->payment_model->update_reservation_status($this->input->post('res_code'));
		$detail = $this->payment_model->get_data_pax($this->input->post('res_code'));
		foreach ($detail as $row_detail)
		{
			$this->payment_model->update_room_available($row_detail['id_rpd']);
		}
		$this->payment_model->update_res_pax_detail_status($this->input->post('res_code'));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('cashier/payment/print_interface');
	}
	
	public function reprint_payment()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'cashier', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('payment_model');
		
		# Get Last Reservation Code
		$pay_code = $this->payment_model->get_last_payment_code();
		
		# Data from View
		$data = array(
				'rb_pay_code' => $pay_code,
				'rb_res_code' => $this->input->post('res_code'),
				'rb_quantity' => $this->input->post('quantity'),
				'rb_total' => $this->input->post('rate_dollar'),
				'rb_total_rp' => $this->input->post('rate'),
				'rb_payment_type' => $this->input->post('pay_type'),
				'rb_payment_type_2' => $this->input->post('pay_type_2'),
				'rb_status' => 'close',
				'rb_promo' => $this->input->post('promo'),
				'rb_discount' => $this->input->post('dis_usd'),
				'rb_discount_rp' => $this->input->post('dis_idr'),
				'rb_tax' => $this->input->post('tax_usd'),
				'rb_tax_rp' => $this->input->post('tax_idr'),
				'rb_service' => $this->input->post('serv_usd'),
				'rb_service_rp' => $this->input->post('serv_idr'),
				'rb_isvoid' => 'no',
				'rb_paid_date' => date('Y-m-d', now()),
				'rb_paid_idr' => $this->input->post('grand_idr'),
				'rb_paid_usd' => $this->input->post('grand_usd'),
				'rb_paid_idr_2' => $this->input->post('grand_idr_2'),
				'rb_paid_usd_2' => $this->input->post('grand_usd_2'),
				'rb_update_by' => $user['username'],
				'rb_transaction_by' => $user['username'],
		);
		
		$this->session->set_flashdata('payment_detail', $data);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('cashier/payment/print_interface');
	}
	
	public function print_interface()
	{
		$this->session->keep_flashdata('payment_detail');
		
		$this->load->view('cashier/script/print_interface');
		
		$this->output->set_header('refresh:1;url=new_payment');
	}
	
	public function print_payment()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Get data from session
		$payment = $this->session->flashdata('payment_detail');
		
		# Model Call
		$this->load->model('payment_model','', TRUE);
		$content['title'] = $this->session->userdata('title');
		$content['res_code'] = $payment['rb_res_code'];			
		$content['pay_code'] = $payment['rb_pay_code'];			
		$content['data_pax'] = $this->payment_model->search_detail_reservasi($payment['rb_res_code']);
		$content['data_pay'] = $payment;
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		$html = '';
		$html .= $this->load->view('cashier/print/billing',$content, true);
		
		$this->load->view('cashier/print/billing',$content);
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		
		$pdf->SetTitle('The Banjar Bali');
		$pdf->SetAutoPageBreak(false);
		$pdf->SetAuthor('Prima Winangun');
		$pdf->SetDisplayMode('real', 'default');
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$pdf->SetMargins(0, 0, 0);
		$pdf->AddPage();
		
		$pdf->writeHTML($html, true, false, true, false, '');
			
		$pdf->lastPage();
		$pdf->Output('Payment-Bill.pdf', 'I');
		
		redirect('cashier/payment/new_payment');
	}
	
	## ------------------ ##
	## END OF NEW PAYMENT ##
	## ------------------ ##
	
	## ------------ ##
	## PAYMENT LIST ##
	## ------------ ##
	
	public function payment_list()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'cashier', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('payment_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'cashier';
		$page['sidebar_list_payment'] = 'on';
		
		# Pagination Config
		$config['base_url'] = base_url().'index.php/cashier/payment/payment_list/'; //set the base url for pagination
		$config['total_rows'] = $this->payment_model->count_payment(); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 4; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$pagination = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		# Get data Travel
		$data['pay_list'] = $this->payment_model->get_payment_list($config['per_page'], $pagination);
		$data['code'] = '';
		$data['date'] = date('d-m-Y', now());
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/payment_list', $data);
		$this->load->view('template/footer');
	}
	
	public function payment_list_search()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'cashier', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('payment_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'cashier';
		$page['sidebar_list_payment'] = 'on';
		
		# Search Input Post
		if ($this->input->post('pay_code') != NULL)
		{
			$this->session->set_flashdata('search_payment', $this->input->post('pay_code'));
			$search = $this->input->post('pay_code');
		} else { 
			$search = $this->session->flashdata('search_payment');
			$this->session->keep_flashdata('search_payment');
		}
		
		# Pagination Config
		$config['base_url'] = base_url().'index.php/cashier/payment/payment_list_search/'; //set the base url for pagination
		$config['total_rows'] = $this->payment_model->count_payment_search($search); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 4; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$pagination = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		# Get data Travel
		$data['pay_list'] = $this->payment_model->get_payment_list_search($search, $config['per_page'], $pagination);
		$data['code'] = $search;
		$data['date'] = date('d-m-Y', now());
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/payment_list', $data);
		$this->load->view('template/footer');
	}
	
	public function payment_list_date_search()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'cashier', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('payment_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'cashier';
		$page['sidebar_list_payment'] = 'on';
		
		# Search Input Post
		if ($this->input->post('pay_date') != NULL)
		{
			$this->session->set_flashdata('search_date', date('Y-m-d', strtotime($this->input->post('pay_date'))));
			$search = date('Y-m-d', strtotime($this->input->post('pay_date')));
		} else { 
			$search = $this->session->flashdata('search_date');
			$this->session->keep_flashdata('search_date');
		}
		
		# Pagination Config
		$config['base_url'] = base_url().'index.php/cashier/payment/payment_list_date_search/'; //set the base url for pagination
		$config['total_rows'] = $this->payment_model->count_payment_search_date($search); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 4; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$pagination = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		# Get data Travel
		$data['pay_list'] = $this->payment_model->get_payment_list_search_date($search, $config['per_page'], $pagination);
		$data['code'] = '';
		$data['date'] = $search;
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/payment_list', $data);
		$this->load->view('template/footer');
	}
	
	## ------------------- ##
	## END OF PAYMENT LIST ##
	## ------------------- ##
	
	## -------------- ##
	## PAYMENT REPORT ##
	## -------------- ##
	
	public function payment_report()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'cashier', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('payment_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'cashier';
		$page['sidebar_payment_report'] = 'on';
		
		# Get data Travel
		$data['list_user'] = $this->login_case->get_user('cashier', 2);
		$data['user'] = $user;
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/payment_report', $data);
		$this->load->view('template/footer');
	}
	
	public function generate_payment_report()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'cashier', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('payment_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'cashier';
		$page['sidebar_payment_report'] = 'on';
		
		# Get data form
		$data['payment'] = $this->input->post('pay_type');
		$data['user'] = $this->input->post('user');
		$data['pay_list'] = $this->payment_model->get_generate_report($data['payment'], $data['user']);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		#view call
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('cashier/payment_report_generated', $data);
		$this->load->view('template/footer');
	}
	
	public function payment_report_pdf()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Load Model connect to database
		$this->load->model('payment_model');
		$this->load->library('pdf');
		
		# Get data form
		$data['payment'] = $this->uri->segment(4);
		$data['user'] = $this->uri->segment(5);
		$data['start'] = date('Y-m-d', strtotime($this->uri->segment(6)));
		$data['pay_list'] = $this->payment_model->get_generate_report($data['payment'], $data['user']);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		# Load Helper PDF
		$this->load->helper('sigap_pdf');
		
		# PDF Maker
		$stream = TRUE; 
		$papersize = 'A4'; 
		$orientation = 'landscape';
		$filename = 'Daily-Payment-Report-'.date('dM', strtotime($data['start'])).'-'.$data['payment'].'-'.$data['user'];
		$data['filename'] = $filename . '.pdf';
		$stn = 'dps';
		$html = $this->load->view('cashier/print/payment',$data, true); 
		pdf_create($html, $filename, $stream, $papersize, $orientation, $stn);
	}
	
	## --------------------- ##
	## END OF PAYMENT REPORT ##
	## --------------------- ##
	
	## ------------- ##
	## VOID PAYMMENT ##
	## ------------- ##
	
	public function void_payment()
	{
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'cashier', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Load Model connect to database
		$this->load->model('payment_model');
		
		# Update Database
		$rsv_code = $this->uri->segment(4);
		$this->payment_model->void_data_payment($rsv_code);
		$this->payment_model->update_reservation_status_open($rsv_code);
		$detail = $this->payment_model->get_data_pax($rsv_code);
		foreach ($detail as $row_detail)
		{
			$this->payment_model->update_room_available_open($row_detail['id_rpd']);
		}
		$this->payment_model->update_res_pax_detail_status_open($rsv_code);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('cashier/payment/new_payment');
	}
	
	## -------------------- ##
	## END OF VOID PAYMMENT ##
	## -------------------- ##
	
}

/* End of file payment.php */
/* Location: ./application/controllers/cashier/payment.php */