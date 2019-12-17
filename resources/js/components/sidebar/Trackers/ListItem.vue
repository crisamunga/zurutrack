<template>
  <v-list-item three-line>
    <v-list-item-avatar>
      <v-avatar class="elevation-3">
        <v-icon :class="iconClass">mdi-chip</v-icon>
      </v-avatar>
    </v-list-item-avatar>

    <v-list-item-content>
      <v-list-item-title class="text-uppercase body-2">{{ this.tracker.name }}</v-list-item-title>
      <v-list-item-subtitle class="text-uppercase caption">{{ this.tracker.state || "Offline" }}</v-list-item-subtitle>
      <v-list-item-subtitle class="overline">
        Expires on
        <span :class="getExpiresOnColor(tracker.expires_on)">{{ this.tracker.expires_on }}</span>
      </v-list-item-subtitle>
    </v-list-item-content>

    <v-list-item-action>
      <v-list-item-action-text>
        <v-tooltip right v-if="this.tracker.fleet && this.tracker.fleet.length > 10">
          <template v-slot:activator="{ on }">
            <span text v-on="on">
              {{
              tracker.fleet.substring(0, 10) + "..."
              }}
            </span>
          </template>
          <span>{{ this.tracker.fleet }}</span>
        </v-tooltip>
        <span v-else>{{ this.tracker.fleet }}</span>
      </v-list-item-action-text>

      <div class="text-center">
        <sidebar-actions-menu :tracker="tracker">
          <template slot-scope="{ on }">
            <v-btn color="indigo" dark v-on="on" icon>
              <v-icon>mdi-dots-vertical</v-icon>
            </v-btn>
          </template>
        </sidebar-actions-menu>
      </div>
    </v-list-item-action>
  </v-list-item>
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
      tab: null,
      fav: false,
      menu: false,
      notification: false,
      hints: true,
    };
  },
  computed: {
    iconClass() {
      return this.tracker.state.toLowerCase() == "active"
        ? "green--text"
        : "red--text";
    }
  },
  methods: {
    getColor(state) {
      return state.toLowerCase() == "active" ? "primary" : "red";
    },
    getExpiresOnColor(date) {
      return this.expired(date) ? "primary--text" : "red--text";
    },
    expired(date) {
      return new Date(date) > new Date();
    }
  }
};
</script>

<style lang="css" scoped>
.bg-light {
  background-color: #ffeeff;
}
</style>
