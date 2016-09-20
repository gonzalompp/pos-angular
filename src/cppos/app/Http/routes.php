<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//principal
Route::get('/', function () {
    return view('index');
});

//vistas angular
Route::get('/AngularViews/{viewname}', function ($viewname) {
    return view('AngularViews.'.$viewname);
});

//vistas angular
Route::get('/AngularViews/{dirname}/{viewname}', function ($dirname,$viewname) {
    return view('AngularViews.'.$dirname.'.'.$viewname);
});

//test AuthTestController TestLogin
Route::get('/AuthTest', 'AuthTestController@Index');
Route::get('/AuthTest/TestLogin', 'AuthTestController@TestLogin');

//Impresiones
Route::get('/Impresiones/Pedido/{id}', 'ImpresionesController@Pedido');

/**************** API ***************/

//Sesiones
Route::get('/Api/Session', 'ApiSessionController@Index');
Route::post('/Api/Session/LoginUsuario', 'ApiSessionController@LoginUsuario');
Route::post('/Api/Session/SetGarzon', 'ApiSessionController@SetGarzon');
Route::get('/Desconectar','ApiSessionController@Desconectar');

//Listado de tipos de comidas y listado de productos
Route::get('/Api/ProductosCategorias/GetCategorias', 'ApiProductosCategoriasController@GetCategorias');
Route::get('/Api/Productos/GetProductos/{id}', 'ApiProductosController@GetProductos');

// Pedidos
Route::get('/Api/Pedidos', 'ApiPedidosController@Index');
Route::get('/Api/Pedidos/{idpedido}/{idmesa}', 'ApiPedidosController@Detalle');
Route::post('/Api/Pedidos/Confirmar', 'ApiPedidosController@Confirmar');
Route::post('/Api/Pedidos/CrearPedido', 'ApiPedidosController@CrearPedido');
Route::post('/Api/Pedidos/Pagar', 'ApiPedidosController@Pagar');
Route::post('/Api/Pedidos/Eliminar/{idpedido}', 'ApiPedidosController@Eliminar');
//Route::post('/Api/Pedidos/DescuentaValor', 'ApiPedidosController@DescuentaValor');

//arqueo de caja
Route::post('/Api/ArqueoCaja/Guardar', 'ApiArqueoCajaController@Guardar');
Route::get('/Api/ArqueoCaja/GetValores/{fi}/{ft}', 'ApiArqueoCajaController@GetValores');
Route::get('/Api/ArqueoCaja/GetArqueosAnteriores', 'ApiArqueoCajaController@GetArqueosAnteriores');

