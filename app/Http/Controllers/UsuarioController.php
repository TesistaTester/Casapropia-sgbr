<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Persona;
use App\Models\Rol;
use App\Models\RolUsuario;
use App\Models\SolicitudPassword;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Mail\CuentaCreada;
use App\Mail\AdminPasswordReset;

class UsuarioController extends Controller
{
    private $modulo = "usuarios";
    /**
     * TIEMPO DE EXPIRACION DE PASSWORD
     * Para la primera vez = 10 dias
     * Luego de la primera renovacion (actualizacion) = 60 dias 
     * **/
    // private CONST TIEMPO_EXPIRACION_PASSWORD = 60; //en dias
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.detalle_usuarios', ['titulo'=>'Usuarios',
                                                          'usuarios' => $usuarios,
                                                          'modulo_activo' => $this->modulo
                                                         ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Rol::all();
        $titulo = 'NUEVO USUARIO';

        return view('usuarios.form_nuevo_usuario', ['titulo'=>$titulo, 
                                                       'roles'=>$roles,
                                                       'modulo_activo' => $this->modulo,
                                                    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validacion = $request->validate([
            //datos persona
            'per_tipo_documento'=>'required|numeric|min:0|max:2',
                    'per_nro_id'=>'required|min:6|max:8',
                  'per_expedido'=>'required|alpha|min:2|max:2',
                   'per_nombres'=>'required|min:2|max:50',
           'per_primer_apellido'=>'required|min:2|max:50',
          'per_segundo_apellido'=>'required|min:2|max:50',
            //datos cliente
                      'usu_email'=>'required|min:2|max:50|email',
        ]);
        //guardar persona
        if($request->input('per_id') == '0'){
            //PERSONA NUEVA
            $persona = new Persona();
            $persona->pai_id = 1;//ID de Bolivia = 1, insertado en BD por seeder
            $persona->per_tipo_persona = 0;
            $persona->per_tipo_documento = $request->input('per_tipo_documento');
            $persona->per_nro_id = $request->input('per_nro_id');
            $persona->per_expedido = $request->input('per_expedido');
            $persona->per_nombres = $request->input('per_nombres');
            $persona->per_primer_apellido = $request->input('per_primer_apellido');
            $persona->per_segundo_apellido = $request->input('per_segundo_apellido');
            $persona->per_fecha_nacimiento = '1900-01-01';
            $persona->per_sexo = 'O';
            $persona->per_estado_civil = 5;
            $persona->per_nombre_comercial = '';
            $persona->save();    
        }else{
            //PERSONA REGISTRADA Y PROPIETARIO NUEVO
            $persona = Persona::where('per_id', $request->input('per_id'))->first();
        }
        //guardar usuario
        $usuario = new Usuario();
        $usuario->per_id = $persona->per_id;
        $usuario->usu_email = $request->input('usu_email');
        $pwd = Str::upper(Str::random(6));
        $usuario->password = Hash::make($pwd);
        $usuario->usu_primer_login = false;
        $usuario->usu_expiracion_passsword = Carbon::now()->add(10,'day');//El password predeterminado (primero) expira en 10 dias
        $usuario->usu_activo = true;

        $codigo_usuario = 'USR'.$usuario->usu_id;
        //creando carpeta de usuario
        $disk = Storage::disk('public');
        $carpeta_usuario = 'docs_usuarios/'.$codigo_usuario;
        $disk->makeDirectory($carpeta_usuario);
        $disk->put($carpeta_usuario.'/index.html', "Acceso no permitido");

        $uri_foto_usuario = $request->file('usu_foto')->storePublicly($carpeta_usuario, 'public'); // store encadenado
        $usuario->usu_foto = $uri_foto_usuario;
        $usuario->save();

        //guardar roles asignados
        $rol_id = $request->input('rol_id');
        foreach($rol_id as $item){
            $rol_usuario = new RolUsuario();
            $rol_usuario->rol_id = $item;
            $rol_usuario->usu_id = $usuario->usu_id;
            $rol_usuario->rus_descripcion = "ASIGNADO EN REGISTRO";
            $rol_usuario->save();
        }

        Mail::to($request->input('usu_email'))->send(new CuentaCreada($request->input('usu_email'), $pwd, $persona->per_nombres));

        return redirect('usuarios/');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $usuario = Usuario::where('usu_id', $id)->first();
        $roles = RolUsuario::where('usu_id', $id)->get();
        $solicitudes = SolicitudPassword::where('usu_id', $id)->get();
        foreach($roles as $item){
            $item->delete();
        }
        foreach($solicitudes as $item){
            $item->delete();
        }
        $usuario->delete();
        return redirect('usuarios');
    }

    /**
     * Funcion para validar la existencia de un usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function valida_usuario(Request $request){
        $x = $request->input('per_nro_id');
        $existe_usuario = Usuario::existe_usuario_por_nro_documento($x);        

        if($existe_usuario != false){
            //si existe en usuario entonces mensaje de error
            return response()->json(['status'=>'3','msg'=>'Ya existe el usuario', 'usuario'=>$existe_usuario]);
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
     * Funcion para validar la existencia de un email de usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function valida_email(Request $request){
        $x = $request->input('usu_email');
        $existe_email = Usuario::existe_email($x);        

        if($existe_email != false){
            //si existe en usuario entonces mensaje de error
            return response()->json(['status'=>'2','msg'=>'Ya existe el usuario']);
        }else{
            return response()->json(['status'=>'1','msg'=>'El email no existe en BD, continuar el registro']);
        }

    }

    /**
     * Resetear password.
     */
    public function resetear_password(Request $request, string $id)
    {
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $usuario = Usuario::where('usu_id', $id)->first();
        $pwd = Str::upper(Str::random(6));
        $usuario->password = Hash::make($pwd);
        $usuario->usu_expiracion_passsword = Carbon::now()->add(config('TIEMPO_EXPIRACION_PASSWORD'),'day');
        $usuario->save();

        Mail::to($usuario->usu_email)->send(new AdminPasswordReset($usuario->usu_email, $pwd, $usuario->persona->per_nombres));

        return redirect('usuarios/');

    }

    public function update_password(Request $request, $id)
    {
        //guardar usuario
        $id = Crypt::decryptString($id);//Desencriptando parametro ID
        $usuario = Usuario::where('usu_id', $id)->first();
        if(Hash::check($request->input('pwd_actual'), $usuario->password)){
            $usuario->password = Hash::make($request->input('pwd_nuevo'));
            $usuario->usu_expiracion_passsword = Carbon::now()->add(config('TIEMPO_EXPIRACION_PASSWORD'),'day');
            $usuario->save();
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'2']);
        }
    }


}
