@extends('layout.master')

@section('content-title', 'Adicionar Estado Cívil')

@section('breadcrumbs')
    @include('layout.breadcrumbs', [
      'breadcrumbs' => [
        (object) [ 'title' => 'Painel', 'url' => route('admin.dashboard') ],
        (object) [ 'title' => 'Usuários', 'url' => route('admin.estado_civil.index') ],
        (object) [ 'title' => 'Novo', 'url' => '' ],
      ]
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    {!! Form::open(['url' => route('admin.estado_civil.store')]) !!}
                    @include('admin.estado_civil._form')
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            <i class="mdi mdi-send"></i> Salvar
                        </button>
                        <a href="{{ route('admin.estado_civil.index') }}" class="btn btn-secondary">
                            <i class="mdi mdi-backup-restore"></i> Voltar</a>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
