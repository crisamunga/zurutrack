<template>
  <v-app-bar app dark class="bg-secondary-reverse">
    <v-app-bar-nav-icon v-if="!drawer" @click="toggleDrawer"></v-app-bar-nav-icon>

    <v-toolbar-title style="width: 300px" class="ml-0 pl-4">
      <span class="hidden-sm-and-down text-uppercase font-weight-light nunito">Zuru Track</span>
    </v-toolbar-title>
    <v-tabs icons-and-text background-color="transparent" v-if="$vuetify.breakpoint.mdAndUp">
      <v-tab to="/" class="overline">
        Home
        <v-icon>mdi-home</v-icon>
      </v-tab>
      <v-tab to="/dashboard" class="overline">
        Dashboard
        <v-icon>mdi-view-dashboard</v-icon>
      </v-tab>
      <v-tab to="/profile" class="overline">
        Profile
        <v-icon>mdi-account</v-icon>
      </v-tab>
      <v-tab to="/billing" class="overline">
        Billing
        <v-icon>mdi-wallet</v-icon>
      </v-tab>
    </v-tabs>
    <v-spacer></v-spacer>
    <appbar-apps-menu v-if="$vuetify.breakpoint.smAndDown"></appbar-apps-menu>
    <appbar-notification-menu></appbar-notification-menu>
    <appbar-account-menu></appbar-account-menu>
  </v-app-bar>
</template>

<script>
export default {
  data() {
    return {
      items: [
        { title: "Billing", icon: "mdi-wallet" },
        { title: "Profile", icon: "mdi-account" },
        { title: "Settings", icon: "mdi-settings" },
        { title: "Logout", icon: "mdi-power" }
      ]
    };
  },
  computed: {
    drawer() {
      return this.$store.state.app.drawer;
    }
  },
  methods: {
    toggleDrawer() {
      this.$store.dispatch("app/toggleDrawer");
    }
  }
};
</script>
