<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // AdminSeeder::class,
            ActividadEconomicaSeeder::class,
            PaisSeeder::class,
            DepartamentoSeeder::class,
            MunicipioSeeder::class,
            Estado_disponibilidadSeeder::class,
            FormaContactoSeeder::class,
            UbicacionSeeder::class,
        ]);

    }
}
