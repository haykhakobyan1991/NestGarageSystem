<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Loader.php";

class MY_Loader extends MX_Loader {

   /**
	 * Check authorisation
     * @param null $controller
     * @param null $page
     * @param string $type
     * @return bool
	 * @passive mode $type = '1' for links // return bool
	 * @pctive mode $type = '2'

	*/
    public function authorisation($controller = NULL, $page = NULL, $type = '2') {
		
		$this->load->library('session');
		$this->load->helper('url');
		$user_id = $this->session->user_id;
		
		
		
		if (is_null($controller)) {
			$controller = $this->router->fetch_class();
		}
		
		if (is_null($page)) {
			$page = $this->router->fetch_method();
		}
		
		
		
		if(!$this->session->username) {
        	redirect('admin/login', 'location');
        	$this->session->sess_destroy();
        }
		
		
		

        $sql = "SELECT 
					`permission`.`id`,
				    `permission`.`controller`,
					`permission`.`page`,
					`permission`.`status`
				FROM 
					`permission`
				LEFT JOIN `role_permission` ON `role_permission`.`permission_id` = `permission`.`id`	
				LEFT JOIN `role` ON `role_permission`.`role_id` = `role`.`id`
				LEFT JOIN `user` ON `user`.`role_id` = `role`.`id`
				WHERE `user`.`id` = '".$user_id."' AND `permission`.`status` = '1' AND `controller` = '".$controller."' AND `page` = '".$page."'
		";

        $query = $this->db->query($sql);
		
		if($query->num_rows() != 1) {
			if ($type == '1') {
				return false;
			} elseif ($type == '2') {
				redirect('admin/access_denied', 'location');
				return false;
			}
		}

		
		return true;
	}

    /**
     * @param $video_id
     * @return bool|string
     */
    public function show_video($video_id = NULL, $iframe_link = NULL,  $width = '670px', $height = '350px') {
            
        // $width = '670px';
        // $height = '350px';

        if ($video_id != NULL) {

            if (!$width OR !$height) {
               return false;
            }

            return '<iframe width="'.$width.'" height="'.$height.'" src="https://www.youtube.com/embed/'.$video_id.'" frameborder="0" allowfullscreen></iframe>';
        } elseif ($iframe_link != NULL){
        	return '<iframe width="'.$width.'" height="'.$height.'" src="'.$iframe_link.'" frameborder="0" allowfullscreen></iframe>';
           
        } else {
        	 return false;
        }
    }
}