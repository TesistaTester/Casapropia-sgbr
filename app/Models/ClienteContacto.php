<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteContacto extends Model
{
    use HasFactory;
    protected $table = "cliente_contacto";
    protected $primaryKey = "cco_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    //Cliente_contacto proviene de: Cliente
    public function cliente(){
        return $this->belongsTo(Cliente::class, 'cli_id');
    }
    //Cliente_actividad proviene de: Cliente
    public function forma_contacto(){
        return $this->belongsTo(FormaContacto::class, 'foc_id');
    }

    /*
    ------------------------------------------------------------------------
    METODOS ADICIONALES
    ------------------------------------------------------------------------
     */

}
