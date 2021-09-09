import Vue from 'vue';
import VueRouter from 'vue-router';

//1. import route components
import Index from './components/pages/Index.vue';
import Cart from './components/pages/Cart.vue';
import Login from './components/pages/Login.vue';
import Products from './components/pages/Products.vue';
import axios from 'axios';
//that is the way how to use a plaging in view(vue-router)
Vue.use(VueRouter);
//2+3. Create the router instance and add a define routes and each route should map to a component
//4. Register all routes that we need
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/cms2/public/sp',
            name: 'index',
            component: Index
        },
        {
            path: '/cms2/public/sp-cart',
            name: 'cart',
            component: Cart
        },
        {
            path: '/cms2/public/sp-login',
            name: 'login',
            component: Login,
            beforeEnter: (to,form,next) => {
               axios.get('auth').then(()=>{
                 
               }) 
            }
        },
        {
            path: '/cms2/public/sp-products',
            name: 'products',
            component: Products
        },
    ]
});

export default router;