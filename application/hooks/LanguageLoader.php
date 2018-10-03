<?php

/**
 * Created by PhpStorm.
 * User: Tiko
 * Date: 21.09.2018
 * Time: 18:26
 */
class LanguageLoader
{
    /**
     *
     */
    public function initialize()
    {
        $ci =& get_instance();
        $ci->load->helper('language');

        $site_lang = $ci->session->userdata('site_lang');

       if ($site_lang) {
            $ci->lang->load('index', $ci->session->userdata('site_lang'));
        } else {
            $ci->lang->load('index', 'armenian');
        }
    }
}