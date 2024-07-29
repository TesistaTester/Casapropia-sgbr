<?php

namespace App\Http\Controllers;

use App\Models\Propietario_real;
use App\Models\Propietario_legal;
use Illuminate\Http\Request;

class PropietarioController extends Controller
{
    private $modulo = "propietarios";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propietarios_reales = Propietario_real::all();
        $propietarios_legales = Propietario_legal::all();
        return view('propietarios.detalle_propietarios', [
            'modulo_activo' => $this->modulo,
            'titulo'=>'Registro de propietarios',
            'reales' => $propietarios_reales,
            'legales' => $propietarios_legales      
        ]);
    }

}
