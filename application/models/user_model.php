<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	/**
	 * PT Gapura Angkasa
	 * Warehouse Management System.
	 * ver 3.0
	 * 
	 * App id : 
	 * App code : wmsdps
	 *
	 * weighing model
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
	 
	 
	public function get_list_user()
	{
		$query = $this->db->get('user_reservasi');
		return $query->result();
	}
	
	public function get_user_detail($id_user)
	{
		$this->db->where('id_user', $id_user);
		$query = $this->db->get('user_reservasi');
		return $query->row();
	}
	
	public function set_approve_user($user, $approved)
	{
		$this->db->where('id_user', $user);
		$this->db->update('user_reservasi', array('ur_approved'=>'yes', 'ur_approve_by'=> $approved));
	}
	
	public function set_suspend_user($user, $approved)
	{
		$this->db->where('id_user', $user);
		$this->db->update('user_reservasi', array('ur_approved'=>'no', 'ur_approve_by'=> $approved));
	}
}
	 