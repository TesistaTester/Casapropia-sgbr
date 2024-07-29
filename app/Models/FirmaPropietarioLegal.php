<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirmaPropietarioLegal extends Model
{
    use HasFactory;
    protected $table = "firma_propietario_legal";
    protected $primaryKey = "fip_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    public function propietarios_legales(){
        return $this->belongsTo(Propietario_legal::class, 'ple_id');
    }
    public function contrato(){
        return $this->belongsTo(Contrato::class, 'con_id');
    }

}
