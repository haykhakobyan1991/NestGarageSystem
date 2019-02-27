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

		$token = $this->input->get('token');


		$sql = "
			SELECT token FROM \"user\" where token = '".$token."'
		";

		$query = $this->db->query($sql);
		$num_rows = $query->num_rows();

		if($num_rows == 0) {
			$this->db->insert('user', array('token' => $token));
		}

		$lng = $this->load->lng();

		$this->session->set_userdata(array('token' => $token));

		redirect($lng.'/gps_tracking', 'location');//todo
	}



	public function gps_tracking() {



		$token = $this->session->token;
		$this->load->authorisation('Gps', 'gps_tracking', $token); //authorisation


		$data = array();

		$lng = $this->load->lng();


		//api call //todo urls
		$fleets = $this->load->CallAPI('POST', 'http://localhost/NestGarageSystem/hy/Api/get_AllFleets', array('token' => $token)); //todo url
		$data['result_fleets'] = json_decode($fleets, true);

		$fleet_group = $this->load->CallAPI('POST', 'http://localhost/NestGarageSystem/hy/Api/get_FleetGroup', array('token' => $token)); //todo url
		$data['result'] = json_decode($fleet_group, true);

		$company_id = $this->load->CallAPI('POST', 'http://localhost/NestGarageSystem/hy/Api/get_companyId', array('token' => $token)); //todo url

		 $sql_g = '
			SELECT 
				"id",
				"name"
			FROM 
			   "geoference"
			WHERE "status" = 1 
			AND "company_id" = '.$company_id.'
		';

		$query_g = $this->db->query($sql_g);
		$data['geoference'] = $query_g->result_array();

		$result = $this->db->select('geoference."id",geoference."name", geoference_cordinates.lat,geoference_cordinates.long')->from('geoference')->join('geoference_cordinates', 'geoference."id" = geoference_cordinates.geoference_id', 'left')->where('geoference.status', 1)->get()->result_array();

		$new_result = array();


		foreach ($result as $value) {
			$new_result[$value['name']][$value['id']][] = '['.$value['lat'].','.$value['long'].']';
		}

		foreach ($new_result as $val) {
			foreach ($val as $id => $value) {
				$new_result2[$id] = $value;
			}
		}

//		$this->pre($new_result);
//		$this->pre($new_result2);

		$data['result2'] = $new_result;
		$data['new_result'] = $new_result2;


		$this->layout->view('gps_tracking/gps_tracking', $data);

	}

	public function speed() {
		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //authorisation
		$this->layout->view('gps_tracking/speed');
	}

	public function trajectory() {
		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //authorisation

		$data = array();

		//api call //todo urls
		$fleets = $this->load->CallAPI('POST', 'http://localhost/NestGarageSystem/hy/Api/get_AllFleets', array('token' => $token)); //todo url
		$data['result_fleets'] = json_decode($fleets, true);


		$this->layout->view('gps_tracking/trajectory', $data);
	}

	public function fuel() {
		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //authorisation

		$data = array();

		//api call //todo urls
		$fleets = $this->load->CallAPI('POST', 'http://localhost/NestGarageSystem/hy/Api/get_AllFleets', array('token' => $token)); //todo url
		$data['result_fleets'] = json_decode($fleets, true);

		$this->layout->view('gps_tracking/fuel', $data);
	}

	public function sos() {
		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //authorisation

		$data = array();

		$sql  = "
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

	public function geoferences() {
		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //authorisation
		$data = array();

		$result = $this->db->select('geoference."id",geoference."name", geoference_cordinates.lat,geoference_cordinates.long')->from('geoference')->join('geoference_cordinates', 'geoference."id" = geoference_cordinates.geoference_id', 'left')->where('geoference.status', 1)->get()->result_array();

		$new_result = array();

		$count_of_fleets = $this->load->CallAPI('POST', 'http://localhost/NestGarageSystem/hy/Api/get_count_of_fleets', array('token' => $token)); //todo url
		$data['count_of_fleets'] = json_decode($count_of_fleets, true);


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
		$company_id = $this->load->CallAPI('POST', 'http://localhost/NestGarageSystem/hy/Api/get_companyId', array('token' => $token)); //todo url


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

		//get company ID
		$company_id = $this->load->CallAPI('POST', 'http://localhost/NestGarageSystem/hy/Api/get_companyId', array('token' => $token)); //todo url

		// update geoference
		$this->db->update('geoference', array('name' => $geo_name), array('id' => $geoference_id));

		// delete old coordinates
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


	public function delete_geoference() {

		$token = $this->session->token;
		//$this->load->authorisation('Gps', 'gps_tracking', $token); //authorisation

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


	public function get_trajectory() {//todo

		$messages = array('success' => '0', 'message' => array(), 'error' => '', 'fields' => '');
		$n = 0;
		$token = $this->session->token;
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



		if($this->form_validation->run() == false){
			//validation errors
			$n = 1;

			$validation_errors = array(
				'from' => form_error('from'),
				'to' => form_error('to'),
				'fleets' => form_error('fleets')
			);
			$messages['error']['elements'][] = $validation_errors;
		}


		if($n == 1) {
			echo json_encode($messages);
			return false;
		}


		//imei
		$fleets = $this->input->post('fleets');
		$fleet_arr = explode(',', $fleets);

		$add_sql = 'AND (';

		foreach ($fleet_arr as $fleet) {
			if($fleet != '') {
				$add_sql .= " gps.\"imei\" =  '".$fleet."' OR";
			}
		}

		$add_sql = substr($add_sql, 0, -2).')';
		//end imei

		$from = $this->input->post('from');
		$to = $this->input->post('to');

		//speed
		$max_speed = 0;
		$speed_yn = $this->input->post('speed_yn');
		if($speed_yn == 1) {
			$max_speed = $this->input->post('speed');

			if ($max_speed == '') {
				$validation_errors = array('speed' => lang('required'));
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}
		}

		$engine =  $this->input->post('engine');


	    $sql  = "
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
			WHERE gps.\"date\" >= '".$from."'
			 AND gps.\"date\" <= '".$to."'
			 ".$add_sql."
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
			WHERE gps.\"date\" >= '".$from."'
			 AND gps.\"date\" <= '".$to."'
			 AND gps.\"speed\" <> 0
			 ".$add_sql."
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


		if(count($result) > 0) {

			$lat = '';
			$long = '';
			$_imei = '';
			$fleet = array();


			foreach ($result as $value) {

				if($engine == 1) {
					if($value['engine'] == 1) {
						$engine_result[$value['imei']]['on'][$value['date']][] = $value['time'];
					} elseif ($value['engine'] == 0) {
						$engine_result[$value['imei']]['off'][$value['date']][] = $value['time'];
					}
				}



				if($lat != $value['lat'] && $long != $value['long']) {

					if(round($value['speed']) > 0) {
						$fl = '';
						if($_imei != $value['imei']) {
							$fl = $this->load->CallAPI('POST', 'http://localhost/NestGarageSystem/hy/Api/get_SingleFleetByImei', array('token' => $token, 'imei' => $value['imei'])); //todo url
							$fleet[$value['imei']] =  json_decode($fl, true);
						}
						$_imei = $value['imei'];

						if(((intval($value['speed']) - intval($max_speed)) > 0) && $max_speed != 0) {

							$new_result[$value['imei']][] = array(
								'time' => $value['date'].' '.$value['time'],
								'cord' => '['.$value['lat'].','.$value['long'].']',
								'cord_qx' => '['.$value['lat'].','.$value['long'].']',
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
								'time' => $value['date'].' '.$value['time'],
								'cord' => '['.$value['lat'].','.$value['long'].']',
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



					} else {
						$speed_null[$value['imei']][$value['date']][] = $value['time'];
					}
				}
				$lat = $value['lat'];
				$long = $value['long'];
			}

			$result = true;

		}

		// power off or on
		$_date = '';
		$_date2 = '';
		$power = array();
		$date1 = new DateTime("00:00:00");
		$date2 = new DateTime("00:00:00");

		if($engine == 1) {
			if (count($engine_result) > 0) {
				foreach ($engine_result as $imei => $er) {
					foreach ($er as $on_off => $date_arr) {
						foreach ($date_arr as $date => $time) {

							if ($on_off == 'on') {
								$duration1 = 0;
								if($_date != $date) {
									$startTime = new DateTime($time[0]);
									$endTime = new DateTime(end($time));
									$duration1 = $startTime->diff($endTime);

								}
								$_date = $date;
								$date1->add($duration1);
								$power[$imei][$on_off] = $date1->format("H:i:s");
							} elseif ($on_off == 'off') {
								$duration2 = 0;
								if($_date2 != $date) {
									$startTime = new DateTime($time[0]);
									$endTime = new DateTime(end($time));
									$duration2 = $startTime->diff($endTime);

								}
								$_date2 = $date;

								$date2->add($duration2);
								$power[$imei][$on_off] = $date2->format("H:i:s");
							}

						}
					}
				}
			}
		}

		$null_speed = array();
		$date_ = '';

		$date3 = new DateTime("00:00:00");
		foreach ($speed_null as $imei => $d_arr) {
			foreach ($d_arr as $date => $time) {
				$duration = 0;
				if($date_ != $date) {
					$startTime = new DateTime($time[0]);
					$endTime = new DateTime(end($time));
					$duration = $startTime->diff($endTime);
				}
				$date_ = $date;
				$date3->add($duration);
				$null_speed[$imei] = $date3->format("H:i:s");
			}
		}



		//$this->pre($new_result);
		//$this->pre($power);
		//$this->pre($null_speed);

		if ($result){
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


	public function get_fuel() {//todo

		$messages = array('success' => '0', 'message' => array(), 'error' => '', 'fields' => '');
		$n = 0;
		$token = $this->session->token;
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



		if($this->form_validation->run() == false){
			//validation errors
			$n = 1;

			$validation_errors = array(
				'from' => form_error('from'),
				'to' => form_error('to'),
				'fleets' => form_error('fleets')
			);
			$messages['error']['elements'][] = $validation_errors;
		}


		if($n == 1) {
			echo json_encode($messages);
			return false;
		}


		//imei
		$fleets = $this->input->post('fleets');
		$fleet_arr = explode(',', $fleets);

		$add_sql = 'AND (';

		foreach ($fleet_arr as $fleet) {
			if($fleet != '') {
				$add_sql .= " gps.\"imei\" =  '".$fleet."' OR";
			}
		}

		$add_sql = substr($add_sql, 0, -2).')';
		//end imei

		$from = $this->input->post('from');
		$to = $this->input->post('to');




		$sql  = "
			SELECT 
				gps.\"id\",
				gps.\"lat\",
				gps.\"long\",
				gps.\"speed\",
				gps.\"course\",
				gps.\"time\",
				gps.\"date\",
				gps.\"imei\",
				gps.\"fuel\"
			FROM 
			   gps
			WHERE gps.\"date\" >= '".$from."'
			 AND gps.\"date\" <= '".$to."'
			 ".$add_sql."
		
		";

		$query = $this->db->query($sql);

		$result = $query->result_array();

		$new_result = array();

		$zapravkaCount = 0;
		$zapravkaCounter = 0;
		$slivCount = 0;
		$slivCounter = 0;

		$zapravkaObyom = 0;
		$slivObyom = 0;

		$lastUroven = -1;

		$totalDistance = 0;
		$bernvac = 0;

		$ancumnerCount = 0;

		$R = 6371;

		$a = 0;
		foreach ($result as $row) {

//			if(isset($lastButton5)){
//
//				if(($row["button_5"]==1 && $lastButton5==0) || ($row["button_5"]==0 && $lastButton5==1)){
//
//					$ancumnerCount++;
//
//				}
//
//			}

//			$lastButton5=$row["button_5"];

			if (isset($last)) {

//				if($row["button_6"]==1 && $last["button_6"]==0){
//					$bernvac++;
//				}

				$lat1 = $last["lat"];
				$lon1 = $last["long"];
				$lat2 = $row["lat"];
				$lon2 = $row["long"];

				$dd = acos(sin($lat1) * sin($lat2) + cos($lat1) * cos($lat2) * cos($lon2 - $lon1)) * $R;

				if (strtolower($dd) == "nan") {
					$dd = 0;
				}

				$totalDistance += $dd;
			}

			$last = $row;


			if ($a == 0) {
				$urovenStart = (float)$row["adc_1"] * $carData["coific_1"];
				$uroven2Start = (float)$row["adc_2"];
			}

			$urovenFinish = (float)$row["adc_1"] * $carData["coific_1"];
			$uroven2Finish = (float)$row["adc_2"];


			if ($lastUroven != -1) {

				if ($lastUroven - (float)$row["adc_1"] >= 1) {
					if ($slivCounter == 0) {
						$slivCount++;
						$slivStart = $lastUroven * $carData["coific_1"];
					}
					$slivCounter = 1;
				} else {
					if ($slivCounter == 1) {
						$slivObyom += $slivStart - ($lastUroven * $carData["coific_1"]);
					}
					$slivCounter = 0;
				}

				if ((float)$row["adc_1"] - $lastUroven >= 1) {
					if ($zapravkaCounter == 0) {
						$zapravkaCount++;
						$zapravkaStart = $lastUroven;
					}
					$zapravkaCounter = 1;
				} else {
					if ($zapravkaCounter == 1) {
						$zapravkaObyom += ($lastUroven * $carData["coific_1"]) - $zapravkaStart;
					}
					$zapravkaCounter = 0;
				}

			}

			$lastUroven = (float)$row["adc_1"];


			$a++;

		}

//
//		$table = '<table id="example" class="table table-striped table-borderless w-100 dataTable no-footer">
//					<thead class="thead_tables">
//						<tr>
//							<th class="table_th">'.lang('fleet').'</th>
//							<th class="table_th">'.lang('type').'</th>
//							<th class="table_th">'.lang('vehicle').'</th>
//							<th class="table_th">'.lang('price').' (AMD)</th>
//						</tr>
//					</thead>
//					<tbody>';
//
//		foreach ($result as $value) {
//
//			$fl = $this->load->CallAPI('POST', 'http://localhost/NestGarageSystem/hy/Api/get_SingleFleetByImei', array('token' => $token, 'imei' => $value['imei'])); //todo url
//			$fleet =  json_decode($fl, true);
//
//			$table .= '<tr>';
//			$table .= '<td class="border">'.$fleet.'</td>';
//			$table .= '<td class="border">'.lang($fleet).'</td>';
//			$table .= '<td class="border">'.$fleet.'</td>';
//			$table .= '<td class="price border">'.$fleet.'</td>';
//			$table .= '</tr>';
//
//
//			$new_result[] = array();
//
//		}
//
//		$table .= '</tbody>
//		</table>';










		$this->pre($result);


		if ($result){
			$messages['success'] = 1;
			$messages['message']['imei'] = $new_result;
		} else {
			$messages['success'] = 0;
			$messages['error'] = 'Error';
		}

		// Return success or error message
		echo json_encode($messages);
		return true;


	}

	public function aaaa() {

		//$sql = "DELETE FROM gps WHERE \"imei\" = '865205035287845'";

		$result = $this->db->select('*')->from('"gps"')//->where('"imei"',  '865205035287845')->order_by('id', 'desc')
		->get()->result_array();


		echo count($result);
//
//		$i = 62;
//
//		foreach ($result as $val) {
//$i -= 0.25;
//			echo $sql1 = "UPDATE \"gps\" SET fuel = '".$i."' WHERE id='".$val['id']."';".br();
//
//		}


		$this->pre($result);



	}

	public function insert_gps() {

		$tr = "TRUNCATE TABLE gps";
		$query_tr = $this->db->query($tr);

		if($query_tr) {
			echo 'TRUNCATE'.br();
		} else {
			echo 'TRUNCATE FALSE'.br();
		}

		$result = $this->db->select('"1", "3", "5", "7", "9", "10", "11", "12"')->from('aaaa')->where('"1"',  '865205035287688')
			->get()->result_array();

		$sql = "INSERT INTO gps (imei,\"time\",lat,long,speed,course,\"date\", engine, fuel, battery, sos, battery_low) VALUES ";

		$power = 0;
		$fuel = 47;
		$_time = '';

		foreach ($result as $val) {


			//lat
			$lat_h = substr(floatval($val[5]), 0, 2);
			$lat_m = substr(floatval($val[5]), 2, 10);

			$lat = round($lat_h+($lat_m/60), 6);

			//long
			$long_h = substr(floatval($val[7]), 0, 2);
			$long_m = substr(floatval($val[7]), 2, 10);

			$long = round($long_h+($long_m/60), 6);

			//time
			$time = substr($val[3], 0, -4).':'.substr($val[3], 2, -2).':'.substr($val[3], 4, 2);

			if($_time != $time && $val[9] != 0) {
				$fuel -= 0.27;
			}
			$_time = $time;

			//date
			$date =  date('20'.substr($val[11], 4, 2).'-'.substr($val[11], 2, -2).'-'.substr($val[11], 0, -4));

			//EFE7FBFF - power on
			//FFFFFBFF - power off

			$bin = str_split(base_convert($val[12], 16,2));

			$battery_supply = $bin[3]; //yes - 1, no - 0
			$sos = $bin[13];//yes - 0, no - 1
			$battery_low = $bin[19];//yes - 1, no - 0
			$engine = $bin[20];//yes - 1, no - 0



			$sql .= "('".($val[1])."', '".$time."', '".$lat."', '".$long."', '".($val[9] * 1.609344)."', '".$val[10]."','".$date."', '".$engine."', '".$fuel."', '".$battery_supply."', '".$sos."', '".$battery_low."' ),";
		}

		 $sql = substr($sql, 0, -1);



		$query = $this->db->query($sql);

		if($query_tr) {
			echo 'INSERTED'.br();
		} else {
			echo 'INSERT FALSE'.br();
		}
	}





}
//end of class
