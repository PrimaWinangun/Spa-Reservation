<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

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
		if(!$this->url_app->check())
		{
			$this->url_app->lock_app($this->input->post('title'));
			$this->url_app->create_verification();
			redirect('register/set_developer');
		} else {
			redirect('register/set_developer');
		}
	}
	
	public function set_developer()
	{
		if ($this->login_case->developer() <1 )
		{
			$this->load->view('developer');
		} else {
			redirect('register/upload_verification');
		}
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
			
			redirect('upload_verification');
		} else {
			echo 'failed';
		}
	}
	
	public function upload_verification()
	{
		$this->load->view('upload');
	}
	
	public function do_upload_verification()
	{
		$config['upload_path'] = './assets/uploads/';
		$config['allowed_types'] = 'txt|text';
		$config['max_size']	= '100';
		$config['file_name'] = 'verification';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			print_r($error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			$this->url_app->upload_verification();
			
			$message = $this->url_app->check_verification();
			
			if ($message == 'verification failed')
			{
				echo $message;
			} else {
				redirect('login');
			}
		}
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */