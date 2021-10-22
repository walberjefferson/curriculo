@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-7 col-md-7 col-lg-6">
            <a href="#" class="btn btn-lg btn-block btn-danger p-4 rounded-pill mt-4">Banco de Currículos</a>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-10 col-sm-5 col-md-5 col-lg-4">
            <a href="{{ route('curriculo.create') }}" class="btn btn-lg btn-block btn-facebook p-4 rounded-pill">
                Cadastre seu Currículo
            </a>
        </div>
    </div>
</div>
@endsection
