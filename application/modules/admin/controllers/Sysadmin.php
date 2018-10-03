<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Sysadmin extends CI_Controller {


	/**
	 * sysadmin constructor.
	 */
	public function __construct() {

		parent::__construct();

		// load the library
		$this->load->library('layout');
		// load the helper
		$this->load->helper('url');

	}

	/**
	 * Valid URL
	 *
	 * @param	string	$str
	 * @return	bool
	 */
	public function valid_url($str) {

		if (filter_var($str, FILTER_VALIDATE_URL)) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * @param $element
	 */
	private function pre($element) {

		echo '<pre>';
		print_r($element);
		echo '</pre>';
	}

	/**
	 * Return unical name without extension.
	 * Ex: 45f7fd76
	 *
	 * @access public
	 * @return string
	 */
	private function uname() {

		return substr(md5(time() . rand()), 3, 8);

	} // End func uname

	/**
	 * @return mixed
	 */
	private function upload_config() {


		$config['allowed_types']        = 'ioc|jpg|png';
		$config['max_size'] 			= '2097152'; //2 MB
		$config['file_name']			= $this->uname();
		$config['max_width']            = '2048';
		$config['max_height']           = '1400';

		$this->load->library('upload', $config);

		$this->upload->initialize($config);

		return $config;

	}

	public function config() {
		$this->authorisation();
		$this->load->helper('form');
		$this->layout->view('config');


	}

	/**
	 * @return bool
	 */
	public function access_denied() {
		$message = 'Մուտքը արգելված է';
		show_error($message, '403', $heading = '403');
		return false;
	}

	/**
	 * @param $data
	 * @return string
	 */
	public function hash($data) {
		return md5($data);
	}

	/**
	 * @param null $value
	 * @return string
	 */
	public function db_value($value = NULL) {

		$this->load->helper('form');

		$value = str_replace("'", "\'", $value);
		//$value = stripslashes($value);

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
	public function authorisation() {

		$this->load->library('session');
		$this->load->helper('url');


		if(!$this->session->username) {
			redirect('admin/login', 'location');
			$this->session->sess_destroy();
		}

		return true;
	}

	public function web() {

		$this->authorisation();
		$this->load->helper('url');
		$this->load->helper('form');
		$data = array();

		$sql = "
        	SELECT 
			  `web`.`language_id`,
			  `language`.`title` AS `language`,
			  `language`.`status` AS `language_status`,
			  `web`.`favicon`,
			  `web`.`website_name`,
			  `web`.`meta_desc`,
			  `web`.`key_word` 
			FROM
			  `web` 
			  LEFT JOIN `language` 
				ON `language`.`id` = `web`.`language_id` 
			WHERE `web`.`status` = 1 
        ";

		$query = $this->db->query($sql);


		$sql_chat = "
			SELECT 
			  `chat`.`language_id`,
			  `chat`.`title`,
			  `chat`.`photo`,
			  `chat`.`mail_to`,
			  `chat`.`form_title`,
			  `chat`.`form_name`,
			  `chat`.`form_email`,
			  `chat`.`form_country_code`,
			  `chat`.`form_phone_number`,
			  `chat`.`form_button`,
			  `chat`.`success_message`,
			  `chat`.`status`
			FROM
			  `chat` 
			  LEFT JOIN `language` 
				ON `language`.`id` = `chat`.`language_id` 
			WHERE 1 
		";

		$query_chat = $this->db->query($sql_chat);


		$result = $query->result_array();
		$result_chat = $query_chat->result_array();

		$data['result'] = $result;
		$data['result_chat'] = $result_chat;


		$this->layout->view('web', $data, 'edit');

	}

	public function web_ax() {

		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');
		$n = 0;

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}


		$this->load->library('image_lib');
		$config = $this->upload_config();
		$config['upload_path'] = set_realpath('assets/img');


		$this->load->library('form_validation');
		// $this->config->set_item('language', 'armenian');
		$this->form_validation->set_error_delimiters('<div>', '</div>');
		$this->form_validation->set_rules('language_1', 'Language 1', 'required');
		$this->form_validation->set_rules('language_2', 'Language 2', 'required');
		//	 $this->form_validation->set_rules('mail_to', 'Mail To', 'required|valid_email');


		$mail_allow = $this->input->post('mail_allow'); // allow mail form
		$allow = $this->input->post('allow'); //allow language 2
		// where mail form is allow
		if($mail_allow == 'on') {
			$this->form_validation->set_rules('mail_to', 'Mail To', 'required|valid_email');

			$this->form_validation->set_rules('title_chat_1', 'Text Lang 1', 'required');
			$this->form_validation->set_rules('name_1', 'Name Lang 1', 'required');
			$this->form_validation->set_rules('email_1', 'Email Lang 1', 'required');
			$this->form_validation->set_rules('country_code_1', 'Country code Lang 1', 'required');
			$this->form_validation->set_rules('phone_number_1', 'Phone number Lang 1', 'required');
			$this->form_validation->set_rules('button_1', 'Button Lang 1', 'required');

			// where language 2 is allow
			if ($allow == 'on') {
				$this->form_validation->set_rules('title_chat_2', 'Text Lang 1', 'required');
				$this->form_validation->set_rules('name_2', 'Name Lang 2', 'required');
				$this->form_validation->set_rules('email_2', 'Email Lang 2', 'required');
				$this->form_validation->set_rules('country_code_2', 'Country code Lang 2', 'required');
				$this->form_validation->set_rules('phone_number_2', 'Phone number Lang 2', 'required');
				$this->form_validation->set_rules('button_2', 'Button Lang 2', 'required');
			}
		}



		if($this->form_validation->run() == false){
			//validation errors

			$validation_errors = array(
				'language_1' => form_error('language_1'),
				'language_2' => form_error('language_2')
			);

			// where mail for is allow
			if ($mail_allow == 'on') {
				$validation_errors = array_merge(
					$validation_errors,
					array(
						'mail_to' => form_error('mail_to'),
						'title_chat_1' => form_error('title_chat_1'),
						'name_1' => form_error('name_1'),
						'email_1' => form_error('email_1'),
						'country_code_1' => form_error('country_code_1'),
						'phone_number_1' => form_error('phone_number_1'),
						'button_1' => form_error('button_1')
					)
				);
				// where language 2 is allow
				if ($allow == 'on') {
					$validation_errors = array_merge(
						$validation_errors,
						array(
							'title_chat_2' => form_error('title_chat_2'),
							'name_2' => form_error('name_2'),
							'email_2' => form_error('email_2'),
							'country_code_2' => form_error('country_code_2'),
							'phone_number_2' => form_error('phone_number_2'),
							'button_2' => form_error('button_2')
						)
					);
				}

			}

			$messages['error']['elements'][] = $validation_errors;

			echo json_encode($messages);
			return false;
		}




		$language_1 = $this->input->post('language_1');
		$language_2 = $this->input->post('language_2');

		$language_arr = array(
			'1' => $language_1,
			'2' => $language_2
		);


		$website_name_1 = $this->input->post('website_name_1');
		$website_name_2 = $this->input->post('website_name_2');

		$meta_1 = $this->input->post('meta_1');
		$meta_2 = $this->input->post('meta_2');


		$key_words_1 = $this->input->post('key_words_1');
		$key_words_2 = $this->input->post('key_words_2');




		if(isset($_FILES['favicon']['name']) AND $_FILES['favicon']['name'] != '') {
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('favicon')) {
				$validation_errors = array('favicon' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}



			$photo_arr = $this->upload->data();

			$image = $photo_arr['file_name'];

			$sql_favicon = "
				UPDATE `web` SET `favicon` = " . $this->db_value($image) . " WHERE 1
			";
			$result_favicon = $this->db->query($sql_favicon);

			if (!$result_favicon) {
				$messages['success'] = 0;
				$messages['error'] = 'Error N 1';
				echo json_encode($messages);
				return false;
			}


		}

		$add_sql = '';

		foreach ($language_arr as $lang_id => $language) {
			if ($allow != 'on' and $lang_id == 2) {
				$add_sql .= "`status` = '-1',";
			} else {
				$add_sql .= "`status` = '1',";
			}

			$sql_lang = "
				UPDATE `language` SET " . $add_sql . " `title` = " . $this->db_value($language) . " WHERE `id` = " . $this->db_value($lang_id) . "
			";
			$result_lang = $this->db->query($sql_lang);


			if (!$result_lang) {
				$messages['success'] = 0;
				$messages['error'] = 'Error N ' . $lang_id;
				echo json_encode($messages);
				return false;
			}


		}



		$sql_web1 = "UPDATE `web`
					SET 
					 `website_name` = ".$this->db_value($website_name_1).",
					 `meta_desc` = ".$this->db_value($meta_1).",
					 `key_word` = ".$this->db_value($key_words_1)."
				WHERE `status` = '1' AND `language_id` = '1'";


		$result_web1 = $this->db->query($sql_web1);



		if (!$result_web1) {
			$messages['success'] = 0;
			$messages['error'] = 'Error';
			echo json_encode($messages);
			return false;
		}


		$sql_web2 = "UPDATE `web`
					SET 
					 `website_name` = ".$this->db_value($website_name_2).",
					 `meta_desc` = ".$this->db_value($meta_2).",
					 `key_word` = ".$this->db_value($key_words_2)."
				WHERE `status` = '1' AND `language_id` = '2'";


		$result_web2 = $this->db->query($sql_web2);

		if (!$result_web2) {
			$messages['success'] = 0;
			$messages['error'] = 'Error';
			echo json_encode($messages);
			return false;
		}


		// chat info
		$mail_to = $this->input->post('mail_to');
		$add_sql_chat = '';

		if($mail_allow != 'on') {
			$add_sql_chat .= "`status` = '-1',";
		} else {
			$add_sql_chat .= "`status` = '1',";
		}

		//chat icon
		$chat_icon = '';
		if(isset($_FILES['chat_icon']['name']) AND $_FILES['chat_icon']['name'] != '') {

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('chat_icon')) {
				$validation_errors = array('chat_icon' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}



			$chat_icon_arr = $this->upload->data();

			$chat_icon = $chat_icon_arr['file_name'];


			$add_sql_chat .= "`photo` = ".$this->db_value($chat_icon).",";


		}

		$sql_chat = "
			UPDATE `chat` 
				SET ".$add_sql_chat." 
				`mail_to` = ".$this->db_value($mail_to)."
			WHERE 1	
		";

		$result_chat = $this->db->query($sql_chat);


		if (!$result_chat) {
			$messages['success'] = 0;
			$messages['error'] = 'Error chat';
			echo json_encode($messages);
			return false;
		}


		// chat form
		$chat_title_1 = $this->input->post('order_1');
		$chat_title_2 = $this->input->post('order_2');

		$chat_form_title_1 = $this->input->post('title_chat_1');
		$chat_form_title_2 = $this->input->post('title_chat_2');
		$chat_form_name_1 = $this->input->post('name_1');
		$chat_form_name_2 = $this->input->post('name_2');
		$chat_form_email_1 = $this->input->post('email_1');
		$chat_form_email_2 = $this->input->post('email_2');
		$chat_form_country_code_1 = $this->input->post('country_code_1');
		$chat_form_country_code_2 = $this->input->post('country_code_2');
		$chat_form_phone_number_1 = $this->input->post('phone_number_1');
		$chat_form_phone_number_2 = $this->input->post('phone_number_2');
		$chat_form_button_1 = $this->input->post('button_1');
		$chat_form_button_2 = $this->input->post('button_2');
		$success_message_1 = $this->input->post('success_message_1');
		$success_message_2 = $this->input->post('success_message_2');

		$chat_lang_arr = array(
			'1' => array(
				'title' => $chat_title_1,
				'form_title' => $chat_form_title_1,
				'form_name' => $chat_form_name_1,
				'form_email' => $chat_form_email_1,
				'form_country_code' => $chat_form_country_code_1,
				'form_phone_number' => $chat_form_phone_number_1,
				'success_message' => $success_message_1,
				'form_button' => $chat_form_button_1
			),
			'2' => array(
				'title' => $chat_title_2,
				'form_title' => $chat_form_title_2,
				'form_name' => $chat_form_name_2,
				'form_email' => $chat_form_email_2,
				'form_country_code' => $chat_form_country_code_2,
				'form_phone_number' => $chat_form_phone_number_2,
				'success_message' => $success_message_2,
				'form_button' => $chat_form_button_2
			)
		);

		foreach ($chat_lang_arr as $lang_id => $value) {
			$sql_chat_form = "
				UPDATE `chat` SET 
					`title` = ".$this->db_value($value['title']).",
					`form_title` = ".$this->db_value($value['form_title']).",
					`form_name` = ".$this->db_value($value['form_name']).",
					`form_email` = ".$this->db_value($value['form_email']).",
					`form_country_code` = ".$this->db_value($value['form_country_code']).",
					`form_phone_number` = ".$this->db_value($value['form_phone_number']).",
					`success_message` = ".$this->db_value($value['success_message']).",
					`form_button` = ".$this->db_value($value['form_button'])."
				WHERE `language_id` = '".$lang_id."'	
			";

			$result_chat_form = $this->db->query($sql_chat_form);

			if (!$result_chat_form) {
				$messages['success'] = 0;
				$messages['error'] = 'Error chat form '.$language_1;
				echo json_encode($messages);
				return false;
			}

		}




		if ($result_web2) {
			$messages['success'] = 1;
			$messages['message'] = 'Success';
		} else {
			$messages['success'] = 0;
			$messages['error'] = 'Error';
		}

		// Return success or error message
		echo json_encode($messages);
		return true;
	}

	public function faq() {

		$this->authorisation();
		$this->load->helper('url');
		$this->load->helper('form');
		$data = array();


		$sql = "
        	SELECT 
			  `id`,
			  `language_id`,
			  `title`,
			  `text` 
			FROM
			  `faq` 
			WHERE `status` = '1' 
        ";

		$query = $this->db->query($sql);
		$result = $query->result_array();

		$data['result'] = $result;





		$this->layout->view('faq', $data, 'edit');

	}

	public function faq_ax() {

		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');
		$n = 0;

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}


		$result = true;
		$this->load->library('image_lib');
		$config = $this->upload_config();
		$config['upload_path'] = set_realpath('assets/img');


		$this->load->library('form_validation');
		// $this->config->set_item('language', 'armenian');
		$this->form_validation->set_error_delimiters('<div>', '</div>');



		// 2 Լեզվի ստուգում
		$sql_lng = "SELECT status FROM `language` WHERE `id` = '2'";
		$query_lng = $this->db->query($sql_lng);
		$row = $query_lng->row_array();
		$allow = $row['status']; //allow language 2

		$title_1 = $this->input->post('title_1');
		$title_2 = $this->input->post('title_2');

		$text_1 = $this->input->post('text_1');
		$text_2 = $this->input->post('text_2');


		foreach ($title_1 as $key1 => $value1) {

			$this->form_validation->set_rules('title_1[' . $key1 . ']', 'Title lang 1', 'required');
			$this->form_validation->set_rules('text_1[' . $key1 . ']', 'Text lang 1', 'required');

			if ($this->form_validation->run() == false) {

				//validation errors
				$validation_errors = array(
					'title_1[' . $key1 . ']' => form_error('title_1[' . $key1 . ']'),
					'text_1[' . $key1 . ']' => form_error('text_1[' . $key1 . ']')
				);

				$messages['error']['elements'][] = $validation_errors;

				echo json_encode($messages);
				return false;
			}


			$sql_faq = "
				SELECT `id` FROM `faq` WHERE `language_id` = '1'
			";

			$query_faq = $this->db->query($sql_faq);
			$num_rows = $query_faq->num_rows();

			if ($num_rows > 0) {
				foreach ($query_faq->result() as $item) {
					$sql_faq_update = "UPDATE `faq` SET `status` = '-1' WHERE `id` = '" . $item->id . "'";
					$query_faq_update = $this->db->query($sql_faq_update);
					if (!$query_faq_update) {
						$messages['success'] = 0;
						$messages['error'] = 'Error faq update id - ' . $item->id;
						echo json_encode($messages);
						return false;
					}
				}
			}
		}

		foreach ($title_1 as $key1 => $value1) {
			$sql_faq_insert = "
				INSERT INTO `faq`
					SET 
					 `title` = ".$this->db_value($value1).",
					 `language_id` = '1',
					 `text` = ".$this->db_value($text_1[$key1]).",
					 `status` = '1'
			";


			$result_faq_insert = $this->db->query($sql_faq_insert);

			if (!$result_faq_insert) {
				$messages['success'] = 0;
				$messages['error'] = 'Error faq insert';
				echo json_encode($messages);
				return false;
			}

		}


		foreach ($title_2 as $key2 => $value2) {

			// where language 2  allow
			if ($allow == '1') {
				$this->form_validation->set_rules('title_2[' . $key2 . ']', 'Title lang 2', 'required');
				$this->form_validation->set_rules('text_2[' . $key2 . ']', 'Text lang 2', 'required');

			}

			if ($this->form_validation->run() == false) {


				// where language 2  allow
				if ($allow == '1') {
					$validation_errors = array(
						'title_2[' . $key2 . ']' => form_error('title_2[' . $key2 . ']'),
						'text_2[' . $key2 . ']' => form_error('text_2[' . $key2 . ']')
					);
				}

				$messages['error']['elements'][] = $validation_errors;

				echo json_encode($messages);
				return false;
			}


			$sql_faq = "
				SELECT `id` FROM `faq` WHERE `language_id` = '2'
			";

			$query_faq = $this->db->query($sql_faq);
			$num_rows = $query_faq->num_rows();

			if ($num_rows > 0) {
				foreach ($query_faq->result() as $item) {
					$sql_faq_update = "UPDATE `faq` SET `status` = '-1' WHERE `id` = '" . $item->id . "'";
					$query_faq_update = $this->db->query($sql_faq_update);
					if (!$query_faq_update) {
						$messages['success'] = 0;
						$messages['error'] = 'Error faq update id - ' . $item->id;
						echo json_encode($messages);
						return false;
					}
				}
			}
		}


		foreach ($title_2 as $key2 => $value2) {
			$sql_faq_insert = "
				INSERT INTO `faq`
					SET 
					 `title` = ".$this->db_value($value2).",
					 `language_id` = '2',
					 `text` = ".$this->db_value($text_2[$key2]).",
					 `status` = '1'
			";


			$result_faq_insert = $this->db->query($sql_faq_insert);

			if (!$result_faq_insert) {
				$messages['success'] = 0;
				$messages['error'] = 'Error faq insert';
				echo json_encode($messages);
				return false;
			}


		}



		if ($result) {
			$messages['success'] = 1;
			$messages['message'] = 'Success';
		} else {
			$messages['success'] = 0;
			$messages['error'] = 'Error';
		}

		// Return success or error message
		echo json_encode($messages);
		return true;
	}

	public function main() {

		$this->authorisation();
		$this->load->helper('url');
		$this->load->helper('form');
		$data = array();


		$sql = "
        	SELECT
			  `language_id`,
			  `button_1`,
			  `button_2`,
			  `button_2_url`,
			  `title`,
			  `main_text`,
			  `font_url`,
			  `font_css`,
			  `background_img`,
			  `status`
			FROM `main`
			WHERE `main`.`status` = 1
			LIMIT 2
        ";

		$query = $this->db->query($sql);
		$result = $query->result_array();

		$data['result'] = $result;

		$this->layout->view('main', $data, 'edit');

	}

	/**
	 * @return bool
	 */
	public function main_ax() {

		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');
		$n = 0;

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}


		$this->load->library('image_lib');
		$config = $this->upload_config();
		$config['upload_path'] = set_realpath('assets/img');


		$this->load->library('form_validation');
		// $this->config->set_item('language', 'armenian');
		$this->form_validation->set_error_delimiters('<div>', '</div>');
		$this->form_validation->set_rules('button_1_1', 'Button 1 lang 1', 'required');
		$this->form_validation->set_rules('button_2_1', 'Button 2 lang 1', 'required');
		$this->form_validation->set_rules('button_2_link_1', 'Button 2 URL lang 1', 'required|valid_url');
		$this->form_validation->set_rules('title_1', 'Title lang 1', 'required');
		$this->form_validation->set_rules('main_text_1', 'Main text lang 1', 'required');

		// 2 Լեզվի ստուգում
		$sql_lng = "SELECT status FROM `language` WHERE `id` = '2'";
		$query_lng = $this->db->query($sql_lng);
		$row = $query_lng->row_array();
		$allow = $row['status']; //allow language 2




		// where language 2  allow
		if($allow == '1') {
			$this->form_validation->set_rules('button_1_2', 'Button 1 lang 2', 'required');
			$this->form_validation->set_rules('button_2_2', 'Button 2 lang 2', 'required');
			$this->form_validation->set_rules('button_2_link_2', 'Button 2 URL lang 2', 'required|valid_url');
			$this->form_validation->set_rules('title_2', 'Title lang 2', 'required');
			$this->form_validation->set_rules('main_text_2', 'Main text lang 2', 'required');
		}


		if ($this->form_validation->run() == false) {
			//validation errors

			$validation_errors = array(
				'button_1_1' => form_error('button_1_1'),
				'button_2_1' => form_error('button_2_1'),
				'button_2_link_1' => form_error('button_2_link_1'),
				'title_1' => form_error('title_1'),
				'main_text_1' => form_error('main_text_1')
			);


			// where language 2  allow
			if ($allow == '1') {
				$validation_errors = array_merge(
					$validation_errors,
					array(
						'button_1_2' => form_error('button_1_2'),
						'button_2_2' => form_error('button_2_2'),
						'button_2_link_2' => form_error('button_2_link_2'),
						'title_2' => form_error('title_2'),
						'main_text_2' => form_error('main_text_2')
					)
				);
			}


			$messages['error']['elements'][] = $validation_errors;

			echo json_encode($messages);
			return false;
		}


		$button_1_1 = $this->input->post('button_1_1');
		$button_2_1 = $this->input->post('button_1_1');
		$button_2_link_1 = $this->input->post('button_2_link_1');
		$title_1 = $this->input->post('title_1');
		$main_text_1 = $this->input->post('main_text_1');
		$font_url_1 = $this->input->post('font_url_1');
		$font_css_1 = $this->input->post('font_css_1');


		$button_1_2 = $this->input->post('button_1_2');
		$button_2_2 = $this->input->post('button_1_2');
		$button_2_link_2 = $this->input->post('button_2_link_2');
		$title_2 = $this->input->post('title_2');
		$main_text_2 = $this->input->post('main_text_2');
		$font_url_2 = $this->input->post('font_url_2');
		$font_css_2 = $this->input->post('font_css_2');



		$main_lang_arr = array(
			'1' => array(
				'button_1' => $button_1_1,
				'button_2' => $button_2_1,
				'button_2_url' => $button_2_link_1,
				'title' => $title_1,
				'main_text' => $main_text_1,
				'font_url' => $font_url_1,
				'font_css' => $font_css_1
			),
			'2' => array(
				'button_1' => $button_1_2,
				'button_2' => $button_2_2,
				'button_2_url' => $button_2_link_2,
				'title' => $title_2,
				'main_text' => $main_text_2,
				'font_url' => $font_url_2,
				'font_css' => $font_css_2
			)
		);

		foreach ($main_lang_arr as $lang_id => $value) {
			$sql_main = "
				UPDATE `main` SET 
					`button_1` = ".$this->db_value($value['button_1']).",
					`button_2` = ".$this->db_value($value['button_2']).",
					`button_2_url` = ".$this->db_value($value['button_2_url']).",
					`title` = ".$this->db_value($value['title']).",
					`main_text` = ".$this->db_value($value['main_text']).",
					`font_url` = ".$this->db_value($value['font_url']).",
					`font_css` = ".$this->db_value($value['font_css'])."
				WHERE `language_id` = '".$lang_id."'	
			";

			$result_main = $this->db->query($sql_main);

			if (!$result_main) {
				$messages['success'] = 0;
				$messages['error'] = 'Error chat form '.$lang_id;
				echo json_encode($messages);
				return false;
			}

		}




		if(isset($_FILES['background_image']['name']) AND $_FILES['background_image']['name'] != '') {
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('background_image')) {
				$validation_errors = array('background_image' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}



			$photo_arr = $this->upload->data();

			$background_img = $photo_arr['file_name'];

			$sql_img = "
				UPDATE `main` SET `background_img` = " . $this->db_value($background_img) . " WHERE 1
			";
			$result_img = $this->db->query($sql_img);

			if (!$result_img) {
				$messages['success'] = 0;
				$messages['error'] = 'Error Background Image';
				echo json_encode($messages);
				return false;
			}


		}

		if ($result_main) {
			$messages['success'] = 1;
			$messages['message'] = 'Success';
		} else {
			$messages['success'] = 0;
			$messages['error'] = 'Error';
		}

		// Return success or error message
		echo json_encode($messages);
		return true;
	}

	public function solution_challenge() {

		$this->authorisation();
		$this->load->helper('url');
		$this->load->helper('form');
		$data = array();

		$sql = "
        	SELECT 
			  `id`,
			  `language_id`,
			  `title_solution`,
			  `text_solution`,
			  `title_challenge`,
			  `text_challenge`,
			  `photo_solution`,
			  `photo_challenge`,
			  `status` 
			FROM
			  `solution_challenge` 
			WHERE `status` = 1 
			LIMIT 2 
        ";

		$query = $this->db->query($sql);
		$result = $query->result_array();

		$data['result'] = $result;

		$this->layout->view('solution_challenge', $data, 'edit');

	}

	public function solution_challenge_ax() {

		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');
		$n = 0;

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}


		$this->load->library('image_lib');
		$config = $this->upload_config();
		$config['upload_path'] = set_realpath('assets/img');


		$this->load->library('form_validation');
		// $this->config->set_item('language', 'armenian');
		$this->form_validation->set_error_delimiters('<div>', '</div>');

		$this->form_validation->set_rules('title_solution_1', 'Solution title lang 1', 'required');
		$this->form_validation->set_rules('text_solution_1', 'Solution text lang 1', 'required');
		$this->form_validation->set_rules('title_challenge_1', 'Challenge title lang 1', 'required');
		$this->form_validation->set_rules('text_challenge_1', 'Challenge text lang 1', 'required');

		// 2 Լեզվի ստուգում
		$sql_lng = "SELECT status FROM `language` WHERE `id` = '2'";
		$query_lng = $this->db->query($sql_lng);
		$row = $query_lng->row_array();
		$allow = $row['status']; //allow language 2


		// where language 2  allow
		if($allow == '1') {
			$this->form_validation->set_rules('title_solution_2', 'Solution title lang 2', 'required');
			$this->form_validation->set_rules('text_solution_2', 'Solution text lang 2', 'required');
			$this->form_validation->set_rules('title_challenge_2', 'Challenge title lang 2', 'required');
			$this->form_validation->set_rules('text_challenge_2', 'Challenge text lang 2', 'required');
		}


		if ($this->form_validation->run() == false) {
			//validation errors

			$validation_errors = array(
				'title_solution_1' => form_error('title_solution_1'),
				'text_solution_1' => form_error('text_solution_1'),
				'title_challenge_1' => form_error('title_challenge_1'),
				'text_challenge_1' => form_error('text_challenge_1')
			);


			// where language 2  allow
			if ($allow == '1') {
				$validation_errors = array_merge(
					$validation_errors,
					array(
						'title_solution_2' => form_error('title_solution_2'),
						'text_solution_2' => form_error('text_solution_2'),
						'title_challenge_2' => form_error('title_challenge_2'),
						'text_challenge_2' => form_error('text_challenge_2')
					)
				);
			}


			$messages['error']['elements'][] = $validation_errors;

			echo json_encode($messages);
			return false;
		}


		$title_solution_1 = $this->input->post('title_solution_1');
		$text_solution_1 = $this->input->post('text_solution_1');
		$title_challenge_1 = $this->input->post('title_challenge_1');
		$text_challenge_1 = $this->input->post('text_challenge_1');



		$title_solution_2 = $this->input->post('title_solution_2');
		$text_solution_2 = $this->input->post('text_solution_2');
		$title_challenge_2 = $this->input->post('title_challenge_2');
		$text_challenge_2 = $this->input->post('text_challenge_2');



		$sch_lang_arr = array(
			'1' => array(
				'title_solution' => $title_solution_1,
				'text_solution' => $text_solution_1,
				'title_challenge' => $title_challenge_1,
				'text_challenge' => $text_challenge_1
			),
			'2' => array(
				'title_solution' => $title_solution_2,
				'text_solution' => $text_solution_2,
				'title_challenge' => $title_challenge_2,
				'text_challenge' => $text_challenge_2
			)
		);

		foreach ($sch_lang_arr as $lang_id => $value) {
			$sql_sch = "
				UPDATE `solution_challenge` SET 
					`title_solution` = ".$this->db_value($value['title_solution']).",
					`text_solution` = ".$this->db_value($value['text_solution']).",
					`title_challenge` = ".$this->db_value($value['title_challenge']).",
					`text_challenge` = ".$this->db_value($value['text_challenge'])."
				WHERE `language_id` = '".$lang_id."'	
			";

			$result_sch = $this->db->query($sql_sch);

			if (!$result_sch) {
				$messages['success'] = 0;
				$messages['error'] = 'Error chat form '.$lang_id;
				echo json_encode($messages);
				return false;
			}

		}




		if(isset($_FILES['photo_solution']['name']) AND $_FILES['photo_solution']['name'] != '') {
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('photo_solution')) {
				$validation_errors = array('photo_solution' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}



			$photo_solution_arr = $this->upload->data();

			$photo_solution = $photo_solution_arr['file_name'];

			$sql_solution = "
				UPDATE `solution_challenge` SET `photo_solution` = " . $this->db_value($photo_solution) . " WHERE 1
			";
			$result_solution = $this->db->query($sql_solution);

			if (!$result_solution) {
				$messages['success'] = 0;
				$messages['error'] = 'Error solution';
				echo json_encode($messages);
				return false;
			}


		}



		if(isset($_FILES['photo_challenge']['name']) AND $_FILES['photo_challenge']['name'] != '') {
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('photo_challenge')) {
				$validation_errors = array('photo_challenge' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}



			$photo_challenge_arr = $this->upload->data();

			$photo_challenge = $photo_challenge_arr['file_name'];

			$sql_challenge = "
				UPDATE `solution_challenge` SET `photo_challenge` = " . $this->db_value($photo_challenge) . " WHERE 1
			";
			$result_challenge = $this->db->query($sql_challenge);

			if (!$result_challenge) {
				$messages['success'] = 0;
				$messages['error'] = 'Error challenge';
				echo json_encode($messages);
				return false;
			}


		}

		if ($result_sch) {
			$messages['success'] = 1;
			$messages['message'] = 'Success';
		} else {
			$messages['success'] = 0;
			$messages['error'] = 'Error';
		}

		// Return success or error message
		echo json_encode($messages);
		return true;
	}

	public function functional() {

		$this->authorisation();
		$this->load->helper('url');
		$this->load->helper('form');
		$data = array();


		$sql = "
        	SELECT
			  `id`,
			  `language_id`,
			  `title`,
			  `icon`,
			  `background_img`,
			  `default`,
			  `statsu`
			FROM `functional`
			 WHERE statsu = 1
        ";

		$query = $this->db->query($sql);
		$result = $query->result_array();

		$data['result'] = $result;

//		$this->pre($result);


		$this->layout->view('functional', $data, 'edit');

	}

	public function functional_ax() {

		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');
		$n = 0;

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}

		$result = true;
		$this->load->library('image_lib');
		$config = $this->upload_config();
		$config['upload_path'] = set_realpath('assets/img');


		$this->load->library('form_validation');
		// $this->config->set_item('language', 'armenian');
		$this->form_validation->set_error_delimiters('<div>', '</div>');

		// 2 Լեզվի ստուգում
		$sql_lng = "SELECT status FROM `language` WHERE `id` = '2'";
		$query_lng = $this->db->query($sql_lng);
		$row = $query_lng->row_array();
		$allow = $row['status']; //allow language 2

		$text = $this->input->post('text');

		$sql_func = "
			SELECT `id`, `language_id` FROM `functional` WHERE 1
		";

		$query_func = $this->db->query($sql_func);
		$result_func = $query_func->result_array();
		$lang_ids = array();

		foreach ($result_func as $item) {
			if($item['language_id'] == 1){
				$lang_ids['lang_1'][] = $item['id'];
			} else {
				$lang_ids['lang_2'][] = $item['id'];
			}
		}


