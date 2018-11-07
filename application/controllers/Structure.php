<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Structure extends MX_Controller {

	/**
	 * Organization constructor.
	 */
	public function __construct() {

		parent::__construct();

		// load the library
		$this->load->library('layout');

		// load the helper
		$this->load->helper('language');

		$lng = $this->load->lng();
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

	public function structure1(){
		$data = array();
		$user_id = $this->session->user_id;

		$lng = $this->load->lng();

		$row = $this->db->select('company_id')->from('user')->where('id', $user_id)->get()->row_array();
		$company_id = $row['company_id'];

		$sql = "
			SELECT 
			  CONCAT_WS(
				' ',
				`head_staff`.`first_name`,
				`head_staff`.`last_name`
			  ) AS `head`,
			  `head_staff`.`photo` AS `head_staff_photo`,
			  `head_staff`.`id` AS `head_staff_id`,
			  CONCAT_WS(
				' ',
				`staff`.`first_name`,
				`staff`.`last_name`
			  ) AS `driver`,
			  `staff`.`photo` AS `driver_photo`,
			  `staff`.`id` AS `driver_id`,
			  `department`.`id` AS `department_id`,
			  `company`.`id` AS `company_id`,
			  `company`.`name` AS `company`,
			  `company`.`logo` AS `company_logo`,
			   CONCAT_WS(
				' ',
				`brand`.`title_".$lng."`,
				`model`.`title_".$lng."`
			  ) AS `model`,
			  `fleet`.`id` AS `fleet_id`
			FROM
			  `user` 
			  LEFT JOIN company 
				ON user.`company_id` = company.`id` 
			  LEFT JOIN department 
				ON department.`company_id` = company.id 
			  LEFT JOIN staff AS head_staff 
				ON department.`head_staff_id` = head_staff.id 
			  LEFT JOIN staff 
				ON FIND_IN_SET(
				  department.id,
				  staff.`department_ids`
				) 
				AND `staff`.`id` <> `head_staff`.`id` 
				/*todo*/
			  LEFT JOIN `fleet` 
				ON FIND_IN_SET(
				  `staff`.`id`,
				  `fleet`.`staff_ids`
				) 
			  LEFT JOIN `model` 
				ON `fleet`.`model_id` = `model`.`id` 
			  LEFT JOIN `brand` 
				ON `model`.`brand_id` = `brand`.`id` 		
			WHERE company.id = '" . $company_id . "' 
			ORDER BY `head_staff`.`id`,
			  `staff`.`id`,
			  `department`.`id`,
			  `fleet`.`id` 
		";


		$result = $this->db->query($sql);

		$structure_array = $result->result_array();

		$structure_arr = array();
		$cmp_id = '';
		$department_id = '';
		$driver_id = '';
		$fleet_id = '';

		$from_to_arr = array();
		foreach ($structure_array AS $key => $value) :
			if ($value['company_id'] != $cmp_id) :

				$structure_arr[] = array('key' => 'c'.$value['company_id'], 'text' => $value['company'], 'img' => base_url('uploads/company/' . $value['company_logo']));

			endif;
			$cmp_id = $value['company_id'];

			if ($value['department_id'] != $department_id) :

				$structure_arr[] = array('key' => 'h'.$value['department_id'], 'text' => $value['head'], 'img' => base_url('uploads/user_'.$user_id.'/staff/original/'.$value['head_staff_photo']));
				$from_to_arr[] = array('from' => 'c'.$value['company_id'], 'to' => 'h'.$value['department_id']);
			endif;
			$department_id = $value['department_id'];

			if ($value['driver_id'] != $driver_id) :
				$structure_arr[] = array('key' => 'd'.$value['driver_id'], 'text' => $value['driver'], 'img' => ($value['driver_photo'] != '' ? base_url('uploads/user_'.$user_id.'/staff/original/'.$value['driver_photo']) : base_url('assets/img/staff.svg')));
				$from_to_arr[] = array('from' => 'h'.$value['department_id'], 'to' => 'd'.$value['driver_id']);

			endif;
			$driver_id = $value['driver_id'];


			if ($value['fleet_id'] != $fleet_id) :
				$structure_arr[] = array('key' => 'f'.$value['fleet_id'], 'text' => $value['model'], 'img' => base_url('assets/img/car.svg'));

			endif;
			$fleet_id = $value['fleet_id'];
			if($value['fleet_id'] != '') :
				$from_to_arr[] = array('from' => 'd'.$value['driver_id'], 'to' => 'f'.$value['fleet_id']);
			endif;

		endforeach;

//		echo '<br>';
//		echo '<br>';
//		echo '<br>';



		$from_to_arr = array_values(array_unique($from_to_arr, SORT_REGULAR));

//		$this->pre($from_to_arr);

		$data['structure'] = json_encode($structure_arr);
		$data['from_to'] = json_encode($from_to_arr);

		$this->layout->view('structure/structure1', $data);

	}

	public function structure2(){
		$data = array();
		$user_id = $this->session->user_id;
		$lng = $this->load->lng();

		$row = $this->db->select('company_id')->from('user')->where('id', $user_id)->get()->row_array();
		$company_id = $row['company_id'];

		$sql = "
			SELECT 
			  CONCAT_WS(
				' ',
				`head_staff`.`first_name`,
				`head_staff`.`last_name`
			  ) AS `head`,
			  `head_staff`.`photo` AS `head_staff_photo`,
			  `head_staff`.`id` AS `head_staff_id`,
			  CONCAT_WS(
				' ',
				`staff`.`first_name`,
				`staff`.`last_name`
			  ) AS `driver`,
			  `staff`.`photo` AS `driver_photo`,
			  `staff`.`id` AS `driver_id`,
			  `department`.`id` AS `department_id`,
			  `company`.`id` AS `company_id`,
			  `company`.`name` AS `company`,
			  `company`.`logo` AS `company_logo`,
			  CONCAT_WS(
				' ',
				`brand`.`title_".$lng."`,
				`model`.`title_".$lng."`
			  ) AS `model`,
			  `fleet`.`id` AS `fleet_id`
			FROM
			  `user` 
			  LEFT JOIN company 
				ON user.`company_id` = company.`id` 
			  LEFT JOIN department 
				ON department.`company_id` = company.id 
			  LEFT JOIN staff AS head_staff 
				ON department.`head_staff_id` = head_staff.id 
			  LEFT JOIN staff 
				ON FIND_IN_SET(
				  department.id,
				  staff.`department_ids`
				) 
				AND `staff`.`id` <> `head_staff`.`id` 
				/*todo*/
			  LEFT JOIN `fleet` 
				ON FIND_IN_SET(
				  `staff`.`id`,
				  `fleet`.`staff_ids`
				) 
			  LEFT JOIN `model` 
				ON `fleet`.`model_id` = `model`.`id`
			  LEFT JOIN `brand` 
				ON `model`.`brand_id` = `brand`.`id` 	
			WHERE company.id = '" . $company_id . "' 
			ORDER BY `head_staff`.`id`,
			  `staff`.`id`,
			  `department`.`id`,
			  `fleet`.`id` 
		";


		$result = $this->db->query($sql);

		$structure_array = $result->result_array();

		$structure_arr = array();
		$cmp_id = '';
		$department_id = '';
		$driver_id = '';

		foreach ($structure_array AS $key => $value) :
			if ($value['company_id'] != $cmp_id) :

				$structure_arr[] = array('key' => 'c'.$value['company_id'], 'name' => $value['company'], 'title' => 'Company');

			endif;
			$cmp_id = $value['company_id'];

			if ($value['department_id'] != $department_id) :

				$structure_arr[] = array('key' => 'h'.$value['department_id'], 'name' => $value['head'], 'parent' => 'c'.$value['company_id'], 'title' => 'Head staff');
			endif;
			$department_id = $value['department_id'];

			if ($value['driver_id'] != $driver_id) :
				$structure_arr[] = array('key' => 'd'.$value['driver_id'], 'name' => $value['driver'], 'parent' => 'h'.$value['department_id'], 'title' => 'Driver');
			endif;
			$driver_id = $value['driver_id'];


			if ($value['fleet_id'] != '') :
				$structure_arr[] = array('key' => 'f'.$value['fleet_id'], 'name' => $value['model'], 'parent' => 'd'.$value['driver_id'], 'title' => 'Fleet');
			endif;


		endforeach;
		$structure_unique = array_values(array_unique($structure_arr, SORT_REGULAR));



		$data['structure'] = json_encode($structure_unique);

		$this->layout->view('structure/structure2', $data);

	}

}
//end of class
