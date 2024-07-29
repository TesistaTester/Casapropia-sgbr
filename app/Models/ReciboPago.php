<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReciboPago extends Model
{
    use HasFactory;
    protected $table = "recibo_pago";
    protected $primaryKey = "rep_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    public function programa(){
        return $this->belongsTo(ProgramaPago::class, 'ppa_id');
    }

}
