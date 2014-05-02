<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Url_app {
	
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
			
			if ($app_name == $c_app && $app_name == $title)
			{
				if ($ip_address == $c_ip)
				{
					if ($app_url == $c_url && $app_url == $url)
					{
						$CI->session->set_userdata('title', $CI->config->item('app_name'));
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
		$data = array(
			'url_app' => $CI->encrypt->sha1($title),
			'url_ip_address' => $CI->encrypt->sha1($CI->config->item('ip_address')),
			'url_encode' => $CI->encrypt->sha1($url)
		);
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
			if(($user['position'] == $modul) OR ($user['level'] == 'developer') OR ($user['position'] == 'supervisor') OR ($user['position'] == 'manager') OR ($user['position'] == 'administrator'))
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