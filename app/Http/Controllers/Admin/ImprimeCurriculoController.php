<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pessoa;
use App\PDF\Curriculo;
use Illuminate\Support\Str;

class ImprimeCurriculoController extends Controller
{
    public function imprime(Pessoa $dados)
    {
        $dados->loadCount(['experiencias', 'habilidades']);
        $dados->load(['sexo', 'escolaridade', 'estado', 'cidade', 'estado_civil', 'experiencias', 'habilidades']);
        $pdf = new Curriculo($dados, 'P');
        $fileName = 'curriculo_' . Str::slug($dados->nome, '_') . '.pdf';
        $pdf->setTitulo('Currículo');
        $pdf->setFoto($dados->foto_disk);
        $pdf->setFileName($fileName);
        $pdf->render();
    }
}
