@extends('layout.master')

@section('content-title', 'Adicionar Currículo')

@section('breadcrumbs')
    @include('layout.breadcrumbs', [
      'breadcrumbs' => [
        (object) [ 'title' => 'Painel', 'url' => route('admin.dashboard') ],
        (object) [ 'title' => 'Currículo', 'url' => route('admin.curriculo.index') ],
        (object) [ 'title' => 'Novo', 'url' => '' ],
      ]
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    {!! Form::open(['url' => route('admin.curriculo.store')]) !!}

                    <div id="form_pessoa">
                        <pessoa-form></pessoa-form>
                    </div>
{{--                    @include('admin.pessoa._form')--}}
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">
                            <i class="mdi mdi-send"></i> Salvar
                        </button>
                        <a href="{{ route('admin.curriculo.index') }}" class="btn btn-secondary">
                            <i class="mdi mdi-backup-restore"></i> Voltar</a>
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script src="{{ asset('js/pessoa.js') }}"></script>
@endpush
