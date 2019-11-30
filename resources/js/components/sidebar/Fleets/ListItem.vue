<template>
  <v-list-item>
    <v-list-item-avatar>
      <v-avatar :color="getRandomColor()" size="48">
        <span class="white--text">{{ title.charAt(0) }}</span>
      </v-avatar>
    </v-list-item-avatar>

    <v-list-item-content>
      <v-list-item-title class="text-uppercase">{{ title }}</v-list-item-title>
      <v-list-item-subtitle class="caption">
        {{ count }} Trackers
      </v-list-item-subtitle>
    </v-list-item-content>
  </v-list-item>
</template>

<script>
import colors from "../../../utils/colors";
export default {
  props: ["title", "count"],
  methods: {
    getRandomColor() {
      return colors.getRandomColor();
    }
  }
};
</script>
