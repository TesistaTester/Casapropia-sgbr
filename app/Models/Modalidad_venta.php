<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Modalidad_venta extends Model
{
    use HasFactory;
    protected $table = "modalidad_venta";
    protected $primaryKey = "mov_id";

    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    //Manzano proviene de: Urbanizacion
    public function propiedad(){
        return $this->belongsTo(Propiedad::class, 'pro_id');
    }

    /*
    ------------------------------------------------------------------------
    METODOS ADICIONALES
    ------------------------------------------------------------------------
     */
    public static function ultima_modalidad($pro_id){
        return DB::table('modalidad_venta')
                  ->where('pro_id', $pro_id)
                  ->latest()
                  ->first();
    }
    // public static function desactiva_modalidad($mov_id){

    // }

    
}
