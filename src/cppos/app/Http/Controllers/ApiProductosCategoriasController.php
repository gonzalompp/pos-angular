<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class Items {
	//propiedades
	public $IdProductoCategoria;
	public $IdProducto;
    public $Nombre;
	public $Tipo;
	
	//constructor
	function __construct($IdProductoCategoria, $Nombre) {
        $this->IdProductoCategoria = $IdProductoCategoria;
		$this->Nombre = $Nombre;
		$this->IdProducto = 0;
    }
}

class ApiProductosCategoriasController extends Controller
{
    public function GetCategorias() {
		
		$array = array();
		
		//obtengo las categorias
		$categorias = \App\Categorias::orderBy('orden')->get();
		
		foreach ($categorias as $cat)
		{
			array_push($array, new Items($cat->id,$cat->nombre));
		}

		//lo devuelve como json
		return response()->json($array);
	}
}