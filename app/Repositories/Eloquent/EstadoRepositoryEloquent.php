<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\EstadoRepository;
use App\Models\Estado;
use App\Validators\EstadoValidator;

/**
 * Class EstadoRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class EstadoRepositoryEloquent extends BaseRepository implements EstadoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Estado::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
