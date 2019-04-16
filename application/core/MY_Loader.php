<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH . "third_party/MX/Loader.php";

class MY_Loader extends MX_Loader
{

	/**
	 * Check authorisation
	 * @param null $controller
	 * @param null $page
	 * @param string $type
	 * @return bool
	 * @passive mode $type = '1' for links // return bool
	 * @active mode $type = '2'
	 */
	public function authorisation($controller = NULL, $page = NULL, $type = '2')
	{

		$this->load->library('session');
		$this->load->helper('url');
		$user_id = $this->session->user_id;


		if (is_null($controller)) {
			$controller = $this->router->fetch_class();
		}

		if (is_null($page)) {
			$page = $this->router->fetch_method();
		}


		if (!$this->session->username) {
			redirect($this->lng() . '/', 'location');
			$this->session->sess_destroy();
		}


		$sql = "SELECT 
					`permission`.`id`,
				    `permission`.`controller`,
				    `permission`.`title_" . $this->lng() . "` AS `title`,
					`permission`.`page`,
					`permission`.`status`
				FROM 
					`permission`
				LEFT JOIN `role_permission` ON `role_permission`.`permission_id` = `permission`.`id`	
				LEFT JOIN `role` ON `role_permission`.`role_id` = `role`.`id`
				LEFT JOIN `user` ON `user`.`role_id` = `role`.`id`
				WHERE `user`.`id` = '" . $user_id . "' AND `permission`.`status` = '1' AND `controller` = '" . $controller . "' AND `page` = '" . $page . "'
		";

		$query = $this->db->query($sql);
		$row = $query->row_array();

		if($type == '2') {
			$this->layout->set_title($row['title']);
		}

		if ($query->num_rows() != 1) {
			if ($type == '1') {
				return false;
			} elseif ($type == '2') {
				redirect('access_denied', 'location');
				return false;
			}
		}


		return true;
	}


	/**
	 * @param $data
	 * @return string
	 */
	public function escape($data)
	{
		return mysqli_escape_string($this->db->db_connect(), $data);
	}


	/**
	 * @param null $value
	 * @return string
	 */
	public function db_value($value = NULL)
	{

		$this->load->helper('form');

		if (is_null($value)) {
			return "NULL";
		}

		if ($value != '') {
			return "'" . $this->escape($value) . "'";
		} else {
			return "NULL";
		}
	}


	/**
	 * @return string
	 */
	public function lng()
	{
		if ($this->uri->segment(1) != '') {
			return $this->uri->segment(1);
		} else {
			return 'hy';
		}
	}


	/**
	 * @param $file
	 * @return mixed
	 */
	public function load_lang($file)
	{

		// load the helper
		$this->load->helper('language');

		$lang = $this->lng();

		return $lang == 'hy'
			? $this->lang->load($file, 'armenian')
			: $this->lang->load($file, 'russian');

	}


	/**
	 * @return mixed
	 */
	public function get_language()
	{

		$lang = $this->lng();

		return $lang == 'hy'
			? 'armenian'
			: 'russian';

	}


	/**
	 * @return mixed
	 */
	public function default_lang()
	{
		return $this->config->item('default_lang');
	}


	/**
	 * @param $ext
	 * @return string
	 */
	public function select_ext($ext)
	{
		$extension = array('pdf', 'png', 'jpg', 'doc', 'docx', 'csv', 'xlsx', 'zip');

		if (in_array($ext, $extension)) {

			if ($ext == 'xlsx' || $ext == 'csv') {
				return '<i style="padding-top: 12px;float: right;" class="fas fa-file-excel"></i>';
			} elseif ($ext == 'doc' || $ext == 'docx') {
				return '<i style="padding-top: 12px;float: right;" class="fas fa-file-word"></i>';
			} elseif ($ext == 'jpg' || $ext == 'png') {
				return '<i style="padding-top: 12px;float: right;" class="fas fa-file-image"></i>';
			} elseif ($ext == 'zip') {
				return '<i style="padding-top: 12px;float: right;" class="fas fa-file-archive"></i>';
			}

			return '<i style="padding-top: 12px;float: right;" class="fas fa-file-' . $ext . '"></i>';
		}

		return '<i style="padding-top: 12px;float: right;" class="fas fa-exclamation-circle"></i>';
	}

	public function loading_svg ()
	{
		return '<svg id="loading_svg" width="80" height="20"
			 viewBox="0 0 135 140"
			 xmlns="http://www.w3.org/2000/svg"
			 fill="rgb(255, 122, 89)">
			<rect y="10" width="15" height="120" rx="6">
				<animate attributeName="height"
						 begin="0.5s" dur="1s"
						 values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear"
						 repeatCount="indefinite"/>
				<animate attributeName="y"
						 begin="0.5s" dur="1s"
						 values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear"
						 repeatCount="indefinite"/>
			</rect>
			<rect x="30" y="10" width="15" height="120" rx="6">
				<animate attributeName="height"
						 begin="0.25s" dur="1s"
						 values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear"
						 repeatCount="indefinite"/>
				<animate attributeName="y"
						 begin="0.25s" dur="1s"
						 values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear"
						 repeatCount="indefinite"/>
			</rect>
			<rect x="60" width="15" height="140" rx="6">
				<animate attributeName="height"
						 begin="0s" dur="1s"
						 values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear"
						 repeatCount="indefinite"/>
				<animate attributeName="y"
						 begin="0s" dur="1s"
						 values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear"
						 repeatCount="indefinite"/>
			</rect>
			<rect x="90" y="10" width="15" height="120" rx="6">
				<animate attributeName="height"
						 begin="0.25s" dur="1s"
						 values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear"
						 repeatCount="indefinite"/>
				<animate attributeName="y"
						 begin="0.25s" dur="1s"
						 values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear"
						 repeatCount="indefinite"/>
			</rect>
			<rect x="120" y="10" width="15" height="120" rx="6">
				<animate attributeName="height"
						 begin="0.5s" dur="1s"
						 values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear"
						 repeatCount="indefinite"/>
				<animate attributeName="y"
						 begin="0.5s" dur="1s"
						 values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear"
						 repeatCount="indefinite"/>
			</rect>
	</svg>';
	}


	/**
	 * @param $fleet_id
	 * @return mixed
	 */
	public function get_drivers ($fleet_id)
	{
		$sql_add_staff = "
				SELECT
				   `staff`.`id`,
				   CONCAT_WS(
					  ' ',
					  `staff`.`first_name`,
					  `staff`.`last_name`
				   ) AS `name`
				FROM 
				 `fleet`  
				LEFT JOIN `staff` 
					ON FIND_IN_SET(
					  `staff`.`id`,
					  `fleet`.`staff_ids`
					) 
			   WHERE `fleet`.`id` = '" . $fleet_id . "'
			    GROUP BY `staff`.`id`
			";

		$query_add_staff = $this->db->query($sql_add_staff);

		return $query_add_staff->result_array();
	}




}
