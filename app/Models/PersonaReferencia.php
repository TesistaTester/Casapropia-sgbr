<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonaReferencia extends Model
{
    use HasFactory;

    protected $table = "persona_referencia";
    protected $primaryKey = "pre_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    //Persona_referencia proviene de un cliente
    public function cliente(){
        return $this->belongsTo(Cliente::class, 'cli_id');
    }
    //Persona_referencia proviene de una persona
    public function persona(){
        return $this->belongsTo(Persona::class, 'per_id');
    }


     /*
    ------------------------------------------------------------------------
    METODOS ADICIONALES
    ------------------------------------------------------------------------
     */


}
