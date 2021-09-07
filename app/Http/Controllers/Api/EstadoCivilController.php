<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EstadoCivil;

class EstadoCivilController extends Controller
{
    public function index()
    {
        return EstadoCivil::query()->orderBy('codigo')->get(['id', 'nome']);
    }
}
