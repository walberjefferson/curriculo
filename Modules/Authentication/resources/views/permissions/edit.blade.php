@extends('layout.master')

@section('content-title', "Permissões de {$role->name}")

@section('breadcrumbs')
    @include('inspinia::layouts.main-panel.breadcrumbs', [
      'breadcrumbs' => [
        (object) [ 'title' => 'Painel', 'url' => route('home') ],
        (object) [ 'title' => 'Permissões', 'url' => route('role.index') ],
        (object) [ 'title' => 'Editar', 'url' => '' ],
      ]
    ])

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title bg-primary"><h5>Permissões de {{ $role->name }}</h5></div>

                <div class="ibox-content">

                    {!! Form::open(['route' => ['role.permission.update', $role], 'method' => 'PUT']) !!}

                    <ul class="list-group">
                        @foreach($permissionsGroup as $pg)
                            <li class="list-group-item">
                                <h3 class="list-group-item-heading">{{ $pg->description }}</h3>
                                <div class="hr-line-dashed m-t-none"></div>
                                <p class="list-group-item-text">
                                <ul class="list-inline">
                                    <?php
                                    $permissionSubGroup = $permissions->filter(function ($value) use ($pg) {
                                        return $value->name == $pg->name;
                                    });
                                    ?>
                                    @foreach($permissionSubGroup as $permission)
                                        <li>
                                            <div class="checkbox-inline i-checks">
                                                <label for="checkbox-{{$permission->id}}">
                                                    <input type="checkbox" name="permissions[]"
                                                           value="{{$permission->id}}"
                                                           {{ $role->permissions->contains('id', $permission->id) ? 'checked="checked"' : '' }}
                                                           id="checkbox-{{$permission->id}}"> {{ $permission->resource_description }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                                </p>
                            </li>
                        @endforeach
                    </ul>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-paper-plane-o"></i> Salvar
                        </button>
                        <a href="{{ route('role.index') }}" class="btn btn-warning"><i class="fa fa-undo"></i>
                            Voltar</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
