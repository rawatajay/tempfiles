<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Home
* 
* 
* @package    	CI
* @subpackage 	Job Hunter
* @category 	Jobseeker Controller
* @author 	  	TrivialWorks* 
*/
class Jobseeker extends CI_Controller{

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
		$this->load->library('Facebook');
		$this->load->library('smtp');
                $this->load->library('phpmailer');
		$this->load->model('app');
        $this->load->model('common','common'); 
		$this->load->model('frontend/user_model','user_model');	
	}

	/*
	* index
	*
	* Used for dispalying the jobseeker dashboard.
	*
	* @param 
	* @return
	*/
	function index(){				
        $data['pageCSS'] 			= array();
        $data['initJsFunc'] 		= array();
        $data['pageJS']				= array();
        $data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Jobseeker Dashboard";        
		
        $this->load->view('frontend/common/jobseekerheader.php',$data);
        $this->load->view('frontend/common/jobseekerTopheader');
        $this->load->view('frontend/jobseekerdahboard',$data);        
        $this->load->view('frontend/common/jobseekerfooter.php',$data);

	}	
	/*
	* signup
	*
	* User signup funtionality.
	*
	* @param 
	* @return
	*/
	public function signup() {              
        $data['login_url'] = $this->facebook->getLoginUrl(
                array(
                    'redirect_uri' => site_url('home/facebook?t=2&rd=signup'),
                    'scope' => array("email") 
                )
        );
        if ($this->input->server('REQUEST_METHOD') === "POST") {
            $postData = $this->input->post(); 
            //print_r( $postData);           
            $insert_data = array();            
            $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
            $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]');        
            $this->form_validation->set_rules('phone', 'Phone No.', 'trim|required|numeric|min_length[5]|max_length[15]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
            $this->form_validation->set_rules('password_again', 'Confirm Password', 'trim|required|matches[password]');   
            //$this->form_validation->set_message('is_unique', '%s already in use.');
            //var_dump($this->form_validation->run());die;
            if ($this->form_validation->run() != FALSE) {
                $insert_data['firstName'] = trim($postData['firstname']);
                $insert_data['lastName'] = trim($postData['lastname']);
                $insert_data['email'] = trim($postData['email']);
                $insert_data['phone'] = trim($postData['phone']);                
                $insert_data['userType'] = 3;
                $insert_data['facebookId'] = trim($postData['fid']);
                $insert_data['profilePic'] = trim($postData['fpic']);
                $insert_data['password'] = md5(trim($postData['password']));
                $insert_data['isActive'] = '0';
                $insert_data['createdOn'] = date("Y-m-d H:i:s");
                $insert_data['code'] = random_string('alnum', 10);
               	$insertId = $this->user_model->register($insert_data);
               
                if ($insertId) {                		
                   $name = $insert_data['firstName'].' '.$insert_data['lastName'];                   
                   $this->activationmail($insert_data['email'],$name,$insert_data['code']);
                   $this->app->message('You have been successfully registered. We sent a email activation  link to your email address. Please verify your account to active .', 'success');
                   redirect('signup');
                }
        	
            } else {
            	if(form_error('firstname')!=''){
                    $this->message = form_error('firstname');
                } else if(form_error('lastName')!='') {
                    $this->message = form_error('lastName');
                } else if(form_error('email')!='') {
                    $this->message = form_error('email');
                } else if(form_error('phone')!='') {
                    $this->message = form_error('phone');
                } else if(form_error('password')!='') {
                    $this->message = form_error('password');
                } else if(form_error('confirm_password')!=''){
                    $this->message = form_error('confirm_password');
                }   
                $this->app->message($this->message, 'error');                
                $data['firstname'] = trim($postData['firstname']);
                $data['last_name'] = trim($postData['lastname']);
                $data['email'] = trim($postData['email']);
                $data['phone'] = trim($postData['phone']);
                $data['facebookid'] = trim($postData['fid']);
                $data['profile_pic'] = trim($postData['fpic']);                
                $data['login_url'] = $this->facebook->getLoginUrl(
		            array(
		                'redirect_uri' => site_url('home/facebook?t=2&rd=signup'),
		                'scope' => array("email") /* permissions here */
		            )
		        );
		        $data['meta_description']	= SITE_TITLE;
		        $data['page_title'] 		= SITE_TITLE;
		        $data['page_name']			= "Sign Up";                
				//echo "<pre>";print_r($data);		
		        $this->load->view('frontend/common/header.php',$data);
		        $this->load->view('frontend/signup', $data);
		        $this->load->view('frontend/common/footer.php',$data);	
            }
        }       
        //redirect('signup');        
    }    
    /*
    * login
    *
    * User login funtionality.
    *
    * @param 
    * @return
    */
    public function login(){
    	if ($this->input->server('REQUEST_METHOD') === "POST") {
            $postData = $this->input->post();
            $insert_data = array();
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            
            if ($this->form_validation->run() != FALSE) {                


              	 $data['email'] = $postData['email'];
                 $data['password'] = md5($postData['password']);
           	    $dataArray = array('email' => $data['email'], 'password' => $data['password'],'userType' => '3');
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
                    $this->common->update('user',array("email" => $userData['email']) , array("lastloginTime" => date("Y-m-d H:i:s")));
                    redirect('myaccount');
                    
                } else {

                    $this->app->message('Email or Password is incorrect.', 'error');
                    redirect('signin', $data);
                }
                
            } else {

                $data['email'] = trim($postData['email']);
                $data['login_url'] = $this->facebook->getLoginUrl(
                        array(
                            'redirect_uri' => site_url('login/facebookt=1&rd=login'),
                            'scope' => array("email") /* permissions here */
                        )
                );
            }
        }
    }
    /*
    * activationmail
    *
    * User activation mail funtionality.
    *
    * @param  $email, $name , $code
    * @return
    */
    public function activationmail($email, $name, $code){

    	$message = '<table style=" background-color: #f6f6f6;width: 100%; margin: 0;padding: 0;font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;background: #fff;border: 1px solid #e9e9e9; border-radius: 3px;"> <tr><td style="display: block !important;max-width: 600px !important;margin: 0 auto !important;clear: both !important;" width="600"><div style="max-width: 600px;margin: 0 auto;display: block;padding: 20px;"><table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope itemtype="http://schema.org/ConfirmAction"><tr><td style="padding: 20px;background: #fff;border: 1px solid #e9e9e9;border-radius: 3px;"><meta itemprop="name" content="Confirm Email"/><table width="100%" cellpadding="0" cellspacing="0"><tr><td style= " font-family: \' Helvetica Neue \', \' Helvetica\', Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;"><h1>Job Hunter</h2></td></tr><tr><td style= " padding: 0 0 20px;font-family: \' Helvetica Neue \', \' Helvetica\', Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;"><p>Dear, {NAME}</p>Please activate your account address by clicking the link below.</td></tr><tr><td  style=" padding: 0 0 20px;"> <a href="{LINK}" style="  text-decoration: none;  color: #FFF;  background-color: #348eda;  border: solid #348eda;  border-width: 10px 20px;  line-height: 2;  font-weight: bold;  text-align: center;  cursor: pointer;  display: inline-block;  border-radius: 5px;  text-transform: capitalize;font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;"" itemprop="url">Confirm email address</a></td></tr><tr><td  style=" padding: 0 0 20px;">Thanks,<br/>{SITENAME} Team</td></tr></table></td></tr></table><div class="footer"><table width="100%"><tr></tr></table></div></div></td></tr></table>';

    	$link = base_url('activation') . "/" . $code;
    	$patternFind1[0] = '/{NAME}/';
        $patternFind1[1] = '/{LINK}/';
        $patternFind1[2] = '/{SITENAME}/';

        $replaceFind1[0] = ucwords($name);
        $replaceFind1[1] = $link;
        $replaceFind1[2] = SITE_TITLE;

        $txtdesc_contact = stripslashes($message);
        $contact_sub = stripslashes($subject);
        $contact_sub = preg_replace($patternFind1, $replaceFind1, $contact_sub);
        $ebody_contact = preg_replace($patternFind1, $replaceFind1, $txtdesc_contact);
		$this->phpmailer->IsSMTP();                                      // set mailer to use SMTP
		$this->phpmailer->Host 			= SMTPHOST;  // specify main and backup server
		$this->phpmailer->SMTPAuth 		= true;     // turn on SMTP authentication
		$this->phpmailer->SMTPSecure 	= "ssl";
		$this->phpmailer->Port 			= SMTPPORT;
		$this->phpmailer->Username 		= SMTPEMAIL;  // SMTP username
		$this->phpmailer->Password 		= SMTPPASS; // SMTP password
		$this->phpmailer->SMTPAuth 		= true;
		$this->phpmailer->From 			= ADMINEMAIL;
		$this->phpmailer->FromName 		= SITE_TITLE;
		$this->phpmailer->AddAddress($email, $name);
		               // name is optional
		$this->phpmailer->AddReplyTo(ADMINEMAIL, SITE_TITLE);

	  
		$this->phpmailer->IsHTML(true);                                  // set email format to HTML

		$this->phpmailer->Subject = "Job Hunter : Activate your account.";
		$this->phpmailer->Body    = $ebody_contact;
		

		if(!$this->phpmailer->Send())
		{
		   echo "Message could not be sent. <p>";
		   echo "Mailer Error: " . $this->phpmailer->ErrorInfo;
		   exit;
		}		
    }
    /*
    * checkactivation
    *
    * User check activation mail funtionality.
    *
    * @param  $email, $name , $code
    * @return
    */
    public function checkactivation() {
        $code = $this->uri->segment(2);        
        $dataArray = array('code' => $code);
        $data = $this->user_model->getuserDetail($dataArray);
        print_r($data);
        if ($data) {
            $this->app->message('Your account has been activated successfully. Please login with your email and password.', 'success');
            redirect('signin');
        } else {

            $this->app->message('Link has been expired. Contact to the administrator for futhur query.', 'error');
            redirect('signin');
        }

        //redirect('login');
    }
    /*
    * forgotpassword
    *
    * User forgotpassword funtionality.
    *
    * @param  
    * @return
    */
    public function forgotpassword() {
        if ($this->input->server('REQUEST_METHOD') === "POST") {
            $postData = $this->input->post();
            $insert_data = array();
            $data['email'] = $postData['email'];
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            if ($this->form_validation->run() != FALSE) {
                $data['email'] = $postData['email'];
                $this->form_validation->set_rules('verify', 'Verify', 'trim|callback_verifyUserEmail');                
                if ($this->form_validation->run() != false) {
                    $code = random_string('alnum', 10);
                    $update = $this->user_model->updateUserDetail(array('email' => $postData['email']), array('code' => $code));
                    if ($update) {

                        $message = '<table style=" background-color: #f6f6f6;width: 100%; margin: 0;padding: 0;font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;background: #fff;border: 1px solid #e9e9e9; border-radius: 3px;"> <tr><td style="display: block !important;max-width: 600px !important;margin: 0 auto !important;clear: both !important;" width="600"><div style="max-width: 600px;margin: 0 auto;display: block;padding: 20px;"><table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope itemtype="http://schema.org/ConfirmAction"><tr><td style="padding: 20px;background: #fff;border: 1px solid #e9e9e9;border-radius: 3px;"><meta itemprop="name" content="Confirm Email"/><table width="100%" cellpadding="0" cellspacing="0"><tr><td style= " font-family: \' Helvetica Neue \', \' Helvetica\', Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;"><h1>Job Hunter</h2></td></tr><tr><td style= " padding: 0 0 20px;font-family: \' Helvetica Neue \', \' Helvetica\', Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">We heard that you lost your  password. Sorry about that!.<br>But don’t worry! You can use the following link within the next day to reset your password:</td></tr><tr><td  style=" padding: 0 0 20px;"> <a href="{LINK}" style="  text-decoration: none;  color: #FFF;  background-color: #348eda;  border: solid #348eda;  border-width: 10px 20px;  line-height: 2;  font-weight: bold;  text-align: center;  cursor: pointer;  display: inline-block;  border-radius: 5px;  text-transform: capitalize;font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;"" itemprop="url">Confirm email address</a></td></tr><tr><td  style=" padding: 0 0 20px;">Thanks,<br/>{SITETITLE} Team</td></tr></table></td></tr></table><div class="footer"><table width="100%"><tr></tr></table></div></div></td></tr></table>';

                        $link = base_url('setpassword') . "/" . $code;
                        $patternFind1[0] = '/{NAME}/';
                        $patternFind1[1] = '/{LINK}/';
                        $patternFind1[2] = '/{SITETITLE}/';

                        $replaceFind1[0] = ucwords($postData['name']);
                        $replaceFind1[1] = $link;
                        $replaceFind1[2] = SITE_TITLE;

                        $txtdesc_contact    = stripslashes($message);                        
                        $contact_sub        = preg_replace($patternFind1, $replaceFind1, $contact_sub);
                        $ebody_contact      = preg_replace($patternFind1, $replaceFind1, $txtdesc_contact);
                        $this->phpmailer->IsSMTP();                                      // set mailer to use SMTP
                        $this->phpmailer->Host          = SMTPHOST;  // specify main and backup server
                        $this->phpmailer->SMTPAuth      = true;     // turn on SMTP authentication
                        $this->phpmailer->SMTPSecure    = "ssl";
                        $this->phpmailer->Port          = SMTPPORT;
                        $this->phpmailer->Username      = SMTPEMAIL;  // SMTP username
                        $this->phpmailer->Password      = SMTPPASS; // SMTP password
                        $this->phpmailer->SMTPAuth      = true;
                        $this->phpmailer->From          = ADMINEMAIL;
                        $this->phpmailer->FromName      = SITE_TITLE;
                        $this->phpmailer->AddAddress($postData['email'], $name);
                                       // name is optional
                        $this->phpmailer->AddReplyTo(ADMINEMAIL, SITE_TITLE);

                      
                        $this->phpmailer->IsHTML(true);                                  // set email format to HTML

                        $this->phpmailer->Subject = "Job Hunter : Please reset your password.";
                        $this->phpmailer->Body    = $ebody_contact;
                        

                        if(!$this->phpmailer->Send())
                        {
                           echo "Message could not be sent. <p>";
                           echo "Mailer Error: " . $this->phpmailer->ErrorInfo;
                           exit;
                        }
                        
                        $this->app->message('Please check your email. Link has been sent on your email.', 'success');
                    } else {
                        $this->app->message('You are not authorized user.', 'error');
                    }                   
                    redirect('forgot-password');
                }               
                redirect('forgot-password');
            }
        }
    }
    /*
    * setpassword
    *
    * User setpassword funtionality.
    *
    * @param  
    * @return bool
    */
    public function setpassword() {       
        
        $code = $this->uri->segment(3);
        $userData = $this->user_model->getuserDetailBYCode(array('code' => $code));
        if ($userData) {
            if ($this->input->server('REQUEST_METHOD') === "POST") {
                $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
                $this->form_validation->set_rules('password_again', 'Confirm Password', 'trim|required|matches[password]');
                if ($this->form_validation->run() != FALSE) {
                    $password = md5($this->input->post('password'));

                    $updateData = $this->user_model->setPassword(array('userID' => $userData['userID']), $password);
                    if ($updateData) {
                        $this->app->message('Your password has been reset successfully.', 'success');
                        redirect('signin');
                    }
                }
            }
        } else {
            $this->app->message('Your link has been expired.', 'error');
            redirect('signin');
        }
        redirect('setpassword');
    }
    /*
    * verifyUserEmail
    *
    * User verifyUserEmail funtionality.
    *
    * @param  
    * @return bool
    */
    public function verifyUserEmail() {
        $email = trim($this->input->post('email'));        
        $userData = $this->user_model->getuserBYEmail($email);  
       
        if ($userData && $userData['isActive'] == '1') {
            return true;
        } elseif ($userData && $userData['isActive'] == '0') {
            $this->app->message('Your account has not been activated. Please activate your account first.', 'warning');
            return false;
        }else {           
            $this->app->message('Your email does not matched with our records.', 'warning');
            return false;
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
    * myaccount
    *
    * view User myaccount .
    *
    * @param  
    * @return bool
    */ 
    public function myaccount(){
        if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='3')) {
            $data['meta_description']    = METADESCRIPTION;
            $data['page_title']          = SITE_TITLE;
            $data['page_name']           = "myaccount";
            $limit = 5;
            $data['profiledownload']         = $this->common->_getCount('useremaildownload',array('jobseekerID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
            $data['datasetlist'] 	 = $this->common->_getdatasetList($limit);
            $data['sendgrid']           = $this->common->getsendgridDetails();
            $data['profiledetails']     = $this->common->getprofileDetails();
            $this->load->view('frontend/common/header.php',$data);
            $this->load->view('frontend/common/jobseekerTopheader.php',$data);
            $this->load->view('frontend/myaccount', $data);
            $this->load->view('frontend/common/footer.php',$data);
        }else{         
            $this->app->message('Invalid user access.', 'error');
            redirect('signin');
        }
    }
    /*
    * editprofile
    *
    * view profile
    *
    * @param  
    * @return bool
    */ 
    public function editprofile(){
        if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='3')) {
            $data['meta_description']    = METADESCRIPTION;
            $data['page_title']          = SITE_TITLE;
            $data['page_name']           = "myaccount";
            $data['profiledetails']     = $this->common->getprofileDetails();
            $this->load->view('frontend/common/header.php',$data);
            $this->load->view('frontend/common/jobseekerTopheader.php',$data);
            $this->load->view('frontend/editprofile', $data);
            $this->load->view('frontend/common/footer.php',$data);
        }else{         
            $this->app->message('Invalid user access.', 'error');
            redirect('signin');
        }
    }

    public function updateProfile() {
        if ($this->input->server('REQUEST_METHOD') === "POST") {
            $postData = $this->input->post();
            print_r($postData);
            $insert_data = array();
            $this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
            $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
                
            if(!empty($_FILES['profilepic']) && $_FILES['profilepic']['size'] > 0){
                
               $config['upload_path'] = FCPATH.'uploads/userProfilePic/';
             
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = 800;
                $new_name = md5(strtotime(date('Y-m-d H:i:s')));
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);            
                if($this->upload->do_upload('profilepic')){
                    $image1 =$this->upload->data()['file_name'] ;
                    $image = base_url().'uploads/userProfilePic/'. $image1; 
                    chmod($this->upload->data()['full_path'],0777);
                }else   {
                    $error = array('error' => $this->upload->display_errors());
                    $this->app->message( $error['error'] , 'error');
                    redirect('user/profile');
               }
            }

            if ($this->form_validation->run() != FALSE) { 
                $data['email'] = $postData['email'];
                $data['password'] = md5($postData['password']);
                $dataArray = array('userID !=' => $this->session->all_userdata()['userId'], 'email =' => $postData['email']);
                $_isEmailExist = $this->common->_getById("user",$dataArray);
                
                if (empty($_isEmailExist)) {
                    $updateDataArr['firstName'] = $postData['firstname'];
                    $updateDataArr['lastName'] = $postData['lastname'];
                    $updateDataArr['email'] = $postData['email'];
                    if($image){
                        $updateDataArr['profilePic'] = $image;
                    }

                    $updateStatus=$this->common->update('user',array("userID" => $this->session->all_userdata()['userId']), $updateDataArr);
                   
                    if($updateStatus > 0){
                        $Sessiondata = array(
                       'loggedin' => true,
                        'fname' => $postData['firstname'],
                        'lname' => $postData['lastname'],
                        'email' => $postData['email'],                       
                        'profilePic' => $image ? $image : $this->session->all_userdata()['profilePic']
                        );
                        $this->session->set_userdata($Sessiondata);                  
                    }
                    $this->app->message('User profile updated.', 'success');
                    redirect('user/profile_view');
                    
                } else {

                    $this->app->message('Email already exist.', 'error');
                    redirect('user/editprofile', $data);
                }
                
            } else {

               
            }
        }
    }
   
    /*
    * profile
    *
    * view profile
    *
    * @param  
    * @return bool
    */ 
    public function profileDetail(){
        
        
        
        if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='3')) {
            $data['academicDetail'] = $this->common->_getById("jobseeker",array('userID ' => $this->session->all_userdata()['userId']));
            $data['settingProfile'] = $this->common->_getById("jobseeker",array('userID ' => $this->session->all_userdata()['userId']));
            
            $data['meta_description']    = METADESCRIPTION;
            $data['page_title']          = SITE_TITLE;
            $data['page_name']           = "profile";
                $data['profiledetails']     = $this->common->getprofileDetails();
            $this->load->view('frontend/common/header.php',$data);
            $this->load->view('frontend/common/jobseekerTopheader.php',$data);
            $this->load->view('frontend/profile', $data);
            $this->load->view('frontend/common/footer.php',$data);
        }else{         
            $this->app->message('Invalid user access.', 'error');
            redirect('signin');
        }
    }
    
  public function   profileviewdata(){
      
    if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='3')) {
            $data['academicDetail'] = $this->common->_getById("jobseeker",array('userID ' => $this->session->all_userdata()['userId']));
            $data['settingProfile'] = $this->common->_getById("jobseeker",array('userID ' => $this->session->all_userdata()['userId']));
                $data['profiledetails']     = $this->common->getprofileDetails();
            $data['meta_description']    = METADESCRIPTION;
            $data['page_title']          = SITE_TITLE;
            $data['page_name']           = "profile";
            $this->load->view('frontend/common/header.php',$data);
            $this->load->view('frontend/common/jobseekerTopheader.php',$data);
            $this->load->view('frontend/profile_view', $data);
            $this->load->view('frontend/common/footer.php',$data);
        }else{         
            $this->app->message('Invalid user access.', 'error');
            redirect('signin');
        }   
      
      
      
  }
    
    

        /*
    * academicDetail
    *
    * view profile
    *
    * @param  
    * @return bool
    */ 
    public function academicDetail(){
        if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='3')) {
            $data['academicDetail'] = $this->common->_getById("jobseeker",array('userID ' => $this->session->all_userdata()['userId']));
             $data['profiledetails']     = $this->common->getprofileDetails();
            $data['meta_description']    = METADESCRIPTION;
            $data['page_title']          = SITE_TITLE;
            $data['page_name']           = "academicDetail";
            $this->load->view('frontend/common/header.php',$data);
            $this->load->view('frontend/common/jobseekerTopheader.php',$data);
            $this->load->view('frontend/academicDetail', $data);
            $this->load->view('frontend/common/footer.php',$data);
        }else{         
            $this->app->message('Invalid user access.', 'error');
            redirect('signin');
        }
    }
    
    
   /*
    * academicDetail
    *
    * view academicDetail
    *
    * @param  
    * @return bool
    */ 
    public function editAcademicDetail(){
         if ($this->input->server('REQUEST_METHOD') === "POST") {
            $postData = $this->input->post();
          //  print_r($postData);  
            $insert_data = array();
            $this->form_validation->set_rules('highSchoolPercentage', 'HighSchool Percentage', 'trim|required');
            $this->form_validation->set_rules('highSchoolcollege_univ', 'HighSchool Board', 'trim|required');
            $this->form_validation->set_rules('interPercentage', 'Inter Percentage', 'trim|required');
            $this->form_validation->set_rules('intercollege_univ', 'Intermediate Board/College  ', 'trim|required');
          
          
            if ($this->form_validation->run() != FALSE) { 
                $data['highSchoolPercentage']     = $postData['highSchoolPercentage'];
                $data['highSchoolBoardCollege']   = $postData['highSchoolcollege_univ'];
                $data['intermediatePercentage']    = $postData['interPercentage'];
                $data['interBoardCollege']          = $postData['intercollege_univ'];
                $data['graduationPercentage']       = $postData['graduactionPercentage'];
                $data['	graduateUniversityCollege'] = $postData['graduactioncollege_univ'];
                $data['postGraduationPercentage']   = $postData['postgraduactionPercentage'];
                $data['pgUniversityCollege']        = $postData['postgraduactioncollege_univ'];
                 $data['otherCertification']        = $postData['otherCertification'];
                $data['userID']                     = $this->session->all_userdata()['userId'];
                                
               $condition = array('userID' => $data['userID'] );
               $jobseker_data = $this->common->_getByIdrowdata('jobseeker',$condition);
                 
              if(empty($jobseker_data)){
               
           
               

                   
                   $id = $this->common->insert('jobseeker',$data);
                      $this->app->message('Academic info created.', 'success');
                      redirect('user/profile_view');   
                //    $this->load->view('user/academicDetail');
                    
               }else{
                    foreach($jobseker_data as $job_data)

                   $id = $this->common->update('jobseeker',array('jobSeekerID'=>$job_data['jobSeekerID']),$data);
                   
                    $this->app->message('Academic info updated.', 'success');
                   redirect('user/profile_view');
                  
               } 
               
            } else {

               if(form_error('highSchoolPercentage')!='')
               {
                    $this->message = form_error('highSchoolPercentage');
               }else if(form_error('highSchoolcollege_univ')!=''){
                     $this->message = form_error('highSchoolcollege_univ');
               }
                if(form_error('interPercentage')!='')
               {
                    $this->message = form_error('interPercentage');
               }else if(form_error('intercollege_univ')!=''){
                     $this->message = form_error('intercollege_univ');
               }
            }
        }
    }  

       /*
    * setting Profile
    *
    * view profile
    *
    * @param  
    * @return bool
    */ 
    public function settingProfile(){
        if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='3')) {
            $data['settingProfile'] = $this->common->_getById("jobseeker",array('userID ' => $this->session->all_userdata()['userId']));
             $data['profiledetails']     = $this->common->getprofileDetails();
            $data['meta_description']    = METADESCRIPTION;
            $data['page_title']          = SITE_TITLE;
            $data['page_name']           = "academicDetail";
            $this->load->view('frontend/common/header.php',$data);
            $this->load->view('frontend/common/jobseekerTopheader.php',$data);
            $this->load->view('frontend/settingProfile', $data);
            $this->load->view('frontend/common/footer.php',$data);
        }else{         
            $this->app->message('Invalid user access.', 'error');
            redirect('signin');
        }
    }
    
    
    
       /*
    * Update Setting Profile
    *
    * view profile
    *
    * @param  
    * @return bool
    */ 
    public function editSettingProfile(){
        
          if ($this->input->server('REQUEST_METHOD') === "POST") {
              
              
              
            $postData = $this->input->post();
       
           $hsmarksheet = $intermarksheet=$otherCertificate=$resume='';
           
           
                  if (!empty($_FILES['resume']) && $_FILES['resume']['size'] > 0) {

                $config['upload_path'] = FCPATH . 'uploads/docs/';
                $config['allowed_types'] = 'pdf|doc';
                //  $config['max_size'] = 100;
                $new_name = strtotime(date('Y-m-d H:i:s'));
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('resume')) {
                    $resume = base_url() . 'uploads/docs/' . $this->upload->data()['file_name'];
                    $insert_data['resumeURL'] = $resume;
                    chmod($this->upload->data()['full_path'], 0777);
                } else {
                    $error = array('error' => $this->upload->display_errors());

                    $this->app->message($error['error'], 'error');
                    redirect('user/profile');
                }
            }

           
            if(!empty($_FILES['hsmarksheet']) && $_FILES['hsmarksheet']['size'] > 0){
                
                $config['upload_path'] = FCPATH.'uploads/docs/';
           //     $config['allowed_types'] = 'pdf|doc';
                $config['max_size'] = 100;
                $new_name = strtotime(date('Y-m-d H:i:s'));
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);            
                if($this->upload->do_upload('hsmarksheet')){
                  $hsmarksheet =base_url().'uploads/docs/'.$this->upload->data()['file_name'] ;
                    $insert_data['highSchoolMarksheet']      =  $hsmarksheet;
                    chmod($this->upload->data()['full_path'],0777);
                }else   {
                   $error = array('error' => $this->upload->display_errors());
                   
                    $this->app->message($error['error'], 'error');
                      redirect('user/profile');
                
               }
            }  
               if(!empty($_FILES['intmarksheet']) && $_FILES['intmarksheet']['size'] > 0){
                
                $config['upload_path'] = FCPATH.'uploads/docs/';
                $config['allowed_types'] = 'pdf|doc';
            //    $config['max_size'] = 100;
                $new_name = strtotime(date('Y-m-d H:i:s'));
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);            
                if($this->upload->do_upload('intmarksheet')){
                  $intermarksheet =base_url().'uploads/docs/'.$this->upload->data()['file_name'] ;
                   $insert_data['intermediateMarksheet']    =  $intermarksheet;
                  
                    chmod($this->upload->data()['full_path'],0777);
                }else   {
                    
                    
                   $error = array('error' => $this->upload->display_errors());
                   $this->app->message($error['error'], 'error');
                      redirect('user/profile');
                   
               }
            }  
            
             if(!empty($_FILES['otherCertificate']) && $_FILES['otherCertificate']['size'] > 0){
                
                $config['upload_path'] = FCPATH.'uploads/docs/';
                $config['allowed_types'] = 'pdf|doc';
          //      $config['max_size'] = 100;
                $new_name = strtotime(date('Y-m-d H:i:s'));
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);            
                if($this->upload->do_upload('otherCertificate')){
                  $otherCertificate =base_url().'uploads/docs/'.$this->upload->data()['file_name'] ;
                  $insert_data['certification']       = $otherCertificate;
                    chmod($this->upload->data()['full_path'],0777);
                }else   {
                  $error = array('error' => $this->upload->display_errors());
                   $this->app->message($error['error'], 'error');
                      redirect('user/profile');
               }
            }  
           
                  $insert_data['notifyByEmail']  = ($postData['notifyByEmail'])?'1':'0';   
                  $insert_data['notifyBySMS']    = ($postData['notifyBySMS'])?'1':'0';   
                  $insert_data['notifyByPhone']  = ($postData['notifyByCall'])?'1':'0';   
                 
                  $isoption                      =    $postData['optionsRadios'];   
              
                  if($isoption==1){
                       $insert_data['isAvailableF2F'] = TRUE;
                  }else{
                       $insert_data['isAvailableF2F'] = FALSE;
                      
                  }
                  
                
                 
        
                  $insert_data['userID']                   = $this->session->all_userdata()['userId'];
            
               $condition = array('userID' =>$insert_data['userID']);
               $jobseker_data = $this->common->_getByIdrowdata('jobseeker',$condition);
               
              
              
               if(empty($jobseker_data)){
                   
                   $id = $this->common->insert('jobseeker',$insert_data);
                      $this->app->message('Profile info created.', 'success');
                       redirect('user/profile_view');
                    
               }else{
                    foreach($jobseker_data as $job_data)
              
                    
                   $id = $this->common->update('jobseeker',array('jobSeekerID'=>$job_data['jobSeekerID']),$insert_data);
                   
                    $this->app->message('Profile info updated.', 'success');
                   redirect('user/profile_view');
                  
               } 
                    

            }

         } 

           
  /*
   * Show Dataset List for jobseeker
   * view dataset
   */
   public function datasetList(){
        if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='3')) {
	    $data['meta_description']    = METADESCRIPTION;
            $data['page_title']          = SITE_TITLE;
            $data['page_name']           = "Datasetlist";
            $data['profiledetails']     = $this->common->getprofileDetails();
            $data['datasetlist']	 = $this->common->_getdatasetList();
            $data['funtionalArealist']	 = $this->common->_getList('functionalarea',array('status' => '1')," functionalID DESC ");
            $this->load->view('frontend/common/header.php',$data);
            $this->load->view('frontend/common/jobseekerTopheader.php',$data);
            $this->load->view('frontend/datasetlist', $data);
            $this->load->view('frontend/common/footer.php',$data);	
        }else{        	
        	$this->app->message('Invalid user access.', 'error');
            redirect('signin');
        }	
       
   }
   
   

           
  /*
   * Show Company List for jobseeker
   * view Company
   */
   public function companylist(){
       
        if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='3')) {
	    $data['meta_description']    = METADESCRIPTION;
            $data['page_title']          = SITE_TITLE;
            $data['page_name']           = "Company List";
            $data['profiledetails']     = $this->common->getprofileDetails();
            $data['companylist']	 = $this->common->_getcompanyList();
            $data['funtionalArealist']	 = $this->common->_getList('functionalarea',array('status' => '1')," functionalID DESC ");
            $this->load->view('frontend/common/header.php',$data);
            $this->load->view('frontend/common/jobseekerTopheader.php',$data);
            $this->load->view('frontend/companylist', $data);
            $this->load->view('frontend/common/footer.php',$data);	
        }else{        	
        	$this->app->message('Invalid user access.', 'error');
            redirect('signin');
        }	
       
   }


 public function datasetview(){
  
      $id = $this->uri->segment(4);  
      $userID                      =   $this->session->all_userdata()['userId']; 
      $data['meta_description']          = METADESCRIPTION;
            $data['page_title']          = SITE_TITLE;
            $data['page_name']           = "Dataset View";
            $data_set                    = $this->common->_getById('dataset',array('datasetId'=>$id));
            $data['dataset_data']        = $data_set; 
            $data_jobseeker              =  $this->common->_getById('jobseeker',array('userID'=>$userID));
            $data['profiledetails']     = $this->common->getprofileDetails();
            
            if(empty($data_jobseeker->resumeURL)){$this->app->message('Please upload you resume.', 'error');}
                $data['dataset_city']        = $this->common->_getCityName($data_set->city);
            
            $data['dataset_emprange']        = $this->common->_getempRange($data_set->empRange);
           
            	$emprangeQuery = $industry = $cities ='';
                
                $emprangeQuery = $data_set->empRange;
                $cities        = $data_set->city;
                $industry      = $data_set->functionalID;
                
              
                 if($emprangeQuery!=""){
                    
                     
                    $emprangeQuery = " AND emprangeID in ('$emprangeQuery')";
               }
                if(!empty($cities)){
                    $cities = " AND city in ('$cities')";
                }
                if(!empty($industry)){
                    $industry = " AND companyFunctionalId = $industry ";
                }
                  
            $data['company_data'] = $this->common->_getdatatsetCompany('company'," status = 1  ".$cities." ".$emprangeQuery." ".$industry."  "," companyID ASC ");
            
           
            $this->load->view('frontend/common/header.php',$data);
            $this->load->view('frontend/common/jobseekerTopheader.php',$data);
            $this->load->view('frontend/dataset_view', $data);
            $this->load->view('frontend/common/footer.php',$data);	
    
          
   }   


            public function datasetmail(){

                 $id = $this->uri->segment(4); 
                      

                         $data['rowID']             = $id;
                  $data['meta_description']          = METADESCRIPTION;
                        $data['page_title']          = SITE_TITLE;
                        $data['page_name']           = "Dataset View";
                        $data['profiledetails']     = $this->common->getprofileDetails();
                        $data_set                    = $this->common->_getById('dataset',array('datasetId'=>$id));
                        $data['dataset_data']        = $data_set; 
                        $userID                      =   $this->session->all_userdata()['userId']; 
                        $data['jobseeker']           =  $this->common->_getById('jobseeker',array('userID'=>$userID));
                            
                        $data['dataset_city']        = $this->common->_getCityName($data_set->city);
                                   
                        $data['dataset_emprange']        = $this->common->_getempRange($data_set->empRange);
                        $data['mail_templates'] = $this->common->_getallTemplateData(); 
                                      
                            $emprangeQuery = $industry = $cities ='';

                            $emprangeQuery = $data_set->empRange;
                            $cities        = $data_set->city;
                            $industry      = $data_set->functionalID;
                             if($emprangeQuery!=""){
                                $emprangeQuery = " AND emprangeID in ('$emprangeQuery')";
                             }
                            if(!empty($cities)){
                                $cities = " AND city in ('$cities')";
                            }
                            if(!empty($industry)){
                                $industry = " AND companyFunctionalId = $industry ";
                            }

                        $data['company_data'] = $this->common->_getdatatsetCompany('company'," status = 1  ".$cities." ".$emprangeQuery." ".$industry."  "," companyID ASC ");
                         
                        $this->load->view('frontend/common/header.php',$data);
                        $this->load->view('frontend/common/jobseekerTopheader.php',$data);
                        $this->load->view('frontend/datasetmail', $data);
                        $this->load->view('frontend/common/footer.php',$data);	


            }   
            
        
             public function test_send_mail() {
           

                print_r($_REQUEST); 
           
       }   



          public function test_send_mail_function() {
           

                 
            
         $tovalue ="ajay.trivialworks@gmail.com";
         $subject = "test";
         $msgdata ="Hello Dear";
         $this->load->library('email');
         $this->email->clear(TRUE);
         $this->email->from('ADMINEMAIL', SITE_TITLE);
         $this->email->to($to);
         $this->email->subject($subject);
         $this->email->message($msgdata);
     //   $this->email->attach($attach_data);
         $this->email->send(false);
       
       $ddddd=  $this->email->print_debugger(array('header'));
       echo'<pre>';      
       print_r($ddddd);
       die;
           
           
       }   




         public function send_mail() {


        if ($this->input->server('REQUEST_METHOD') === "POST") {

            $postdata = $this->input->post();
         


            $link = base_url();
            $insert_data = array();
            
            $this->form_validation->set_rules('mail_subject', ' Email subject ', 'trim|required');
            $this->form_validation->set_rules('mailID', 'Mail Template', 'trim|required');
            $this->form_validation->set_rules('messageData', ' Email message ', 'trim|required');
            $this->form_validation->set_rules('attach_data', ' Resume  ', 'trim|required');
            if ($this->form_validation->run() != FALSE) {
                
                  $tmpID      = $postdata['mailID'];
                 $id          = $postdata['rowID'];
                 $subject     = $postdata['mail_subject'];
                 $msg         = $postdata['messageData'];
                 $attach_data = $postdata['attach_data'];
                $userID        =   $this->session->all_userdata()['userId']; 
                
                $data_set     = $this->common->_getById('dataset',array('datasetId'=>$id));
           
                  $emprangeQuery = $industry = $cities ='';

                            $emprangeQuery = $data_set->empRange;
                            $cities        = $data_set->city;
                            $industry      = $data_set->functionalID;
                             if($emprangeQuery!=""){
                                $emprangeQuery = " AND emprangeID in ('$emprangeQuery')";
                             }
                            if(!empty($cities)){
                                $cities = " AND city in ('$cities')";
                            }
                            if(!empty($industry)){
                                $industry = " AND companyFunctionalId = $industry ";
                            }

                 $company_data = $this->common->_getdatatsetCompany('company'," status = 1  ".$cities." ".$emprangeQuery." ".$industry."  "," companyID ASC ");
                         
               
              

                $message = $this->common->_getTemplateData($tmpID); 
                 $data_set                    = $this->common->_getById('dataset',array('datasetId'=>$id));

                $MSG = '/{MESSAGE}/';

                $LINK = '/{LINK}/';
                $SITE = '/{NAME}/';
                $PRO  = '/{PROFILEDETAILS}/';
                $SITE_title = SITE_TITLE;
                $job        = $data_set->title;
                
             
                $msgdata = preg_replace($MSG, $msg, $message);
                $msgdata = preg_replace($SITE, $SITE_title, $msgdata);
                $msgdata = preg_replace($PRO, $job, $msgdata);
                
                foreach ($company_data  as $cval) {
                    
                    $tovalue = $cval['primaryEmail'];
                     $insert_data['datasetID']           = $id;
                      $insert_data['jobseekerID']       = $userID;
                      $insert_data['downloadedURL']     = $attach_data;
                       $insert_data['companyID']         = $cval['companyID'];
                      $insert_data['templateID']        = $tmpID;
                       $insert_data['isdownLoaded']      = 0;
                      $insert_data['createdAt']          = date('Y-m-d H:i:s');
                      $rowid = $this->common->insert('useremaildownload',$insert_data);
                       $link = base_url().'user/profiledownLoad/'.$rowid;                   
                      $msgdata = preg_replace($LINK, $link, $msgdata);    
                     
                    $this->common->send_mail($tovalue, $subject, $msgdata, $attach_data);
                }

                $this->app->message('Message has been sent.', 'success');
                redirect('user/profile_view');
            } else {

                if (form_error('mail_subject') != '') {
                    $this->app->message(form_error('mail_subject'), 'error');
                } else if (form_error('mailID') != '') {
                    $this->app->message(form_error('mailID'), 'error');
                  
                } else if (form_error('messageData') != '') {
                    $this->app->message(form_error('messageData'), 'error');
                    //  $this->app->message = form_error('messageData');
                } else if (form_error('attach_data') != '') {
                    $this->app->message(form_error('attach_data'), 'error');
                    //  $this->app->message = form_error('messageData');
                }


                //    echo json_encode(array("status" => FALSE, "message" => $this->message )); 
                redirect('user/dataset/mail/' . $id);
            }
        } else {
            $this->app->message('Invalid methods access.', 'error');
            redirect('datasetmail');
        }
    }
    
    
         public function getpreviewmail(){
             
                 $postdata = $this->input->post();
                 $from = $this->session->all_userdata()['firstName'];
                 $tmpID = $postdata['mailID'];
                 $id    = $postdata['rowID'];
                 $subject = $postdata['mail_subject'];
                 $msg = $postdata['messageData'];
                 $attach_data = $postdata['attach_data'];
                      
                 $message = $this->common->_getTemplateData($tmpID); 
                 $data_set                    = $this->common->_getById('dataset',array('datasetId'=>$id));

                $MSG = '/{MESSAGE}/';

                $LINK = '/{LINK}/';
                $SITE = '/{NAME}/';
                $PRO  = '/{PROFILEDETAILS}/';
                $SITE_title = SITE_TITLE;
                $job        = $data_set->title;
                
                $msgdata = preg_replace($LINK, $attach_data, $message);
                $msgdata = preg_replace($MSG, $msg, $msgdata);
                $msgdata = preg_replace($SITE, $SITE_title, $msgdata);
                $msgdata = preg_replace($PRO, $job, $msgdata);
                
                echo $msgdata;
               

               
         }
         
         
      public function getcityDatafilter(){       
         if(!empty($_POST["keyword"])) {
          $keyword = $_POST["keyword"];
             $result = $this->common->getCityDatabyname($keyword);
         if(!empty($result)) {
         ?>
         <ul id="country-list">
         <?php
         foreach($result as $country) {
         ?>
         <li onClick="selectCountry('<?php echo $country["name"]; ?>','<?php echo $country["id"]; ?>' );"><?php echo $country["name"]; ?></li>
         <?php } ?>
         </ul>
         <?php } } 
}



        public function getdatasetdata(){
            
            
            $postdata = $this->input->post();
            $cityID   = $postdata['cityID'];
            $funID    = $postdata['funID']  ;
            
            $datasetlist   =  $this->common->getDatasetdata($cityID,$funID);
          
                   
                        if (!empty($datasetlist)) {
                            foreach ($datasetlist as $data){
             ?>  
                                <div class="col-sm-6 col-md-4 col-xl-3">
                                    
                                  
                                    <article class="card-user box-typical  " style="height: 214px;">


                                        <div class="card-user-photo">
                                            <a href="<?php echo base_url()  ?>user/dataset/detail/<?php echo $data['datasetId']; ?>">  
                                                <img src="<?php echo base_url() ?>assets/admin/img/townhouse.jpg" alt=""> </a>
                                        </div>
                                        <div class="card-user-name"><?php echo $data['title']; ?></div>
                                        <div class="card-user-status">
                                            <?php
                                            echo $data['stateName'];
                                            echo '<br/>';
                                            $cities = $this->common->_getCityName($data['city']);
                                            echo rtrim($cities, ', ');
                                            ?>
                                        </div>
                                        <div class="card-user-name"><?php echo ($data['price'])?'$ '.$data['price']:'$ 0 ' ; ?></div>
<!--                                        <a href="#" class="btn btn-rounded">Company <?php // echo $data['datasetCount']; ?></a>-->
                                         
                                    </article><!--.card-user--> 
                                </div>   
                           <?php }
                            } else {
                                ?> 

                              <section class="box-typical">
                                <div class="add-customers-screen tbl" style="height: 240px;">
                                    <div class="add-customers-screen-in">
                                        <div class="add-customers-screen-user">
                                            <i class="font-icon font-icon-user"></i>
                                        </div>
                                        <h2>Your <?php echo $page_name; ?> list is empty</h2>						
                                    </div>
                                </div>
                             </section>
                        <?php } 
        }     
        
        
        public function profiledownLoad(){
            
             $id = $this->uri->segment(3);
             
               $condition   = array('downloadID'=>$id);
               $insert_data =array('isdownLoaded'=>'1');
               $this->common->update('useremaildownload',$condition, $insert_data);
               $download     = $this->common->_getById('useremaildownload',array('downloadID'=>$id));
               $this->load->helper('download');
               if(!empty($download->downloadedURL)){
                   
                $url  =  $download->downloadedURL;
                $type = explode('.', $url);
               }
               $data = file_get_contents($url); // Read the file's contents
               $name = 'resume.'.$type[1];

               force_download($name, $data);
            
            
            
        }
            
            
         
}


?>