<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LangSwitch extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function switchLanguage($language = "lang_1") {

    	$language_id = explode('_', $language);

		$this->session->set_userdata(
			array(
				'site_lang' => $language,
				'language_id' => ($language_id[1]-1)
			)
		);
        redirect($_SERVER['HTTP_REFERER']);
    }
}
