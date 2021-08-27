@extends('layout.master')

@section('content-title', 'Papeis de Usuário')

@section('breadcrumbs')
    @include('inspinia::layouts.main-panel.breadcrumbs', [
      'breadcrumbs' => [
        (object) [ 'title' => 'Painel', 'url' => route('home') ],
        (object) [ 'title' => 'Papel de Usuário', 'url' => route('role.index') ],
      ]
    ])

@endsection

@section('breadcrumbs_button')
    <a href="{{ route('role.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Novo</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title bg-primary"><h5>Papeis de Usuário</h5>
                    {{--<div class="ibox-tools">--}}
                    {{--<span class="label label-warning-light pull-right">Welcome</span>--}}
                    {{--</div>--}}
                </div>

                <div class="ibox-content">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th width="5%" class="text-center">#</th>
                            <th>Nome</th>
                            <th width="41%">Descrição</th>
                            <th width="12%" nowrap>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dados as $d)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td nowrap>{{ $d->name }}</td>
                                <td>{{ $d->description }}</td>
                                <td>
                                    <div class="btn-group btn-group-justified btn-group-xs">
                                        {{--<a href="" class="btn btn-success"><i class="fa fa-eye"></i></a>--}}
                                        <a href="{{ route('role.edit', $d->id) }}" class="btn btn-primary">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <?php $deleteForm = "delete-form-{$loop->index}" ?>
                                        <a href="{{ route('role.destroy', $d->id) }}"
                                           class="btn btn-danger no-margins"
                                           onclick="if(confirm('Deseja realmente excluir?')) {event.preventDefault(); document.getElementById('{{$deleteForm}}').submit(); }else{ return false; }">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                        {!! Form::open(['route' => ['role.destroy', $d->id], 'id' => $deleteForm, 'style' => 'display:none;', 'method' => 'DELETE']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2"><strong>Total de Registros {{ $dados->total() }}</strong></td>
                            <td colspan="2">{{ $dados }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
