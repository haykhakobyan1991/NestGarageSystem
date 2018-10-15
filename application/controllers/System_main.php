<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class System_main extends CI_Controller {


	public function __construct() {

        parent::__construct();

    }


	public function pre($element) {

		echo '<pre>';
			print_r($element);
		echo '</pre>';
	}


	public function access_denied() {
		$message = 'Access Denied';
		show_error($message, '403', $heading = '403 Access is prohibited');
		return false;
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
	 * @return bool
	 */
	public function get_marz() {

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$this->access_denied();
			return false;
		}

		$country = $this->input->post('value');


		$sql = "
		  SELECT 
			`id`,
			`title_hy` AS `title`,
			`status` 
		  FROM
			`marz` 
		  WHERE `country_id` = '".$country."' 
		   AND `status` = '1'
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


		$sql = "
			 SELECT 
			  `region`.`id`,
			  `region`.`title_hy` AS `title`,
			  `region`.`status` 
			FROM
			  `region` 
			  LEFT JOIN `district` 
				ON `region`.`district_id` = `district`.`id` 
			WHERE `district`.`marz_id` = '".$marz."' 
			  AND `region`.`status` = '1' 
			  AND `district`.`status` = '1' 
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




}
//end of class
