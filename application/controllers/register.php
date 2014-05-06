<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

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
	public function index()
	{
		if ($this->url_app->available())
		{
			$this->load->view('register');
		} else {
			redirect('login');
		}
	}
	
	public function save_app()
	{
		
		$this->url_app->lock_app($this->input->post('title'));
		
		redirect('register/set_developer');
	}
	
	public function set_developer()
	{
		$this->load->view('developer');
	}
	
	public function save_developer()
	{
		# Form Validation
		$config = array(
               array(
                     'field'   => 'username', 
                     'label'   => 'username', 
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'password', 
                     'label'   => 'password', 
                     'rules'   => 'required|password'
                  ),
               array(
                     'field'   => 'nama', 
                     'label'   => 'nama', 
                     'rules'   => 'required'
                  ), 
			   array(
                     'field'   => 'email', 
                     'label'   => 'email', 
                     'rules'   => 'required|email'
                  ), 
			   array(
                     'field'   => 'telp', 
                     'label'   => 'telp', 
                     'rules'   => 'required|numeric'
                  ),
            );
		$this->form_validation->set_rules($config);
		
		if ($this->form_validation->run() == TRUE)
		{
			$data = array(
					'ur_username' => $this->input->post('username'),
					'ur_password' => $this->encrypt->sha1($this->input->post('password'), $this->config->item('encryption_key')),
					'ur_nama'	  => $this->input->post('nama'),
					'ur_email'	  => $this->input->post('email'),
					'ur_level'	  => $this->encrypt->encode($this->input->post('level'), $this->config->item('encryption_key')),
					'ur_telpon'	  => $this->input->post('telp'),
					'ur_logon'	  => $this->encrypt->encode($this->input->post('auth'), $this->config->item('encryption_key')),
					'ur_position' => $this->encrypt->encode($this->input->post('position'), $this->config->item('encryption_key')),
					'ur_approved' => 'yes',
					'ur_approve_by' => 'first register',
				);
			# Check available developer
			if ($this->login_case->developer() >= 1 )
			{
				redirect('login');
			} else {
				$this->login_case->register_user($data);
			}
			
			redirect('login');
		} else {
			echo 'failed';
		}
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */