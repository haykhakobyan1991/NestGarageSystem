<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gps extends MX_Controller {

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



	public function gps_tracking() {

		//$this->load->authorisation('Gps', 'gps_tracking');


		$user_id = $this->session->user_id;

		$data = array();

		$lng = $this->load->lng();


		$row = $this->db->select('company_id')->from('user')->where('id', $user_id)->get()->row_array();
		$company_id = $row['company_id'];

		$sql = "
			SELECT 
			  GROUP_CONCAT(`fleet_group`.`fleet_id`) AS `fleet_id`,
			  `fleet_group`.`title`,
			  `fleet_group`.`group_id`
			FROM
			  `fleet_group` 
			WHERE `fleet_group`.`status` = 1
			 AND `fleet_group`.`company_id` = ".$this->load->db_value($company_id)."
			 GROUP BY `fleet_group`.`title` 
		";

		$query = $this->db->query($sql);


		$data['result'] = $query->result_array();


		$sql_fleets = "
			SELECT 
				`fleet`.`id`,
				CONCAT_WS(
					' ',
					`brand`.`title_".$lng."`,
					`model`.`title_".$lng."`
				) AS `brand_model`
			FROM
			   `fleet`
			LEFT JOIN `model` 
				ON `model`.`id` = `fleet`.`model_id` 
			LEFT JOIN `brand` 
				ON `brand`.`id` = `model`.`brand_id`
			LEFT JOIN `user` 
				ON `user`.`id` = `fleet`.`registrar_user_id` 	
			WHERE `user`.`company_id` = ".$this->load->db_value($company_id)."		
			 AND `fleet`.`status` = '1'	   
		";


		$query_fleets = $this->db->query($sql_fleets);

		$data['result_fleets'] = $query_fleets->result_array();

		$this->layout->view('gps_tracking/gps_tracking', $data);

	}

	public function speed() {

		//$this->load->authorisation('Gps', 'gps_tracking');

		$this->layout->view('gps_tracking/speed');

	}

	public function fuel() {
		//$this->load->authorisation('Gps', 'gps_tracking');

		$this->layout->view('gps_tracking/fuel');

	}


}
//end of class
