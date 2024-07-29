<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracionProgramaPago extends Model
{
    use HasFactory;
    protected $table = "configuracion_programa_pago";
    protected $primaryKey = "cof_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    public function programa_pago(){
        return $this->hasMany(ProgramaPago::class, 'cof_id');
    }
    public function contrato(){
        return $this->belongsTo(Contrato::class, 'con_id');
    }


}
