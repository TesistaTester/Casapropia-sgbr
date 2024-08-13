<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //usuario: admin password: 123
        DB::table('usuario')->insert(['usu_email'=> 'admin@gmail.com', 'password'=> '$2a$10$PN2/1NMw9v15BcLkbEFvPuSzdjLPurQHvh/QuukpETAoTVVZRkMza', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('rol_usuario')->insert(['rol_id'=> 1, 'usu_id'=> 1, 'rus_descripcion'=> 'ADMIN DE SISTEMA', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
    }
}
