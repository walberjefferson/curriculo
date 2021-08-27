@if ($breadcrumbs)
    <nav class="page-breadcrumb">
        <ol class="breadcrumb hidden-print">
            @foreach ($breadcrumbs as $breadcrumb)
                @if ($loop->last)
                    <li class="breadcrumb-item active" aria-current="page"><strong>{{ $breadcrumb->title }}</strong></li>
                @else
                    <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                @endif
            @endforeach
        </ol>
    </nav>
@endif
