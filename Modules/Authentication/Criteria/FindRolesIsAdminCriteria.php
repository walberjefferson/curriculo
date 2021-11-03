<?php

namespace Authentication\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class FindRolesIsAdminCriteria implements CriteriaInterface
{
    public function apply($model, RepositoryInterface $repository)
    {
        if (auth()->check() && !auth()->user()->isAdmin()) {
            $model = $model->where('name', '!=', config('authentication.acl.role_admin'));
        }
        return $model;
    }
}
