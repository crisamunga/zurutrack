<template>
  <div class="text-center">
    <v-dialog v-model="dialog" width="100%" :fullscreen="true">
      <template v-slot:activator="{ on }">
        <v-btn fab dark :color="iconColor" v-on="on">
          <v-icon>{{icon}}</v-icon>
        </v-btn>
        <div class="caption py-2">
          {{iconLabel}}
        </div>
      </template>

      <v-card class="pb-5">

        <v-toolbar dark class="mb-3 bg-primary" height="80" extended extension-height="400">
          <slot name="headerLeft" />

          <v-spacer></v-spacer>
          <slot name="headerRight" />
          <v-btn text @click="dialog = false">
            <v-icon left>mdi-close</v-icon> Close
          </v-btn>
        </v-toolbar>



        <v-card class="mx-5" style="margin-top:-350px;">
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
