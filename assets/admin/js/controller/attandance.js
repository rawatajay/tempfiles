// define application
var app = angular.module('TrivialPMS',[]);

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

app.controller("AttandanceController" ,function($scope,$http,serverResponseMessages){
	$scope.tempdata = {};
	$scope.filename = "";
	//console.log($scope.myFile);
	$('.monthYear').datetimepicker({
		viewMode: 'years',
        format: 'MM/YYYY'
	});
	$scope.filename = $scope.myFile;
	$scope.uploadattandatesheet = function(action) {
		$(".uploadattandatesheet-btn").prop("disabled",true);
		
		
        var file = $scope.myFile;
        var text = $scope.name;
        var monthYear = $scope.name;
		var fd = new FormData();
        fd.append('monthYear', $('.monthYear').val());
        fd.append('file', file);
         
        var config = {
             transformRequest: angular.identity,
             headers: {'Content-Type': undefined,'Process-Data': false}
        }
       // console.log($scope);
		$http.post(SITEBASEURL+"admin/updloadattandancefile", fd, config).then(function(response) {
			$(".uploadattandatesheet-btn").prop("disabled",false);
			if(response.status === 200){
				if(response.data.status === false){
					$scope.myFile = "";
					serverResponseMessages.messageError(response.data.message);	
				} else{					
					serverResponseMessages.messageSuccess(response.data.message);	
					
				}
			} else {
				serverResponseMessages.messageError('Connection Error !!');
			}
		});
	}
});

app.directive('fileModel', ['$parse', function ($parse) {
    return {
    restrict: 'A',
    link: function(scope, element, attrs) {
        var model = $parse(attrs.fileModel);
        var modelSetter = model.assign;

        element.bind('change', function(){
            scope.$apply(function(){
                modelSetter(scope, element[0].files[0]);
            });
            scope.filename = "sdfjsdfjsofj";
        });
    }
   };
}]);

// We can write our own fileUpload service to reuse it in the controller
app.service('fileUpload', ['$http', function ($http) {
    this.uploadFileToUrl = function(file, uploadUrl, name){
         var fd = new FormData();
         fd.append('file', file);
         fd.append('name', name);
         $http.post(uploadUrl, fd, {
             transformRequest: angular.identity,
             headers: {'Content-Type': undefined,'Process-Data': false}
         })
         .success(function(){
            console.log("Success");
         })
         .error(function(){
            console.log("Success");
         });
     }
 }]);