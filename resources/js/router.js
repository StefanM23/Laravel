import Vue from 'vue';
import VueRouter from 'vue-router';

//1. import route components
import Products from './components/pages/Products.vue';

//that is the way how to use a plaging in view(vue-router)
Vue.use(VueRouter);
//2+3. Create the router instance and add a define routes and each route should map to a component
//4. Register all routes that we need
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/index',
            name: 'products',
            component: Products
        },
    ]
});

export default router;