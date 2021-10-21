<?php

namespace App\Repositories\Eloquent;

use App\Contracts\Repositories\PessoaRepository;
use App\Models\Pessoa;
use App\Traits\UploadTrait;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class PessoaRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class PessoaRepositoryEloquent extends BaseRepository implements PessoaRepository
{
    use UploadTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Pessoa::class;
    }

    public function create(array $attributes)
    {
        if (isset($attributes['foto']) && is_file($attributes['foto'])) {
            $foto = $this->uploadFile($attributes['foto'], Pessoa::$folder);
            $attributes['foto'] = $foto['url'];
        } else {
            unset($attributes['foto']);
        }
        $model = parent::create($attributes);
        if (isset($attributes['experiencias']) && is_array($attributes['experiencias'])) {
            $attributes['experiencias'] = array_filter($attributes['experiencias']);
            foreach ($attributes['experiencias'] as $experiencia) {
                $experiencia = array_filter($experiencia);
                if (!empty($experiencia)) {
                    $model->experiencias()->create($experiencia);
                }
            }
        }
        if (isset($attributes['habilidades']) && is_array($attributes['habilidades'])) {
            $model->habilidades()->sync($attributes['habilidades']);
        }
        $model->load(['experiencias', 'habilidades']);
        return $model;
    }

    public function update(array $attributes, $id)
    {
        if (isset($attributes['foto']) && is_file($attributes['foto'])) {
            $foto = $this->uploadFile($attributes['foto'], Pessoa::$folder);
            $attributes['foto'] = $foto['url'];
        } else {
            unset($attributes['foto']);
        }
        $model = parent::update($attributes, $id);
        if (isset($attributes['experiencias']) && is_array($attributes['experiencias'])) {
            $attributes['experiencias'] = array_filter($attributes['experiencias']);
            foreach ($attributes['experiencias'] as $experiencia) {
                $experiencia = array_filter($experiencia);
                if (!empty($experiencia)) {
                    if (isset($experiencia['id'])) {
                        $model->experiencias()->updateOrCreate(['id' => $experiencia['id']], $experiencia);
                    } else {
                        $model->experiencias()->create($experiencia);
                    }
                }
            }
        }
        if (isset($attributes['habilidades']) && is_array($attributes['habilidades'])) {
            $model->habilidades()->sync($attributes['habilidades']);
        }
        $model->load(['experiencias', 'habilidades']);
        return $model;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
