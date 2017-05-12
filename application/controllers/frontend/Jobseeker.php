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
                $this->load->library('googleplus');
		$this->load->library('smtp');
                $this->load->library('phpmailer');
		$this->load->model('app');
        $this->load->model('common','common'); 
		$this->load->model('frontend/user_model','user_model');	
                      $this->load->library('upload');
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
                  $insertId= $this->common->encrypt_decrypt('encrypt',$insertId);
                   redirect('signup/'.$insertId);
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
      //  print_r($data);   die;
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
                        redirect('admin');
                    }
                }
            }
        } else {
            $this->app->message('Your link has been expired.', 'error');
            redirect('admin');
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
            $data['page_slug']           =  "myaccount";   
            $limit = 5;
            $userID                      = $this->session->all_userdata()['userId'];
            $data['profiledownload']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
            $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
            $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 
            $data['datasetlist'] 	 = $this->common->_getdatasetList($limit);
            $data['sendgrid']           = $this->common->getsendgridDetails();
            $data['profiledetails']     = $this->common->getprofileDetails();
            $data['total_balance']      =  $this->common->chkBalanceAccount($userID);
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
            $userID    = $this->session->all_userdata()['userId'];
            $data['meta_description']    = METADESCRIPTION;
            $data['page_title']          = SITE_TITLE;
            $data['page_name']           = "Edit Profile";
            $data['page_slug']           =  "profile";
            $data['profiledetails']     = $this->common->getprofileDetails();
            
            $data['profiledownload']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
            $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
            $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 
             $data['total_balance']      =  $this->common->chkBalanceAccount($userID);    
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
                $this->upload->initialize($config);
                if($this->upload->do_upload('profilepic')){
                    $image1 =$this->upload->data()['file_name'] ;
                    $image = base_url().'uploads/userProfilePic/'. $image1; 
                    chmod($this->upload->data()['full_path'],0777);
                }else{
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
              $userID    = $this->session->all_userdata()['userId'];
            $data['academicDetail'] = $this->common->_getById("jobseeker",array('userID ' => $this->session->all_userdata()['userId']));
            $data['settingProfile'] = $this->common->_getById("jobseeker",array('userID ' => $this->session->all_userdata()['userId']));
            
            $data['meta_description']    = METADESCRIPTION;
            $data['page_title']          = SITE_TITLE;
            $data['page_name']           = "profile";
            $data['page_slug']           =  "profile";
                $data['profiledetails']     = $this->common->getprofileDetails();
                 $data['profiledownload']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
            $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
            $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 
             $data['total_balance']      =  $this->common->chkBalanceAccount($userID);
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
          $userID    = $this->session->all_userdata()['userId'];
            $data['academicDetail'] = $this->common->_getById("jobseeker",array('userID ' => $this->session->all_userdata()['userId']));
            $data['settingProfile'] = $this->common->_getById("jobseeker",array('userID ' => $this->session->all_userdata()['userId']));
            $data['profiledetails']     = $this->common->getprofileDetails();
            $data['profiledownload']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
            $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
            $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 
             $data['total_balance']      =  $this->common->chkBalanceAccount($userID);  
            $data['meta_description']    = METADESCRIPTION;
            $data['page_title']          = SITE_TITLE;
            $data['page_name']           = "profile";
            $data['page_slug']           =  "profile";
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
              $userID    = $this->session->all_userdata()['userId'];
            $data['academicDetail'] = $this->common->_getById("jobseeker",array('userID ' => $this->session->all_userdata()['userId']));
             $data['profiledetails']     = $this->common->getprofileDetails();
            $data['profiledownload']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
            $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
            $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 
            $data['total_balance']      =  $this->common->chkBalanceAccount($userID); 
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
              $userID    = $this->session->all_userdata()['userId'];
            $data['settingProfile'] = $this->common->_getById("jobseeker",array('userID ' => $this->session->all_userdata()['userId']));
             $data['profiledetails']     = $this->common->getprofileDetails();
              $data['profiledownload']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
            $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
            $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 
             $data['total_balance']      =  $this->common->chkBalanceAccount($userID);
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
           
           
          /*        if (!empty($_FILES['resume']) && $_FILES['resume']['size'] > 0) {

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
           */
                  $insert_data['notifyByEmail']  = ($postData['notifyByEmail'])?'1':'0';   
                  $insert_data['notifyBySMS']    = ($postData['notifyBySMS'])?'1':'0';   
                  $insert_data['notifyByPhone']  = ($postData['notifyByCall'])?'1':'0';   
                 
                  $isoption                      =    $postData['optionsRadios'];   
              
                  if($isoption==1){
                       $insert_data['isAvailableF2F'] = TRUE;
                  }else{
                       $insert_data['isAvailableF2F'] = FALSE;
                      
                  }
                  
                
                 
        
               $insert_data['userID']   = $this->session->all_userdata()['userId'];
            
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
              $userID    = $this->session->all_userdata()['userId'];
	    $data['meta_description']    = METADESCRIPTION;
            $data['page_title']          = SITE_TITLE;
            $data['page_name']           = "Datasetlist";
             $data['page_slug']           = "Datasetlist";
             $data['profiledownload']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
            $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
            $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 
            $data['total_balance']      =  $this->common->chkBalanceAccount($userID);
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
            
            $userID    = $this->session->all_userdata()['userId'];
	    $data['meta_description']    = METADESCRIPTION;
            $data['page_title']          = SITE_TITLE;
            $data['page_name']           = "Company List";
              $data['page_slug']           = "Companylist";
            $data['profiledownload']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
            $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
            $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 
             $data['total_balance']      =  $this->common->chkBalanceAccount($userID);
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
    if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='3')) {
      $id = $this->uri->segment(4);  
      $userID                            =   $this->session->all_userdata()['userId']; 
      $data['meta_description']          = METADESCRIPTION;
            $data['page_title']          = SITE_TITLE;
            $data['page_name']           = "Dataset View";
            $data_set                    = $this->common->_getById('dataset',array('datasetId'=>$id));
            $data['dataset_data']        = $data_set; 
            $data_jobseeker              =  $this->common->_getById('jobseeker',array('userID'=>$userID));
            $data['profiledetails']      = $this->common->getprofileDetails();
            
             $data['profiledownload']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
            $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
            $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 
            $data['total_balance']       =  $this->common->chkBalanceAccount($userID);
            $statusdata =$this->common->get_trackuserEmail($this->session->all_userdata()['userId'],$id);
            
            if(!empty($statusdata)){
                $this->app->message('You have already send email to this data set.', 'error');
            }
            
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
    
         }else{
                  $this->app->message('Invalid  access.', 'error');
                redirect('signin'); 
              }     
}   


            public function datasetmail(){
  if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='3')) {
                 $id = $this->uri->segment(4); 
                      

                         $data['rowID']              = $id;
                  $data['meta_description']          = METADESCRIPTION;
                        $data['page_title']          = SITE_TITLE;
                        $data['page_name']           = "user_email";
                        
                         $data['profiledownload']    = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
                        $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
                        $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 

                        $data['profiledetails']      = $this->common->getprofileDetails();
                        $data_set                    = $this->common->_getById('dataset',array('datasetId'=>$id));
                        $data['dataset_data']        = $data_set; 
                        $userID                      =   $this->session->all_userdata()['userId']; 
                        
                          $balance                   =    $this->common->chkBalanceAccount($userID);
                     
                       
                         if($balance < $data_set->price){
                             
                             $this->app->message("You have no sufficient balance, Please recharge your account. ",'error');
                             redirect('user/userPaymentPage');
                         }
                         
                        
                        
                        $data['jobseeker']           =  $this->common->_getById('jobseeker',array('userID'=>$userID));
                            
                        $data['dataset_city']        = $this->common->_getCityName($data_set->city);
                                   
                        $data['dataset_emprange']    = $this->common->_getempRange($data_set->empRange);
                        $data['mail_templates']      = $this->common->_getallTemplateData(); 
                                      
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
                        
              }else{
                  $this->app->message('Invalid  access.', 'error');
                redirect('signin'); 
              }    


            }   
            
     
           public function send_mail() {
               
            if ($this->input->server('REQUEST_METHOD') === "POST") {

                $postdata = $this->input->post();
                $link = base_url();
                $insert_data = array();

                $this->form_validation->set_rules('mail_subject', ' Email subject ', 'trim|required');
                $this->form_validation->set_rules('mailID', 'Mail Template', 'trim|required');
                $this->form_validation->set_rules('messageData', ' Email message ', 'trim|required');

                if ($this->form_validation->run() != FALSE) {

                      $tmpID      = $postdata['mailID'];
                     $id          = $postdata['rowID'] ;
                     $subject     = $postdata['mail_subject'];
                     $msg         = $this->input->post('messageData', FALSE).'<p >{BRRR}<p/>'. '<br/>{OPENLINK}<br/>';
                     $attach_data = $postdata['attachImg'];
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




                      $message                    = $this->common->_getTemplateData($tmpID); 
                     $data_set                    = $this->common->_getById('dataset',array('datasetId'=>$id));

                    $MSG = '/{MESSAGE}/';

                    $LINK = '/{LINK}/';
                    $SITE = '/{NAME}/';
                    $PRO  = '/{PROFILEDETAILS}/';
                    $URL  = '/{URLLINK}/';
                    $SITE_title = SITE_TITLE;
                    $job        = $data_set->title;
                    $BRRR        = '/{BRRR}/';
                    $OPEN        = '/{OPENLINK}/';
                 
                    $downloadURL =   '<b>Click on to download resume <a  href="{LINK}"   > Click</b>';
                    
                  
                  
                    $msg = preg_replace($BRRR, $downloadURL, $msg); 
                    
                    $urllink = '<div style="margin:0 auto;max-width:700px; display:none; background-color:#CCC;">
                                   <table class="" cellpadding="0" cellspacing="0" style="width:100%;font-size:0px;" align="center">
                                   <tbody>
                                   <tr><td style="text-align:center;vertical-align:top;font-size:0;padding:20px 0;padding-top:0px;padding-bottom:24px;">
                                   <img src="{URLLINK}" width="10" height="10" />  </td></tr></tbody></table></div>';
                    
                 
                    $msg = preg_replace($OPEN, $urllink, $msg); 
                    
                 
                    foreach ($company_data  as $cval) {

                          $tovalue                            = $cval['primaryEmail'];
                          $insert_data['datasetID']           = $id;
                          $insert_data['userID']              = $userID;
                          $insert_data['downloadedURL']       = $attach_data;
                           $insert_data['companyID']          = $cval['companyID'];
                          $insert_data['templateID']          = $tmpID;
                           $insert_data['isdownLoaded']       = 0;
                           $insert_data['isopenedEmail']      = 0;
                          $insert_data['createdAt']           = date('Y-m-d H:i:s');
                       
                           $rowid  = $this->common->insert('trackuseremail',$insert_data);
                           $link   = base_url().'user/profiledownLoad/'.$rowid;      
                           $link1  = base_url().'user/openEmail/'.$rowid;
                           
                          $msg     = preg_replace($LINK, $link, $msg);   
                          $msgdata = preg_replace($URL, $link1, $msg);    
                      
                          $status  =  $this->common->send_mail($tovalue, $subject, $msgdata, $attach_data);
                       
                    }
                    
                    $data['amount']                = $data_set->price;
                           $data['userID']         = $userID ;
                    $data['transactionTimeStamp']  = date('Y-m-d H:i:s') ;
                    $data['paymentStatus']         = $status ;
                    $data['paymentGateway']        = 'Jobseeker';
                    $data['remarks']               = "Apply to job";
                    $orderID                       = $this->common->insert('emailcampaignbookingorder',$data);
                    
                    $balance                       = $this->common->chkBalanceAccount($userID);
                    $final                         = $balance-$data_set->price;
                    
                    $history ['userID']            = $userID;
                    $history ['orderID']           = $orderID;
                     $history['balance']           = $final;
                       $history['amount']          = $data_set->price;
                    $history ['remarks']           = "Apply to job";
                    $history ['transactionType']   = '2';
                    $history ['createdon']         = date('Y-m-d H:i:s');
                    $this->common->insert('transactionHistory',$history);
                    $this->app->message('Message has been sent.', 'success');
                    redirect('user/profile_view');
                } else {

                    if (form_error('mail_subject') != '') {
                        $this->app->message(form_error('mail_subject'), 'error');
                    } else if (form_error('mailID') != '') {
                        $this->app->message(form_error('mailID'), 'error');

                    } else if (form_error('messageData') != '') {
                        $this->app->message(form_error('messageData'), 'error');
                       
                    } 
                   
                }
            } else {
                $this->app->message('Invalid methods access.', 'error');
                redirect('datasetmail');
            }
        }


        public function getpreviewmailData(){

                     $postdata = $this->input->post();
                     $from = $this->session->all_userdata()['firstName'];
                     $tmpID = $postdata['mailID'];
                     $id    = $postdata['rowID'];
                     $subject = $postdata['mail_subject'];
                     $msg = $postdata['messageData'];
                     $attach_data = $postdata['attachImg'];

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

        
        public function getpreviewmail(){
                
                     $postdata      = $this->input->post();
                     $from          = $this->session->all_userdata()['firstName'];
                     $tmpID         = $postdata['mailID'];
                     $id            = $postdata['rowID'];
                     $subject       = $postdata['mail_subject'];
                     $msg           = $this->input->post('messageData',false);
                    $attach_data    = $postdata['attachImg'];
                    $comp_count     =  $postdata['company_count_data'];
                  
                    $data['mailID']       =  $tmpID;
                    $data['rowID']        =  $id;
                    $data['subject']      =  $subject;
                    $data['messageData']  =   $this->input->post('messageData',false);
                    $data['attach_Data']  =  $attach_data;
                    $data['company_count']=  $comp_count; 
                    
                $data['meta_description']     = METADESCRIPTION;
                 $data['page_title']          = SITE_TITLE;
                 $data['page_name']           = "user_email";
                 $data['page_slug']           = "preview_email";

                  $data['profiledownload']    = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
                 $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
                 $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 

                 $data['profiledetails']      = $this->common->getprofileDetails();
                 $data_set                    = $this->common->_getById('dataset',array('datasetId'=>$id));
                 $data['dataset_data']        = $data_set; 
                 $userID                      = $this->session->all_userdata()['userId']; 

                   $balance                   = $this->common->chkBalanceAccount($userID);
                 //print_r($data); die;
                  $this->load->view('frontend/common/header.php',$data);
                  $this->load->view('frontend/common/jobseekerTopheader.php',$data);
                  $this->load->view('frontend/mailpreview', $data);
                  $this->load->view('frontend/common/footer.php',$data);    

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
                                    
                                  
                                    <article class="card-user box-typical  " style="height: 320px;">
                                          <div class="card-user-status">
                                            <?php
                                            echo $data['stateName'];
                                            echo '<br/>';
                                            $cities = $this->common->_getCityName($data['city']);
                                            echo rtrim($cities, ', ');
                                            ?>
                                        </div>
                                            
                                        <div class="card-user-photo">
                                            <a href="<?php echo base_url()  ?>user/dataset/detail/<?php echo $data['datasetId']; ?>">  
                                                <img src="<?php echo base_url() ?>assets/admin/img/townhouse.jpg" alt=""> </a>
                                        </div>
                                        <div class="card-user-name"><?php echo $data['title']; ?></div>
                                         <div class="card-user-name">Company :  <?php echo $data['comp_count']; ?></div>
                                       
                                         <div class="card-user-name"> <i class="fa fa-rupee"></i> <?php  echo ($data['price'])?$data['price']:'0 ' ; ?></div>
                                      <a href="<?php echo base_url()  ?>user/dataset/detail/<?php echo $data['datasetId']; ?>" class="btn btn-rounded">Apply</a>
                                         
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
               $this->common->update('trackuseremail',$condition, $insert_data);
               $download     = $this->common->_getById('trackuseremail',array('downloadID'=>$id));
               $this->load->helper('download');
               if(!empty($download->downloadedURL)){
                   
                $url  =  $download->downloadedURL;
                $type = explode('.', $url);
               }
               $data = file_get_contents($url); // Read the file's contents
               $name = 'resume.'.$type[1];

               force_download($name, $data);
            
            
            
        }
        
        
        public function openEmail(){
            
             $id = $this->uri->segment(3);
             
               $condition   = array('downloadID'=>$id);
               $insert_data =array('isopenedEmail'=>'1');
               $this->common->update('trackuseremail',$condition, $insert_data);
               $download     = $this->common->_getById('trackuseremail',array('downloadID'=>$id));
              
        }
        
        
        
          
        public function uploadFileData(){
             $fname ='';
            $files  = $_FILES;

               $key = array_keys($_FILES);
             $fname = $key[0];
              $path = FCPATH . 'uploads/docs/'; 
                $config = array(
                   'upload_path'   => $path,
                   'allowed_types' => 'pdf|docs|doc',
                   'overwrite'     => 1,                       
               );

           
               $new_name = $fname.strtotime(date('Y-m-d H:i:s'));
                $config['file_name'] = $new_name;

        
         
                 $this->load->library('upload', $config);
                 $this->upload->initialize($config);
                 $cpt = count($_FILES[$fname]['name']);
                 for($i=0; $i<$cpt; $i++)
                {
                     $_FILES[$fname]['name']= $files[$fname]['name'][$i];
                     $_FILES[$fname]['type']= $files[$fname]['type'][$i];
                     $_FILES[$fname]['tmp_name']= $files[$fname]['tmp_name'][$i];
                     $_FILES[$fname]['error']= $files[$fname]['error'][$i];
                     $_FILES[$fname]['size']= $files[$fname]['size'][$i];


                    if ($this->upload->do_upload($fname)) {
                      $fileName =base_url().'uploads/docs/'.$this->upload->data()['file_name'] ;
                     // $insert_data['intermediateMarksheet']    =  $intermarksheet;
                       $images[] = $fileName;
                      }else{
                            $error = $this->upload->display_errors();
                            print_r( $error); die;
                      }
                }
                
                $imagefile = implode(',', $images);
                $id        = $from = $this->session->all_userdata()['userId'];
                
             
                
                $query      =  $this->db->query("select jobseekerID from jobseeker where userID = $id");
                $row = (array)$query->row();
                if($fname=='resume'){
                    $data = array('resumeURL'=>$imagefile);
                }else if($fname=='hsmarksheet'){
                    $data = array('highSchoolMarksheet'=>$imagefile);
                }else if($fname=='intmarksheet'){
                    $data = array('intermediateMarksheet'=>$imagefile);
                } else if($fname=='otherCertificate'){
                    
                $data = array('certification'=>$imagefile);
                }
                if(!empty($row)){
                $condition = array('jobseekerID'=>$row['jobseekerID']);
                $this->common->update('jobseeker',$condition,$data);
                }else{
                    $data['userID'] = $id;
                    $id = $this->common->insert('jobseeker',$data);
                } 
               echo (json_encode(array('error' => $error, 'img' => $imagefile)));	
    
               
        }
        
      
        
        
             
        /*
         * Show Company List for jobseeker
         * view Company
         */
         public function emailuserlist(){

              if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='3')) {


            $id = $this->uri->segment(3);  
            $userID                      =   $this->session->all_userdata()['userId']; 
            $data['meta_description']          = METADESCRIPTION;
                  $data['page_title']          = SITE_TITLE;
                  $data['page_name']           = "User Dataset View";
                   $data['page_slug']           = "useremail";
                   $data['profiledownload']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
                    $data['openedemail']        = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
                    $data['totalsendemail']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 
                    $data['total_balance']      =  $this->common->chkBalanceAccount($userID);
                  $data_set                    = $this->common->_getById('dataset',array('datasetId'=>$id));
                  $data['dataset_data']        = $data_set; 
                  $data['company_data']         = $this->common->get_trackuserEmail($this->session->all_userdata()['userId'],$id);
                  $data['profiledetails']     = $this->common->getprofileDetails();
                  $data['dataset_emprange']        = $this->common->_getempRange($data_set->empRange);


                  $this->load->view('frontend/common/header.php',$data);
                  $this->load->view('frontend/common/jobseekerTopheader.php',$data);
                  $this->load->view('frontend/useremail', $data);
                  $this->load->view('frontend/common/footer.php',$data);	


              }else{        	
                      $this->app->message('Invalid user access.', 'error');
                  redirect('signin');
              }	

         }    


         public function userDatasetlistData(){

              if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='3')) {
                  $data['meta_description']    = METADESCRIPTION;
                  $data['page_title']          = SITE_TITLE;
                  $data['page_name']           = "User Dataset List";
                  $data['page_slug']           = "useremail";
                  $data['profiledownload']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
                  $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
                  $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 
                  $userID                      =   $this->session->all_userdata()['userId']; 
                   $data['profiledetails']     = $this->common->getprofileDetails();
                   $data['total_balance']      =  $this->common->chkBalanceAccount($userID);

                  $data['datasetlist']         = $this->common->get_trackuserdataset($this->session->all_userdata()['userId']);


                  $this->load->view('frontend/common/header.php',$data);
                  $this->load->view('frontend/common/jobseekerTopheader.php',$data);
                  $this->load->view('frontend/userDatasetlist', $data);
                  $this->load->view('frontend/common/footer.php',$data);	
              }else{        	
                      $this->app->message('Invalid user access.', 'error');
                  redirect('signin');
              }	

         }   
         
         
     
  // Payment Process Start from Here..       
      public function userPaymentPage(){
              
              
            
              
              if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='3')) {
                  
                  $userID                      = $this->session->all_userdata()['userId'];  
                  $data['meta_description']    = METADESCRIPTION;
                  $data['page_title']          = SITE_TITLE;
                  $data['page_name']           = "User Recharge Page";
                  $data['page_slug']           = "payment_page";
                  $data['profiledownload']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
                  $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
                  $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId']));         
                  $data['profiledetails']      = $this->common->getprofileDetails();  
                  $data['total_balance']      =  $this->common->chkBalanceAccount($userID);
                  $data['txnid']               = substr(hash('sha256', mt_rand() . microtime()), 0, 20);                  
                  $data['hash']                = '';    
                  $data['amount']              = '';
                  $data['action']              =    base_url()."user/payu_Payment";  
                 // $data['msg']                 = validation_errors() ? validation_errors() :  $this->app->message('Invalid user access.', 'error');

                   $this->load->view('frontend/common/header.php',$data);
                  $this->load->view('frontend/common/jobseekerTopheader.php',$data);
                  $this->load->view('frontend/paymentpage', $data);
                  $this->load->view('frontend/common/footer.php',$data);	

              }else{        	
                    $this->app->message('Invalid user access.', 'error');
                    redirect('signin');
              }	

         } 
          
         
   
      public function payu_Payment(){
          
          
            if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='3')) {
                
                $userID   = $this->session->all_userdata()['userId'];
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required');
            if($this->form_validation->run()!=FALSE){      
               
                   
                $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
               
                if(empty($this->input->post('hash')) ) {   
                    
                     
                  
                    $hashVarsSeq = explode('|', $hashSequence);
                    $hash_string = '';	
                  
                    foreach($hashVarsSeq as $hash_var) {
                        $hash_string .= ($this->input->post($hash_var))?$this->input->post($hash_var) : '';
                        $hash_string .= '|';
                    }
                    $SALT         = PAYU_SALT  ;
                    $hash_string .= $SALT;
                    $data['hash']   = strtolower(hash('sha512', $hash_string));
                } 
                

                $data['meta_description']    = METADESCRIPTION;
                $data['page_title']          = SITE_TITLE;
               $data['page_name']            = "User Payment Page";
                  $data['page_slug']         = "payment_page";
                $data['profiledownload']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
                $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
                $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 
                $data['profiledetails']      = $this->common->getprofileDetails();
                 $data['total_balance']      =  $this->common->chkBalanceAccount($userID);    
                $data['txnid']               = $this->input->post('txnid');
                $data['amount']              = $this->input->post('amount');
               
                $data['action']              = PAYU_TEST_URL.'/_payment';
                // $data['msg']                 = validation_errors() ? validation_errors() :  $this->app->message('Invalid user access.', 'error');
              
                $this->load->view('frontend/common/header.php',$data);
             
                $this->load->view('frontend/common/jobseekerTopheader',$data);
               
                $this->load->view('frontend/paymentpage', $data);
                $this->load->view('frontend/common/footer',$data);	
               }else{    
                   if(form_error('amount')!=''){
                     $this->message = form_error('amount');
                    redirect('user/userPaymentPage');
                   }
                }
            }else{
                  $this->app->message('Invalid user access.', 'error');
                  redirect('signin');
            
            }    

     }  
   
    //"Seagull== http://seagullpublishers.in/?page_id=2605";
     public function payu_PaymentSuccess() {
         
       $amount =0;
     
         $userID   = $this->session->all_userdata()['userId'];
        
         $response = $_REQUEST;
         
          $data['userID']             = $userID;
          $data['amount']             = $response['amount'];
        $data['transactionTimeStamp'] = $response['addedon'];
        if($response['status']=="success"){
           $data['paymentstatus']     = '1';
        }if($response['status']=="pending"){
            $data['paymentstatus']    = '2';
        }if($response['status']=="failure"){
            $data['paymentstatus']    = '3';
        }
        $data['transactionData']      = $response['txnid'];
         $data['paymentGateway']      = 'PAYU';
         $data['createdon']           = $createON    = date('Y-m-d H:i:s');
    
         
        if($response['status']=="success"){
            $amount   =   $response['amount'];
        }
       // print_r($data); die;
         $rechargID   = $this->common->insert('recharge', $data);
        
            $query1 = $this->db->query("select balance+$amount as balance1 from transactionHistory where userID=$userID order by transactionID desc limit 1");
            $row    = (array)$query1->row();
            $newAmt = $row['balance1']  ;
            
          
             $query = "insert into transactionHistory set userID = '$userID' ,amount='$amount' ,transactionType='1',createdon='$createON',rechargeID= $rechargID, 
             balance= $newAmt, remarks= 'credit via PAYU' ";
  
            $this->db->query($query);
         //   echo $this->db->last_query();  
         
        $userID   = $this->session->all_userdata()['userId'];
        $data['meta_description']    = METADESCRIPTION;
        $data['page_title']          = SITE_TITLE;
       $data['page_name']            = "Transaction History";
          $data['page_slug']         = "transaction_history";
        $data['profiledownload']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
        $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
        $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 
        $data['profiledetails']      = $this->common->getprofileDetails();
        $data['total_balance']      =  $this->common->chkBalanceAccount($userID);             
        $this->app->message('Transaction have completed.', 'success'); 
        
        $data['history_Data']       = $this->common->getTransactionHistory($userID);
        
        
        
        $this->load->view('frontend/common/header.php',$data);
        $this->load->view('frontend/common/jobseekerTopheader',$data);
        $this->load->view('frontend/transactionHistory', $data);
        $this->load->view('frontend/common/footer',$data);
     }
 
      
     public function payu_TransactionHistory() {  
            
              if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='3')) {
                   $userID   = $this->session->all_userdata()['userId'];
                $data['meta_description']    = METADESCRIPTION;
                $data['page_title']          = SITE_TITLE;
               $data['page_name']            = "Transaction History";
                  $data['page_slug']         = "transaction_history";
                $data['profiledownload']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
                $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
                $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 
                $data['profiledetails']      = $this->common->getprofileDetails();
                 $data['total_balance']      =  $this->common->chkBalanceAccount($userID);     
            //    $this->app->message('Transaction have completed.', 'success'); 

                $data['history_Data']       = $this->common->getTransactionHistory($userID);



                $this->load->view('frontend/common/header.php',$data);
                $this->load->view('frontend/common/jobseekerTopheader',$data);
                $this->load->view('frontend/transactionHistory', $data);
                $this->load->view('frontend/common/footer',$data);      
        }else{
                $this->app->message('Invalid user access.', 'error');
                redirect('signin'); 
        }          
    }     
   
    //"Seagull== http://seagullpublishers.in/?page_id=2605";
     public function payu_Paymentfailure() {


                
         
         $amount  =$famount= 0;
         
         $userID   = $this->session->all_userdata()['userId'];
        
         $response = $_REQUEST;
         
          $data['userID']            = $userID;
   //      $data['transactionID']      = $response['txnid'];
         $data['amount']             = $response['amount'];
         
        $data['transactionTimeStamp']= $response['addedon'];
        if($response['status']=="success"){
           $data['paymentstatus']    = '1';
        }if($response['status']=="pending"){
            $data['paymentstatus']    = '2';
        }if($response['status']=="failure"){
            $data['paymentstatus']    = '3';
        }
        $data['transactionData']      = $response['txnid'];
         $data['paymentGateway']      = 'PAYU';
         $data['createdon']      = $createON    = date('Y-m-d H:i:s');
    
         $amount                      = $response['amount'] ;
        if($response['status']=="success"){
            $famount =   $response['amount'];
        }
       // print_r($data); die;
         $rechargID   = $this->common->insert('recharge', $data);
        
            $newAmt = 0;        
            $query1 = $this->db->query("select balance as balance1 from transactionHistory where userID=$userID order by transactionID desc limit 1");
            if($query1->num_rows() > 0){
                $row    = (array)$query1->row();
                $balance = $row['balance1']  ;

            }
            
          
             $query = "insert into transactionHistory set userID = '$userID' ,amount='$amount' ,transactionType='1',createdon='$createON',rechargeID= $rechargID, 
             balance= $balance, remarks= 'credit via PAYU' ";
  
            $this->db->query($query);
         //   echo $this->db->last_query();  
         
       
        $data['meta_description']    = METADESCRIPTION;
        $data['page_title']          = SITE_TITLE;
       $data['page_name']            = "Transaction History";
          $data['page_slug']         = "transaction_history";
        $data['profiledownload']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
        $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
        $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 
        $data['profiledetails']      = $this->common->getprofileDetails();
         $data['total_balance']      =  $this->common->chkBalanceAccount($userID);               
        $this->app->message('Transaction have failed.', 'error'); 
        
        $data['history_Data']       = $this->common->getTransactionHistory($userID);
        
        
        
        $this->load->view('frontend/common/header.php',$data);
        $this->load->view('frontend/common/jobseekerTopheader',$data);
        $this->load->view('frontend/transactionHistory', $data);
        $this->load->view('frontend/common/footer',$data);
     }
     
     
      
     public function payu_PaymentHistory() {  
            
              if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='3')) {
                   $userID   = $this->session->all_userdata()['userId'];
                $data['meta_description']    = METADESCRIPTION;
                $data['page_title']          = SITE_TITLE;
               $data['page_name']            = "Payu Transaction History";
                  $data['page_slug']         = "transaction_history";
                $data['profiledownload']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
                $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
                $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 
                $data['profiledetails']      = $this->common->getprofileDetails();
                 $data['total_balance']      =  $this->common->chkBalanceAccount($userID);     
            //    $this->app->message('Transaction have completed.', 'success'); 

                $data['history_Data']       = $this->common->getPayuTransactionHistory($userID);



                $this->load->view('frontend/common/header.php',$data);
                $this->load->view('frontend/common/jobseekerTopheader',$data);
                $this->load->view('frontend/paymentHistory', $data);
                $this->load->view('frontend/common/footer',$data);      
        }else{
                $this->app->message('Invalid user access.', 'error');
                redirect('signin'); 
        }          
    }     
    
  public function user_TransactionHistory() {  
            
              if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='3')) {
                   $userID   = $this->session->all_userdata()['userId'];
                $data['meta_description']    = METADESCRIPTION;
                $data['page_title']          = SITE_TITLE;
               $data['page_name']            = "User Transaction History";
                  $data['page_slug']         = "transaction_history";
                $data['profiledownload']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
                $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
                $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 
                $data['profiledetails']      = $this->common->getprofileDetails();
                 $data['total_balance']      =  $this->common->chkBalanceAccount($userID);     
            //    $this->app->message('Transaction have completed.', 'success'); 

                $data['history_Data']       = $this->common->user_TransactionHistory($userID);



                $this->load->view('frontend/common/header.php',$data);
                $this->load->view('frontend/common/jobseekerTopheader',$data);
                $this->load->view('frontend/userPaymentHistory', $data);
                $this->load->view('frontend/common/footer',$data);      
        }else{
                $this->app->message('Invalid user access.', 'error');
                redirect('signin'); 
        }          
    }        


           
    // Get  Social Sites User Data   
    public function getgmailData(){
        
             if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='3')) {
        
                        $gmailAPIKEY       ="AIzaSyCWjeIJ9sHVOUtYweVRVz-_-UK_fR-EhtI";

                        $gmailCLIENTID     = "733626215518-8ref4g43m6bhk24pdd7ot3uqd5cpjgq2.apps.googleusercontent.com";
                        $gmailCLIENTSECRET = "lcATFycgnJ-hCktkesoFmrgc";
                        $redirectUrl       = base_url().'user/getgmailData';
                    $Google_api_client_id  = $gmailCLIENTID ;
                    $Google_client_secret  = $gmailCLIENTSECRET ;
                    $Google_redirect_url   = $redirectUrl; // redirect url mentioned in aapi console
                    $Google_contact_max_result =100 ; // integer value
                    $authcode= $_GET["code"];
                    $clientid=$Google_api_client_id;
                    $clientsecret=$Google_client_secret;
                    $redirecturi=$Google_redirect_url ;
                    $fields=array(
                    'code'=>  urlencode($authcode),
                    'client_id'=>  urlencode($clientid),
                    'client_secret'=>  urlencode($clientsecret),
                    'redirect_uri'=>  urlencode($redirecturi),
                    'grant_type'=>  urlencode('authorization_code')
                    );
                    $fields_string="";
                    foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
                    $fields_string=rtrim($fields_string,'&');
                    //open connection
                    $ch = curl_init();
                    //set the url, number of POST vars, POST data
                    curl_setopt($ch,CURLOPT_URL,'https://accounts.google.com/o/oauth2/token');
                    curl_setopt($ch,CURLOPT_POST,100);
                    curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
                    // Set so curl_exec returns the result instead of outputting it.
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    //to trust any ssl certificates
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    //execute post
                    $result = curl_exec($ch);
                    //close connection
                    curl_close($ch);
                    //extracting access_token from response string
                    $response   =  json_decode($result);
                   $accesstoken= $response->access_token;
                   
                    if( $accesstoken!="")
                    $_SESSION['token']= $accesstoken; 
                    //passing accesstoken to obtain contact details
                     $myurl ='https://www.google.com/m8/feeds/contacts/default/full?&max-results='.$Google_contact_max_result .'&oauth_token='.$_SESSION['token'];
                    //$xmlresponse=  file_get_contents('https://www.google.com/m8/feeds/contacts/default/full?&max-results='.$Google_contact_max_result .'&oauth_token='.$_SESSION['token']);
                    
                   // $xmlresponse=  file_get_contents($myurl);
                        //reading xml using SimpleXML
                    

                    $curl_handle=curl_init();
                    curl_setopt($curl_handle, CURLOPT_URL, $myurl);
                    curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
                    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Job Hunter');
                    $query = curl_exec($curl_handle);
                    curl_close($curl_handle);
                    $xmlresponse = $query ;
                  
                    $xml=  new SimpleXMLElement($xmlresponse);
                    $xml->registerXPathNamespace('gd','http://schemas.google.com/g/2008');
                    $result = $xml->xpath('//gd:email');
                    $count = 0;
                     
                    foreach ( $result as $title )
                    {
                        
                       // echo $title->attributes()->address;
                         $friends[]  = (array)$title->attributes()->address;
                   // $contact_key[] = $this->contact_model->insert_contact_gmail($fetched_email);
                    }
                    
                     foreach ( $friends as $daa )
                    {
                        
                       // echo $title->attributes()->address;
                         $friendsdata[]  = $daa[0];
                   // $contact_key[] = $this->contact_model->insert_contact_gmail($fetched_email);
                    }
                    
                
                 //   $data['friendsdata']        =     $friendsdata;
                 $dataemail                     = $this->common->getEmailList();
                    $filterfriends = array_diff($friendsdata,$dataemail);
                    
               
                 //   $friendata = array();
                  $final_data      = array_unique($filterfriends);
                 
                  
                    foreach ($final_data as $key=> $friendvalue) {
                      
                        $frienddata[$key]['email']  = $friendvalue;
                        $frienddata[$key] ['status'] = $this->common->chkapprovedstatus($friendvalue);
                    }
                   
                    $data['friend_list']        =     $frienddata;
               
                $data['meta_description']    = METADESCRIPTION;
                $data['page_title']          = SITE_TITLE;
                $data['page_name']           = "myfriends";
                $data['page_slug']           =  "myfriends";   
                $limit = 5;
                $userID                      = $this->session->all_userdata()['userId'];
                $data['profiledownload']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
                $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
                $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 
                $data['datasetlist'] 	     = $this->common->_getdatasetList($limit);
                $data['sendgrid']           = $this->common->getsendgridDetails();
                $data['profiledetails']     = $this->common->getprofileDetails();
                $data['total_balance']      =  $this->common->chkBalanceAccount($userID);

                $data['clientid']            =  $clientId = '733626215518-8ref4g43m6bhk24pdd7ot3uqd5cpjgq2.apps.googleusercontent.com';
                $clientSecret                = 'lcATFycgnJ-hCktkesoFmrgc';
                $data['redirecturi']         = $redirectUrl = base_url() .'user/getgmailData'; 
                
//                echo '<pre>';
//                print_r($data);  die;
                $this->load->view('frontend/common/header.php',$data);
                $this->load->view('frontend/common/jobseekerTopheader',$data);
                $this->load->view('frontend/getsocialfriendList', $data);
                $this->load->view('frontend/common/footer',$data);   
                
             }else{
         
         $this->app->message("In valid user ",'error');
         redirect('signin');
     }    
        
          } 
        
    public function getsocialsitesData(){
                if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='3')) {
        $data['meta_description']    = METADESCRIPTION;
        $data['page_title']          = SITE_TITLE;
        $data['page_name']           = "myfriends";
        $data['page_slug']           =  "myfriends";   
        $limit = 5;
        $userID                      = $this->session->all_userdata()['userId'];
        $data['profiledownload']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
        $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
        $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 
        $data['datasetlist'] 	 = $this->common->_getdatasetList($limit);
        $data['sendgrid']           = $this->common->getsendgridDetails();
        $data['profiledetails']     = $this->common->getprofileDetails();
        $data['total_balance']      =  $this->common->chkBalanceAccount($userID);
       $data['red_data']            = $this->common->get_referral_data($userID);        
        $data['clientid']            =  $clientId = '733626215518-8ref4g43m6bhk24pdd7ot3uqd5cpjgq2.apps.googleusercontent.com';
        $clientSecret                = 'lcATFycgnJ-hCktkesoFmrgc';
        $data['redirecturi']         = $redirectUrl = base_url() .'user/getgmailData'; 
            
                $this->load->view('frontend/common/header.php',$data);
                $this->load->view('frontend/common/jobseekerTopheader',$data);
                $this->load->view('frontend/getsocialfriendList', $data);
                $this->load->view('frontend/common/footer',$data);    
     }else{
         
         $this->app->message("In valid user Access ",'error');
         redirect('signin');
     }
            
        
    }
    
          
    
    public function sendrefferalMail(){
              
      if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='3')) {
                $postdata    = $this->input->post();
                $referdata   = $postdata['referal'];
               
                $friendemail = $postdata['friend_email'];
                
                $friendemail = explode(',',$postdata['friend_email']);
             
                foreach ($friendemail as $key => $value) {

                    if (!filter_var($value, FILTER_VALIDATE_EMAIL) === true) {
                         $this->app->message("this $value is not valid.", 'error'); 
                         redirect('user/getsocialsitesData');
                    }else{
                        $friendEmail[] = $value;
                    }
               }
            
               if(isset($postdata['referal']))
               $final = array_merge($referdata, $friendEmail);
               else{
                  $final =$friendEmail;
               }
               $referdata =  array_unique($final);
             
             
             $message = '
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title></title>
  <style type="text/css">
    
  #outlook a { padding: 0; }
  .ReadMsgBody { width: 100%; }
  .ExternalClass { width: 100%; }
  .ExternalClass * { line-height:100%; }
	body { margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
	table, td { border-collapse:collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
  img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }
  p {
    display: block;
    margin: 13px 0;
  }

  </style>
  <!--[if !mso]><!-->
  <style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Ubuntu:400,500,700,300);
  </style>
  <style type="text/css">
    @media only screen and (max-width:480px) {
      @-ms-viewport { width:320px; }
      @viewport { width:320px; }
    }
  </style>
  <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700,300" rel="stylesheet" type="text/css">
  <!--<![endif]-->
<style type="text/css">
    @media only screen and (min-width:480px) {
    .mj-column-per-100, * [aria-labelledby="mj-column-per-100"] { width:100%!important; }
}</style></head>
<body id="YIELD_MJML" style="background: #eceff4;"><div class="mj-body" style="background-color:#eceff4;"><!--[if mso]>
  		<table border="0" cellpadding="0" cellspacing="0" width="700" align="center" style="width:700px;"><tr><td>
  		<![endif]--><div style="margin:0 auto;max-width:700px;"><table class="" cellpadding="0" cellspacing="0" style="width:100%;font-size:0px;" align="center"><tbody><tr><td style="text-align:center;vertical-align:top;font-size:0;padding:20px 0;padding-top:0px;padding-bottom:24px;"></td></tr></tbody></table></div><!--[if mso]>
      </td></tr></table>
  		<![endif]-->
  		<!--[if mso]>
  		<table border="0" cellpadding="0" cellspacing="0" width="700" align="center" style="width:700px;"><tr><td>
  		<![endif]--><div style="margin:0 auto;max-width:700px;background:#d8e2e7;"><table class="" cellpadding="0" cellspacing="0" style="width:100%;font-size:0px;background:#d8e2e7;" align="center"><tbody><tr><td style="text-align:center;vertical-align:top;font-size:0;padding:1px;"><!--[if mso]>
      <table border="0" cellpadding="0" cellspacing="0"><tr><td style="width:700px;">
      <![endif]--><div style="vertical-align:top;display:inline-block;font-size:13px;text-align:left;width:100%;" class="mj-column-per-100" aria-labelledby="mj-column-per-100">
                                        <table style="background:white;" width="100%"><tbody><tr><td style="font-size:0;padding:30px 30px 18px;" align="left">
                                                        <div class="mj-content" style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:24px;line-height:22px;">You’ve received an invite</div></td></tr>
                                                        <tr><td style="font-size:0;padding:0 30px 16px;" align="left"><div class="mj-content" style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:15px;line-height:22px;">
                                                                 
                    <span style="color: #0081c3; font-weight: 700;">{NAME}</span>
               
                has invited you to join Job Hunter!</div></td></tr>
                 <tr><td style="font-size:0;padding:0 30px 6px;" align="left"><div class="mj-content" style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:15px;line-height:22px;">«I have reffered you to join the job hunter , It is growing company to get job Please join it  and  have a great pleasure to get  jobs .»</div></td></tr>
                 <tr><td style="font-size:0;padding:8px 16px 10px;padding-bottom:25px;padding-right:30px;padding-left:30px;" align="left"><table cellpadding="0" cellspacing="0" style="border:none;border-radius:25px;" align="left"><tbody>
                                 <tr><td style="background:#00a8ff;border-radius:25px;color:white;cursor:auto;" align="center" valign="middle" bgcolor="#00a8ff">
                                         <a class="mj-content" href="{SIGNUPLINK}" style="display:inline-block;text-decoration:none;background:#00a8ff;border:1px solid #00a8ff;border-radius:25px;color:white;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:15px;font-weight:400;padding:8px 16px 10px;" target="_blank">Go to Job Hunter </a></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso]>
      </td></tr></table>
      <![endif]--></td></tr></tbody></table></div><!--[if mso]>
      </td></tr></table>
  		<![endif]-->
  		<!--[if mso]>
  		<table border="0" cellpadding="0" cellspacing="0" width="700" align="center" style="width:700px;"><tr><td>
  	
      </td></tr></table>
  		<![endif]-->
  		<!--[if mso]>
  		<table border="0" cellpadding="0" cellspacing="0" width="700" align="center" style="width:700px;"><tr><td>
  		<![endif]--><div style="margin:0 auto;max-width:700px;"><table class="" cellpadding="0" cellspacing="0" style="width:100%;font-size:0px;" align="center"><tbody><tr><td style="text-align:center;vertical-align:top;font-size:0;padding:20px 0;padding-top:0px;padding-bottom:24px;"></td></tr></tbody></table></div><!--[if mso]>
  		</td></tr></table>
  		<![endif]--></div></body>
