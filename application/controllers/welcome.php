<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * The Banjar Bali
	 * Reservation System.
	 * 
	 * App code : app.rsv.alcd
	 * App ver  : 1.0.0
	 *
	 * setting/user controller
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
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'Dashboard';
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('dashboard');
		$this->load->view('template/footer');
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */