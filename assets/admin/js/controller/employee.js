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
		},
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
	$scope.saveEmployee = function(){
		//console.log($scope);
		var data = $.param({
			'data' : $scope.tempEmpData
		});

		var config = {
			headers : {
				'Content-Type' : 'application/x-www-form-urlencoded;charset=utf-8;'
			}
		};

		
		$http.post("addEmpdata", data, config).then(function(response) {
			//console.log(response.data);
			if(response.status === 200){
				if(response.data.status === false){
					serverResponseMessages.messageError(response.data.message);	
				} else{
					window.location.href = 'employee_list';
				}
			} else {
				serverResponseMessages.messageError('Connection Error !!');
			}
		});
	}
});
// controller to add employee
app.controller("empAccountController", function($scope,$http,serverResponseMessages){
	$scope.employees = [];
	$scope.employeeTypes = [];
    // function to get records from the database
    $scope.getRecords = function(){
        $http.get('getEmpdataForAccountCreatePage', {
        }).then(function(response) {
			if(response.status === 200){
				$scope.employees = response.data.data.users;
				$scope.employeeTypes = response.data.data.userTypes;
			} else {
				serverResponseMessages.messageError('Connection Error !!');
			}
		});
    };
    $scope.getEmpID = function(){
    	var selectedEmp = $scope.employees.filter(function(item) {
  			return item.userID === $scope.tempEmpData.userID;
		})[0];
		$scope.tempEmpData.empId = (selectedEmp)?selectedEmp.empId:'';
    };
    $scope.createAccount=  function () {
    	var data = $.param({
		'data' : $scope.tempEmpData
		});

		var config = {
			headers : {
				'Content-Type' : 'application/x-www-form-urlencoded;charset=utf-8;'
			}
		};

		$http.post("addAccountEmpdata", data, config).then(function(response) {
			if(response.status === 200){
				if(response.data.status === false){
					serverResponseMessages.messageError(response.data.message);	
				} else{
					serverResponseMessages.messageSuccess(response.data.message);
					$scope.getRecords();	
					$scope.tempEmpData={};
				}
			} else {
				serverResponseMessages.messageError('Connection Error !!');
			}
		});
    }
});
// controller to modify employee
app.controller("empModifyController", function($scope,$http,serverResponseMessages){
	$scope.editEmp = function(empID){
		$("#editEmpForm").hide();
		$("#editEmpForm").slideDown();
		$(".editbtn").click(function(){
			$(window).scrollTop(0);
		})
		 $scope.genders = [
		    { 'id': 1, 'value' : 'Male' },
		    { 'id': 2, 'value' : 'Female' },
		    ];
		var data = $.param({
			'data' : empID
		});
		var config = {
			headers : {
				'Content-Type' : 'application/x-www-form-urlencoded;charset=utf-8;'
			}
		};
		
		$http.post("getEmpData", data, config).then(function(response) {
			//console.log(response.data);
			if(response.status === 200){
				if(response.data.status === false){
					serverResponseMessages.messageError(response.data.message);	
				} else{
					$scope.tempEmpData.primary = empID;
					$scope.tempEmpData.empname = response.data.data.name;
					$scope.tempEmpData.empfathername = response.data.data.fathername;
					$scope.tempEmpData.gender = response.data.data.gender;
					$scope.tempEmpData.contact = response.data.data.contact;
					$scope.tempEmpData.address = response.data.data.address;
					$scope.tempEmpData.doj = response.data.data.dateOfJoining;
					$scope.tempEmpData.dob = response.data.data.dateOfBirth;
				}
			} else {
				serverResponseMessages.messageError('Connection Error !!');
			}
		});
	}

	// update emp data
	$scope.tempEmpData = {};
	$scope.updateEmpData = function(){

		var data = $.param({
			'data' : $scope.tempEmpData
		});

		var config = {
			headers : {
				'Content-Type' : 'application/x-www-form-urlencoded;charset=utf-8;'
			}
		};

		$http.post("editEmpdata", data, config).then(function(response) {
			//console.log(response.data);
			if(response.status === 200){
				if(response.data.status === false){
					serverResponseMessages.messageError(response.data.message);	
				} else{
					window.location.href = 'employee_list';
				}
			} else {
				serverResponseMessages.messageError('Connection Error !!');
			}
		});

	}
});
	