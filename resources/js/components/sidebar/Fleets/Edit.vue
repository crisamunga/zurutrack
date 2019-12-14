<template>
  <dialog-small>
    <template v-slot:activator="{ on }">
      <buttons-hover-icon bottom icon="mdi-pencil" label="Edit" v-on="on" />
    </template>

    <template v-slot:headerLeft>
      <v-toolbar-title>
        <span class="headline">{{ fleetName }}</span>
      </v-toolbar-title>
    </template>

    <template v-slot:headerRight>
      <v-btn text @click="save"><v-icon left>mdi-upload</v-icon> Save</v-btn>
    </template>

    <v-card flat>
      <v-card-text>
        <span class="caption">Update your fleet details</span>
      </v-card-text>

      <v-card-text>
        <v-text-field v-model="fleetName" label="Fleet Name" />
      </v-card-text>

    </v-card>
  </dialog-small>
</template>

<script>
import colors from "../../../utils/colors";
export default {
  props: {
    fleet: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      dialog: null,
      fleetName: ""
    };
  },
  methods: {
    save() {
      this.$emit("saved");
    },
    getRandomColor() {
      return colors.getRandomColor();
    }
  },
  mounted() {
    this.fleetName = this.fleet.name;
  }
};
</script>
