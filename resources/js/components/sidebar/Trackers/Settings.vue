<template>
  <div>
    <v-toolbar dark color="transparent">
      <buttons-hover-icon top icon="mdi-arrow-left" label="Back" @click="back" />
      <v-spacer></v-spacer>
      <v-toolbar-title>Settings</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn text small>
        <v-icon left>mdi-refresh</v-icon>Reset
      </v-btn>
    </v-toolbar>

    <v-list class="transparent">
      <v-list-item>
        <v-list-item-action>
          <v-switch v-model="notifications" />
        </v-list-item-action>
        <v-list-item-title>Enable notifications</v-list-item-title>
      </v-list-item>

      <v-list-item>
        <v-list-item-action>
          <v-switch v-model="reports" />
        </v-list-item-action>
        <v-list-item-title>Weekly reports</v-list-item-title>
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
  data() {
    return {
      notifications: false,
      reports: true
    };
  },
  methods: {
    back() {
      this.$emit("back");
    }
  }
};
</script>