<?php

namespace Authentication\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class FindUsersIsNotAdminCriteria implements CriteriaInterface
{
    public function apply($model, RepositoryInterface $repository)
    {
        if (auth()->check() && !auth()->user()->isAdmin()) {
            $model = $model->whereHas('roles', function ($q) {
                $q->where('name', '!=', config('authentication.acl.role_admin'));
            });
        }
        return $model;
    }
}
