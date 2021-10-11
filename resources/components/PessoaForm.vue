<template>
    <div>
        <b-modal v-model="modalShow" id="modal-1" title="Cortar Foto" size="lg">
            <Cropper
                ref="cropper"
                class="cropper"
                :src="imagem_cropper"
                :stencil-props="{
                    aspectRatio: 3/4
                }"
            />

            <template #modal-footer>
                <div class="w-100">
                    <b-button variant="primary" class="float-right" @click="cortaFoto">
                        Cortar
                    </b-button>
                    <b-button variant="secondary" class="mr-2 float-right" @click="modalShow=false">
                        Fechar
                    </b-button>
                </div>
            </template>
        </b-modal>

        <form @submit.prevent="send">
            <div class="row">
                <div class="col-md-2">
                    <label for="upload_image">
                        <div class="image_area">
                            <b-img v-if="fotoBase64" :src="fotoBase64" fluid width="300" height="400" blank-color="#CCC"
                                   :alt="form.nome">
                            </b-img>
                            <b-img v-else :blank="true" fluid width="300" height="400" blank-color="#CCC"
                                   alt="HEX shorthand color image (#777)">
                            </b-img>
                            <div class="overlay">
                                <div class="text">Clique para carregar a foto</div>
                            </div>
                        </div>
                        <b-form-file @change="getFoto" id="upload_image" style="display: none"
                                     accept=".jpg, .jpeg, .png"></b-form-file>
                    </label>
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
                                        <b-form-select-option :value="null">Selecione a escolaridade
                                        </b-form-select-option>
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
                                        <b-form-select-option :value="null">Selecione o estado cívil
                                        </b-form-select-option>
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
                                <input class="form-check-input" v-model="form.pcd" type="radio" :value="true">
                                Sim
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" v-model="form.pcd" type="radio" :value="false">
                                Não
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 form-group">
                    <label class="text-muted"><abbr title="Carrteira Nacional de Habilitação"
                                                    class="initialism">CNH</abbr>
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
                        <b-form-group label="Quantidade de Filhos" label-for="filhos_quantidade"
                                      label-class="text-muted">
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

            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit"><i class="mdi mdi-send"></i> Salvar</button>
                <a href="#" class="btn btn-secondary"><i class="mdi mdi-backup-restore"></i> Voltar</a>
            </div>
        </form>
    </div>

</template>

<script>
import axios from 'axios';
import {ERROR_422} from "../js/services/error";
import {Cropper} from 'vue-advanced-cropper';
import 'vue-advanced-cropper/dist/style.css';

