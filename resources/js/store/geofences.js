export default {
  namespaced: true,
  state: {
    geofences: [
      {
        id: 1,
        name: "Juja Area Geofence",
        center: { lat: -1.1, lng: 37 },
        radius: 1000
      },
      {
        id: 2,
        name: "CBD Area",
        center: { lat: -1.1, lng: 36 },
        radius: 1000
      }
    ]
  }
};
