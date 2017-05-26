<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Admin
* 
* 
* @package    	CI
* @subpackage 	LMS
* @category 	Admin Controller
* @author 	  	TrivialWorks*
*/
class Admin extends CI_Controller
{

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
	        $data['pageJS']				= array('js/angular.min.js','js/controller/employee.js');
	        $this->load->view('admin/common/header.php',$data); 
        	$data['pendingLeaveCount']= count($this->common->_getlist('employeeLeave', array('status' => 'pending')));
        	$data['employeeCount']= count($this->common->_getlist('user', array('userType !=' => '1')));
        
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
			$action = $this->input->post('action');
			
			$this->form_validation->set_rules('data[empname]', ' Employee Name', 'trim|required');  
			$this->form_validation->set_rules('data[empfathername]', ' Father Name', 'trim|required');
			if($action == 'save') {
				$this->form_validation->set_rules('data[email]', ' Email ', 'trim|required|valid_email|is_unique[user.email]');
			}
			else if($action == 'update') {
				$this->form_validation->set_rules('data[email]', ' Email ', 'trim|required|valid_email|callback_validate_existing_email');
				$this->form_validation->set_message('validate_existing_email',' %s already exists.');
			}
			$this->form_validation->set_rules('data[gender]', ' Gender ', 'trim|required');
			$this->form_validation->set_rules('data[contact]', ' Contact ', 'trim|required|numeric');
			$this->form_validation->set_rules('data[address]', ' Address', 'trim|required');
			$this->form_validation->set_rules('data[dob]', ' Date Of Birth ', 'trim|required'); 
			

