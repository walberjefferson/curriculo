<div class="row">
    {!! Html::openFormGroup('password', $errors, 'col-md-6') !!}
    {!! Form::label('password', 'Senha', ['class' => 'control-label']) !!}
    {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
    {!! Form::error('password', $errors) !!}
    {!! Html::closeFormGroup() !!}

    {!! Html::openFormGroup('password_confirmation', $errors, 'col-md-6') !!}
    {!! Form::label('password_confirmation', 'Confirmar Senha', ['class' => 'control-label']) !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control', 'required']) !!}
    {!! Form::error('password_confirmation', $errors) !!}
    {!! Html::closeFormGroup() !!}
</div>
