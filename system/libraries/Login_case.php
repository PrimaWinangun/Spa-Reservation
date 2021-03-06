<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Login_case {
	
	public function login_check($username, $password)
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->load->helper('array');
		$CI->load->helper('url');
		$CI->load->library('encrypt');
		$CI->load->library('session');
		
		$CI->db->where('ur_username', $username);
		$CI->db->where('ur_password', $CI->encrypt->sha1($password, $CI->config->item('encryption_key')));
		$CI->db->limit(1);
		$user = $CI->db->get('user_reservasi');
		$userdata = $user->row();
		
		if ($user->num_rows() > 0)
		{
			@chmod(FCPATH . 'system/log/log_data_'.$userdata->id_user.'.dat', 0777);
			$data = @file_get_contents(FCPATH . 'system/log/log_data_'.$userdata->id_user.'.dat');
			@chmod(FCPATH . 'system/temp/log_data_'.$userdata->id_user.'.dat', 0600);
			
			if ($data != NULL)
			{
				$auth = explode(' ', $data);
			} else {
				return FALSE;
			}
			
			if ($CI->session->userdata('title') != $CI->config->item('app_name'))
			{
				$CI->session->set_userdata('title','System Hijacked');
			}

			$data = array(
						'username' => $userdata->ur_username,
						'level'    => $CI->encrypt->decode($auth[1], $CI->config->item('encryption_key')),
						'position' => $CI->encrypt->decode($auth[2], $CI->config->item('encryption_key')),
						'authority'=> $CI->encrypt->decode($auth[0], $CI->config->item('encryption_key')),
						'email'    => $userdata->ur_email,
						'status'   => $userdata->ur_approved
					);
			$CI->session->set_userdata('log_data', $data);
			return TRUE;
			
		} else {
			return FALSE;
		}
	}
	
	public function sidebar_modul($modul)
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->load->helper('array');
		$CI->load->helper('url');
		
		if ($modul['authority'] > 2)
		{
			$search = "";
		} else {
			$search = $modul['position'];
		}
		$CI->db->select('modul');
		$CI->db->like('position', $search);
		$CI->db->order_by('id_sidebar');
		$CI->db->group_by('modul');
		$sidebar = $CI->db->get('app_sidebar');
		
		return $sidebar->result();
	}
	
	public function sidebar_data($search, $user)
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->load->helper('array');
		$CI->load->helper('url');
		
		if ($user['authority'] > 2)
		{
			$position = "";
		} else {
			$position = $user['position'];
		}
		
		$CI->db->select('sub_modul, sidebar');
		$CI->db->like('modul', $search);
		$CI->db->like('position', $position);
		$CI->db->order_by('modul');
		$CI->db->group_by('sub_modul');
		$sidebar = $CI->db->get('app_sidebar');
		
		return $sidebar->result();
	}
	
	public function register_user($data)
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->load->helper('array');
		$CI->load->helper('url');
		$CI->load->library('encrypt');
		$CI->load->library('session');
		
		$CI->db->insert('user_reservasi', $data);
		
		# create directory if not exist
		$dir = FCPATH . 'system/log/';
		if (!is_dir($dir)){@mkdir($dir);}
		
		write_file(FCPATH . 'system/log/log_data_'.$CI->db->insert_id().'.dat', $data['ur_logon'].' '.$data['ur_level'].' '.$data['ur_position']);
		chmod(FCPATH . 'system/log/log_data_'.$CI->db->insert_id().'.dat', 0600);
	}
	
	public function update_user($id_user, $data)
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->load->helper('array');
		$CI->load->helper('url');
		$CI->load->library('encrypt');
		$CI->load->library('session');
		
		$CI->db->where('id_user', $id_user);
		$CI->db->update('user_reservasi', $data);
		
		@chmod(FCPATH . 'system/log/log_data_'.$id_user.'.dat', 0777);
		write_file(FCPATH . 'system/log/log_data_'.$id_user.'.dat', $data['ur_logon'].' '.$data['ur_level'].' '.$data['ur_position'], 'w');
		@chmod(FCPATH . 'system/temp/log_data_'.$id_user.'.dat', 0600);
	}
	
	public function get_user($modul, $include)
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->load->helper('array');
		
		$CI->db->where('ur_approved', 'yes');
		$data = $CI->db->get('user_reservasi');
		$user = $data->result();
		
		$num = 0;
		
		foreach ($user as $row_user)
		{
			if ($include == 1)
			{
				if ($CI->encrypt->decode($row_user->ur_position, $CI->config->item('encryption_key')) == $modul)
				{
					$data_user[$num] = array('nama' => $row_user->ur_nama, 'username' => $row_user->ur_username);
					$num++;
				}
			}
			
			if ($include == 2)
			{
				if (($CI->encrypt->decode($row_user->ur_position, $CI->config->item('encryption_key')) == $modul) OR 
					($CI->encrypt->decode($row_user->ur_logon, $CI->config->item('encryption_key'))) >= 2)
				{
					$data_user[$num] = array('nama' => $row_user->ur_nama, 'username' => $row_user->ur_username);
					$num++;
				}
			}
			
		}
		
		return $data_user;
	}
	
	public function developer()
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->load->helper('array');
		
		$user = $CI->db->get('user_reservasi');
		$userdata = $user->result();
		$num = 0;
		
		foreach ($userdata as $ud)
		{
			if ($CI->encrypt->decode($ud->ur_level, $CI->config->item('encryption_key')) == 'developer')
			{
				$num++;
			}
		}
		return $num;
	}
}

/* End of file Someclass.php */