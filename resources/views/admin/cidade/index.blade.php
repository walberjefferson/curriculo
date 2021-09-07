@extends('layout.master')

@section('content-title', 'Cidade')

@section('breadcrumbs')
    @include('layout.breadcrumbs', [
      'breadcrumbs' => [
        (object) [ 'title' => 'Painel', 'url' => route('admin.dashboard') ],
        (object) [ 'title' => 'Cidade', 'url' => route('admin.cidade.index') ],
      ]
    ])
@endsection

@section('breadcrumbs_button')
    {!! Form::open(['url' => route('admin.cidade.index'), 'method' => 'GET']) !!}
    <div class="input-group">
        {!! Form::text('search', request()->get('search'), ['class' => 'form-control', 'placeholder' => 'O que você procura?']) !!}
        <div class="input-group-append">
            <button class="btn btn-outline-dark" type="submit">Buscar</button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th width="3%" class="text-center">#</th>
                                <th>Nome</th>
                                <th nowrap>Estado</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dados as $d)
                                <tr>
                                    <td nowrap class="text-center">{{ $loop->iteration }}</td>
                                    <td nowrap>{{ $d->nome }}</td>
                                    <td nowrap>{{ $d->estado['nome'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">{{ $dados }}</div>
            </div>
        </div>
    </div>
@endsection
