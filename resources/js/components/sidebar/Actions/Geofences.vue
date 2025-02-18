<template>
  <div>
    <v-toolbar dark color="transparent">
      <buttons-hover-icon top icon="mdi-arrow-left" label="Back" @click="back" />
      <v-spacer></v-spacer>
      <v-toolbar-title>Geofences</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn text small>
        <v-icon left>mdi-plus</v-icon>Add
      </v-btn>
    </v-toolbar>

    <v-data-iterator
      :items="geofences"
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
            <v-avatar :color="getRandomColor(item.name)" size="48">
              <span class="white--text">{{ item.name.charAt(0) }}</span>
            </v-avatar>
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title class="text-uppercase">{{ item.name }}</v-list-item-title>
            <v-list-item-subtitle class="caption">Center: {{ item.center.lat }}, {{ item.center.lng }}</v-list-item-subtitle>
            <v-list-item-subtitle class="caption">Radius: {{ item.radius }}m</v-list-item-subtitle>
          </v-list-item-content>

          <v-list-item-action>
            <v-list-item-action-text>Set</v-list-item-action-text>
            <v-switch :input-value="isSelected(item)" @change="(v) => select(item, v)" />
          </v-list-item-action>

          <v-list-item-action>
            <v-list-item-action-text>Edit</v-list-item-action-text>
            <v-btn icon>
              <v-icon>mdi-pencil</v-icon>
            </v-btn>
          </v-list-item-action>

          <v-list-item-action>
            <v-list-item-action-text>Delete</v-list-item-action-text>
            <v-btn icon>
              <v-icon>mdi-delete</v-icon>
            </v-btn>
          </v-list-item-action>
        </v-list-item>
      </template>
    </v-data-iterator>
  </div>
</template>

<script>
import { mapState } from "vuex";
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
    ...mapState({
      geofences: state => state.geofences.geofences
    })
  },
  methods: {
    back() {
      this.$emit("back");
    },
    getRandomColor(name) {
      return colors.getSpecificColor(name.charCodeAt(0));
    }
  }
};
</script>