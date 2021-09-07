<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estado;

class EstadoController extends Controller
{
    public function index()
    {
        return Estado::query()->orderBy('nome')->get(['id', 'nome']);
    }
}
