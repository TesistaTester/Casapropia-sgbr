<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;
    protected $table = "pais";
    protected $primaryKey = "pai_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    //Pais tiene N personas
    public function personas(){
        return $this->hasMany(Persona::class, 'pai_id');
    }
    //Pais tiene N departamentos
    public function departamentos(){
        return $this->hasMany(Departamentos::class, 'pai_id');
    }



     /*
    ------------------------------------------------------------------------
    METODOS ADICIONALES
    ------------------------------------------------------------------------
     */

}
