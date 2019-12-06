<template>
  <v-menu
    v-model="menu"
    :close-on-click="true"
    :close-on-content-click="false"
    :nudge-width="200"
    offset-x
  >
    <template v-slot:activator="{ on }">
      <slot :on="on" />
    </template>

    <v-card width="400" max-height="700" dark class="bg-secondary">
      <v-container fluid v-if="!show" class="bg-secondary">
        <v-row class="mt-2" dense>
          <v-col cols="6" sm="6" md="4" v-for="(item, index) in items" :key="index" class="text-center">
            <v-card flat @click="show = item.title" class="transparent py-5">
              <v-btn fab dark :color="item.color">
                <v-icon>{{ item.icon }}</v-icon>
              </v-btn>
              <div class="caption py-2">{{ item.title }}</div>
            </v-card>
          </v-col>
        </v-row>
      </v-container>

      <sidebar-trackers-details v-if="show == 'Details'" :tracker="tracker" @back="show = null" />
      <sidebar-trackers-commands v-if="show == 'Commands'" :tracker="tracker" @back="show = null" />
      <sidebar-trackers-geofences v-if="show == 'Geofences'" :tracker="tracker" @back="show = null" />
      <sidebar-trackers-waypoints v-if="show == 'Waypoints'" :tracker="tracker" @back="show = null" />
      <sidebar-trackers-notifications v-if="show == 'Notifications'" :tracker="tracker" @back="show = null" />
      <sidebar-trackers-settings v-if="show == 'Settings'" :tracker="tracker" @back="show = null" />
      <sidebar-trackers-users v-if="show == 'Users'" :tracker="tracker" @back="show = null" />
      <sidebar-trackers-statistics v-if="show == 'Statistics'" :tracker="tracker" @back="show = null" />
      <sidebar-trackers-link-trackers v-if="show == 'Link trackers'" :tracker="tracker" @back="show = null" />
    </v-card>
  </v-menu>
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
      show: null,
      menu: false,
      items: [
        { icon: "mdi-pen", title: "Details", color: "teal" },
        { icon: "mdi-send", title: "Commands", color: "orange darken-2" },
        { icon: "mdi-link-variant", title: "Link trackers", color: "deep-purple" },
        { icon: "mdi-chart-bar", title: "Statistics", color: "purple" },
        { icon: "mdi-map-marker-circle", title: "Geofences", color: "indigo" },
        { icon: "mdi-map-marker-radius", title: "Waypoints", color: "cyan" },
        { icon: "mdi-bell", title: "Notifications", color: "blue" },
        { icon: "mdi-account", title: "Users", color: "blue-grey" },
        { icon: "mdi-settings", title: "Settings", color: "lime darken-3" },
      ]
    };
  },
  watch: {
    menu: function(val) {
      if (!val) {
        this.show = null;
      }
    }
  },
};
</script>
