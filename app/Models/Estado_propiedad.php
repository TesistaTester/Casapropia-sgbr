<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Estado_propiedad extends Model
{
    use HasFactory;
    protected $table = "estado_propiedad";
    protected $primaryKey = "esp_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    public function estado(){
        return $this->belongsTo(Estado_disponibilidad::class, 'edi_id');
    }
    public function propiedad(){
        return $this->belongsTo(Propiedad::class, 'pro_id');
    }


    /*
    ------------------------------------------------------------------------
    METODOS ADICIONALES
    ------------------------------------------------------------------------
     */
    public static function ultimo_estado($pro_id){
        return DB::table('estado_propiedad')
                  ->where('pro_id', $pro_id)
                  ->latest()
                  ->first();
    }

}
