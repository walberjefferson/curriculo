@extends('layout.master')

@section('content-title', 'Papeis de Usuário')

@section('breadcrumbs')
    @include('layout.breadcrumbs', [
      'breadcrumbs' => [
        (object) [ 'title' => 'Painel', 'url' => route('admin.dashboard') ],
        (object) [ 'title' => 'Papel de Usuário', 'url' => route('admin.role.index') ],
      ]
    ])

@endsection

@section('breadcrumbs_button')
    @can('admin-roles/create')
        <a href="#" id="refresh" class="btn btn-warning text-white btn-icon-text mr-2">
            <i class="btn-icon-prepend" data-feather="refresh-cw"></i>
            Carregar Permissões
        </a>
        <a href="{{ route('admin.role.create') }}" class="btn btn-primary btn-icon-text">
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
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th width="5%" class="text-center">#</th>
                            <th>Nome</th>
                            <th width="41%">Descrição</th>
                            @canany(['admin-roles/edit', 'admin-roles/delete', 'admin-permission/edit'])
                                <th width="12%" nowrap>Ações</th>
                            @endcanany
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dados as $d)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td nowrap>{{ $d->name }}</td>
                                <td>{{ $d->description }}</td>
                                @canany(['admin-roles/edit', 'admin-roles/delete', 'admin-permission/edit'])
                                    <td>
                                        <div class="btn-group btn-group-justified">
                                            @can('admin-permission/edit')
                                                <a href="{{ route('admin.role.permission.edit', $d) }}"
                                                   class="btn btn-warning text-white"
                                                   title="Permissões">
                                                    <i class="mdi mdi-lock"></i>
                                                </a>
                                            @endcan
                                            @can('admin-roles/edit')
                                                <a href="{{ route('admin.role.edit', $d->id) }}"
                                                   class="btn btn-primary">
                                                    <i class="mdi mdi-pencil-outline"></i>
                                                </a>
                                            @endcan
                                            @can('admin-roles/delete')
                                                <?php $deleteForm = "delete-form-{$loop->index}" ?>
                                                <a href="{{ route('admin.role.destroy', $d->id) }}"
                                                   class="btn btn-danger no-margins"
                                                   onclick="if(confirm('Deseja realmente excluir?')) {event.preventDefault(); document.getElementById('{{$deleteForm}}').submit(); }else{ return false; }">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </a>
                                            @endcan
                                        </div>

                                        @can('admin-roles/delete')
                                            {!! Form::open(['route' => ['admin.role.destroy', $d->id], 'id' => $deleteForm, 'style' => 'display:none;', 'method' => 'DELETE']) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                @endcanany
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="card-footer">
                    {{ $dados }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script>
        $(function () {
           $(document).on('click', '#refresh', function (e) {
               e.preventDefault();
               document.body.classList.remove('loaded');
               axios.put('/api/refresh_permissions').then(() => {
               }).finally(() => {
                   document.body.classList.add('loaded');
               })
           })
        });
    </script>
@endpush
