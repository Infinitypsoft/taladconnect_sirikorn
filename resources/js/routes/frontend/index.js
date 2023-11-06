import Vue from "vue";
import Router from "vue-router";
import PageAll from "../../views/User/PageAll.vue";


Vue.use(Router);

export default new Router({
    mode: 'history',
    base: process.env.CONFIG_PATH,
    routes: [
        {
            path: "/",
            name: "pageAll",
            component: PageAll,
            children: [
            ],
        },
    ],
});
