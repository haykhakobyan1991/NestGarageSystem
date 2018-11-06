<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Organization extends MX_Controller {

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
	 * @param string $company_id
	 * @return bool
	 */
	public function get_parent_user($company_id = '') {

		if ($company_id != '') {
			$row_parent_user = $this->db->select('user.id')
				->from('user')
				->join('company', 'company.id = user.company_id', 'left')
				->where('user.company_id', $company_id)
				->where('user.parent_user_id', NULL)
				->limit('1')
				->get()
				->row_array();

			return $row_parent_user['id'];
		}

		return false;
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


	private function smtp_mailing() {

		$config['protocol']    = 'smtp';
		$config['smtp_host']    = 'ssl://smtp.gmail.com';
		$config['smtp_port']    = '465';
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = 'dilemmatik@gmail.com';
		$config['smtp_pass']    = 'dilemma!1';
		$config['charset']    = 'utf-8';
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'html'; // or text
		$config['validation'] = TRUE; // bool whether to validate email or not
		$this->load->library('email');
		$this->email->initialize($config);

		$this->email->from('dilemmatik@gmail.com', 'dilemmatik.ru');


	}




	public function company() {

		// for all
		$this->load->authorisation();
		$this->load->helper('url');
		$this->load->library('session');
		$user_id = $this->session->user_id;
		$data = array();

		$lng = $this->load->lng();




		$row = $this->db->select('company_id')->from('user')->where('id', $user_id)->get()->row_array();
		$company_id = $row['company_id'];


		$data['parent_user'] = $this->get_parent_user($company_id);


		$sql_country = "
		    SELECT 
              `id`,
              `title_".$lng."` AS `title`,
              `status` 
            FROM
              `country` 
            WHERE `status` = '1' 
            ORDER BY `title_".$lng."` 
		";

		$query_country = $this->db->query($sql_country);
		$data['country'] = $query_country->result_array();

		// end

		$data['company'] = $this->db->select('*')->from('company')->where('id', $company_id)->get()->row_array();


		$sql_company_type = "
				SELECT 
				  `id`,
				  `title_" . $lng . "` AS `title`
				FROM
				  `company_type` 
				WHERE `status` = '1'
			";

		$query_company_type = $this->db->query($sql_company_type);
		$data['company_type'] = $query_company_type->result_array();

		$this->layout->view('organization/company', $data);

	}



	public function department() {

		$this->load->authorisation();
		$this->load->helper('url');
		$this->load->library('session');
		$user_id = $this->session->user_id;
		$data = array();

		$lng = $this->load->lng();


		$row = $this->db->select('company_id')->from('user')->where('id', $user_id)->get()->row_array();
		$company_id = $row['company_id'];


		$data['parent_user'] = $this->get_parent_user($company_id);

		$sql_country = "
		    SELECT 
              `id`,
              `title_".$lng."` AS `title`,
              `status` 
            FROM
              `country` 
            WHERE `status` = '1' 
            ORDER BY `title_".$lng."` 
		";

		$query_country = $this->db->query($sql_country);
		$data['country'] = $query_country->result_array();


		$data['company'] = $this->db->select('*')->from('company')->where('id', $company_id)->get()->row_array();


		$data['staff_for_select'] = $this->db->select('staff.id, CONCAT_WS(" ", staff.first_name, staff.last_name) AS name, staff.status')
			->from('staff')
			->join('user', 'staff.registrar_user_id = user.id', 'left')
			->where('user.company_id', $company_id)
			->where('staff.status', 1)
			->get()
			->result_array();


		$query = $this->db->select('
									department.id, 
									department.title, 
									department.description, 
									staff.first_name, 
									staff.last_name, 
									CONCAT_WS("<br>", staff.contact_1, staff.contact_2) AS phone, 
									staff.email, CONCAT_WS(" ", user.first_name, user.last_name) AS user_name, 
									DATE_FORMAT(department.registration_date, "%d-%m-%y %H:%i") AS registration_date
								')
			->from('department')
			->join('staff', 'staff.id = department.head_staff_id', 'left')
			->join('user', 'department.registrar_user_id = user.id', 'left')
			->where('department.status', 1)
			->where('department.company_id', $company_id)
			->get();

		$data['department'] = $query->result_array();
		$data['department_num_rows'] = $query->num_rows();


		$this->layout->view('organization/department', $data);

	}


	public function staff() {

		$this->load->authorisation();
		$this->load->helper('url');
		$this->load->library('session');
		$user_id = $this->session->user_id;
		$data = array();

		$lng = $this->load->lng();


		$row = $this->db->select('company_id')->from('user')->where('id', $user_id)->get()->row_array();
		$company_id = $row['company_id'];

		$data['parent_user'] = $this->get_parent_user($company_id);


		$sql_country = "
		    SELECT 
              `id`,
              `title_".$lng."` AS `title`,
              `status` 
            FROM
              `country` 
            WHERE `status` = '1' 
            ORDER BY `title_".$lng."` 
		";

		$query_country = $this->db->query($sql_country);
		$data['country'] = $query_country->result_array();

		$sql_department = "
		    SELECT 
              `id`,
              `title`,
              `status` 
            FROM
              `department` 
            WHERE `status` = '1' 
             AND `company_id` = '".$company_id."'
             ORDER BY `title` 
		";

		$query_department = $this->db->query($sql_department);
		$data['department'] = $query_department->result_array();


		$data['staff'] = $this->db->select('
			staff.*, 
			GROUP_CONCAT(CONCAT("<span class=\"m-1 badge badge-info\" >",  department.title , "</span>") SEPARATOR "") AS department, 
			GROUP_CONCAT(CONCAT("<span class=\"m-1 badge badge-info\" >", CONCAT_WS(" ", head_staff.first_name, head_staff.last_name), "</span>") SEPARATOR "") AS head_staff, 
			CONCAT_WS(" ", user.first_name, user.last_name) AS user_name')
			->from('staff')
			->join('user', 'staff.registrar_user_id = user.id', 'left')
			->join('department', 'FIND_IN_SET(department.id, staff.department_ids)', 'left')
			->join('staff AS head_staff', 'department.head_staff_id = head_staff.id', 'left')
			->where('user.company_id', $company_id)
			->group_by('staff.id')
			->get()
			->result_array();


		$this->layout->view('organization/staff', $data);

	}


	public function vehicles() {

		$this->load->authorisation();
		$this->load->helper('url');
		$this->load->library('session');
		$user_id = $this->session->user_id;
		$data = array();

		$lng = $this->load->lng();


		$row = $this->db->select('company_id')->from('user')->where('id', $user_id)->get()->row_array();
		$company_id = $row['company_id'];


		$data['parent_user'] = $this->get_parent_user($company_id);

		$sql_country = "
		    SELECT 
              `id`,
              `title_".$lng."` AS `title`,
              `status` 
            FROM
              `country` 
            WHERE `status` = '1' 
            ORDER BY `title_".$lng."` 
		";

		$query_country = $this->db->query($sql_country);
		$data['country'] = $query_country->result_array();


		$sql = "
			SELECT 
			  `fleet`.`id`,
			  GROUP_CONCAT(
				CONCAT(
				  '<span class=\"m-1 badge badge-info\">',
				  CONCAT_WS(
					' ',
					`staff`.`first_name`,
					`staff`.`last_name`
				  ),
				  '</span>'
				) SEPARATOR ''
			  ) AS `staff`,
			  CONCAT_WS(
				' ',
				`brand`.`title_".$lng."`,
				`model`.`title_".$lng."`
			  ) AS `brand_model`,
			  `color`,
			  `vin_code`,
			  `engine_power`,
			   CONCAT_WS(' ', `user`.`first_name`, `user`.`last_name`) AS `user_name`,
			   DATE_FORMAT(`fleet`.`registration_date`, '%d-%m-%Y') AS `creation_date`,
			  `fleet`.`status` 
			FROM
			  `fleet` 
			LEFT JOIN `staff` 
				ON FIND_IN_SET(
				  `staff`.`id`,
				  `fleet`.`staff_ids`
				) 
			LEFT JOIN `user` 
				ON `user`.`id` = `fleet`.`registrar_user_id` 	
			LEFT JOIN `model` 
				ON `model`.`id` = `fleet`.`model_id` 
			LEFT JOIN `brand` 
				ON `brand`.`id` = `model`.`brand_id` 
			WHERE `user`.`company_id` = ".$this->load->db_value($company_id)."	
			GROUP BY `fleet`.`id` 
		";


		$query = $this->db->query($sql);
		$data['result_array'] = $query->result_array();



		$this->layout->view('organization/vehicles', $data);


	}





	public function user() {
		$this->load->authorisation();
		$this->load->helper('url');
		$this->load->library('session');
		$user_id = $this->session->user_id;
		$data = array();

		$lng = $this->load->lng();


		$row = $this->db->select('company_id')->from('user')->where('id', $user_id)->get()->row_array();
		$company_id = $row['company_id'];


		$data['parent_user'] = $this->get_parent_user($company_id);


		 $sql = "
			SELECT
			  `user`.`id`,
			  `user`.`photo`,
			  `user`.`parent_user_id`,
			  CONCAT_WS(' ', `user`.`first_name`, `user`.`last_name`) AS `user_name`,
			  `user`.`email`,
			  CONCAT_WS(' ', `parent_user`.`first_name`, `parent_user`.`last_name`) AS `parent_user_name`,
			  `company`.`name` AS `company_name`,
			  `role`.`title` AS `role`,
			  `user`.`address`,
			  `user`.`country_id`,
			  `user`.`country_code`,
			  `user`.`phone_number`,
			  `user`.`username`,
			  DATE_FORMAT(`user`.`creation_date`, '%d-%m-%Y') AS `creation_date`,
			  DATE_FORMAT(`user`.`last_activity`, '%d-%m-%Y/%H:%i') AS `last_activity`,
			  DATEDIFF(NOW(), `user`.`last_activity`) AS `activity`,
			  `user`.`status`
			FROM 
			  `user`
			LEFT JOIN `user` AS `parent_user`
				ON `user`.`parent_user_id` = `parent_user`.`id`
			LEFT JOIN `company`	
				ON `user`.`company_id` = `company`.`id`
			LEFT JOIN `role`	
				ON `user`.`role_id` = `role`.`id`
			WHERE `user`.`company_id` = '".$company_id."'
				
		";

		$query = $this->db->query($sql);
		$data['user'] = $query->result_array();


		$sql_country = "
		    SELECT 
              `id`,
              `title_".$lng."` AS `title`,
              `status` 
            FROM
              `country` 
            WHERE `status` = '1' 
            ORDER BY `title_".$lng."` 
		";

		$query_country = $this->db->query($sql_country);
		$data['country'] = $query_country->result_array();


		 $sql_role = "
		    SELECT 
              `id`,
              `title`,
              `status` 
            FROM
              `role` 
            WHERE `status` = '1' 
             AND `id` <> '1' #not administrator
		";

		$query_role = $this->db->query($sql_role);
		$data['role'] = $query_role->result_array();

		$this->layout->view('organization/user', $data);
	}






	public function company_ax() {

		$this->load->authorisation('Organization', 'company');

		$this->load->library('session');
		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');
		$n = 0;
		$user_id = $this->session->user_id;
		$this->load->library('image_lib');


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
		$this->form_validation->set_rules('company_type', 'Company type', 'required');
		$this->form_validation->set_rules('company_name', 'Company name', 'required');
		$this->form_validation->set_rules('owner_email', 'owner_email', 'valid_email');
		$this->form_validation->set_rules('email', 'email', 'valid_email');





		if($this->form_validation->run() == false){
			//validation errors
			$n = 1;

			$validation_errors = array(
				'company_type' => form_error('company_type'),
				'company_name' => form_error('company_name'),
				'owner_email' => form_error('owner_email'),
				'email' => form_error('email'),
			);
			$messages['error']['elements'][] = $validation_errors;
		}


		if($n == 1) {
			echo json_encode($messages);
			return false;
		}


		$sql_company_exits = "
			SELECT 
			  `company`.`id`,
			  `company`.`logo`
			FROM
			  `company` 
			  LEFT JOIN `user` 
				ON `user`.`company_id` = `company`.`id` 
			WHERE `user`.`id` = '".$user_id."' 
		";


		$query_company_exits = $this->db->query($sql_company_exits);

		$row_company_exits = $query_company_exits->row_array();

		$exist_company_id = $row_company_exits['id'];
		$company_logo = $row_company_exits['logo'];

		$num = $query_company_exits->num_rows();


		$company_name = $this->input->post('company_name');
		$company_type = $this->input->post('company_type');

		$activity_country = $this->input->post('activity_country');
		$activity_state_region = $this->input->post('activity_state_region');
		$activity_city = $this->input->post('activity_city');
		$activity_zip_code = $this->input->post('activity_zip_code');
		$activity_address = $this->input->post('activity_address');

		$legal_country = $this->input->post('legal_country');
		$legal_state_region = $this->input->post('legal_state_region');
		$legal_city = $this->input->post('legal_city');
		$legal_zip_code = $this->input->post('legal_zip_code');
		$legal_address = $this->input->post('legal_address');

		$tin = $this->input->post('tin');
		$phone_number = $this->input->post('phone_number');
		$email = $this->input->post('email');
		$web_address = $this->input->post('web_address');

		$owner_firstname = $this->input->post('owner_firstname');
		$owner_lastname = $this->input->post('owner_lastname');
		$owner_position = $this->input->post('owner_position');
		$owner_contact_number = $this->input->post('owner_contact_number');
		$owner_email = $this->input->post('owner_email');

		$account_name_1 = $this->input->post('account_name_1');
		$account_number_1 = $this->input->post('account_number_1');
		$correspondent_bank_1 = $this->input->post('correspondent_bank_1');
		$swift_code_1 = $this->input->post('swift_code_1');
		$account_1 = $this->input->post('account_1');

		$account_name_2 = $this->input->post('account_name_2');
		$account_number_2 = $this->input->post('account_number_2');
		$correspondent_bank_2 = $this->input->post('correspondent_bank_2');
		$swift_code_2 = $this->input->post('swift_code_2');
		$account_2 = $this->input->post('account_2');

		$account_name_3 = $this->input->post('account_name_3');
		$account_number_3 = $this->input->post('account_number_3');
		$correspondent_bank_3 = $this->input->post('correspondent_bank_3');
		$swift_code_3 = $this->input->post('swift_code_3');
		$account_3 = $this->input->post('account_3');


		$account_name_4 = $this->input->post('account_name_4');
		$account_number_4 = $this->input->post('account_number_4');
		$correspondent_bank_4 = $this->input->post('correspondent_bank_4');
		$swift_code_4 = $this->input->post('swift_code_4');
		$account_4 = $this->input->post('account_4');


		$status = '1';
		$add_sql_image = '';


		//upload config
		$config = $this->upload_config();


		if (!file_exists(set_realpath('uploads/company'))) {
			mkdir(set_realpath('uploads/company'), '0755', true);
			copy(set_realpath('uploads/index.html'), set_realpath('uploads/index.html'));
			copy(set_realpath('uploads/index.html'), set_realpath('uploads/company/index.html'));
		}

		$config['upload_path'] = set_realpath('uploads/company');


		if(isset($_FILES['photo']['name']) AND $_FILES['photo']['name'] != '') {
			$this->load->library('upload', $config);
			$this->upload->initialize($config);


			if (!$this->upload->do_upload('photo')) {
				$validation_errors = array('photo' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}


			if($company_logo != '' && file_exists(set_realpath('uploads/company/'.$company_logo))) {
				unlink(set_realpath('uploads/company/'.$company_logo));
			}



			$photo_arr = $this->upload->data();

			$image = $photo_arr['file_name'];

			$add_sql_image = "`logo` =  '".$image."',";

		}



		// if num rows > 0 update company
		if($num > 0) {
			$sql = "
				UPDATE 
				  `company` 
				SET
				  `company_type_id` = ".$this->load->db_value($company_type).",
				  ".$add_sql_image."
				  `owner_firstname` = ".$this->load->db_value($owner_firstname).",
				  `owner_lastname` = ".$this->load->db_value($owner_lastname).",
				  `owner_position` = ".$this->load->db_value($owner_position).",
				  `owner_contact_number` = ".$this->load->db_value($owner_contact_number).",
				  `owner_email` = ".$this->load->db_value($owner_email).",
				  `name` = ".$this->load->db_value($company_name).",
				  `activity_country_id` = ".$this->load->db_value($activity_country).",
				  `activity_state_region` = ".$this->load->db_value($activity_state_region).",
				  `activity_city` = ".$this->load->db_value($activity_city).",
				  `activity_zip_code` = ".$this->load->db_value($activity_zip_code).",
				  `activity_address` = ".$this->load->db_value($activity_address).",
				  `legal_country_id` = ".$this->load->db_value($legal_country).",
				  `legal_state_region` = ".$this->load->db_value($legal_state_region).",
				  `legal_city` = ".$this->load->db_value($legal_city).",
				  `legal_zip_code` = ".$this->load->db_value($legal_zip_code).",
				  `legal_address` = ".$this->load->db_value($legal_address).",
				  `tin` = ".$this->load->db_value($tin).",
				  `phone_number` = ".$this->load->db_value($phone_number).",
				  `email` = ".$this->load->db_value($email).",
				  `web_address` = ".$this->load->db_value($web_address).",
				  `status` = ".$this->load->db_value($status).",
				  `account_name_1` = ".$this->load->db_value($account_name_1).",
				  `account_number_1` = ".$this->load->db_value($account_number_1).",
				  `correspondent_bank_1` = ".$this->load->db_value($correspondent_bank_1).",
				  `swift_code_1` = ".$this->load->db_value($swift_code_1).",
				  `account_1` = ".$this->load->db_value($account_1).",
				  `account_name_2` = ".$this->load->db_value($account_name_2).",
				  `account_number_2` = ".$this->load->db_value($account_number_2).",
				  `correspondent_bank_2` = ".$this->load->db_value($correspondent_bank_2).",
				  `swift_code_2` = ".$this->load->db_value($swift_code_2).",
				  `account_2` = ".$this->load->db_value($account_2).",
				  `account_name_3` = ".$this->load->db_value($account_name_3).",
				  `account_number_3` = ".$this->load->db_value($account_number_3).",
				  `correspondent_bank_3` = ".$this->load->db_value($correspondent_bank_3).",
				  `swift_code_3` = ".$this->load->db_value($swift_code_3).",
				  `account_3` = ".$this->load->db_value($account_3).",
				  `account_name_4` = ".$this->load->db_value($account_name_4).",
				  `account_number_4` = ".$this->load->db_value($account_number_4).",
				  `correspondent_bank_4` = ".$this->load->db_value($correspondent_bank_4).",
				  `swift_code_4` = ".$this->load->db_value($swift_code_4).",
				  `account_4` = ".$this->load->db_value($account_4)."
				WHERE `id` = '".$exist_company_id."' 
			";

			$result = $this->db->query($sql);

		} else {
			$sql = "
				INSERT INTO 
				  `company` 
				SET
				  `company_type_id` = ".$this->load->db_value($company_type).",
				  ".$add_sql_image."
				  `owner_firstname` = ".$this->load->db_value($owner_firstname).",
				  `owner_lastname` = ".$this->load->db_value($owner_lastname).",
				  `owner_position` = ".$this->load->db_value($owner_position).",
				  `owner_contact_number` = ".$this->load->db_value($owner_contact_number).",
				  `owner_email` = ".$this->load->db_value($owner_email).",
				  `name` = ".$this->load->db_value($company_name).",
				  `activity_country_id` = ".$this->load->db_value($activity_country).",
				  `activity_state_region` = ".$this->load->db_value($activity_state_region).",
				  `activity_city` = ".$this->load->db_value($activity_city).",
				  `activity_zip_code` = ".$this->load->db_value($activity_zip_code).",
				  `activity_address` = ".$this->load->db_value($activity_address).",
				  `legal_country_id` = ".$this->load->db_value($legal_country).",
				  `legal_state_region` = ".$this->load->db_value($legal_state_region).",
				  `legal_city` = ".$this->load->db_value($legal_city).",
				  `legal_zip_code` = ".$this->load->db_value($legal_zip_code).",
				  `legal_address` = ".$this->load->db_value($legal_address).",
				  `tin` = ".$this->load->db_value($tin).",
				  `phone_number` = ".$this->load->db_value($phone_number).",
				  `email` = ".$this->load->db_value($email).",
				  `web_address` = ".$this->load->db_value($web_address).",
				  `creation_date` = NOW(),
				  `status` = ".$this->load->db_value($status).",
				  `account_name_1` = ".$this->load->db_value($account_name_1).",
				  `account_number_1` = ".$this->load->db_value($account_number_1).",
				  `correspondent_bank_1` = ".$this->load->db_value($correspondent_bank_1).",
				  `swift_code_1` = ".$this->load->db_value($swift_code_1).",
				  `account_1` = ".$this->load->db_value($account_1).",
				  `account_name_2` = ".$this->load->db_value($account_name_2).",
				  `account_number_2` = ".$this->load->db_value($account_number_2).",
				  `correspondent_bank_2` = ".$this->load->db_value($correspondent_bank_2).",
				  `swift_code_2` = ".$this->load->db_value($swift_code_2).",
				  `account_2` = ".$this->load->db_value($account_2).",
				  `account_name_3` = ".$this->load->db_value($account_name_3).",
				  `account_number_3` = ".$this->load->db_value($account_number_3).",
				  `correspondent_bank_3` = ".$this->load->db_value($correspondent_bank_3).",
				  `swift_code_3` = ".$this->load->db_value($swift_code_3).",
				  `account_3` = ".$this->load->db_value($account_3).",
				  `account_name_4` = ".$this->load->db_value($account_name_4).",
				  `account_number_4` = ".$this->load->db_value($account_number_4).",
				  `correspondent_bank_4` = ".$this->load->db_value($correspondent_bank_4).",
				  `swift_code_4` = ".$this->load->db_value($swift_code_4).",
				  `account_4` = ".$this->load->db_value($account_4)."
			";


			$result = $this->db->query($sql);
			$company_id = $this->db->insert_id();

			$sql_user_company = "
				UPDATE `user` SET `company_id` = '".$company_id."' WHERE `id` = '".$user_id."'
			";

			$query_user_company = $this->db->query($sql_user_company);

			if(!$query_user_company) {
				log_message('CUSTOM', 'company_id is not added in user table.');
			}
		}





		if ($result){
			$messages['success'] = 1;
			$messages['message'] = 'Success';
		} else {
			$messages['success'] = 0;
			$messages['error'] = 'Error';
		}

		// Return success or error message
		echo json_encode($messages);
		return true;
	}



	public function add_staff_ax() {

		$this->load->authorisation('Organization', 'staff');

		$this->load->library('session');
		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');
		$n = 0;
		$user_id = $this->session->user_id;
		$this->load->library('image_lib');


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
		$this->form_validation->set_rules('firstname', 'firstname', 'required');
		$this->form_validation->set_rules('lastname', 'lastname', 'required');
		$this->form_validation->set_rules('email', 'email', 'valid_email');





		if($this->form_validation->run() == false){
			//validation errors
			$n = 1;

			$validation_errors = array(
				'firstname' => form_error('firstname'),
				'lastname' => form_error('lastname'),
				'email' => form_error('email'),
			);
			$messages['error']['elements'][] = $validation_errors;
		}


		if($n == 1) {
			echo json_encode($messages);
			return false;
		}




		$firstname = $this->input->post('firstname');
		$lastname = $this->input->post('lastname');
		$contact_1 = $this->input->post('contact_1');
		$contact_2 = $this->input->post('contact_2');
		$email = $this->input->post('email');
		$country = $this->input->post('country');
		$address = $this->input->post('address');
		$post_code = $this->input->post('post_code');
		$department = $department = $department = ($this->input->post('department') != '' ? implode(',', $this->input->post('department')) : '');
		$position = $this->input->post('position');
		$other = $this->input->post('other');

		$nest_card_id = $this->input->post('nest_card_id');

		$document_1 = $this->input->post('document_1');
		$reference_1 = $this->input->post('reference_1');
		$expiration_1 = $this->input->post('expiration_1');
		$note_1 = $this->input->post('note_1');

		$file_1 = '';
		$ext_1 = '';

		$document_2 = $this->input->post('document_2');
		$reference_2 = $this->input->post('reference_2');
		$expiration_2 = $this->input->post('expiration_2');
		$note_2 = $this->input->post('note_2');

		$file_2 = '';
		$ext_2 = '';

		$document_3 = $this->input->post('document_3');
		$reference_3 = $this->input->post('reference_3');
		$expiration_3 = $this->input->post('expiration_3');
		$note_3 = $this->input->post('note_3');

		$file_3 = '';
		$ext_3 = '';


		$document_4 = $this->input->post('document_4');
		$reference_4 = $this->input->post('reference_4');
		$expiration_4 = $this->input->post('expiration_4');
		$note_4 = $this->input->post('note_4');

		$file_4 = '';
		$ext_4 = '';




		$status = ($this->input->post('status') == '' ? 1 : $this->input->post('status'));


		$add_sql_image = '';


		//upload config
		$config = $this->upload_config();


		if (!file_exists(set_realpath('uploads/user_'.$user_id.'/staff/original'))) {
			mkdir(set_realpath('uploads/user_'.$user_id.'/staff/original'), '0755', true);
			copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/staff/original/index.html'));
		}

		$config['upload_path'] = set_realpath('uploads/user_'.$user_id.'/staff/original');


		if(isset($_FILES['photo']['name']) AND $_FILES['photo']['name'] != '') {

			$this->load->library('upload', $config);
			$this->upload->initialize($config);


			if (!$this->upload->do_upload('photo')) {
				$validation_errors = array('photo' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}


			$photo_arr = $this->upload->data();

			$image = $photo_arr['file_name'];

			$add_sql_image = "`photo` =  '".$image."',";

		}

		if(isset($image) && $image != '') {

			if (!file_exists(set_realpath('uploads/user_'.$user_id.'/staff/thumbs'))) {
				mkdir(set_realpath('uploads/user_'.$user_id.'/staff/thumbs'), '0755', true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/staff/thumbs/index.html'));
			}


			$config_r = array(
				'image_library' => 'gd2',
				'source_image' => set_realpath('uploads/user_'.$user_id.'/staff/original').$image,
				'new_image' => set_realpath('uploads/user_'.$user_id.'/staff/thumbs').$image,
				'maintain_ratio' => TRUE,
				'create_thumb' => TRUE,
				'thumb_marker' => '',
				'height' => 50
			);

			$this->image_lib->initialize($config_r);
			$this->image_lib->resize();

			// end resize

			if (!$this->image_lib->resize()) {
				$validation_errors = array('photo' => $this->image_lib->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}

		}


		//file config
		$config_f['upload_path'] = set_realpath('uploads/user_'.$user_id.'/staff/files');
		$config_f['allowed_types'] = 'pdf|jpg|png|doc|docx|csv|xlsx';
		$config_f['max_size'] = '4097152'; //4 MB
		$config_f['file_name'] = $this->uname(3, 8);

		if(isset($_FILES['file_1']['name']) AND $_FILES['file_1']['name'] != '') {


			if (!file_exists(set_realpath('uploads/user_'.$user_id.'/staff/files'))) {
				mkdir(set_realpath('uploads/user_'.$user_id.'/staff/files'), '0755', true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/staff/files/index.html'));
			}



			$this->load->library('upload', $config_f);
			$this->upload->initialize($config_f);

			if (!$this->upload->do_upload('file_1')) {
				$validation_errors = array('file_1' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}


			$file_1_arr = $this->upload->data();

			$file_1 = $file_1_arr['file_name'];

			$file_1_array = explode('.', $file_1);

			$file_1 = $file_1_array[0];
			$ext_1 = $file_1_array[1];



		}



		if(isset($_FILES['file_2']['name']) AND $_FILES['file_2']['name'] != '') {


			if (!file_exists(set_realpath('uploads/user_'.$user_id.'/staff/files'))) {
				mkdir(set_realpath('uploads/user_'.$user_id.'/staff/files'), '0755', true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/staff/files/index.html'));
			}



			$this->load->library('upload', $config_f);
			$this->upload->initialize($config_f);



			if (!$this->upload->do_upload('file_2')) {
				$validation_errors = array('file_2' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}


			$file_2_arr = $this->upload->data();

			$file_2 = $file_2_arr['file_name'];

			$file_2_array = explode('.', $file_2);

			$file_2 = $file_2_array[0];
			$ext_2 = $file_2_array[1];



		}


		if(isset($_FILES['file_3']['name']) AND $_FILES['file_3']['name'] != '') {


			if (!file_exists(set_realpath('uploads/user_'.$user_id.'/staff/files'))) {
				mkdir(set_realpath('uploads/user_'.$user_id.'/staff/files'), '0755', true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/staff/files/index.html'));
			}



			$this->load->library('upload', $config_f);
			$this->upload->initialize($config_f);

			if (!$this->upload->do_upload('file_3')) {
				$validation_errors = array('file_3' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}


			$file_3_arr = $this->upload->data();

			$file_3 = $file_3_arr['file_name'];

			$file_3_array = explode('.', $file_3);

			$file_3 = $file_3_array[0];
			$ext_3 = $file_3_array[1];



		}


		if(isset($_FILES['file_4']['name']) AND $_FILES['file_4']['name'] != '') {


			if (!file_exists(set_realpath('uploads/user_'.$user_id.'/staff/files'))) {
				mkdir(set_realpath('uploads/user_'.$user_id.'/staff/files'), '0755', true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/staff/files/index.html'));
			}



			$this->load->library('upload', $config_f);
			$this->upload->initialize($config_f);

			if (!$this->upload->do_upload('file_4')) {
				$validation_errors = array('file_4' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}


			$file_4_arr = $this->upload->data();

			$file_4 = $file_4_arr['file_name'];

			$file_4_array = explode('.', $file_4);

			$file_4 = $file_4_array[0];
			$ext_4 = $file_4_array[1];



		}

			$sql = "
				INSERT INTO 
				  `staff` 
				SET
				  ".$add_sql_image."
				  `first_name` = ".$this->load->db_value($firstname).",
				  `last_name` = ".$this->load->db_value($lastname).",
				  `contact_1` = ".$this->load->db_value($contact_1).",
				  `contact_2` = ".$this->load->db_value($contact_2).",
				  `email` = ".$this->load->db_value($email).",
				  `country_id` = ".$this->load->db_value($country).",
				  `address` = ".$this->load->db_value($address).",
				  `post_code` = ".$this->load->db_value($post_code).",
				  `department_ids` = ".$this->load->db_value($department).",
				  `position` = ".$this->load->db_value($position).",
				  `nest_card_id` = ".$this->load->db_value($nest_card_id).",
				  `other` = ".$this->load->db_value($other).",
				  `registrar_user_id` = ".$this->load->db_value($user_id).",
				  `registration_date` = NOW(),
				  `status` = ".$this->load->db_value($status).",
				  `document_1` = ".$this->load->db_value($document_1).",
				  `reference_1` = ".$this->load->db_value($reference_1).",
				  `expiration_1` = ".$this->load->db_value($expiration_1).",
				  `note_1` = ".$this->load->db_value($note_1).",
				  `file_1` = ".$this->load->db_value($file_1).",
				  `ext_1` = ".$this->load->db_value($ext_1).",
				  `document_2` = ".$this->load->db_value($document_2).",
				  `reference_2` = ".$this->load->db_value($reference_2).",
				  `expiration_2` = ".$this->load->db_value($expiration_2).",
				  `note_2` = ".$this->load->db_value($note_2).",
				  `file_2` = ".$this->load->db_value($file_2).",
				  `ext_2` = ".$this->load->db_value($ext_2).",
				  `document_3` = ".$this->load->db_value($document_3).",
				  `reference_3` = ".$this->load->db_value($reference_3).",
				  `expiration_3` = ".$this->load->db_value($expiration_3).",
				  `note_3` = ".$this->load->db_value($note_3).",
				  `file_3` = ".$this->load->db_value($file_3).",
				  `ext_3` = ".$this->load->db_value($ext_3).",
				  `document_4` = ".$this->load->db_value($document_4).",
				  `reference_4` = ".$this->load->db_value($reference_4).",
				  `expiration_4` = ".$this->load->db_value($expiration_4).",
				  `note_4` = ".$this->load->db_value($note_4).",
				  `file_4` = ".$this->load->db_value($file_4).",
				  `ext_4` = ".$this->load->db_value($ext_4)."
				 
			";


			$result = $this->db->query($sql);




		if ($result){
			$messages['success'] = 1;
			$messages['message'] = 'Success';
		} else {
			$messages['success'] = 0;
			$messages['error'] = 'Error';
		}

		// Return success or error message
		echo json_encode($messages);
		return true;
	}



	public function add_department_ax() {

		$this->load->authorisation('Organization', 'department');

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
		$this->form_validation->set_rules('head_staff', 'head_staff', 'required');





		if($this->form_validation->run() == false){
			//validation errors
			$n = 1;

			$validation_errors = array(
				'title' => form_error('title'),
				'head_staff' => form_error('head_staff'),
			);
			$messages['error']['elements'][] = $validation_errors;
		}


		if($n == 1) {
			echo json_encode($messages);
			return false;
		}


		$row = $this->db->select('company_id')->from('user')->where('id', $user_id)->get()->row_array();
		$company_id = $row['company_id'];




		$title = $this->input->post('title');
		$head_staff = $this->input->post('head_staff');
		$description = $this->input->post('description');
		$status = 1;




		$sql = "
				INSERT INTO 
				  `department`
				SET
				  `title` = ".$this->load->db_value($title).",
				  `registrar_user_id` = ".$this->load->db_value($user_id).",
				  `registration_date` = NOW(),
				  `company_id` = ".$this->load->db_value($company_id).",
				  `head_staff_id` = ".$this->load->db_value($head_staff).",
				  `description` = ".$this->load->db_value($description).",
				  `status` = ".$this->load->db_value($status)."
			";


		$result = $this->db->query($sql);

		$department_id = $this->db->insert_id();

		$sql_head_staff_select = "SELECT `id` FROM `staff` WHERE FIND_IN_SET('".$department_id."', `department_ids`)";

		$query_head_staff_select = $this->db->query($sql_head_staff_select);
		$num_rows = $query_head_staff_select->num_rows();

		if($num_rows == 0) {
			$sql_head_staff = "
				UPDATE `staff` SET `department_ids` = CONCAT_WS(',', `department_ids`, '".$department_id."') WHERE `id` = '".$head_staff."'
			";

			$result_head_staff  = $this->db->query($sql_head_staff);
		}




		if ($result){
			$messages['success'] = 1;
			$messages['message'] = 'Success';
		} else {
			$messages['success'] = 0;
			$messages['error'] = 'Error';
		}

		// Return success or error message
		echo json_encode($messages);
		return true;
	}


	public function edit_department_modal_ax() {

		$id = $this->uri->segment(3);
		$this->load->helper('url');
		$this->load->helper('form');
		$lng = $this->load->lng();

		if($id == NULL) {
			$message = 'Undifined ID';
			show_error($message, '404', $heading = '404 Page Not Found');
			return false;
		}


		$sql = "SELECT
                  `id`,
				  `company_id`,
				  `title`,
				  `description`,
				  `registration_date`,
				  `registrar_user_id`,
				  `head_staff_id`,
				  `status`
                FROM 
                   `department`
                WHERE `id` =  ".$this->load->db_value($id)."
                LIMIT 1";

		$query = $this->db->query($sql);
		$row = $query->row_array();


		$data['staff_for_select'] = $this->db->select('staff.id, CONCAT_WS(" ", staff.first_name, staff.last_name) AS name, staff.status')
			->from('staff')
			->join('user', 'staff.registrar_user_id = user.id', 'left')
			->where('user.company_id', $row['company_id'])
			->where('staff.status', 1)
			->get()
			->result_array();



		$data['id'] = $row['id'];
		$data['company_id'] = $row['company_id'];
		$data['title'] = $row['title'];
		$data['description'] = $row['description'];
		$data['head_staff_id'] = $row['head_staff_id'];



		$this->load->view('organization/edit_department', $data);

	}



	public function edit_department_ax() {

		$this->load->authorisation('Organization', 'department');

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
		$this->form_validation->set_rules('head_staff', 'head_staff', 'required');





		if($this->form_validation->run() == false){
			//validation errors
			$n = 1;

			$validation_errors = array(
				'title' => form_error('title'),
				'head_staff' => form_error('head_staff'),
			);
			$messages['error']['elements'][] = $validation_errors;
		}


		if($n == 1) {
			echo json_encode($messages);
			return false;
		}


//		$row = $this->db->select('company_id')->from('user')->where('id', $user_id)->get()->row_array();
//		$company_id = $row['company_id'];




		$id = $this->input->post('department_id');
		$title = $this->input->post('title');
		$head_staff = $this->input->post('head_staff');
		$description = $this->input->post('description');
		$status = 1;




		$sql = "
				UPDATE 
				  `department`
				SET
				  `title` = ".$this->load->db_value($title).",
				  `head_staff_id` = ".$this->load->db_value($head_staff).",
				  `description` = ".$this->load->db_value($description).",
				  `status` = ".$this->load->db_value($status)."
				WHERE `id` =   ".$this->load->db_value($id)."
			";


		$result = $this->db->query($sql);


		$sql_head_staff_select = "SELECT `id` FROM `staff` WHERE FIND_IN_SET('".$id."', `department_ids`) AND `id` = '".$head_staff."'";

		$query_head_staff_select = $this->db->query($sql_head_staff_select);
		$num_rows = $query_head_staff_select->num_rows();

		if($num_rows == 0) {
			 $sql_head_staff = "
				UPDATE `staff` SET `department_ids` = CONCAT_WS(',', `department_ids`, '".$id."') WHERE `id` = '".$head_staff."'
			";

			$result_head_staff  = $this->db->query($sql_head_staff);
		}







		if ($result){
			$messages['success'] = 1;
			$messages['message'] = 'Success';
		} else {
			$messages['success'] = 0;
			$messages['error'] = 'Error';
		}

		// Return success or error message
		echo json_encode($messages);
		return true;
	}

	public function delete_department() {

		$this->load->authorisation('Organization', 'department');

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}

		$id = $this->input->post('department_id');


		$this->db->delete('department', array('id' => $id));

		return true;

	}




	public function edit_staff_modal_ax() {

		$id = $this->uri->segment(4);
		$this->load->helper('url');
		$this->load->helper('form');
		$lng = $this->load->lng();
		$data = array();
		$user_id = $this->session->user_id;

		if($id == NULL) {
			$message = 'Undifined ID';
			show_error($message, '404', $heading = '404 Page Not Found');
			return false;
		}




		$row = $this->db->select('company_id')->from('user')->where('id', $user_id)->get()->row_array();
		$company_id = $row['company_id'];

		$sql_country = "
		    SELECT 
              `id`,
              `title_".$lng."` AS `title`,
              `status` 
            FROM
              `country` 
            WHERE `status` = '1' 
            ORDER BY `title_".$lng."` 
		";

		$query_country = $this->db->query($sql_country);
		$data['country'] = $query_country->result_array();


		$sql_department = "
		    SELECT 
              `id`,
              `title`,
              `status` 
            FROM
              `department` 
            WHERE `status` = '1' 
             AND `company_id` = '".$company_id."'
             ORDER BY `title` 
		";

		$query_department = $this->db->query($sql_department);
		$data['department'] = $query_department->result_array();


		$sql = "SELECT
                  `id`,
				  `photo`,
				  `first_name`,
				  `last_name`,
				  `contact_1`,
				  `contact_2`,
				  `email`,
				  `country_id`,
				  `address`,
				  `post_code`,
				  `department_ids`,
				  `position`,
				  `nest_card_id`,
				  `other`,
				  `registrar_user_id`,
				  `registration_date`,
				  `status`,
				  `document_1`,
				  `reference_1`,
				  `expiration_1`,
				  `note_1`,
				  `file_1`,
				  `ext_1`,
				  `document_2`,
				  `reference_2`,
				  `expiration_2`,
				  `note_2`,
				  `file_2`,
				  `ext_2`,
				  `document_3`,
				  `reference_3`,
				  `expiration_3`,
				  `note_3`,
				  `file_3`,
				  `ext_3`,
				  `document_4`,
				  `reference_4`,
				  `expiration_4`,
				  `note_4`,
				  `file_4`,
				  `ext_4`
                FROM 
                   `staff`
                WHERE `id` =  ".$this->load->db_value($id)."
                LIMIT 1";

		$query = $this->db->query($sql);
		$row = $query->row_array();

		$data['id'] = $row['id'];
		$data['photo'] = $row['photo'];
		$data['first_name'] = $row['first_name'];
		$data['last_name'] = $row['last_name'];
		$data['contact_1'] = $row['contact_1'];
		$data['contact_2'] = $row['contact_2'];
		$data['email'] = $row['email'];
		$data['country_id'] = $row['country_id'];
		$data['address'] = $row['address'];
		$data['post_code'] = $row['post_code'];
		$data['department_id'] = explode(',', $row['department_ids']);
		$data['position'] = $row['position'];
		$data['nest_card_id'] = $row['nest_card_id'];
		$data['other'] = $row['other'];
		$data['registrar_user_id'] = $row['registrar_user_id'];
		$data['registration_date'] = $row['registration_date'];
		$data['status'] = $row['status'];
		$data['document_1'] = $row['document_1'];
		$data['reference_1'] = $row['reference_1'];
		$data['expiration_1'] = $row['expiration_1'];
		$data['note_1'] = $row['note_1'];
		$data['file_1'] = $row['file_1'];
		$data['ext_1'] = $row['ext_1'];
		$data['document_2'] = $row['document_2'];
		$data['reference_2'] = $row['reference_2'];
		$data['expiration_2'] = $row['expiration_2'];
		$data['note_2'] = $row['note_2'];
		$data['file_2'] = $row['file_2'];
		$data['ext_2'] = $row['ext_2'];
		$data['document_3'] = $row['document_3'];
		$data['reference_3'] = $row['reference_3'];
		$data['expiration_3'] = $row['expiration_3'];
		$data['note_3'] = $row['note_3'];
		$data['file_3'] = $row['file_3'];
		$data['ext_3'] = $row['ext_3'];
		$data['document_4'] = $row['document_4'];
		$data['reference_4'] = $row['reference_4'];
		$data['expiration_4'] = $row['expiration_4'];
		$data['note_4'] = $row['note_4'];
		$data['file_4'] = $row['file_4'];
		$data['ext_4'] = $row['ext_4'];



		$this->load->view('organization/edit_staff', $data);

	}



	public function edit_staff_ax() {

		$this->load->authorisation('Organization', 'staff');

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
		$this->form_validation->set_rules('firstname', 'firstname', 'required');
		$this->form_validation->set_rules('lastname', 'lastname', 'required');
		$this->form_validation->set_rules('email', 'email', 'valid_email');





		if($this->form_validation->run() == false){
			//validation errors
			$n = 1;

			$validation_errors = array(
				'firstname' => form_error('firstname'),
				'lastname' => form_error('lastname'),
				'email' => form_error('email'),
			);
			$messages['error']['elements'][] = $validation_errors;
		}


		if($n == 1) {
			echo json_encode($messages);
			return false;
		}




		$id = $this->input->post('staff_id');

		$firstname = $this->input->post('firstname');
		$lastname = $this->input->post('lastname');
		$contact_1 = $this->input->post('contact_1');
		$contact_2 = $this->input->post('contact_2');
		$email = $this->input->post('email');
		$country = $this->input->post('country');
		$address = $this->input->post('address');
		$post_code = $this->input->post('post_code');
		$department = $this->input->post('department');
		$position = $this->input->post('position');
		$other = $this->input->post('other');

		$nest_card_id = $this->input->post('nest_card_id');

		$document_1 = $this->input->post('document_1');
		$reference_1 = $this->input->post('reference_1');
		$expiration_1 = $this->input->post('expiration_1');
		$note_1 = $this->input->post('note_1');

		$file_1 = '';
		$ext_1 = '';

		$document_2 = $this->input->post('document_2');
		$reference_2 = $this->input->post('reference_2');
		$expiration_2 = $this->input->post('expiration_2');
		$note_2 = $this->input->post('note_2');

		$file_2 = '';
		$ext_2 = '';

		$document_3 = $this->input->post('document_3');
		$reference_3 = $this->input->post('reference_3');
		$expiration_3 = $this->input->post('expiration_3');
		$note_3 = $this->input->post('note_3');

		$file_3 = '';
		$ext_3 = '';


		$document_4 = $this->input->post('document_4');
		$reference_4 = $this->input->post('reference_4');
		$expiration_4 = $this->input->post('expiration_4');
		$note_4 = $this->input->post('note_4');

		$file_4 = '';
		$ext_4 = '';




		$status = ($this->input->post('status') == '' ? 1 : $this->input->post('status'));


		$add_sql_image = '';


		 $department = $department = ($this->input->post('department') != '' ? implode(',', $this->input->post('department')) : '');


		//upload config
		$config = $this->upload_config();


		if (!file_exists(set_realpath('uploads/user_'.$user_id.'/staff/original'))) {
			mkdir(set_realpath('uploads/user_'.$user_id.'/staff/original'), '0755', true);
			copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/staff/original/index.html'));
		}

		$config['upload_path'] = set_realpath('uploads/user_'.$user_id.'/staff/original');


		if(isset($_FILES['photo']['name']) AND $_FILES['photo']['name'] != '') {

			$this->load->library('upload', $config);
			$this->upload->initialize($config);


			if (!$this->upload->do_upload('photo')) {
				$validation_errors = array('photo' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}


			$photo_arr = $this->upload->data();

			$image = $photo_arr['file_name'];

			$add_sql_image = "`photo` =  '".$image."',";

		}

		if(isset($image) && $image != '') {

			if (!file_exists(set_realpath('uploads/user_'.$user_id.'/staff/thumbs'))) {
				mkdir(set_realpath('uploads/user_'.$user_id.'/staff/thumbs'), '0755', true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/staff/thumbs/index.html'));
			}


			$config_r = array(
				'image_library' => 'gd2',
				'source_image' => set_realpath('uploads/user_'.$user_id.'/staff/original').$image,
				'new_image' => set_realpath('uploads/user_'.$user_id.'/staff/thumbs').$image,
				'maintain_ratio' => TRUE,
				'create_thumb' => TRUE,
				'thumb_marker' => '',
				'height' => 50
			);

			$this->load->library('image_lib');
			$this->image_lib->initialize($config_r);
			$this->image_lib->resize();

			// end resize

			if (!$this->image_lib->resize()) {
				$validation_errors = array('photo' => $this->image_lib->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}

		}


		//file config
		$config_f['upload_path'] = set_realpath('uploads/user_'.$user_id.'/staff/files');
		$config_f['allowed_types'] = 'pdf|jpg|png|doc|docx|csv|xlsx';
		$config_f['max_size'] = '4097152'; //4 MB
		$config_f['file_name'] = $this->uname(3, 8);

		if(isset($_FILES['file_1']['name']) AND $_FILES['file_1']['name'] != '') {


			if (!file_exists(set_realpath('uploads/user_'.$user_id.'/staff/files'))) {
				mkdir(set_realpath('uploads/user_'.$user_id.'/staff/files'), '0755', true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/staff/files/index.html'));
			}



			$this->load->library('upload', $config_f);
			$this->upload->initialize($config_f);

			if (!$this->upload->do_upload('file_1')) {
				$validation_errors = array('file_1' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}


			$file_1_arr = $this->upload->data();

			$file_1 = $file_1_arr['file_name'];

			$file_1_array = explode('.', $file_1);

			$file_1 = "`file_1` = ".$this->load->db_value($file_1_array[0]).",";
			$ext_1 = "`ext_1` = ".$this->load->db_value($file_1_array[1]).",";





		}



		if(isset($_FILES['file_2']['name']) AND $_FILES['file_2']['name'] != '') {


			if (!file_exists(set_realpath('uploads/user_'.$user_id.'/staff/files'))) {
				mkdir(set_realpath('uploads/user_'.$user_id.'/staff/files'), '0755', true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/staff/files/index.html'));
			}



			$this->load->library('upload', $config_f);
			$this->upload->initialize($config_f);



			if (!$this->upload->do_upload('file_2')) {
				$validation_errors = array('file_2' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}


			$file_2_arr = $this->upload->data();

			$file_2 = $file_2_arr['file_name'];

			$file_2_array = explode('.', $file_2);



			$file_2 = "`file_2` = ".$this->load->db_value($file_2_array[0]).",";
			$ext_2 = "`ext_2` = ".$this->load->db_value($file_2_array[1]).",";







		}


		if(isset($_FILES['file_3']['name']) AND $_FILES['file_3']['name'] != '') {


			if (!file_exists(set_realpath('uploads/user_'.$user_id.'/staff/files'))) {
				mkdir(set_realpath('uploads/user_'.$user_id.'/staff/files'), '0755', true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/staff/files/index.html'));
			}



			$this->load->library('upload', $config_f);
			$this->upload->initialize($config_f);

			if (!$this->upload->do_upload('file_3')) {
				$validation_errors = array('file_3' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}


			$file_3_arr = $this->upload->data();

			$file_3 = $file_3_arr['file_name'];

			$file_3_array = explode('.', $file_3);

			$file_3 = "`file_3` = ".$this->load->db_value($file_3_array[0]).",";
			$ext_3 = "`ext_3` = ".$this->load->db_value($file_3_array[1]).",";



		}


		if(isset($_FILES['file_4']['name']) AND $_FILES['file_4']['name'] != '') {


			if (!file_exists(set_realpath('uploads/user_'.$user_id.'/staff/files'))) {
				mkdir(set_realpath('uploads/user_'.$user_id.'/staff/files'), '0755', true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/staff/files/index.html'));
			}



			$this->load->library('upload', $config_f);
			$this->upload->initialize($config_f);

			if (!$this->upload->do_upload('file_4')) {
				$validation_errors = array('file_4' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}


			$file_4_arr = $this->upload->data();

			$file_4 = $file_4_arr['file_name'];

			$file_4_array = explode('.', $file_4);

			$file_4 = "`file_4` = ".$this->load->db_value($file_4_array[0]).",";
			$ext_4 = "`ext_4` = ".$this->load->db_value($file_4_array[1]).",";



		}

		$sql = "
				UPDATE 
				  `staff` 
				SET
				  ".$add_sql_image."
				  `first_name` = ".$this->load->db_value($firstname).",
				  `last_name` = ".$this->load->db_value($lastname).",
				  `contact_1` = ".$this->load->db_value($contact_1).",
				  `contact_2` = ".$this->load->db_value($contact_2).",
				  `email` = ".$this->load->db_value($email).",
				  `country_id` = ".$this->load->db_value($country).",
				  `address` = ".$this->load->db_value($address).",
				  `post_code` = ".$this->load->db_value($post_code).",
				  `department_ids` = ".$this->load->db_value($department).",
				  `position` = ".$this->load->db_value($position).",
				  `nest_card_id` = ".$this->load->db_value($nest_card_id).",
				  `other` = ".$this->load->db_value($other).",
				  `status` = ".$this->load->db_value($status).",
				  `document_1` = ".$this->load->db_value($document_1).",
				  `reference_1` = ".$this->load->db_value($reference_1).",
				  `expiration_1` = ".$this->load->db_value($expiration_1).",
				  `note_1` = ".$this->load->db_value($note_1).",
				  ".$file_1."
				  ".$ext_1."
				  `document_2` = ".$this->load->db_value($document_2).",
				  `reference_2` = ".$this->load->db_value($reference_2).",
				  `expiration_2` = ".$this->load->db_value($expiration_2).",
				  `note_2` = ".$this->load->db_value($note_2).",
				   ".$file_2."
				   ".$ext_2."
				  `document_3` = ".$this->load->db_value($document_3).",
				  `reference_3` = ".$this->load->db_value($reference_3).",
				  `expiration_3` = ".$this->load->db_value($expiration_3).",
				  `note_3` = ".$this->load->db_value($note_3).",
				   ".$file_3."
				   ".$ext_3."
				  `document_4` = ".$this->load->db_value($document_4).",
				  `reference_4` = ".$this->load->db_value($reference_4).",
				  `expiration_4` = ".$this->load->db_value($expiration_4).",
				  ".$file_4."
				  ".$ext_4."
				  `note_4` = ".$this->load->db_value($note_4)."
				WHERE `id` = ".$this->load->db_value($id)."
			";


		$result = $this->db->query($sql);



		if ($result){
			$messages['success'] = 1;
			$messages['message'] = 'Success';
		} else {
			$messages['success'] = 0;
			$messages['error'] = 'Error';
		}

		// Return success or error message
		echo json_encode($messages);
		return true;
	}

	public function delete_staff() {

		$this->load->authorisation('Organization', 'staff');

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}

		$id = $this->input->post('staff_id');


		$this->db->delete('staff', array('id' => $id));

		return true;

	}


	public function add_vehicles() {

		$this->load->authorisation();
		$this->load->helper('url');
		$this->load->library('session');
		$user_id = $this->session->user_id;
		$data = array();

		$lng = $this->load->lng();
		$data['lang'] = $lng;


		$row = $this->db->select('company_id')->from('user')->where('id', $user_id)->get()->row_array();
		$company_id = $row['company_id'];

		$data['staff_for_select'] = $this->db->select('staff.id, CONCAT_WS(" ", staff.first_name, staff.last_name) AS name, staff.status')
			->from('staff')
			->join('user', 'staff.registrar_user_id = user.id', 'left')
			->join('department', 'FIND_IN_SET(department.id, staff.department_ids)', 'left')
			->where('user.company_id', $company_id)
			->where('department.head_staff_id <> ', 'staff.id', FALSE)
			->where('staff.status', 1)
			->get()
			->result_array();


		$sql_brand = "
			SELECT 
				`id`,
				`title_".$lng."` AS `title`
			  FROM
			    `brand`
			WHERE `status` = '1'	
		";

		$result_brand = $this->db->query($sql_brand);

		$data['brand'] = $result_brand->result_array();


		$sql_fleet_type = "
			SELECT 
				`id`,
				`title_".$lng."` AS `title`
			  FROM
			    `fleet_type`
			WHERE `status` = '1'	
		";

		$result_fleet_type = $this->db->query($sql_fleet_type);

		$data['fleet_type'] = $result_fleet_type->result_array();

		$sql_fuel = "
			SELECT 
				`id`,
				`title_".$lng."` AS `title`
			  FROM
			    `fuel`
			WHERE `status` = '1'	
		";

		$result_fuel = $this->db->query($sql_fuel);

		$data['fuel'] = $result_fuel->result_array();


		$sql_insurance = "
			SELECT
				`id`,
				`title_".$lng."` AS `title`
			 FROM
				`insurance_type`
			WHERE `status` = 1	
		";

		$result_insurance = $this->db->query($sql_insurance);


		$data['insurance_type'] = $result_insurance->result_array();


		$sql_value = "
			SELECT
				`id`,
				`title_".$lng."` AS `title`,
				`type`,
				`convert`
			 FROM
				`value`
			WHERE `status` = 1	
		";

		$result_value = $this->db->query($sql_value);

		$data['value'] = $result_value->result_array();



		$this->layout->view('organization/add_vehicles', $data);

	}


	public function add_vehicles_ax() {

		$this->load->authorisation('Organization', 'add_vehicles');

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
		$this->form_validation->set_rules('staff[]', 'staff', 'required');
		$this->form_validation->set_rules('brand', 'brand', 'required');
		$this->form_validation->set_rules('model', 'model', 'required');
		$this->form_validation->set_rules('fleet_type', 'fleet_type', 'required');
		$this->form_validation->set_rules('fleet_plate_number', 'fleet_plate_number', 'required');
		$this->form_validation->set_rules('production_date', 'production_date', 'required');






		if($this->form_validation->run() == false){
			//validation errors
			$n = 1;

			$validation_errors = array(
				'staff[]' => form_error('staff[]'),
				'brand' => form_error('brand'),
				'model' => form_error('model'),
				'fleet_type' => form_error('fleet_type'),
				'fleet_plate_number' => form_error('fleet_plate_number'),
				'production_date' => form_error('production_date'),

			);
			$messages['error']['elements'][] = $validation_errors;
		}


		$staff = $this->input->post('staff');
		if($staff != '') {
			$staff = implode(',', $this->input->post('staff'));
		}
		$brand = $this->input->post('brand');
		$model = $this->input->post('model');
		$fleet_type = $this->input->post('fleet_type');
		$fleet_plate_number = $this->input->post('fleet_plate_number');
		$production_date = $this->input->post('production_date');
		$color = $this->input->post('color');
		$vin = $this->input->post('vin');
		$engine_power = str_replace(",", ".", $this->input->post('engine_power'));
		$fuel = $this->input->post('fuel');
		$fuel_avg_consumption = str_replace(",", ".", $this->input->post('fuel_avg_consumption'));
		$mileage = $this->input->post('mileage');
		$odometer = $this->input->post('odometer');
		$other = $this->input->post('other');
		$status = ($this->input->post('status') == '' ? 1 : $this->input->post('status'));


		//info

		$owner_staff_id = $this->input->post('owner_id');
		$owner = $this->input->post('owner');

		$regitered_address = $this->input->post('regitered_address');
		$regitered_number = $this->input->post('regitered_number');
		$regitered_file = '';

		$value_1 = $this->input->post('value_1');
		$value1_day = str_replace(",", ".", $this->input->post('value1_day'));
		$auto_increment = ($this->input->post('auto_increment') != '' ? $this->input->post('auto_increment') : '-1');
		$use_of_secondary_meter = $this->input->post('use_of_secondary_meter');
		$value_2 = '';
		$value2_day = '';
		$convert = $this->input->post('convert');

		if($use_of_secondary_meter == 1) {
			$value_2 = $this->input->post('value_2');
			if($value_2 != '') {
				$value2_day = ($value1_day * $convert[$value_2]);
			}

		}



		//file config
		$config_f['upload_path'] = set_realpath('uploads/user_'.$user_id.'/fleet/regitered_file');
		$config_f['allowed_types'] = 'pdf|jpg|png|doc|docx|csv|xlsx';
		$config_f['max_size'] = '4097152'; //4 MB
		$config_f['file_name'] = $this->uname(3, 8);


		if(isset($_FILES['regitered_file']['name']) AND $_FILES['regitered_file']['name'] != '') {


			if (!file_exists(set_realpath('uploads/user_'.$user_id.'/fleet/regitered_file'))) {
				mkdir(set_realpath('uploads/user_'.$user_id.'/fleet/regitered_file'), '0755', true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/fleet/regitered_file/index.html'));
			}



			$this->load->library('upload', $config_f);
			$this->upload->initialize($config_f);

			if (!$this->upload->do_upload('regitered_file')) {
				$validation_errors = array('regitered_file' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}


			$regitered_file_arr = $this->upload->data();

			$regitered_file = $regitered_file_arr['file_name'];

		}



		$company = $this->input->post('company');
		//$file = $this->input->post('file');
		$reference = $this->input->post('reference');
		$expiration = $this->input->post('expiration');
		$type = $this->input->post('type');

		//file config insurance
		$config_f_i['upload_path'] = set_realpath('uploads/user_'.$user_id.'/fleet/insurance');
		$config_f_i['allowed_types'] = 'pdf|jpg|png|doc|docx|csv|xlsx';
		$config_f_i['max_size'] = '4097152'; //4 MB
		$config_f_i['file_name'] = $this->uname(3, 8);


		$file_1 = '';
		$ext_1 = '';
		if(isset($_FILES['file_1']['name']) AND $_FILES['file_1']['name'] != '') {


			if (!file_exists(set_realpath('uploads/user_'.$user_id.'/fleet/insurance'))) {
				mkdir(set_realpath('uploads/user_'.$user_id.'/fleet/insurance'), '0755', true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/fleet/insurance/index.html'));
			}



			$this->load->library('upload', $config_f_i);
			$this->upload->initialize($config_f_i);

			if (!$this->upload->do_upload('file_1')) {
				$validation_errors = array('file_1' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}


			$file_1_arr = $this->upload->data();

			$file_1 = $file_1_arr['file_name'];

			$file_1_array = explode('.', $file_1);

			$file_1 = $file_1_array[0];
			$ext_1 = $file_1_array[1];


		}


		$file_2 = '';
		$ext_2 = '';
		if(isset($_FILES['file_2']['name']) AND $_FILES['file_2']['name'] != '') {


			if (!file_exists(set_realpath('uploads/user_'.$user_id.'/fleet/insurance'))) {
				mkdir(set_realpath('uploads/user_'.$user_id.'/fleet/insurance'), '0755', true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/fleet/insurance/index.html'));
			}



			$this->load->library('upload', $config_f_i);
			$this->upload->initialize($config_f_i);

			if (!$this->upload->do_upload('file_2')) {
				$validation_errors = array('file_2' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}



			$file_2_arr = $this->upload->data();

			$file_2 = $file_2_arr['file_name'];

			$file_2_array = explode('.', $file_2);

			$file_2 = $file_2_array[0];
			$ext_2 = $file_2_array[1];


		}


		$file_3 = '';
		$ext_3 = '';
		if(isset($_FILES['file_3']['name']) AND $_FILES['file_3']['name'] != '') {


			if (!file_exists(set_realpath('uploads/user_'.$user_id.'/fleet/insurance'))) {
				mkdir(set_realpath('uploads/user_'.$user_id.'/fleet/insurance'), '0755', true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/fleet/insurance/index.html'));
			}



			$this->load->library('upload', $config_f_i);
			$this->upload->initialize($config_f_i);

			if (!$this->upload->do_upload('file_3')) {
				$validation_errors = array('file_3' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}



			$file_3_arr = $this->upload->data();

			$file_3 = $file_3_arr['file_name'];

			$file_3_array = explode('.', $file_3);

			$file_3 = $file_3_array[0];
			$ext_3 = $file_3_array[1];


		}


		$file_4 = '';
		$ext_4 = '';
		if(isset($_FILES['file_4']['name']) AND $_FILES['file_4']['name'] != '') {


			if (!file_exists(set_realpath('uploads/user_'.$user_id.'/fleet/insurance'))) {
				mkdir(set_realpath('uploads/user_'.$user_id.'/fleet/insurance'), '0755', true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/fleet/insurance/index.html'));
			}



			$this->load->library('upload', $config_f_i);
			$this->upload->initialize($config_f_i);

			if (!$this->upload->do_upload('file_4')) {
				$validation_errors = array('file_4' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}


			$file_4_arr = $this->upload->data();

			$file_4 = $file_4_arr['file_name'];

			$file_4_array = explode('.', $file_4);

			$file_4 = $file_4_array[0];
			$ext_4 = $file_4_array[1];


		}




		//fleet details variables
		$item = $this->input->post('item');
		$value = $this->input->post('value');
		$avg_exploitation = str_replace(",", ".", $this->input->post('avg_exploitation'));
		$per_days = str_replace(",", ".", $this->input->post('per_days'));
		$more_info = $this->input->post('more_info');
		$remind_before = str_replace(",", ".", $this->input->post('remind_before'));
		$start_alarm_date = $this->input->post('start_alarm_date');
		// end fleet details variables

		// validation fleet details
		if(is_array($item)) :
			foreach ($item as $i => $item_val) :
				if($item_val == '') :
					$n = 1;
					$validation_errors = array('item['.$i.']' => "required");
					$messages['error']['elements'][] = $validation_errors;
				endif;

				if($per_days[$i] == '' || !is_numeric($per_days[$i])) :
					$n = 1;
					$validation_errors = array('per_days['.$i.']' => "required");
					$messages['error']['elements'][] = $validation_errors;
				endif;

				if($value[$i] == '') :
					$n = 1;
					$validation_errors = array('value['.$i.']' => "required");
					$messages['error']['elements'][] = $validation_errors;
				endif;

				if($avg_exploitation[$i] == '' || !is_numeric($avg_exploitation[$i])) :
					$n = 1;
					$validation_errors = array('avg_exploitation['.$i.']' => "required");
					$messages['error']['elements'][] = $validation_errors;
				endif;

				if($remind_before[$i] == ''  || !is_numeric(($remind_before[$i]))) :
					$n = 1;
					$validation_errors = array('remind_before['.$i.']' => "required");
					$messages['error']['elements'][] = $validation_errors;
				endif;

				if($start_alarm_date[$i] == '') :
					$n = 1;
					$validation_errors = array('start_alarm_date['.$i.']' => "required");
					$messages['error']['elements'][] = $validation_errors;
				endif;
			endforeach;
		endif;
		// end of validation fleet details





		if($n == 1) {
			echo json_encode($messages);
			return false;
		}




		if($this->input->post('mail_to') == 1) {

			$sql_for_mail = "
				SELECT 
					GROUP_CONCAT(`email` SEPARATOR ', ') AS `emails`
				FROM
					`staff`
				WHERE FIND_IN_SET(`id`, '".$staff."')		
				 LIMIT 1 
			";

			$result_for_mail = $this->db->query($sql_for_mail);

			$emails = implode(', ', $result_for_mail->row_array());

			$this->smtp_mailing();

			$this->email->to($emails);
			$this->email->subject('car added  NestGarageSystem');
			$this->email->message('
			   Fleet info...
			');

			if(!$this->email->send()) {
				$messages['success'] = 0;
				$messages['error'] = $this->email->print_debugger();
				echo json_encode($messages);
				return false;
			}
		}




		$sql = "
				INSERT INTO `fleet` SET 
					`staff_ids` = ".$this->load->db_value($staff).",
					`model_id` = ".$this->load->db_value($model).",
					`fleet_type_id` = ".$this->load->db_value($fleet_type).",
					`production_date` = ".$this->load->db_value($production_date).",
					`color` = ".$this->load->db_value($color).",
					`vin_code` = ".$this->load->db_value($vin).",
					`engine_power` = ".$this->load->db_value($engine_power).",
					`fuel_id` = ".$this->load->db_value($fuel).",
					`fuel_avg_consumption` = ".$this->load->db_value($fuel_avg_consumption).",
					`mileage` =  ".$this->load->db_value($mileage).",
					`odometer` = ".$this->load->db_value($odometer).",
					`fleet_plate_number` = ".$this->load->db_value($fleet_plate_number).",
					`other` = ".$this->load->db_value($other).",
					`registrar_user_id` = ".$this->load->db_value($user_id).",
					`registration_date` = NOW(),
					`owner_staff_id` = ".$this->load->db_value($owner_staff_id).",
					`owner` = ".$this->load->db_value($owner).",
					`value1_id` = ".$this->load->db_value($value_1).",
					`value2_id` = ".$this->load->db_value($value_2).",
					`value1_day` = ".$this->load->db_value($value1_day).",
					`value2_day` = ".$this->load->db_value($value2_day).",
					`auto_increment` = ".$this->load->db_value($auto_increment).",
					`regitered_address` = ".$this->load->db_value($regitered_address).",
					`regitered_number` = ".$this->load->db_value($regitered_number).",
					`regitered_file` = ".$this->load->db_value($regitered_file).", 
					`insurance_company_1` = ".$this->load->db_value($company[1]).",
				    `insurance_referance_1` = ".$this->load->db_value($reference[1]).",
				    `insurance_type_id_1` = ".$this->load->db_value($type[1]).",
				    `insurance_expiration_1` = ".$this->load->db_value($expiration[1]).",
				    `insurance_file_1` = ".$this->load->db_value($file_1).",
				    `insurance_ext_1` = ".$this->load->db_value($ext_1).",
				    `insurance_company_2` = ".$this->load->db_value($company[2]).",
				    `insurance_referance_2` = ".$this->load->db_value($reference[2]).",
				    `insurance_type_id_2` = ".$this->load->db_value($type[2]).",
				    `insurance_expiration_2` = ".$this->load->db_value($expiration[2]).",
				    `insurance_file_2` = ".$this->load->db_value($file_2).",
				    `insurance_ext_2` = ".$this->load->db_value($ext_2).",
				    `insurance_company_3` = ".$this->load->db_value($company[3]).",
				    `insurance_referance_3` = ".$this->load->db_value($reference[3]).",
				    `insurance_type_id_3` = ".$this->load->db_value($type[3]).",
				    `insurance_expiration_3` = ".$this->load->db_value($expiration[3]).",
				    `insurance_file_3` = ".$this->load->db_value($file_3).",
				    `insurance_ext_3` = ".$this->load->db_value($ext_3).",
				    `insurance_company_4` = ".$this->load->db_value($company[4]).",
				    `insurance_referance_4` = ".$this->load->db_value($reference[4]).",
				    `insurance_type_id_4` = ".$this->load->db_value($type[4]).",
				    `insurance_expiration_4` = ".$this->load->db_value($expiration[4]).",
				    `insurance_file_4` = ".$this->load->db_value($file_4).",
				    `insurance_ext_4` = ".$this->load->db_value($ext_4).",
					`status` = ".$this->load->db_value($status)."
			";


		$result = $this->db->query($sql);
		$fleet_id = $this->db->insert_id();




		$sql_fleet_details = "
			INSERT INTO `fleet_details`
				(`items`,
				 `value_id`,
				 `avg_exploitation`,
				 `start_alarm_date`,
				 `per_days`,
				 `more_info`,
				 `reminde_me`,
				 `fleet_id`,
				 `next_alarm_date`,
				 `registrar_user_id`,
				 `registration_date`,
				 `status`)
			VALUES
		";



		if(is_array($item)) :
			foreach ($item as $i => $item_val) :
				if($item_val != '') :

				$sub_days[$i] = round((($avg_exploitation[$i]/$per_days[$i]) - $remind_before[$i]),0,PHP_ROUND_HALF_ODD);

				$next_alarm_date[$i] = strtotime ( $sub_days[$i].' day' , strtotime ( $start_alarm_date[$i] ) ) ;
				$next_alarm_date[$i] = date ( 'Y-m-d' , $next_alarm_date[$i] );

				$sql_fleet_details .= "(
					".$this->load->db_value($item_val).",
					".$this->load->db_value($value[$i]).",
					".$this->load->db_value($avg_exploitation[$i]).",
					".$this->load->db_value($start_alarm_date[$i]).",
					".$this->load->db_value($per_days[$i]).",
					".$this->load->db_value($more_info[$i]).",
					".$this->load->db_value($remind_before[$i]).",
					".$this->load->db_value($fleet_id).",
					".$this->load->db_value($next_alarm_date[$i]).",
					".$this->load->db_value($user_id).",
					NOW(),
					1
				),";

				endif;
			endforeach;
		endif;


		$sql_fleet_details = substr($sql_fleet_details, 0, -1);

		$this->db->query($sql_fleet_details);



		if ($result){
			$messages['success'] = 1;
			$messages['message'] = 'Success';
		} else {
			$messages['success'] = 0;
			$messages['error'] = 'Error';
		}

		// Return success or error message
		echo json_encode($messages);
		return true;
	}


	public function edit_vehicles() {

		$this->load->authorisation();
		$this->load->helper('url');
		$this->load->library('session');
		$user_id = $this->session->user_id;
		$data = array();

		$id =  $this->uri->segment(3); //todo to think


		$lng = $this->load->lng();
		$data['lang'] = $lng;

		$data['fleet'] = $this->db->select('model.brand_id, fleet.*')->from('fleet')->join('model', 'fleet.model_id = model.id', 'left')->where('fleet.id', $id)->get()->row_array();

		if($data['fleet']['id'] == '') {
			$this->access_denied();
			return false;
		}

		$data['fleet_details'] = $this->db->select('fleet_details.*')->from('fleet_details')->where('fleet_id', $data['fleet']['id'])->where('status <> ', -2 , FALSE)->get()->result_array();


		$row = $this->db->select('company_id')->from('user')->where('id', $user_id)->get()->row_array();
		$company_id = $row['company_id'];

		$data['staff_for_select'] = $this->db->select('staff.id, CONCAT_WS(" ", staff.first_name, staff.last_name) AS name, staff.status')
			->from('staff')
			->join('user', 'staff.registrar_user_id = user.id', 'left')
			->join('department', 'FIND_IN_SET(department.id, staff.department_ids)', 'left')
			->where('user.company_id', $company_id)
			->where('department.head_staff_id <> ', 'staff.id', FALSE)
			->where('staff.status', 1)
			->get()
			->result_array();


		$sql_brand = "
			SELECT 
				`id`,
				`title_".$lng."` AS `title`
			  FROM
			    `brand`
			WHERE `status` = '1'	
		";

		$result_brand = $this->db->query($sql_brand);

		$data['brand'] = $result_brand->result_array();


		$sql_model = "
			SELECT 
				`id`,
				`title_".$lng."` AS `title`
			  FROM
			    `model`
			WHERE `status` = '1'	
		";

		$result_model = $this->db->query($sql_model);

		$data['model'] = $result_model->result_array();



		$sql_fleet_type = "
			SELECT 
				`id`,
				`title_".$lng."` AS `title`
			  FROM
			    `fleet_type`
			WHERE `status` = '1'	
		";

		$result_fleet_type = $this->db->query($sql_fleet_type);

		$data['fleet_type'] = $result_fleet_type->result_array();

		$sql_fuel = "
			SELECT 
				`id`,
				`title_".$lng."` AS `title`
			  FROM
			    `fuel`
			WHERE `status` = '1'	
		";

		$result_fuel = $this->db->query($sql_fuel);

		$data['fuel'] = $result_fuel->result_array();


		$sql_insurance = "
			SELECT
				`id`,
				`title_".$lng."` AS `title`
			 FROM
				`insurance_type`
			WHERE `status` = 1	
		";

		$result_insurance = $this->db->query($sql_insurance);


		$data['insurance_type'] = $result_insurance->result_array();


		$sql_value = "
			SELECT
				`id`,
				`title_".$lng."` AS `title`,
				`type`,
				`convert`
			 FROM
				`value`
			WHERE `status` = 1	
		";

		$result_value = $this->db->query($sql_value);

		$data['value'] = $result_value->result_array();



		$this->layout->view('organization/edit_vehicles', $data);

	}


	public function edit_vehicles_ax() {

		$this->load->authorisation('Organization', 'add_vehicles');

		$this->load->library('session');
		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');
		$n = 0;
		$user_id = $this->session->user_id;

		$fleet_id = $this->input->post('fleet_id');

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
		$this->form_validation->set_rules('staff[]', 'staff', 'required');
		$this->form_validation->set_rules('brand', 'brand', 'required');
		$this->form_validation->set_rules('model', 'model', 'required');
		$this->form_validation->set_rules('fleet_type', 'fleet_type', 'required');
		$this->form_validation->set_rules('fleet_plate_number', 'fleet_plate_number', 'required');
		$this->form_validation->set_rules('production_date', 'production_date', 'required');






		if($this->form_validation->run() == false){
			//validation errors
			$n = 1;

			$validation_errors = array(
				'staff[]' => form_error('staff[]'),
				'brand' => form_error('brand'),
				'model' => form_error('model'),
				'fleet_type' => form_error('fleet_type'),
				'fleet_plate_number' => form_error('fleet_plate_number'),
				'production_date' => form_error('production_date'),

			);
			$messages['error']['elements'][] = $validation_errors;
		}


		$staff = $this->input->post('staff');
		if($staff != '') {
			$staff = implode(',', $this->input->post('staff'));
		}
		$brand = $this->input->post('brand');
		$model = $this->input->post('model');
		$fleet_type = $this->input->post('fleet_type');
		$fleet_plate_number = $this->input->post('fleet_plate_number');
		$production_date = $this->input->post('production_date');
		$color = $this->input->post('color');
		$vin = $this->input->post('vin');
		$engine_power = str_replace(",", ".", $this->input->post('engine_power'));
		$fuel = $this->input->post('fuel');
		$fuel_avg_consumption = str_replace(",", ".", $this->input->post('fuel_avg_consumption'));
		$mileage = $this->input->post('mileage');
		$odometer = $this->input->post('odometer');
		$other = $this->input->post('other');
		$status = ($this->input->post('status') == '' ? 1 : $this->input->post('status'));


		//info

		$owner_staff_id = $this->input->post('owner_id');
		$owner = $this->input->post('owner');

		$regitered_address = $this->input->post('regitered_address');
		$regitered_number = $this->input->post('regitered_number');
		$regitered_file = '';

		$value_1 = $this->input->post('value_1');
		$value1_day = str_replace(",", ".", $this->input->post('value1_day'));
		$auto_increment = ($this->input->post('auto_increment') != '' ? $this->input->post('auto_increment') : '-1');
		$use_of_secondary_meter = $this->input->post('use_of_secondary_meter');
		$value_2 = '';
		$value2_day = '';
		$convert = $this->input->post('convert');

		if($use_of_secondary_meter == 1) {
			$value_2 = $this->input->post('value_2');
			if($value_2 != '') {
				$value2_day = ($value1_day * $convert[$value_2]);
			}

		}



		//file config
		$config_f['upload_path'] = set_realpath('uploads/user_'.$user_id.'/fleet/regitered_file');
		$config_f['allowed_types'] = 'pdf|jpg|png|doc|docx|csv|xlsx';
		$config_f['max_size'] = '4097152'; //4 MB
		$config_f['file_name'] = $this->uname(3, 8);


		if(isset($_FILES['regitered_file']['name']) AND $_FILES['regitered_file']['name'] != '') {


			if (!file_exists(set_realpath('uploads/user_'.$user_id.'/fleet/regitered_file'))) {
				mkdir(set_realpath('uploads/user_'.$user_id.'/fleet/regitered_file'), '0755', true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/fleet/regitered_file/index.html'));
			}



			$this->load->library('upload', $config_f);
			$this->upload->initialize($config_f);

			if (!$this->upload->do_upload('regitered_file')) {
				$validation_errors = array('regitered_file' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}


			$regitered_file_arr = $this->upload->data();

			$regitered_file = "`regitered_file` = ".$this->load->db_value($regitered_file_arr['file_name']).",";



		}



		$company = $this->input->post('company');
		//$file = $this->input->post('file');
		$reference = $this->input->post('reference');
		$expiration = $this->input->post('expiration');
		$type = $this->input->post('type');

		//file config insurance
		$config_f_i['upload_path'] = set_realpath('uploads/user_'.$user_id.'/fleet/insurance');
		$config_f_i['allowed_types'] = 'pdf|jpg|png|doc|docx|csv|xlsx';
		$config_f_i['max_size'] = '4097152'; //4 MB
		$config_f_i['file_name'] = $this->uname(3, 8);


		$file_1 = '';
		$ext_1 = '';
		if(isset($_FILES['file_1']['name']) AND $_FILES['file_1']['name'] != '') {


			if (!file_exists(set_realpath('uploads/user_'.$user_id.'/fleet/insurance'))) {
				mkdir(set_realpath('uploads/user_'.$user_id.'/fleet/insurance'), '0755', true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/fleet/insurance/index.html'));
			}



			$this->load->library('upload', $config_f_i);
			$this->upload->initialize($config_f_i);

			if (!$this->upload->do_upload('file_1')) {
				$validation_errors = array('file_1' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}


			$file_1_arr = $this->upload->data();

			$file_1 = $file_1_arr['file_name'];

			$file_1_array = explode('.', $file_1);

			$file_1 = "`insurance_file_1` = ".$this->load->db_value($file_1_array[0]).",";
			$ext_1 = " `insurance_ext_1` = ".$this->load->db_value($file_1_array[1]).",";



		}


		$file_2 = '';
		$ext_2 = '';
		if(isset($_FILES['file_2']['name']) AND $_FILES['file_2']['name'] != '') {


			if (!file_exists(set_realpath('uploads/user_'.$user_id.'/fleet/insurance'))) {
				mkdir(set_realpath('uploads/user_'.$user_id.'/fleet/insurance'), '0755', true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/fleet/insurance/index.html'));
			}



			$this->load->library('upload', $config_f_i);
			$this->upload->initialize($config_f_i);

			if (!$this->upload->do_upload('file_2')) {
				$validation_errors = array('file_2' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}



			$file_2_arr = $this->upload->data();

			$file_2 = $file_2_arr['file_name'];

			$file_2_array = explode('.', $file_2);

			$file_2 = "`insurance_file_2` = ".$this->load->db_value($file_2_array[0]).",";
			$ext_2 = " `insurance_ext_2` = ".$this->load->db_value($file_2_array[1]).",";


		}


		$file_3 = '';
		$ext_3 = '';
		if(isset($_FILES['file_3']['name']) AND $_FILES['file_3']['name'] != '') {


			if (!file_exists(set_realpath('uploads/user_'.$user_id.'/fleet/insurance'))) {
				mkdir(set_realpath('uploads/user_'.$user_id.'/fleet/insurance'), '0755', true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/fleet/insurance/index.html'));
			}



			$this->load->library('upload', $config_f_i);
			$this->upload->initialize($config_f_i);

			if (!$this->upload->do_upload('file_3')) {
				$validation_errors = array('file_3' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}



			$file_3_arr = $this->upload->data();

			$file_3 = $file_3_arr['file_name'];

			$file_3_array = explode('.', $file_3);

			$file_3 = "`insurance_file_3` = ".$this->load->db_value($file_3_array[0]).",";
			$ext_3 = " `insurance_ext_3` = ".$this->load->db_value($file_3_array[1]).",";


		}


		$file_4 = '';
		$ext_4 = '';
		if(isset($_FILES['file_4']['name']) AND $_FILES['file_4']['name'] != '') {


			if (!file_exists(set_realpath('uploads/user_'.$user_id.'/fleet/insurance'))) {
				mkdir(set_realpath('uploads/user_'.$user_id.'/fleet/insurance'), '0755', true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/fleet/insurance/index.html'));
			}



			$this->load->library('upload', $config_f_i);
			$this->upload->initialize($config_f_i);

			if (!$this->upload->do_upload('file_4')) {
				$validation_errors = array('file_4' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}


			$file_4_arr = $this->upload->data();

			$file_4 = $file_4_arr['file_name'];

			$file_4_array = explode('.', $file_4);

			$file_4 = "`insurance_file_4` = ".$this->load->db_value($file_4_array[0]).",";
			$ext_4 = " `insurance_ext_4` = ".$this->load->db_value($file_4_array[1]).",";


		}




		//fleet details variables
		$item = $this->input->post('item');
		$value = $this->input->post('value');
		$avg_exploitation = str_replace(",", ".", $this->input->post('avg_exploitation'));
		$per_days = str_replace(",", ".", $this->input->post('per_days'));
		$more_info = $this->input->post('more_info');
		$remind_before = str_replace(",", ".", $this->input->post('remind_before'));
		$start_alarm_date = $this->input->post('start_alarm_date');
		// end fleet details variables

		// validation fleet details
		if(is_array($item)) :
			foreach ($item as $i => $item_val) :
				if($item_val == '') :
					$n = 1;
					$validation_errors = array('item['.$i.']' => "required");
					$messages['error']['elements'][] = $validation_errors;
				endif;

				if($per_days[$i] == '' || !is_numeric($per_days[$i])) :
					$n = 1;
					$validation_errors = array('per_days['.$i.']' => "required");
					$messages['error']['elements'][] = $validation_errors;
				endif;

				if($value[$i] == '') :
					$n = 1;
					$validation_errors = array('value['.$i.']' => "required");
					$messages['error']['elements'][] = $validation_errors;
				endif;

				if($avg_exploitation[$i] == '' || !is_numeric($avg_exploitation[$i])) :
					$n = 1;
					$validation_errors = array('avg_exploitation['.$i.']' => "required");
					$messages['error']['elements'][] = $validation_errors;
				endif;

				if($remind_before[$i] == ''  || !is_numeric(($remind_before[$i]))) :
					$n = 1;
					$validation_errors = array('remind_before['.$i.']' => "required");
					$messages['error']['elements'][] = $validation_errors;
				endif;

				if($start_alarm_date[$i] == '') :
					$n = 1;
					$validation_errors = array('start_alarm_date['.$i.']' => "required");
					$messages['error']['elements'][] = $validation_errors;
				endif;
			endforeach;
		endif;
		// end of validation fleet details





		if($n == 1) {
			echo json_encode($messages);
			return false;
		}




		//todo mail ---






		$sql = "
				UPDATE `fleet` SET 
					`staff_ids` = ".$this->load->db_value($staff).",
					`model_id` = ".$this->load->db_value($model).",
					`fleet_type_id` = ".$this->load->db_value($fleet_type).",
					`production_date` = ".$this->load->db_value($production_date).",
					`color` = ".$this->load->db_value($color).",
					`vin_code` = ".$this->load->db_value($vin).",
					`engine_power` = ".$this->load->db_value($engine_power).",
					`fuel_id` = ".$this->load->db_value($fuel).",
					`fuel_avg_consumption` = ".$this->load->db_value($fuel_avg_consumption).",
					`mileage` =  ".$this->load->db_value($mileage).",
					`odometer` = ".$this->load->db_value($odometer).",
					`fleet_plate_number` = ".$this->load->db_value($fleet_plate_number).",
					`other` = ".$this->load->db_value($other).",
					`registrar_user_id` = ".$this->load->db_value($user_id).",
					`registration_date` = NOW(),
					`owner_staff_id` = ".$this->load->db_value($owner_staff_id).",
					`owner` = ".$this->load->db_value($owner).",
					`value1_id` = ".$this->load->db_value($value_1).",
					`value2_id` = ".$this->load->db_value($value_2).",
					`value1_day` = ".$this->load->db_value($value1_day).",
					`value2_day` = ".$this->load->db_value($value2_day).",
					`auto_increment` = ".$this->load->db_value($auto_increment).",
					`regitered_address` = ".$this->load->db_value($regitered_address).",
					`regitered_number` = ".$this->load->db_value($regitered_number).",
					".$regitered_file."
					`insurance_company_1` = ".$this->load->db_value($company[1]).",
				    `insurance_referance_1` = ".$this->load->db_value($reference[1]).",
				    `insurance_type_id_1` = ".$this->load->db_value($type[1]).",
				    `insurance_expiration_1` = ".$this->load->db_value($expiration[1]).",
				    ".$file_1."
				    ".$ext_1."
				    `insurance_company_2` = ".$this->load->db_value($company[2]).",
				    `insurance_referance_2` = ".$this->load->db_value($reference[2]).",
				    `insurance_type_id_2` = ".$this->load->db_value($type[2]).",
				    `insurance_expiration_2` = ".$this->load->db_value($expiration[2]).",
				    ".$file_2."
				    ".$ext_2."
				    `insurance_company_3` = ".$this->load->db_value($company[3]).",
				    `insurance_referance_3` = ".$this->load->db_value($reference[3]).",
				    `insurance_type_id_3` = ".$this->load->db_value($type[3]).",
				    `insurance_expiration_3` = ".$this->load->db_value($expiration[3]).",
				    ".$file_3."
				    ".$ext_3."
				    `insurance_company_4` = ".$this->load->db_value($company[4]).",
				    `insurance_referance_4` = ".$this->load->db_value($reference[4]).",
				    `insurance_type_id_4` = ".$this->load->db_value($type[4]).",
				    `insurance_expiration_4` = ".$this->load->db_value($expiration[4]).",
				    ".$file_4."
				    ".$ext_4."
					`status` = ".$this->load->db_value($status)."
				WHERE `id` = ".$this->load->db_value($fleet_id)."
			";


		$result = $this->db->query($sql);


		$this->db->update('fleet_details', array('status' => '-2'), array('fleet_id' => $fleet_id));


		$sql_fleet_details = "
			INSERT INTO `fleet_details`
				(`items`,
				 `value_id`,
				 `avg_exploitation`,
				 `start_alarm_date`,
				 `per_days`,
				 `more_info`,
				 `reminde_me`,
				 `fleet_id`,
				 `next_alarm_date`,
				 `registrar_user_id`,
				 `registration_date`,
				 `status`)
			VALUES
		";



		if(is_array($item)) :
			foreach ($item as $i => $item_val) :
				if($item_val != '') :

					$sub_days[$i] = round((($avg_exploitation[$i]/$per_days[$i]) - $remind_before[$i]),0,PHP_ROUND_HALF_ODD);

					$next_alarm_date[$i] = strtotime ( $sub_days[$i].' day' , strtotime ( $start_alarm_date[$i] ) ) ;
					$next_alarm_date[$i] = date ( 'Y-m-d' , $next_alarm_date[$i] );

					$sql_fleet_details .= "(
					".$this->load->db_value($item_val).",
					".$this->load->db_value($value[$i]).",
					".$this->load->db_value($avg_exploitation[$i]).",
					".$this->load->db_value($start_alarm_date[$i]).",
					".$this->load->db_value($per_days[$i]).",
					".$this->load->db_value($more_info[$i]).",
					".$this->load->db_value($remind_before[$i]).",
					".$this->load->db_value($fleet_id).",
					".$this->load->db_value($next_alarm_date[$i]).",
					".$this->load->db_value($user_id).",
					NOW(),
					1
				),";

				endif;
			endforeach;
		endif;


		$sql_fleet_details = substr($sql_fleet_details, 0, -1);

		$result_fleet_details = $this->db->query($sql_fleet_details);

		if($result_fleet_details) {
			$this->db->delete('fleet_details', array('status' => '-2'));
		}



		if ($result){
			$messages['success'] = 1;
			$messages['message'] = 'Success';
		} else {
			$messages['success'] = 0;
			$messages['error'] = 'Error';
		}

		// Return success or error message
		echo json_encode($messages);
		return true;
	}

	public function add_user_ax() {

		$this->load->authorisation('Organization', 'department');

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
		$this->form_validation->set_rules('first_name', 'first_name', 'required');
		$this->form_validation->set_rules('last_name', 'last_name', 'required');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
		$this->form_validation->set_rules('contact_number', 'contact_number', 'required');
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_rules('role', 'role', 'required');





		if($this->form_validation->run() == false){
			//validation errors
			$n = 1;

			$validation_errors = array(
				'first_name' => form_error('first_name'),
				'last_name' => form_error('last_name'),
				'email' => form_error('email'),
				'contact_number' => form_error('contact_number'),
				'username' => form_error('username'),
				'password' => form_error('password'),
				'role' => form_error('role'),
			);
			$messages['error']['elements'][] = $validation_errors;
		}



		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$email = $this->input->post('email');
		$address = $this->input->post('address');
		$country_id = $this->input->post('country_id');
		$country_code = $this->input->post('country_code');
		$contact_number = $this->input->post('contact_number');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$hash_password = $this->hash($password);
		$role = $this->input->post('role');
		$status = ($this->input->post('status') == '' ? 1 : $this->input->post('status'));



		$sql_email_unique = "
            SELECT `id` FROM `user` WHERE `email` = ".$this->load->db_value($email)." #todo if suspended and one company
        ";

		$query_email_unique = $this->db->query($sql_email_unique);
		$num_rows = $query_email_unique->num_rows();

		if($num_rows >= 1) {
			$n = 1;
			$validation_errors = array('email_unique' => "Email is not unique");
			$messages['error']['elements'][] = $validation_errors;
		}


		$sql_username_unique = "
            SELECT `id` FROM `user` WHERE `username` = ".$this->load->db_value($username)." #todo if suspended and one company
        ";

		$query_username_unique = $this->db->query($sql_username_unique);
		$num_rows_u = $query_username_unique->num_rows();

		if($num_rows_u >= 1) {
			$n = 1;
			$validation_errors = array('username_unique' => "Username is not unique");
			$messages['error']['elements'][] = $validation_errors;
		}



		if($n == 1) {
			echo json_encode($messages);
			return false;
		}


		$row = $this->db->select('company_id')->from('user')->where('id', $user_id)->get()->row_array();
		$company_id = $row['company_id'];


		if (!file_exists(set_realpath('uploads/user_'.$user_id.'/user/photo'))) {
			mkdir(set_realpath('uploads/user_'.$user_id.'/user/photo'), '0755', true);
			copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/user/photo/index.html'));
		}


		// watermark
		$config_wm['image_library'] = 'gd'; //default value
		$config_wm['source_image'] = set_realpath('assets/img/circle.png'); //get image
		$config_wm['new_image'] = set_realpath('uploads/user_'.$user_id.'/user/photo/'.$username.'.png');
		$config_wm['wm_text'] = $this->get_first_character($first_name);
		$config_wm['wm_type'] = 'text';
		$config_wm['wm_font_path'] = set_realpath('system/fonts/GHEAGrpalatReg.ttf');
		$config_wm['wm_font_size'] = '48';
		$config_wm['wm_hor_alignment'] = 'center';
		$config_wm['wm_font_color'] = $this->rand_color(); //random
		$config_wm['wm_padding'] = '-3';

		$this->load->library('image_lib', $config_wm);
		$this->image_lib->initialize($config_wm);

		$photo = $username.'.png';
		// end watermark

		if (!$this->image_lib->watermark()) {
			$validation_errors = array('watermark' => $this->image_lib->display_errors());
			$messages['error']['elements'][] = $validation_errors;
			echo json_encode($messages);
			return false;
		}




		if($this->input->post('mail_to') == 1) {


			$this->smtp_mailing();

			$this->email->to($email);
			$this->email->subject('NestGarageSystem Account');
			$this->email->message(
				'Site link is: <a href="'.base_url().'">'.base_url().'</a><br>'.
				'Account username: '.$username.'<br>'.
				'Account password: '.$password.'<br>'
			);

			if(!$this->email->send()) {
				$messages['success'] = 0;
				$messages['error'] = $this->email->print_debugger();
				echo json_encode($messages);
				return false;
			}
		}


		$sql = "
				INSERT INTO `user` SET 
					`photo` = ".$this->load->db_value($photo).",
					`first_name` = ".$this->load->db_value($first_name).",
					`last_name` = ".$this->load->db_value($last_name).",
					`email` = ".$this->load->db_value($email).",
					`parent_user_id` = ".$this->load->db_value($user_id).",
					`company_id` = ".$this->load->db_value($company_id).",
					`role_id` = ".$this->load->db_value($role).",
					`address` = ".$this->load->db_value($address).",
					`country_id` = ".$this->load->db_value($country_id).",
					`country_code` =  ".$this->load->db_value($country_code).",
					`phone_number` = ".$this->load->db_value($contact_number).",
					`username` = ".$this->load->db_value($username).",
					`password` = ".$this->load->db_value($hash_password).",
					`creation_date` = NOW(),
					`status` = ".$this->load->db_value($status)."
			";


		$result = $this->db->query($sql);




		if ($result){
			$messages['success'] = 1;
			$messages['message'] = 'Success';
		} else {
			$messages['success'] = 0;
			$messages['error'] = 'Error';
		}

		// Return success or error message
		echo json_encode($messages);
		return true;
	}




	public function edit_user_modal_ax() {

		$id = $this->uri->segment(4);
		$this->load->helper('url');
		$this->load->helper('form');
		$lng = $this->load->lng();

		if($id == NULL) {
			$message = 'Undifined ID';
			show_error($message, '404', $heading = '404 Page Not Found');
			return false;
		}


		$sql = "SELECT
				  `id`,
				  `photo`,
				  `first_name`,
				  `last_name`,
				  `email`,
				  `parent_user_id`,
				  `company_id`,
				  `role_id`,
				  `address`,
				  `country_id`,
				  `country_code`,
				  `phone_number`,
				  `username`,
				  `password`,
				  `creation_date`,
				  `last_activity`,
				  `fb_id`,
				  `google_id`,
				  `status`
				FROM 
				  `user`
                WHERE `id` =  ".$this->load->db_value($id)."
                LIMIT 1";

		$query = $this->db->query($sql);
		$row = $query->row_array();

		$data['id'] = $row['id'];
		$data['first_name'] = $row['first_name'];
		$data['last_name'] = $row['last_name'];
		$data['email'] = $row['email'];
		$data['role_id'] = $row['role_id'];
		$data['username'] = $row['username'];
		$data['phone_number'] = $row['phone_number'];
		$data['status'] = $row['status'];


		$sql_country = "
		    SELECT 
              `id`,
              `title_".$lng."` AS `title`,
              `status` 
            FROM
              `country` 
            WHERE `status` = '1' 
            ORDER BY `title_".$lng."` 
		";

		$query_country = $this->db->query($sql_country);
		$data['country'] = $query_country->result_array();


		$sql_role = "
		    SELECT 
              `id`,
              `title`,
              `status` 
            FROM
              `role` 
            WHERE `status` = '1' 
            # AND `id` <> '1' #not administrator
		";

		$query_role = $this->db->query($sql_role);
		$data['role'] = $query_role->result_array();


		$this->load->view('organization/edit_user', $data);

	}


	public function edit_user_ax() {

		$this->load->authorisation('Organization', 'user');

		$this->load->library('session');
		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');
		$n = 0;
		$user_id = $this->session->user_id;

		$result = false;

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			echo json_encode($messages);
			return false;
		}


		$this->load->library('form_validation');
		// $this->config->set_item('language', 'armenian');
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('first_name', 'first_name', 'required');
		$this->form_validation->set_rules('last_name', 'last_name', 'required');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
		$this->form_validation->set_rules('contact_number', 'contact_number', 'required');
		$this->form_validation->set_rules('username', 'username', 'required');
		$this->form_validation->set_rules('role', 'role', 'required');





		if($this->form_validation->run() == false){
			//validation errors
			$n = 1;

			$validation_errors = array(
				'first_name' => form_error('first_name'),
				'last_name' => form_error('last_name'),
				'email' => form_error('email'),
				'contact_number' => form_error('contact_number'),
				'username' => form_error('username'),
				'role' => form_error('role'),
			);
			$messages['error']['elements'][] = $validation_errors;
		}



		$id = $this->input->post('user_id');

		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$email = $this->input->post('email');
		$address = $this->input->post('address');
		$country_id = $this->input->post('country_id');
		$country_code = $this->input->post('country_code');
		$contact_number = $this->input->post('contact_number');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$hash_password = '';
		$role = $this->input->post('role');
		$status = ($this->input->post('status') == '' ? 1 : $this->input->post('status'));

		if($password != '') {
			$hash_password = $this->hash($password);
			$hash_password = "`password` = ".$this->load->db_value($hash_password).",";
		}




		$sql_email_unique = "
            SELECT `id` FROM `user` WHERE `id` <> '".$id."' AND  `email` = ".$this->load->db_value($email)." #todo if suspended and one company
        ";

		$query_email_unique = $this->db->query($sql_email_unique);
		$num_rows = $query_email_unique->num_rows();

		if($num_rows >= 1) {
			$n = 1;
			$validation_errors = array('email_unique' => "Email is not unique");
			$messages['error']['elements'][] = $validation_errors;
		}


		$sql_username_unique = "
            SELECT `id` FROM `user` WHERE `id` <> '".$id."' AND `username` = ".$this->load->db_value($username)." #todo if suspended and one company
        ";

		$query_username_unique = $this->db->query($sql_username_unique);
		$num_rows_u = $query_username_unique->num_rows();

		if($num_rows_u >= 1) {
			$n = 1;
			$validation_errors = array('username_unique' => "Username is not unique");
			$messages['error']['elements'][] = $validation_errors;
		}



		if($n == 1) {
			echo json_encode($messages);
			return false;
		}


		$row = $this->db->select('company_id')->from('user')->where('id', $user_id)->get()->row_array();
		$company_id = $row['company_id'];





		if (!file_exists(set_realpath('uploads/user_'.$user_id.'/user/photo'))) {
			mkdir(set_realpath('uploads/user_'.$user_id.'/user/photo'), '0755', true);
			copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/user/photo/index.html'));
		}


		// watermark
		$config_wm['image_library'] = 'gd2'; //default value
		$config_wm['source_image'] = set_realpath('assets/img/circle.png'); //get image
		$config_wm['new_image'] = set_realpath('uploads/user_'.$user_id.'/user/photo/'.$username.'.png');
		$config_wm['wm_text'] = $this->get_first_character($first_name);
		$config_wm['wm_type'] = 'text';
		$config_wm['wm_font_path'] = set_realpath('system/fonts/GHEAGrpalatReg.ttf');
		$config_wm['wm_font_size'] = '48';
		$config_wm['wm_hor_alignment'] = 'center';
		$config_wm['wm_font_color'] = $this->rand_color(); //random
		$config_wm['wm_padding'] = '-3';

		$this->load->library('image_lib', $config_wm);
		$this->image_lib->initialize($config_wm);

		$photo = '';
		// end watermark

		if (!$this->image_lib->watermark()) {
			$validation_errors = array('watermark' => $this->image_lib->display_errors());
			$messages['error']['elements'][] = $validation_errors;
			echo json_encode($messages);
			return false;
		} else {
			$photo = $username.'.png';
		}





		   $sql = "
				UPDATE `user` SET 
					`photo` = ".$this->load->db_value($photo).",
					`first_name` = ".$this->load->db_value($first_name).",
					`last_name` = ".$this->load->db_value($last_name).",
					`email` = ".$this->load->db_value($email).",
					`company_id` = ".$this->load->db_value($company_id).",
					`role_id` = ".$this->load->db_value($role).",
					`address` = ".$this->load->db_value($address).",
					`country_id` = ".$this->load->db_value($country_id).",
					`country_code` =  ".$this->load->db_value($country_code).",
					`phone_number` = ".$this->load->db_value($contact_number).",
					`username` = ".$this->load->db_value($username).",
					".$hash_password."
					`status` = ".$this->load->db_value($status)."
				WHERE `id` = ".$this->load->db_value($id)."
			";


		$result = $this->db->query($sql);




		if ($result){
			$messages['success'] = 1;
			$messages['message'] = 'Success';
		} else {
			$messages['success'] = 0;
			$messages['error'] = 'Error';
		}

		// Return success or error message
		echo json_encode($messages);
		return true;
	}


	public function delete_user() {

		$this->load->authorisation('Organization', 'user');

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}

		$id = $this->input->post('user_id');


		$this->db->delete('user', array('id' => $id));

		return true;

	}














}
//end of class
