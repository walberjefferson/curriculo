<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\EstadoCivilRepository;
use App\Models\EstadoCivil;
use App\Validators\EstadoCivilValidator;

/**
 * Class EstadoCivilRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class EstadoCivilRepositoryEloquent extends BaseRepository implements EstadoCivilRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EstadoCivil::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
