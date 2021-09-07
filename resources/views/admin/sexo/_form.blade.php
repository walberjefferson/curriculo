{!! Html::openFormGroup('nome', $errors) !!}
{!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
{!! Form::text('nome', null, ['class' => 'form-control', 'required' => 'required']) !!}
{!! Form::error('nome', $errors) !!}
{!! Html::closeFormGroup() !!}
