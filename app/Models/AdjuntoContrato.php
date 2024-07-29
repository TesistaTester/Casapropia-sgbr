<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdjuntoContrato extends Model
{
    use HasFactory;
    protected $table = "adjunto_contrato";
    protected $primaryKey = "aco_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    public function contrato(){
        return $this->belongsTo(Contrato::class, 'con_id');
    }


}
