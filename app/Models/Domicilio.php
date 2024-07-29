<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domicilio extends Model
{
    use HasFactory;
    protected $table = "domicilio";
    protected $primaryKey = "dom_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    //Domicilio proviene de 1 municipio
    public function pais(){
        return $this->belongsTo(Pais::class, 'pai_id');
    }
    //Domicilio proviene de 1 persona
    public function persona(){
        return $this->belongsTo(Persona::class, 'per_id');
    }
    //Domicilio proviene de 1 municipio
    public function municipio(){
        return $this->belongsTo(Municipio::class, 'mun_id');
    }

     /*
    ------------------------------------------------------------------------
    METODOS ADICIONALES
    ------------------------------------------------------------------------
     */
}
