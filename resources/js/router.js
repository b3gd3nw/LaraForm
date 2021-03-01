import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import Second_step from "./components/Second_step";
import First_step from "./components/First_step";

const routes = [
    {
        path: "/",
        component: First_step
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
