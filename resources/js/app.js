/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.axios = require("axios");
window.Vue = require("vue");

import Echo from "laravel-echo";
window.io = require("socket.io-client");
window.Echo = new Echo({
    broadcaster: "socket.io",
    namespace: "zurutrack_database",
    key: "zurutrack_database",
    host: process.env.MIX_APP_URL
});

import Vuetify from "vuetify";
import App from "./App.vue";
import router from "./router";
import store from "./store";

import "./components";

Vue.use(Vuetify);

let vuetify = new Vuetify({
    icons: {
        iconfont: "mdi"
    },
    theme: {
        dark: false,
        themes: {
            dark: {
                primary: "#7B1FA2",
                accent: "#D81B60",
                secondary: "#D1C4E9",
                success: "#4CAF50",
                info: "#2196F3",
                warning: "#FB8C00",
                error: "#FF5252"
            },
            light: {
                primary: "#6319D2",
                accent: "#C2185B",
                secondary: "#051D38",
                success: "#388E3C",
                info: "#2196F3",
                warning: "#FB8C00",
                error: "#FF5252"
            }
        }
    }
});

Vue.config.productionTip = false;

// new Vue({
//     vuetify,
//     router,
//     store,
//     render: h => h(App)
// }).$mount("#app");

const app = new Vue({
    vuetify,
    store,
    el: '#app',
});
