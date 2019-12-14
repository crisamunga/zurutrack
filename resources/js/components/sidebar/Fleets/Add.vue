<template>
  <dialog-small>
    <template v-slot:activator="{ on }">
      <buttons-hover-icon bottom icon="mdi-plus" label="Add fleet" v-on="on" />
    </template>

    <template v-slot:headerLeft>
      <v-toolbar-title>
        <span class="headline">Add fleet</span>
      </v-toolbar-title>
    </template>

    <template v-slot:headerRight>
      <v-btn text @click="save"><v-icon left>mdi-upload</v-icon> Save</v-btn>
    </template>

    <v-card flat>
      <v-card-text>
        <span class="caption">Add a new tracker fleet</span>
      </v-card-text>

      <v-card-text>
        <v-text-field v-model="fleetName" label="Fleet Name" />
      </v-card-text>

    </v-card>
  </dialog-small>
</template>

<script>
export default {
  data() {
    return {
      dialog: null,
      fleetName: ""
    };
  },
  methods: {
    save() {
      this.$emit("saved");
    }
  }
};
</script>
