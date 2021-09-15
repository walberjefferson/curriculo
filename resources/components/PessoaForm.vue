<template>
    <div>
        <b-modal id="modal-1" title="Adicionar Foto" size="lg">
            <cropper
                class="cropper"
                :src="imagem_cropper"
                :stencil-props="{
		            aspectRatio: 3/4
	            }"
            />

            <b-form-file @change="getFoto" v-model="imagem" placeholder="Adicionar foto" accept=".jpg, .jpeg, .png"></b-form-file>
        </b-modal>

        <div class="row">
            <div class="col-md-2">
                <b-img :blank="true" fluid width="300" height="400" blank-color="#CCC" alt="HEX shorthand color image (#777)"></b-img>
                <b-button size="sm" v-b-modal.modal-1 for="foto" block>Adicionar</b-button>
            </div>
            <div class="col-md-10">

                <h6 class="card-title text-primary">Dados Pessoais</h6>

                <div class="row">
                    <div class="col-md-6">
                        <b-form-group label="Nome" label-for="nome" label-class="text-muted">
                            <b-form-input id="nome" v-model="form.nome" type="text" required/>
                        </b-form-group>
                    </div>

                    <div class="col-md-3">
                        <b-form-group label="Data Nascimento" label-for="data_nascimento" label-class="text-muted">
                            <b-form-datepicker
                                :date-format-options="{ year: 'numeric', month: 'numeric', day: 'numeric' }"
                                placeholder="Data Nascimento" id="data_nascimento" v-model="form.data_nascimento"
                                locale="pt-br"></b-form-datepicker>
                        </b-form-group>
                    </div>

                    <div class="col-md-3">
                        <b-form-group label="Sexo" label-for="sexo" label-class="text-muted">
                            <b-form-select
                                id="sexo"
                                v-model="form.sexo_id"
                                :options="sexos"
                                value-field="id"
                                text-field="nome"
                                required
                            >
                                <template #first>
                                    <b-form-select-option :value="null">Selecione o sexo</b-form-select-option>
                                </template>
                            </b-form-select>
                        </b-form-group>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-3">
                        <b-form-group label="CPF" label-for="cpf" label-class="text-muted">
                            <b-form-input id="cpf" v-model="form.cpf" type="text" ref="cpf" required/>
                        </b-form-group>
                    </div>

                    <div class="col-md-3">
                        <b-form-group label="Perfil do Instagam (@)" label-for="instagram" label-class="text-muted">
                            <b-form-input id="instagram" v-model="form.instagram" type="text"/>
                        </b-form-group>
                    </div>

                    <div class="col-md-3">
                        <b-form-group label="Telefone" label-for="telefone" label-class="text-muted">
                            <b-form-input id="telefone" v-model="form.telefone" class="telefone" type="text"/>
                        </b-form-group>
                    </div>

                    <div class="col-md-3">
                        <b-form-group label="WhatsApp" label-for="whatsapp" label-class="text-muted">
                            <b-form-input id="whatsapp" v-model="form.whatsapp" class="telefone" type="text"/>
                        </b-form-group>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <b-form-group label="Escolaridade" label-for="escolaridade" label-class="text-muted">
                            <b-form-select
                                id="escolaridade"
                                v-model="form.escolaridade_id"
                                :options="escolaidades"
                                value-field="id"
                                text-field="nome"
                                required
                            >
                                <template #first>
                                    <b-form-select-option :value="null">Selecione a escolaridade</b-form-select-option>
                                </template>
                            </b-form-select>
                        </b-form-group>
                    </div>

                    <div class="col-md-3">
                        <b-form-group label="Estado Cívil" label-for="estado_civil_id" label-class="text-muted">
                            <b-form-select
                                id="estado_civil_id"
                                v-model="form.estado_civil_id"
                                :options="estados_civis"
                                value-field="id"
                                text-field="nome"
                                required
                            >
                                <template #first>
                                    <b-form-select-option :value="null">Selecione o estado cívil</b-form-select-option>
                                </template>
                            </b-form-select>
                        </b-form-group>
                    </div>

                    <div class="col-md-2">
                        <b-form-group label="Estado" label-for="estado_id" label-class="text-muted">
                            <b-form-select
                                id="estado_id"
                                v-model="form.estado_id"
                                :options="estados"
                                value-field="id"
                                text-field="nome"
                                required
                                @change="getCidades"
                            >
                                <template #first>
                                    <b-form-select-option :value="null">Selecione o estado</b-form-select-option>
                                </template>
                            </b-form-select>
                        </b-form-group>
                    </div>

                    <div class="col-md-4">
                        <b-form-group label="Cidade" label-for="cidade_id" label-class="text-muted">
                            <b-form-select
                                id="cidade_id"
                                v-model="form.cidade_id"
                                :options="cidades"
                                value-field="id"
                                text-field="nome"
                                required
                            >
                                <template #first>
                                    <b-form-select-option :value="null">Selecione a cidade</b-form-select-option>
                                </template>
                            </b-form-select>
                        </b-form-group>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-4 form-group">
                <label class="text-muted">
                    <abbr title="Portador de Deficiência Física" class="initialism">PCD</abbr>
                    - (Portador de Deficiência Física)
                </label>
                <div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" v-model="form.pcd" type="radio" value="1">
                            Sim
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" v-model="form.pcd" type="radio" value="0">
                            Não
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-md-4 form-group">
                <label class="text-muted"><abbr title="Carrteira Nacional de Habilitação" class="initialism">CNH</abbr>
                    - (Carrteira Nacional de
                    Habilitação)</label>
                <div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" v-model="form.cnh" type="radio" :value="true">
                            Sim
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" v-model="form.cnh" type="radio" :value="false">
                            Não
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-md-4 form-group">
                <label class="text-muted">Tem filhos?</label>
                <div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" v-model="form.filhos" type="radio" :value="true">
                            Sim
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" v-model="form.filhos" type="radio" :value="false">
                            Não
                        </label>
                    </div>
                </div>
            </div>

        </div>

        <div v-if="form.cnh || form.filhos" class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div v-if="form.cnh">
                    <b-form-group label="Categoria CNH" label-for="categoria_cnh" label-class="text-muted">
                        <b-form-input id="categoria_cnh" v-model="form.categoria_cnh" type="text"/>
                    </b-form-group>
                </div>
            </div>
            <div class="col-md-4">
                <div v-if="form.filhos">
                    <b-form-group label="Quantidade de Filhos" label-for="filhos_quantidade" label-class="text-muted">
                        <b-form-input id="filhos_quantidade" v-model="form.filhos_quantidade" type="text"/>
                    </b-form-group>
                </div>
            </div>
        </div>

        <h6 class="card-title text-primary mt-3">Habilidades</h6>

        <div class="row">
            <div class="col-md-4" v-for="habilidade in habilidades" :key="habilidade.id">
                <b-form-checkbox
                    v-model="form.habilidades"
                    :value="habilidade.id"
                >
                    {{ habilidade.nome }}
                </b-form-checkbox>
            </div>
        </div>

        <h6 class="card-title text-primary mt-3">Experiências</h6>

        <div v-for="(experiencia, index) in form.experiencias" :key="index" class="row">
            <div class="col-md-3">
                <b-form-group label="Cargo" label-for="cargo" label-class="text-muted">
                    <b-form-input id="cargo" v-model="form.experiencias[index].cargo" type="text"/>
                </b-form-group>
            </div>
            <div class="col-md-4">
                <b-form-group label="Empresa" label-for="empresa" label-class="text-muted">
                    <b-form-input id="empresa" v-model="form.experiencias[index].empresa" type="text"/>
                </b-form-group>
            </div>
            <div class="col-md-3">
                <b-form-group label="Tempo de Seviço" label-for="tempo_servico" label-class="text-muted">
                    <b-form-input id="tempo_servico" v-model="form.experiencias[index].tempo_servico" type="text"/>
                </b-form-group>
            </div>
            <div class="col-md-2">
                <b-form-group label="Saída" label-for="saida" label-class="text-muted">
                    <b-form-input id="saida" v-model="form.experiencias[index].saida" type="text"/>
                </b-form-group>
            </div>
        </div>

        <h6 class="card-title text-primary mt-3">Dados Postais</h6>

        <div class="row">
            <div class="col-md-5">
                <b-form-group label="Endereço" label-for="endereco" label-class="text-muted">
                    <b-form-input id="endereco" v-model="form.endereco" type="text"/>
                </b-form-group>
            </div>

            <div class="col-md-1">
                <b-form-group label="Nº" label-for="endereco_numero" label-class="text-muted">
                    <b-form-input id="endereco_numero" v-model="form.endereco_numero" type="text"/>
                </b-form-group>
            </div>

            <div class="col-md-3">
                <b-form-group label="Ponto de Referência" label-for="ponto_referrencia" label-class="text-muted">
                    <b-form-input id="ponto_referrencia" v-model="form.ponto_referrencia" type="text"/>
                </b-form-group>
            </div>

            <div class="col-md-3">
                <b-form-group label="Complemento" label-for="complemento" label-class="text-muted">
                    <b-form-input id="complemento" v-model="form.complemento" type="text"/>
                </b-form-group>
            </div>
        </div>

        <h6 class="card-title text-primary mt-3">Outras Informações</h6>

        <b-form-group label="Outras Informações" label-for="outras_informacoes" label-class="text-muted">
            <b-form-textarea id="outras_informacoes" v-model="form.outras_informacoes" rows="4"></b-form-textarea>
        </b-form-group>

        <pre>{{ imagem_cropper }}</pre>
        <pre>{{ form }}</pre>
    </div>

