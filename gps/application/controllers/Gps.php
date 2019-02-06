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
		$this->load->authorisation('Gps', 'gps_tracking', $token); //authorisation


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

	public function geoferences() {
		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //authorisation
		$data = array();

		$result = $this->db->select('geoference."id",geoference."name", geoference_cordinates.lat,geoference_cordinates.long')->from('geoference')->join('geoference_cordinates', 'geoference."id" = geoference_cordinates.geoference_id', 'left')->where('geoference.status', 1)->get()->result_array();

		// $this->pre($result);

		$new_result = array();


		foreach ($result as $value) {
			$new_result[$value['name']][$value['id']][] = '['.$value['lat'].','.$value['long'].']';
		}

//		$this->pre($new_result);

		$data['result'] = $new_result;

		$this->layout->view('gps_tracking/geoferences', $data);
	}

	public function add_geoference_ax() {

		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //authorisation

		$this->load->library('session');
		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');
		$n = 0;
		$user_id = $this->session->user_id;

		$result = false;

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}




		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('geo_name', 'geo_name', 'required');
		$this->form_validation->set_rules('geometry', 'geometry', 'required');



		if($this->form_validation->run() == false){
			//validation errors
			$n = 1;

			$validation_errors = array(
				'geo_name' =>  form_error('geo_name'),
				'geometry' =>  form_error('geometry')
			);
			$messages['error']['elements'][] = $validation_errors;
		}


		if($n == 1) {
			echo json_encode($messages);
			return false;
		}




		$geo_name = $this->input->post('geo_name');
		$geometry = $this->input->post('geometry');
		$status = 1;
		$company_id = $this->load->CallAPI('POST', 'http://localhost/NestGarageSystem/hy/Api/get_companyId', array('token' => $token));


		$sql = "
				INSERT INTO 
				  \"geoference\"
				(name, company_id, status) VALUES 
				( '".$geo_name."', '".$company_id."', '".$status."')
		";

		$result = $this->db->query($sql);

		$geoference_id = $this->db->insert_id();


		$geometry = explode(',', $geometry);
		$lat = array();
		$long = array();
		foreach ($geometry as $key => $value) {
			if($key == '0' || $key % 2 == 0) {
				$lat[] = $value;
			} else {
				$long[] = $value;
			}
		}

		$sql_cord = "
		INSERT INTO 
				  \"geoference_cordinates\"
				(lat, long, geoference_id, status) VALUES 
		";

		foreach ($lat AS $i => $l) {
			$sql_cord .= "('".$l."', '".$long[$i]."', '".$geoference_id."', 1),";
		}

		$sql_cord = substr($sql_cord, 0, -1);
		$result_cord = $this->db->query($sql_cord);

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



	public function edit_geoference_ax() {

		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //authorisation

		$this->load->library('session');
		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');
		$n = 0;
		$user_id = $this->session->user_id;

		$result = false;

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}




		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('geo_name', 'geo_name', 'required');
		$this->form_validation->set_rules('edit_geometry', 'edit_geometry', 'required');



		if($this->form_validation->run() == false){
			//validation errors
			$n = 1;

			$validation_errors = array(
				'geo_name' =>  form_error('geo_name'),
				'edit_geometry' =>  form_error('edit_geometry')
			);
			$messages['error']['elements'][] = $validation_errors;
		}


		if($n == 1) {
			echo json_encode($messages);
			return false;
		}




		$geo_name = $this->input->post('geo_name');
		$geometry = $this->input->post('edit_geometry');
		$geoference_id = $this->input->post('edit_id');
		$status = 1;

		$company_id = $this->load->CallAPI('POST', 'http://localhost/NestGarageSystem/hy/Api/get_companyId', array('token' => $token)); //todo url

		$this->db->update('geoference', array('name' => $geo_name), array('id' => $geoference_id));


		$this->db->delete('geoference_cordinates', array('geoference_id' => $geoference_id));


		$geometry = explode(',', $geometry);
		$lat = array();
		$long = array();
		foreach ($geometry as $key => $value) {
			if($key == '0' || $key % 2 == 0) {
				$lat[] = $value;
			} else {
				$long[] = $value;
			}
		}

		$sql_cord = "
		INSERT INTO 
				  \"geoference_cordinates\"
				(lat, long, geoference_id, status) VALUES 
		";

		foreach ($lat AS $i => $l) {
			$sql_cord .= "('".$l."', '".$long[$i]."', '".$geoference_id."', 1),";
		}

		$sql_cord = substr($sql_cord, 0, -1);
		$result_cord = $this->db->query($sql_cord);

		if ($result_cord){
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



}
//end of class
