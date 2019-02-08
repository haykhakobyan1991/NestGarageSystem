<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MX_Controller {

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



	public function get_AllFleets() {

		$token = $this->input->post('token');

		if ($token == '') {
			return false;
		}

		$row = $this->db->select('company_id')->from('user')->where('token', $token)->get()->row_array();
		$company_id = $row['company_id'];

		$lng = $this->load->lng();

		$sql = "
				SELECT 
					`fleet`.*,
					CONCAT_WS(
						' ',
						`staff`.`first_name`,
						`staff`.`last_name`
					) AS `staff`,
					`staff`.`contact_1`,
					`department`.`title` AS `department`,
					CONCAT_WS(
						' ',
						`brand`.`title_" . $lng . "`,
						`model`.`title_" . $lng . "`
					) AS `brand_model`,
					GROUP_CONCAT(`fleet_group`.`title`) AS `fleet_group`
				FROM
				   `fleet`
				LEFT JOIN `fleet_group` 
					ON `fleet_group`.`fleet_id` = `fleet`.`id`    
				LEFT JOIN `staff` 
					ON FIND_IN_SET(
					  `staff`.`id`,
					  `fleet`.`staff_ids`
					) 
				LEFT JOIN `department`
					ON FIND_IN_SET(`department`.`id`, `staff`.`department_ids`)	  
				LEFT JOIN `model` 
					ON `model`.`id` = `fleet`.`model_id` 
				LEFT JOIN `brand` 
					ON `brand`.`id` = `model`.`brand_id`
				LEFT JOIN `user` 
					ON `user`.`id` = `fleet`.`registrar_user_id` 	
				WHERE `user`.`company_id` = " . $this->load->db_value($company_id) . "		
				 AND `fleet`.`status` = '1'	 
				 GROUP BY `fleet`.`id`
			";

		$query = $this->db->query($sql);

		echo json_encode($query->result_array());
		return true;

	}

	public function get_FleetGroup() {

		$token = $this->input->post('token');

		if ($token == '') {
			return false;
		}

		$row = $this->db->select('company_id')->from('user')->where('token', $token)->get()->row_array();
		$company_id = $row['company_id'];

		$lng = $this->load->lng();

		$sql = "
			SELECT
			  GROUP_CONCAT(`fleet_group`.`fleet_id`) AS `fleet_id`,
			  `fleet_group`.`title`,
			  `fleet_group`.`group_id`,
			  `fleet_group`.`default`
			FROM
			  `fleet_group`
			WHERE `fleet_group`.`status` = 1
			 AND `fleet_group`.`company_id` = ".$this->load->db_value($company_id)."
			 GROUP BY `fleet_group`.`title`
			 ORDER BY `fleet_group`.`default` DESC, `fleet_group`.`title`
		";

		$query = $this->db->query($sql);


		$query = $this->db->query($sql);

		echo json_encode($query->result_array());
		return true;

	}

	public function get_SingleFleet() {

		$token = $this->input->post('token');
		$fleet_id = $this->input->post('fleet_id');

		if ($token == '' || $fleet_id == '') {
			return false;
		}

		$row = $this->db->select('company_id')->from('user')->where('token', $token)->get()->row_array();
		$company_id = $row['company_id'];

		$lng = $this->load->lng();

		$sql = "
				SELECT 
					`fleet`.*,
					CONCAT_WS(
						' ',
						`brand`.`title_" . $lng . "`,
						`model`.`title_" . $lng . "`
					) AS `brand_model`
				FROM
				   `fleet`
				LEFT JOIN `model` 
					ON `model`.`id` = `fleet`.`model_id` 
				LEFT JOIN `brand` 
					ON `brand`.`id` = `model`.`brand_id`
				LEFT JOIN `user` 
					ON `user`.`id` = `fleet`.`registrar_user_id` 	
				WHERE `user`.`company_id` = " . $this->load->db_value($company_id) . "	
				 AND `fleet`.`id` = " . $this->load->db_value($fleet_id) . "	
				 AND `fleet`.`status` = '1'	   
			";

		$query = $this->db->query($sql);

		echo json_encode($query->row_array());
		return true;

	}

	public function get_user() {

		$token = $this->input->post('token');

		if ($token == '') {
			return false;
		}

		$row = $this->db->select('CONCAT_WS(" ", user.first_name, user.last_name) AS name')
		->from('user')
		->where('token', $token)
		->get()
		->row_array();

		echo json_encode($row);
		return true;


	}


	public function authorisation()
	{

		$controller = $this->input->post('controller');
		$page = $this->input->post('page');
		$type = $this->input->post('type');
		$token = $this->input->post('token');

		$this->load->library('session');
		$this->load->helper('url');


		if ($token == '' || $page == '' || $controller == '') {
			echo 'logout';
			return false;
		}


		$sql = "SELECT 
					`permission`.`id`,
				    `permission`.`controller`,
				    `permission`.`title_" . $this->load->lng() . "` AS `title`,
					`permission`.`page`,
					`permission`.`status`
				FROM 
					`permission`
				LEFT JOIN `role_permission` ON `role_permission`.`permission_id` = `permission`.`id`	
				LEFT JOIN `role` ON `role_permission`.`role_id` = `role`.`id`
				LEFT JOIN `user` ON `user`.`role_id` = `role`.`id`
				WHERE `user`.`token` = '" . $token . "' AND `permission`.`status` = '1' AND `controller` = '" . $controller . "' AND `page` = '" . $page . "'
		";

		$query = $this->db->query($sql);
		$row = $query->row_array();




		if ($query->num_rows() != 1) {
			if ($type == '1') {
				echo 'false';
				return false;
			} elseif ($type == '2') {
				echo 'access_denied';
				return false;
			}
		}

		if($type == '2') {
			echo $row['title'];
			return true;
		}


		echo 'true';
		return true;
	}


	public function get_companyId()
	{

		$token = $this->input->post('token');

		if ($token == '') {
			return false;
		}

		$row = $this->db->select('company_id')->from('user')->where('token', $token)->get()->row_array();
		echo $row['company_id'];
		return true;
	}




}
//end of class
