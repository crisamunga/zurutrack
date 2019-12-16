<template>
  <v-app>
    <component :is="layout">
      <core-router-view />
    </component>
  </v-app>
</template>

<script>
import { mapGetters } from "vuex";
const default_layouts = "layouts-auth";

export default {
  computed: {
    layout() {
      return this.$route.meta.layout || default_layouts;
    }
  }
};
</script>

