<script>
export default {
  props: {
    map: {
      type: Object,
      required: true
    },
    marker: {
      type: Object,
      required: true
    }
  },
  mounted() {
    new google.maps.Marker({
      position: this.marker.position,
      marker: this.marker,
      map: this.map,
      label: "KCA GGGJ",
      icon: {
        labelOrigin: new google.maps.Point(16,40),
        url: "/img/violet-marker.png"
      },
    });
  },
  render: function(h) {
    return h(); // avoid warning message
  }
};
</script>
