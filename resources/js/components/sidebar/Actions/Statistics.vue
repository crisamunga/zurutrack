<template>
  <div>
    <v-toolbar dark color="transparent">
      <buttons-hover-icon top icon="mdi-arrow-left" label="Back" @click="back" />
      <v-spacer></v-spacer>
      <v-toolbar-title>Statistics</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn text small>
        <v-icon left>mdi-dots-horizontal</v-icon>More
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
  methods: {
    back() {
      this.$emit("back");
    }
  }
};
</script>