<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Admin
* 
* 
* @package    	CI
* @subpackage 	Job Hunter
* @category 	Admin Controller
* @author 	  	TrivialWorks*
*/
class Admin extends CI_Controller{

	/*
	 * __construct
	 *
	 * initialise object’s properties
	 *
	 * @param 
	 * @return 
	*/
	function __construct(){
		parent::__construct();	
		if(empty($this->session->all_userdata('userId')) || $this->session->userdata('userType')!='1'){
            $this->app->message('Invalid user access.', 'error');
            redirect(base_url());
        }
	}

	/*
	* index
	*
	* Used for dispalying the admin login.
	*
	* @param 
	* @return
	*/
	function index(){		
		$data['page_title']         = SITE_TITLE;
        $data['page_name']          = "Dashboard";
        $data['page_slug']          = 'dashboard'; 
        $data['home_url']          = 'admin/dashboard';  
        $this->load->view('admin/common/header.php',$data);  
        $this->load->view('admin/common/topheader.php',$data);
        $this->load->view('admin/common/adminsidebarMenu.php',$data);   
        $this->load->view('admin/admindashboard',$data);        
        $this->load->view('admin/common/footer.php',$data);
	}
}

?>