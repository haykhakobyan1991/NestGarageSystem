<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class System_main extends CI_Controller {


	/**
	 * System_main constructor.
	 */
	public function __construct() {

        parent::__construct();

		// load the library
		$this->load->library('layout');

		// load the helper
		$this->load->helper('language');

		$lng = $this->load->lng();

		$language = $this->load->get_language($lng);

		$this->config->set_item('language', $language);

		$this->load->load_lang('translate', $lng);

    }


	/**
	 * @param $element
	 */
	public function pre($element) {

		echo '<pre>';
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
	 * @param int $start
	 * @param int $length
	 * @return bool|string
	 * Ex: 45f7fd76
	 */
	private function uname($start = 3, $length = 2) {

		return substr(md5(time() . rand()), $start, $length);

	}


	/**
	 * @return bool
	 */
	public function change_lang() {

		$new_lang = $this->input->post('lang');
		$current_url = $this->input->post('current_url');

		$start = 0;
		$new_url = '';
		$url_array = explode(base_url(), $current_url);
		$url = array();
		$all_lang_arr = array('hy', 'ru', 'en');

		if(isset($url_array[1])) {
			$url = explode('/', $url_array[1]);
		}

		if (isset($url[0])) {
			if (in_array($url[0], $all_lang_arr)) {
				$start = 1;
			}
		}

		for ($i = $start; $i < count($url); $i++) {
			$new_url .= '/' . $url[$i];
		}

		echo base_url() . $new_lang . $new_url;

		return true;

	}


	public function config_ax() {


		$this->load->library('session');
		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');
		$n = 0;


		$result = false;

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}


		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('nominal_speed', 'nominal_speed', 'required');
		$this->form_validation->set_rules('threshold_of_refueling', 'threshold_of_refueling', 'required');
		$this->form_validation->set_rules('drain_threshold', 'drain_threshold', 'required');
		$this->form_validation->set_rules('parking_time', 'parking_time', 'required');



		if($this->form_validation->run() == false){
			//validation errors
			$n = 1;

			$validation_errors = array(
				'nominal_speed' =>  form_error('nominal_speed'),
				'threshold_of_refueling' =>  form_error('threshold_of_refueling'),
				'drain_threshold' =>  form_error('drain_threshold'),
				'parking_time' =>  form_error('parking_time')
			);
			$messages['error']['elements'][] = $validation_errors;
		}


		if($n == 1) {
			echo json_encode($messages);
			return false;
		}


		$lng = $this->load->lng();
		$token = $this->session->token;
		$company_id = $this->load->CallAPI('POST', $this->load->old_baseUrl() . $lng . '/Api/get_companyId', array('token' => $token));

		$nominal_speed = $this->input->post('nominal_speed');
		$threshold_of_refueling = $this->input->post('threshold_of_refueling');
		$drain_threshold = $this->input->post('drain_threshold');
		$parking_time = $this->input->post('parking_time');


		$sql = "
			SELECT 
				id
			FROM 
				config
			WHERE company_id = '".$company_id."'	
		";

		$query = $this->db->query($sql);
		$num_rows = $query->num_rows();


		if($num_rows == 0) {

			$sql = "
				INSERT INTO config (company_id, nominal_speed, threshold_of_refueling, drain_threshold, parking_time) 
				VALUES ($company_id, $nominal_speed, $threshold_of_refueling, $drain_threshold, $parking_time)
			";
			$result = $this->db->query($sql);
		} else {

			$sql = "
				UPDATE config set
					company_id = $company_id, 
					nominal_speed = $nominal_speed, 
					threshold_of_refueling = $threshold_of_refueling, 
					drain_threshold = $drain_threshold, 
					parking_time = $parking_time 
			";

			$result = $this->db->query($sql);
		}


		if ($result){
			$messages['success'] = 1;
			$messages['message'] = lang('success');
		} else {
			$messages['success'] = 0;
			$messages['error'] = lang('error');
		}

		// Return success or error message
		echo json_encode($messages);
		return true;
	}


	public function gnss_tracker() {

		$imei = $this->input->post('imei');


		if ($imei == '') {
			return false;
		}

		$row = $this->db->select('*')->from('tracking')->where('imei', $imei)->get()->row_array();

		if(!empty($row)) {
			echo json_encode($row);
		} else {
			echo json_encode('empty');
		}

		return true;

	}

}
//end of class
