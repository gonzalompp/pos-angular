<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class DataArqueo
{
	public $Id;
	public $FechaDesde;
	public $FechaHasta;
	public $FechaRegistro;
	
	//fechas
    public $ArqueoFechaInicio;
    public $ArqueoHoraInicio;
    public $ArqueoFechaTermino;
    public $ArqueoHoraTermino;
    
    public $PagoEfectivo;
    public $PagoCredito;
    public $PagoDebito;
    public $PagoCheque;
	
	public $Cargado;
	
	public $First;
}

class ApiArqueoCajaController extends Controller
{
	//$pedidos = \DB::table('mesas')
	
	public function Guardar(Request $request) {
		$arqueosistema = $request->input('ArqueoSistema');
		$arqueoregistrado = $request->input('ArqueoRegistrado');

		//nuevo arqueo
		$arqueo = new \App\Arqueos();
		
		$fi = explode("/", $arqueoregistrado['ArqueoFechaInicio']);
		$ft = explode("/", $arqueoregistrado['ArqueoFechaTermino']);
		
		$arqueo->fecha_desde =$fi[2]."-".$fi[1]."-".$fi[0]." ".$arqueoregistrado['ArqueoHoraInicio'].':00';
		$arqueo->fecha_hasta =$ft[2]."-".$ft[1]."-".$ft[0]." ".$arqueoregistrado['ArqueoHoraTermino'].':00';
		
		
		//registrado en sistema
		$arqueo->sistema_efectivo = $arqueosistema['PagoEfectivo'];
		$arqueo->sistema_credito = $arqueosistema['PagoCredito'];
		$arqueo->sistema_debito = $arqueosistema['PagoDebito'];
		$arqueo->sistema_cheque = $arqueosistema['PagoCheque'];
		
		//ingreso x conteo manual usuario
		$arqueo->registrado_efectivo = $arqueoregistrado['PagoEfectivo'];
		$arqueo->registrado_credito = $arqueoregistrado['PagoCredito'];
		$arqueo->registrado_debito = $arqueoregistrado['PagoDebito'];
		$arqueo->registrado_cheque = $arqueoregistrado['PagoCheque'];
		
		$arqueo->id_user = Session::get('IdUsuario');
		$arqueo->id_garzon = Session::get('IdGarzon');
		
		$arqueo->save();
		
		//respuesta
        return response()->json([
			'codigo' => 1, 
			'mensaje' =>  "Arqueo guardado"
		]);
	}
	
	public function GetValores($fi, $ft) {
		
		//fecha debug_backtrace inicio
		$fi = explode(" ", $fi);
		$fi_fecha_ori = explode("-", $fi[0]);
		$fi_fecha = $fi_fecha_ori;
		$fi_fecha = $fi_fecha[2]."-".$fi_fecha[1]."-".$fi_fecha[0]." ".$fi[1].":00";
		
		//fecha de termino
		$ft = explode(" ", $ft);
		$ft_fecha_ori = explode("-", $ft[0]);
		$ft_fecha = $ft_fecha_ori;
		$ft_fecha = $ft_fecha[2]."-".$ft_fecha[1]."-".$ft_fecha[0]." ".$ft[1].":00";
		
		
		//valida la fecha
		 $arqueos = \App\Arqueos::where('fecha_hasta', '>', $fi_fecha)->get();

		 if (count($arqueos)>0)
		 return response()->json([
			'codigo' => 0, 
			'mensaje' =>  "Ya existe un arqueo posterior a la fecha de inicio (".$fi_fecha.")"
		]);
		
		
		
		//obtiene valores
		$pedidos = \DB::table('pedidos')
			->where('created_at', '>=', $fi_fecha)
			->where('created_at', '<=', $ft_fecha)
            ->select(
				\DB::raw('SUM(pago_efectivo) as pago_efectivo'), 
				\DB::raw('SUM(pago_credito) as pago_credito'),
				\DB::raw('SUM(pago_debito) as pago_debito'),
				\DB::raw('SUM(pago_cheque) as pago_cheque'),
				\DB::raw('COUNT(id) as pagos')
				)
			->first();
			
		if ($pedidos==NULL)
		return response()->json([
			'codigo' => 0, 
			'mensaje' =>  "Error al consultar los pedidos"
		]);
		
		//valido si es que no hay ventas
		if ($pedidos->pagos == 0)
		return response()->json([
			'codigo' => 0, 
			'mensaje' =>  "No existen ventas durante ese periodo"
		]);
		
		//todo ok
		$data_arqueo = new DataArqueo();

		$data_arqueo->ArqueoFechaInicio = $fi[0];
		$data_arqueo->ArqueoHoraInicio = $fi[1];
		$data_arqueo->ArqueoFechaTermino = $ft[0];
		$data_arqueo->ArqueoHoraTermino = $ft[1];

		$data_arqueo->PagoEfectivo = $pedidos->pago_efectivo;
		$data_arqueo->PagoCredito = $pedidos->pago_credito;
		$data_arqueo->PagoDebito = $pedidos->pago_debito;
		$data_arqueo->PagoCheque = $pedidos->pago_cheque;
		
		$data_arqueo->Cargado = 1;
		
		//respuesta
        return response()->json([
			'codigo' => 1, 
			'mensaje' =>  "Resultados de ventas cargados",
			'data' =>$data_arqueo
		]);
	}
	
	public function GetArqueosAnteriores()
	{
		$arqueos = \App\Arqueos::orderBy('created_at', 'DESC')->take(10)->get();
		
		$array = array();
		
		$first = true;
		
		foreach($arqueos as $arq)
		{
			$data_arqueo = new DataArqueo();
			$data_arqueo->Id = $arq->id;
			$data_arqueo->FechaDesde = $arq->fecha_desde;
			$data_arqueo->FechaHasta = $arq->fecha_hasta;
			$data_arqueo->FechaRegistro = date($arq->created_at);
			
			if ($first == true) {
				$data_arqueo->First = "UltimoArqueoClass";
				$first = false;
			} else {
				$data_arqueo->First = "";
			}
			
			
			
			array_push($array, $data_arqueo);
		}
		
		
		
		return response()->json([
			'codigo' => 1, 
			'mensaje' =>  "Ultimos arqueos de caja",
			'data' =>$array
		]);
	}
}