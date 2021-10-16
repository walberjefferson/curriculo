@extends('layout.master')

@section('content-title', 'Pessoa')

@section('breadcrumbs')
    @include('layout.breadcrumbs', [
      'breadcrumbs' => [
        (object) [ 'title' => 'Painel', 'url' => route('admin.dashboard') ],
        (object) [ 'title' => 'Pessoa', 'url' => route('admin.curriculo.index') ],
        (object) [ 'title' => 'Detalhes', 'url' => '#' ],
      ]
    ])
@endsection

@section('breadcrumbs_button')
    <a href="{{ url()->previous() }}" class="btn btn-warning text-white mr-2">
        <i class="mdi mdi-chevron-left"></i>
        Voltar
    </a>

    <a href="{{ route('admin.curriculo.imprimir', $dados->uuid) }}" target="_blank" class="btn btn-primary">
        <i class="mdi mdi-printer"></i>
        Imprimir
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-2">
                            <h6 class="card-title text-primary mb-2">Foto</h6>
                            <div class="row">
                                <div class="col-12 border px-1 py-2">
                                    @if($dados->foto)
                                        <img src="{{ $dados->foto_url }}" class="img-fluid w-100"
                                             alt="{{ $dados->nome }}">
                                    @else
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="col-md-10">
                            <h6 class="card-title text-primary mb-2">Dados Pessoais</h6>

                            <div class="row">
                                <div class="col-md-8 border py-2">
                                    <small class="text-gray">
                                        <b>Nome</b>
                                    </small>
                                    <br>
                                    {{ $dados->nome ?? '---' }}
                                </div>
                                <div class="col-md-2 border border-left-0 py-2">
                                    <small class="text-gray">
                                        <b>Sexo</b>
                                    </small>
                                    <br>
                                    {{ $dados->sexo ? $dados->sexo['nome'] : '---' }}
                                </div>
                                <div class="col-md-2 border border-left-0 py-2">
                                    <small class="text-gray">
                                        <b>Data Nascimento</b>
                                    </small>
                                    <br>
                                    {{ $dados->data_nascimento ?? '---' }}
                                </div>

                                <div class="col-md-2 border border-top-0 py-2">
                                    <small class="text-gray">
                                        <b>CPF</b>
                                    </small>
                                    <br>
                                    {{ $dados->cpf ?? '---' }}
                                </div>

                                <div class="col-md-3 border border-top-0 border-left-0 py-2">
                                    <small class="text-gray">
                                        <b>Instagram</b>
                                    </small>
                                    <br>
                                    {{ $dados->instagram ?? '---' }}
                                </div>

                                <div class="col-md-2 border border-top-0 border-left-0 py-2">
                                    <small class="text-gray">
                                        <b>Telefone</b>
                                    </small>
                                    <br>
                                    {{ $dados->telefone ?? '---' }}
                                </div>

                                <div class="col-md-2 border border-top-0 border-left-0 py-2">
                                    <small class="text-gray">
                                        <b>Whatsapp</b>
                                    </small>
                                    <br>
                                    {{ $dados->whatsapp ?? '---' }}
                                </div>

                                <div class="col-md-3 border border-top-0 border-left-0 py-2">
                                    <small class="text-gray">
                                        <b>Estado Cívil</b>
                                    </small>
                                    <br>
                                    {{ $dados->estado_civil ? $dados->estado_civil['nome'] : '---' }}
                                </div>

                                <div class="col-md-4 border border-top-0 py-2">
                                    <small class="text-gray">
                                        <b>Escolaridade</b>
                                    </small>
                                    <br>
                                    {{ $dados->escolaridade ? $dados->escolaridade['nome'] : '---' }}
                                </div>
                                <div class="col-md-8 border border-top-0 border-left-0 py-2">
                                    <small class="text-gray">
                                        <b>Cidade / Estado</b>
                                    </small>
                                    <br>
                                    {{ $dados->cidade ? $dados->cidade['nome'] : '---' }} /
                                    {{ $dados->estado ? $dados->estado['nome'] : '---' }}
                                </div>
                                <div class="col-md-4 border border-top-0 py-2">
                                    <small class="text-gray">
                                        <b>PCD - (Portador de Deficiência Física)</b>
                                    </small>
                                    <br>
                                    {{ $dados->pcd ? 'Sim' : 'Não' }}
                                </div>

                                <div class="col-md-4 border border-top-0 border-left-0 py-2">
                                    <small class="text-gray">
                                        <b>CNH - (Carrteira Nacional de Habilitação)</b>
                                    </small>
                                    <br>
                                    {{ $dados->cnh ? 'Sim' : 'Não' }}
                                    {{ $dados->cnh ? ' - ' . $dados->categoria_cnh : null }}
                                </div>

                                <div class="col-md-4 border border-top-0 border-left-0 py-2">
                                    <small class="text-gray">
                                        <b>Tem filhos?</b>
                                    </small>
                                    <br>
                                    {{ $dados->filhos ? 'Sim' : 'Não' }}
                                    {{ $dados->filhos ? ' - Quantos? ' . $dados->filhos_quantidade : null }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <h6 class="card-title text-primary mt-3 mb-2">Habilidades</h6>
                    <div class="row">
                        <div class="col-md-12 border py-2">
                            <small class="text-gray">
                                <b>Habilidades</b>
                            </small>
                            <br>
                            {{ $dados->habilidades_count ? $dados->habilidades->implode('nome', ', ') : 'Nenhuma habilidade' }}
                        </div>
                    </div>

                    <h6 class="card-title text-primary mt-3 mb-2">EXPERIÊNCIAS</h6>
                    <div class="row">
                        <div class="col-md-12">

                            @if($dados->experiencias_count)
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Cargo</th>
                                                <th>Empresa</th>
                                                <th width="20%">Tempo de Seviço</th>
                                                <th width="10%">Saída</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($dados->experiencias as $experiencia)
                                                <tr>
                                                    <td>{{ $experiencia->cargo ?? '---' }}</td>
                                                    <td>{{ $experiencia->empresa ?? '---' }}</td>
                                                    <td>{{ $experiencia->tempo_servico ?? '---' }}</td>
                                                    <td>{{ $experiencia->saida ?? '---' }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                Nenhuma experiência
                            @endif
                        </div>
                    </div>

                    <h6 class="card-title text-primary mt-3 mb-2">Dados Postais</h6>
                    <div class="row">
                        <div class="col-md-5 border py-2">
                            <small class="text-gray">
                                <b>Endereço</b>
                            </small>
                            <br>
                            {{ $dados->endereco ?? '---' }}
                        </div>
                        <div class="col-md-1 border border-left-0 py-2">
                            <small class="text-gray">
                                <b>Nº</b>
                            </small>
                            <br>
                            {{ $dados->endereco_numero ?? '---' }}
                        </div>
                        <div class="col-md-3 border border-left-0 py-2">
                            <small class="text-gray">
                                <b>Ponto de Referência</b>
                            </small>
                            <br>
                            {{ $dados->ponto_referencia ?? '---' }}
                        </div>
                        <div class="col-md-3 border border-left-0 py-2">
                            <small class="text-gray">
                                <b>Complemento</b>
                            </small>
                            <br>
                            {{ $dados->complemento ?? '---' }}
                        </div>
                    </div>

                    <h6 class="card-title text-primary mt-3 mb-2">Outras Informações</h6>
                    <div class="row">
                        <div class="col-md-12 border py-2">
                            <small class="text-gray">
                                <b>Outras Informações</b>
                            </small>
                            <br>
                            {{ $dados->outras_informacoes ?? '---' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
