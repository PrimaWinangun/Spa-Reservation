<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_station extends CI_Controller {
	
	function __construct()
	{
        parent::__construct();
		$this->load->model( 'reservation_model' );
    }
	
	function select_room ( )
	{
		$room_cat = $this->input->post('room_cat');
		$data['rooms'] = $this->reservation_model->get_data_room_by_cat( $room_cat );
		
		print_r($data);
		$this->load->view('reservation/chain/room', $data);
	}

	
}

/* End of file ajax_station.php */
/* Location: ./application/controllers/ajax_station.php */
