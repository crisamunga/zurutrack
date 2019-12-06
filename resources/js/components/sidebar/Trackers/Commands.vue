<template>
  <div>
    <v-toolbar dark color="transparent">
      <buttons-hover-icon icon="mdi-arrow-left" label="Back" @click="back" />
      <v-spacer></v-spacer>
      <v-toolbar-title>Commands</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn text small>
        <v-icon left>mdi-information-outline</v-icon>About
      </v-btn>
    </v-toolbar>

    <v-list class="transparent">
      <v-list-item>
        <v-list-item-content>
          <v-list-item-subtitle>Engine control</v-list-item-subtitle>
          <v-list-item-title>
            <v-btn text>
              <v-icon left>mdi-engine</v-icon>Start Engine
            </v-btn>
            <v-btn text>
              <v-icon left>mdi-engine-outline</v-icon>Stop Engine
            </v-btn>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item>
        <v-list-item-content>
          <v-list-item-subtitle>Tracking</v-list-item-subtitle>
          <v-list-item-title>
            <v-btn text>
              <v-icon left>mdi-map-marker</v-icon>Enable
            </v-btn>
            <v-btn text>
              <v-icon left>mdi-map-marker-outline</v-icon>Disable
            </v-btn>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
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