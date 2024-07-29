<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departamento')->insert(['pai_id' => 1, 'dep_nombre'=> 'LA PAZ', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('departamento')->insert(['pai_id' => 1, 'dep_nombre'=> 'ORURO', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('departamento')->insert(['pai_id' => 1, 'dep_nombre'=> 'POTOSI', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('departamento')->insert(['pai_id' => 1, 'dep_nombre'=> 'COCHABAMBA', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('departamento')->insert(['pai_id' => 1, 'dep_nombre'=> 'CHUQUISACA', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('departamento')->insert(['pai_id' => 1, 'dep_nombre'=> 'TARIJA', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('departamento')->insert(['pai_id' => 1, 'dep_nombre'=> 'PANDO', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('departamento')->insert(['pai_id' => 1, 'dep_nombre'=> 'BENI', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('departamento')->insert(['pai_id' => 1, 'dep_nombre'=> 'SANTA CRUZ', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
    }
}
