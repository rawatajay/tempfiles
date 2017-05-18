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

	private $status = false;

	private $responsedata = array();

	private $message = "";
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
        $this->load->helper('functions');
        $this->load->model('app');
        $this->load->model('auth_model');
        $this->load->library('phpmailer');
	}

	/*
	* index
	*
	* Used for dispalying the admin dashboard.
	*
	* @param 
	* @return
	*/
	function index(){
		if($this->session->userdata('userType') === '1'){
			$data['page_title']         = SITE_TITLE;
	        $data['page_name']          = "Dashboard";
	        $data['page_slug']          = 'dashboard'; 
	        $this->load->view('admin/common/header.php',$data);  
	        $this->load->view('admin/common/topheader.php',$data);
	        $this->load->view('admin/common/adminsidebarMenu.php',$data);   
	        $this->load->view('admin/admindashboard',$data);        
	        $this->load->view('admin/common/footer.php',$data);
        } else {
			echo ADMIN_ACCESS;
		}
	}
	/*
	* register_employee
	*
	* Used for registering employee.
	*
	* @param 
	* @return
	*/
	function register_employee(){	
		if($this->session->userdata('userType') === '1'){
			$data['page_title']         = SITE_TITLE;
	        $data['page_name']          = "Employee Section";
	        $data['page_slug']          = 'manage-employee'; 
	        $data['pageCSS']			= array('css/lib/clockpicker/bootstrap-clockpicker.min.css');
	        $data['pageJS']				= array('js/lib/daterangepicker/daterangepicker.js','js/lib/bootstrap-select/bootstrap-select.min.js','js/angular.min.js','js/controller/employee.js');

	        $data['initJsFunc']	= array("$('#doj').daterangepicker({singleDatePicker: true,showDropdowns: true});","$('#dob').daterangepicker({singleDatePicker: true,showDropdowns: true});");
	        $this->load->view('admin/common/header.php',$data);  
	        $this->load->view('admin/common/topheader.php',$data);
	        $this->load->view('admin/common/adminsidebarMenu.php',$data);   
	        $this->load->view('admin/register_employee',$data);        
	        $this->load->view('admin/common/footer.php',$data);

		} else {
			echo ADMIN_ACCESS;
		}
	}
	/*
	* addEmpdata
	*
	* Used for ading employee data.
	*
	* @param 
	* @return
	*/
	function addEmpdata(){
		if($this->session->userdata('userType') === '1'){
			$postData = $this->input->post('data');
			//print_r($postData);

			$this->form_validation->set_rules('data[empname]', ' Employee Name', 'trim|required');  
			$this->form_validation->set_rules('data[empfathername]', ' Father Name', 'trim|required');
			$this->form_validation->set_rules('data[email]', ' Email ', 'trim|required|valid_email|is_unique[user.email]');
			$this->form_validation->set_rules('data[gender]', ' Gender ', 'trim|required');
			$this->form_validation->set_rules('data[contact]', ' Contact ', 'trim|required|numeric');
			$this->form_validation->set_rules('data[address]', ' Address', 'trim|required');
			$this->form_validation->set_rules('data[dob]', ' Date Of Birth ', 'trim|required'); 
			$this->form_validation->set_rules('data[doj]', ' Date Of Joining', 'trim|required');

			$this->form_validation->set_message('is_unique',' %s already exists.');
			if ($this->form_validation->run() != FALSE) {
				$insert_data['email']            	= trim($postData['email']);                
                $insert_data['gender']           	= trim($postData['gender']);
                $insert_data['dateOfJoining']       = date("Y-m-d",strtotime($postData['doj']));       
                $insert_data['name']        		= trim($postData['empname']);       
                $insert_data['fathername']        	= trim($postData['empfathername']);       
                $insert_data['contact']        		= trim($postData['contact']);
                $insert_data['address']        		= trim($postData['address']);
                $insert_data['createdOn']       	= date("Y-m-d H:i:s");
                $insert_data['dateOfBirth']        	= date("Y-m-d",strtotime($postData['dob'])); 
                                
                
                $insertId = $this->common->insert('user',$insert_data);
                $this->responsedata = array('primary' => encrypt_decrypt('encrypt',$insertId));
                $this->status = true;
                $this->message = "User registered successfully.";

			} else {
				if(form_error('data[empname]')){                     
				    $this->message = form_error('data[empname]');
				} else if(form_error('data[empfathername]')){	
				  	$this->message = form_error('data[empfathername]');
				} else if(form_error('data[email]')){	
				  	$this->message = form_error('data[email]');
				} else if(form_error('data[gender]')){	
				  	$this->message = form_error('data[gender]');
				} else if(form_error('data[contact]')){	
				  	$this->message = form_error('data[contact]');
				} else if(form_error('data[address]')){	
				  	$this->message = form_error('data[address]');
				} else if(form_error('data[dob]')){	
				  	$this->message = form_error('data[dob]');
				} else if(form_error('data[doj]')){	
				  	$this->message = form_error('data[doj]');
				}
			
			}
			echo json_encode(array('status' => $this->status ,'data' =>  $this->responsedata, 'message' => strip_tags($this->message)));
		}
	}
	/*
	* create_account
	*
	* Used for creating employee account.
	*
	* @param 
	* @return
	*/
	function create_account(){	
		if($this->session->userdata('userType') === '1'){
			$data['page_title']         = SITE_TITLE;
	        $data['page_name']          = "Create Employee Account";
	        $data['page_slug']          = 'manage-employee'; 
	        $data['pageJS']				= array('js/angular.min.js','js/controller/employee.js','js/lib/blockUI/jquery.blockUI.js');
	        $this->load->view('admin/common/header.php',$data);  
	        $this->load->view('admin/common/topheader.php',$data);
	        $this->load->view('admin/common/adminsidebarMenu.php',$data);   
	        $this->load->view('admin/create_account',$data);        
	        $this->load->view('admin/common/footer.php',$data);

		} else {
			echo ADMIN_ACCESS;
		}
	}
	/*
	* employee_list
	*
	* Used for displaying employee list.
	*
	* @param 
	* @return
	*/
	function employee_list(){	
		if($this->session->userdata('userType') === '1'){
			$data['page_title']         = SITE_TITLE;
	        $data['page_name']          = "Employee List";
	        $data['page_slug']          = 'manage-employee'; 
	        $data['pageCSS']			= array('css/lib/datatables-net/datatables.min.css','css/lib/bootstrap-sweetalert/sweetalert.css');
	        $data['pageJS']				= array('js/lib/daterangepicker/daterangepicker.js','js/lib/bootstrap-select/bootstrap-select.min.js','js/lib/datatables-net/datatables.min.js','js/lib/bootstrap-sweetalert/sweetalert.min.js','js/angular.min.js','js/controller/employee.js');

	        //$data['initJsFunc']	= array("$('#example').DataTable();");
	        $data['initJsFunc']	= array("$('#doj').daterangepicker({singleDatePicker: true,showDropdowns: true});","$('#dob').daterangepicker({singleDatePicker: true,showDropdowns: true});","$('#registerdemployeelist').DataTable();");
        	$data['userTypes']	= $this->common->_getList('userType','status=1','orderNo ASC');
        	$data['users']	    = $this->common->_getList('USER_VIEW','','empId DESC');
	        $this->load->view('admin/common/header.php',$data);  
	        $this->load->view('admin/common/topheader.php',$data);
	        $this->load->view('admin/common/adminsidebarMenu.php',$data);   
	        $this->load->view('admin/emplist',$data);        
	        $this->load->view('admin/common/footer.php',$data);

		} else {
			echo ADMIN_ACCESS;
		}
	}
	/*
	* getEmpData
	*
	* Used for getting employee data.
	*
	* @param 
	* @return
	*/
	//function getEmpData(){
		/*if($this->session->userdata('userType') === '1'){
			$postData = $this->input->post('data');
			//print_r($postData);
			if(empty($postData)){
				$this->message = "Invalid employee";
			} else {
				$empid = encrypt_decrypt('decrypt',$postData);
				$EmpData = $this->common->_getRow('user', ' userID ='.$empid ,'dateOfJoining,name,address,fathername,contact,dateOfBirth,if(gender="male",1,2) as gender');
				if(!empty($EmpData)) {
					$this->message = "Employee data";
					$this->status  = true;
					$this->responsedata = $EmpData;
				} else {
					$this->message = "No record found.";
				}
			}
			
			echo json_encode(array('status' => $this->status ,'data' =>  $this->responsedata, 'message' => strip_tags($this->message)));
		}*/
	//}
	/*
	* editEmpdata
	*
	* Used for ading employee data.
	*
	* @param 
	* @return
	*/
	function editEmpdata(){
		if($this->session->userdata('userType') === '1'){
			$postData = $this->input->post('data');
			//print_r($postData);die;
			$this->form_validation->set_rules('data[primary]', ' Employee ID', 'trim|required');  
			$this->form_validation->set_rules('data[empname]', ' Employee Name', 'trim|required');  
			$this->form_validation->set_rules('data[empfathername]', ' Father Name', 'trim|required');
			//$this->form_validation->set_rules('data[email]', ' Email ', 'trim|required|valid_email');
			$this->form_validation->set_rules('data[gender]', ' Gender ', 'trim|required');
			$this->form_validation->set_rules('data[contact]', ' Contact ', 'trim|required');
			$this->form_validation->set_rules('data[address]', ' Address', 'trim|required');
			$this->form_validation->set_rules('data[dob]', ' Date Of Birth ', 'trim|required'); 
			$this->form_validation->set_rules('data[doj]', ' Date Of Joining', 'trim|required');

			//$this->form_validation->set_message('is_unique',' %s already exists.');
			if ($this->form_validation->run() != FALSE) {
				$empid = encrypt_decrypt('decrypt',$postData['primary']);
                $insert_data['gender']           	= trim($postData['gender']);
                $insert_data['dateOfJoining']       = date("Y-m-d",strtotime($postData['doj']));       
                $insert_data['name']        		= trim($postData['empname']);       
                $insert_data['fathername']        	= trim($postData['empfathername']);       
                $insert_data['contact']        		= trim($postData['contact']);
                $insert_data['address']        		= trim($postData['address']);
                $insert_data['updatedOn']       	= date("Y-m-d H:i:s");
                $insert_data['dateOfBirth']        	= date("Y-m-d",strtotime($postData['dob']));
                $this->common->update('user', array("userID" => $empid), $insert_data);
                $this->status = true;
                $this->app->message('Emplyee details update successfully.','success');

			} else {
				if(form_error('data[primary]')){                     
				    $this->message = form_error('data[primary]');
				} else if(form_error('data[empname]')){                     
				    $this->message = form_error('data[empname]');
				} else if(form_error('data[empfathername]')){	
				  	$this->message = form_error('data[empfathername]');
				} else if(form_error('data[email]')){	
				  	$this->message = form_error('data[email]');
				} else if(form_error('data[gender]')){	
				  	$this->message = form_error('data[gender]');
				} else if(form_error('data[contact]')){	
				  	$this->message = form_error('data[contact]');
				} else if(form_error('data[address]')){	
				  	$this->message = form_error('data[address]');
				} else if(form_error('data[dob]')){	
				  	$this->message = form_error('data[dob]');
				} else if(form_error('data[doj]')){	
				  	$this->message = form_error('data[doj]');
				}
			
			}
			echo json_encode(array('status' => $this->status ,'data' =>  $this->responsedata, 'message' => strip_tags($this->message)));
		}
	}
	/*
	* updatehrinfo
	*
	* Used for update hr info
	*
	* @param 
	* @return
	*/
	function updatehrinfo(){
		if($this->session->userdata('userType') === '1'){
			$postData = $this->input->post('data');
			$this->form_validation->set_rules('data[primary]', ' Employee Edit Id', 'trim|required');  
			$this->form_validation->set_rules('data[empid]', ' Employee Trivial ID', 'trim|required|is_unique[user.empid]');  
			$this->form_validation->set_rules('data[userType]', ' Employee Type', 'trim|required');
			$this->form_validation->set_rules('data[userdesign]', ' Employee Designation ', 'trim|required');
			$this->form_validation->set_rules('data[userdepart]', ' Employee Department ', 'trim|required');
			$this->form_validation->set_rules('data[empEmergencyContactNumber]', ' Employee Emergency Contact Number', 'trim|required|numeric');
			$this->form_validation->set_rules('data[empEmergencyContactPersonName]', ' Employee Emergency Contact Person Name ', 'trim|required'); 
			$this->form_validation->set_rules('data[empEmergencyContactPersonRelation]', ' Date Of Joining', 'trim|required');
			$this->form_validation->set_message('is_unique',' %s is assigned to other employee');
			
			if ($this->form_validation->run() != FALSE) {
				$empid = encrypt_decrypt('decrypt',$postData['primary']);
                $insert_data['empId']           				= trim($postData['empid']);
                $insert_data['userType']       					= trim($postData['userType']);       
                $insert_data['designationId']       			= trim($postData['userdesign']);       
                $insert_data['departmentId']        			= trim($postData['userdepart']);       
                $insert_data['empEmergencyContactNumber']       = trim($postData['empEmergencyContactNumber']);
                $insert_data['empEmergencyContactPersonName']   = trim($postData['empEmergencyContactPersonName']);
                $insert_data['empEmergencyContactPersonRelation']= trim($postData['empEmergencyContactPersonRelation']);
                $insert_data['updatedOn']       				= date("Y-m-d H:i:s");

                $this->common->update('user', array("userID" => $empid), $insert_data);
                $this->status = true;
                $this->message = "HR Info updated successfully";

                $this->responsedata = array('primary' => $postData['primary'],'emptrivialid' => $postData['empid']);
			} else {
				if(form_error('data[primary]')){                     
				    $this->message = form_error('data[primary]');
				} else if(form_error('data[empid]')){                     
				    $this->message = form_error('data[empid]');
				} else if(form_error('data[userType]')){	
				  	$this->message = form_error('data[userType]');
				} else if(form_error('data[userdesign]')){	
				  	$this->message = form_error('data[userdesign]');
				} else if(form_error('data[userdepart]')){	
				  	$this->message = form_error('data[userdepart]');
				} else if(form_error('data[empEmergencyContactNumber]')){	
				  	$this->message = form_error('data[empEmergencyContactNumber]');
				} else if(form_error('data[empEmergencyContactPersonName]')){	
				  	$this->message = form_error('data[empEmergencyContactPersonName]');
				} else if(form_error('data[empEmergencyContactPersonRelation]')){	
				  	$this->message = form_error('data[empEmergencyContactPersonRelation]');
				} 
			
			}
			echo json_encode(array('status' => $this->status ,'data' =>  $this->responsedata, 'message' => strip_tags($this->message)));
		}
	}
	
	/*
	* updateAccountInfo
	*
	* Used for update account info
	*
	* @param 
	* @return
	*/
	function updateAccountInfo(){
		if($this->session->userdata('userType') === '1'){
			$postData = $this->input->post('data');
			$this->form_validation->set_rules('data[primary]', ' Employee Edit Id', 'trim|required');  
			$this->form_validation->set_rules('data[empPass]', ' Employee Password', 'trim|required|min_length[6]'); 

			if ($this->form_validation->run() != FALSE) {
                $insert_data['password']        	= password_hash((trim($postData['empPass'])), PASSWORD_DEFAULT);     
                $insert_data['isActive']    		= true; 
                $insert_data['updatedOn']       	= date("Y-m-d H:i:s");
                $empid = encrypt_decrypt('decrypt',$postData['primary']);
                $this->common->update('user', array("userID" => $empid), $insert_data);
                $this->status = true;
                $this->message = "Account Info updated successfully";

                $EmpData = $this->common->_getRow('user', ' userID ='.$empid ,'dateOfJoining,name,empId,email,address,fathername,contact,dateOfBirth,if(gender="male",1,2) as gender');

                $message = $this->auth_model->create_Account_tamplate();
            	
            	$patternFind1[0] 	= '/{NAME}/';
                $patternFind1[1] 	= '/{ACCOUNT}/';
                $patternFind1[2] 	= '/{PASSWORD}/';
                $replaceFind1[0] 	= ucwords($EmpData['name']);
                $replaceFind1[1] 	= $EmpData['email'].' <b> OR </b> '.$EmpData['empId'];
                $replaceFind1[2] 	= $postData['empPass'];
                $txtdesc_contact    = stripslashes($message);                        
                $ebody_contact      = preg_replace($patternFind1, $replaceFind1, $txtdesc_contact);
                $esubject_contact	= ucwords(SITE_TITLE)." : Account Created.";
                
                $sendEmailStatus=$this->common->send_mail($ebody_contact,$esubject_contact,$EmpData['email'], $name, ADMINEMAIL, ucwords(SITE_TITLE));
                if($sendEmailStatus){
                	$this->app->message('Employee account created. Link has been sent to employee email.', 'success');
                	$this->session->set_flashdata("resendeamil",'resendeamil');
                }else{
                	$this->app->message('Employee account created but mail not sent yo the employee mail.', 'error');
                }

			} else {
				if(form_error('data[primary]')){                     
				    $this->message = form_error('data[primary]');
				} else if(form_error('data[empPass]')){                     
				    $this->message = form_error('data[empPass]');
				} 
			
			}
			echo json_encode(array('status' => $this->status ,'data' =>  $this->responsedata, 'message' => strip_tags($this->message)));
		}
	}
	/*
	* edit employee
	*
	* Used for update employee info
	*
	* @param 
	* @return
	*/
	function edit_employee(){
		if($this->session->userdata('userType') === '1'){
			$data['page_title']         = SITE_TITLE;
	        $data['page_name']          = "Employee Edit Section";
	        $data['page_slug']          = 'manage-employee'; 
	        $data['pageCSS']			= array('css/lib/clockpicker/bootstrap-clockpicker.min.css');
	        $data['pageJS']				= array('js/lib/daterangepicker/daterangepicker.js','js/lib/bootstrap-select/bootstrap-select.min.js','js/angular.min.js','js/controller/employee.js');

	        $data['initJsFunc']	= array("$('#doj').daterangepicker({singleDatePicker: true,showDropdowns: true});","$('#dob').daterangepicker({singleDatePicker: true,showDropdowns: true});");
	        $this->load->view('admin/common/header.php',$data);  
	        $this->load->view('admin/common/topheader.php',$data);
	        $this->load->view('admin/common/adminsidebarMenu.php',$data);   
	        $this->load->view('admin/edit_employee',$data);        
	        $this->load->view('admin/common/footer.php',$data);

		} else {
			echo ADMIN_ACCESS;
		}
	}
	/*
	* addEmpdata
	*
	* Used for ading employee data.
	*
	* @param 
	* @return
	*/
	function getEmpdataForAccountCreatePage(){
		$data['userTypes']	= $this->common->_getList('userType','status=1','orderNo ASC');
        $data['departments']= $this->common->_getList('departments','status=1');
        $data['designations']= $this->common->_getList('designations','status=1');
		echo json_encode(array('status' => TRUE ,'data' =>  $data, 'message' => ""));
	}
	/*
	* getEmplData
	*
	* Used for ading employee data.
	*
	* @param 
	* @return
	*/
	function getEmpData(){
		$postData = $this->input->post('data');
        $data['empdata']= $this->common->_getRow('user', array('userID' => encrypt_decrypt('decrypt',$postData)));
        
		echo json_encode(array('status' => TRUE ,'data' =>  $data, 'message' => ""));
	}
	/*
	* addAccountEmpdata
	*
	* Used for creating employee account data.
	*
	* @param 
	* @return
	*/
	function addAccountEmpdata(){
		if($this->session->userdata('userType') === '1'){
			$postData = $this->input->post('data');
			$this->form_validation->set_rules('data[userID]', ' Select Employee', 'trim|required');
			$this->form_validation->set_rules('data[userType]', ' Employee Type', 'trim|required');  
			$this->form_validation->set_rules('data[password]', ' Password ', 'trim|required');
			$this->form_validation->set_rules('data[repassword]', 'Confirm Password', 'required|matches[data[password]]');
			
			if ($this->form_validation->run() != FALSE) {
				$insert_data['userType']            	= trim($postData['userType']);                
                $insert_data['password']        	= password_hash((trim($postData['password'])), PASSWORD_DEFAULT);
                $insert_data['isAccountCreated']    = true;                 
                
                $isUpdated = $this->common->update('user','`userID`= '.$postData['userID'],$insert_data);

                $EmpData = $this->common->_getRow('user', ' userID ='.$postData['userID'] ,'dateOfJoining,name,empId,email,address,fathername,contact,dateOfBirth,if(gender="male",1,2) as gender');

                $message = $this->auth_model->create_Account_tamplate();
            	
            	$patternFind1[0] 	= '/{NAME}/';
                $patternFind1[1] 	= '/{ACCOUNT}/';
                $patternFind1[2] 	= '/{PASSWORD}/';
                $replaceFind1[0] 	= ucwords($EmpData['name']);
                $replaceFind1[1] 	= $EmpData['email'].' <b> OR </b> '.$EmpData['empId'];
                $replaceFind1[2] 	= $postData['password'];
                $txtdesc_contact    = stripslashes($message);                        
                $ebody_contact      = preg_replace($patternFind1, $replaceFind1, $txtdesc_contact);
                $esubject_contact	= ucwords(SITE_TITLE)." : Account Created.";
                
                $sendEmailStatus=$this->common->send_mail($ebody_contact,$esubject_contact,$EmpData['email'], $name, ADMINEMAIL, ucwords(SITE_TITLE));
                if($sendEmailStatus){
                	$this->app->message('Please check your email. Link has been sent on your email.', 'success');
                	$this->session->set_flashdata("resendeamil",'resendeamil');
                }else{
                	$this->app->message('Oh snap! due to some error we can not send email.', 'error');
                }

                $this->status = true;
				$this->message = "Account created successfully!";

			} else {
				if(form_error('data[userID]')){                     
				    $this->message = form_error('data[userID]');
				} else if(form_error('data[userType]')){	
				  	$this->message = form_error('data[userType]');
				} else if(form_error('data[password]')){	
				  	$this->message = form_error('data[password]');
				} else if(form_error('data[repassword]')){	
				  	$this->message = form_error('data[repassword]');
				}
			
			}
			echo json_encode(array('status' => $this->status ,'data' =>  $this->responsedata, 'message' => strip_tags($this->message)));
		}
	}
	/*
	* deleteEmployee
	*
	* Used for deleting employee .
	*
	* @param 
	* @return
	*/
	function deleteEmployee(){
		if($this->session->userdata('userType') === '1'){
			$postData = $this->input->post('data');
			//print_r($postData);die;
			if(empty($postData)){
				$this->message = "Invalid employee";
			} else {
				$empid = encrypt_decrypt('decrypt',$postData['id']);
				$isActiveStatus = ($postData['status'] == 'active') ? true : false;
				$isUpdated = $this->common->update('user','`userID`= '.$empid,array('isActive' => $isActiveStatus ));
				$this->status = true;
			}
			
			echo json_encode(array('status' => $this->status ,'data' =>  $this->responsedata, 'message' => strip_tags($this->message)));
		}
	}
	/*
	* deactiveAccount
	*
	* Used for deactive employee .
	*
	* @param 
	* @return
	*/
	function deactivateEmployee(){
		if($this->session->userdata('userType') === '1'){
			$postData = $this->input->post('data');
			//print_r($postData);die;
			if(empty($postData)){
				$this->message = "Invalid employee";
			} else {
				$empid = encrypt_decrypt('decrypt',$postData);
				//$isActiveStatus = ($postData['status'] == 'active') ? true : false;
				$isUpdated = $this->common->update('user','`userID`= '.$empid,array('isAccountCreated' => false ));
				$this->status = true;
			}
			
			echo json_encode(array('status' => $this->status ,'data' =>  $this->responsedata, 'message' => strip_tags($this->message)));
		}
	}
}

?>