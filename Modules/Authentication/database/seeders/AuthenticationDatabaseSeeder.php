<?php

namespace Authentication\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AuthenticationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        \Artisan::call('authentication:make-permission');
        // $this->call("OthersTableSeeder");
    }
}
