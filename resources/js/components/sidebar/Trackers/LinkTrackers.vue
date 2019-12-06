<template>
  <div>
    <v-toolbar dark color="transparent">
      <buttons-hover-icon icon="mdi-arrow-left" label="Back" @click="back" />
      <v-spacer></v-spacer>
      <v-toolbar-title>Linked trackers</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn text small>
        <v-icon left>mdi-information-outline</v-icon>About
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