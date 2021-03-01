import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import Second_step from "./components/Second_step";
import First_step from "./components/First_step";
import Reg_form from "./components/Reg_form";

const routes = [
    {
        path: "/",
        component: Reg_form
    },
    {
        path: "/second",
        component: Second_step
    }
]

export default new vueRouter( {
    mode: "history",
    routes
});
