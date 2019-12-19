<template>
  <v-dialog v-model="dialog" width="600">
    <template v-slot:activator="{ on }">
      <slot :on="on" />
    </template>

    <v-card class="pb-5 mx-auto">
      <v-toolbar dark class="mb-3 bg-primary" height="40" extended extension-height="200">
        <v-btn icon @click="dialog = false" v-if="$vuetify.breakpoint.smAndDown">
          <v-icon>mdi-arrow-left</v-icon>
        </v-btn>

        <v-toolbar-title>
          <span class="headline">{{ name }}</span>
        </v-toolbar-title>

        <v-spacer></v-spacer>
        <v-btn text @click="save">
          <v-icon left>mdi-upload</v-icon>Save
        </v-btn>
        <v-btn text @click="dialog = false" v-if="$vuetify.breakpoint.mdAndUp">
          <v-icon left>mdi-close</v-icon>Close
        </v-btn>
      </v-toolbar>

      <v-card class="mx-5" style="margin-top:-150px;" min-height="200" :loading="loading">
        <v-card-text>
          <span class="caption">Update your fleet details</span>
        </v-card-text>

        <v-form ref="form">
          <v-card-text>
            <v-text-field
              label="Name"
              v-model="name"
              :rules="nameRules"
              :error-messages="errors.name"
            />
          </v-card-text>
        </v-form>

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
  props: {
    fleet: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      m_Dialog: null,
      name: "",
      nameRules: [v => validators.required(v)],
      loading: false,
      errors: {},
      errorMessage: null
    };
  },
  computed: {
    dialog: {
      get() {
        return this.m_Dialog;
      },
      set(val) {
        this.m_Dialog = val;
        if (!val) {
          this.name = this.fleet.name;
        }
      }
    }
  },
  methods: {
    ...mapActions({
      updateFleet: "fleets/update"
    }),
    save() {
      if (this.$refs.form.validate()) {
        const data = {
          id: this.fleet.id,
          name: this.name
        };
        this.loading = true;
        this.updateFleet(data)
          .then(response => {
            this.loading = false;
            this.errorMessage = null;
            this.dialog = false;
          })
          .catch(error => {
            this.loading = false;
            this.errors = error.response.data.errors;
            this.errorMessage = error.response.data.message;
          });
      }
    }
  },
  mounted() {
    this.name = this.fleet.name;
  }
};
</script>
