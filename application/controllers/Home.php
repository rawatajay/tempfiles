<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Home
* 
* 
* @package    	CI
* @subpackage 	Job Hunter
* @category 	Home Controller
* @author 	  	TrivialWorks* 
*/
class Home extends CI_Controller{

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
        if(empty($this->session->userdata('userId'))){
            $this->app->message('Invalid user access.', 'error');
            redirect(base_url());
        }
	}

	/*
	* index
	*
	* Used for dispalying the frontend home page.
	*
	* @param 
	* @return
	*/
	function index(){
        $data['page_title']         = SITE_TITLE;
        $data['page_name']          = "Dashboard";
        $data['page_slug']          = 'dashboard';  
        $data['home_url']           = 'dashboard';  
        $this->load->view('admin/common/header.php',$data);  
        $this->load->view('admin/common/topheader.php',$data);
        $this->load->view('admin/common/sidebarMenu.php',$data);   
        $this->load->view('admin/dashboard',$data);        
        $this->load->view('admin/common/footer.php',$data);
	}
	/*
	* 404 page
	*
	* Used for view 404 page.
	*
	* @param 
	* @return
	*/
	function page_404(){		
		$data['page_slug']			= $this->uri->segment(1);		
		$data['meta_description']	= METADESCRIPTION;
        $data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Page Not Found";
        $this->load->view('frontend/common/header.php',$data);        
        $this->load->view('frontend/404_page', $data);        
	}
} 

?>