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
                    <div id="form_pessoa">
                        <pessoa-form voltar="{{ route('admin.curriculo.index') }}"></pessoa-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script src="{{ asset('js/pessoa.js') }}"></script>
@endpush
