'use strict';

app.controller('LoginController', function ($scope, $http, $location) {
	
	
	$scope.usuario = "";
	$scope.clave = "";
	
	$scope.Login = function (item) {
		$http.post(fullUrl('Api/Session/LoginUsuario'), {
			usuario:$scope.usuario,
			clave: $scope.clave
		}).success(function (data, status, headers, config) {
            
            if (data.codigo == 0)
			{
				alert(data.mensaje);
			} 
			else 
			{
				$location.path('/garzon');	
			}

        }).error(function (data, status, headers, config) {
            alert('error');
        });
    }
});