<?php

namespace App\Models;

use App\Utils\SaveToUpper;
use App\Utils\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Estado extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes, Uuid, SaveToUpper;

    protected $table = 'estado';
    protected $no_upper = ['uuid'];
    protected $fillable = ['nome', 'uf'];
    protected $dates = ['deleted_at'];

    public function cidades()
    {
        return $this->hasMany(Cidade::class, 'estado_id');
    }
}
