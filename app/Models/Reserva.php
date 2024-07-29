<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    protected $table = "reserva";
    protected $primaryKey = "res_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    public function persona(){
        return $this->belongsTo(Persona::class, 'per_id');
    }
    public function descargo(){
        return $this->hasOne(DescargoReserva::class, 'res_id');
    }
}
