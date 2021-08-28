<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\EscolaridadeRepository;
use App\Models\Escolaridade;
use App\Validators\EscolaridadeValidator;

/**
 * Class EscolaridadeRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class EscolaridadeRepositoryEloquent extends BaseRepository implements EscolaridadeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Escolaridade::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