</html>';
             
             
                   $userID = $this->session->all_userdata()['userId'];

                    $LINK      = '/{SIGNUPLINK}/';

                    $NAME      = '/{NAME}/';
                  
                    
                    
                   
                    $fname     = $this->session->all_userdata()['fname']; 
                    $fromemail = $this->session->all_userdata()['email'];
                  
                    $msgdata = preg_replace($NAME, $fname, $message);
                     foreach ($referdata as $refemail){
                    
                         $insdata['userID']        = $userID ;
                         $insdata['refertoEmail']  = $refemail;
                         $insdata['status']        = '1';
                         $insdata['createdOn']     =  date("Y-m-d H:i:s");
                         
                         $subject ="Referal Mail";
                         if($this->common->checkSendEmail($userID,$refemail) > 0) {
                            
                             $dup_email[]=$refemail;
                         }else{
                         
                                $rowid    = $this->common->insert('referral',$insdata);
                                  $rowid     = $this->common->encrypt_decrypt('decrypt',$rowid);    
                                  $link   = "http://mobileappsdev.net/jobhunter/signup/$rowid";
                                 $msgdata = preg_replace($LINK, $link, $msgdata);

                                $this->phpmailer->IsSMTP();                                      // set mailer to use SMTP
                                $this->phpmailer->Host 			= SMTPHOST;  // specify main and backup server
                                $this->phpmailer->SMTPAuth 		= true;     // turn on SMTP authentication
                                $this->phpmailer->SMTPSecure 	        = "ssl";
                                $this->phpmailer->Port 			= SMTPPORT;
                                $this->phpmailer->Username 		= SMTPEMAIL;  // SMTP username
                                $this->phpmailer->Password 		= SMTPPASS; // SMTP password
                                $this->phpmailer->SMTPAuth 		= true;
                                $this->phpmailer->From 			= ADMINEMAIL;
                                $this->phpmailer->FromName 		= SITE_TITLE;
                                $this->phpmailer->AddAddress($refemail);
                                               // name is optional
                                $this->phpmailer->AddReplyTo(ADMINEMAIL, SITE_TITLE);


                                $this->phpmailer->IsHTML(true);                                  // set email format to HTML

                                $this->phpmailer->Subject = "Job Hunter : Referral Mail.";
                                $this->phpmailer->Body    = $msgdata;


                                if(!$this->phpmailer->Send())
                                {
                                //   echo "Message could not be sent. <p>";
                                    $this->app->message("Mailer Error: " . $this->phpmailer->ErrorInfo,'error'); // "Mailer Error: " . $this->phpmailer->ErrorInfo;
                                    redirect('user/getsocialsitesData');
                                }
               }  
            }  
           
           
            if(!empty($dup_email)){
                $email = implode(', ', $dup_email);
                $this->app->message($email." already send mail  for this",'error');
            }
            
             // Include the google api php libraries
        $data['meta_description']    = METADESCRIPTION;
        $data['page_title']          = SITE_TITLE;
        $data['page_name']           = "myfriends";
        $data['page_slug']           =  "myfriends";   
        $limit = 5;
        $userID                      = $this->session->all_userdata()['userId'];
        $data['profiledownload']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
        $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
        $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 
        $data['datasetlist'] 	     = $this->common->_getdatasetList($limit);
        $data['sendgrid']            = $this->common->getsendgridDetails();
        $data['profiledetails']      = $this->common->getprofileDetails();
        $data['total_balance']       =  $this->common->chkBalanceAccount($userID);
                 
        $data['clientid']            =  $clientId = '733626215518-8ref4g43m6bhk24pdd7ot3uqd5cpjgq2.apps.googleusercontent.com';
        $clientSecret                = 'lcATFycgnJ-hCktkesoFmrgc';
        $data['redirecturi']         = $redirectUrl = base_url() .'user/getgmailData'; 
            
        $this->load->view('frontend/common/header.php',$data);
        $this->load->view('frontend/common/jobseekerTopheader',$data);
        $this->load->view('frontend/getsocialfriendList', $data);
        $this->load->view('frontend/common/footer',$data);    
    
    
     
      } else {
         $this->app->message("In valid user Access ",'error');
         redirect('signin');
      }
  }  
    
  

