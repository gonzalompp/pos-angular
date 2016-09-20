'use strict';

app.controller('GarzonController', function ($scope, $http, $location) {
	
	$scope.codigo = "";
	
	$scope.SetGarzon = function (item) {
		$http.post(fullUrl('Api/Session/SetGarzon'), {
			codigo:$scope.codigo
		}).success(function (data, status, headers, config) {
            
            if (data.codigo == 0)
			{
				alert(data.mensaje);
			} 
			else 
			{
				alert(data.mensaje);
				$location.path('/mesas');	
			}

        }).error(function (data, status, headers, config) {
            alert('error');
        });
    }
});