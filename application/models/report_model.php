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
					SELECT * FROM `tbb_reservation_bill`
					$search
					$search_user
					AND `rb_isvoid` = 'no'
					AND `rb_paid_date` >= '$start'
					AND `rb_paid_date` <= '$end'
					ORDER BY `id_res_bill` DESC
				";
		$data = $this->db->query($query);
		return $data->result();
	 }
	 
	 public function get_therapist()
	 {
		$query = $this->db->get('tbb_therapist');
		return $query->result_array();
	 }
	 
	 public function get_product()
	 {
		$query = $this->db->get('tbb_product');
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
				GROUP BY `thw_date`, `thr_name`
				ORDER BY `thr_code`,`thw_date` ASC
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
				SELECT `prod_name`, `rpd_product`, `res_date`, `rpd_res_id`, COUNT(`rpd_product`) AS `times`, SUM(`rpd_quantity`) AS `sum` FROM `tbb_reservasi_pax_detail` AS `rpd`
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
}
	 