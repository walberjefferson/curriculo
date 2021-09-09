<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Habilidade;

class HabilidadesController extends Controller
{
    public function index()
    {
        return Habilidade::query()->orderBy('codigo')->get(['id', 'nome']);
    }
}
