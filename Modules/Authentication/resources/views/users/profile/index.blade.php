@extends('layout.master')

@section('content-title', 'Perfil')

@section('breadcrumbs')
    @include('inspinia::layouts.main-panel.breadcrumbs', [
      'breadcrumbs' => [
        (object) [ 'title' => 'Painel', 'url' => route('admin.dashboard') ],
        (object) [ 'title' => 'Perfil', 'url' => '' ],
      ]
    ])

@endsection

@section('breadcrumbs_button')
    <a href="{{ route('admin.alterar_senha') }}" class="btn btn-primary"><i class="fa fa-key"></i> Alterar Senha</a>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row m-b-lg m-t-lg">
                        <div class="col-md-6">

                            <div class="profile-image">
                                <img src="{{ 'https://www.gravatar.com/avatar/' . md5($dados->email) . '?d=mm' }}" class="rounded-circle circle-border m-b-md" alt="profile">
                            </div>
                            <div class="profile-info">
                                <div class="">
                                    <div>
                                        <h2 class="no-margins">
                                            {{ $dados->name }}
                                        </h2>
                                        <h4>{{ $dados->email }}</h4>
                                        <small>
                                            <b>Permissões: </b> {{ $dados->roles->implode('name', ', ') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