/*

      public function sendrefferalMail(){
              
      if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='3')) {
                $postdata    = $this->input->post();
                $referdata   = $postdata['referal'];
                
                
             $message = '
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title></title>
  <style type="text/css">
    
  #outlook a { padding: 0; }
  .ReadMsgBody { width: 100%; }
  .ExternalClass { width: 100%; }
  .ExternalClass * { line-height:100%; }
	body { margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
	table, td { border-collapse:collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
  img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }
  p {
    display: block;
    margin: 13px 0;
  }

  </style>
  <!--[if !mso]><!-->
  <style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Ubuntu:400,500,700,300);
  </style>
  <style type="text/css">
    @media only screen and (max-width:480px) {
      @-ms-viewport { width:320px; }
      @viewport { width:320px; }
    }
  </style>
  <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700,300" rel="stylesheet" type="text/css">
  <!--<![endif]-->
<style type="text/css">
    @media only screen and (min-width:480px) {
    .mj-column-per-100, * [aria-labelledby="mj-column-per-100"] { width:100%!important; }
}</style></head>
<body id="YIELD_MJML" style="background: #eceff4;"><div class="mj-body" style="background-color:#eceff4;"><!--[if mso]>
  		<table border="0" cellpadding="0" cellspacing="0" width="700" align="center" style="width:700px;"><tr><td>
  		<![endif]--><div style="margin:0 auto;max-width:700px;"><table class="" cellpadding="0" cellspacing="0" style="width:100%;font-size:0px;" align="center"><tbody><tr><td style="text-align:center;vertical-align:top;font-size:0;padding:20px 0;padding-top:0px;padding-bottom:24px;"></td></tr></tbody></table></div><!--[if mso]>
      </td></tr></table>
  		<![endif]-->
  		<!--[if mso]>
  		<table border="0" cellpadding="0" cellspacing="0" width="700" align="center" style="width:700px;"><tr><td>
  		<![endif]--><div style="margin:0 auto;max-width:700px;background:#d8e2e7;"><table class="" cellpadding="0" cellspacing="0" style="width:100%;font-size:0px;background:#d8e2e7;" align="center"><tbody><tr><td style="text-align:center;vertical-align:top;font-size:0;padding:1px;"><!--[if mso]>
      <table border="0" cellpadding="0" cellspacing="0"><tr><td style="width:700px;">
      <![endif]--><div style="vertical-align:top;display:inline-block;font-size:13px;text-align:left;width:100%;" class="mj-column-per-100" aria-labelledby="mj-column-per-100">
                                        <table style="background:white;" width="100%"><tbody><tr><td style="font-size:0;padding:30px 30px 18px;" align="left">
                                                        <div class="mj-content" style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:24px;line-height:22px;">You’ve received an invite</div></td></tr>
                                                        <tr><td style="font-size:0;padding:0 30px 16px;" align="left"><div class="mj-content" style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:15px;line-height:22px;">
                                                                 
                    <span style="color: #0081c3; font-weight: 700;">{NAME}</span>
               
                has invited you to join Job Hunter!</div></td></tr>
                 <tr><td style="font-size:0;padding:0 30px 6px;" align="left"><div class="mj-content" style="cursor:auto;color:#000000;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:15px;line-height:22px;">«I have reffered you to join the job hunter , It is growing company to get job Please join it  and  have a great pleasure to get  jobs .»</div></td></tr>
                 <tr><td style="font-size:0;padding:8px 16px 10px;padding-bottom:25px;padding-right:30px;padding-left:30px;" align="left"><table cellpadding="0" cellspacing="0" style="border:none;border-radius:25px;" align="left"><tbody>
                                 <tr><td style="background:#00a8ff;border-radius:25px;color:white;cursor:auto;" align="center" valign="middle" bgcolor="#00a8ff">
                                         <a class="mj-content" href="{SIGNUPLINK}" style="display:inline-block;text-decoration:none;background:#00a8ff;border:1px solid #00a8ff;border-radius:25px;color:white;font-family:Proxima Nova, Arial, Arial, Helvetica, sans-serif;font-size:15px;font-weight:400;padding:8px 16px 10px;" target="_blank">Go to Job Hunter </a></td></tr></tbody></table></td></tr></tbody></table></div><!--[if mso]>
      </td></tr></table>
      <![endif]--></td></tr></tbody></table></div><!--[if mso]>
      </td></tr></table>
  		<![endif]-->
  		<!--[if mso]>
  		<table border="0" cellpadding="0" cellspacing="0" width="700" align="center" style="width:700px;"><tr><td>
  	
      </td></tr></table>
  		<![endif]-->
  		<!--[if mso]>
  		<table border="0" cellpadding="0" cellspacing="0" width="700" align="center" style="width:700px;"><tr><td>
  		<![endif]--><div style="margin:0 auto;max-width:700px;"><table class="" cellpadding="0" cellspacing="0" style="width:100%;font-size:0px;" align="center"><tbody><tr><td style="text-align:center;vertical-align:top;font-size:0;padding:20px 0;padding-top:0px;padding-bottom:24px;"></td></tr></tbody></table></div><!--[if mso]>
  		</td></tr></table>
  		<![endif]--></div></body>
</html>';
             
             
                   $userID = $this->session->all_userdata()['userId'];

                    $LINK      = '/{SIGNUPLINK}/';

                    $NAME      = '/{NAME}/';
                    $link      ="http://mobileappsdev.net/jobhunter/signup/$userID";
                    
                    
                   
                    $fname     = $this->session->all_userdata()['fname']; 
                    $fromemail = $this->session->all_userdata()['email'];
                    $msgdata = preg_replace($LINK, $link, $message);
                    $msgdata = preg_replace($NAME, $fname, $msgdata);
                     foreach ($referdata as $refemail){
                    
                         $insdata['userID']        = $userID ;
                         $insdata['refertoEmail']  = $refemail;
                         $insdata['status']        = '1';
                         $insdata['createdOn']     =  date("Y-m-d H:i:s");
                         
                         $subject ="Referal Mail";
                         
                         
                $rowid    = $this->common->insert('referral',$insdata);
                $this->phpmailer->IsSMTP();                                      // set mailer to use SMTP
		$this->phpmailer->Host 			= SMTPHOST;  // specify main and backup server
		$this->phpmailer->SMTPAuth 		= true;     // turn on SMTP authentication
		$this->phpmailer->SMTPSecure 	        = "ssl";
		$this->phpmailer->Port 			= SMTPPORT;
		$this->phpmailer->Username 		= SMTPEMAIL;  // SMTP username
		$this->phpmailer->Password 		= SMTPPASS; // SMTP password
		$this->phpmailer->SMTPAuth 		= true;
		$this->phpmailer->From 			= ADMINEMAIL;
		$this->phpmailer->FromName 		= SITE_TITLE;
		$this->phpmailer->AddAddress($refemail);
		               // name is optional
		$this->phpmailer->AddReplyTo(ADMINEMAIL, SITE_TITLE);

	  
		$this->phpmailer->IsHTML(true);                                  // set email format to HTML

		$this->phpmailer->Subject = "Job Hunter : Referral Mail.";
		$this->phpmailer->Body    = $msgdata;
		

		if(!$this->phpmailer->Send())
		{
		//   echo "Message could not be sent. <p>";
		    $this->app->message("Mailer Error: " . $this->phpmailer->ErrorInfo,'error'); // "Mailer Error: " . $this->phpmailer->ErrorInfo;
		    redirect('user/getsocialsitesData');
		}
            }  
            
            
             // Include the google api php libraries
        $data['meta_description']    = METADESCRIPTION;
        $data['page_title']          = SITE_TITLE;
        $data['page_name']           = "myfriends";
        $data['page_slug']           =  "myfriends";   
        $limit = 5;
        $userID                      = $this->session->all_userdata()['userId'];
        $data['profiledownload']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
        $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
        $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 
        $data['datasetlist'] 	     = $this->common->_getdatasetList($limit);
        $data['sendgrid']            = $this->common->getsendgridDetails();
        $data['profiledetails']      = $this->common->getprofileDetails();
        $data['total_balance']       =  $this->common->chkBalanceAccount($userID);
          $data['red_data']            = $this->common->get_referral_data($userID);               
        $data['clientid']            =  $clientId = '733626215518-8ref4g43m6bhk24pdd7ot3uqd5cpjgq2.apps.googleusercontent.com';
        $clientSecret                = 'lcATFycgnJ-hCktkesoFmrgc';
        $data['redirecturi']         = $redirectUrl = base_url() .'user/getgmailData'; 
            
        $this->load->view('frontend/common/header.php',$data);
        $this->load->view('frontend/common/jobseekerTopheader',$data);
        $this->load->view('frontend/getsocialfriendList', $data);
        $this->load->view('frontend/common/footer',$data);    
    
    
      }
      else {
         $this->app->message("In valid user Access ",'error');
         redirect('signin');
      }
  }  
    
    */
  
    public function questionListData(){
        
        
        
        if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='3')){
            
           
            
                if ($this->input->server('REQUEST_METHOD') === "POST") {
                    
                   
                    $this->form_validation->set_rules('question_data', 'Question Text ', 'trim|required');
            
                   if($this->form_validation->run()!=FALSE){    
                     
                      $insdata['questionText'] =    $this->input->post('question_data');
                      $insdata['createdOn']    =    date('Y-m-d H:i:s');
                      $insdata['userID']       =    $this->session->all_userdata()['userId'];
                     
                    if(!$this->common->insert('userQuery',$insdata)){
                        $this->app->message("Error in Inser process",'error');
                        redirect('user/questionData');
                    }
                      
                    }else{
                        
                     if(form_error('question_data'))   {
                      
                      $this->app->message(form_error('question_data'), 'error'); 
                       redirect('user/questionData');
                     }
                        
                    }
                }
              
                $data['meta_description']    = METADESCRIPTION;
                $data['page_title']          = SITE_TITLE;
                $data['page_name']           = "User Question List";
                $data['page_slug']           = "question";
                $id                          =  $this->session->all_userdata['userId'];
                $data['ques_data']            = $this->common->question_data($id);
                  $limit = 5;
        $userID                      = $this->session->all_userdata()['userId'];
        $data['profiledownload']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
        $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
        $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 
        $data['datasetlist'] 	     = $this->common->_getdatasetList($limit);
        $data['sendgrid']            = $this->common->getsendgridDetails();
        $data['profiledetails']      = $this->common->getprofileDetails();
        $data['total_balance']       =  $this->common->chkBalanceAccount($userID);
               
                $this->load->view('frontend/common/header',$data);
                $this->load->view('frontend/common/jobseekerTopheader',$data);
                $this->load->view('frontend/get_question', $data);
                $this->load->view('frontend/common/footer',$data);      


        }else{
          $this->app->message("Access Denined ",'error')  ;
          redirect('signin');
          
            
        }
    }

    public function getquestionData(){
        
        
        
        if(!empty($this->session->all_userdata()['userId']) && ($this->session->all_userdata()['userType'] =='3')){
            
    
              
                $data['meta_description']    = METADESCRIPTION;
                $data['page_title']          = SITE_TITLE;
                $data['page_name']           = "Question List";
                $data['page_slug']           = "question";
             
                
                
                $userID                      = $this->session->all_userdata()['userId'];
                $data['profiledownload']     = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isdownLoaded'=>'1')); 
                $data['openedemail']         = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'],'isopenedEmail'=>'1')); 
                $data['totalsendemail']      = $this->common->_getCount('trackuseremail',array('userID'=>$this->session->all_userdata()['userId'])); 
                $data['datasetlist'] 	     = $this->common->_getdatasetList($limit);
                $data['sendgrid']            = $this->common->getsendgridDetails();
                $data['profiledetails']      = $this->common->getprofileDetails();
                $data['total_balance']       =  $this->common->chkBalanceAccount($userID);
                $data['ques_data']           = $this->common->_getList('question',array('status'=>'1'),'questionID desc');
                $this->load->view('frontend/common/header',$data);
                $this->load->view('frontend/common/jobseekerTopheader',$data);
                $this->load->view('frontend/questionData', $data);
                $this->load->view('frontend/common/footer',$data);      


        }else{
          $this->app->message("Access Denined ",'error')  ;
          redirect('signin');
          
            
        }
    }
                   
    
    
     
 
} 

?>