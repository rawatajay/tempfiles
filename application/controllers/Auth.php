<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Auth
* 
* 
* @package    	CI
* @subpackage 	Job Hunter
* @category 	Auth Controller
* @author 	  	TrivialWorks*
*/
class Auth extends CI_Controller{

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
		$this->load->model('auth_model');	
	}

	/*
	* index
	*
	* Used for dispalying the login page.
	*
	* @param 
	* @return
	*/
	function index(){		
		if(!empty($this->session->all_userdata()['userId'])){
            $this->load_dashboard();
        }
		$data['page_title'] 	= SITE_TITLE;
        $data['page_name']		= "Login";
        $data['page_slug']		= $this->uri->segment(1);
        $data['userTypes']	    = $this->common->_getList('userType','status=1','orderNo ASC');
        $this->load->view('admin/common/header.php',$data);
        $this->load->view('admin/login',$data);        
        $this->load->view('admin/common/footer.php',$data);
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
            $this->form_validation->set_rules('usertype', 'User Type', 'trim|required');           
            if ($this->form_validation->run() != FALSE) {                
	    		//$data['email'] = $postData['email'];
		        //$data['password'] = md5($postData['password']);
                $dataArray = " ( email = '".$postData['email']."' OR empId='".$postData['email']."' ) AND userType = ".$postData['usertype'].""; 
           	    //$dataArray = array('email' => $postData['email'], 'userType' => $postData['usertype']);
                $userData = $this->auth_model->loginUser($dataArray);
                if(!empty($userData)) {
                    $result = password_verify($postData['password'], $userData['password']);
                    if($userData['isActive'] == false){
                        $this->app->message('Your account is not active. Contact to the administrator', 'error');
                        redirect(base_url(), $postData);
                    }
                    if ($result == true) {
                        $Sessiondata = array(                       
                            'loggedin' => true,                        
                            'empId' => $userData['empId'],                        
                            'name' => $userData['name'],                        
                            'email' => $userData['email'],                        
                            'userId' => $userData['userID'],                        
                            'userType' => $userData['userType'],                        
                            'phone' => $userData['contact'],                        
                            'profilePic' => $userData['profilePic']                    
                            );
                        $this->session->set_userdata($Sessiondata);                  
                        $this->load_dashboard();
                    } else {
                        $this->app->message('Invaild User or Email or Password.', 'error');
                        redirect(base_url(), $data);
                    }
                } else {
                    $this->app->message('User does not exist with this account.', 'error');
                    redirect(base_url(), $data);
                }
                
            } else {
            	if(form_error('email')!=''){
                    $this->message = form_error('email');
                } else if(form_error('password')!='') {
                    $this->message = form_error('email');
                } else if(form_error('usertype')!='') {
                    $this->message = form_error('usertype');
                } 
            	$this->app->message($this->message, 'error');
        		redirect(base_url());
            }
        }else{
        	$this->app->message('Invalid request.', 'error');
        	redirect(base_url());
        }
	}
	/*
    * logout
    *
    * User logout funtionality.
    *
    * @param  
    * @return bool
    */  
    public function logout() {
        $this->session->unset_userdata('user_data');
        session_destroy();
        redirect();
    }
    /*
    * forgotpassword
    *
    * Used for view user sign up page.
    *
    * @param 
    * @return
    */
    function forgotpassword(){        
        $data['meta_description']   = METADESCRIPTION;
        $data['page_title']         = SITE_TITLE;
        $data['page_name']          = "Forgot Password";
        $data['page_slug']		= $this->uri->segment(1);
        $this->load->view('admin/common/header.php',$data);
        $this->load->view('admin/forgetpassword', $data);
        $this->load->view('admin/common/footer.php',$data);
    }
    /*
    * forgotpassword_process
    *
    * User forgotpassword funtionality.
    *
    * @param  
    * @return
    */
    public function forgotpassword_process() {
        if ($this->input->server('REQUEST_METHOD') === "POST") {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            if ($this->form_validation->run() != FALSE) {
            	$postData = $this->input->post();
                $code = random_string('alnum', 10);
                $name = $this->auth_model->forgotpassword(array('email' => $postData['email']), array('code' => $code));
                if ($name) {
            		$message = $this->auth_model->forgot_pass_template();
                	$link = base_url('setpassword') . "/" . $code;
                	$patternFind1[0] 	= '/{NAME}/';
                    $patternFind1[1] 	= '/{LINK}/';
                    $patternFind1[2] 	= '/{SITETITLE}/';
                    $replaceFind1[0] 	= ucwords($name);
                    $replaceFind1[1] 	= $link;
                    $replaceFind1[2] 	= ucwords(SITE_TITLE);
                    $txtdesc_contact    = stripslashes($message);                        
                    $ebody_contact      = preg_replace($patternFind1, $replaceFind1, $txtdesc_contact);
                    $esubject_contact	= ucwords(SITE_TITLE)." : Please reset your password.";
                    $sendEmailStatus=$this->common->send_mail($ebody_contact,$esubject_contact,$postData['email'], $name, ADMINEMAIL, ucwords(SITE_TITLE));
                    if($sendEmailStatus){
                    	$this->app->message('Please check your email. Link has been sent on your email.', 'success');
                    	$this->session->set_flashdata("resendeamil",'resendeamil');
                    }else{
                    	$this->app->message('Oh snap! due to some error we can not send email.', 'error');
                    }
                } else {
                    $this->app->message('You are not authorized user.', 'error');
                }                   
            } else {
            	if(form_error('email')!=''){
                    $this->message = form_error('email');
                } 
            }              
        }else{
        	$this->app->message('Invalid request.', 'error');
        }
        redirect('forgot-password');
    }
    /*
    * setpassword
    *
    * Used for view user sign up page.
    *
    * @param 
    * @return
    */
    function setpassword(){
        $data['code'] = $this->uri->segment(2);
        $data['meta_description']   = METADESCRIPTION;
        $data['page_title']         = SITE_TITLE;
        $data['page_name']          = "Set Password";
        $data['page_name']          = "Change Password";
        $data['page_slug']			= $this->uri->segment(1);
        $this->load->view('admin/common/header.php',$data);       
        $this->load->view('admin/setpassword', $data);
        $this->load->view('admin/common/footer.php',$data);   
    }

    /*
    * setpassword_process
    *
    * User setpassword funtionality.
    *
    * @param  
    * @return bool
    */
    public function setpassword_process() {       
        $code = $this->uri->segment(2); 
        $userData = $this->common->_getRow('user',array('code' => $code));
        if ($userData) {
            if ($this->input->server('REQUEST_METHOD') === "POST") {
                $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
                if ($this->form_validation->run() != FALSE) {
                    $password = md5($this->input->post('password'));
                    $updateData = $this->common->update('user',array('userID' => $userData['userID']),array('code' => '', 'password' => $password));
                    if ($updateData) {
                        $this->app->message('Your password has been reset successfully.', 'success');
                    }
                }
            }
        } else {
            $this->app->message('Your reset password link has been expired.', 'error');
        }
        redirect(base_url());
    }
    
    public function load_dashboard(){
		if($this->session->userdata('userType')=='1'){
			redirect('admin/dashboard');
		}else{
			redirect('dashboard');
		}
    } 
}

?>