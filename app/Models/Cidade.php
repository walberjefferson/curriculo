<?php

namespace App\Models;

use App\Utils\SaveToUpper;
use App\Utils\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Cidade extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes, Uuid, SaveToUpper;

    protected $table = 'cidade';
    protected $no_upper = ['uuid'];
    protected $fillable = ['nome', 'estado_id'];
    protected $dates = ['deleted_at'];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }
}
