<?php

namespace Authentication\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindPermissionGroupCriteria.
 *
 * @package namespace Authentication\Criteria;
 */
class FindPermissionGroupCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->groupBy('name', 'description');
    }
}
