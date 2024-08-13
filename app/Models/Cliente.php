<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClienteActividad;
use App\Models\ClienteContacto;
use Illuminate\Support\Facades\DB;

class Cliente extends Model
{
    use HasFactory;
    protected $table = "cliente";
    protected $primaryKey = "cli_id";
    /*
    ------------------------------------------------------------------------
    METODOS PARA RELACIONES
    ------------------------------------------------------------------------
     */
    //Cliente proviene de: Persona
    public function persona(){
        return $this->belongsTo(Persona::class, 'per_id');
    }
    //Cliente tiene N actividades
    public function cliente_actividad(){
        return $this->hasMany(ClienteActividad::class, 'cli_id');
    }
    //Cliente tiene N personas_referencia
    public function persona_referencia(){
        return $this->hasMany(PersonaReferencia::class, 'cli_id');
    }

    //Cliente tiene N cliente_contacto
    public function cliente_contacto(){
        return $this->hasMany(ClienteContacto::class, 'cli_id');
    }
    public function actividad_economica(){
        return $this->belongsToMany(ActividadEconomica::class,'cliente_actividad','cli_id', 'ace_id');
    }
    //Cliente tiene N contratos
    // public function contratos(){
    //     return $this->hasMany(Contrato::class, 'cli_id');
    // }

    /*
    ------------------------------------------------------------------------
    METODOS ADICIONALES
    ------------------------------------------------------------------------
     */
    //cliente tiene n contratos provisional
    public function contratos(){
        return collect();
    }
    //metodo para verificar la existencia de un cliente registrado
    public static function existe_cliente_por_nro_documento($x){
        $cliente = DB::table('cliente')
                                ->join('persona','cliente.per_id' ,'=', 'persona.per_id')
                                ->select('persona.*', 'cliente.*')
                                ->where('persona.per_nro_id', '=', $x)
                                ->get();
        if($cliente->count() > 0){
            return $cliente;
        }else{
            return false;
        }                        
    }

     
}
