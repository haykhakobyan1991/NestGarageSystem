<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gps extends MX_Controller {

	/**
	 * Structure constructor.
	 * @property
	 */
	public function __construct() {

		parent::__construct();

		// load the library
		$this->load->library('layout');

		// load the helper
		$this->load->helper('language');
		$this->load->helper('date');

		$lng = $this->load->lng();

		$language = $this->load->get_language($lng);

		$this->config->set_item('language', $language);

		$this->load->load_lang('translate', $lng);

	}



	/**
	 * @param $element
	 */
	public function pre($element) {

		echo '<pre class="mt-5">';
		print_r($element);
		echo '</pre>';

	}

	/**
	 * @return bool
	 */
	public function access_denied() {
		$message = 'Access Denied';
		show_error($message, '403', $heading = '403 Access is prohibited');
		return false;
	}

	/**
	 * @param $data
	 * @return string
	 */
	public function hash($data) {
		return hash('sha256', $data);
	}



	public function index() {

		$token = $this->input->post('token');


		$sql = "
			SELECT token FROM \"user\" where token = '".$token."'
		";

		$query = $this->db->query($sql);
		$num_rows = $query->num_rows();

		if($num_rows == 0) {
			$this->db->insert('user', array('token' => $token));
		}

		$this->session->set_userdata(array('token' => $token));
	}



	public function gps_tracking() {

		$token = $this->session->token;
		$this->load->authorisation('Gps', 'gps_tracking', $token);


		$data = array();

		$lng = $this->load->lng();


		//api call //todo urls
		$fleets = $this->load->CallAPI('POST', 'http://localhost/NestGarageSystem/hy/Api/get_AllFleets', array('token' => $token));
		$fleet_group = $this->load->CallAPI('POST', 'http://localhost/NestGarageSystem/hy/Api/get_FleetGroup', array('token' => $token));


		$data['result'] = json_decode($fleet_group, true);
		$data['result_fleets'] = json_decode($fleets, true);

		$this->layout->view('gps_tracking/gps_tracking', $data);

	}

	public function speed() {
		//$this->load->authorisation('Gps', 'gps_tracking');
		$this->layout->view('gps_tracking/speed');
	}

	public function fuel() {
		//$this->load->authorisation('Gps', 'gps_tracking');
		$this->layout->view('gps_tracking/fuel');
	}

	public function geofences() {
		//$this->load->authorisation('Gps', 'gps_tracking');
		$this->layout->view('gps_tracking/geofences');
	}



}
//end of class
