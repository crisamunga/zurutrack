<template>
  <v-list class="pt-0">
    <v-toolbar class="mb-2 px-0" color="transparent" flat>
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
    <v-data-iterator
      :items="trackers"
      :items-per-page.sync="itemsPerPage"
      :search="search"
      :footer-props="{ itemsPerPageOptions }"
    >
      <template v-slot:default="props">
        <sidebar-trackers-list-item
          v-for="(item, index) in props.items"
          :key="index"
          :tracker="item" />
      </template>
    </v-data-iterator>
  </v-list>
</template>

<script>
import { mapState } from 'vuex';

export default {
  data() {
    return {
      itemsPerPageOptions: [5, 10, 25, 50],
      itemsPerPage: 5,
      search: null
    };
  },
  computed: {
    ...mapState({
      trackers: state => state.trackers.trackers
    })
  },
};
</script>
