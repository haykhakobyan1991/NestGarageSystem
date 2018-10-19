<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Main extends MX_Controller {

	/**
	 * Main constructor.
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


	public function create_company() {

		$this->load->authorisation();
		$this->load->helper('url');
		$this->load->library('session');
		$user_id = $this->session->user_id;
		$data = array();

		$lng = $this->load->lng();


		$row = $this->db->select('company_id')->from('user')->where('id', $user_id)->get()->row_array();
		$company_id = $row['company_id'];

		$data['company'] = $this->db->select('*')->from('company')->where('id', $company_id)->get()->row_array();


		$sql_company_type = "
		    SELECT 
              `id`,
              `title_".$lng."` AS `title`
            FROM
              `company_type` 
            WHERE `status` = '1'
		";

		$query_company_type = $this->db->query($sql_company_type);
		$data['company_type'] = $query_company_type->result_array();

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

		$this->layout->view('create_company', $data);
	}


	public function create_company_ax() {

		$this->load->authorisation('Main', 'create_company');

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





		if($this->form_validation->run() == false){
			//validation errors
			$n = 1;

			$validation_errors = array(
				'company_type' => form_error('company_type'),
				'company_name' => form_error('company_name')
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
		$activity_address = $this->input->post('activity_address');
		$legal_address = $this->input->post('legal_address');
		$tin = $this->input->post('tin');
		$phone_number = $this->input->post('phone_number');
		$email = $this->input->post('email');
		$web_address = $this->input->post('web_address');
		$status = '1';
		$add_sql_image = '';


		//upload config
		$config = $this->upload_config();


		if (!file_exists(set_realpath('uploads/user_'.$user_id.'/company'))) {
			mkdir(set_realpath('uploads/user_'.$user_id.'/company'), '0777', true);
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


			if(file_exists(set_realpath('uploads/user_'.$user_id.'/company/'.$company_logo))) {
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
				  `owner_firstname` = ".$this->load->db_value('').",
				  `owner_lastname` = ".$this->load->db_value('').",
				  `owner_position` = ".$this->load->db_value('').",
				  `owner_contact_number` = ".$this->load->db_value('').",
				  `owner_email` = ".$this->load->db_value('').",
				  `name` = ".$this->load->db_value($company_name).",
				  `activity_country_id` = ".$this->load->db_value('').",
				  `activity_state_region` = ".$this->load->db_value('').",
				  `activity_city` = ".$this->load->db_value('').",
				  `activity_zip_code` = ".$this->load->db_value('').",
				  `activity_address` = ".$this->load->db_value($activity_address).",
				  `legal_country_id` = ".$this->load->db_value('').",
				  `legal_state_region` = ".$this->load->db_value('').",
				  `legal_city` = ".$this->load->db_value('').",
				  `legal_zip_code` = ".$this->load->db_value('').",
				  `legal_address` = ".$this->load->db_value($legal_address).",
				  `tin` = ".$this->load->db_value($tin).",
				  `phone_number` = ".$this->load->db_value($phone_number).",
				  `email` = ".$this->load->db_value($email).",
				  `web_address` = ".$this->load->db_value($web_address).",
				  `status` = ".$this->load->db_value($status)." 
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
				  `owner_firstname` = ".$this->load->db_value('').",
				  `owner_lastname` = ".$this->load->db_value('').",
				  `owner_position` = ".$this->load->db_value('').",
				  `owner_contact_number` = ".$this->load->db_value('').",
				  `owner_email` = ".$this->load->db_value('').",
				  `name` = ".$this->load->db_value($company_name).",
				  `activity_country_id` = ".$this->load->db_value('').",
				  `activity_state_region` = ".$this->load->db_value('').",
				  `activity_city` = ".$this->load->db_value('').",
				  `activity_zip_code` = ".$this->load->db_value('').",
				  `activity_address` = ".$this->load->db_value($activity_address).",
				  `legal_country_id` = ".$this->load->db_value('').",
				  `legal_state_region` = ".$this->load->db_value('').",
				  `legal_city` = ".$this->load->db_value('').",
				  `legal_zip_code` = ".$this->load->db_value('').",
				  `legal_address` = ".$this->load->db_value($legal_address).",
				  `tin` = ".$this->load->db_value($tin).",
				  `phone_number` = ".$this->load->db_value($phone_number).",
				  `email` = ".$this->load->db_value($email).",
				  `web_address` = ".$this->load->db_value($web_address).",
				  `creation_date` = NOW(),
				  `status` = ".$this->load->db_value($status)." 
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


}
//end of class
