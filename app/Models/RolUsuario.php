<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolUsuario extends Model
{
    use HasFactory;
    protected $table = "rol_usuario";
    protected $primaryKey = "rus_id";

    public function usuario(){
        return $this->belongsTo(Usuario::class, 'usu_id');
    }

    public function rol(){
        return $this->belongsTo(Rol::class, 'rol_id');
    }

}
