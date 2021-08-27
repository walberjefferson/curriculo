<span class="help-block">
    @if(!str_contains($field, '*'))
        <strong class="text-danger">{{$errors->first($field)}}</strong>
    @else
        <ul>
            @foreach($errors->get($field) as $fieldErrors)
                <li>{{ $fieldErrors[0] }}</li>
            @endforeach
        </ul>
    @endif
</span>
