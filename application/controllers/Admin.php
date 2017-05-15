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
	* Used for dispalying the admin login.
	*
	* @param 
	* @return
	*/
	function register_employee(){	
		if($this->session->userdata('userType') === '1'){
			$data['page_title']         = SITE_TITLE;
	        $data['page_name']          = "Register Employee";
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
			$this->form_validation->set_rules('data[contact]', ' Contact ', 'trim|required');
			$this->form_validation->set_rules('data[address]', ' Address', 'trim|required');
			$this->form_validation->set_rules('data[dob]', ' Date Of Birth ', 'trim|required'); 
			$this->form_validation->set_rules('data[doj]', ' Date Of Joining', 'trim|required');

			$this->form_validation->set_message('is_unique',' %s already exists.');
			if ($this->form_validation->run() != FALSE) {
				//print_r(print_r($postData));die;
				$insert_data['email']            	= trim($postData['email']);                
                $insert_data['gender']           	= trim($postData['gender']);
                //$insert_data['password']        	= password_hash((trim($postData['password'])), PASSWORD_DEFAULT);
                $insert_data['dateOfJoining']       = date("Y-m-d",strtotime($postData['doj']));       
                $insert_data['name']        		= trim($postData['empname']);       
                $insert_data['fathername']        	= trim($postData['empfathername']);       
                $insert_data['contact']        		= trim($postData['contact']);
                $insert_data['address']        		= trim($postData['address']);
                $insert_data['createdOn']       	= date("Y-m-d H:i:s");
                $insert_data['dateOfBirth']        	= date("Y-m-d",strtotime($postData['dob'])); 
                $insert_data['isAccountCreated']    = false;                 
                
                $insertId = $this->common->insert('user',$insert_data);

                if($insertId > 0) {
                	$this->common->update('user', array("userID" => $insertId), array("empId" => "EMP0".$insertId));
                }
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
	        $data['pageJS']				= array('js/angular.min.js','js/controller/employee.js');
        	$data['userTypes']	= $this->common->_getList('userType','status=1','orderNo ASC');
        	$data['users']	    = $this->common->_getList('user','isAccountCreated=0','empId ASC');
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
	        $data['pageCSS']			= array('css/lib/datatables-net/datatables.min.css');
	        $data['pageJS']				= array('js/lib/daterangepicker/daterangepicker.js','js/lib/bootstrap-select/bootstrap-select.min.js','js/lib/datatables-net/datatables.min.js','js/angular.min.js','js/controller/employee.js');

	        //$data['initJsFunc']	= array("$('#example').DataTable();");
	        $data['initJsFunc']	= array("$('#doj').daterangepicker({singleDatePicker: true,showDropdowns: true});","$('#dob').daterangepicker({singleDatePicker: true,showDropdowns: true});");
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
	function getEmpData(){
		if($this->session->userdata('userType') === '1'){
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
                $insert_data['isAccountCreated']    = false;                 
                
                $this->common->update('user', array("userID" => $empid), $insert_data);
                $this->status = true;
                echo $this->app->message('Emplyee details update successfully.','success');

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
}

?>