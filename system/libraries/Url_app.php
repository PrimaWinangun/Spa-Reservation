<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Url_app {
		
	public function create_verification()
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->load->helper('array');
		$CI->load->helper('url');
		$CI->load->library('encrypt');
		$CI->load->library('session');
		
		# Create PIN
		$length = rand(4, 4);
		$use_upper_case=false;
        $selection = '1234567890abcdefghijklmnopqrstuvwxyz';     
        $pin = "";
        for($i=0; $i<$length; $i++) {
            $current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];            
            $pin .=  $current_letter;
        }             
		
		$url = $CI->config->item('app_name');
		$lock = '4189';
		$verification_code = $CI->encrypt->encode($url, $pin);
		
		write_file(FCPATH . 'system/temp/verification.dat', $verification_code);
		write_file(FCPATH . 'verification.txt', $CI->encrypt->encode($pin, $lock));
		chmod(FCPATH . 'system/temp/verification.dat', 0600);
	}
	
	public function upload_verification()
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->load->helper('array');
		$CI->load->helper('url');
		$CI->load->library('encrypt');
		$CI->load->library('session');
		
		@chmod(FCPATH . 'assets/uploads/verification.txt', 0777);
		$code = @file_get_contents(FCPATH . 'assets/uploads/verification.txt');
		
		
		$data = array(
			'url_ver_code' => $code
		);
		$CI->db->where('id_url_app', 1);
		$CI->db->update('url_app', $data);
		
		@unlink(FCPATH . 'assets/uploads/verification.txt');
	}
	
	public function check_verification()
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->load->helper('array');
		$CI->load->helper('url');
		$CI->load->library('encrypt');
		$CI->load->library('session');
		
		$CI->db->limit(1);
		$CI->db->order_by('id_url_app', 'ASC');
		$url_app = $CI->db->get('url_app');
		$validation = $url_app->row();
		
		@chmod(FCPATH . 'system/temp/verification.dat', 0777);
		$verification = @file_get_contents(FCPATH . 'system/temp/verification.dat');
		@chmod(FCPATH . 'system/temp/verification.dat', 0600);
		
		$ver_code = substr($validation->url_ver_code, 5, 4);
		$title = $CI->encrypt->decode($verification, $ver_code);
		
		$sha_title = $CI->encrypt->sha1($title);
		$app_name = $validation->url_app;
		
		if ($sha_title == $app_name)
		{
			$success = $CI->encrypt->sha1('success', $ver_code);
			$data = array(
				'url_verification_end' => $success
			);
			$CI->db->where('id_url_app', 1);
			$CI->db->update('url_app', $data);
			$message = 'verification success';
		} else {
			$message = 'verification failed';
			echo $ver_code;
		}
		
		return $message;
	}
	
	public function application_valid()
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->load->helper('array');
		$CI->load->helper('url');
		$CI->load->library('encrypt');
		$CI->load->library('session');
		
		$CI->db->limit(1);
		$CI->db->order_by('id_url_app', 'ASC');
		$url_app = $CI->db->get('url_app');
		$validation = $url_app->row();
		
		$ver_code = substr($validation->url_ver_code, 5, 4);
		$success = $CI->encrypt->sha1('success', $ver_code);
		
		@chmod(FCPATH . 'system/temp/verification.dat', 0777);
		$verification = @file_get_contents(FCPATH . 'system/temp/verification.dat');
		@chmod(FCPATH . 'system/temp/verification.dat', 0600);
		
		$ver_code = substr($validation->url_ver_code, 5, 4);
		$title = $CI->encrypt->decode($verification, $ver_code);
		$sha_title = $CI->encrypt->sha1($title);
		$app_name = $validation->url_app;
		
		$value = FALSE;
		if ($url_app->num_rows() > 0)
		{
			$date = $validation->url_verification_end;
			$today = date('Y-m-d', now());
			if(($date != $success) && ($sha_title == $app_name))
			{
				if (strtotime($CI->encrypt->decode($date)) >= strtotime($today))
				{
					$value = TRUE;
					
				} else {
					$value = FALSE;
				}
			} else {
				$value = TRUE;
			}
		}
		return $value;
	}
	
	public function check()
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->load->helper('array');
		$CI->load->helper('url');
		$CI->load->library('encrypt');
		$CI->load->library('session');
		
		$CI->db->limit(1);
		$CI->db->order_by('id_url_app', 'ASC');
		$url_app = $CI->db->get('url_app');
		$validation = $url_app->row();
		
		@chmod(FCPATH . 'system/temp/application.dat', 0777);
		@chmod(FCPATH . 'system/temp/application.bak', 0777);
		$url = $CI->encrypt->decode(@file_get_contents(FCPATH . 'system/temp/application.dat'));
		$title = $CI->encrypt->decode(@file_get_contents(FCPATH . 'system/temp/application.bak'));
		@chmod(FCPATH . 'system/temp/application.dat', 0600);
		@chmod(FCPATH . 'system/temp/application.bak', 0600);
		
		$url = $CI->encrypt->sha1($url);
		$title = $CI->encrypt->sha1($title);
		
		$c_app = $CI->encrypt->sha1($CI->config->item('app_name'));
		$c_ip  = $CI->encrypt->sha1($CI->config->item('ip_address'));
		$c_url = $CI->encrypt->sha1($CI->config->item('base_url'));
		$value = FALSE;
		if ($url_app->num_rows() > 0)
		{
			$app_name = $validation->url_app;
			$ip_address = $validation->url_ip_address;
			$app_url = $validation->url_encode;
			$verification = $validation->url_verification_end;
			
			if ($app_name == $c_app && $app_name == $title)
			{
				if ($ip_address == $c_ip)
				{
					if ($app_url == $c_url && $app_url == $url)
					{
						if ($CI->encrypt->sha1('success') != $verification)
						{	
							$CI->session->set_userdata('title', 'Trial Version');
							$CI->session->set_userdata('trial', 'Application Trial Version');
						} else {
							$CI->session->set_userdata('trial', '');
							$CI->session->set_userdata('title', $CI->config->item('app_name'));
						}
						$value = TRUE;
					}
				}
			}
		}
		return $value;
	}
	
	public function lock_app($title)
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->load->helper('array');
		$CI->load->helper('url');
		$CI->load->library('encrypt');
		$CI->load->library('session');
		
		$url = $CI->config->item('base_url');
		$date = date('Y-m-d', now());
		$data = array(
			'url_app' => $CI->encrypt->sha1($title),
			'url_ip_address' => $CI->encrypt->sha1($CI->config->item('ip_address')),
			'url_encode' => $CI->encrypt->sha1($url),
			'url_ver_code' => '',
			'url_verification_end' => $CI->encrypt->encode(date('Y-m-d', strtotime($date. ' + 3 days')))
		);
		$CI->db->truncate('url_app');
		$CI->db->insert('url_app', $data);
		
		# create directory if not exist
		$dir = FCPATH . 'system/temp/';
		if (!is_dir($dir)){@mkdir($dir);}
		
		write_file(FCPATH . 'system/temp/application.dat', $CI->encrypt->encode($url));
		write_file(FCPATH . 'system/temp/application.bak', $CI->encrypt->encode($title));
		chmod(FCPATH . 'system/temp/application.dat', 0600);
		chmod(FCPATH . 'system/temp/application.bak', 0600);
	}
	
	public function available()
	{
		$CI =& get_instance();
		$CI->load->database();
		
		$CI->db->limit(1);
		$CI->db->order_by('id_url_app', 'ASC');
		$url_app = $CI->db->get('url_app');
		
		@chmod(FCPATH . 'system/temp/application.dat', 0777);
		@chmod(FCPATH . 'system/temp/application.bak', 0777);
		$url = $CI->encrypt->decode(@file_get_contents(FCPATH . 'system/temp/application.dat'));
		$title = $CI->encrypt->decode(@file_get_contents(FCPATH . 'system/temp/application.bak'));
		@chmod(FCPATH . 'system/temp/application.dat', 0600);
		@chmod(FCPATH . 'system/temp/application.bak', 0600);
		
		if ($url_app->num_rows() > 0)
		{
			return FALSE;
		} else {
			if (($url != NULL) || $title != NULL)
			{ 
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}
	
	public function auth_limit($user, $modul, $limit)
	{
		if (($user['level'] == 'developer') OR ($user['level'] == 'administrator') OR ($user['level'] == 'officer'))
		{
			if(($user['position'] == $modul) OR ($user['level'] == 'developer') OR ($user['position'] == 'supervisor') OR ($user['position'] == 'manager') OR ($user['position'] == 'administrator') OR ($modul == 'all'))
			{
				if ($user['authority'] >= $limit)
				{
					return TRUE;
				} else {
					return FALSE;
				}
			}
		} else {
			return FALSE;
		}
	}
}

/* End of file Someclass.php */