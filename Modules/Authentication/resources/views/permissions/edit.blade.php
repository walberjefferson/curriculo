@extends('layout.master')

@section('content-title', "Permissões de {$role->name}")

@section('breadcrumbs')
    @include('layout.breadcrumbs', [
      'breadcrumbs' => [
        (object) [ 'title' => 'Painel', 'url' => route('admin.dashboard') ],
        (object) [ 'title' => 'Permissões', 'url' => route('admin.role.index') ],
        (object) [ 'title' => 'Editar', 'url' => '' ],
      ]
    ])

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['route' => ['admin.role.permission.update', $role], 'method' => 'PUT']) !!}
            <div class="card">
                <div class="card-body">
                    <div class="list-group">
                        @foreach($permissionsGroup as $pg)
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1 text-gray">{{ $pg->description }}</h5>
                                    <span class="badge badge-pill badge-secondary">{{ $pg->name }}</span>
                                </div>

                                <div class="list-group-item-text">
                                    <?php
                                    $permissionSubGroup = $permissions->filter(function ($value) use ($pg) {
                                        return $value->name == $pg->name;
                                    });
                                    ?>
                                    @foreach($permissionSubGroup as $permission)
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="checkbox-{{$permission->id}}">
                                                <input type="checkbox" name="permissions[]"
                                                       class="form-check-input"
                                                       value="{{$permission->id}}"
                                                       {{ $role->permissions->contains('id', $permission->id) ? 'checked="checked"' : '' }}
                                                       id="checkbox-{{$permission->id}}"> {{ $permission->resource_description }}
                                            </label>
                                        </div>
                                    @endforeach

                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            <i class="mdi mdi-send"></i> Salvar
                        </button>
                        <a href="{{ route('admin.role.index') }}" class="btn btn-secondary">
                            <i class="mdi mdi-backup-restore"></i> Voltar
                        </a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
