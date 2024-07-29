<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;
    protected $table = "municipio";
    protected $primaryKey = "mun_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    //Municipio tiene N domicilios
    public function municipios(){
        return $this->hasMany(Municipio::class, 'dep_id');
    }
    //Municipio proviene de 1 departamento
    public function departamento(){
        return $this->belongsTo(Departamento::class, 'dep_id');
    }



     /*
    ------------------------------------------------------------------------
    METODOS ADICIONALES
    ------------------------------------------------------------------------
     */
}
