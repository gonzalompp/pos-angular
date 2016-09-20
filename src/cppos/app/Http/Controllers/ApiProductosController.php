<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class Items {
	//propiedades
	public $IdDetalle;
	public $IdProductoCategoria;
	public $IdProducto;
    public $Nombre;
	public $PrecioUnitario;
	public $Cantidad;
	
	public $Eliminado;
	
	//constructor
	function __construct($IdProducto, $Nombre, $PrecioUnitario) {
        $this->IdProductoCategoria = 0;
		$this->Nombre = $Nombre;
    	$this->IdProducto = $IdProducto;
		$this->PrecioUnitario = $PrecioUnitario;
		$this->IdDetalle = 0;
		$this->Cantidad = 0;
	}
}

class ApiProductosController extends Controller
{
    public function GetProductos($id) {
		
		
		$array = array();
		
		//obtengo las categorias
		$productos = \App\Productos::where('categoria_id','=',$id)->orderBy('orden')->get();
		
		foreach ($productos as $prod)
		{
			array_push($array, new Items($prod->id,$prod->nombre, $prod->precio));
		}
		
		//lo devuelve como json
		return response()->json($array);
	}
}