<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model {

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
	 
	 public function get_generate_payment_report($start, $end, $payment, $user)
	 {
		if ($payment == 'All')
		{
			$search = "WHERE (`rb_payment_type` LIKE '%%' OR `rb_payment_type_2` LIKE '%%')";
		} else {
			$search = "WHERE (`rb_payment_type` = '$payment' OR `rb_payment_type_2` = '$payment')";
		}
		if ($user == 'All')
		{
			$search_user = "AND `rb_transaction_by` LIKE '%%'";
		} else {
			$search_user = "AND `rb_transaction_by` = '$user'";
		}
		$query = "
					SELECT * FROM `tbb_reservation_bill` AS `rb`
					LEFT JOIN `tbb_reservasi` AS `rsv` ON `rb`.`rb_res_code` = `rsv`.`res_code`
					$search
					$search_user
					AND `rb_isvoid` = 'no'
					AND `res_status` = 'paid'
					AND `rb_paid_date` >= '$start'
					AND `rb_paid_date` <= '$end'
					ORDER BY `id_res_bill` DESC
				";
		$data = $this->db->query($query);
		return $data->result();
	 }
	 
	 public function get_therapist()
	 {
		$this->db->where('thr_hide_status', 'no');
		$query = $this->db->get('tbb_therapist');
		return $query->result_array();
	 }
	 
	 public function get_product()
	 {
		$this->db->where('prod_hide_status', 'no');
		$query = $this->db->get('tbb_product');
		return $query->result_array();
	 }
	 
	 public function get_travel()
	 {
		$this->db->where('trv_hide_status', 'no');
		$query = $this->db->get('tbb_travel');
		return $query->result_array();
	 }
	 
	 public function get_room()
	 {
		$this->db->where('room_hide_status', 'no');
		$query = $this->db->get('tbb_room');
		return $query->result_array();
	 }
	 
	 public function get_generate_therapist_report($start, $end, $therapist)
	 {
		if ($therapist == 'All')
		{
			$search = "WHERE `thw_code` LIKE '%%'";
		} else {
			$search = "WHERE `thw_code` = '$therapist'";
		}
		
		$query = "
				SELECT *, COUNT(`thw_code`) AS `times` FROM `tbb_therapist` AS `thr`
				LEFT JOIN `tbb_therapist_workhour` AS `thw` ON `thr`.`thr_code` = `thw`.`thw_code`
				$search
				AND `thw_date` >= '$start'
				AND `thw_date` <= '$end'
				AND `thw_isvoid` = 'no'
				GROUP BY `thw_date`, `thr_name`
				ORDER BY `thr_code`,`thw_date` ASC
			";
		$data = $this->db->query($query);
		return $data->result();
	 }
	 
	 public function get_generate_room_report($start, $end, $therapist)
	 {
		if ($therapist == 'All')
		{
			$search = "WHERE `rav_room_name` LIKE '%%'";
		} else {
			$search = "WHERE `rav_room_name` = '$therapist'";
		}
		
		$query = "
				SELECT * FROM `tbb_room_available` AS `rav`
				LEFT JOIN `tbb_room` AS `room` ON `rav`.`rav_room_name` = `room`.`room_name`
				$search
				AND `rav_book_date` >= '$start'
				AND `rav_book_date` <= '$end'
				AND `rav_status` = 'paid'
				ORDER BY `rav_book_date`,`rav_room_name`,`room_category` ASC
			";
		$data = $this->db->query($query);
		return $data->result();
	 }
	 
	 public function get_generate_product_report($start, $end, $product)
	 {
		if ($product == 'All')
		{
			$search = "WHERE `rpd_product` LIKE '%%'";
		} else {
			$search = "WHERE `rpd_product` = '$product'";
		}
		
		$query = "
				SELECT `prod_code`,`prod_name`, `rpd_product`, `res_date`, `rpd_res_id`, COUNT(`rpd_product`) AS `times`, SUM(`rpd_quantity`) AS `sum` FROM `tbb_reservasi_pax_detail` AS `rpd`
				LEFT JOIN `tbb_reservasi` AS `rsv` ON `rpd`.`rpd_res_id` = `rsv`.`res_code`
				LEFT JOIN `tbb_product` AS `prod` ON `rpd`.`rpd_product` = `prod`.`prod_code`
				$search
				AND `res_date` >= '$start'
				AND `res_date` <= '$end'
				AND `rpd_status` != 'void'
				GROUP BY `rpd_product`, `res_date`
				ORDER BY `res_date`,`rpd_product` ASC
			";
		$data = $this->db->query($query);
		return $data->result();
	 } 
	 
	 public function get_generate_travel_report($start, $end, $travel)
	 {
		if ($travel == 'All')
		{
			$search = "WHERE `res_agent` LIKE '%%'";
		} else {
			$search = "WHERE `res_agent` = '$travel'";
		}
		
		$query = "
				SELECT `trv_name`, `rpd_res_id`, `res_code`, `res_agent`, `res_guide`, `res_date`, `rpd_res_id`, SUM(`rpd_quantity`) AS `sum` FROM `tbb_reservasi_pax_detail` AS `rpd`
				LEFT JOIN `tbb_reservasi` AS `rsv` ON `rpd`.`rpd_res_id` = `rsv`.`res_code`
				LEFT JOIN `tbb_travel` AS `trv` ON `rsv`.`res_agent` = `trv`.`trv_code`
				$search
				AND `res_date` >= '$start'
				AND `res_date` <= '$end'
				AND `rpd_status` != 'void'
				GROUP BY `res_agent`, `res_date`
				ORDER BY `res_date`,`res_agent` ASC
			";
		$data = $this->db->query($query);
		return $data->result();
	 }
	 
	 public function update_payment_status($id)
	 {
		$this->db->where('id_res_bill', $id);
		$this->db->update('tbb_reservation_bill', array('rb_status' => 'closed'));
	 }
}
	 