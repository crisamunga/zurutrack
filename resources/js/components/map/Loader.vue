<template>
  <div class="google-map-container">
    <div class="google-map" ref="googleMap"></div>
    <template v-if="Boolean(this.map)">
      <slot
        :map="map"
      />
    </template>
  </div>
</template>

<script>
export default {
  props: {
    mapConfig: Object
  },
  data() {
    return {
      map: null
    };
  },
  async mounted() {
    this.initializeMap();
  },
  methods: {
    initializeMap() {
      const mapContainer = this.$refs.googleMap;
      this.map = new google.maps.Map(mapContainer, this.mapConfig);
    }
  }
};
</script>

<style lang="css" scoped>
.google-map-container {
  width: 100%;
  height: 100%;
}
.google-map {
  width: 100%;
  height: 100%;
}
</style>
