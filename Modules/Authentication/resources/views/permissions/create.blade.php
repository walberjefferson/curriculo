@extends('layout.master')

@section('content-title', 'Papeis de Usuário')

@section('breadcrumbs')
    @include('inspinia::layouts.main-panel.breadcrumbs', [
      'breadcrumbs' => [
        (object) [ 'title' => 'Painel', 'url' => route('home') ],
        (object) [ 'title' => 'Papel de Usuário', 'url' => route('role.index') ],
        (object) [ 'title' => 'Novo', 'url' => '' ],
      ]
    ])

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title bg-primary"><h5>Adicionar novo papel de usuário</h5></div>

                <div class="ibox-content">

                    {!! Form::open(['route' => 'role.store']) !!}
                    @include('authentication::roles._form')
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-paper-plane-o"></i> Salvar
                        </button>
                        <a href="{{ route('role.index') }}" class="btn btn-warning"><i class="fa fa-undo"></i> Voltar</a>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
