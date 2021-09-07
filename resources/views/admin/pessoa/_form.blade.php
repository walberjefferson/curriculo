<h6 class="card-title text-primary">Dados Pessoais</h6>

<div class="row">
    {!! Html::openFormGroup('nome', $errors, 'col-md-5') !!}
    {!! Form::label('nome', 'Nome', ['class' => 'text-muted']) !!}
    {!! Form::text('nome', null, ['class' => 'form-control', 'required']) !!}
    {!! Form::error('nome', $errors) !!}
    {!! Html::closeFormGroup() !!}

    {!! Html::openFormGroup('data_nascimento', $errors, 'col-md-2') !!}
    {!! Form::label('data_nascimento', 'Data Nascimento', ['class' => 'text-muted']) !!}
    {!! Form::text('data_nascimento', null, ['class' => 'form-control']) !!}
    {!! Form::error('data_nascimento', $errors) !!}
    {!! Html::closeFormGroup() !!}

    {!! Html::openFormGroup('sexo_id', $errors, 'col-md-2') !!}
    {!! Form::label('sexo_id', 'Sexo', ['class' => 'text-muted']) !!}
    {!! Form::select('sexo_id', $sexo, null, ['class' => 'form-control', 'placeholder' => 'Selecione o sexo']) !!}
    {!! Form::error('sexo_id', $errors) !!}
    {!! Html::closeFormGroup() !!}

    {!! Html::openFormGroup('pcd', $errors, 'col-md-3') !!}
    <label class="text-muted"><abbr title="Portador de Deficiência Física" class="initialism">PCD</abbr> - (Portador de Deficiência Física)</label>
    <div>
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                {!! Form::radio('pcd', 1, null, ['class' => 'form-check-input']) !!}
                Sim
            </label>
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                {!! Form::radio('pcd', 0, null, ['class' => 'form-check-input']) !!}
                Não
            </label>
        </div>
    </div>
    {!! Form::error('pcd', $errors) !!}
    {!! Html::closeFormGroup() !!}
</div>

<div class="row">
    {!! Html::openFormGroup('cpf', $errors, 'col-md-3') !!}
    {!! Form::label('cpf', 'CPF', ['class' => 'text-muted']) !!}
    {!! Form::text('cpf', null, ['class' => 'form-control']) !!}
    {!! Form::error('cpf', $errors) !!}
    {!! Html::closeFormGroup() !!}

    {!! Html::openFormGroup('instagram', $errors, 'col-md-3') !!}
    {!! Form::label('instagram', 'Perfil do Instagam (@)', ['class' => 'text-muted']) !!}
    {!! Form::text('instagram', null, ['class' => 'form-control']) !!}
    {!! Form::error('instagram', $errors) !!}
    {!! Html::closeFormGroup() !!}

    {!! Html::openFormGroup('telefone', $errors, 'col-md-3') !!}
    {!! Form::label('telefone', 'Telefone', ['class' => 'text-muted']) !!}
    {!! Form::text('telefone', null, ['class' => 'form-control']) !!}
    {!! Form::error('telefone', $errors) !!}
    {!! Html::closeFormGroup() !!}

    {!! Html::openFormGroup('whatsapp', $errors, 'col-md-3') !!}
    {!! Form::label('whatsapp', 'WhatsApp', ['class' => 'text-muted']) !!}
    {!! Form::text('whatsapp', null, ['class' => 'form-control']) !!}
    {!! Form::error('whatsapp', $errors) !!}
    {!! Html::closeFormGroup() !!}
</div>

<div class="row">
    {!! Html::openFormGroup('escolaridade_id', $errors, 'col-md-3') !!}
    {!! Form::label('escolaridade_id', 'Escolaridade', ['class' => 'text-muted']) !!}
    {!! Form::select('escolaridade_id', $escolaridade, null, ['class' => 'form-control', 'placeholder' => 'Selecione a escolaridade']) !!}
    {!! Form::error('escolaridade_id', $errors) !!}
    {!! Html::closeFormGroup() !!}

    {!! Html::openFormGroup('estado_civil_id', $errors, 'col-md-3') !!}
    {!! Form::label('estado_civil_id', 'Estado Cívil', ['class' => 'text-muted']) !!}
    {!! Form::select('estado_civil_id', $estadoCivil, null, ['class' => 'form-control', 'placeholder' => 'Selecione o estado cívil']) !!}
    {!! Form::error('estado_civil_id', $errors) !!}
    {!! Html::closeFormGroup() !!}

    {!! Html::openFormGroup('estado_id', $errors, 'col-md-2') !!}
    {!! Form::label('estado_id', 'Estado', ['class' => 'text-muted']) !!}
    {!! Form::select('estado_id', $estado, null, ['class' => 'form-control', 'placeholder' => 'Selecione o estado']) !!}
    {!! Form::error('estado_id', $errors) !!}
    {!! Html::closeFormGroup() !!}

    {!! Html::openFormGroup('cidade_id', $errors, 'col-md-4') !!}
    {!! Form::label('cidade_id', 'Cidade', ['class' => 'text-muted']) !!}
    {!! Form::select('cidade_id', [], null, ['class' => 'form-control', 'placeholder' => 'Selecione a cidade']) !!}
    {!! Form::error('cidade_id', $errors) !!}
    {!! Html::closeFormGroup() !!}
