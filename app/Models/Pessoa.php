<?php

namespace App\Models;

use App\Utils\SaveToUpper;
use App\Utils\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Pessoa.
 *
 * @package namespace App\Models;
 */
class Pessoa extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes, Uuid, SaveToUpper;

    public static $folder = 'pessoa/foto';
    protected $table = 'pessoa';
    protected $no_upper = ['uuid', 'foto', 'cnh', 'pcd', 'ativo', 'filhos', 'instagram'];
    protected $fillable = [
        'nome', 'data_nascimento', 'sexo_id', 'cpf', 'cnh', 'categoria_cnh', 'pcd', 'telefone', 'whatsapp', 'endereco',
        'endereco_numero', 'complemento', 'ponto_referencia', 'instagram', 'outras_informacoes', 'foto', 'ativo',
        'outra_habilidade', 'filhos', 'filhos_quantidade', 'escolaridade_id', 'estado_id', 'cidade_id', 'estado_civil_id'
    ];
    protected $appends = ['foto_base64'];
    protected $dates = ['deleted_at'];
    protected $casts = [
        'cnh' => 'boolean',
        'pcd' => 'boolean',
        'ativo' => 'boolean',
        'filhos' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function getFotoBase64Attribute()
    {
        if(\Storage::disk('public')->exists(self::$folder . "/" . $this->foto)) {
            $file = \Storage::disk('public')->get(self::$folder . "/" . $this->foto);
            return base64_encode($file);
        }
        return null;
    }

    public function sexo()
    {
        return $this->belongsTo(Sexo::class, 'sexo_id');
    }

    public function escolaridade()
    {
        return $this->belongsTo(Escolaridade::class, 'escolaridade_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'cidade_id');
    }

    public function estado_civil()
    {
        return $this->belongsTo(EstadoCivil::class, 'estado_civil_id');
    }

    public function experiencias()
    {
        return $this->hasMany(Experiencia::class, 'pessoa_id');
    }

    public function habilidades()
    {
        return $this->belongsToMany(Habilidade::class, 'habilidade_pessoa');
    }
}
