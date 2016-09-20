<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PedidosOut {
	public $IdPedido;
	public $IdMesa;
    public $TipoPedido; // 1: Mesa / 2: Retiro en local / 3: Despacho a domicilio
	public $TipoPedidoNombre; 
	public $TipoPedidoNombreCorto; 
	public $TipoPedidoNombreTag; 
	public $TipoPedidoIcono; 
	public $TipoPedidoCssClass; 
    public $Observaciones;
	public $IdCliente;
	
	public $DespachoDireccion;
	public $DespachoComuna;
	public $DespachoTelefono;
	public $NombrePersonaRetira;
	
	public $productos_venta;
}

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
	function __construct($IdDetalle,$IdProducto, $Nombre, $PrecioUnitario, $Cantidad, $Eliminado) {
        $this->IdProductoCategoria = 0;
		$this->Nombre = $Nombre;
    	$this->IdProducto = $IdProducto;
		$this->PrecioUnitario = $PrecioUnitario;
		$this->Cantidad = $Cantidad;
		$this->Eliminado = $Eliminado;
		$this->IdDetalle = $IdDetalle;
	}
}

class ApiPedidosController extends Controller
{
	//listado de pedidos para pantalla de mesas
    public function Index() {
		
		$array = array();
		
		/*************** PEDIDOS MESA ******************/
		$pedidos = \DB::table('mesas')
            //->leftJoin('pedidos', 'mesas.id', '=', 'pedidos.id_mesa')
			->leftJoin('pedidos', function($join)
			{
				$join->on('mesas.id', '=', 'pedidos.id_mesa')
					 ->on('pedidos.id_estado', '=', \DB::raw(1));// 1 es el estado pendiente de un pedido
			})
			->leftJoin('tipos', 'tipos.id', '=', 'pedidos.id_tipo')
			//->leftJoin('estados', 'estados.id', '=', 'pedidos.id_estado')
            ->select(
				'pedidos.id as id_pedido', 
				'mesas.id as id_mesa', 
				'mesas.nombre as nombre_mesa',
				'tipos.nombre as tipo_nombre',
				'tipos.nombre_corto as tipo_nombre_corto',
				'tipos.tag as tipo_tag',
				'tipos.fa_icon as tipo_fa_icon',
				'tipos.css_class as tipo_css_class'
				)
            ->orderBy('id_mesa')
			->get();
		
		$datos_mesa_vacia = \App\Tipos::where('id', 4)->first();
		
		foreach ($pedidos as $ped)
		{
			$pedido_temp = new PedidosOut();
			
			if ($ped->id_pedido == null) {
				$ped->id_pedido = 0;
				$pedido_temp->TipoPedido = 4; //tipo pedido mesa vacía
				
				$pedido_temp->TipoPedido = 1; //pedido tipo mesa ocupada
				$pedido_temp->IdPedido = $ped->id_pedido;
				$pedido_temp->Observacion = $ped->nombre_mesa;
				$pedido_temp->IdMesa = $ped->id_mesa;
				
				$pedido_temp->TipoPedidoNombre = $datos_mesa_vacia->nombre;
				$pedido_temp->TipoPedidoNombreCorto = $datos_mesa_vacia->nombre_corto;
				$pedido_temp->TipoPedidoNombreTag = $datos_mesa_vacia->tag;
				$pedido_temp->TipoPedidoIcono = $datos_mesa_vacia->fa_icon;
				$pedido_temp->TipoPedidoCssClass = $datos_mesa_vacia->css_class;
			} 
			else 
			{
				$pedido_temp->TipoPedido = 1; //pedido tipo mesa ocupada
				$pedido_temp->IdPedido = $ped->id_pedido;
				$pedido_temp->Observacion = $ped->nombre_mesa;
				$pedido_temp->IdMesa = $ped->id_mesa;
				
				$pedido_temp->TipoPedidoNombre = $ped->tipo_nombre;
				$pedido_temp->TipoPedidoNombreCorto = $ped->tipo_nombre_corto;
				$pedido_temp->TipoPedidoNombreTag = $ped->tipo_tag;
				$pedido_temp->TipoPedidoIcono = $ped->tipo_fa_icon;
				$pedido_temp->TipoPedidoCssClass = $ped->tipo_css_class;
			}
			
			
			
			array_push($array, $pedido_temp);
		}
		
		/*************** PEDIDOS DISTINTOS A MESAS ******************/
		$pedidos = \DB::table('pedidos')
			->leftJoin('tipos', 'tipos.id', '=', 'pedidos.id_tipo')
            ->where('id_tipo','!=','1')
			->where('id_estado','=','1') //estado pendiente
			->select(
				'pedidos.id_tipo',
				'pedidos.id as id_pedido', 
				'tipos.nombre as tipo_nombre',
				'tipos.nombre_corto as tipo_nombre_corto',
				'tipos.tag as tipo_tag',
				'tipos.fa_icon as tipo_fa_icon',
				'tipos.css_class as tipo_css_class',
				
				'pedidos.observaciones',
				'pedidos.despacho_direccion',
				'pedidos.despacho_comuna',
				'pedidos.despacho_telefono',
				'pedidos.nombre_persona_retira'
				)
            ->orderBy('id_pedido')
			->get();
		
		foreach ($pedidos as $ped)
		{
			$pedido_temp = new PedidosOut();
			$pedido_temp->TipoPedido = $ped->id_tipo; //pedido tipo mesa ocupada
			$pedido_temp->IdPedido = $ped->id_pedido;
			$pedido_temp->Observaciones = $ped->observaciones;
			$pedido_temp->IdMesa = 0;
			
			$pedido_temp->DespachoDireccion = $ped->despacho_direccion;
			$pedido_temp->DespachoComuna = $ped->despacho_comuna;
			$pedido_temp->DespachoTelefono = $ped->despacho_telefono;
			$pedido_temp->NombrePersonaRetira = $ped->nombre_persona_retira;
			
			$pedido_temp->TipoPedidoNombre = $ped->tipo_nombre;
			$pedido_temp->TipoPedidoNombreCorto = $ped->tipo_nombre_corto;
			$pedido_temp->TipoPedidoNombreTag = $ped->tipo_tag;
			$pedido_temp->TipoPedidoIcono = $ped->tipo_fa_icon;
			$pedido_temp->TipoPedidoCssClass = $ped->tipo_css_class;
			
			array_push($array, $pedido_temp);
		}
		
		//lo devuelve como json
		return response()->json($array);
	}
	
