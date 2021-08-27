<div class="row">
    {!! Html::openFormGroup('name', $errors, 'col-md-5') !!}
    {!! Form::label('name', 'Nome', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! Form::error('name', $errors) !!}
    {!! Html::closeFormGroup() !!}

    <div class="col-md-7">
        <div class="row">
            {!! Html::openFormGroup('email', $errors, 'col-md-6') !!}
            {!! Form::label('email', 'E-mail', ['class' => 'control-label required']) !!}
            {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! Form::error('email', $errors) !!}
            {!! Html::closeFormGroup() !!}

            {!! Html::openFormGroup('password', $errors, 'col-md-3') !!}
            {!! Form::label('password', 'Senha', ['class' => 'control-label']) !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
            {!! Form::error('password', $errors) !!}
            {!! Html::closeFormGroup() !!}

            {!! Html::openFormGroup('password_confirmation', $errors, 'col-md-3') !!}
            {!! Form::label('password_confirmation', 'Confirmar Senha', ['class' => 'control-label']) !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
            {!! Form::error('password_confirmation', $errors) !!}
            {!! Html::closeFormGroup() !!}
        </div>
    </div>
</div>

{!! Html::openFormGroup('roles.*', $errors) !!}
{!! Form::label('roles[]', 'Papel de Usuário', ['class' => 'control-label required']) !!}
{!! Form::select('roles[]', $roles, null, ['class' => 'form-control', 'placeholder' => 'Selecione o papel desejado', 'multiple']) !!}
{!! Form::error('roles.*', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('ativo', $errors, 'form-check form-check-flat form-check-primary') !!}
<label class="form-check-label">
    {!! Form::checkbox('ativo', null, null, ['class' => 'form-check-input']) !!}
    Ativo?
</label>
{!! Form::error('ativo', $errors) !!}
{!! Html::closeFormGroup() !!}
