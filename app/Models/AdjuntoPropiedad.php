<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdjuntoPropiedad extends Model
{
    use HasFactory;
    protected $table = "adjunto_propiedad";
    protected $primaryKey = "apo_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    public function propiedad(){
        return $this->belongsTo(Propiedad::class, 'pro_id');
    }

}
