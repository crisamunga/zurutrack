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
      let url = "/webapi/tracker-models";
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
