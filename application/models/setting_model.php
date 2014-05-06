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
		 $query = $this->db->get('tbb_category_room');
		 return $query->result_array();
	 }
	 
	 public function get_detail_room_cat($id)
	 {
		$this->db->where('id_cat_room', $id);
		 $query = $this->db->get('tbb_category_room');
		 return $query->row();
	 }	 
	 
	 public function update_room_cat($id, $data)
	 {
		$this->db->where('id_cat_room', $id);
		$this->db->update('tbb_category_room', $data);
	 }
	 
	 public function void_room_cat($id)
	 {
		$this->db->where('id_cat_room', $id);
		$this->db->update('tbb_category_room', array('cat_hide_status'=> 'yes'));
	 }
	 
	 public function show_room_cat($id)
	 {
		$this->db->where('id_cat_room', $id);
		$this->db->update('tbb_category_room', array('cat_hide_status'=> 'no'));
	 }
	 	 
	 ## Product Category ##
	 
	 public function get_data_product_cat()
	 {
		 $query = $this->db->get('tbb_category_product');
		 return $query->result_array();
	 }	  
	 
	 public function get_detail_product_cat($id)
	 {
		$this->db->where('id_cat_product',$id);
		 $query = $this->db->get('tbb_category_product');
		 return $query->row();
	 }	 	 
	 
	 public function insert_product_cat($data)
	 {
		$this->db->insert('tbb_category_product', $data); 
	 }
	 
	 public function update_product_cat($id, $data)
	 {
		$this->db->where('id_cat_product',$id);
		$this->db->update('tbb_category_product', $data);
	 }
	 
	 public function void_product_cat($id)
	 {
		$this->db->where('id_cat_product',$id);
		$this->db->update('tbb_category_product', array('cp_hide_status'=> 'yes'));
	 }
	 public function show_product_cat($id)
	 {
		$this->db->where('id_cat_product',$id);
		$this->db->update('tbb_category_product', array('cp_hide_status'=> 'no'));
	 }
	 
	 ## Product ##
	 
	 public function insert_product($data)
	 {
		$this->db->insert('tbb_product', $data); 
	 }
	 
	 public function get_data_product_cat_unhide()
	 {
		$this->db->where('cp_hide_status', 'no');
		 $query = $this->db->get('tbb_category_product');
		 return $query->result_array();
	 }	
	 
	 public function get_data_product($page, $offset)
	 {
		$this->db->limit($page, $offset);
		 $query = $this->db->get('tbb_product');
		 return $query->result_array();
	 }
	 
	 public function count_product()
	 {
		$query = $this->db->get('tbb_product');
		return $query->num_rows();
	 }
	 
	 public function get_detail_product($id)
	 {
		$this->db->where('id_prod', $id);
		 $query = $this->db->get('tbb_product');
		 return $query->row();
	 }
	 
	 public function update_product($id, $data)
	 {
		$this->db->where('id_prod', $id);
		$this->db->update('tbb_product', $data);
	 }
	 
	 public function void_product($id)
	 {
		$this->db->where('id_prod', $id);
		$this->db->update('tbb_product', array('prod_hide_status'=> 'yes'));
	 }
	 
	 public function show_product($id)
	 {
		$this->db->where('id_prod', $id);
		$this->db->update('tbb_product', array('prod_hide_status'=> 'no'));
	 }
	 
	 ## Room ##
	 
	 public function insert_room($data)
	 {
		$this->db->insert('tbb_room', $data); 
	 }

	 public function get_data_room($page, $offset)
	 {
		$this->db->limit($page, $offset);
		$query = $this->db->get('tbb_room');
		return $query->result_array();
	 }
	 
	 public function get_data_room_cat_unhide()
	 {
		$this->db->where('cat_hide_status', 'no');
		 $query = $this->db->get('tbb_category_room');
		 return $query->result_array();
	 }
	 
	 public function get_detail_room($id)
	 {
		$this->db->where('id', $id);
		$query = $this->db->get('tbb_room');
		return $query->row();
	 }
	 
	 public function count_room()
	 {
		$query = $this->db->get('tbb_room');
		return $query->num_rows();
	 }
	 
	 public function update_room($id, $data)
	 {
		$this->db->where('id', $id);
		$this->db->update('tbb_room', $data);
	 }
	 
	 public function void_room($id)
	 {
		$this->db->where('id', $id);
		$this->db->update('tbb_room', array('room_hide_status'=> 'yes'));
	 }
	 
	 public function show_room($id)
	 {
		$this->db->where('id', $id);
		$this->db->update('tbb_room', array('room_hide_status'=> 'no'));
	 }
	 
	 ## Therapist ##
	 
	 public function insert_therapist($data)
	 {
		$this->db->insert('tbb_therapist', $data); 
	 }
	 
	 public function get_data_therapist($page, $offset)
	 {
		$this->db->limit($page, $offset);
		$query = $this->db->get('tbb_therapist');
		return $query->result_array();
	 }	
	 
	 public function count_therapist()
	 {
		$query = $this->db->get('tbb_therapist');
		return $query->num_rows();
	 }	
	 
	 public function get_detail_therapist($id)
	 {
		$this->db->where('id_therapist', $id);
		$query = $this->db->get('tbb_therapist');
		return $query->row();
	 }	

	 public function update_therapist($id, $data)
	 {
		$this->db->where('id_therapist', $id);
		$this->db->update('tbb_therapist', $data);
	 }	
	 
	 public function void_therapist($id)
	 {
		$this->db->where('id_therapist', $id);
		$this->db->update('tbb_therapist', array('thr_hide_status'=> 'yes'));
	 }	
	 
	 public function show_therapist($id)
	 {
		$this->db->where('id_therapist', $id);
		$this->db->update('tbb_therapist', array('thr_hide_status'=> 'no'));
	 }	 
	 
	 ## Travel ##
	 
	 public function insert_travel($data)
	 {
		$this->db->insert('tbb_travel', $data); 
	 }
	 
	 public function get_data_travel($page, $offset)
	 {
		$this->db->limit($page, $offset);
		$query = $this->db->get('tbb_travel');
		return $query->result_array();
	 }	  
	 
	 public function count_travel()
	 {
		$query = $this->db->get('tbb_travel');
		return $query->num_rows();
	 }	 
	 
	 public function get_detail_travel($id)
	 {
		$this->db->where('id_travel', $id);
		$query = $this->db->get('tbb_travel');
		return $query->row();
	 }	

	 public function update_travel($id, $data)
	 {
		$this->db->where('id_travel', $id);
		$this->db->update('tbb_travel', $data);
	 }	
	 
	 public function void_travel($id)
	 {
		$this->db->where('id_travel', $id);
		$this->db->update('tbb_travel', array('trv_hide_status'=> 'yes'));
	 }	
	 
	 public function show_travel($id)
	 {
		$this->db->where('id_travel', $id);
		$this->db->update('tbb_travel', array('trv_hide_status'=> 'no'));
	 }	 
	 
	 ## Payment Type ##
	 
	 public function insert_payment($data)
	 {
		$this->db->insert('tbb_payment_type', $data); 
	 }
	 
	 public function get_data_payment()
	 {
		$query = $this->db->get('tbb_payment_type');
		return $query->result_array();
	 }	 
	 
	 public function get_detail_payment($id)
	 {
		$this->db->where('id_pay_type', $id);
		$query = $this->db->get('tbb_payment_type');
		return $query->row();
		return $query->row();
	 }	

	 public function update_payment($id, $data)
	 {
		$this->db->where('id_pay_type', $id);
		$this->db->update('tbb_payment_type', $data);
	 }	 
	 
	 public function void_payment($id)
	 {
		$this->db->where('id_pay_type', $id);
		$this->db->update('tbb_payment_type', array('pay_hide_status'=> 'yes'));
	 }	 
	 
	 public function show_payment($id)
	 {
		$this->db->where('id_pay_type', $id);
		$this->db->update('tbb_payment_type', array('pay_hide_status'=> 'no'));
	 }	 
}
	 