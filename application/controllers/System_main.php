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
	public function change_lang() {

		$new_lang = $this->input->post('lang');
		$current_url = $this->input->post('current_url');

		$start = 0;
		$new_url = '';
		$url_array = explode(base_url(), $current_url);
		$url = array();
		$all_lang_arr = array('hy', 'ru', 'en');
		if(isset($url_array[1])) {
			$url = explode('/', $url_array[1]);
		}



		if (in_array($url[0], $all_lang_arr)) {
			$start = 1;
		}

		for ($i = $start; $i < count($url); $i++) {
			$new_url .= '/' . $url[$i];
		}

		echo base_url() . $new_lang . $new_url;

		return true;

	}


	public function get_child ()
	{

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			return false;
		}

		$lng = $this->input->post('lang');
		$response_type = $this->input->post('response_type');
		$response = $this->input->post('response');
		$name = $this->input->post('name');
		$value = $this->input->post('value');

		$sql = "SELECT `id`, `title_" . $lng . "` AS `title` 
					FROM `" . $response . "` 
					WHERE `" . $name . "_id` = '" . $value . "' 
					ORDER BY `title`
					";

		$result = $this->db->query($sql);

		$result_array = $result->result_array();

		if ($result->num_rows() > 0) {
			if ($response_type == 'select') {
				echo '<label class=" col-form-label">Տ/մ տեսակ *</label>

						<select name="model"
								class="col selectpicker form-control form-control-sm "
								data-size="5" id="model" 
								data-live-search="true"
								title="Select a model">';
				foreach ($result_array as $row) :
					echo '<option  value="' . $row['id'] . '">' . $row['title'] . '</option>';
				endforeach;
				echo '</select>';

				echo '<script>';
				echo '$(\'#' . $response . '\').selectpicker(\'refresh\');'."\n";
				echo '$(\'.selectpicker\').parent(\'div\').children(\'button\').css({\'background\': \'#fff\', \'color\': \'#000\', \'border\': \'1px solid #ced4da\'});'."\n";
				echo '$(\'.selectpicker\').parent(\'div\').children(\'button\').removeClass(\'btn-light\');';
				echo '</script>';

			} elseif ($response_type == 'radio') {

			} elseif ($response_type == 'checkbox') {

			}
		}
	}









}
//end of class
