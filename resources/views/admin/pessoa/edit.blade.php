@extends('layout.master')

@section('content-title', 'Editar Escolaridade')

@section('breadcrumbs')
    @include('layout.breadcrumbs', [
      'breadcrumbs' => [
        (object) [ 'title' => 'Painel', 'url' => route('admin.dashboard') ],
        (object) [ 'title' => 'Escolaridade', 'url' => route('admin.escolaridade.index') ],
        (object) [ 'title' => 'Editar', 'url' => '' ],
      ]
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="form_pessoa">
                        <pessoa-form uuid="{{ $dados->uuid }}"></pessoa-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script src="{{ asset('js/pessoa.js') }}"></script>
@endpush
