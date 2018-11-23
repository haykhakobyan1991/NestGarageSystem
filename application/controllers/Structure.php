<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Structure extends MX_Controller {

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

	public function structure1 () {

		$this->load->authorisation();

		$user_id = $this->session->user_id;
		$folder = $this->session->folder;
		$lng = $this->load->lng();
		$data = array();

		$sql_add_user = "
			SELECT
				CONCAT_WS(
					' ',
					`first_name`,
					`last_name`
			  	) AS `name`
			FROM
			  `user`
			WHERE `id` = '".$user_id."'	  	
		";

		$query_add_user = $this->db->query($sql_add_user);

		$data['user'] = $query_add_user->row_array();



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
			  `department`.`title` AS `department`,
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
				 AND `department`.`status` = '1'
			  LEFT JOIN staff AS head_staff 
				ON department.`head_staff_id` = head_staff.id 
				 AND `head_staff`.`status` = '1'
			  LEFT JOIN `staff`
				ON FIND_IN_SET(
				  `department`.`id`,
				  `staff`.`department_ids`
				) 
				AND `staff`.`status` = '1'
				/*todo*/
			  LEFT JOIN `fleet` 
				ON FIND_IN_SET(
				  `staff`.`id`,
				  `fleet`.`staff_ids`
				) 
				AND `fleet`.`status` = '1'
			  LEFT JOIN `model` 
				ON `fleet`.`model_id` = `model`.`id` 
			  LEFT JOIN `brand` 
				ON `model`.`brand_id` = `brand`.`id` 		
			WHERE company.id = '" . $company_id . "' 
			AND `staff`.`id` <> `head_staff`.`id` /*todo*/
			ORDER BY `head_staff`.`id`,
			  `department`.`id`, /*todo*/
			  `staff`.`id`,
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
				$structure_arr[] = array('key' => 'c' . $value['company_id'], 'text' => $value['company'], 'img' => base_url('uploads/' . $folder . '/company/' . $value['company_logo']));
			endif;
			$cmp_id = $value['company_id'];

			if ($value['department_id'] != $department_id && $value['department_id'] != '') :
				$structure_arr[] = array('key' => 'h' . $value['department_id'], 'text' => $value['head'] . ' (' . $value['department'] . ' - '. $value['department_id']. ')', 'img' => base_url('uploads/' . $folder . '/staff/original/' . $value['head_staff_photo']), 'fromDepartment' => true, 'from' => true);
				$from_to_arr[] = array('from' => 'c' . $value['company_id'], 'to' => 'h' . $value['department_id']);
			endif;
			$department_id = $value['department_id'];

			if ($value['driver_id'] != $driver_id && $value['driver_id'] != '') :
				$structure_arr[] = array('key' => 'd' . $value['driver_id'], 'text' => $value['driver']. ' - ' .$value['driver_id'], 'img' => ($value['driver_photo'] != '' ? base_url('uploads/' . $folder . '/staff/original/' . $value['driver_photo']) : base_url('assets/img/staff.svg')), 'toStaff' => true, 'from' => true, 'fromDepartment' => true);
				$from_to_arr[] = array('from' => 'h' . $value['department_id'], 'to' => 'd' . $value['driver_id']);
			endif;
			$driver_id = $value['driver_id'];

			if ($value['fleet_id'] != $fleet_id && $value['fleet_id'] != '') :
				$structure_arr[] = array('key' => 'f' . $value['fleet_id'], 'text' => $value['model'] . ' - ' .$value['fleet_id'], 'img' => base_url('assets/img/car.svg'), 'to' => true);
			endif;
			$fleet_id = $value['fleet_id'];

			if ($value['fleet_id'] != '') :
				$from_to_arr[] = array('from' => 'd' . $value['driver_id'], 'to' => 'f' . $value['fleet_id']);
			endif;

		endforeach;

		$from_to_arr = array_values(array_unique($from_to_arr, SORT_REGULAR));
		$structure_arr = array_values(array_unique($structure_arr, SORT_REGULAR));

		$data['structure'] = json_encode($structure_arr);
		$data['from_to'] = json_encode($from_to_arr);

		//$this->pre($structure_arr);
		//$this->pre($from_to_arr);

		$this->layout->view('structure/structure1', $data);

	}

	public function structure2(){
		$this->load->authorisation();

		$user_id = $this->session->user_id;
		$lng = $this->load->lng();
		$data = array();

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
			  `department`.`title` AS `department`,
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
				 AND `department`.`status` = '1'
			  LEFT JOIN staff AS head_staff 
				ON department.`head_staff_id` = head_staff.id 
				 AND `head_staff`.`status` = '1'
			  LEFT JOIN staff 
				ON FIND_IN_SET(
				  department.id,
				  staff.`department_ids`
				) 
				
				AND `staff`.`status` = '1'
				/*todo*/
			  LEFT JOIN `fleet` 
				ON FIND_IN_SET(
				  `staff`.`id`,
				  `fleet`.`staff_ids`
				) 
				AND `fleet`.`status` = '1'
			  LEFT JOIN `model` 
				ON `fleet`.`model_id` = `model`.`id` 
			  LEFT JOIN `brand` 
				ON `model`.`brand_id` = `brand`.`id` 	
			WHERE company.id = '" . $company_id . "' 
			 AND `staff`.`id` <> `head_staff`.`id` 
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
				$structure_arr[] = array('key' => 'c' . $value['company_id'], 'name' => $value['company'], 'title' => 'Company');
			endif;
			$cmp_id = $value['company_id'];

			if ($value['department_id'] != $department_id) :
				$structure_arr[] = array('key' => 'h' . $value['department_id'], 'name' => $value['head'] . ' (' . $value['department'] . ')', 'parent' => 'c' . $value['company_id'], 'title' => 'Head staff');
			endif;
			$department_id = $value['department_id'];

			if ($value['driver_id'] != $driver_id) :
				$structure_arr[] = array('key' => 'd' . $value['driver_id'], 'name' => $value['driver'], 'parent' => 'h' . $value['department_id'], 'title' => 'Driver');
			endif;
			$driver_id = $value['driver_id'];

			if ($value['fleet_id'] != '') :
				$structure_arr[] = array('key' => 'f' . $value['fleet_id'], 'name' => $value['model'], 'parent' => 'd' . $value['driver_id'], 'title' => 'Fleet');
			endif;

		endforeach;

		$structure_unique = array_values(array_unique($structure_arr, SORT_REGULAR));


		$data['structure'] = json_encode($structure_unique);

		$this->layout->view('structure/structure2', $data);

	}



	public function structure3 () {

		$this->load->authorisation();

		$user_id = $this->session->user_id;
		$folder = $this->session->folder;
		$lng = $this->load->lng();
		$data = array();


		$this->layout->view('structure/structure3', $data);
	}



	public function change_from_to_ax() {

		$return = array('error' => '', 'result' => '');

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$return['error'] = 'error_message';
			$this->access_denied();
			return false;
		}


		$data = $this->input->post('data');
		$old_data = json_decode($this->input->post('old_data'), true);
		$structure = json_decode($this->input->post('structure'), true);


		$structure_arr = array();
		foreach ($structure as $value) :

			$structure_arr[$value['key']] = $value['text'];

		endforeach;


		$old_data_arr = array();
		foreach ($old_data as $value) :

			if (preg_match('/^(c)/', $value['from']) || preg_match('/^(h)/', $value['to'])) {
				$old_data_arr['c_h'][preg_replace('/^(c)/', '', $value['from'])][] = preg_replace('/^(h)/', '', $value['to']);
			}

			if (preg_match('/^(h)/', $value['from']) || preg_match('/^(d)/', $value['to'])) {
				$old_data_arr['h_d'][preg_replace('/^(h)/', '', $value['from'])][] = preg_replace('/^(d)/', '', $value['to']);
			}

			if (preg_match('/^(d)/', $value['from']) || preg_match('/^(f)/', $value['to'])) {
				$old_data_arr['d_f'][preg_replace('/^(d)/', '', $value['from'])][] = preg_replace('/^(f)/', '', $value['to']);
			}

		endforeach;


		$new_data_arr = array();
		foreach ($data as $value) :
			if (preg_match('/^(c)/', $value['from']) || preg_match('/^(h)/', $value['to'])) {
				$new_data_arr['c_h'][preg_replace('/^(c)/', '', $value['from'])][] = preg_replace('/^(h)/', '', $value['to']);
			}

			if (preg_match('/^(h)/', $value['from']) || preg_match('/^(d)/', $value['to'])) {
				$new_data_arr['h_d'][preg_replace('/^(h)/', '', $value['from'])][] = preg_replace('/^(d)/', '', $value['to']);
			}

			if (preg_match('/^(d)/', $value['from']) || preg_match('/^(f)/', $value['to'])) {
				$new_data_arr['d_f'][preg_replace('/^(d)/', '', $value['from'])][] = preg_replace('/^(f)/', '', $value['to']);
			}

		endforeach;


//		echo '<br>----------------------New department - driver------------------------------<br>';
//		$this->pre($new_data_arr['h_d']);
//		echo '<br>----------------------OLD department - driver------------------------------<br>';
//		$this->pre($old_data_arr['h_d']);
//		echo '<br>----------------------New Driver - fleet------------------------------<br>';
//		$this->pre($new_data_arr['d_f']);
//		echo '<br>----------------------OLD Driver - fleet------------------------------<br>';
//		$this->pre($old_data_arr['d_f']);

		if(!isset($new_data_arr['c_h']) || !isset($new_data_arr['h_d']) || !isset($new_data_arr['d_f'])) {
			$return['error'] = 'ERROR'; //todo
			echo json_encode($return);
			return false;
		}

		$array = $this->from_to($new_data_arr['c_h'], $new_data_arr['h_d'], $new_data_arr['d_f'], $old_data_arr['c_h'], $old_data_arr['h_d'], $old_data_arr['d_f']);


		//ask change or no
		if ($this->input->post('value') == '-1') {

			if (isset($array['deleted'])) {
				$return['result'][] = '<b>Deleted</b>'.hr();
				foreach ($array['deleted'] as $f_t => $value) {
					foreach ($value as $from_to) {

						if($f_t == 'd_f') {
							 $return['result'][] = '<b>From driver:</b> ' . $structure_arr['d'.$from_to['from']] . ' <b>To fleet:</b> ' . $structure_arr['f'.$from_to['to']] . br();
						} elseif($f_t == 'h_d') {
							 $return['result'][] = '<b>From department:</b> ' . $structure_arr['h'.$from_to['from']] . ' <b>To driver:</b> ' . $structure_arr['d'.$from_to['to']] . br();
						} elseif($f_t == 'c_h') {
							 $return['result'][] = '<b>From company:</b> ' . $structure_arr['c'.$from_to['from']] . ' <b>To department</b> ' . $structure_arr['h'.$from_to['to']] . br();
						}

					}
				}
			}

			if(isset($array['added'])) {
				$return['result'][] = (isset($array['deleted']) ? hr().'<b>Added</b>'.hr() : '<b>Added</b>'.hr());
				foreach ($array['added'] as $f_t => $value) {
					foreach ($value as $from_to) {

						if($f_t == 'd_f' && isset($structure_arr['d'.$from_to['from']]) && isset($structure_arr['f'.$from_to['to']])) {
							$return['result'][] = '<b>From driver:</b> ' . $structure_arr['d'.$from_to['from']] . ' <b>To fleet:</b> ' . $structure_arr['f'.$from_to['to']] . br();
						} elseif($f_t == 'h_d' && isset($structure_arr['h'.$from_to['from']]) && isset($structure_arr['d'.$from_to['to']])) {
							$return['result'][] = '<b>From department:</b> ' . $structure_arr['h'.$from_to['from']] . ' <b>To driver:</b> ' . $structure_arr['d'.$from_to['to']] . br();
						} elseif($f_t == 'c_h' && isset($structure_arr['c'.$from_to['from']]) && isset($structure_arr['h'.$from_to['to']])) {
							$return['result'][] = '<b>From company:</b> ' . $structure_arr['c'.$from_to['from']] . ' <b>To department:</b> ' . $structure_arr['h'.$from_to['to']] . br();
						} else {
							$return['result'] = false;
							$return['error'] = 'Անհնար միացում'; //todo
						}

					}
				}
			}

		} elseif ($this->input->post('value') == '1') {

			$return['result'] = true;

			if (isset($array['deleted'])) {
				foreach ($array['deleted'] as $f_t => $value) {
					//echo $f_t;
					//echo hr();
					//$this->pre($value);
					foreach ($value as $from_to) {

						if ($f_t == 'c_h') {
							$sql = "
								UPDATE 
								  `department` 
								SET
								  `status` = '-1' 
								WHERE `company_id` = '" . $from_to['from'] . "' 
								  AND `id` = '" . $from_to['to'] . "' 
							";

							$this->db->query($sql);

						} else if ($f_t == 'h_d') {
							//select departments for this staff
							$sql_sel = "
								SELECT 
								  `department_ids` 
								FROM
								  `staff` 
								WHERE FIND_IN_SET('" . $from_to['from'] . "', `department_ids`) 
								  AND `id` = '" . $from_to['to'] . "' 
							";

							$query_sel = $this->db->query($sql_sel);
							$row = $query_sel->row_array();

							// department ides to array
							$old_departments = explode(',', $row['department_ids']);


							// unset found department
							if (($key = array_search($from_to['from'], $old_departments)) !== false) {
								unset($old_departments[$key]);
							}

							// after unset departments, to string
							$new_departments = implode(',', $old_departments);

							// update staff departments after unset
							$sql = "
								UPDATE 
								  `staff` 
								SET
								  `department_ids` = '" . $new_departments . "' 
								WHERE `id` = '" . $from_to['to'] . "' 
							";

							 $this->db->query($sql);

							// check isset staffs for this department
							$sql_isset_departments = "
								SELECT 
								  `department_ids` 
								FROM
								  `staff` 
								WHERE FIND_IN_SET('" . $from_to['from'] . "', `department_ids`)
							";

							$query_isset_departments = $this->db->query($sql_isset_departments);

							//if not isset staffs for this department
							if ($query_isset_departments->num_rows() == 0) {
								// todo petqa te che  ?
								$sql = "
									UPDATE 
									  `department` 
									SET
									  `status` = '-1' 
									WHERE `id` = '" . $from_to['from'] . "' 
								";

								$this->db->query($sql);
							}

						} else if ($f_t == 'd_f') {
							//select staffs for this fleet
							 $sql_sel = "
								SELECT 
								  `staff_ids` 
								FROM
								  `fleet` 
								WHERE FIND_IN_SET('" . $from_to['from'] . "', `staff_ids`) 
								  AND `id` = '" . $from_to['to'] . "' 
							";


							$query_sel = $this->db->query($sql_sel);
							$row = $query_sel->row_array();

							// staffs ides to array
							$old_staffs = explode(',', $row['staff_ids']);


							// unset found staff
							if (($key = array_search($from_to['from'], $old_staffs)) !== false) {
								unset($old_staffs[$key]);
							}

							// after unset staffs, to string
							$new_staffs = implode(',', $old_staffs);


							// update staff departments after unset
							$sql = "
								UPDATE 
								  `fleet` 
								SET
								  `staff_ids` = '" . $new_staffs . "' 
								WHERE `id` = '" . $from_to['to'] . "' 
							";

							$this->db->query($sql);


							// check isset fleets for this staff
							$sql_isset_staffs = "
								SELECT 
								  `staff_ids` 
								FROM
								  `fleet` 
								WHERE FIND_IN_SET('" . $from_to['from'] . "', `staff_ids`)
							";

							$query_isset_staffs = $this->db->query($sql_isset_staffs);

							//if not isset fleets for this staff
							if ($query_isset_staffs->num_rows() == 0) {
								// todo petqa te che  ?
								$sql = "
									UPDATE 
									  `staff` 
									SET
									  `status` = '-1' 
									WHERE `id` = '" . $from_to['from'] . "' 
								";

								//todo $this->db->query($sql);
							}
						}

					}
				}
			}


			if (isset($array['added'])) {
				foreach ($array['added'] as $f_t => $value) {
//					echo $f_t;
//					echo hr();
//					$this->pre($value);
					foreach ($value as $from_to) {

						if ($f_t == 'c_h') {
							// todo Իմ ջոկելով ես դեպքը երբեք չի լինի
							$sql = "
								UPDATE 
								  `department` 
								SET
								  `status` = '1' 
								WHERE `company_id` = '" . $from_to['from'] . "' 
								  AND `id` = '" . $from_to['to'] . "' 
							";

							$this->db->query($sql);

						} else if ($f_t == 'h_d') {
							//select departments for this staff
							 $sql_sel = "
								SELECT 
								  `department_ids` 
								FROM
								  `staff` 
								WHERE `id` = '" . $from_to['to'] . "' 
							";

							$query_sel = $this->db->query($sql_sel);
							$row = $query_sel->row_array();

							$new_departments = '';

							if($row['department_ids'] != '') {
								$new_departments = $row['department_ids'].','.$from_to['from'];
							} else {
								$new_departments = $from_to['from'];
							}


							 // update staff departments
							 $sql = "
								UPDATE 
								  `staff` 
								SET
								  `department_ids` = '" . $new_departments . "' 
								WHERE `id` = '" . $from_to['to'] . "' 
							 ";

							 $this->db->query($sql);



						} else if ($f_t == 'd_f') {
							//select staffs for this fleet
							$sql_sel = "
								SELECT 
								  `staff_ids` 
								FROM
								  `fleet` 
								WHERE `id` = '" . $from_to['to'] . "' 
							";


							$query_sel = $this->db->query($sql_sel);
							$row = $query_sel->row_array();

							$new_staffs = '';

							if($row['staff_ids'] != '') {
								$new_staffs = $row['staff_ids'].','.$from_to['from'];
							} else {
								$new_staffs = $from_to['from'];
							}


							// update fleet staffs
							$sql = "
								UPDATE 
								  `fleet` 
								SET
								  `staff_ids` = '" . $new_staffs . "' 
								WHERE `id` = '" . $from_to['to'] . "' 
							";

							$this->db->query($sql);


						}

					}
				}
			}
		}


		echo json_encode($return);
		return true;

	}




	/**
	 * @param $new_ch
	 * @param $new_hd
	 * @param $new_df
	 * @param $old_ch
	 * @param $old_hd
	 * @param $old_df
	 * @return array
	 */
	private function from_to ($new_ch, $new_hd, $new_df, $old_ch, $old_hd, $old_df) {

		$change_array = array();

		foreach ($new_ch as $company_id => $department_array) {
			foreach ($department_array as $key => $department_id) {
				if (!isset($old_ch[$company_id][$key])) {
					if(isset($old_ch[$company_id]) && !in_array($department_id, $old_ch[$company_id])) {
						$change_array['added']['c_h'][] = array(
							'from' => $company_id,
							'to' => $department_id
						);
					} elseif (!isset($old_ch[$company_id])) {
						$change_array['added']['c_h'][] = array(
							'from' => $company_id,
							'to' => $department_id
						);
					}
				} elseif(!in_array($department_id, $old_ch[$company_id])) {
					$change_array['added']['c_h'][] = array(
						'from' => $company_id,
						'to' => $department_id
					);
				}
			}
		}

		foreach ($new_hd as $department_id => $driver_array) {
			foreach ($driver_array as $key => $driver_id) {
				if (!isset($old_hd[$department_id][$key])) {
					if(isset($old_hd[$department_id]) && !in_array($driver_id, $old_hd[$department_id])) {
						$change_array['added']['h_d'][] = array(
							'from' => $department_id,
							'to' => $driver_id
						);
					} elseif (!isset($old_hd[$department_id])) {
						$change_array['added']['h_d'][] = array(
							'from' => $department_id,
							'to' => $driver_id
						);
					}
				} elseif(!in_array($driver_id, $old_hd[$department_id])) {
					$change_array['added']['h_d'][] = array(
						'from' => $department_id,
						'to' => $driver_id
					);
				}
			}
		}

		foreach ($new_df as $driver_id => $fleet_array) {
			foreach ($fleet_array as $key => $fleet_id) {
				if (!isset($old_df[$driver_id][$key])) {
					if(isset($old_df[$driver_id]) && !in_array($fleet_id, $old_df[$driver_id])) {
						$change_array['added']['d_f'][] = array(
							'from' => $driver_id,
							'to' => $fleet_id
						);
					} elseif(!isset($old_df[$driver_id])) { //new todo stugel
						$change_array['added']['d_f'][] = array(
							'from' => $driver_id,
							'to' => $fleet_id
						);
					}
				} elseif(!in_array($fleet_id, $old_df[$driver_id])) {
					$change_array['added']['d_f'][] = array(
						'from' => $driver_id,
						'to' => $fleet_id
					);
				}
			}
		}


		foreach ($old_ch as $company_id => $department_array) {
			foreach ($department_array as $key => $department_id) {
				if (!isset($new_ch[$company_id][$key])) {
					if(isset($new_ch[$company_id]) && !in_array($department_id, $new_ch[$company_id])) {
						$change_array['deleted']['c_h'][] = array(
							'from' => $company_id,
							'to' => $department_id
						);
					} elseif(!isset($new_ch[$company_id])) { //new todo stugel
						$change_array['deleted']['c_h'][] = array(
							'from' => $company_id,
							'to' => $department_id
						);
					}
				} elseif(!in_array($department_id, $new_ch[$company_id])) {
					$change_array['deleted']['c_h'][] = array(
						'from' => $company_id,
						'to' => $department_id
					);
				}
			}
		}

		foreach ($old_hd as $department_id => $driver_array) {
			foreach ($driver_array as $key => $driver_id) {
				if (!isset($new_hd[$department_id][$key])) {
					if(isset($new_hd[$department_id]) && !in_array($driver_id, $new_hd[$department_id])) {
						$change_array['deleted']['h_d'][] = array(
							'from' => $department_id,
							'to' => $driver_id
						);
					} elseif (!isset($new_hd[$department_id])) { //new todo
						$change_array['deleted']['h_d'][] = array(
							'from' => $department_id,
							'to' => $driver_id
						);
					}
				} elseif(!in_array($driver_id, $new_hd[$department_id])) {
					$change_array['deleted']['h_d'][] = array(
						'from' => $department_id,
						'to' => $driver_id
					);
				}
			}
		}

		foreach ($old_df as $driver_id => $fleet_array) {
			foreach ($fleet_array as $key => $fleet_id) {
				if (!isset($new_df[$driver_id][$key])) {
					if(isset($new_df[$driver_id]) && !in_array($fleet_id, $new_df[$driver_id])) {
						$change_array['deleted']['d_f'][] = array(
							'from' => $driver_id,
							'to' => $fleet_id
						);
					} elseif (!isset($new_df[$driver_id])) { //new todo
						$change_array['deleted']['d_f'][] = array(
							'from' => $driver_id,
							'to' => $fleet_id
						);
					}
				} elseif(!in_array($fleet_id, $new_df[$driver_id])) {
					$change_array['deleted']['d_f'][] = array(
						'from' => $driver_id,
						'to' => $fleet_id
					);
				}
			}
		}


		return $change_array;

	}

	public function car_info() {

		// $this->load->authorisation();

		$user_id = $this->session->user_id;
		$lng = $this->load->lng();
		$data = array();

		$row = $this->db->select('company_id')->from('user')->where('id', $user_id)->get()->row_array();
		$company_id = $row['company_id'];

		$fleet_arr = array();
		$driver_arr = array();
		$arr = $this->input->post('arr');



		foreach ($arr as $value) :
			if(preg_match('/^(f)/', $value['key'])) :
				$fleet_arr[] = preg_replace('/^(f)/', '', $value['key']);
			elseif (preg_match('/^(d)/', $value['key'])) :
				$driver_arr[] = preg_replace('/^(d)/', '', $value['key']);
			endif;
		endforeach;


		$fleet_ids = implode(',', $fleet_arr);
		$staff_ids = implode(',', $driver_arr);



		if($fleet_ids != '') {

			$sql = "
				SELECT
					`brand`.`title_".$lng."` AS `brand`,
					`model`.`title_".$lng."` AS `model`,
					`fleet_type`.`title_".$lng."` AS `fleet_type`,
					`fuel`.`title_".$lng."` AS `fuel`,
					`insurance_type`.`title_".$lng."` AS `insurance_type`,
					`staff`.`first_name`,
					`staff`.`last_name`,
					`staff`.`contact_1`,
					`staff`.`contact_2`,
					`staff`.`email`,
					`staff`.`address`,
					`staff`.`post_code`,
					`staff`.`position`,
					`staff`.`nest_card_id`,
					`staff`.`photo`,
					`country`.`title_".$lng."` AS `country`,
					GROUP_CONCAT(
						`department`.`title`
					) AS `department`,
					`fleet`.*
				 FROM
				   `fleet`
				LEFT JOIN `model` 
					ON `model`.`id` = `fleet`.`model_id` 
				LEFT JOIN `brand` 
					ON `brand`.`id` = `model`.`brand_id` 
				LEFT JOIN `fleet_type`
					ON `fleet`.`fleet_type_id` = `fleet_type`.`id`
				LEFT JOIN `fuel`
					ON `fleet`.`fuel_id` = `fuel`.`id` 
				LEFT JOIN `insurance_type`
					ON `fleet`.`insurance_type_id_1` = `insurance_type`.`id`	
				LEFT JOIN `staff`
					ON FIND_IN_SET(`staff`.`id`, `fleet`.`staff_ids`)	
				LEFT JOIN `department`
					ON FIND_IN_SET(`department`.`id`, `staff`.`department_ids`)
				LEFT JOIN `country`
					ON `country`.`id` = `staff`.`country_id`			
				WHERE FIND_IN_SET(`fleet`.`id`, '" . $fleet_ids . "')
				GROUP BY `fleet`.`id`
			";


			$result = $this->db->query($sql);

			$data['result'] = $result->result_array();

		}

		if($staff_ids != '') {
			$sql = "
				SELECT
					`brand`.`title_".$lng."` AS `brand`,
					`model`.`title_".$lng."` AS `model`,
					`fleet_type`.`title_".$lng."` AS `fleet_type`,
					`fuel`.`title_".$lng."` AS `fuel`,
					`insurance_type`.`title_".$lng."` AS `insurance_type`,
					`staff`.`first_name`,
					`staff`.`last_name`,
					`staff`.`contact_1`,
					`staff`.`contact_2`,
					`staff`.`email`,
					`staff`.`address`,
					`staff`.`post_code`,
					`staff`.`position`,
					`staff`.`nest_card_id`,
					`staff`.`photo`,
					`country`.`title_".$lng."` AS `country`,
					GROUP_CONCAT(
						`department`.`title`
					) AS `department`,
					`fleet`.*
				 FROM
				   `fleet`
				LEFT JOIN `model` 
					ON `model`.`id` = `fleet`.`model_id` 
				LEFT JOIN `brand` 
					ON `brand`.`id` = `model`.`brand_id` 
				LEFT JOIN `fleet_type`
					ON `fleet`.`fleet_type_id` = `fleet_type`.`id`
				LEFT JOIN `fuel`
					ON `fleet`.`fuel_id` = `fuel`.`id` 
				LEFT JOIN `insurance_type`
					ON `fleet`.`insurance_type_id_1` = `insurance_type`.`id`	
				LEFT JOIN `staff`
					ON FIND_IN_SET(`staff`.`id`, `fleet`.`staff_ids`)	
				LEFT JOIN `department`
					ON FIND_IN_SET(`department`.`id`, `staff`.`department_ids`)
				LEFT JOIN `country`
					ON `country`.`id` = `staff`.`country_id`			
				WHERE FIND_IN_SET(`staff`.`id`, '" . $staff_ids . "')
				GROUP BY `staff`.`id`
			";

			$result = $this->db->query($sql);

			$data['result_driver'] = $result->result_array();
		}



		$this->load->view('structure/car_info', $data);
	}


	public function vehicle_inspection() {

		$user_id = $this->session->user_id;
		$lng = $this->load->lng();
		$data = array();

		$sql_add_user = "
			SELECT
				CONCAT_WS(
					' ',
					`first_name`,
					`last_name`
			  	) AS `name`
			FROM
			  `user`
			WHERE `id` = '".$user_id."'	  	
		";

		$query_add_user = $this->db->query($sql_add_user);

		$data['user'] = $query_add_user->row_array();

		$this->load->view('structure/vehicle_inspection', $data);
	}



}
//end of class
