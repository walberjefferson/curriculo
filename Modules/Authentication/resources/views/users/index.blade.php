@extends('layout.master')

@section('content-title', 'Usuário')

@section('breadcrumbs')
    @include('layout.breadcrumbs', [
      'breadcrumbs' => [
        (object) [ 'title' => 'Painel', 'url' => route('home') ],
        (object) [ 'title' => 'Usuários', 'url' => route('user.index') ],
      ]
    ])
@endsection

@section('breadcrumbs_button')
    @can('admin-users/create')
        <a href="{{ route('user.create') }}" class="btn btn-primary">
            <i class="mdi mdi-plus"></i> Novo
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
                                <th>Nome</th>
                                <th width="20%">E-mail</th>
                                <th width="21%">Perfis</th>
                                <th width="5%" nowrap>Ativo?</th>
                                @canany(['admin-users/edit', 'admin-users/delete'])
                                    <th width="12%" nowrap>Ações</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dados as $d)
                                <tr>
                                    <td nowrap class="text-center">{{ $loop->iteration }}</td>
                                    <td nowrap>{{ $d->name }}</td>
                                    <td>{{ $d->email }}</td>
                                    <td>{{ $d->roles->implode('name', '|') }}</td>
                                    <td class="text-center">
                                        <i class="mdi {{ ($d->ativo) ? 'mdi-check text-success' : 'mdi-close text-danger' }}"></i>
                                    </td>
                                    @if(auth()->user()->can('admin-users/edit') || auth()->user()->can('admin-users/delete'))
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                @can('admin-users/edit')
                                                    <a href="{{ route('user.edit', $d->id) }}" class="btn btn-primary">
                                                        <i class="mdi mdi-pencil-outline"></i>
                                                    </a>
                                                @endcan
                                                @can('admin-users/delete')
                                                    <?php $deleteForm = "delete-form-{$loop->index}" ?>
                                                    <a href="{{ route('user.destroy', $d->id) }}"
                                                       class="btn btn-danger"
                                                       onclick="if(confirm('Deseja realmente excluir?')) {event.preventDefault(); document.getElementById('{{$deleteForm}}').submit(); }else{ return false; }">
                                                        <i class="mdi mdi-trash-can-outline"></i>
                                                    </a>
                                                @endcan
                                            </div>
                                            @can('admin-users/delete')
                                                {!! Form::open(['route' => ['user.destroy', $d->id], 'id' => $deleteForm, 'style' => 'display:none;', 'method' => 'DELETE']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="3"><strong>Total de Registros {{ $dados->total() }}</strong></td>
                                <td colspan="4">{{ $dados }}</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
