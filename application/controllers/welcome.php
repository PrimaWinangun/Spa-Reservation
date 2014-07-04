<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends My_Reservation {

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
	} 
	
	public function index()
	{
		# Log Data
		$limit = array('all');
		$user = $this->session_limit($limit, 1);
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'Dashboard';
		$page['sidebar'] = $this->sidebar_set($user['log_data']);
		
		# Application Log
		$this->app_record($user);
		
		#view call
		$this->view_call('dashboard', $page, '');
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */