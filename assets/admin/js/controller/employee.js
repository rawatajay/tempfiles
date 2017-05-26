// define application
var app = angular.module('TrivialPMS', []);

// create factory 
app.factory('serverResponseMessages', function(){
	return {
		// function to display success message
		messageSuccess : function(msg) {
			$('.alert-success > p').html(msg);
		    $('.alert-success').show();
		    $('.alert-success').delay(2000).slideUp(function(){
		    $('.alert-success > p').html('');
		    });
		},// function to display error message
		messageError : function(msg) {
			$('.alert-danger  > p').html(msg);
		    $('.alert-danger').show();
		    $('.alert-danger').delay(2000).slideUp(function(){
		    $('.alert-danger > p').html('');
		    });
		}
	};
});



app.filter("ucwords", function () {
    return function (input){
        input = input.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });
        return input; 
    }    
})

// controller to add employee
app.controller("empAddController", function($scope,$http, serverResponseMessages){
	$scope.tempEmpData = {};
	// function to insert employee data	
	
	$scope.departments = [];
	$scope.employeeTypes = [];
	$scope.designations = [];
	$scope.EmployeeData = [];
	$scope.genders = [
		    { 'id': 1, 'value' : 'Male' },
		    { 'id': 2, 'value' : 'Female' },
		    ];
	$scope.employeeStatus =[
			{ 'id': 1, 'value' : 'Active'},
			{ 'id': 0, 'value' : 'Inactive'},
			];
    // function to get records from the database
    $scope.getRecords = function(){
        $http.get(SITEBASEURL+'admin/getEmpdataForAccountCreatePage', {
        }).then(function(response) {        	
			if(response.status === 200){
				$scope.designations = response.data.data.designations;
				$scope.departments = response.data.data.departments;
				$scope.employeeTypes = response.data.data.userTypes;
				$scope.employeeData = response.data.data.EmployeeData;
			} else {
				serverResponseMessages.messageError('Connection Error !!');
			}
		});

		// get employee data
		var url = $(location).attr('href');
		var getPrimary = url.split('/').reverse()[0];
		var data = $.param({
			'data' : getPrimary
		});

		var config = {
			headers : {
				'Content-Type' : 'application/x-www-form-urlencoded;charset=utf-8;'
			}
		};

		$http.post(SITEBASEURL+"admin/getEmpdata", data, config).then(function(response) {
			$(".signup-personal-btn").prop("disabled",false);
			if(response.status === 200){
				if(response.data.status === false){
					serverResponseMessages.messageError(response.data.message);	
				} else{				
					$scope.tempEmpData.empname = response.data.data.empdata.name;
					$scope.tempEmpData.empfathername = response.data.data.empdata.fathername;
					$scope.tempEmpData.email = response.data.data.empdata.email;
					$scope.tempEmpData.gender = response.data.data.empdata.gender;
					$scope.tempEmpData.address = response.data.data.empdata.address;
					$scope.tempEmpData.dob = response.data.data.empdata.dateOfBirth;
					$scope.tempEmpData.doj = response.data.data.empdata.dateOfJoining;
					$scope.tempEmpData.contact = response.data.data.empdata.contact;
					$scope.tempEmpData.empid = response.data.data.empdata.empId;
					$scope.tempEmpData.userType = response.data.data.empdata.userType;
					$scope.tempEmpData.userdesign = response.data.data.empdata.designationId;
					$scope.tempEmpData.userdepart = response.data.data.empdata.departmentId;
					$scope.tempEmpData.empEmergencyContactNumber = response.data.data.empdata.empEmergencyContactNumber;
					$scope.tempEmpData.empEmergencyContactPersonName = response.data.data.empdata.empEmergencyContactPersonName;
					$scope.tempEmpData.empEmergencyContactPersonRelation = response.data.data.empdata.empEmergencyContactPersonRelation;
					$scope.tempEmpData.empTrivialId = response.data.data.empdata.empId;
					$scope.tempEmpData.isActive = response.data.data.empdata.isActive;
					$scope.tempEmpData.empexitid = response.data.data.empdata.dateOfExit;
					$scope.tempEmpData.userStatus = response.data.data.empdata.isActive;
				}
			} else {
				serverResponseMessages.messageError('Connection Error !!');
			}
		});
		
    };



	$scope.saveEmployee = function(action){
		$(".signup-personal-btn").prop("disabled",true);
		var primary = "";
		if(action == "update"){
			var url = $(location).attr('href');
			primary = url.split('/').reverse()[0];
		}
		var data = $.param({
			'data' 		: $scope.tempEmpData,
			'action' 	: action,
			'primary' 	: primary
 		});

		var config = {
			headers : {
				'Content-Type' : 'application/x-www-form-urlencoded;charset=utf-8;'
			}
		};
		
		$http.post(SITEBASEURL+"admin/addEmpdata", data, config).then(function(response) {
			$(".signup-personal-btn").prop("disabled",false);
			if(response.status === 200){
				if(response.data.status === false){
					serverResponseMessages.messageError(response.data.message);	
				} else{					
					serverResponseMessages.messageSuccess(response.data.message);	
					if(action == 'save') {
						$scope.tempEmpData = {};
						setTimeout(function(){
							$(".personalinfotab").removeClass("active");
							$(".personalinfotab").attr("data-toggle","");
							$(".hrinfotab").addClass("active");
							$("#tabs-1-tab-1").removeClass("active in");
							$("#tabs-1-tab-2").addClass("active in");						
							$("#tabs-1-tab-1").html("");
						},1000);
						
						$scope.tempEmpData.primary = response.data.data.primary;
						window.onbeforeunload = function() {
				        	return "Are you sure you want to leave from this page ? ";
				    	}
				    }
				}
			} else {
				serverResponseMessages.messageError('Connection Error !!');
			}
		});
	}

	// function to set hr info
	$scope.updateHrInfo = function(action) {
		$(".signup-hrinfo-btn").prop('disabled',true);
		var primary = "";
		if(action == "update"){
			var url = $(location).attr('href');
			primary = url.split('/').reverse()[0];
		}
		var data = $.param({
			data : $scope.tempEmpData,
			'action' 	: action,
			'primary' 	: primary
		})

		var config = {
			headers : {
				'Content-Type' : 'application/x-www-form-urlencoded;charset=utf=8'
			}
		}
		//console.log($scope);
		//return false;
		$http.post(SITEBASEURL+'admin/updatehrinfo',data,config).then(function(response){
			$(".signup-hrinfo-btn").prop("disabled",false);
			if(response.status === 200){
				if(response.data.status === false){
					serverResponseMessages.messageError(response.data.message);	
				} else{
					serverResponseMessages.messageSuccess(response.data.message);	
					if(action == 'save') {
						$scope.tempEmpData = {};
						setTimeout(function(){
							$(".hrinfotab").removeClass("active");
							$(".hrinfotab").attr("data-toggle","");
							$(".accountinfotab").addClass("active");
							$("#tabs-1-tab-2").removeClass("active in");
							$("#tabs-1-tab-3").addClass("active in");						
							$("#tabs-1-tab-2").html("");
						},1500);					
						$scope.tempEmpData.primary = response.data.data.primary;
						$scope.tempEmpData.empTrivialId = response.data.data.emptrivialid;
						window.onbeforeunload = function() {
				        	return "Are you sure you want to leave from this page ? ";
				    	}
			    	}
				}
			} else {
				serverResponseMessages.messageError('Connection Error !!');
			}
		});
	}
	// function to update account info.
	$scope.updateAccountInfo = function(action) {
		var primary = "";
		if(action == "update"){
			var url = $(location).attr('href');
			primary = url.split('/').reverse()[0];
		}
		$(".signup-accinfo-btn").prop('disabled',true);
		var data = $.param({
			data : $scope.tempEmpData,
			'action' 	: action,
			'primary' 	: primary
		})

		var config = {
			headers : {
				'Content-Type' : 'application/x-www-form-urlencoded;charset=utf=8'
			}
		}

		$http.post(SITEBASEURL+'admin/updateAccountInfo',data,config).then(function(response){
			$(".signup-accinfo-btn").prop("disabled",false);
			if(response.status === 200){
				if(response.data.status === false){
					serverResponseMessages.messageError(response.data.message);	
				} else{
					serverResponseMessages.messageSuccess(response.data.message);
					$scope.tempEmpData.empPass = "";
					if(action == 'save') {	
						window.onbeforeunload = function () {}
						setTimeout(function(){
							window.location.href=SITEBASEURL+'admin/employee_list';
						},1000);
					}
					
				}
			} else {
				serverResponseMessages.messageError('Connection Error !!');
			}
		});
	}

	
});
app.controller('LeaveController',function($scope,$http, serverResponseMessages){
	$scope.leaveTypes = [
	    { 'id': 1, 'value' : 'Casual Leave' },
	    { 'id': 2, 'value' : 'Medical Leave' },
	    { 'id': 3, 'value' : 'Earned Leave' },
    ];
    $scope.tempEmpData = {};
	$scope.leavedata = [];
	// function to insert employee data	
	

    $scope.applyleave = function (action){
    	$(".applyleave-btn").prop("disabled",false);
    	var primary = "";
		if(action == "update"){
			var url = $(location).attr('href');
			primary = url.split('/').reverse()[0];
		}
		var data = $.param({
			'data' 		: $scope.tempEmpData,
			'action' 	: action,
			'primary' 	: primary
 		});

		var config = {
			headers : {
				'Content-Type' : 'application/x-www-form-urlencoded;charset=utf-8;'
			}
		};

		$http.post(SITEBASEURL+'employee/addleaveRecord',data,config).then(function(response){
			$(".applyleave-btn").prop("disabled",false);
			if(response.status === 200){
				if(response.data.status === false){
					serverResponseMessages.messageError(response.data.message);	
				} else{
					serverResponseMessages.messageSuccess(response.data.message);
					setTimeout(function(){
						window.location.href=SITEBASEURL+'employee/my_leave';
					},1000)
				}
			} else {
				serverResponseMessages.messageError('Connection Error !!');
			}
		});
    }

    // get leave data
    $scope.getleavedata = function(){

    	var url = $(location).attr('href');
		var getPrimary = url.split('/').reverse()[0];
		var data = $.param({
			'data' : getPrimary
		});

		var config = {
			headers : {
				'Content-Type' : 'application/x-www-form-urlencoded;charset=utf-8;'
			}
		};

		$http.post(SITEBASEURL+"employee/getLeaveData", data, config).then(function(response) {
			$(".signup-personal-btn").prop("disabled",false);
			if(response.status === 200){
				if(response.data.status === false){
					serverResponseMessages.messageError(response.data.message);	
				} else{				
					$scope.tempEmpData.leavestartdate = response.data.data.empdata.startDate;
					$scope.tempEmpData.leaveenddate = response.data.data.empdata.endDate;
					$scope.tempEmpData.leaveTypes = response.data.data.empdata.leaveType;
					$scope.tempEmpData.emergencyContactNumber = response.data.data.empdata.emergencyContactNumber;
					$scope.tempEmpData.reason = response.data.data.empdata.reason;					
				}
			} else {
				serverResponseMessages.messageError('Connection Error !!');
			}
		});
    }
});


