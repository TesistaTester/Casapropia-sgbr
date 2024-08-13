<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function autenticar(Request $request)
    {
        try {
            $usr = $request->input('uuo');
            $pwd = $request->input('ovc');
            $credenciales = $request->validate([
                'uuo' => 'required|email',
                'ovc' => 'required',
                // 'g-recaptcha-response' => 'required|recaptchav3:captcha,0.9' 
            ]);
    
            if(Auth::attempt(['usu_email' => $usr, 'password' => $pwd])){
                $request->session()->regenerate();
                $usuario = Auth::user();
                if(count($usuario->roles_usuario) > 1){
                    return redirect('/role_selector');
                }else{
                    $rol_codigo = Auth::user()->roles_usuario[0]->rol->rol_codigo;
                    $rol_nombre = Auth::user()->roles_usuario[0]->rol->rol_nombre;
                    $request->session()->put('rol_codigo', $rol_codigo);
                    $request->session()->put('rol_nombre', $rol_nombre);
                    return redirect('/inicio');
                }
            }
            return redirect('/login');
            } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function role_director(Request $request)
    {
        try {
            $credenciales = $request->validate([
                'rol_id' => 'required|numeric',
            ]);
            $request->session()->put('rol_codigo', $request->rol_id);
            return redirect('/inicio');
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function logout(Request $request){
        Auth::logout();//elimina los datos de sesion del usuario
        // $request->session()->invalidate(); //inicializa la sesion y genera un ID nuevo
        // $request->session()->regenerateToken();//regenera el toke CSRF
        $request->session()->flush();
        return redirect('/login');
    }

    
}


// $2y$10$mFz0R4X37lVQf2T5ILqZF.hgNG822FahLnNvyjXXSJPsHBue/6XjK