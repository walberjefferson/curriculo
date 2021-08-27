@extends('layout.master')

@section('content-title', 'Perfil')

@section('breadcrumbs')
    @include('inspinia::layouts.main-panel.breadcrumbs', [
      'breadcrumbs' => [
        (object) [ 'title' => 'Painel', 'url' => route('home') ],
        (object) [ 'title' => 'Perfil', 'url' => route('profile') ],
        (object) [ 'title' => 'Alterar Senha', 'url' => '' ],
      ]
    ])

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title bg-primary"><h5>Alterar Senha</h5></div>

                <div class="ibox-content">
                    {!! Form::open(['url' => route('alterar_senha'), 'method' => 'PUT']) !!}
                    @include('authentication::users.profile._form')
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-paper-plane-o"></i> Salvar
                        </button>
                        <a href="{{ url()->previous() }}" class="btn btn-warning">
                            <i class="fa fa-undo"></i> Voltar
                        </a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
