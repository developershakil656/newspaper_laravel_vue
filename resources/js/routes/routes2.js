import Home from '../components/frontend/Home.vue';
import About from '../components/frontend/About.vue';
import Category from '../components/frontend/category.vue';
import Post from '../components/frontend/Post.vue';
import Search from '../components/frontend/Search.vue';
import NotFound from '../components/NotFound.vue';



let routes = [
    { path: '/', component: Home },
    { path: '/search/:slug', component: Search },
    { path: '/about', component: About },
    { path: '/category/:slug', component: Category },
    { path: '/post/:slug', component: Post },
    { path: '/login/google',
    beforeEnter(to, from, next) {
        // Put the full page url including the protocol http(s) below
        window.location = "http://127.0.0.1:8000/sociallogin/google"
    }},
    { path: '/*', component: NotFound },

];


export default routes;