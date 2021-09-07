<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\CidadeRepository;
use App\Models\Cidade;

class CidadeRepositoryEloquent extends BaseRepository implements CidadeRepository
{
    protected $fieldSearchable = [
        'nome' => 'like',
        'estado.nome' => 'like',
        'estado.uf'
    ];
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Cidade::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
