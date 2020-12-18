import home from '../components/admin/home.vue';
import slider from '../components/admin/Slider.vue';
import NotFound from '../components/NotFound.vue';

//users
import users from '../components/admin/user/Users.vue';

//categories
import categories from '../components/admin/category/category.vue';
import addcategory from '../components/admin/category/create.vue';
import editcategory from '../components/admin/category/edit.vue';

//posts
import posts from '../components/admin/post/post.vue';
import addpost from '../components/admin/post/create.vue';
import editpost from '../components/admin/post/edit.vue';


let routes = [
    { path: '/', component: home },
    { path: '/categories', component: categories },
    { path: '/add-category', component: addcategory },
    { path: '/edit-category/:slug', component: editcategory },
    { path: '/posts', component: posts },
    { path: '/add-post', component: addpost },
    { path: '/edit-post/:id', component: editpost },
    { path: '/sliders', component: slider },
    { path: '/users', component: users },
    { path: '/*', component: NotFound },

];


export default routes;