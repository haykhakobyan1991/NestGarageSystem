<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Structure extends MX_Controller
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

	}

	private function my_lang($line, $args = array())
	{
		$CI =& get_instance();
		$lang = $CI->lang->line($line);
		// $lang = '%s %s were %s';// this would be the language line
		return vsprintf($lang, $args);
	}


	/**
	 * @return mixed
	 */
	private function upload_config()
	{


		$config['allowed_types'] = 'gif|jpg|png|bmp';
		$config['max_size'] = '4097152'; //4 MB
		$config['file_name'] = $this->uname(3, 8);
		$config['max_width'] = '2048';
		$config['max_height'] = '1200';

		$this->load->library('upload', $config);

		$this->upload->initialize($config);

		return $config;

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

	/**
	 * @param int $start
	 * @param int $length
	 * @return bool|string
	 * Ex: 45f7fd76
	 */
	private function uname($start = 3, $length = 2)
	{

		return substr(md5(time() . rand()), $start, $length);

	}

	/**
	 * @param $text
	 * @return string
	 */
	public function get_first_character($text)
	{
		return mb_substr($text, 0, 1, 'utf-8');
	}

	/**
	 * @return string
	 */
	public function rand_color()
	{
		return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
	}

	public function structure1()
	{

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
			WHERE `id` = '" . $user_id . "'	  	
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
				`brand`.`title_" . $lng . "`,
				`model`.`title_" . $lng . "`
			  ) AS `model`,
			  `fleet`.`id` AS `fleet_id`,
			  `fleet`.`fleet_plate_number`
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
				/*AND `staff`.`Id` <> `head_staff`.`Id` new*/
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
			/*AND `staff`.`id` <> `head_staff`.`id` todo*/
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
				$structure_arr[] = array('key' => 'h' . $value['department_id'], 'title' => $value['head'], 'text' => $value['department'], 'img' => base_url('uploads/' . $folder . '/staff/original/' . $value['head_staff_photo']), 'fromDepartment' => true, 'from' => true);
				$from_to_arr[] = array('from' => 'c' . $value['company_id'], 'to' => 'h' . $value['department_id']);
			endif;
			$department_id = $value['department_id'];

			if ($value['driver_id'] != $driver_id && $value['driver_id'] != '') :
				$structure_arr[] = array('key' => 'd' . $value['driver_id'], 'color' => 'salmon', 'text' => ($value['driver'] == $value['head'] ? '▲  ' . $value['driver'] : $value['driver']), 'img' => ($value['driver_photo'] != '' ? base_url('uploads/' . $folder . '/staff/original/' . $value['driver_photo']) : base_url('assets/img/staff.svg')), 'toStaff' => true, 'from' => true, 'fromDepartment' => true);
				$from_to_arr[] = array('from' => 'h' . $value['department_id'], 'to' => 'd' . $value['driver_id']);
			endif;
			$driver_id = $value['driver_id'];

			if ($value['fleet_id'] != $fleet_id && $value['fleet_id'] != '') :
				$structure_arr[] = array('key' => 'f' . $value['fleet_id'], 'text' => $value['model'], 'title' => $value['fleet_plate_number'], 'img' => base_url('assets/img/car.svg'), 'to' => true);
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

	public function structure2()
	{
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
				`brand`.`title_" . $lng . "`,
				`model`.`title_" . $lng . "`
			  ) AS `model`,
			  `fleet`.`id` AS `fleet_id`,
			  `fleet`.`fleet_plate_number`
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
				/*AND `staff`.`Id` <> `head_staff`.`Id` new*/
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
			/* AND `staff`.`id` <> `head_staff`.`id` todo */
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
				$structure_arr[] = array('key' => 'c' . $value['company_id'], 'name' => $value['company'], 'title' => '');
			endif;
			$cmp_id = $value['company_id'];

			if ($value['department_id'] != $department_id) :
				$structure_arr[] = array('key' => 'h' . $value['department_id'], 'name' => $value['head'] . ' (' . $value['department'] . ')', 'parent' => 'c' . $value['company_id'], 'title' => '');
			endif;
			$department_id = $value['department_id'];

			if ($value['driver_id'] != $driver_id) :
				$structure_arr[] = array('key' => 'd' . $value['driver_id'], 'name' => $value['driver'], 'parent' => 'h' . $value['department_id'], 'title' => '');
			endif;
			$driver_id = $value['driver_id'];

			if ($value['fleet_id'] != '') :
				$structure_arr[] = array('key' => 'f' . $value['fleet_id'], 'name' => $value['model'] . ' (' . $value['fleet_plate_number'] . ')', 'parent' => 'd' . $value['driver_id'], 'title' => '');
			endif;

		endforeach;

		$structure_unique = array_values(array_unique($structure_arr, SORT_REGULAR));

		$data['structure'] = json_encode($structure_unique);

		$this->layout->view('structure/structure2', $data);

	}


	public function structure3()
	{

		$this->load->authorisation();

		$user_id = $this->session->user_id;
		$folder = $this->session->folder;
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
				`brand`.`title_" . $lng . "`,
				`model`.`title_" . $lng . "`
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
				AND `staff`.`id` <> `head_staff`.`id` /*new*/
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
			/* AND `staff`.`id` <> `head_staff`.`id` todo */
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
				$structure_arr[] = array('key' => 'c' . $value['company_id'], 'name' => $value['company'], 'title' => '');
			endif;
			$cmp_id = $value['company_id'];

			if ($value['department_id'] != $department_id) :
				$structure_arr[] = array('key' => 'h' . $value['department_id'], 'name' => $value['head'] . ' (' . $value['department'] . ')', 'parent' => 'c' . $value['company_id'], 'title' => '');
			endif;
			$department_id = $value['department_id'];

			if ($value['driver_id'] != $driver_id) :
				$structure_arr[] = array('key' => 'd' . $value['driver_id'], 'name' => $value['driver'], 'parent' => 'h' . $value['department_id'], 'title' => '');
			endif;
			$driver_id = $value['driver_id'];

			if ($value['fleet_id'] != '') :
				$structure_arr[] = array('key' => 'f' . $value['fleet_id'], 'name' => $value['model'], 'parent' => 'd' . $value['driver_id'], 'title' => '');
			endif;

		endforeach;

		$structure_unique = array_values(array_unique($structure_arr, SORT_REGULAR));


		$data['structure'] = json_encode($structure_unique);


		$this->layout->view('structure/structure3', $data);
	}


	public function change_from_to_ax()
	{

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



		if (!isset($new_data_arr['c_h']) || !isset($new_data_arr['h_d']) || !isset($new_data_arr['d_f'])) {
			$return['error'] = 'ERROR'; //todo
			echo json_encode($return);
			return false;
		}

		$array = $this->from_to($new_data_arr['c_h'], $new_data_arr['h_d'], $new_data_arr['d_f'], $old_data_arr['c_h'], $old_data_arr['h_d'], $old_data_arr['d_f']);


		//ask change or no
		if ($this->input->post('value') == '-1') {

			if (isset($array['deleted'])) {
				$return['result'][] = '<b>' . lang('deleted') . '</b>' . hr();
				foreach ($array['deleted'] as $f_t => $value) {
					foreach ($value as $from_to) {

						if ($f_t == 'd_f') {
							$return['result'][] = $this->my_lang('from_driver_vehicle', array($structure_arr['d' . $from_to['from']], $structure_arr['f' . $from_to['to']])) . br();
						} elseif ($f_t == 'h_d') {
							$return['result'][] = $this->my_lang('from_department_driver', array($structure_arr['h' . $from_to['from']], $structure_arr['d' . $from_to['to']])) . br();
						} elseif ($f_t == 'c_h') {
							$return['result'][] = $this->my_lang('from_company_department', array($structure_arr['c' . $from_to['from']], $structure_arr['h' . $from_to['to']])) . br();
						}

					}
				}
			}

			if (isset($array['added'])) {
				$return['result'][] = (isset($array['deleted']) ? hr() . '<b>' . lang('added') . '</b>' . hr() : '<b>' . lang('added') . '</b>' . hr());
				foreach ($array['added'] as $f_t => $value) {
					foreach ($value as $from_to) {
						if ($f_t == 'd_f' && isset($structure_arr['d' . $from_to['from']]) && isset($structure_arr['f' . $from_to['to']])) {
							$return['result'][] = $this->my_lang('from_driver_to_vehicle', array($structure_arr['d' . $from_to['from']], $structure_arr['f' . $from_to['to']])) . br();
						} elseif ($f_t == 'h_d' && isset($structure_arr['h' . $from_to['from']]) && isset($structure_arr['d' . $from_to['to']])) {
							$return['result'][] = $this->my_lang('from_department_to_driver', array($structure_arr['h' . $from_to['from']], $structure_arr['d' . $from_to['to']])) . br();
						} elseif ($f_t == 'c_h' && isset($structure_arr['c' . $from_to['from']]) && isset($structure_arr['h' . $from_to['to']])) {
							$return['result'][] = $this->my_lang('from_company_to_department', array($structure_arr['c' . $from_to['from']], $structure_arr['h' . $from_to['to']])) . br();
						} else {
							$return['result'] = false;
							$return['error'] = lang('impossible_connectivity'); //todo
						}

					}
				}
			}

		} elseif ($this->input->post('value') == '1') {

			$return['result'] = true;

			if (isset($array['deleted'])) {
				foreach ($array['deleted'] as $f_t => $value) {

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

							if ($row['department_ids'] != '') {
								$new_departments = $row['department_ids'] . ',' . $from_to['from'];
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

							if ($row['staff_ids'] != '') {
								$new_staffs = $row['staff_ids'] . ',' . $from_to['from'];
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
	private function from_to($new_ch, $new_hd, $new_df, $old_ch, $old_hd, $old_df)
	{

		$change_array = array();

		foreach ($new_ch as $company_id => $department_array) {
			foreach ($department_array as $key => $department_id) {
				if (!isset($old_ch[$company_id][$key])) {
					if (isset($old_ch[$company_id]) && !in_array($department_id, $old_ch[$company_id])) {
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
				} elseif (!in_array($department_id, $old_ch[$company_id])) {
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
					if (isset($old_hd[$department_id]) && !in_array($driver_id, $old_hd[$department_id])) {
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
				} elseif (!in_array($driver_id, $old_hd[$department_id])) {
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
					if (isset($old_df[$driver_id]) && !in_array($fleet_id, $old_df[$driver_id])) {
						$change_array['added']['d_f'][] = array(
							'from' => $driver_id,
							'to' => $fleet_id
						);
					} elseif (!isset($old_df[$driver_id])) { //new todo stugel
						$change_array['added']['d_f'][] = array(
							'from' => $driver_id,
							'to' => $fleet_id
						);
					}
				} elseif (!in_array($fleet_id, $old_df[$driver_id])) {
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
					if (isset($new_ch[$company_id]) && !in_array($department_id, $new_ch[$company_id])) {
						$change_array['deleted']['c_h'][] = array(
							'from' => $company_id,
							'to' => $department_id
						);
					} elseif (!isset($new_ch[$company_id])) { //new todo stugel
						$change_array['deleted']['c_h'][] = array(
							'from' => $company_id,
							'to' => $department_id
						);
					}
				} elseif (!in_array($department_id, $new_ch[$company_id])) {
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
					if (isset($new_hd[$department_id]) && !in_array($driver_id, $new_hd[$department_id])) {
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
				} elseif (!in_array($driver_id, $new_hd[$department_id])) {
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
					if (isset($new_df[$driver_id]) && !in_array($fleet_id, $new_df[$driver_id])) {
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
				} elseif (!in_array($fleet_id, $new_df[$driver_id])) {
					$change_array['deleted']['d_f'][] = array(
						'from' => $driver_id,
						'to' => $fleet_id
					);
				}
			}
		}


		return $change_array;

	}

	public function car_info()
	{

		// $this->load->authorisation();
		//todo if not post redirect to 404

		$user_id = $this->session->user_id;
		$lng = $this->load->lng();
		$data = array();

		$row = $this->db->select('company_id')->from('user')->where('id', $user_id)->get()->row_array();
		$company_id = $row['company_id'];

		$fleet_arr = array();
		$driver_arr = array();
		$arr = $this->input->post('arr');

		$add_sql = '';

		foreach ($arr as $value) :
			if (preg_match('/^(f)/', $value['key'])) :
				$fleet_arr[] = preg_replace('/^(f)/', '', $value['key']);
			elseif (preg_match('/^(d)/', $value['key'])) :
				$driver_arr[] = preg_replace('/^(d)/', '', $value['key']);
			endif;
		endforeach;


		$fleet_ids = implode(',', $fleet_arr);
		$staff_ids = implode(',', $driver_arr);

		if ($staff_ids != '') {
			$add_sql = "OR FIND_IN_SET(`staff`.`id`, '" . $staff_ids . "')"; //todo
		}


		if ($fleet_ids != '') {

			$sql = "
				SELECT
					`brand`.`title_" . $lng . "` AS `brand`,
					`model`.`title_" . $lng . "` AS `model`,
					`fleet_type`.`title_" . $lng . "` AS `fleet_type`,
					`fuel`.`title_" . $lng . "` AS `fuel`,
					`insurance_type`.`title_" . $lng . "` AS `insurance_type`,
					`staff`.`id` AS `staff_id`,
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
					`country`.`title_" . $lng . "` AS `country`,
					`department`.`title` AS `department`,
					`value`.`title_" . $lng . "` AS `value`,
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
				LEFT JOIN `value`
					ON `value`.`id` = `fleet`.`mileage_value_id`				
				WHERE FIND_IN_SET(`fleet`.`id`, '" . $fleet_ids . "')
				" . $add_sql . "
				ORDER BY `staff`.`id`, `fleet`.`id`
			";


			$result = $this->db->query($sql);

			$data['result'] = $result->result_array();

		}


		$this->load->view('structure/car_info', $data);
	}


	public function vehicle_inspection()
	{

		$user_id = $this->session->user_id;
		$lng = $this->load->lng();
		$data = array();
		$arr = $this->input->post('arr');

		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');

		$sql_add_user = "
			SELECT
				CONCAT_WS(
					' ',
					`first_name`,
					`last_name`
			  	) AS `name`
			FROM
			  `user`
			WHERE `id` = '" . $user_id . "'	  	
		";

		$query_add_user = $this->db->query($sql_add_user);

		$data['user'] = $query_add_user->row_array();

		$fleet_arr = array();

		if ($arr) {
			foreach ($arr as $value) {
				if (preg_match('/^(f)/', $value['key'])) {
					$fleet_arr['id'][] = preg_replace('/^(f)/', '', $value['key']);
					$fleet_arr['name'][] = $value['name'];
				}
			}
		}


		if ($fleet_arr) {
			$data['fleet'] = $fleet_arr;

			$sql = "
				SELECT 
				  `inspection`.`id`,
				  `inspection`.`add_date`,
				  `inspection`.`add_user_id`,
				  `inspection`.`end_date`,
				  `inspection`.`price`,
				  `inspection`.`fleet_id`,
				  CONCAT_WS(
					' ',
					`brand`.`title_" . $lng . "`,
					`model`.`title_" . $lng . "`
				  ) AS `brand_model`,
				  CONCAT_WS(' ', `user`.`first_name`, `user`.`last_name`) AS `user_name`,
				  `inspection`.`status` 
				FROM
				  `inspection` 
				LEFT JOIN `fleet` 
					ON `fleet`.`id` = `inspection`.`fleet_id`
				LEFT JOIN `user` 
					ON `user`.`id` = `inspection`.`add_user_id`	
				LEFT JOIN `model` 
					ON `model`.`id` = `fleet`.`model_id` 
				LEFT JOIN `brand` 
					ON `brand`.`id` = `model`.`brand_id` 	
				WHERE `inspection`.`status` = '1' 
				AND FIND_IN_SET(`inspection`.`fleet_id`, '" . implode(',', $fleet_arr['id']) . "')
				AND (`inspection`.`add_date` >= '" . $date_from . "' AND `inspection`.`add_date` <= '" . $date_to . "')
				ORDER BY `inspection`.`fleet_id`
			";

			$query = $this->db->query($sql);

			$data['fleet_data'] = $query->result_array();

			$this->load->view('structure/vehicle_inspection', $data);
		}
	}


	public function inspection_ax()
	{

		//$this->load->authorisation('Structure', 'inspection');

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


		$fleet_id = $this->input->post('fleet_id');

		// validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');


		if ($fleet_id != '') {

			$end_date = $this->input->post('end_date');
			$price = $this->input->post('price');
			$date = $this->input->post('date');

			if (is_array($end_date)) :
				foreach ($end_date as $i => $end_date_val) :
					if ($end_date_val == '') :
						$n = 1;
						$validation_errors = array('end_date[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;


					if ($price[$i] == '') :
						$n = 1;
						$validation_errors = array('price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;
				endforeach;
			endif;
			// end of validation


			if ($n == 1) {
				echo json_encode($messages);
				return false;
			}


			$status = 1;


			$sql = "
				INSERT INTO `inspection` (
				  `add_date`,
				  `add_user_id`,
				  `end_date`,
				  `price`,
				  `fleet_id`,
				  `status`
				) 
				VALUES
			";


			foreach ($date as $key => $add_dte) {
				$sql .= "(
				" . $this->load->db_value($add_dte) . ",
				" . $this->load->db_value($user_id) . ",
				" . $this->load->db_value($end_date[$key]) . ",
				" . $this->load->db_value($price[$key]) . ",
				" . $this->load->db_value($fleet_id) . ",
				" . $this->load->db_value($status) . "
			),";
			}

			$sql = substr($sql, 0, -1);

			$result = $this->db->query($sql);

		} else {

			$fl_ids = $this->input->post('fl_id');
			$date = $this->input->post('date');
			$price = $this->input->post('price');
			$end_date = $this->input->post('end_date');
			$status = '1';

			if (is_array($end_date)) :
				foreach ($end_date as $i => $end_date_val) :
					if ($end_date_val == '') :
						$n = 1;
						$validation_errors = array('end_date[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;


					if ($price[$i] == '') :
						$n = 1;
						$validation_errors = array('price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;
				endforeach;
			endif;

			if ($n == 1) {
				echo json_encode($messages);
				return false;
			}


			$sql = "
				INSERT INTO `inspection` (
				  `add_date`,
				  `add_user_id`,
				  `end_date`,
				  `price`,
				  `fleet_id`,
				  `status`
				) 
				VALUES
			";


			foreach ($fl_ids as $key => $fl_id) {
				$sql .= "(
				
				" . $this->load->db_value($date[$key]) . ",
				" . $this->load->db_value($user_id) . ",
				" . $this->load->db_value($end_date[$key]) . ",
				" . $this->load->db_value($price[$key]) . ",
				" . $this->load->db_value($fl_id) . ",
				" . $this->load->db_value($status) . "
			),";
			}

			$sql = substr($sql, 0, -1);

			$result = $this->db->query($sql);


		}
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


	public function edit_inspection_ax()
	{

		//$this->load->authorisation('Structure', 'inspection');

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

		// validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');


		$end_date = $this->input->post('end_date');
		$price = $this->input->post('price');
		$add_date = $this->input->post('add_date');
		$inspection_id = $this->input->post('inspection_id');

		$this->form_validation->set_rules('add_date', 'add_date', 'required');
		$this->form_validation->set_rules('price', 'price', 'required');
		$this->form_validation->set_rules('end_date', 'end_date', 'required');


		if ($this->form_validation->run() == false) {
			//validation errors
			$n = 1;

			$validation_errors = array(
				'add_date[' . $inspection_id . ']' => form_error('add_date'),
				'inspection_price[' . $inspection_id . ']' => form_error('price'),
				'end_date[' . $inspection_id . ']' => form_error('end_date')
			);
			$messages['error']['elements'][] = $validation_errors;
		}

		// end of validation


		if ($n == 1) {
			echo json_encode($messages);
			return false;
		}


		$sql = "
			UPDATE `inspection` set
				`add_date` = " . $this->load->db_value($add_date) . ",
				`add_user_id` = " . $this->load->db_value($user_id) . ",
				`end_date` = " . $this->load->db_value($end_date) . ",
				`price` = " . $this->load->db_value($price) . "
			WHERE `id` = " . $this->load->db_value($inspection_id) . "	
		";


		$result = $this->db->query($sql);


		if ($result) {
			$messages['success'] = 1;
			$messages['message'] = $inspection_id;
		} else {
			$messages['success'] = 0;
			$messages['error'] = lang('error');
		}

		// Return success or error message
		echo json_encode($messages);
		return true;
	}


	public function vehicle_fuel()
	{

		$user_id = $this->session->user_id;
		$lng = $this->load->lng();
		$data = array();
		$arr = $this->input->post('arr');

		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');

		$sql_add_user = "
			SELECT
				CONCAT_WS(
					' ',
					`first_name`,
					`last_name`
			  	) AS `name`
			FROM
			  `user`
			WHERE `id` = '" . $user_id . "'	  	
		";

		$query_add_user = $this->db->query($sql_add_user);

		$data['user'] = $query_add_user->row_array();


		$fleet_arr = array();

		if ($arr) {
			foreach ($arr as $value) {
				if (preg_match('/^(f)/', $value['key'])) {
					$fleet_arr['id'][] = preg_replace('/^(f)/', '', $value['key']);
					$fleet_arr['name'][] = $value['name'];
				}
			}
		}


		if ($fleet_arr) {


			$sql_add_staff = "
				SELECT
				   `staff`.`id`,
				   CONCAT_WS(
					  ' ',
					  `staff`.`first_name`,
					  `staff`.`last_name`
				   ) AS `name`
				FROM 
				 `fleet`  
				LEFT JOIN `staff` 
					ON FIND_IN_SET(
					  `staff`.`id`,
					  `fleet`.`staff_ids`
					) 
			   WHERE `fleet`.`id` = '" . $fleet_arr['id'][0] . "'
			    GROUP BY `staff`.`id`		
			";

			$query_add_staff = $this->db->query($sql_add_staff);

			$data['staff'] = $query_add_staff->result_array();


			$data['fleet'] = $fleet_arr;

			$sql = "
				SELECT 
				  `fuel_consumption`.`id`,
				  `fuel_consumption`.`add_date`,
				  `fuel_consumption`.`add_user_id`,
				  `fuel_consumption`.`staff_id`, /**/
				  `fuel_consumption`.`count_liter`,
				  `fuel_consumption`.`one_liter_price`,
				  `fuel_consumption`.`price`,
				  `fuel_consumption`.`fleet_id`, /**/
				  CONCAT_WS(
					' ',
					`brand`.`title_" . $lng . "`,
					`model`.`title_" . $lng . "`
				  ) AS `brand_model`,
				  CONCAT_WS(' ', `user`.`first_name`, `user`.`last_name`) AS `user_name`,
				  CONCAT_WS(
					' ',
					`staff`.`first_name`,
					`staff`.`last_name`
				  ) AS staff_name,
				  `fuel_consumption`.`status` 
				FROM
				  `fuel_consumption` 
				LEFT JOIN `fleet` 
					ON `fleet`.`id` = `fuel_consumption`.`fleet_id`
				LEFT JOIN `user` 
					ON `user`.`id` = `fuel_consumption`.`add_user_id`
				LEFT JOIN `staff` 
					ON `staff`.`id` = `fuel_consumption`.`staff_id`		
				LEFT JOIN `model` 
					ON `model`.`id` = `fleet`.`model_id` 
				LEFT JOIN `brand` 
					ON `brand`.`id` = `model`.`brand_id` 	
				WHERE `fuel_consumption`.`status` = '1' 
				AND FIND_IN_SET(`fuel_consumption`.`fleet_id`, '" . implode(',', $fleet_arr['id']) . "')
				AND (`fuel_consumption`.`add_date` >= '" . $date_from . "' AND `fuel_consumption`.`add_date` <= '" . $date_to . "')
				ORDER BY `brand_model`
			";

			$query = $this->db->query($sql);

			$data['fleet_data'] = $query->result_array();

			$this->load->view('structure/vehicle_fuel', $data);
		}
	}


	public function fuel_ax()
	{

		//$this->load->authorisation('Structure', 'fuel');

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


		$fleet_id = $this->input->post('fleet_id');

		// validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');


		if ($fleet_id != '') {


			$price = $this->input->post('price');
			$one_liter_price = $this->input->post('one_liter_price');
			$count_liter = $this->input->post('count_liter');
			$staff_id = $this->input->post('staff_id');
			$date = $this->input->post('date');

			if (is_array($one_liter_price)) :
				foreach ($one_liter_price as $i => $one_liter_price_val) :
					if ($one_liter_price_val == '') :
						$n = 1;
						$validation_errors = array('one_liter_price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;


					if ($price[$i] == '') :
						$n = 1;
						$validation_errors = array('price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($count_liter[$i] == '') :
						$n = 1;
						$validation_errors = array('count_liter[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;


					if ($staff_id[$i] == '') :
						$n = 1;
						$validation_errors = array('staff_id[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

				endforeach;
			endif;
			// end of validation


			if ($n == 1) {
				echo json_encode($messages);
				return false;
			}


			$status = 1;


			$sql = "
				INSERT INTO `fuel_consumption` (
				  `add_date`,
				  `add_user_id`,
				  `staff_id`,
				  `count_liter`,
				  `one_liter_price`,
				  `price`,
				  `fleet_id`,
				  `status`
				) 
				VALUES
			";


			foreach ($date as $key => $add_dte) {
				$sql .= "(
					" . $this->load->db_value($add_dte) . ",
					" . $this->load->db_value($user_id) . ",
					" . $this->load->db_value($staff_id[$key]) . ",
					" . $this->load->db_value($count_liter[$key]) . ",
					" . $this->load->db_value($one_liter_price[$key]) . ",
					" . $this->load->db_value($price[$key]) . ",
					" . $this->load->db_value($fleet_id) . ",
					" . $this->load->db_value($status) . "
				),";
			}

			$sql = substr($sql, 0, -1);

			$result = $this->db->query($sql);

		} else {

			$fl_ids = $this->input->post('fl_id');
			$price = $this->input->post('price');
			$one_liter_price = $this->input->post('one_liter_price');
			$count_liter = $this->input->post('count_liter');
			$staff_id = $this->input->post('staff_id');
			$date = $this->input->post('date');
			$status = '1';

			if (is_array($one_liter_price)) :
				foreach ($one_liter_price as $i => $one_liter_price_val) :
					if ($one_liter_price_val == '') :
						$n = 1;
						$validation_errors = array('one_liter_price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;


					if ($price[$i] == '') :
						$n = 1;
						$validation_errors = array('price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($count_liter[$i] == '') :
						$n = 1;
						$validation_errors = array('count_liter[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;


					if ($staff_id[$i] == '') :
						$n = 1;
						$validation_errors = array('staff_id[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

				endforeach;
			endif;
			// end of validation


			if ($n == 1) {
				echo json_encode($messages);
				return false;
			}


			$sql = "
				INSERT INTO `fuel_consumption` (
				  `add_date`,
				  `add_user_id`,
				  `staff_id`,
				  `count_liter`,
				  `one_liter_price`,
				  `price`,
				  `fleet_id`,
				  `status`
				) 
				VALUES
			";


			foreach ($fl_ids as $key => $fl_id) {

				$sql .= "(
					" . $this->load->db_value($date[$key]) . ",
					" . $this->load->db_value($user_id) . ",
					" . $this->load->db_value($staff_id[$key]) . ",
					" . $this->load->db_value($count_liter[$key]) . ",
					" . $this->load->db_value($one_liter_price[$key]) . ",
					" . $this->load->db_value($price[$key]) . ",
					" . $this->load->db_value($fl_id) . ",
					" . $this->load->db_value($status) . "
				),";
			}

			$sql = substr($sql, 0, -1);

			$result = $this->db->query($sql);


		}
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

	public function edit_fuel_ax()
	{

		//$this->load->authorisation('Structure', 'fuel');

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


		// validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');

		$this->form_validation->set_rules('fuel_add_date', 'fuel_add_date', 'required');
		$this->form_validation->set_rules('fuel_price', 'fuel_price', 'required');
		$this->form_validation->set_rules('fuel_one_liter_price', 'fuel_one_liter_price', 'required');
		$this->form_validation->set_rules('fuel_count_liter', 'fuel_count_liter', 'required');
		$this->form_validation->set_rules('fuel_staff_id', 'fuel_fuel_staff_id', 'required');

		$fuel_id = $this->input->post('fuel_id');


		if ($this->form_validation->run() == false) {
			//validation errors
			$n = 1;

			$validation_errors = array(
				'fuel_add_date[' . $fuel_id . ']' => form_error('fuel_add_date'),
				'fuel_price[' . $fuel_id . ']' => form_error('fuel_price'),
				'fuel_one_liter_price[' . $fuel_id . ']' => form_error('fuel_one_liter_price'),
				'fuel_count_liter[' . $fuel_id . ']' => form_error('fuel_count_liter'),
				'fuel_staff_id[' . $fuel_id . ']' => form_error('fuel_staff_id')
			);
			$messages['error']['elements'][] = $validation_errors;
		}

		// end of validation
		if ($n == 1) {
			echo json_encode($messages);
			return false;
		}


		$price = $this->input->post('fuel_price');
		$one_liter_price = $this->input->post('fuel_one_liter_price');
		$count_liter = $this->input->post('fuel_count_liter');
		$staff_id = $this->input->post('fuel_staff_id');
		$date = $this->input->post('fuel_add_date');


		$sql = "
			UPDATE `fuel_consumption` SET
				`add_date`  = " . $this->load->db_value($date) . ",
				`add_user_id`  = " . $this->load->db_value($user_id) . ",
				`staff_id`  = " . $this->load->db_value($staff_id) . ",
				`count_liter`  = " . $this->load->db_value($count_liter) . ",
				`one_liter_price`  = " . $this->load->db_value($one_liter_price) . ",
				`price`  = " . $this->load->db_value($price) . "
			WHERE `id` = " . $this->load->db_value($fuel_id) . "
		";


		$result = $this->db->query($sql);

		if ($result) {
			$messages['success'] = 1;
			$messages['message'] = $fuel_id;
		} else {
			$messages['success'] = 0;
			$messages['error'] = lang('error');
		}

		// Return success or error message
		echo json_encode($messages);
		return true;
	}


	public function vehicle_fine()
	{

		$user_id = $this->session->user_id;
		$lng = $this->load->lng();
		$data = array();
		$arr = $this->input->post('arr');

		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');

		$sql_add_user = "
			SELECT
				CONCAT_WS(
					' ',
					`first_name`,
					`last_name`
			  	) AS `name`
			FROM
			  `user`
			WHERE `id` = '" . $user_id . "'	  	
		";

		$query_add_user = $this->db->query($sql_add_user);

		$data['user'] = $query_add_user->row_array();


		$fleet_arr = array();

		if ($arr) {
			foreach ($arr as $value) {
				if (preg_match('/^(f)/', $value['key'])) {
					$fleet_arr['id'][] = preg_replace('/^(f)/', '', $value['key']);
					$fleet_arr['name'][] = $value['name'];
				}
			}
		}


		if ($fleet_arr) {


			$sql_add_staff = "
				SELECT
				   `staff`.`id`,
				   CONCAT_WS(
					  ' ',
					  `staff`.`first_name`,
					  `staff`.`last_name`
				   ) AS `name`
				FROM 
				 `fleet`  
				LEFT JOIN `staff` 
					ON FIND_IN_SET(
					  `staff`.`id`,
					  `fleet`.`staff_ids`
					) 
			   WHERE `fleet`.`id` = '" . $fleet_arr['id'][0] . "'
			    GROUP BY `staff`.`id`		
			";

			$query_add_staff = $this->db->query($sql_add_staff);

			$data['staff'] = $query_add_staff->result_array();


			$data['fleet'] = $fleet_arr;

			$sql = "
				SELECT 
				  `fine`.`id`,
				  `fine`.`add_date`,
				  `fine`.`add_user_id`,
				  `fine`.`staff_id`, /**/
				  `fine`.`type`,
				  `fine`.`other_info`,
				  `fine`.`price`,
				  `fine`.`fleet_id`, /**/
				  CONCAT_WS(
					' ',
					`brand`.`title_" . $lng . "`,
					`model`.`title_" . $lng . "`
				  ) AS `brand_model`,
				  CONCAT_WS(' ', `user`.`first_name`, `user`.`last_name`) AS `user_name`,
				  CONCAT_WS(
					' ',
					`staff`.`first_name`,
					`staff`.`last_name`
				  ) AS staff_name,
				  `fine`.`status` 
				FROM
				  `fine` 
				LEFT JOIN `fleet` 
					ON `fleet`.`id` = `fine`.`fleet_id`
				LEFT JOIN `user` 
					ON `user`.`id` = `fine`.`add_user_id`
				LEFT JOIN `staff` 
					ON `staff`.`id` = `fine`.`staff_id`		
				LEFT JOIN `model` 
					ON `model`.`id` = `fleet`.`model_id` 
				LEFT JOIN `brand` 
					ON `brand`.`id` = `model`.`brand_id` 	
				WHERE `fine`.`status` = '1' 
				AND FIND_IN_SET(`fine`.`fleet_id`, '" . implode(',', $fleet_arr['id']) . "')
				AND (`fine`.`add_date` >= '" . $date_from . "' AND `fine`.`add_date` <= '" . $date_to . "')
			";

			$query = $this->db->query($sql);

			$data['fleet_data'] = $query->result_array();

			$this->load->view('structure/vehicle_fine', $data);
		}
	}


	public function fine_ax()
	{

		//$this->load->authorisation('Structure', 'fuel');

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


		$fleet_id = $this->input->post('fleet_id');

		// validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');


		if ($fleet_id != '') {


			$price = $this->input->post('price');
			$type = $this->input->post('type');
			$other_info = $this->input->post('other_info');
			$staff_id = $this->input->post('staff_id');
			$date = $this->input->post('date');

			if (is_array($type)) :
				foreach ($type as $i => $type_val) :

					if ($type_val == '') :
						$n = 1;
						$validation_errors = array('type[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($staff_id[$i] == '') :
						$n = 1;
						$validation_errors = array('staff_id[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;


					if ($price[$i] == '') :
						$n = 1;
						$validation_errors = array('price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

				endforeach;
			endif;
			// end of validation


			if ($n == 1) {
				echo json_encode($messages);
				return false;
			}


			$status = 1;


			$sql = "
				INSERT INTO `fine` (
				  `add_date`,
				  `add_user_id`,
				  `type`,
				  `staff_id`,
				  `price`,
				  `other_info`,
				  `fleet_id`,
				  `status`
				) 
				VALUES
			";


			foreach ($date as $key => $add_dte) {
				$sql .= "(
				" . $this->load->db_value($add_dte) . ",
				" . $this->load->db_value($user_id) . ",
				" . $this->load->db_value($type[$key]) . ",
				" . $this->load->db_value($staff_id[$key]) . ",
				" . $this->load->db_value($price[$key]) . ",
				" . $this->load->db_value($other_info[$key]) . ",
				" . $this->load->db_value($fleet_id) . ",
				" . $this->load->db_value($status) . "
			),";
			}

			$sql = substr($sql, 0, -1);

			$result = $this->db->query($sql);

		} else {

			$fl_ids = $this->input->post('fl_id');
			$date = $this->input->post('date');
			$price = $this->input->post('price');
			$type = $this->input->post('type');
			$other_info = $this->input->post('other_info');
			$staff_id = $this->input->post('staff_id');
			$status = '1';

			if (is_array($type)) :
				foreach ($type as $i => $type_val) :

					if ($type_val == '') :
						$n = 1;
						$validation_errors = array('type[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($staff_id[$i] == '') :
						$n = 1;
						$validation_errors = array('staff_id[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;


					if ($price[$i] == '') :
						$n = 1;
						$validation_errors = array('price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

				endforeach;
			endif;
			// end of validation


			if ($n == 1) {
				echo json_encode($messages);
				return false;
			}


			$sql = "
				INSERT INTO `fine` (
				  `add_date`,
				  `add_user_id`,
				  `type`,
				  `staff_id`,
				  `price`,
				  `other_info`,
				  `fleet_id`,
				  `status`
				) 
				VALUES
			";


			foreach ($fl_ids as $key => $fl_id) {

				$sql .= "(
					" . $this->load->db_value($date[$key]) . ",
					" . $this->load->db_value($user_id) . ",
					" . $this->load->db_value($type[$key]) . ",
					" . $this->load->db_value($staff_id[$key]) . ",
					" . $this->load->db_value($price[$key]) . ",
					" . $this->load->db_value($other_info[$key]) . ",
					" . $this->load->db_value($fl_id) . ",
					" . $this->load->db_value($status) . "
				),";
			}

			$sql = substr($sql, 0, -1);

			$result = $this->db->query($sql);


		}
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


	public function edit_fine_ax()
	{

		//$this->load->authorisation('Structure', 'fine');

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


		// validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');


		$this->form_validation->set_rules('fine_add_date', 'fine_add_date', 'required');
		$this->form_validation->set_rules('fine_price', 'fine_price', 'required');
		$this->form_validation->set_rules('fine_type', 'fine_type', 'required');
		$this->form_validation->set_rules('fine_staff_id', 'fine_staff_id', 'required');


		$fine_id = $this->input->post('fine_id');

		if ($this->form_validation->run() == false) {
			//validation errors
			$n = 1;

			$validation_errors = array(
				'fine_add_date[' . $fine_id . ']' => form_error('fine_add_date'),
				'fine_price[' . $fine_id . ']' => form_error('fine_price'),
				'fine_type[' . $fine_id . ']' => form_error('fine_type'),
				'fine_staff_id[' . $fine_id . ']' => form_error('fine_staff_id')
			);
			$messages['error']['elements'][] = $validation_errors;
		}


		$price = $this->input->post('fine_price');
		$type = $this->input->post('fine_type');
		$other_info = $this->input->post('fine_other_info');
		$staff_id = $this->input->post('fine_staff_id');
		$date = $this->input->post('fine_add_date');


		// end of validation

		if ($n == 1) {
			echo json_encode($messages);
			return false;
		}


		$sql = "
			UPDATE `fine` SET
				`add_date` = " . $this->load->db_value($date) . ",
				`add_user_id` = " . $this->load->db_value($user_id) . ",
				`type` = " . $this->load->db_value($type) . ",
				`staff_id` = " . $this->load->db_value($staff_id) . ",
				`price` = " . $this->load->db_value($price) . ",
				`other_info` = " . $this->load->db_value($other_info) . "
			WHERE `id` = " . $this->load->db_value($fine_id) . "
		";


		$result = $this->db->query($sql);


		if ($result) {
			$messages['success'] = 1;
			$messages['message'] = $fine_id;
		} else {
			$messages['success'] = 0;
			$messages['error'] = lang('error');
		}

		// Return success or error message
		echo json_encode($messages);
		return true;
	}

	public function vehicle_accident()
	{

		$user_id = $this->session->user_id;
		$lng = $this->load->lng();
		$data = array();
		$arr = $this->input->post('arr');

		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');

		$sql_add_user = "
			SELECT
				CONCAT_WS(
					' ',
					`first_name`,
					`last_name`
			  	) AS `name`
			FROM
			  `user`
			WHERE `id` = '" . $user_id . "'	  	
		";

		$query_add_user = $this->db->query($sql_add_user);

		$data['user'] = $query_add_user->row_array();


		$fleet_arr = array();

		if ($arr) {
			foreach ($arr as $value) {
				if (preg_match('/^(f)/', $value['key'])) {
					$fleet_arr['id'][] = preg_replace('/^(f)/', '', $value['key']);
					$fleet_arr['name'][] = $value['name'];
				}
			}
		}


		if ($fleet_arr) {


			$sql_add_staff = "
				SELECT
				   `staff`.`id`,
				   CONCAT_WS(
					  ' ',
					  `staff`.`first_name`,
					  `staff`.`last_name`
				   ) AS `name`
				FROM 
				 `fleet`  
				LEFT JOIN `staff` 
					ON FIND_IN_SET(
					  `staff`.`id`,
					  `fleet`.`staff_ids`
					) 
			   WHERE `fleet`.`id` = '" . $fleet_arr['id'][0] . "'
			    GROUP BY `staff`.`id`		
			";

			$query_add_staff = $this->db->query($sql_add_staff);

			$data['staff'] = $query_add_staff->result_array();


			$data['fleet'] = $fleet_arr;

			$sql = "
				SELECT 
				  `accident`.`id`,
				  `accident`.`add_date`,
				  `accident`.`add_user_id`,
				  `accident`.`staff_id`, /**/
				  `accident`.`insurance_company`,
				  `accident`.`conclusion_number`,
				  `accident`.`replacement_parts`,
				  `accident`.`return_amount`,
				  `accident`.`file`,
				  `accident`.`fleet_id`, /**/
				  CONCAT_WS(
					' ',
					`brand`.`title_" . $lng . "`,
					`model`.`title_" . $lng . "`
				  ) AS `brand_model`,
				  CONCAT_WS(' ', `user`.`first_name`, `user`.`last_name`) AS `user_name`,
				  CONCAT_WS(
					' ',
					`staff`.`first_name`,
					`staff`.`last_name`
				  ) AS staff_name,
				  `accident`.`status` 
				FROM
				  `accident` 
				LEFT JOIN `fleet` 
					ON `fleet`.`id` = `accident`.`fleet_id`
				LEFT JOIN `user` 
					ON `user`.`id` = `accident`.`add_user_id`
				LEFT JOIN `staff` 
					ON `staff`.`id` = `accident`.`staff_id`		
				LEFT JOIN `model` 
					ON `model`.`id` = `fleet`.`model_id` 
				LEFT JOIN `brand` 
					ON `brand`.`id` = `model`.`brand_id` 	
				WHERE `accident`.`status` = '1' 
				AND FIND_IN_SET(`accident`.`fleet_id`, '" . implode(',', $fleet_arr['id']) . "')
				AND (`accident`.`add_date` >= '" . $date_from . "' AND `accident`.`add_date` <= '" . $date_to . "')
			";

			$query = $this->db->query($sql);

			$data['fleet_data'] = $query->result_array();

			$this->load->view('structure/vehicle_accident', $data);
		}
	}


	public function accident_ax()
	{

		//$this->load->authorisation('Structure', 'fuel');

		$this->load->library('session');
		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');
		$n = 0;
		$user_id = $this->session->user_id;
		$folder = $this->session->folder;

		$result = false;

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}


		$fleet_id = $this->input->post('fleet_id');

		// validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');


		if ($fleet_id != '') {


			$conclusion_number = $this->input->post('conclusion_number');
			$insurance_company = $this->input->post('insurance_company');
			$replacement_parts = $this->input->post('replacement_parts');
			$return_amount = $this->input->post('return_amount');
			$staff_id = $this->input->post('staff_id');
			$date = $this->input->post('date');

			if (is_array($insurance_company)) :
				foreach ($insurance_company as $i => $insurance_company_val) :

					if ($insurance_company_val == '') :
						$n = 1;
						$validation_errors = array('insurance_company[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($staff_id[$i] == '') :
						$n = 1;
						$validation_errors = array('staff_id[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($conclusion_number[$i] == '') :
						$n = 1;
						$validation_errors = array('conclusion_number[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($return_amount[$i] == '') :
						$n = 1;
						$validation_errors = array('return_amount[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

				endforeach;
			endif;
			// end of validation


			if ($n == 1) {
				echo json_encode($messages);
				return false;
			}


			$cpt = count($_FILES);
			$file = array();
			$config_f = array();
			for ($i = 1; $i <= $cpt; $i++) {

				//file config
				$config_f['upload_path'] = set_realpath('uploads/' . $folder . '/accident/fleet_' . $fleet_id);
				$config_f['allowed_types'] = 'pdf|jpg|png|doc|docx|csv|xlsx';
				$config_f['max_size'] = '4097152'; //4 MB
				$config_f['file_name'] = $this->uname(3, 8);
				if (isset($_FILES['accident_file_' . $i]['name']) AND $_FILES['accident_file_' . $i]['name'] != '') {

					if (!file_exists(set_realpath('uploads/' . $folder . '/accident/fleet_' . $fleet_id))) {
						mkdir(set_realpath('uploads/' . $folder . '/accident/fleet_' . $fleet_id), 0755, true);
						copy(set_realpath('uploads/index.html'), set_realpath('uploads/' . $folder . '/accident/fleet_' . $fleet_id . '/index.html'));
					}


					$this->load->library('upload', $config_f);
					$this->upload->initialize($config_f);

					if (!$this->upload->do_upload('accident_file_' . $i)) {
						$validation_errors = array('accident_file_' . $i => $this->upload->display_errors());
						$messages['error']['elements'][] = $validation_errors;
						echo json_encode($messages);
						return false;
					}


					$file_arr = $this->upload->data();

					$file[$i] = $file_arr['file_name'];
				}

			}


			$status = 1;


			$sql = "
				INSERT INTO `accident` (
				  `add_date`,
				  `add_user_id`,
				  `insurance_company`,
				  `staff_id`,
				  `conclusion_number`,
				  `replacement_parts`,
				  `return_amount`,
				  `fleet_id`,
				  `file`,
				  `status`
				) 
				VALUES
			";


			foreach ($date as $key => $add_dte) {
				$sql .= "(
				" . $this->load->db_value($add_dte) . ",
				" . $this->load->db_value($user_id) . ",
				" . $this->load->db_value($insurance_company[$key]) . ",
				" . $this->load->db_value($staff_id[$key]) . ",
				" . $this->load->db_value($conclusion_number[$key]) . ",
				" . $this->load->db_value($replacement_parts[$key]) . ",
				" . $this->load->db_value($return_amount[$key]) . ",
				" . $this->load->db_value($fleet_id) . ",
				" . $this->load->db_value((isset($file[$key]) ? $file[$key] : '')) . ",
				" . $this->load->db_value($status) . "
			),";
			}

			$sql = substr($sql, 0, -1);

			$result = $this->db->query($sql);

		} else {

			$fl_ids = $this->input->post('fl_id');
			$conclusion_number = $this->input->post('conclusion_number');
			$insurance_company = $this->input->post('insurance_company');
			$replacement_parts = $this->input->post('replacement_parts');
			$return_amount = $this->input->post('return_amount');
			$staff_id = $this->input->post('staff_id');
			$date = $this->input->post('date');
			$status = '1';


			if (is_array($insurance_company)) :
				foreach ($insurance_company as $i => $insurance_company_val) :

					if ($insurance_company_val == '') :
						$n = 1;
						$validation_errors = array('insurance_company[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($staff_id[$i] == '') :
						$n = 1;
						$validation_errors = array('staff_id[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($conclusion_number[$i] == '') :
						$n = 1;
						$validation_errors = array('conclusion_number[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($return_amount[$i] == '') :
						$n = 1;
						$validation_errors = array('return_amount[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

				endforeach;
			endif;
			// end of validation


			if ($n == 1) {
				echo json_encode($messages);
				return false;
			}


			$cpt = count($_FILES);
			$file = array();
			$config_f = array();
			foreach ($fl_ids as $key => $fl_id) {

				$i = $key + 1;

				//file config
				$config_f['upload_path'] = set_realpath('uploads/' . $folder . '/accident/fleet_' . $fl_id);
				$config_f['allowed_types'] = 'pdf|jpg|png|doc|docx|csv|xlsx';
				$config_f['max_size'] = '4097152'; //4 MB
				$config_f['file_name'] = $this->uname(3, 8);
				if (isset($_FILES['accident_file_' . $key]['name']) AND $_FILES['accident_file_' . $key]['name'] != '') {

					if (!file_exists(set_realpath('uploads/' . $folder . '/accident/fleet_' . $fl_id))) {
						mkdir(set_realpath('uploads/' . $folder . '/accident/fleet_' . $fl_id), 0755, true);
						copy(set_realpath('uploads/index.html'), set_realpath('uploads/' . $folder . '/accident/fleet_' . $fl_id . '/index.html'));
					}


					$this->load->library('upload', $config_f);
					$this->upload->initialize($config_f);

					if (!$this->upload->do_upload('accident_file_' . $key)) {
						$validation_errors = array('accident_file_' . $key => $this->upload->display_errors());
						$messages['error']['elements'][] = $validation_errors;
						echo json_encode($messages);
						return false;
					}


					$file_arr = $this->upload->data();

					$file[$key] = $file_arr['file_name'];
				}

			}


			$sql = "
				INSERT INTO `accident` (
				  `add_date`,
				  `add_user_id`,
				  `insurance_company`,
				  `staff_id`,
				  `conclusion_number`,
				  `replacement_parts`,
				  `return_amount`,
				  `fleet_id`,
				  `file`,
				  `status`
				) 
				VALUES
			";


			foreach ($fl_ids as $key => $fl_id) {

				$sql .= "(
					" . $this->load->db_value($date[$key]) . ",
					" . $this->load->db_value($user_id) . ",
					" . $this->load->db_value($insurance_company[$key]) . ",
					" . $this->load->db_value($staff_id[$key]) . ",
					" . $this->load->db_value($conclusion_number[$key]) . ",
					" . $this->load->db_value($replacement_parts[$key]) . ",
					" . $this->load->db_value($return_amount[$key]) . ",
					" . $this->load->db_value($fl_id) . ",
					" . $this->load->db_value((isset($file[$key]) ? $file[$key] : '')) . ",
					" . $this->load->db_value($status) . "
				),";
			}

			$sql = substr($sql, 0, -1);

			$result = $this->db->query($sql);


		}
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


	public function edit_accident_ax()
	{

		//$this->load->authorisation('Structure', 'fuel');

		$this->load->library('session');
		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');
		$n = 0;
		$user_id = $this->session->user_id;
		$folder = $this->session->folder;

		$result = false;

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}


		// validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');

		$accident_id = $this->input->post('accident_id');

		$this->form_validation->set_rules('accident_conclusion_number[' . $accident_id . ']', 'accident_conclusion_number', 'required');
		$this->form_validation->set_rules('accident_insurance_company[' . $accident_id . ']', 'accident_insurance_company', 'required');
		$this->form_validation->set_rules('accident_return_amount[' . $accident_id . ']', 'accident_return_amount', 'required');
		$this->form_validation->set_rules('accident_staff_id[' . $accident_id . ']', 'accident_staff_id', 'required');
		$this->form_validation->set_rules('accident_date[' . $accident_id . ']', 'accident_add_date', 'required');


		if ($this->form_validation->run() == false) {
			//validation errors
			$n = 1;
			$validation_errors = array(
				'accident_conclusion_number[' . $accident_id . ']' => form_error('accident_conclusion_number[' . $accident_id . ']'),
				'accident_insurance_company[' . $accident_id . ']' => form_error('accident_insurance_company[' . $accident_id . ']'),
				'accident_return_amount[' . $accident_id . ']' => form_error('accident_return_amount[' . $accident_id . ']'),
				'accident_staff_id[' . $accident_id . ']' => form_error('accident_staff_id[' . $accident_id . ']'),
				'accident_date[' . $accident_id . ']' => form_error('accident_add_date[' . $accident_id . ']')
			);
			$messages['error']['elements'][] = $validation_errors;
		}


		// end of validation
		$accident_conclusion_number = $this->input->post('accident_conclusion_number');
		$accident_insurance_company = $this->input->post('accident_insurance_company');
		$accident_replacement_parts = $this->input->post('accident_replacement_parts');
		$accident_return_amount = $this->input->post('accident_return_amount');
		$accident_staff_id = $this->input->post('accident_staff_id');
		$accident_add_date = $this->input->post('accident_date');
		$fl = $this->input->post('fl');
		$fl_id = $fl[$accident_id];


		if ($n == 1) {
			echo json_encode($messages);
			return false;
		}

		//file config
		$config_f['upload_path'] = set_realpath('uploads/' . $folder . '/accident/fleet_' . $fl_id);
		$config_f['allowed_types'] = 'pdf|jpg|png|doc|docx|csv|xlsx';
		$config_f['max_size'] = '4097152'; //4 MB
		$config_f['file_name'] = $this->uname(3, 8);

		$add_file = '';
		if (isset($_FILES['accident_file_' . $accident_id]['name']) AND $_FILES['accident_file_' . $accident_id]['name'] != '') {

			if (!file_exists(set_realpath('uploads/' . $folder . '/accident/fleet_' . $fl_id))) {
				mkdir(set_realpath('uploads/' . $folder . '/accident/fleet_' . $fl_id), 0755, true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/' . $folder . '/accident/fleet_' . $fl_id . '/index.html'));
			}


			$this->load->library('upload', $config_f);
			$this->upload->initialize($config_f);

			if (!$this->upload->do_upload('accident_file_' . $accident_id)) {
				$validation_errors = array('accident_file_' . $accident_id => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}


			$file_arr = $this->upload->data();

			$add_file = "`file` = " . $this->load->db_value($file_arr['file_name']) . ",";
		}


		$sql = "
			UPDATE `accident` SET
				`add_date` = " . $this->load->db_value($accident_add_date[$accident_id]) . ",
				`add_user_id` = " . $this->load->db_value($user_id) . ",
				`insurance_company` = " . $this->load->db_value($accident_insurance_company[$accident_id]) . ",
				`staff_id` = " . $this->load->db_value($accident_staff_id[$accident_id]) . ",
				`conclusion_number` = " . $this->load->db_value($accident_conclusion_number[$accident_id]) . ",
				`replacement_parts` = " . $this->load->db_value($accident_replacement_parts[$accident_id]) . ",
				" . $add_file . "
				`return_amount` = " . $this->load->db_value($accident_return_amount[$accident_id]) . "
			WHERE `id` = " . $this->load->db_value($accident_id) . "
		";


		$result = $this->db->query($sql);


		if ($result) {
			$messages['success'] = 1;
			$messages['message'] = $accident_id;
		} else {
			$messages['success'] = 0;
			$messages['error'] = lang('error');
		}

		// Return success or error message
		echo json_encode($messages);
		return true;
	}


	public function vehicle_insurance()
	{

		$user_id = $this->session->user_id;
		$lng = $this->load->lng();
		$data = array();
		$arr = $this->input->post('arr');

		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');

		$sql_add_user = "
			SELECT
				CONCAT_WS(
					' ',
					`first_name`,
					`last_name`
			  	) AS `name`
			FROM
			  `user`
			WHERE `id` = '" . $user_id . "'	  	
		";

		$query_add_user = $this->db->query($sql_add_user);

		$data['user'] = $query_add_user->row_array();

		$sql_insurance_type = "
			SELECT
				`id`,
				`title_" . $lng . "` AS `title`
			 FROM
			    `insurance_type`
			WHERE `status` = '1'    	
		";

		$query_insurance_type = $this->db->query($sql_insurance_type);

		$data['insurance_type'] = $query_insurance_type->result_array();


		$fleet_arr = array();

		if ($arr) {
			foreach ($arr as $value) {
				if (preg_match('/^(f)/', $value['key'])) {
					$fleet_arr['id'][] = preg_replace('/^(f)/', '', $value['key']);
					$fleet_arr['name'][] = $value['name'];
				}
			}
		}


		if ($fleet_arr) {

			$sql_add_staff = "
				SELECT
				   `staff`.`id`,
				   CONCAT_WS(
					  ' ',
					  `staff`.`first_name`,
					  `staff`.`last_name`
				   ) AS `name`
				FROM 
				 `fleet`  
				LEFT JOIN `staff` 
					ON FIND_IN_SET(
					  `staff`.`id`,
					  `fleet`.`staff_ids`
					) 
			   WHERE `fleet`.`id` = '" . $fleet_arr['id'][0] . "'
			    GROUP BY `staff`.`id`		
			";

			$query_add_staff = $this->db->query($sql_add_staff);

			$data['staff'] = $query_add_staff->result_array();


			$data['fleet'] = $fleet_arr;

			$sql = "
				SELECT 
				  `insurance`.`id`,
				  `insurance`.`add_date`,
				  `insurance`.`add_user_id`,
				  `insurance`.`insurance_company`, 
				  `insurance`.`insurance_type_id`,
				  `insurance`.`end_date`,
				  `insurance`.`price`,
				  `insurance`.`file`,
				  `insurance`.`fleet_id`, /**/
				  CONCAT_WS(' ', `brand`.`title_" . $lng . "`, `model`.`title_" . $lng . "`) AS `brand_model`,
				  CONCAT_WS(' ', `user`.`first_name`, `user`.`last_name`) AS `user_name`,
				  `insurance_type`.`title_" . $lng . "` AS `insurance_type`,
				  `insurance`.`status` 
				FROM
				  `insurance` 
				LEFT JOIN `fleet` 
					ON `fleet`.`id` = `insurance`.`fleet_id`
				LEFT JOIN `insurance_type` 
					ON `insurance_type`.`id` = `insurance`.`insurance_type_id`	
				LEFT JOIN `user` 
					ON `user`.`id` = `insurance`.`add_user_id`
				LEFT JOIN `model` 
					ON `model`.`id` = `fleet`.`model_id` 
				LEFT JOIN `brand` 
					ON `brand`.`id` = `model`.`brand_id` 	
				WHERE `insurance`.`status` = '1' 
				AND FIND_IN_SET(`insurance`.`fleet_id`, '" . implode(',', $fleet_arr['id']) . "')
				AND (`insurance`.`add_date` >= '" . $date_from . "' AND `insurance`.`add_date` <= '" . $date_to . "')
				ORDER BY `brand_model`
			";

			$query = $this->db->query($sql);

			$data['fleet_data'] = $query->result_array();

			$this->load->view('structure/vehicle_insurance', $data);
		}

	}


	public function insurance_ax()
	{

		//$this->load->authorisation('Structure', 'insurance');

		$this->load->library('session');
		$this->load->library('upload');
		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');
		$n = 0;
		$user_id = $this->session->user_id;
		$folder = $this->session->folder;
		$result = false;

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}


		$fleet_id = $this->input->post('fleet_id');

		// validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');


		if ($fleet_id != '') {


			$price = $this->input->post('price');
			$insurance_company = $this->input->post('insurance_company');
			$insurance_type_id = $this->input->post('insurance_type_id');
			$end_date = $this->input->post('end_date');
			$date = $this->input->post('date');

			if (is_array($insurance_company)) :
				foreach ($insurance_company as $i => $insurance_company_val) :
					if ($insurance_company_val == '') :
						$n = 1;
						$validation_errors = array('insurance_company[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($price[$i] == '') :
						$n = 1;
						$validation_errors = array('price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($date[$i] == '') :
						$n = 1;
						$validation_errors = array('date[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($insurance_type_id[$i] == '') :
						$n = 1;
						$validation_errors = array('insurance_type_id[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;


					if ($end_date[$i] == '') :
						$n = 1;
						$validation_errors = array('end_date[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

				endforeach;
			endif;
			// end of validation


			if ($n == 1) {
				echo json_encode($messages);
				return false;
			}


			$cpt = count($_FILES);
			$file = array();
			$config_f = array();
			for ($i = 1; $i <= $cpt; $i++) {

				//file config
				$config_f['upload_path'] = set_realpath('uploads/' . $folder . '/insurance/fleet_' . $fleet_id);
				$config_f['allowed_types'] = 'pdf|jpg|png|doc|docx|csv|xlsx';
				$config_f['max_size'] = '4097152'; //4 MB
				$config_f['file_name'] = $this->uname(3, 8);
				if (isset($_FILES['insurance_file_' . $i]['name']) AND $_FILES['insurance_file_' . $i]['name'] != '') {

					if (!file_exists(set_realpath('uploads/' . $folder . '/insurance/fleet_' . $fleet_id))) {
						mkdir(set_realpath('uploads/' . $folder . '/insurance/fleet_' . $fleet_id), 0755, true);
						copy(set_realpath('uploads/index.html'), set_realpath('uploads/' . $folder . '/insurance/fleet_' . $fleet_id . '/index.html'));
					}


					$this->load->library('upload', $config_f);
					$this->upload->initialize($config_f);

					if (!$this->upload->do_upload('insurance_file_' . $i)) {
						$validation_errors = array('insurance_file_' . $i => $this->upload->display_errors());
						$messages['error']['elements'][] = $validation_errors;
						echo json_encode($messages);
						return false;
					}


					$file_arr = $this->upload->data();

					$file[$i] = $file_arr['file_name'];
				}

			}


			$status = 1;


			$sql = "
				INSERT INTO `insurance` (
				  `add_date`,
				  `add_user_id`,
				  `insurance_company`,
				  `insurance_type_id`,
				  `end_date`,
				  `price`,
				  `fleet_id`,
				  `file`,
				  `status`
				)
				VALUES
			";


			foreach ($date as $key => $add_dte) {
				$sql .= "(
					" . $this->load->db_value($add_dte) . ",
					" . $this->load->db_value($user_id) . ",
					" . $this->load->db_value($insurance_company[$key]) . ",
					" . $this->load->db_value($insurance_type_id[$key]) . ",
					" . $this->load->db_value($end_date[$key]) . ",
					" . $this->load->db_value($price[$key]) . ",
					" . $this->load->db_value($fleet_id) . ",
					" . $this->load->db_value((isset($file[$key]) ? $file[$key] : '')) . ",
					" . $this->load->db_value($status) . "
				),";
			}

			$sql = substr($sql, 0, -1);

			$result = $this->db->query($sql);

		} else {

			$fl_ids = $this->input->post('fl_id');
			$price = $this->input->post('price');
			$insurance_company = $this->input->post('insurance_company');
			$insurance_type_id = $this->input->post('insurance_type_id');
			$end_date = $this->input->post('end_date');
			$date = $this->input->post('date');
			$status = '1';

			if (is_array($insurance_company)) :
				foreach ($insurance_company as $i => $insurance_company_val) :
					if ($insurance_company_val == '') :
						$n = 1;
						$validation_errors = array('insurance_company[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($price[$i] == '') :
						$n = 1;
						$validation_errors = array('price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($date[$i] == '') :
						$n = 1;
						$validation_errors = array('date[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($insurance_type_id[$i] == '') :
						$n = 1;
						$validation_errors = array('insurance_type_id[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;


					if ($end_date[$i] == '') :
						$n = 1;
						$validation_errors = array('end_date[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

				endforeach;
			endif;
			// end of validation


			$cpt = count($_FILES);
			$file = array();
			$config_f = array();
			foreach ($fl_ids as $key => $fl_id) {

				$i = $key + 1;

				//file config
				$config_f['upload_path'] = set_realpath('uploads/' . $folder . '/insurance/fleet_' . $fl_id);
				$config_f['allowed_types'] = 'pdf|jpg|png|doc|docx|csv|xlsx';
				$config_f['max_size'] = '4097152'; //4 MB
				$config_f['file_name'] = $this->uname(3, 8);
				if (isset($_FILES['insurance_file_' . $key]['name']) AND $_FILES['insurance_file_' . $key]['name'] != '') {

					if (!file_exists(set_realpath('uploads/' . $folder . '/insurance/fleet_' . $fl_id))) {
						mkdir(set_realpath('uploads/' . $folder . '/insurance/fleet_' . $fl_id), 0755, true);
						copy(set_realpath('uploads/index.html'), set_realpath('uploads/' . $folder . '/insurance/fleet_' . $fl_id . '/index.html'));
					}


					$this->load->library('upload', $config_f);
					$this->upload->initialize($config_f);

					if (!$this->upload->do_upload('insurance_file_' . $key)) {
						$validation_errors = array('insurance_file_' . $key => $this->upload->display_errors());
						$messages['error']['elements'][] = $validation_errors;
						echo json_encode($messages);
						return false;
					}


					$file_arr = $this->upload->data();

					$file[$key] = $file_arr['file_name'];
				}

			}


			if ($n == 1) {
				echo json_encode($messages);
				return false;
			}


			$sql = "
				INSERT INTO `insurance` (
				  `add_date`,
				  `add_user_id`,
				  `insurance_company`,
				  `insurance_type_id`,
				  `end_date`,
				  `price`,
				  `fleet_id`,
				  `file`,
				  `status`
				) 
				VALUES
			";


			foreach ($fl_ids as $key => $fl_id) {

				$sql .= "(
					" . $this->load->db_value($date[$key]) . ",
					" . $this->load->db_value($user_id) . ",
					" . $this->load->db_value($insurance_company[$key]) . ",
					" . $this->load->db_value($insurance_type_id[$key]) . ",
					" . $this->load->db_value($end_date[$key]) . ",
					" . $this->load->db_value($price[$key]) . ",
					" . $this->load->db_value($fl_id) . ",
					" . $this->load->db_value((isset($file[$key]) ? $file[$key] : '')) . ",
					" . $this->load->db_value($status) . "
				),";
			}

			$sql = substr($sql, 0, -1);

			$result = $this->db->query($sql);


		}
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


	public function edit_insurance_ax()
	{

		//$this->load->authorisation('Structure', 'insurance');

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


		// validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');

		$insurance_id = $this->input->post('insurance_id');
		$folder = $this->session->folder;


		$this->form_validation->set_rules('insurance_price[' . $insurance_id . ']', 'insurance_price', 'required');
		$this->form_validation->set_rules('insurance_insurance_company[' . $insurance_id . ']', 'insurance_insurance_company', 'required');
		$this->form_validation->set_rules('insurance_type_id[' . $insurance_id . ']', 'insurance_type_id', 'required');
		$this->form_validation->set_rules('insurance_end_date[' . $insurance_id . ']', 'insurance_end_date', 'required');
		$this->form_validation->set_rules('insurance_date[' . $insurance_id . ']', 'insurance_date', 'required');


		if ($this->form_validation->run() == false) {
			//validation errors
			$n = 1;

			$validation_errors = array(
				'insurance_price[' . $insurance_id . ']' => form_error('insurance_price[' . $insurance_id . ']'),
				'insurance_insurance_company[' . $insurance_id . ']' => form_error('insurance_insurance_company[' . $insurance_id . ']'),
				'insurance_type_id[' . $insurance_id . ']' => form_error('insurance_type_id[' . $insurance_id . ']'),
				'insurance_end_date[' . $insurance_id . ']' => form_error('insurance_end_date[' . $insurance_id . ']'),
				'insurance_date[' . $insurance_id . ']' => form_error('insurance_date[' . $insurance_id . ']')
			);
			$messages['error']['elements'][] = $validation_errors;
		}

		// end of validation


		$price = $this->input->post('insurance_price');
		$insurance_company = $this->input->post('insurance_insurance_company');
		$insurance_type_id = $this->input->post('insurance_type_id');
		$end_date = $this->input->post('insurance_end_date');
		$date = $this->input->post('insurance_date');
		$fl = $this->input->post('fl');
		$fl_id = $fl[$insurance_id];


		if ($n == 1) {
			echo json_encode($messages);
			return false;
		}


		//file config
		$config_f['upload_path'] = set_realpath('uploads/' . $folder . '/insurance/fleet_' . $fl_id);
		$config_f['allowed_types'] = 'pdf|jpg|png|doc|docx|csv|xlsx';
		$config_f['max_size'] = '4097152'; //4 MB
		$config_f['file_name'] = $this->uname(3, 8);

		//$this->pre($_FILES);

		$add_file = '';
		if (isset($_FILES['insurance_file_' . $insurance_id]['name']) AND $_FILES['insurance_file_' . $insurance_id]['name'] != '') {

			if (!file_exists(set_realpath('uploads/' . $folder . '/insurance/fleet_' . $fl_id))) {
				mkdir(set_realpath('uploads/' . $folder . '/insurance/fleet_' . $fl_id), 0755, true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/' . $folder . '/insurance/fleet_' . $fl_id . '/index.html'));
			}


			$this->load->library('upload', $config_f);
			$this->upload->initialize($config_f);

			if (!$this->upload->do_upload('insurance_file_' . $insurance_id)) {
				$validation_errors = array('insurance_file_' . $insurance_id => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}


			$file_arr = $this->upload->data();

			$add_file = "`file` = " . $this->load->db_value($file_arr['file_name']) . ",";
		}


		$sql = "
			UPDATE `insurance` SET
				`add_date` = " . $this->load->db_value($date[$insurance_id]) . ",
				`add_user_id` = " . $this->load->db_value($user_id) . ",
				`insurance_company` = " . $this->load->db_value($insurance_company[$insurance_id]) . ",
				`insurance_type_id` = " . $this->load->db_value($insurance_type_id[$insurance_id]) . ",
				`end_date` = " . $this->load->db_value($end_date[$insurance_id]) . ",
				" . $add_file . "
				`price` = " . $this->load->db_value($price[$insurance_id]) . "
			WHERE `id` = " . $this->load->db_value($insurance_id) . "
		";


		$result = $this->db->query($sql);


		if ($result) {
			$messages['success'] = 1;
			$messages['message'] = $insurance_id;
		} else {
			$messages['success'] = 0;
			$messages['error'] = lang('error');
		}

		// Return success or error message
		echo json_encode($messages);
		return true;
	}


	public function vehicle_spares()
	{

		$user_id = $this->session->user_id;
		$lng = $this->load->lng();
		$data = array();
		$arr = $this->input->post('arr');

		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');

		$sql_add_user = "
			SELECT
				CONCAT_WS(
					' ',
					`first_name`,
					`last_name`
			  	) AS `name`
			FROM
			  `user`
			WHERE `id` = '" . $user_id . "'	  	
		";

		$query_add_user = $this->db->query($sql_add_user);

		$data['user'] = $query_add_user->row_array();

		$sql_insurance_type = "
			SELECT
				`id`,
				`title_" . $lng . "` AS `title`
			 FROM
			    `insurance_type`
			WHERE `status` = '1'    	
		";

		$query_insurance_type = $this->db->query($sql_insurance_type);

		$data['insurance_type'] = $query_insurance_type->result_array();


		$fleet_arr = array();

		if ($arr) {
			foreach ($arr as $value) {
				if (preg_match('/^(f)/', $value['key'])) {
					$fleet_arr['id'][] = preg_replace('/^(f)/', '', $value['key']);
					$fleet_arr['name'][] = $value['name'];
				}
			}
		}


		if ($fleet_arr) {


			$sql_add_staff = "
				SELECT
				   `staff`.`id`,
				   CONCAT_WS(
					  ' ',
					  `staff`.`first_name`,
					  `staff`.`last_name`
				   ) AS `name`
				FROM 
				 `fleet`  
				LEFT JOIN `staff` 
					ON FIND_IN_SET(
					  `staff`.`id`,
					  `fleet`.`staff_ids`
					) 
			   WHERE `fleet`.`id` = '" . $fleet_arr['id'][0] . "'
			    GROUP BY `staff`.`id`		
			";

			$query_add_staff = $this->db->query($sql_add_staff);

			$data['staff'] = $query_add_staff->result_array();


			$data['fleet'] = $fleet_arr;

			$sql = "
				SELECT 
				  `spares`.`id`,
				  `spares`.`add_date`,
				  `spares`.`add_user_id`,
				  `spares`.`whence`,
				  `spares`.`type`,
				  `spares`.`producer`,
				  `spares`.`model`,
				  `spares`.`depreciation`,
				  `spares`.`count`,
				  `spares`.`one_price`,
				  `spares`.`price`,
				  `spares`.`fleet_id`,
				  CONCAT_WS(' ', `brand`.`title_" . $lng . "`, `model`.`title_" . $lng . "`) AS `brand_model`,
				  CONCAT_WS(' ', `user`.`first_name`, `user`.`last_name`) AS `user_name`,
				  `spares`.`status` 
				FROM
				  `spares` 
				LEFT JOIN `fleet` 
					ON `fleet`.`id` = `spares`.`fleet_id`
				LEFT JOIN `user` 
					ON `user`.`id` = `spares`.`add_user_id`
				LEFT JOIN `model` 
					ON `model`.`id` = `fleet`.`model_id` 
				LEFT JOIN `brand` 
					ON `brand`.`id` = `model`.`brand_id` 	
				WHERE `spares`.`status` = '1' 
				 AND FIND_IN_SET(`spares`.`fleet_id`, '" . implode(',', $fleet_arr['id']) . "')
				 AND (`spares`.`add_date` >= '" . $date_from . "' AND `spares`.`add_date` <= '" . $date_to . "')
				 ORDER BY `brand_model`
			";

			$query = $this->db->query($sql);

			$data['fleet_data'] = $query->result_array();

			$this->load->view('structure/vehicle_spares', $data);
		}
	}


	public function spares_ax()
	{

		//$this->load->authorisation('Structure', 'spares');

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


		$fleet_id = $this->input->post('fleet_id');

		// validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');


		if ($fleet_id != '') {

			$price = $this->input->post('price');
			$whence = $this->input->post('whence');
			$type = $this->input->post('type');
			$producer = $this->input->post('producer');
			$model = $this->input->post('model');
			$depreciation = $this->input->post('depreciation');
			$count = $this->input->post('count');
			$one_price = $this->input->post('one_price');
			$date = $this->input->post('date');

			if (is_array($price)) :
				foreach ($price as $i => $price_val) :
					if ($price_val == '') :
						$n = 1;
						$validation_errors = array('price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($type[$i] == '') :
						$n = 1;
						$validation_errors = array('type[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($depreciation[$i] == '') :
						$n = 1;
						$validation_errors = array('depreciation[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($count[$i] == '') :
						$n = 1;
						$validation_errors = array('count[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($one_price[$i] == '') :
						$n = 1;
						$validation_errors = array('one_price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

				endforeach;
			endif;
			// end of validation


			if ($n == 1) {
				echo json_encode($messages);
				return false;
			}


			$status = 1;


			$sql = "
				INSERT INTO `spares` (
				  `add_date`,
				  `add_user_id`,
				  `whence`,
				  `type`,
				  `producer`,
				  `model`,
				  `depreciation`,
				  `count`,
				  `one_price`,
				  `price`,
				  `fleet_id`,
				  `status`
				) 
				VALUES
			";


			foreach ($date as $key => $add_dte) {
				$sql .= "(
					" . $this->load->db_value($add_dte) . ",
					" . $this->load->db_value($user_id) . ",
					" . $this->load->db_value($whence[$key]) . ",
					" . $this->load->db_value($type[$key]) . ",
					" . $this->load->db_value($producer[$key]) . ",
					" . $this->load->db_value($model[$key]) . ",
					" . $this->load->db_value($depreciation[$key]) . ",
					" . $this->load->db_value($count[$key]) . ",
					" . $this->load->db_value($one_price[$key]) . ",
					" . $this->load->db_value($price[$key]) . ",
					" . $this->load->db_value($fleet_id) . ",
					" . $this->load->db_value($status) . "
				),";
			}

			$sql = substr($sql, 0, -1);

			$result = $this->db->query($sql);

		} else {

			$fl_ids = $this->input->post('fl_id');
			$price = $this->input->post('price');
			$whence = $this->input->post('whence');
			$type = $this->input->post('type');
			$producer = $this->input->post('producer');
			$model = $this->input->post('model');
			$depreciation = $this->input->post('depreciation');
			$count = $this->input->post('count');
			$one_price = $this->input->post('one_price');
			$date = $this->input->post('date');
			$status = 1;

			if (is_array($price)) :
				foreach ($price as $i => $price_val) :
					if ($price_val == '') :
						$n = 1;
						$validation_errors = array('price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;
					if ($type[$i] == '') :
						$n = 1;
						$validation_errors = array('type[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($depreciation[$i] == '') :
						$n = 1;
						$validation_errors = array('depreciation[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($count[$i] == '') :
						$n = 1;
						$validation_errors = array('count[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($one_price[$i] == '') :
						$n = 1;
						$validation_errors = array('one_price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

				endforeach;
			endif;
			// end of validation


			if ($n == 1) {
				echo json_encode($messages);
				return false;
			}


			$sql = "
				INSERT INTO `spares` (
				  `add_date`,
				  `add_user_id`,
				  `whence`,
				  `type`,
				  `producer`,
				  `model`,
				  `depreciation`,
				  `count`,
				  `one_price`,
				  `price`,
				  `fleet_id`,
				  `status`
				) 
				VALUES
			";


			foreach ($fl_ids as $key => $fl_id) {

				$sql .= "(
					" . $this->load->db_value($date[$key]) . ",
					" . $this->load->db_value($user_id) . ",
					" . $this->load->db_value($whence[$key]) . ",
					" . $this->load->db_value($type[$key]) . ",
					" . $this->load->db_value($producer[$key]) . ",
					" . $this->load->db_value($model[$key]) . ",
					" . $this->load->db_value($depreciation[$key]) . ",
					" . $this->load->db_value($count[$key]) . ",
					" . $this->load->db_value($one_price[$key]) . ",
					" . $this->load->db_value($price[$key]) . ",
					" . $this->load->db_value($fl_id) . ",
					" . $this->load->db_value($status) . "
				),";
			}

			$sql = substr($sql, 0, -1);

			$result = $this->db->query($sql);


		}
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


	public function edit_spares_ax()
	{

		//$this->load->authorisation('Structure', 'spares');

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


		// validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');

		$spares_id = $this->input->post('spares_id');

		$this->form_validation->set_rules('spares_price', 'spares_price', 'required');
		$this->form_validation->set_rules('spares_type', 'spares_type', 'required');
		$this->form_validation->set_rules('spares_depreciation', 'spares_depreciation', 'required');
		$this->form_validation->set_rules('spares_count', 'spares_count', 'required');
		$this->form_validation->set_rules('spares_one_price', 'spares_one_price', 'required');
		$this->form_validation->set_rules('spares_date', 'spares_date', 'required');


		if ($this->form_validation->run() == false) {
			//validation errors
			$n = 1;

			$validation_errors = array(
				'spares_price[' . $spares_id . ']' => form_error('spares_price'),
				'spares_type[' . $spares_id . ']' => form_error('spares_type'),
				'spares_depreciation[' . $spares_id . ']' => form_error('spares_depreciation'),
				'spares_count[' . $spares_id . ']' => form_error('spares_count'),
				'spares_one_price[' . $spares_id . ']' => form_error('spares_one_price'),
				'spares_date[' . $spares_id . ']' => form_error('spares_date')
			);
			$messages['error']['elements'][] = $validation_errors;
		}


		// end of validation

		$spares_price = $this->input->post('spares_price');
		$spares_whence = $this->input->post('spares_whence');
		$spares_type = $this->input->post('spares_type');
		$spares_producer = $this->input->post('spares_producer');
		$spares_model = $this->input->post('spares_model');
		$spares_depreciation = $this->input->post('spares_depreciation');
		$spares_count = $this->input->post('spares_count');
		$spares_one_price = $this->input->post('spares_one_price');
		$spares_date = $this->input->post('spares_date');


		if ($n == 1) {
			echo json_encode($messages);
			return false;
		}


		$sql = "
			UPDATE `spares` SET
				`add_date` = " . $this->load->db_value($spares_date) . ",
				`add_user_id` = " . $this->load->db_value($user_id) . ",
				`whence` = " . $this->load->db_value($spares_whence) . ",
				`type` = " . $this->load->db_value($spares_type) . ",
				`producer` = " . $this->load->db_value($spares_producer) . ",
				`model` = " . $this->load->db_value($spares_model) . ",
			    `depreciation` =	" . $this->load->db_value($spares_depreciation) . ",
				`count` = " . $this->load->db_value($spares_count) . ",
				`one_price` = " . $this->load->db_value($spares_one_price) . ",
				`price` = " . $this->load->db_value($spares_price) . "
			WHERE `id` = " . $this->load->db_value($spares_id) . "
		";

		$result = $this->db->query($sql);


		if ($result) {
			$messages['success'] = 1;
			$messages['message'] = $spares_id;
		} else {
			$messages['success'] = 0;
			$messages['error'] = lang('error');
		}

		// Return success or error message
		echo json_encode($messages);
		return true;
	}


	public function vehicle_repair()
	{

		$user_id = $this->session->user_id;
		$lng = $this->load->lng();
		$data = array();
		$arr = $this->input->post('arr');

		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');

		$sql_add_user = "
			SELECT
				CONCAT_WS(
					' ',
					`first_name`,
					`last_name`
			  	) AS `name`
			FROM
			  `user`
			WHERE `id` = '" . $user_id . "'	  	
		";

		$query_add_user = $this->db->query($sql_add_user);

		$data['user'] = $query_add_user->row_array();

		$sql_insurance_type = "
			SELECT
				`id`,
				`title_" . $lng . "` AS `title`
			 FROM
			    `insurance_type`
			WHERE `status` = '1'    	
		";

		$query_insurance_type = $this->db->query($sql_insurance_type);

		$data['insurance_type'] = $query_insurance_type->result_array();


		$fleet_arr = array();

		if ($arr) {
			foreach ($arr as $value) {
				if (preg_match('/^(f)/', $value['key'])) {
					$fleet_arr['id'][] = preg_replace('/^(f)/', '', $value['key']);
					$fleet_arr['name'][] = $value['name'];
				}
			}
		}


		if ($fleet_arr) {


			$sql_add_staff = "
				SELECT
				   `staff`.`id`,
				   CONCAT_WS(
					  ' ',
					  `staff`.`first_name`,
					  `staff`.`last_name`
				   ) AS `name`
				FROM 
				 `fleet`  
				LEFT JOIN `staff` 
					ON FIND_IN_SET(
					  `staff`.`id`,
					  `fleet`.`staff_ids`
					) 
			   WHERE `fleet`.`id` = '" . $fleet_arr['id'][0] . "'
			    GROUP BY `staff`.`id`		
			";

			$query_add_staff = $this->db->query($sql_add_staff);

			$data['staff'] = $query_add_staff->result_array();


			$data['fleet'] = $fleet_arr;

			$sql = "
				SELECT 
				  `repair`.`id`,
				  `repair`.`add_date`,
				  `repair`.`add_user_id`,
				  `repair`.`repairer`, 
				  `repair`.`necessary_parts`,
				  `repair`.`price`,
				  `repair`.`fleet_id`, /**/
				  CONCAT_WS(' ', `brand`.`title_" . $lng . "`, `model`.`title_" . $lng . "`) AS `brand_model`,
				  CONCAT_WS(' ', `user`.`first_name`, `user`.`last_name`) AS `user_name`,
				  `repair`.`status` 
				FROM
				  `repair` 
				LEFT JOIN `fleet` 
					ON `fleet`.`id` = `repair`.`fleet_id`
				LEFT JOIN `user` 
					ON `user`.`id` = `repair`.`add_user_id`
				LEFT JOIN `model` 
					ON `model`.`id` = `fleet`.`model_id` 
				LEFT JOIN `brand` 
					ON `brand`.`id` = `model`.`brand_id` 	
				WHERE `repair`.`status` = '1' 
				AND FIND_IN_SET(`repair`.`fleet_id`, '" . implode(',', $fleet_arr['id']) . "')
				AND (`repair`.`add_date` >= '" . $date_from . "' AND `repair`.`add_date` <= '" . $date_to . "')
				ORDER BY `brand_model`
			";

			$query = $this->db->query($sql);

			$data['fleet_data'] = $query->result_array();

			$this->load->view('structure/vehicle_repair', $data);
		}
	}


	public function repair_ax()
	{

		//$this->load->authorisation('Structure', 'spares');

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


		$fleet_id = $this->input->post('fleet_id');

		// validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');


		if ($fleet_id != '') {


			$price = $this->input->post('price');
			$repairer = $this->input->post('repairer');
			$necessary_parts = $this->input->post('necessary_parts');
			$date = $this->input->post('date');

			if (is_array($price)) :
				foreach ($price as $i => $price_val) :

					if ($price_val == '') :
						$n = 1;
						$validation_errors = array('price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($necessary_parts[$i] == '') :
						$n = 1;
						$validation_errors = array('necessary_parts[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($date[$i] == '') :
						$n = 1;
						$validation_errors = array('producer[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;


				endforeach;
			endif;
			// end of validation


			if ($n == 1) {
				echo json_encode($messages);
				return false;
			}


			$status = 1;


			$sql = "
				INSERT INTO `repair` (
				  `add_date`,
				  `add_user_id`,
				  `repairer`,
				  `necessary_parts`,
				  `price`,
				  `fleet_id`,
				  `status`
				) 
				VALUES
			";


			foreach ($date as $key => $add_dte) {
				$sql .= "(
					" . $this->load->db_value($add_dte) . ",
					" . $this->load->db_value($user_id) . ",
					" . $this->load->db_value($repairer[$key]) . ",
					" . $this->load->db_value($necessary_parts[$key]) . ",
					" . $this->load->db_value($price[$key]) . ",
					" . $this->load->db_value($fleet_id) . ",
					" . $this->load->db_value($status) . "
				),";
			}

			$sql = substr($sql, 0, -1);

			$result = $this->db->query($sql);

		} else {

			$fl_ids = $this->input->post('fl_id');
			$price = $this->input->post('price');
			$repairer = $this->input->post('repairer');
			$necessary_parts = $this->input->post('necessary_parts');
			$date = $this->input->post('date');
			$status = '1';

			if (is_array($price)) :
				foreach ($price as $i => $price_val) :

					if ($price_val == '') :
						$n = 1;
						$validation_errors = array('price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($necessary_parts[$i] == '') :
						$n = 1;
						$validation_errors = array('necessary_parts[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($date[$i] == '') :
						$n = 1;
						$validation_errors = array('producer[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;


				endforeach;
			endif;
			// end of validation


			if ($n == 1) {
				echo json_encode($messages);
				return false;
			}


			$sql = "
				INSERT INTO `repair` (
				  `add_date`,
				  `add_user_id`,
				  `repairer`,
				  `necessary_parts`,
				  `price`,
				  `fleet_id`,
				  `status`
				) 
				VALUES
			";


			foreach ($fl_ids as $key => $fl_id) {

				$sql .= "(
					" . $this->load->db_value($date[$key]) . ",
					" . $this->load->db_value($user_id) . ",
					" . $this->load->db_value($repairer[$key]) . ",
					" . $this->load->db_value($necessary_parts[$key]) . ",
					" . $this->load->db_value($price[$key]) . ",
					" . $this->load->db_value($fl_id) . ",
					" . $this->load->db_value($status) . "
				),";
			}

			$sql = substr($sql, 0, -1);

			$result = $this->db->query($sql);


		}
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


	public function edit_repair_ax()
	{

		//$this->load->authorisation('Structure', 'spares');

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


		// validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');

		$repair_id = $this->input->post('repair_id');

		$this->form_validation->set_rules('repair_price', 'repair_price', 'required');
		$this->form_validation->set_rules('repair_necessary_parts', 'repair_necessary_parts', 'required');
		$this->form_validation->set_rules('repair_date', 'repair_date', 'required');


		if ($this->form_validation->run() == false) {
			//validation errors
			$n = 1;

			$validation_errors = array(
				'repair_price[' . $repair_id . ']' => form_error('repair_price'),
				'repair_necessary_parts[' . $repair_id . ']' => form_error('repair_necessary_parts'),
				'repair_date[' . $repair_id . ']' => form_error('repair_date')
			);
			$messages['error']['elements'][] = $validation_errors;
		}


		// end of validation


		$repair_price = $this->input->post('repair_price');
		$repair_repairer = $this->input->post('repair_repairer');
		$repair_necessary_parts = $this->input->post('repair_necessary_parts');
		$repair_date = $this->input->post('repair_date');


		if ($n == 1) {
			echo json_encode($messages);
			return false;
		}


		$sql = "
			UPDATE `repair` SET 
				`add_date` = " . $this->load->db_value($repair_date) . ",
				`add_user_id` = " . $this->load->db_value($user_id) . ",
				`repairer` = " . $this->load->db_value($repair_repairer) . ",
				`necessary_parts` = " . $this->load->db_value($repair_necessary_parts) . ",
				`price` = " . $this->load->db_value($repair_price) . "
			WHERE `id` = " . $this->load->db_value($repair_id) . "
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


	public function vehicle_wheel()
	{

		$user_id = $this->session->user_id;
		$lng = $this->load->lng();
		$data = array();
		$arr = $this->input->post('arr');

		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');

		$sql_add_user = "
			SELECT
				CONCAT_WS(
					' ',
					`first_name`,
					`last_name`
			  	) AS `name`
			FROM
			  `user`
			WHERE `id` = '" . $user_id . "'	  	
		";

		$query_add_user = $this->db->query($sql_add_user);

		$data['user'] = $query_add_user->row_array();


		$fleet_arr = array();

		if ($arr) {
			foreach ($arr as $value) {
				if (preg_match('/^(f)/', $value['key'])) {
					$fleet_arr['id'][] = preg_replace('/^(f)/', '', $value['key']);
					$fleet_arr['name'][] = $value['name'];
				}
			}
		}


		if ($fleet_arr) {

			$data['fleet'] = $fleet_arr;

			$sql = "
				SELECT 
				  `wheel`.`id`,
				  `wheel`.`add_date`,
				  `wheel`.`add_user_id`,
				  `wheel`.`whence`,
				  `wheel`.`wheel_type`,
				  `wheel`.`producer`,
				  `wheel`.`model`,
				  `wheel`.`depreciation`,
				  `wheel`.`count`,
				  `wheel`.`one_price`,
				  `wheel`.`other_info`,
				  `wheel`.`price`,
				  `wheel`.`fleet_id`,
				  CONCAT_WS(' ', `brand`.`title_" . $lng . "`, `model`.`title_" . $lng . "`) AS `brand_model`,
				  CONCAT_WS(' ', `user`.`first_name`, `user`.`last_name`) AS `user_name`,
				  `wheel`.`status` 
				FROM
				  `wheel` 
				LEFT JOIN `fleet` 
					ON `fleet`.`id` = `wheel`.`fleet_id`
				LEFT JOIN `user` 
					ON `user`.`id` = `wheel`.`add_user_id`
				LEFT JOIN `model` 
					ON `model`.`id` = `fleet`.`model_id` 
				LEFT JOIN `brand` 
					ON `brand`.`id` = `model`.`brand_id` 	
				WHERE `wheel`.`status` = '1' 
				 AND FIND_IN_SET(`wheel`.`fleet_id`, '" . implode(',', $fleet_arr['id']) . "')
				 AND (`wheel`.`add_date` >= '" . $date_from . "' AND `wheel`.`add_date` <= '" . $date_to . "')
				 ORDER BY `brand_model`
			";

			$query = $this->db->query($sql);

			$data['fleet_data'] = $query->result_array();

			$this->load->view('structure/vehicle_wheel', $data);
		}
	}

	public function wheel_ax()
	{

		//$this->load->authorisation('Structure', 'spares');

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


		$fleet_id = $this->input->post('fleet_id');

		// validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');


		if ($fleet_id != '') {

			$price = $this->input->post('price');
			$whence = $this->input->post('whence');
			$wheel_type = $this->input->post('wheel_type');
			$producer = $this->input->post('producer');
			$model = $this->input->post('model');
			$depreciation = $this->input->post('depreciation');
			$count = $this->input->post('count');
			$one_price = $this->input->post('one_price');
			$date = $this->input->post('date');
			$other_info = $this->input->post('other_info');

			if (is_array($price)) :
				foreach ($price as $i => $price_val) :
					if ($price_val == '') :
						$n = 1;
						$validation_errors = array('price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($whence[$i] == '') :
						$n = 1;
						$validation_errors = array('whence[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($wheel_type[$i] == '') :
						$n = 1;
						$validation_errors = array('wheel_type[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($producer[$i] == '') :
						$n = 1;
						$validation_errors = array('producer[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($model[$i] == '') :
						$n = 1;
						$validation_errors = array('model[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($depreciation[$i] == '') :
						$n = 1;
						$validation_errors = array('depreciation[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($count[$i] == '') :
						$n = 1;
						$validation_errors = array('count[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($one_price[$i] == '') :
						$n = 1;
						$validation_errors = array('one_price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

				endforeach;
			endif;
			// end of validation


			if ($n == 1) {
				echo json_encode($messages);
				return false;
			}


			$status = 1;


			$sql = "
				INSERT INTO `wheel` (
				  `add_date`,
				  `add_user_id`,
				  `whence`,
				  `wheel_type`,
				  `producer`,
				  `model`,
				  `depreciation`,
				  `count`,
				  `one_price`,
				  `price`,
				  `other_info`,
				  `fleet_id`,
				  `status`
				) 
				VALUES
			";


			foreach ($date as $key => $add_dte) {
				$sql .= "(
					" . $this->load->db_value($add_dte) . ",
					" . $this->load->db_value($user_id) . ",
					" . $this->load->db_value($whence[$key]) . ",
					" . $this->load->db_value($wheel_type[$key]) . ",
					" . $this->load->db_value($producer[$key]) . ",
					" . $this->load->db_value($model[$key]) . ",
					" . $this->load->db_value($depreciation[$key]) . ",
					" . $this->load->db_value($count[$key]) . ",
					" . $this->load->db_value($one_price[$key]) . ",
					" . $this->load->db_value($price[$key]) . ",
					" . $this->load->db_value($other_info[$key]) . ",
					" . $this->load->db_value($fleet_id) . ",
					" . $this->load->db_value($status) . "
				),";
			}

			$sql = substr($sql, 0, -1);

			$result = $this->db->query($sql);

		} else {

			$fl_ids = $this->input->post('fl_id');
			$price = $this->input->post('price');
			$whence = $this->input->post('whence');
			$wheel_type = $this->input->post('wheel_type');
			$producer = $this->input->post('producer');
			$model = $this->input->post('model');
			$depreciation = $this->input->post('depreciation');
			$count = $this->input->post('count');
			$one_price = $this->input->post('one_price');
			$date = $this->input->post('date');
			$other_info = $this->input->post('other_info');
			$status = 1;

			if (is_array($price)) :
				foreach ($price as $i => $price_val) :
					if ($price_val == '') :
						$n = 1;
						$validation_errors = array('price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($whence[$i] == '') :
						$n = 1;
						$validation_errors = array('whence[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($wheel_type[$i] == '') :
						$n = 1;
						$validation_errors = array('wheel_type[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($producer[$i] == '') :
						$n = 1;
						$validation_errors = array('producer[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($model[$i] == '') :
						$n = 1;
						$validation_errors = array('model[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($depreciation[$i] == '') :
						$n = 1;
						$validation_errors = array('depreciation[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($count[$i] == '') :
						$n = 1;
						$validation_errors = array('count[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($one_price[$i] == '') :
						$n = 1;
						$validation_errors = array('one_price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

				endforeach;
			endif;
			// end of validation


			if ($n == 1) {
				echo json_encode($messages);
				return false;
			}


			$sql = "
				INSERT INTO `wheel` (
				  `add_date`,
				  `add_user_id`,
				  `whence`,
				  `wheel_type`,
				  `producer`,
				  `model`,
				  `depreciation`,
				  `count`,
				  `one_price`,
				  `price`,
				  `other_info`,
				  `fleet_id`,
				  `status`
				) 
				VALUES
			";


			foreach ($fl_ids as $key => $fl_id) {

				$sql .= "(
					" . $this->load->db_value($date[$key]) . ",
					" . $this->load->db_value($user_id) . ",
					" . $this->load->db_value($whence[$key]) . ",
					" . $this->load->db_value($wheel_type[$key]) . ",
					" . $this->load->db_value($producer[$key]) . ",
					" . $this->load->db_value($model[$key]) . ",
					" . $this->load->db_value($depreciation[$key]) . ",
					" . $this->load->db_value($count[$key]) . ",
					" . $this->load->db_value($one_price[$key]) . ",
					" . $this->load->db_value($price[$key]) . ",
					" . $this->load->db_value($other_info[$key]) . ",
					" . $this->load->db_value($fl_id) . ",
					" . $this->load->db_value($status) . "
				),";
			}

			$sql = substr($sql, 0, -1);

			$result = $this->db->query($sql);


		}
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


	public function vehicle_brake()
	{

		$user_id = $this->session->user_id;
		$lng = $this->load->lng();
		$data = array();
		$arr = $this->input->post('arr');

		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');

		$sql_add_user = "
			SELECT
				CONCAT_WS(
					' ',
					`first_name`,
					`last_name`
			  	) AS `name`
			FROM
			  `user`
			WHERE `id` = '" . $user_id . "'	  	
		";

		$query_add_user = $this->db->query($sql_add_user);

		$data['user'] = $query_add_user->row_array();


		$fleet_arr = array();

		if ($arr) {
			foreach ($arr as $value) {
				if (preg_match('/^(f)/', $value['key'])) {
					$fleet_arr['id'][] = preg_replace('/^(f)/', '', $value['key']);
					$fleet_arr['name'][] = $value['name'];
				}
			}
		}


		if ($fleet_arr) {

			$data['fleet'] = $fleet_arr;

			$sql = "
				SELECT 
				  `brake`.`id`,
				  `brake`.`add_date`,
				  `brake`.`add_user_id`,
				  `brake`.`whence`,
				  `brake`.`brake_type`,
				  `brake`.`producer`,
				  `brake`.`model`,
				  `brake`.`depreciation`,
				  `brake`.`count`,
				  `brake`.`one_price`,
				  `brake`.`other_info`,
				  `brake`.`price`,
				  `brake`.`fleet_id`,
				  CONCAT_WS(' ', `brand`.`title_" . $lng . "`, `model`.`title_" . $lng . "`) AS `brand_model`,
				  CONCAT_WS(' ', `user`.`first_name`, `user`.`last_name`) AS `user_name`,
				  `brake`.`status` 
				FROM
				  `brake` 
				LEFT JOIN `fleet` 
					ON `fleet`.`id` = `brake`.`fleet_id`
				LEFT JOIN `user` 
					ON `user`.`id` = `brake`.`add_user_id`
				LEFT JOIN `model` 
					ON `model`.`id` = `fleet`.`model_id` 
				LEFT JOIN `brand` 
					ON `brand`.`id` = `model`.`brand_id` 	
				WHERE `brake`.`status` = '1' 
				 AND FIND_IN_SET(`brake`.`fleet_id`, '" . implode(',', $fleet_arr['id']) . "')
				 AND (`brake`.`add_date` >= '" . $date_from . "' AND `brake`.`add_date` <= '" . $date_to . "')
				 ORDER BY `brand_model`
			";

			$query = $this->db->query($sql);

			$data['fleet_data'] = $query->result_array();

			$this->load->view('structure/vehicle_brake', $data);
		}
	}


	public function brake_ax()
	{

		//$this->load->authorisation('Structure', 'spares');

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


		$fleet_id = $this->input->post('fleet_id');

		// validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');


		if ($fleet_id != '') {

			$price = $this->input->post('price');
			$whence = $this->input->post('whence');
			$brake_type = $this->input->post('brake_type');
			$producer = $this->input->post('producer');
			$model = $this->input->post('model');
			$depreciation = $this->input->post('depreciation');
			$count = $this->input->post('count');
			$one_price = $this->input->post('one_price');
			$date = $this->input->post('date');
			$other_info = $this->input->post('other_info');

			if (is_array($price)) :
				foreach ($price as $i => $price_val) :
					if ($price_val == '') :
						$n = 1;
						$validation_errors = array('price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($whence[$i] == '') :
						$n = 1;
						$validation_errors = array('whence[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($brake_type[$i] == '') :
						$n = 1;
						$validation_errors = array('brake_type[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($producer[$i] == '') :
						$n = 1;
						$validation_errors = array('producer[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($model[$i] == '') :
						$n = 1;
						$validation_errors = array('model[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($depreciation[$i] == '') :
						$n = 1;
						$validation_errors = array('depreciation[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($count[$i] == '') :
						$n = 1;
						$validation_errors = array('count[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($one_price[$i] == '') :
						$n = 1;
						$validation_errors = array('one_price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

				endforeach;
			endif;
			// end of validation


			if ($n == 1) {
				echo json_encode($messages);
				return false;
			}


			$status = 1;


			$sql = "
				INSERT INTO `brake` (
				  `add_date`,
				  `add_user_id`,
				  `whence`,
				  `brake_type`,
				  `producer`,
				  `model`,
				  `depreciation`,
				  `count`,
				  `one_price`,
				  `price`,
				  `other_info`,
				  `fleet_id`,
				  `status`
				) 
				VALUES
			";


			foreach ($date as $key => $add_dte) {
				$sql .= "(
					" . $this->load->db_value($add_dte) . ",
					" . $this->load->db_value($user_id) . ",
					" . $this->load->db_value($whence[$key]) . ",
					" . $this->load->db_value($brake_type[$key]) . ",
					" . $this->load->db_value($producer[$key]) . ",
					" . $this->load->db_value($model[$key]) . ",
					" . $this->load->db_value($depreciation[$key]) . ",
					" . $this->load->db_value($count[$key]) . ",
					" . $this->load->db_value($one_price[$key]) . ",
					" . $this->load->db_value($price[$key]) . ",
					" . $this->load->db_value($other_info[$key]) . ",
					" . $this->load->db_value($fleet_id) . ",
					" . $this->load->db_value($status) . "
				),";
			}

			$sql = substr($sql, 0, -1);

			$result = $this->db->query($sql);

		} else {

			$fl_ids = $this->input->post('fl_id');
			$price = $this->input->post('price');
			$whence = $this->input->post('whence');
			$brake_type = $this->input->post('brake_type');
			$producer = $this->input->post('producer');
			$model = $this->input->post('model');
			$depreciation = $this->input->post('depreciation');
			$count = $this->input->post('count');
			$one_price = $this->input->post('one_price');
			$date = $this->input->post('date');
			$other_info = $this->input->post('other_info');
			$status = 1;

			if (is_array($price)) :
				foreach ($price as $i => $price_val) :
					if ($price_val == '') :
						$n = 1;
						$validation_errors = array('price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($whence[$i] == '') :
						$n = 1;
						$validation_errors = array('whence[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($brake_type[$i] == '') :
						$n = 1;
						$validation_errors = array('brake_type[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($producer[$i] == '') :
						$n = 1;
						$validation_errors = array('producer[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($model[$i] == '') :
						$n = 1;
						$validation_errors = array('model[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($depreciation[$i] == '') :
						$n = 1;
						$validation_errors = array('depreciation[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($count[$i] == '') :
						$n = 1;
						$validation_errors = array('count[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($one_price[$i] == '') :
						$n = 1;
						$validation_errors = array('one_price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

				endforeach;
			endif;
			// end of validation


			if ($n == 1) {
				echo json_encode($messages);
				return false;
			}


			$sql = "
				INSERT INTO `brake` (
				  `add_date`,
				  `add_user_id`,
				  `whence`,
				  `brake_type`,
				  `producer`,
				  `model`,
				  `depreciation`,
				  `count`,
				  `one_price`,
				  `price`,
				  `other_info`,
				  `fleet_id`,
				  `status`
				) 
				VALUES
			";


			foreach ($fl_ids as $key => $fl_id) {

				$sql .= "(
					" . $this->load->db_value($date[$key]) . ",
					" . $this->load->db_value($user_id) . ",
					" . $this->load->db_value($whence[$key]) . ",
					" . $this->load->db_value($brake_type[$key]) . ",
					" . $this->load->db_value($producer[$key]) . ",
					" . $this->load->db_value($model[$key]) . ",
					" . $this->load->db_value($depreciation[$key]) . ",
					" . $this->load->db_value($count[$key]) . ",
					" . $this->load->db_value($one_price[$key]) . ",
					" . $this->load->db_value($price[$key]) . ",
					" . $this->load->db_value($other_info[$key]) . ",
					" . $this->load->db_value($fl_id) . ",
					" . $this->load->db_value($status) . "
				),";
			}

			$sql = substr($sql, 0, -1);

			$result = $this->db->query($sql);


		}
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


	public function vehicle_grease()
	{

		$user_id = $this->session->user_id;
		$lng = $this->load->lng();
		$data = array();
		$arr = $this->input->post('arr');

		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');

		$sql_add_user = "
			SELECT
				CONCAT_WS(
					' ',
					`first_name`,
					`last_name`
			  	) AS `name`
			FROM
			  `user`
			WHERE `id` = '" . $user_id . "'	  	
		";

		$query_add_user = $this->db->query($sql_add_user);

		$data['user'] = $query_add_user->row_array();


		$fleet_arr = array();

		if ($arr) {
			foreach ($arr as $value) {
				if (preg_match('/^(f)/', $value['key'])) {
					$fleet_arr['id'][] = preg_replace('/^(f)/', '', $value['key']);
					$fleet_arr['name'][] = $value['name'];
				}
			}
		}


		if ($fleet_arr) {

			$data['fleet'] = $fleet_arr;

			$sql = "
				SELECT 
				  `grease`.`id`,
				  `grease`.`add_date`,
				  `grease`.`add_user_id`,
				  `grease`.`whence`,
				  `grease`.`model`,
				  `grease`.`count`,
				  `grease`.`producer`,
				  `grease`.`one_price`,
				  `grease`.`other_info`,
				  `grease`.`price`,
				  `grease`.`fleet_id`,
				  CONCAT_WS(' ', `brand`.`title_" . $lng . "`, `model`.`title_" . $lng . "`) AS `brand_model`,
				  CONCAT_WS(' ', `user`.`first_name`, `user`.`last_name`) AS `user_name`,
				  `grease`.`status` 
				FROM
				  `grease` 
				LEFT JOIN `fleet` 
					ON `fleet`.`id` = `grease`.`fleet_id`
				LEFT JOIN `user` 
					ON `user`.`id` = `grease`.`add_user_id`
				LEFT JOIN `model` 
					ON `model`.`id` = `fleet`.`model_id` 
				LEFT JOIN `brand` 
					ON `brand`.`id` = `model`.`brand_id` 	
				WHERE `grease`.`status` = '1' 
				 AND FIND_IN_SET(`grease`.`fleet_id`, '" . implode(',', $fleet_arr['id']) . "')
				 AND (`grease`.`add_date` >= '" . $date_from . "' AND `grease`.`add_date` <= '" . $date_to . "')
				 ORDER BY `brand_model`
			";

			$query = $this->db->query($sql);

			$data['fleet_data'] = $query->result_array();

			$this->load->view('structure/vehicle_grease', $data);
		}
	}


	public function grease_ax()
	{

		//$this->load->authorisation('Structure', 'grease');

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


		$fleet_id = $this->input->post('fleet_id');

		// validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');


		if ($fleet_id != '') {

			$price = $this->input->post('price');
			$whence = $this->input->post('whence');
			$producer = $this->input->post('producer');
			$model = $this->input->post('model');
			$count = $this->input->post('count');
			$one_price = $this->input->post('one_price');
			$date = $this->input->post('date');
			$other_info = $this->input->post('other_info');

			if (is_array($price)) :
				foreach ($price as $i => $price_val) :
					if ($price_val == '') :
						$n = 1;
						$validation_errors = array('price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($whence[$i] == '') :
						$n = 1;
						$validation_errors = array('whence[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;


					if ($producer[$i] == '') :
						$n = 1;
						$validation_errors = array('producer[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($model[$i] == '') :
						$n = 1;
						$validation_errors = array('model[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($count[$i] == '') :
						$n = 1;
						$validation_errors = array('count[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($one_price[$i] == '') :
						$n = 1;
						$validation_errors = array('one_price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

				endforeach;
			endif;
			// end of validation


			if ($n == 1) {
				echo json_encode($messages);
				return false;
			}


			$status = 1;


			$sql = "
				INSERT INTO `grease` (
				  `add_date`,
				  `add_user_id`,
				  `whence`,
				  `producer`,
				  `model`,
				  `count`,
				  `one_price`,
				  `price`,
				  `other_info`,
				  `fleet_id`,
				  `status`
				) 
				VALUES
			";


			foreach ($date as $key => $add_dte) {
				$sql .= "(
					" . $this->load->db_value($add_dte) . ",
					" . $this->load->db_value($user_id) . ",
					" . $this->load->db_value($whence[$key]) . ",
					" . $this->load->db_value($producer[$key]) . ",
					" . $this->load->db_value($model[$key]) . ",
					" . $this->load->db_value($count[$key]) . ",
					" . $this->load->db_value($one_price[$key]) . ",
					" . $this->load->db_value($price[$key]) . ",
					" . $this->load->db_value($other_info[$key]) . ",
					" . $this->load->db_value($fleet_id) . ",
					" . $this->load->db_value($status) . "
				),";
			}

			$sql = substr($sql, 0, -1);

			$result = $this->db->query($sql);

		} else {

			$fl_ids = $this->input->post('fl_id');
			$price = $this->input->post('price');
			$whence = $this->input->post('whence');
			$producer = $this->input->post('producer');
			$model = $this->input->post('model');
			$count = $this->input->post('count');
			$one_price = $this->input->post('one_price');
			$date = $this->input->post('date');
			$other_info = $this->input->post('other_info');
			$status = 1;

			if (is_array($price)) :
				foreach ($price as $i => $price_val) :
					if ($price_val == '') :
						$n = 1;
						$validation_errors = array('price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($whence[$i] == '') :
						$n = 1;
						$validation_errors = array('whence[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($producer[$i] == '') :
						$n = 1;
						$validation_errors = array('producer[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($model[$i] == '') :
						$n = 1;
						$validation_errors = array('model[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($count[$i] == '') :
						$n = 1;
						$validation_errors = array('count[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($one_price[$i] == '') :
						$n = 1;
						$validation_errors = array('one_price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

				endforeach;
			endif;
			// end of validation


			if ($n == 1) {
				echo json_encode($messages);
				return false;
			}


			$sql = "
				INSERT INTO `grease` (
				  `add_date`,
				  `add_user_id`,
				  `whence`,
				  `producer`,
				  `model`,
				  `count`,
				  `one_price`,
				  `price`,
				  `other_info`,
				  `fleet_id`,
				  `status`
				) 
				VALUES
			";


			foreach ($fl_ids as $key => $fl_id) {

				$sql .= "(
					" . $this->load->db_value($date[$key]) . ",
					" . $this->load->db_value($user_id) . ",
					" . $this->load->db_value($whence[$key]) . ",
					" . $this->load->db_value($producer[$key]) . ",
					" . $this->load->db_value($model[$key]) . ",
					" . $this->load->db_value($count[$key]) . ",
					" . $this->load->db_value($one_price[$key]) . ",
					" . $this->load->db_value($price[$key]) . ",
					" . $this->load->db_value($other_info[$key]) . ",
					" . $this->load->db_value($fl_id) . ",
					" . $this->load->db_value($status) . "
				),";
			}

			$sql = substr($sql, 0, -1);

			$result = $this->db->query($sql);


		}
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


	public function vehicle_filter()
	{

		$user_id = $this->session->user_id;
		$lng = $this->load->lng();
		$data = array();
		$arr = $this->input->post('arr');

		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');

		$sql_add_user = "
			SELECT
				CONCAT_WS(
					' ',
					`first_name`,
					`last_name`
			  	) AS `name`
			FROM
			  `user`
			WHERE `id` = '" . $user_id . "'	  	
		";

		$query_add_user = $this->db->query($sql_add_user);

		$data['user'] = $query_add_user->row_array();


		$fleet_arr = array();

		if ($arr) {
			foreach ($arr as $value) {
				if (preg_match('/^(f)/', $value['key'])) {
					$fleet_arr['id'][] = preg_replace('/^(f)/', '', $value['key']);
					$fleet_arr['name'][] = $value['name'];
				}
			}
		}


		if ($fleet_arr) {

			$data['fleet'] = $fleet_arr;

			$sql = "
				SELECT 
				  `filter`.`id`,
				  `filter`.`add_date`,
				  `filter`.`add_user_id`,
				  `filter`.`whence`,
				  `filter`.`model`,
				  `filter`.`type`,
				  `filter`.`count`,
				  `filter`.`producer`,
				  `filter`.`one_price`,
				  `filter`.`other_info`,
				  `filter`.`price`,
				  `filter`.`fleet_id`,
				  CONCAT_WS(' ', `brand`.`title_" . $lng . "`, `model`.`title_" . $lng . "`) AS `brand_model`,
				  CONCAT_WS(' ', `user`.`first_name`, `user`.`last_name`) AS `user_name`,
				  `filter`.`status` 
				FROM
				  `filter` 
				LEFT JOIN `fleet` 
					ON `fleet`.`id` = `filter`.`fleet_id`
				LEFT JOIN `user` 
					ON `user`.`id` = `filter`.`add_user_id`
				LEFT JOIN `model` 
					ON `model`.`id` = `fleet`.`model_id` 
				LEFT JOIN `brand` 
					ON `brand`.`id` = `model`.`brand_id` 	
				WHERE `filter`.`status` = '1' 
				 AND FIND_IN_SET(`filter`.`fleet_id`, '" . implode(',', $fleet_arr['id']) . "')
				 AND (`filter`.`add_date` >= '" . $date_from . "' AND `filter`.`add_date` <= '" . $date_to . "')
				 ORDER BY `brand_model`
			";

			$query = $this->db->query($sql);

			$data['fleet_data'] = $query->result_array();

			$this->load->view('structure/vehicle_filter', $data);
		}
	}


	public function filter_ax()
	{

		//$this->load->authorisation('Structure', 'grease');

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


		$fleet_id = $this->input->post('fleet_id');

		// validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');


		if ($fleet_id != '') {

			$price = $this->input->post('price');
			$whence = $this->input->post('whence');
			$producer = $this->input->post('producer');
			$model = $this->input->post('model');
			$type = $this->input->post('type');
			$count = $this->input->post('count');
			$one_price = $this->input->post('one_price');
			$date = $this->input->post('date');
			$other_info = $this->input->post('other_info');

			if (is_array($price)) :
				foreach ($price as $i => $price_val) :
					if ($price_val == '') :
						$n = 1;
						$validation_errors = array('price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($whence[$i] == '') :
						$n = 1;
						$validation_errors = array('whence[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;


					if ($producer[$i] == '') :
						$n = 1;
						$validation_errors = array('producer[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($model[$i] == '') :
						$n = 1;
						$validation_errors = array('model[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($type[$i] == '') :
						$n = 1;
						$validation_errors = array('type[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($count[$i] == '') :
						$n = 1;
						$validation_errors = array('count[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($one_price[$i] == '') :
						$n = 1;
						$validation_errors = array('one_price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

				endforeach;
			endif;
			// end of validation


			if ($n == 1) {
				echo json_encode($messages);
				return false;
			}


			$status = 1;


			$sql = "
				INSERT INTO `filter` (
				  `add_date`,
				  `add_user_id`,
				  `whence`,
				  `producer`,
				  `model`,
				  `type`,
				  `count`,
				  `one_price`,
				  `price`,
				  `other_info`,
				  `fleet_id`,
				  `status`
				) 
				VALUES
			";


			foreach ($date as $key => $add_dte) {
				$sql .= "(
					" . $this->load->db_value($add_dte) . ",
					" . $this->load->db_value($user_id) . ",
					" . $this->load->db_value($whence[$key]) . ",
					" . $this->load->db_value($producer[$key]) . ",
					" . $this->load->db_value($model[$key]) . ",
					" . $this->load->db_value($type[$key]) . ",
					" . $this->load->db_value($count[$key]) . ",
					" . $this->load->db_value($one_price[$key]) . ",
					" . $this->load->db_value($price[$key]) . ",
					" . $this->load->db_value($other_info[$key]) . ",
					" . $this->load->db_value($fleet_id) . ",
					" . $this->load->db_value($status) . "
				),";
			}

			$sql = substr($sql, 0, -1);

			$result = $this->db->query($sql);

		} else {

			$fl_ids = $this->input->post('fl_id');
			$price = $this->input->post('price');
			$whence = $this->input->post('whence');
			$producer = $this->input->post('producer');
			$model = $this->input->post('model');
			$type = $this->input->post('type');
			$count = $this->input->post('count');
			$one_price = $this->input->post('one_price');
			$date = $this->input->post('date');
			$other_info = $this->input->post('other_info');
			$status = 1;

			if (is_array($price)) :
				foreach ($price as $i => $price_val) :
					if ($price_val == '') :
						$n = 1;
						$validation_errors = array('price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($whence[$i] == '') :
						$n = 1;
						$validation_errors = array('whence[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($producer[$i] == '') :
						$n = 1;
						$validation_errors = array('producer[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($model[$i] == '') :
						$n = 1;
						$validation_errors = array('model[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($type[$i] == '') :
						$n = 1;
						$validation_errors = array('type[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($count[$i] == '') :
						$n = 1;
						$validation_errors = array('count[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($one_price[$i] == '') :
						$n = 1;
						$validation_errors = array('one_price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

				endforeach;
			endif;
			// end of validation


			if ($n == 1) {
				echo json_encode($messages);
				return false;
			}


			$sql = "
				INSERT INTO `filter` (
				  `add_date`,
				  `add_user_id`,
				  `whence`,
				  `producer`,
				  `model`,
				  `type`,
				  `count`,
				  `one_price`,
				  `price`,
				  `other_info`,
				  `fleet_id`,
				  `status`
				) 
				VALUES
			";


			foreach ($fl_ids as $key => $fl_id) {

				$sql .= "(
					" . $this->load->db_value($date[$key]) . ",
					" . $this->load->db_value($user_id) . ",
					" . $this->load->db_value($whence[$key]) . ",
					" . $this->load->db_value($producer[$key]) . ",
					" . $this->load->db_value($model[$key]) . ",
					" . $this->load->db_value($type[$key]) . ",
					" . $this->load->db_value($count[$key]) . ",
					" . $this->load->db_value($one_price[$key]) . ",
					" . $this->load->db_value($price[$key]) . ",
					" . $this->load->db_value($other_info[$key]) . ",
					" . $this->load->db_value($fl_id) . ",
					" . $this->load->db_value($status) . "
				),";
			}

			$sql = substr($sql, 0, -1);

			$result = $this->db->query($sql);


		}
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


	public function vehicle_battery()
	{

		$user_id = $this->session->user_id;
		$lng = $this->load->lng();
		$data = array();
		$arr = $this->input->post('arr');

		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');

		$sql_add_user = "
			SELECT
				CONCAT_WS(
					' ',
					`first_name`,
					`last_name`
			  	) AS `name`
			FROM
			  `user`
			WHERE `id` = '" . $user_id . "'	  	
		";

		$query_add_user = $this->db->query($sql_add_user);

		$data['user'] = $query_add_user->row_array();


		$fleet_arr = array();

		if ($arr) {
			foreach ($arr as $value) {
				if (preg_match('/^(f)/', $value['key'])) {
					$fleet_arr['id'][] = preg_replace('/^(f)/', '', $value['key']);
					$fleet_arr['name'][] = $value['name'];
				}
			}
		}


		if ($fleet_arr) {

			$data['fleet'] = $fleet_arr;

			$sql = "
				SELECT 
				  `battery`.`id`,
				  `battery`.`add_date`,
				  `battery`.`add_user_id`,
				  `battery`.`whence`,
				  `battery`.`model`,
				  `battery`.`count`,
				  `battery`.`producer`,
				  `battery`.`one_price`,
				  `battery`.`other_info`,
				  `battery`.`price`,
				  `battery`.`fleet_id`,
				  CONCAT_WS(' ', `brand`.`title_" . $lng . "`, `model`.`title_" . $lng . "`) AS `brand_model`,
				  CONCAT_WS(' ', `user`.`first_name`, `user`.`last_name`) AS `user_name`,
				  `battery`.`status` 
				FROM
				  `battery` 
				LEFT JOIN `fleet` 
					ON `fleet`.`id` = `battery`.`fleet_id`
				LEFT JOIN `user` 
					ON `user`.`id` = `battery`.`add_user_id`
				LEFT JOIN `model` 
					ON `model`.`id` = `fleet`.`model_id` 
				LEFT JOIN `brand` 
					ON `brand`.`id` = `model`.`brand_id` 	
				WHERE `battery`.`status` = '1' 
				 AND FIND_IN_SET(`battery`.`fleet_id`, '" . implode(',', $fleet_arr['id']) . "')
				 AND (`battery`.`add_date` >= '" . $date_from . "' AND `battery`.`add_date` <= '" . $date_to . "')
				 ORDER BY `brand_model`
			";

			$query = $this->db->query($sql);

			$data['fleet_data'] = $query->result_array();

			$this->load->view('structure/vehicle_battery', $data);
		}
	}


	public function battery_ax()
	{

		//$this->load->authorisation('Structure', 'grease');

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


		$fleet_id = $this->input->post('fleet_id');

		// validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');


		if ($fleet_id != '') {

			$price = $this->input->post('price');
			$whence = $this->input->post('whence');
			$producer = $this->input->post('producer');
			$model = $this->input->post('model');
			$count = $this->input->post('count');
			$one_price = $this->input->post('one_price');
			$date = $this->input->post('date');
			$other_info = $this->input->post('other_info');

			if (is_array($price)) :
				foreach ($price as $i => $price_val) :
					if ($price_val == '') :
						$n = 1;
						$validation_errors = array('price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($whence[$i] == '') :
						$n = 1;
						$validation_errors = array('whence[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;


					if ($producer[$i] == '') :
						$n = 1;
						$validation_errors = array('producer[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($model[$i] == '') :
						$n = 1;
						$validation_errors = array('model[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($count[$i] == '') :
						$n = 1;
						$validation_errors = array('count[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($one_price[$i] == '') :
						$n = 1;
						$validation_errors = array('one_price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

				endforeach;
			endif;
			// end of validation


			if ($n == 1) {
				echo json_encode($messages);
				return false;
			}


			$status = 1;


			$sql = "
				INSERT INTO `battery` (
				  `add_date`,
				  `add_user_id`,
				  `whence`,
				  `producer`,
				  `model`,
				  `count`,
				  `one_price`,
				  `price`,
				  `other_info`,
				  `fleet_id`,
				  `status`
				) 
				VALUES
			";


			foreach ($date as $key => $add_dte) {
				$sql .= "(
					" . $this->load->db_value($add_dte) . ",
					" . $this->load->db_value($user_id) . ",
					" . $this->load->db_value($whence[$key]) . ",
					" . $this->load->db_value($producer[$key]) . ",
					" . $this->load->db_value($model[$key]) . ",
					" . $this->load->db_value($count[$key]) . ",
					" . $this->load->db_value($one_price[$key]) . ",
					" . $this->load->db_value($price[$key]) . ",
					" . $this->load->db_value($other_info[$key]) . ",
					" . $this->load->db_value($fleet_id) . ",
					" . $this->load->db_value($status) . "
				),";
			}

			$sql = substr($sql, 0, -1);

			$result = $this->db->query($sql);

		} else {

			$fl_ids = $this->input->post('fl_id');
			$price = $this->input->post('price');
			$whence = $this->input->post('whence');
			$producer = $this->input->post('producer');
			$model = $this->input->post('model');
			$count = $this->input->post('count');
			$one_price = $this->input->post('one_price');
			$date = $this->input->post('date');
			$other_info = $this->input->post('other_info');
			$status = 1;

			if (is_array($price)) :
				foreach ($price as $i => $price_val) :
					if ($price_val == '') :
						$n = 1;
						$validation_errors = array('price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($whence[$i] == '') :
						$n = 1;
						$validation_errors = array('whence[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($producer[$i] == '') :
						$n = 1;
						$validation_errors = array('producer[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($model[$i] == '') :
						$n = 1;
						$validation_errors = array('model[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($count[$i] == '') :
						$n = 1;
						$validation_errors = array('count[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

					if ($one_price[$i] == '') :
						$n = 1;
						$validation_errors = array('one_price[' . $i . ']' => lang('required'));
						$messages['error']['elements'][] = $validation_errors;
					endif;

				endforeach;
			endif;
			// end of validation


			if ($n == 1) {
				echo json_encode($messages);
				return false;
			}


			$sql = "
				INSERT INTO `battery` (
				  `add_date`,
				  `add_user_id`,
				  `whence`,
				  `producer`,
				  `model`,
				  `count`,
				  `one_price`,
				  `price`,
				  `other_info`,
				  `fleet_id`,
				  `status`
				) 
				VALUES
			";


			foreach ($fl_ids as $key => $fl_id) {

				$sql .= "(
					" . $this->load->db_value($date[$key]) . ",
					" . $this->load->db_value($user_id) . ",
					" . $this->load->db_value($whence[$key]) . ",
					" . $this->load->db_value($producer[$key]) . ",
					" . $this->load->db_value($model[$key]) . ",
					" . $this->load->db_value($count[$key]) . ",
					" . $this->load->db_value($one_price[$key]) . ",
					" . $this->load->db_value($price[$key]) . ",
					" . $this->load->db_value($other_info[$key]) . ",
					" . $this->load->db_value($fl_id) . ",
					" . $this->load->db_value($status) . "
				),";
			}

			$sql = substr($sql, 0, -1);

			$result = $this->db->query($sql);


		}
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


}
//end of class
