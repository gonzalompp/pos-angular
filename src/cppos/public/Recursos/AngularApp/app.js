'use strict';
    
    //path base
    var urlBase = 'http://localhost:8090/cppos/public/';
    //funcion básica
    function fullUrl(path)
    {
        return urlBase + path;
    }

    //carga app angular
    var app = angular.module('store', ['ngRoute']);

    //rutas
    app.config(function ($routeProvider) {
        $routeProvider
        .when('/', {
            redirectTo: '/login'
        })
        .when('/local', {
            templateUrl: fullUrl('AngularViews/Local'),
            controller: 'LocalController'
        })
        .when('/login', {
            templateUrl: fullUrl('AngularViews/Login'),
            controller: 'LoginController'
        })
        .when('/pedido/:idpedido/:idmesa', {
            templateUrl: fullUrl('AngularViews/Pedido'),
            controller: 'PedidoController'
        })
        .when('/mesas', {
            templateUrl: fullUrl('AngularViews/Mesas'),
            controller: 'MesasController'
        })
        .when('/garzon', {
            templateUrl: fullUrl('AngularViews/Garzon'),
            controller: 'GarzonController'
        })
        .otherwise({
            redirectTo: '/'
        });
    });
    
    
    app.factory('svc_session', function($http,$location) {

        var GetSessionData = function() {
    
            return $http({method:"GET", url:fullUrl("/Api/Session")}).then(function(result){
               
               var session = result.data;
               
               if (session.IdUsuario == null)
                $location.path('/login');
                
                if (session.IdGarzon == null)
                $location.path('/garzon');
                
                return result.data;
            });
        };
        return { GetSessionData: GetSessionData };
        
        
    });
    
