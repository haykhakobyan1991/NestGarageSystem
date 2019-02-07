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

		$user_id = $this->session->user_id;

		$data = array();

		$lng = $this->load->lng();


		$row = $this->db->select('company_id')->from('user')->where('id', $user_id)->get()->row_array();
		$company_id = $row['company_id'];

		$sql = "
			SELECT 
			  GROUP_CONCAT(`fleet_group`.`fleet_id`) AS `fleet_id`,
			  `fleet_group`.`title`,
			  `fleet_group`.`group_id`
			FROM
			  `fleet_group` 
			WHERE `fleet_group`.`status` = 1
			 AND `fleet_group`.`company_id` = ".$this->load->db_value($company_id)."
			 GROUP BY `fleet_group`.`title` 
		";

		$query = $this->db->query($sql);

		$data['result'] = $query->result_array();


		 $sql_fleets = "
			SELECT 
				`fleet`.`id`,
				CONCAT_WS(
					' ',
					`brand`.`title_".$lng."`,
					`model`.`title_".$lng."`
				) AS `brand_model`
			FROM
			   `fleet`
			LEFT JOIN `model` 
				ON `model`.`id` = `fleet`.`model_id` 
			LEFT JOIN `brand` 
				ON `brand`.`id` = `model`.`brand_id`
			LEFT JOIN `user` 
				ON `user`.`id` = `fleet`.`registrar_user_id` 	
			WHERE `user`.`company_id` = ".$this->load->db_value($company_id)."		
			 AND `fleet`.`status` = '1'	   
		";


		$query_fleets = $this->db->query($sql_fleets);

		$data['result_fleets'] = $query_fleets->result_array();


		$this->layout->view('fleet_history/expenses_history', $data);

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
		$hidden = $this->input->post('hidden');
		$search_car = $this->input->post('search_car');
		$search_car_ids = $this->input->post('search_car_ids');

		$new_array = array();

		if(!empty($hidden) && in_array('inspection', $hidden)) {
			$inspection = array();
		} else {
			$inspection = $this->vehicle_info($from, $to, $company_id, 'inspection', $search_car, $search_car_ids);
		}

		if(!empty($hidden) && in_array('fuel_consumption', $hidden)) {
			$fuel_consumption = array();
		} else {
			$fuel_consumption = $this->vehicle_info($from, $to, $company_id, 'fuel_consumption', $search_car, $search_car_ids);
		}

		if(!empty($hidden) && in_array('fine', $hidden)) {
			$fine = array();
		} else {
			$fine = $this->vehicle_info($from, $to, $company_id, 'fine', $search_car, $search_car_ids);
		}

		if(!empty($hidden) && in_array('accident', $hidden)) {
			$accident = array();
		} else {
			$accident = $this->vehicle_info($from, $to, $company_id, 'accident', $search_car, $search_car_ids);
		}

		if(!empty($hidden) && in_array('insurance', $hidden)) {
			$insurance = array();
		} else {
			$insurance = $this->vehicle_info($from, $to, $company_id, 'insurance', $search_car, $search_car_ids);
		}

		if(!empty($hidden) && in_array('spares', $hidden)) {
			$spares = array();
		} else {
			$spares = $this->vehicle_info($from, $to, $company_id, 'spares', $search_car, $search_car_ids);
		}

		if(!empty($hidden) && in_array('repair', $hidden)) {
			$repair = array();
		} else {
			$repair = $this->vehicle_info($from, $to, $company_id, 'repair', $search_car, $search_car_ids);
		}

		if(!empty($hidden) && in_array('wheel', $hidden)) {
			$wheel = array();
		} else {
			$wheel = $this->vehicle_info($from, $to, $company_id, 'wheel', $search_car, $search_car_ids);
		}

		if(!empty($hidden) && in_array('brake', $hidden)) {
			$brake = array();
		} else {
			$brake = $this->vehicle_info($from, $to, $company_id, 'brake', $search_car, $search_car_ids);
		}

		if(!empty($hidden) && in_array('grease', $hidden)) {
			$grease = array();
		} else {
			$grease = $this->vehicle_info($from, $to, $company_id, 'grease', $search_car, $search_car_ids);
		}

		if(!empty($hidden) && in_array('filter', $hidden)) {
			$filter = array();
		} else {
			$filter = $this->vehicle_info($from, $to, $company_id, 'filter', $search_car, $search_car_ids);
		}

		if(!empty($hidden) && in_array('battery', $hidden)) {
			$battery = array();
		} else {
			$battery = $this->vehicle_info($from, $to, $company_id, 'battery', $search_car, $search_car_ids);
		}



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
							<th class="table_th">'.lang('date').'</th>
							<th class="table_th">'.lang('type').'</th>
							<th class="table_th">'.lang('vehicle').'</th>
							<th class="table_th">'.lang('price').' (AMD)</th>
						</tr>
					</thead>
					<tbody>';

		foreach ($new_array as $date => $types) {


			foreach ($types as $type => $value) {
				foreach ($value as $fleet => $price) {
					$table .= '<tr>';
						$table .= '<td class="border">'.$date.'</td>';
						$table .= '<td class="border">'.lang($type).'</td>';
						$table .= '<td class="border">'.$fleet.'</td>';
						$table .= '<td class="price border">'.$price.'</td>';
					$table .= '</tr>';
				}
			}


			$data['category'][] = date($date);

			$data['data'][] = array('name' => lang('inspection'), 'data' => $arr['inspection'], 'table' => 'inspection', 'stack' => '-');
			$data['data'][] = array('name' => lang('fuel_consumption'), 'data' => $arr['fuel_consumption'], 'table' => 'fuel_consumption', 'stack' => '-');
			$data['data'][] = array('name' => lang('fine'), 'data' => $arr['fine'], 'table' => 'fine', 'stack' => '-');
			$data['data'][] = array('name' => lang('accident'), 'data' => $arr['accident'], 'table' => 'accident', 'stack' => '-');
			$data['data'][] = array('name' => lang('insurance'), 'data' => $arr['insurance'], 'table' => 'insurance', 'stack' => '-');
			$data['data'][] = array('name' => lang('spares'), 'data' => $arr['spares'], 'table' => 'spares', 'stack' => '-');
			$data['data'][] = array('name' => lang('repair'), 'data' => $arr['repair'], 'table' => 'repair', 'stack' => '-');


		}

		$table .= '</tbody>
		<tfoot>
            <tr role="row" class="odd">
                <th class="font-weight-bold border"  style="text-align:left !important;">'.lang('total').'</th>
                <th class="font-weight-bold border" colspan="2" ></th>
                <th id="sum" class="font-weight-bold border"></th>
            </tr>
        </tfoot>
		</table>';


		$data['data'] = $this->get_unique_associate_array($data['data']);
		$data['table'] = $table;

		echo json_encode($data);
		return true;
	}




	public function vehicle_info($from, $to, $company_id, $table, $search_car, $search_car_ids) {

		$lng = $this->load->lng();
		$sql_add = '';
		$add_sql = '';

		if($table == 'inspection' || $table == 'insurance') {
			$sql_add .= "".$table.".`end_date`,";
		}



		if($table == 'accident') {
			$sql_add .= "@price := SUM(".$table.".`return_amount`) AS `price`,";
			$sql_add .= "".$table.".`return_amount` AS `count`,";
		} else {
			$sql_add .= "@price := SUM(".$table.".`price`) AS `price`,";
			$sql_add .= "".$table.".`price` AS `count`,";
		}

		if($search_car_ids != '') {
			$add_sql .= 'AND FIND_IN_SET(`fleet`.`id`, "'.$search_car_ids.'")';
		}

		if($search_car != '') {
			$add_sql .= 'AND CONCAT_WS(
				\' \',
				`brand`.`title_'.$lng.'`,
				`model`.`title_'.$lng.'`
			  ) LIKE '.$this->load->db_value('%'.$search_car.'%').'
			';
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
			 ".$add_sql."
		 	 GROUP BY ".$table.".`fleet_id`
		 ";

			$query = $this->db->query($sql);

			$result = $query->result_array();

		$Arr = array();

		foreach($result as $val) {
			$Arr[] = array(
				'date' => date($val['add_date']),
				'price' => intval($val['price']),
				'fleet_name' => $val['brand_model'].'<span class="f" style="font-size: 0.2px" >f'.$val['fleet_id'].'</span>'
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




	public function add_group_ax() {

		// $this->load->authorisation('Organization', 'add_group');

		$this->load->library('session');
		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');
		$n = 0;
		$user_id = $this->session->user_id;
		$token = $this->input->post('token'); //for gps

		if($token != '') {
			$row_t = $this->db->select('company_id')->from('user')->where('token', $token)->get()->row_array();
			$company_id = $row_t['company_id'];
		} else {
			$row = $this->db->select('company_id')->from('user')->where('id', $user_id)->get()->row_array();
			$company_id = $row['company_id'];
		}


		$result = false;

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}


		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('title', 'title', 'required');
		$this->form_validation->set_rules('groups', 'groups', 'required');



		if($this->form_validation->run() == false){
			//validation errors
			$n = 1;

			$validation_errors = array(
				'title' =>  form_error('title'),
				'groups' =>  form_error('groups')
			);
			$messages['error']['elements'][] = $validation_errors;
		}


		if($n == 1) {
			echo json_encode($messages);
			return false;
		}



		$row_l = $this->db->select('group_id')->from('fleet_group')->where('company_id', $company_id)->order_by("group_id", "desc")->limit(1)->get()->row_array();
		$group_id = $row_l['group_id'] + 1; //todo return false if group id is 0




		$title = $this->input->post('title');
		$groups = $this->input->post('groups');
		$description = $this->input->post('description');
		$geoference = $this->input->post('geoference');
		$status = 1;

		$groups_arr = explode(',', $groups);

		$sql = "
			INSERT INTO `fleet_group`
				(`title`,
				 `details`,
				 `fleet_id`,
				 `group_id`,
				 `company_id`,
				 `geoference_id`,
				 `status`)
			VALUES
		";

		foreach ($groups_arr as $fleet_id) {
			$sql .= "(
					".$this->load->db_value($title).",
					".$this->load->db_value($description).",
					".$this->load->db_value($fleet_id).",
					".$this->load->db_value($group_id).",
					".$this->load->db_value($company_id).",
					".$this->load->db_value($geoference).",
					1
				),";
		}


		$sql = substr($sql, 0, -1);

		$result = $this->db->query($sql);


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


	public function edit_group_modal_ax() {

		$id = $this->uri->segment(4);
		$token = $this->uri->segment(5);

		$this->load->helper('url');
		$this->load->helper('form');
		$lng = $this->load->lng();
		$user_id = $this->session->user_id;

		if($id == NULL) {
			$message = 'Undifined ID';
			show_error($message, '404', $heading = '404 Page Not Found');
			return false;
		}

		if($token != '') {
			$row_t = $this->db->select('company_id')->from('user')->where('token', $token)->get()->row_array();
			$company_id = $row_t['company_id'];
			$data['token'] = $token;
		} else {
			$row = $this->db->select('company_id')->from('user')->where('id', $user_id)->get()->row_array();
			$company_id = $row['company_id'];
		}

		$sql_selected_fleets = "
			SELECT 
			    `fleet`.`id`,
			    `fleet_group`.`title`,
			    `fleet_group`.`details`,
			    `fleet_group`.`default`,
			    `fleet_group`.`geoference_id`,
			    CONCAT_WS(
					' ',
					`brand`.`title_".$lng."`,
					`model`.`title_".$lng."`
			    ) AS `brand_model`
			FROM
			   `fleet_group`
			LEFT JOIN `fleet` 
				ON `fleet`.`id` = `fleet_group`.`fleet_id`
			LEFT JOIN `model` 
				ON `model`.`id` = `fleet`.`model_id` 	
			LEFT JOIN `brand` 
				ON `brand`.`id` = `model`.`brand_id`	
			WHERE `group_id` = 	'".$id."'	
			 
		";

		$query_selected_fleets = $this->db->query($sql_selected_fleets);

		if($query_selected_fleets->num_rows() == 0) {
			echo '<h1 class="h2 p-2 alert-secondary m-2 text-center">'.lang('You_can_not_edit_this_group').'</h1>';
			return false;
		}

		$data['result_selected_fleets'] = $query_selected_fleets->result_array();


		$choose_fleet_arr = array();

		foreach ($data['result_selected_fleets'] as $row) {
			$choose_fleet_arr[] = $row['id'];
		}

		$data['selected_fleet_ids'] = implode(',', $choose_fleet_arr);
		$data['group_id'] = $id;


		$sql_fleets = "
			SELECT 
				`fleet`.`id`,
				CONCAT_WS(
					' ',
					`brand`.`title_".$lng."`,
					`model`.`title_".$lng."`
				) AS `brand_model`
			FROM
			   `fleet`
			LEFT JOIN `model` 
				ON `model`.`id` = `fleet`.`model_id` 
			LEFT JOIN `brand` 
				ON `brand`.`id` = `model`.`brand_id`
			LEFT JOIN `user` 
				ON `user`.`id` = `fleet`.`registrar_user_id` 	
			WHERE `user`.`company_id` = ".$this->load->db_value($company_id)."	
			 AND NOT FIND_IN_SET(`fleet`.`id`, '".$data['selected_fleet_ids']."')	
			 AND `fleet`.`status` = '1'	   
		";


		$query_fleets = $this->db->query($sql_fleets);

		$data['result_fleets'] = $query_fleets->result_array();

		$this->load->view('fleet_history/edit_group', $data);

	}


	public function edit_group_ax() {

		// $this->load->authorisation('Organization', 'edit_group');

		$this->load->library('session');
		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');
		$n = 0;
		$user_id = $this->session->user_id;
		$token = $this->input->post('token'); //for gps

		if($token != '') {
			$row_t = $this->db->select('company_id')->from('user')->where('token', $token)->get()->row_array();
			$company_id = $row_t['company_id'];
		} else {
			$row = $this->db->select('company_id')->from('user')->where('id', $user_id)->get()->row_array();
			$company_id = $row['company_id'];
		}

		$result = false;

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}


		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('title', 'title', 'required');
		$this->form_validation->set_rules('edit_groups', 'edit_groups', 'required');





		if($this->form_validation->run() == false){
			//validation errors
			$n = 1;

			$validation_errors = array(
				'title' =>  form_error('title'),
				'edit_groups' =>  form_error('edit_groups')
			);
			$messages['error']['elements'][] = $validation_errors;
		}


		if($n == 1) {
			echo json_encode($messages);
			return false;
		}




		$group_id = $this->input->post('group_id');

		$this->db->delete('fleet_group', array('group_id' => $group_id));




		$title = $this->input->post('title');
		$groups = $this->input->post('edit_groups');
		$description = $this->input->post('description');
		$geoference = $this->input->post('geoference');
		$status = 1;

		$groups_arr = explode(',', $groups);

		$sql = "
			INSERT INTO `fleet_group`
				(`title`,
				 `details`,
				 `fleet_id`,
				 `group_id`,
				 `company_id`,
				 `geoference_id`,
				 `status`)
			VALUES
		";

		foreach ($groups_arr as $fleet_id) {
			$sql .= "(
					".$this->load->db_value($title).",
					".$this->load->db_value($description).",
					".$this->load->db_value($fleet_id).",
					".$this->load->db_value($group_id).",
					".$this->load->db_value($company_id).",
					".$this->load->db_value($geoference).",
					1
				),";
		}


		$sql = substr($sql, 0, -1);

		$result = $this->db->query($sql);


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

	public function delete_group() {

		//$this->load->authorisation('Fleet_history', 'delete_group');

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}

		$group_id = $this->input->post('group_id');


		$this->db->delete('fleet_group', array('group_id' => $group_id));

		return true;

	}




	public function group_type() {

		$group_id = $this->input->post('group_id');

		$sql_selected_fleets = "
			SELECT 
			    `fleet_group`.`id`
			FROM
			   `fleet_group`	
			WHERE `group_id` = 	'".$group_id."'	
			 AND `default` = '1'	
		";

		$query_selected_fleets = $this->db->query($sql_selected_fleets);

		if($query_selected_fleets->num_rows() == 0) {
			echo '<h1 class="h2 p-2 alert-secondary m-2 text-center">'.lang('You_can_not_edit_this_group').'</h1>';
			return false;
		}

	}






}
//end of class
