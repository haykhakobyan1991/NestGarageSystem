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

		$language_id = $this->session->language_id;

		if($language_id == '') {
			$language_id = 0;
		}

		$this->load->view('create_company');
	}


}
//end of class
