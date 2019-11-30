import Vue from "vue";
import Router from "vue-router";

import Login from "./views/Login.vue";
import Register from "./views/Register.vue";
import Dashboard from "./views/Dashboard.vue";
import Home from "./views/Home.vue";
import Error404 from "./views/Error404.vue";

import auth from "./middleware/auth";
import guest from "./middleware/guest";

Vue.use(Router);

const router = new Router({
  mode: "history",
  routes: [
    {
      path: "/login",
      name: "login",
      component: Login,
      beforeEnter: guest,
      meta: { layout: "layouts-auth" }
    },
    {
      path: "/register",
      name: "register",
      component: Register,
      beforeEnter: guest,
      meta: { layout: "layouts-auth" }
    },
    {
      path: "/",
      name: "home",
      component: Home,
      beforeEnter: auth,
      meta: { layout: "layouts-map" }
    },
    {
      path: "/dashboard",
      name: "dashboard",
      component: Dashboard,
      beforeEnter: auth,
      meta: { layout: "layouts-dashboard" }
    },
    {
      path: "*",
      name: "error404",
      component: Error404,
      meta: { layout: "layouts-auth" }
    }
  ]
});

export default router;
