<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class App_log {
	
	public function record($user, $url, $ip_address)
	{
		$CI =& get_instance();
		$CI->load->database();
		$data = array(
			'al_user' => $user['username'],
			'al_url' => $url,
			'al_ip_address' => $ip_address,
		);
		$CI->db->insert('app_log',$data);
	}
}

/* End of file App_log.php */