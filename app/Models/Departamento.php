<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;
    protected $table = "departamento";
    protected $primaryKey = "dep_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    //Departamento tiene N Municipios
    public function municipios(){
        return $this->hasMany(Municipio::class, 'dep_id');
    }
    //Departamento proviene de 1 pais
    public function pais(){
        return $this->belongsTo(Pais::class, 'pai_id');
    }



     /*
    ------------------------------------------------------------------------
    METODOS ADICIONALES
    ------------------------------------------------------------------------
     */
}
