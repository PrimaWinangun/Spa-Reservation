<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reservation_model extends CI_Model {

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
		$this->db->insert('tbb_reservasi', $data); 
	 }
	 
	 public function insert_data_pax($data)
	 {
		$this->db->insert('tbb_reservasi_pax_detail', $data); 
		return $this->db->insert_id();
	 }
	 
	 public function insert_therapist_workhour($data)
	 {
		$this->db->insert('tbb_therapist_workhour', $data);
	 }
	 
	 public function insert_available_list($data)
	 {
		$this->db->insert('tbb_room_available', $data);
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
	 
	 public function get_today_res_list($date, $num, $offset)
	 {
		$this->db->select('*');
		$this->db->select('SUM(rpd_rate) as harga');
		$this->db->where('res_date', $date);
		$this->db->order_by('id_res', 'DESC');
		$this->db->group_by('res_code');
		$this->db->limit($num, $offset);
		$this->db->join('tbb_reservasi_pax_detail','tbb_reservasi_pax_detail.rpd_res_id = tbb_reservasi.res_code', 'LEFT');
		$query = $this->db->get('tbb_reservasi');
		
		return $query->result();
	 }
	 
	 public function get_reservation_list($num, $offset)
	 {
		$this->db->select('*');
		$this->db->select('SUM(rpd_rate) as harga');
		$this->db->order_by('id_res', 'DESC');
		$this->db->group_by('res_code');
		$this->db->limit($num, $offset);
		$this->db->join('tbb_reservasi_pax_detail','tbb_reservasi_pax_detail.rpd_res_id = tbb_reservasi.res_code', 'LEFT');
		$query = $this->db->get('tbb_reservasi');
		
		return $query->result();
	 }
	 
	 public function get_search_reservation_list($search, $num, $offset)
	 {
		$this->db->select('*');
		$this->db->select('SUM(rpd_rate) as harga');
		$this->db->like('res_code',$search);
		$this->db->order_by('id_res', 'DESC');
		$this->db->group_by('res_code');
		$this->db->limit($num, $offset);
		$this->db->join('tbb_reservasi_pax_detail','tbb_reservasi_pax_detail.rpd_res_id = tbb_reservasi.res_code', 'LEFT');
		$query = $this->db->get('tbb_reservasi');
		
		return $query->result();
	 }
	 
	 public function get_data_pax($pax)
	 {
		 $this->db->where('rpd_res_id', $pax);
		 $query = $this->db->get('tbb_reservasi_pax_detail');
		 return $query->result_array();
	 }
	 
	 public function total_detail_pax($pax)
	 {
		$this->db->where('rpd_res_id', $pax);
		$this->db->where('rpd_status != ', 'void');
		 $query = $this->db->get('tbb_reservasi_pax_detail');
		 return $query->num_rows();
	 }
	 
	 public function get_data_room_cat()
	 {
		$this->db->where('cat_hide_status','no');
		 $query = $this->db->get('tbb_category_room');
		 return $query->result_array();
	 }	
	 
	 public function get_data_room_open()
	 {	
		 $this->db->where('room_status', 'open');
		 $query = $this->db->get('tbb_room');
		 return $query->result();
	 }
	 
	 public function get_data_room_by_cat($cat)
	 {
		 $this->db->where('room_category', $cat);
		 $query = $this->db->get('tbb_room');
		 return $query->result();
	 }
	 
	 public function get_room_cat_by_room_no($room)
	 {
		$this->db->where('room_name', $room);
		$query = $this->db->get('tbb_room');
		return $query->row();
	 }
	 
	 public function get_data_therapist_open()
	 {	
		 $this->db->where('thr_status', 'open');
		 $query = $this->db->get('tbb_therapist');
		 return $query->result_array();
	 }
	 
	 public function get_detail_product($id_prod)
	 {
		 $this->db->where('id_prod', $id_prod);
		 $query = $this->db->get('tbb_product');
		 return $query->row();
	 }
	 
	 public function get_data_reservation($res_code)
	 {
		$this->db->where('res_code', $res_code);
		$query = $this->db->get('tbb_reservasi');
		return $query->row();
	 }
	 
	 public function get_all_room($date, $id)
	 {
		$this->db->where('rav_book_date', $date);
		$this->db->where('rav_room_name', $id);
		$this->db->where('rav_status !=', 'void');
		$this->db->join('tbb_reservasi_pax_detail', 'tbb_reservasi_pax_detail.id_rpd = tbb_room_available.rav_id_rpd');
		$query = $this->db->get('tbb_room_available');
		return $query->result();
	 }
	 
	 public function get_room_list()
	 {
		$query = $this->db->get('tbb_room');
		return $query->result();
	 }
	 
	 public function get_available_room($room, $start, $end, $date)
	 {	
		$query = "SELECT * 
				  FROM  `tbb_room_available` 
				  WHERE  `rav_status` !=  'void'
				  AND  `rav_book_date` =  '$date'
				  AND (HOUR(`rav_start`) <=  '".date('H',strtotime($end))."' AND  `rav_end` >=  '$start')
				  AND  `rav_room_name` =  '$room'";
		$result = $this->db->query($query);
		return $result->num_rows();
	 }
	 
	 public function get_available_therapist($therapist, $start, $end, $date)
	 {	
		$query = "SELECT * 
				  FROM  `tbb_therapist_workhour` 
				  WHERE `thw_date` =  '$date'
				  AND (HOUR(`thw_start_time`) <=  '".date('H',strtotime($end))."' AND  `thw_end_time` >=  '$start')
				  AND  `thw_code` =  '$therapist'";
		$result = $this->db->query($query);
		return $result->num_rows();
	 }
	 
	 public function get_last_res_code()
	 {	
		 $rsv = 'TBB-RSV'.mdate('%m%y', time());
		 $rsv_start = '00001';
		 
		 $this->db->order_by('id_res', 'DESC');
		 $this->db->limit(1);
		 $res_code = $this->db->get('tbb_reservasi');
		 
		 if($res_code->num_rows()>0)
		 {
			$reserv = $res_code->row();
			$rsv_code = $reserv->res_code;
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
	 
	 ## END GET DATA ##
	 
	 ## UPDATE DATA ##
	 
	 public function set_therapist_close($thr_code)
	 {
		$this->db->where('thr_code', $thr_code);
		$this->db->update('tbb_therapist', array('thr_status' => 'close'));
	 }
	 
	 public function set_close_room($room, $status)
	 {
		$open = array('room_status' => 'book');
		
		$this->db->where('room_name', $room);
		$this->db->update('tbb_room', $open);
	 }
	 
	 ## END UPDATE DATA ##
	 
	 ## VOID DATA ##
	 
	 public function void_reservation($res_code)
	 {
		$this->db->where('res_code', $res_code);
		$this->db->update('tbb_reservasi', array('res_status' => 'void'));
	 }
	 
	 public function void_detail_reservation($res_code)
	 {
		$this->db->where('rpd_res_id', $res_code);
		$this->db->update('tbb_reservasi_pax_detail', array('rpd_status' => 'void'));
	 }
	 
	 public function void_detail_reservation_by_id($id_rpd)
	 {
		$this->db->where('id_rpd', $id_rpd);
		$this->db->update('tbb_reservasi_pax_detail', array('rpd_status' => 'void'));
	 }
	 
	 public function void_available_room($room_name)
	 {
		$this->db->where('rav_room_name', $room_name);
		$this->db->update('tbb_room_available', array('rav_status' => 'void'));
	 }
	 
	 public function void_available_room_by_id($id_room)
	 {
		$this->db->where('rav_id_rpd', $id_room);
		$this->db->update('tbb_room_available', array('rav_status' => 'void'));
	 }
	 
	 ## END VOID DATA ##
	 
	 ## COUNT DATA ##
	 
	 public function count_reservation()
	 {
		$query = $this->db->get('tbb_reservasi');
		return $query->num_rows();
	 }
	 
	 public function count_reservation_search($search)
	 {
		$this->db->like('res_code', $search);
		$query = $this->db->get('tbb_reservasi');
		return $query->num_rows();
	 }
	 
	 public function count_reservation_date($date)
	 {
		$this->db->where('res_date', $date);
		$query = $this->db->get('tbb_reservasi');
		return $query->num_rows();
	 }
	 
	 ## END COUNT DATA ##
}

/* end of reservation_model.php */