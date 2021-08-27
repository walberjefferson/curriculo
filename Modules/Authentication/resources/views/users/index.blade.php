@extends('layout.master')

@section('content-title', 'Usuário')

{{--@section('breadcrumbs')--}}
{{--    @include('inspinia::layouts.main-panel.breadcrumbs', [--}}
{{--      'breadcrumbs' => [--}}
{{--        (object) [ 'title' => 'Painel', 'url' => route('home') ],--}}
{{--        (object) [ 'title' => 'Usuários', 'url' => route('user.index') ],--}}
{{--      ]--}}
{{--    ])--}}

{{--@endsection--}}

{{--@section('breadcrumbs_button')--}}
{{--    @can('admin-users/create')--}}
{{--        <a href="{{ route('user.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Novo</a>--}}
{{--    @endcan--}}
{{--@endsection--}}

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title bg-primary">
                    <h5>Usuários</h5>
                </div>

                <div class="ibox-content">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th width="3%" class="text-center">#</th>
                            <th>Nome</th>
                            <th width="12%">CPF</th>
                            <th width="20%">E-mail</th>
                            <th width="21%">Roles</th>
                            <th width="5%" nowrap>Ativo?</th>
                            @if(auth()->user()->can('admin-users/edit') || auth()->user()->can('admin-users/delete'))
                                <th width="12%" nowrap>Ações</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dados as $d)
                            <tr>
                                <td nowrap class="text-center">{{ $loop->iteration }}</td>
                                <td nowrap>{{ $d->name }}</td>
                                <td nowrap>{{ mask_cpf_or_cnpj($d->cpf) }}</td>
                                <td>{{ $d->email }}</td>
                                <td>{{ $d->roles->implode('name', '|') }}</td>
                                <td class="text-center">
                                    <i class="fa {{ ($d->ativo) ? 'fa-check text-success' : 'fa-times text-danger' }}"></i>
                                </td>
                                @if(auth()->user()->can('admin-users/edit') || auth()->user()->can('admin-users/delete'))
                                    <td>
                                        <div class="btn-group btn-group-justified btn-group-xs">
                                            @can('admin-users/edit')
                                                <a href="{{ route('user.edit', $d->id) }}" class="btn btn-primary">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>
                                            @endcan
                                            @can('admin-users/delete')
                                                <?php $deleteForm = "delete-form-{$loop->index}" ?>
                                                <a href="{{ route('user.destroy', $d->id) }}"
                                                   class="btn btn-danger no-margins"
                                                   onclick="if(confirm('Deseja realmente excluir?')) {event.preventDefault(); document.getElementById('{{$deleteForm}}').submit(); }else{ return false; }">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                                {!! Form::open(['route' => ['user.destroy', $d->id], 'id' => $deleteForm, 'style' => 'display:none;', 'method' => 'DELETE']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </div>
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
@endsection
