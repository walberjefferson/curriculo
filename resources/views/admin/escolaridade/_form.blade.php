<div class="row">
    {!! Html::openFormGroup('codigo', $errors, 'col-md-3') !!}
    {!! Form::label('codigo', 'Código', ['class' => 'control-label']) !!}
    {!! Form::text('codigo', null, ['class' => 'form-control']) !!}
    {!! Form::error('codigo', $errors) !!}
    {!! Html::closeFormGroup() !!}

    {!! Html::openFormGroup('nome', $errors, 'col-md-9') !!}
    {!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
    {!! Form::text('nome', null, ['class' => 'form-control', 'required']) !!}
    {!! Form::error('nome', $errors) !!}
    {!! Html::closeFormGroup() !!}
</div>
