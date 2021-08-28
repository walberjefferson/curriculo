<?php

namespace App\Models;

use App\Utils\SaveToUpper;
use App\Utils\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Experiencia extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes, Uuid, SaveToUpper;

    protected $table = 'experiencia';
    protected $no_upper = ['uuid'];
    protected $fillable = ['cargo', 'empresa', 'tempo_servico', 'saida', 'pessoa_id'];
    protected $dates = ['deleted_at'];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class, 'pessoa_id');
    }
}
