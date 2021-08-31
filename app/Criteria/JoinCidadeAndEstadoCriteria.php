<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class JoinCidadeAndEstadoCriteria.
 *
 * @package namespace App\Criteria;
 */
class JoinCidadeAndEstadoCriteria implements CriteriaInterface
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
        return $model->join('estado as e', 'e.id', '=', 'cidade.estado_id')->select('cidade.*');
    }
}
