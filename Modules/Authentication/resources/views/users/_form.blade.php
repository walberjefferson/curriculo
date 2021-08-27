<div class="row">
    {!! Html::openFormGroup('name', $errors, 'col-md-8') !!}
    {!! Form::label('name', 'Nome', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! Form::error('name', $errors) !!}
    {!! Html::closeFormGroup() !!}

    {!! Html::openFormGroup('cpf', $errors, 'col-md-4') !!}
    {!! Form::label('cpf', 'CPF', ['class' => 'control-label']) !!}
    {!! Form::text('cpf', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! Form::error('cpf', $errors) !!}
    {!! Html::closeFormGroup() !!}
</div>

<div class="row">
    {!! Html::openFormGroup('email', $errors, 'col-md-4') !!}
    {!! Form::label('email', 'E-mail', ['class' => 'control-label required']) !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! Form::error('email', $errors) !!}
    {!! Html::closeFormGroup() !!}

    {!! Html::openFormGroup('password', $errors, 'col-md-4') !!}
    {!! Form::label('password', 'Senha', ['class' => 'control-label']) !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
    {!! Form::error('password', $errors) !!}
    {!! Html::closeFormGroup() !!}

    {!! Html::openFormGroup('password_confirmation', $errors, 'col-md-4') !!}
    {!! Form::label('password_confirmation', 'Confirmar Senha', ['class' => 'control-label']) !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
    {!! Form::error('password_confirmation', $errors) !!}
    {!! Html::closeFormGroup() !!}
</div>

{!! Html::openFormGroup('roles.*', $errors) !!}
{!! Form::label('roles[]', 'Papel de Usuário', ['class' => 'control-label required']) !!}
{!! Form::select('roles[]', $roles, null, ['class' => 'form-control', 'placeholder' => 'Selecione o papel desejado', 'multiple']) !!}
{!! Form::error('roles.*', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('ativo', $errors) !!}
<div class="checkbox-inline i-checks">
    <label for="ativo">
        {!! Form::checkbox('ativo', null, null, ['class' => 'form-control']) !!}
        Ativo?
    </label>
</div>
{!! Form::error('ativo', $errors) !!}
{!! Html::closeFormGroup() !!}
