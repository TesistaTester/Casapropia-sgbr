<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescargoReserva extends Model
{
    use HasFactory;
    protected $table = "descargo_reserva";
    protected $primaryKey = "dre_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    public function reserva(){
        return $this->belongsTo(Reserva::class, 'res_id');
    }
    // public function cuenta(){
    //     return $this->belongsTo(Cuenta::class, 'res_id');
    // }
}
