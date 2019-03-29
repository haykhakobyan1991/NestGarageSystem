<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gps extends MX_Controller
{

	/**
	 * Structure constructor.
	 * @property
	 */
	public function __construct()
	{

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

		date_default_timezone_set('Asia/Yerevan');//todo

	}


	/**
	 * @param $element
	 */
	public function pre($element)
	{

		echo '<pre class="mt-5">';
		print_r($element);
		echo '</pre>';

	}

	/**
	 * @return bool
	 */
	public function access_denied()
	{
		$message = 'Access Denied';
		show_error($message, '403', $heading = '403 Access is prohibited');
		return false;
	}

	/**
	 * @param $data
	 * @return string
	 */
	public function hash($data)
	{
		return hash('sha256', $data);
	}


	public function index()
	{

		$token = $this->input->get('token');


		$sql = "
			SELECT token FROM \"user\" where token = '" . $token . "' LIMIT 1
		";

		$query = $this->db->query($sql);
		$num_rows = $query->num_rows();

		if ($num_rows == 0) {
			$this->db->insert('user', array('token' => $token));
		}

		$lng = $this->load->lng();

		$this->session->set_userdata(array('token' => $token));

		redirect($lng . '/gps_tracking', 'location');//todo
	}


	public function gps_tracking()
	{


		$token = $this->session->token;
		$this->load->authorisation('Gps', 'gps_tracking', $token); //authorisation


		$data = array();

		$lng = $this->load->lng();


		//api call
		$fleets = $this->load->CallAPI('POST', $this->load->old_baseUrl() . $lng . '/Api/get_AllFleets', array('token' => $token));
		$data['result_fleets'] = json_decode($fleets, true);

		$fleet_group = $this->load->CallAPI('POST', $this->load->old_baseUrl() . $lng . '/Api/get_FleetGroup', array('token' => $token));
		$data['result'] = json_decode($fleet_group, true);

		$company_id = $this->load->CallAPI('POST', $this->load->old_baseUrl() . $lng . '/Api/get_companyId', array('token' => $token));

		$sql_g = '
			SELECT 
				"id",
				"name"
			FROM 
			   "geoference"
			WHERE "status" = 1 
			AND "company_id" = ' . $company_id . '
		';

		$query_g = $this->db->query($sql_g);
		$data['geoference'] = $query_g->result_array();

		$result = $this->db->select('geoference."id",geoference."name", geoference_cordinates.lat,geoference_cordinates.long')->from('geoference')->join('geoference_cordinates', 'geoference."id" = geoference_cordinates.geoference_id', 'left')->where('geoference.status', 1)->get()->result_array();

		$new_result = array();


		foreach ($result as $value) {
			$new_result[$value['name']][$value['id']][] = '[' . $value['lat'] . ',' . $value['long'] . ']';
		}

		foreach ($new_result as $val) {
			foreach ($val as $id => $value) {
				$new_result2[$id] = $value;
			}
		}

		//---- get last location ----
		$add_sql = '';
		foreach (json_decode($fleets, true) as $row) {
			$add_sql .= " gps.\"imei\" = '" . $row['gps_tracker_imei'] . "' OR";
		}

		$add_sql = substr($add_sql, 0, -2);

		$sql = "
			SELECT 
				gps.\"id\",
				gps.\"lat\",
				gps.\"long\",
				gps.\"speed\",
				gps.\"course\",
				gps.\"time\",
				gps.\"date\",
				gps.\"imei\",
				gps.\"engine\"
			FROM 
			   gps
			WHERE " . $add_sql . "
		 	ORDER BY imei, 
		 	CONCAT_WS (' ',
		 	   gps.\"date\",
			   gps.\"time\"
		    ) desc
		";


		$query = $this->db->query($sql);

		$result_l = $query->result_array();


//		$this->pre($new_result);
//		$this->pre($new_result2);
//		$this->pre($result_l);


		$data['result2'] = $new_result;
		$data['new_result'] = $new_result2;
		$data['last_location'] = $result_l;


		$this->layout->view('gps_tracking/gps_tracking', $data);

	}

	public function changDataCoordinate()
	{

		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //todo authorisation


		$user_id = $this->session->user_id;

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}

		$fleets = $this->input->post('fleets');
		$add_sql = '';
		foreach ($fleets as $imei) {
			$add_sql .= " gps.\"imei\" = '" . $imei . "' OR";
		}

		$add_sql = substr($add_sql, 0, -2);

		$sql = "
			SELECT 
			    gps.\"id\",
				gps.\"lat\",
				gps.\"long\",
				gps.\"speed\",
				gps.\"course\",
				gps.\"time\",
				gps.\"date\",
				gps.\"imei\",
				gps.\"engine\"
			FROM 
			   gps 
			WHERE $add_sql ORDER BY imei, 
		 	CONCAT_WS (' ',
		 	   gps.\"date\",
			   gps.\"time\"
		    ) desc
		";

		$query = $this->db->query($sql);

		$result = $query->result_array();

		$tmp = 0;
		$imei = '';
		$arr = array();
		$carStatus = '';
		$timing = '';

		foreach ($result as $val) {

			if ($imei != $val['imei']) {

				//new DateTime
				if ($tmp == 0) {

					$newDateTime = new DateTime();
					$lastDateTime = new DateTime($val['date'] . ' ' . $val['time']);
					$interval = $newDateTime->diff($lastDateTime);

					$timing = $this->load->getTime($interval->days, $interval->h, $interval->i, $interval->s);

					if($val['speed'] < 5 && $val['engine'] == 0) {
						$carStatus = 2;
					} elseif ($val['speed'] < 5 && $val['engine'] == 1) {
						$carStatus = 2;
					} elseif ($val['speed'] > 5 && $val['engine'] == 0) {
						$carStatus = 2;
					} elseif ($val['speed'] > 5 && $val['engine'] == 1) {
						$carStatus = 2;
					} elseif($val['speed'] < 5 && $val['engine'] == 0) {
						$carStatus = -1;
					} else {
						$carStatus = 1;
					}



					$arr[$val['imei']] = array(
						'lat' => $val['lat'],
						'long' => $val['long'],
						'date' => $val['date'],
						'time' => $val['time'],
						'course' => $val['course'],
						'speed' => $val['speed'],
						'engine' => $val['engine'],
						'carStatus' => $carStatus,
						'timing' => $timing
					);
				}
				$tmp = 1;
			} else {
				$tmp = 0;
			}
			$imei = $val['imei'];
		}

		echo json_encode($arr);
		return true;

	}

	public function speed()
	{
		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //todo authorisation
		$this->layout->view('gps_tracking/speed');
	}

	public function trajectory()
	{
		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //todo authorisation

		$data = array();
		$lng = $this->load->lng();


		//api call
		$fleets = $this->load->CallAPI('POST', $this->load->old_baseUrl() . $lng . '/Api/get_AllFleets', array('token' => $token));
		$data['result_fleets'] = json_decode($fleets, true);


		$this->layout->view('gps_tracking/trajectory', $data);
	}

	public function fuel()
	{
		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //todo authorisation

		$data = array();
		$lng = $this->load->lng();

		//api call
		$fleets = $this->load->CallAPI('POST', $this->load->old_baseUrl() . $lng . '/Api/get_AllFleets', array('token' => $token));
		$data['result_fleets'] = json_decode($fleets, true);

		$this->layout->view('gps_tracking/fuel', $data);
	}

	public function load()
	{
		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //todo authorisation

		$data = array();
		$lng = $this->load->lng();

		//api call
		$fleets = $this->load->CallAPI('POST', $this->load->old_baseUrl() . $lng . '/Api/get_AllFleets', array('token' => $token));
		$data['result_fleets'] = json_decode($fleets, true);

		$this->layout->view('gps_tracking/load', $data);
	}

	public function event()
	{
		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //todo authorisation

		$data = array();
		$lng = $this->load->lng();

		//api call
		$fleets = $this->load->CallAPI('POST', $this->load->old_baseUrl() . $lng . '/Api/get_AllFleets', array('token' => $token));
		$data['result_fleets'] = json_decode($fleets, true);


		$staffs = $this->load->CallAPI('POST', $this->load->old_baseUrl() . $lng . '/Api/getAllStaffs', array('token' => $token));
		$data['result_staffs'] = json_decode($staffs, true);

		$company_id = $this->load->CallAPI('POST', $this->load->old_baseUrl() . 'Api/get_companyId', array('token' => $token));

		// end api call


		$local_time = time();

		if ($this->uri->segment(3) != '') {
			$year = $this->uri->segment(3);
		} else {
			$year = date('Y', $local_time);
		}

		if ($this->uri->segment(4) != '') {
			$month = $this->uri->segment(4);
		} else {
			$month = date('m', $local_time);
		}


		$prefs = array(
			'month_type' => 'long',
			'show_other_days' => true,
			'show_next_prev' => true,
			'next_prev_url' => base_url() . $lng . '/event'
		);

		$this->load->library('calendar', $prefs); // Load calender library


		$sql = "
			SELECT 
				id,
				title,
				description,
				staff_id,
				fleet_id,
				date
			FROM
				event
			WHERE  date	LIKE '" . $year . '-' . $month . "%'
			 AND company_id = '" . $company_id . "'
		";

		$query = $this->db->query($sql);

		$result = $query->result_array();

		$event = array();
		foreach ($result as $row) {
			if (substr($row['date'], 0, 7) == $year . '-' . $month) {
				$fleet = json_decode($this->load->CallAPI('POST', $this->load->old_baseUrl() . $lng . '/Api/get_SingleFleet', array('token' => $token, 'fleet_id' => $row['fleet_id'])),true);
				$staff = json_decode($this->load->CallAPI('POST', $this->load->old_baseUrl() . $lng . '/Api/get_SingleStaff', array('token' => $token, 'staff_id' => $row['staff_id'])),true);

				$event[intval(substr($row['date'], 8))][] = '
					<span class="badge badge-pill badge-primary event mt-1" style="position: relative; cursor: pointer; display: block; background-color: rgb(121,134,203)">' . $row['title'] . '
						<div class="card">
							<div class="card-header text-left">' . $row['title'] . '
								<div class="ml-2 float-right">	
									<i id="edit_event_modal" data-id="' . $row['id'] . '" data-toggle="modal" data-target="#myModal" class=" fas fa-pen"></i>
									<i id="delete_event_modal" data-id="' . $row['id'] . '" data-toggle="modal" data-target="#delMod" class="ml-1 fas fa-trash-alt"></i>
								</div>
							</div>
							<div class="card-body text-left">
								'.($staff['name'] != '' ? '<div class="">' . lang('driver') . ': ' . $staff['name'] . '</div>' : '').'
								'.($fleet['brand_model'] != '' ? '<div class="'.($staff['name'] != '' ? 'mt-2' : '').'">' . lang('fleet') . ': ' . $fleet['brand_model'] . '</div>' : '').'
								<div class="'.($fleet['brand_model'] != '' ? 'mt-2' : '').'">' . $row['description'] . '</div>
								
							</div>
						</div>
					</span>';
			}
		}


		//$this->pre($event);


		$data['calendar'] = $this->calendar->generate($year, $month, $event);


		$this->layout->view('event/event', $data);
	}


	public function add_event_ax()
	{
		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //todo authorisation

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
		// $this->config->set_item('language', 'armenian');
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('title', 'title', 'required');


		if ($this->form_validation->run() == false) {
			//validation errors
			$n = 1;

			$validation_errors = array(
				'title' => form_error('title')
			);
			$messages['error']['elements'][] = $validation_errors;
		}


		if ($n == 1) {
			echo json_encode($messages);
			return false;
		}

		$title = $this->input->post('title');
		$date = $this->input->post('day');
		$description = $this->input->post('description');
		$staff = $this->input->post('staff');
		$fleet = $this->input->post('fleet');
		$company_id = $this->load->CallAPI('POST', $this->load->old_baseUrl() . 'Api/get_companyId', array('token' => $token));


		$sql = "
			INSERT INTO event 
				(
					title,
					\"date\",
					description,
					staff_id,
					fleet_id,
					company_id
				) VALUES (
					" . $this->load->db_value($title) . ",
					'" . $date . "',
					" . $this->load->db_value($description) . ",
					" . $this->load->db_value($staff) . ",
					" . $this->load->db_value($fleet) . ",
					" . $this->load->db_value($company_id) . "
				)
		";

		$query = $this->db->query($sql);


		if ($query) {
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


	public function edit_event_modal_ax()
	{

		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //todo authorisation

		$id = $this->uri->segment(4);
		$this->load->helper('url');
		$this->load->helper('form');
		$lng = $this->load->lng();
		$data = array();

		if ($id == NULL) {
			$message = 'Undifined ID';
			show_error($message, '404', $heading = '404 Page Not Found');
			return false;
		}



		//api call

		$fleets = $this->load->CallAPI('POST', $this->load->old_baseUrl() . $lng . '/Api/get_AllFleets', array('token' => $token));
		$data['result_fleets'] = json_decode($fleets, true);


		$staffs = $this->load->CallAPI('POST', $this->load->old_baseUrl() . $lng . '/Api/getAllStaffs', array('token' => $token));
		$data['result_staffs'] = json_decode($staffs, true);

		// end api call

		$sql = "SELECT
                   id,
                   title,
                   description,
                   staff_id,
                   fleet_id,
                   date
                FROM 
                   event
                WHERE id =  " . $this->load->db_value($id) . "
                LIMIT 1";

		$query = $this->db->query($sql);
		$row = $query->row_array();

		$data['row'] = $row;


		$this->load->view('event/edit_event', $data);

	}


	public function edit_event_ax()
	{

		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //todo authorisation

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
		// $this->config->set_item('language', 'armenian');
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('title', 'title', 'required');


		if ($this->form_validation->run() == false) {
			//validation errors
			$n = 1;

			$validation_errors = array(
				'title' => form_error('title')
			);
			$messages['error']['elements'][] = $validation_errors;
		}


		if ($n == 1) {
			echo json_encode($messages);
			return false;
		}


		$id = $this->input->post('event_id');
		$day = $this->input->post('day');
		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$staff = $this->input->post('staff');
		$fleet = $this->input->post('fleet');
		$company_id = $this->load->CallAPI('POST', $this->load->old_baseUrl() . 'Api/get_companyId', array('token' => $token));


		$sql = "
				UPDATE 
				  event
				SET
				  title = " . $this->load->db_value($title) . ",
				  date = " . $this->load->db_value($day) . ",
				  staff_id = " . $this->load->db_value($staff) . ",
				  fleet_id = " . $this->load->db_value($fleet) . ",
				  company_id = " . $this->load->db_value($company_id) . ",
				  description = " . $this->load->db_value($description) . "
				WHERE id =   " . $this->load->db_value($id) . "
			";

		$result = $this->db->query($sql);


		if ($result) {
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


	public function delete_event()
	{

		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //todo authorisation

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}

		$id = $this->input->post('event_id');


		$this->db->delete('event', array('id' => $id));

		return true;

	}

	public function sos()
	{
		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //todo authorisation

		$data = array();

		$sql = "
			SELECT 
				gps.\"id\",
				gps.\"lat\",
				gps.\"long\",
				gps.\"speed\",
				gps.\"course\",
				gps.\"sos_visibility\",
				CONCAT_WS(' ',
					gps.\"date\",
					gps.\"time\"
				) datetime,
				gps.\"imei\",
				gps.\"fuel\"
			FROM 
			   gps
			WHERE sos = '1'
			ORDER BY imei, date, time
		";

		$query = $this->db->query($sql);

		$data['result'] = $query->result_array();

		$this->layout->view('gps_tracking/sos', $data);
	}

	public function geoferences()
	{
		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //todo authorisation
		$data = array();
		$lng = $this->load->lng();

		$result = $this->db->select('geoference."id",geoference."name", geoference_cordinates.lat,geoference_cordinates.long')->from('geoference')->join('geoference_cordinates', 'geoference."id" = geoference_cordinates.geoference_id', 'left')->where('geoference.status', 1)->get()->result_array();

		$new_result = array();

		$count_of_fleets = $this->load->CallAPI('POST', $this->load->old_baseUrl() . $lng . '/Api/get_count_of_fleets', array('token' => $token));
		$data['count_of_fleets'] = json_decode($count_of_fleets, true);


		foreach ($result as $value) {
			$new_result[$value['name']][$value['id']][] = '[' . $value['lat'] . ',' . $value['long'] . ']';
		}

//		$this->pre($new_result);

		$data['result'] = $new_result;

		$this->layout->view('gps_tracking/geoferences', $data);
	}

	public function add_geoference_ax()
	{

		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //todo authorisation

		$this->load->library('session');
		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');
		$n = 0;
		$user_id = $this->session->user_id;
		$lng = $this->load->lng();

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


		if ($this->form_validation->run() == false) {
			//validation errors
			$n = 1;

			$validation_errors = array(
				'geo_name' => form_error('geo_name'),
				'geometry' => form_error('geometry')
			);
			$messages['error']['elements'][] = $validation_errors;
		}


		if ($n == 1) {
			echo json_encode($messages);
			return false;
		}


		$geo_name = $this->input->post('geo_name');
		$geometry = $this->input->post('geometry');
		$status = 1;
		$company_id = $this->load->CallAPI('POST', $this->load->old_baseUrl() . $lng . '/Api/get_companyId', array('token' => $token));


		$sql = "
				INSERT INTO 
				  \"geoference\"
				(name, company_id, status) VALUES 
				( '" . $geo_name . "', '" . $company_id . "', '" . $status . "')
		";

		$result = $this->db->query($sql);

		$geoference_id = $this->db->insert_id();


		$geometry = explode(',', $geometry);
		$lat = array();
		$long = array();
		foreach ($geometry as $key => $value) {
			if ($key == '0' || $key % 2 == 0) {
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
			$sql_cord .= "('" . $l . "', '" . $long[$i] . "', '" . $geoference_id . "', 1),";
		}

		$sql_cord = substr($sql_cord, 0, -1);
		$result_cord = $this->db->query($sql_cord);

		if ($result) {
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


	public function edit_geoference_ax()
	{

		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //todo authorisation

		$this->load->library('session');
		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');
		$n = 0;
		$user_id = $this->session->user_id;
		$lng = $this->load->lng();

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


		if ($this->form_validation->run() == false) {
			//validation errors
			$n = 1;

			$validation_errors = array(
				'geo_name' => form_error('geo_name'),
				'edit_geometry' => form_error('edit_geometry')
			);
			$messages['error']['elements'][] = $validation_errors;
		}


		if ($n == 1) {
			echo json_encode($messages);
			return false;
		}


		$geo_name = $this->input->post('geo_name');
		$geometry = $this->input->post('edit_geometry');
		$geoference_id = $this->input->post('edit_id');
		$status = 1;

		//get company ID
		$company_id = $this->load->CallAPI('POST', $this->load->old_baseUrl() . $lng . '/Api/get_companyId', array('token' => $token));

		// update geoference
		$this->db->update('geoference', array('name' => $geo_name), array('id' => $geoference_id));

		// delete old coordinates
		$this->db->delete('geoference_cordinates', array('geoference_id' => $geoference_id));


		$geometry = explode(',', $geometry);
		$lat = array();
		$long = array();
		foreach ($geometry as $key => $value) {
			if ($key == '0' || $key % 2 == 0) {
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
			$sql_cord .= "('" . $l . "', '" . $long[$i] . "', '" . $geoference_id . "', 1),";
		}

		$sql_cord = substr($sql_cord, 0, -1);
		$result_cord = $this->db->query($sql_cord);

		if ($result_cord) {
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


	public function delete_geoference()
	{

		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //todo authorisation

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}

		$id = $this->input->post('geo_id');

		$this->db->delete('geoference', array('id' => $id));

		$this->db->delete('geoference_cordinates', array('geoference_id' => $id));

		return true;
	}


	public function get_trajectory()
	{//todo

		$messages = array('success' => '0', 'message' => array(), 'error' => '', 'fields' => '');
		$n = 0;
		$token = $this->session->token;
		$lng = $this->load->lng();
		$result = false;

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}


		$this->load->library('form_validation');
		// $this->config->set_item('language', 'armenian');
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('from', 'from', 'required');
		$this->form_validation->set_rules('to', 'to', 'required');
		$this->form_validation->set_rules('fleets', 'fleets', 'required');


		if ($this->form_validation->run() == false) {
			//validation errors
			$n = 1;

			$validation_errors = array(
				'from' => form_error('from'),
				'to' => form_error('to'),
				'fleets' => form_error('fleets')
			);
			$messages['error']['elements'][] = $validation_errors;
		}


		if ($n == 1) {
			echo json_encode($messages);
			return false;
		}


		//imei
		$fleets = $this->input->post('fleets');
		$fleet_arr = explode(',', $fleets);

		$add_sql = 'AND (';

		foreach ($fleet_arr as $fleet) {
			if ($fleet != '') {
				$add_sql .= " gps.\"imei\" =  '" . $fleet . "' OR";
			}
		}

		$add_sql = substr($add_sql, 0, -2) . ')';
		//end imei

		$from = $this->input->post('from');
		$to = $this->input->post('to');

		//speed
		$max_speed = 0;
		$speed_yn = $this->input->post('speed_yn');
		if ($speed_yn == 1) {
			$max_speed = $this->input->post('speed');

			if ($max_speed == '') {
				$validation_errors = array('speed' => lang('required'));
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}
		}

		$engine = $this->input->post('engine');


		$sql = "
			SELECT 
				gps.\"id\",
				gps.\"lat\",
				gps.\"long\",
				gps.\"speed\",
				gps.\"course\",
				gps.\"time\",
				gps.\"date\",
				gps.\"imei\",
				gps.\"engine\"
			FROM 
			   gps
			WHERE CONCAT_WS(' ', gps.\"date\", gps.\"time\") >= '" . $from . "'
			 AND CONCAT_WS(' ', gps.\"date\", gps.\"time\") <= '" . $to . "'
			 " . $add_sql . "
		  ORDER BY date, time
		";

		$query = $this->db->query($sql);

		$result = $query->result_array();

		$new_result = array();


		$sql_avg = "
			SELECT 
				imei,
				AVG (gps.\"speed\") AS avg_speed
			FROM 
			   gps
			WHERE CONCAT_WS(' ', gps.\"date\", gps.\"time\") >= '" . $from . "'
			 AND CONCAT_WS(' ', gps.\"date\", gps.\"time\") <= '" . $to . "'
			 AND gps.\"speed\" <> 0
			 " . $add_sql . "
			GROUP BY gps.\"imei\" 
		";

		$query_avg = $this->db->query($sql_avg);

		$result_avg = $query_avg->result_array();

		$avg_arr = array();

		foreach ($result_avg as $val) {
			$avg_arr[$val['imei']] = $val['avg_speed'];
		}


		$date = '';
		$engine_result = array();
		$speed_null = array();


		if (count($result) > 0) {

			$lat = '';
			$long = '';
			$_imei = '';
			$fleet = array();
			$imei1 = '';

			$eng = '';
			$eng_res = array();
			$key_arr = array();
			$tmp = 0;

			foreach ($result as $k => $row) { //todo
				if (intval($row['speed']) === 0) {
					if ($k > 0) {
						if (isset($result[$k + 1]['lat']) && isset($result[$k + 1]['long']) && $row['lat'] == $result[$k + 1]['lat'] && $row['long'] == $result[$k + 1]['long']) {
							unset($result[$k]);
						}
					}
				}
			}

			// $this->pre($result);


			foreach ($result as $key => $value) {

				if ($lat != $value['lat'] && $long != $value['long']) {

					if (round($value['speed']) > 0) {

						if ($engine == 1) {
							if ($imei1 != $value['imei']) {
								if ($tmp == 0) {
									$eng_res[$value['imei']][] = array($value['engine'] => new DateTime($value['date'] . ' ' . $value['time']));
								}
								$tmp++;
							}
							$imei1 = $value['imei'];

							if ($eng != $value['engine']) {
								$eng_res[$value['imei']][] = array($value['engine'] => new DateTime($value['date'] . ' ' . $value['time']));
							}
							$eng = $value['engine'];
						}

						if ($_imei != $value['imei']) {
							$fl = $this->load->CallAPI('POST', $this->load->old_baseUrl() . $lng . '/Api/get_SingleFleetByImei', array('token' => $token, 'imei' => $value['imei']));
							$fleet[$value['imei']] = json_decode($fl, true);
						}
						$_imei = $value['imei'];

						if (((intval($value['speed']) - intval($max_speed)) > 0) && $max_speed > 0) {

							$new_result[$value['imei']][] = array(
								'time' => $value['date'] . ' ' . $value['time'],
								'cord' => '[' . $value['lat'] . ',' . $value['long'] . ']',
								'cord_qx' => '[' . $value['lat'] . ',' . $value['long'] . ']',
								'speed' => round($value['speed']),
								'speed_avg' => round($avg_arr[$value['imei']], 2),
								'fleet' => $fleet[$value['imei']]['brand_model'],
								'fleet_plate_number' => $fleet[$value['imei']]['fleet_plate_number'],
								'staff' => $fleet[$value['imei']]['staff'],
								'engine_power' => $value['engine'],
								'engine' => $engine,
								'course' => $value['course']
							);

						} else {

							$new_result[$value['imei']][] = array(
								'time' => $value['date'] . ' ' . $value['time'],
								'cord' => '[' . $value['lat'] . ',' . $value['long'] . ']',
								'speed' => round($value['speed']),
								'speed_avg' => round($avg_arr[$value['imei']], 2),
								'fleet' => $fleet[$value['imei']]['brand_model'],
								'fleet_plate_number' => $fleet[$value['imei']]['fleet_plate_number'],
								'staff' => $fleet[$value['imei']]['staff'],
								'engine_power' => $value['engine'],
								'engine' => $engine,
								'course' => $value['course']
							);
						}


					}

				}
				$lat = $value['lat'];
				$long = $value['long'];

				if (intval($value['speed']) === 0) {
					$speed_null[$value['imei']][] = array($value['speed'] => new DateTime($value['date'] . ' ' . $value['time']));
				} else {
					$speed_null[$value['imei']][] = array($value['speed'] => new DateTime($value['date'] . ' ' . $value['time']));
				}
			}


			//$result = true;


			// power off or on
			$power = array();
			if ($engine == 1) {
				$date1 = new DateTime("00:00:00");
				$date2 = new DateTime("00:00:00");
				foreach ($eng_res as $imei => $eng_arr) {
					foreach ($eng_arr as $k => $e_arr) {
						if ($k > 0) {

							$first = $eng_arr[$k - 1][key($eng_arr[$k - 1])];

							if (key($e_arr) == 1) {
								$duration2 = $first->diff($e_arr[key($e_arr)]);
								$date2->add($duration2);
								$power[$imei]['off'] = $date2->format("H:i:s");
							} elseif (key($e_arr) == 0) {
								$duration1 = $first->diff($e_arr[key($eng_arr[$k])]);
								$date1->add($duration1);
								$power[$imei]['on'] = $date1->format("H:i:s");
							}

						}
					}
				}
			}


			// speed null
			$null_speed = array();
			$date3 = new DateTime("00:00:00");
			foreach ($speed_null as $imei => $sp_arr) {
				foreach ($sp_arr as $k => $s_arr) {
					if ($k > 0) {
						$last = $sp_arr[$k - 1][key($sp_arr[$k - 1])];

						if (key($s_arr) == 0) {
							$duration = $last->diff($s_arr[key($sp_arr[$k])]);
							$date3->add($duration);
							$null_speed[$imei] = $date3->format("H:i:s");
						}

					}
				}
			}
		}

//		$this->pre($speed_null);
		//$this->pre($power);
		//$this->pre($null_speed);

		if ($result) {
			$messages['success'] = 1;
			$messages['message']['imei'] = $new_result;
			$messages['message']['power'] = $power;
			$messages['message']['null_speed'] = $null_speed;
		} else {
			$messages['success'] = 0;
			$messages['error'] = 'Error';
		}

		// Return success or error message
		echo json_encode($messages);
		return true;


	}


	public function get_fuel()
	{//todo

		$messages = array('success' => '0', 'message' => array(), 'error' => '', 'fields' => '');
		$n = 0;
		$token = $this->session->token;
		$lng = $this->load->lng();
		$result = false;

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}


		$this->load->library('form_validation');
		// $this->config->set_item('language', 'armenian');
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('from', 'from', 'required');
		$this->form_validation->set_rules('to', 'to', 'required');
		$this->form_validation->set_rules('fleets', 'fleets', 'required');


		if ($this->form_validation->run() == false) {
			//validation errors
			$n = 1;

			$validation_errors = array(
				'from' => form_error('from'),
				'to' => form_error('to'),
				'fleets' => form_error('fleets')
			);
			$messages['error']['elements'][] = $validation_errors;
		}


		if ($n == 1) {
			echo json_encode($messages);
			return false;
		}


		//imei
		$fleets = $this->input->post('fleets');
		$fleet_arr = explode(',', $fleets);

		$add_sql = 'AND (';

		foreach ($fleet_arr as $fleet) {
			if ($fleet != '') {
				$add_sql .= " gps.\"imei\" =  '" . $fleet . "' OR";
			}
		}

		$add_sql = substr($add_sql, 0, -2) . ')';
		//end imei

		$from = $this->input->post('from');
		$to = $this->input->post('to');

		$company_id = $this->load->CallAPI('POST', $this->load->old_baseUrl() . $lng . '/Api/get_companyId', array('token' => $token));

		$sql_config = "
			SELECT 
				threshold_of_refueling,
				drain_threshold
			FROM 
				config
			WHERE company_id = '".$company_id."'	
		";

		$query_config = $this->db->query($sql_config);
		$config = $query_config->row_array();

		$threshold_of_refueling = $this->config->item('threshold_of_refueling');
		$drain_threshold = $this->config->item('drain_threshold');

		if($query_config->num_rows() == 1) {
			$threshold_of_refueling = $config['threshold_of_refueling'];
			$drain_threshold = $config['drain_threshold'];
		}



		$sql = "
			SELECT 
				gps.\"id\",
				gps.\"lat\",
				gps.\"long\",
				gps.\"speed\",
				gps.\"course\",
				CONCAT_WS(' ',
					gps.\"date\",
					gps.\"time\"
				) datetime,
				gps.\"time\",
				gps.\"date\",
				gps.\"imei\",
				gps.\"fuel\"
			FROM 
			   gps
			WHERE CONCAT_WS(' ', gps.\"date\", gps.\"time\") >= '" . $from . "'
			 AND CONCAT_WS(' ', gps.\"date\", gps.\"time\") <= '" . $to . "'
			 " . $add_sql . "
			ORDER BY id 
		";

		$query = $this->db->query($sql);
		$result = $query->result_array();

		$new_result = array();
		$date_array = array();
		//date_timestamp_get


		$tmp = 0;
		$_tmp = 1;
		$step_refueling = -$threshold_of_refueling;
		$step_drain = -$drain_threshold;
		$array_length = count($result);

		$fuel = '';

		$avg_all = 0;
		$avg_counter = 0;

		$drain = 0;
		$drain_counter = 0;

		$refueling = 0;
		$refueling_counter = 0;

		$fleet = array();
		$_imei = '';

		$levelStart = 0;
		$levelFinish = 0;

		foreach ($result as $row) {
			$date = new DateTime($row['datetime']);


			$new_result[] = array(
				(float)$row['fuel']
			);

			$date_array[] = array(
				$date->format('Y-m-d H:i:s')
			);


			if ($_imei != $row['imei']) {
				$fl = $this->load->CallAPI('POST', $this->load->old_baseUrl() . $lng . '/Api/get_SingleFleetByImei', array('token' => $token, 'imei' => $row['imei']));
				$fleet = json_decode($fl, true);
				$fuel = $fleet['fuel'];
			}
			$_imei = $row['imei'];

			if ($tmp == 0) {
				$levelStart = (float)$row['fuel'];
			}

			$levelFinish = (float)$row['fuel'];


			if ($_tmp < $array_length) {
				if (((float)$result[$_tmp]['fuel'] - (float)$row['fuel'] >= (float)($step_refueling)) && ((float)$result[$_tmp]['fuel'] - (float)$row['fuel'] >= (float)($step_drain)) && (float)$result[$_tmp]['fuel'] - (float)$row['fuel'] > 0) {
					$avg_all += abs((float)$result[$_tmp]['fuel'] - (float)$row['fuel']);
					$avg_counter++;
				} else if ((float)$result[$_tmp]['fuel'] - (float)$row['fuel'] < (float)($step_drain)) {
					$drain += abs((float)$result[$_tmp]['fuel'] - (float)$row['fuel']);
					$drain_counter++;
				} else if ((float)$row['fuel'] - (float)$result[$_tmp]['fuel'] < (float)($step_refueling)) {
					$refueling += abs((float)$result[$_tmp]['fuel'] - (float)$row['fuel']);
					$refueling_counter++;
				}
			}

			$tmp++;
			$_tmp++;
		}

		//echo 'Уровень в начале периода '.$levelStart.br();
		//echo 'Уровень в конце периода '.$levelFinish.br();
		//echo 'Общий расход топлива '.$avg_all.br();
		//echo 'Количество заправок '.$refueling_counter.br();
		//echo 'Количество сливов '.$drain_counter.br();
		//echo 'Объём заправок '.$refueling.br();
		//echo 'Объём сливов '.$drain.br();
		//echo 'Средний '.$avg_all/$avg_counter.br();

		$fleet_info = '<table id="example12" class="table table-striped table-borderless w-100 dataTable no-footer">
	<thead>
		<tr>
			<th style="font-size: 12px !important;font-weight: 500;text-align: center;">' . lang("fleets") . '</th>
			<th style="font-size: 12px !important;font-weight: 500;text-align: center;">' . lang("Level_At_The_Beginning") . '</th>
			<th style="font-size: 12px !important;font-weight: 500;text-align: center;">' . lang('total_consumption') . '</th>
			<th style="font-size: 12px !important;font-weight: 500;text-align: center;">' . lang("number_charges") . '</th>
			<th style="font-size: 12px !important;font-weight: 500;text-align: center;">' . lang('engine_consumption') . '</th>
			<th class="engineOnOf" style="font-size: 12px !important;font-weight: 500;">' . lang('drain_counter') . '</th>
			<th style="font-size: 12px !important;font-weight: 500;text-align: center;">' . lang('drain') . '</th>
			<th style="font-size: 12px !important;font-weight: 500;text-align: center;">' . lang('levelFinish') . '</th>
			<th class="engineOnOf" style="font-size: 12px !important;font-weight: 500;">' . lang('middle') . '</th>
		</tr>
	</thead>
	<tbody class="example_12_tbody">
		<tr>
			<td style="text-align: center;">' . (isset($fleet['brand_model']) ? $fleet['brand_model'] : '') . '</td>
			<td style="text-align: center;">' . $levelStart . '</td>
			<td style="text-align: center;">' . $avg_all . '</td>
			<td style="text-align: center;">' . $refueling_counter . '</td>
			<td style="text-align: center;">' . $refueling . '</td>
			<td style="text-align: center;">' . $drain_counter . '</td>
			<td style="text-align: center;">' . $drain . '</td>
			<td style="text-align: center;">' . $levelFinish . '</td>
			<td style="text-align: center;">' . ($avg_counter == 0 ? 0 : $avg_all / $avg_counter ) . '</td>
		</tr>
	</tbody>
</table>';


		// $this->pre($new_result);


		if ($result) {
			$messages['success'] = 1;
			$messages['message']['fleet_info'] = $fleet_info;
			$messages['message']['fleet_chart'] = $new_result;
			$messages['message']['date_array'] = $date_array;
			$messages['message']['fuel'] = $fuel;
		} else {
			$messages['success'] = 0;
			$messages['error'] = 'Error';
		}

		// Return success or error message
		echo json_encode($messages);
		return true;


	}


	public function sos_visibility()
	{

		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //todo authorisation

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}

		$id = $this->input->post('gps_id');
		$sos_visibility = $this->input->post('sos_visibility');
		$count_unread = $this->input->post('count_unread');

		$this->session->set_userdata('unread', $count_unread);

		$sql = "UPDATE gps SET sos_visibility = '" . $sos_visibility . "' WHERE id = '" . $id . "'";
		$query = $this->db->query($sql);


		if ($query) {
			echo 1;
		} else {
			echo -1;
		}


		return true;


	}


	public function get_location()
	{

		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //todo authorisation

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}

		$fleets = $this->input->post('fleets');

		$add_sql = '';
		foreach (explode(',', $fleets) as $imei) {
			$add_sql .= " gps.\"imei\" = '" . $imei . "' OR";
		}

		$add_sql = substr($add_sql, 0, -2);

		$sql = "
			SELECT 
				gps.\"id\",
				gps.\"lat\",
				gps.\"long\",
				gps.\"speed\",
				gps.\"course\",
				gps.\"time\",
				gps.\"date\",
				gps.\"imei\",
				gps.\"engine\"
			FROM 
			   gps
			WHERE " . $add_sql . "
		 	ORDER BY imei, 
		 	CONCAT_WS (' ',
		 	   gps.\"date\",
			   gps.\"time\"
		    ) desc
		";


		$query = $this->db->query($sql);

		$last_location = $query->result_array();

		$tmp = 0;
		$imei = '';
		$arr = array();

		foreach ($last_location as $val) {
			if ($imei != $val['imei']) {
				if ($tmp == 0) {
					$arr[$val['imei']] = array('lat' => $val['lat'], 'long' => $val['long'], 'date' => $val['date'], 'time' => $val['time'], 'course' => $val['course']);
				}
				$tmp = 1;
			} else {
				$tmp = 0;
			}
			$imei = $val['imei'];
		}

		echo json_encode($arr);
		return true;
	}


	public function get_trajectory_load()
	{//todo

		$messages = array('success' => '0', 'message' => array(), 'error' => '', 'fields' => '');
		$n = 0;
		$token = $this->session->token;
		$lng = $this->load->lng();
		$result = false;

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}


		$this->load->library('form_validation');
		// $this->config->set_item('language', 'armenian');
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('from', 'from', 'required');
		$this->form_validation->set_rules('to', 'to', 'required');
		$this->form_validation->set_rules('fleets', 'fleets', 'required');


		if ($this->form_validation->run() == false) {
			//validation errors
			$n = 1;

			$validation_errors = array(
				'from' => form_error('from'),
				'to' => form_error('to'),
				'fleets' => form_error('fleets')
			);
			$messages['error']['elements'][] = $validation_errors;
		}


		if ($n == 1) {
			echo json_encode($messages);
			return false;
		}


		//imei
		$fleets = $this->input->post('fleets');
		$fleet_arr = explode(',', $fleets);

		$add_sql = 'AND (';

		foreach ($fleet_arr as $fleet) {
			if ($fleet != '') {
				$add_sql .= " gps.\"imei\" =  '" . $fleet . "' OR";
			}
		}

		$add_sql = substr($add_sql, 0, -2) . ')';
		//end imei

		$from = $this->input->post('from');
		$to = $this->input->post('to');


		$sql = "
			SELECT 
				gps.\"id\",
				gps.\"lat\",
				gps.\"long\",
				gps.\"speed\",
				gps.\"course\",
				gps.\"time\",
				gps.\"date\",
				gps.\"imei\",
				gps.\"load\",
				gps.\"engine\"
			FROM 
			   gps
			WHERE  CONCAT_WS(' ', gps.\"date\", gps.\"time\") >= '" . $from . "'
			 AND CONCAT_WS(' ', gps.\"date\", gps.\"time\") <= '" . $to . "'
			 " . $add_sql . "
		  ORDER BY date, time
		";

		$query = $this->db->query($sql);

		$result = $query->result_array();

		$new_result = array();


		$date = '';
		$load_result = array();
		$speed_null = array();
		$imei1 = '';


		if (count($result) > 0) {

			$lat = '';
			$long = '';
			$_imei = '';
			$fleet = array();
			$tmp = 0;
			$load = '';
			foreach ($result as $value) {


				if (round($value['speed']) > 0) {
					if ($imei1 != $value['imei']) {
						if ($tmp == 0) {
							$load_result[$value['imei']][] = array($value['load'] => new DateTime($value['date'] . ' ' . $value['time']));
						}
						$tmp++;
					}
					$imei1 = $value['imei'];
					if ($load != $value['load']) {
						$load_result[$value['imei']][] = array($value['load'] => new DateTime($value['date'] . ' ' . $value['time']));
					}
					$load = $value['load'];
				}


				if ($lat != $value['lat'] && $long != $value['long']) {

					if (round($value['speed']) > 0) {
						$fl = '';
						if ($_imei != $value['imei']) {
							$fl = $this->load->CallAPI('POST', $this->load->old_baseUrl() . $lng . '/Api/get_SingleFleetByImei', array('token' => $token, 'imei' => $value['imei']));
							$fleet[$value['imei']] = json_decode($fl, true);
						}
						$_imei = $value['imei'];

						if ($value['load'] == 1) {

							$new_result[$value['imei']][] = array(
								'time' => $value['date'] . ' ' . $value['time'],
								'cord' => '[' . $value['lat'] . ',' . $value['long'] . ']',
								'cord_qx' => '[' . $value['lat'] . ',' . $value['long'] . ']',
								'speed' => round($value['speed']),
								'fleet' => $fleet[$value['imei']]['brand_model'],
								'fleet_plate_number' => $fleet[$value['imei']]['fleet_plate_number'],
								'staff' => $fleet[$value['imei']]['staff'],
								'course' => $value['course']
							);

						} else {

							$new_result[$value['imei']][] = array(
								'time' => $value['date'] . ' ' . $value['time'],
								'cord' => '[' . $value['lat'] . ',' . $value['long'] . ']',
								'speed' => round($value['speed']),
								'fleet' => $fleet[$value['imei']]['brand_model'],
								'fleet_plate_number' => $fleet[$value['imei']]['fleet_plate_number'],
								'staff' => $fleet[$value['imei']]['staff'],
								'course' => $value['course']
							);
						}


					}
				}
				$lat = $value['lat'];
				$long = $value['long'];
			}

			$result = true;

		}

		// load  yes no
		$load = array();
		$date1 = new DateTime("00:00:00");
		$date2 = new DateTime("00:00:00");
		if (count($load_result) > 0) {
			foreach ($load_result as $imei => $load_arr) {
				foreach ($load_arr as $k => $l_arr) {
					if ($k > 0) {
						//$this->pre($eng_arr[$k - 1]);
						$last = $load_arr[$k - 1][key($load_arr[$k - 1])];

						if (key($l_arr) == 1) {
							$duration2 = $last->diff($l_arr[key($load_arr[$k])]);
							$date2->add($duration2);
							$load[$imei]['off'] = $date2->format("H:i:s");
						} elseif (key($l_arr) == -1) {
							$duration1 = $last->diff($l_arr[key($load_arr[$k])]);
							$date1->add($duration1);
							$load[$imei]['on'] = $date1->format("H:i:s");
						}

					}
				}
			}
		}


		//$this->pre($new_result);
		//$this->pre($power);
		//$this->pre($null_speed);

		if ($result) {
			$messages['success'] = 1;
			$messages['message']['imei'] = $new_result;
			$messages['message']['load'] = $load;
		} else {
			$messages['success'] = 0;
			$messages['error'] = 'Error';
		}

		// Return success or error message
		echo json_encode($messages);
		return true;


	}


}
//end of class
