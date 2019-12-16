<template>
  <div>
    <v-toolbar dark color="transparent">
      <buttons-hover-icon top icon="mdi-arrow-left" label="Back" @click="back" />
      <v-spacer></v-spacer>
      <v-toolbar-title>Fleets</v-toolbar-title>
      <v-spacer></v-spacer>
      <sidebar-fleets-add />
      <v-btn text small @click="show = null" v-if="show">
        <v-icon left>mdi-close</v-icon>Cancel
      </v-btn>
    </v-toolbar>

    <sidebar-fleets-list :tracker="tracker" v-if="!show" @edit="edit" @remove="remove" />
    <sidebar-fleets-delete :fleet="fleet" v-if="show == 'remove'" @saved="show = null" />
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
      show: null,
      fleet: null
    };
  },
  computed: {
    ...mapState({
      fleets: state => state.fleets.fleets
    })
  },
  methods: {
    ...mapActions({
      getAllFleets: "fleets/index"
    }),
    back() {
      if (this.show) {
        this.show = null;
      } else {
        this.$emit("back");
      }
    },
    edit(fleet) {
      this.show = "edit";
      this.fleet = fleet;
    },
    remove(fleet) {
      this.show = "remove";
      this.fleet = fleet;
    },
    getRandomColor(name) {
      return colors.getSpecificColor(name.charCodeAt(0));
    }
  },
  mounted() {
    this.getAllFleets();
  },
};
</script>