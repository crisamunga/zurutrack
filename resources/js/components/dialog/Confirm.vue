<template>
  <div class="text-center">
    <v-dialog v-model="innerDialog" width="600" :fullscreen="fullscreen">
      <template v-slot:activator="{ on }">
        <slot name="activator" :on="on" />
      </template>

      <v-card class="pb-5 mx-auto" height="200">
        <v-card-title primary-title>
          <v-avatar color="red">
            <v-icon dark>mdi-close</v-icon>
          </v-avatar>
        </v-card-title>

        <v-card-title primary-title>
          <h3 class="headline">Are you sure?</h3>
        </v-card-title>

        <v-card-text>
          <p>Do you really want to delete this item?</p>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="success">Delete</v-btn>
          <v-btn color="success">Cancel</v-btn>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
export default {
  data() {
    return {
      dialog: false
    };
  },
  methods: {
    confirm() {
      this.$emit("confirm");
      dialog = false;
    },
    cancel() {
      this.$emit("cancel");
      dialog = false;
    }
  }
};
</script>