<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Propietario_legal;
use App\Models\Persona;
use App\Rules\Persona_es_unico;

class Propietario_legalController extends Controller
{
    private $modulo = "propietarios";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('propietarios.form_nuevo_propietario_legal', [
            'modulo_activo' => $this->modulo,
            'titulo'=>'Nuevo propietario legal'
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
        $validacion = $request->validate([
            'per_tipo_documento'=>'required|min:1|max:1',
            'per_id'=>'required|min:1|max:100000000',
            'per_nro_id'=>['required','min:6','max:8'],
            'per_expedido'=>'required|min:2|max:2',
            'per_nombres'=>'required|min:2|max:50',
            'per_primer_apellido'=>'required|min:2|max:50',
            'per_segundo_apellido'=>'required|min:2|max:50',
            'per_fecha_nacimiento'=>'required|date',
            'per_sexo'=>'required|min:1|max:1',
            'per_estado_civil'=>'required|min:1|max:1'
        ]);

        if($request->input('per_id') == '0'){
            //PERSONA NUEVA Y PROPIETARIO NUEVO
            $persona = new Persona();
            $persona->pai_id = 1;//ID de Bolivia = 1, insertado en BD por seeder
            $persona->per_tipo_persona = 0;// Persona natural = 0
            $persona->per_tipo_documento = $request->input('per_tipo_documento');
            $persona->per_nro_id = $request->input('per_nro_id');
            $persona->per_expedido = $request->input('per_expedido');
            $persona->per_nombres = $request->input('per_nombres');
            $persona->per_primer_apellido = $request->input('per_primer_apellido');
            $persona->per_segundo_apellido = $request->input('per_segundo_apellido');
            $persona->per_fecha_nacimiento = $request->input('per_fecha_nacimiento');
            $persona->per_sexo = $request->input('per_sexo');
            $persona->per_estado_civil = $request->input('per_estado_civil');
            $persona->per_nombre_comercial = '';
            $persona->save();
    
            $propietario_legal = new Propietario_legal();
            $propietario_legal->per_id = $persona->per_id;
            $propietario_legal->save();
        }else{
            //PERSONA REGISTRADA Y PROPIETARIO NUEVO
            $propietario_legal = new Propietario_legal();
            $propietario_legal->per_id = $request->input('per_id');
            $propietario_legal->save();
        }

        return redirect('/propietarios');

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
        $propietario_legal = Propietario_legal::where('ple_id', $id)->first();
        $persona = $propietario_legal->persona;
        return view('propietarios.form_editar_propietario_legal', [
            'modulo_activo' => $this->modulo,
            'titulo'=>'Editar propietario legal',
            'propietario'=>$propietario_legal,
            'persona' => $persona   
        ]);

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
        $validacion = $request->validate([
            'per_tipo_documento'=>'required|min:1|max:1',
            'per_id'=>'required|min:1|max:100000000',
            'per_nro_id'=>['required','min:6','max:8'],
            'per_expedido'=>'required|min:2|max:2',
            'per_nombres'=>'required|min:2|max:50',
            'per_primer_apellido'=>'required|min:2|max:50',
            'per_segundo_apellido'=>'required|min:2|max:50',
            'per_fecha_nacimiento'=>'required|date',
            'per_sexo'=>'required|min:1|max:1',
            'per_estado_civil'=>'required|min:1|max:1'
        ]);

        $per_id = $request->input('per_id');
        $persona = Persona::where('per_id',$per_id)->first();
        $persona->pai_id = 1;//ID de Bolivia = 1, insertado en BD por seeder
        $persona->per_tipo_persona = 0;// Persona natural = 0
        $persona->per_tipo_documento = $request->input('per_tipo_documento');
        // $persona->per_nro_id = $request->input('per_nro_id');
        $persona->per_expedido = $request->input('per_expedido');
        $persona->per_nombres = $request->input('per_nombres');
        $persona->per_primer_apellido = $request->input('per_primer_apellido');
        $persona->per_segundo_apellido = $request->input('per_segundo_apellido');
        $persona->per_fecha_nacimiento = $request->input('per_fecha_nacimiento');
        $persona->per_sexo = $request->input('per_sexo');
        $persona->per_estado_civil = $request->input('per_estado_civil');
        $persona->per_nombre_comercial = '';
        $persona->save();

        $propietario_legal = Propietario_legal::where('ple_id', $id)->first();
        $propietario_legal->per_id = $per_id;
        $propietario_legal->save();

        return redirect('/propietarios');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $propietario_legal = Propietario_legal::where('ple_id', $id)->first();
        $propietario_legal->delete();
        return redirect('propietarios');
    }

    /**
     * Funcion para validar la existencia de un propietario LEGAL.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function valida_propietario(Request $request){
        $x = $request->input('per_nro_id');
        $existe_propietario_legal = Propietario_legal::existe_propietario_legal_por_nro_documento($x);        

        if($existe_propietario_legal != false){
            //si existe en propietario entonces mensaje de error
            return response()->json(['status'=>'3','msg'=>'Ya existe el propietario', 'propietario'=>$existe_propietario_legal]);
        }else{
            $existe_persona = Persona::existe_persona_por_nro_documento($x);
            if($existe_persona == false){
                //si no existe, entonces dejar continuar el llenado
                return response()->json(['status'=>'1','msg'=>'La persona no existe en BD, continuar el registro']);
            }else{
                //si existe en persona, mandar datos para autollenar
                $persona = Persona::get_persona_por_nro_documento($x);
                return response()->json(['status'=>'2','msg'=>'Solo existe en persona', 'persona'=>$persona]);
            }
        }

    }

}
