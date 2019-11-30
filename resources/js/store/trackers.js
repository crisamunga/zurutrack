export default {
  namespaced: true,
  state: {
    trackers: [
      {
        id: 1,
        name: "KCF 458R",
        serial: "4578963214587",
        model: "Noran 008",
        reseller: "Chris Martin Amunga",
        client: "Chris Martin Amunga",
        added_on: "11 Nov 2019",
        expires_on: "10 Oct 2019",
        state: "Disabled",
        last_known_location: { lat: -0.2, lng: 36 }
      },
      {
        id: 2,
        name: "KBM 574J",
        serial: "7845129631594",
        model: "Coban 102",
        reseller: "Chris Martin Amunga",
        client: "Chris Martin Amunga",
        added_on: "11 Nov 2019",
        expires_on: "11 Nov 2020",
        state: "Active",
        fleet: "Kenya Mpya Sacco",
        last_known_location: { lat: -1.1, lng: 37 }
      }
    ],
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
    }
  },
  actions: {
    showTracker(context, tracker_id) {
      context.commit("setDrawerFilter", tracker_id);
    },
    clearTracker(context) {
      context.commit("removeDrawerFilter");
    }
  }
};
