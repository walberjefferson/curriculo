import Vue from 'vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import VueSweetalert2 from 'vue-sweetalert2';

import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'sweetalert2/dist/sweetalert2.min.css';

const options = {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#ff7674',
};

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueSweetalert2, options);

// Components
import PessoaForm from "../components/PessoaForm";
import PessoaFormUpdate from "../components/PessoaFormUpdate";

new Vue({
    el: "#form_pessoa",
    components: {
        PessoaForm,
        PessoaFormUpdate
    }
});
