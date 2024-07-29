<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ubicacion')->insert(['ubi_descripcion' => "CALLE", 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('ubicacion')->insert(['ubi_descripcion' => "AVENIDA", 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('ubicacion')->insert(['ubi_descripcion' => "PLAZA", 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('ubicacion')->insert(['ubi_descripcion' => "ESQUINA CALLE", 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('ubicacion')->insert(['ubi_descripcion' => "ESQUINA AVENIDA", 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('ubicacion')->insert(['ubi_descripcion' => "ESQUINA PLAZA", 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
    }
}
