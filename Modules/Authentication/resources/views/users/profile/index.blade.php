@extends('layout.master')

@section('content-title', 'Perfil')

@section('breadcrumbs')
    @include('layout.breadcrumbs', [
      'breadcrumbs' => [
        (object) [ 'title' => 'Painel', 'url' => route('admin.dashboard') ],
        (object) [ 'title' => 'Perfil', 'url' => '' ],
      ]
    ])
@endsection

@section('breadcrumbs_button')
    <a href="{{ route('admin.alterar_senha') }}" class="btn btn-primary"><i class="mdi mdi-account-key mr-2"></i>
        Alterar Senha</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row d-flex justify-content-center m-b-lg m-t-lg">
                        <div class="col-6">
                            <div class="d-flex justify-content-center flex-column">
                                <div class="d-flex justify-content-center mb-4">
                                    <img src="{{ 'https://www.gravatar.com/avatar/' . md5($dados->email) . '?d=mm' }}"
                                          class="rounded-circle circle-border m-b-md d-block" alt="profile"></div>
                                <div class="text-center">
                                    <h3>{{ $dados->name }}</h3>
                                    <h5>{{ $dados->email }}</h5>
                                    <small><b>Permissões: </b> {{ $dados->roles->implode('name', ', ') }}</small>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
