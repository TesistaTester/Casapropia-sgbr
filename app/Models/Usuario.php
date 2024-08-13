<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\DB;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = "usuario";
    protected $primaryKey = "usu_id";

    public function persona(){
        return $this->belongsTo(Persona::class, 'per_id');
    }

    public function roles_usuario(){
        return $this->hasMany(RolUsuario::class, 'usu_id');
    }

    public function solicitudes(){
        return $this->belongsTo(Persona::class, 'per_id');
    }

    //metodo para verificar la existencia de un usuario registrado
    public static function existe_usuario_por_nro_documento($x){
        $usuario = DB::table('usuario')
                                ->join('persona','usuario.per_id' ,'=', 'persona.per_id')
                                ->select('persona.*', 'usuario.*')
                                ->where('persona.per_nro_id', '=', $x)
                                ->get();
        if($usuario->count() > 0){
            return $usuario;
        }else{
            return false;
        }                        
    }

    //metodo para verificar la existencia de un  registrado
    public static function existe_email($x){
        $usuario = DB::table('usuario')
                                ->where('usu_email', '=', $x)
                                ->get();
        if($usuario->count() > 0){
            return $usuario;
        }else{
            return false;
        }                        
    }

}
