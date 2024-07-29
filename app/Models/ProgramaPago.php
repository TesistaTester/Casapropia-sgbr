<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramaPago extends Model
{
    use HasFactory;
    protected $table = "programa_pago";
    protected $primaryKey = "ppa_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    public function recibo_pago(){
        return $this->hasMany(ReciboPago::class, 'ppa_id');
    }
    public function configuracion_programa(){
        return $this->belongsTo(ConfiguracionProgramaPago::class, 'cof_id');
    }

}
