<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SessionData {
	public $IdEmpresa;
	public $NombreEmpresa;
	
    public $IdLocal;
	public $NombreLocal;
	
	public $IdGarzon;
	public $NombreGarzon;
	
	public $IdUsuario;
	public $NombreUsuario;
	
	public $MesasOcupadas;
	public $MesasDisponibles;
}

class ApiSessionController extends Controller
{
    public function Index() {
		/*
		//listado de pedidos
		$sessiondata = new SessionData();
		
		$sessiondata->IdEmpresa =0;
		$sessiondata->NombreEmpresa ="OM Gastronomía";
		
		$sessiondata->IdLocal = 0;
		$sessiondata->NombreLocal = "Manquehue";
		
		$sessiondata->IdGarzon = 0;
		$sessiondata->NombreGarzon = "Juan López";
		
		$sessiondata->IdUsuario = Session::get('IdUsuario');
		$sessiondata->NombreUsuario = Session::get('NombreUsuario');
		
		$sessiondata->MesasOcupadas = 5;
		$sessiondata->MesasDisponibles = 10;
		*/
		
		//listado de pedidos
		$sessiondata = new SessionData();
		
		$sessiondata->IdEmpresa =Session::get('IdEmpresa');
		$sessiondata->NombreEmpresa =Session::get('NombreEmpresa');
		
		$sessiondata->IdLocal = Session::get('IdEmpresa');
		$sessiondata->NombreLocal = Session::get('NombreLocal');
		
		$sessiondata->IdGarzon = Session::get('IdGarzon');
		$sessiondata->NombreGarzon = Session::get('NombreGarzon');
		
		$sessiondata->IdUsuario = Session::get('IdUsuario');
		$sessiondata->NombreUsuario = Session::get('NombreUsuario');
		
		//colocar aqui las mesas ocupadas y disponible desde la BD
		$sessiondata->MesasOcupadas = 5;
		$sessiondata->MesasDisponibles = 10;
		

		//lo devuelve como json
		return response()->json($sessiondata);
	}
	
	public function LoginUsuario(Request $request)
	{
		//obtiene nombre de usuario y clave
		$u_usuario = $request->input('usuario');
		$u_clave = $request->input('clave');
		
		//obtener aqui
		if (Auth::attempt(['username' => $u_usuario, 'password' => $u_clave])) {
            // Authentication passed...
			
			$user = Auth::user();
			
			Session::set('IdUsuario',$user->id);
			Session::set('NombreUsuario',$u_usuario);
			
			//datos empresa
			Session::set('IdEmpresa',12);
			Session::set('NombreEmpresa','Juan y medio');
			Session::set('IdLocal',34);
			Session::set('NombreLocal','Vitacura');
			
			//respuesta
            return response()->json(['codigo' => 1, 'mensaje' => 'Login correcto']);
        }
		
		//elimino el login siesq estaba logeado
		if (Auth::check()) {
            
            $user = Auth::user();
            Auth::logout();
            //echo "test: Logeado!";
        }
		
		//elimino datos de la cuenta
		Session::set('IdUsuario',0);
		Session::set('NombreUsuario','');
		
		//mensaje de retorno
		return response()->json(['codigo' => 0, 'mensaje' => 'Usuario/Contraseña incorrectos']);
		
	}
	
	public function Desconectar()
    {
        if (Auth::check()) {
            $user = Auth::user();
			Auth::logout();
        }
		
        return redirect('/');
    }
	
	public function SetGarzon(Request $request)
	{
		//obtiene CODIGO de garzon
		$g_codigo = $request->input('codigo');
		
		//en caso de que no exista el garzon, envía esto
		//return response()->json(['codigo' => 0, 'mensaje' => 'El código de garzon no existe']);
		
		$garzon = \App\Vendedores::where('codigo', $g_codigo)->first();
			   
		if ($garzon==null)
			return response()->json(['codigo' => 0, 'mensaje' => 'El vendedor no existe']);
		else 
		{
			//setea sesiones
			Session::set('IdGarzon',$garzon->id);
			Session::set('NombreGarzon',$garzon->nombre);
			
			return response()->json(['codigo' => 1, 'mensaje' => 'Bienvenido '.$garzon->nombre]);
		}
	}
}