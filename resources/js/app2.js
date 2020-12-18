require('./bootstrap');

//vue js-----------------------------
window.Vue = require('vue');

//vue router-------------------------
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import routes from './routes/routes2.js';
const router = new VueRouter({
    routes,
    // mode:'history'
})


//v-form------------------------
import { Form, HasError, AlertError } from 'vform'
window.Form =Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);


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


//components
import Header from './components/frontend/Header';


//google auth
// import VueAxios from 'vue-axios'
// Vue.use(VueAxios, axios)
// import VueSocialauth from 'vue-social-auth'
// Vue.use(VueSocialauth, {
//   providers: {
//     google: {
//       clientId: '956092664575-ti108spr2ra09io8d81ceinu3q4n1ri4.apps.googleusercontent.com',
//       redirectUri: 'http://127.0.0.1:8000/auth/google/callback' // Your client app URL
//     }
//   }
// })

//vue spinner
import loader from 'vue-loading-spinner/src/components/Circle9';

// vue js
const app = new Vue({
    el: '#homeContent',
    router,
    store,
    components:{
        'myheader' :Header,
        loader,
        
    },
    data: function(){
        return{
            isLoading: true
        }
    },
    mounted () {
        // setTimeout(() => {
        //     this.isLoading = false
        // }, 4000);
    },
    watch:{
      $route(){
        const this_= this;
        this.isLoading=true;
        // setTimeout(() => {
        //     this.isLoading = false
        // }, 3000);
      }
    },
    
});
