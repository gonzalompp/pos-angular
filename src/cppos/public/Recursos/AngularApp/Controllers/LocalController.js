'use strict';

app.controller('LocalController', function ($scope, $http, $location, svc_session) {
	
    $scope.arqueosanteriores;
    
    //carga arqueos anteriores
    cargaArqueosAnteriores();
    
    //inicia arqueo nuevo
    vaciaFiltrosArqueo();
    vaciaArqueoSistema();
    vaciaArqueoRegistrado();
    
    function cargaArqueosAnteriores()
    {
        $http.get(fullUrl('Api/ArqueoCaja/GetArqueosAnteriores')).success(function (data, status, headers, config) {

            if (data.codigo == 1)
            {
                $scope.arqueosanteriores = data.data;
            } 

        }).error(function (data, status, headers, config) {
            alert('error');
        });
    }
    
    function vaciaFiltrosArqueo()
    {
        $scope.ArqueoFechaInicio = '';
        $scope.ArqueoHoraInicio = '';
        $scope.ArqueoFechaTermino = '';
        $scope.ArqueoHoraTermino = '';
    }
    
    function vaciaArqueoSistema()
    {
        $scope.arqueosistema = new Object();
        
        $scope.arqueosistema.ArqueoFechaInicio = '';
        $scope.arqueosistema.ArqueoHoraInicio = '';
        $scope.arqueosistema.ArqueoFechaTermino = '';
        $scope.arqueosistema.ArqueoHoraTermino = '';
        
        $scope.arqueosistema.PagoEfectivo = 0;
        $scope.arqueosistema.PagoCredito = 0;
        $scope.arqueosistema.PagoDebito = 0;
        $scope.arqueosistema.PagoCheque = 0;
        $scope.arqueosistema.Cargado = 0; //flag de carga desde sistema
    }

    function vaciaArqueoRegistrado()
    {
        //numeros ingresados por usuario
        $scope.arqueoregistrado = new Object();
        
        //fechas
        $scope.arqueoregistrado.ArqueoFechaInicio = '';
        $scope.arqueoregistrado.ArqueoHoraInicio = '';
        $scope.arqueoregistrado.ArqueoFechaTermino = '';
        $scope.arqueoregistrado.ArqueoHoraTermino = '';
        
        //$scope.arqueoregistrado.FechaArqueo
        $scope.arqueoregistrado.PagoEfectivo = 0;
        $scope.arqueoregistrado.PagoCredito = 0;
        $scope.arqueoregistrado.PagoDebito =0;
        $scope.arqueoregistrado.PagoCheque = 0;
    }
    
    $scope.PagoEfectivoColor = function()
    {
        if ($scope.arqueosistema.PagoEfectivo - $scope.arqueoregistrado.PagoEfectivo > 0)
            return "mostrar"; 
        return "esconder";
    }
    
    $scope.PagoCreditoColor = function()
    {
        if ($scope.arqueosistema.PagoCredito - $scope.arqueoregistrado.PagoCredito > 0)
            return "mostrar"; 
        return "esconder";
    }
    
    $scope.PagoDebitoColor = function()
    {
        if ($scope.arqueosistema.PagoDebito - $scope.arqueoregistrado.PagoDebito > 0)
            return "mostrar"; 
        return "esconder";
    }
    
    $scope.PagoChequeColor = function()
    {
        if ($scope.arqueosistema.PagoCheque - $scope.arqueoregistrado.PagoCheque > 0)
            return "mostrar"; 
        return "esconder";
    }
    
    /* CLICKS */
    
    $scope.generarArqueo = function()
    {
        if ($scope.arqueosistema.Cargado == 1) {
        
            //carga el listado de productos
            $http.post(fullUrl('Api/ArqueoCaja/Guardar'),
            {
                ArqueoSistema: $scope.arqueosistema,
                ArqueoRegistrado: $scope.arqueoregistrado
            }).success(function (data, status, headers, config) {
    
                alert(data.mensaje);
                
                //exito
                if (data.codigo == 1)
                {
                    vaciaArqueoRegistrado();
                    vaciaArqueoSistema();
                    vaciaArqueoRegistrado();
                    
                    //actualiza listado de arqueos
                    cargaArqueosAnteriores();
                }
    
            }).error(function (data, status, headers, config) {
                alert('error');
            });
        } else {
            alert('Primero Debes cargar las ventas del periodo');
        }
    }
    
    $scope.cargarValoresArqueo = function()
    {
        
        if ($scope.ArqueoFechaInicio=='')
        {
            alert('Debes ingresar una fecha inicial');
            return;
        }
        
        if ($scope.ArqueoHoraInicio=='')
        {
            alert('Debes ingresar una hora inicial');
            return;
        }
        
        if ($scope.ArqueoFechaTermino=='')
        {
            alert('Debes ingresar una fecha de término');
            return;
        }
        
        if ($scope.ArqueoHoraTermino=='')
        {
            alert('Debes ingresar una hora de término');
            return;
        }

        var fi = $scope.ArqueoFechaInicio.replace(/\//g, "-")+" "+$scope.ArqueoHoraInicio;
        var ft = $scope.ArqueoFechaTermino.replace(/\//g, "-")+" "+$scope.ArqueoHoraTermino;
        //carga el listado de productos
        $http.get(fullUrl('Api/ArqueoCaja/GetValores/'+fi+'/'+ft)).success(function (data, status, headers, config) {

            if (data.codigo == 1)
            {
                alert(data.mensaje);
                $scope.arqueosistema = data.data;
                //mete valores de fecha a 
                
                $scope.arqueosistema.ArqueoFechaInicio = $scope.ArqueoFechaInicio;
                $scope.arqueosistema.ArqueoHoraInicio = $scope.ArqueoHoraInicio;
                $scope.arqueosistema.ArqueoFechaTermino = $scope.ArqueoFechaTermino;
                $scope.arqueosistema.ArqueoHoraTermino = $scope.ArqueoHoraTermino;
                
                $scope.arqueoregistrado.ArqueoFechaInicio = $scope.ArqueoFechaInicio;
                $scope.arqueoregistrado.ArqueoHoraInicio = $scope.ArqueoHoraInicio;
                $scope.arqueoregistrado.ArqueoFechaTermino = $scope.ArqueoFechaTermino;
                $scope.arqueoregistrado.ArqueoHoraTermino = $scope.ArqueoHoraTermino;
                
                console.log($scope.arqueosistema);
                console.log($scope.arqueoregistrado);
            } 
            else 
            {
                alert(data.mensaje);
                vaciaArqueoSistema();
            }

        }).error(function (data, status, headers, config) {
            alert('error');
        });
    }
    
	//carga los datos de la sesión
    $scope.session;
    
    cargaSession();
	
	function cargaSession()
    {
        //utiliza una promesa para esperar el callback del async
        var myDataPromise = svc_session.GetSessionData();
        
        myDataPromise.then(function(result) {  // this is only run after $http completes
            $scope.session = result;
        });
    }
});