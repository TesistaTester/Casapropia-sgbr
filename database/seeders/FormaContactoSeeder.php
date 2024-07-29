<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormaContactoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('forma_contacto')->insert(['foc_medio' => "PROMOTOR DE VENTA", 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('forma_contacto')->insert(['foc_medio' => "PERIODICO", 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('forma_contacto')->insert(['foc_medio' => "REDES SOCIALES", 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('forma_contacto')->insert(['foc_medio' => "REFERENCIA DE OTRO CLIENTE", 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
    }
}
