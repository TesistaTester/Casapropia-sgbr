<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaContacto extends Model
{
    use HasFactory;
    protected $table = "forma_contacto";
    protected $primaryKey = "foc_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    //Forma_contacto tiene N: cliente_contacto
    public function cliente_contacto(){
        return $this->hasMany(ClienteContacto::class, 'foc_id');
    }

    /*
    ------------------------------------------------------------------------
    METODOS ADICIONALES
    ------------------------------------------------------------------------
     */


}
