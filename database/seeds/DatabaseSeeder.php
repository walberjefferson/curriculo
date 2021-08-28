<?php

use Authentication\database\seeders\AuthenticationDatabaseSeeder;
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
         $this->call(AuthenticationDatabaseSeeder::class);
         $this->call(SexoTableSeeder::class);
         $this->call(EstadoCivilTableSeeder::class);
        $this->call(EscolaridadeTableSeeder::class);
        $this->call(HabilidadeTableSeeder::class);
        $this->call(EstadoTableSeeder::class);
        $this->call(CidadeTableSeeder::class);
    }
}
