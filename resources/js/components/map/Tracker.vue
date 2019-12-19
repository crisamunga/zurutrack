<script>
import MarkerWithLabel from "@google/markerwithlabel/src/markerwithlabel";
export default {
  props: {
    map: {
      type: Object,
      required: true
    },
    tracker: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      marker: null
    };
  },
  computed: {
    location() {
      return this.tracker.last_known_location;
    }
  },
  methods: {
    getMarkerIcon() {
      return this.tracker.state.toLowerCase() == "active"
        ? "/img/circle-marker-purple.png"
        : "/img/circle-marker-red.png";
    }
  },
  watch: {
    location(val) {
      console.log(val);
      if (val && val.lat && val.lng) {
        if (this.marker) {
          this.marker.setPosition(new google.maps.LatLng(val.lat, val.lng));
        } else {
          this.marker = new MarkerWithLabel({
            position: {
              lat: this.location.lat,
              lng: this.location.lng
            },
            labelContent: this.tracker.name,
            labelAnchor: new google.maps.Point(22, 0),
            labelClass: "labels",
            labelInBackground: true,
            title: this.tracker.name,
            icon: {
              labelOrigin: new google.maps.Point(16, 40),
              url: this.getMarkerIcon()
            },
            map: this.map
          });
        }
      }
    }
  },
  mounted() {
    if (this.location && this.location.lat && this.location.lng) {
      this.marker = new MarkerWithLabel({
        position: {
          lat: this.location.lat,
          lng: this.location.lng
        },
        labelContent: this.tracker.name,
        labelAnchor: new google.maps.Point(22, 0),
        labelClass: "labels",
        labelInBackground: true,
        title: this.tracker.name,
        icon: {
          labelOrigin: new google.maps.Point(16, 40),
          url: this.getMarkerIcon()
        },
        map: this.map
      });
    }

    Echo.private("Tracker.Location." + this.tracker.id).listen(
      ".App\\Events\\TrackerLocationUpdated",
      e => {
        this.marker.setPosition(e.location_data);
      }
    );
  },
  beforeDestroy() {
    if (this.marker) {
      this.marker.setMap(null);
    }
  },
  render: function(h) {
    return h(); // avoid warning message
  }
};
</script>
