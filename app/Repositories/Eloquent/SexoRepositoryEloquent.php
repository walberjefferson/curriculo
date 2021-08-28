<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\SexoRepository;
use App\Models\Sexo;
use App\Validators\SexoValidator;

/**
 * Class SexoRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class SexoRepositoryEloquent extends BaseRepository implements SexoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Sexo::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
