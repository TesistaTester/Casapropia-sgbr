<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contrato extends Model
{
    use HasFactory;
    protected $table = "contrato";
    protected $primaryKey = "con_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    public function propiedad(){
        return $this->belongsTo(Propiedad::class, 'pro_id');
    }
    public function reconocimiento(){
        return $this->hasOne(ReconocimientoFirma::class, 'con_id');
    }
    public function clientes(){
        return $this->hasMany(FirmaCliente::class, 'con_id');
    }
    public function legales(){
        return $this->hasMany(FirmaPropietarioLegal::class, 'con_id');
    }
    public function adjuntos(){
        return $this->hasMany(AdjuntoContrato::class, 'con_id');
    }

}