//		$this->pre($lang_ids);

		foreach ($text as $key => $value) {

			if($key < 4) { //todo

				$this->form_validation->set_rules('text['.$key.'][1]', 'Text lang 1', 'required');

				// where language 2  allow
				if($allow == '1') {
					$this->form_validation->set_rules('text['.$key.'][2]', 'Text lang 2', 'required');

				}

				if ($this->form_validation->run() == false) {
					//validation errors

					$validation_errors = array(
						'text['.$key.'][1]' => form_error('text['.$key.'][1]')
					);

					// where language 2  allow
					if ($allow == '1') {
						$validation_errors = array_merge(
							$validation_errors,
							array(
								'text['.$key.'][2]' => form_error('text['.$key.'][2]')
							)
						);
					}

					$messages['error']['elements'][] = $validation_errors;

					echo json_encode($messages);
					return false;
				}
			}


			$sql_func_l1 = "
				UPDATE `functional` SET `title` = '".$value[1]."' WHERE `language_id` = 1 AND `id` = '".$lang_ids['lang_1'][$key-1]."'
			";

			$result_func_l1 = $this->db->query($sql_func_l1);

			if (!$result_func_l1) {
				$result = false;
				$messages['success'] = 0;
				$messages['error'] = 'Error func lang 1';
				echo json_encode($messages);
				return false;
			}


			$sql_func_l2 = "
				UPDATE `functional` SET `title` = '".$value[2]."' WHERE `language_id` = 2 AND `id` = '".$lang_ids['lang_2'][$key-1]."'
			";

			$result_func_l2 = $this->db->query($sql_func_l2);

			if (!$result_func_l2) {
				$result = false;
				$messages['success'] = 0;
				$messages['error'] = 'Error func lang 2';
				echo json_encode($messages);
				return false;
			}

		}




			$files = $_FILES;
			$count = count($_FILES['icon']['name']);

			for($i = 1; $i <= $count; $i++) {
				$_FILES['icon']['name'] = $files['icon']['name'][$i];
				$_FILES['icon']['type'] = $files['icon']['type'][$i];
				$_FILES['icon']['tmp_name'] = $files['icon']['tmp_name'][$i];
				$_FILES['icon']['error'] = $files['icon']['error'][$i];
				$_FILES['icon']['size'] = $files['icon']['size'][$i];

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if(isset($_FILES['icon']['name'][$i]) AND $_FILES['icon']['name'][$i] != '') {

					if (!$this->upload->do_upload('icon')) {
						$validation_errors = array('icon' => $this->upload->display_errors());
						$messages['error']['elements'][] = $validation_errors;
						echo json_encode($messages);
						return false;
					}

					$photo_func_arr = $this->upload->data();

					$photo_icon = $photo_func_arr['file_name'];

					$sql_icon = "
								UPDATE `functional` SET `icon` = " . $this->db_value($photo_icon) . " WHERE (`id` = '" . $lang_ids['lang_1'][$i - 1] . "' OR `id` = '" . $lang_ids['lang_2'][$i - 1] . "')
							";
					$result_icon = $this->db->query($sql_icon);

					if (!$result_icon) {
						$result = false;
						$messages['success'] = 0;
						$messages['error'] = 'Error icon';
						echo json_encode($messages);
						return false;
					}
				}


				$_FILES['background']['name'] = $files['background']['name'][$i];
				$_FILES['background']['type'] = $files['background']['type'][$i];
				$_FILES['background']['tmp_name'] = $files['background']['tmp_name'][$i];
				$_FILES['background']['error'] = $files['background']['error'][$i];
				$_FILES['background']['size'] = $files['background']['size'][$i];

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if(isset($_FILES['background']['name'][$i]) AND $_FILES['background']['name'][$i] != '') {

					if (!$this->upload->do_upload('background')) {
						$result = false;
						$validation_errors = array('background' => $this->upload->display_errors());
						$messages['error']['elements'][] = $validation_errors;
						echo json_encode($messages);
						return false;
					}

					$photo_func_arr = $this->upload->data();

					$photo_background = $photo_func_arr['file_name'];

					 $sql_background = "
								UPDATE `functional` SET `background_img` = " . $this->db_value($photo_background) . " WHERE (`id` = '" . $lang_ids['lang_1'][$i - 1] . "' OR `id` = '" . $lang_ids['lang_2'][$i - 1] . "')
							";
					$result_background = $this->db->query($sql_background);

					if (!$result_background) {
						$messages['success'] = 0;
						$messages['error'] = 'Error challenge';
						echo json_encode($messages);
						return false;
					}
				}


			}



		if ($result) {
			$messages['success'] = 1;
			$messages['message'] = 'Success';
		} else {
			$messages['success'] = 0;
			$messages['error'] = 'Error';
		}

		// Return success or error message
		echo json_encode($messages);
		return true;
	}

	public function functional_2() {

		$this->authorisation();
		$this->load->helper('url');
		$this->load->helper('form');
		$data = array();

		$sql = "
        	SELECT
			  `id`,
			  `language_id`,
			  `button_name`,
			  `button_link`,
			  `background_img`,
			  `background_color`,
			  `show_img`,
			  `text`,
			  `status`
			FROM `functional_2`
			 WHERE `status` = 1
			 LIMIT 2
        ";

		$query = $this->db->query($sql);
		$result = $query->result_array();

		$data['result'] = $result;



		$this->layout->view('functional_2', $data, 'edit');

	}

	public function functional_2_ax() {

		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');
		$n = 0;

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}


		$this->load->library('image_lib');
		$config = $this->upload_config();
		$config['upload_path'] = set_realpath('assets/img');


		$this->load->library('form_validation');
		// $this->config->set_item('language', 'armenian');
		$this->form_validation->set_error_delimiters('<div>', '</div>');

		$this->form_validation->set_rules('button_name_1', 'Button name lang 1', 'required');
		$this->form_validation->set_rules('button_link', 'Button URL lang 1', 'required|valid_url');
		$this->form_validation->set_rules('text_1', 'Text lang 1', 'required');

		// 2 Լեզվի ստուգում
		$sql_lng = "SELECT status FROM `language` WHERE `id` = '2'";
		$query_lng = $this->db->query($sql_lng);
		$row = $query_lng->row_array();
		$allow = $row['status']; //allow language 2




		// where language 2  allow
		if($allow == '1') {
			$this->form_validation->set_rules('button_name_2', 'Button name lang 2', 'required');
			$this->form_validation->set_rules('text_2', 'Text lang 2', 'required');
		}


		if ($this->form_validation->run() == false) {
			//validation errors

			$validation_errors = array(
				'button_name_1' => form_error('button_name_1'),
				'button_link' => form_error('button_link'),
				'text_1' => form_error('text_1')
			);


			// where language 2  allow
			if ($allow == '1') {
				$validation_errors = array_merge(
					$validation_errors,
					array(
						'button_name_2' => form_error('button_name_2'),
						'text_2' => form_error('text_2')
					)
				);
			}


			$messages['error']['elements'][] = $validation_errors;

			echo json_encode($messages);
			return false;
		}


		$show_img = $this->input->post('show_img');
		$button_name_1 = $this->input->post('button_name_1');
		$text_1 = $this->input->post('text_1');
		$button_link = $this->input->post('button_link');
		$background_color = $this->input->post('background_color');



		$button_name_2 = $this->input->post('button_name_2');
		$text_2 = $this->input->post('text_2');



		$func2_lang_arr = array(
			'1' => array(
				'button_name' => $button_name_1,
				'text' => $text_1,
				'button_link' => $button_link,
				'background_color' => $background_color,
				'show_img' => $show_img,
			),
			'2' => array(
				'button_name' => $button_name_2,
				'text' => $text_2,
				'button_link' => $button_link,
				'background_color' => $background_color,
				'show_img' => $show_img,
			)
		);

		foreach ($func2_lang_arr as $lang_id => $value) {
			$sql_func2 = "
				UPDATE `functional_2` SET 
					`button_name` = ".$this->db_value($value['button_name']).",
					`text` = ".$this->db_value($value['text']).",
					`button_link` = ".$this->db_value($value['button_link']).",
					`show_img` = ".$this->db_value($value['show_img']).",
					`background_color` = ".$this->db_value($value['background_color'])."
				WHERE `language_id` = '".$lang_id."'	
			";

			$result_func2 = $this->db->query($sql_func2);

			if (!$result_func2) {
				$messages['success'] = 0;
				$messages['error'] = 'Error func2 - '.$lang_id;
				echo json_encode($messages);
				return false;
			}

		}




		if(isset($_FILES['background_img']['name']) AND $_FILES['background_img']['name'] != '') {
			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('background_img')) {
				$validation_errors = array('background_img' => $this->upload->display_errors());
				$messages['error']['elements'][] = $validation_errors;
				echo json_encode($messages);
				return false;
			}



			$photo_arr = $this->upload->data();

			$background_img = $photo_arr['file_name'];

			$sql_img = "
				UPDATE `functional_2` SET `background_img` = " . $this->db_value($background_img) . " WHERE 1
			";
			$result_img = $this->db->query($sql_img);

			if (!$result_img) {
				$messages['success'] = 0;
				$messages['error'] = 'Error Background Image';
				echo json_encode($messages);
				return false;
			}


		}

		if ($result_func2) {
			$messages['success'] = 1;
			$messages['message'] = 'Success';
		} else {
			$messages['success'] = 0;
			$messages['error'] = 'Error';
		}

		// Return success or error message
		echo json_encode($messages);
		return true;
	}

	public function footer_section() {

		$this->authorisation();
		$this->load->helper('url');
		$this->load->helper('form');
		$data = array();

		$sql = "
        	SELECT
			  `id`,
			  `language_id`,
			  `title`,
			  `text`,
			  `input_1`,
			  `input_2`,
			  `button_name`,
			  `footer_text`,
			  `status`
			FROM `footer`
			 WHERE `status` = 1
			 LIMIT 2
        ";

		$query = $this->db->query($sql);
		$result = $query->result_array();

		$data['result'] = $result;




		$this->layout->view('footer_section', $data, 'edit');

	}

	public function footer_section_ax() {

		$messages = array('success' => '0', 'message' => '', 'error' => '', 'fields' => '');
		$n = 0;

		if ($this->input->server('REQUEST_METHOD') != 'POST') {
			// Return error
			$messages['error'] = 'error_message';
			$this->access_denied();
			return false;
		}


		$this->load->library('image_lib');
		$config = $this->upload_config();
		$config['upload_path'] = set_realpath('assets/img');


		$this->load->library('form_validation');
		// $this->config->set_item('language', 'armenian');
		$this->form_validation->set_error_delimiters('<div>', '</div>');

		$this->form_validation->set_rules('input_1_1', 'Input 1 lang 1', 'required');
		$this->form_validation->set_rules('input_2_1', 'Input 2 lang 1', 'required');
		$this->form_validation->set_rules('title_1', 'Title lang 1', 'required');
		$this->form_validation->set_rules('text_1', 'Text lang 1', 'required');
		$this->form_validation->set_rules('button_name_1', 'Button Name lang 1', 'required');
		$this->form_validation->set_rules('footer_text_1', 'Footer text lang 1', 'required');

		// 2 Լեզվի ստուգում
		$sql_lng = "SELECT status FROM `language` WHERE `id` = '2'"; //todo config
		$query_lng = $this->db->query($sql_lng);
		$row = $query_lng->row_array();
		$allow = $row['status']; //allow language 2




		// where language 2  allow
		if($allow == '1') {
			$this->form_validation->set_rules('input_1_2', 'Input 1 lang 2', 'required');
			$this->form_validation->set_rules('input_2_2', 'Input 2 lang 2', 'required');
			$this->form_validation->set_rules('title_2', 'Title lang 2', 'required');
			$this->form_validation->set_rules('text_2', 'Text lang 2', 'required');
			$this->form_validation->set_rules('button_name_2', 'Button Name lang 2', 'required');
			$this->form_validation->set_rules('footer_text_2', 'Footer text lang 2', 'required');
		}


		if ($this->form_validation->run() == false) {
			//validation errors

			$validation_errors = array(
				'input_1_1' => form_error('input_1_1'),
				'input_2_1' => form_error('input_2_1'),
				'title_1' => form_error('title_1'),
				'text_1' => form_error('text_1'),
				'button_name_1' => form_error('button_name_1'),
				'footer_text_1' => form_error('footer_text_1'),
			);


			// where language 2  allow
			if ($allow == '1') {
				$validation_errors = array_merge(
					$validation_errors,
					array(
						'input_1_2' => form_error('input_1_2'),
						'input_2_2' => form_error('input_2_2'),
						'title_2' => form_error('title_2'),
						'text_2' => form_error('text_2'),
						'button_name_2' => form_error('button_name_2'),
						'footer_text_2' => form_error('footer_text_2')
					)
				);
			}


			$messages['error']['elements'][] = $validation_errors;

			echo json_encode($messages);
			return false;
		}


		$input_1_1 = $this->input->post('input_1_1');
		$input_2_1 = $this->input->post('input_2_1');
		$title_1 = $this->input->post('title_1');
		$text_1 = $this->input->post('text_1');
		$button_name_1 = $this->input->post('button_name_1');
		$footer_text_1 = $this->input->post('footer_text_1');

		$input_1_2 = $this->input->post('input_1_2');
		$input_2_2 = $this->input->post('input_2_2');
		$title_2 = $this->input->post('title_2');
		$text_2 = $this->input->post('text_2');
		$button_name_2 = $this->input->post('button_name_2');
		$footer_text_2= $this->input->post('footer_text_2');




		$footer_lang_arr = array(
			'1' => array(
				'input_1' => $input_1_1,
				'input_2' => $input_2_1,
				'title' => $title_1,
				'text' => $text_1,
				'button_name' => $button_name_1,
				'footer_text' => $footer_text_1
			),
			'2' => array(
				'input_1' => $input_1_2,
				'input_2' => $input_2_2,
				'title' => $title_2,
				'text' => $text_2,
				'button_name' => $button_name_2,
				'footer_text' => $footer_text_2
			)
		);

		foreach ($footer_lang_arr as $lang_id => $value) {
			$sql_foot = "
				UPDATE `footer` SET 
					`input_1` = ".$this->db_value($value['input_1']).",
					`input_2` = ".$this->db_value($value['input_2']).",
					`title` = ".$this->db_value($value['title']).",
					`text` = ".$this->db_value($value['text']).",
					`button_name` = ".$this->db_value($value['button_name']).",
					`footer_text` = ".$this->db_value($value['footer_text'])."
				WHERE `language_id` = '".$lang_id."'	
			";

			$result_foot = $this->db->query($sql_foot);

			if (!$result_foot) {
				$messages['success'] = 0;
				$messages['error'] = 'Error foot '.$lang_id;
				echo json_encode($messages);
				return false;
			}

		}




		if ($result_foot) {
			$messages['success'] = 1;
			$messages['message'] = 'Success';
		} else {
			$messages['success'] = 0;
			$messages['error'] = 'Error';
		}

		// Return success or error message
		echo json_encode($messages);
		return true;
	}

	public function subscribe() {

		$this->authorisation();
		$this->load->helper('url');
		$this->load->helper('form');
		$data = array();

		$sql = "
        	SELECT
			  `id`,
			  `name`,
			  `email`, 
			  DATE_FORMAT(`log_date`, '%d-%m-%Y %k:%i') AS `log_date`
			FROM `subscribe`
			 WHERE `status` = 1
        ";

		$query = $this->db->query($sql);
		$result = $query->result_array();

		$data['result'] = $result;


		$this->layout->view('subscribe', $data, 'edit');

	}


}
//end of class
