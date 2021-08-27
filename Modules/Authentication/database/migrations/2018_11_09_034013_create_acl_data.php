<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Authentication\Models\Role;
use Authentication\Models\User;

class CreateAclData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $roleAdmin = Role::firstOrCreate([
            'name' => config('authentication.acl.role_admin'),
            'description' => 'Papel de usuário mestre do sistema.'
        ]);

        $user = User::where('email', 'admin@user.com')->first();
        $user->roles()->save($roleAdmin);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $user = User::where('email', config('authentication.user_default.email'))->first();
        $user->roles()->detach();
        $role = Role::where('name', config('authentication.acl.role_admin'))->first();
        $role->users()->detach();
        $role->permissions()->detach();
        $role->delete();

    }
}
