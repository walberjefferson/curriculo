<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\ExperienciaRepository;
use App\Models\Experiencia;
use App\Validators\ExperienciaValidator;

/**
 * Class ExperienciaRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class ExperienciaRepositoryEloquent extends BaseRepository implements ExperienciaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Experiencia::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
