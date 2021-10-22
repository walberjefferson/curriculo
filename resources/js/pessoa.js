import Vue from 'vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import VueSweetalert2 from 'vue-sweetalert2';
import VueToast from 'vue-toast-notification';

import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'sweetalert2/dist/sweetalert2.min.css';
import 'vue-toast-notification/dist/theme-sugar.css';


const options = {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#ff7674',
};

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueSweetalert2, options);
Vue.use(VueToast, {
    position: 'top-right'
});

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
