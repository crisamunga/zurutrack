<template>
  <v-navigation-drawer v-model="drawer" width="380" app class="light-bg">
    <template v-slot:prepend>
      <v-toolbar flat class="bg-secondary" dark>
        <v-btn icon @click="hideDrawer">
          <v-icon>mdi-arrow-left</v-icon>
        </v-btn>

        <v-toolbar-title>Trackers</v-toolbar-title>

        <v-spacer></v-spacer>

        <trackers-list>
          <template v-slot:activator="{ on }">
            <v-btn icon v-on="on"><v-icon>mdi-view-dashboard</v-icon></v-btn>
          </template>
        </trackers-list>

        <sidebar-trackers-create>
          <template v-slot:activator="{ on }">
            <v-btn icon v-on="on"><v-icon>mdi-plus</v-icon></v-btn>
          </template>
        </sidebar-trackers-create>

        
        <!-- <v-tabs fixed-tabs v-model="tab" background-color="transparent">
          <v-tabs-slider></v-tabs-slider>

          <v-tab v-for="item in tabs" :key="item">
            {{ item }}
          </v-tab>
        </v-tabs> -->

        <!-- <v-btn small icon @click="hideDrawer">
          <v-icon>mdi-close</v-icon>
        </v-btn> -->
      </v-toolbar>
    </template>

    <!-- <v-tabs-items v-model="tab" class="transparent">
      <v-tab-item>
        <sidebar-trackers-list></sidebar-trackers-list>
      </v-tab-item>
      <v-tab-item>
        <sidebar-fleets-list></sidebar-fleets-list>
      </v-tab-item>
    </v-tabs-items> -->

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