import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import Second_step from "./components/Second_step";
import First_step from "./components/First_step";
import Reg_form from "./components/Reg_form";
import Social from "./components/Social";
import All_members from "./components/All_members";

const routes = [
    {
        path: "/",
        component: Reg_form
    },
    {
        path: "/second",
        component: Second_step
    },
    {
        path: "/social",
        component: Social
    },
    {
        path: "/all_members",
        component: All_members
    },
    {
        path: "/homepage",
        component: Reg_form
    }

]

export default new vueRouter( {
    mode: "history",
    routes
});
