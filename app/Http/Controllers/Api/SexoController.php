<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sexo;

class SexoController extends Controller
{
    public function index()
    {
        return Sexo::query()->orderBy('nome')->get(['id', 'nome']);
    }
}
