<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthTestController extends Controller
{
    public function Index() {
		
        $email = 'caja1';
        $password = '1234';

        if (Auth::attempt(['username' => $email, 'password' => $password])) {
            // Authentication passed...
            return "logeado";
        }
        
        return "NO logeado";
        
    }
    
    public function TestLogin()
    {
        if (Auth::check()) {
            
            $user = Auth::user();
            var_dump($user);
            //Auth::logout();
            //echo "test: Logeado!";
        }
        else
        return "TEST: NO logeado";
    }
}