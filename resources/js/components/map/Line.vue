<script>
export default {
  props: {
    map: {
      type: Object,
      required: true
    },
    path: {
      type: Array,
      required: true
    }
  },

  mounted() {
    new google.maps.Polyline({
      path: this.path,
      map: this.map,
    })
  }
}
</script>