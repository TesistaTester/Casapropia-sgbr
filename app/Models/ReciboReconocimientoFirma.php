<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReciboReconocimientoFirma extends Model
{
    use HasFactory;
    protected $table = "recibo_reconocimiento_firma";
    protected $primaryKey = "ref_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    public function reconocimiento(){
        return $this->belongsTo(ReconocimientoFirma::class, 'rfi_id');
    }

}
