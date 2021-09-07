<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Escolaridade;

class EscolaridadeController extends Controller
{
    public function index()
    {
        return Escolaridade::query()->orderBy('codigo')->get(['id', 'nome']);
    }
}
