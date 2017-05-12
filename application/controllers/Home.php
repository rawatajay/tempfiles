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
        if(empty($this->session->all_userdata()['userId'])){
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
        $data['home_url']          = 'dashboard';  
        $this->load->view('admin/common/header.php',$data);  
        $this->load->view('admin/common/topheader.php',$data);
        $this->load->view('admin/common/sidebarMenu.php',$data);   
        $this->load->view('admin/dashboard',$data);        
        $this->load->view('admin/common/footer.php',$data);
	}
	/*
	* sign up
	*
	* Used for view user sign up page.
	*
	* @param 
	* @return
	*/
	function signup($data =array()){

             $datad = $data;
                   
              $code       = $this->uri->segment(2);   
              $dataID     = $this->common->encrypt_decrypt('decrypt',$code); 
             
            if($dataID!="1233"){
                $this->common->openReferralEmail($dataID);
            }
        
        if(!empty($this->session->all_userdata()['userId']) && $this->session->all_userdata()['userType'] !='1' ){
            redirect('myaccount');
        }
		$datad['login_url'] = $this->facebook->getLoginUrl(
            array(
                'redirect_uri' => site_url('home/facebook?t=2&rd=signup'),
                'scope' => array("email") /* permissions here */
            )
        );
		$datad['meta_description']	= METADESCRIPTION;
        $datad['page_title'] 		        = SITE_TITLE;
        $datad['page_name']			= "Sign Up";
			
        $this->load->view('frontend/common/header.php',$datad);
      
        $this->load->view('frontend/signup', $datad);
        $this->load->view('frontend/common/footer.php',$datad);
	}
    /*
    * sign up
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
            
        $this->load->view('frontend/common/header.php',$data);
      /*  $this->load->view('frontend/common/tophead.php',$data);
        $this->load->view('frontend/common/comHead.php',$data);*/
        $this->load->view('frontend/forgetpassword', $data);
        $this->load->view('frontend/common/footer.php',$data);
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
            
        $this->load->view('frontend/common/header.php',$data);       
        $this->load->view('frontend/setpassword', $data);
        $this->load->view('frontend/common/footer.php',$data);   
    }
	/*
	* Login
	*
	* Used for view user login page.
	*
	* @param 
	* @return
	*/
	function signin(){       

        if(!empty($this->session->all_userdata()['userId']) && $this->session->all_userdata()['userType'] !='1' ){
            redirect('myaccount');
        }
        $data['login_url'] = $this->facebook->getLoginUrl(
            array(
                'redirect_uri' => site_url('home/facebook?t=2&rd=signin'),
                'scope' => array("email") /* permissions here */
            )
        );	
          $data['code'] = $this->common->encrypt_decrypt('encrypt','1233'); 	
		$data['meta_description']	= METADESCRIPTION;
        $data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Sign In";
         $data['page_slug']			= "sign_in";    
        $this->load->view('frontend/common/header.php',$data);
        //$this->load->view('frontend/common/tophead.php',$data);
        //$this->load->view('frontend/common/comHead.php',$data);
        
     
        $this->load->view('frontend/login', $data);
        
        
        $this->load->view('frontend/common/footer.php',$data);
	}
	/*
	* Contact
	*
	* Used for view frontend contact view.
	*
	* @param 
	* @return
	*/
	function contact(){
		$data['page_slug']			= $this->uri->segment(1);		
		$data['meta_description']	= METADESCRIPTION;
        $data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Contact Us";
        $this->load->view('frontend/common/header.php',$data);
        $this->load->view('frontend/common/tophead.php',$data);
        $this->load->view('frontend/common/comHead.php',$data);
        $this->load->view('frontend/contactus', $data);
        $this->load->view('frontend/common/footer.php',$data);
	}
	/*
	* Blog
	*
	* Used for view frontend Blog view.
	*
	* @param 
	* @return
	*/
	function blog(){
            
       
        $data['page_slug']		= $this->uri->segment(1);		
        $data['meta_description']	= METADESCRIPTION;
        $data['page_title'] 		= SITE_TITLE;
        $data['page_name']		= "Blog";
        $postData                       = $this->input->post();
   $data['code'] = $this->common->encrypt_decrypt('encrypt','1233'); 
            $blog_count                  = $this->common->_getCount('blog',array('status'=>'1'));      
            $limit  = 5;
            $data['totalpage']           = ceil($blog_count/$limit);

            if(isset($postData['pageNum']) && $postData['pageNum']){
                $pageNum = $postData['pageNum'] - 1;
            } else 
            {
               $pageNum = 0;
            }
         //   echo "dddddddd".$postData['pageNum'].'<br/>'; 
        //   echo  $pageNum;
            $offset = $pageNum * $limit;
            $data['page_num']  = $pageNum +1;
           $data['blog_data']  = $this->common->_getpageData('blog',$limit ,$offset, 'blogID Desc');
        
       
           $this->load->view('frontend/blog', $data);
	}
        
        function blog_details(){
            
        $id = $this->uri->segment(2); 
        $data['page_slug']			= $this->uri->segment(1);		
        $data['meta_description']	= METADESCRIPTION;
        $data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Blog";
     //   $this->load->view('frontend/common/header.php',$data);
       // $this->load->view('frontend/common/tophead.php',$data);
       // $this->load->view('frontend/common/comHead.php',$data);
            
         $data['blog_data'] = $this->common->_getById('blog',array('blogID'=>$id));
            $data['code'] = $this->common->encrypt_decrypt('encrypt','1233'); 
        
        //print_r($this->common->_getList('blog','','blogID desc')); die;
        $this->load->view('frontend/blog_details', $data);
       // $this->load->view('frontend/common/footer.php',$data);
	}
	/*
	* About Us
	*
	* Used for view frontend About Us.
	*
	* @param 
	* @return
	*/
	function aboutus(){
		$data['page_slug']			= $this->uri->segment(1);		
		$data['meta_description']	= METADESCRIPTION;
        $data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "About Us";
        $this->load->view('frontend/common/header.php',$data);
        $this->load->view('frontend/common/tophead.php',$data);
        $this->load->view('frontend/common/comHead.php',$data);
        $this->load->view('frontend/aboutus', $data);
        $this->load->view('frontend/common/footer.php',$data);
	}
	/*
	* About Us
	*
	* Used for view frontend About Us.
	*
	* @param 
	* @return
	*/
	function privacypolicy(){
		$data['page_slug']			= $this->uri->segment(1);		
		$data['meta_description']	= METADESCRIPTION;
        $data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Privacy Policy";
        $this->load->view('frontend/common/header.php',$data);
        $this->load->view('frontend/common/tophead.php',$data);
        $this->load->view('frontend/common/comHead.php',$data);
        $this->load->view('frontend/privacypolicy', $data);
        $this->load->view('frontend/common/footer.php',$data);
	}
	/*
	* About Us
	*
	* Used for view frontend About Us.
	*
	* @param 
	* @return
	*/
	function termsandcondition(){
		$data['page_slug']			= $this->uri->segment(1);		
		$data['meta_description']	= METADESCRIPTION;
        $data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Terms & Condition";
        $this->load->view('frontend/common/header.php',$data);
        $this->load->view('frontend/common/tophead.php',$data);
        $this->load->view('frontend/common/comHead.php',$data);
        $this->load->view('frontend/termsandcondition', $data);
        $this->load->view('frontend/common/footer.php',$data);
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
	/*
	* searchpage
	*
	* Used for view Search Page.
	*
	* @param 
	* @return
	*/
	function searchquery(){		
		$data['page_slug']			= $this->uri->segment(1);		
		$data['meta_description']	= METADESCRIPTION;
        $data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Search";
		$this->load->view('frontend/common/header.php',$data);
        $this->load->view('frontend/common/tophead.php',$data);
        $this->load->view('frontend/common/comHead.php',$data);
        $this->load->view('frontend/searchquery', $data);
        $this->load->view('frontend/common/footer.php',$data);        
	}
	/*
	* Academic Detail
	*
	* Used for view Academic detail.
	*
	* @param 
	* @return
	*/
	function academicrecord(){		
		$data['page_slug']			= $this->uri->segment(1);		
		$data['meta_description']	= METADESCRIPTION;
        $data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Academic Detail";
		$this->load->view('frontend/common/header.php',$data);
        $this->load->view('frontend/common/tophead.php',$data);
        $this->load->view('frontend/common/comHead.php',$data);
        $this->load->view('frontend/academicrecord', $data);
        $this->load->view('frontend/common/footer.php',$data);        
	}
	/*
	* Jobseeker Dashboard 
	*
	* Used for view Jobseeker Dashboard .
	*
	* @param 
	* @return
	*/
	function jobseekerdashboard(){		
		$data['page_slug']			= $this->uri->segment(1);		
		$data['meta_description']	= METADESCRIPTION;
        $data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Job Seeker Dashboard";
		$this->load->view('frontend/common/header.php',$data);
        $this->load->view('frontend/common/tophead.php',$data);
        $this->load->view('frontend/common/comHead.php',$data);
        $this->load->view('frontend/jobseekerdahboard', $data);
        $this->load->view('frontend/common/footer.php',$data);        
	}
    /*
    * joobseeker
    *
    * Used for dispalying the joobseeker step .
    *
    * @param 
    * @return
    */
	function jobseeker(){
		$data['page_slug']			= $this->uri->segment(1);		
		$data['meta_description']	= METADESCRIPTION;
        $data['page_title'] 		= SITE_TITLE;
        $data['page_name']			= "Job Seeker";
		$this->load->view('frontend/common/header.php',$data);
        $this->load->view('frontend/common/tophead.php',$data);
        //$this->load->view('frontend/common/comHead.php',$data);
        $this->load->view('frontend/jobseeker', $data);
        $this->load->view('frontend/common/footer.php',$data);    
        
       // $this->load->view('frontend/common/footer.php',$data);        	
	}
    /*
    * facebook
    *
    * Used for login and sign with facebook.
    *
    * @param $role 
    * @return
    */
	public function facebook($role = null) {

        $redirectTo = @$this->input->get('rd');             
        $user = $this->facebook->getUser();     
      
        
        if ($user) {
            try {
                $data['user_profile'] = $this->facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture.width(150).height(150)');
                $facebook_pic = $data['user_profile']['picture']['data']['url'];
                
                if (!empty($data['user_profile'])) {
                    
                   	$haveProfile = $this->user_model->checkSocialID($data['user_profile']['id']);
                    
                    if ($haveProfile) {

                        $dataArray['firstName']     = $data['user_profile']['first_name'];
                        $dataArray['lastName']      = $data['user_profile']['last_name'];
                        $dataArray['profilePic']    = $facebook_pic; 
                        $dataArray['email']         = $data['user_profile']['email'];                        
                        $dataArray['facebookId']    = $data['user_profile']['id'];

                        $this->user_model->updateFacebookID($haveProfile['userID'], $dataArray);                     
                                              
                        if ($haveProfile['isActive'] == '0') {
                            $name = $data['user_profile']['first_name'].' '.$data['user_profile']['last_name'];
                            $codeData =$this->user_model->getuserDetailBYCode(array('email' => $haveProfile['email']));
                            $this->activationmail($haveProfile['email'],ucfirst($name),$codeData['code']);
                            $this->app->message('Your account is not activated yet.kindly, check your mail ( '.$data['user_profile']['email'].' ) to activate your account or contact to administrator', 'error');
                            redirect('signin');
                        } else {                            
                            $this->__dologin($data['user_profile']['email'], $facebook_pic);
                            redirect('myaccount');
                        }                       
                    } else {
                        $userDetail = $this->user_model->getuserBYEmail(@$data['user_profile']['email']);
                        
                        if (!empty($userDetail)) {

                            $dataArray['facebookid'] = $data['user_profile']['id'];
                            $dataArray['profilePic'] = $facebook_pic;
                            $this->user_model->updateFacebookID($userDetail['userID'], $dataArray);
                           
                            if ($userDetail['isActive'] == '0') {
                                $name = $data['user_profile']['first_name'].' '.$data['user_profile']['last_name'];
                                $codeData =$this->user_model->getuserDetailBYCode(array('email' => $userDetail['email']));
                                $this->activationmail($haveProfile['email'],ucfirst($name),$codeData['code']);
                                $this->app->message('Your account is not activated yet.kindly, check your mail ( '.$userDetail['email'].' ) to activate your account or contact to administrator', 'error');
                                redirect('signin');
                            } else {                               
                                $this->__dologin($data['user_profile']['email'], $facebook_pic);
                                redirect('myaccount');
                            }
                        } else {
                            /*if (empty($data['user_profile']['email'])) {
                                $this->app->message('Email address is required.', 'error');
                                redirect('signup');
                            }   */                         
                            $data['firstname'] = $data['user_profile']['first_name'];
                            $data['last_name'] = $data['user_profile']['last_name'];
                            $data['email'] = $data['user_profile']['email'];
                            $data['facebookid'] = $data['user_profile']['id'];
                            $data['profile_pic'] = $facebook_pic;
                            $this->signup($data);                            
                        }
                    }
                }
            } catch (FacebookApiException $e) {
                $user = null;
            }
        } else {
            $this->app->message('User request failed, try again', 'error');
            redirect($redirectTo);
        }
    }
    /*
    * activationmail
    *
    * Used for send activation mail.
    *
    * @param $email, $name, $code 
    * @return
    */
    public function activationmail($email, $name, $code){

        $message = '<table style=" background-color: #f6f6f6;width: 100%; margin: 0;padding: 0;font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;background: #fff;border: 1px solid #e9e9e9; border-radius: 3px;"> <tr><td style="display: block !important;max-width: 600px !important;margin: 0 auto !important;clear: both !important;" width="600"><div style="max-width: 600px;margin: 0 auto;display: block;padding: 20px;"><table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope itemtype="http://schema.org/ConfirmAction"><tr><td style="padding: 20px;background: #fff;border: 1px solid #e9e9e9;border-radius: 3px;"><meta itemprop="name" content="Confirm Email"/><table width="100%" cellpadding="0" cellspacing="0"><tr><td style= " font-family: \' Helvetica Neue \', \' Helvetica\', Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;"><h1>{SITENAME}</h2></td></tr><tr><td style= " padding: 0 0 20px;font-family: \' Helvetica Neue \', \' Helvetica\', Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;"><p>Dear, {NAME}</p>Please activate your account address by clicking the link below.</td></tr><tr><td  style=" padding: 0 0 20px;"> <a href="{LINK}" style="  text-decoration: none;  color: #FFF;  background-color: #348eda;  border: solid #348eda;  border-width: 10px 20px;  line-height: 2;  font-weight: bold;  text-align: center;  cursor: pointer;  display: inline-block;  border-radius: 5px;  text-transform: capitalize;font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;"" itemprop="url">Confirm email address</a></td></tr><tr><td  style=" padding: 0 0 20px;">Thanks,<br/>{SITENAME} Team</td></tr></table></td></tr></table><div class="footer"><table width="100%"><tr></tr></table></div></div></td></tr></table>';

        $link = base_url('activation') . "/" . $code;
        $patternFind1[0] = '/{NAME}/';
        $patternFind1[1] = '/{LINK}/';
        $patternFind1[2] = '/{SITENAME}/';

        $replaceFind1[0] = ucwords($name);
        $replaceFind1[1] = $link;
        $replaceFind1[2] = SITE_TITLE;

        $txtdesc_contact = stripslashes($message);       
        $contact_sub = preg_replace($patternFind1, $replaceFind1, $contact_sub);
        $ebody_contact = preg_replace($patternFind1, $replaceFind1, $txtdesc_contact);
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
    * __dologin
    *
    * Used for send activation mail.
    *
    * @param $email, $name, $code 
    * @return
    */
    public function __dologin($email, $link = null) {

        $userData = $this->user_model->getuserBYEmail($email);

        //$userinfoData = $this->userinfo->fetchAll($userData['id_user']);
        if ($userData) {
            $session = array(
                'loggedin' => true,
                'fname' => $userData['firstName'],
                'lname' => $userData['lastName'],
                'email' => $userData['email'],
                'userId' => $userData['userID'],
                'userType' => $userData['userType'],
                'facebookId' => $userData['facebookId'],
                'phone' => $userData['phone'],
                'profilePic' => $link ? $link : $userData['profilePic'],
            );
            $this->session->set_userdata($session);
        }
    }
	
} 

?>