<?php

use Authentication\Models\User;
use Illuminate\Database\Migrations\Migration;

class CreateUsersData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        User::query()->firstOrCreate([
            'name' => config('authentication.user_default.name'),
            'email' => config('authentication.user_default.email'),
            'password' => bcrypt(config('authentication.user_default.password')),
            'ativo' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        User::query()->truncate();
    }
}
