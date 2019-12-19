<template>
  <v-dialog v-model="dialog" width="500" persistent>
    <template v-slot:activator="{ on }">
      <slot :on="on" />
    </template>

    <v-card class="py-5 mx-auto bg-secondary" width="500" height="500" dark>
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
        <p>Deleting this user will deny them access to all trackers on your account, but they will still be able to log in with their account. Proceed?</p>
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
    user: {
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
      deleteuser: "users/delete"
    }),
    confirm() {
      this.deleteuser(this.user.id).then(response => {
        this.dialog = false;
      });
    },
    cancel() {
      this.dialog = false;
    }
  }
};
</script>