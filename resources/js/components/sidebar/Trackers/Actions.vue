<template>
  <v-menu
    v-model="menu"
    :close-on-click="closeOnClick"
    :close-on-content-click="false"
    :nudge-width="200"
    offset-x
  >
    <template v-slot:activator="{ on }">
      <slot :on="on" />
    </template>

    <v-card :width="width" max-height="700" dark class="bg-secondary">
      <v-container fluid v-if="!show" class="bg-secondary">
        <v-row class="mt-2" dense>
          <v-col
            cols="6"
            sm="6"
            md="4"
            v-for="(item, index) in items"
            :key="index"
            class="text-center"
          >
            <v-card flat @click="setItem(item)" class="transparent py-5">
              <v-btn fab dark :color="item.color">
                <v-icon>{{ item.icon }}</v-icon>
              </v-btn>
              <div class="caption py-2">{{ item.title }}</div>
            </v-card>
          </v-col>
        </v-row>
      </v-container>

      <sidebar-trackers-details v-if="show == 'Details'" :tracker="tracker" @back="clearItem()" />
      <sidebar-trackers-commands v-if="show == 'Commands'" :tracker="tracker" @back="clearItem()" />
      <sidebar-trackers-geofences
        v-if="show == 'Geofences'"
        :tracker="tracker"
        @back="clearItem()"
      />
      <sidebar-trackers-waypoints
        v-if="show == 'Waypoints'"
        :tracker="tracker"
        @back="clearItem()"
      />
      <sidebar-trackers-notifications
        v-if="show == 'Notifications'"
        :tracker="tracker"
        @back="clearItem()"
      />
      <sidebar-trackers-settings v-if="show == 'Settings'" :tracker="tracker" @back="clearItem()" />
      <sidebar-trackers-users v-if="show == 'Users'" :tracker="tracker" @back="clearItem()" />
      <sidebar-trackers-statistics
        v-if="show == 'Statistics'"
        :tracker="tracker"
        @back="clearItem()"
      />
      <sidebar-trackers-link-trackers
        v-if="show == 'Link trackers'"
        :tracker="tracker"
        @back="clearItem()"
      />
      <sidebar-trackers-route-history
        v-if="show == 'Route history'"
        :tracker="tracker"
        @back="clearItem()"
      />
      <sidebar-trackers-fleets v-if="show == 'Fleets'" :tracker="tracker" @back="clearItem()" />
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
      width: 400,
      closeOnClick: true,
      items: [
        {
          icon: "mdi-pen",
          title: "Details",
          color: "teal",
          width: 500,
          closeOnClick: true
        },
        {
          icon: "mdi-send",
          title: "Commands",
          color: "orange darken-2",
          width: 500,
          closeOnClick: true
        },
        {
          icon: "mdi-map-marker-multiple",
          title: "Fleets",
          color: "lime darken-3",
          width: 500,
          closeOnClick: true
        },
        {
          icon: "mdi-account",
          title: "Users",
          color: "blue-grey",
          width: 500,
          closeOnClick: true
        },
        {
          icon: "mdi-link-variant",
          title: "Link trackers",
          color: "deep-purple",
          width: 500,
          closeOnClick: true
        },
        {
          icon: "mdi-chart-bar",
          title: "Statistics",
          color: "purple",
          width: 700,
          closeOnClick: true
        },
        {
          icon: "mdi-vector-line",
          title: "Route history",
          color: "brown",
          width: 500,
          closeOnClick: false
        },
        {
          icon: "mdi-map-marker-circle",
          title: "Geofences",
          color: "indigo",
          width: 500,
          closeOnClick: false
        },
        {
          icon: "mdi-bell",
          title: "Notifications",
          color: "cyan",
          width: 500,
          closeOnClick: false
        },
        {
          icon: "mdi-settings",
          title: "Settings",
          color: "blue",
          width: 500,
          closeOnClick: true
        }
      ]
    };
  },
  methods: {
    setItem(item) {
      this.show = item.title;
      this.width = item.width;
      this.closeOnClick = item.closeOnClick;
    },
    clearItem() {
      this.show = null;
      this.width = 400;
      this.closeOnClick = true;
    }
  },
  watch: {
    menu: function(val) {
      if (!val) {
        this.clearItem();
      }
    }
  }
};
</script>
