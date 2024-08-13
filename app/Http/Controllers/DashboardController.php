<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private $modulo = "dashboard";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $contratos = Contrato::all();
        $usuario = Auth::user();
        $rol_codigo_session = session('rol_codigo');
        $rol_nombre = '';
        foreach($usuario->roles_usuario as $item){
            if($item->rol->rol_codigo === $rol_codigo_session){
                $rol_nombre = $item->rol->rol_nombre;
            }
        }
        $request->session()->put('rol_nombre', $rol_nombre);
        return view('inicio.admin_dashboard', ['titulo'=>'Panel de inicio',
                                                          'modulo_activo' => $this->modulo,
                                                 ]);
    }

    public function role_selector()
    {
        // $contratos = Contrato::all();
        $usuario = Auth::user();
        $roles = $usuario->roles_usuario;

        return view('inicio.role_selector', ['titulo'=>'Selector de rol',
                                                          'modulo_activo' => $this->modulo,
                                                          'roles'=> $roles
                                                 ]);
    }

}
