<template>
  <div>
    <v-toolbar dark color="transparent">
      <buttons-hover-icon icon="mdi-arrow-left" label="Back" @click="back" />
      <v-spacer></v-spacer>
      <v-toolbar-title>Route history</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn text small @click="dates = []">
        <v-icon left>mdi-close</v-icon>Clear
      </v-btn>
    </v-toolbar>

    <v-container>
      <v-date-picker v-model="dates" show-current range full-width class="time-picker-style" />
    </v-container>
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
      dates: []
    };
  },
  methods: {
    back() {
      this.$emit("back");
    }
  }
};
</script>

<style scoped>
    .time-picker-style, .time-picker-style >>> .theme--dark.v-picker__body {
        background: transparent;
    }
</style>