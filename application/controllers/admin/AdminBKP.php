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
		$this->load->model('app');
		$this->load->model('frontend/user_model','user_model');	
		$this->load->model('Common' ,'common');	
		$this->load->library('Csvimport','csvimport');
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
		if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='1' || $this->session->all_userdata()['userType'] =='2' )){
            redirect('admin/dashboard');
        }
		$data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Login";
        $data['page_slug']			= $this->uri->segment(1);	    
        $this->load->view('admin/common/header.php',$data);
        $this->load->view('admin/login',$data);        
        $this->load->view('admin/common/footer.php',$data);
	}
	/*
	* dashboard
	*
	* Used for dispalying the admin dashboard.
	*
	* @param 
	* @return
	*/
	function dashboard(){	
		if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='1' || $this->session->all_userdata()['userType'] =='2' )){

                $data['page_title'] 		= SITE_TITLE;
                $limit = 5;
        	$data['page_name']			= "Dashboard";
	        $data['page_slug']			= 'dashboard';	
                $data['user_count']                     = $this->common->_getCount('user',array('isActive'=>'1'));
                $data['company_count']                  = $this->common->_getCount('company',array('status'=>'1'));     
                 $data['datasetlist'] 	                = $this->common->_getdatasetList($limit);
                  $data['sendgrid']                      = $this->common->getsendgridDetails();
                  
                  
                 
                $data['profiledownload']             = $this->common->_getCount('trackuseremail',array('isdownLoaded'=>'1')); 
                    
                
          
	        $this->load->view('admin/common/header.php',$data);	 
	        $this->load->view('admin/common/topheader.php',$data);
	        $this->load->view('admin/common/sidebarMenu.php',$data);		       
	        $this->load->view('admin/dashboard',$data);        
	        $this->load->view('admin/common/footer.php',$data);
        }else{        	
        	$this->app->message('Invalid user access.', 'error');
        	redirect('admin');
        }
        
	}
	/*
	* user
	*
	* Used for dispalying the admin user list.
	*
	* @param 
	* @return
	*/
	function users(){	
        $data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Users";
        $data['page_slug']			= $this->uri->segment(2);
        $data['pageJS']				= array(base_url()."assets/admin/plugins/select2/select2.min.js",
							base_url()."assets/admin/plugins/DataTables/media/js/jquery.dataTables.min.js",
							base_url()."assets/admin/plugins/DataTables/media/js/DT_bootstrap.js",
							base_url()."assets/admin/js/table-data.js",
							base_url()."assets/admin/plugins/bootstrap-modal/js/bootstrap-modal.js",
							base_url()."assets/admin/plugins/bootstrap-modal/js/bootstrap-modalmanager.js",
							base_url()."assets/admin/js/ui-modals.js",
							base_url()."assets/admin/plugins/jquery-validation/dist/jquery.validate.min.js",
							base_url()."assets/admin/js/form-validation.js");
        $data['initJsFunc']			= array("TableData.init();","UIModals.init();","FormValidator.init();",);
        $data['pageCSS']			= array(base_url()."assets/admin/plugins/select2/select2.css",
							base_url()."assets/admin/plugins/DataTables/media/css/DT_bootstrap.css",
							base_url()."assets/admin/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css",
							base_url()."assets/admin/plugins/bootstrap-modal/css/bootstrap-modal.css");
        $this->load->view('admin/common/header.php',$data);
        $this->load->view('admin/common/topheader.php',$data);
        $this->load->view('admin/userlist',$data);        
        $this->load->view('admin/common/footer.php',$data);
	}
	/*
	* jobseekerlist
	*
	* Used for dispalying the admin user list.
	*
	* @param 
	* @return
	*/
	function jobseekerlist(){
		if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='1' || $this->session->all_userdata()['userType'] =='2' )){	
        $data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Job Seeker";
        $data['page_slug']			= 'user_jobseeker';        
        $dataArr					= array('userType' => '3');
        $data['jobseekerList']		= $this->common->_getList('user',$dataArr," userID DESC ");        
        $this->load->view('admin/common/header.php',$data);	 
	    $this->load->view('admin/common/topheader.php',$data);
	    $this->load->view('admin/common/sidebarMenu.php',$data);	
        $this->load->view('admin/jobseekerlist',$data);        
        $this->load->view('admin/common/footer.php',$data);
        }else{        	
        	$this->app->message('Invalid user access.', 'error');
        	redirect('admin');
        }
	}
	/*
	* salaryrangelist
	*
	* Used for dispalying the admin salary list.
	*
	* @param 
	* @return
	*/
	function salaryrangelist(){
		$data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Salary Range";
        $data['page_slug']			= $this->uri->segment(2);
        $data['pageJS']				= array(base_url()."assets/admin/plugins/select2/select2.min.js",
							base_url()."assets/admin/plugins/DataTables/media/js/jquery.dataTables.min.js",
							base_url()."assets/admin/plugins/DataTables/media/js/DT_bootstrap.js",
							base_url()."assets/admin/js/table-data.js",
							base_url()."assets/admin/plugins/bootstrap-modal/js/bootstrap-modal.js",
							base_url()."assets/admin/plugins/bootstrap-modal/js/bootstrap-modalmanager.js",
							base_url()."assets/admin/js/ui-modals.js",
							base_url()."assets/admin/plugins/jquery-validation/dist/jquery.validate.min.js",
							base_url()."assets/admin/js/form-validation.js");
        $data['initJsFunc']			= array("TableData.init();","UIModals.init();","FormValidator.init();",);
        $data['pageCSS']			= array(base_url()."assets/admin/plugins/select2/select2.css",
							base_url()."assets/admin/plugins/DataTables/media/css/DT_bootstrap.css",
							base_url()."assets/admin/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css",
							base_url()."assets/admin/plugins/bootstrap-modal/css/bootstrap-modal.css");
        $this->load->view('admin/common/header.php',$data);
        $this->load->view('admin/common/topheader.php',$data);
        $this->load->view('admin/salaryrangelist',$data);        
        $this->load->view('admin/common/footer.php',$data);	
	}
	/*
	* functionalarealist
	*
	* Used for dispalying the admin functional area list.
	*
	* @param 
	* @return
	*/
	function functionalarealist(){
		$data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Functional Area";
        $data['page_slug']			= "funtionaltype";
        $data['functinalList']		= $this->common->_getList('functionalarea',""," functionalID DESC ");        
        $this->load->view('admin/common/header.php',$data);
        $this->load->view('admin/common/topheader.php',$data);
        $this->load->view('admin/common/sidebarMenu.php',$data);
        $this->load->view('admin/functionallist',$data);        
        $this->load->view('admin/common/footer.php',$data);		
	}
	/*
	* companylist
	*
	* Used for dispalying the admin functional area list.
	*
	* @param 
	* @return
	*/
	function companylist(){
		if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='1' || $this->session->all_userdata()['userType'] =='2' )){
		$data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Company";
        $data['page_slug']			= 'company';   
        //$data['companylist']		= $this->common->_getList('company',""," companyID DESC ");   
           $data['companylist']		        = $this->common->_getcompanyList();   
        $data['funtionalArealist']		= $this->common->_getList('functionalarea',array('status' => '1')," functionalID DESC ");     
        $this->load->view('admin/common/header.php',$data);
        $this->load->view('admin/common/topheader.php',$data);
        $this->load->view('admin/common/sidebarMenu.php',$data);	
        $this->load->view('admin/companylist',$data);        
        $this->load->view('admin/common/footer.php',$data);	
         }else{        	
        	$this->app->message('Invalid user access.', 'error');
        	redirect('admin');
        }		
	}
	/*
	* jobtypelist
	*
	* Used for dispalying the admin functional area list.
	*
	* @param 
	* @return
	*/
	/*
	* companylist
	*
	* Used for dispalying the admin functional area list.
	*
	* @param 
	* @return
	*/
	function datasetlist(){
		if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='1' || $this->session->all_userdata()['userType'] =='2' )){
		$data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Dataset";
        $data['page_slug']			= 'dataset';
        $data['datasetlist']		= $this->common->_getdatasetList();
        $data['funtionalArealist']	= $this->common->_getList('functionalarea',array('status' => '1')," functionalID DESC ");
        $this->load->view('admin/common/header.php',$data);
        $this->load->view('admin/common/topheader.php',$data);
        $this->load->view('admin/common/sidebarMenu.php',$data);	
        $this->load->view('admin/datasetlist',$data);        
        $this->load->view('admin/common/footer.php',$data);	
        }else{        	
        	$this->app->message('Invalid user access.', 'error');
        	redirect('admin');
        }		
	}
	/*
	* jobtypelist
	*
	* Used for dispalying the admin functional area list.
	*
	* @param 
	* @return
	*/
	function jobtypelist(){
		if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='1' || $this->session->all_userdata()['userType'] =='2' )){
		$data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Job Type";
        $data['page_slug']			= 'jobtype';   
        $data['jobtypeList']		= $this->common->_getList('jobtype',""," jobtypeID DESC ");
        $this->load->view('admin/common/header.php',$data);	 
	    $this->load->view('admin/common/topheader.php',$data);
	    $this->load->view('admin/common/sidebarMenu.php',$data);
        $this->load->view('admin/jobtypelist',$data);        
        $this->load->view('admin/common/footer.php',$data);
        }else{        	
        	$this->app->message('Invalid user access.', 'error');
        	redirect('admin');
        }
	}
	/*
	* login
	*
	* Used for admin login funtionality.
	*
	* @param 
	* @return
	*/
	function login(){
		if ($this->input->server('REQUEST_METHOD') === "POST") {
            $postData = $this->input->post();
            $insert_data = array();
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('user', 'User Type', 'trim|required');           
            if ($this->form_validation->run() != FALSE) {                
	    		$data['email'] = $postData['email'];
		        $data['password'] = md5($postData['password']);
           	    $dataArray = array('email' => $data['email'], 'password' => $data['password'],' userType != ' => '3' , 'userType' => $postData['user']);
                $userData = $this->user_model->loginUser($dataArray);            	
                //print_r($userData);die;
                if($userData['isActive'] == '0'){
                    $this->app->message('Your account is not active. Contact to the administrator', 'error');
                    redirect('signin', $data);
                }
                if (!empty($userData)) {
                    $Sessiondata = array(
                       'loggedin' => true,
                        'fname' => $userData['firstName'],
                        'lname' => $userData['lastName'],
                        'email' => $userData['email'],
                        'userId' => $userData['userID'],
                        'userType' => $userData['userType'],
                        'facebookId' => $userData['facebookId'],
                        'phone' => $userData['phone'],
                        'profilePic' => $link ? $link : $userData['profilePic']
                    );
                    $this->session->set_userdata($Sessiondata);                  
              
                    redirect('admin/dashboard');
                    
                } else {
                    $this->app->message('Invaild User or Email or Password.', 'error');
                    redirect('admin', $data);
                }
                
            } else {
            	if(form_error('email')!=''){
                    $this->message = form_error('email');
                } else if(form_error('password')!='') {
                    $this->message = form_error('email');
                } else if(form_error('user')!='') {
                    $this->message = form_error('user');
                } 
            	$this->app->message($this->message, 'error');
        		redirect('admin');
            }
        }else{
        	$this->app->message('Invalid request.', 'error');
        	redirect('admin');
        }
	}
	/*
	* useredit
	*
	* Used for admin login funtionality.
	*
	* @param 
	* @return
	*/
	function useredit(){
		$data = $this->common->_getById('user', array('userID' =>$this->input->post('id') ));			
		echo json_encode($data);
	}	
	/*
	* useredit
	*
	* Used for user save funtionality.
	*
	* @param 
	* @return
	*/
	function usersave(){		
		if ($this->input->server('REQUEST_METHOD') === "POST") {
            $postData = $this->input->post();                      
            $insert_data = array();            
            $this->form_validation->set_rules('firstName', 'First Name', 'trim|required');
            $this->form_validation->set_rules('lastName', 'Last Name', 'trim|required');            
            $this->form_validation->set_rules('status', 'status', 'trim|required');              
            
           
            if ($this->form_validation->run() != FALSE) {
                $insert_data['firstName'] = trim($postData['firstName']);
                $insert_data['lastName'] = trim($postData['lastName']);               
                $insert_data['isActive'] = $postData['status'];               
               	
               	$updateuser=$this->common->update('user',array('userID' => $postData['_id'] ), $insert_data);
               	echo json_encode(array("status" => TRUE));
            } else {
            	if(form_error('firstName')!=''){
                    $this->message = form_error('firstName');
                } else if(form_error('lastName')!='') {
                    $this->message = form_error('lastName');
                }
               echo json_encode(array("status" => FALSE, "message" => $this->message ));
            }
        }
	}
	/*
	* userdelete
	*
	* Used for user delete funtionality.
	*
	* @param 
	* @return
	*/
	function userdelete(){
		if ($this->input->server('REQUEST_METHOD') === "POST") {
            $postData = $this->input->post();                               
            if ($postData['id']) {
               	$this->common->delete_by_id('user',array('userID' => $postData['id']));
			 	echo json_encode(array("status" => TRUE));               
            } 
        }
	}
	/*
	* jobtypeadd
	*
	* Used for job type add funtionality.
	*
	* @param 
	* @return
	*/
	function jobtypeadd(){			
		if ($this->input->server('REQUEST_METHOD') === "POST") {
            $postData = $this->input->post();                      
            $insert_data = array();            
            $this->form_validation->set_rules('title', 'Title', 'trim|required');            
            $this->form_validation->set_rules('status', 'status', 'trim|required'); 
           
            if ($this->form_validation->run() != FALSE) {
                $insert_data['type'] 	 = trim($postData['title']);
                $insert_data['status'] = trim($postData['status']);               
               	$insert=$this->common->insert('jobtype', $insert_data);
               	echo json_encode(array("status" => TRUE));
            } else {
            	if(form_error('title')!=''){
                    $this->message = form_error('title');
                } else if(form_error('status')!='') {
                    $this->message = form_error('status');
                }
               echo json_encode(array("status" => FALSE, "message" => $this->message ));
            }
        }else{
        	 echo json_encode(array("status" => FALSE, "message" =>'Invalid request made.' ));
        }
	}
	/*
	* jobtypeedit
	*
	* Used for job type edit funtionality.
	*
	* @param 
	* @return
	*/
	function jobtypeedit(){
		$data = $this->common->_getById('jobtype', array('jobtypeID' =>$this->input->post('id') ));			
		echo json_encode($data);
	}
	/*
	* jobtypeupdate
	*
	* Used for job type update funtionality.
	*
	* @param 
	* @return
	*/
	function jobtypeupdate(){
		if ($this->input->server('REQUEST_METHOD') === "POST") {
            $postData = $this->input->post();                      
            $insert_data = array();            
            $this->form_validation->set_rules('title', 'Title', 'trim|required');            
            $this->form_validation->set_rules('status', 'status', 'trim|required'); 
           
            if ($this->form_validation->run() != FALSE) {
                $insert_data['type'] 	 = trim($postData['title']);
                $insert_data['status'] = trim($postData['status']);               
               	$updateuser=$this->common->update('jobtype',array('jobtypeID' => $postData['_id'] ), $insert_data);
               	echo json_encode(array("status" => TRUE));
            } else {
            	if(form_error('title')!=''){
                    $this->message = form_error('title');
                } else if(form_error('status')!='') {
                    $this->message = form_error('status');
                }
               echo json_encode(array("status" => FALSE, "message" => $this->message ));
            }
        }else{
        	 echo json_encode(array("status" => FALSE, "message" =>'Invalid request made.' ));
        }
	}
	/*
	* jobtypedelete
	*
	* Used for job type delete funtionality.
	*
	* @param 
	* @return
	*/	
	function jobtypedelete(){
		if ($this->input->server('REQUEST_METHOD') === "POST") {
            $postData = $this->input->post();                               
            if ($postData['id']) {
               	$this->common->delete_by_id('jobtype',array('jobtypeID' => $postData['id']));
			 	echo json_encode(array("status" => TRUE));               
            } 
        }
	}
	/*
	* funtionaltypeadd
	*
	* Used for funtional type  delete funtionality.
	*
	* @param 
	* @return
	*/
	function funtionaltypeadd(){		
		if ($this->input->server('REQUEST_METHOD') === "POST") {
            $postData = $this->input->post();                      
            $insert_data = array();            
            $this->form_validation->set_rules('title', 'Title', 'trim|required');            
            $this->form_validation->set_rules('status', 'status', 'trim|required'); 
           
            if ($this->form_validation->run() != FALSE) {
                $insert_data['funationalName'] 	 = trim($postData['title']);
                $insert_data['status'] = trim($postData['status']);               
               	$insert=$this->common->insert('functionalarea', $insert_data);
               	echo json_encode(array("status" => TRUE));
            } else {
            	if(form_error('title')!=''){
                    $this->message = form_error('title');
                } else if(form_error('status')!='') {
                    $this->message = form_error('status');
                }
               echo json_encode(array("status" => FALSE, "message" => $this->message ));
            }
        }else{
        	 echo json_encode(array("status" => FALSE, "message" =>'Invalid request made.' ));
        }
	}
        
    /*
	* funtionaltypeedit
	*
	* Used for funtional type  edit funtionality.
	*
	* @param 
	* @return
	*/    
    function funtionaltypeedit(){
		$data = $this->common->_getById('functionalarea', array('functionalID' =>$this->input->post('id') ));			
		echo json_encode($data);
	}
	/*
	* funtionaltypeupdate
	*
	* Used for funtional type  update funtionality.
	*
	* @param 
	* @return
	*/   
	function funtionaltypeupdate(){
		if ($this->input->server('REQUEST_METHOD') === "POST") {
            $postData = $this->input->post();                      
            $insert_data = array();            
            $this->form_validation->set_rules('title', 'Title', 'trim|required');            
            $this->form_validation->set_rules('status', 'status', 'trim|required'); 
           
            if ($this->form_validation->run() != FALSE) {
                $insert_data['funationalName'] 	 = trim($postData['title']);
                $insert_data['status'] = trim($postData['status']);               
               	$updateuser=$this->common->update('functionalarea',array('functionalID' => $postData['_id'] ), $insert_data);
               	echo json_encode(array("status" => TRUE));
            } else {
            	if(form_error('title')!=''){
                    $this->message = form_error('title');
                } else if(form_error('status')!='') {
                    $this->message = form_error('status');
                }
               echo json_encode(array("status" => FALSE, "message" => $this->message ));
            }
        }else{
        	 echo json_encode(array("status" => FALSE, "message" =>'Invalid request made.' ));
        }
	}
     /*
	* fareadelete
	*
	* Used for funtional type  delete funtionality.
	*
	* @param 
	* @return
	*/      
        
    function fareadelete(){
		if ($this->input->server('REQUEST_METHOD') === "POST") {
            $postData = $this->input->post();                               
            if ($postData['id']) {
               	$this->common->delete_by_id('functionalarea',array('functionalID' => $postData['id']));
			 	echo json_encode(array("status" => TRUE));               
            } 
        }
	}

    /*    
	* Create Template
	*
	* Used for Create Template  funtionality.
	*
	* @param 
	* @return
	*/
        
        function addtemplate(){
            
	if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='1' || $this->session->all_userdata()['userType'] =='2' )){
	$data['page_title'] 		        = SITE_TITLE;
        $data['page_name']			= "Add Template";
        $data['page_slug']			= 'addtemplate';   
        $param     = $this->uri->segment(3);
        if($param!=0){
        $data['page_name']			= "Edit Template";
        
            $condition  = array('id'=>$param);
            $data['tempData']		= $this->common->_getById('template_tbl',$condition); 
        }    
      
        $this->load->view('admin/common/header.php',$data);	 
        $this->load->view('admin/common/topheader.php',$data);
        $this->load->view('admin/common/sidebarMenu.php',$data);
        $this->load->view('admin/addtemplate',$data);        
        $this->load->view('admin/common/footer.php',$data);
        }else{        	
        	$this->app->message('Invalid user access.', 'error');
        	redirect('admin');
        }
	}
        
        
            function editTemplate(){
            
	if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='1' || $this->session->all_userdata()['userType'] =='2' )){
	$data['page_title'] 		        = SITE_TITLE;
        $data['page_name']			= "Add Template";
        $data['page_slug']			= 'addtemplate';   
        $param     = $this->uri->segment(3);
        if($param!=0){
        $data['page_name']			= "Edit Template";
        
            $condition  = array('id'=>$param);
            $data['tempData']		= $this->common->_getById('template_tbl',$condition); 
        }    
      
        $this->load->view('admin/common/header.php',$data);	 
        $this->load->view('admin/common/topheader.php',$data);
        $this->load->view('admin/common/sidebarMenu.php',$data);
        $this->load->view('admin/addtemplate',$data);        
        $this->load->view('admin/common/footer.php',$data);
        }else{        	
        	$this->app->message('Invalid user access.', 'error');
        	redirect('admin');
        }
	}
        
        
        
        function createtemplate(){
        
 $postData = $this->input->post();   

        
          if ($this->input->server('REQUEST_METHOD') === "POST") {
            $postData = $this->input->post();  
         
    $postData['templateData']=$this->input->post('templateData',FALSE);
     
   
            $this->form_validation->set_rules('templateName', 'Template Name', 'trim|required|min_length[3]');            
            $this->form_validation->set_rules('templateData', 'Template Data', 'trim|required'); 
            
            if($this->form_validation->run()!=FALSE){
                 
                
                $data['name'] = $postData['templateName'];
                $data['content']     =  $this->input->post('templateData',FALSE);  
            //    $data['createdAt']   = date('Y-m-d H:i:s');
                $data['status']      = ($postData['status'])?'1':'0';
               
                if(!empty($postData['tempID'])){
                       
                   $condition  =array('id'=>$postData['tempID']);
                   $this->common->update('template_tbl',$condition,$data);  
                   redirect('admin/template');
                    
                }else{
                    $this->common->insert('template_tbl', $data);
                    redirect('admin/template');
                }
                
            }else{
              if(form_error('templateName')!='') {
                 $this->message = form_error('templateName');   
              } else if(form_error('templateData')!=''){
                 $this->message = form_error('templateData');    
              }
                
            }
          }else{
                 $this->app->message('Invalid user access.', 'error');
        	redirect('admin');
          }
            
        }
        
        
        
           function updateTemplate(){
        
             $postData = $this->input->post();   

        
          if ($this->input->server('REQUEST_METHOD') === "POST") {
            $postData = $this->input->post();  
         
         $postData['templateData']=$this->input->post('templateData',FALSE);
     
   
            $this->form_validation->set_rules('templateName', 'Template Name', 'trim|required|min_length[3]');            
            $this->form_validation->set_rules('templateData', 'Template Data', 'trim|required'); 
            
            if($this->form_validation->run()!=FALSE){
                 
                
                $data['name'] = $postData['templateName'];
                $data['content']     =  $this->input->post('templateData',FALSE);  
            //    $data['createdAt']   = date('Y-m-d H:i:s');
                $data['status']      = ($postData['status'])?'1':'0';
               
                if(!empty($postData['tempID'])){
                       
                   $condition  =array('id'=>$postData['tempID']);
                   $this->common->update('template_tbl',$condition,$data);  
                   redirect('admin/template');
                    
                }else{
                    $this->common->insert('template_tbl', $data);
                    redirect('admin/template');
                }
                
            }else{
              if(form_error('templateName')!='') {
                 
                   $this->app->message(form_error('templateName'), 'error');
              } else if(form_error('templateData')!=''){
                
                   $this->app->message(form_error('templateData'), 'error');
              }
                 
            }
          }else{
                 $this->app->message('Invalid user access.', 'error');
        	redirect('admin');
          }
            
        }
        
        
        
        function manageTemplate(){
          if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='1' || $this->session->all_userdata()['userType'] =='2' )){
        $data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Template";
        $data['page_slug']			= 'template';   
        
        $data['templatelist']		= $this->common->_getList('template_tbl',""," id DESC "); 
       
        $this->load->view('admin/common/header.php',$data);	 
        $this->load->view('admin/common/topheader.php',$data);
        $this->load->view('admin/common/sidebarMenu.php',$data);
        $this->load->view('admin/template',$data);        
        $this->load->view('admin/common/footer.php',$data);
        }else{        	
        	$this->app->message('Invalid user access.', 'error');
        	redirect('admin');
        }   
     }


     public function getpreviewmail(){
             
                 $postdata = $this->input->post();
                 $tempID = $postdata['tempID'];
                       
                 $message = $this->common->_getTemplateDatabyAdmin($tempID); 
            
                echo $message;
              
         }





        /*    
	* Company
	*
	* Used for view Company  funtionality.
	*
	* @param 
	* @return
	*/
            
        
        
	function company(){
        if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='1' || $this->session->all_userdata()['userType'] =='2' )){
        $data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Company";
        $data['page_slug']			= 'company';   
        $data['funtionalArealist']	= $this->common->_getList('functionalarea',array('status' => '1')," functionalID DESC ");  
        $data['countrylist']		= $this->common->_getList('countries',""," name ASC"); 
        $data['rangelist']		= $this->common->_getList('employeerange',""," emprangeID ASC");                    
        $this->load->view('admin/common/header.php',$data);	 
        $this->load->view('admin/common/topheader.php',$data);
        $this->load->view('admin/common/sidebarMenu.php',$data);
        $this->load->view('admin/company',$data);        
        $this->load->view('admin/common/footer.php',$data);
        }else{        	
        	$this->app->message('Invalid user access.', 'error');
        	redirect('admin');
        }
	}

         
     /*    
	* createCompany
	*
	* Used for create Company  funtionality.
	*
	* @param 
	* @return
	*/
	function createCompany(){            
      
          if ($this->input->server('REQUEST_METHOD') === "POST") {
            $postData = $this->input->post();      
       
         
            $insert_data = array();            
            $this->form_validation->set_rules('companyName', 'company Name', 'trim|required|min_length[3]');            
            $this->form_validation->set_rules('contactName', 'Contact Name', 'trim|required|min_length[3]'); 
            $this->form_validation->set_rules('contactEmail', 'Company email', 'trim|required|valid_email|is_unique[company.primaryEmail]');            
            $this->form_validation->set_rules('funArea', 'Funtional Area', 'trim|required');      
            $this->form_validation->set_rules('website', 'Website', 'trim|required|callback_checkwebsiteurl');  
            $this->form_validation->set_rules('contactNumber', 'Contact Number', 'trim|required|numeric|min_length[5]|max_length[15]');            
            $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[3]');  
            $this->form_validation->set_rules('country', 'Country', 'trim|required'); 
            $this->form_validation->set_rules('state', 'State', 'trim|required'); 
            $this->form_validation->set_rules('city', 'City', 'trim|required'); 
            $this->form_validation->set_rules('status', 'status', 'trim|required'); 
            $this->form_validation->set_rules('foundedyear', 'Founded year', 'trim|required|numeric'); 
            $this->form_validation->set_rules('emprange', 'Employee Range ', 'trim|required'); 
            
           
            
            if ($this->form_validation->run() != FALSE) {
                
                $insert_data['companyName'] 	         = trim($postData['companyName']);
                $insert_data['primarycontactname'] 	 = trim($postData['contactName']);
                $insert_data['primaryEmail'] 	         = trim($postData['contactEmail']);
                $insert_data['website'] 	         = trim($postData['website']);
                $insert_data['companyFunctionalId']		= trim($postData['funArea']);
                $insert_data['address'] 	         = trim($postData['address']); 
                $insert_data['country'] 	         	= trim($postData['country']);
                $insert_data['state'] 	         		= trim($postData['state']);
                $insert_data['city'] 	         		= trim($postData['city']);              
                $insert_data['contactnumbers'] 	         = trim($postData['contactNumber']);
                $insert_data['createdDate']              = date("Y-m-d H:i:s");
                $insert_data['status'] = trim($postData['status']);   
                $insert_data['empRangeID'] 	         		= trim($postData['emprange']);
                $insert_data['foundedYear'] 	         		= trim($postData['foundedyear']);
               
                $insert_data['logo']                     = trim($postData['profilepic']);
               	$insert=$this->common->insert('company', $insert_data);
               	echo json_encode(array("status" => TRUE));
                } else {
                
            	if(form_error('companyName')!=''){
                    $this->message = form_error('companyName');
                } else if(form_error('contactName')!=''){
                      $this->message = form_error('contactName');
                } else if(form_error('contactEmail')!=''){
                      $this->message = form_error('contactEmail');
                } else if(form_error('funArea')!=''){
                      $this->message = form_error('funArea');
                } else if(form_error('website')!=''){
                      $this->message = form_error('website');
                } else if(form_error('contactNumber')!=''){
                      $this->message = form_error('contactNumber');
                } else if(form_error('address')!=''){
                      $this->message = form_error('address');
                } else if(form_error('country')!=''){
                      $this->message = form_error('country');
                } else if(form_error('state')!=''){
                      $this->message = form_error('state');
                } else if(form_error('city')!=''){
                      $this->message = form_error('city');
                } else if(form_error('status')!='') {
                    $this->message = form_error('status');
                } 
                  else if(form_error('emprange')!='') {
                    $this->message = form_error('emprange');
                } 
                 else if(form_error('foundedyear')!='') {
                    $this->message = form_error('foundedyear');
                }      
               echo json_encode(array("status" => FALSE, "message" => $this->message ));
            }
        }else{
        	 echo json_encode(array("status" => FALSE, "message" =>'Invalid request made.' ));
        }
       }
     
        
     /*    
	* companyupdate
	*
	* Used for company update  funtionality.
	*
	* @param 
	* @return
	*/     
    function companyedit($id){
    	
    	if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='1' || $this->session->all_userdata()['userType'] =='2' )){
		$data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Company";
        $data['page_slug']			= 'company';   
        $data['funtionalArealist']		= $this->common->_getList('functionalarea',array('status' => '1')," functionalID DESC ");  
        $data['companyDetail'] = $this->common->_getById('company', array('companyID' =>$id ));
      	$data['countrylist']		= $this->common->_getList('countries',""," name ASC");  
         $data['rangelist']		= $this->common->_getList('employeerange',""," emprangeID ASC");      
        $this->load->view('admin/common/header.php',$data);	 
	    $this->load->view('admin/common/topheader.php',$data);
	    $this->load->view('admin/common/sidebarMenu.php',$data);
        $this->load->view('admin/company',$data);        
        $this->load->view('admin/common/footer.php',$data);
        }else{        	
        	$this->app->message('Invalid user access.', 'error');
        	redirect('admin');
        }
		
		//echo json_encode($data);
	}
     function companyupdate(){
         
         	//print_r($_POST);
            if ($this->input->server('REQUEST_METHOD') === "POST") {
            $postData = $this->input->post();      
      
            $insert_data = array();            
            $this->form_validation->set_rules('companyName', 'company Name', 'trim|required|min_length[3]');            
            
            $this->form_validation->set_rules('contactName', 'Contact Name', 'trim|required|min_length[3]'); 
            
       
            $this->form_validation->set_rules('contactEmail', 'Company email', 'trim|required|valid_email|callback_checkusername['.$postData["_id"].']');
            $this->form_validation->set_rules('funArea', 'Funtional Area', 'trim|required');             
            $this->form_validation->set_rules('website', 'Website', 'trim|required|callback_checkwebsiteurl');  
            $this->form_validation->set_rules('contactNumber', 'Contact Number', 'trim|required|numeric');            
            $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('country', 'Country', 'trim|required'); 
            $this->form_validation->set_rules('state', 'State', 'trim|required'); 
            $this->form_validation->set_rules('city', 'City', 'trim|required'); 
            $this->form_validation->set_rules('status', 'status', 'trim|required'); 
            $this->form_validation->set_rules('foundedyear', 'Founded year', 'trim|required|numeric'); 
            $this->form_validation->set_rules('emprange', 'Employee Range ', 'trim|required'); 
            if ($this->form_validation->run() != FALSE) {
                
                $insert_data['companyName'] 	        = trim($postData['companyName']);
                $insert_data['primarycontactname'] 	 	= trim($postData['contactName']);
                $insert_data['primaryEmail'] 	        = trim($postData['contactEmail']);
                $insert_data['companyFunctionalId']		= trim($postData['funArea']);
                $insert_data['website'] 	         	= trim($postData['website']);
                $insert_data['address'] 	         	= trim($postData['address']);
                $insert_data['country'] 	         	= trim($postData['country']);
                $insert_data['state'] 	         		= trim($postData['state']);
                $insert_data['city'] 	         		= trim($postData['city']);
	            $insert_data['contactnumbers'] 	 		= trim($postData['contactNumber']);
	            $insert_data['updatedDate']             = date("Y-m-d H:i:s");
                $insert_data['status'] 					= trim($postData['status']);  
                if(!empty($postData['profilepic']))
                $insert_data['logo']                            = trim($postData['profilepic']);     
                $insert_data['empRangeID'] 	         		= trim($postData['emprange']);
                $insert_data['foundedYear'] 	         		= trim($postData['foundedyear']);
               	$updateuser=$this->common->update('company',array('companyID' => $postData['_id'] ), $insert_data);
               	echo json_encode(array("status" => TRUE));
            }else {
                
            	if(form_error('companyName')!=''){
                    $this->message = form_error('companyName');
                } else if(form_error('contactName')!=''){
                      $this->message = form_error('contactName');
                } else if(form_error('contactEmail')!=''){
                      $this->message = form_error('contactEmail');
                } else if(form_error('funArea')!=''){
                      $this->message = form_error('funArea');
                } else if(form_error('website')!=''){
                      $this->message = form_error('website');
                } else if(form_error('contactNumber')!=''){
                      $this->message = form_error('contactNumber');
                } else if(form_error('address')!=''){
                      $this->message = form_error('address');
                } else if(form_error('country')!=''){
                      $this->message = form_error('country');
                } else if(form_error('state')!=''){
                      $this->message = form_error('state');
                } else if(form_error('city')!=''){
                      $this->message = form_error('city');
                } else if(form_error('status')!='') {
                    $this->message = form_error('status');
                } 
                 else if(form_error('emprange')!='') {
                    $this->message = form_error('emprange');
                } 
                 else if(form_error('foundedyear')!='') {
                    $this->message = form_error('foundedyear');
                }     
               echo json_encode(array("status" => FALSE, "message" => $this->message ));
            }
        }else{
        	 echo json_encode(array("status" => FALSE, "message" =>'Invalid request made.' ));
        }
	}
    //Check Email in Edit company
    function checkusername($contactEmail , $id) {
	     $dataArr = array('companyID !=' => $id, 'primaryEmail' => $contactEmail);
	     $return_value = $this->common->_getById('company',$dataArr);                
	     if ($return_value){
	       $this->form_validation->set_message('checkusername', 'Sorry, This Email is already used by another user please select another one');
	        return FALSE;
	     } else{
	        return TRUE;
	     }
    }

    function checkwebsiteurl($string_url){
        $reg_exp = "@^(http\:\/\/|https\:\/\/)?([a-z0-9][a-z0-9\-]*\.)+[a-z0-9][a-z0-9\-]*$@i";
        if(preg_match($reg_exp, $string_url) == TRUE){
         return TRUE;
        }
        else{
         $this->form_validation->set_message('checkwebsiteurl', 'Website url is invalid format');
         return FALSE;
        }
	 }   
    /*    
	* companydelete
	*
	* Used for delete company funtionality.
	*
	* @param 
	* @return
	*/ 
    function companydelete(){
	if ($this->input->server('REQUEST_METHOD') === "POST") {
        $postData = $this->input->post();                               
        if ($postData['id']) {
           	$this->common->delete_by_id('company',array('companyID' => $postData['id']));
		 	echo json_encode(array("status" => TRUE));               
        } 
      }
	}
	/*    
	* getstate
	*
	* Used for state list funtionality.
	*
	* @param 
	* @return
	*/
	function getstate(){
		$data['stateList']	= $this->common->_getList('states',array("country_id" => $this->input->post('country'))," name ASC ");
		echo json_encode(($data['stateList']));
	} 
	/*    
	* getcity
	*
	* Used for city list funtionality.
	*
	* @param 
	* @return
	*/
	function getcity(){
		$data['cityList']	= $this->common->_getList('cities',array("state_id" => $this->input->post('state'))," name ASC ");
		echo json_encode(($data['cityList']));
	}
	/*    
	* exportcountry
	*
	* Used for export country list funtionality.
	*
	* @param 
	* @return
	*/
	function exportcountry(){
		$data = $this->common->_getList('countries',""," name ASC ");
		$heads= array(array("ID","Sort Name","Country Name"));
		$data =array_merge($heads , $data);		
		$this->common->outputCSV($data,"countries.csv");
	}
	/*    
	* exportstate
	*
	* Used for export state list funtionality.
	*
	* @param 
	* @return
	*/
	function exportstate(){
		$data = $this->common->_getList('states',""," country_id ASC ");		
		$heads= array(array("ID","State Name","country Id"));
		$data =array_merge($heads , $data);		
		$this->common->outputCSV($data,"states.csv");
	}
	/*    
	* exportcity
	*
	* Used for export city list funtionality.
	*
	* @param 
	* @return
	*/
	function exportcity(){
		$data = $this->common->_getList('cities',""," state_id ASC ");		
		$heads= array(array("ID","City Name","State Id"));
		$data =array_merge($heads , $data);		
		$this->common->outputCSV($data,"cities.csv");
	}
	/*    
	* exportcompany
	*
	* Used for export company list funtionality.
	*
	* @param 
	* @return
	*/
	function exportcompany(){
		$data = $this->common->_getList('company',""," companyID ASC ");		
		$heads= array(array("companyID","companyName","companyFunctionalId","status","primarycontactname","primaryEmail","website","logo","address","country","state","city","contactnumbers","createdDate","updatedDate"));
		$data =array_merge($heads , $data);		
		$this->common->outputCSV($data,"company.csv");
	}
	/*    
	* importcompany
	*
	* Used for impoer company list funtionality.
	*
	* @param 
	* @return
	*/
	function exportfunctionalarea(){
		$data = $this->common->_getList('functionalarea',""," functionalID ASC ");		
		$heads= array(array("Funaional ID","Title","status"));
		$data =array_merge($heads , $data);		
		$this->common->outputCSV($data,"functionalarea.csv");
	}
	function importcompany(){
		if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='1' || $this->session->all_userdata()['userType'] =='2' )){
		$data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Import Company";
        $data['page_slug']			= 'companyImport';   
        
        $this->load->view('admin/common/header.php',$data);	 
	    $this->load->view('admin/common/topheader.php',$data);
	    $this->load->view('admin/common/sidebarMenu.php',$data);
        $this->load->view('admin/importcompany',$data);        
        $this->load->view('admin/common/footer.php',$data);
        }else{        	
        	$this->app->message('Invalid user access.', 'error');
        	redirect('admin');
        }
	}
	function importcompanycsv(){
        
        $data['error'] = '';    
        $config['upload_path'] =  FCPATH.'uploads/companycsv/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('companycsvimport')) {
            $data['error'] = $this->upload->display_errors();
            $this->app->message($data['error'], 'error');
           redirect('admin/importcompany');
        } else {

            $file_data = $this->upload->data();
            $file_path =  FCPATH.'uploads/companycsv/'.$file_data['file_name'];
 			
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                //echo "<pre>";print_r($csv_array);die;
                foreach ($csv_array as $row) {

                	$companyExist	=	$this->common->_getById('company', " companyName 	LIKE '%".$row['companyName']."%'");
                	$emailExist		=	$this->common->_getById('company', " primaryEmail  = '" .$row['primaryEmail']."' ");
                	$countryExist	=	$this->common->_getById('countries', " id  = '" .$row['country']."' ");
                	$stateExist		=	$this->common->_getById('states', " id  = '" .$row['state']."' ");
                	$cityExist		=	$this->common->_getById('cities', " id  = '" .$row['city']."' ");

                	$insert_data['companyName'] 	        = trim($row['companyName']);
	                $insert_data['primarycontactname'] 	 	= trim($row['primarycontactname']);
	                $insert_data['primaryEmail'] 	        = trim($row['primaryEmail']);
	                $insert_data['companyFunctionalId']		= trim($row['companyFunctionalId']);
	                $insert_data['website'] 	         	= trim($row['website']);
	                $insert_data['address'] 	         	= trim($row['address']);
	                $insert_data['country'] 	         	= trim($row['country']);
	                $insert_data['state'] 	         		= trim($row['state']);
	                $insert_data['city'] 	         		= trim($row['city']);
	                 $insert_data['createdDate']              = date("Y-m-d H:i:s");
		            $insert_data['contactnumbers'] 	 		= trim($row['contactNumber']);
		            
	                $insert_data['status'] 					= trim($row['status']);
	                if(empty($companyExist) && empty($emailExist) && $countryExist && $countryExist && $stateExist && $cityExist){
	                	$insert=$this->common->insert('company', $insert_data); 
	            	}
                }
               
                $this->app->message('Csv Data Imported Succesfully', 'success');                      
               	redirect('admin/importcompany');
                //echo "<pre>"; print_r($insert_data);
            } else 
            	$this->app->message('Invalid File', 'error');                
              	redirect('admin/importcompany');
        }
	}
	 /*    
	* Dataset
	*
	* Used for view dataset  funtionality.
	*
	* @param 
	* @return
	*/
	function dataset(){
		if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='1' || $this->session->all_userdata()['userType'] =='2' )){
		$data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Dataset";
        $data['page_slug']			= 'dataset';   
        $data['datasetlist']		= $this->common->_getList('dataset',""," datasetId DESC");  
        $data['countrylist']		= $this->common->_getList('countries',""," name ASC");    
        $data['funtionalArealist']	= $this->common->_getList('functionalarea',array('status' => '1')," functionalID DESC ");  
               
        $data['rangelist']		= $this->common->_getList('employeerange',""," emprangeID ASC");        
        $this->load->view('admin/common/header.php',$data);	 
        $this->load->view('admin/common/topheader.php',$data);
        $this->load->view('admin/common/sidebarMenu.php',$data);
        $this->load->view('admin/dataset',$data);        
        $this->load->view('admin/common/footer.php',$data);
        }else{        	
        	$this->app->message('Invalid user access.', 'error');
        	redirect('admin');
        }
	}
	/*    
	* getTotCompanies
	*
	* Used for total companies funtionality.
	*
	* @param 
	* @return
	*/
	function getTotCompanies(){
		//print_r($_POST);
		$emprangeQuery = $industry = $cities ='';
		if($this->input->post('emprange')){

			$emprangeQuery = " AND emprangeID in (".rtrim($this->input->post('emprange'),',').")";
		}

		if($this->input->post('cities')){

			$cities = " AND city in (".rtrim($this->input->post('cities'),',').")";
		}

		if($this->input->post('industry')){
			$industry = " AND companyFunctionalId = ".$this->input->post('industry')."";
		}
		$data = $this->common->_getCount('company'," status = 1  ".$cities." ".$emprangeQuery." ".$industry."  "," companyID ASC ");		
		if($data){
			echo $data;
		} else {
			echo 0;
		}
	}
	/*    
	* datasetadd
	*
	* Used for dataset add.
	*
	* @param 
	* @return
	*/
	function datasetadd(){
		
		if ($this->input->server('REQUEST_METHOD') === "POST") {
            $postData = $this->input->post();                      
            $insert_data = array();            
            $this->form_validation->set_rules('title', 'Title', 'trim|required');            
            $this->form_validation->set_rules('mktgmessage', 'Marketting Message', 'trim|required'); 
            $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric'); 
            $this->form_validation->set_rules('discount', 'Discount', 'trim|required|numeric'); 
            $this->form_validation->set_rules('description', 'Description', 'trim|required'); 
            $this->form_validation->set_rules('status', 'Status', 'trim|required'); 
            $this->form_validation->set_rules('country', 'Country', 'trim|required'); 
            $this->form_validation->set_rules('state', 'State', 'trim|required'); 
            $this->form_validation->set_rules('city[]', 'City', 'trim|required'); 
            
             $this->form_validation->set_rules('companyAge', 'Company Age', 'trim|required'); 
              $this->form_validation->set_rules('funcArea', 'Industry', 'trim|required'); 
             
           
            if ($this->form_validation->run() != FALSE) {
                $insert_data['title'] 	 = trim($postData['title']);
                $insert_data['markettingMessage'] = trim($postData['mktgmessage']);               
                $insert_data['description'] = trim($postData['description']);               
                $insert_data['price'] = trim($postData['price']);               
                $insert_data['discount	'] = trim($postData['discount']);               
                $insert_data['status'] = trim($postData['status']);               
                $insert_data['country'] = trim($postData['country']);               
                $insert_data['state'] = trim($postData['state']);               
                $insert_data['city'] = implode(',',$postData['city']); 
                $insert_data['empRange']     = implode(',',$postData['emprange']);   
                $insert_data['functionalID'] = trim($postData['funcArea']); 
                $insert_data['companyAge']   = trim($postData['companyAge']); 
                $insert_data['datasetCount'] = trim($postData['datacount']);                      
               	$insert=$this->common->insert('dataset', $insert_data);
               	echo json_encode(array("status" => TRUE));
            } else {
            	if(form_error('title')!=''){
                    $this->message = form_error('title');
                } else if(form_error('mktgmessage')!='') {
                    $this->message = form_error('mktgmessage');
                } else if(form_error('price')!='') {
                    $this->message = form_error('price');
                } else if(form_error('discount')!='') {
                    $this->message = form_error('discount');
                } else if(form_error('description')!='') {
                    $this->message = form_error('description');
                } else if(form_error('status')!='') {
                    $this->message = form_error('status');
                } else if(form_error('country')!='') {
                    $this->message = form_error('country');
                } else if(form_error('state')!='') {
                    $this->message = form_error('state');
                } else if(form_error('city[]')!='') {
                    $this->message = form_error('city[]');
                }else if(form_error('companyAge')!='') {
                    $this->message = form_error('companyAge');
                } else if(form_error('funcArea')!='') {
                    $this->message = form_error('funcArea');
                }
               echo json_encode(array("status" => FALSE, "message" => $this->message ));
            }
        }else{
        	 echo json_encode(array("status" => FALSE, "message" =>'Invalid request made.' ));
        }
	}
	/*    
	* datasetedit
	*
	* Used for dataset edit.
	*
	* @param 
	* @return
	*/
	public function datasetedit($id){
		
		if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='1' || $this->session->all_userdata()['userType'] =='2' )){
		$data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Dataset";
        $data['page_slug']			= 'dataset';   
        $data['datasetDetail'] = $this->common->_getById('dataset', array('datasetId' =>$id ));
        $data['totalcompaies'] = $this->common->_getCount('company'," city in (".$data['datasetDetail']->city." ) AND status = 1 "," companyID ASC ");	
         $data['funtionalArealist']	= $this->common->_getList('functionalarea',array('status' => '1')," functionalID DESC ");  
               
        $data['rangelist']		= $this->common->_getList('employeerange',""," emprangeID ASC");   	
		

      	$data['countrylist']		= $this->common->_getList('countries',""," name ASC");  
        $this->load->view('admin/common/header.php',$data);	 
	    $this->load->view('admin/common/topheader.php',$data);
	    $this->load->view('admin/common/sidebarMenu.php',$data);
        $this->load->view('admin/dataset',$data);        
        $this->load->view('admin/common/footer.php',$data);
        }else{        	
        	$this->app->message('Invalid user access.', 'error');
        	redirect('admin');
        }
	}
	/*    
	* datasetupdate
	*
	* Used for dataset update.
	*
	* @param 
	* @return
	*/
	public function datasetupdate(){
	
		if ($this->input->server('REQUEST_METHOD') === "POST") {
            $postData = $this->input->post();                      
            $insert_data = array();            
           $this->form_validation->set_rules('title', 'Title', 'trim|required');            
            $this->form_validation->set_rules('mktgmessage', 'Marketting Message', 'trim|required'); 
            $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric'); 
            $this->form_validation->set_rules('discount', 'Discount', 'trim|required|numeric'); 
            $this->form_validation->set_rules('description', 'Description', 'trim|required'); 
            $this->form_validation->set_rules('status', 'Status', 'trim|required'); 
            $this->form_validation->set_rules('country', 'Country', 'trim|required'); 
            $this->form_validation->set_rules('state', 'State', 'trim|required'); 
            $this->form_validation->set_rules('city[]', 'City', 'trim|required'); 
            $this->form_validation->set_rules('companyAge', 'Company Age', 'trim|required'); 
              $this->form_validation->set_rules('funcArea', 'Industry', 'trim|required');
            if ($this->form_validation->run() != FALSE) {
                $insert_data['title'] 	 = trim($postData['title']);
                $insert_data['markettingMessage'] = trim($postData['mktgmessage']);               
                $insert_data['description'] = trim($postData['description']);               
                $insert_data['price'] = trim($postData['price']);               
                $insert_data['discount	'] = trim($postData['discount']);               
                $insert_data['status'] = trim($postData['status']);               
                $insert_data['country'] = trim($postData['country']);               
                $insert_data['state'] = trim($postData['state']);               
                $insert_data['city'] = implode(',',$postData['city']); 
                $insert_data['empRange']     = implode(',',$postData['emprange']);   
                $insert_data['functionalID'] = trim($postData['funcArea']); 
                $insert_data['companyAge']   = trim($postData['companyAge']); 
                $insert_data['datasetCount'] = trim($postData['datacount']);   
                                         
                      
               	$updateuser=$this->common->update('dataset',array('datasetId' => $postData['_dID'] ), $insert_data);
               	echo json_encode(array("status" => TRUE));
            } else {
            	if(form_error('title')!=''){
                    $this->message = form_error('title');
                } else if(form_error('mktgmessage')!='') {
                    $this->message = form_error('mktgmessage');
                } else if(form_error('price')!='') {
                    $this->message = form_error('price');
                } else if(form_error('discount')!='') {
                    $this->message = form_error('discount');
                } else if(form_error('description')!='') {
                    $this->message = form_error('description');
                } else if(form_error('status')!='') {
                    $this->message = form_error('status');
                } else if(form_error('country')!='') {
                    $this->message = form_error('country');
                } else if(form_error('state')!='') {
                    $this->message = form_error('state');
                } else if(form_error('city[]')!='') {
                    $this->message = form_error('city[]');
                }else if(form_error('companyAge')!='') {
                    $this->message = form_error('companyAge');
                } else if(form_error('funcArea')!='') {
                    $this->message = form_error('funcArea');
                }
               echo json_encode(array("status" => FALSE, "message" => $this->message ));
            }
        }else{
        	 echo json_encode(array("status" => FALSE, "message" =>'Invalid request made.' ));
        }
	}
	/*    
	* datasetdelete
	*
	* Used for dataset delete.
	*
	* @param 
	* @return
	*/
	public function datasetdelete(){
		if ($this->input->server('REQUEST_METHOD') === "POST") {
	        $postData = $this->input->post();                               
	        if ($postData['id']) {
	           	$this->common->delete_by_id('dataset',array('datasetId' => $postData['id']));
			 	echo json_encode(array("status" => TRUE));               
	        } 
      	}
	}
	/*    
	* exportdataset
	*
	* Used for dataset export.
	*
	* @param 
	* @return
	*/
	function exportdataset(){
		$data = $this->common->_getList('dataset',""," datasetId ASC ");		
		$heads= array(array("datasetId","title","markettingMessage","description","companyAge","functionalID","empRange","datasetCount","price","discount","status","country","state","city"));
		$data =array_merge($heads , $data);		
		$this->common->outputCSV($data,"dataset.csv");
	}
	/*    
	* importdataset
	*
	* Used for dataset import.
	*
	* @param 
	* @return
	*/
	function importdataset(){
		if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='1' || $this->session->all_userdata()['userType'] =='2' )){
		$data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Import Dataset";
        $data['page_slug']			= 'datasetImport';   
        
        $this->load->view('admin/common/header.php',$data);	 
	    $this->load->view('admin/common/topheader.php',$data);
	    $this->load->view('admin/common/sidebarMenu.php',$data);
        $this->load->view('admin/importdataset',$data);        
        $this->load->view('admin/common/footer.php',$data);
        }else{        	
        	$this->app->message('Invalid user access.', 'error');
        	redirect('admin');
        }
	}
	function importdatasetcsv(){
        
        $data['error'] = '';    
        $config['upload_path'] =  FCPATH.'uploads/datasetcsv/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '1000';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('datasetcsvimport')) {
            $data['error'] = $this->upload->display_errors();
            $this->app->message($data['error'], 'error');
           redirect('admin/importdataset');
        } else {

            $file_data = $this->upload->data();
            $file_path =  FCPATH.'uploads/datasetcsv/'.$file_data['file_name'];
 			
            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
                //echo "<pre>";print_r($csv_array);die;
                foreach ($csv_array as $row) {

                	$titleExist	=	$this->common->_getById('dataset', " title 	LIKE '".$row['title']."'");
                	
                	$insert_data['title'] 	        	= trim($row['title']);
	                $insert_data['markettingMessage'] 	= trim($row['markettingMessage']);
	                $insert_data['description'] 	    = trim($row['description']);
	                $insert_data['companyAge']			= trim($row['companyAge']);
	                $insert_data['functionalID'] 	    = trim($row['functionalID']);
	                $insert_data['empRange'] 	        = trim($row['empRange']);
	                $insert_data['price'] 	         	= trim($row['price']);
	                $insert_data['discount'] 	        = trim($row['discount']);
	                $insert_data['status']              = trim("status");
		            $insert_data['country'] 	 		= trim($row['country']);		            
	                $insert_data['state'] 	 			= trim($row['state']);
	                $insert_data['city'] 	 			= trim($row['city']);
	              
	                if(empty($titleExist)){
	                	$insert=$this->common->insert('dataset', $insert_data); 
	            	}
                }
               
                $this->app->message('Csv Data Imported Succesfully', 'success');                      
               	redirect('admin/importdataset');
                //echo "<pre>"; print_r($insert_data);
            } else 
            	$this->app->message('Invalid File', 'error');                
              	redirect('admin/importdataset');
        }
	}
        
        
        
	      public function userDatasetlistData(){

            if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='1' || $this->session->all_userdata()['userType'] =='2' )) {
                  $data['meta_description']    = METADESCRIPTION;
                  $data['page_title']          = SITE_TITLE;
                  $data['page_name']           = "User Dataset List";
              //    $data['profiledetails']     = $this->common->getprofileDetails();
                 // $data['companylist']	 = $this->common->_getcompanyList();

                  $data['datasetlist']         = $this->common->get_trackuserdatasetAdmin();


                   $this->load->view('admin/common/header.php',$data);	 
                            $this->load->view('admin/common/topheader.php',$data);
                                     $this->load->view('admin/common/sidebarMenu.php',$data);
                                      $this->load->view('admin/userDatasetlist',$data);        
                                                $this->load->view('admin/common/footer.php',$data);
        }else{        	
        	$this->app->message('Invalid user access.', 'error');
        	redirect('admin');
        }   
         }    
	
	   
         
        
	
	
	
}

?>