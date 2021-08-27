<?php

namespace Authentication\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Transformable
{
    use Notifiable, TransformableTrait, HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'ativo'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @param Collection|string $role
     * @return boolean
     */
    public function hasRole($role)
    {
        return is_string($role) ? $this->roles->contains('name', $role) : (boolean)$role->intersect($this->roles)->count();
    }

    public function isAdmin()
    {
        return $this->hasRole(config('authentication.acl.role_admin'));
    }
}
