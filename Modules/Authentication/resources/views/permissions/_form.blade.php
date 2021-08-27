{!! Html::openFormGroup('name', $errors) !!}
{!! Form::label('name', 'Nome', ['class' => 'control-label required']) !!}
{!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
{!! Form::error('name', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('description', $errors) !!}
{!! Form::label('description', 'Descrição', ['class' => 'control-label required']) !!}
{!! Form::text('description', null, ['class' => 'form-control']) !!}
{!! Form::error('description', $errors) !!}
{!! Html::closeFormGroup() !!}