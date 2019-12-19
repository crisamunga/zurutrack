<template>
  <div>
    <v-toolbar dark color="transparent">
      <buttons-hover-icon top icon="mdi-arrow-left" label="Back" @click="back" />
      <v-spacer></v-spacer>
      <v-toolbar-title>Users</v-toolbar-title>
      <v-spacer></v-spacer>
      <sidebar-users-create>
        <template slot-scope="{ on }">
          <v-btn text small v-on="on">
            <v-icon left>mdi-plus</v-icon>Add
          </v-btn>
        </template>
      </sidebar-users-create>
    </v-toolbar>

    <sidebar-users-list :tracker="tracker" />
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
      itemsPerPageOptions: [5, 10, 25, 50],
      itemsPerPage: 5,
      search: "",
      select: []
    };
  },
  computed: {
    ...mapState({
      clients: state => state.users.users
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