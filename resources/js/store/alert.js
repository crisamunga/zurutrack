export default {
  namespaced: true,
  state: {
    message: null,
    type: null
  },
  getters: {
    show(state) {
      return state.message ? true : false;
    }
  },
  mutations: {
    setType(state, type) {
      state.type = type;
    },
    setMessage(state, message) {
      state.message = message;
    }
  },
  actions: {
    info(context, message) {
      context.commit("setType", "info");
      context.commit("setMessage", message);
    },
    error(context, message) {
      context.commit("setType", "error");
      context.commit("setMessage", message);
    },
    clear(context) {
      context.commit("setType", null);
      context.commit("setMessage", null);
    }
  }
};
