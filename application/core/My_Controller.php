<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_Reservation extends CI_Controller {

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
	
	public function session_limit($modul, $auth)
	{
		$user = $this->session->all_userdata();
		$pass = 0;
		
		foreach ($modul as $row)
		{
			if($this->url_app->auth_limit($user['log_data'], $row, $auth))
			{
				$pass = $pass + 1;
			}
		}
		
		if ($pass < 1)
		{
			redirect('notice/not_authorized');
		}
		
		return $user;
	}
	
	
	public function sidebar_set($modul)
	{
		$data['modul'] = $this->login_case->sidebar_modul($modul);
		foreach ($data['modul'] as $row)
		{
			$data[$row->modul] = $this->login_case->sidebar_data($row->modul, $modul);
		}
		return $data;
	}
	
	public function view_call($page, $detail, $content)
	{
		$this->load->view('template/header', $detail);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view($page, $content);
		$this->load->view('template/footer');
	}
	
	public function app_record($user)
	{
		$this->app_log->record($user['log_data'], $this->uri->uri_string(), $user['ip_address']);
	}
}

class My_Login extends CI_Controller {

	function __construct()
	{
        parent::__construct();

			if (! $this->url_app->check())
			{
				if ($this->url_app->available())
				{
					redirect('register');
				} else {
					redirect('invalid');
				}
			}else 
			if(! $this->url_app->application_valid())
			{
					redirect('invalid');
			}
	} 
	
}
/* End of file payment.php */
/* Location: ./application/controllers/cashier/payment.php */