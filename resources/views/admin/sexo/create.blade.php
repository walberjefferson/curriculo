@extends('layout.master')

@section('content-title', 'Adicionar Sexo')

@section('breadcrumbs')
    @include('layout.breadcrumbs', [
      'breadcrumbs' => [
        (object) [ 'title' => 'Painel', 'url' => route('admin.dashboard') ],
        (object) [ 'title' => 'Sexo', 'url' => route('admin.sexo.index') ],
        (object) [ 'title' => 'Novo', 'url' => '' ],
      ]
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    {!! Form::open(['url' => route('admin.sexo.store')]) !!}
                    @include('admin.sexo._form')
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            <i class="mdi mdi-send"></i> Salvar
                        </button>
                        <a href="{{ route('admin.sexo.index') }}" class="btn btn-secondary">
                            <i class="mdi mdi-backup-restore"></i> Voltar</a>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
