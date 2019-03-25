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

		$language = $this->load->get_language($lng);

		$this->config->set_item('language', $language);

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


	/**
	 * @param $folder
	 * @return bool
	 */
	private function folder($folder) {

		if (!file_exists(set_realpath('uploads/'.$folder.'/'))) {
			mkdir(set_realpath('uploads/' . $folder . '/'), 0755, true);
			//chmod(set_realpath('uploads/' . $folder . '/'), 0755);
			copy(set_realpath('uploads/index.html'), set_realpath('uploads/'.$folder.'/index.html'));
		}

		if (!file_exists(set_realpath('uploads/'.$folder.'/company/'))) {
			mkdir(set_realpath('uploads/' . $folder . '/company/'), 0755, true);
			//chmod(set_realpath('uploads/' . $folder . '/company/'), 0755);
			copy(set_realpath('uploads/index.html'), set_realpath('uploads/'.$folder.'/company/index.html'));
		}

		if (!file_exists(set_realpath('uploads/'.$folder.'/fleet/'))) {
			mkdir(set_realpath('uploads/' . $folder . '/fleet/'), 0755, true);
			//chmod(set_realpath('uploads/' . $folder . '/fleet/'), 0755);
			copy(set_realpath('uploads/index.html'), set_realpath('uploads/'.$folder.'/fleet/index.html'));
		}

		if (!file_exists(set_realpath('uploads/'.$folder.'/staff/'))) {
			mkdir(set_realpath('uploads/' . $folder . '/staff/'), 0755, true);
			//chmod(set_realpath('uploads/' . $folder . '/staff/'), 0755);
			copy(set_realpath('uploads/index.html'), set_realpath('uploads/'.$folder.'/staff/index.html'));
		}

		if (!file_exists(set_realpath('uploads/'.$folder.'/user/'))) {
			mkdir(set_realpath('uploads/' . $folder . '/user/'), 0755, true);
			//chmod(set_realpath('uploads/' . $folder . '/staff/'), 0755);
			copy(set_realpath('uploads/index.html'), set_realpath('uploads/'.$folder.'/user/index.html'));
		}


		return true;

	}




	public function index() {

        $this->load->library('session');
		$this->load->helper(array('form', 'url', 'captcha'));
        $data[] = array();

        $lng = $this->load->lng();

		//captcha
		$captcha = $this->_generateCaptcha();
		$data['captcha'] = $captcha;
		$this->session->set_userdata('captchaWord', $captcha['word']);



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
        $pass = $this->input->post('up_password');
        $password = $this->input->post('up_password');
        $confirm_password = $this->input->post('confirm_password');
        $country = $this->input->post('up_country');
		$folder = $this->uname(3,8); //unique chars length 8  (example: a5f7fd76)



        $fb_id = $this->input->post('fb_id');
        $google_id = $this->input->post('google_id');


        $this->load->library('form_validation');
        // $this->config->set_item('language', 'armenian');
        $this->form_validation->set_error_delimiters('<div>', '</div>');
        $this->form_validation->set_rules('firstname', 'First name', 'required_all');
        $this->form_validation->set_rules('lastname', 'Last name', 'required_all');
        $this->form_validation->set_rules('up_email', 'lang:email', 'required_all|valid_email');
        $this->form_validation->set_rules('country_code', 'Country code', 'required_all|numeric');
        $this->form_validation->set_rules('phone_number', 'Phone number', 'required_all|numeric');
        $this->form_validation->set_rules('up_password','Password','required_all|min_length[6]');
        $this->form_validation->set_rules('confirm_password','Confirm password','required_all');
        $this->form_validation->set_rules('up_country','Country','required_all');



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
			asort($validation_errors); //todo
            $messages['error']['elements'][] = $validation_errors;
        }



        if($password == $confirm_password) {
            $password = $this->hash($password);
        } else {
            $n = 1;
            $validation_errors = array('confirm_password' => lang('passwords_not_mach'));
            $messages['error']['elements'][] = $validation_errors;
        }

         $sql_email_unique = "
            SELECT `id` FROM `user` WHERE `email` = ".$this->load->db_value($email)." #todo if suspended
        ";

        $query_email_unique = $this->db->query($sql_email_unique);
        $num_rows = $query_email_unique->num_rows();

        if($num_rows == 1) {
            $n = 1;
            $validation_errors = array('up_email' => lang('email_not_unique')); //todo ml
            $messages['error']['elements'][] = $validation_errors;
        }


        if($n == 1) {
            echo json_encode($messages);
            return false;
        }


        // mailing

		$this->smtp_mailing();

		$this->email->to($email);
		$this->email->subject('(Fleet management system) Your account is created');
		$this->email->message(
			'Username: '.$username.'<br />'.
			'Password: '.$pass
		);

		if(!$this->email->send()) {
			$messages['success'] = 0;
			$messages['error'] = $this->email->print_debugger();
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
              `folder`,
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
                ".$this->load->db_value($folder).",
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
		$this->load->helper(array('form', 'url', 'captcha'));
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$password = $this->hash($password);
		$tmp = true;


		$this->load->library('form_validation');
		// $this->config->set_item('language', 'armenian');
		$this->form_validation->set_error_delimiters('', '');

		$this->form_validation->set_rules('email', 'lang:email', 'required_single');
		$this->form_validation->set_rules('password', 'lang:password', 'required_single');
		$this->form_validation->set_rules('captcha', 'Captcha', 'required_single');

		$word = $this->session->captchaWord;
		$code = $this->input->post('captcha');

		if (strtolower($code) != strtolower($word)) {
			$n = 1;
			$validation_errors = array('captcha' =>  lang('captcha_incorrect'));
			$messages['error']['elements'][] = $validation_errors;

		}




		if ($this->form_validation->run() == false) {
			//validation errors
			$n = 1;
			$validation_errors = array(
				'password' => form_error('password'),
				'email' => form_error('email'),
				'captcha' => form_error('captcha')
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
					`user`.`folder`,
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
			$validation_errors = array('email' => lang('invalid_email'));
			$messages['error']['elements'][] = $validation_errors;
			echo json_encode($messages);
			return false;
		}


		if ($password != $account['password']) {
			$validation_errors = array('password' => lang('invalid_password'));
			$messages['error']['elements'][] = $validation_errors;
			echo json_encode($messages);
			return false;
		}


		if ($num == 1) {


			if ($account['status'] == -2) {
				$validation_errors = array('password' => lang('your_account_suspended'));
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;

			}

			if ($account['status'] == -1) {
				$validation_errors = array('password' => lang('account_not_active'));
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}



			$this->folder($account['folder']); //create folders

			$sess = array(
				'user_id' => $account['id'],
				'folder' => $account['folder'],
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



	public function login_google_ax() {

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$this->access_denied();
			return false;
		}

		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$email = $this->input->post('email');
		$google_photo = $this->input->post('google_photo');
		$google_id = $this->input->post('google_id');
		$username = $this->generate_username($email);
		$messages['success'] = 1;

		$user_id = '';






		$sql_email = "
            SELECT `id` FROM `user` WHERE `email` = '".$email."'
        ";

		$query = $this->db->query($sql_email);


		$num_rows = $query->num_rows();

		if($num_rows > '0') {

			$row = $query->row_array();
			$user_id = $row['id'];

			$sql = "
                UPDATE `user`
					SET 
					 `photo` = ".$this->load->db_value($google_photo).",
					 `google_id` = ".$this->load->db_value($google_id)."
				WHERE  `email` = ".$this->load->db_value($email)."
		    ";


			$result = $this->db->query($sql);

			if(!$result) {
				$messages['success'] = 0;
				$messages['error'] = 'Error';
				echo json_encode($messages);
				return false;
			}

		} else {

			$folder = $this->uname(3,8); //unique chars length 8  (example: a5f7fd76)

			$sql = "INSERT INTO `user`
					SET 
					 `role_id` = '1',
					 `first_name` = ".$this->load->db_value($first_name).",
					 `last_name` = ".$this->load->db_value($last_name).",
					 `email` = ".$this->load->db_value($email).",
					 `photo` = ".$this->load->db_value($google_photo).",
					 `google_id` = ".$this->load->db_value($google_id).",
					 `folder` = ".$this->load->db_value($folder).",
					 `username` = ".$this->load->db_value($username).",
					 `status` = '1'";

			$result = $this->db->query($sql);

			$user_id = $this->db->insert_id();

			if(!$result) {
				$messages['success'] = 0;
				$messages['error'] = 'Error';
				echo json_encode($messages);
				return false;
			}
		}



		$session = array(
			'google_id'  => $google_id,
			'google_photo'  => $google_photo,
			'username' => $username,
			'user_id' => $user_id
		);


		$this->session->set_userdata($session);


		echo json_encode($messages);
		return true;
	}

	public function login_fb_ax() {

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$this->access_denied();
			return false;
		}

		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$email = $this->input->post('email');
		$fb_photo = $this->input->post('fb_photo');
		$fb_id = $this->input->post('fb_id');
		$username = $this->generate_username($email);
		$messages['success'] = 1;

		$user_id = '';






		$sql_email = "
            SELECT `id` FROM `user` WHERE `email` = '".$email."'
        ";

		$query = $this->db->query($sql_email);


		$num_rows = $query->num_rows();

		if($num_rows > '0') {

			$row = $query->row_array();
			$user_id = $row['id'];

			$sql = "
                UPDATE `user`
					SET 
					 `photo` = ".$this->load->db_value($fb_photo).",
					 `fb_id` = ".$this->load->db_value($fb_id)."
				WHERE  `email` = ".$this->load->db_value($email)."
		    ";


			$result = $this->db->query($sql);

			if(!$result) {
				$messages['success'] = 0;
				$messages['error'] = 'Error';
				echo json_encode($messages);
				return false;
			}

		} else {

			$folder = $this->uname(3,8); //unique chars length 8  (example: a5f7fd76)

			$sql = "INSERT INTO `user`
					SET 
					 `role_id` = '1',
					 `first_name` = ".$this->load->db_value($first_name).",
					 `last_name` = ".$this->load->db_value($last_name).",
					 `email` = ".$this->load->db_value($email).",
					 `photo` = ".$this->load->db_value($fb_photo).",
					 `fb_id` = ".$this->load->db_value($fb_id).",
					 `folder` = ".$this->load->db_value($folder).",
					 `username` = ".$this->load->db_value($username).",
					 `status` = '1'";

			$result = $this->db->query($sql);

			$user_id = $this->db->insert_id();

			if(!$result) {
				$messages['success'] = 0;
				$messages['error'] = 'Error';
				echo json_encode($messages);
				return false;
			}
		}


		$session = array(
			'fb_id'  => $fb_id,
			'fb_photo'  => $fb_photo,
			'username' => $username,
			'user_id' => $user_id
		);

		$this->session->set_userdata($session);

		echo json_encode($messages);
		return true;
	}



	public function _generateCaptcha() {
		$values = array(
			'img_path' => set_realpath('assets/img/captcha/'),
			'img_url' => base_url('assets/img/captcha/'),
			'font_path' => set_realpath('system/fonts/GHEAGrpalatReg.ttf'),
			'img_width' => '150',
			'img_height' => 50,
			'expiration' => 7200,
			'font_size'	=> 16,
			'captcha_case_sensitive' => true,
			'colors'	=> array(
				'background'	=> array(255,255,255),
				'border'	=> array(206,212,218),
				'text'		=> array(40,167,69),
				'grid'		=> array(255,193,7)
			)
		);
		/* Generate the captcha */
		return create_captcha($values);
	}


	public function refresh() {

		$this->load->helper('captcha');
		// Captcha configuration
		$values = array(
			'img_path' => set_realpath('assets/img/captcha/'),
			'img_url' => base_url('assets/img/captcha/'),
			'font_path' => set_realpath('system/fonts/GHEAGrpalatReg.ttf'),
			'img_width' => '150',
			'img_height' => 50,
			'expiration' => 3600,
			'font_size'	=> 16,
			'captcha_case_sensitive' => true,
			'colors'	=> array(
				'background'	=> array(255,255,255),
				'border'	=> array(206,212,218),
				'text'		=> array(40,167,69),
				'grid'		=> array(255,193,7)
			)
		);
		$captcha = create_captcha($values);

		// Unset previous captcha and set new captcha word
		$this->session->unset_userdata('captchaWord');
		$this->session->set_userdata('captchaWord', $captcha['word']);

		// Display captcha image
		echo $captcha['image'];
	}


}
//end of class
