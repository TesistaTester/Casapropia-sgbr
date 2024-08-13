<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\Propiedad;
use App\Models\Propietario_legal;
use App\Models\Urbanizacion;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    private $modulo = "contratos";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contratos = Contrato::all();
        return view('contratos.lista_contratos', ['titulo'=>'Contratos',
                                                          'contratos' => $contratos,
                                                          'modulo_activo' => $this->modulo
                                                         ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $propiedades = Propiedad::all();
        $urbanizaciones = Urbanizacion::all();
        $clientes = Cliente::all();
        // $propietarios = Propietario_legal::all();
        return view('contratos.form_nuevo_contrato', ['titulo'=>'Registrar contrato',
                                                          'urbanizaciones' => $urbanizaciones,
                                                          'clientes' => $clientes,
                                                        //   'propietarios' => $propietarios,
                                                          'propiedades' => $propiedades,
                                                          'modulo_activo' => $this->modulo
                                                         ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
