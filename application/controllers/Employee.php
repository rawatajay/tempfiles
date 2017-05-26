<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Employee
* 
* 
* @package    	CI
* @subpackage 	LMS
* @category 	Employee Controller
* @author 	  	TrivialWorks*
*/
class Employee extends CI_Controller{
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
		if(empty($this->session->all_userdata('userId')) || $this->session->userdata('userType') == '1'){
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
	* Used for dispalying the  dashboard.
	*
	* @param 
	* @return
	*/
	function index(){
		if($this->session->userdata('userType') != '1' && $this->session->userdata('userID') != ""){
			$data['page_title']         = SITE_TITLE;
	        $data['page_name']          = "Dashboard";
	        $data['page_slug']          = 'dashboard'; 
	        $this->load->view('admin/common/header.php',$data);  
	        $this->load->view('admin/common/topheader.php',$data);
	        $this->load->view('admin/common/sidebarMenu.php',$data);   
	        $this->load->view('admin/dashboard',$data);        
	        $this->load->view('admin/common/footer.php',$data);
        } else {
			echo ACCESS_DENIED;
		}
	}
	/*
	* leave_apply
	*
	* Used for leave apply.
	*
	* @param 
	* @return
	*/
	function leave_apply(){	
		if($this->session->userdata('userType') != '1' && $this->session->userdata('userID') != ""){
			$data['page_title']         = SITE_TITLE;
	        $data['page_name']          = "Leave Apply";
	        $data['page_slug']          = 'leave-apply'; 
	        $data['pageCSS']			= array('css/lib/clockpicker/bootstrap-clockpicker.min.css');
	        $data['pageJS']				= array('js/lib/daterangepicker/daterangepicker.js','js/lib/bootstrap-select/bootstrap-select.min.js','js/angular.min.js','js/controller/employee.js');

	        $data['initJsFunc']	= array("$('#leavestartdate').daterangepicker({singleDatePicker: true,showDropdowns: true,minDate: '".date('m/d/Y')."'});","$('#leaveenddate').daterangepicker({singleDatePicker: true,showDropdowns: true,minDate: '".date('m/d/Y')."'});");
	        $this->load->view('admin/common/header.php',$data);  
	        $this->load->view('admin/common/topheader.php',$data);
	        $this->load->view('admin/common/sidebarMenu.php',$data);   
	        $this->load->view('admin/employee/leave_apply',$data);        
	        $this->load->view('admin/common/footer.php',$data);

		} else {
			echo ACCESS_DENIED;
		}
	}
	/*
	* leave_apply
	*
	* Used for save leave apply.
	*
	* @param 
	* @return
	*/
	function addleaveRecord(){
		//print_r($this->input->post());die;
		if($this->session->userdata('userType') != '1' && $this->session->userdata('userID') != ""){
			$postData = $this->input->post('data');
			$action = $this->input->post('action');
			
			$this->form_validation->set_rules('data[leavestartdate]', ' Leave Start Date', 'trim|required');  
			$this->form_validation->set_rules('data[leaveenddate]', ' Leave End Date', 'trim|required');
			$this->form_validation->set_rules('data[leaveTypes]', ' Leave Type', 'trim|required');
			$this->form_validation->set_rules('data[emergencyContactNumber]', ' Emergency Contact ', 'trim|required|numeric');
			$this->form_validation->set_rules('data[reason]', ' Reason', 'trim|required');
			//die;
			if ($this->form_validation->run() != FALSE) {
				if(!empty($this->session->userdata('userID'))){
										
						$insert_data['empId']            		= trim($this->session->userdata('userID'));
		                $insert_data['startDate']           	= date("Y-m-d",strtotime($postData['leavestartdate']));
		                $insert_data['endDate']       			= date("Y-m-d",strtotime($postData['leaveenddate']));
		                $insert_data['emergencyContactNumber']  = trim($postData['emergencyContactNumber']);       
		                $insert_data['reason']        			= trim($postData['reason']);       
		                $insert_data['status']        			= 'pending';
		                $insert_data['leaveType']        		= trim($postData['leaveTypes']);
		                if($action == 'update') {
		                	$insert_data['updatedOn']       		= date("Y-m-d H:i:s");
		                } else {
		                	$insert_data['createdOn']       		= date("Y-m-d H:i:s");
		            	}
		                     	
		                                
		                if($action == 'save'){
		                	//echo "sdfsf";
		                	$checkleavestatus   = $this->common->_getCustomeQuery('SELECT * FROM `employeeLeave` where empId = '.$this->session->userdata('userID').' and ((startDate <= "'.date("Y-m-d",strtotime($postData['leavestartdate'])).'" AND endDate >= "'.date("Y-m-d",strtotime($postData['leavestartdate'])).'") OR (startDate <= "'.date("Y-m-d",strtotime($postData['leaveenddate'])).'" AND endDate >= "'.date("Y-m-d",strtotime($postData['leaveenddate'])).'") )',1);
					
							if(empty($checkleavestatus)) {	
			                	$insertedID = $this->common->insert('employeeLeave',$insert_data);
			                	$this->app->message('Leave applied successfully.', 'success');
			                	$this->status = true;
			                	$this->message = "Leave applied successfully.";
			               	} else {
	            				$this->message = "Sorry!!. You cannot apply for the leave in which the date you had already applied.";
	            			}
		            	} else  if ($action == 'update'){
			            	$leaveid = encrypt_decrypt('decrypt',$this->input->post('primary'));
		            		$isPending  = $this->common->_getCustomeQuery('select * from employeeLeave where leaveId = '.$leaveid,3);	            		
		            		if($isPending['status'] == "pending") {
			            		$this->common->update('employeeLeave', array("leaveId" => $leaveid), $insert_data);
			            		$this->app->message('Leave details updated successfully.', 'success');
			            		$this->status = true;
			            		$this->message = "Leave details updated successfully.";
			            	} else {
			            		$this->message = "Sorry!!. Only pending leave can be updated.";
			            	}
		            	}
	            	
	                
	            } else{
	            	$this->message = "Invalid Employee.";
	            }

			} else {
				if(form_error('data[leavestartdate]')){                     
				    $this->message = form_error('data[leavestartdate]');
				} else if(form_error('data[leaveenddate]')){	
				  	$this->message = form_error('data[leaveenddate]');
				} else if(form_error('data[leaveTypes]')){	
				  	$this->message = form_error('data[leaveTypes]');
				} else if(form_error('data[emergencyContactNumber]')){	
				  	$this->message = form_error('data[emergencyContactNumber]');
				} else if(form_error('data[reason]')){	
				  	$this->message = form_error('data[reason]');
				} 
			
			}
			echo json_encode(array('status' => $this->status ,'data' =>  $this->responsedata, 'message' => strip_tags($this->message)));
		}
	}
	/*
	* my_leave
	*
	* Used for  leave apply list.
	*
	* @param 
	* @return
	*/
	function my_leave(){
		if($this->session->userdata('userType') != '1' && $this->session->userdata('userID') != ""){
			$data['page_title']         = SITE_TITLE;
	        $data['page_name']          = "My Leave";
	        $data['page_slug']          = 'leave-apply'; 
	        $data['pageCSS']			= array('css/lib/datatables-net/datatables.min.css','css/lib/bootstrap-sweetalert/sweetalert.css');
	        $data['pageJS']				= array('js/lib/daterangepicker/daterangepicker.js','js/lib/bootstrap-select/bootstrap-select.min.js','js/lib/datatables-net/datatables.min.js','js/lib/bootstrap-sweetalert/sweetalert.min.js','js/angular.min.js','js/controller/employee.js');

	        //$data['initJsFunc']	= array("$('#example').DataTable();");
	        $data['initJsFunc']	= array("$('#doj').daterangepicker({singleDatePicker: true,showDropdowns: true});","$('#dob').daterangepicker({singleDatePicker: true,showDropdowns: true});","$('#myleavelist').DataTable();");
        	$data['leaves']	    = $this->common->_getCustomeQuery('select epl.*,u.name,u.empId as employeeId,u.designationId,u.departmentId,design.name as desinationName , depart.name as departmentName from employeeLeave epl left join user u on u.userID = epl.empId left join designations design on design.id = u.designationId left join departments depart on depart.id = u.departmentId  where epl.empId = '.$this->session->userdata('userID').' ORDER BY epl.leaveId DESC ',1);

	        $this->load->view('admin/common/header.php',$data);  
	        $this->load->view('admin/common/topheader.php',$data);
	        $this->load->view('admin/common/sidebarMenu.php',$data);  
	        $this->load->view('admin/employee/my_leave',$data);        
	        $this->load->view('admin/common/footer.php',$data);

		} else {
			echo ACCESS_DENIED;
		}
	}
	/*
	* edit_leave
	*
	* Used for edit leave apply .
	*
	* @param 
	* @return
	*/
	function edit_leave(){
		if($this->session->userdata('userType') != '1' && $this->session->userdata('userID') != ""){
			$data['page_title']         = SITE_TITLE;
	        $data['page_name']          = "Leave Apply";
	        $data['page_slug']          = 'leave-apply'; 
	        $data['pageCSS']			= array('css/lib/clockpicker/bootstrap-clockpicker.min.css');
	        $data['pageJS']				= array('js/lib/daterangepicker/daterangepicker.js','js/lib/bootstrap-select/bootstrap-select.min.js','js/angular.min.js','js/controller/employee.js');

	        $data['initJsFunc']	= array("$('#leavestartdate').daterangepicker({singleDatePicker: true,showDropdowns: true,minDate: '".date('m/d/Y')."'});","$('#leaveenddate').daterangepicker({singleDatePicker: true,showDropdowns: true,minDate: '".date('m/d/Y')."'});");
	        $this->load->view('admin/common/header.php',$data);  
	        $this->load->view('admin/common/topheader.php',$data);
	        $this->load->view('admin/common/sidebarMenu.php',$data);   
	        $this->load->view('admin/employee/edit_leave',$data);        
	        $this->load->view('admin/common/footer.php',$data);

		} else {
			echo ACCESS_DENIED;
		}
	}
	/*
	* getLeaveData
	*
	* Used for get leave data .
	*
	* @param 
	* @return
	*/
	function getLeaveData(){
		$postData = $this->input->post('data');
        $data['empdata']= $this->common->_getRow('employeeLeave', array('leaveId' => encrypt_decrypt('decrypt',$postData)));
        
		echo json_encode(array('status' => TRUE ,'data' =>  $data, 'message' => ""));
	}
	/*
	* getMyAttendance
	*
	* Used get My Attendance
	*
	* @param 
	* @return
	*/
	function getMyAttendance(){
		if($this->session->userdata('userType') != '1' && $this->session->userdata('userID') != ""){
			//print_r($this->session->userdata());
			if($this->input->post('inputyear')){
				$monthYear = $this->input->post('inputyear');
			} else {
				$monthYear = date("Y-m");
			}
			$data['page_title']         = SITE_TITLE;
	        $data['page_name']          = "My Attandance";
	        $data['page_slug']          = 'attandance';
	        $data['pageCSS']			= array('css/lib/datatables-net/datatables.min.css');
	        
	        $data['pageJS']				= array('js/lib/datatables-net/datatables.min.js','js/lib/bootstrap-select/bootstrap-select.min.js','js/angular.min.js','js/controller/attandance.js','js/datatabledata.js');
	        $data['initJsFunc']	= array("$('#employeeattandancelist').DataTable();","$('.attendancemonthYear').datetimepicker({
		viewMode: 'years',  format: 'MM/YYYY'});");
	        //$data['getAttandance']		= $this->common->_getCustomeQuery('SELECT * from EMPLOYEE_ATTANDANCE  where `yearMonth` like "'.$monthYear.'%" ',1);
			//print_r($data['getAttandance']);
	        $this->load->view('admin/common/header.php',$data);  
	        $this->load->view('admin/common/topheader.php',$data);
	        $this->load->view('admin/common/sidebarMenu.php',$data);   
	        $this->load->view('admin/employee/my_attandance',$data);        
	        $this->load->view('admin/common/footer.php',$data);

		} else {
			echo ACCESS_DENIED;
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

	    if ( $sWhere == "" )
        {
            $sWhere = "WHERE ";
        }
        else
        {
            $sWhere .= " AND ";
        }

	    $sWhere .= '  `yearMonth` like "'.$monthYear.'%" AND empCode ="'.$this->session->userdata('empId').'"';

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