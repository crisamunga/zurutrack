<template>
  <v-dialog v-model="dialog" width="600">
    <template v-slot:activator="{ on }">
      <buttons-hover-icon bottom icon="mdi-pencil" label="Edit" v-on="on" />
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
          <span class="caption">Update your tracker details</span>
        </v-card-text>

        <v-form ref="form">
          <v-card-text>
            <v-text-field
              label="Name"
              v-model="name"
              hint="You can use the vehicle numberplate or model here"
              :rules="nameRules"
              :error-messages="errors.name"
              persistent-hint
            />
          </v-card-text>

          <v-card-text>
            <v-select
              label="Model"
              v-model="tracker_model_id"
              :items="models"
              item-text="name"
              item-value="id"
              :menu-props="{ maxHeight: '400' }"
              :rules="modelRules"
              :error-messages="errors.tracker_model_id"
              hint="The model for your tracker"
              persistent-hint
            />
          </v-card-text>

          <v-card-text>
            <v-text-field
              label="Serial"
              v-model="serial"
              hint="Your tracker's unique serial or imei"
              persistent-hint
              :rules="serialRules"
              :error-messages="errors.serial"
            />
          </v-card-text>
        </v-form>

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
import { mapGetters, mapActions } from "vuex";
import validators from "../../../utils/validators";
export default {
  props: {
    tracker: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      m_Dialog: null,
      name: "",
      tracker_model_id: "",
      serial: "",
      nameRules: [v => validators.required(v)],
      modelRules: [v => validators.required(v)],
      serialRules: [v => validators.required(v)],
      loading: false,
      errors: {},
      errorMessage: null
    };
  },
  computed: {
    ...mapGetters({
      models: "models/allModels"
    }),
    dialog: {
      get() {
        return this.m_Dialog;
      },
      set(val) {
        this.m_Dialog = val;
        if (!val) {
          this.name = this.tracker.name;
          this.tracker_model_id = this.tracker.tracker_model.id;
          this.serial = this.tracker.serial;
        }
      }
    }
  },
  methods: {
    ...mapActions({
      fetchModels: "models/fetchModels",
      updateTracker: "trackers/update"
    }),
    save() {
      if (this.$refs.form.validate()) {
        const data = {
          id: this.tracker.id,
          name: this.name,
          tracker_model_id: this.tracker_model_id,
          serial: this.serial
        };
        this.loading = true;
        this.updateTracker(data)
          .then(response => {
            this.loading = false;
            this.errorMessage = null;
            this.m_Dialog = false;
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
    this.name = this.tracker.name;
    this.tracker_model_id = this.tracker.tracker_model.id;
    this.serial = this.tracker.serial;
    this.fetchModels();
  }
};
</script>
