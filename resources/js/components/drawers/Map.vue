<template>
  <v-navigation-drawer v-model="drawer" width="380" app class="light-bg">
    <template v-slot:prepend>
      <v-toolbar flat class="bg-secondary" dark>
        <v-btn icon @click="hideDrawer">
          <v-icon>mdi-arrow-left</v-icon>
        </v-btn>

        <v-toolbar-title>Trackers</v-toolbar-title>

        <v-spacer></v-spacer>
        <sidebar-trackers-create>
          <template v-slot:activator="{ on }">
            <buttons-hover-icon bottom icon="mdi-plus" label="New tracker" v-on="on" />
          </template>
        </sidebar-trackers-create>
      </v-toolbar>
    </template>
    <sidebar-trackers-list></sidebar-trackers-list>
  </v-navigation-drawer>
</template>

<script>
export default {
  data() {
    return {
      tab: 0,
      tabs: ["trackers", "fleets"]
    };
  },
  computed: {
    drawer: {
      get() {
        return this.$store.state.app.drawer;
      },
      set(value) {
        this.$store.dispatch("app/setDrawer", value);
      }
    }
  },
  methods: {
    hideDrawer() {
      this.$store.dispatch("app/hideDrawer");
    }
  }
};
</script>

<style lang="css" scoped>
.light-bg {
  background-color: #f2f6ff;
}
</style>