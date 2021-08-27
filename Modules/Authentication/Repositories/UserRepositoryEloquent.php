<?php

namespace Authentication\Repositories;

use Authentication\Models\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements \Authentication\Repositories\UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    public function create(array $attributes)
    {
        $attributes['password'] = bcrypt($attributes['password']);
        $model = parent::create($attributes);
        if (isset($attributes['roles'])) $model->roles()->sync($attributes['roles']);
        return $model;
    }

    public function update(array $attributes, $id)
    {
        if (empty($attributes['password'])) {
            unset($attributes['password'], $attributes['confirm_password']);
        } else {
            $attributes['password'] = bcrypt($attributes['password']);
        }
        $model = parent::update($attributes, $id);
        if (isset($attributes['roles'])) $model->roles()->sync($attributes['roles']);
        return $model;
    }

    public function updatePassword(array $attributes, $id)
    {
        $attributes['password'] = bcrypt($attributes['password']);
        return parent::update($attributes, $id);
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
