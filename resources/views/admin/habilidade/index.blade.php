@extends('layout.master')

@section('content-title', 'Habilidade')

@section('breadcrumbs')
    @include('layout.breadcrumbs', [
      'breadcrumbs' => [
        (object) [ 'title' => 'Painel', 'url' => route('admin.dashboard') ],
        (object) [ 'title' => 'Habilidade', 'url' => route('admin.habilidade.index') ],
      ]
    ])
@endsection

@section('breadcrumbs_button')
    @can('admin-habilidade/store')
        <a href="{{ route('admin.habilidade.create') }}" class="btn btn-primary btn-icon-text">
            <i class="btn-icon-prepend" data-feather="plus"></i>
            Novo
        </a>
    @endcan
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
                                <th width="5%" class="text-center">Código</th>
                                <th>Nome</th>
                                @canany(['admin-habilidade/update', 'admin-habilidade/destroy'])
                                    <th width="8%" nowrap>Ações</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dados as $d)
                                <tr>
                                    <td nowrap class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center" nowrap>{{ $d->codigo }}</td>
                                    <td nowrap>{{ $d->nome }}</td>
                                    @canany(['admin-habilidade/update', 'admin-habilidade/destroy'])
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                @can('admin-habilidade/update')
                                                    <a href="{{ route('admin.habilidade.edit', $d->uuid) }}" class="btn btn-primary">
                                                        <i class="mdi mdi-pencil-outline"></i>
                                                    </a>
                                                @endcan
                                                @can('admin-habilidade/destroy')
                                                    <?php $deleteForm = "delete-form-{$loop->index}" ?>
                                                    <a href="#" class="btn btn-danger"
                                                       onclick="if(confirm('Deseja realmente excluir?')) {event.preventDefault(); document.getElementById('{{$deleteForm}}').submit(); }else{ return false; }">
                                                        <i class="mdi mdi-trash-can-outline"></i>
                                                    </a>
                                                @endcan
                                            </div>
                                            @can('admin-habilidade/destroy')
                                                {!! Form::open(['url' => route('admin.habilidade.destroy', $d->uuid), 'id' => $deleteForm, 'style' => 'display:none;', 'method' => 'DELETE']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    @endcanany
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
