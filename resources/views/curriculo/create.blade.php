@extends('layouts.app')

@section('content')
    <div class="container p-4 bg-white" >
        <div class="row justify-content-center">
            <div id="app_curriculo">
                <pessoa-web-form></pessoa-web-form>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script src="{{ asset(mix('js/pessoa_web.js')) }}"></script>
@endpush
