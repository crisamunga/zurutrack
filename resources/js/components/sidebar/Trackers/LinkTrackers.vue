<template>
  <div>
    <v-toolbar dark color="transparent">
      <buttons-hover-icon top icon="mdi-arrow-left" label="Back" @click="back" />
      <v-spacer></v-spacer>
      <v-toolbar-title>Linked trackers</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn text small>
        <v-icon left>mdi-information-outline</v-icon>About
      </v-btn>
    </v-toolbar>

    <v-data-iterator
      :items="trackers"
      :items-per-page.sync="itemsPerPage"
      :search="search"
      :footer-props="{ itemsPerPageOptions }"
      :single-select="false"
      v-model="select"
    >
      <template v-slot:header>
        <v-toolbar color="transparent" flat>
          <v-text-field
            filled
            shaped
            v-model="search"
            hide-details
            label="Search"
            clearable
            single-line
          >
            <template v-slot:append>
              <v-icon v-if="!search || search == null">mdi-magnify</v-icon>
            </template>
          </v-text-field>
        </v-toolbar>
      </template>
      <template v-slot:default="{ items, isSelected, select }">
        <v-list-item v-for="(item, index) in items" :key="index">
          <v-list-item-avatar>
            <v-avatar class="elevation-3">
              <v-icon :class="getIconClass(item.state)">mdi-chip</v-icon>
            </v-avatar>
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title class="text-uppercase">{{ item.name }}</v-list-item-title>
            <v-list-item-subtitle class="caption">{{ item.fleet }} Trackers</v-list-item-subtitle>
          </v-list-item-content>

          <v-list-item-action>
            <v-list-item-action-text>Link</v-list-item-action-text>
            <v-switch :input-value="isSelected(item)" @change="(v) => select(item, v)" />
          </v-list-item-action>

          <v-list-item-action>
            <v-list-item-action-text>Locate</v-list-item-action-text>
            <v-btn icon>
              <v-icon>mdi-map-marker</v-icon>
            </v-btn>
          </v-list-item-action>
        </v-list-item>
      </template>
    </v-data-iterator>
  </div>
</template>

<script>
import colors from "../../../utils/colors";

export default {
  props: {
    tracker: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      itemsPerPageOptions: [5, 10],
      itemsPerPage: 5,
      search: "",
      select: []
    };
  },
  computed: {
    trackers() {
      return this.$store.state.trackers.trackers.filter(
        value => value.id != this.tracker.id
      );
    }
  },
  methods: {
    back() {
      this.$emit("back");
    },
    getIconClass(state) {
      return state.toLowerCase() == "active"
        ? "green--text"
        : "red--text";
    }
  }
};
</script>