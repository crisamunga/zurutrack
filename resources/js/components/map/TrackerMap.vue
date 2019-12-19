<template>
  <map-loader :mapConfig="mapConfig">
    <template slot-scope="{ map }">
      <map-tracker
        v-for="(tracker, index) in trackers"
        :key="index"
        :tracker="tracker"
        :map="map"
      />
    </template>
  </map-loader>
</template>

<script>
import { mapState, mapGetters } from "vuex";

export default {
  data() {
    return {
      mapConfig: {
        center: { lat: 0.097, lng: 37.644 },
        zoom: 9,
        styles: [
          {
            featureType: "landscape",
            elementType: "geometry.fill",
            stylers: [
              {
                color: "#f2f6ff"
              }
            ]
          },
          {
            featureType: "poi.attraction",
            stylers: [
              {
                visibility: "off"
              }
            ]
          },
          {
            featureType: "poi.business",
            stylers: [
              {
                visibility: "off"
              }
            ]
          },
          {
            featureType: "poi.government",
            stylers: [
              {
                visibility: "on"
              }
            ]
          },
          {
            featureType: "poi.medical",
            stylers: [
              {
                visibility: "on"
              }
            ]
          },
          {
            featureType: "poi.park",
            elementType: "labels.text",
            stylers: [
              {
                visibility: "off"
              }
            ]
          },
          {
            featureType: "road.arterial",
            elementType: "labels.icon",
            stylers: [
              {
                visibility: "off"
              }
            ]
          },
          {
            featureType: "road.highway",
            elementType: "labels.icon",
            stylers: [
              {
                visibility: "off"
              }
            ]
          },
          {
            featureType: "road.local",
            elementType: "labels.icon",
            stylers: [
              {
                visibility: "off"
              }
            ]
          }
        ]
      }
    };
  },
  computed: {
    ...mapGetters({
      trackers: "trackers/all"
    })
  }
};
</script>
