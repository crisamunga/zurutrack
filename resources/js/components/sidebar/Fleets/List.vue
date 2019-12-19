<template>
  <div>
    <v-data-iterator
      :items="fleets"
      :items-per-page.sync="itemsPerPage"
      :search="search"
      :footer-props="{ itemsPerPageOptions }"
      :single-select="true"
      :loading="loading"
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
            <v-list-item-subtitle class="caption">{{ item.trackers_count }} Trackers</v-list-item-subtitle>
          </v-list-item-content>

          <v-list-item-action>
            <v-tooltip top>
              <template v-slot:activator="{ on }">
                <v-switch
                  :input-value="isSelected(item)"
                  @change="(v) => select(item, v)"
                  v-on="on"
                />
              </template>
              <span>Set</span>
            </v-tooltip>
          </v-list-item-action>

          <v-list-item-action class="ml-3">
            <sidebar-fleets-edit :fleet="item">
              <template v-slot="{ on }">
                <buttons-hover-icon top icon="mdi-pencil" label="Edit" v-on="on" />
              </template>
            </sidebar-fleets-edit>
          </v-list-item-action>

          <v-list-item-action class="ml-0">
            <sidebar-fleets-delete :fleet="item">
              <template slot-scope="{ on }">
                <buttons-hover-icon top icon="mdi-delete" label="Delete" v-on="on" />
              </template>
            </sidebar-fleets-delete>
          </v-list-item-action>
        </v-list-item>
      </template>
    </v-data-iterator>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";
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
      itemsPerPageOptions: [5, 10, 25, 50],
      itemsPerPage: 5,
      search: "",
      select: [],
      loading: false
    };
  },
  computed: {
    ...mapState({
      fleets: state => state.fleets.fleets
    })
  },
  methods: {
    edit(fleet) {
      this.$emit("edit", fleet);
    },
    remove(fleet) {
      this.$emit("remove", fleet);
    },
    getRandomColor(name) {
      return colors.getSpecificColor(name.charCodeAt(0));
    }
  }
};
</script>
