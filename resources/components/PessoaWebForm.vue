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
                <div class="col-md-4 col-lg-2">
                    <label for="upload_image">
                        <div class="image_area">
                            <b-img v-if="fotoBase64" :src="fotoBase64" fluid blank-color="#CCC"
                                   :alt="form.nome"></b-img>
                            <b-img v-else src="/assets/images/default-avatar.jpg" fluid alt="Foto"></b-img>
                            <div class="overlay">
                                <div class="text">Clique para escolher a foto</div>
                            </div>
                        </div>
                        <b-form-file @change="getFoto" id="upload_image" style="display: none"
                                     accept=".jpg, .jpeg, .png"></b-form-file>
                    </label>
                </div>
                <div class="col-md-8 col-lg-10">

                    <h6 class="card-title text-primary">Dados Pessoais</h6>

                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <b-form-group label="Nome" label-for="nome" label-class="text-muted">
                                <b-form-input :state="!erros.nome ? null : !erros.nome" id="nome" v-model="form.nome"
                                              type="text" required/>
                                <b-form-invalid-feedback :state="!erros.nome ? null : !erros.nome">
                                    {{ erros.nome }}
                                </b-form-invalid-feedback>
                            </b-form-group>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <b-form-group label="Data Nascimento" label-for="data_nascimento" label-class="text-muted">
                                <b-form-input :state="!erros.data_nascimento ? null : !erros.data_nascimento"
                                              id="data_nascimento" v-model="form.data_nascimento"
                                              placeholder="Data Nascimento"
                                              type="date" required/>
                                <b-form-invalid-feedback
                                    :state="!erros.data_nascimento ? null : !erros.data_nascimento">
                                    {{ erros.data_nascimento }}
                                </b-form-invalid-feedback>
                            </b-form-group>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <b-form-group label="Sexo" label-for="sexo" label-class="text-muted">
                                <b-form-select
                                    required
                                    id="sexo"
                                    v-model="form.sexo_id"
                                    :options="sexos"
                                    value-field="id"
                                    text-field="nome"
                                    :state="!erros.sexo_id ? null : !erros.sexo_id"
                                >
                                    <template #first>
                                        <b-form-select-option :value="null">Selecione o sexo</b-form-select-option>
                                    </template>
                                </b-form-select>
                                <b-form-invalid-feedback :state="!erros.sexo_id ? null : !erros.sexo_id">
                                    {{ erros.sexo_id }}
                                </b-form-invalid-feedback>
                            </b-form-group>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <b-form-group label="CPF" label-for="cpf" label-class="text-muted">
                                <b-form-input required :state="!erros.cpf ? null : !erros.cpf" id="cpf"
                                              v-model="form.cpf" type="text" ref="cpf"/>
                                <b-form-invalid-feedback :state="!erros.cpf ? null : !erros.cpf">
                                    {{ erros.cpf }}
                                </b-form-invalid-feedback>
                            </b-form-group>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <b-form-group label="Perfil do Instagam (@)" label-for="instagram" label-class="text-muted">
                                <b-form-input :state="!erros.instagram ? null : !erros.instagram" id="instagram"
                                              v-model="form.instagram" type="text"/>
                                <b-form-invalid-feedback :state="!erros.instagram ? null : !erros.instagram">
                                    {{ erros.instagram }}
                                </b-form-invalid-feedback>
                            </b-form-group>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <b-form-group label="Telefone" label-for="telefone" label-class="text-muted">
                                <b-form-input :state="!erros.telefone ? null : !erros.telefone" id="telefone"
                                              v-model="form.telefone" class="telefone" type="text"/>
                                <b-form-invalid-feedback :state="!erros.telefone ? null : !erros.telefone">
                                    {{ erros.telefone }}
                                </b-form-invalid-feedback>
                            </b-form-group>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <b-form-group label="WhatsApp" label-for="whatsapp" label-class="text-muted">
                                <b-form-input :state="!erros.whatsapp ? null : !erros.whatsapp" id="whatsapp"
                                              v-model="form.whatsapp" class="telefone" type="text"/>
                                <b-form-invalid-feedback :state="!erros.whatsapp ? null : !erros.whatsapp">
                                    {{ erros.whatsapp }}
                                </b-form-invalid-feedback>
                            </b-form-group>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <b-form-group label="Escolaridade" label-for="escolaridade" label-class="text-muted">
                                <b-form-select
                                    required
                                    id="escolaridade"
                                    v-model="form.escolaridade_id"
                                    :options="escolaidades"
                                    value-field="id"
                                    text-field="nome"
                                    :state="!erros.escolaridade_id ? null : !erros.escolaridade_id"
                                >
                                    <template #first>
                                        <b-form-select-option :value="null">Selecione a escolaridade
                                        </b-form-select-option>
                                    </template>
                                </b-form-select>
                                <b-form-invalid-feedback
                                    :state="!erros.escolaridade_id ? null : !erros.escolaridade_id">
                                    {{ erros.escolaridade_id }}
                                </b-form-invalid-feedback>
                            </b-form-group>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <b-form-group label="Estado Cívil" label-for="estado_civil_id" label-class="text-muted">
                                <b-form-select
                                    required
                                    id="estado_civil_id"
                                    v-model="form.estado_civil_id"
                                    :options="estados_civis"
                                    value-field="id"
                                    text-field="nome"
                                    :state="!erros.estado_civil_id ? null : !erros.estado_civil_id"
                                >
                                    <template #first>
                                        <b-form-select-option :value="null">Selecione o estado cívil
                                        </b-form-select-option>
                                    </template>
                                </b-form-select>
                                <b-form-invalid-feedback
                                    :state="!erros.estado_civil_id ? null : !erros.estado_civil_id">
                                    {{ erros.estado_civil_id }}
                                </b-form-invalid-feedback>
                            </b-form-group>
                        </div>

                        <div class="col-md-4 col-lg-2">
                            <b-form-group label="Estado" label-for="estado_id" label-class="text-muted">
                                <b-form-select
                                    required
                                    id="estado_id"
                                    v-model="form.estado_id"
                                    :options="estados"
                                    value-field="id"
                                    text-field="nome" :state="!erros.estado_id ? null : !erros.estado_id"
                                    @change="getCidades"
                                >
                                    <template #first>
                                        <b-form-select-option :value="null">Selecione o estado</b-form-select-option>
                                    </template>
                                </b-form-select>
                                <b-form-invalid-feedback :state="!erros.estado_id ? null : !erros.estado_id">
                                    {{ erros.estado_id }}
                                </b-form-invalid-feedback>
                            </b-form-group>
                        </div>

                        <div class="col-md-8 col-lg-4">
                            <b-form-group label="Cidade" label-for="cidade_id" label-class="text-muted">
                                <b-form-select
                                    required
                                    id="cidade_id"
                                    v-model="form.cidade_id"
                                    :options="cidades"
                                    value-field="id"
                                    text-field="nome"
                                    :state="!erros.cidade_id ? null : !erros.cidade_id"
                                >
                                    <template #first>
                                        <b-form-select-option :value="null">Selecione a cidade</b-form-select-option>
                                    </template>
                                </b-form-select>
                                <b-form-invalid-feedback :state="!erros.cidade_id ? null : !erros.cidade_id">
                                    {{ erros.cidade_id }}
                                </b-form-invalid-feedback>
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
                    <b-form-invalid-feedback :state="!erros.pcd ? null : !erros.pcd">
                        {{ erros.pcd }}
                    </b-form-invalid-feedback>
                </div>

                <div class="col-md-4 form-group">
                    <label class="text-muted">
                        <abbr title="Carrteira Nacional de Habilitação"
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
                    <b-form-invalid-feedback :state="!erros.cnh ? null : !erros.cnh">
                        {{ erros.cnh }}
                    </b-form-invalid-feedback>
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
                    <b-form-invalid-feedback :state="!erros.filhos ? null : !erros.filhos">
                        {{ erros.filhos }}
                    </b-form-invalid-feedback>
                </div>

            </div>

            <div v-if="form.cnh || form.filhos" class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div v-if="form.cnh">
                        <b-form-group label="Categoria CNH" label-for="categoria_cnh" label-class="text-muted">
                            <b-form-input :state="!erros.categoria_cnh ? null : !erros.categoria_cnh" id="categoria_cnh"
                                          v-model="form.categoria_cnh" type="text"/>
                            <b-form-invalid-feedback :state="!erros.categoria_cnh ? null : !erros.categoria_cnh">
                                {{ erros.categoria_cnh }}
                            </b-form-invalid-feedback>
                        </b-form-group>
                    </div>
                </div>
                <div class="col-md-4">
                    <div v-if="form.filhos">
                        <b-form-group label="Quantidade de Filhos" label-for="filhos_quantidade"
                                      label-class="text-muted">
                            <b-form-input :state="!erros.filhos_quantidade ? null : !erros.filhos_quantidade"
                                          id="filhos_quantidade" v-model="form.filhos_quantidade" type="text"/>
                            <b-form-invalid-feedback
                                :state="!erros.filhos_quantidade ? null : !erros.filhos_quantidade">
                                {{ erros.filhos_quantidade }}
                            </b-form-invalid-feedback>
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
                        <b-form-input required :state="!erros.endereco ? null : !erros.endereco" id="endereco"
                                      v-model="form.endereco" type="text"/>
                        <b-form-invalid-feedback :state="!erros.endereco ? null : !erros.endereco">
                            {{ erros.endereco }}
                        </b-form-invalid-feedback>
                    </b-form-group>
                </div>

                <div class="col-md-1">
                    <b-form-group label="Nº" label-for="endereco_numero" label-class="text-muted">
                        <b-form-input :state="!erros.endereco_numero ? null : !erros.endereco_numero"
                                      id="endereco_numero" v-model="form.endereco_numero" type="text"/>
                        <b-form-invalid-feedback :state="!erros.endereco_numero ? null : !erros.endereco_numero">
                            {{ erros.endereco_numero }}
                        </b-form-invalid-feedback>
                    </b-form-group>
                </div>

                <div class="col-md-3">
                    <b-form-group label="Ponto de Referência" label-for="ponto_referrencia" label-class="text-muted">
                        <b-form-input :state="!erros.ponto_referrencia ? null : !erros.ponto_referrencia"
                                      id="ponto_referrencia" v-model="form.ponto_referrencia" type="text"/>
                        <b-form-invalid-feedback :state="!erros.ponto_referrencia ? null : !erros.ponto_referrencia">
                            {{ erros.ponto_referrencia }}
                        </b-form-invalid-feedback>
                    </b-form-group>
                </div>

                <div class="col-md-3">
                    <b-form-group label="Complemento" label-for="complemento" label-class="text-muted">
                        <b-form-input :state="!erros.complemento ? null : !erros.complemento" id="complemento"
                                      v-model="form.complemento" type="text"/>
                        <b-form-invalid-feedback :state="!erros.complemento ? null : !erros.complemento">
                            {{ erros.complemento }}
                        </b-form-invalid-feedback>
                    </b-form-group>
                </div>
            </div>

            <h6 class="card-title text-primary mt-3">Outras Informações</h6>

            <b-form-group label="Outras Informações" label-for="outras_informacoes" label-class="text-muted">
                <b-form-textarea :state="!erros.outras_informacoes ? null : !erros.outras_informacoes"
                                 id="outras_informacoes" v-model="form.outras_informacoes" rows="4"></b-form-textarea>
                <b-form-invalid-feedback :state="!erros.outras_informacoes ? null : !erros.outras_informacoes">
                    {{ erros.outras_informacoes }}
                </b-form-invalid-feedback>
            </b-form-group>

            <div class="row">
                <div class="col-md-12 py-4">
                    <b-form-checkbox
                        id="lei_lgpd"
                        v-model="form.lei_lgpd"
                        name="lei_lgpd"
                        :value="true"
                        :unchecked-value="false"
                    >
                        <strong>Autorizo a Alagoas Desenvolvimento Empresarial e Social LTDA e a Associação Comercial de
                            Santana do Ipanema a utilizar este currículo para fins de apreciação dos dados e possíveis
                            seleção, entre as empresas associadas e parceiras.</strong>
                    </b-form-checkbox>
                </div>
            </div>

            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <button class="btn btn-primary" :disabled="!form.lei_lgpd" type="submit"><i class="mdi mdi-send"></i>
                    Salvar
                </button>
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
    name: "PessoaWebForm",
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
        erros: {},
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
            lei_lgpd: false,
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
            }).catch(() => {
                this.$toast.open({
                    message: 'Erro ao tentar carregar estados.',
                    type: 'error',
                });
            }).finally(() => {
                document.body.classList.add('loaded');
            })
        },
        getHabilidades() {
            document.body.classList.remove('loaded');
            axios.get('/api/habilidade').then(({data}) => {
                this.habilidades = data;
            }).catch(() => {
                this.$toast.open({
                    message: 'Erro ao tentar carregar habilidades.',
                    type: 'error',
                });
            }).finally(() => {
                document.body.classList.add('loaded');
            })
        },
        getSexo() {
            document.body.classList.remove('loaded');
            axios.get('/api/sexo').then(({data}) => {
                this.sexos = data;
            }).catch(() => {
                this.$toast.open({
                    message: 'Erro ao tentar carregar sexos.',
                    type: 'error',
                });
            }).finally(() => {
                document.body.classList.add('loaded');
            })
        },
        getEscolaridades() {
            document.body.classList.remove('loaded');
            axios.get('/api/escolaridade').then(({data}) => {
                this.escolaidades = data;
            }).catch(() => {
                this.$toast.open({
                    message: 'Erro ao tentar carregar escolaridades.',
                    type: 'error',
                });
            }).finally(() => {
                document.body.classList.add('loaded');
            });
        },
        getEstadoCivil() {
            document.body.classList.remove('loaded');
            axios.get('/api/estado_civil').then(({data}) => {
                this.estados_civis = data;
            }).catch(() => {
                this.$toast.open({
                    message: 'Erro ao tentar carregar estados civis.',
                    type: 'error',
                });
            }).finally(() => {
                document.body.classList.add('loaded');
            });
        },
        async getCidades() {
            if (this.form.estado_id) {
                document.body.classList.remove('loaded');
                await axios.post('/api/cidade', {estado_id: this.form.estado_id}).then(({data}) => {
                    this.form.cidade_id = null;
                    this.cidades = data;
                }).catch(() => {
                    this.$toast.open({
                        message: 'Erro ao tentar carregar cidades.',
                        type: 'error',
                    });
                }).finally(() => {
                    document.body.classList.add('loaded');
                });
            } else {
                this.cidades = [];
            }
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
            if (this.form.lei_lgpd) {
                if (this.canvas) {
                    this.canvas.toBlob((blob) => {
                        let form = this.prepareForm(blob);
                        document.body.classList.remove('loaded');
                        axios.post('/api/curriculo', form).then(({data}) => {
                            this.$swal("Sucesso", data.message, "success").then(() => {
                                window.location.reload(true);
                            });
                        }).catch(({response}) => {
                            if (response.status === 422) {
                                this.erros = ERROR_422(response);
                                this.$swal("Erro", 'Algum campo não está válido', "warning");
                            } else {
                                this.$swal("Erro", 'Algo de errado aconteceu.', "error");
                            }
                        }).finally(() => {
                            document.body.classList.add('loaded');
                        });
                    }, 'image/jpeg');
                } else {
                    document.body.classList.remove('loaded');
                    axios.post('/api/curriculo', this.form).then(({data}) => {
                        this.$swal("Sucesso", data.message, "success").then(() => {
                            window.location.reload(true);
                        });
                    }).catch(({response}) => {
                        if (response.status === 422) {
                            this.erros = ERROR_422(response);
                            this.$swal("Erro", 'Algum campo não está válido', "warning");
                        } else {
                            this.$swal("Erro", 'Algo de errado aconteceu.', "error");
                        }
                    }).finally(() => {
                        document.body.classList.add('loaded');
                    });
                }
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
    background-color: rgba(19, 88, 160, 0.68);
    overflow: hidden;
    height: 30%;
    transition: .5s ease;
    width: 100%;
    padding: 5px 10px 0;
    color: #FFF;
    font-size: 1.1rem;
    font-weight: 600;
    text-align: center;
}

.image_area {
    position: relative;
}

.image_area:hover .overlay {
    height: 30%;
    cursor: pointer;
}
</style>
