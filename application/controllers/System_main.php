<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class System_main extends CI_Controller {


	/**
	 * System_main constructor.
	 */
	public function __construct() {

        parent::__construct();

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
	 * @return bool
	 */
	public function get_marz() {

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$this->access_denied();
			return false;
		}

		$country = $this->input->post('value');
		$lng = $this->load->lng();


		$sql = "
		  SELECT 
			`id`,
			`title_".$lng."` AS `title`,
			`status` 
		  FROM
			`marz` 
		  WHERE `country_id` = '".$country."' 
		   AND `status` = '1'
		  ORDER BY `title_".$lng."` 
		";

		$query = $this->db->query($sql);
		$result = $query->result_array();

		if ($country == '12' || $country == '82' || $country == '103'):

			echo '<select class="form-control form-control-sm Child" name="marz">';
			echo '<option value="">Select Marz ... </option>';
			foreach ($result as $row) :
				echo '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
			endforeach;
			echo '</select>';


		endif;

		return true;
	}


	/**
	 * @return bool
	 */
	public function get_region() {

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$this->access_denied();
			return false;
		}

		$marz = $this->input->post('value');

		$lng = $this->load->lng();


		$sql = "
			 SELECT 
			  `region`.`id`,
			  `region`.`title_".$lng."` AS `title`,
			  `region`.`status` 
			FROM
			  `region` 
			  LEFT JOIN `district` 
				ON `region`.`district_id` = `district`.`id` 
			WHERE `district`.`marz_id` = '".$marz."' 
			  AND `region`.`status` = '1' 
			  AND `district`.`status` = '1' 
			ORDER BY `region`.`title_".$lng."`
		";

		$query = $this->db->query($sql);
		$num = $query->num_rows();
		$result = $query->result_array();

		if ($marz != '' && $num > 0) :

			echo '<select class="form-control form-control-sm Child" name="region">';
			echo '<option value="">Select Region ... </option>';
			foreach ($result as $row) :
				echo '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
			endforeach;
			echo '</select>';


		endif;

		return true;
	}


	/**
	 * @return bool
	 */
	public function change_lang() {

		$new_lang = $this->input->post('lang');
		$current_url = $this->input->post('current_url');

		$start = 0;
		$new_url = '';
		$url_array = explode(base_url(), $current_url);
		$all_lang_arr = array('hy', 'ru', 'en');
		$url = explode('/', $url_array[1]);


		if (in_array($url[0], $all_lang_arr)) {
			$start = 1;
		}

		for ($i = $start; $i < count($url); $i++) {
			$new_url .= '/' . $url[$i];
		}

		echo base_url() . $new_lang . $new_url;

		return true;

	}









}
//end of class
