<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends My_Login {

	/**
	 * PT Gapura Angkasa
	 * Warehouse Management System.
	 * ver 3.0
	 * 
	 * App id : 
	 * App code : wmsdps
	 *
	 * login controller
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
	} 
	
	public function index()
	{
		if ($this->session->userdata('log_data'))
		{
			$user = $this->session->userdata('log_data');
			if ($user['status'] == 'no')
			{
				# view login form
				$data['message']='User belum di aktivasi, silakan hubungi Admin';
				$data['title'] = $this->session->userdata('title');
				$data['trial'] = $this->session->userdata('trial');
				$this->load->view('user/login', $data);
			} else {
				redirect('welcome');
			}
		}
		else
		{
			# view login form
			$data['message']='';
			$data['title'] = $this->session->userdata('title');
			$data['trial'] = $this->session->userdata('trial');
			$this->load->view('user/login', $data);
		}
	}
	
	public function cek_login()
	{
		# execute login
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		
		
		if($this->login_case->login_check($username, $password) == TRUE)
		{
			$user = $this->session->userdata('log_data');
			if ($user['status'] == 'no')
			{
				# login fail, show login form
				$data['message']='User belum di aktivasi, silakan hubungi Admin';
				$data['title'] = $this->session->userdata('title');
				$data['trial'] = $this->session->userdata('trial');
				$this->load->view('user/login', $data);
			} else {
				redirect('welcome');
			}
		}
		else
		{
			# login fail, show login form
			$data['message']='Masukan username dan password anda dengan benar.';
			$data['title'] = $this->session->userdata('title');
			$data['trial'] = $this->session->userdata('trial');
			$this->load->view('user/login', $data);
		}
		
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */