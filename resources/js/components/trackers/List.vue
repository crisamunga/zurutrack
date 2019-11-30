<template>
  <dialog-large>
    <template v-slot:activator="{ on }">
      <slot name="activator" :on="on" />
    </template>

    <template v-slot:headerLeft>
      <v-toolbar-title class="body-2">
        <v-icon>{{ icon }}</v-icon> {{ iconLabel.toUpperCase() }}
      </v-toolbar-title>
    </template>

    <template v-slot:headerRight>
      <v-btn
        v-if="selected.length > 0"
        :text="$vuetify.breakpoint.mdAndUp"
        :icon="$vuetify.breakpoint.smAndDown"
        @click="dialog = false"
      >
        <v-icon :left="$vuetify.breakpoint.mdAndUp">mdi-delete</v-icon>
        <span v-if="$vuetify.breakpoint.mdAndUp"> Delete</span>
      </v-btn>
      <v-btn
        v-if="selected.length > 0"
        :text="$vuetify.breakpoint.mdAndUp"
        :icon="$vuetify.breakpoint.smAndDown"
        @click="dialog = false"
      >
        <v-icon :left="$vuetify.breakpoint.mdAndUp">mdi-chart-bar</v-icon>
        <span v-if="$vuetify.breakpoint.mdAndUp"> Statistics</span>
      </v-btn>
      <trackers-create></trackers-create>
    </template>

    <v-data-table
      v-model="selected"
      :headers="headers"
      :items="trackers"
      :search="search"
      :mobile-breakpoint="1280"
      item-key="id"
      show-select
      sort-by="calories"
      class="elevation-0 bg-light px-5 pb-5 py-10"
    >
      <template v-slot:top>
        <v-toolbar flat class="transparent mb-10">
          <v-text-field
            filled
            shaped
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            single-line
            hide-details
          ></v-text-field>
        </v-toolbar>
      </template>
      <template v-slot:item.action="{ item }">
        <trackers-detail :tracker="item" />
      </template>
      <template v-slot:item.name="{ item }">
        {{ item.name }}
        <v-chip :color="getColor(item.state)" small dark>
          {{ item.state }}
        </v-chip>
      </template>
      <template v-slot:item.client="{ item }">
        <v-avatar
          :color="getNameColor(item.client.charCodeAt(0))"
          size="32"
          class="mr-2"
        >
          <span class="white--text">{{ item.client.charAt(0) }}</span>
        </v-avatar>
        <span>
          {{ item.client }}
        </span>
      </template>
      <template v-slot:item.fleet="{ item }">
        <v-btn color="success" text class="body-2">
          <v-icon left v-if="item.fleet">mdi-map-marker-multiple</v-icon>
          <v-icon left v-else>mdi-plus</v-icon>
          {{ item.fleet || "Set fleet" }}
        </v-btn>
        <v-btn color="red" icon x-small v-if="item.fleet">
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </template>
      <template v-slot:item.expires_on="{ item }">
        <span :class="getExpiresOnColor(item.expires_on)">
          {{ item.expires_on }}
        </span>
      </template>
    </v-data-table>
  </dialog-large>
</template>

<script>
import { mapState } from "vuex";
import colors from "../../utils/colors";

export default {
  data() {
    return {
      icon: "mdi-chip",
      iconLabel: "Trackers",
      iconColor: "black",
      search: "",
      selected: [],
      headers: [
        {
          text: "Name",
          align: "left",
          value: "name"
        },
        { text: "Serial", value: "serial" },
        { text: "Client", value: "client" },
        { text: "Fleet", value: "fleet" },
        { text: "Added on", value: "added_on" },
        { text: "Expires on", value: "expires_on" },
        { text: "Actions", value: "action", sortable: false }
      ]
    };
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
    },
    getNameColor(index) {
      return colors.getSpecificColor(index);
    }
  },
  computed: {
    ...mapState({
      trackers: state => state.trackers.trackers
    })
  }
};
</script>
