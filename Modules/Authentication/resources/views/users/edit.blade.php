@extends('layout.master')

@section('content-title', 'Usuário')

{{--@section('breadcrumbs')--}}
{{--    @include('inspinia::layouts.main-panel.breadcrumbs', [--}}
{{--      'breadcrumbs' => [--}}
{{--        (object) [ 'title' => 'Painel', 'url' => route('home') ],--}}
{{--        (object) [ 'title' => 'Usuários', 'url' => route('user.index') ],--}}
{{--        (object) [ 'title' => 'Editar', 'url' => '' ],--}}
{{--      ]--}}
{{--    ])--}}

{{--@endsection--}}

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title bg-primary"><h5>Editar usuário</h5></div>

                <div class="ibox-content">

                    {!! Form::model($dados, ['route' => ['user.update', $dados->id], 'method' => 'PUT']) !!}
                    @include('authentication::users._form')
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-paper-plane-o"></i> Salvar
                        </button>
                        <a href="{{ route('user.index') }}" class="btn btn-warning"><i class="fa fa-undo"></i>
                            Voltar</a>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
