<?php

namespace App\Http\Controllers;

use App\Models\ActividadEconomica;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\ClienteContacto;
use App\Models\ClienteActividad;
use App\Models\FormaContacto;
use App\Models\Departamento;
use App\Models\Domicilio;
use App\Models\Manzano;
use App\Models\Municipio;
use App\Models\Persona;
use App\Models\PersonaReferencia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class ClienteController extends Controller
{
    private $modulo = "clientes";
    private $max_edad_cliente = 100; //edad maxima de un cliente, para registro de calendario (validacion)
    private $min_edad_cliente = 18; // edad minima de un cliente, para registro de calendario (validacion)
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.detalle_clientes', ['titulo'=>'Clientes',
                                                          'clientes' => $clientes,
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
        $actividades_economicas = ActividadEconomica::all();
        $formas_contacto = FormaContacto::all();
        $departamentos = Departamento::all();
        $municipios = Municipio::all();
        $titulo = 'NUEVO CLIENTE';

        return view('clientes.form_nuevo_cliente', ['titulo'=>$titulo, 
                                                       'actividades'=>$actividades_economicas,
                                                       'formas_contacto'=>$formas_contacto,
                                                       'departamentos'=>$departamentos,
                                                       'municipios'=>$municipios,
                                                       'modulo_activo' => $this->modulo,
                                                       'min_edad_cliente' => $this->min_edad_cliente,
                                                       'max_edad_cliente' => $this->max_edad_cliente,
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
        //guardando archivo en storage
        // $ruta_foto = $request->file('cli_copia_ci')->store('clientes/ci_digitales', 'gcs');
        // $ruta_foto = $request->file('cli_copia_ci')->store('clientes/ci_digitales', 'public'); // store encadenado
        // return "Hola GCS: ".$ruta_foto;

        $validacion = $request->validate([
            //datos persona
            'per_tipo_documento'=>'required|numeric|min:0|max:2',
                    'per_nro_id'=>'required|min:6|max:8',
                  'per_expedido'=>'required|alpha|min:2|max:2',
                   'per_nombres'=>'required|min:2|max:50',
           'per_primer_apellido'=>'required|min:2|max:50',
          'per_segundo_apellido'=>'required|min:2|max:50',
          'per_fecha_nacimiento'=>'required|date',
                      'per_sexo'=>'required|alpha|min:1|max:1',
              'per_estado_civil'=>'required|numeric|min:0|max:5',
            //datos cliente
                      'cli_foto'=>'required|file|image|max:20000',
                  'cli_copia_ci'=>'required|file|mimes:pdf|max:20000',
                     'cli_email'=>'nullable|min:1|max:100|email',
                  'cli_telefono'=>'nullable|min:7|max:8',
            //datos domicilio
                      'dom_tipo'=>'required|min:0|max:3',
                        'mun_id'=>'required|min:1|max:100',
                      'dom_zona'=>'required|min:1|max:200',
             'dom_calle_avenida'=>'required|min:1|max:200',
                       'dom_nro'=>'required|min:1|max:100',
                   'dom_latitud'=>'nullable|numeric',
                  'dom_longitud'=>'nullable|numeric',
            //datos de actividad economica
                        'ace_id'=>'required|numeric|min:1|max:10000',
            //datos de persona de referencia
                   'pre_nombres'=>'required|min:1|max:100',
           'pre_primer_apellido'=>'required|min:1|max:100',
          'pre_segundo_apellido'=>'required|min:1|max:100',
                'pre_parentesco'=>'required|min:1|max:100',
                  'pre_telefono'=>'required|min:7|max:8',
             //datos de forma de contacto
                        'foc_id'=>'required|min:1|max:100',
        ]);
        //guardar persona
        if($request->input('per_id') == '0'){
            //PERSONA NUEVA Y PROPIETARIO NUEVO
            $persona = new Persona();
            $persona->pai_id = 1;//ID de Bolivia = 1, insertado en BD por seeder
            $persona->per_tipo_persona = $request->input('per_tipo_persona');
            $persona->per_tipo_documento = $request->input('per_tipo_documento');
            $persona->per_nro_id = $request->input('per_nro_id');
            $persona->per_expedido = $request->input('per_expedido');
            $persona->per_nombres = $request->input('per_nombres');
            $persona->per_primer_apellido = $request->input('per_primer_apellido');
            $persona->per_segundo_apellido = $request->input('per_segundo_apellido');
            $persona->per_fecha_nacimiento = $request->input('per_fecha_nacimiento');
            $persona->per_sexo = $request->input('per_sexo');
            $persona->per_estado_civil = $request->input('per_estado_civil');
            $persona->per_nombre_comercial = $request->input('per_nombre_comercial');
            $persona->save();    
        }else{
            //PERSONA REGISTRADA Y PROPIETARIO NUEVO
            $persona = Persona::where('per_id', $request->input('per_id'))->first();
        }
        //guardar cliente
        $cliente = new Cliente();
        $cliente->per_id = $persona->per_id;
        $cliente->cli_telefono = $request->input('cli_telefono');
        $cliente->cli_email = $request->input('cli_email');
        $codigo_cliente = 'T'.$cliente->persona->per_tipo_persona.'I'.$cliente->persona->per_id.'D'.$cliente->persona->per_nro_id;
        //creando carpeta cliente
        $disk = Storage::disk('public');
        $carpeta_cliente = 'docs_clientes/'.$codigo_cliente;
        $disk->makeDirectory($carpeta_cliente);
        $disk->put($carpeta_cliente.'/index.html', "Acceso no permitido");

        $uri_foto_cliente = $request->file('cli_foto')->storePublicly($carpeta_cliente, 'public'); // store encadenado
        $uri_docs_cliente = $request->file('cli_copia_ci')->storePublicly($carpeta_cliente, 'public'); // store encadenado
        $cliente->cli_foto = $uri_foto_cliente;
        $cliente->cli_copia_ci = $uri_docs_cliente;
        $cliente->save();
        //guardar domicilio
        $domicilio = new Domicilio();
        $domicilio->per_id = $persona->per_id;
        $domicilio->mun_id = $request->input('mun_id');
        $domicilio->dom_tipo = $request->input('dom_tipo');
        $domicilio->dom_zona = $request->input('dom_zona');
        $domicilio->dom_calle_avenida = $request->input('dom_calle_avenida');
        $domicilio->dom_nro = $request->input('dom_nro');
        $domicilio->dom_latitud = $request->input('dom_latitud');
        $domicilio->dom_longitud = $request->input('dom_longitud');
        $domicilio->save();
        //guardar actividad economica
        $cliente_actividad = new ClienteActividad();
        $cliente_actividad->cli_id = $cliente->cli_id;
        $cliente_actividad->ace_id = $request->input('ace_id');
        $cliente_actividad->save();
        //guardar persona de referencia
        $persona_ref = new Persona();
        $persona_ref->pai_id = 1;//ID de Bolivia = 1, insertado en BD por seeder
        $persona_ref->per_tipo_persona = 0;//persona natural
        $persona_ref->per_tipo_documento = 2;//otro tipo de documento
        $persona_ref->per_nro_id = random_int(999,99999);//numeros aleatorios en el rango 999 a 99999
        $persona_ref->per_expedido = 'LP';
        $persona_ref->per_nombres = $request->input('pre_nombres');
        $persona_ref->per_primer_apellido = $request->input('pre_primer_apellido');
        $persona_ref->per_segundo_apellido = $request->input('pre_segundo_apellido');
        $persona_ref->per_fecha_nacimiento = date('Y-m-d');
        $persona_ref->per_sexo = 'O';
        $persona_ref->per_estado_civil = '5';
        $persona_ref->per_nombre_comercial = '';
        $persona_ref->save();

        $persona_referencia = new PersonaReferencia();
        $persona_referencia->cli_id = $cliente->cli_id;
        $persona_referencia->per_id = $persona_ref->per_id;
        $persona_referencia->pre_parentesco = $request->input('pre_parentesco');
        $persona_referencia->pre_telefono = $request->input('pre_telefono');
        $persona_referencia->save();

        //guardar formas de contacto (seleccion multiple)
        $foc_id = $request->input('foc_id');
        foreach($foc_id as $item){
            $cliente_contacto = new ClienteContacto();
            $cliente_contacto->cli_id = $cliente->cli_id;
            $cliente_contacto->foc_id = $item;
            $cliente_contacto->save();
        }

        return redirect('clientes/');


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
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $cliente = Cliente::where('cli_id', $id)->first();
        $persona = $cliente->persona;
        $domicilio = $persona->domicilio;
        $actividades_economicas = ActividadEconomica::all();
        $formas_contacto = FormaContacto::all();
        $departamentos = Departamento::all();
        $municipios = Municipio::all();
        $titulo = 'EDITAR CLIENTE';
        $actividad = $cliente->cliente_actividad;
        $persona_referencia = $cliente->persona_referencia;
        $contactos = $cliente->cliente_contacto;

        return view('clientes.form_editar_cliente', [
                'cliente' => $cliente,
                'persona' => $persona,
                'domicilio' => $domicilio[0],
                'contactos'=>$contactos,
                'persona_referencia'=>$persona_referencia[0],
                'titulo'=>$titulo, 
                'actividad' => $actividad[0],
                'actividades'=>$actividades_economicas,
                'formas_contacto'=>$formas_contacto,
                'departamentos'=>$departamentos,
                'municipios'=>$municipios,
                'modulo_activo' => $this->modulo,
                'min_edad_cliente' => $this->min_edad_cliente,
                'max_edad_cliente' => $this->max_edad_cliente,

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
        $validacion = $request->validate([
            //datos persona
            'per_tipo_documento'=>'required|numeric|min:0|max:2',
                    'per_nro_id'=>'required|min:6|max:8',
                  'per_expedido'=>'required|alpha|min:2|max:2',
                   'per_nombres'=>'required|min:2|max:50',
           'per_primer_apellido'=>'required|min:2|max:50',
          'per_segundo_apellido'=>'required|min:2|max:50',
          'per_fecha_nacimiento'=>'required|date',
                      'per_sexo'=>'required|alpha|min:1|max:1',
              'per_estado_civil'=>'required|numeric|min:0|max:5',
            //datos cliente
                      'cli_foto'=>'nullable|file|image|max:20000',
                  'cli_copia_ci'=>'nullable|file|mimes:pdf|max:20000',
                     'cli_email'=>'nullable|min:1|max:100|email',
                  'cli_telefono'=>'nullable|min:7|max:8',
            //datos domicilio
                      'dom_tipo'=>'required|min:0|max:3',
                        'mun_id'=>'required|min:1|max:100',
                      'dom_zona'=>'required|min:1|max:200',
             'dom_calle_avenida'=>'required|min:1|max:200',
                       'dom_nro'=>'required|min:1|max:100',
                   'dom_latitud'=>'nullable|numeric',
                  'dom_longitud'=>'nullable|numeric',
            //datos de actividad economica
                        'ace_id'=>'required|numeric|min:1|max:10000',
            //datos de persona de referencia
                   'pre_nombres'=>'required|min:1|max:100',
           'pre_primer_apellido'=>'required|min:1|max:100',
          'pre_segundo_apellido'=>'required|min:1|max:100',
                'pre_parentesco'=>'required|min:1|max:100',
                  'pre_telefono'=>'required|min:7|max:8',
             //datos de forma de contacto
                        'foc_id'=>'required|min:1|max:100',
        ]);
        //guardar persona
        $per_id = Crypt::decryptString($request->input('per_id'));
        $persona = Persona::where('per_id', $per_id)->first();
        $persona->pai_id = 1;//ID de Bolivia = 1, insertado en BD por seeder
        $persona->per_tipo_persona = $request->input('per_tipo_persona');
        $persona->per_tipo_documento = $request->input('per_tipo_documento');
        // $persona->per_nro_id = $request->input('per_nro_id');
        $persona->per_expedido = $request->input('per_expedido');
        $persona->per_nombres = $request->input('per_nombres');
        $persona->per_primer_apellido = $request->input('per_primer_apellido');
        $persona->per_segundo_apellido = $request->input('per_segundo_apellido');
        $persona->per_fecha_nacimiento = $request->input('per_fecha_nacimiento');
        $persona->per_sexo = $request->input('per_sexo');
        $persona->per_estado_civil = $request->input('per_estado_civil');
        $persona->per_nombre_comercial = $request->input('per_nombre_comercial');
        $persona->save();    
        //guardar cliente
        $cli_id = Crypt::decryptString($id);
        $cliente = Cliente::where('cli_id', $cli_id)->first();
        // $cliente->per_id = $persona->per_id;
        $cliente->cli_telefono = $request->input('cli_telefono');
        $cliente->cli_email = $request->input('cli_email');
        //codigo de cliente para archivos
        $codigo_cliente = 'T'.$cliente->persona->per_tipo_persona.'I'.$cliente->persona->per_id.'D'.$cliente->persona->per_nro_id;
        //creando carpeta cliente
        $disk = Storage::disk('public');
        $carpeta_cliente = 'docs_clientes/'.$codigo_cliente;
        // $disk->makeDirectory($carpeta_cliente);
        // $disk->put($carpeta_cliente.'/index.html', "Acceso no permitido");

        if($request->file('cli_foto') != null){
            $uri_foto_cliente = $request->file('cli_foto')->storePublicly($carpeta_cliente, 'public'); // store encadenado
            $cliente->cli_foto = $uri_foto_cliente;
        }
        if($request->file('cli_copia_ci') != null){
            $uri_docs_cliente = $request->file('cli_copia_ci')->storePublicly($carpeta_cliente, 'public'); // store encadenado
            $cliente->cli_copia_ci = $uri_docs_cliente;
        }
        $cliente->save();
        //guardar domicilio
        $dom_id = $persona->domicilio[0]->dom_id;
        $domicilio = Domicilio::where('dom_id', $dom_id)->first();
        $domicilio->per_id = $persona->per_id;
        $domicilio->mun_id = $request->input('mun_id');
        $domicilio->dom_tipo = $request->input('dom_tipo');
        $domicilio->dom_zona = $request->input('dom_zona');
        $domicilio->dom_calle_avenida = $request->input('dom_calle_avenida');
        $domicilio->dom_nro = $request->input('dom_nro');
        $domicilio->dom_latitud = $request->input('dom_latitud');
        $domicilio->dom_longitud = $request->input('dom_longitud');
        $domicilio->save();
        //guardar actividad economica
        $cliente_actividad = ClienteActividad::where('cli_id', $cli_id)->first();
        $cliente_actividad->cli_id = $cliente->cli_id;
        $cliente_actividad->ace_id = $request->input('ace_id');
        $cliente_actividad->save();
        //guardar persona de referencia
        $persona_ref = $cliente->persona_referencia[0]->persona;
        // $persona_ref = new Persona();
        $persona_ref->pai_id = 1;//ID de Bolivia = 1, insertado en BD por seeder
        // $persona_ref->per_tipo_persona = 0;//persona natural
        // $persona_ref->per_tipo_documento = 2;//otro tipo de documento
        // $persona_ref->per_nro_id = random_int(999,99999);//numeros aleatorios en el rango 999 a 99999
        // $persona_ref->per_expedido = 'LP';
        $persona_ref->per_nombres = $request->input('pre_nombres');
        $persona_ref->per_primer_apellido = $request->input('pre_primer_apellido');
        $persona_ref->per_segundo_apellido = $request->input('pre_segundo_apellido');
        // $persona_ref->per_fecha_nacimiento = date('Y-m-d');
        // $persona_ref->per_sexo = 'O';
        // $persona_ref->per_estado_civil = '5';
        // $persona_ref->per_nombre_comercial = '';
        $persona_ref->save();

        $persona_referencia = $cliente->persona_referencia[0];
        // $persona_referencia = new PersonaReferencia();
        // $persona_referencia->cli_id = $cliente->cli_id;
        // $persona_referencia->per_id = $persona_ref->per_id;
        $persona_referencia->pre_parentesco = $request->input('pre_parentesco');
        $persona_referencia->pre_telefono = $request->input('pre_telefono');
        $persona_referencia->save();

        //guardar formas de contacto (seleccion multiple)
        //Primero eliminar los anteriores
        $cons = ClienteContacto::where('cli_id', $cli_id)->get();
        foreach($cons as $item){
            $item->delete();
        }
        //Luego registramos como nuevo
        $foc_id = $request->input('foc_id');
        foreach($foc_id as $item){
            $cliente_contacto = new ClienteContacto();
            $cliente_contacto->cli_id = $cliente->cli_id;
            $cliente_contacto->foc_id = $item;
            $cliente_contacto->save();
        }

        return redirect('clientes/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Crypt::decryptString($id);
        //eliminar clientes_contacto
        $cons = ClienteContacto::where('cli_id', $id)->get();
        foreach($cons as $item){
            $item->delete();
        }
        //eliminar clientes_actividad
        $clac = ClienteActividad::where('cli_id', $id)->get();
        foreach($clac as $item){
            $item->delete();
        }
        //eliminar persona_referencia
        $pref = PersonaReferencia::where('cli_id', $id)->get();
        foreach($pref as $item){
            $item->delete();
        }
        //eliminar cliente
        $cliente = Cliente::where('cli_id', $id)->first();
        $cliente->delete();
        return redirect('clientes');
    }

    /**
     * Funcion para validar la existencia de un cliente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function valida_cliente(Request $request){
        $x = $request->input('per_nro_id');
        $existe_cliente = Cliente::existe_cliente_por_nro_documento($x);        

        if($existe_cliente != false){
            //si existe en cliente entonces mensaje de error
            return response()->json(['status'=>'3','msg'=>'Ya existe el cliente', 'cliente'=>$existe_cliente]);
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

    /**
     * Funcion para validar la existencia de un cliente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function valida_persona(Request $request){
        $x = $request->input('per_nro_id');
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

        /*
        * Metodo: get_codigo_cliente
        * Params: Id de cliente
        * Return: String codigo cliente
        * ESPECIFICACION DE CODIGO DE CLIENTE
        * Primer caracter: C (Cliente)
        * Segundo caracter: 0 ó 1 (Tipo de cliente)
        * Tercer caracter: I (Abrev. Id de cliente en BD)
        * Cuarto y siguientes n digitos: Número de id en BD
        * Quinto: D (Abrev. Digitos)
        * Sexto y siguientes n digitos: Numero de documento de identificacion
        * Ejemplo: C0I567D6835147
        * Ref: C0 Persona natural
        *      I567 Id 567 en BD
        *      D6835147 Nro 6835147 en documento de identificacion
        */

    public function get_codigo_cliente($id){
        $cliente = Cliente::where('cli_id', $id)->first();
        if($cliente !== null){
            $tipo_cliente = $cliente->persona->per_tipo_persona;
            $nro_id = $cliente->persona->per_nro_id;
            return 'C'.$tipo_cliente.'I'.$id.'D'.$nro_id;
        }else{
            return null;
        }
    }

    
}
