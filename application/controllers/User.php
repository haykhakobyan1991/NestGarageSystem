<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class User extends CI_Controller {


    /**
     * User constructor.
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


    /**
     * @param $email
     * @return mixed|string
     */
    private function generate_username($email) {

        $email_arr = explode('@', $email);
        $username = $email_arr[0].'_'.$this->uname(3,3);
        $username = str_replace(".","",$username);

        return $username;
    }



	public function index() {

        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $data[] = array();

        $lng = $this->load->lng();


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

        $this->load->view('login_register/index', $data);

        return true;
		
	}


    /**
     * @return bool
     */
    public function logout() {

		$this->load->library('session');
		$this->session->sess_destroy();
		redirect('/', 'location');
	
		return true;
	}


	/**
     * @return bool
     */
    public function signUp_ax() {

        $messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');

        if ($this->input->server('REQUEST_METHOD') != 'POST') {
            // Return error
            $this->access_denied();
            return false;
        }


        $n = 0;
        $messages['error'] = array();
        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $email = $this->input->post('up_email');
        $country_code = $this->input->post('country_code');
        $phone_number = $this->input->post('phone_number');
        $username = $this->generate_username($email);
        $password = $this->input->post('up_password');
        $confirm_password = $this->input->post('confirm_password');
        $country = $this->input->post('up_country');



        $fb_id = $this->input->post('fb_id');
        $google_id = $this->input->post('google_id');


        $this->load->library('form_validation');
        // $this->config->set_item('language', 'armenian');
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('firstname', 'First name', 'required');
        $this->form_validation->set_rules('lastname', 'Last name', 'required');
        $this->form_validation->set_rules('up_email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('country_code', 'Country code', 'required|numeric');
        $this->form_validation->set_rules('phone_number', 'Phone number', 'required|numeric');
        $this->form_validation->set_rules('up_password','Password','required|min_length[6]');
        $this->form_validation->set_rules('confirm_password','Confirm password','required');
        $this->form_validation->set_rules('up_country','Country','required');



        if($this->form_validation->run() == false){
            //validation errors
            $n = 1;
            $validation_errors = array(
                'firstname' => form_error('firstname'),
                'lastname' => form_error('lastname'),
                'up_password' => form_error('up_password'),
                'confirm_password' => form_error('confirm_password'),
                'country_code' => form_error('country_code'),
                'phone_number' => form_error('phone_number'),
                'up_country' => form_error('up_country'),
                'up_email' => form_error('up_email')
            );
            $messages['error']['elements'][] = $validation_errors;
        }



        if($password == $confirm_password) {
            $password = $this->hash($password);
        } else {
            $n = 1;
            $validation_errors = array('confirm_password' => "passwords do not mach");
            $messages['error']['elements'][] = $validation_errors;
        }

         $sql_email_unique = "
            SELECT `id` FROM `user` WHERE `email` = ".$this->load->db_value($email)." #todo if suspended
        ";

        $query_email_unique = $this->db->query($sql_email_unique);
        $num_rows = $query_email_unique->num_rows();

        if($num_rows == 1) {
            $n = 1;
            $validation_errors = array('up_email' => "Email is not unique");
            $messages['error']['elements'][] = $validation_errors;
        }


        if($n == 1) {
            echo json_encode($messages);
            return false;
        }



        $sql = "
            INSERT INTO `user` (
              `first_name`,
              `last_name`,
              `email`,
              `country_code`,
              `phone_number`,
              `country_id`,
              `username`,
              `password`,
              `creation_date`,
              `role_id`,
              `fb_id`,
              `google_id`,
              `status`
            ) 
            VALUES
              (
                ".$this->load->db_value($firstname).",
                ".$this->load->db_value($lastname).",
                ".$this->load->db_value($email).",
                ".$this->load->db_value($country_code).",
                ".$this->load->db_value($phone_number).",
                ".$this->load->db_value($country).",
                ".$this->load->db_value($username).",
                ".$this->load->db_value($password).",
                NOW(),
                '1',
                ".$this->load->db_value($fb_id).",
                ".$this->load->db_value($google_id).",
                '1'
              )
        ";

        $query = $this->db->query($sql);

		if ($query) {
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


	/**
	 * @return bool
	 */
	public function signIn_ax()
	{

		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$this->access_denied();
			return false;
		}


		$n = 0;
		$messages['error'] = array();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$password = $this->hash($password);
		$tmp = true;


		$this->load->library('form_validation');
		// $this->config->set_item('language', 'armenian');
		$this->form_validation->set_error_delimiters('', '');

		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');


		if ($this->form_validation->run() == false) {
			//validation errors
			$n = 1;
			$validation_errors = array(

				'password' => form_error('password'),
				'email' => form_error('email')
			);
			$messages['error']['elements'][] = $validation_errors;
		}


		if ($n == 1) {
			echo json_encode($messages);
			return false;
		}


		$sql = "SELECT 
					`user`.`id`,
					`user`.`username`,
					`user`.`email`,
					`user`.`password`,
					`user`.`role_id`,
					`user`.`status`
				FROM 
					`user`				
				WHERE (`username` = '" . $email . "' 
					OR `email` = '" . $email . "')
				LIMIT 1
				";

		$query = $this->db->query($sql);

		$account = $query->row_array();
		$num = $query->num_rows();


		$sql_per = "SELECT 
					`permission`.`id`,
					`permission`.`controller`,
					`permission`.`page`,
					`permission`.`status`
				FROM 
					`role_permission`
				LEFT JOIN `role` ON  `role_permission`.`role_id` = `role`.`id` 			
				LEFT JOIN `permission` ON  `role_permission`.`permission_id` = `permission`.`id` 			
				WHERE `role`.`id` = '" . $account['role_id'] . "'
		";
		$query_per = $this->db->query($sql_per);

		$permission = $query_per->result_array();
		$per = array();
		foreach ($permission as $row_per) {
			$per['controller'][] = $row_per['controller'];
			$per['page'][] = $row_per['page'];
		}


		if ($email != $account['email'] && $email != $account['username']) {
			$validation_errors = array('email' => "You were not logged in because you entered an invalid email");
			$messages['error']['elements'][] = $validation_errors;
			echo json_encode($messages);
			return false;
		}


		if ($password != $account['password']) {
			$validation_errors = array('password' => "You were not logged in because you entered an invalid password");
			$messages['error']['elements'][] = $validation_errors;
			echo json_encode($messages);
			return false;
		}


		if ($num == 1) {


			if ($account['status'] == -2) {
				$validation_errors = array('password' => 'Your account suspended');
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;

			}

			if ($account['status'] == -1) {
				$validation_errors = array('password' => 'Your account is not active');
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}


			$sess = array(
				'user_id' => $account['id'],
				'username' => $account['username'],
				'password' => $account['password']
			);


			$session = array_merge($sess, $per);


			$this->session->set_userdata($session);


		}

		// set last activity
		$this->db->query($sql_last_activity = "UPDATE `user` SET `last_activity` = NOW() WHERE `id` = '".$account['id']."'");


		if ($tmp) {
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
