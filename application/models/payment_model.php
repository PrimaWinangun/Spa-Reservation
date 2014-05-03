<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment_model extends CI_Model {

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
	 
	 ## GET DATABASE ##
	 
	 public function get_reservation_list($num, $offset)
	 {
		$this->db->select('*');
		$this->db->select('SUM(rpd_rate) as harga');
		$this->db->where('res_status !=', 'void');
		$this->db->order_by('res_status, id_res', 'DESC');
		$this->db->group_by('res_code');
		$this->db->limit($num, $offset);
		$this->db->join('tbb_reservasi_pax_detail','tbb_reservasi_pax_detail.rpd_res_id = tbb_reservasi.res_code', 'LEFT');
		$query = $this->db->get('tbb_reservasi');
		
		return $query->result();
	 } 
	 
	 public function get_reservation_list_search($search, $num, $offset)
	 {
		$this->db->select('*');
		$this->db->select('SUM(rpd_rate) as harga');
		$this->db->where('res_status !=', 'void');
		$this->db->like('res_code', $search);
		$this->db->order_by('res_status, id_res', 'DESC');
		$this->db->group_by('res_code');
		$this->db->limit($num, $offset);
		$this->db->join('tbb_reservasi_pax_detail','tbb_reservasi_pax_detail.rpd_res_id = tbb_reservasi.res_code', 'LEFT');
		$query = $this->db->get('tbb_reservasi');
		
		return $query->result();
	 }
	 
	 public function get_payment_list($num, $offset)
	 {
		$this->db->where('rb_isvoid', 'no');
		$this->db->order_by('id_res_bill', 'DESC');
		$this->db->limit($num, $offset);
		$query = $this->db->get('tbb_reservation_bill');
		
		return $query->result();
	 }
	 
	 public function get_payment_list_search_date($search, $num, $offset)
	 {
		$this->db->where('rb_paid_date', $search);
		$this->db->where('rb_isvoid', 'no');
		$this->db->order_by('id_res_bill', 'DESC');
		$this->db->limit($num, $offset);
		$query = $this->db->get('tbb_reservation_bill');
		
		return $query->result();
	 }
	 
	 public function get_payment_list_search($search, $num, $offset)
	 {
		$query = "SELECT * FROM (`tbb_reservation_bill`) 
				  WHERE (`rb_pay_code` LIKE '%$search%' OR `rb_res_code` LIKE '%$search%')
				  AND `rb_isvoid` = 'no' 
				  ORDER BY `id_res_bill` DESC LIMIT $offset, $num";
		$query = $this->db->query($query);
		
		return $query->result();
	 }
	 
	 public function get_paid_data($res_code)
	 {
		$this->db->where('rb_res_code', $res_code);
		$this->db->where('rb_isvoid', 'no');
		$this->db->order_by('id_res_bill', 'DESC');
		$query = $this->db->get('tbb_reservation_bill');
		
		if($query->num_rows() >= 1)
		{ return TRUE; } else { return FALSE; }
	 }
	 
	 public function get_data_pax($pax)
	 {
		 $this->db->where('rpd_res_id', $pax);
		 $query = $this->db->get('tbb_reservasi_pax_detail');
		 return $query->result_array();
	 }
	 
	 public function get_list_cashier()
	 {
		$this->db->where('ur_position', $this->encrypt->encode('cashier', $this->config->item('encryption_key')));
		$this->db->or_where('ur_position', $this->encrypt->encode('developer', $this->config->item('encryption_key')));
		$this->db->or_where('ur_position', $this->encrypt->encode('administrator', $this->config->item('encryption_key')));
		
	 }
	 
	 public function get_generate_report($payment, $user)
	 {
		$date = date('Y-m-d', now());
		if ($payment == 'All')
		{
			$search = "WHERE (`rb_payment_type` LIKE '%%' OR `rb_payment_type_2` LIKE '%%')";
		} else {
			$search = "WHERE (`rb_payment_type` = '$payment' OR `rb_payment_type_2` = '$payment')";
		}
		$query = "
					SELECT * FROM `tbb_reservation_bill`
					$search
					AND `rb_transaction_by` = '$user'
					AND `rb_isvoid` = 'no'
					AND `rb_paid_date` = '$date'
					ORDER BY `id_res_bill` DESC
				";
		$data = $this->db->query($query);
		return $data->result();
	 }
	 
	 public function get_last_payment_code()
	 {	
		 $pay = 'TBB-BIL'.mdate('%m%y', time());
		 $pay_start = '00001';
		 
		 $this->db->order_by('id_res_bill', 'DESC');
		 $this->db->limit(1);
		 $pay_code = $this->db->get('tbb_reservation_bill');
		 
		 if($pay_code->num_rows()>0)
		 {
			$payment = $pay_code->row();
			$pay_code = $payment->rb_pay_code;
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
	 	 
	 ## INSERT DATABASE ##
	 
	 public function insert_data_payment($data)
	 {
		$this->db->insert('tbb_reservation_bill', $data); 
	 }
	 
	 public function insert_data_pax($data)
	 {
		$this->db->insert('tbb_reservasi_pax_detail', $data); 
	 }
	 
	 ## SEARCH DATABASE ##
	 
	 public function search_detail_reservasi($rsv_code)
	 {
		$this->db->where('rpd_res_id', $rsv_code);
		$this->db->where('rpd_status !=', 'void');
		$this->db->from('tbb_reservasi_pax_detail');
		$query = $this->db->get();
		
		return $query->result_array();
	 }
	 
	 public function search_data_reservasi($rsv_code)
	 {
		$this->db->where('res_code', $rsv_code);
		$query = $this->db->get('tbb_reservasi');
		
		return $query->row();
	 }
	 
	## UPDATE DATABASE ##
	
	public function update_reservation_status($res_code)
	{
		$this->db->where('res_code', $res_code);
		$this->db->update('tbb_reservasi', array('res_status' => 'paid'));
	}
	
	public function update_res_pax_detail_status($res_code)
	{
		$this->db->where('rpd_res_id', $res_code);
		$this->db->update('tbb_reservasi_pax_detail', array('rpd_status' => 'paid'));
	}
	
	public function update_room_available($id_rpd)
	{
		$this->db->where('rav_id_rpd', $id_rpd);
		$this->db->update('tbb_room_available', array('rav_status' => 'paid'));
	}
	
	public function update_reservation_status_open($res_code)
	{
		$this->db->where('res_code', $res_code);
		$this->db->update('tbb_reservasi', array('res_status' => 'open'));
	}
	
	public function update_res_pax_detail_status_open($res_code)
	{
		$this->db->where('rpd_res_id', $res_code);
		$this->db->update('tbb_reservasi_pax_detail', array('rpd_status' => 'open'));
	}
	
	public function update_room_available_open($id_rpd)
	{
		$this->db->where('rav_id_rpd', $id_rpd);
		$this->db->update('tbb_room_available', array('rav_status' => 'open'));
	}
	
	## COUNT DATABASE ##
	
	public function count_reservation()
	{
		$this->db->where('res_status !=', 'void');
		$query = $this->db->get('tbb_reservasi');
		return $query->num_rows();
	}
	
	public function count_reservation_search($search)
	{
		$this->db->like('res_code', $search);
		$this->db->where('res_status !=', 'void');
		$query = $this->db->get('tbb_reservasi');
		return $query->num_rows();
	}
	
	public function count_payment()
	{
		$this->db->where('rb_isvoid !=', 'yes');
		$query = $this->db->get('tbb_reservation_bill');
		return $query->num_rows();
	}
	
	public function count_payment_search($search)
	{
		$this->db->like('rb_pay_code OR rb_res_code', $search);
		$this->db->where('rb_isvoid !=', 'yes');
		$query = $this->db->get('tbb_reservation_bill');
		return $query->num_rows();
	}
	
	public function count_payment_search_date($search)
	{
		$this->db->where('rb_paid_date', $search);
		$this->db->where('rb_isvoid !=', 'yes');
		$query = $this->db->get('tbb_reservation_bill');
		return $query->num_rows();
	}
	
	## VOID DATABASE ##
	
	public function void_data_payment($rsv_code)
	{
		$this->db->where('rb_res_code', $rsv_code);
		$this->db->where('rb_isvoid !=', 'yes');
		$this->db->update('tbb_reservation_bill', array('rb_isvoid'=> 'yes'));
	}
	 
}
	 