app.controller('StatusleaveController',function($scope,$http, serverResponseMessages){
	
   
	// function to insert employee data	
	

    $scope.changeStatusEmployee = function(status,primary) {
				swal({
				title: "Are you sure?",
				text: "You want to change the employee status!",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, change it!",
				cancelButtonText: "No, cancel plz!",
				closeOnConfirm: false,
				closeOnCancel: false
			},
			function(isConfirm) {
				if (isConfirm) {
					var data = $.param({
						'data' : {'id' : primary , 'status' : status}
					});
					var config = {
						headers : {
							'Content-Type' : 'application/x-www-form-urlencoded;charset=utf-8;'
						}
					};				
					$http.post(SITEBASEURL+"admin/changeEmployeeLeaveStatus", data, config).then(function(response) {
						//console.log(response.data);
						if(response.status === 200){
							if(response.data.status === false){
								serverResponseMessages.messageError(response.data.message);	
							} else{
								setTimeout(function(){
								   location.reload();
								}, 1000);
								
							}
						} else {
							serverResponseMessages.messageError('Connection Error !!');
						}
					});
					swal({
						title: "Changed!",
						text: "Emlployee status has been changed.",
						type: "success",
						confirmButtonClass: "btn-success"
					});
				} else {
					swal({
						title: "Cancelled",
						text: "",
						type: "error",
						confirmButtonClass: "btn-danger"
					});
				}
			});
		//});
	}
});