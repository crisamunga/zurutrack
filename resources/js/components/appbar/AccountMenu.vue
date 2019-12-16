<template>
  <v-menu transition="slide-y-transition" bottom :offset-y="true">
    <template v-slot:activator="{ on }">
      <v-btn class="title mr-2 ml-4" fab dark small color="purple" v-on="on">C</v-btn>
    </template>
    <v-card>
      <v-toolbar flat class="bg-primary" dark>
        <v-list-item two-line>
          <v-list-item-avatar>
            <img src="https://randomuser.me/api/portraits/women/81.jpg" />
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title>Jane Smith</v-list-item-title>
            <v-list-item-subtitle>Logged In</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
      </v-toolbar>

      <v-divider></v-divider>

      <v-list>
        <v-list-item v-for="item in items" :key="item.title">
          <v-list-item-icon>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item @click="logout">
          <v-list-item-icon>
            <v-icon class="red--text">mdi-power</v-icon>
          </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title class="red--text">Logout</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-card>
  </v-menu>
</template>

<script>
export default {
  data() {
    return {
      items: [
        { title: "Notifications", icon: "mdi-information" },
        { title: "Profile", icon: "mdi-account" },
        { title: "Settings", icon: "mdi-settings" },
        { title: "Switch to reseller account", icon: "mdi-account-switch" }
      ]
    };
  },
  methods: {
    logout() {
      this.$store
        .dispatch("auth/logout")
        .then(result => {
          window.location.href = "/login";
        })
        .catch(error => {
          window.location.href = "/login";
        });
    }
  }
};
</script>
