<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Propiedad extends Model
{
    use HasFactory;
    protected $table = "propiedad";
    protected $primaryKey = "pro_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    //Propiedad tiene un lote asociado
    public function lote(){
        return $this->hasOne(Lote::class, 'pro_id');
    }
    //Propiedad tiene N modalidades de venta
    public function modalidades_venta(){
        return $this->hasMany(Modalidad_venta::class, 'pro_id');
    }

    // public function estados(){
    //     return $this->hasMany(Estado_propiedad::class, 'pro_id');
    // }
    public function estados(){
        return $this->hasMany(Estado_propiedad::class, 'pro_id');
    }
    // public function estados(){
    //     return $this->belongsToMany(Estado_disponibilidad::class, 'estado_propiedad', 'pro_id', 'edi_id')->as('estado_propiedad')->withPivot('esp_fecha')->withTimestamps();
    // }

    //Lote proviene de: Manzano
    public function manzano(){
        return $this->belongsTo(Manzano::class, 'man_id');
    }
    //contratos
    public function contratos(){
        return $this->hasMany(Contrato::class, 'pro_id');
    }

    //Propietarios legales asignados
    // public function propietarios_legales(){
    //     return $this->hasMany(Asignacion_propietario_legal::class, 'pro_id');
    // }
    //Propietarios reales asignados
    // public function propietarios_reales(){
    //     return $this->hasMany(Asignacion_propietario_real::class, 'pro_id');
    // }


    /*
    ------------------------------------------------------------------------
    METODOS ADICIONALES
    ------------------------------------------------------------------------
     */
    //propietarios reales asignados a la propiedad
    public function propietarios_reales($pro_id){
        $propietarios_reales = DB::table('propietario_real')
        ->join('asignacion_propietario_real','propietario_real.prr_id' ,'=', 'asignacion_propietario_real.prr_id')
        ->join('persona','propietario_real.per_id' ,'=', 'persona.per_id')
        ->select('asignacion_propietario_real.*', 'propietario_real.*', 'persona.*')
        ->where('asignacion_propietario_real.pro_id', '=', $pro_id)
        ->get();
        return $propietarios_reales;
    }
    //propietarios reales libres (no asignados a la propiedad)
    public function prr_libres($pro_id){
        $propietarios_reales = DB::table('propietario_real')
        ->join('persona','propietario_real.per_id' ,'=', 'persona.per_id')
        ->select('propietario_real.*', 'persona.*')
        ->whereNotIn('propietario_real.prr_id', DB::table('asignacion_propietario_real')->where('pro_id','=',$pro_id)->pluck('prr_id'))
        ->get();
        return $propietarios_reales;
    }

    //propietarios legales asignados a la propiedad
    public function propietarios_legales($pro_id){
        $propietarios_legales = DB::table('propietario_legal')
        ->join('asignacion_propietario_legal','propietario_legal.ple_id' ,'=', 'asignacion_propietario_legal.ple_id')
        ->join('persona','propietario_legal.per_id' ,'=', 'persona.per_id')
        ->select('asignacion_propietario_legal.*', 'propietario_legal.*', 'persona.*')
        ->where('asignacion_propietario_legal.pro_id', '=', $pro_id)
        ->get();
        return $propietarios_legales;
    }
    //propietarios legales libres (no asignados a la propiedad)
    public function ple_libres($pro_id){
        $propietarios_legales = DB::table('propietario_legal')
        ->join('persona','propietario_legal.per_id' ,'=', 'persona.per_id')
        ->select('propietario_legal.*', 'persona.*')
        ->whereNotIn('propietario_legal.ple_id', DB::table('asignacion_propietario_legal')->where('pro_id','=',$pro_id)->pluck('ple_id'))
        ->get();
        return $propietarios_legales;
    }

}
