<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, ['estado_id' => 'required']);
        return Cidade::query()->where('estado_id', $request->get('estado_id'))->get(['id', 'nome']);
    }
}