</div>

<div class="row">
    {!! Html::openFormGroup('cnh', $errors, 'col-md-3') !!}
    <label class="text-muted"><abbr title="Carrteira Nacional de Habilitação" class="initialism">CNH</abbr> - (Carrteira Nacional de
        Habilitação)</label>
    <div>
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                {!! Form::radio('cnh', 1, null, ['class' => 'form-check-input']) !!}
                Sim
            </label>
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                {!! Form::radio('cnh', 0, null, ['class' => 'form-check-input']) !!}
                Não
            </label>
        </div>
    </div>
    {!! Form::error('cnh', $errors) !!}
    {!! Html::closeFormGroup() !!}

    {!! Html::openFormGroup('categoria_cnh', $errors, 'col-md-3') !!}
    {!! Form::label('categoria_cnh', 'Categoria CNH', ['class' => 'text-muted']) !!}
    {!! Form::text('categoria_cnh', null, ['class' => 'form-control']) !!}
    {!! Form::error('categoria_cnh', $errors) !!}
    {!! Html::closeFormGroup() !!}

    {!! Html::openFormGroup('filhos', $errors, 'col-md-3') !!}
    <label class="text-muted">Tem filhos?</label>
    <div>
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                {!! Form::radio('filhos', 1, null, ['class' => 'form-check-input']) !!}
                Sim
            </label>
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                {!! Form::radio('filhos', 0, null, ['class' => 'form-check-input']) !!}
                Não
            </label>
        </div>
    </div>
    {!! Form::error('filhos', $errors) !!}
    {!! Html::closeFormGroup() !!}

    {!! Html::openFormGroup('filhos_quantidade', $errors, 'col-md-3') !!}
    {!! Form::label('filhos_quantidade', 'Quantidade de Filhos', ['class' => 'text-muted']) !!}
    {!! Form::text('filhos_quantidade', null, ['class' => 'form-control']) !!}
    {!! Form::error('filhos_quantidade', $errors) !!}
    {!! Html::closeFormGroup() !!}
</div>

<h6 class="card-title text-primary mt-3">Dados Postais</h6>

<div class="row">
    {!! Html::openFormGroup('endereco', $errors, 'col-md-5') !!}
    {!! Form::label('endereco', 'Endereço', ['class' => 'text-muted']) !!}
    {!! Form::text('endereco', null, ['class' => 'form-control', 'required']) !!}
    {!! Form::error('endereco', $errors) !!}
    {!! Html::closeFormGroup() !!}

    {!! Html::openFormGroup('endereco_numero', $errors, 'col-md-1') !!}
    {!! Form::label('endereco_numero', 'Nº', ['class' => 'text-muted']) !!}
    {!! Form::text('endereco_numero', null, ['class' => 'form-control', 'required']) !!}
    {!! Form::error('endereco_numero', $errors) !!}
    {!! Html::closeFormGroup() !!}

    {!! Html::openFormGroup('ponto_referrencia', $errors, 'col-md-3') !!}
    {!! Form::label('ponto_referrencia', 'Ponto de Referência', ['class' => 'text-muted']) !!}
    {!! Form::text('ponto_referrencia', null, ['class' => 'form-control', 'required']) !!}
    {!! Form::error('ponto_referrencia', $errors) !!}
    {!! Html::closeFormGroup() !!}

    {!! Html::openFormGroup('complemento', $errors, 'col-md-3') !!}
    {!! Form::label('complemento', 'Complemento', ['class' => 'text-muted']) !!}
    {!! Form::text('complemento', null, ['class' => 'form-control', 'required']) !!}
    {!! Form::error('complemento', $errors) !!}
    {!! Html::closeFormGroup() !!}
</div>

<h6 class="card-title text-primary mt-3">Outras Informações</h6>

{!! Html::openFormGroup('outras_informacoes', $errors) !!}
{!! Form::label('outras_informacoes', 'Outras Informações', ['class' => 'text-muted']) !!}
{!! Form::textarea('outras_informacoes', null, ['class' => 'form-control']) !!}
{!! Form::error('outras_informacoes', $errors) !!}
{!! Html::closeFormGroup() !!}
