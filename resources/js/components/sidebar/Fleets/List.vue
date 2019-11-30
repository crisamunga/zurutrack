<template>
  <v-list two-line dense class="pt-0">
    <v-toolbar color="transparent" flat>
          <v-text-field
            v-model="search"
            hide-details
            label="Search"
            clearable
            single-line
            prepend-inner-icon="mdi-magnify"
          ></v-text-field>
          <v-spacer></v-spacer>
          <v-btn icon><v-icon>mdi-plus</v-icon></v-btn>
          <v-btn icon><v-icon>mdi-dots-vertical</v-icon></v-btn>
        </v-toolbar>
    <v-data-iterator
      :items="fleets"
      :items-per-page.sync="itemsPerPage"
      :search="search"
      :footer-props="{ itemsPerPageOptions }"
    >
      <template v-slot:default="props">
        <sidebar-fleets-list-item
          v-for="(item, index) in props.items"
          :key="index"
          :title="item.name"
          :count="item.trackers_count"
        ></sidebar-fleets-list-item>
      </template>
    </v-data-iterator>
  </v-list>
</template>

<script>
import { mapState } from "vuex";
export default {
  data() {
    return {
      itemsPerPageOptions: [5, 10, 25, 50],
      itemsPerPage: 5,
      search: "",
      filter: {},
      owned: [
        {
          title: "Main Fleet",
          count: "2"
        }
      ]
    };
  },
  computed: {
    ...mapState({
      fleets: state => state.fleets.fleets
    }),
  }
};
</script>
