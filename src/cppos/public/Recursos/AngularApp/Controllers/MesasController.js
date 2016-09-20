'use strict';

app.controller('MesasController', function ($scope, $http, svc_session, $location) {
    
    $scope.mesas = [];

    cargaPedidos();
    
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

    function cargaPedidos() {
        //carga el listado de productos
        $http.get(fullUrl('/Api/Pedidos')).success(function (data, status, headers, config) {
            //coloca las mesas
            $scope.mesas = data;
            console.dir($scope.mesas);

        }).error(function (data, status, headers, config) {
            alert('error');
        });
    }
    
    $scope.PedidoNombre = function (pedido) {
        
        if (pedido.IdMesa > 0)
            return pedido.TipoPedidoNombreCorto+' '+pedido.IdMesa;
        
        return pedido.TipoPedidoNombreCorto;
    }
    
    $scope.PedidoNombreDerecha = function (pedido) {
        if (pedido.IdPedido >0)
            return '#'+pedido.IdPedido;
            
        return '';
    }
    
    $scope.PedidoSubNombre = function (pedido) {
        //si es de mesa
            if (pedido.TipoPedido == 1 && pedido.IdPedido>0) //mesa ocupada
                return 'Ocupada';
                
            if (pedido.TipoPedido == 1 && pedido.IdPedido==0) //mesa vacía
                return 'Vacía';
        
            if (pedido.TipoPedido == 2)  //despacho
            {
                if (pedido.DespachoDireccion=='')
                    return 'Sin dirección cliente';
                else
                    return pedido.DespachoDireccion;
            }
            
            if (pedido.TipoPedido == 3) //retiro
            {
                if (pedido.NombrePersonaRetira!='')
                    return pedido.NombrePersonaRetira;
                else
                    return 'Sin nombre cliente';
            }
                
            return '???';
    }
    
    $scope.GoPedido = function (idpedido,idmesa) {
            if (idpedido == 0)
            {
                if( confirm('¿Deseas asignar un nuevo pedido a esta mesa?'))
                {
                    //crea pedido
                    //carga el listado de productos
                    $http.post(fullUrl('/Api/Pedidos/CrearPedido'),
                    {  
                        idtipo: 1,
                        idpedido: idpedido,
                        idmesa: idmesa,
                        idcliente: 0
                    }).success(function (data, status, headers, config) {
                        //coloca las mesas
                        if (data.codigo == 1)
                            $location.path('/pedido/'+data.idpedido+'/'+data.idmesa);	
                        else
                            alert(data.mensaje); //muestar mensaje de error
            
                    }).error(function (data, status, headers, config) {
                        alert('error');
                    });
                }
                    
            } 
            else 
            {
                //si está con un numero, envia directamente al pedido
                $location.path('/pedido/'+idpedido+'/'+idmesa);
            }
    }
    
    //nuevo despacho
    $scope.NuevoDespacho = function () {
                if( confirm('¿Deseas crear un nuevo despacho?'))
                {
                    //crea pedido
                    //carga el listado de productos
                    $http.post(fullUrl('/Api/Pedidos/CrearPedido'),
                    {  
                        idtipo: 2,
                        idpedido: 0,
                        idmesa: 0,
                        idcliente: 0
                    }).success(function (data, status, headers, config) {
                        //coloca las mesas
                        if (data.codigo == 1)
                            $location.path('/pedido/'+data.idpedido+'/'+data.idmesa);	
                        else
                            alert(data.mensaje); //muestar mensaje de error
            
                    }).error(function (data, status, headers, config) {
                        alert('error');
                    });
                }
                    
            } 
    
    //nuevo despacho
    $scope.NuevoRetiro = function () {

                if( confirm('¿Deseas crear un nuevo retiro en local?'))
                {
                    //crea pedido
                    //carga el listado de productos
                    $http.post(fullUrl('/Api/Pedidos/CrearPedido'),
                    {  
                        idtipo: 3,
                        idpedido: 0,
                        idmesa: 0,
                        idcliente: 0
                    }).success(function (data, status, headers, config) {
                        //coloca las mesas
                        if (data.codigo == 1)
                            $location.path('/pedido/'+data.idpedido+'/'+data.idmesa);	
                        else
                            alert(data.mensaje); //muestar mensaje de error
            
                    }).error(function (data, status, headers, config) {
                        alert('error');
                    });
                } 
    }
});