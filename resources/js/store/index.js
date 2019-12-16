import Vue from "vue";
import Vuex from "vuex";
// import axios from "axios";

import auth from "./auth";
import alert from "./alert";
import app from "./app";
import trackers from "./trackers";
import fleets from "./fleets";
import clients from "./clients";
import geofences from "./geofences";
import models from "./models";

Vue.use(Vuex);

const store = new Vuex.Store({
  state: {},
  mutations: {},
  actions: {},
  modules: {
    auth,
    alert,
    app,
    trackers,
    fleets,
    clients,
    geofences,
    models
  }
});

export default store;
