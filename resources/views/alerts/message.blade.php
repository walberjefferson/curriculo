@if(Session::has('message'))
    <div class="alert alert-fill-success alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {!! Session::get('message') !!}
    </div>
@else
    @foreach ( ['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('message-'. $msg))
            <div class="alert alert-fill-{{ $msg }} fade show">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {!! Session::get('message-'.$msg) !!}
            </div>
        @endif
    @endforeach
@endif
