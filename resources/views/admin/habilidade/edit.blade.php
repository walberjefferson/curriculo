@extends('layout.master')

@section('content-title', 'Editar usuário')

@section('breadcrumbs')
    @include('layout.breadcrumbs', [
      'breadcrumbs' => [
        (object) [ 'title' => 'Painel', 'url' => route('admin.dashboard') ],
        (object) [ 'title' => 'Habilidade', 'url' => route('admin.habilidade.index') ],
        (object) [ 'title' => 'Editar', 'url' => '' ],
      ]
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {!! Form::model($dados, ['url' => route('admin.habilidade.update', $dados->uuid), 'method' => 'PUT']) !!}
                    @include('admin.habilidade._form')
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            <i class="mdi mdi-send"></i> Salvar
                        </button>
                        <a href="{{ route('admin.habilidade.index') }}" class="btn btn-secondary">
                            <i class="mdi mdi-backup-restore"></i> Voltar
                        </a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
