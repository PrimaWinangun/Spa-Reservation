<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class App_log {
	
	public function record($user, $url)
	{
		$CI =& get_instance();
		$CI->load->database();
		$data = array(
			'al_user' => $user,
			'al_url' => $url,
		);
		$CI->db->insert('app_log',$data);
	}
}

/* End of file App_log.php */