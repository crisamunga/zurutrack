export default {
  namespaced: true,
  state: {
    drawer: null,
    search: true
  },
  mutations: {
    setDrawer(state, value) {
      state.drawer = value;
    },
    toggleDrawer(state) {
      state.drawer = !state.drawer;
    }
  },
  actions: {
    showDrawer(context) {
      context.commit("setDrawer", true);
    },
    hideDrawer(context) {
      context.commit("setDrawer", false);
    },
    setDrawer(context, visible) {
      context.commit("setDrawer", visible);
    },
    toggleDrawer(context) {
      context.commit("toggleDrawer");
    }
  }
};
