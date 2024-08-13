<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rol')->insert(['rol_codigo' => "ADMIN",    'rol_nombre' => "ADMINISTRADOR DEL SISTEMA" , 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('rol')->insert(['rol_codigo' => "PROP",  'rol_nombre' => "PROPIETARIO" , 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('rol')->insert(['rol_codigo' => "ABG",    'rol_nombre' => "ABOGADO" , 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('rol')->insert(['rol_codigo' => "EJECUTIVO",  'rol_nombre' => "EJECUTIVO DE VENTAS" , 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('rol')->insert(['rol_codigo' => "CAJERO",  'rol_nombre' => "CAJERO" , 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('rol')->insert(['rol_codigo' => "PROMOTOR",   'rol_nombre' => "PROMOTOR DE VENTAS" , 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
    }
}
