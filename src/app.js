window.Vue = require('vue');
Vue.config.productionTip = false;
import VueRouter from 'vue-router'
Vue.use(VueRouter);
import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios, axios);
import BlogCompontent from './components/Blog.vue';
import HomeComponent from './components/Home.vue';
import Checkout from './components/Checkout.vue';
import BlogSingle from './components/BlogSingle.vue';
import Account from './components/myaccount.vue';
Vue.component('sitestudio', require('./components/render-router.vue').default);
const routes = [
    {
        name: "Home",
        path: "/",
        component: HomeComponent,
        meta: {
            title: 'საიტების დამზადება სეო ოპტიმიზაცია - Sitestudio'
        }
    },
    {
        name: "Blog",
        path: "/blog",
        component: BlogCompontent,
        meta: {
            title: 'ბლოგი - Sitestudio'
        }
    },
    {
        name: "Account",
        path: "/my-account",
        component: Account,
        meta: {
            title: 'ბლოგი11 - Sitestudio'
        }
    },
    {
        name: "BlogSingle",
        path: "/:slug",
        component: BlogSingle,
        meta: {
            title: 'ბლოგი - Sitestudio'
        }
    },
    {
        name: "Checkout",
        path: "/checkout",
        component: Checkout,
        meta: {
            title: 'ბლოგი - Sitestudio'
        }
    }
];

const router = new VueRouter({ mode: 'history', routes: routes});

const app = new Vue({
    el: '#app',
    router
});