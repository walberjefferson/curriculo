<?php

namespace Authentication\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindPermissionResourceCriteria.
 *
 * @package namespace Authentication\Criteria;
 */
class FindPermissionResourceCriteria implements CriteriaInterface
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
        return $model->whereNotNull('resource_name');
    }
}
