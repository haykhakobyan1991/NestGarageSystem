<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class System_main extends CI_Controller {


	/**
	 * System_main constructor.
	 */
	public function __construct() {

        parent::__construct();

		// load the library
		$this->load->library('layout');

		// load the helper
		$this->load->helper('language');

		$lng = $this->load->lng();

		$language = $this->load->get_language($lng);

		$this->config->set_item('language', $language);

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
				echo '<label class=" col-form-label col-sm-2">Մոդել *</label>

						<select name="model"
								class="col selectpicker form-control form-control-sm col-sm-7"
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



	public function search_owner() {


		$user_id = $this->input->get('user_id');

		$sql_row = "SELECT company_id FROM user WHERE id = ".$this->load->db_value($user_id)." ";
		$row = $this->db->query($sql_row)->row_array();
		$company_id = $row['company_id'];


		 $sql = "
				SELECT 
					`staff`.`id`, 
					CONCAT_WS(' ', `staff`.`first_name`, `staff`.`last_name`) AS `name` 
				  FROM 
				    `staff` 
				  LEFT JOIN 
				  	  `user` ON `staff`.`registrar_user_id` = `user`.`id`
				  WHERE `staff`.`status` = 1 
				   AND  `user`.`company_id` = ".$this->load->db_value($company_id)."";
		$result = $this->db->query($sql);

		$array = $result->result_array();

		echo json_encode($array);
	}


	public function reference () {

		$this->load->helper('language');

		// Include the main TCPDF library (search for installation path).
		require_once realpath('application/libraries/pdf.php');

		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);

		// set default header data
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(STANDART_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


		// set default font subsetting mode
		$pdf->setFontSubsetting(true);

		// Set font
		// dejavusans is a UTF-8 Unicode font, if you only need to
		// print standard ASCII chars, you can use core fonts like
		// helvetica or times to reduce file size.
		$pdf->SetFont('dejavusans', '', 10, '', true);

		// add a page
		$pdf->AddPage();

		$pdf->setCellHeightRatio(2);

		// set text shadow effect
		$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.0000001, 'depth_h'=>0.0000001, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));


		//print_r($_REQUEST);

		$sql = "SELECT `country`.`title_".$this->load->lng()."` AS `country` FROM `country` WHERE `country`.`id` = '".$this->input->post('legal_country')."'";
		$query = $this->db->query($sql);
		$row = $query->row_array();
		$country = $row['country'];

		$city = $this->input->post('legal_city');
		$zip_code = $this->input->post('legal_zip_code');
		$address = $this->input->post('legal_address');


		$logo = $this->input->post('u_logo');
		$address = $country.','.$city.', '.$zip_code.' '.$address;
		$phone = $this->input->post('phone_number');
		$web_page = $this->input->post('web_address');
		$email = $this->input->post('email');
		$ITN = $this->input->post('tin');
		$Director = $this->input->post('owner_firstname').' '.$this->input->post('owner_lastname');


		$Account_type_1 = $this->input->post('account_name_1');
		$Account_number_1 = $this->input->post('account_number_1');
		$Account_1 = $this->input->post('account_1');
		$CorrespondentBank_1 = $this->input->post('correspondent_bank_1');
		$SwiftCode_1 = $this->input->post('swift_code_1');

		$Account_type_2 = $this->input->post('account_name_2');
		$Account_number_2 = $this->input->post('account_number_2');
		$Account_2 = $this->input->post('account_2');
		$CorrespondentBank_2 = $this->input->post('correspondent_bank_2');
		$SwiftCode_2 = $this->input->post('swift_code_2');

		$Account_type_3 = $this->input->post('account_name_3');
		$Account_number_3 = $this->input->post('account_number_3');
		$CorrespondentBank_3 = $this->input->post('correspondent_bank_3');
		$SwiftCode_3 = $this->input->post('correspondent_bank_3');
		$Account_3 = $this->input->post('account_3');

		$Account_type_4 = $this->input->post('account_name_4');
		$Account_number_4 = $this->input->post('account_number_4');
		$CorrespondentBank_4 = $this->input->post('correspondent_bank_4');
		$SwiftCode_4 = $this->input->post('correspondent_bank_4');
		$Account_4 = $this->input->post('account_4');

		// create some HTML content
		$html = '
		<table>
			<tr>
				<td><img src="'.$logo.'" alt=""></td>
				<td style="line-height: 80%;"><h1  align="center" style="color: #365f8f; "><br>'.lang('Reference').'</h1></td>
				<td></td>
			</tr>
			<tr>
				<td width="15%" style="line-height: 90%; "></td>
				<td width="75%" style="line-height: 90%; "></td>
				<td width="10%" style="line-height: 90%; "></td>
			</tr>
			<br>
			<tr>
				<td>'.lang('address').'</td>
				<td >'.$address.'</td>
				<td></td>
			</tr>
			<tr>
				<td>'.lang('phone').'</td>
				<td >'.$phone.'</td>
				<td></td>
			</tr>
			<tr>
				<td>'.lang('Web_address').'</td>
				<td >'.$web_page.'</td>
				<td></td>
			</tr>
			<tr>
				<td>'.lang('email').'</td>
				<td >'.$email.'</td>
				<td></td>
			</tr>
			<tr>
				<td>'.lang('tin').'</td>
				<td >'.$ITN.'</td>
				<td></td>
			</tr>
			<tr>
				<td>'.lang('head').'</td>
				<td >'.$Director.'</td>
				<td></td>
			</tr>
			<br>
			<tr>
				<td colspan="3" style="line-height: 7%; background-color: #c7c7c7; "></td>
			</tr>

			<br>
			
			<tr>
				<td width="40%" style="color: #0f427a; " >'.$Account_type_1.'</td>
			</tr>
			
			<tr>
				<td width="30%" >'.($Account_number_1 != '' ? lang('account_number') : '').'</td>
				<td align="center" width="10%" style="'.($Account_number_1 != '' ? 'border-right: 1px solid #c7c7c7' : '').'"></td>
				<td width="10%"></td>
				<td width="40%" >'.$Account_number_1.'</td>
			</tr>
			<tr>
				<td width="30%" >'.($Account_1 != '' ? lang('account') : '').'</td>
				
				<td align="center" width="10%" style="'.($Account_1 != '' ? 'border-right: 1px solid #c7c7c7' : '').'"></td>
				<td></td>
				<td width="40%" >'.$Account_1.'</td>
			</tr>
			<tr>
				<td width="30%" >'.($CorrespondentBank_1 != '' ? lang('Correspondent_Bank') : '').'</td>
				
				<td align="center" width="10%" style="'.($CorrespondentBank_1 != '' ? 'border-right: 1px solid #c7c7c7' : '').'"></td>
				<td></td>
				<td width="40%" >'.$CorrespondentBank_1.'</td>
			</tr>
			<tr>
				<td width="30%" >'.($SwiftCode_1 != '' ? lang('swift_code') : '').'</td>
				
				<td align="center" width="10%" style="'.($SwiftCode_1 != '' ? 'border-right: 1px solid #c7c7c7' : '').'"></td>
				<td></td>
				<td width="40%" >'.$SwiftCode_1.'</td>
			</tr>
			
			<br>
			
			<tr>
				<td width="40%" style="color: #0f427a; " >'.$Account_type_2.'</td>
			</tr>
			<tr>
				<td width="20%" >'.($Account_number_2 != '' ? lang('account_number') : '').'</td>
				
				<td align="center" width="10%" style="'.($Account_number_2 != '' ? 'border-right: 1px solid #c7c7c7' : '').'" ></td>
				<td></td>
				<td width="40%" >'.$Account_number_2.'</td>
			</tr>
			<tr>
				<td width="20%" >'.($Account_2 != '' ?  lang('account') : '').'</td>
				
				<td align="center" width="10%" style="'.($Account_2 != '' ? 'border-right: 1px solid #c7c7c7' : '').'"></td>
				<td></td>
				<td width="40%" >'.$Account_2.'</td>
			</tr>
			<tr>
				<td width="20%" >'.($CorrespondentBank_2 != '' ? lang('Correspondent_Bank') : '').'</td>
				
				<td align="center" width="10%" style="'.($CorrespondentBank_2 != '' ? 'border-right: 1px solid #c7c7c7' : '').'"></td>
				<td></td>
				<td width="40%" >'.$CorrespondentBank_2.'</td>
			</tr>
			<tr>
				<td width="20%" >'.($SwiftCode_2 != '' ? lang('swift_code') : '').'</td>
				
				<td align="center" width="10%" style="'.($SwiftCode_2 != '' ? 'border-right: 1px solid #c7c7c7' : '').'"></td>
				<td></td>
				<td width="40%" >'.$SwiftCode_2.'</td>
			</tr>
			
			<br>
			
			<tr>
				<td width="40%" style="color: #0f427a; " >'.$Account_type_3.'</td>
			</tr>
			<tr>
				<td width="20%" >'.($Account_number_3 != '' ? lang('account_number') : '').'</td>
				
				<td align="center" width="10%" style="'.($Account_number_3 != '' ? 'border-right: 1px solid #c7c7c7' : '').'" ></td>
				<td></td>
				<td width="40%" >'.$Account_number_3.'</td>
			</tr>
			<tr>
				<td width="20%" >'.($CorrespondentBank_3 != '' ?  lang('Correspondent_Bank') : '').'</td>
				
				<td align="center" width="10%" style="'.($CorrespondentBank_3 != '' ? 'border-right: 1px solid #c7c7c7' : '').'"></td>
				<td></td>
				<td width="40%" >'.$CorrespondentBank_3.'</td>
			</tr>
			<tr>
				<td width="20%" >'.($SwiftCode_3 != '' ? lang('swift_code') : '').'</td>
				
				<td align="center" width="10%" style="'.($SwiftCode_3 != '' ? 'border-right: 1px solid #c7c7c7' : '').'"></td>
				<td></td>
				<td width="40%" >'.$SwiftCode_3.'</td>
			</tr>
			<tr>
				<td width="20%" >'.($Account_3 != '' ? lang('account') : '').'</td>
				
				<td align="center" width="10%" style="'.($Account_3 != '' ? 'border-right: 1px solid #c7c7c7' : '').'"></td>
				<td></td>
				<td width="40%" >'.$Account_3.'</td>
			</tr>
			
			<br>
			
			<tr>
				<td width="40%" style="color: #0f427a; " >'.$Account_type_4.'</td>
			</tr>
			<tr>
				<td width="20%" >'.($Account_number_4 != '' ? lang('account_number') : '').'</td>
				
				<td align="center" width="10%" style="'.($Account_number_4 != '' ? 'border-right: 1px solid #c7c7c7' : '').'" ></td>
				<td></td>
				<td width="40%" >'.$Account_number_4.'</td>
			</tr>
			<tr>
				<td width="20%" >'.($CorrespondentBank_4 != '' ?  lang('Correspondent_Bank') : '').'</td>
				
				<td align="center" width="10%" style="'.($CorrespondentBank_4 != '' ? 'border-right: 1px solid #c7c7c7' : '').'"></td>
				<td></td>
				<td width="40%" >'.$CorrespondentBank_4.'</td>
			</tr>
			<tr>
				<td width="20%" >'.($SwiftCode_4 != '' ? lang('swift_code') : '').'</td>
				
				<td align="center" width="10%" style="'.($SwiftCode_4 != '' ? 'border-right: 1px solid #c7c7c7' : '').'"></td>
				<td></td>
				<td width="40%" >'.$SwiftCode_4.'</td>
			</tr>
			<tr>
				<td width="20%" >'.($Account_4 != '' ? lang('account') : '').'</td>
				
				<td align="center" width="10%" style="'.($Account_4 != '' ? 'border-right: 1px solid #c7c7c7' : '').'"></td>
				<td></td>
				<td width="40%" >'.$Account_4.'</td>
			</tr>
			
		</table>';

		// output the HTML content
		$pdf->writeHTMLCell(0, 0, 10, 20, $html, 0, 1, 0, true, '', true);

		// reset pointer to the last page
		$pdf->lastPage();

		// ---------------------------------------------------------

		//Close and output PDF document
		$file = $pdf->Output('example.pdf', 'S');

		//============================================================+
		// END OF FILE
		//============================================================+

		// Generate file
		$doc_file = base64_encode($file);
		// return $file;


		echo 'data: application/pdf;base64,'.$doc_file;
		unset($pdf);
		return;

	}









}
//end of class
