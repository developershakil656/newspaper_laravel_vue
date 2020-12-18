require('./bootstrap');

//vue js-----------------------------
window.Vue = require('vue');


//vue router-------------------------
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import routes from './routes/routes.js';
const router = new VueRouter({
    routes,
    // mode:'history'
})


//v-form------------------------
import { Form, HasError, AlertError } from 'vform'
window.Form =Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);


//sweet alert2-------------------
import Swal from 'sweetalert2';
window.Swal = Swal;

//Toastr alert--------------------
import toastr from 'toastr';
window.toastr = toastr;

//Vuex--------------------------
import Vuex from 'vuex';
Vue.use(Vuex)
import storeData from './store/store';
const store = new Vuex.Store(storeData);

//vue filter---------------------------
import {filter} from './filter/filter';

//vue mixins
import {mixins} from './helpers/mixin';


//CKEditor 5
import CKEditor from '@ckeditor/ckeditor5-vue';
Vue.use( CKEditor );

//components
Vue.component('pagination', require('laravel-vue-pagination'));
//vue spinner
import loader from 'vue-loading-spinner/src/components/Circle9';

//vue data-tables
import DataTable from 'laravel-vue-datatable';
Vue.use(DataTable);

// vue js
const app = new Vue({
    el: '#content',
    data:function(){
        return{
            isLoading: true
        }
    },
    components:{
        loader
    },
    router,
    store,
    watch:{
        $route(){
          this.isLoading=true;
        }
      },
});
