<template>
  <div>
    <v-toolbar dark color="transparent">
      <buttons-hover-icon icon="mdi-arrow-left" label="Back" @click="back" />
      <v-spacer></v-spacer>
      <v-toolbar-title>Notifications</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn text small @click="show = ! show">
        <v-icon left v-if="!show">mdi-map-marker</v-icon>
        <v-icon left v-if="show">mdi-map-marker-off</v-icon>
        <span v-if="show">Hide </span>
        <span v-if="!show">Show </span>
        <span>Markers</span>
      </v-btn>
    </v-toolbar>

    <v-list class="transparent">
        
    </v-list>
  </div>
</template>

<script>
export default {
  props: {
    tracker: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      show: false
    }
  },
  methods: {
    back() {
      this.$emit("back");
    }
  }
};
</script>