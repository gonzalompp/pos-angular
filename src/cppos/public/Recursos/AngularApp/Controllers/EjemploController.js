'use strict';
    /* PosProductosController */
app.controller('PosPedidoController', function ($scope, $http) {

    $scope.productos = [];
    $scope.productos_venta = [];
        
    //carga categorias
    cargaTipoComidas();

    $scope.getSubTotal = function () {
        var total = 0;
        for (var i = 0; i < $scope.productos_venta.length; i++) {
            var product = $scope.productos_venta[i];
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

    $scope.cantidadDisminuir = function (item) {
        item.Cantidad = item.Cantidad - 1;
    }

    $scope.cantidadAumentar = function (item) {
        item.Cantidad = item.Cantidad + 1;
    }

    $scope.confirmarVenta = function ()
    {
        $http.post('http://localhost:54532/api/Pedidos/Confirmar/', $scope.productos_venta).success(function (data, status, headers, config) {
            
            alert('Confirmado');

        }).error(function (data, status, headers, config) {
            alert('error');
        });
    }

    $scope.itemClick = function (item) {

        if (item.IdComida == 0 && item.IdTipoComida>0) {
            //es tipo categoria
            cargaComidas(item.IdTipoComida);

        } else if (item.IdComida > 0) {
            //es tipo comida
            var flagExiste = false;

            angular.forEach($scope.productos_venta, function (value, key) {
                if (value.IdComida == item.IdComida) {
                    //ya existe, suma uno
                    item.Cantidad = item.Cantidad + 1;

                    flagExiste = true;
                }
            });

            if (flagExiste == false) {
                //coloca cantidad inicial con uno
                item.Cantidad = 1;
                //agrega el producto al listado de venta
                $scope.productos_venta.push(item);
            }
        } else {
            //es boton volver a categorias
            cargaTipoComidas();
        }
    }

    function cargaTipoComidas() {
        //carga el listado de productos
        $http.get('http://localhost:54532/api/TiposComidas/').success(function (data, status, headers, config) {
            //ingresa los productos
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
        $http.get('http://localhost:54532/api/Comidas/GetComidasByTipoComida/' + IdCategoria).success(function (data, status, headers, config) {
            //ingresa los productos
            $scope.productos = data; 

            angular.forEach($scope.productos, function (value, key) {
                value.Tipo = 2;
            });

            //agrega el boton para volver
            $scope.productos.unshift({ Nombre: "Volver", IdComida: "0", IdTipoComida: "0", Tipo: "0" });

        }).error(function (data, status, headers, config) {
            alert('error');
        });
    }


});