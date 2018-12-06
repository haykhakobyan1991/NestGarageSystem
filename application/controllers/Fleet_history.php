<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Fleet_history extends MX_Controller {

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
	 * @return mixed
	 */
	private function upload_config() {


		$config['allowed_types']        = 'gif|jpg|png|bmp';
		$config['max_size'] 			= '4097152'; //4 MB
		$config['file_name']			= $this->uname(3,8);
		$config['max_width']            = '2048';
		$config['max_height']           = '1200';

		$this->load->library('upload', $config);

		$this->upload->initialize($config);

		return $config;

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
	 * @param $text
	 * @return string
	 */
	public function get_first_character($text) {
		return mb_substr($text,0,1, 'utf-8');
	}

	/**
	 * @return string
	 */
	public function rand_color() {
		return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
	}


	public function expenses_history() {

		$this->layout->view('fleet_history/expenses_history');

	}




	//--------------
	public function getHistory_ax () {

		$user_id = $this->session->user_id;
		$row = $this->db->select('company_id')->from('user')->where('id', $user_id)->get()->row_array();
		$company_id = $row['company_id'];

		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');
		$table = $this->input->post('table');
		$arr = $this->input->post('arr');


		$this->getHistory($date_from, $date_to, $table, $arr);

	}



	public function getHistory($date_from, $date_to, $table_name, $arr) {

		$lng = $this->load->lng();

		$add_sql = '';
		$sql_add = '';
		$fleet_arr = array();
		$Arr = array();

		if($arr && $table_name != '') {
			foreach ($arr as $value) {
				if (preg_match('/^(f)/', $value['key'])) {
					$fleet_arr['id'][] = preg_replace('/^(f)/', '', $value['key']);
				}
			}


			$fleet_ids = implode(',', $fleet_arr['id']);



			if($table_name == 'inspection' || $table_name == 'insurance') {
				$sql_add .= "".$table_name.".`end_date`,";
				//$add_sql .= " AND (".$table_name.".`add_date` >= '".$date_from."' AND ".$table_name.".`end_date` <= '".$date_to."')";
			}

			if($table_name == 'accident') {
				$sql_add .= "SUM(".$table_name.".`return_amount`) AS `price`,";
				$sql_add .= "".$table_name.".`return_amount` AS `count`,";
			} else {
				$sql_add .= "SUM(".$table_name.".`price`) AS `price`,";
				$sql_add .= "".$table_name.".`price` AS `count`,";
			}

				$sql = "
					SELECT 
					  ".$table_name.".`id`,
					  ".$table_name.".`add_date`,
					  ".$table_name.".`add_user_id`,
					  ".$sql_add."
					  
					  ".$table_name.".`fleet_id`,
					  CONCAT_WS(
						' ',
						`brand`.`title_".$lng."`,
						`model`.`title_".$lng."`
					  ) AS `brand_model`
					FROM
					  ".$table_name." 
					LEFT JOIN `fleet` 
						ON `fleet`.`id` = ".$table_name.".`fleet_id`
					LEFT JOIN `model` 
						ON `model`.`id` = `fleet`.`model_id` 
					LEFT JOIN `brand` 
						ON `brand`.`id` = `model`.`brand_id` 	
					WHERE ".$table_name.".`status` = '1' 
					 AND FIND_IN_SET(".$table_name.".`fleet_id`, '".$fleet_ids."')
					 AND (".$table_name.".`add_date` >= '".$date_from."' AND ".$table_name.".`add_date` <= '".$date_to."')
					 GROUP BY ".$table_name.".`fleet_id`
				";

				$query = $this->db->query($sql);

				$result = $query->result_array();

				$Arr = array();

				foreach($result as $val) {

					$Arr['data'][] = array(
						'name' => $val['brand_model'],
						'y' => intval($val['price']),
						'fleet_id' => $val['fleet_id'],
						'table' => $table_name
					);
				}


				$sql1 = "
					SELECT 
					  ".$table_name.".`add_date`,
					  ".$sql_add."
					  ".$table_name.".`status`
					FROM
					  ".$table_name." 
					WHERE ".$table_name.".`status` = '1' 
					 AND FIND_IN_SET(".$table_name.".`fleet_id`, '".$fleet_ids."')
					 AND (".$table_name.".`add_date` >= '".$date_from."' AND ".$table_name.".`add_date` <= '".$date_to."')
					 GROUP BY ".$table_name.".`add_date`
				";

				$query1 = $this->db->query($sql1);

				$result1 = $query1->result_array();


				foreach($result1 as $val1) {


					$Arr['date'][] = date($val1['add_date']);
					$Arr['price'][] = intval($val1['price']);
					$Arr['table'] =  $table_name;
				}

		}

		echo json_encode($Arr);
		return true;


	}


	public function getHistorySingle_ax () {


		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');
		$table = $this->input->post('table');
		$fleet_id = $this->input->post('fleet_id');


		$this->getHistorySingle($date_from, $date_to, $table, $fleet_id);

	}



	public function getHistorySingle($date_from, $date_to, $table_name, $fleet_id) {

		$lng = $this->load->lng();

		$add_sql = '';
		$sql_add = '';
		$Arr = array();

		if($fleet_id && $table_name != '') {



			if($table_name == 'inspection' || $table_name == 'insurance') {
				$sql_add .= "".$table_name.".`end_date`,";
				//$add_sql .= " AND (".$table_name.".`add_date` >= '".$date_from."' AND ".$table_name.".`end_date` <= '".$date_to."')";
			}

			if($table_name == 'accident') {
				$sql_add .= "SUM(".$table_name.".`return_amount`) AS `price`,";
				$sql_add .= "".$table_name.".`return_amount` AS `count`,";
			} else {
				$sql_add .= "SUM(".$table_name.".`price`) AS `price`,";
				$sql_add .= "".$table_name.".`price` AS `count`,";
			}




			$sql1 = "
					SELECT 
					  ".$table_name.".`add_date`,
					  ".$sql_add."
					  CONCAT_WS(
						' ',
						`brand`.`title_".$lng."`,
						`model`.`title_".$lng."`
					  ) AS `brand_model`
					FROM
					  ".$table_name." 
					LEFT JOIN `fleet` 
						ON `fleet`.`id` = ".$table_name.".`fleet_id`
					LEFT JOIN `model` 
						ON `model`.`id` = `fleet`.`model_id` 
					LEFT JOIN `brand` 
						ON `brand`.`id` = `model`.`brand_id` 	
					WHERE ".$table_name.".`status` = '1' 
					 AND ".$table_name.".`fleet_id` = '".$fleet_id."'
					 AND (".$table_name.".`add_date` >= '".$date_from."' AND ".$table_name.".`add_date` <= '".$date_to."')
					 GROUP BY ".$table_name.".`add_date`
				";

			$query1 = $this->db->query($sql1);

			$result1 = $query1->result_array();


			foreach($result1 as $val1) {
				$Arr['date'][] = date($val1['add_date']);
				$Arr['price'][] = intval($val1['price']);
				$Arr['fleet_name'] = $val1['brand_model'];
			}

		}

		echo json_encode($Arr);
		return true;

	}


	public function getHistoryCircle_ax() {

		$date = $this->input->post('date');
		$table = $this->input->post('table');
		$arr = $this->input->post('arr');


		$this->getHistoryCircle($date, $table, $arr);
	}


	public function getHistoryCircle($date, $table_name, $arr) {
		$lng = $this->load->lng();

		$add_sql = '';
		$sql_add = '';
		$fleet_arr = array();
		$Arr = array();


			foreach ($arr as $value) {
				if (preg_match('/^(f)/', $value['key'])) {
					$fleet_arr['id'][] = preg_replace('/^(f)/', '', $value['key']);
				}
			}


			$fleet_ids = implode(',', $fleet_arr['id']);



			if($table_name == 'inspection' || $table_name == 'insurance') {
				$sql_add .= "".$table_name.".`end_date`,";
				//$add_sql .= " AND (".$table_name.".`add_date` >= '".$date_from."' AND ".$table_name.".`end_date` <= '".$date_to."')";
			}

			if($table_name == 'accident') {
				$sql_add .= "SUM(".$table_name.".`return_amount`) AS `price`,";
				$sql_add .= "".$table_name.".`return_amount` AS `count`,";
			} else {
				$sql_add .= "SUM(".$table_name.".`price`) AS `price`,";
				$sql_add .= "".$table_name.".`price` AS `count`,";
			}

			 $sql = "
					SELECT 
					  ".$table_name.".`id`,
					  ".$table_name.".`add_date`,
					  ".$table_name.".`add_user_id`,
					  ".$sql_add."
					  
					  ".$table_name.".`fleet_id`,
					  CONCAT_WS(
						' ',
						`brand`.`title_".$lng."`,
						`model`.`title_".$lng."`
					  ) AS `brand_model`
					FROM
					  ".$table_name." 
					LEFT JOIN `fleet` 
						ON `fleet`.`id` = ".$table_name.".`fleet_id`
					LEFT JOIN `model` 
						ON `model`.`id` = `fleet`.`model_id` 
					LEFT JOIN `brand` 
						ON `brand`.`id` = `model`.`brand_id` 	
					WHERE ".$table_name.".`status` = '1' 
					 AND FIND_IN_SET(".$table_name.".`fleet_id`, '".$fleet_ids."')
					 AND (".$table_name.".`add_date` = '".$date."')
					 GROUP BY ".$table_name.".`fleet_id`
				";

			$query = $this->db->query($sql);

			$result = $query->result_array();

			$Arr = array();

			foreach($result as $val) {

				$Arr['data'][] = array(
					'name' => $val['brand_model'],
					'y' => intval($val['price']),
					'fleet_id' => $val['fleet_id'],
					'table' => $table_name
				);
			}



		echo json_encode($Arr);
		return true;
	}


	public function getHistoryAll_ax() {
		$lng = $this->load->lng();


		$Arr = array();

		$user_id = $this->session->user_id;
		$row = $this->db->select('company_id')->from('user')->where('id', $user_id)->get()->row_array();
		$company_id = $row['company_id'];

		$from = $this->input->post('from');
		$to = $this->input->post('to');

		$new_array = array();

		$inspection = $this->vehicle_info($from, $to, $company_id, 'inspection');
		$fuel_consumption = $this->vehicle_info($from, $to, $company_id, 'fuel_consumption');
		$fine = $this->vehicle_info($from, $to, $company_id, 'fine');
		$accident = $this->vehicle_info($from, $to, $company_id, 'accident');
		$insurance = $this->vehicle_info($from, $to, $company_id, 'insurance');
		$spares = $this->vehicle_info($from, $to, $company_id, 'spares');
		$repair = $this->vehicle_info($from, $to, $company_id, 'repair');
		$wheel = $this->vehicle_info($from, $to, $company_id, 'wheel');
		$brake = $this->vehicle_info($from, $to, $company_id, 'brake');
		$grease = $this->vehicle_info($from, $to, $company_id, 'grease');
		$filter = $this->vehicle_info($from, $to, $company_id, 'filter');
		$battery = $this->vehicle_info($from, $to, $company_id, 'battery');

		$arr = array();
		$data = array();
		$data['data'] = array();

		$big_arr = $this->get_big_array($inspection,$fuel_consumption,$fine,$accident,$insurance,$spares,$repair,$wheel,$brake,$grease,$filter,$battery);


		foreach ($big_arr as $key => $value) {


			if(isset($inspection[$key])) {
				$new_array[$inspection[$key]['date']]['inspection'][$inspection[$key]['fleet_name']] = $inspection[$key]['price'];
			}
			if(isset($fuel_consumption[$key])) {
				$new_array[$fuel_consumption[$key]['date']]['fuel_consumption'][$fuel_consumption[$key]['fleet_name']] = $fuel_consumption[$key]['price'];
			}
			if(isset($fine[$key])) {
				$new_array[$fine[$key]['date']]['fine'][$fine[$key]['fleet_name']] = $fine[$key]['price'];
			}
			if(isset($accident[$key])) {
				$new_array[$accident[$key]['date']]['accident'][$accident[$key]['fleet_name']] = $accident[$key]['price'];
			}
			if(isset($insurance[$key])) {
				$new_array[$insurance[$key]['date']]['insurance'][$insurance[$key]['fleet_name']] = $insurance[$key]['price'];
			}
			if(isset($spares[$key])) {
				$new_array[$spares[$key]['date']]['spares'][$spares[$key]['fleet_name']] = $spares[$key]['price'];
			}
			if(isset($repair[$key])) {
				$new_array[$repair[$key]['date']]['repair'][$repair[$key]['fleet_name']] = $repair[$key]['price'];
			}
			if(isset($wheel[$key])) {
				$new_array[$wheel[$key]['date']]['wheel'][$wheel[$key]['fleet_name']] = $wheel[$key]['price'];
			}
			if(isset($brake[$key])) {
				$new_array[$brake[$key]['date']]['brake'][$brake[$key]['fleet_name']] =  $brake[$key]['price'];
			}
			if(isset($grease[$key])) {
				$new_array[$grease[$key]['date']]['grease'][$grease[$key]['fleet_name']] = $grease[$key]['price'];
			}
			if(isset($filter[$key])) {
				$new_array[$filter[$key]['date']]['filter'][$filter[$key]['fleet_name']] = $filter[$key]['price'];
			}
			if(isset($battery[$key])) {
				$new_array[$battery[$key]['date']]['battery'][$battery[$key]['fleet_name']] = $battery[$key]['price'];
			}

		}

		ksort($new_array);



		foreach ($new_array as $date => $types) {
			$arr['inspection'][] = (isset($types['inspection']) ? array_sum($types['inspection']) : 0);
			$arr['fuel_consumption'][] = (isset($types['fuel_consumption']) ? array_sum($types['fuel_consumption']) : 0);
			$arr['fine'][] = (isset($types['fine']) ? array_sum($types['fine']) : 0);
			$arr['accident'][] = (isset($types['accident']) ? array_sum($types['accident']) : 0);
			$arr['insurance'][] = (isset($types['insurance']) ? array_sum($types['insurance']) : 0);
			$arr['spares'][] = (isset($types['spares']) ? array_sum($types['spares']) : 0);
			$arr['repair'][] = (isset($types['repair']) ? array_sum($types['repair']) : 0);
			$arr['wheel'][] = (isset($types['wheel']) ? array_sum($types['wheel']) : 0);
			$arr['brake'][] = (isset($types['brake']) ? array_sum($types['brake']) : 0);
			$arr['grease'][] = (isset($types['grease']) ? array_sum($types['grease']) : 0);
			$arr['filter'][] = (isset($types['filter']) ? array_sum($types['filter']) : 0);
			$arr['battery'][] = (isset($types['battery']) ? array_sum($types['battery']) : 0);
		}


		$table = '<table id="example" class="table table-striped table-borderless w-100 dataTable no-footer">
					<thead class="thead_tables">
						<tr>
							<th class="table_th">Date</th>
							<th class="table_th">Type</th>
							<th class="table_th">Fleet</th>
							<th class="table_th">Price (AMD)</th>
						</tr>
					</thead>
					<tbody>';

		foreach ($new_array as $date => $types) {


			foreach ($types as $type => $value) {
				foreach ($value as $fleet => $price) {
					$table .= '<tr>';
					$table .= '<td class="border">'.$date.'</td>';
					$table .= '<td class="border">'.$type.'</td>';
					$table .= '<td class="border">'.$fleet.'</td>';
					$table .= '<td class="border">'.$price.'</td>';
					$table .= '</tr>';
				}
			}


			$data['category'][] = date($date);

			$data['data'][] = array('name' => 'ՏԵԽ ԶՆՆՈՒՄ', 'data' => $arr['inspection'], 'stack' => '-');
			$data['data'][] = array('name' => 'ՎԱՌԵԼԻՔ', 'data' => $arr['fuel_consumption'], 'stack' => '-');
			$data['data'][] = array('name' => 'ՏՈՒԳԱՆՔ', 'data' => $arr['fine'], 'stack' => '-');
			$data['data'][] = array('name' => 'ՊԱՏԱՀԱՐՆԵՐ', 'data' => $arr['accident'], 'stack' => '-');
			$data['data'][] = array('name' => 'ԱՊԱՀՈՎԱԳՐՈՒԹՅՈՒՆ', 'data' => $arr['insurance'], 'stack' => '-');
			$data['data'][] = array('name' => 'ՊԱՀԵՍՏԱՄԱՍԵՐ', 'data' => $arr['spares'], 'stack' => '-');
			$data['data'][] = array('name' => 'ՎԵՐԱՆՈՐՈԳՈՒՄ', 'data' => $arr['repair'], 'stack' => '-');
			$data['data'][] = array('name' => 'ԱՆՎԱԴՈՂ', 'data' => $arr['wheel'], 'stack' => '-');
			$data['data'][] = array('name' => 'ԱՐԳԵԼԱԿ', 'data' => $arr['brake'], 'stack' => '-');
			$data['data'][] = array('name' => 'ՔՍՈՒՔ', 'data' => $arr['grease'], 'stack' => '-');
			$data['data'][] = array('name' => 'ՖԻԼՏՐ', 'data' => $arr['filter'], 'stack' => '-');
			$data['data'][] = array('name' => 'ՄԱՐՏԿՈՑ', 'data' => $arr['battery'], 'stack' => '-');

		}

		$table .= '</tbody></table>';


		$data['data'] = $this->get_unique_associate_array($data['data']);
		$data['table'] = $table;

		echo json_encode($data);
		return true;
	}




	public function vehicle_info($from, $to, $company_id, $table) {

		$lng = $this->load->lng();
		$sql_add = '';

		if($table == 'inspection' || $table == 'insurance') {
			$sql_add .= "".$table.".`end_date`,";
		}



		if($table == 'accident') {
			$sql_add .= "SUM(".$table.".`return_amount`) AS `price`,";
			$sql_add .= "".$table.".`return_amount` AS `count`,";
		} else {
			$sql_add .= "SUM(".$table.".`price`) AS `price`,";
			$sql_add .= "".$table.".`price` AS `count`,";
		}

		 $sql = "
			SELECT 
			  ".$table.".`id`,
			  ".$table.".`add_date`,
			  ".$table.".`add_user_id`,
			  ".$sql_add."
			  ".$table.".`fleet_id`,
			  CONCAT_WS(
				' ',
				`brand`.`title_".$lng."`,
				`model`.`title_".$lng."`
			  ) AS `brand_model`
			FROM
			  ".$table." 
			LEFT JOIN `fleet` 
				ON `fleet`.`id` = ".$table.".`fleet_id`
			LEFT JOIN `model` 
				ON `model`.`id` = `fleet`.`model_id` 
			LEFT JOIN `brand` 
				ON `brand`.`id` = `model`.`brand_id` 
			LEFT JOIN `user` 
				ON `user`.`id` = `fleet`.`registrar_user_id` 			
			WHERE ".$table.".`status` = '1' 
			 AND `user`.`company_id` = ".$this->load->db_value($company_id)."	
			 AND (".$table.".`add_date` >= '".$from."' AND ".$table.".`add_date` <= '".$to."')
		 	 GROUP BY ".$table.".`fleet_id`
		 ";

			$query = $this->db->query($sql);

			$result = $query->result_array();

		$Arr = array();

		foreach($result as $val) {
			$Arr[] = array(
				'date' => date($val['add_date']),
				'price' => intval($val['price']),
				'fleet_name' => $val['brand_model']
			);

		}

		return $Arr;

	}




	public function get_unique_associate_array($array) {

		$serialized_array = array_map("serialize", $array);

		foreach ($serialized_array as $key => $val) {

			$result[$val] = true;

		}

		if (isset($result)) {
			return array_map("unserialize", (array_keys($result)));
		} else {
			return array();
		}


	}


	public function get_big_array($arr1, $arr2, $arr3, $arr4, $arr5, $arr6, $arr7, $arr8, $arr9, $arr10, $arr11, $arr12) {
		$key = array_keys(
			array(count($arr1), count($arr2), count($arr3), count($arr4), count($arr5), count($arr6), count($arr7), count($arr8), count($arr9), count($arr10), count($arr11), count($arr12)),
			max(
				array(count($arr1), count($arr2), count($arr3), count($arr4), count($arr5), count($arr6), count($arr7), count($arr8), count($arr9), count($arr10), count($arr11), count($arr12))
			)
		);

		if (is_array(func_get_args())) {
			foreach (func_get_args() as $k => $array) {
				if ($k == $key[0]) {
					return $array;
				}
			}
		} else {
			return array();
		}

	}




}
//end of class
