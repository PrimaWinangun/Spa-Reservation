<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_model extends CI_Model {

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
	 
	 ## Room Category ##
	 public function insert_room_cat($data)
	 {
		$this->db->insert('tbb_category_room', $data); 
	 }
	 	 
	 public function get_data_room_cat()
	 {
		$this->db->where('cat_hide_status','no');
		 $query = $this->db->get('tbb_category_room');
		 return $query->result_array();
	 }	 
	 
	 public function void_room_cat($id)
	 {
		$this->db->where('id_cat_room', $id);
		$this->db->update('tbb_category_room', array('cat_hide_status'=> 'yes'));
	 }
	 	 
	 ## Product Category ##
	 
	 public function get_data_product_cat()
	 {
		$this->db->where('cp_hide_status','no');
		 $query = $this->db->get('tbb_category_product');
		 return $query->result_array();
	 }	 	 
	 
	 public function insert_product_cat($data)
	 {
		$this->db->insert('tbb_category_product', $data); 
	 }
	 
	 public function void_product_cat($id)
	 {
		$this->db->where('id_cat_product',$id);
		$this->db->update('tbb_category_product', array('cp_hide_status'=> 'yes'));
	 }
	 
	 ## Product ##
	 
	 public function insert_product($data)
	 {
		$this->db->insert('tbb_product', $data); 
	 }
	 
	 public function get_data_product()
	 {
		$this->db->where('prod_hide_status','no');
		 $query = $this->db->get('tbb_product');
		 return $query->result_array();
	 }
	 
	 public function void_product($id)
	 {
		$this->db->where('id_cat_prod', $id);
		$this->db->update('tbb_product', array('prod_hide_status'=> 'yes'));
	 }
	 
	 ## Room ##
	 
	 public function insert_room($data)
	 {
		$this->db->insert('tbb_room', $data); 
	 }

	 public function get_data_room()
	 {
		$this->db->where('room_hide_status','no');
		$query = $this->db->get('tbb_room');
		return $query->result_array();
	 }
	 
	 public function void_room_cat($id)
	 {
		$this->db->where('id', $id);
		$this->db->update('tbb_room', array('room_hide_status'=> 'yes'));
	 }
	 
	 ## Therapist ##
	 
	 public function insert_therapist($data)
	 {
		$this->db->insert('tbb_therapist', $data); 
	 }
	 
	 public function get_data_therapist()
	 {
		$this->db->where('thr_hide_status','no');
		$query = $this->db->get('tbb_therapist');
		return $query->result_array();
	 }	

	 public function void_therapist($id)
	 {
		$this->db->where('id_therapist', $id);
		$this->db->update('tbb_category_product', array('thr_hide_status'=> 'yes'));
	 }	 
}
	 