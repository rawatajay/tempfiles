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
app.controller("empAccountController", function($scope,$http){

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
	