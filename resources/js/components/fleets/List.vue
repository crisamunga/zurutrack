<template>
  <v-data-table
    :headers="headers"
    :items="fleets"
    sort-by="calories"
    class="elevation-0 bg-light px-5 pb-5"
  >
    <template v-slot:top>
      <v-toolbar flat class="transparent mb-10">
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Search"
          single-line
          hide-details
        ></v-text-field>
      </v-toolbar>
    </template>
    <template v-slot:item.action="{ item }">
      <v-btn flat icon color="primary">
        <v-icon>mdi-dots-vertical</v-icon>
      </v-btn>
      <v-btn flat icon color="blue">
        <v-icon>mdi-pencil</v-icon>
      </v-btn>
      <v-btn flat icon color="red">
        <v-icon>mdi-delete</v-icon>
      </v-btn>
    </template>
  </v-data-table>
</template>

<script>
import { mapState } from "vuex";

export default {
  data: () => ({
    dialog: false,
    search: "",
    headers: [
      {
        text: "Name",
        align: "left",
        value: "name"
      },
      { text: "Number of trackers", value: "trackers_count" },
      { text: "Actions", value: "action", sortable: false }
    ],
  }),
  computed: {
    ...mapState({
      fleets: state => state.fleets.fleets
    }),
  },
};
</script>
