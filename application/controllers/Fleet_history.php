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


		if($arr) {
			foreach ($arr as $value) {
				if (preg_match('/^(f)/', $value['key'])) {
					$fleet_arr['id'][] = preg_replace('/^(f)/', '', $value['key']);
				}
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
					'y' => intval($val['price'])
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
		}


			echo json_encode($Arr);
			return true;


	}


}
//end of class
