import axios from "axios";

export default {
  namespaced: true,
  state: {
    fleets: []
  },
  getters: {
    all(state) {
      return state.fleets;
    }
  },
  mutations: {
    all(state, fleets) {
      state.fleets = fleets;
    },
    store(state, fleet) {
      state.fleets.push(fleet);
    },
    update(state, fleet_id, fleet) {
      state.fleets = state.fleets.map(value => {
        if (value.id == fleet_id) {
          return fleet;
        } else {
          return value;
        }
      });
    },
    delete(state, fleet_id) {
      state.fleets = state.fleets.filter(value => {
        return value.id != fleet_id;
      });
    }
  },
  actions: {
    index(context) {
      let url = `${process.env.MIX_APP_URL}/webapi/fleets`;
      return new Promise((resolve, reject) => {
        axios
          .get(url)
          .then(response => {
            context.commit("all", response.data.data);
            resolve(response);
          })
          .catch(error => {
            reject(error);
          });
      });
    },
    store(context, fleet) {
      let url = `${process.env.MIX_APP_URL}/webapi/fleets`;
      return new Promise((resolve, reject) => {
        axios
          .post(url, fleet)
          .then(response => {
            context.commit("store", response.data.data);
            resolve(response);
          })
          .catch(error => {
            reject(error);
          });
      });
    },
    update(context, fleet) {
      const fleet_id = fleet.id;
      let url = `${process.env.MIX_APP_URL}/webapi/fleets/${fleet_id}`;
      return new Promise((resolve, reject) => {
        axios
          .put(url, fleet)
          .then(response => {
            context.commit("update", fleet_id, response.data.data);
            resolve(response);
          })
          .catch(error => {
            reject(error);
          });
      });
    },
    delete(context, fleet_id) {
      let url = `${process.env.MIX_APP_URL}/webapi/fleets/${fleet_id}`;
      return new Promise((resolve, reject) => {
        axios
          .delete(url)
          .then(response => {
            context.commit("delete", fleet_id);
            resolve(response);
          })
          .catch(error => {
            reject(error);
          });
      });
    }
  }
};
