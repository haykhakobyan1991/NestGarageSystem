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









}
//end of class
