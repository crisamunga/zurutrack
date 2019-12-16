<template>
  <v-dialog v-model="dialog" width="600">
    <template v-slot:activator="{ on }">
      <buttons-hover-icon bottom icon="mdi-plus" label="Add fleet" v-on="on" />
    </template>

    <v-card class="pb-5 mx-auto">
      <v-toolbar dark class="mb-3 bg-primary" height="40" extended extension-height="200">
        <v-btn icon @click="dialog = false" v-if="$vuetify.breakpoint.smAndDown">
          <v-icon>mdi-arrow-left</v-icon>
        </v-btn>
        <v-toolbar-title>
          <span class="headline">Add fleet</span>
        </v-toolbar-title>
      </v-toolbar>

      <v-card class="mx-5" style="margin-top:-150px;" min-height="200">
        <v-card-text>
          <span class="caption">Add a new tracker fleet</span>
        </v-card-text>

        <v-card-text>
          <v-form ref="form">
            <v-text-field
              v-model="fleetName"
              :rules="nameRules"
              :error-messages="errors.name"
              label="Fleet Name"
            />
          </v-form>
        </v-card-text>

        <v-alert type="error" v-if="errorMessage" class="bg-error">{{ errorMessage }}</v-alert>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text @click="dialog = false" v-if="$vuetify.breakpoint.mdAndUp" color="red">Cancel</v-btn>
          <v-btn text @click="save" color="primary">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-card>
  </v-dialog>
</template>

<script>
import { mapActions } from "vuex";
import validators from "../../../utils/validators";

export default {
  data() {
    return {
      show: null,
      fleetName: "",
      nameRules: [v => validators.required(v)],
      loading: false,
      errors: {},
      errorMessage: null
    };
  },
  computed: {
    dialog: {
      get() {
        return this.show;
      },
      set(val) {
        this.show = val;
        if (!val) {
          this.fleetName = "";
          this.errors = {};
          this.errorMessage = null;
          this.loading = false;
        }
      }
    }
  },
  methods: {
    ...mapActions({
      storeFleet: "fleets/store"
    }),
    save() {
      if (this.$refs.form.validate()) {
        const data = { name: this.fleetName };
        this.loading = true;
        this.storeFleet(data)
          .then(response => {
            this.loading = false;
            this.dialog = false;
          })
          .catch(error => {
            this.loading = false;
            this.errors = error.response.data.errors;
            this.errorMessage = error.response.data.message;
          });
      }
    }
  }
};
</script>