export default {
    name: "PessoaForm",
    components: {
        Cropper,
    },
    data: () => ({
        modalShow: false,
        imagem: null,
        imagem_cropper: null,
        canvas: null,
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
                {cargo: null, empresa: null, tempo_servico: null, saida: null, pessoa_id: null},
                {cargo: null, empresa: null, tempo_servico: null, saida: null, pessoa_id: null}
            ]
        }
    }),
    methods: {
        getFoto(event) {
            const _self = this;
            let files = event.target.files;

            let done = (url) => {
                _self.modalShow = true;
                _self.imagem_cropper = url;
            };

            if (files && files.length > 0) {
                let reader = new FileReader();
                reader.onload = function (event) {
                    done(reader.result);
                };
                reader.readAsDataURL(files[0]);
            }
        },
        cortaFoto() {
            const {canvas} = this.$refs.cropper.getResult();
            this.canvas = canvas;
            this.imagem = canvas.toDataURL('image/jpeg');
            this.modalShow = false;
        },
        reset() {
            this.form = Object.assign({}, this.default);
        },
        getEstados() {
            document.body.classList.remove('loaded');
            axios.get('/api/estado').then(({data}) => {
                this.estados = data;
            }).catch(({response}) => {
                this.$swal('Erro', 'Erro ao tentar carregar estadoss', 'error');
            }).finally(() => {
                document.body.classList.add('loaded');
            })
        },
        getHabilidades() {
            document.body.classList.remove('loaded');
            axios.get('/api/habilidade').then(({data}) => {
                this.habilidades = data;
            }).catch(({response}) => {
                this.$swal('Erro', 'Erro ao tentar carregar habilidades', 'error');
            }).finally(() => {
                document.body.classList.add('loaded');
            })
        },
        getSexo() {
            document.body.classList.remove('loaded');
            axios.get('/api/sexo').then(({data}) => {
                this.sexos = data;
            }).catch(({response}) => {
                this.$swal('Erro', 'Erro ao tentar carregar sexos.', 'error');
            }).finally(() => {
                document.body.classList.add('loaded');
            })
        },
        getEscolaridades() {
            document.body.classList.remove('loaded');
            axios.get('/api/escolaridade').then(({data}) => {
                this.escolaidades = data;
            }).catch(({response}) => {
                this.$swal('Erro', 'Erro ao tentar carregar escolaridades.', 'error');
            }).finally(() => {
                document.body.classList.add('loaded');
            });
        },
        getEstadoCivil() {
            document.body.classList.remove('loaded');
            axios.get('/api/estado_civil').then(({data}) => {
                this.estados_civis = data;
            }).catch(({response}) => {
                this.$swal('Erro', 'Erro ao tentar carregar estados civis.', 'error');
            }).finally(() => {
                document.body.classList.add('loaded');
            });
        },
        async getCidades() {
            document.body.classList.remove('loaded');
            await axios.post('/api/cidade', {estado_id: this.form.estado_id}).then(({data}) => {
                this.form.cidade_id = null;
                this.cidades = data;
            }).catch(({response}) => {
                this.$swal('Erro', 'Erro ao tentar carregar cidades', 'error');
            }).finally(() => {
                document.body.classList.add('loaded');
            });
        },
        createFormData(formData, key, data) {
            if (data === Object(data) || Array.isArray(data)) {
                for (let i in data) {
                    this.createFormData(formData, key + '[' + i + ']', data[i]);
                }
            } else {
                formData.append(key, data);
            }
        },
        send() {
            if (this.canvas) {
                this.canvas.toBlob((blob) => {
                    let form = this.prepareForm(blob);
                    axios.post('/api/curriculo', form).then(({data}) => {
                        this.$swal("Sucesso", data.message, "success");
                    }).catch(({response}) => {
                        console.log(3, response)
                        if (response.status === 422) {
                            let errors = ERROR_422(response);
                            console.log(errors);
                        }
                    });
                }, 'image/jpeg');
            } else {
                axios.post('/api/curriculo', this.form).then(({data}) => {
                    this.$swal("Sucesso", data.message, "success");
                }).catch(({response}) => {
                    console.log(4, response)
                    if (response.status === 422) {
                        let errors = ERROR_422(response);
                        console.log(errors);
                    }
                });
            }
        },
        prepareForm(blob = null) {
            const form = new FormData();
            Object.keys(this.form).map((key) => {
                if (key === 'habilidades') {
                    this.createFormData(form, key, this.form[key]);
                } else if (key === 'experiencias') {
                    this.createFormData(form, key, this.form[key]);
                } else if (key === 'pcd' || key === 'cnh' || key === 'filhos') {
                    form.append(key, this.form[key]);
                } else if (key === 'foto' && typeof blob === 'object') {
                    form.append(key, blob);
                } else {
                    form.append(key, this.form[key]);
                }
            });

            return form;
        },
        changeData(data) {
            Object.entries(data).forEach(([key, value]) => {
                if (key === 'habilidades') {
                    this.form[key] = value.map((p) => p.id);
                } else if (key === 'experiencias') {
                    let arrayObj = [];
                    this.form[key].map((item, index) => {
                        (value[index]) ? arrayObj.push(value[index]) : arrayObj.push(item);
                    });
                    this.form[key] = arrayObj;
                } else if (key === 'estado_id') {
                    this.form[key] = value;
                    this.getCidades().finally(() => {
                        this.form['cidade_id'] = data.cidade_id;
                    });
                } else {
                    this.form[key] = value;
                }
            });
        }
    },
    computed: {
        fotoBase64() {
            if (this.form.foto) {
                return this.form.foto;
            } else if (this.imagem) {
                return this.imagem;
            } else {
                return null;
            }
        },
    },
    created() {
        this.reset();
        this.getEstados();
        this.getSexo();
        this.getEscolaridades();
        this.getEstadoCivil();
        this.getHabilidades();
    }
}
</script>

<style>
.custom-file-label::after {
    content: 'Adicionar' !important;
}

.overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(255, 255, 255, 0.5);
    overflow: hidden;
    height: 0;
    transition: .5s ease;
    width: 100%;
    padding: 5px 10px 0;
}

.image_area {
    position: relative;
}

.image_area:hover .overlay {
    height: 30%;
    cursor: pointer;
}
</style>
