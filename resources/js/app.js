import './bootstrap';
import VueRouter from "vue-router";

// app component
import AppComponent from "./components/AppComponent";

// docs component
import DocsComponent from "./components/docs/DocsComponent";
import RacketDocumentationComponent from "./components/docs/RacketDocumentationComponent";
import BrandDocumentationComponent from "./components/docs/BrandDocumentationComponent";

// main component
import MainComponent from "./components/main/MainComponent";
import RacketComponent from "./components/main/racket/RacketComponent";
import RacketAddComponent from "./components/main/racket/RacketAddComponent";
import RacketDetailComponent from "./components/main/racket/RacketDetailComponent";
import BrandComponent from "./components/main/brand/BrandComponent";
import BrandAddComponent from "./components/main/brand/BrandAddComponent";
import BrandDetailComponent from "./components/main/brand/BrandDetailComponent";

window.Vue = require('vue');
Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        component: MainComponent,
        children: [
            {
                path: "/",
                component: RacketComponent
            },
            {
                path: "/add",
                component: RacketAddComponent
            },
            {
                path: "/detail/:id",
                component: RacketDetailComponent
            },
            {
                path: "/brand",
                component: BrandComponent
            },
            {
                path: "/brand/add",
                component: BrandAddComponent
            },
            {
                path: "/brand/detail/:id",
                component: BrandDetailComponent
            }
        ]
    },
    {
        path: "/docs",
        component: DocsComponent,
        children:[
            {
                path: "/docs",
                component: RacketDocumentationComponent
            },
            {
                path: "/docs/brand",
                component: BrandDocumentationComponent
            }
        ]
    }
];

const router = new VueRouter({
    mode: "history",
    routes: routes,
    base: "/"
})

new Vue(Vue.util.extend({ router }, AppComponent)).$mount("#app");
