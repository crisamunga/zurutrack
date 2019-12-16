import axios from "axios";

export default {
  namespaced: true,
  state: {
    trackers: [],
    drawerFilter: null
  },
  getters: {
    locatedTrackers(state) {
      return state.trackers.filter(tracker => tracker.last_known_location);
    },
    sidebarTerminal(state) {
      if (!state.drawerFilter) {
        return null;
      }
      return state.trackers.filter(tracker => tracker.id == state.drawerFilter);
    }
  },
  mutations: {
    setDrawerFilter(state, tracker_id) {
      state.drawerFilter = tracker_id;
    },
    removeDrawerFilter(state) {
      state.drawerFilter = null;
    },
    addTracker(state, tracker) {
      state.trackers.push(tracker);
    },
    setTrackers(state, trackers) {
      state.trackers = trackers;
    },
    removeTracker(state, tracker_id) {
      state.trackers = state.trackers.filter(value => value.id != tracker_id);
    },
    updateTracker(state, tracker_id, newData) {
      state.trackers = state.trackers.map(value => {
        if (value.id == tracker_id) {
          return newData;
        } else {
          return value;
        }
      });
    }
  },
  actions: {
    showTracker(context, tracker_id) {
      context.commit("setDrawerFilter", tracker_id);
    },
    clearTracker(context) {
      context.commit("removeDrawerFilter");
    },
    index(context) {
      let url = `${process.env.MIX_APP_URL}/api/trackers`;
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${context.rootGetters["auth/token"]}`;

      return new Promise((resolve, reject) => {
        axios
          .get(url)
          .then(response => {
            context.commit("setTrackers", response.data.data);
            resolve(response);
          })
          .catch(error => {
            reject(error);
          });
      });
    },
    store(context, tracker) {
      let url = `${process.env.MIX_APP_URL}/api/trackers`;
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${context.rootGetters["auth/token"]}`;

      return new Promise((resolve, reject) => {
        axios
          .post(url, tracker)
          .then(response => {
            context.commit("addTracker", response.data.data);
            resolve(response);
          })
          .catch(error => {
            reject(error);
          });
      });
    },
    update(context, tracker_id, tracker) {
      let url = `${process.env.MIX_APP_URL}/api/trackers/${tracker_id}`;
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${context.rootGetters["auth/token"]}`;

      return new Promise((resolve, reject) => {
        axios
          .put(url, tracker)
          .then(response => {
            context.commit("updateTracker", response.data.data);
            resolve(response);
          })
          .catch(error => {
            reject(error);
          });
      });
    },
    delete(context, tracker_id) {
      let url = `${process.env.MIX_APP_URL}/api/trackers/${tracker_id}`;
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${context.rootGetters["auth/token"]}`;

      return new Promise((resolve, reject) => {
        axios
          .delete(url)
          .then(response => {
            context.commit("removeTracker", response.data.data);
            resolve(response);
          })
          .catch(error => {
            reject(error);
          });
      });
    }
  }
};
