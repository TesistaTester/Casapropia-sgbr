<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirmaCliente extends Model
{
    use HasFactory;
    protected $table = "firma_cliente";
    protected $primaryKey = "fic_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    public function cliente(){
        return $this->belongsTo(Cliente::class, 'cli_id');
    }
    public function contrato(){
        return $this->belongsTo(Contrato::class, 'con_id');
    }

}
