<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReconocimientoFirma extends Model
{
    use HasFactory;
    protected $table = "reconocimiento_firma";
    protected $primaryKey = "rfi_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    public function contrato(){
        return $this->belongsTo(Contrato::class, 'con_id');
    }
    public function recibo(){
        return $this->hasOne(Recibo_reconocimiento_firma::class, 'rfi_id');
    }

}
