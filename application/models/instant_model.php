<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instant_model extends CI_Model {

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
	 
	 ## INSERT DATA ##
	 
	 public function insert_data_reservasi($data)
	 {
		$this->db->insert('tbb_instant_reservation', $data); 
	 }
	 
	 public function insert_data_pax($data)
	 {
		$this->db->insert('tbb_instant_rsv_pax_detail', $data); 
	 }
	 
	 public function insert_data_payment($data)
	 {
		$this->db->insert('tbb_instant_rsv_bill', $data); 
	 }
	 
	 ## END INSERT DATA ##
	 
	 ## GET DATA ##
	 
	 public function get_data_produk()
	 {
		$this->db->where('prod_hide_status','no');
		 $query = $this->db->get('tbb_product');
		 return $query->result_array();
	 }
	 
	 public function get_data_travel()
	 {
		$this->db->where('trv_hide_status','no');
		 $query = $this->db->get('tbb_travel');
		 return $query->result_array();
	 }
	 
	 public function get_data_pax($pax)
	 {
		 $this->db->where('irpd_rsv_code', $pax);
		 $query = $this->db->get('tbb_instant_rsv_pax_detail');
		 return $query->result_array();
	 }
	 
	 public function get_data_pax_by_id($pax)
	 {
		 $this->db->where('id_rpd', $pax);
		 $this->db->join('tbb_reservasi', 'tbb_reservasi.res_code = tbb_reservasi_pax_detail.rpd_res_id');
		 $query = $this->db->get('tbb_reservasi_pax_detail');
		 return $query->result();
	 }
	 
	 public function get_paid_data($res_code)
	 {
		$this->db->where('irb_res_code', $res_code);
		$this->db->where('irb_isvoid', 'no');
		$this->db->order_by('id_ins_rsv_bill', 'DESC');
		$query = $this->db->get('tbb_instant_rsv_bill');
		
		if($query->num_rows() >= 1)
		{ return TRUE; } else { return FALSE; }
	 }
	 
	 public function total_detail_pax($pax)
	 {
		$this->db->select('SUM(`irpd_quantity`) AS `jum`');
		$this->db->where('irpd_rsv_code', $pax);
		$this->db->where('irpd_status != ', 'void');
		$this->db->group_by('irpd_rsv_code');
		 $query = $this->db->get('tbb_instant_rsv_pax_detail');
		 return $query->row();
	 }
	 
	 public function get_detail_product($id_prod)
	 {
		 $this->db->where('id_prod', $id_prod);
		 $query = $this->db->get('tbb_product');
		 return $query->row();
	 }
	 
	 public function get_data_reservation($res_code)
	 {
		$this->db->where('ins_rsv_code', $res_code);
		$query = $this->db->get('tbb_instant_reservation');
		return $query->row();
	 }
	 
	 public function get_data_reservation_bill($res_code)
	 {
		$this->db->where('irb_res_code', $res_code);
		$query = $this->db->get('tbb_instant_rsv_bill');
		return $query->row();
	 }
	 
	 public function get_list_payment()
	 {
		$this->db->where('irb_isvoid', 'no');
		$this->db->where('irb_status', 'open');
		$this->db->where('ins_rsv_status !=', 'open');
		$this->db->join('tbb_instant_reservation', 'ins_rsv_code = irb_res_code');
		$query = $this->db->get('tbb_instant_rsv_bill');
		return $query->result_array();
	 }
	 
	 public function get_payment_type()
	 {
		$this->db->where('pay_hide_status', 'no');
		$query = $this->db->get('tbb_payment_type');
		
		return $query->result();
	 }
	 
	 
	 public function get_last_res_code()
	 {	
		 $rsv = 'TBB-INS'.mdate('%m%y', time());
		 $rsv_start = '00001';
		 
		 $this->db->order_by('id_instant_rsv', 'DESC');
		 $this->db->limit(1);
		 $res_code = $this->db->get('tbb_instant_reservation');
		 
		 if($res_code->num_rows()>0)
		 {
			$reserv = $res_code->row();
			$rsv_code = $reserv->ins_rsv_code;
			if(substr($rsv_code, 7, 4) == mdate("%m%y", time()))
			{
				$rsv_count = substr($rsv_code, 11, 5);
				$rsv_code = $rsv.sprintf("%1$05d",($rsv_count + 1));
			}
			else # handling different date / restart new serial number
			{
				$rsv_code = $rsv  . $rsv_start;	
			}
			return $rsv_code;
		 } else	{
				# handling empty record
				$rsv_code = $rsv  . $rsv_start;
				return $rsv_code;
		 }
	 }
	 
	 
	 public function get_last_payment_code()
	 {	
		 $pay = 'TBB-IBL'.mdate('%m%y', time());
		 $pay_start = '00001';
		 
		 $this->db->order_by('id_ins_rsv_bill', 'DESC');
		 $this->db->limit(1);
		 $pay_code = $this->db->get('tbb_instant_rsv_bill');
		 
		 if($pay_code->num_rows()>0)
		 {
			$payment = $pay_code->row();
			$pay_code = $payment->irb_pay_code;
			if(substr($pay_code, 7, 4) == mdate("%m%y", time()))
			{
				$pay_count = substr($pay_code, 11, 5);
				$pay_code = $pay.sprintf("%1$05d",($pay_count + 1));
			}
			else # handling different date / restart new serial number
			{
				$pay_code = $pay  . $pay_start;	
			}
			return $pay_code;
		 } else	{
				# handling empty record
				$pay_code = $pay  . $pay_start;
				return $pay_code;
		 }
	 }
	 ## END GET DATA ##
	 
	 ## SEARCH DATA ##
	 
	 
	 public function search_detail_reservasi($rsv_code)
	 {
		$this->db->where('irpd_rsv_code', $rsv_code);
		$this->db->where('irpd_status !=', 'void');
		$this->db->from('tbb_instant_rsv_pax_detail');
		$query = $this->db->get();
		
		return $query->result_array();
	 }
	 
	 public function search_data_reservasi($rsv_code)
	 {
		$this->db->where('res_code', $rsv_code);
		$query = $this->db->get('tbb_reservasi');
		
		return $query->row();
	 }
	 
	 
	 ## VOID DATA ##
	 
	 public function void_reservation($res_code)
	 {
		$this->db->where('ins_rsv_code', $res_code);
		$this->db->update('tbb_instant_reservation', array('ins_rsv_status' => 'void'));
	 }
	 
	 public function void_detail_reservation($res_code)
	 {
		$this->db->where('irpd_rsv_code', $res_code);
		$this->db->update('tbb_instant_rsv_pax_detail', array('irpd_status' => 'void'));
	 }
	 
	 public function void_detail_reservation_by_id($id_rpd)
	 {
		$this->db->where('id_irpd', $id_rpd);
		$this->db->update('tbb_instant_rsv_pax_detail', array('irpd_status' => 'void'));
	 }
	 
	 public function void_reservation_bill($res_code)
	 {
		$this->db->where('irb_res_code', $res_code);
		$this->db->update('tbb_instant_rsv_bill', array('irb_isvoid' => 'yes'));
	 }
	 
	 ## END VOID DATA ##
	 
	 ## UPDATE DATA ##
	 
	 public function update_reservation_status($res_code)
	{
		$this->db->where('ins_rsv_code', $res_code);
		$this->db->update('tbb_instant_reservation', array('ins_rsv_status' => 'paid'));
	}
	
	public function update_res_pax_detail_status($res_code)
	{
		$this->db->where('irpd_rsv_code', $res_code);
		$this->db->update('tbb_instant_rsv_pax_detail', array('irpd_status' => 'paid'));
	}
	
	## END OF UPDATE DATA ##
	 
}

/* end of reservation_model.php */