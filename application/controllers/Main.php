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
		$data[] = array();

		$lng = $this->load->lng();

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

		$this->load->view('create_company', $data);
	}


	public function create_company_ax() {
		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');
		$n = 0;

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}


		$this->load->library('form_validation');
		// $this->config->set_item('language', 'armenian');
		$this->form_validation->set_error_delimiters('<div>', '</div>');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('first_name', 'First name', 'required');
		$this->form_validation->set_rules('role', 'Role', 'required');
		$this->form_validation->set_rules('password','Password','required|min_length[6]');
		$this->form_validation->set_rules('email','Email','valid_email');



		if($this->form_validation->run() == false){
			//validation errors
			$n = 1;

			$validation_errors = array(
				'username' => form_error('username'),
				'first_name' => form_error('first_name'),
				'role' => form_error('role'),
				'password' => form_error('password'),
				'email' => form_error('email')
			);
			$messages['error']['elements'][] = $validation_errors;
		}



		$password = $this->hash($this->input->post('password'));
		$role = $this->input->post('role');
		$email = $this->input->post('email');
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$username = $this->input->post('username');
		$status = $this->input->post('status');

		$sql_unique = "SELECT `username` FROM `user` WHERE `username` = '".$username."'";

		$query = $this->db->query($sql_unique);
		$num_rows = $query->num_rows();


		if($num_rows > '0') {
			$n = 1;
			$validation_errors = array('username' => "Username is not unique");
			$messages['error']['elements'][] = $validation_errors;
		}

		if($n == 1) {
			echo json_encode($messages);
			return false;
		}


		$sql = "INSERT INTO `user`
					SET 
					 `role_id` = ".$this->db_value($role).",
					 `username` = ".$this->db_value($username).",
					 `first_name` = ".$this->db_value($first_name).",
					 `last_name` = ".$this->db_value($last_name).",
					 `email` = ".$this->db_value($email).",
					 `password` = ".$this->db_value($password).",
					 `status` = ".$this->db_value($status)."";


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


}
//end of class
