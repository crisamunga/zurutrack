<template>
  <v-dialog v-model="dialog" width="100%" :fullscreen="true">
    <template v-slot:activator="{ on }">
      <slot name="activator" :on="on" />
    </template>
    <v-card class="pb-5">
      <v-toolbar dark class="mb-3 bg-primary" height="80" extended extension-height="400">
        <v-btn icon @click="dialog = false" v-if="$vuetify.breakpoint.smAndDown">
          <v-icon>mdi-arrow-left</v-icon>
        </v-btn>
        <v-spacer></v-spacer>
        <h1 class="headline text-center white--text text-uppercase nunito">Add tracker</h1>
        <v-spacer></v-spacer>
        <v-btn text @click="dialog = false" v-if="$vuetify.breakpoint.mdAndUp">
          <v-icon left>mdi-close</v-icon>Close
        </v-btn>
      </v-toolbar>

      <v-card class="mx-5" style="margin-top:-350px;" min-height="500" :loading="loading">
        <v-container>
          <v-stepper v-model="element" vertical class="elevation-0">
            <v-stepper-step :complete="element > 1" step="1">Enter your tracker details</v-stepper-step>

            <v-stepper-content step="1">
              <v-container>
                <v-form ref="form">
                  <v-row>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        label="Name"
                        v-model="name"
                        hint="You can use the vehicle numberplate or model here"
                        :rules="nameRules"
                        :error-messages="errors.name"
                        persistent-hint
                      />
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
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
                    </v-col>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field
                        label="Serial"
                        v-model="serial"
                        hint="Your tracker's unique serial or imei"
                        persistent-hint
                        :rules="serialRules"
                        :error-messages="errors.serial"
                      />
                    </v-col>
                  </v-row>
                </v-form>
                <v-alert type="error" v-if="errorMessage" class="bg-error">{{ errorMessage }}</v-alert>
              </v-container>

              <v-btn color="primary" @click="saveTracker">Continue</v-btn>
              <v-btn text @click="dialog = false">Cancel</v-btn>
            </v-stepper-content>

            <v-stepper-step
              :complete="element > 1"
              step="2"
            >Configure your tracker to connect with out platform</v-stepper-step>

            <v-stepper-content step="2">
              <v-card class="mb-12" min-height="200px">
                <v-card-text>{{ modelInstructions }}</v-card-text>
              </v-card>
              <v-btn color="primary" @click="dialog = false">Finish</v-btn>
            </v-stepper-content>
          </v-stepper>
        </v-container>
      </v-card>
    </v-card>
  </v-dialog>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import colors from "../../../utils/colors";
import validators from "../../../utils/validators";

export default {
  data() {
    return {
      element: 0,
      name: "",
      tracker_model_id: null,
      serial: "",
      nameRules: [v => validators.required(v)],
      modelRules: [v => validators.required(v)],
      serialRules: [v => validators.required(v)],
      isOpen: false,
      loading: false,
      errors: {},
      errorMessage: null
    };
  },
  computed: {
    ...mapGetters({
      models: "models/allModels"
    }),
    modelInstructions() {
      let model = this.models.reduce((previous, current) => {
        if (current.id == this.tracker_model_id) {
          return current;
        } else {
          return previous;
        }
      }, null);
      if (model) {
        return model.configuration_instructions;
      } else {
        return "Choose a tracker model to get it's configuration instructions";
      }
    },
    modelList() {
      return this.models.map(val => val.name);
    },
    dialog: {
      get: function() {
        return this.isOpen;
      },
      set: function(val) {
        if (!val) {
          this.element = 1;
          this.isOpen = false;
          this.loading = false;
          this.errors = {};
          this.errorMessage = null;
          this.name = "";
          this.tracker_model_id = null;
          this.serial = "";
        }
        this.isOpen = val;
      }
    }
  },
  methods: {
    ...mapActions({
      fetchModels: "models/fetchModels",
      storeTracker: "trackers/store"
    }),
    saveTracker() {
      if (this.$refs.form.validate()) {
        const data = {
          name: this.name,
          tracker_model_id: this.tracker_model_id,
          serial: this.serial
        };
        this.loading = true;
        this.storeTracker(data)
          .then(response => {
            this.loading = false;
            this.element = 2;
            this.errorMessage = null;
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
    this.fetchModels();
  }
};
</script>
