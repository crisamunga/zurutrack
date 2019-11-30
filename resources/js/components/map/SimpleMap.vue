<template>
  <map-loader :mapConfig="mapConfig">
  </map-loader>
</template>

<script>
export default {
  data() {
    return {
      mapConfig: {
        center: { lat: 0.097, lng: 37.644 },
        zoom: 8
      }
    };
  }
};
</script>
