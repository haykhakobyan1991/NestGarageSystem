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


	public function  staff() {

		$this->load->authorisation();
		$this->load->helper('url');
		$this->load->library('session');
		$user_id = $this->session->user_id;
		$data = array();

		$lng = $this->load->lng();


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


		$data['staff'] = $this->db->select('staff.*, CONCAT_WS(" ", user.first_name, user.last_name) AS user_name')
			->from('staff')
			->join('user', 'staff.registrar_user_id = user.id', 'left')
			->where('user.company_id', $company_id)
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


		if (!file_exists(set_realpath('uploads/user_'.$user_id.'/company'))) {
			mkdir(set_realpath('uploads/user_'.$user_id.'/company'), '0777', true);
			copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/index.html'));
			copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/company/index.html'));
		}

		$config['upload_path'] = set_realpath('uploads/user_'.$user_id.'/company');


		if(isset($_FILES['photo']['name']) AND $_FILES['photo']['name'] != '') {
			$this->load->library('upload', $config);
			$this->upload->initialize($config);


			if (!$this->upload->do_upload('photo')) {
				$validation_errors = array('photo' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}


			if($company_logo != '' && file_exists(set_realpath('uploads/user_'.$user_id.'/company/'.$company_logo))) {
				unlink(set_realpath('uploads/user_'.$user_id.'/company/'.$company_logo));
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


		//upload config
		$config = $this->upload_config();


		if (!file_exists(set_realpath('uploads/user_'.$user_id.'/staff/original'))) {
			mkdir(set_realpath('uploads/user_'.$user_id.'/staff/original'), '0777', true);
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
				mkdir(set_realpath('uploads/user_'.$user_id.'/staff/thumbs'), '0777', true);
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


		if(isset($_FILES['file_1']['name']) AND $_FILES['file_1']['name'] != '') {


			if (!file_exists(set_realpath('uploads/user_'.$user_id.'/staff/files'))) {
				mkdir(set_realpath('uploads/user_'.$user_id.'/staff/files'), '0777', true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/staff/files/index.html'));
			}

			//file config
			$config_f['upload_path'] = set_realpath('uploads/user_'.$user_id.'/staff/files');
			$config_f['allowed_types'] = 'pdf|jpg|png|doc|docx|csv|xlsx';
			$config_f['max_size'] = '4097152'; //4 MB
			$config_f['file_name'] = $this->uname(3, 8);

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
				mkdir(set_realpath('uploads/user_'.$user_id.'/staff/files'), '0777', true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/staff/files/index.html'));
			}

			//file config
			$config_f['upload_path'] = set_realpath('uploads/user_'.$user_id.'/staff/files');
			$config_f['allowed_types'] = 'pdf|jpg|png|doc|docx|csv|xlsx';
			$config_f['max_size'] = '4097152'; //4 MB
			$config_f['file_name'] = $this->uname(3, 8);

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
				mkdir(set_realpath('uploads/user_'.$user_id.'/staff/files'), '0777', true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/staff/files/index.html'));
			}

			//file config
			$config_f['upload_path'] = set_realpath('uploads/user_'.$user_id.'/staff/files');
			$config_f['allowed_types'] = 'pdf|jpg|png|doc|docx|csv|xlsx';
			$config_f['max_size'] = '4097152'; //4 MB
			$config_f['file_name'] = $this->uname(3, 8);

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
				mkdir(set_realpath('uploads/user_'.$user_id.'/staff/files'), '0777', true);
				copy(set_realpath('uploads/index.html'), set_realpath('uploads/user_'.$user_id.'/staff/files/index.html'));
			}

			//file config
			$config_f['upload_path'] = set_realpath('uploads/user_'.$user_id.'/staff/files');
			$config_f['allowed_types'] = 'pdf|jpg|png|doc|docx|csv|xlsx';
			$config_f['max_size'] = '4097152'; //4 MB
			$config_f['file_name'] = $this->uname(3, 8);

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
				  `department_id` = ".$this->load->db_value($department).",
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


}
//end of class
