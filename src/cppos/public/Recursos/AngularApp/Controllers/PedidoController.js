'use strict';

app.controller('PedidoController', function ($window, $location, $scope, $http, svc_session, $routeParams) {

    //cuadros productos
    $scope.productosShow = "inline";
    $scope.pagoShow = "none";
    $scope.dataClienteShow = "none";
    $scope.descuentosShow = "none";
    
    $scope.abreProductos = function ()
    {
        $scope.productosShow = "inline";
        $scope.pagoShow = "none";
        $scope.dataClienteShow = "none";
        $scope.descuentosShow = "none";
    }
    
    $scope.abrePagar = function ()
    {
        $scope.productosShow = "none";
        $scope.pagoShow = "inline";
        $scope.dataClienteShow = "none";
        $scope.descuentosShow = "none";
    }
    
    $scope.abreDataCliente = function ()
    {
        $scope.productosShow = "none";
        $scope.pagoShow = "none";
        $scope.dataClienteShow = "inline";
        $scope.descuentosShow = "none";
    }
    
    $scope.abreDescuentos = function ()
    {
        $scope.productosShow = "none";
        $scope.pagoShow = "none";
        $scope.dataClienteShow = "none";
        $scope.descuentosShow = "inline";
    }
   
   //

    $scope.productos = [];
    
    $scope.pedido = new Object();
    $scope.pedido.productos_venta = [];
    $scope.pedido.idPedido = 3422;
    $scope.pedido.cliente = "Despacho 34 (María López)";
    
    //descuentos
    $scope.descuentoPorcentaje = 0;
    $scope.descuentoValor = 0;
    
    //pagos
    $scope.PagoEfectivo = 0;
    $scope.PagoCredito = 0;
    $scope.PagoDebito = 0;
    $scope.PagoCheque = 0;
    
    //carga los datos de la sesión
    $scope.session;
    
    cargaSession();
    
    //carga pedido
    cargaPedido($routeParams.idpedido,$routeParams.idmesa);
        
    //carga categorias
    cargaTipoComidas();
    
    $scope.imprimirPedido = function ()
    {
        //$location.path('/mesas');
        
        $http.post(fullUrl('Api/Pedidos/Confirmar'), { pedido: $scope.pedido}).success(function (data, status, headers, config) {
            //carga pedido
            cargaPedido($scope.pedido.IdPedido,$scope.pedido.IdMesa);
            $window.open(fullUrl('Impresiones/Pedido/'+$scope.pedido.IdPedido), 'Impresion', 'width=500,height=400');

        }).error(function (data, status, headers, config) {
            alert('error confirmando el pedido');
        });
        
    }
    
    $scope.cancelarDescuento = function () 
    {
        //setea formulario en vacio
        $scope.descuentoPorcentaje = 0;
        $scope.descuentoValor = 0;
    
        //muestra productos
        $scope.abreProductos();
    }

    $scope.getSubTotal = function () {
        var total = 0;
        for (var i = 0; i < $scope.pedido.productos_venta .length; i++) {
            var product = $scope.pedido.productos_venta [i];
            if (product.Eliminado == 0)
                total += (product.PrecioUnitario * product.Cantidad);
        }
        return total;
    }

    $scope.getPropina = function () {
        
        return $scope.getSubTotal()*0.1;
    }

    $scope.getTotal = function () {

        return $scope.getSubTotal() + $scope.getPropina();
    }
    
    $scope.getSumaPagos = function () {

        return $scope.PagoEfectivo+$scope.PagoCredito+$scope.PagoDebito+ $scope.PagoCheque;
    }
    
    /* pantalla de descuentos */
    $scope.getTempSubTotalDescValor = function () {
        
        return $scope.getSubTotal()-$scope.descuentoValor;
    }
    
    
    //
    $scope.getTempTotalDescValor = function () {
        
        return $scope.descuentoValor;
    }
    
    $scope.getTempSubTotalDescPorcent = function () {
        
        return $scope.getSubTotal()*(1-($scope.descuentoPorcentaje/100));
    }
    
    //
    $scope.getTempTotalDescPorcent = function () {
        
        return ($scope.getSubTotal()*$scope.descuentoPorcentaje)/100;
    }
    
    $scope.AplicarDescuentoValor = function ()
    {
        var valor_temp = $scope.getTempTotalDescValor();
        var idpedido_temp = $scope.pedido.IdPedido;
        aplicaDescuentoValor(idpedido_temp,valor_temp);
    }
    
    $scope.AplicarDescuentoPorcent = function ()
    {
        var valor_temp = $scope.getTempTotalDescPorcent();
        var idpedido_temp = $scope.pedido.IdPedido;
        aplicaDescuentoValor(idpedido_temp,valor_temp);
    }
    
    function aplicaDescuentoValor(idpedido, valor)
    {
        if (valor==0)
        {
            alert('El valor de descuento no puede ser 0');
            return;
        }
        
        if (valor<1)
        {
            alert('El valor de descuento no puede ser negativo');
            return;
        }
        
        if (valor>$scope.getSubTotal())
        {
            alert('El descuento no puede ser mayor al subtotal');
            return;
        }
        
        var itemDescto = new Object();
        
        itemDescto.IdProductoCategoria = 0;
        itemDescto.Nombre = 'Descuento';
        itemDescto.IdProducto = 0;
        itemDescto.PrecioUnitario = -valor;
        itemDescto.Cantidad = 1;
        itemDescto.Eliminado = 0;
        itemDescto.IdDetalle = 0;
        
        $scope.pedido.productos_venta.push(itemDescto);
        
        //muestra la pantalla de productos
        $scope.abreProductos();
    }
    
    
    /* otros */

    $scope.cantidadDisminuir = function (item) {
        if (item.Cantidad>1)
            item.Cantidad = item.Cantidad - 1;
        else
            if (confirm("Desea eliminar el producto \""+item.Nombre+"\"?"))
            {
                item.Eliminado = 1;
            }
    }
    
    $scope.eliminarItem = function (item) {
            if (confirm("Realmente desea eliminar el producto \""+item.Nombre+"\"?"))
            {
                item.Eliminado = 1;
            }
    }

    $scope.cantidadAumentar = function (item) {
        if (item.IdProducto == 0)
        {
            alert('Acción no permitida para los items de descuentos');
            return;
        }
        
        item.Cantidad = item.Cantidad + 1;
    }
    
    $scope.clickPagar = function ()
    {
        $scope.abrePagar();
    }
    
    $scope.pagarPedido = function ()
    {
        //validacion pagos
        if ($scope.getSubTotal()<1)
        {
        alert('No se puede pagar una cuenta que tiene un subtotal en $0 pesos');
            return;
        }
        
        //validacion pagos
        if ($scope.PagoEfectivo<0)
        {
            alert('Pago efectivo no puede ser un numero negativo');
            return;
        }
        
        if ($scope.PagoCredito<0)
        {
            alert('Pago con tarjeta de crédito no puede ser un numero negativo');
            return;
        }
        
        if ($scope.PagoDebito<0)
        {
            alert('Pago con tarjeta de débito no puede ser un numero negativo');
            return;
        }
        
        if ($scope.PagoCheque<0)
        {
            alert('Pago con cheque no puede ser un numero negativo');
            return;
        }
        
        //validacion de monto minimo
        if ($scope.getSumaPagos() < $scope.getSubTotal())
        {
            alert('La suma de formas de pago no puede ser menor al SUB TOTAL de la cuenta');
            return;
        }
        
        // todo ok
        if (confirm('Click en ACEPTAR para pagar el pedido')) 
        {
            //primero confirma el pedido
            $http.post(fullUrl('Api/Pedidos/Confirmar'), { pedido: $scope.pedido}).success(function (data, status, headers, config) {
                //ahora paga
                $http.post(fullUrl('Api/Pedidos/Pagar'), 
                { 
                    IdPedido: $scope.pedido.IdPedido,
                    PagoEfectivo: $scope.PagoEfectivo,
                    PagoCredito: $scope.PagoCredito,
                    PagoDebito: $scope.PagoDebito,
                    PagoCheque: $scope.PagoCheque
                }).success(function (data, status, headers, config) {
    
                    if (data.codigo != 1) {
                        //error
                        alert(data.mensaje);
                    } else {
                        //todo ok
                        alert(data.mensaje);
                        
                        //envia a mesas
                        $location.path('/mesas');
                    }
        
                }).error(function (data, status, headers, config) {
                    alert('error pagando el pedido');
                });

            }).error(function (data, status, headers, config) {
                alert('error confirmando el pedido');
            });
            
            
        }
    }
    
    $scope.eliminarPedido = function ()
    {
        if (confirm('Realmente queres eliminar el pedido?')) 
        {
            $http.post(fullUrl('Api/Pedidos/Eliminar/'+$scope.pedido.IdPedido), { pedido: $scope.pedido}).success(function (data, status, headers, config) {

                if (data.codigo != 1) {
                    //error
                    alert(data.mensaje);
                } else {
                    //todo ok
                    alert(data.mensaje);
                    
                    //envia a mesas
                    $location.path('/mesas');
                }
    
            }).error(function (data, status, headers, config) {
                alert('error confirmando el pedido');
            });
        }
    }

    $scope.confirmarPedido = function ()
    {
        console.log($scope.pedido);
        $http.post(fullUrl('Api/Pedidos/Confirmar'), { pedido: $scope.pedido}).success(function (data, status, headers, config) {
            //carga pedido
            cargaPedido($scope.pedido.IdPedido,$scope.pedido.IdMesa);
            alert('Confirmado');

        }).error(function (data, status, headers, config) {
            alert('error confirmando el pedido');
        });
    }

    $scope.itemClick = function (item) {
        //alert('item.IdProducto: '+item.IdProducto+' / '+item.IdProductoCategoria);
        if (item.IdProducto == 0 && item.IdProductoCategoria>0) {
            //es tipo categoria
            cargaComidas(item.IdProductoCategoria);

        } else if (item.IdProducto > 0) {
            //es tipo comida
            var flagExiste = false;

            angular.forEach($scope.pedido.productos_venta , function (value, key) {
                if (value.IdProducto == item.IdProducto) {
                    if (value.Eliminado==1) {
                        value.Eliminado = 0;
                        value.Cantidad = 0;
                    }
                    
                    //ya existe, suma uno
                    value.Cantidad = value.Cantidad + 1;
                    flagExiste = true;
                }
            });

            if (flagExiste == false) {
                //coloca cantidad inicial con uno
                item.Cantidad = 1;
                
                //marca como no eliminado
                item.Eliminado = 0;
                
                //agrega el producto al listado de venta
                $scope.pedido.productos_venta.push(item);
            }
        } else {
            //es boton volver a categorias
            cargaTipoComidas();
        }
    }
    
    function cargaPedido(IdPedido,IdMesa)
    {
        $http.get(fullUrl('Api/Pedidos/'+IdPedido+'/'+IdMesa)).success(function (data, status, headers, config) {
           console.log(data);
            $scope.pedido = data;

        }).error(function (data, status, headers, config) {
            alert('error');
        });
    }
    
    function cargaSession()
    {
        //utiliza una promesa para esperar el callback del async
        var myDataPromise = svc_session.GetSessionData();
        
        myDataPromise.then(function(result) {  // this is only run after $http completes
            $scope.session = result;
        });
    }

    function cargaTipoComidas() {
        //carga el listado de productos
        $http.get(fullUrl('Api/ProductosCategorias/GetCategorias')).success(function (data, status, headers, config) {
            //ingresa los productos
            //alert('carga comidas');
            $scope.productos = data;
            angular.forEach($scope.productos, function (value, key) {
                value.Tipo = 1;
            });

        }).error(function (data, status, headers, config) {
            alert('error');
        });
    }

    function cargaComidas(IdCategoria) {
        //carga el listado de productos
        $http.get(fullUrl('Api/Productos/GetProductos/' + IdCategoria)).success(function (data, status, headers, config) {
            //ingresa los productos
            $scope.productos = data; 

            angular.forEach($scope.productos, function (value, key) {
                value.Tipo = 2;
            });

            //agrega el boton para volver
            $scope.productos.unshift({ Nombre: "Volver", IdProducto: "0", IdProductoCategoria: "0", Tipo: "0" });

        }).error(function (data, status, headers, config) {
            alert('error');
        });
    }
});