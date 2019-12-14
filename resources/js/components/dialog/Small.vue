<template>
  <div class="text-center">
    <v-dialog v-model="innerDialog" width="600" :fullscreen="fullscreen">
      <template v-slot:activator="{ on }">
        <slot name="activator" :on="on" />
      </template>

      <v-card class="pb-5 mx-auto">

        <v-toolbar dark class="mb-3 bg-primary" height="40" extended extension-height="200">
          <v-btn icon @click="closed" v-if="$vuetify.breakpoint.smAndDown">
            <v-icon>mdi-arrow-left</v-icon>
          </v-btn>
          <slot name="headerLeft" />

          <v-spacer></v-spacer>
          <slot name="headerRight" />
          <v-btn text @click="closed" v-if="$vuetify.breakpoint.mdAndUp">
            <v-icon left>mdi-close</v-icon> Close
          </v-btn>
        </v-toolbar>

        <v-card class="mx-5" style="margin-top:-150px;" min-height="200">
          <slot :dialog="dialog" />
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
    iconColor: String,
    dialog: Boolean,
    fullscreen: Boolean,
    value: Boolean
  },
  data() {
    return {
      innerDialog: false
    };
  },
  methods: {
    closed() {
      this.innerDialog = false
      this.$emit('closed');
    }
  },
};
</script>
