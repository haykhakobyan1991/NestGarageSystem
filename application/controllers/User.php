<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User extends CI_Controller {


	public function __construct() {

        parent::__construct();

        // load the library
        $this->load->library('layout');
    }


	public function pre($element) {

		echo '<pre>';
			print_r($element);
		echo '</pre>';
	}




	public function config() {
		$this->authorisation();
		$this->load->helper('form');
		$this->load->view('config');
		   
		
	}

	public function access_denied() {
		$message = 'Access Denied';
		show_error($message, '403', $heading = '403 Access is prohibited');
		return false;
	}


	public function hash($data) {
		return hash('sha256', $data);
	}


    /**
     * Return unical name without extension.
     * Ex: 45f7fd76
     *
     * @access public
     * @return string
     */
    private function uname() {

        return substr(md5(time() . rand()), 3, 2);

    } // End func uname


    /**
     * @param $email
     * @return mixed|string
     */
    private function generate_username($email) {

        $email_arr = explode('@', $email);
        $username = $email_arr[0].'_'.$this->uname();
        $username = str_replace(".","",$username);

        return $username;
    }




	public function db_value($value = NULL) {

		$this->load->helper('form');

		if(is_null($value)){
			return "NULL";
		}

		if($value != ''){
			return "'".$value."'";
		} else {
			return "NULL";
		}
	}

	 /**
	 * Check authorisation
     * @param null $controller
     * @param null $page
     * @param string $type
     * @return bool
	 * Passive mode $type = '1' for links // return bool
	 * Active mode $type = '2'

	*/
    public function authorisation($controller = NULL, $page = NULL, $type = '2') {
		
		$this->load->library('session');
		$this->load->helper('url');
		$user_id = $this->session->user_id;
		
		
		
		if (is_null($controller)) {
			$controller = $this->router->fetch_class();
		}
		
		if (is_null($page)) {
			$page = $this->router->fetch_method();
		}
		
		if(!$this->session->username) {
        	redirect('login', 'location');
        	$this->session->sess_destroy();
        }
		

        $sql = "SELECT 
					`permission`.`id`,
				    `permission`.`controller`,
					`permission`.`page`,
					`permission`.`status`
				FROM 
					`permission`
				LEFT JOIN `role_permission` ON `role_permission`.`permission_id` = `permission`.`id`	
				LEFT JOIN `role` ON `role_permission`.`role_id` = `role`.`id`
				LEFT JOIN `user` ON `user`.`role_id` = `role`.`id`
				WHERE `user`.`id` = '".$user_id."' AND `permission`.`status` = '1' AND `controller` = '".$controller."' AND `page` = '".$page."'
		";

        $query = $this->db->query($sql);
		
		if($query->num_rows() != 1) {
			if ($type == '1') {
				return false;
			} elseif ($type == '2') {
				redirect('access_denied', 'location');
				return false;
			}
		}

		return true;
	}


	public function index() {

		$this->authorisation();
		$this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->layout->view('dashboard');
        
        
	}

	public function login() {

		$this->load->library('session');
		$this->load->helper('url');
        $this->load->helper('form');
		$data[] = array();

        $lng = 'hy'; //todo
		$username = $this->input->post('name');
		$pass = $this->input->post('password');
		$password = $this->hash($this->input->post('password'));



		$sql_country = "
		    SELECT 
              `id`,
              `title_hy` AS `title`,
              `status` 
            FROM
              `country` 
            WHERE `status` = '1' 
		";

        $query_country = $this->db->query($sql_country);

        $result_country = $query_country->result_array();

        $data['country'] = $result_country;


		$sql = "SELECT 
					`user`.`id`,
					`user`.`username`,
					`user`.`password`,
					`user`.`role_id`,
					`user`.`status`
				FROM 
					`user`				
				WHERE (`username` = '".$username."' 
					OR `email` = '".$username."')
				LIMIT 1
				";

		$query = $this->db->query($sql);

		$account = $query->row_array();	
		$num = $query->num_rows();

		$data['username'] = $username;
		$data['password'] = $pass;

		$sql_per = "SELECT 
					`permission`.`id`,
					`permission`.`controller`,
					`permission`.`page`,
					`permission`.`status`
				FROM 
					`role_permission`
				LEFT JOIN `role` ON  `role_permission`.`role_id` = `role`.`id` 			
				LEFT JOIN `permission` ON  `role_permission`.`permission_id` = `permission`.`id` 			
				WHERE `role`.`id` = '".$account['role_id']."'
		";
		$query_per = $this->db->query($sql_per);

		$permission = $query_per->result_array();
		$per = array();
		foreach($permission as $row_per) {
			$per['controller'][] = $row_per['controller'];	
			$per['page'][] = $row_per['page'];	
		}

		

		if($username != '') {

			if ($username != $account['username'] or $password != $account['password']) {

				$data['error'] = 'You were not logged in because you entered an invalid username/password combination';
				$this->load->view('login/index', $data);
				return false;
			}
		}

		if($num == 1) {

			if (!isset($account['username']) or !isset($account['password']) or $account['username'] != $username or $account['password'] != $password) {
				 $data['error'] = 'You were not logged in because you entered an invalid username/password combination';
				 $this->load->view('login/index', $data);
				 return false;
			}

			if($account['status'] == -2) {
				 $data['error'] = 'Your account suspended';
				 $this->load->view('login/index', $data);
				 return false;

			}
		
			if($account['status'] == -1) {
				$data['error'] = 'Your account is not active';
				$this->load->view('login/index', $data);
				return false;
			}

			

			$sess = array(
				'user_id' => $account['id'],
	        	'username'  => $account['username'],
	        	'password'  => $account['password']
			);

		
			$session = array_merge($sess, $per);

			
			$this->session->set_userdata($session);
			redirect('/', 'location');

		} else {
			$data['error'] = '';
			$this->load->view('login/index', $data);
		}
		

		
	}

    /**
     * @return bool
     */
    public function logout() {

		$this->load->library('session');
		$this->session->sess_destroy();
		redirect('admin/login', 'location');
	
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
        $email = $this->input->post('email');
        $country_code = $this->input->post('country_code');
        $phone_number = $this->input->post('phone_number');
        $username = $this->generate_username($email);
        $password = $this->input->post('password');
        $confirm_password = $this->input->post('confirm_password');
        $country = $this->input->post('country');
        $marz = $this->input->post('marz');
        $region = $this->input->post('region');

        $fb_id = $this->input->post('fb_id');
        $google_id = $this->input->post('google_id');


        $this->load->library('form_validation');
        // $this->config->set_item('language', 'armenian');
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('firstname', 'First name', 'required');
        $this->form_validation->set_rules('lastname', 'Last name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('country_code', 'Country code', 'required|numeric');
        $this->form_validation->set_rules('phone_number', 'Phone number', 'required|numeric');
        $this->form_validation->set_rules('password','Password','required|min_length[6]');
        $this->form_validation->set_rules('confirm_password','Confirm password','required');
        $this->form_validation->set_rules('country','Country','required');



        if($this->form_validation->run() == false){
            //validation errors
            $n = 1;

            $validation_errors = array(
                'username' => form_error('username'),
                'firstname' => form_error('firstname'),
                'lastname' => form_error('lastname'),
                'password' => form_error('password'),
                'confirm_password' => form_error('confirm_password'),
                'country_code' => form_error('country_code'),
                'phone_number' => form_error('phone_number'),
                'country' => form_error('country'),
                'email' => form_error('email')
            );
            $messages['error']['elements'][] = $validation_errors;
        }









        if($password == $confirm_password) {
            $password = $this->hash($password);
        } else {
            $n = 1;
            $validation_errors = array('confirm_passwords' => "passwords do not mach");
            $messages['error']['elements'][] = $validation_errors;
        }

         $sql_email_unique = "
            SELECT `id` FROM `user` WHERE `email` = ".$this->db_value($email)." #todo if suspended
        ";

        $query_email_unique = $this->db->query($sql_email_unique);
        $num_rows = $query_email_unique->num_rows();

        if($num_rows == 1) {
            $n = 1;
            $validation_errors = array('email' => "Email is not unique");
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
              `marz_id`,
              `region_id`,
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
                ".$this->db_value($firstname).",
                ".$this->db_value($lastname).",
                ".$this->db_value($email).",
                ".$this->db_value($country_code).",
                ".$this->db_value($phone_number).",
                ".$this->db_value($country).",
                ".$this->db_value($marz).",
                ".$this->db_value($region).",
                ".$this->db_value($username).",
                ".$this->db_value($password).",
                NOW(),
                '1',
                ".$this->db_value($fb_id).",
                ".$this->db_value($google_id).",
                '1'
              )
        ";

        $query = $this->db->query($sql);

        if($query) {
            return true;
        } else {
            return false;
        }


        // Return success or error message
        echo json_encode($messages);
        return true;
	}

}
//end of class