<template>
  <v-dialog v-model="dialog" width="500" persistent>
    <template v-slot:activator="{ on }">
      <slot :on="on" />
    </template>

    <v-card class="py-5 mx-auto bg-secondary" dark>
      <v-btn icon absolute top right @click="cancel">
        <v-icon>mdi-close</v-icon>
      </v-btn>

      <v-card-title primary-title class="text-center">
        <v-spacer></v-spacer>
        <v-btn class="ma-2" outlined disabled height="164" width="164" fab color="red">
          <v-icon size="82">mdi-delete</v-icon>
        </v-btn>
        <v-spacer></v-spacer>
      </v-card-title>

      <v-card-title>
        <v-spacer></v-spacer>
        <p class="display-1">Are you sure?</p>
        <v-spacer></v-spacer>
      </v-card-title>

      <v-card-text class="text-center">
        <p>Do you really want to delete this item?</p>
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn large text @click="cancel">Cancel</v-btn>
        <v-spacer></v-spacer>
        <v-btn large text @click="confirm">Delete</v-btn>
        <v-spacer></v-spacer>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import { mapActions } from "vuex";
export default {
  props: {
    tracker: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      dialog: false
    };
  },
  methods: {
    ...mapActions({
      deleteTracker: "trackers/delete"
    }),
    confirm() {
      this.deleteTracker(this.tracker.id).then(response => {
        this.dialog = false;
      });
    },
    cancel() {
      this.dialog = false;
    }
  }
};
</script>