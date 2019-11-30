<template>
  <v-list-item @click="logout">
    <v-list-item-icon>
      <v-icon>mdi-power</v-icon>
    </v-list-item-icon>

    <v-list-item-content>
      <v-list-item-title>Logout</v-list-item-title>
    </v-list-item-content>
  </v-list-item>
  <!-- <v-btn icon @click="logout">
    <v-icon>mdi-power</v-icon>
  </v-btn> -->
</template>

<script>
export default {
  methods: {
    logout() {
      this.$store.dispatch("auth/logout").then(result => {
        this.$router.push({ name: "login" });
      });
    }
  }
};
</script>
