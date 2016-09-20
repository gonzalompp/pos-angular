<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

class ImpresionesController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function Pedido($id)
    {
        //busca pedido
		$pedido_db = \App\Pedidos::where('id', $id)->first();
		
		if ($pedido_db == null)
		{
			return response()->json(['codigo' => 0, 'mensaje' => 'ERROR: El pedido no existe']);
		}
        
        //listado de items
        $detalles_db = \App\Detalles::where('id_pedido','=', $id)->get();
        
        //config
        $configs_db = \App\Configs::all();
        
        $empresa ="";
        $local ="";
        $direccion ="";
        $telefono ="";
        $email ="";
        
        foreach($configs_db as $item)
        {
            if ($item->codigo == "empresa.nombre")
                $empresa = $item->valor;
            
            if ($item->codigo == "sucursal.nombre")
                $local = $item->valor;
                
            if ($item->codigo == "sucursal.direccion")
                $direccion = $item->valor;
                
            if ($item->codigo == "sucursal.teléfono")
                $telefono = $item->valor;
                
            if ($item->codigo == "sucursal.email")
                $email = $item->valor;
        }
        

        
        return view('Impresiones.Pedido',
        [
            'nombre_empresa' => $empresa,
            'nombre_local' => $local,
            'direccion' => $direccion,
            'telefono' => $telefono,
            'email' => $email,
            'fecha_pedido' => $pedido_db->created_at,
            'items' => $detalles_db,
            'subtotal' => $pedido_db->subtotal,
            'propina' => $pedido_db->propina,
            'total' => $pedido_db->total,
            'observaciones' => $pedido_db->observaciones
        ]
        );
    }
}