</template>

<script>
import axios from 'axios';
import { Cropper } from 'vue-advanced-cropper';
import 'vue-advanced-cropper/dist/style.css';

export default {
    name: "PessoaForm",
    components: {
        Cropper,
    },
    data: () => ({
        imagem: null,
        imagem_cropper: null,
        form: {},
        sexos: [],
        estados: [],
        estados_civis: [],
        escolaidades: [],
        cidades: [],
        habilidades: [],
        default: {
            id: undefined,
            nome: null,
            foto: null,
            data_nascimento: null,
            sexo_id: null,
            pcd: null,
            cpf: null,
            instagram: null,
            telefone: null,
            whatsapp: null,
            escolaridade_id: null,
            estado_civil_id: null,
            estado_id: null,
            cidade_id: null,
            cnh: null,
            categoria_cnh: null,
            filhos: null,
            filhos_quantidade: null,
            endereco: null,
            endereco_numero: null,
            ponto_referrencia: null,
            complemento: null,
            outras_informacoes: null,
            habilidades: [],
            experiencias: [
                { cargo: null, empresa: null, tempo_servico: null, saida: null, pessoa_id: null },
                { cargo: null, empresa: null, tempo_servico: null, saida: null, pessoa_id: null }
            ]
        }
    }),
    methods: {
        getFoto(event) {
            console.log(event);
            console.log(this.imagem);
        },
        reset() {
            this.form = Object.assign({}, this.default);
        },
        getEstados() {
            document.body.classList.remove('loaded');
            axios.get('/api/estado').then(({ data }) => {
                this.estados = data;
            }).catch(({ response }) => {
                this.$swal('Erro', 'Erro ao tentar carregar estadoss', 'error');
            }).finally(() => {
                document.body.classList.add('loaded');
            })
        },
        getHabilidades() {
            document.body.classList.remove('loaded');
            axios.get('/api/habilidade').then(({ data }) => {
                this.habilidades = data;
            }).catch(({ response }) => {
                this.$swal('Erro', 'Erro ao tentar carregar habilidades', 'error');
            }).finally(() => {
                document.body.classList.add('loaded');
            })
        },
        getSexo() {
            document.body.classList.remove('loaded');
            axios.get('/api/sexo').then(({ data }) => {
                this.sexos = data;
            }).catch(({ response }) => {
                this.$swal('Erro', 'Erro ao tentar carregar sexos.', 'error');
            }).finally(() => {
                document.body.classList.add('loaded');
            })
        },
        getEscolaridades() {
            document.body.classList.remove('loaded');
            axios.get('/api/escolaridade').then(({ data }) => {
                this.escolaidades = data;
            }).catch(({ response }) => {
                this.$swal('Erro', 'Erro ao tentar carregar escolaridades.', 'error');
            }).finally(() => {
                document.body.classList.add('loaded');
            });
        },
        getEstadoCivil() {
            document.body.classList.remove('loaded');
            axios.get('/api/estado_civil').then(({ data }) => {
                this.estados_civis = data;
            }).catch(({ response }) => {
                this.$swal('Erro', 'Erro ao tentar carregar estados civis.', 'error');
            }).finally(() => {
                document.body.classList.add('loaded');
            });
        },
        getCidades() {
            document.body.classList.remove('loaded');
            axios.post('/api/cidade', { estado_id: this.form.estado_id }).then(({ data }) => {
                this.form.cidade_id = null;
                this.cidades = data;
            }).catch(({ response }) => {
                this.$swal('Erro', 'Erro ao tentar carregar cidades', 'error');
            }).finally(() => {
                document.body.classList.add('loaded');
            });
        }
    },
    created() {
        this.reset();
        this.getEstados();
        this.getSexo();
        this.getEscolaridades();
        this.getEstadoCivil();
        this.getHabilidades();
    },
    watch: {
        // imagem: (file) => {
        //     if(file) {
        //         console.log(file);
        //
        //         let reader  = new FileReader();
        //
        //         reader.onloadend = function () {
        //             console.log(reader.result); //this is an ArrayBuffer
        //         }
        //         this.imagem_cropper = reader.readAsArrayBuffer(file);
        //     }
        // }
    }
}
</script>

<style>
.custom-file-label::after {
    content: 'Adicionar' !important;
}
</style>
