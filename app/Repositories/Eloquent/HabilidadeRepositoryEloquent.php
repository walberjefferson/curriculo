<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\HabilidadeRepository;
use App\Models\Habilidade;
use App\Validators\HabilidadeValidator;

/**
 * Class HabilidadeRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class HabilidadeRepositoryEloquent extends BaseRepository implements HabilidadeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Habilidade::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
