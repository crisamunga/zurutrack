<template>
  <layouts-map>
    <v-container fluid fill-height class="ma-0 pa-0">
      <map-tracker-map></map-tracker-map>
    </v-container>
  </layouts-map>
</template>

<script>
import { mapActions } from "vuex";

export default {
  methods: {
    ...mapActions({
      getTrackers: "trackers/index"
    })
  },
  mounted() {
    this.getTrackers();
  }
};
</script>
