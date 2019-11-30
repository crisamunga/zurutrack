<template>
  <v-dialog v-model="dialog" max-width="500px">
    <template v-slot:activator="{ on }">
      <v-btn
        :text="$vuetify.breakpoint.mdAndUp"
        :icon="$vuetify.breakpoint.smAndDown"
        v-on="on"
      >
        <v-icon :left="$vuetify.breakpoint.mdAndUp">mdi-plus</v-icon
        ><span v-if="$vuetify.breakpoint.mdAndUp"> Add</span>
      </v-btn>
    </template>
    <v-card>
      <v-card-title>
        <span class="headline">Edit tracker</span>
      </v-card-title>

      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="12" sm="6" md="4">
              <v-text-field label="Name" v-model="name" />
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-select
                label="Model"
                v-model="model"
                :items="models"
                :menu-props="{ maxHeight: '400' }"
              />
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-text-field label="Serial" v-model="serial" />
            </v-col>
          </v-row>
        </v-container>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: ["tracker_id"],
  data() {
    return {
      dialog: false,
      name: "",
      model: "",
      serial: "",
      sim: "",
      models: ["Noran 008", "Coban 102"]
    };
  }
};
</script>