	public function CrearPedido(Request $request)
	{
		$idtipo = $request->input('idtipo');
		$idpedido = $request->input('idpedido');
		$idmesa = $request->input('idmesa');
		$idcliente = $request->input('idcliente');
		
		//aqui crear pedido en blanco y luego 
		//enviar respuesta con el ID del pedido y el id de mesa
		$pedido = new \App\Pedidos();
		
		$pedido->subtotal = 0;
		$pedido->propina = 0;
		$pedido->total = 0;
		
		$pedido->id_cliente = $idcliente;
		
		$pedido->id_tipo = $idtipo;
		$pedido->id_estado = 1;
		
		$pedido->observaciones = "";
		
		$pedido->despacho_direccion = "";
		$pedido->despacho_comuna = "";
		$pedido->despacho_telefono = "";
		$pedido->nombre_persona_retira = "";
		
		$pedido->id_mesa = $idmesa;
		
		$pedido->save();
		
		//respuesta
        return response()->json(['codigo' => 1, 'mensaje' => 'Creado sin problemas', 'idpedido'=>$pedido->id, 'idmesa'=>$pedido->id_mesa]);
	}
	
	//detalle de pedido
	public function Detalle($idpedido,$idmesa)
	{
		//obtiene pedido
		$pedido_db = \App\Pedidos::where('id', $idpedido)->first();
		
		if ($pedido_db == null)
		{
			return response()->json(['codigo' => 0, 'mensaje' => 'ERROR: El pedido no existe']);
		}
		
		$pedido = new PedidosOut();
		$pedido->IdPedido = $pedido_db->id;
		$pedido->IdMesa = $pedido_db->id_mesa;
		$pedido->TipoPedido = $pedido_db->id_tipo;
		$pedido->Observaciones = $pedido_db->observaciones;
		
		$pedido->DespachoDireccion = $pedido_db->despacho_direccion;
		$pedido->DespachoComuna = $pedido_db->despacho_comuna;
		$pedido->DespachoTelefono = $pedido_db->despacho_telefono;
		$pedido->NombrePersonaRetira = $pedido_db->nombre_persona_retira;
		
		/*
			public $TipoPedidoNombreCorto; 
	public $TipoPedidoNombreTag; 
	public $TipoPedidoIcono; 
	public $TipoPedidoCssClass; 
		*/
		
		
		//obtiene los datos del tipo de pedido
		$tipo_db = \App\Tipos::where('id', $pedido_db->id_tipo)->first();
		$pedido->TipoPedidoNombre = $tipo_db->nombre;
		$pedido->TipoPedidoNombreCorto = $tipo_db->nombre_corto;
		$pedido->TipoPedidoNombreTag = $tipo_db->tag;
		$pedido->TipoPedidoIcono = $tipo_db->fa_icon;
		$pedido->TipoPedidoCssClass = $tipo_db->css_class;
		
		//obtiene detalle
		//obtengo el detalle actual
		$detalle_db = \App\Detalles::where('id_pedido','=',$pedido_db->id)->get();
		
		$pedido->productos_venta = array();
		
		//agrega los que no estan agregados
		foreach($detalle_db as $item)
		{
			
			array_push(
						$pedido->productos_venta, 
						new Items(
							$item->id,
							$item->id_producto,
							$item->nombre_producto, 
							$item->precio_unitario,
							$item->cantidad,
							$item->eliminado
						)
				);
			
		}
		
		return response()->json($pedido);
	}
	
