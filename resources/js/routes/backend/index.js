import Vue from "vue";
import Router from "vue-router";
import PageAll from "../../views/Admin/PageAll.vue";
import { Login } from "./login.js";
import { Dashboard } from "./dashboard.js";
import { Users } from "./user.js";
import { Request } from "./request.js";
import { Transfers } from "./transfers.js";
import { PanelRental } from "./panelrental.js";
import { MeterWater } from "./watermeter.js";
import { MeterElectricity } from "./electricitymeter.js";
import { Bill } from "./bill.js";
import { Recommended } from "./recommended.js";


Vue.use(Router);

export default new Router({
    mode: 'history',
    base: process.env.CONFIG_PATH + '/admin',
    routes: [
        ...Login,
        {
            path: '/',
            name: "pageAll",
            component: PageAll,
            children: [
                ...Bill,
                ...Dashboard,
                ...Users,
                ...Request,
                ...Transfers,
                ...PanelRental,
                ...MeterWater,
                ...MeterElectricity,
                ...Recommended,
            ],
        },
    ],
});
