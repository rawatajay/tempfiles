// define application
angular.module('TrivialPMS', []).
	controller("empAddController", function($scope,$http){
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

			//$http.post("admin/addEmpdata" , data , config).success().error();
			$http.post("addEmpdata", data, config).then(function(response) {
        		console.log(response.data);
        		if(response.status === 200){
        			if(response.data.status === false){
        				$scope.messageError(response.data.message);	
        			} else{
        				window.location.href = 'employee_list';
        			}
        		} else {
        			$scope.messageError('Connection Error !!');
        		}
    		});
		}

		// function to display success message
	    $scope.messageSuccess = function(msg){
	        $('.alert-success > p').html(msg);
	        $('.alert-success').show();
	        $('.alert-success').delay(2000).slideUp(function(){
	            $('.alert-success > p').html('');
	        });
	    };
	    
	    // function to display error message
	    $scope.messageError = function(msg){
	        $('.alert-danger  > p').html(msg);
	        $('.alert-danger').show();
	        $('.alert-danger').delay(2000).slideUp(function(){
	            $('.alert-danger > p').html('');
	        });
	    };
	});
	