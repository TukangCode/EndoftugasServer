var mainApp = angular.module("mainApp", ['ngRoute']);
 
mainApp.config(function($routeProvider) {
    $routeProvider
        .when('/login', {
            templateUrl: 'template/login.html',
            controller: 'LoginController'
        })
        .when('/dataBuku', {
            templateUrl: 'template/data-buku.html',
            controller: 'DataBukuController'
        })
        .otherwise({
            redirectTo: '/login'
        });
});
 
mainApp.controller('DataBukuController', function($scope,http) {
	$scope.getBuku = function(){
		$http.get(
			'php/get-buku.php'
		).success(function(data){
			$scope.daftarbuku = data;
		});
	};
	$scope.message = 'getBuku';
	$scope.getbuku();
	$scope.currentPage = 0;
    $scope.pageSize = 10;
    $scope.numberOfPages=function(){
        return Math.ceil($scope.daftarbuku.length/$scope.pageSize);                
    }
});
mainApp.filter('startFrom', function() {
    return function(input, start) {
        start = +start; //parse to int
        return input.slice(start);
    }
});