<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends My_Reservation {

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
		$this->register();
	}
	
	public function register()
	{
		# Load Model
		$this->load->model('user_model');
		
		# Log Data
		$limit = array('setting');
		$user = $this->session_limit($limit, 1);
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'setting';
		$page['sidebar_list_user'] = 'on'; 
		$page['sidebar'] = $this->sidebar_set($user['log_data']);
		
		# Form Data
		$data['auth'] = $user['log_data']['authority'];
		$data['list_user'] = $this->user_model->get_list_user();
		
		# Application Log
		$this->app_record($user);
		
		# View Call
		$this->view_call('user/register', $page, $data);
	}
	
	public function update()
	{
		# Load Model
		$this->load->model('user_model');
		
		# Log Data
		$limit = array('setting');
		$user = $this->session_limit($limit, 1);
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'setting';
		$page['sidebar_list_user'] = 'on'; 
		$page['sidebar'] = $this->sidebar_set($user['log_data']);
		
		# Form Data
		$data['auth'] = $user['log_data']['authority'];
		$data['datauser'] = $this->user_model->get_user_detail($this->uri->segment(4));
		
		# Application Log
		$this->app_record($user);
		
		$this->view_call('user/update', $page, $data);
	}
	
	public function update_user()
	{
		# Load Model
		$this->load->model('user_model');
		$this->load->library('encrypt');
		
		# Log Data
		$limit = array('setting');
		$user = $this->session_limit($limit, 1);
		
		$id_user = $this->input->post('id_user');
		
		if ($this->input->post('password') == NULL)
		{
			$data = array(
				'ur_username' => $this->input->post('username'),
				'ur_nama'	  => $this->input->post('nama'),
				'ur_email'	  => $this->input->post('email'),
				'ur_level'	  => $this->encrypt->encode($this->input->post('level'), $this->config->item('encryption_key')),
				'ur_telpon'	  => $this->input->post('telp'),
				'ur_logon'	  => $this->encrypt->encode($this->input->post('auth'), $this->config->item('encryption_key')),
				'ur_position' => $this->encrypt->encode($this->input->post('position'), $this->config->item('encryption_key')),
			);
		} else {
			$data = array(
				'ur_username' => $this->input->post('username'),
				'ur_password' => $this->encrypt->sha1($this->input->post('password'), $this->config->item('encryption_key')),
				'ur_nama'	  => $this->input->post('nama'),
				'ur_email'	  => $this->input->post('email'),
				'ur_level'	  => $this->encrypt->encode($this->input->post('level'), $this->config->item('encryption_key')),
				'ur_telpon'	  => $this->input->post('telp'),
				'ur_logon'	  => $this->encrypt->encode($this->input->post('auth'), $this->config->item('encryption_key')),
				'ur_position' => $this->encrypt->encode($this->input->post('position'), $this->config->item('encryption_key')),
			);
		}
		
		$this->login_case->update_user($id_user, $data);
			
		# Application Log
		$this->app_record($user);
		
		# Redirect
		redirect('setting/user/register');
	}
	
	public function save_user()
	{
		# Load Model
		$this->load->model('user_model');
		$this->load->library('encrypt');
		
		# Log Data
		$limit = array('setting');
		$user = $this->session_limit($limit, 1);
		
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
				);
			
			$this->login_case->register_user($data);
			
			# Application Log
			$this->app_record($user);
			
			# Redirect
			redirect('setting/user/register');
		} else {
			redirect('setting/user/register');
		}
	}
	
	public function approve_user()
	{
		# Load Model
		$this->load->model('user_model');
		
		# Log Data
		$limit = array('setting');
		$user = $this->session_limit($limit, 3);
		
		$id_user = $this->uri->segment(4);
		
		# Check Developer
		$user_data = $this->user_model->get_user_detail($id_user);
		if ($this->encrypt->decode($user_data->ur_level, $this->config->item('encryption_key')) == 'developer')
		{
			redirect('notice/not_authorized');
		} else {
			$this->user_model->set_approve_user($id_user, $user['log_data']['username']);
		}
		
		# Application Log
		$this->app_record($user);
		
		redirect('setting/user/register');
	}
	
	public function suspend_user()
	{
		# Load Model
		$this->load->model('user_model');
		
		# Log Data
		$limit = array('setting');
		$user = $this->session_limit($limit, 3);
		
		$id_user = $this->uri->segment(4);
		
		# Check Developer
		$user_data = $this->user_model->get_user_detail($id_user);
		if ($this->encrypt->decode($user_data->ur_level, $this->config->item('encryption_key')) == 'developer')
		{
			redirect('notice/not_authorized');
		} else {
			$this->user_model->set_suspend_user($id_user, $user['log_data']['username']);
		}
		
		# Application Log
		$this->app_record($user);
		
		redirect('setting/user/register');
	}
	
	public function approve_developer()
	{
		# Load Model
		$this->load->model('user_model');
		
		# Log Data
		$limit = array('setting');
		$user = $this->session_limit($limit, 4);
		
		$id_user = $this->uri->segment(4);
		$this->user_model->set_approve_user($id_user, $user['log_data']['username']);
		
		# Application Log
		$this->app_record($user);
		
		redirect('setting/user/register');
	}
	
	public function suspend_developer()
	{
		# Load Model
		$this->load->model('user_model');
		
		# Log Data
		$limit = array('setting');
		$user = $this->session_limit($limit, 4);
		
		$id_user = $this->uri->segment(4);
		$this->user_model->set_suspend_user($id_user, $user['log_data']['username']);
		
		# Application Log
		$this->app_record($user);
		
		redirect('setting/user/register');
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */