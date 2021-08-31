<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\PessoaRepository;
use App\Models\Pessoa;

/**
 * Class PessoaRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class PessoaRepositoryEloquent extends BaseRepository implements PessoaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Pessoa::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
