<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservation extends My_Reservation {

	/**
	 * The Banjar Bali
	 * Reservation System.
	 * 
	 * App code : app.rsv.alcd
	 * App ver  : 1.0.0
	 *
	 * instant/reservation controller
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
		$this->new_reservation();
	}
	
	## --------------- ##
	## NEW RESERVATION ##
	## --------------- ##
	
	public function new_reservation()
	{		
		# Log Data
		$limit = array('cashier');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('instant_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'cashier';
		$page['sidebar_instant_reservation'] = 'on';
		$page['sidebar'] = $this->sidebar_set($user['log_data']);
		
		# Get data Travel
		$data['travel'] = $this->instant_model->get_data_travel();
		$data['res_code'] = $this->instant_model->get_last_res_code();
		$data['list_payment'] = $this->instant_model->get_list_payment();
		
		# Application Log
		$this->app_record($user);
		
		# View call
		$this->view_call('instant/add_new_reservation', $page, $data);
	}
	
	public function insert_reservation()
	{
		# Log Data
		$limit = array('cashier');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('instant_model');
		
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
					'ins_rsv_code' => $this->input->post('res_code'),
					'ins_rsv_date' => mdate('%Y-%m-%d',strtotime($this->input->post('date'))),
					'ins_rsv_agent' => $this->input->post('pic'),
					'ins_rsv_travel' => $this->input->post('travel'),
					'ins_rsv_pax' => $this->input->post('pax'),
					'ins_rsv_update_by' => $userdata['username'],
			);
			
			# Masukkan data ke database melalui model
			$this->instant_model->insert_data_reservasi($data);
			
			# Application Log
			$this->app_record($user);
			
			redirect('instant/reservation/add_detail_pax/'.$this->input->post('res_code'));
		} else {
			redirect('instant/reservation/new_reservation/invalid_input');
		}
	}
	
	public function add_detail_pax()
	{
		# Log Data
		$limit = array('cashier');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('instant_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'cashier';
		$page['sidebar_instant_reservation'] = 'on';
		$page['sidebar'] = $this->sidebar_set($user['log_data']);
		
		# Retrieve Data from Database
		$data['produk'] = $this->instant_model->get_data_produk();
		$data['data_pax'] = $this->instant_model->get_data_pax($this->uri->segment(4));
		$data['reservation'] = $this->instant_model->get_data_reservation($this->uri->segment(4));
		
		$total_pax = $this->instant_model->get_data_reservation($this->uri->segment(4));
		$data['total_pax'] = $total_pax->ins_rsv_pax;
		$data['res_date'] = $total_pax->ins_rsv_date;
		$total_pax = $this->instant_model->total_detail_pax($this->uri->segment(4));
		if ($total_pax == NULL)
		{ $data['detail_total_pax'] = 0; } else { $data['detail_total_pax'] = $total_pax->jum; }
		
		# Application Log
		$this->app_record($user);
		
		#view call
		$this->view_call('instant/add_detail_pax', $page, $data);
	}
	
	public function insert_detail_pax()
	{
		# Log Data
		$limit = array('cashier');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('instant_model');
		
		# Form Validation
		$config = array(
               array(
                     'field'   => 'jum', 
                     'label'   => 'jum', 
                     'rules'   => 'required'
                  )
            );
		$this->form_validation->set_rules($config);
		
		if ($this->form_validation->run() == TRUE)
		{
			# Retrieve data user
			$userdata = $this->session->userdata('log_data');
			
			# Ambil harga dari database
			$product = $this->instant_model->get_detail_product($this->input->post('produk'));

			if ($this->input->post('rupiah') == 'yes')
			{
				$payment = 'rupiah';
			} else { $payment = 'dollar'; }
			$data = array(
					'irpd_rsv_code' => $this->input->post('res_code'),
					'irpd_product' => $product->prod_code,
					'irpd_rate' => $product->prod_rate,
					'irpd_rate_dollar' => $product->prod_rate_dollar,
					'irpd_rate_payment' => $payment,
					'irpd_quantity' => $this->input->post('jum'),
					'irpd_update_by' => $userdata['username'],
			);
			
			# Application Log
			$this->app_record($user);
			$this->instant_model->insert_data_pax($data);
			redirect('instant/reservation/add_detail_pax/'.$this->input->post('res_code'));
		} else {
			redirect('instant/reservation/'.$this->input->post('res_code').'/invalid');
		}
	}
	
	## ---------------------- ##
	## END OF NEW RESERVATION ##
	## ---------------------- ##
	
	## ---------------- ##
	## VOID RESERVATION ##
	## ---------------- ##
	
	public function void_reservation()
	{
		# Log Data
		$limit = array('cashier');
		$user = $this->session_limit($limit, 2);
		
		# Load Model connect to database
		$this->load->model('instant_model');
		
		# Void Data
		$detail = $this->instant_model->get_data_pax($this->uri->segment(4, TRUE));
		
		# Void Data
		$this->instant_model->void_detail_reservation($this->uri->segment(4, TRUE));
		$this->instant_model->void_reservation($this->uri->segment(4, TRUE));
		$this->instant_model->void_reservation_bill($this->uri->segment(4, TRUE));
		
		# Application Log
		$this->app_record($user);
		
		# Redirect
		redirect('instant/reservation/'.$this->uri->segment(5));
	}
	
	public function void_detail_pax()
	{
		# Log Data
		$limit = array('cashier');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('instant_model');
		
		# Void Data
		$this->instant_model->void_detail_reservation_by_id($this->uri->segment(4, TRUE));
		$this->instant_model->void_available_room_by_id($this->uri->segment(4, TRUE));
		
		# Application Log
		$this->app_record($user);
		
		# Redirect
		redirect('instant/reservation/add_detail_pax/'.$this->uri->segment(5));
	}
	
	## ----------------------- ##
	## END OF VOID RESERVATION ##
	## ----------------------- ##
	
	## --------------- ##
	## PAY RESERVATION ##
	## --------------- ##
	
	
	public function pay_reservation()
	{
		# Log Data
		$limit = array('cashier');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('instant_model');
		$this->load->model('payment_model');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'cashier';
		$page['sidebar_instant_reservation'] = 'on';
		$page['sidebar'] = $this->sidebar_set($user['log_data']);
		
		# Masukkan data ke database melalui model
		$rsv = $this->uri->segment(4, TRUE);
		$data['rsv_detail'] = $this->instant_model->search_detail_reservasi($rsv);
		$data['rsv_data'] = $this->instant_model->search_data_reservasi($rsv);
		$data['payment_type'] = $this->instant_model->get_payment_type();
		$data['kurs'] = $this->payment_model->get_last_kurs();
		
		# Application Log
		$this->app_record($user);
		
		#view call
		$this->view_call('instant/payment_detail', $page, $data);
	}
	
	
	public function submit_payment()
	{
		# Log Data
		$limit = array('cashier');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('instant_model');
		
		# Check if already paid
		if ($this->instant_model->get_paid_data($this->input->post('res_code')))
		{
			redirect('cashier/payment/');
		}
		
		# Get Last Reservation Code
		$pay_code = $this->instant_model->get_last_payment_code();
		
		# Data from View
		$data = array(
				'irb_pay_code' => $pay_code,
				'irb_res_code' => $this->input->post('res_code'),
				'irb_quantity' => $this->input->post('quantity'),
				'irb_total' => $this->input->post('rate_dollar'),
				'irb_total_rp' => $this->input->post('rate'),
				'irb_payment_type' => $this->input->post('pay_type'),
				'irb_payment_type_2' => $this->input->post('pay_type_2'),
				'irb_status' => 'open',
				'irb_promo' => $this->input->post('promo'),
				'irb_discount' => $this->input->post('dis_usd'),
				'irb_discount_rp' => $this->input->post('dis_idr'),
				'irb_tax' => $this->input->post('tax_usd'),
				'irb_tax_rp' => $this->input->post('tax_idr'),
				'irb_service' => $this->input->post('serv_usd'),
				'irb_service_rp' => $this->input->post('serv_idr'),
				'irb_isvoid' => 'no',
				'irb_paid_date' => date('Y-m-d', now()),
				'irb_paid_idr' => $this->input->post('grand_idr'),
				'irb_paid_usd' => $this->input->post('grand_usd'),
				'irb_paid_idr_2' => $this->input->post('grand_idr_2'),
				'irb_paid_usd_2' => $this->input->post('grand_usd_2'),
				'irb_rate' => $this->input->post('kurs'),
				'irb_phys_idr' => $this->input->post('fis_idr'),
				'irb_phys_usd' => $this->input->post('fis_usd'),
				'irb_note' => $this->input->post('foc_note'),
				'irb_update_by' => $user['log_data']['username'],
				'irb_transaction_by' => $user['log_data']['username'],
		);
		
		$this->instant_model->insert_data_payment($data);
		$this->instant_model->update_reservation_status($this->input->post('res_code'));
		$this->instant_model->update_res_pax_detail_status($this->input->post('res_code'));
		$this->session->set_flashdata('instant_detail', $data);
		
		# Application Log
		$this->app_record($user);
		
		redirect('instant/reservation/print_interface');
	}
	
	public function reprint_reservation()
	{
		# Log Data
		$limit = array('cashier');
		$user = $this->session_limit($limit, 1);
		
		# Load Model connect to database
		$this->load->model('instant_model');
		
		$payment = $this->instant_model->get_data_reservation_bill($this->uri->segment(4));
		
		# Data from View
		$data = array(
				'irb_pay_code' => $payment->irb_pay_code,
				'irb_res_code' => $payment->irb_res_code,
				'irb_quantity' => $payment->irb_quantity,
				'irb_total' => $payment->irb_total,
				'irb_total_rp' => $payment->irb_total_rp,
				'irb_payment_type' => $payment->irb_payment_type,
				'irb_payment_type_2' => $payment->irb_payment_type_2,
				'irb_status' => $payment->irb_status,
				'irb_promo' => $payment->irb_promo,
				'irb_discount' => $payment->irb_discount,
				'irb_discount_rp' => $payment->irb_discount_rp,
				'irb_tax' => $payment->irb_tax,
				'irb_tax_rp' => $payment->irb_tax_rp,
				'irb_service' => $payment->irb_service,
				'irb_service_rp' => $payment->irb_service_rp,
				'irb_isvoid' => 'no',
				'irb_paid_date' => $payment->irb_paid_date,
				'irb_paid_idr' => $payment->irb_paid_idr,
				'irb_paid_usd' => $payment->irb_paid_usd,
				'irb_paid_idr_2' => $payment->irb_paid_idr_2,
				'irb_paid_usd_2' => $payment->irb_paid_usd_2,
				'irb_instant_pay' => '',
				'irb_update_by' => $user['log_data']['username'],
				'irb_transaction_by' => $user['log_data']['username'],
		);
		
		$this->session->set_flashdata('instant_detail', $data);
		
		# Application Log
		$this->app_record($user);
		
		redirect('instant/reservation/print_interface');
	}
	
	public function print_interface()
	{
		$this->session->keep_flashdata('instant_detail');
		
		$this->load->view('instant/script/print_interface');
		
		$this->output->set_header('refresh:1;url=new_reservation');
	}
	
	public function print_payment()
	{
		# Log Data
		$limit = array('cashier');
		$user = $this->session_limit($limit, 1);
		
		# Get data from session
		$payment = $this->session->flashdata('instant_detail');
		
		# Model Call
		$this->load->model('instant_model','', TRUE);
		$content['title'] = $this->session->userdata('title');
		$content['res_code'] = $payment['irb_res_code'];			
		$content['pay_code'] = $payment['irb_pay_code'];			
		$content['data_pax'] = $this->instant_model->search_detail_reservasi($payment['irb_res_code']);
		$content['data_pay'] = $payment;
		
		# Application Log
		$this->app_record($user);
		
		$html = '';
		$html .= $this->load->view('instant/print/billing',$content, true);
		$this->load->view('instant/print/billing',$content, true);
		
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
		$pdf->Output('Payment-Instant.pdf', 'I');
		
		redirect('instant/reservation/new_reservation');
	}
	
	## ---------------------- ##
	## END OF PAY RESERVATION ##
	## ---------------------- ##
	
	
	
}

/* End of file payment.php */
/* Location: ./application/controllers/cashier/payment.php */