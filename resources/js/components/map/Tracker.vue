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
    methods: {
        getMarkerIcon() {
            return this.tracker.state.toLowerCase() == "active"
                ? "/img/circle-marker-purple.png"
                : "/img/circle-marker-red.png";
        }
    },
    mounted() {
        this.marker = new MarkerWithLabel({
            position: {
                lat: this.tracker.last_known_location.lat,
                lng: this.tracker.last_known_location.lng
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
        // !This is such a hack. Find a better place to put this or maybe set it once
        Echo.connector.options.auth.headers["Authorization"] =
            "Bearer " + this.$store.state.auth.user.access_token;
        Echo.private("Tracker.Location." + this.tracker.id).listen(
            ".App\\Events\\TrackerLocationUpdated",
            e => {
              this.marker.setPosition(e.location_data);
            }
        );
    },
    render: function(h) {
        return h(); // avoid warning message
    }
};
</script>
