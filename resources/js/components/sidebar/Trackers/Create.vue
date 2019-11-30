<template>
  <dialog-large @closed="onClose">
    <template v-slot:activator="{ on }">
      <slot name="activator" :on="on" />
    </template>

    <v-container>
      <h1
        class="display-1 text-center white--text"
        style="margin-top: -100px; margin-bottom: 100px;"
      >
        Add tracker
      </h1>
      <v-stepper v-model="element" vertical class="elevation-0">
        <v-stepper-step :complete="element > 1" step="1">
          Enter your tracker details
        </v-stepper-step>

        <v-stepper-content step="1">
          <v-container>
            <v-row>
              <v-col cols="12" sm="6" md="4">
                <v-text-field
                  label="Name"
                  v-model="name"
                  hint="You can use the vehicle numberplate or model here"
                  persistent-hint
                />
              </v-col>
              <v-col cols="12" sm="6" md="4">
                <v-select
                  label="Model"
                  v-model="model"
                  :items="models"
                  :menu-props="{ maxHeight: '400' }"
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
                />
              </v-col>
            </v-row>
          </v-container>

          <v-btn color="primary" @click="element = 2">Continue</v-btn>
          <v-btn text>Cancel</v-btn>
        </v-stepper-content>

        <v-stepper-step :complete="element > 2" step="2">
          Configure your tracker to connect with out platform
        </v-stepper-step>

        <v-stepper-content step="2">
          <v-card color="grey lighten-1" class="mb-12" height="200px"></v-card>
          <v-btn color="primary" @click="element = 3">Continue</v-btn>
          <v-btn text>Cancel</v-btn>
        </v-stepper-content>

        <v-stepper-step :complete="element > 3" step="3">
          Final steps
        </v-stepper-step>

        <v-stepper-content step="3">
          <v-container>
            <v-row>
              <v-col cols="12" sm="12" md="6">
                <v-btn text>
                  <v-icon left>mdi-account</v-icon> Set client
                </v-btn>
              </v-col>
              <v-col cols="12" sm="12" md="6">
                <v-btn text>
                  <v-icon left>mdi-map-marker-multiple</v-icon> Set fleet
                </v-btn>
              </v-col>
            </v-row>
          </v-container>
          <v-btn color="primary">Finish</v-btn>
        </v-stepper-content>
      </v-stepper>
    </v-container>
  </dialog-large>
</template>

<script>
import { mapState } from "vuex";
import colors from "../../../utils/colors";

export default {
  data() {
    return {
      element: 0,
      name: "",
      model: "",
      serial: "",
      sim: "",
      models: ["Noran 008", "Coban 102"]
    };
  },
  methods: {
    onClose() {
      this.element = 1;
    }
  }
};
</script>
