<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudPassword extends Model
{
    use HasFactory;
    protected $table = "solicitud_password";
    protected $primaryKey = "spa_id";

    public function usuario(){
        return $this->belongsTo(Usuario::class, 'usu_id');
    }

}