			$this->form_validation->set_message('is_unique',' %s already exists.');
			if ($this->form_validation->run() != FALSE) {
				$insert_data['email']            	= trim($postData['email']);                
                $insert_data['gender']           	= trim($postData['gender']);
                       
                $insert_data['name']        		= trim($postData['empname']);       
                $insert_data['fathername']        	= trim($postData['empfathername']);       
                $insert_data['contact']        		= trim($postData['contact']);
                $insert_data['address']        		= trim($postData['address']);
                $insert_data['createdOn']       	= date("Y-m-d H:i:s");
                $insert_data['dateOfBirth']        	= date("Y-m-d",strtotime($postData['dob'])); 
                                
                if($action == 'save'){
                	$userID = $this->common->insert('user',$insert_data);
                	$userID = encrypt_decrypt('encrypt',$userID);
                	$this->message = "User registered successfully.";
            	} else  if ($action == 'update'){
            		$empid = encrypt_decrypt('decrypt',$this->input->post('primary'));
            		$userID = $this->input->post('primary');
            		$this->common->update('user', array("userID" => $empid), $insert_data);
                	$this->message ='Employee details update successfully.';
            	}
                $this->responsedata = array('primary' => $userID);
                $this->status = true;

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
				} 
			
			}
			echo json_encode(array('status' => $this->status ,'data' =>  $this->responsedata, 'message' => strip_tags($this->message)));
		}
	}
	/*
	* validate_existing_email
	*
	* check the email is not related with current user.
	*
	* @param 
	* @return
	*/
	function validate_existing_email(){
		$email = $this->input->post('data[email]');
   		$empid = encrypt_decrypt('decrypt',$this->input->post('primary'));
   		$EmpData = $this->common->_getRow('user', ' userID !='.$empid.' AND email = "'.$email.'"');
   		
   		if(!empty($EmpData)){
   			return false;
   		} else {
   			return true;
   		}
	}
	/*
	* validate_existing_empId
	*
	* check the empId is not related with current user.
	*
	* @param 
	* @return
	*/
	function validate_existing_empId(){
		$emptrivialid = $this->input->post('data[empid]');
   		$empid = encrypt_decrypt('decrypt',$this->input->post('primary'));
   		$EmpData = $this->common->_getRow('user', ' userID !='.$empid.' AND empId = "'.$emptrivialid.'"');
   		
   		if(!empty($EmpData)){
   			return false;
   		} else {
   			return true;
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
	        $data['initJsFunc']	= array("$('#doj').daterangepicker({singleDatePicker: true,showDropdowns: true});","$('#dob').daterangepicker({singleDatePicker: true,showDropdowns: true});","$('#registerdemployeelist').DataTable({ 'scrollX' : true});");
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
			//$this->form_validation->set_rules('data[doj]', ' Date Of Joining', 'trim|required');

			//$this->form_validation->set_message('is_unique',' %s already exists.');
			if ($this->form_validation->run() != FALSE) {
				$empid = encrypt_decrypt('decrypt',$postData['primary']);
                $insert_data['gender']           	= trim($postData['gender']);
                //$insert_data['dateOfJoining']       = date("Y-m-d",strtotime($postData['doj']));       
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
			if($this->input->post('action') == 'update') {
				$this->form_validation->set_rules('primary', ' Employee Edit Id', 'trim|required');  
			} else{
				$this->form_validation->set_rules('data[primary]', ' Employee Edit Id', 'trim|required');  
			}
			$this->form_validation->set_rules('data[empid]', ' Employee Code', 'trim|required|is_unique[user.empid]'); 

			if($this->input->post('action') == 'update') {
				$this->form_validation->set_rules('data[empid]', ' Employee Trivial Code ', 'trim|required|callback_validate_existing_empId');
				$this->form_validation->set_message('validate_existing_empId',' %s already exists.');
			} else {
				$this->form_validation->set_rules('data[empid]', ' Employee Trivial Code', 'trim|required|is_unique[user.empid]'); 
			}

			
			$this->form_validation->set_rules('data[userdesign]', ' Employee Designation ', 'trim|required');
			$this->form_validation->set_rules('data[userdepart]', ' Employee Department ', 'trim|required');
			$this->form_validation->set_rules('data[empEmergencyContactNumber]', ' Employee Emergency Contact Number', 'trim|required|numeric');
			$this->form_validation->set_rules('data[empEmergencyContactPersonName]', ' Employee Emergency Contact Person Name ', 'trim|required'); 
			$this->form_validation->set_rules('data[empEmergencyContactPersonRelation]', ' Date Of Joining', 'trim|required');
			$this->form_validation->set_rules('data[doj]', ' Date Of Joining', 'trim|required');
			$this->form_validation->set_message('is_unique',' %s is assigned to other employee');
			//print_r($postData);
			if ($this->form_validation->run() != FALSE) {
				if($this->input->post('action') == 'update') {
					$empid = encrypt_decrypt('decrypt',$this->input->post('primary'));
				} else{
					$empid = encrypt_decrypt('decrypt',$postData['primary']);
				}
				
                $insert_data['empId']           				= trim($postData['empid']);
                
                $insert_data['dateOfJoining']       			= date("Y-m-d",strtotime($postData['doj']));     
                $insert_data['designationId']       			= trim($postData['userdesign']);       
                $insert_data['departmentId']        			= trim($postData['userdepart']);       
                $insert_data['empEmergencyContactNumber']       = trim($postData['empEmergencyContactNumber']);
                $insert_data['empEmergencyContactPersonName']   = trim($postData['empEmergencyContactPersonName']);
                $insert_data['empEmergencyContactPersonRelation']= trim($postData['empEmergencyContactPersonRelation']);
                $insert_data['dateOfExit']       				= ($postData['empexitid'] != "") ?date("Y-m-d",strtotime($postData['empexitid'])) : "";
                $insert_data['updatedOn']       				= date("Y-m-d H:i:s");

                $this->common->update('user', array("userID" => $empid), $insert_data);
                $this->status = true;
                $this->message = "HR Info updated successfully";

                if($this->input->post('action') == 'update') {
                	$postData['primary'] = $this->input->post('primary');
                }

                $this->responsedata = array('primary' => $postData['primary'],'emptrivialid' => $postData['empid']);
			} else {
				if(form_error('data[primary]')){                     
				    $this->message = form_error('data[primary]');
				} else if(form_error('data[empid]')){                     
				    $this->message = form_error('data[empid]');
				}  else if(form_error('data[userdesign]')){	
				  	$this->message = form_error('data[userdesign]');
				} else if(form_error('data[userdepart]')){	
				  	$this->message = form_error('data[userdepart]');
				} else if(form_error('data[empEmergencyContactNumber]')){	
				  	$this->message = form_error('data[empEmergencyContactNumber]');
				} else if(form_error('data[empEmergencyContactPersonName]')){	
				  	$this->message = form_error('data[empEmergencyContactPersonName]');
				} else if(form_error('data[empEmergencyContactPersonRelation]')){	
				  	$this->message = form_error('data[empEmergencyContactPersonRelation]');
				} else if(form_error('data[doj]')){	
				  	$this->message = form_error('data[doj]');
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
			if($this->input->post('action') == 'update') {
				$this->form_validation->set_rules('primary', ' Employee Edit Id', 'trim|required');
			} else {
				$this->form_validation->set_rules('data[primary]', ' Employee Edit Id', 'trim|required');  
				$this->form_validation->set_rules('data[empPass]', ' Employee Password', 'trim|required|min_length[6]');
			}
			$this->form_validation->set_rules('data[userType]', ' Employee Type', 'trim|required');
			$this->form_validation->set_rules('data[userStatus]', ' Employee Status', 'trim|required');
			if ($this->form_validation->run() != FALSE) {
				if(!empty($postData['empPass'])){
                	$insert_data['password']        	= password_hash((trim($postData['empPass'])), PASSWORD_DEFAULT);
                }     
                $insert_data['updatedOn']       	= date("Y-m-d H:i:s");
				$insert_data['userType']       		= trim($postData['userType']);
				$insert_data['isActive']       		= ($postData['userStatus'] == 1) ? true : false;

                if($this->input->post('action') == 'update') {
					$empid = encrypt_decrypt('decrypt',$this->input->post('primary'));
				} else{
					$empid = encrypt_decrypt('decrypt',$postData['primary']);
				}
                $this->common->update('user', array("userID" => $empid), $insert_data);
	
				if(!empty($postData['empPass'])){                
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
	                	$message = 'Employee account created. Link has been sent to employee email.';
	                	$this->app->message($message, 'success');
	                	
	                }else{
	                	$message = 'Employee account created but mail not sent to the employee mail.';
	                	$this->app->message($message, 'error');
	                }

            	}
                $this->status = true;
                $this->message = $message;
                $this->message = "Employee Account detail updated successfully.";



			} else {
				if(form_error('data[primary]')){                     
				    $this->message = form_error('data[primary]');
				} else if(form_error('data[empPass]')){                     
				    $this->message = form_error('data[empPass]');
				} else if(form_error('data[userType]')){	
				  	$this->message = form_error('data[userType]');
				} else if(form_error('data[userStatus]')){	
				  	$this->message = form_error('data[userStatus]');
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
			if(!$postData['password']) 
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
	/*
	* emp_leave
	*
	* Used for employee leave.
	*
	* @param 
	* @return
	*/
	function emp_leave(){
		if($this->session->userdata('userType') === '1'){
			$data['page_title']         = SITE_TITLE;
	        $data['page_name']          = "Employee Leave";
	        $data['page_slug']          = 'emp-leave'; 
	        $data['pageCSS']			= array('css/lib/datatables-net/datatables.min.css','css/lib/bootstrap-sweetalert/sweetalert.css');
	        $data['pageJS']				= array('js/lib/daterangepicker/daterangepicker.js','js/lib/bootstrap-select/bootstrap-select.min.js','js/lib/datatables-net/datatables.min.js','js/lib/bootstrap-sweetalert/sweetalert.min.js','js/angular.min.js','js/controller/employee.js');

	        //$data['initJsFunc']	= array("$('#example').DataTable();");
	        $data['initJsFunc']	= array("$('#doj').daterangepicker({singleDatePicker: true,showDropdowns: true});","$('#dob').daterangepicker({singleDatePicker: true,showDropdowns: true});","$('#employeeleavelist').DataTable();");
        	$data['leaves']	    = $this->common->_getCustomeQuery('select epl.*,u.name,u.empId as employeeId,u.designationId,u.departmentId,design.name as desinationName , depart.name as departmentName from employeeLeave epl left join user u on u.userID = epl.empId left join designations design on design.id = u.designationId left join departments depart on depart.id = u.departmentId  ORDER BY epl.leaveId DESC ',1);
	        $this->load->view('admin/common/header.php',$data);  
	        $this->load->view('admin/common/topheader.php',$data);
	        $this->load->view('admin/common/adminsidebarMenu.php',$data);   
	        $this->load->view('admin/emp_leave',$data);        
	        $this->load->view('admin/common/footer.php',$data);

		} else {
			echo ADMIN_ACCESS;
		}
	}
	/*
	* view_leave
	*
	* Used for employee leave view.
	*
	* @param 
	* @return
	*/
	function view_leave(){
		if($this->session->userdata('userType') === '1'){
			//echo $this->uri->segment(3);die;
			$data['page_title']         = SITE_TITLE;
	        $data['page_name']          = "Employee Leave Detail";
	        $data['page_slug']          = 'emp-leave'; 
	        $data['pageCSS']			= array('css/lib/datatables-net/datatables.min.css','css/lib/bootstrap-sweetalert/sweetalert.css');
	        $data['pageJS']				= array('js/lib/daterangepicker/daterangepicker.js','js/lib/bootstrap-select/bootstrap-select.min.js','js/lib/datatables-net/datatables.min.js','js/lib/bootstrap-sweetalert/sweetalert.min.js','js/angular.min.js','js/controller/employee.js');

	        //$data['initJsFunc']	= array("$('#example').DataTable();");
	        $data['initJsFunc']	= array("$('#doj').daterangepicker({singleDatePicker: true,showDropdowns: true});","$('#dob').daterangepicker({singleDatePicker: true,showDropdowns: true});","$('#employeeleavelist').DataTable();");
        	$data['leavedetails']	    = $this->common->_getCustomeQuery('select epl.*,u.name,u.empId as employeeId,u.designationId,u.departmentId,design.name as desinationName , depart.name as departmentName from employeeLeave epl left join user u on u.userID = epl.empId left join designations design on design.id = u.designationId left join departments depart on depart.id = u.departmentId  where epl.leaveId ='.encrypt_decrypt('decrypt',$this->uri->segment(3)),3);
        	//print_r($data['leavedetails']);
	        $this->load->view('admin/common/header.php',$data);  
	        $this->load->view('admin/common/topheader.php',$data);
	        $this->load->view('admin/common/adminsidebarMenu.php',$data);   
	        $this->load->view('admin/view_leave',$data);        
	        $this->load->view('admin/common/footer.php',$data);

		} else {
			echo ADMIN_ACCESS;
		}
	}

	/*
	* changeEmployeeLeaveStatus
	*
	* Used for change employee status.
	*
	* @param 
	* @return
	*/
	function changeEmployeeLeaveStatus(){
		if($this->session->userdata('userType') === '1'){
			$postData = $this->input->post('data');
			//print_r($postData['id']);die;
			if(empty($postData)){
				$this->message = "Invalid Leave Id";
			} else {				
				$leaveid = encrypt_decrypt('decrypt',$postData['id']);				
				$status = ($postData['status'] == 'reject') ? 'denied' : 'approved';
				$isUpdated = $this->common->update('employeeLeave','`leaveid`= '.$leaveid,array('status' => $status ));
				$this->app->message('Employee Leave status changed.', 'success');
				$this->status = true;
			}
			
			echo json_encode(array('status' => $this->status ,'data' =>  $this->responsedata, 'message' => strip_tags($this->message)));
		}
	}
	/*
	* upload_attendence_sheet
	*
	* Used to view attandance sheet 
	*
	* @param 
	* @return
	*/
	function upload_attendence_sheet(){
		if($this->session->userdata('userType') === '1'){
			//echo $this->uri->segment(3);die;
			$data['page_title']         = SITE_TITLE;
	        $data['page_name']          = "Upload Employee Attandance";
	        $data['page_slug']          = 'attandance'; 
	        $data['pageJS']				= array('js/angular.min.js','js/controller/attandance.js');
	        $this->load->view('admin/common/header.php',$data);  
	        $this->load->view('admin/common/topheader.php',$data);
	        $this->load->view('admin/common/adminsidebarMenu.php',$data);   
	        $this->load->view('admin/upload_attendence_sheet',$data);        
	        $this->load->view('admin/common/footer.php',$data);

		} else {
			echo ADMIN_ACCESS;
		}
	}
	/*
	* updloadattandancefile
	*
	* Used to upload attandance sheet
	*
	* @param 
	* @return
	*/
	function updloadattandancefile(){
		if($this->session->userdata('userType') === '1'){
			//print_r($_FILES);
			if($_FILES['file']['type'] == "text/csv" && !empty($_FILES)){
				$filename=$_FILES["file"]["tmp_name"];
				$file = fopen($filename, "r");
				
				if(!empty($this->input->post('monthYear'))){
					while (($importdata = fgetcsv($file, 10000, ",")) !== FALSE)
					{					
						if($importdata[0] != "emp_code" && $importdata[0] != "" && $importdata[1] != "in_time" && $importdata[1] != "" && $importdata[2] != "out_time" && $importdata[2] != ""  ){
							$inTime = date("Y-m-d H:i:s", strtotime($importdata[1]));
							$outTime = date("Y-m-d H:i:s", strtotime($importdata[2]));
							if( date("Y-m-d", strtotime($inTime))  != "1970-01-01" && date("Y-m-d", strtotime($outTime))  != "1970-01-01" ) {
								$insertdata = array(
									'empCode' 		=> 	$importdata[0],
									'inTime' 		=>	$inTime,
									'outTime' 		=> 	$outTime,
									'yearMonth'		=>  date("Y-d-m",strtotime("01/".$this->input->post('monthYear'))),
									'createdAt'		=>  date("Y-m-d H:i:s")
					        	);
					        	// check if already exist
					        	$getRow = $this->common->_getRow('empAttandance', ' empCode ="'.$importdata[0].'" AND inTime = "'.$inTime.'" AND outTime="'.$outTime.'"  ');
					        	if(empty($getRow)){
					        		$userID = $this->common->insert('empAttandance',$insertdata);
					        	} 
					        	$status = true;
					        	$message = "Attandance uploded successfully"; 
					    	}  else{
								$message = "Invalid Date format. Please provided date format in Y-m-d H:i:s.";   		
					    	}
						}
					}
				} else {
					$message = "Please select the year and month field.";
				}                
				fclose($file);
				$this->status = ($status == true) ? true : false;
				$this->message = $message;

			} else {
				$this->message = "Please upload the csv format";
			}
			echo json_encode(array('status' => $this->status ,'data' =>  $this->responsedata, 'message' => strip_tags($this->message)));
		} else {
			echo ADMIN_ACCESS;
		}
	}
	/*
	* getAllEmployeeAttendance
	*
	* Used get All Employee Attendance
	*
	* @param 
	* @return
	*/
	function getAllEmployeeAttendance(){
		if($this->session->userdata('userType') === '1'){
			//print_r($this->session->userdata());
			if($this->input->post('inputyear')){
				$monthYear = $this->input->post('inputyear');
			} else {
				$monthYear = date("Y-m");
			}
			$data['page_title']         = SITE_TITLE;
	        $data['page_name']          = "All Employee Attandance";
	        $data['page_slug']          = 'attandance';
	        $data['pageCSS']			= array('css/lib/datatables-net/datatables.min.css');
	        
	        $data['pageJS']				= array('js/lib/datatables-net/datatables.min.js','js/lib/bootstrap-select/bootstrap-select.min.js','js/angular.min.js','js/controller/attandance.js','js/datatabledata.js');
	        $data['initJsFunc']	= array("$('#employeeattandancelist').DataTable();","$('.attendancemonthYear').datetimepicker({
		viewMode: 'years',  format: 'MM/YYYY'});");
	        $data['getAttandance']		= $this->common->_getCustomeQuery('SELECT * from EMPLOYEE_ATTANDANCE  where `yearMonth` like "'.$monthYear.'%" ',1);
			//print_r($data['getAttandance']);
	        $this->load->view('admin/common/header.php',$data);  
	        $this->load->view('admin/common/topheader.php',$data);
	        $this->load->view('admin/common/adminsidebarMenu.php',$data);   
	        $this->load->view('admin/allEmployeeAttendance',$data);        
	        $this->load->view('admin/common/footer.php',$data);

		} else {
			echo ADMIN_ACCESS;
		}
	}
	function getAttandanceData()
	{
		if($_REQUEST['monthyear'] != ""){
			$explode_year_month = explode('/',$_REQUEST['monthyear']);
			//print_r($explode_year_month);
			$createdate = $explode_year_month[1]."-".$explode_year_month[0]."-"."01";
			$monthYear = date("Y-m",strtotime($createdate));
		} else {
			$monthYear = date("Y-m");
		}
		$aColumns = array( 'empCode','name', 'inTime', 'outTime','working_hours_min','status', 'remarks');
		$sIndexColumn = "id";
		$sTable = "EMPLOYEE_ATTANDANCE";
		/*
     	* Paging
     	*/

    	$sLimit = "";

	    if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	    {
	        $sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
	            intval( $_GET['iDisplayLength'] );
	    }

	    /*
	    * Ordering
	    */
	    $sOrder = "";
	    if ( isset( $_GET['iSortCol_0'] ) )
	    {
	        $sOrder = "ORDER BY  ";
	        for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
	        {

	            if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
	           	{

	                $sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
	                    ".($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
	            }
	        }          

	        $sOrder = substr_replace( $sOrder, "", -2 );

	        if ( $sOrder == "ORDER BY" )
	        {
	            $sOrder = "";
	        }
	    }

	    /*
     	* Filtering
     	*/

    	$sWhere = "";
	   	if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
	    {
	        $sWhere = "WHERE (";

	        for ( $i=0 ; $i<count($aColumns) ; $i++ )
	        {
	            if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
	            {
	                $sWhere .= $aColumns[$i]." LIKE '%".$_GET['sSearch']."%' OR ";
	            }
	        }
	        $sWhere = substr_replace( $sWhere, "", -3 );
	        $sWhere .= ')';
	    }      


	    /*$sWhere = "WHERE ";
	    $sWhere .= ' `yearMonth` like "'.$monthYear.'%" ';*/

	    /* Individual column filtering */

	    /*for ( $i=0 ; $i<count($aColumns) ; $i++ )
	    {

	        if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
	        {
	            if ( $sWhere == "" )
	            {
	                $sWhere = "WHERE ";
	            }
	            else
	            {
	                $sWhere .= " AND ";
	            }
	            $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
	        }
	        	
	    }*/

	    if ( $sWhere == "" )
        {
            $sWhere = "WHERE ";
        }
        else
        {
            $sWhere .= " AND ";
        }

	    $sWhere .= '  `yearMonth` like "'.$monthYear.'%" ';

	    $sQuery = " SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."  FROM   $sTable        $sWhere $sOrder $sLimit ";

	    $rResult =  $this->common->_getCustomeQuery($sQuery,1);
	    //print_r($rResult);die;

	    /* Data set length after filtering */
		$sQuery = " SELECT FOUND_ROWS() as found_rows";

		$rResultFilterTotal = $this->common->_getCustomeQuery($sQuery,3);
		//print_r($rResultFilterTotal['found_rows']);
		$aResultFilterTotal = $rResultFilterTotal['found_rows'];
    	$iFilteredTotal = $aResultFilterTotal;

    	/* Total data set length */
    	$sQuery = " SELECT COUNT(".$sIndexColumn.") as totalcounts FROM   $sTable ";
    	$rResultTotal = $this->common->_getCustomeQuery($sQuery,3);
    	//print_r($rResultTotal);
    	$aResultTotal = $rResultTotal['totalcounts'];
    	$iTotal = $aResultTotal;

    	/*
     	* Output
     	*/
    	/*
    	$output = array(
      		"sEcho" => intval($_GET['sEcho']),
      		"iTotalRecords" => $iTotal,
        	"iTotalDisplayRecords" => $iFilteredTotal,
        	"aaData" => array()
    	);
    	*/
    	//print_r($rResult);die;
    	$queryData = array();
    	foreach ($rResult as $rkey => $rvalue) {

    		$row = array();      
    		foreach ($aColumns as $ckey => $cvalue) {    
    		    
		        if ( $cvalue != ' ' )   
		        { 
		           $row[] = $rvalue[ $cvalue ];    
		        }
		    }   
		    
		    $queryData[] = $row; 

		}
		$output['aaData'] = $queryData;
		$output['iTotalRecords'] = $iTotal; 
		$output['iTotalDisplayRecords'] = $iFilteredTotal; 
		$output['sEcho'] = intval($_GET['sEcho']); 
	   	echo json_encode( $output );
	}
}
?>