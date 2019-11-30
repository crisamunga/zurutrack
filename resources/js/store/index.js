import Vue from "vue";
import Vuex from "vuex";
// import axios from "axios";

import authModule from "./auth";
import alertModule from "./alert";
import appModule from "./app";
import trackersModule from "./trackers";
import fleetsModule from "./fleets";

Vue.use(Vuex);

const store = new Vuex.Store({
  state: {},
  mutations: {},
  actions: {},
  modules: {
    auth: authModule,
    alert: alertModule,
    app: appModule,
    trackers: trackersModule,
    fleets: fleetsModule
  }
});

export default store;
