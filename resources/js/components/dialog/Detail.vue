<template>
  <div class="text-center">
    <v-dialog v-model="dialog" width="100%" :fullscreen="$vuetify.breakpoint.mdAndDown">
      <template v-slot:activator="{ on }">
        <v-btn fab dark :color="iconColor" v-on="on">
          <v-icon>{{icon}}</v-icon>
        </v-btn>
        <div class="caption py-2">
          {{iconLabel}}
        </div>
      </template>

      <v-card class="pb-5">

        <v-toolbar dark class="mb-3 bg-primary" height="80">
          <slot name="headerLeft" />

          <v-spacer></v-spacer>
          <slot name="headerRight" />
          <v-btn text @click="dialog = false">
            <v-icon left>mdi-close</v-icon> Close
          </v-btn>
        </v-toolbar>



        <v-card class="mx-5">
          <slot />
        </v-card>

      </v-card>
    </v-dialog>
  </div>
</template>

<script>
export default {
  props: {
    icon: String,
    iconLabel: String,
    iconColor: String
  },
  data() {
    return {
      dialog: false
    };
  }
};
</script>
