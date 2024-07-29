<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Estado_disponibilidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estado_disponibilidad')->insert(['edi_estado' => "GUARDADO", 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('estado_disponibilidad')->insert(['edi_estado' => "OFERTA", 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('estado_disponibilidad')->insert(['edi_estado' => "DISPONIBLE", 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('estado_disponibilidad')->insert(['edi_estado' => "VENDIDO", 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('estado_disponibilidad')->insert(['edi_estado' => "PAGANDO", 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('estado_disponibilidad')->insert(['edi_estado' => "DUEÑOS", 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
    }
}
