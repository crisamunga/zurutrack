<template>
  <div class="pb-5">
    <v-toolbar dark color="transparent">
      <buttons-hover-icon icon="mdi-arrow-left" label="Back" @click="back" />
      <v-spacer></v-spacer>
      <v-toolbar-title>Details</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn text small>
        <v-icon left>mdi-upload</v-icon>Save
      </v-btn>
      <v-btn text small>
        <v-icon left>mdi-delete</v-icon>Delete
      </v-btn>
    </v-toolbar>

    <v-list class="transparent">
      <v-list-item>
        <v-list-item-content>
          <v-text-field name="name" label="Name" v-model="name"></v-text-field>
        </v-list-item-content>
      </v-list-item>

      <v-list-item>
        <v-list-item-content>
          <v-list-item-subtitle>Model</v-list-item-subtitle>
          <v-list-item-title>{{ this.tracker.model }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item>
        <v-list-item-content>
          <v-list-item-subtitle>Serial</v-list-item-subtitle>
          <v-list-item-title>{{ this.tracker.serial }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item>
        <v-list-item-content>
          <v-list-item-subtitle>Added on</v-list-item-subtitle>
          <v-list-item-title>{{ this.tracker.added_on }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item>
        <v-list-item-content>
          <v-list-item-subtitle>Expires on</v-list-item-subtitle>
          <v-list-item-title>{{ this.tracker.expires_on }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item>
        <v-list-item-content>
          <v-list-item-subtitle>Fleet</v-list-item-subtitle>
          <v-list-item-title>{{ this.tracker.fleet || "No fleet set" }}</v-list-item-title>
        </v-list-item-content>
        <buttons-hover-icon icon="mdi-pencil" label="Edit" />
        <buttons-hover-icon icon="mdi-close" label="Delete" />
      </v-list-item>
    </v-list>
  </div>
</template>

<script>
export default {
  props: {
    tracker: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      name: "",
      model: "",
      serial: "",
      sim: "",
      models: ["Noran 008", "Coban 102"]
    };
  },
  methods: {
    back() {
      this.$emit("back");
    },
    initCurrentValues() {
      this.name = this.tracker.name;
      this.model = this.tracker.model;
      this.serial = this.tracker.serial;
      this.sim = this.tracker.sim;
    }
  },
  mounted() {
    this.initCurrentValues();
  }
};
</script>