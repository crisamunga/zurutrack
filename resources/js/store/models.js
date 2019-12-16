import axios from "axios";

export default {
  namespaced: true,
  state: {
    models: []
  },
  mutations: {
    setModels(state, models) {
      state.models = models;
    }
  },
  getters: {
    allModels(state) {
      return state.models;
    }
  },
  actions: {
    fetchModels(context) {
      let url = `${process.env.MIX_APP_URL}/api/tracker-models`;
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${context.rootGetters["auth/token"]}`;

      return new Promise((resolve, reject) => {
        axios
          .get(url)
          .then(response => {
            context.commit("setModels", response.data.data);
            resolve(response);
          })
          .catch(error => {
            reject(error);
          });
      });
    }
  }
};
