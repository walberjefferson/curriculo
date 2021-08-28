<?php

namespace App\Models;

use App\Utils\SaveToUpper;
use App\Utils\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Habilidade extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes, Uuid, SaveToUpper;

    protected $table = 'habilidade';
    protected $no_upper = ['uuid', 'codigo'];
    protected $fillable = ['nome', 'codigo'];
    protected $dates = ['deleted_at'];

    public function pessoas()
    {
        return $this->belongsToMany(Pessoa::class, 'habilidaded_pessoa');
    }
}
