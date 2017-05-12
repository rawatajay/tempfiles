// define application
angular.module('TrivialPMS', []).
	controller("empAddController", function($scope,$http){
		// function to insert employee data
		$scope.saveEmployee = function(){
			console.log($scope);
		}
	});
	