	public function Confirmar(Request $request)
	{
		//obtiene pedido
		$pedido_request = $request->input('pedido');
		
		//setea valores en 0
		$v_subtotal = 0;
		$v_propina = 0;
		$v_total = 0;
		
		//traspasa pedido a objeto
		$pedido = new PedidosOut();
		foreach ($pedido_request as $key => $value)
		{
			if ($key != "productos_venta")
				$pedido->$key = $value;
			else
			{
				$pedido->productos_venta = array();
				
				foreach ($value as $i)
				{
					//($IdDetalle,$IdProducto, $Nombre, $PrecioUnitario, $Cantidad, $Eliminado
					array_push(
						$pedido->productos_venta, 
						new Items($i['IdDetalle'],$i['IdProducto'],$i['Nombre'], $i['PrecioUnitario'],$i['Cantidad'],$i['Eliminado'])
						);
						
					//sumo valores
					$v_subtotal = $v_subtotal + ($i['PrecioUnitario']*$i['Cantidad']);
				}
			}
		}
		
		//obtengo el pedido de la base de datos
		$id = $pedido->IdPedido;
		$pedido_db = \App\Pedidos::where('id', $id)->first();
		
		if ($pedido_db == null)
		{
			return response()->json(['codigo' => 0, 'mensaje' => 'ERROR: El pedido no existe']);
		}
		
		//actualizo los datos del pedido
		$pedido_db->subtotal = $v_subtotal;
		$pedido_db->propina = $v_subtotal*0.1;
		$pedido_db->total = $v_subtotal+$v_subtotal*0.1;
		
		$pedido_db->id_cliente = $pedido->IdCliente;
		
		//$pedido_db->id_tipo = $pedido->IdCliente;//tampoco se modifica
		//$pedido_db->id_estado = $pedido->IdCliente; //el estado no se modifica desde esta pantalla, se mantiene igual
		
		$pedido_db->observaciones = $pedido->Observaciones;
		
		$pedido_db->despacho_direccion = $pedido->DespachoDireccion;
		$pedido_db->despacho_comuna = $pedido->DespachoComuna;
		$pedido_db->despacho_telefono = $pedido->DespachoTelefono;
		
		$pedido_db->nombre_persona_retira = $pedido->NombrePersonaRetira;
		
		//$pedido_db->id_mesa = $pedido->IdMesa; //No se toca
		
		/************* AGREGA DETALLE *************/
		
		//obtengo el detalle actual
		$detalle_db = \App\Detalles::where('id_pedido','=',$pedido_db->id)->get();
		
		$detalles_array = array();
		
		//recorro los productos del listado
		foreach($pedido->productos_venta as $item)
		{
			//item nuevo en el listado
			if ($item->IdDetalle==0)
			{
				$detalle_temp = new \App\Detalles();
				
				$detalle_temp->id_pedido = $pedido->IdPedido;
				$detalle_temp->id_producto = $item->IdProducto;
				$detalle_temp->cantidad = $item->Cantidad;
				$detalle_temp->precio_unitario = $item->PrecioUnitario;
				$detalle_temp->eliminado = $item->Eliminado;
				$detalle_temp->nombre_producto = $item->Nombre;
				
				$detalle_temp->save();
			}
			
			//actualiza valores del resto
			foreach($detalle_db as $item_db)
			{
				if ($item_db->id == $item->IdDetalle)
				{
					$item_db->cantidad = $item->Cantidad;
					$item_db->eliminado = $item->Eliminado;
					
					$item_db->save();
				}
			}
			
		}
		
		//guarda pedido
		$pedido_db->save();
		
	/*
		\App\Detalles::insert($detalles_array); // Eloquent
		\DB::table('detalles')->insert($data); // Query Builder
		*/
		var_dump($pedido);
		var_dump($pedido_db);
		//return $pedido->productos_venta[0]['Cantidad'];
	}
	
	
	public function Eliminar($idpedido)
	{
		//obtiene datos
		$id_pedido = $idpedido;
		
		//ve si el id de pedido es valido
		if ($id_pedido<1 || $id_pedido == null)
		{
			return response()->json(['codigo' => 0, 'mensaje' => 'ERROR: El id de pedido es 0 o negativo']);
		}
		
		//busca pedido
		$pedido_db = \App\Pedidos::where('id', $id_pedido)->first();
		
		if ($pedido_db == null)
		{
			return response()->json(['codigo' => 0, 'mensaje' => 'ERROR: El pedido no existe']);
		}

		$pedido_db->id_estado = 3; //estado eliminado
		$pedido_db->save();
			
		return response()->json(['codigo' => 1, 'mensaje' => 'Pedido eliminado']);
	}
	
