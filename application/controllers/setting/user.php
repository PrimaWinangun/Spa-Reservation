<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

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
		
		if (! $this->url_app->check())
		{
			if ($this->url_app->available())
			{
				redirect('register');
			} else {
				redirect('invalid');
			}
		}
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
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'setting', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'setting';
		$page['sidebar_list_user'] = 'on';
		
		# Form Data
		$data['auth'] = $user['authority'];
		$data['list_user'] = $this->user_model->get_list_user();
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('user/register', $data);
		$this->load->view('template/footer');
	}
	
	public function update()
	{
		# Load Model
		$this->load->model('user_model');
		
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'setting', 1))
		{
			redirect('notice/not_authorized');
		}
		
		# Page Data
		$page['page_title'] = $this->session->userdata('title');
		$page['modul'] = 'setting';
		$page['sidebar_list_user'] = 'on';
		
		# Form Data
		$data['auth'] = $user['authority'];
		$data['datauser'] = $this->user_model->get_user_detail($this->uri->segment(4));
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		$this->load->view('template/header', $page);
		$this->load->view('template/sidebar');
		$this->load->view('template/breadcumb');
		$this->load->view('user/update', $data);
		$this->load->view('template/footer');
	}
	
	public function update_user()
	{
		# Load Model
		$this->load->model('user_model');
		$this->load->library('encrypt');
		
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'setting', 1))
		{
			redirect('notice/not_authorized');
		}
		
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
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		# Redirect
		redirect('setting/user/register');
	}
	
	public function save_user()
	{
		# Load Model
		$this->load->model('user_model');
		$this->load->library('encrypt');
		
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'setting', 1))
		{
			redirect('notice/not_authorized');
		}
		
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
			$this->app_log->record($user['username'], $this->uri->uri_string());
			
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
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'setting', 3))
		{
			redirect('notice/not_authorized');
		}
		
		$id_user = $this->uri->segment(4);
		
		# Check Developer
		$user_data = $this->user_model->get_user_detail($id_user);
		if ($this->encrypt->decode($user_data->ur_level, $this->config->item('encryption_key')) == 'developer')
		{
			redirect('notice/not_authorized');
		} else {
			$this->user_model->set_approve_user($id_user, $user['username']);
		}
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/user/register');
	}
	
	public function suspend_user()
	{
		# Load Model
		$this->load->model('user_model');
		
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'setting', 3))
		{
			redirect('notice/not_authorized');
		}
		
		$id_user = $this->uri->segment(4);
		
		# Check Developer
		$user_data = $this->user_model->get_user_detail($id_user);
		if ($this->encrypt->decode($user_data->ur_level, $this->config->item('encryption_key')) == 'developer')
		{
			redirect('notice/not_authorized');
		} else {
			$this->user_model->set_suspend_user($id_user, $user['username']);
		}
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/user/register');
	}
	
	public function approve_developer()
	{
		# Load Model
		$this->load->model('user_model');
		
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'setting', 4))
		{
			redirect('notice/not_authorized');
		}
		
		$id_user = $this->uri->segment(4);
		$this->user_model->set_approve_user($id_user, $user['username']);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/user/register');
	}
	
	public function suspend_developer()
	{
		# Load Model
		$this->load->model('user_model');
		
		# Log Data
		$user = $this->session->userdata('log_data');
		
		# Authentication Limit
		if (!$this->url_app->auth_limit($user, 'setting', 4))
		{
			redirect('notice/not_authorized');
		}
		
		$id_user = $this->uri->segment(4);
		$this->user_model->set_suspend_user($id_user, $user['username']);
		
		# Application Log
		$this->app_log->record($user['username'], $this->uri->uri_string());
		
		redirect('setting/user/register');
	}
	
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */