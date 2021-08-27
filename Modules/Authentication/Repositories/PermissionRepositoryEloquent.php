<?php

namespace Authentication\Repositories;

use Authentication\Models\Permission;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class PermissionRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    public function update(array $attributes, $id)
    {
        $model = parent::update($attributes, $id);
        if (isset($attributes['permissions'])) {
            $model->permissions->sync($attributes['permissions']);
        } else {
            $model->permissions->sync([]);
        }
        return $model;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
