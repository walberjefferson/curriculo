<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurriculoFotoRequest;
use App\Http\Resources\CurriculoResource;
use App\Models\Pessoa;
use App\Traits\UploadTrait;

class CurriculoFotoController extends Controller
{
    use UploadTrait;

    public function update(CurriculoFotoRequest $request, Pessoa $dados)
    {
        try {
            \DB::beginTransaction();
            if ($request->hasFile('foto')) {
                $foto = $this->uploadFile($request->file('foto'), Pessoa::$folder);
                $dados->update(['foto' => $foto['url']]);
                $dados->load(['experiencias', 'habilidades'])->refresh();
            }
            \DB::commit();
            return response()->json(['data' => CurriculoResource::make($dados), 'message' => 'Foto atualizada com sucesso', 'error' => false]);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json(['message' => 'Erro ao tentar atualizar currículo. - ' . $e->getMessage(), 'error' => true], 500);
        }
    }

    public function destroy(Pessoa $dados)
    {
        try {
            \DB::beginTransaction();
            $foto = $dados->foto;
            $dados->update(['foto' => null]);
            $this->deleteFile($foto, Pessoa::$folder);
            $dados->load(['experiencias', 'habilidades'])->refresh();
            \DB::commit();
            return response()->json(['data' => CurriculoResource::make($dados), 'message' => 'Foto removida com sucesso.', 'error' => false]);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json(['message' => 'Erro ao tentar excluir foto.', 'error' => true], 500);
        }
    }
}