	public function Pagar(Request $request)
	{
		/*
		PARAMETROS:
		
				IdPedido: $scope.pedido,
                PagoEfectivo: $scope.PagoEfectivo,
                PagoCredito: $scope.PagoCredito,
                PagoDebito: $scope.PagoDebito,
                PagoCheque: $scope.PagoCheque
		
		*/
		
		$PagoEfectivo = 0;
		$PagoCredito = 0;
		$PagoDebito = 0;
		$PagoCheque = 0;
		
		//obtiene datos
		$id_pedido = $request->input('IdPedido');
		
		if (is_numeric($request->input('PagoEfectivo')) && $request->input('PagoEfectivo')>=0) $PagoEfectivo = $request->input('PagoEfectivo');
		if (is_numeric($request->input('PagoCredito')) && $request->input('PagoCredito')>=0) $PagoCredito = $request->input('PagoCredito');
		if (is_numeric($request->input('PagoDebito')) && $request->input('PagoDebito')>=0) $PagoDebito = $request->input('PagoDebito');
		if (is_numeric($request->input('PagoCheque')) && $request->input('PagoCheque')>=0) $PagoCheque = $request->input('PagoCheque');
		
		//ve si el id de pedido es valido
		if ($id_pedido<1 || $id_pedido == null)
		{
			return response()->json(['codigo' => 0, 'mensaje' => 'ERROR: El id de pedido es 0 o negativo']);
		}
		
		//busca pedido
		$pedido_db = \App\Pedidos::where('id', $id_pedido)->first();
		
		if ($pedido_db == null)
		{
			return response()->json(['codigo' => 0, 'mensaje' => 'ERROR: El pedido no existe']);
		}
		
		//carga datos pago
		$pedido_db->pago_efectivo = $PagoEfectivo;
		$pedido_db->pago_credito = $PagoCredito;
		$pedido_db->pago_debito = $PagoDebito;
		$pedido_db->pago_cheque = $PagoCheque;
		
		//cambia estado a pagado
		$pedido_db->id_estado = 2;
		
		$pedido_db->save();
		
		return response()->json(['codigo' => 1, 'mensaje' => 'Cuenta pagada']);
	}
	
	
}